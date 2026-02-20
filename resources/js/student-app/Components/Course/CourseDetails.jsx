import React, { useEffect } from "react";
import * as Routes from '../../Routes/Routes';
import { useDispatch, useSelector } from 'react-redux';
import { fetchCourseDetails, afterLoginRedirectTo } from '../../store/actions/index';
import { Navigate, useParams, useNavigate } from "react-router-dom";
import SemesterAccordion from "../Semester/SemesterAccordion";

const CourseDetails = () => {
    const { courseId } = useParams();
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { loading, course, semesters, statusCode, errorMessage } = useSelector(state => state.courseDetail);
    const { token } = useSelector(state => state.auth);
    
    if(!courseId){
        return (<Navigate to="/404" replace />);
    }

    useEffect(() => {
        dispatch(fetchCourseDetails(courseId));
        // console.log(course);
        // console.log(semesters);
        
    }, [dispatch, courseId]);

    const handleBuyNow = async () => {
        if(!token){
            alert('Please register yourself first.');
            let intendedUrl = Routes.COURSE_DETAILS_PAGE;
                intendedUrl = intendedUrl.replace(':courseId', courseId)
            dispatch(afterLoginRedirectTo(intendedUrl));
            navigate(Routes.WELCOME_PAGE, { replace: true });
            return;
        }
        const confirmed = window.confirm("Are you sure you want to purchase this course?");
        
        if (!confirmed) return;

        try {
            const response = await axios.post(Routes.COURSE_ORDER_STORE_API, {
                                                courseId: course.id
                                            }, {
                                                headers: {
                                                Authorization: `Bearer ${token}`,
                                                "Content-Type": "application/json",
                                            },
                                        });

            alert("Course purchased successfully!");
            console.log(response.data);

        } catch (error) {
            console.error(error);
            alert("Something went wrong while purchasing.");
        }
    };
        
    if (loading) {
        return (<div>Loading....</div>);
    }

    if(statusCode == 404){
        return (<Navigate to="/404" replace />);
    }

    

    return (
        <React.Fragment>
            <div className="d-flex justify-content-between">
                <h2>{course.name}</h2>
                <div className="mt-2">
                    <button onClick={handleBuyNow} className="btn btn-primary"> Buy Now </button></div>
            </div>
            <SemesterAccordion semesters={semesters} doNotStream={true} />
        </React.Fragment>
    );

}

export default CourseDetails;