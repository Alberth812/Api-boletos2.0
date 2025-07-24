<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return response()->json(Location::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
        ]);

        $location = Location::create($validated);

        return response()->json([
            'message' => 'Ubicación creada exitosamente',
            'location' => $location
        ], 201);
    }

    public function show($id)
    {
        $location = Location::find($id);

        if (! $location) {
            return response()->json(['message' => 'Ubicación no encontrada'], 404);
        }

        return response()->json($location);
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);

        if (! $location) {
            return response()->json(['message' => 'Ubicación no encontrada'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
        ]);

        $location->update($validated);

        return response()->json([
            'message' => 'Ubicación actualizada exitosamente',
            'location' => $location
        ]);
    }

    public function destroy($id)
    {
        $location = Location::find($id);

        if (! $location) {
            return response()->json(['message' => 'Ubicación no encontrada'], 404);
        }

        $location->delete();

        return response()->json(['message' => 'Ubicación eliminada exitosamente'], 200);
    }
}