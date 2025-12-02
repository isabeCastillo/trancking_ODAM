{{-- resources/views/livewire/admin/dashboard.blade.php --}}
<x-layouts.admin>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <h2>{{ $vehiculo ? 'Editar Vehículo' : 'Nuevo Vehículo' }}</h2>
    @if (session('error'))
    <div style="color:red;">
        {{ session('error') }}
    </div>
    @endif

    <form wire:submit.prevent="save">

        <label>Placa</label>
        <input type="text" wire:model="placa">

        <label>Marca</label>
        <input type="text" wire:model="marca">

        <label>Modelo</label>
        <input type="text" wire:model="modelo">

        <label>Color</label>
        <input type="text" wire:model="color">

        <label>Capacidad</label>
        <input type="number" wire:model="capacidad">

        <label>Tipo</label>
        <input type="text" wire:model="tipo">

        <label>Estado</label>
        <select wire:model="estado">
            <option>Disponible</option>
            <option>Mantenimiento</option>
        </select>
    
        <label>Motorista asignado</label>
        <select wire:model="user_id">
            <option value="">Sin motorista</option>

        @foreach($motoristas as $m)
            <option value="{{ $m->id }}">
            {{ $m->name }}
            </option>
        @endforeach
       </select>


        <button type="submit">Guardar</button>
    </form>
</x-layouts.admin>
