export enum HomeTypes {
    ACCOUNT_REQUEST = '@home/ACCOUNT_REQUEST',
    ACCOUNT_SUCCESS = '@home/ACCOUNT_SUCCESS',
    ACCOUNT_FAILURE = '@home/ACCOUNT_FAILURE',
    TRANSACTION_DASH_REQUEST = '@home/TRANSACTION_DASH_REQUEST',
    TRANSACTION_DASH_SUCCESS = '@home/TRANSACTION_DASH_SUCCESS',
    TRANSACTION_DASH_FAILURE = '@home/TRANSACTION_DASH_FAILURE',
}

export interface TransactionDash {
    revenue: string,
    expense: string
}

export interface Account {
    name: string,
    sale: number
}

export interface HomeState {
    readonly account: Account[],
    readonly isLoadingAccount: boolean,
    readonly transactionDash: TransactionDash,
    readonly isLoadingTransactionDash: boolean
}