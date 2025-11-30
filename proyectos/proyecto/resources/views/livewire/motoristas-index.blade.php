<div>
    {{-- The whole world belongs to you. --}}
    <h2>Motoristas</h2>

    <input type="text" wire:model="buscar" placeholder="Buscar...">

    <a href="{{ route('motoristas.create') }}">Nuevo Motorista</a>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($motoristas as $m)
                <tr>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->email }}</td>
                    <td>{{ $m->username }}</td>
                    <td>
                        <a href="{{ route('motoristas.edit', $m->id) }}">Editar</a>
                        <button wire:click="toggleEstado({{ $m->id }})">
                            {{ $m->estado ? 'Desactivar' : 'Activar' }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
