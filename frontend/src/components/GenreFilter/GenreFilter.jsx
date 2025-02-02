import "./GenreFilter.css";

const popularGenres = [
    { id: 9648, name: "Mystery" },
    { id: 18, name: "Drama" },
    { id: 16, name: "Animation" },
    { id: 10759, name: "Action & Adventure" },
    { id: 35, name: "Comedy" }
];

const GenreFilter = ({ onSelectGenre }) => {
    const handleGenreClick = (genreId) => {
        onSelectGenre(genreId);
    };

    return (
        <div className="genre-filter-container">
            <div className="genre-buttons">
                {popularGenres.map((genre) => (
                    <button
                        key={genre.id}
                        className="genre-button"
                        onClick={() => handleGenreClick(genre.id)}
                    >
                        {genre.name}
                    </button>
                ))}
            </div>
        </div>
    );
};

export default GenreFilter;
