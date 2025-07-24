<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Listar todos los eventos
     */
    public function index()
    {
        return response()->json(Event::with(['location', 'artists', 'ticketTypes'])->get());
    }

    /**
     * Crear un nuevo evento
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location_id' => 'required|exists:locations,id',
            'status' => 'required|string|in:scheduled,completed,cancelled',
            'venue_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        $event = Event::create($validated);

        return response()->json([
            'message' => 'Evento creado exitosamente',
            'event' => $event
        ], 201);
    }

    /**
     * Mostrar un evento específico
     */
    public function show($id)
    {
        $event = Event::with(['location', 'artists', 'ticketTypes', 'packages'])->find($id);

        if (! $event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        return response()->json($event);
    }

    /**
     * Actualizar un evento
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (! $event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location_id' => 'required|exists:locations,id',
            'status' => 'required|string|in:scheduled,completed,cancelled',
            'venue_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        $event->update($validated);

        return response()->json([
            'message' => 'Evento actualizado exitosamente',
            'event' => $event
        ]);
    }

    /**
     * Eliminar un evento
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if (! $event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Evento eliminado exitosamente'], 200);
    }
}