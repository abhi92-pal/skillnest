import React from "react";
import "./FullPageLoader.css";

function FullPageLoader() {
  return (
    <div className="fullpage-loader-overlay">
      <div className="fullpage-loader-spinner"></div>
    </div>
  );
}

export default FullPageLoader;
