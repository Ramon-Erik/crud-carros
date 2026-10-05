<?php

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('resultado paginado', function () {
    Car::factory()->count(15)->create();

    $response = $this->getJson('/api/car/listagem?page=1&perPage=9');

    $response->assertStatus(200)
        ->assertJsonPath('pagination.currentPage', 1)
        ->assertJsonPath('pagination.perPage', 9)
        ->assertJsonPath('pagination.total', 15);
});

test('resultado filtrado', function () {
    Car::factory()->count(15)->create();

    $color = 'RoyalBlue';
    $model = 'FirstModelEver';
    Car::factory()->create([
        'color' => $color,
        'model' => $model
    ]);

    $response = $this->getJson('/api/car/listagem?page=1&perPage=9&color=' . $color . '&model=' . $model);

    $response->assertStatus(200)
        ->assertJsonPath('data.0.color', $color)
        ->assertJsonPath('data.0.model', $model)
        ->assertJsonPath('pagination.total', 1);
});

test('resultado com pesquisa', function () {
    Car::factory()->count(15)->create();

    $color = 'RoyalBlue';
    $model = 'FirstModelEver';
    $name = 'Fusca Azul';
    Car::factory()->create([
        'color' => $color,
        'name' => $name,
        'model' => $model
    ]);

    $response = $this->getJson('/api/car/listagem?page=1&perPage=9&search=' . $name);

    $response->assertStatus(200)
        ->assertJsonPath('data.0.name', $name)
        ->assertJsonPath('data.0.model', $model)
        ->assertJsonPath('data.0.model', $model)
        ->assertJsonPath('pagination.total', 1);
});
