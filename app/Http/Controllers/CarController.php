<?php

namespace App\Http\Controllers;

use App\Http\Requests\car\StoreRequest;
use App\Http\Requests\car\UpdateRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\CarResource;

class CarController extends Controller
{
    public function index()
    {
        $res = CarResource::collection(Car::all());
        return ApiResponse::success($res);
    }

    public function store(StoreRequest $request)
    {
        $res = Car::create($request->validated());
        return ApiResponse::success(new CarResource($res), 'Carro criado com sucesso', 201);
    }

    public function show(Car $car)
    {
        $res = new CarResource($car);
        return ApiResponse::success($res);
    }

    public function update(UpdateRequest $request, Car $car)
    {
        $res = $car->save($request->validated());
        return ApiResponse::success($res);
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return response()->noContent();
    }
}
