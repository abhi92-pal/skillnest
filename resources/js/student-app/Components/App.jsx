// resources/js/Components/HomePage.jsx
import React, {useEffect} from 'react';
import { BrowserRouter as Router, Routes, Route, useLocation } from 'react-router-dom';
import initJqueryPlugins from '../jquery/main.js';
import NavBar from './Layouts/NavBar/index';
import Welcome from './Pages/Welcome';
import CoursePage from './Pages/CoursePage';
import InstructorPage from './Pages/InstructorPage';
import Footer from './Layouts/Footer/index.jsx';
import AboutUsPage from './Pages/AboutUsPage.jsx';
import ContactPage from './Pages/ContactPage.jsx';
import MyCoursePage from './Pages/MyCoursePage';
import * as WebRoutes from '../Routes/Routes';
import { useDispatch } from 'react-redux';
import { autoLoginHandler } from '../store/actions';
import AuthGuard from './AuthGuard/AuthGuard';

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
                <Route path="/instructors" element={<InstructorPage />} />
                <Route path="/contact" element={<ContactPage />} />
                <Route element={<AuthGuard />}>
                    <Route path={WebRoutes.MY_COURSES_PAGE} element={<MyCoursePage />} />
                    {/* <Route path={WebRoutes.PROFILE_PAGE} element={<ProfilePage />} /> */}
                </Route>
            </Routes>
            <Footer />
        </Router>
    );
}

export default App;