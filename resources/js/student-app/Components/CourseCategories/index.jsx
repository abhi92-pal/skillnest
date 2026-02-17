import React, { useEffect, useState, useRef } from "react";
import axios from "axios";
import * as ApiRoutes from '../../Routes/Routes';
import { useDispatch, useSelector } from "react-redux";
import { fetchCategory } from '../../store/actions/index';

const CourseCategories = () => {
	const { categories, loading } = useSelector(state => state.courseCategory)
	const dispatch = useDispatch();
	useEffect(() => {
		if(categories.length == 0){
			dispatch(fetchCategory());
		}
	}, []);

	if (loading) {
		return <div className="text-center py-5">Loading categories...</div>;
	}

	return (
		<section className="ftco-section">
			<div className="container">
				<div className="row justify-content-center pb-4">
					<div className="col-md-12 heading-section text-center ftco-animate">
						<span className="subheading">Start Learning Today</span>
						<h2 className="mb-4">Browse Online Course Category</h2>
					</div>
				</div>

				<div className="row justify-content-center">
					{categories.map((category, index) => (
						<div key={index} className="col-md-3 col-lg-2">
							<a
								href="#"
								className="course-category img d-flex align-items-center justify-content-center"
								style={{ backgroundImage: `url(${category.file})` }}
							>
								<div className="text w-100 text-center">
									<h3>{category.name}</h3>
									<span>{category.course_count} Course</span>
								</div>
							</a>
						</div>
					))}

					<div className="col-md-12 text-center mt-5">
						<a href="#" className="btn btn-secondary">
							See All Courses
						</a>
					</div>
				</div>
			</div>
		</section>
	);
};

export default CourseCategories;
