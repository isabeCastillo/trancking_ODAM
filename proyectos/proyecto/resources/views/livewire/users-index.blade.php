<div>
    <h2>Gestión de usuarios (admins y motoristas)</h2>

    @if (session('message'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('message') }}
        </div>
    @endif

    {{-- Filtros --}}
    <div style="margin-bottom: 15px; display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar por nombre, usuario o correo"
        >

        <select wire:model.live="rol">
            <option value="">Todos los roles</option>
            <option value="admin">Admin</option>
            <option value="motorista">Motorista</option>
        </select>

        <a href="{{ route('usuarios.create') }}">+ Crear usuario</a>
    </div>

    {{-- Tabla --}}
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->rol }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $user) }}">Editar</a>
                        @if(auth()->id() !== $user->id)
                            <button
                                type="button"
                                wire:click="eliminar({{ $user->id }})"
                                onclick="return confirm('¿Seguro que deseas eliminar este usuario?')"
                            >
                                Eliminar
                            </button>
                        @else
                            <em>(Tú)</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        {{ $usuarios->links() }}
    </div>
</div>
