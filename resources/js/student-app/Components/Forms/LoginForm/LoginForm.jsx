import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from "react-redux";
import { Navigate  } from 'react-router-dom';
import InputField from '../../FormEl/InputField';
import * as Routes from '../../../Routes/Routes';
import FullPageLoader from '../../UI/FullPageLoader/FullPageLoader';
import * as actionTypes from '../../../store/actions/actionTypes'
import { auth } from '../../../store/actions';

function LoginForm() {
	const dispatch = useDispatch();
    const { loading, errors, errorMessage, successMessage, token, redirectRoute } = useSelector((state) => state.auth);

	const initialFormData = {
                                email: "",
                                password: "",
                            };

	const [formData, setFormData] = useState(initialFormData);

	useEffect(() => {
		if(token){
			setFormData(initialFormData);
		}
	}, [token])

	// const [errors, setErrors] = useState({});
	// const [loading, setLoading] = useState(false);

	const handleChange = (e) => {
		const { name, value } = e.target;
		setFormData((prev) => ({ ...prev, [name]: value }));
	};

	// const validate = () => {
	// 	const newErrors = {};

	// 	if (!formData.email.trim()) newErrors.email = "Email is required";
	// 	else if (!/\S+@\S+\.\S+/.test(formData.email)) newErrors.email = "Invalid email address";

	// 	if (!formData.password) newErrors.password = "Password is required";

	// 	setErrors(newErrors);
	// 	return Object.keys(newErrors).length === 0;
	// };

	const handleSubmit = async (e) => {
		e.preventDefault();
		// if (!validate()) return;

		// setLoading(true);
		if(token){
			return false;
		}
		dispatch(auth(formData));

		// try {
		// 	const response = await axios.post(Routes.LOGIN_API, formData);
		// 	console.log("Login success:", response.data);
		// 	alert("Login successful!");
			
		// 	setFormData({ email: "", password: "" });
		// 	setErrors({});
		// } catch (err) {
		// 	let response = err.response?.data;

		// 	if (response?.errors) {
		// 		Object.entries(response.errors).map(([field, messages]) => {
		// 			setErrors(prev => ({
		// 				...prev,
		// 				[field]: messages[0]
		// 			}));
		// 		});
		// 	}
		// 	console.error("Login error:", err.response.data);

		// 	// Handle API errors
		// 	// if (err.response) {
		// 	// 	setApiError(err.response.data.message || "Login failed.");
		// 	// } else {
		// 	// 	setApiError("Network error. Please try again.");
		// 	// }
		// } finally {
		// 	setLoading(false);
		// }
	};

	let authRedirect = null;
	if(token){
		if(redirectRoute){
			authRedirect = <Navigate to={redirectRoute} replace />
		}else{
			authRedirect = <Navigate to='/' replace />
		}
	}

	return (
		<React.Fragment>
			{ authRedirect }
			{loading ? <FullPageLoader /> : ''}
			<h3 className="mb-4">Login</h3>

			<form action="#" className="signup-form" onSubmit={handleSubmit}>

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

				{(Object.keys(errors).length == 0 && errorMessage) ? <p className='text-danger'>{errorMessage}</p> : ''}

				{
					!token ? (
						<div className="form-group d-flex justify-content-end mt-4">
							<button type="submit" className="btn btn-primary submit">
								<span className="fa fa-paper-plane"></span>
							</button>
						</div>
					) : ( successMessage ? (<span className='text-success'>{ successMessage }</span>) : 'You are already logged in.' )
				}
				
			</form>
		</React.Fragment>
	)
}

export default LoginForm;
