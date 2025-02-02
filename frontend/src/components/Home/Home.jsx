import React from "react";
import SerieCard from "../SerieCard/SerieCard.jsx";
import GenreFilter from "../GenreFilter/GenreFilter.jsx";
import "./Home.css";

const Home = ({ series, totalPages, currentPage, setCurrentPage, onSelectGenre }) => {
    return (
        <div className="home-container">
            <h5 className="home-title">
                <strong className="highlight">Top</strong> Series
            </h5>
            <GenreFilter onSelectGenre={onSelectGenre} />

            <div className="series-grid">
                {series.length > 0 ? (
                    series.map((serie) => <SerieCard key={serie.id} serie={serie} />)
                ) : (
                    <p>No series available</p>
                )}
            </div>

            <div className="pagination">
                <button
                    disabled={currentPage === 1}
                    onClick={() => setCurrentPage((prev) => Math.max(prev - 1, 1))}
                >
                    Previous Page
                </button>
                <span>Page {currentPage} of {totalPages}</span>
                <button
                    disabled={currentPage >= totalPages}
                    onClick={() => setCurrentPage((prev) => prev + 1)}
                >
                    Next Page
                </button>
            </div>
        </div>
    );
};

export default Home;
