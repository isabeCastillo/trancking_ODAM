<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Tracking ODAM' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    {{-- Estilos de Livewire --}}
    @livewireStyles
</head>

<body style="margin:0; padding:0; background:#F3F4F6;">

    {{ $slot }}

    {{-- Scripts de Livewire --}}
    <script src="{{ asset('vendor/livewire/livewire.js') }}"
            data-csrf="{{ csrf_token() }}"
            data-update-uri="/proyecto/public/livewire/update"
            data-navigate-once="true"></script>

</body>
</html>
