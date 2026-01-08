import React, { useEffect, useState } from "react";
import CommonBanner from '../Banner/CommonBanner';
import Instructor from '../Instructor/Instructor';

import axios from "axios";
import * as ApiRoutes from '../../Routes/Routes';
import Pagination from "../Pagination/Pagination";


const CoursePage = () => {

    const [teachers, setTeachers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [paginationData, setPaginationData] = useState({});

    const fetchTeachers = async (page = 1) => {
        try {
            const response = await axios.get(ApiRoutes.TEACHERS_API + `?page=${page}`);
            const apiResp = response.data.data.teachers;
            const teacherApiResp = apiResp.data;
            // console.log(teacherApiResp);
            setTeachers(teacherApiResp);
            const {data, ...paginationWithoutData} = apiResp;
            // console.log(paginationWithoutData);
            
            setPaginationData(paginationWithoutData);

        } catch (error) {
           //
        } finally {
            setLoading(false);
        }
    };
    const handlePageChange = (page) => {
        fetchTeachers(page); // Fetch the data for the selected page
    };

    useEffect(() => {
        fetchTeachers();
    }, [])

    if (loading) {
        return (<div>Loading....</div>);
    }
    return (
        <React.Fragment>
            <CommonBanner title="Certified Instructor" />
            <section className="ftco-section bg-light">
                <div className="container">
                    <div className="row">
                        {teachers.map((teacher, index) => (
                            <div className="col-md-6 col-lg-3 d-flex align-items-stretch" key={index}>
                                <Instructor teacher={teacher} />
                            </div>
                        ))}
                    </div>
                    <div className="row mt-5">
                        <div className="col text-center">
                            <Pagination paginationData={paginationData} onPageChange={handlePageChange} />
                        </div>
                    </div>
                </div>
            </section>

        </React.Fragment>
    )
}

export default CoursePage;
