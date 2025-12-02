<div>
    <x-layouts.motorista>
    <h1>Seguimiento de envíos</h1>

    <div>
        <input type="text" wire:model="codigo" placeholder="Ingresa tu código de tracking">
        <button wire:click="buscar">Buscar</button>
    </div>

    @if($mensaje)
        <p style="color:red;">{{ $mensaje }}</p>
    @endif

    @if($envio)
        <h2>Información del envío</h2>

        <p><strong>Remitente:</strong>
            {{ $envio->remitente_nombre }},
            {{ $envio->remitente_telefono }},
            {{ $envio->remitente_direccion }}
        </p>

        <p><strong>Destinatario:</strong>
            {{ $envio->destinatario_nombre }},
            {{ $envio->destinatario_telefono }},
            {{ $envio->destinatario_direccion }}
        </p>

        <p><strong>Tipo de envío:</strong> {{ $envio->tipo_envio }}</p>
        <p><strong>Peso:</strong> {{ $envio->peso ?? 'N/A' }}</p>
        <p><strong>Fecha estimada:</strong> {{ $envio->fecha_estimada }}</p>

        <h3>Estado:
            @if($envio->estado == 'pendiente')
                <span style="color:orange;">Pendiente</span>
            @elseif($envio->estado == 'en ruta')
                <span style="color:blue;">En Ruta</span>
            @elseif($envio->estado == 'entregado')
                <span style="color:green;">Entregado</span>
            @else
                {{ $envio->estado }}
            @endif
        </h3>
    @endif
    </x-layouts.motorista>
</div>
