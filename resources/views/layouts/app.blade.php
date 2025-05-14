<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>@yield('title','Actividad Extracurricular')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

  <nav class="bg-white shadow-sm p-4 flex justify-between">
    <a href="{{ route('events.index') }}" class="font-semibold">Eventos</a>
    @if (!Route::is('perfil'))
      <a href="{{ route('perfil') }}" class="font-semibold">Mi perfil</a>
    @else
      <a href="{{ route('home') }}" class="font-semibold">Inicio</a>
    @endif
    
    <div class="space-x-4">
      @guest
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{ route('register') }}">Registrarse</a>
      @else
        <span>Hola, {{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit">Cerrar sesión</button>
        </form>
      @endguest
    </div>
  </nav>

  <main class="p-6">
    @if(session('status'))
      <div class="mb-4 p-2 bg-green-100">{{ session('status') }}</div>
    @endif

    @yield('content')
  </main>
</body>
</html>
