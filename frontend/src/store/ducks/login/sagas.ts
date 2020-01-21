import { push } from 'connected-react-router';
import { call, put } from 'redux-saga/effects';
import { Api } from '../../../services/api';
import { User } from "../../../services/user";
import { Token } from '../../../services/token';

import { loginSuccess, loginFailure, loginReset } from './action';
import { RequestLogin } from "../../../factory/request/requestLogin";
import { RequestUserLogged } from "../../../factory/request/requestUserLogged";

interface Action {
    type?: string,
    payload?: any
}

function login(params: object) {
    return Api.run(new RequestLogin(params));
}

function userLogged() {
    return Api.run(new RequestUserLogged());
}

const delay = (ms: number) => new Promise(res => setTimeout(res, ms));

export function* loginEffect(action: Action) {
    try {
        const responseLogin = yield call(login, action?.payload);
        Token.setToken(responseLogin.data);
        const responseLogged = yield call(userLogged);
        User.setUser(responseLogged.data);
        yield put(loginSuccess());
        yield put(push("/home"));
    } catch (err) {
        switch (err.response.status) {
            case 400:
            case 404:
            case 401:
                yield put(loginFailure("Email or password invalid!"));
                yield delay(5000);
                yield put(loginReset());
                break;
        }
    }
}