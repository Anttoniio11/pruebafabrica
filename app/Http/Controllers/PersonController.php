<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Person;

class PersonController extends Controller
{
    // Mostrar todas las reseñas
    public function index(Request $request)
    {
        // $categories=Category::all();
        //$person = person::with(['patient', 'professional'])->get();
       $persons=Person::included()->get();
       //$categories=Category::included()->filter();
       //$categories=Category::included()->filter()->sort()->get();
       //$categories=Category::included()->filter()->sort()->getOrPaginate();
       return response()->json($persons);

        // $persons = person::query()
        //     ->included()->get();
        //     // ->filter()
        //     // ->sort()
        //     // ->getOrPaginate();
        
        // return response()->json($persons);
    }

    // Mostrar una reseña específica
    public function show($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'person not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($person);
    }

    // Crear una nueva reseña
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|string',
        ]);

        $person = Person::create($request->all());

        return response()->json($person, Response::HTTP_CREATED);
    }

    // Actualizar una reseña existente
    public function update(Request $request, $id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'person not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|string',
        ]);

        $person->update($request->all());

        return response()->json($person);
    }

    // Eliminar una reseña
    public function destroy($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'person not found'], Response::HTTP_NOT_FOUND);
        }

        $person->delete();

        return response()->json(['message' => 'person deleted successfully']);
    }
}
