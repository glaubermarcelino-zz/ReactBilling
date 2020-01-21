import { action } from 'typesafe-actions';
import { LoginTypes } from './types';

export const loginRequest = (email: string, password: string) => action(LoginTypes.LOGIN_REQUEST, {email, password} );

export const loginSuccess = () => action(LoginTypes.LOGIN_SUCCESS);

export const loginFailure = (message: string) => action(LoginTypes.LOGIN_FAILURE, { message });

export const loginReset = () => action(LoginTypes.LOGIN_RESET);