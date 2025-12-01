<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tracking ODAM</title>

    {{-- Estilos de Livewire --}}
    @livewireStyles
</head>
<body>
    <header>
        <h1>Tracking ODAM</h1>
    </header>

    <main>
        {{ $slot }}
    </main>

    <script src="{{ asset('vendor/livewire/livewire.js') }}"
            data-csrf="{{ csrf_token() }}"
            data-update-uri="/proyecto/public/livewire/update"
            data-navigate-once="true"></script>

</body>
</html>