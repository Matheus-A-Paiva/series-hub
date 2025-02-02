import axios from "axios";

const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';


const handleRequest = async (requestFunction) => {
    try{
        const response = await requestFunction();
        return response.data[0];
    } catch (error) {
        console.error("Request error:", error);
        throw new Error(error.response?.data?.message || "Error fetching data.");
    }
}

export const fetchSeries = (page = 1) =>
    handleRequest(() => axios.get(`${API_URL}/series`, { params: { page }}))
export const fetchGenres = () => handleRequest(() => axios.get(`${API_URL}/genres`))
export const fetchSerieDetails = (id) =>
    handleRequest(() => axios.get(`${API_URL}/series/${id}`))
export const fetchSearchSeries = (query, page = 1) =>
    handleRequest(() => axios.get(`${API_URL}/series/search`, { params: { query, page } }))
export const fetchSeriesByGenre = (with_genres, page = 1) =>
    handleRequest(() => axios.get(`${API_URL}/series/discover`, { params: { with_genres, page } }))


