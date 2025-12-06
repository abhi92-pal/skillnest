import React, { useEffect, useState, useRef } from "react";
import axios from "axios";
import * as ApiRoutes from '../../Routes/Routes';

const CourseCategories = () => {
	
	const [categories, setCategories] = useState([]);
	const [loading, setLoading] = useState(true);
	// const fetchedRef = useRef(false);

	useEffect(() => {
		// if (fetchedRef.current) return; 
        // fetchedRef.current = true;

		const fetchCategories = async () => {
			try {
				const response = await axios.get(ApiRoutes.COURSE_CATEGORY_API);
				
				setCategories(response.data.data.categories);
			} catch (error) {
				console.error("Error fetching categories:", error);
			} finally {
				setLoading(false);
			}
		};

		fetchCategories();
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
