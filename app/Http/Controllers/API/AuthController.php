<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Inicio de sesión (login)
     */
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:1',
        ]);

        // Intentar autenticar al usuario
        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas.'],
            ]);
        }

        // Obtener el usuario autenticado
        $user = User::where('email', $request->email)->first();

        // Asegurarse de que el usuario esté activo
        if (! $user->is_active) {
            return response()->json([
                'message' => 'Tu cuenta está inactiva. Contacta al administrador.'
            ], 403);
        }

        // Generar token de acceso (Sanctum)
        $token = $user->createToken('auth-token')->plainTextToken;

        // Devolver respuesta JSON
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
                'is_active' => $user->is_active,
            ]
        ], 200);
    }

    /**
     * Cerrar sesión (logout)
     */
    public function logout(Request $request)
    {
        // Revocar el token actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Cierre de sesión exitoso'
        ], 200);
    }

    /**
     * Obtener información del usuario autenticado
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}