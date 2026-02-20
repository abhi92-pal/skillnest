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

export const fetchCourseDetailsStart = () => {
    return {
        type: actionTypes.COURSE_DETAILS_FETCHED_START
    }
}

export const fetchCourseDetails = (courseId) => {
    return dispatch => {
        const fetchCourseApi = ApiRoutes.COURSE_DETAILS_API.replace('_courseId_', courseId)
        dispatch(fetchCourseDetailsStart());
        const token = localStorage.getItem('_token');
        axios.get(fetchCourseApi, 
                    {
                        headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "application/json",
                        },
                    }
                ).then(response => {
                    
                    dispatch(fetchCourseDetailsSuccess(response.data.data.course, response.data.data.semesters))
                }).catch(error => {
                    console.log(error);
                    dispatch(fetchCourseDetailsFail(error.message, error.response.status))
                })
    }
}

export const fetchCourseDetailsSuccess = (course, semesters) => {
    return {
        type: actionTypes.COURSE_DETAILS_FETCHED_SUCCESS,
        course: course,
        semesters: semesters,
    }
}

export const fetchCourseDetailsFail = (errorMessage, statusCode) => {
    return {
        type: actionTypes.COURSE_DETAILS_FETCHED_FAIL,
        errorMessage: errorMessage,
        statusCode: statusCode
    }
}