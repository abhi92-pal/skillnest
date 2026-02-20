import { combineReducers } from "@reduxjs/toolkit";
import authReducer from "./authReducer";
import examReducer from "./examReducer";

export default combineReducers({
    auth: authReducer,
    exam: examReducer,
});