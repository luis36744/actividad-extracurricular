<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Actividad Extracurricular')</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
  <nav>
    <a href="{{ route('events.index') }}">Eventos</a>
    @guest
      <a href="{{ route('login') }}">Iniciar sesión</a>
      <a href="{{ route('register') }}">Registrarse</a>
    @else
      <span>Hola, {{ auth()->user()->name }}</span>
      <form method="POST" action="{{ route('logout') }}">@csrf<button>Cerrar sesión</button></form>
    @endguest
  </nav>

  <main class="container">
    @if(session('status'))
      <div class="alert">{{ session('status') }}</div>
    @endif

    @yield('content')
  </main>

  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
