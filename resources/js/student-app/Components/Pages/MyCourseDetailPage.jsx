import React from 'react'
import CommonBanner from '../Banner/CommonBanner';
import MyCourseDetails from '../Course/MyCourseDetails';

const MyCourseDetailPage = () => {
    return (
        <React.Fragment>
            <CommonBanner title="My Courses" />
            <section className="ftco-section bg-light">
                <div className="container">
                    <MyCourseDetails />
                </div>
            </section>
        </React.Fragment>
    )
}

export default MyCourseDetailPage;
