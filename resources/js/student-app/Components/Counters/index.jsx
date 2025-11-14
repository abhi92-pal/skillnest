import React, { useEffect } from 'react'
import { useLocation } from 'react-router-dom';

const Counters = () => {
    const JQueryInitializer = () => {
        const location = useLocation();

        useEffect(() => {
            if (window.$) {
                var counter = function () {
                    $('.ftco-counter').waypoint(
                        function (direction) {
                        if (
                            direction === 'down' &&
                            !$(this.element).hasClass('ftco-animated')
                        ) {
                            var comma_separator_number_step =
                            $.animateNumber.numberStepFactories.separator(',');
                            $('.number').each(function () {
                            var $this = $(this),
                                num = $this.data('number');
                            $this.animateNumber(
                                {
                                number: num,
                                numberStep: comma_separator_number_step
                                },
                                7000
                            );
                            });
                        }
                        },
                        { offset: '95%' }
                    );
                };
                counter();
            }
        }, [location.pathname]); // Runs every time the route changes

        return null;
    };

    return (
        <React.Fragment>
            <JQueryInitializer />
            <section
                className="ftco-section ftco-counter img"
                id="section-counter"
                style={{ backgroundImage: "url('images/bg_4.jpg')" }}
            >
                <div className="overlay"></div>
                <div className="container">
                    <div className="row">
                        <div className="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div className="block-18 d-flex align-items-center">
                                <div className="icon">
                                    <span className="flaticon-online"></span>
                                </div>
                                <div className="text">
                                    <strong className="number" data-number="400">
                                        0
                                    </strong>
                                    <span>Online Courses</span>
                                </div>
                            </div>
                        </div>

                        <div className="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div className="block-18 d-flex align-items-center">
                                <div className="icon">
                                    <span className="flaticon-graduated"></span>
                                </div>
                                <div className="text">
                                    <strong className="number" data-number="4500">
                                        0
                                    </strong>
                                    <span>Students Enrolled</span>
                                </div>
                            </div>
                        </div>

                        <div className="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div className="block-18 d-flex align-items-center">
                                <div className="icon">
                                    <span className="flaticon-instructor"></span>
                                </div>
                                <div className="text">
                                    <strong className="number" data-number="1200">
                                        0
                                    </strong>
                                    <span>Experts Instructors</span>
                                </div>
                            </div>
                        </div>

                        <div className="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div className="block-18 d-flex align-items-center">
                                <div className="icon">
                                    <span className="flaticon-tools"></span>
                                </div>
                                <div className="text">
                                    <strong className="number" data-number="300">
                                        0
                                    </strong>
                                    <span>Hours Content</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </React.Fragment>
    )
}

export default Counters;
