import { useState } from "react";
import { FaChevronDown, FaChevronUp } from "react-icons/fa";
import "./SerieCard.css";

const SerieCard = ({ serie }) => {
    const [isExpanded, setIsExpanded] = useState(false);
    const imageUrl = `https://image.tmdb.org/t/p/w300${serie.poster_path}`;
    const ratingPercentage = Math.round(serie.vote_average * 10);
    const releaseDate = serie.first_air_date
        ? new Date(serie.first_air_date + "T00:00:00Z").toLocaleDateString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric",
            timeZone: "UTC"
        })
        : "N/A";

    return (
        <div className={`serie-card ${isExpanded ? "expanded" : ""}`}>
            <div className="image-container">
                <img src={imageUrl} alt={serie.name} className="serie-image" />

                <div className="rating-container">
                    <svg width="35" height="35" viewBox="0 0 100 100" className="rating-circle">
                        <circle cx="50" cy="50" r="45" fill="#2d2d2d" stroke="white" strokeWidth="4" />
                        <circle
                            cx="50" cy="50" r="45" fill="none" stroke="#4CAF50" strokeWidth="6"
                            strokeDasharray="282.6"
                            strokeDashoffset={282.6 - (ratingPercentage / 100) * 282.6}
                            strokeLinecap="round"
                            transform="rotate(-90 50 50)"
                        />
                        <text x="50" y="60" fontSize="35" fill="white" textAnchor="middle" fontWeight="bold">
                            {ratingPercentage}%
                        </text>
                    </svg>
                </div>
            </div>

            <div className="info-container">
                <h6 className="serie-title">
                    {serie.name.length > 20 ? serie.name.slice(0, 20) + "..." : serie.name}
                </h6>
                <p className="release-date"> {releaseDate}</p>

                <button className="toggle-button" onClick={() => setIsExpanded(!isExpanded)}>
                    {isExpanded ? <FaChevronUp /> : <FaChevronDown />}
                    <span>{isExpanded ? "Hide synopsis" : "Show synopsis"}</span>
                </button>

                <div className="synopsis-container">
                    <p className="synopsis">
                        {serie.overview ? serie.overview : "Synopsis not available."}
                    </p>
                </div>
            </div>
        </div>
    );
};

export default SerieCard;
