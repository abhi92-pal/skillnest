import * as actionTypes from '../actions/actionTypes';

const initialState = {
    loading: false,
    errormessage: null,
    courses: [],
    paginationData: {}
}

const courseReducer = (state = initialState, action) => {
    switch(action.type){
        case actionTypes.COURSE_FETCH_START:
            return {
                ...state,
                loading: true,
                errormessage: null
            }
        case actionTypes.COURSE_FETCH_SUCCESS:
            return {
                ...state,
                loading: false,
                courses: action.data,
                paginationData: action.paginationWithoutData
            }
        case actionTypes.COURSE_FETCH_FAIL:
            return {
                ...state,
                loading: false,
                errormessage: action.errorMessage
            }
        default:
            return state;
    }
}

export default courseReducer;