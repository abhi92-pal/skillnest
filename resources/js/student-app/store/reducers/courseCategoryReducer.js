import * as actionTypes from '../actions/actionTypes';

const initialState = {
    errorMessage: null,
    categories: [],
    loading: false,
}

const courseCategoryReducer = (state = initialState, action) => {
    switch (action.type){
        case actionTypes.COURSE_CATEGORY_FETCHED_START:
            return {
                ...state,
                errorMessage: null,
                loading: true
            }
        case actionTypes.COURSE_CATEGORY_FETCHED_SUCCESS:
            return {
                ...state,
                loading: false,
                categories: action.categories
            }
        case actionTypes.COURSE_CATEGORY_FETCHED_FAIL:
            return {
                ...state,
                loading: false,
                errorMessage: action.errorMessage
            }
        default:
            return state;
    }
}

export default courseCategoryReducer;