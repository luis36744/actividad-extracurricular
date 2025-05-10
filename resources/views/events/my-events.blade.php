@extends('layouts.app')
@section('title','Mis eventos')
@section('content')
  <h1 class="text-2xl mb-4">Mis eventos</h1>

  @if($events->isEmpty())
    <p>No tienes eventos inscritos.</p>
  @else
    <ul class="space-y-2">
      @foreach($events as $e)
        <li class="p-3 bg-white shadow rounded">
          {{ $e->title }} —
          <span class="text-gray-600">{{ $e->starts_at->format('d/m/Y H:i') }}</span>
        </li>
      @endforeach
    </ul>
  @endif
@endsection
