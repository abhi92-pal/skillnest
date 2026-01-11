import React, { useEffect, useState } from "react";
import Course from '../Course/Course';
import axios from "axios";
import * as ApiRoutes from '../../Routes/Routes';
import Pagination from "../Pagination/Pagination";

const CourseList = ({ course }) => {

    const [courses, setCourses] = useState([]);
    const [loading, setLoading] = useState(true);
    const [paginationData, setPaginationData] = useState({});

    const fetchCourses = async (page = 1) => {
        try {
            const response = await axios.get(ApiRoutes.COURSES_API + `?page=${page}`);
            const apiResp = response.data.data.courses;
            // console.log(apiResp);
            const courseApiResp = apiResp.data;
            setCourses(courseApiResp);
            const {data, ...paginationWithoutData} = apiResp;
            // console.log(paginationWithoutData);
            
            setPaginationData(paginationWithoutData);

        } catch (error) {
            // console.error("Error fetching courses:", error);
        } finally {
            setLoading(false);
        }
    };
    const handlePageChange = (page) => {
        fetchCourses(page); // Fetch the data for the selected page
    };

    useEffect(() => {
        fetchCourses();
    }, [])

    if (loading) {
        return (<div>Loading....</div>);
    }

    return (
        <React.Fragment>
            <div className="row">
                {courses.map((course, index) => (
                    <div className="col-md-6 d-flex align-items-stretch " key={index}>
                        <Course course={course} detailsLinkStructure={ApiRoutes.COURSE_DETAILS_PAGE} />
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

export default CourseList;