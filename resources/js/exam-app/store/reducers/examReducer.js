import * as actionTypes from '../actions/actionTypes';

const initialState =  {
    errors: [],
    errorMessage: null,
    successMessage: null,
    loading: false,
    data: []
}

const examReducer = (state = initialState, action) => {
    switch(action.type){
        case actionTypes.FETCH_QUESTION_START:
            return {
                ...state,
                loading: true,
                errors: [],
                errorMessage: null
            }
        case actionTypes.FETCH_QUESTION_SUCCESS:
            return {
                ...state,
                loading: false,
                data: action.resonseData.data,
                successMessage: action.resonseData.message,
            }
        case actionTypes.FETCH_QUESTION_FAIL:
            return {
                ...state,
                loading: false,
                errors: action.errors,
                errorMessage: action.errorMessage,
            }
        default:
            return state;
    }
}

export default examReducer;