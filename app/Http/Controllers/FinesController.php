<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Fines;

class FinesController extends Controller
{
    // Mostrar todas las reseñas
    public function index(Request $request)
    {
        // $categories=Category::all();
        //$fines = fines::with(['patient', 'professional'])->get();
       $fines=Fines::included()->get();
       //$categories=Category::included()->filter();
       //$categories=Category::included()->filter()->sort()->get();
       //$categories=Category::included()->filter()->sort()->getOrPaginate();
       return response()->json($fines);

        // $fines = fines::query()
        //     ->included()->get();
        //     // ->filter()
        //     // ->sort()
        //     // ->getOrPaginate();
        
        // return response()->json($fines);
    }

    // Mostrar una reseña específica
    public function show($id)
    {
        $fines = Fines::find($id);

        if (!$fines) {
            return response()->json(['message' => 'fines not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($fines);
    }

    // Crear una nueva reseña
    public function store(Request $request)
    {
        $request->validate([
            'lugar' => 'required|string',
            'fecha' => 'required|string',
            'hora' => 'required|string',
            'matricula' => 'required|string',
            'person_id' => 'required|exists:person,id',
            'vehicle_id' => 'required|exists:vehicle,id',
        ]);

        $fines = Fines::create($request->all());

        return response()->json($fines, Response::HTTP_CREATED);
    }

    // Actualizar una reseña existente
    public function update(Request $request, $id)
    {
        $fines = Fines::find($id);

        if (!$fines) {
            return response()->json(['message' => 'fines not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'lugar' => 'required|string',
            'fecha' => 'required|string',
            'hora' => 'required|string',
            'matricula' => 'required|string',
            'person_id' => 'required|exists:person,id',
            'vehicle_id' => 'required|exists:vehicle,id',
        ]);

        $fines->update($request->all());

        return response()->json($fines);
    }

    // Eliminar una reseña
    public function destroy($id)
    {
        $fines = Fines::find($id);

        if (!$fines) {
            return response()->json(['message' => 'fines not found'], Response::HTTP_NOT_FOUND);
        }

        $fines->delete();

        return response()->json(['message' => 'fines deleted successfully']);
    }
}
