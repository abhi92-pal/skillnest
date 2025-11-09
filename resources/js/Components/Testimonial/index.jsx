import React from 'react'

const Testimonial = () => {
    return (
        <React.Fragment>
            <section className="ftco-section testimony-section bg-light">
                <div className="overlay" style={{ backgroundImage: "url('images/bg_2.jpg')" }}></div>

                <div className="container">
                    <div className="row pb-4">
                        <div className="col-md-7 heading-section ftco-animate">
                            <span className="subheading">Testimonial</span>
                            <h2 className="mb-4">What Are Students Says</h2>
                        </div>
                    </div>
                </div>

                <div className="container container-2">
                    <div className="row ftco-animate">
                        <div className="col-md-12">
                            <div className="carousel-testimony owl-carousel">
                                {[
                                    "person_1.jpg",
                                    "person_2.jpg",
                                    "person_3.jpg",
                                    "person_1.jpg",
                                    "person_2.jpg",
                                ].map((img, index) => (
                                    <div className="item" key={index}>
                                        <div className="testimony-wrap py-4">
                                            <div className="text">
                                                <p className="star">
                                                    {[...Array(5)].map((_, i) => (
                                                        <span key={i} className="fa fa-star"></span>
                                                    ))}
                                                </p>
                                                <p className="mb-4">
                                                    Far far away, behind the word mountains, far from the countries
                                                    Vokalia and Consonantia, there live the blind texts.
                                                </p>
                                                <div className="d-flex align-items-center">
                                                    <div
                                                        className="user-img"
                                                        style={{ backgroundImage: `url(images/${img})` }}
                                                    ></div>
                                                    <div className="pl-3">
                                                        <p className="name">Roger Scott</p>
                                                        <span className="position">Marketing Manager</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </React.Fragment>
    )
}

export default Testimonial;
