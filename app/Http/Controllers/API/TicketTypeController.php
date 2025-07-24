<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Listar todos los tipos de boleto
     */
    public function index()
    {
        return response()->json(TicketType::with('event')->get());
    }

    /**
     * Crear un nuevo tipo de boleto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'section' => 'nullable|string|max:50',
            'is_vip' => 'required|boolean',
            'is_seat' => 'required|boolean',
            'door_number' => 'nullable|integer|min:1|max:10',
            'capacity' => 'required|integer|min:1',
            'available_tickets' => 'required|integer|min:0|max:capacity',
        ]);

        $ticketType = TicketType::create($validated);

        return response()->json([
            'message' => 'Tipo de boleto creado exitosamente',
            'ticket_type' => $ticketType
        ], 201);
    }

    /**
     * Mostrar un tipo de boleto específico
     */
    public function show($id)
    {
        $ticketType = TicketType::with('event')->find($id);

        if (! $ticketType) {
            return response()->json(['message' => 'Tipo de boleto no encontrado'], 404);
        }

        return response()->json($ticketType);
    }

    /**
     * Actualizar un tipo de boleto
     */
    public function update(Request $request, $id)
    {
        $ticketType = TicketType::find($id);

        if (! $ticketType) {
            return response()->json(['message' => 'Tipo de boleto no encontrado'], 404);
        }

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'section' => 'nullable|string|max:50',
            'is_vip' => 'required|boolean',
            'is_seat' => 'required|boolean',
            'door_number' => 'nullable|integer|min:1|max:10',
            'capacity' => 'required|integer|min:1',
            'available_tickets' => 'required|integer|min:0|max:capacity',
        ]);

        $ticketType->update($validated);

        return response()->json([
            'message' => 'Tipo de boleto actualizado exitosamente',
            'ticket_type' => $ticketType
        ]);
    }

    /**
     * Eliminar un tipo de boleto
     */
    public function destroy($id)
    {
        $ticketType = TicketType::find($id);

        if (! $ticketType) {
            return response()->json(['message' => 'Tipo de boleto no encontrado'], 404);
        }

        $ticketType->delete();

        return response()->json(['message' => 'Tipo de boleto eliminado exitosamente'], 200);
    }
}