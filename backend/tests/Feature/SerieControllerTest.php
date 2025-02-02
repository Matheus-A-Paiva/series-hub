<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerieControllerTest extends TestCase
{

    public function test_top_rated_series(): void
    {
        $response = $this->getJson('api/series');

        $response->assertStatus(200);
    }

    public function test_get_serie_by_id(): void
    {
        $response = $this->getJson('api/series/93405');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Squid Game', 'id'=> 93405, "homepage" => "https://www.netflix.com/title/81040344"]);

    }

    public function test_get_series_by_name(): void
    {
        $response = $this->getJson('api/series/search?query=breaking+bad');

        $response->assertStatus(200)
            ->assertJson(function ($json) {
                $json->has('0.results', 2);
                $json->where('0.results.0.name', 'Breaking Bad');
                $json->where('0.results.1.name', 'Breaking Bad Fortune Teller');
            });
    }

    public function test_get_series_by_genre(): void
    {
        $response = $this->getJson('api/series/discover?with_genres=18');

        $response->assertStatus(200)
                ->assertJson( function($json) {
                    $json->has('0.results');
                    $json->has('0.results.0');
                    $json->where('0.results.0.genre_ids.0', 18);
                    $json->has('0.results.0.name');
                });
    }

    public function test_get_series_by_invalid_genre(): void
    {
        $response = $this->getJson('api/series/discover?with_genres=999999999');

        $response->assertStatus(200)
            ->assertJsonPath('0.results', []);
    }


}
