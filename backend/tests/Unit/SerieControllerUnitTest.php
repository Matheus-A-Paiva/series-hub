<?php

namespace Tests\Unit;

use App\Http\Controllers\SerieController;
use App\Services\TMDBService;
use Exception;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class SerieControllerUnitTest extends TestCase
{
    protected $tmbdServiceMock;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tmbdServiceMock = Mockery::mock(TMDBService::class);
        $this->controller = new SerieController($this->tmbdServiceMock);
    }

    public function test_index_returns_top_rated_series()
    {
        $mockResponse = [['id'=>1, 'name'=> 'Breaking Bad']];

        $this->tmbdServiceMock
            ->shouldReceive('getTopRatedSeries')
            ->once()
            ->andReturn($mockResponse);

        $request = new Request(['page'=>1]);
        $response = $this->controller->index($request);

        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([$mockResponse], $responseData);
    }

    public function test_show_returns_serie_details()
    {
        // Arrange
        $mockResponse = ['id' => 93405, 'name' => 'Squid Game'];

        // Act
        $this->tmbdServiceMock
            ->shouldReceive('getSerieById')
            ->with(93405)
            ->once()
            ->andReturn($mockResponse);

        $response = $this->controller->show(93405);
        $responseData = json_decode($response->getContent(), true);

        // Assert
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($mockResponse, $responseData);
    }


    public function test_search_series_by_genre_returns_correct_data()
    {
        $mockResponse = [['id'=>1, 'name'=> 'Drama Series']];

        $this->tmbdServiceMock
            ->shouldReceive('searchSeriesByGenre')
            ->once(18)
            ->andReturn($mockResponse);

        $request = new Request(['with_genres'=>18]);
        $response = $this->controller->searchSeriesByGenre($request);
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([$mockResponse], $responseData);
    }

    public function test_search_series_returns_correct_data()
    {
        $mockResponse = [['id' => 1, 'name' => 'Breaking Bad']];

        $this->tmbdServiceMock
            ->shouldReceive('searchSeriesByName')
            ->with('breaking bad', 1)
            ->once()
            ->andReturn($mockResponse);

        $request = new Request(['query' => 'breaking bad', 'page' => 1]);

        $response = $this->controller->searchSeries($request);
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([$mockResponse], $responseData);
    }

    public function test_show_returns_error_when_service_fails()
    {
        $this->tmbdServiceMock
            ->shouldReceive('getSerieById')
            ->with(99999999)
            ->once()
            ->andThrow(new Exception('Not Found', 404));

        $response = $this->controller->show(99999999);
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertArrayHasKey('error', $responseData);
        $this->assertEquals('Not Found', $responseData['error']);
    }
}
