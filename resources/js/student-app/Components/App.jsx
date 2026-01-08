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

const App = () => {
    const JQueryInitializer = () => {
        const location = useLocation();

        useEffect(() => {
            if (window.$) {
                initJqueryPlugins();
            }
        }, [location.pathname]); // Runs every time the route changes

        return null;
    };
    return (
        <Router>
            <JQueryInitializer />
            <NavBar />
            <Routes>
                <Route path="/" element={<Welcome />} />
                <Route path="/about-us" element={<AboutUsPage />} />
                <Route path="/courses" element={<CoursePage />} />
                <Route path="/instructors" element={<InstructorPage />} />
                <Route path="/contact" element={<ContactPage />} />
            </Routes>
            <Footer />
        </Router>
    );
}

export default App;