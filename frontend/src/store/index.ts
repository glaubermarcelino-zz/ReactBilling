import Thunk from 'redux-thunk';
import Promise from 'redux-promise';
import createSagaMiddleware from 'redux-saga';

import { history  } from '../router/history';
import { LoginState  } from './ducks/login/types';
import { HomeState  } from './ducks/home/types';
import { AccountState } from "./ducks/account/types";
import { TransactionState } from "./ducks/transaction/types";
import { routerMiddleware } from 'connected-react-router';
import { createStore, applyMiddleware, Store } from 'redux';

import rootSaga from './ducks/rootSaga';
import rootReducer from './ducks/rootReducer';

export interface ApplicationState {
    home: HomeState,
    login: LoginState,
    account: AccountState,
    transaction: TransactionState
}

const sagaMiddleware = createSagaMiddleware();

const middleware = [Thunk, Promise, routerMiddleware(history), sagaMiddleware];
const store: Store<ApplicationState> = createStore(rootReducer(history), applyMiddleware(...middleware));

sagaMiddleware.run(rootSaga);

export default store;