<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class EventoController extends Controller
{
    public function __construct()
    {
        // Aplica EventPolicy@manage a todas las acciones
        $this->authorizeResource(Event::class, 'event');
    }

    public function index()
    {
        $events = Event::orderBy('starts_at')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at'   => 'required|date',
        ]);

        Event::create($data);

        return redirect()
            ->route('events.index')
            ->with('status','Evento creado correctamente.');
    }

    public function show(Event $event)
    {
        $event->load('users','files.user');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at'   => 'required|date',
        ]);

        $event->update($data);

        return redirect()
            ->route('events.index')
            ->with('status','Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('status','Evento eliminado correctamente.');
    }
    public function subscribe(Request $request, Event $event)
{
        $user = auth()->user();

        // Aquí deberías tener una relación many-to-many (por ejemplo, evento_user)
        $event->users()->attach($user->id);

        return redirect()->back()->with('success', 'Te has suscrito al evento.');
}
}
