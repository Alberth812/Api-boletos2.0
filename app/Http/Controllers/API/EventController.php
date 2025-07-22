<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Listar todos los eventos con relaciones.
     */
    public function index()
    {
        return response()->json(
            Event::with(['location', 'artists', 'ticketTypes'])->get()
        );
    }

    /**
     * Mostrar un evento específico.
     */
    public function show($id)
    {
        return response()->json(
            Event::with(['location', 'artists', 'ticketTypes', 'packages'])->findOrFail($id)
        );
    }
}