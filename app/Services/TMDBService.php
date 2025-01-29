<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class TMDBService{
    protected $baseUrl;
    protected $apiKey;

    public function __construct(){
        $this->baseUrl = "https://api.themoviedb.org/3";
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function getPopularSeries()
    {
        $response = Http::get("{$this->baseUrl}/tv/popular", $this->getHeaders());

        if ($response->successful()) {
            return $response->json();
        }

        $this->handleResponseError($response);
    }

    public function getSerieById($serieId)
    {
        $response = Http::get("{$this->baseUrl}/tv/{$serieId}", $this->getHeaders());

        if ($response->successful()) {
            return $response->json();
        }

        $this->handleResponseError($response);
    }

    public function searchSeriesByName($query)
    {
        $headerData = ['query' => $query];
        $response = Http::get("{$this->baseUrl}/search/tv", $this->getHeaders($headerData));

        if ($response->successful()) {
            return $response->json();
        }

        $this->handleResponseError($response);
    }

    public function getAllGenres()
    {
        $response = Http::get("{$this->baseUrl}/genre/tv/list", $this->getHeaders());


        if ($response->successful()) {
            return $response->json();
        }

        $this->handleResponseError($response);
    }

    public function searchSeriesByGenre($genre)
    {
        $headerData = ['with_genres' => $genre];
        $response = Http::get("{$this->baseUrl}/discover/tv", $this->getHeaders($headerData));

        if ($response->successful()) {
            return $response->json();
        }

        $this->handleResponseError($response);
    }

    private function getHeaders($headerData = []){
        if (!empty($headerData)){
            return array_merge($headerData, [
                'api_key' => $this->apiKey,
                'Accept' => 'application/json',
            ]);
        }
        return [
            'api_key' => $this->apiKey,
            'Accept' => 'application/json',
        ];
    }

    private function handleResponseError($response)
    {
        $message = $response->json()['status_message'] ?? 'Unknown error';
        $status = $response->status();

        throw new Exception($message, $status);
    }

}
