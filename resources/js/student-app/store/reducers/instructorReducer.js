import * as actionTypes from '../actions/actionTypes';

const initialState = {
    loading: false,
    errormessage: null,
    teachers: [],
    paginationData: {}
}

const instructorReducer = (state = initialState, action) => {
    switch(action.type){
        case actionTypes.INSTRUCTOR_FETCH_START:
            return {
                ...state,
                loading: true,
                errormessage: null
            }
        case actionTypes.INSTRUCTOR_FETCH_SUCCESS:
            return {
                ...state,
                loading: false,
                teachers: action.data,
                paginationData: action.paginationWithoutData
            }
        case actionTypes.INSTRUCTOR_FETCH_FAIL:
            return {
                ...state,
                loading: false,
                errormessage: action.errorMessage
            }
        default:
            return state;
    }
}

export default instructorReducer;