import swal from 'sweetalert';
import { call, put } from 'redux-saga/effects';
import { push } from "connected-react-router";
import { Api } from '../../../services/api';
import { Transaction, Account, Select, Category } from './types';

import { RequestCategoryTypeList } from "../../../factory/request/requestCategoryTypeList";
import { RequestAccountUserLogged} from "../../../factory/request/requestAccountUserLogged";
import { RequestTransactionRegister } from "../../../factory/request/requestTransactionRegister";
import {
    transactionRegisterFinally,
    accountFailure,
    accountSuccess,
    categoryFailure,
    categorySuccess,
    transactionRequest,
    transactionSuccess,
    transactionFailure
} from './action';
import {RequestTransactionFIlterList} from "../../../factory/request/requestTransactionFIlterList";

interface Action {
    type?: string,
    payload?: any
}

function account() {
    return Api.run(new RequestAccountUserLogged());
}

function category(id: number) {
    return Api.run(new RequestCategoryTypeList(id));
}

function transaction(params: object) {
    return Api.run(new RequestTransactionFIlterList(params))
}

function transactionRegister(params: Transaction) {
    return Api.run(new RequestTransactionRegister(params));
}

export function* categoryEffect(action: Action) {
    try {
        const responseCategory = yield call(category, action.payload.id);
        const list: Select[] = [];
        responseCategory.data.map((item: Category) => {
            const s: Select = {};
            s.label = item.category;
            s.value = item.id;
            list.push(s);
            return null;
        });
        yield put(categorySuccess(list));
    } catch (err) {
        switch (err.response.status) {
            case 401:
                yield put(push("/"));
                break;
            case 404:
                yield put(categoryFailure());
                break;
        }
    }
}

export function* accountEffect() {
    try {
        const responseAccount = yield call(account);
        const list: Select[] = [];
        responseAccount.data.map((item: Account) => {
            const s: Select = {};
            s.label = item.name;
            s.value = item.id;
            list.push(s);
            return null;
        });
        yield put(accountSuccess(list));
    } catch (err) {
        switch (err.response.status) {
            case 401:
                yield put(push("/"));
                break;
            case 404:
                yield put(accountFailure());
                break;
        }
    }
}

export function* transactionEffect(action: Action) {
    try {
        const responseAccount = yield call(transaction, action.payload);
        yield put(transactionSuccess(responseAccount.data));
    } catch(err) {
        switch (err.response.status) {
            case 401:
                yield put(push("/"));
                break;
            case 404:
                yield put(transactionFailure());
                break;
        }
    }
}

export function* transactionRegisterEffect(action: Action) {
    try {
        yield call(transactionRegister, action?.payload.params);
        yield put(transactionRegisterFinally(""));
        yield put(transactionRequest(new Date()));
        swal("Success", "Transação registrada com sucesso!", "success");
    } catch (err) {
        switch (err.response.status) {
            case 400:
                console.log(err.response);
                break;
            case 401:
                yield put(push("/"));
                break;
            default:
                swal("Error", `Erro ao registrar a conta!`, "error");
                break;
        }
    }
}