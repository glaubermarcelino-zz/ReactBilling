import { combineReducers } from 'redux';
import { connectRouter } from 'connected-react-router';

import login from './login';
import home from './home';
import account from './account';
import transaction from './transaction';

export default (history: any) => combineReducers({
    router: connectRouter(history),
    login, home, account, transaction
});