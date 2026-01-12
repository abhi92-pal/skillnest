import React from 'react'
import CommonBanner from '../Banner/CommonBanner';
import MyCourseDetails from '../Course/MyCourseDetails';
import { useSelector } from 'react-redux';

const MyCourseDetailPage = () => {
    const { loading, course } = useSelector(state => state.myCourseDetail);

    return (
        <React.Fragment>
            <CommonBanner title="My Courses" subTitle={loading ? '' : course?.name} />
            <section className="ftco-section bg-light">
                <div className="container">
                    <MyCourseDetails />
                </div>
            </section>
        </React.Fragment>
    )
}

export default MyCourseDetailPage;
