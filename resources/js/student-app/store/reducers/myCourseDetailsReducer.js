import * as actionTypes from '../actions/actionTypes';

const initialState = {
    errorMessage: null,
    course: {},
    semesters: [],
    loading: false,
    contentLoading: false,
    statusCode: null,
    streamUrl: null,
    lessonType: null
}

const myCourseDetailsReducer = (state = initialState, action) => {
    switch (action.type){
        case actionTypes.MY_COURSE_DETAILS_FETCHED_START:
            return {
                ...state,
                errorMessage: null,
                loading: true,
                statusCode: null,
                streamUrl: null,
                lessonType: null
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
        case actionTypes.MY_COURSE_LESSION_CONTENT_FETCH_START:
            return {
                ...state,
                contentLoading: true,
                errorMessage: null,
                statusCode: null,
                streamUrl: null,
                lessonType: null
            }
        case actionTypes.MY_COURSE_LESSION_CONTENT_FETCH_SUCCESS:
            return {
                ...state,
                contentLoading: false,
                statusCode: 200,
                streamUrl: action.streamUrl,
                lessonType: action.lessonType
            }
        case actionTypes.MY_COURSE_LESSION_CONTENT_FETCH_FAIL:
            return {
                ...state,
                contentLoading: false,
                errorMessage: action.errorMessage,
                statusCode: action.statusCode
            }
        case actionTypes.MY_COURSE_LESSION_STATUS_UPDATE:
            return {
                ...state,
                semesters: state.semesters.map(semester => ({
                    ...semester,
                    sem_topics: semester.sem_topics.map(topic => ({
                        ...topic,
                        lessions: topic.lessions.map(lesson => 
                            lesson.id == action.lessonId 
                            ? {
                                ...lesson,
                                progress_status: action.status
                            } 
                            : lesson
                        )
                    }))
                }))
            }
        default:
            return state;
    }
}

export default myCourseDetailsReducer;