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

export const fetchMyCourseDetailsStart = () => {
    return {
        type: actionTypes.MY_COURSE_DETAILS_FETCHED_START
    }
}

export const fetchMyCourseDetails = (courseId) => {
    return dispatch => {
        const fetchCourseApi = Routes.MY_COURSE_DETAILS_API.replace('_courseId_', courseId)
        dispatch(fetchMyCourseDetailsStart())
        axios.get(fetchCourseApi)
                .then(response => {
                    dispatch(fetchMyCourseDetailsSuccess(response.data.course, response.data.semesters))
                }).catch(error => {
                    console.log(error);
                    dispatch(fetchMyCourseDetailsFail(error.message, error.response.status))
                })
    }
}

export const fetchMyCourseDetailsSuccess = (course, semesters) => {
    return {
        type: actionTypes.MY_COURSE_DETAILS_FETCHED_SUCCESS,
        course: course,
        semesters: semesters,
    }
}

export const fetchMyCourseDetailsFail = (errorMessage, statusCode) => {
    return {
        type: actionTypes.MY_COURSE_DETAILS_FETCHED_FAIL,
        errorMessage: errorMessage,
        statusCode: statusCode
    }
}