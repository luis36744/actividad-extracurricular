cat > events/show.blade.php << 'EOF'
@extends('layouts.app')

@section('title', $event->title)

@section('content')
  <h1>{{ $event->title }}</h1>
  <p>{{ $event->description }}</p>
  <p>Fecha: {{ $event->starts_at->format('d/m/Y H:i') }}</p>

  @auth
    @unless($subscribed)
      <form action="{{ route('events.subscribe', $event) }}" method="POST">
        @csrf
        <button>Inscribirme</button>
      </form>
    @else
      <p>Ya estás inscrito.</p>
      <form method="POST" enctype="multipart/form-data" action="{{ route('events.files.upload', $event) }}">
        @csrf
        <input type="file" name="file" required>
        <button>Subir evidencia</button>
      </form>

      <h4>Mis archivos</h4>
      <ul>
        @foreach($files as $file)
          <li>
            <a href="{{ Storage::url($file->path) }}">{{ $file->original_name }}</a>
            <form method="POST" action="{{ route('files.destroy',$file) }}" style="display:inline">
              @csrf @method('DELETE')
              <button>Borrar</button>
            </form>
          </li>
        @endforeach
      </ul>
    @endunless
  @else
    <p><a href="{{ route('login') }}">Inicia sesión</a> para inscribirte.</p>
  @endauth
@endsection
EOF
