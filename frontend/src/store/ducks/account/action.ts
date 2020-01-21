import { action } from 'typesafe-actions';
import { Account, AccountTypes } from './types';

export const accountRequest = () => action(AccountTypes.ACCOUNT_REQUEST );

export const accountSuccess = (data: Account[]) => action(AccountTypes.ACCOUNT_SUCCESS, { data });

export const accountFailure = () => action(AccountTypes.ACCOUNT_FAILURE);

export const accountRegister = (params: Account) => action(AccountTypes.ACCOUNT_REGISTER, { params });

export const accountRegisterFinally = (error: string) => action(AccountTypes.ACCOUNT_REGISTER_FINALLY, { error });