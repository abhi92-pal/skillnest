import React from 'react'
import HomeBanner from '../Banner/HomeBanner';
import CourseCategories from '../CourseCategories/index';
import Counters from '../Counters/index';
import AboutUs from '../AboutUs/AboutUs';
import Services from '../AboutUs/Services';
import Testimonial from '../Testimonial/index';
import Enroll from '../Enroll/index';

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

                                <form action="#" className="signup-form">
                                    <div className="form-group">
                                        <label className="label" htmlFor="name">Full Name</label>
                                        <input type="text" className="form-control" placeholder="John Doe" />
                                    </div>

                                    <div className="form-group">
                                        <label className="label" htmlFor="email">Email Address</label>
                                        <input type="text" className="form-control" placeholder="johndoe@gmail.com" />
                                    </div>

                                    <div className="form-group">
                                        <label className="label" htmlFor="password">Password</label>
                                        <input id="password-field" type="password" className="form-control" placeholder="Password" />
                                    </div>

                                    <div className="form-group">
                                        <label className="label" htmlFor="confirm-password">Confirm Password</label>
                                        <input id="confirm-password" type="password" className="form-control" placeholder="Confirm Password" />
                                    </div>

                                    <div className="form-group d-flex justify-content-end mt-4">
                                        <button type="submit" className="btn btn-primary submit">
                                            <span className="fa fa-paper-plane"></span>
                                        </button>
                                    </div>
                                </form>

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
