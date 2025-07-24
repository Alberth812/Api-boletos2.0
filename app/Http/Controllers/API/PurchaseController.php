<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Listar todas las compras
     */
    public function index()
    {
        return response()->json(Purchase::with('user', 'tickets')->get());
    }

    /**
     * Crear una nueva compra
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:credit_card,paypal,oxxo',
            'payment_status' => 'required|string|in:completed,pending,refunded',
            'transaction_id' => 'required|string|unique:purchases,transaction_id|max:100',
        ]);

        $purchase = Purchase::create($validated);

        return response()->json([
            'message' => 'Compra creada exitosamente',
            'purchase' => $purchase
        ], 201);
    }

    /**
     * Mostrar una compra específica
     */
    public function show($id)
    {
        $purchase = Purchase::with(['user', 'tickets', 'discounts'])->find($id);

        if (! $purchase) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        return response()->json($purchase);
    }

    /**
     * Actualizar una compra
     */
    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);

        if (! $purchase) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:credit_card,paypal,oxxo',
            'payment_status' => 'required|string|in:completed,pending,refunded',
            'transaction_id' => 'required|string|max:100|unique:purchases,transaction_id,' . $id,
        ]);

        $purchase->update($validated);

        return response()->json([
            'message' => 'Compra actualizada exitosamente',
            'purchase' => $purchase
        ]);
    }

    /**
     * Eliminar una compra
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);

        if (! $purchase) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        $purchase->delete();

        return response()->json(['message' => 'Compra eliminada exitosamente'], 200);
    }
}