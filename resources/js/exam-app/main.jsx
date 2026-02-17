import '../bootstrap';
import '../../css/app.css';

import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './Components/App';

import rootReducer from './store/reducers/index';
import { configureStore } from '@reduxjs/toolkit';
import { Provider } from 'react-redux';

const store = configureStore({
        reducer: rootReducer,
        devTools: import.meta.env.DEV,
    });
    
ReactDOM.createRoot(document.getElementById('app')).render(
    <React.StrictMode>
        <Provider store={store}>
            <App />
        </Provider>
    </React.StrictMode>
);