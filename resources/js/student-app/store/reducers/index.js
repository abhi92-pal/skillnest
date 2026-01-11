// import { combineReducers } from "redux";
import { combineReducers } from "@reduxjs/toolkit";
import authReducer from "./authReducer";
import courseCategoryReducer from './courseCategoryReducer';
import myCourseReducer from './myCourseReducer';

export default combineReducers({
    auth: authReducer,
    courseCategory: courseCategoryReducer,
    myCourse: myCourseReducer,
});