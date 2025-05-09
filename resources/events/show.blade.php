@extends('layouts.app')

@section('title', $event->title)

@section('content')
  <h1>{{ $event->title }}</h1>
  <p>{{ $event->description }}</p>
  <p>Fecha: {{ $event->starts_at->format('d/m/Y H:i') }}</p>

  @auth
    @if(! $subscribed)
      <form action="{{ route('events.subscribe', $event) }}" method="POST">
        @csrf
        <button>Inscribirme</button>
      </form>
    @else
      <p>Ya estás inscrito.</p>
      {{-- Aquí iría el formulario de carga de archivos --}}
    @endif
  @else
    <p><a href="{{ route('login') }}">Inicia sesión</a> para inscribirte.</p>
  @endauth
@endsection
