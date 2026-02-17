import React from "react";
import { Link } from "react-router-dom";

const Course = ({ course, showPricing = false, detailsLinkStructure }) => {
    const detailsLink = detailsLinkStructure.replace(':courseId', course.id);
    return (
        <React.Fragment>
            {/* {console.log(course)} */}
            <div className="project-wrap">
                <Link to={detailsLink} className="img" style={{ backgroundImage: `url(${course.file_path})` }}>
                    {/* <span className="price">{course.type}</span> */}
                </Link>
                <div className="text p-4">
                    <h3><a href="#">{course.name}</a></h3>
                    <p className="advisor">Duration <span>{course.duration} {course.duration_type}</span></p>
                    { showPricing 
                        ?
                        <ul className="d-flex justify-content-between">
                            <li><span className="flaticon-shower"></span>{course.price}</li>
                            <li className="price">{course.selling_price}</li>
                        </ul>
                        : ''}
                </div>
            </div>
        </React.Fragment>
    )

}

export default Course;