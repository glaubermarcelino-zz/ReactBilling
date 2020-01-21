import { Reducer } from "redux";
import { AccountTypes, AccountState } from './types';

const INITIAL_STATE: AccountState = {
    account: [],
    lastTransictions: [],
    isErrorRegister: "",
    isLoadingAccount: false,
    isLoadingRegister: false,
};

const reducer: Reducer<AccountState> = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        case AccountTypes.ACCOUNT_REGISTER:
            return { ...state, isLoadingRegister: true };
        case AccountTypes.ACCOUNT_REGISTER_FINALLY:
            return {...state, isLoadingRegister: false, isErrorRegister: action.payload.error};
        case AccountTypes.ACCOUNT_REQUEST:
            return { ...state, isLoadingAccount: true };
        case AccountTypes.ACCOUNT_SUCCESS:
            return { ...state, isLoadingAccount: false, account: action.payload.data };
        case AccountTypes.ACCOUNT_FAILURE:
            return { ...state, isLoadingAccount: false, account: []};
        default:
            return state;
    }
};

export default reducer;