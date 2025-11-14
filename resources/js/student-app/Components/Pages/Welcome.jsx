import React from 'react'
import HomeBanner from '../Banner/HomeBanner';
import CourseCategories from '../CourseCategories/index';
import Counters from '../Counters/index';
import AboutUs from '../AboutUs/AboutUs';
import Services from '../AboutUs/Services';
import Testimonial from '../Testimonial/index';
import Enroll from '../Enroll/index';
import RegistrationForm from '../Forms/RegistrationForm/RegistrationForm';

const Welcome = () => {
    return (
        <React.Fragment>
            <HomeBanner />
            <section className="ftco-section ftco-no-pb ftco-no-pt">
                <div className="container">
                    <div className="row">
                        <div className="col-md-7"></div>
                        <div className="col-md-5 order-md-last">
                            <div className="login-wrap p-4 p-md-5">
                                <h3 className="mb-4">Register Now</h3>

                                <RegistrationForm />

                                <p className="text-center">
                                    Already have an account? <a href="#signin">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <CourseCategories />
            <Counters />
            <AboutUs />
            <Testimonial />
            <Enroll />
            <Services />

        </React.Fragment>
    )
}

export default Welcome;
