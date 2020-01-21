import { Reducer } from "redux";
import { TransactionTypes, TransactionState } from './types';

const INITIAL_STATE: TransactionState  = {
    account: [],
    category: [],
    transactions: [],
    isLoadingCategory: false,
    isLoadingAccount: false,
    isLoadingTransaction: false,
    isErrorRegister: "",
    isLoadingRegister: false
};

const reducer: Reducer<TransactionState> = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        case TransactionTypes.CATEGORY_REQUEST:
            return { ...state, isLoadingCategory: true };
        case TransactionTypes.CATEGORY_SUCCESS:
            return { ...state, isLoadingCategory: false, category: action.payload.data };
        case TransactionTypes.CATEGORY_FAILURE:
            return {...state,  isLoadingCategory: false, category: []};
        case TransactionTypes.ACCOUNT_REQUEST:
            return { ...state, isLoadingAccount: true };
        case TransactionTypes.ACCOUNT_SUCCESS:
            return { ...state, isLoadingAccount: false, account: action.payload.data };
        case TransactionTypes.ACCOUNT_FAILURE:
            return {...state,  isLoadingAccount: false, account: []};
        case TransactionTypes.TRANSACTION_REQUEST:
            return { ...state, isLoadingTransaction: true };
        case TransactionTypes.TRANSACTION_SUCCESS:
            return { ...state, isLoadingTransaction: false, transactions: action.payload.data };
        case TransactionTypes.TRANSACTION_FAILURE:
            return {...state,  isLoadingTransaction: false, transactions: []};
        case TransactionTypes.TRANSACTION_REGISTER:
            return { ...state, isLoadingRegister: true };
        case TransactionTypes.TRANSACTION_REGISTER_FINALLY:
            return { ...state, isLoadingRegister: false, isErrorRegister: action.payload.error };
        default:
            return state;
    }
};

export default reducer;