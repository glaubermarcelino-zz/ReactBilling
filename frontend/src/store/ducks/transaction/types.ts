export enum TransactionTypes {
    ACCOUNT_REQUEST = '@transaction/ACCOUNT_REQUEST',
    ACCOUNT_SUCCESS = '@transaction/ACCOUNT_SUCCESS',
    ACCOUNT_FAILURE = '@transaction/ACCOUNT_FAILURE',
    CATEGORY_REQUEST = '@transaction/CATEGORY_REQUEST',
    CATEGORY_SUCCESS = '@transaction/CATEGORY_SUCCESS',
    CATEGORY_FAILURE = '@transaction/CATEGORY_FAILURE',
    TRANSACTION_REQUEST = '@transaction/TRANSACTION_REQUEST',
    TRANSACTION_SUCCESS = '@transaction/TRANSACTION_SUCCESS',
    TRANSACTION_FAILURE = '@transaction/TRANSACTION_FAILURE',
    TRANSACTION_REGISTER = '@transaction/TRANSACTION_REGISTER',
    TRANSACTION_REGISTER_FINALLY = '@transaction/TRANSACTION_REGISTER_FINALLY'
}

export interface Select {
    value?: any,
    label?: any
}

export interface Category {
    id: number,
    category: string,
}

export interface Account {
    id: number,
    name: string,
    sale: number,
}

export interface Transaction {
    id?: number,
    account: any,
    type: any,
    category: any,
    name: string,
    value?: number | string,
    date: any,
    fixed?: boolean
    note?: string,
    tag?: string
}

export interface TransactionState {
    readonly account: Account[],
    readonly category: Category[],
    readonly transactions: Transaction[],
    readonly isLoadingAccount: boolean,
    readonly isLoadingCategory: boolean,
    readonly isLoadingTransaction: boolean,
    readonly isErrorRegister: string,
    readonly isLoadingRegister: boolean
}