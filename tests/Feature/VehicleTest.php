<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanGetTheirOwnVehicles()
    {
        $john = User::factory()->create();
        $vehicleForJohn = Vehicle::factory()->create([
            'user_id' => $john->id
        ]);

        $jane = User::factory()->create();
        $vehicleForJane = Vehicle::factory()->create([
            'user_id' => $jane->id
        ]);
        $response = $this->actingAs($john)->getJson('/api/v1/vehicles');

        $response->assertStatus(200)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.plate_number', $vehicleForJohn->plate_number)
            ->assertJsonPath('data.0.description', $vehicleForJohn->description)
            ->assertJsonMissing($vehicleForJane->toArray());
    }

    public function testUserCanCreateVehicle()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/vehicles', [
            'plate_number' => 'P200',
            'description' => 'Hello World',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    'plate_number',
                    'description',
                ],
            ])
            ->assertJsonPath('data.plate_number', 'P200')
            ->assertJsonPath('data.description', 'Hello World');


        $this->assertDatabaseHas('vehicles', [
            'plate_number' => 'P200',
            'description' => 'Hello World',
        ]);
    }

    public function testUserCanUpdateTheirVehicle()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->putJson('/api/v1/vehicles/' . $vehicle->id, [
            'plate_number' => 'P201',
            'description' => 'Another Description'
        ]);

        $response->assertStatus(202)
            ->assertJsonStructure(['plate_number','description'])
            ->assertJsonPath('plate_number', 'P201')
            ->assertJsonPath('description', 'Another Description');


        $this->assertDatabaseHas('vehicles', [
            'plate_number' => 'P201',
            'description' => 'Another Description'
        ]);
    }

    public function testUserCanDeleteTheirVehicle()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson('/api/v1/vehicles/' . $vehicle->id);

        $response->assertNoContent();

        $this->assertDatabaseMissing('vehicles', [
            'id' => $vehicle->id,
            'deleted_at' => NULL
        ])->assertDatabaseCount('vehicles', 0);
    }
}
