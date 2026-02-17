import * as actionTypes from './actionTypes';
import axios from 'axios';
import * as ApiRoutes from '../../Routes/Routes';

export const fetchStart = () => {
    return {
        type: actionTypes.INSTRUCTOR_FETCH_START
    }
}

export const instructorListFetch = (page) => {
    return dispatch => {
        dispatch(fetchStart());
        axios.get(ApiRoutes.TEACHERS_API + `?page=${page}`)
                .then(response => {
                    // console.log(response);
                    
                    dispatch(fetchSuccess(response.data.data.teachers))
                })
                .catch(error => {
                    // console.log(error);
                    const errResp = error.response.data;
                    dispatch(fetchFail(errResp.message));
                });
    }
}

export const fetchSuccess = (respData) => {
    const teacherApiResp = respData.data;
    const {data, ...paginationWithoutData} = respData;

    return {
        type: actionTypes.INSTRUCTOR_FETCH_SUCCESS,
        data: teacherApiResp,
        paginationWithoutData: paginationWithoutData
    }
}

export const fetchFail = (errorMsg) => {
    return {
        type: actionTypes.INSTRUCTOR_FETCH_FAIL,
        errorMessage: errorMsg
    }
}