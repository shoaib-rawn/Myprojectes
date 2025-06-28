// Import necessary modules
import React from "react"; // Import React to create components
import ReactDOM from "react-dom/client"; // Import ReactDOM to render components in the DOM
import "./styles.css"; // Import custom CSS styles
import App from "./App"; // Import the main App component

// Create the root element where the React app will be mounted
const root = ReactDOM.createRoot(document.getElementById("root"));

// Render the App component inside the root element
root.render(
  <React.StrictMode>
    {/* React.StrictMode is a wrapper that helps identify potential problems in the app during development */}
    <App />
    {/* The App component is the main entry point of the application */}
  </React.StrictMode>
);
