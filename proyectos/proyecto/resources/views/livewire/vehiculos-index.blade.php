<div>
    {{-- Be like water. --}}

    <h2>Vehículos</h2>

    <input type="text" wire:model="buscar" placeholder="Buscar...">

    <a href="{{ route('vehiculos.create') }}">Nuevo Vehículo</a>

    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Capacidad</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($vehiculos as $v)
                <tr>
                    <td>{{ $v->placa }}</td>
                    <td>{{ $v->marca }}</td>
                    <td>{{ $v->modelo }}</td>
                    <td>{{ $v->color }}</td>
                    <td>{{ $v->capacidad }}</td>
                    <td>{{ $v->tipo }}</td>
                    <td>{{ $v->estado }}</td>
                    <td>
                        <a href="{{ route('vehiculos.edit', $v->id) }}">Editar</a>
                        <button wire:click="eliminar({{ $v->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
