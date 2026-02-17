import * as actionTypes from './actionTypes';
import * as Routes from '../../Routes/Routes';

export const fetchStart = () => {
    return {
        type: actionTypes.COURSE_CATEGORY_FETCHED_START
    }
}

export const fetchCategory = () => {
    return dispatch => {
        dispatch(fetchStart());

        axios.get(Routes.COURSE_CATEGORY_API)
            .then(response => {
                dispatch(fetchSuccess(response.data.data.categories));
            }).catch(error => {
                // console.log(error.response);
                dispatch(fetchFail(error.response.message));
            });
    }
}

export const fetchSuccess = (categories) => {
    return {
        type: actionTypes.COURSE_CATEGORY_FETCHED_SUCCESS,
        categories: categories
    }
}

export const fetchFail = (errorMessage) => {
     return {
        type: actionTypes.COURSE_CATEGORY_FETCHED_FAIL,
        errorMessage: errorMessage
     }
}