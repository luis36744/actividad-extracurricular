@extends('layouts.app')

@section('title','Próximos eventos')

@section('content')
  <h1 class="text-2xl mb-4">Próximos eventos</h1>

  @if($events->isEmpty())
    <p>No hay eventos programados.</p>
  @else
    <ul class="space-y-2">
      @foreach($events as $event)
        <li class="p-4 bg-white shadow rounded flex justify-between">
          <div>
            <strong>{{ $event->title }}</strong><br>
            <small class="text-gray-600">{{ $event->starts_at->format('d/m/Y H:i') }}</small>
          </div>
          <a href="{{ route('events.show',$event) }}"
             class="self-center px-3 py-1 bg-blue-500 text-white rounded">
            Ver detalle
          </a>
        </li>
      @endforeach
    </ul>
  @endif
@endsection
