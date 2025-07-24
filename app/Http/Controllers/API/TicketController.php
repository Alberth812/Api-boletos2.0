<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Listar todos los boletos
     */
    public function index()
    {
        return response()->json(Ticket::with(['ticketType', 'user', 'purchase'])->get());
    }

    /**
     * Crear un nuevo boleto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'user_id' => 'required|exists:users,id',
            'purchase_id' => 'required|exists:purchases,id',
            'seat_number' => 'nullable|string|max:10',
            'qr_code' => 'required|string|unique:tickets,qr_code|max:255',
            'is_used' => 'required|boolean',
            'is_cancelled' => 'required|boolean',
            'issued_at' => 'nullable|date',
        ]);

        $ticket = Ticket::create($validated);

        return response()->json([
            'message' => 'Boleto creado exitosamente',
            'ticket' => $ticket
        ], 201);
    }

    /**
     * Mostrar un boleto específico
     */
    public function show($id)
    {
        $ticket = Ticket::with(['ticketType', 'user', 'purchase'])->find($id);

        if (! $ticket) {
            return response()->json(['message' => 'Boleto no encontrado'], 404);
        }

        return response()->json($ticket);
    }

    /**
     * Actualizar un boleto
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if (! $ticket) {
            return response()->json(['message' => 'Boleto no encontrado'], 404);
        }

        $validated = $request->validate([
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'user_id' => 'required|exists:users,id',
            'purchase_id' => 'required|exists:purchases,id',
            'seat_number' => 'nullable|string|max:10',
            'qr_code' => 'required|string|max:255|unique:tickets,qr_code,' . $id,
            'is_used' => 'required|boolean',
            'is_cancelled' => 'required|boolean',
            'issued_at' => 'nullable|date',
        ]);

        $ticket->update($validated);

        return response()->json([
            'message' => 'Boleto actualizado exitosamente',
            'ticket' => $ticket
        ]);
    }

    /**
     * Eliminar un boleto
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (! $ticket) {
            return response()->json(['message' => 'Boleto no encontrado'], 404);
        }

        $ticket->delete();

        return response()->json(['message' => 'Boleto eliminado exitosamente'], 200);
    }
}