import React from "react";

const LoginForm = () => {
    return (
        <div className="container-fluid vh-100 d-flex justify-content-center align-items-center bg-light">
            <div className="card shadow-lg" style={{ width: "450px" }}>
                <div className="card-body p-4">
                    <h4 className="text-center mb-1">Welcome To SkillNest Exam Portal</h4>
                    <p className="text-center text-muted mb-4">
                        Login to your account
                    </p>

                    <form>
                        <div className="mb-3">
                            <label className="form-label">Email</label>
                            <input
                                type="email"
                                className="form-control"
                                placeholder="Enter email"
                            />
                        </div>

                        <div className="mb-3">
                            <label className="form-label">Password</label>
                            <input
                                type="password"
                                className="form-control"
                                placeholder="Enter password"
                            />
                        </div>

                        <button type="submit" className="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                </div>
            </div>
        </div>
    );
};

export default LoginForm;
