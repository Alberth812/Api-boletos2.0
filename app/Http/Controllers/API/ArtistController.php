<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Listar todos los artistas
     */
    public function index()
    {
        return response()->json(Artist::all());
    }

    /**
     * Crear un nuevo artista
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'image_url' => 'nullable|url|max:500',
        ]);

        $artist = Artist::create($validated);

        return response()->json([
            'message' => 'Artista creado exitosamente',
            'artist' => $artist
        ], 201);
    }

    /**
     * Mostrar un artista específico
     */
    public function show($id)
    {
        $artist = Artist::find($id);

        if (! $artist) {
            return response()->json(['message' => 'Artista no encontrado'], 404);
        }

        return response()->json($artist);
    }

    /**
     * Actualizar un artista
     */
    public function update(Request $request, $id)
    {
        $artist = Artist::find($id);

        if (! $artist) {
            return response()->json(['message' => 'Artista no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'image_url' => 'nullable|url|max:500',
        ]);

        $artist->update($validated);

        return response()->json([
            'message' => 'Artista actualizado exitosamente',
            'artist' => $artist
        ]);
    }

    /**
     * Eliminar un artista
     */
    public function destroy($id)
    {
        $artist = Artist::find($id);

        if (! $artist) {
            return response()->json(['message' => 'Artista no encontrado'], 404);
        }

        $artist->delete();

        return response()->json(['message' => 'Artista eliminado exitosamente'], 200);
    }
}