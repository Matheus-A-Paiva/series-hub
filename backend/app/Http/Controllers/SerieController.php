<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use Exception;
use Illuminate\Http\Request;

class SerieController extends Controller
{

    protected TMDBService $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }
    public function index(Request $request)
    {
        try{
            $page = $request->query('page', 1);
            $topRatedSeries = $this->tmdbService->getTopRatedSeries($page);
            return response()->json([$topRatedSeries], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getCode());
        }

    }

    public function show($serieId)
    {
        try{
            $serieDetail = $this->tmdbService->getSerieById($serieId);

            return response()->json($serieDetail, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getCode());
        }
    }

    public function searchSeriesByGenre(Request $request)
    {

        try{
            $page = $request->query('page', 1);
            $genres = $request->query('with_genres');
            $response = $this->tmdbService->searchSeriesByGenre($genres, $page);
            return response()->json([$response], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], $e->getCode());
        }
    }

    public function searchSeries(Request $request)
    {

        try{
            $page = $request->query('page', 1);
            $query = $request->query('query');
            $response = $this->tmdbService->searchSeriesByName($query, $page);

            return response()->json([$response], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], $e->getCode());
        }
    }


}
