<?php

namespace App\Http\Controllers;

use App\Http\Requests\car\StoreRequest;
use App\Http\Requests\car\UpdateRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::paginate();
    }

    public function store(StoreRequest $request)
    {
        return Car::create($request->validated());
    }


    public function show(int $id)
    {
        $car = Car::find($id);
        if ($car) {
            return $car;
        }
        return response()->json(['message' => 'Não encontrado',], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Não encontrado',], 404);
        }

        $data = $request->validated();
        $car->fill($data);
        $car->save();
        return $car;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $car = Car::find($id);

        if ($car) {
            $car->delete();
            return response()->json(['message' => 'Carro deletado'], 204);
        }
        return response()->json(['message' => 'Não encontrado',], 404);
    }
}
