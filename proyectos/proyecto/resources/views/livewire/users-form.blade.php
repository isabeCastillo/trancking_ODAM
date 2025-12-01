<div>
    <h2>{{ $user && $user->exists ? 'Editar usuario' : 'Crear usuario' }}</h2>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form wire:submit.prevent="guardar">
        <div style="margin-bottom: 10px;">
            <label>Nombre *</label><br>
            <input type="text" wire:model="name">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Usuario (login) *</label><br>
            <input type="text" wire:model="username">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Correo</label><br>
            <input type="email" wire:model="email">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Rol *</label><br>
            <select wire:model="rol">
                <option value="admin">Admin</option>
                <option value="motorista">Motorista</option>
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label>
                Contraseña
                @if(!$user) (obligatoria) @else (dejar en blanco para no cambiar) @endif
            </label><br>
            <input type="password" wire:model="password">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Confirmar contraseña</label><br>
            <input type="password" wire:model="password_confirmation">
        </div>

        <div style="margin-top: 10px;">
            <button type="submit">
                {{ $user && $user->exists ? 'Actualizar usuario' : 'Guardar usuario' }}
            </button>

            <a href="{{ route('usuarios.index') }}" style="margin-left: 10px;">
                Cancelar
            </a>
        </div>
    </form>
</div>
