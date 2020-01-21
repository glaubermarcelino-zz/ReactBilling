import { Reducer } from "redux";
import { LoginState, LoginTypes } from './types';

const INITIAL_STATE: LoginState = {
    isError: false,
    isLoading: false,
    isErrorMessage: ""
};

const reducer: Reducer<LoginState> = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        case LoginTypes.LOGIN_RESET:
            return { ...state, ...INITIAL_STATE };
        case LoginTypes.LOGIN_REQUEST:
            return { ...state, isLoading: true };
        case LoginTypes.LOGIN_SUCCESS:
            return { ...state, isLoading: false, isError: false };
        case LoginTypes.LOGIN_FAILURE:
            return {...state, isLoading: false, isError: true, isErrorMessage: action.payload.message };
        default:
            return state;
    }
};

export default reducer;