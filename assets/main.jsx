import React from "react";
import ReactDOM from "react-dom/client";
import App from "./app.jsx";
import './bootstrap.js';
import './styles/app.css';

const container  = document.getElementById('root');

const root = ReactDOM.createRoot(container);
root.render(
    <React.StrictMode>
        <App/>
    </React.StrictMode>
);
