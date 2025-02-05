import React, { useEffect, useState } from "react";
import Header from "../../components/Header/Header.jsx";
import Home from "../../components/Home/Home.jsx";
import Footer from "../../components/Footer/Footer.jsx";
import { fetchSeries, fetchSeriesByGenre, fetchSearchSeries } from "../../services/api.js";

const HomePage = () => {
    const [series, setSeries] = useState([]);
    const [selectedGenre, setSelectedGenre] = useState(null);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [searchActive, setSearchActive] = useState(false);

    useEffect(() => {
        if (searchActive) return;

        const loadSeries = async () => {
            try {
                let data;
                if (selectedGenre) {
                    data = await fetchSeriesByGenre(selectedGenre, currentPage);
                } else {
                    data = await fetchSeries(currentPage);
                }

                setSeries(data.results);
                setTotalPages(data.total_pages || 1);
            } catch (error) {
                console.error("Failed to load series:", error);
            }
        };

        loadSeries();
    }, [currentPage, selectedGenre, searchActive]);

    const handleSearch = async (query) => {
        if (!query.trim()) {
            setSearchActive(false);
            setCurrentPage(1);
            return;
        }

        setSearchActive(true);
        setCurrentPage(1);
        setSelectedGenre(null);

        try {
            const data = await fetchSearchSeries(query, 1);
            setSeries(data.results);
            setTotalPages(data.total_pages || 1);
        } catch (error) {
            console.error("Search failed:", error);
        }
    };


    const handleGenreChange = (genreId) => {
        setSearchActive(false);
        setCurrentPage(1);
        setSelectedGenre(genreId);
    };

    return (
        <div>
            <Header onSearch={handleSearch} />
            <Home
                series={series}
                totalPages={totalPages}
                currentPage={currentPage}
                setCurrentPage={setCurrentPage}
                onSelectGenre={handleGenreChange}
            />
            <Footer/>
        </div>
    );
};

export default HomePage;
