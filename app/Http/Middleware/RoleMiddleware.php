<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        // Si no está autenticado
        if (! $user) {
            return response()->json([
                'message' => 'No autenticado. Inicia sesión para continuar.'
            ], 401);
        }

        // Si no se especificaron roles, denegar acceso
        if (empty($roles)) {
            return response()->json([
                'message' => 'No se especificaron roles permitidos.'
            ], 500);
        }

        // Convertir roles a booleanos (true = admin, false = usuario)
        $allowedRoles = array_map('boolval', $roles);

        // Verificar si el rol del usuario está permitido
        if (! in_array($user->is_admin, $allowedRoles)) {
            return response()->json([
                'message' => 'No tienes permiso para realizar esta acción. Requiere rol administrador.'
            ], 403);
        }

        return $next($request);
    }
}