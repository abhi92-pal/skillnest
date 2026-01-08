import React, { useEffect, useState, useRef } from "react";

const Instructor = ({teacher}) => {
    // console.log(teacher);
    return (
        <React.Fragment>
            <div className="staff">
                <div className="img-wrap d-flex align-items-stretch">
                    <div className="img align-self-stretch" style={{ backgroundImage: `url(${teacher.profile_pic})` }}></div>
                </div>
                <div className="text pt-3">
                    <h3>{teacher.name}</h3>
                    <span className="position mb-2">{teacher.teacher.designation}</span>
                    <div className="faded">
                        <p>{teacher.teacher.about}</p>
                        {/* <ul className="ftco-social text-center">
                            <li className="ftco-animate"><a href="#"><span className="fa fa-twitter"></span></a></li>
                            <li className="ftco-animate"><a href="#"><span className="fa fa-facebook"></span></a></li>
                            <li className="ftco-animate"><a href="#"><span className="fa fa-google"></span></a></li>
                            <li className="ftco-animate"><a href="#"><span className="fa fa-instagram"></span></a></li>
                        </ul> */}
                    </div>
                </div>
            </div>
        </React.Fragment>
    )

}

export default Instructor;