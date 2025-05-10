<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

