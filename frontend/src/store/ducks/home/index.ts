import { Reducer } from "redux";
import { HomeTypes, HomeState } from './types';

const INITIAL_STATE: HomeState = {
    account: [],
    isLoadingAccount: false,
    isLoadingTransactionDash: false,
    transactionDash: { expense: "0,00", revenue: "0,00" }
};

const reducer: Reducer<HomeState> = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        case HomeTypes.ACCOUNT_REQUEST:
            return { ...state, isLoadingAccount: true };
        case HomeTypes.ACCOUNT_SUCCESS:
            return { ...state, isLoadingAccount: false, account: action.payload.data };
        case HomeTypes.ACCOUNT_FAILURE:
            return {...state,  isLoadingAccount: false, account: []};
        case HomeTypes.TRANSACTION_DASH_REQUEST:
            return { ...state, isLoadingTransactionDash: true };
        case HomeTypes.TRANSACTION_DASH_SUCCESS:
            return { ...state, isLoadingTransactionDash: false, transactionDash: action.payload.data };
        case HomeTypes.TRANSACTION_DASH_FAILURE:
            return {...state,  isLoadingTransactionDash: false, transactionDash:  { expense: "0,00", revenue: "0,00" }};
        default:
            return state;
    }
};

export default reducer;