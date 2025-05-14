@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi perfil</h1>
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Créditos:</strong> {{ $user->credits ?? '0' }}</p>
    @if ($user->events->isEmpty())
        <p>No estás inscrito en ningún evento actualmente.</p>
    @else
        <ul class="list-disc pl-5 space-y-1">
            Estas inscrito en los siguientes eventos:
            @foreach ($user->events as $event)
                <li>
                    <strong>{{ $event->title }}</strong> -
                    {{ $event->starts_at->format('d/m/Y H:i') }}
                    <form action="{{ route('events.unsubscribe', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Desinscribirme</button>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection