import React from 'react'
import CommonBanner from '../Banner/CommonBanner';
import MyCourseList from '../Course/MyCourseList';

const MyCoursePage = () => {
    return (
        <React.Fragment>
            <CommonBanner title="My Courses" />
            <section className="ftco-section bg-light">
                <div className="container-fluid">
                    <MyCourseList/>
                </div>
            </section>
        </React.Fragment>
    )
}

export default MyCoursePage;
