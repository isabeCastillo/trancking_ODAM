<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Motorista</title>
</head>
<body>
    <h1>Panel de motorista</h1>

    <p>Hola, {{ auth()->user()->name }} (rol: {{ auth()->user()->rol }})</p>

    @if(auth()->user()->rol === 'motorista')
    <h3>Vehículo asignado:</h3>

    @if(auth()->user()->vehiculo)
        <p>
            {{ auth()->user()->vehiculo->placa }}
            – {{ auth()->user()->vehiculo->marca }}
            {{ auth()->user()->vehiculo->modelo }}
            ({{ auth()->user()->vehiculo->estado }})
        </p>
    @else
        <p>No tienes un vehículo asignado.</p>
    @endif
@endif


    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>