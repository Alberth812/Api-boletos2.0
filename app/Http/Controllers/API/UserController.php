<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Listar todos los usuarios (solo admin)
     */
    public function index()
    {
        return response()->json(User::select('id', 'username', 'first_name', 'last_name', 'email', 'phone', 'birth_date', 'is_admin', 'is_active', 'created_at')->get());
    }

    /**
     * Crear un nuevo usuario (solo admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['is_admin'],
            'is_active' => $validated['is_active'],
        ]);

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user->only('id', 'username', 'first_name', 'last_name', 'email', 'is_admin', 'is_active')
        ], 201);
    }

    /**
     * Mostrar un usuario específico (solo admin)
     */
    public function show($id)
    {
        $user = User::select('id', 'username', 'first_name', 'last_name', 'email', 'phone', 'birth_date', 'is_admin', 'is_active', 'created_at')->find($id);

        if (! $user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    /**
     * Actualizar un usuario (solo admin)
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'is_admin' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'user' => $user->only('id', 'username', 'first_name', 'last_name', 'email', 'is_admin', 'is_active')
        ]);
    }

    /**
     * Eliminar un usuario (solo admin)
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // No eliminar al usuario actual si es el último admin
        if ($user->is_admin && User::where('is_admin', true)->count() === 1) {
            return response()->json(['message' => 'No puedes eliminar al último administrador'], 400);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
    }
}