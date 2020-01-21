import { action } from 'typesafe-actions';
import { Select, Transaction, TransactionTypes} from './types';

export const accountRequest = () => action(TransactionTypes.ACCOUNT_REQUEST);

export const accountSuccess = (data: Select[]) => action(TransactionTypes.ACCOUNT_SUCCESS, { data });

export const accountFailure = () => action(TransactionTypes.ACCOUNT_FAILURE);

export const categoryRequest = (id: number) => action(TransactionTypes.CATEGORY_REQUEST, { id });

export const categorySuccess = (data: Select[]) => action(TransactionTypes.CATEGORY_SUCCESS, { data });

export const categoryFailure = () => action(TransactionTypes.CATEGORY_FAILURE);

export const transactionRequest = (date: string | Date, type?: number, category?: number) => action(TransactionTypes.TRANSACTION_REQUEST, {date, type, category});

export const transactionSuccess = (data: Transaction[]) => action(TransactionTypes.TRANSACTION_SUCCESS, { data });

export const transactionFailure = () => action(TransactionTypes.TRANSACTION_FAILURE);

export const transactionRegister = (params: Transaction) => action(TransactionTypes.TRANSACTION_REGISTER, { params });

export const transactionRegisterFinally = (error: string) => action(TransactionTypes.TRANSACTION_REGISTER_FINALLY, { error });