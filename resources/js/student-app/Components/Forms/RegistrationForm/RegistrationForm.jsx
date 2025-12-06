import React, {useState} from 'react';
import InputField from '../../FormEl/InputField';

const RegistrationForm = () => {
    const [formData, setFormData] = useState({
                                                name: "",
                                                email: "",
                                                password: "",
                                                confirmPassword: "",
                                            });

    const [errors, setErrors] = useState({});
    const [loading, setLoading] = useState(false);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const validate = () => {
        const newErrors = {};

        if (!formData.name.trim()) newErrors.name = "Name is required";
        if (!formData.email.trim()) newErrors.email = "Email is required";
        else if (!/\S+@\S+\.\S+/.test(formData.email)) newErrors.email = "Invalid email address";

        if (!formData.password) newErrors.password = "Password is required";
        else if (formData.password.length < 6) newErrors.password = "Must be at least 6 characters";

        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        if (!validate()) return;

        setLoading(true);
        try {
        console.log("Submitting data:", formData);
        await new Promise((r) => setTimeout(r, 1000)); // simulate API delay
        alert("Form submitted successfully!");
        setFormData({ name: "", email: "", password: "" });
        setErrors({});
        } finally {
        setLoading(false);
        }
    };

    return (
        <React.Fragment>
            <h3 className="mb-4">Register Now</h3>
            
            <form action="#" className="signup-form">
                <InputField 
                    label="Full Name"
                    name="name"
                    value={formData.name}
                    onChange={handleChange}
                    error={errors.name}
                    placeholder="Enter Your Name"
                />
                
                <InputField 
                    label="Email Address"
                    name="email"
                    value={formData.email}
                    onChange={handleChange}
                    error={errors.email}
                    placeholder="Enter Your Email"
                />
                
                <InputField 
                    type="password"
                    label="Password"
                    name="password"
                    value={formData.password}
                    onChange={handleChange}
                    error={errors.password}
                    placeholder="Enter Your Password"
                />

                <InputField 
                    type="password"
                    label="Confirm Password"
                    name="confirmPassword"
                    value={formData.confirmPassword}
                    onChange={handleChange}
                    error={errors.confirmPassword}
                    placeholder="Re-enter Your Password"
                />

                <div className="form-group d-flex justify-content-end mt-4">
                    <button type="submit" className="btn btn-primary submit">
                        <span className="fa fa-paper-plane"></span>
                    </button>
                </div>
            </form>
        </React.Fragment>
    )
}

export default RegistrationForm
