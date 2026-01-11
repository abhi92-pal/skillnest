import React, { useEffect, useState } from "react";
import Course from './Course';
import axios from "axios";
import * as ApiRoutes from '../../Routes/Routes';
import Pagination from "../Pagination/Pagination";
import { useDispatch, useSelector } from 'react-redux';
import { fetchMyCourses } from '../../store/actions/index';

const MyCourseList = ({ course }) => {
    const dispatch = useDispatch();
    const { loading, courses, paginationData } = useSelector(state => state.myCourse)

    const handlePageChange = (page) => {
        dispatch(fetchMyCourses(page));
    };

    useEffect(() => {
        if(courses.length == 0){
            dispatch(fetchMyCourses(1));
        }
    }, [])

    if (loading) {
        return (<div>Loading....</div>);
    }

    return (
        <React.Fragment>
            <div className="row">
                {courses.map((course, index) => (
                    <div className="col-md-4 d-flex align-items-stretch " key={index}>
                        <Course course={course} showPricing={false} />
                    </div>
                ))}
            </div>

            <div className="row mt-5">
                <div className="col">
                    <Pagination paginationData={paginationData} onPageChange={handlePageChange} />
                </div>
            </div>

        </React.Fragment>
    );

}

export default MyCourseList;