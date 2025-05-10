@extends('layouts.app')

@section('title','Bienvenido')

@section('content')
  <div class="text-center py-12">
    <h1 class="text-5xl font-bold mb-6">Actividad Extracurricular</h1>
    <p class="mb-8">Registro de eventos a los que asiste un alumno.</p>

    <a href="{{ route('events.index') }}"
       class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Ver eventos
    </a>
  </div>
@endsection
