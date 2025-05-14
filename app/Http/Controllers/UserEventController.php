<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class UserEventController extends Controller
{
    public function index()
    {
    $events = auth()->user()
                    ->events()
                    ->orderBy('starts_at')
                    ->get();

    return view('events.my-events',compact('events'));
    }
    public function store(Event $event)
    {
    $user = auth()->user();

    // Evitar inscripción duplicada
    if ($user->events()->where('event_id', $event->id)->exists()) {
        return redirect()->back()->with('error', 'Ya estás inscrito en este evento.');
    }

    // Inscribir
    $user->events()->attach($event->id);

    // Enviar correo
    \Mail::to($user->email)->send(new \App\Mail\InscripcionEvento($event));

    return redirect()->back()->with('status', 'Inscripción exitosa.');
    }

    public function uploadFile(Request $request, Event $event)
    {
    $request->validate([
        'file' => 'required|file|max:2048',
    ]);

    $user = auth()->user();

    // Verificar que está inscrito
    if (!$user->events->contains($event)) {
        abort(403, 'No puedes subir archivos a un evento al que no estás inscrito.');
    }

    $uploadedFile = $request->file('file');
    $path = $uploadedFile->store('evidencias');

    \App\Models\File::create([
        'user_id' => $user->id,
        'event_id' => $event->id,
        'original_name' => $uploadedFile->getClientOriginalName(),
        'path' => $path,
    ]);

    return redirect()->back()->with('status', 'Archivo subido correctamente.');
    }

    public function destroyFile(Event $event, \App\Models\File $file)
    {
        $user = auth()->user();

        if ($file->user_id !== $user->id) {
            abort(403, 'Solo puedes eliminar tus propios archivos.');
        }

        \Storage::delete($file->path);
        $file->delete();

        return redirect()->back()->with('status', 'Archivo eliminado.');
    }

    public function unsubscribe(Event $event)
    {
        $user = auth()->user();

        // Verificar que esté inscrito
        if (!$user->events->contains($event)) {
            return redirect()->back()->with('error', 'No estás inscrito a este evento.');
        }

        $user->events()->detach($event->id);

        return redirect()->back()->with('status', 'Te has desuscrito del evento.');
    }

}

