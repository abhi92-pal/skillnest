import React from 'react'
import CommonBanner from '../Banner/CommonBanner';
import CourseDetails from '../Course/CourseDetails';
import { useSelector } from 'react-redux';

const CourseDetailPage = () => {
    const { loading, course } = useSelector(state => state.courseDetail);

    return (
        <React.Fragment>
            <CommonBanner title="Courses" subTitle={loading ? '' : course?.name} />
            <section className="ftco-section bg-light">
                <div className="container">
                    <CourseDetails />
                </div>
            </section>
        </React.Fragment>
    )
}

export default CourseDetailPage;
