import React from 'react'

const Welcome = () => {
    const APP_NAME = import.meta.env.VITE_APP_NAME;
    return (
        <React.Fragment>
            <div
                className="hero-wrap js-fullheight"
                style={{ backgroundImage: "url('images/bg_1.jpg')" }}
            >
                <div className="overlay"></div>
                <div className="container">
                    <div
                        className="row no-gutters slider-text js-fullheight align-items-center"
                        data-scrollax-parent="true"
                    >
                        <div className="col-md-7 ftco-animate1">
                            <span className="subheading">Welcome to {APP_NAME}</span>
                            <h1 className="mb-4">We Are Online Platform For Make Learn</h1>
                            <p className="caps">
                                Far far away, behind the word mountains, far from the countries Vokalia and Consonantia
                            </p>
                            <p className="mb-0">
                                <a href="#" className="btn btn-primary">Our Course</a>
                                {' '}
                                <a href="#" className="btn btn-white">Learn More</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

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
        </React.Fragment>
    )
}

export default Welcome;
