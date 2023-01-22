<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZoneTest extends TestCase
{
    use RefreshDatabase;

    public $seed = true;

    public function testPublicUserCanGetAllZones()
    {
        $response = $this->getJson('/api/v1/zones');

        $response->assertStatus(200)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure(['data' => [
                ['*' => 'id', 'name', 'price_per_hour'],
            ]]);
    }
}
