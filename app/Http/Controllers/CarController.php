<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarCadastroRequest;
use App\Http\Requests\FilterCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Support\Models\ApiResponse;
use function response;

class CarController
{
    public function cadastrar(CarCadastroRequest $request)
    {
        $data = $request->validated();
        $car = Car::create($data);

        return ApiResponse::build()
            ->setData(new CarResource($car))
            ->setCode(201)
            ->response();
    }

    public function listagem(FilterCarRequest $request)
    {
        $cars = Car::query()
            ->search($request->query('search'))
            ->byColor($request->query('color'))
            ->byYear($request->query('year'))
            ->orderBy(
                $request->query('sortBy', 'name'),
                $request->query('order', 'asc')
            )
            ->paginate($request->query('perPage', 10));

        return ApiResponse::build()
            ->setData(CarResource::collection($cars))
            ->response();
    }

    public function listar(string $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return ApiResponse::build()
                ->setMessage('Carro não encontrado')
                ->setErrors("Id {$id} não encontrado")
                ->setCode(404)
                ->response();
        }

        return ApiResponse::build()
            ->setData(new CarResource($car))
            ->response();
    }

    public function deletar(string $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return ApiResponse::build()
                ->setMessage('Carro não encontrado')
                ->setErrors("Id {$id} não encontrado")
                ->setCode(404)
                ->response();
        }
        $car->delete();
        return response()->json($car);
    }

}
