<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
  <h2>Listado de Envíos</h2>

    @if (session('message'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('message') }}
        </div>
    @endif

   
    <div style="margin-bottom: 15px; display:flex; gap:10px; flex-wrap:wrap;">
       
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar tracking, remitente, destinatario"
        >

       
        <select wire:model.live="estado">
            <option value="">Todos los estados</option>
            <option value="pendiente">Pendiente</option>
            <option value="en_transito">En tránsito</option>
            <option value="entregado">Entregado</option>
            <option value="cancelado">Cancelado</option>
        </select>

       
        <select wire:model.live="motoristaId">
            <option value="">Todos los motoristas</option>
            @foreach($motoristas as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
            @endforeach
        </select>

        <a href="{{ route('envios.create') }}">+ Crear envío</a>
    </div>

   
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Código</th>
                <th>Remitente</th>
                <th>Destinatario</th>
                <th>Estado</th>
                <th>Motorista</th>
                <th>Vehículo</th>
                <th>Fecha estimada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($envios as $envio)
                <tr>
                    <td>{{ $envio->codigo_tracking }}</td>
                    <td>{{ $envio->remitente_nombre }}</td>
                    <td>{{ $envio->destinatario_nombre }}</td>
                    <td>{{ $envio->estado }}</td>
                    <td>{{ optional($envio->motorista)->name ?? 'No asignado' }}</td>
                    <td>{{ $envio->vehiculo->placa ?? 'Sin asignar' }}</td>
                    <td>{{ $envio->fecha_estimada }}</td>
                    <td>
                        <a href="{{ route('envios.edit', $envio) }}">Editar</a>
                        <button
                            type="button"
                            wire:click="eliminar({{ $envio->id }})"
                            onclick="return confirm('¿Seguro que deseas eliminar este envío?')"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay envíos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div style="margin-top: 10px;">
        {{ $envios->links() }}
    </div>
</div>
