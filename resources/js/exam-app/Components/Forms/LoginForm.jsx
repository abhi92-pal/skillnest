import React, { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Navigate } from "react-router-dom";
import InputField from '../FormEl/InputField';
import FullPageLoader from '../Utilities/FullPageLoader/FullPageLoader';
import { auth } from '../../store/actions/index';
import * as Routes from '../../Routes/Routes';

const LoginForm = () => {
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

    const handleChange = (e) => {
		const {name, value} = e.target;
		setFormData((prev) => ({...prev, [name]: value}));
	};

    const handleSubmit = async (e) => {
		e.preventDefault();
		
		if(token){
			return false;
		}
		dispatch(auth(formData));
	};

	let authRedirect = null;
	if(token){
		if(redirectRoute){
			authRedirect = <Navigate to={redirectRoute} replace />
		}else{
			authRedirect = <Navigate to={Routes.QUESTIONS_PAGE} replace />
		}
	}

    return (
        <div className="container-fluid vh-100 d-flex justify-content-center align-items-center bg-light">
            { authRedirect }
			{loading ? <FullPageLoader /> : ''}
            <div className="card shadow-lg" style={{ width: "450px" }}>
                <div className="card-body p-4">
                    <h4 className="text-center mb-1">Welcome To SkillNest Exam Portal</h4>
                    <p className="text-center text-muted mb-4">
                        Login to your account
                    </p>

                    <form action="#" onSubmit={handleSubmit}>
                        <div className="mb-3">
                            <InputField
                                label="Email Address"
                                name="email"
                                type="email"
                                value={formData.email}
                                onChange={handleChange}
                                error={errors.email}
                                placeholder="Enter Your Email"
                            />
                        </div>

                        <div className="mb-3">
                            <InputField
                                label="Password"
                                name="password"
                                type="password"
                                value={formData.password}
                                onChange={handleChange}
                                error={errors.password}
                                placeholder="Enter Your Password"
                            />
                        </div>

                        {(Object.keys(errors).length == 0 && errorMessage) ? <p className='text-danger'>{errorMessage}</p> : ''}

                        {
                            !token ? (
                                <button type="submit" className="btn btn-primary w-100">
                                    Login
                                </button>
                            ) : ( successMessage ? (<span className='text-success'>{ successMessage }</span>) : 'You are already logged in.' )
                        }
                    </form>

                </div>
            </div>
        </div>
    );
};

export default LoginForm;
