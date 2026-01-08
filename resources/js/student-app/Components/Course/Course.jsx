import React, { useEffect, useState, useRef } from "react";

const Course = ({course}) => {
    
    return (
        <React.Fragment>
            {/* {console.log(course)} */}
            <div className="project-wrap">
                <a href="#" className="img" style={{ backgroundImage: `url(${course.file_path})` }}>
                    {/* <span className="price">{course.type}</span> */}
                </a>
                <div className="text p-4">
                    <h3><a href="#">{course.name}</a></h3>
                    <p className="advisor">Duration <span>{course.duration} {course.duration_type}</span></p>
                    <ul className="d-flex justify-content-between">
                        <li><span className="flaticon-shower"></span>{course.price}</li>
                        <li className="price">{course.selling_price}</li>
                    </ul>
                </div>
            </div>
        </React.Fragment>
    )

}

export default Course;