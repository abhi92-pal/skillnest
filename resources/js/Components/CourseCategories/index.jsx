import React from "react";

const CourseCategories = () => {
	const categories = [
		{ title: "IT & Software", image: "images/work-1.jpg", count: "100 course" },
		{ title: "Music", image: "images/work-9.jpg", count: "100 course" },
		{ title: "Photography", image: "images/work-3.jpg", count: "100 course" },
		{ title: "Marketing", image: "images/work-5.jpg", count: "100 course" },
		{ title: "Health", image: "images/work-8.jpg", count: "100 course" },
		{ title: "Audio Video", image: "images/work-6.jpg", count: "100 course" },
	];

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
								style={{ backgroundImage: `url(${category.image})` }}
							>
								<div className="text w-100 text-center">
									<h3>{category.title}</h3>
									<span>{category.count}</span>
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
