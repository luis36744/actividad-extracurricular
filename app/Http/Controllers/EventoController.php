<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\EventSubscription;

class EventoController extends Controller
{
    public function index()
    {
        $events = Event::where('starts_at', '>=', now())->orderBy('starts_at')->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $user = auth()->user();
        $subscribed = $user ? $user->events->contains($event->id) : false;
        $files = $user
            ? $event->files()->where('user_id', $user->id)->get()
            : collect();
        return view('events.show', compact('event','subscribed','files'));
    }

    public function subscribe(Event $event)
    {
        $user = auth()->user();
        if (!$user->events->contains($event->id)) {
            $user->events()->attach($event->id);
            Mail::to($user->email)->send(new EventSubscription($event));
        }
        return back();
    }

    public function uploadFile(Request $request, Event $event)
    {
        $request->validate([
            'file' => 'required|file|max:5120',
        ]);

        $path = $request->file('file')->store('event_files');
        File::create([
            'user_id'       => auth()->id(),
            'event_id'      => $event->id,
            'original_name' => $request->file('file')->getClientOriginalName(),
            'path'          => $path,
        ]);

        return back();
    }

    public function destroyFile(File $file)
    {
        $this->authorize('delete', $file);
        Storage::delete($file->path);
        $file->delete();
        return back();
    }
}
