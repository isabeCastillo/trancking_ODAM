<div>
    <div>
    <h2>Mis Envíos</h2>

    @if (session('mensaje'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('mensaje') }}
        </div>
    @endif

    <table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Destinatario</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th>Acción</th>
            <th>Historial</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($envios as $e)
            <tr>
                <td>{{ $e->codigo_tracking }}</td>
                <td>{{ $e->destinatario_nombre }}</td>
                <td>{{ $e->destinatario_direccion }}</td>
                <td>{{ $e->estado }}</td>
                <td>
                    <button wire:click="seleccionarEnvio({{ $e->id }})">
                        Actualizar
                    </button>
                </td>
                <td>
                    <a href="{{ route('motorista.envios.historial', $e->id) }}">
                        Ver historial
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    {{-- FORMULARIO DE ACTUALIZACIÓN --}}
    @if ($selectedEnvio)
        <h3>Actualizar Envío: {{ $selectedEnvio->codigo_tracking }}</h3>

        <div style="margin-top: 20px;">
            <label>Nuevo estado:</label>
            <select wire:model="estado">
                <option value="pendiente">Pendiente</option>
                <option value="en ruta">En Ruta</option>
                <option value="entregado">Entregado</option>
            </select>
        </div>

        <div style="margin-top: 20px;">
            <label>Comentario (opcional):</label>
            <textarea wire:model="comentario"></textarea>
        </div>

        <div style="margin-top: 20px;">
            <label>Foto (evidencia):</label>
            <input type="file" wire:model="foto">
        </div>

        <button wire:click="actualizar" style="margin-top: 20px;">
            Guardar cambios
        </button>
    @endif
</div>
</div>