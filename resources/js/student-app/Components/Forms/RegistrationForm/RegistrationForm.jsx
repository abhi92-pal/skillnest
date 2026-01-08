import React, {useEffect, useState} from 'react';
import InputField from '../../FormEl/InputField';
import { useDispatch, useSelector } from 'react-redux';
import { register } from '../../../store/actions';
import FullPageLoader from '../../UI/FullPageLoader/FullPageLoader';

const RegistrationForm = () => {
    const { loading, errors, errorMessage, token, successMessage } = useSelector((state) => state.auth);
    const dispatch = useDispatch();

    const initialFormData = {
                                name: "",
                                phone: "",
                                email: "",
                                password: "",
                                password_confirmation: "",
                            };

    const [formData, setFormData] = useState(initialFormData);

    useEffect(() => {
        if(token){
            setFormData(initialFormData);
        }
    }, [token]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };


    const handleSubmit = async (e) => {
        e.preventDefault();
        dispatch(register(formData));
    };

    return (
        <React.Fragment>
            { loading ? <FullPageLoader /> : ''}
            <h3 className="mb-4">Register Now</h3>
            
            <form action="#" className="signup-form" onSubmit={handleSubmit}>
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
                    label="Phone"
                    name="phone"
                    value={formData.phone}
                    onChange={handleChange}
                    error={errors.phone}
                    placeholder="Enter Your Phone"
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
                    name="password_confirmation"
                    value={formData.password_confirmation}
                    onChange={handleChange}
                    error={errors.password_confirmation}
                    placeholder="Re-enter Your Password"
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

export default RegistrationForm
