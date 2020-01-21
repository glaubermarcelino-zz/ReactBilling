import { all, takeLatest } from 'redux-saga/effects';

import { LoginTypes  } from './login/types';
import { loginEffect } from './login/sagas';
import { HomeTypes  } from './home/types';
import { accountEffect as accountHomeEffect, transactionDashEffect } from './home/sagas';
import { AccountTypes } from './account/types';
import { accountEffect, accountRegisterEffect  } from './account/sagas';
import { TransactionTypes } from './transaction/types';
import {
    accountEffect as accountTransactionEffect,
    transactionRegisterEffect,
    categoryEffect,
    transactionEffect
} from './transaction/sagas';

export default function* rootSaga() {
    return yield all([
        takeLatest(LoginTypes.LOGIN_REQUEST, loginEffect),
        takeLatest(HomeTypes.ACCOUNT_REQUEST, accountHomeEffect),
        takeLatest(HomeTypes.TRANSACTION_DASH_REQUEST, transactionDashEffect),
        takeLatest(AccountTypes.ACCOUNT_REQUEST, accountEffect),
        takeLatest(AccountTypes.ACCOUNT_REGISTER, accountRegisterEffect),
        takeLatest(TransactionTypes.TRANSACTION_REGISTER, transactionRegisterEffect),
        takeLatest(TransactionTypes.ACCOUNT_REQUEST, accountTransactionEffect),
        takeLatest(TransactionTypes.CATEGORY_REQUEST, categoryEffect),
        takeLatest(TransactionTypes.TRANSACTION_REQUEST, transactionEffect)
    ]);
}