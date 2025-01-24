<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        return response()->json(Publisher::all(), 200);
    }

    public function show($id)
    {
        $publisher = Publisher::find($id);
        if (!$publisher) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
        return response()->json($publisher, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'country' => 'sometimes|string',
        ]);

        $publisher = Publisher::create($request->all());
        return response()->json($publisher, 201);
    }

    public function update(Request $request, $id)
    {
        $publisher = Publisher::find($id);
        if (!$publisher) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
        $publisher->update($request->all());
        return response()->json($publisher, 200);
    }

    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        if (!$publisher) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
        $publisher->delete();
        return response()->json(['message' => 'Publisher deleted'], 200);
    }

    public function authors($id)
    {
        $publisher = Publisher::find($id);
        if (!$publisher) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
        return response()->json($publisher->authors, 200);
    }

    public function associateAuthor(Request $request, $id)
    {
        $this->validate($request, [
            'author_id' => 'required|exists:authors,id',
        ]);

        $publisher = Publisher::find($id); // Ahora coincide con el parámetro de la ruta
        if (!$publisher) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }

        $publisher->authors()->attach($request->input('author_id'));

        return response()->json(['message' => 'Author associated successfully'], 200);
    }


    public function disassociateAuthor(Request $request, $publisherId)
    {
        $this->validate($request, [
            'author_id' => 'required|exists:authors,id',
        ]);

        $publisher = Publisher::find($publisherId);
        if (!$publisher) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }

        // Eliminar la asociación
        $publisher->authors()->detach($request->input('author_id'));

        return response()->json(['message' => 'Author disassociated successfully'], 200);
    }



}
