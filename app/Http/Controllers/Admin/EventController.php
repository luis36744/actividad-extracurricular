<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        // Aplica EventPolicy@manage a todos los métodos
        $this->authorizeResource(Event::class, 'event');
    }

    /** Listar todos los eventos */
    public function index()
    {
        $events = Event::orderBy('starts_at')->get();
        return view('admin.events.index', compact('events'));
    }

    /** Mostrar formulario de creación */
    public function create()
    {
        return view('admin.events.create');
    }

    /** Almacenar nuevo evento */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at'   => 'required|date',
        ]);

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Evento creado correctamente.');
    }

    /** Mostrar un evento (y sus inscritos y archivos) */
    public function show(Event $event)
    {
        $event->load('users', 'files.user');
        return view('admin.events.show', compact('event'));
    }

    /** Formulario para editar un evento */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /** Actualizar evento en BD */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at'   => 'required|date',
        ]);

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Evento actualizado correctamente.');
    }

    /** Eliminar evento (cascade borrará inscripciones y archivos) */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Evento eliminado correctamente.');
    }
}
