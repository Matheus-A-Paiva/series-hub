<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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
            $cacheKey = "series_page_{$page}";

            if(Redis::exists($cacheKey)){
                return response()->json([json_decode(Redis::get($cacheKey))], 200);
            }

            $topRatedSeries = $this->tmdbService->getTopRatedSeries($page);

            Redis::setex($cacheKey, 600, json_encode($topRatedSeries));

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
            $cacheKey = "series_show_{$serieId}";
            if(Redis::get($cacheKey)){
                return response()->json([json_decode(Redis::get($cacheKey))], 200);
            }
            $serieDetail = $this->tmdbService->getSerieById($serieId);

            Redis::setex($cacheKey, 600, json_encode($serieDetail));

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
            $cacheKey = "series_genre_{$genres}_page_{$page}";

            if(Redis::exists($cacheKey)){
                return response()->json([json_decode(Redis::get($cacheKey))], 200);
            }

            $response = $this->tmdbService->searchSeriesByGenre($genres, $page);

            Redis::setex($cacheKey, 600, json_encode($response));

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
            $cacheKey = "series_query_{$query}_page_{$page}";

            if(Redis::exists($cacheKey)){
                return response()->json([json_decode(Redis::get($cacheKey))], 200);
            }
            $response = $this->tmdbService->searchSeriesByName($query, $page);

            Redis::setex($cacheKey, 600, json_encode($response));

            return response()->json([$response], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], $e->getCode());
        }
    }


}
