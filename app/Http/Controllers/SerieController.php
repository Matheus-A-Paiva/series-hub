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
    public function index()
    {
        try{
            $popularSeries = $this->tmdbService->getPopularSeries();
            return response()->json([$popularSeries], 200);
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
            $response = $this->tmdbService->searchSeriesByGenre($request->get('with_genres'));
            return response()->json([$response], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], $e->getCode());
        }
    }

    public function searchSeries(Request $request)
    {

        try{
            $response = $this->tmdbService->searchSeriesByName($request->get('query'));

            return response()->json([$response], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], $e->getCode());
        }
    }


}
