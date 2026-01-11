import * as actionTypes from './actionTypes';
import * as Routes from '../../Routes/Routes';

export const fetchStart = () => {
    return {
        type: actionTypes.MY_COURSES_FETCHED_START
    }
}

export const fetchMyCourses = (page) => {
    return dispatch => {
        dispatch(fetchStart());

        axios.get(Routes.MY_COURSES_API + `?page=${page}`)
            .then(response => {
                dispatch(fetchSuccess(response.data.data.courses));
            }).catch(error => {
                dispatch(fetchFail(error.response.message));
            });
    }
}

export const fetchSuccess = (apiResp) => {
    const courseApiResp = apiResp.data;
    const {data, ...paginationWithoutData} = apiResp;

    return {
        type: actionTypes.MY_COURSES_FETCHED_SUCCESS,
        courses: courseApiResp,
        paginationData: paginationWithoutData,
    }
}

export const fetchFail = (errorMessage) => {
     return {
        type: actionTypes.MY_COURSES_FETCHED_FAIL,
        errorMessage: errorMessage
     }
}