<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tracking ODAM - Acceso</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    {{-- Estilos de Livewire --}}
    @livewireStyles
</head>
<body style="margin:0; padding:0; background:#edf1f4; min-height:100vh;">

    {{ $slot }}

    {{-- Scripts de Livewire - FORZANDO la URL correcta --}}
    <script
        src="{{ asset('vendor/livewire/livewire.js') }}"
        data-csrf="{{ csrf_token() }}"
        data-update-uri="/proyecto/public/livewire/update"
        data-navigate-once="true">
    </script>

</body>
</html>
