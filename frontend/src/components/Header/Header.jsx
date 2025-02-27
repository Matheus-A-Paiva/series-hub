import React from "react";
import SearchBar from "../SearchBar/SearchBar.jsx";
import "./Header.css";

const Header = ({ onSearch }) => {
    return (
        <header className="header">
            <h1 className="logo" onClick={() => window.location.reload()}>
                <span className="logo-series">Series</span>
                <span className="logo-hub">Hub</span>
            </h1>

            <SearchBar onSearch={onSearch} />
        </header>
    );
};

export default Header;
