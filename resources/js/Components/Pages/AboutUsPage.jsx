import React from 'react'
import CommonBanner from '../Banner/CommonBanner';
import AboutUs from '../AboutUs/AboutUs';
import Counters from '../Counters/index';
import Testimonial from '../Testimonial/index';
import Enroll from '../Enroll/index';
import Services from '../AboutUs/Services';

const AboutUsPage = () => {
    return (
        <React.Fragment>
            <CommonBanner title="About Us" />
            <AboutUs />
            <Counters />
            <Testimonial />
            <Enroll />
            <Services />

        </React.Fragment>
    )
}

export default AboutUsPage;
