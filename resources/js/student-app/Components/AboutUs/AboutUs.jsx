import React from 'react'

const AboutUs = () => {
    return (
        <React.Fragment>
            <section className="ftco-section ftco-about img">
                <div className="container">
                    <div className="row d-flex">
                        <div className="col-md-12 about-intro">
                            <div className="row">
                                <div className="col-md-6 d-flex">
                                    <div className="d-flex about-wrap">
                                        <div
                                            className="img d-flex align-items-center justify-content-center"
                                            style={{ backgroundImage: "url('images/about-1.jpg')" }}
                                        ></div>
                                        <div
                                            className="img-2 d-flex align-items-center justify-content-center"
                                            style={{ backgroundImage: "url('images/about.jpg')" }}
                                        ></div>
                                    </div>
                                </div>

                                <div className="col-md-6 pl-md-5 py-5">
                                    <div className="row justify-content-start pb-3">
                                        <div className="col-md-12 heading-section ftco-animate">
                                            <span className="subheading">Enhanced Your Skills</span>
                                            <h2 className="mb-4">Learn Anything You Want Today</h2>
                                            <p>
                                                Far far away, behind the word mountains, far from the countries Vokalia and
                                                Consonantia, there live the blind texts. Separated they live in Bookmarksgrove
                                                right at the coast of the Semantics, a large language ocean. A small river named
                                                Duden flows by their place and supplies it with the necessary regelialia.
                                            </p>
                                            <p>
                                                <a href="#" className="btn btn-primary">
                                                    Get in touch with us
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </React.Fragment>
    )
}

export default AboutUs;
