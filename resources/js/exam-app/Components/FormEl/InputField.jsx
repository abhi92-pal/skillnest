import React from 'react'

const InputField = ({ label, name, type = "text", value, onChange, error, placeholder }) => {
    return (
        <React.Fragment>
            <div className="form-group">
                <label htmlFor={name} className="label">{label}</label>
                <input
                    id={name}
                    name={name}
                    type={type}
                    value={value}
                    onChange={onChange}
                    placeholder={placeholder}
                    className={`form-control ${error ? "border-danger" : ""}`}
                />
                {error && <p className="text-danger text-sm">{error}</p>}
            </div>
        </React.Fragment>
    )
}

export default InputField;
