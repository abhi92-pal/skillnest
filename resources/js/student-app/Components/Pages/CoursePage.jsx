import React, { useEffect, useState } from 'react'
import CommonBanner from '../Banner/CommonBanner';
import Sidebar from '../FilterEl/CoursepageSidebar';
import CourseList from '../Course/CourseList';


const CoursePage = () => {
    
    return (
        <React.Fragment>
            <CommonBanner title="Course Lists" />
            <section className="ftco-section bg-light">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-3 sidebar">
                            <Sidebar />
                        </div>
                        <div className="col-lg-9">
                            <CourseList/>
                        </div>
                    </div>
                </div>
            </section>

        </React.Fragment>
    )
}

export default CoursePage;
