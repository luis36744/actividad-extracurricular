@extends('layouts.app')

@section('title', $event->title)

@section('content')
  <h1 class="text-2xl font-bold mb-2">{{ $event->title }}</h1>
  <p class="mb-4">{{ $event->description }}</p>
  <p class="mb-6 text-gray-600">
    Fecha: {{ $event->starts_at->format('d/m/Y H:i') }}
  </p>

  @auth
    {{-- Si puede suscribirse (es alumno y no está inscrito) --}}
    @can('subscribe', $event)
      <form action="{{ route('events.subscribe', $event) }}" method="POST" class="mb-4">
        @csrf
        <button type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
          Inscribirme
        </button>
      </form>
    @else
      {{-- Si ya está inscrito, muestra upload y archivos --}}
      <p class="mb-4 text-green-700">Ya estás inscrito a este evento.</p>

      <form method="POST"
            enctype="multipart/form-data"
            action="{{ route('events.files.upload', $event) }}"
            class="mb-4">
        @csrf
        <input type="file" name="file" required class="border p-1">
        <button type="submit"
                class="ml-2 px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
          Subir evidencia
        </button>
      </form>

      <h4 class="font-semibold mb-2">Mis evidencias</h4>
      <ul class="space-y-2">
        @foreach($files as $file)
          <li class="flex justify-between bg-white p-2 shadow rounded">
            <a href="{{ Storage::url($file->path) }}"
               class="underline text-blue-600">
              {{ $file->original_name }}
            </a>
            @can('delete', $file)
              <form method="POST"
                    action="{{ route('files.destroy', $file) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-red-600 hover:underline">
                  Borrar
                </button>
              </form>
            @endcan
          </li>
        @endforeach
      </ul>
    @endcan
  @else
    <p class="text-center">
      <a href="{{ route('login') }}" class="underline">Inicia sesión</a>
      para inscribirte y subir evidencias.
    </p>
  @endauth
@endsection
EOF
