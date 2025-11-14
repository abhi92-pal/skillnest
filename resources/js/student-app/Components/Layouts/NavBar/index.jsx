import React from 'react';
import {Link, useLocation } from 'react-router-dom';


export default function index() {
    const APP_NAME = import.meta.env.VITE_APP_NAME;
    const location = useLocation();
    const isActive = (path) => location.pathname === path ? 'nav-item active' : 'nav-item';
    return (
        <React.Fragment>
            <nav className="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
                <div className="container">
                    <Link to="/" className="navbar-brand" >{APP_NAME}</Link>
                    <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="oi oi-menu"></span> Menu
                    </button>

                    <div className="collapse navbar-collapse" id="ftco-nav">
                        <ul className="navbar-nav ml-auto">
                            <li className={isActive('/')}><Link to="/" className="nav-link">Home</Link></li>
                            <li className={isActive('/about-us')}><Link to="/about-us" className="nav-link">About</Link></li>
                            <li className={isActive('/courses')}><Link to="/courses" className="nav-link">Course</Link></li>
                            <li className="nav-item"><a href="instructor.html" className="nav-link">Instructor</a></li>
                            <li className="nav-item"><a href="contact.html" className="nav-link">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </React.Fragment>
    )
}
