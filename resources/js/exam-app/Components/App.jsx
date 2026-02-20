import React, { useEffect } from 'react';
import { BrowserRouter as Router, Navigate, Route, Routes } from 'react-router-dom';
import NotFound from './Pages/NotFound';
import AuthGuard from './AuthGuard/AuthGuard';
import WelcomeExam from './Pages/WelcomeExam';
import QuestionPaper from './Pages/QuestionPaper';

import * as WebRoutes from '../Routes/Routes';
import { useDispatch } from 'react-redux';
import { autoLoginHandler } from '../store/actions/index';

const App = () => {
    const dispatch = useDispatch();
    useEffect(() => {
        dispatch(autoLoginHandler());
    }, []);
    
    return (
        <Router basename="/ex">
            <Routes>
                <Route path={WebRoutes.EXAM_WELCOME_PAGE} element={<WelcomeExam />} />
                <Route element={<AuthGuard />}>
                    <Route path={WebRoutes.QUESTIONS_PAGE} element={<QuestionPaper />} />
                </Route>

                <Route path="/404" element={<NotFound />} />
                <Route path="*" element={<Navigate to="/404" replace />} />
            </Routes>
        </Router>
    );
}

export default App;