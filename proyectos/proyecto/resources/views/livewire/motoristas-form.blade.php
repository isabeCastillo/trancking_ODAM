<div>
    {{-- Stop trying to control. --}}
    <h2>{{ $user ? 'Editar Motorista' : 'Nuevo Motorista' }}</h2>

    <form wire:submit.prevent="save">

        <label>Nombre</label>
        <input type="text" wire:model="name">

        <label>Email</label>
        <input type="email" wire:model="email">

        <label>Usuario</label>
        <input type="text" wire:model="username">

        <label>Contraseña</label>
        <input type="password" wire:model="password">

        <button type="submit">Guardar</button>
    </form>
</div>
