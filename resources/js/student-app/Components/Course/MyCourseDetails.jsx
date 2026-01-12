import React, { useEffect } from "react";
import * as Routes from '../../Routes/Routes';
import { useDispatch, useSelector } from 'react-redux';
import { fetchMyCourseDetails } from '../../store/actions/index';
import { Navigate, useParams } from "react-router-dom";
import SemesterAccordion from "../Semester/SemesterAccordion";

const MyCourseDetails = () => {
    const { courseId } = useParams();
    const dispatch = useDispatch();
    const { loading, course, semesters, statusCode, errorMessage } = useSelector(state => state.myCourseDetail)
    
    if(!courseId){
        return (<Navigate to="/404" replace />);
    }

    useEffect(() => {
        dispatch(fetchMyCourseDetails(courseId));
        // console.log(course);
        // console.log(semesters);
        
    }, [dispatch, courseId]);
        
    if (loading) {
        return (<div>Loading....</div>);
    }

    if(statusCode == 404){
        return (<Navigate to="/404" replace />);
    }

    

    return (
        <React.Fragment>
            <h2>{course.name}</h2>
            <SemesterAccordion semesters={semesters} />
        </React.Fragment>
    );

}

export default MyCourseDetails;