<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Listar todos los descuentos
     */
    public function index()
    {
        return response()->json(Discount::all());
    }

    /**
     * Crear un nuevo descuento
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:discounts,code|max:50',
            'description' => 'nullable|string',
            'discount_type' => 'required|string|in:percentage,fixed',
            'percentage' => 'nullable|numeric|min:1|max:100',
            'fixed_amount' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after:valid_from',
            'max_uses' => 'required|integer|min:1',
            'used_count' => 'required|integer|min:0|max:max_uses',
            'is_active' => 'required|boolean',
        ]);

        $discount = Discount::create($validated);

        return response()->json([
            'message' => 'Descuento creado exitosamente',
            'discount' => $discount
        ], 201);
    }

    /**
     * Mostrar un descuento específico
     */
    public function show($id)
    {
        $discount = Discount::find($id);

        if (! $discount) {
            return response()->json(['message' => 'Descuento no encontrado'], 404);
        }

        return response()->json($discount);
    }

    /**
     * Actualizar un descuento
     */
    public function update(Request $request, $id)
    {
        $discount = Discount::find($id);

        if (! $discount) {
            return response()->json(['message' => 'Descuento no encontrado'], 404);
        }

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:discounts,code,' . $id,
            'description' => 'nullable|string',
            'discount_type' => 'required|string|in:percentage,fixed',
            'percentage' => 'nullable|numeric|min:1|max:100',
            'fixed_amount' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after:valid_from',
            'max_uses' => 'required|integer|min:1',
            'used_count' => 'required|integer|min:0|max:max_uses',
            'is_active' => 'required|boolean',
        ]);

        $discount->update($validated);

        return response()->json([
            'message' => 'Descuento actualizado exitosamente',
            'discount' => $discount
        ]);
    }

    /**
     * Eliminar un descuento
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);

        if (! $discount) {
            return response()->json(['message' => 'Descuento no encontrado'], 404);
        }

        $discount->delete();

        return response()->json(['message' => 'Descuento eliminado exitosamente'], 200);
    }
}