export enum AccountTypes {
    ACCOUNT_REQUEST = '@account/ACCOUNT_REQUEST',
    ACCOUNT_SUCCESS = '@account/ACCOUNT_SUCCESS',
    ACCOUNT_FAILURE = '@account/ACCOUNT_FAILURE',
    ACCOUNT_REGISTER = '@account/ACCOUNT_REGISTER',
    ACCOUNT_REGISTER_FINALLY = '@account/ACCOUNT_REGISTER_FINALLY'
}

export interface Account {
    id?: number,
    name: string,
    sale: number
}

export interface Transiction {

}

export interface AccountState {
    readonly account: Account[],
    readonly isErrorRegister: string,
    readonly isLoadingAccount: boolean,
    readonly isLoadingRegister: boolean,
    readonly lastTransictions: Transiction[]
}

