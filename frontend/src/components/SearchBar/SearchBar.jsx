import { useState } from "react";
import "./SearchBar.css";

const SearchBar = ({ onSearch }) => {
    const [query, setQuery] = useState("");

    const handleSearch = (e) => {
        e.preventDefault();
        onSearch(query);
    };

    return (
        <form className="search-bar" onSubmit={handleSearch}>
            <input
                type="text"
                className="search-input"
                placeholder="Search series..."
                value={query}
                onChange={(e) => setQuery(e.target.value)}
            />
            <button className="search-button" type="submit">
                Search
            </button>
        </form>
    );
};

export default SearchBar;
