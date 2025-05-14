<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscripción confirmada</title>
</head>
<body>
    <h1>¡Hola!</h1>
    <p>Te has inscrito correctamente al evento:</p>

    <ul>
        <li><strong>Título:</strong> {{ $event->title }}</li>
        <li><strong>Fecha:</strong> {{ $event->starts_at->format('d/m/Y H:i') }}</li>
    </ul>

    <p>¡Nos vemos pronto!</p>
</body>
</html>
