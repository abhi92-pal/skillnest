import React from 'react';
import { BrowserRouter as Router, Navigate, Route, Routes } from 'react-router-dom';
import NotFound from './Pages/NotFound';
import AuthGuard from './AuthGuard/AuthGuard';
// import AuthGuard from './AuthGuard/AuthGuard';
import WelcomeExam from './Pages/WelcomeExam';

import * as WebRoutes from '../Routes/Routes';

const App = () => {
    return (
        <Router basename="/ex">
            <Routes>
                <Route path={WebRoutes.EXAM_WELCOME_PAGE} element={<WelcomeExam />} />
                {/* <Route element={<AuthGuard />}> */}
                    {/* <Route path={WebRoutes.MY_COURSES_PAGE} element={<MyCoursePage />} />
                    <Route path={WebRoutes.MY_COURSE_DETAILS_PAGE } element={<MyCourseDetailPage />} /> */}
                {/* </Route> */}

                <Route path="/404" element={<NotFound />} />
                <Route path="*" element={<Navigate to="/404" replace />} />
            </Routes>
        </Router>
    );
}

export default App;