<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TicketPackage;
use Illuminate\Http\Request;

class TicketPackageController extends Controller
{
    /**
     * Listar todos los paquetes de boletos
     */
    public function index()
    {
        return response()->json(TicketPackage::with('event')->get());
    }

    /**
     * Crear un nuevo paquete de boletos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'event_id' => 'required|exists:events,id',
            'max_tickets' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $package = TicketPackage::create($validated);

        return response()->json([
            'message' => 'Paquete de boletos creado exitosamente',
            'package' => $package
        ], 201);
    }

    /**
     * Mostrar un paquete específico
     */
    public function show($id)
    {
        $package = TicketPackage::with('event')->find($id);

        if (! $package) {
            return response()->json(['message' => 'Paquete no encontrado'], 404);
        }

        return response()->json($package);
    }

    /**
     * Actualizar un paquete de boletos
     */
    public function update(Request $request, $id)
    {
        $package = TicketPackage::find($id);

        if (! $package) {
            return response()->json(['message' => 'Paquete no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'event_id' => 'required|exists:events,id',
            'max_tickets' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $package->update($validated);

        return response()->json([
            'message' => 'Paquete de boletos actualizado exitosamente',
            'package' => $package
        ]);
    }

    /**
     * Eliminar un paquete de boletos
     */
    public function destroy($id)
    {
        $package = TicketPackage::find($id);

        if (! $package) {
            return response()->json(['message' => 'Paquete no encontrado'], 404);
        }

        $package->delete();

        return response()->json(['message' => 'Paquete de boletos eliminado exitosamente'], 200);
    }
}