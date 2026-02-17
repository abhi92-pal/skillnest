// import { combineReducers } from "redux";
import { combineReducers } from "@reduxjs/toolkit";
import authReducer from "./authReducer";
import instructorReducer from './instructorReducer';
import courseReducer from './courseReducer';

export default combineReducers({
    auth: authReducer,
    instructor: instructorReducer,
    course: courseReducer
});