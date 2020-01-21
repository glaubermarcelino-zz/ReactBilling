import { call, put } from 'redux-saga/effects';
import { Api } from '../../../services/api';
import { push } from "connected-react-router";

import { RequestAccountUserLogged } from "../../../factory/request/requestAccountUserLogged";
import { accountFailure, accountSuccess, transactionDashSuccess, transactionDashFailure  } from './action';
import {RequestTransactionDashboard} from "../../../factory/request/requestTransactionDashboard";

interface Action {
    type?: string,
    payload?: any
}

function account() {
    return Api.run(new RequestAccountUserLogged());
}

function transactionDash(date: string | Date) {
    return Api.run(new RequestTransactionDashboard(date));
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

export function* transactionDashEffect(action: Action) {
    try {
        const responseAccount = yield call(transactionDash, action.payload.date);
        yield put(transactionDashSuccess(responseAccount.data));
    } catch (err) {
        switch (err.response.status) {
            case 401:
                yield put(push("/"));
                break;
            case 404:
                yield put(transactionDashFailure());
                break;
        }
    }
}
