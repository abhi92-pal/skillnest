// import { combineReducers } from "redux";
import { combineReducers } from "@reduxjs/toolkit";
import authReducer from "./authReducer";
import instructorReducer from './instructorReducer';
import courseReducer from './courseReducer';
import courseCategoryReducer from './courseCategoryReducer';
import myCourseReducer from './myCourseReducer';
import myCourseDetailsReducer from './myCourseDetailsReducer';

export default combineReducers({
    auth: authReducer,
    courseCategory: courseCategoryReducer,
    instructor: instructorReducer,
    course: courseReducer,
    myCourse: myCourseReducer,
    myCourseDetail: myCourseDetailsReducer,
});