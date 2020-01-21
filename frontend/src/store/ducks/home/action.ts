import { action } from 'typesafe-actions';
import { Account, TransactionDash, HomeTypes } from './types';

export const accountRequest = () => action(HomeTypes.ACCOUNT_REQUEST );

export const accountSuccess = (data: Account) => action(HomeTypes.ACCOUNT_SUCCESS, { data });

export const accountFailure = () => action(HomeTypes.ACCOUNT_FAILURE);

export const transactionDashRequest = (date: string | Date) => action(HomeTypes.TRANSACTION_DASH_REQUEST, { date } );

export const transactionDashSuccess = (data: TransactionDash) => action(HomeTypes.TRANSACTION_DASH_SUCCESS, { data });

export const transactionDashFailure = () => action(HomeTypes.TRANSACTION_DASH_FAILURE);