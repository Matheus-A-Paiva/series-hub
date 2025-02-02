import React from "react";
import { FaGithub, FaLinkedin } from "react-icons/fa";
import "./Footer.css";

const Footer = () => {
    return (
        <footer className="footer">
            <p>&copy; {new Date().getFullYear()} Series Hub. All rights reserved.</p>

            <div className="social-links">
                <a
                    href="https://github.com/Matheus-A-Paiva/series-hub"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="social-icon"
                >
                    <FaGithub />
                </a>
                <a
                    href="https://www.linkedin.com/in/matheus-paiva-6875b2270/"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="social-icon"
                >
                    <FaLinkedin />
                </a>
            </div>
        </footer>
    );
};

export default Footer;
