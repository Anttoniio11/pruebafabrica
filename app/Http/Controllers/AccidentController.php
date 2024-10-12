<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Accident;

class AccidentController extends Controller
{
    // Mostrar todas las reseñas
    public function index(Request $request)
    {
        // $categories=Category::all();
        //$accident = accident::with(['patient', 'professional'])->get();
       $accidents=Accident::included()->get();
       //$categories=Category::included()->filter();
       //$categories=Category::included()->filter()->sort()->get();
       //$categories=Category::included()->filter()->sort()->getOrPaginate();
       return response()->json($accidents);

        // $accidents = accident::query()
        //     ->included()->get();
        //     // ->filter()
        //     // ->sort()
        //     // ->getOrPaginate();
        
        // return response()->json($accidents);
    }

    // Mostrar una reseña específica
    public function show($id)
    {
        $accident = Accident::find($id);

        if (!$accident) {
            return response()->json(['message' => 'accident not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($accident);
    }

    // Crear una nueva reseña
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|string',
            'hora' => 'required|string',
            'lugar' => 'required|string',
        ]);

        $accident = Accident::create($request->all());

        return response()->json($accident, Response::HTTP_CREATED);
    }

    // Actualizar una reseña existente
    public function update(Request $request, $id)
    {
        $accident = Accident::find($id);

        if (!$accident) {
            return response()->json(['message' => 'accident not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'fecha' => 'string',
            'hora' => 'string',
            'lugar' => 'string',
        ]);

        $accident->update($request->all());

        return response()->json($accident);
    }

    // Eliminar una reseña
    public function destroy($id)
    {
        $accident = Accident::find($id);

        if (!$accident) {
            return response()->json(['message' => 'accident not found'], Response::HTTP_NOT_FOUND);
        }

        $accident->delete();

        return response()->json(['message' => 'accident deleted successfully']);
    }
}
