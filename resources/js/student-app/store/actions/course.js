import * as actionTypes from './actionTypes';
import axios from 'axios';
import * as ApiRoutes from '../../Routes/Routes';

export const fetchStart = () => {
    return {
        type: actionTypes.COURSE_FETCH_START
    }
}

export const courseListFetch = (page) => {
    return dispatch => {
        dispatch(fetchStart());
        axios.get(ApiRoutes.COURSES_API + `?page=${page}`)
                .then(response => {
                    // console.log(response);
                    
                    dispatch(fetchSuccess(response.data.data.courses))
                })
                .catch(error => {
                    // console.log(error);
                    const errResp = error.response.data;
                    dispatch(fetchFail(errResp.message));
                });
    }
}

export const fetchSuccess = (respData) => {
    const courseApiResp = respData.data;
    const {data, ...paginationWithoutData} = respData;

    return {
        type: actionTypes.COURSE_FETCH_SUCCESS,
        data: courseApiResp,
        paginationWithoutData: paginationWithoutData
    }
}

export const fetchFail = (errorMsg) => {
    return {
        type: actionTypes.COURSE_FETCH_FAIL,
        errorMessage: errorMsg
    }
}