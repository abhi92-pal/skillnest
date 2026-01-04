import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { Link, useLocation } from 'react-router-dom';
import { logout } from '../../../store/actions';
import * as Routes from '../../../Routes/Routes';


export default function index() {
    const dispatch = useDispatch();
    const { token } = useSelector((state) => state.auth);
    const APP_NAME = import.meta.env.VITE_APP_NAME;
    const location = useLocation();
    const isActive = (path) => location.pathname === path ? 'nav-item active' : 'nav-item';

    const logoutHandler = () => {
        dispatch(logout());
    }

    return (
        <React.Fragment>
            <nav className="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
                <div className="container">
                    <Link to={Routes.WELCOME_PAGE} className="navbar-brand" >{APP_NAME}</Link>
                    <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="oi oi-menu"></span> Menu
                    </button>

                    <div className="collapse navbar-collapse" id="ftco-nav">
                        <ul className="navbar-nav ml-auto">
                            <li className={isActive(Routes.WELCOME_PAGE)}><Link to={Routes.WELCOME_PAGE} className="nav-link">Home</Link></li>
                            <li className={isActive(Routes.ABOUT_US_PAGE)}><Link to={Routes.ABOUT_US_PAGE} className="nav-link">About</Link></li>
                            <li className={isActive(Routes.COURSES_PAGE)}><Link to={Routes.COURSES_PAGE} className="nav-link">Course</Link></li>
                            <li className="nav-item"><a href="instructor.html" className="nav-link">Instructor</a></li>
                            <li className="nav-item"><a href="contact.html" className="nav-link">Contact</a></li>
                            {token && (
                                <li className="nav-item dropdown">
                                    <span
                                        className="nav-link dropdown-toggle"
                                        id="userDropdown"
                                        role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        style={{ cursor: 'pointer' }}
                                    >
                                        Account
                                    </span>
                                    <div
                                        className="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="userDropdown"
                                    >
                                        <Link className="dropdown-item" to="/menu2">
                                            Menu 2
                                        </Link>
                                        <Link className="dropdown-item" to="/profile">
                                            Profile
                                        </Link>
                                        <div className="dropdown-divider"></div>
                                        <span
                                            className="dropdown-item"
                                            style={{ cursor: 'pointer' }}
                                            onClick={logoutHandler}
                                        >
                                            Logout
                                        </span>
                                    </div>
                                </li>
                            )}
                        </ul>
                    </div>
                </div>
            </nav>
        </React.Fragment>
    )
}
