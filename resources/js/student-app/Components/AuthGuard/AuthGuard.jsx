// components/Auth/AuthGuard.jsx
import { useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { Navigate, useLocation, Outlet } from 'react-router-dom';
import { afterLoginRedirectTo } from '../../store/actions';
import * as Routes from '../../Routes/Routes';

const AuthGuard = () => {
    const dispatch = useDispatch();
    const location = useLocation();
    const { token, isAuthChecked } = useSelector(state => state.auth);

    useEffect(() => {
        if (isAuthChecked && !token) {
            dispatch(afterLoginRedirectTo(location.pathname));
        }
    }, [isAuthChecked, token, location.pathname, dispatch]);

    if (!isAuthChecked) {
        return null;
    }

    if (!token) {
        return <Navigate to={Routes.WELCOME_PAGE} replace />;
    }

    return <Outlet />;
};

export default AuthGuard;
