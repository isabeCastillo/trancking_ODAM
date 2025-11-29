<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>

    @if ($errors->any())
        <div style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div>
            <label for="username">Usuario</label><br>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
        </div>

        <div style="margin-top: 10px;">
            <label for="password">Contraseña</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" style="margin-top: 15px;">
            Entrar
        </button>
    </form>
</body>
</html>