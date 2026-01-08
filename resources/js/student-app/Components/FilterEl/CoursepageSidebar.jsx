import React, { useEffect, useState } from "react";
import axios from "axios";
import * as ApiRoutes from '../../Routes/Routes';

const CoursepageSidebar = () => {

    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);
    const [filters, setFilters] = useState({
        category: "" // Default selected category
    });

    // Fetch categories from API only once
    useEffect(() => {
        const fetchCategories = async () => {
            try {
                const response = await axios.get(ApiRoutes.COURSE_CATEGORY_API);
                // console.log(response.data.data.categories)
                // Assuming the response structure is response.data.data.categories
                setCategories(response.data.data.categories);
            } catch (error) {
                console.error("Error fetching categories:", error);
                // Fallback to default categories if fetching fails
                setCategories([
                    "Design & Illustration",
                    "Web Development",
                    "Programming",
                    "Music & Entertainment",
                    "Photography",
                    "Health & Fitness"
                ]);
            } finally {
                setLoading(false);
            }
        };

        fetchCategories();
    }, []); // Empty dependency array means this effect only runs once, when the component mounts

    // Set the default selected category once categories are loaded
    useEffect(() => {
        if (categories.length > 0 && !filters.category) {
            setFilters({ category: categories[0] }); // Set default filter when categories are loaded
        }
    }, [categories, filters.category]); // This will run when categories are fetched

    if (loading) {
        return <div className="text-center py-5">Loading categories...</div>;
    }

    // Handle radio button change
    const handleChange = (group, value) => {
        setFilters((prev) => ({
            ...prev,
            [group]: value // Only one category can be selected
        }));
    };

    return (
        <React.Fragment>
            {/* Search Box */}
            <div className="sidebar-box bg-white">
                <form className="search-form">
                    <div className="form-group">
                        <span className="icon fa fa-search"></span>
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Search..."
                        />
                    </div>
                </form>
            </div>

            {/* Course Category Section */}
            <SidebarSection
                title="Course Category"
                group="category"
                items={categories}
                filters={filters}
                onChange={handleChange}
            />
        </React.Fragment>
    );
};

// -----------------------------------
// Reusable Sidebar Section Component for Radio Buttons
// -----------------------------------
const SidebarSection = ({ title, group, items, filters, onChange }) => {
    return (
        <div className="sidebar-box bg-white p-4">
            <h3 className="heading-sidebar">{title}</h3>

            {items.length > 0 ? (
                items.map((item, index) => {
                    // const id = `${group}-${index}`;
                    // {console.log(item)}
                    const checked = filters[group] === item.name;

                    return (
                        <label key={item.id} htmlFor={item.id} style={{ display: "block" }}>
                            <input
                                type="radio"
                                name={group} // All radio buttons in the same group
                                id={item.id}
                                checked={checked}
                                onChange={() => onChange(group, item.name)} // Only one category can be selected
                            />{" "}
                            {item.name}
                        </label>
                    );
                })
            ) : (
                <div>No categories available</div> // Handle case when there are no categories
            )}
        </div>
    );
};

export default CoursepageSidebar;
