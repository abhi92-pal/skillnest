import * as actionTypes from './actionTypes';
import axios from 'axios';

import * as Routes from '../../Routes/Routes';

export const authStart = () => {
    return {
        type: actionTypes.AUTH_START
    };
};

export const logout = () => {
    const token = localStorage.getItem('_token');
    return dispatch => {
        if (token) {
            localStorage.removeItem('_token');
            localStorage.removeItem('expirationDate');
            dispatch(logoutSuccess());
            dispatch(autoRedirectAfterAutoLogout());

            // axios.post('/auth/logout', {}, {
            //     headers: {
            //         'Authorization': `bearer ${token}`
            //     }
            // }).then(response => {
            //     localStorage.removeItem('_token');
            //     localStorage.removeItem('expirationDate');
            //     dispatch(logoutSuccess());
            //     dispatch(autoRedirectAfterAutoLogout());
            // }).catch(error => {
            //     console.log(error.response);
            //     // dispatch(authFail(error.response));
            // });
        }

    }
}

export const logoutSuccess = () => {
    return {
        type: actionTypes.AUTH_LOGOUT
    }
}

export const autoRedirectAfterAutoLogout = () => {
    location.replace(Routes.WEB_BASE_URL);
}

export const refresh = () => {
    const token = localStorage.getItem('_token');
    return dispatch => {
        if (token) {
            axios.post(Routes.AUTH_REFRESH_API, {}, {
                headers: {
                    'Authorization': `bearer ${token}`
                }
            }).then(response => {
                const expirationDate = new Date(new Date().getTime() + response.data.data.expires_at * 1000);
                localStorage.setItem('_token', response.data.data.token);
                localStorage.setItem('expirationDate', expirationDate);
                dispatch(authSuccess(response.data.data.token));
                // dispatch(fetchUserDetails());
                dispatch(checkAuthTimeOut(response.data.data.expires_at));
            }).catch(error => {
                console.log(error.response);
                // dispatch(authFail(error.response));
            });
        }
    }
}

export const checkAuthTimeOut = (expirationTime) => {
    return dispatch => {
        const now = new Date().getTime(); // current time in ms
        const expirationTimeMs = expirationTime * 1000;

        const timeout = expirationTimeMs - now - 2000;
        if(timeout > 0){
            setTimeout(() => {
                dispatch(refresh());
            }, timeout);
        }
    };
};

export const authSuccess = (authData) => {
    return {
        type: actionTypes.AUTH_SUCCESS,
        authData: authData
    };
};

export const authFail = (errors, errorMessage) => {
    return {
        type: actionTypes.AUTH_FAIL,
        errors: errors,
        errorMessage: errorMessage
    };
};

export const auth = (credential) => {
    return dispatch => {
        dispatch(authStart());
        axios.post(Routes.LOGIN_API, credential)
            .then(response => {
                // console.log(response);
                
                const expirationDate = new Date(response.data.data.expires_at * 1000);
                localStorage.setItem('_token', response.data.data.token);
                localStorage.setItem('expirationDate', expirationDate);
                dispatch(authSuccess(response.data));
                // dispatch(fetchUserDetails());
                dispatch(checkAuthTimeOut(response.data.data.expires_at));
            })
            .catch(error => {
                // console.log(error);
                const errResp = error.response.data;
                dispatch(authFail(errResp.errors, errResp.message));
            });
    };
};

export const storeUserDetails = (userDetails) => {
    return {
        type: actionTypes.GET_AUTH_DETAILS,
        userData: userDetails
    }
}

export const fetchUserDetails = () => {
    const token = localStorage.getItem('_token');
    return dispatch => {
        if (token) {
            axios.post('/auth/me', {}, {
                headers: {
                    'Authorization': `bearer ${token}`
                }
            })
                .then(response => {
                    dispatch(storeUserDetails(response.data));
                })
                .catch(error => {
                    console.log(error.response);
                    // dispatch(authFail(error.response));
                });
        }
    }
}

export const autoLoginHandler = () => {
        
    return dispatch => {
        const _token = localStorage.getItem('_token');
        if (!_token) {
            dispatch(logout());
        } else {
            const expirationDate = new Date(localStorage.getItem('expirationDate'));
            if (expirationDate > new Date()) {
                // console.log('Auto Logged in');
                
                const authData = {
                                    data: {
                                            token: _token,
                                        },
                                    message: 'Logged in successfully'
                                };
                dispatch(authSuccess(authData));
                // dispatch(fetchUserDetails());
                const expirationTime = ((expirationDate.getTime() - new Date().getTime()) / 1000);
                dispatch(checkAuthTimeOut(expirationTime));
            } else {
                // console.log('Logged out');
                dispatch(logout());
            }
        }
    }
}

export const afterLoginRedirectTo = (redirect_path) => {
    return {
        type: actionTypes.AFTER_LOGIN_REDIRECT_TO,
        redirect_path: redirect_path
    }
}

export const registerStart = () => {
    return {
        type: actionTypes.REGISTER_START
    };
};

export const registerSuccess = (newUserData) => {
    return {
        type: actionTypes.REGISTER_SUCCESS,
        newUserData: newUserData
    };
};

export const registerFail = (errors, errorMessage) => {
    return {
        type: actionTypes.REGISTER_FAIL,
        errors: errors,
        errorMessage: errorMessage
    };
};

export const register = (registerFormData) => {
    return dispatch => {
        dispatch(registerStart());
        axios.post(Routes.REGISTER_API, registerFormData)
            .then(response => {
                // console.log(response);

                const expirationDate = new Date(response.data.data.expires_at * 1000);
                localStorage.setItem('_token', response.data.data.token);
                localStorage.setItem('expirationDate', expirationDate);
                
                dispatch(authSuccess(response.data));
                // dispatch(fetchUserDetails());
                dispatch(checkAuthTimeOut(response.data.data.expires_at));
            })
            .catch(error => {
                // console.log(error);
                const errResp = error.response.data;
                dispatch(registerFail(errResp.errors, errResp.message));
            })
    };
};