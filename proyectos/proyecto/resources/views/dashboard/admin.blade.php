<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
</head>
<body>
    <h1>Panel de administrador</h1>

    <p>Hola, {{ auth()->user()->name }} (rol: {{ auth()->user()->rol }})</p>

    
    <p>
        <a href="{{ route('envios.index') }}"> Gestionar envíos</a>
    </p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
    
</body>
</html>
