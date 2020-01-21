import swal from 'sweetalert';
import { call, put } from 'redux-saga/effects';
import { push } from "connected-react-router";
import { Api } from '../../../services/api';
import { Account } from './types'
import { RequestAccountRegister } from "../../../factory/request/requestAccountRegister";
import { RequestAccountUserLogged } from "../../../factory/request/requestAccountUserLogged";
import { accountFailure, accountSuccess, accountRegisterFinally, accountRequest } from './action';

interface Action {
    type?: string,
    payload?: any
}

function account() {
    return Api.run(new RequestAccountUserLogged());
}

function accountRegister(params: Account) {
    return Api.run(new RequestAccountRegister(params))
}

export function* accountEffect(action: Action) {
    try {
        const responseAccount = yield call(account);
        yield put(accountSuccess(responseAccount.data));
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

export function* accountRegisterEffect(action: Action) {
    try {
        yield call(accountRegister, action?.payload.params);
        yield put(accountRegisterFinally(""));
        yield put(accountRequest());
        swal("Success", `Conta ${action?.payload.params.name.toLowerCase()} registrada com sucesso!`, "success");
    } catch (err) {
        switch (err.response.status) {
            case 400:
                if(err.response.data.validation.name) {
                    yield put(accountRegisterFinally("name"));
                } else {
                    yield put(accountRegisterFinally(""));
                    swal("Error", `Erro ao registrar a conta!`, "error");
                }
                break;
            case 401:
                yield put(push("/"));
                break;
            default:
                swal("Error", `Erro ao registrar a conta!`, "error");
                break
        }
    }
}