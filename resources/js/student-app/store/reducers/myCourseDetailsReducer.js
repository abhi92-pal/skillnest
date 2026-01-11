import * as actionTypes from '../actions/actionTypes';

const initialState = {
    errorMessage: null,
    course: {},
    semesters: [],
    loading: false,
    statusCode: null
}

const myCourseDetailsReducer = (state = initialState, action) => {
    switch (action.type){
        case actionTypes.MY_COURSE_DETAILS_FETCHED_START:
            return {
                ...state,
                errorMessage: null,
                loading: true,
                statusCode: null
            }
        case actionTypes.MY_COURSE_DETAILS_FETCHED_SUCCESS:
            return {
                ...state,
                loading: false,
                course: action.course,
                semesters: action.semesters,
                statusCode: 200
            }
        case actionTypes.MY_COURSE_DETAILS_FETCHED_FAIL:
            return {
                ...state,
                loading: false,
                errorMessage: action.errorMessage,
                statusCode: action.statusCode
            }
        default:
            return state;
    }
}

export default myCourseDetailsReducer;