<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Motorista</title>
</head>
<body>
    <h1>Panel de motorista</h1>

    <p>Hola, {{ auth()->user()->name }} (rol: {{ auth()->user()->rol }})</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>