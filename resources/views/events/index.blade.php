cat > resources/views/events/index.blade.php << 'EOF'
@extends('layouts.app')

@section('title', 'Próximos eventos')

@section('content')
  <h1>Próximos eventos</h1>

  @if($events->isEmpty())
    <p>No hay eventos programados.</p>
  @else
    <ul>
      @foreach($events as $event)
        <li>
          <strong>{{ $event->title }}</strong>
          <span>({{ $event->starts_at->format('d/m/Y H:i') }})</span>
          <a href="{{ route('events.show', $event) }}">Ver detalle</a>
        </li>
      @endforeach
    </ul>
  @endif
@endsection
EOF
