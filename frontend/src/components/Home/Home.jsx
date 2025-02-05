import React from "react";
import SerieCard from "../SerieCard/SerieCard.jsx";
import GenreFilter from "../GenreFilter/GenreFilter.jsx";
import ReactPaginate from "react-paginate";
import "./Home.css";

const Home = ({ series, totalPages, currentPage, setCurrentPage, onSelectGenre }) => {
    const handlePageClick = (data) => {
        setCurrentPage(data.selected + 1);
    };

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


            <ReactPaginate
                previousLabel={"«"}
                nextLabel={"»"}
                breakLabel={<span className="dots">...</span>}
                pageCount={totalPages}
                marginPagesDisplayed={1}
                pageRangeDisplayed={3}
                onPageChange={handlePageClick}
                forcePage={currentPage - 1}
                containerClassName={"pagination"}
                pageClassName={"page-item"}
                pageLinkClassName={"page-link"}
                previousClassName={"prev-button"}
                nextClassName={"next-button"}
                activeClassName={"active-page"}
                disabledClassName={"disabled"}
                breakClassName={"dots"}
                breakLinkClassName={"dots"}
            />

        </div>
    );
};

export default Home;
