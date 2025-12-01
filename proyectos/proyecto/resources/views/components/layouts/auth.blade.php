<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tracking ODAM - Acceso</title>
    <link rel="icon" href="" type="image/png">

    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body style="margin:0; padding:0; background:#edf1f4; min-height:100vh;">

    {{-- Login se renderiza aquí --}}
    {{ $slot }}

    {{-- Livewire Scripts --}}
    <script src="{{ asset('vendor/livewire/livewire.js') }}"
            data-csrf="{{ csrf_token() }}"
            data-update-uri="/proyecto/public/livewire/update"
            data-navigate-once="true"></script>

</body>
</html>
