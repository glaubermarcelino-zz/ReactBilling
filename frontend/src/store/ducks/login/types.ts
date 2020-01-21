export enum LoginTypes {
    LOGIN_REQUEST = '@login/LOGIN_REQUEST',
    LOGIN_SUCCESS = '@login/LOGIN_SUCCESS',
    LOGIN_FAILURE = '@login/LOGIN_FAILURE',
    LOGIN_RESET = '@login/LOGIN_RESET',
}

export interface LoginState {
    readonly isError: boolean,
    readonly isLoading: boolean,
    readonly isErrorMessage: string
}