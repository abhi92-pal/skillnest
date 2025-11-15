import React from 'react'

const HomeBanner = () => {
    const APP_NAME = import.meta.env.VITE_APP_NAME;
    return (
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
                    <div className="col-md-7 ftco-animate">
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
    )
}

export default HomeBanner
