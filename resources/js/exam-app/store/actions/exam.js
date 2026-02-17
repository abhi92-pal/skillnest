import * as actionTypes from './actionTypes';
import axios from 'axios';

import * as Routes from '../../Routes/Routes';

export const fetchQuestionsStart = () => {
    return {
        type: actionTypes.FETCH_QUESTION_START
    };
};

export const fetchQuestionsSuccess = (data) => {
    return {
        type: actionTypes.FETCH_QUESTION_SUCCESS,
        resonseData: data
    };
};

export const fetchQuestionsFail = (errors, errorMessage) => {
    return {
        type: actionTypes.FETCH_QUESTION_FAIL,
        errors: errors,
        errorMessage: errorMessage
    };
};

export const fetchQuestions = (exampaperId) => {
    const token = localStorage.getItem('_token');
    const url = Routes.GET_QUESTIONS_API.replace('_examPaperId_', exampaperId);
    return dispatch => {
        dispatch(fetchQuestionsStart());
        axios.get(url, {
                headers: {
                        'Authorization': `bearer ${token}`
                    }
            })
            .then(response => {                
                // console.log(response.data.data);
                dispatch(fetchQuestionsSuccess(response.data))
            })
            .catch(error => {
                // console.log(error);
                const errResp = error.response.data;
                dispatch(fetchQuestionsFail(errResp.errors, errResp.message));
            });
    };
};
