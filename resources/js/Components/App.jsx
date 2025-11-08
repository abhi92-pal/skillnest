    // resources/js/Components/HomePage.jsx
    import React from 'react';
    import { BrowserRouter as Router, Routes, Route} from 'react-router-dom';
    import NavBar from './Layouts/NavBar/index';
    import Welcome from './Pages/Welcome';
    import CoursePage from './Pages/CoursePage';

    const App = () => {
        return (
            <Router>
                <NavBar />
                <Routes>
                    <Route path="/" element={<Welcome />} />
                    <Route path="/courses" element={<CoursePage />} />
                </Routes>
            </Router>
        );
    }

    export default App;