import React from 'react';
import { Link } from 'react-router-dom';

const CommonBanner = ({ title }) => {
    return (
        <React.Fragment>
            <section
                className="hero-wrap hero-wrap-2"
                style={{ backgroundImage: "url('images/bg_2.jpg')" }}
            >
                <div className="overlay"></div>
                <div className="container">
                    <div className="row no-gutters slider-text align-items-end justify-content-center">
                        <div className="col-md-9 ftco-animate pb-5 text-center">
                            <p className="breadcrumbs">
                                <span className="mr-2">
                                    <Link to="/">
                                        Home <i className="fa fa-chevron-right"></i>
                                    </Link>
                                </span>{" "}
                                <span>
                                    {title} <i className="fa fa-chevron-right"></i>
                                </span>
                            </p>
                            <h1 className="mb-0 bread">{title}</h1>
                        </div>
                    </div>
                </div>
            </section>
        </React.Fragment>
    )
}

export default CommonBanner
