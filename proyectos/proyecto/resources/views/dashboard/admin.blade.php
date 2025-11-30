<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>

    {{-- Livewire Styles --}}
    @livewireStyles
</head>
<body>
    <h1>Panel de administrador</h1>

    <p>Hola, {{ auth()->user()->name }} (rol: {{ auth()->user()->rol }})</p>

    <p>
        <a href="{{ route('envios.index') }}"> Gestionar envíos</a>
    </p>
    <p>
        <a href="{{ route('motoristas.index') }}"> Gestionar motoritas</a>
    </p>
    <p>
        <a href="{{ route('vehiculos.index') }}"> Gestionar vehiculos</a>
    </p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>

    {{-- Livewire Scripts --}}
    @livewireScripts
</body>
</html>
