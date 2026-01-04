import * as actionTypes from '../actions/actionTypes';

const initialState =  {
    token: null,
    errors: [],
    errorMessage: null,
    successMessage: null,
    loading: false,
    redirectRoute: null,
    user: {
        id: null,
        name: null
    }
}

const authReducer = (state = initialState, action) => {
    switch (action.type){
        case actionTypes.AUTH_START:
            return {
                ...state,
                errors: [],
                errorMessage: null,
                successMessage: null,
                loading: true
            }
        case actionTypes.AUTH_SUCCESS:
            return {
                ...state,
                token: action.authData.data.token,
                errors: [],
                errorMessage: null,
                successMessage: action.authData.message,
                loading: false
            }
        case actionTypes.AUTH_FAIL:
            return {
                ...state,
                errors: action.errors ?? [],
                errorMessage: action.errorMessage,
                successMessage: null,
                loading: false
            }
        case actionTypes.AUTH_LOGOUT:
            return {
                ...state,
                token: null,
                redirectRoute: null
            }
        case actionTypes.AFTER_LOGIN_REDIRECT_TO:
            return {
                ...state,
                redirectRoute: action.redirect_path
            }
        case actionTypes.GET_AUTH_DETAILS:
            return {
                ...state,
                user: {
                    ...state.user,
                    id: action.userData.id,
                    name: action.userData.name
                }
            }
        case actionTypes.REGISTER_START:
            return {
                ...state,
                errors: [],
                errorMessage: null,
                successMessage: null,
                loading: true
            }
        case actionTypes.REGISTER_FAIL:
            return {
                ...state,
                errors: action.errors ?? [],
                errorMessage: action.errorMessage,
                successMessage: null,
                loading: false
            }
        default:
            return state;
    }
}

export default authReducer;