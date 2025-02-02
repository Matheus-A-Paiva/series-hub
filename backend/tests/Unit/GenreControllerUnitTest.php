<?php

namespace Tests\Unit;

use App\Http\Controllers\GenreController;
use App\Services\TMDBService;
use Mockery;
use Tests\TestCase;

class GenreControllerUnitTest extends TestCase
{

    protected $tmbdServiceMock;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tmbdServiceMock = Mockery::mock(TMDBService::class);
        $this->controller = new GenreController($this->tmbdServiceMock);
    }
    public function test_index_returns_correct_data()
    {
        $mockResponse = ['genres' => ['Action', 'Comedy']];
        $this->tmbdServiceMock->shouldReceive('getAllGenres')
            ->once()
            ->andReturn($mockResponse);

        $response = $this->controller->index();

        $responseData = $response->getData(true);

        $this->assertEquals($mockResponse, $responseData);
        $this->assertEquals(200, $response->getStatusCode());    }
}
