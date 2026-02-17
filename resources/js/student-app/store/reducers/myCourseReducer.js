import * as actionTypes from '../actions/actionTypes';

const initialState = {
    errorMessage: null,
    courses: [],
    paginationData: {},
    loading: false,
}

const myCourseReducer = (state = initialState, action) => {
    switch (action.type){
        case actionTypes.MY_COURSES_FETCHED_START:
            return {
                ...state,
                errorMessage: null,
                loading: true
            }
        case actionTypes.MY_COURSES_FETCHED_SUCCESS:
            return {
                ...state,
                loading: false,
                courses: action.courses,
                paginationData: action.paginationData
            }
        case actionTypes.MY_COURSES_FETCHED_FAIL:
            return {
                ...state,
                loading: false,
                errorMessage: action.errorMessage
            }
        default:
            return state;
    }
}

export default myCourseReducer;