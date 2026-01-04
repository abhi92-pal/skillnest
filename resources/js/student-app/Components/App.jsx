// resources/js/Components/HomePage.jsx
import React, {useEffect} from 'react';
import { BrowserRouter as Router, Routes, Route, useLocation } from 'react-router-dom';
import initJqueryPlugins from '../jquery/main.js';
import NavBar from './Layouts/NavBar/index';
import Welcome from './Pages/Welcome';
import CoursePage from './Pages/CoursePage';
import Footer from './Layouts/Footer/index.jsx';
import AboutUsPage from './Pages/AboutUsPage.jsx';
import * as WebRoutes from '../Routes/Routes';
import { useDispatch } from 'react-redux';
import { autoLoginHandler } from '../store/actions';

const App = () => {
    const JQueryInitializer = () => {
        const location = useLocation();
        const dispatch = useDispatch();

        useEffect(() => {
            if (window.$) {
                initJqueryPlugins();
            }

            dispatch(autoLoginHandler());
        }, [location.pathname]); // Runs every time the route changes

        return null;
    };
    return (
        <Router>
            <JQueryInitializer />
            <NavBar />
            <Routes>
                <Route path={WebRoutes.WELCOME_PAGE} element={<Welcome />} />
                <Route path={WebRoutes.ABOUT_US_PAGE} element={<AboutUsPage />} />
                <Route path={WebRoutes.COURSES_PAGE} element={<CoursePage />} />
            </Routes>
            <Footer />
        </Router>
    );
}

export default App;