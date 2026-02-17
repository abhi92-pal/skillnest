import React, { useState } from 'react'
import HomeBanner from '../Banner/HomeBanner';
import CourseCategories from '../CourseCategories/index';
import Counters from '../Counters/index';
import AboutUs from '../AboutUs/AboutUs';
import Services from '../AboutUs/Services';
import Testimonial from '../Testimonial/index';
import Enroll from '../Enroll/index';
import RegistrationForm from '../Forms/RegistrationForm/RegistrationForm';
import LoginForm from '../Forms/LoginForm/LoginForm';

const Welcome = () => {
    const [showLoginForm, setShowLoginForm] = useState(false);

    return (
        <React.Fragment>
            <HomeBanner />
            <section className="ftco-section ftco-no-pb ftco-no-pt">
                <div className="container">
                    <div className="row">
                        <div className="col-md-7"></div>
                        <div className="col-md-5 order-md-last">
                            <div className="login-wrap p-4 p-md-5">


                                {showLoginForm ? <LoginForm /> : <RegistrationForm />}


                                <p className="text-center">
                                    
                                    
                                    {showLoginForm ? (
                                        <>
                                            Don't have an account?{" "}
                                            <a href="#" onClick={() => setShowLoginForm(false)}>
                                                Register
                                            </a>
                                        </>
                                    ) : (
                                        <>
                                            Already have an account?{" "}
                                            <a href="#" onClick={() => setShowLoginForm(true)}>
                                                Sign In
                                            </a>
                                        </>
                                    )}
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
