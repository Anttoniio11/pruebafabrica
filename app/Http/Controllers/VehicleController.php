<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    // Mostrar todas las reseñas
    public function index(Request $request)
    {
        // $categories=Category::all();
        //$vehicle = vehicle::with(['patient', 'professional'])->get();
       $vehicles=Vehicle::included()->get();
       //$categories=Category::included()->filter();
       //$categories=Category::included()->filter()->sort()->get();
       //$categories=Category::included()->filter()->sort()->getOrPaginate();
       return response()->json($vehicles);

        // $vehicles = vehicle::query()
        //     ->included()->get();
        //     // ->filter()
        //     // ->sort()
        //     // ->getOrPaginate();
        
        // return response()->json($vehicles);
    }

    // Mostrar una reseña específica
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'vehicle not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($vehicle);
    }

    // Crear una nueva reseña
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'person_id' => 'required|exists:person,id',
        ]);

        $vehicle = Vehicle::create($request->all());

        return response()->json($vehicle, Response::HTTP_CREATED);
    }

    // Actualizar una reseña existente
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'vehicle not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'person_id' => 'required|exists:person,id',
        ]);

        $vehicle->update($request->all());

        return response()->json($vehicle);
    }

    // Eliminar una reseña
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'vehicle not found'], Response::HTTP_NOT_FOUND);
        }

        $vehicle->delete();

        return response()->json(['message' => 'vehicle deleted successfully']);
    }
}
