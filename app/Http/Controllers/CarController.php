<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::all();
    }

    public function store(Request $request)
    {
        return Car::create($request->only(['name', 'model', 'manufacture_year', 'color']));
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
    public function update(Request $request, int $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Não encontrado',], 404);
        }

        $data = $request->only(['name', 'model', 'manufacture_year', 'color']);
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
