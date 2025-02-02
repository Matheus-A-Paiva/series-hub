<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreControllerTest extends TestCase
{
    public function test_get_genres(): void
    {
        $response = $this->getJson('api/genres');

        $response->assertStatus(200)
            ->assertJson(function ($json) {
                $json->has('genres');
                $json->has('genres.0');
                $json->has('genres.0.id');
                $json->has('genres.0.name');
            });
    }

}
