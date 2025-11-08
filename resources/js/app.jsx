    import './bootstrap'; // If you use Laravel's default bootstrap.js
    import '../css/app.css'; // Import your CSS

    import React from 'react';
    import ReactDOM from 'react-dom/client';
    import HomePage from './Components/HomePage'; // Your main React component
    import NavBar from './Components/NavBar/index'

    ReactDOM.createRoot(document.getElementById('app')).render(
        <React.StrictMode>
            <NavBar />
            <HomePage />
        </React.StrictMode>
    );