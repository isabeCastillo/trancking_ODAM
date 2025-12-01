<div class="vehiculos-container">
    
<style>
    .vehiculos-container {
        background: #E7EFEC;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        font-family: 'Quicksand', sans-serif;
    }

    .vehiculos-title {
        color: #343B3E;
        font-size: 28px;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .vehiculos-input {
        padding: 10px 15px;
        border: 2px solid #A5E7F1;
        border-radius: 8px;
        margin-bottom: 15px;
        width: 60%;
        font-size: 15px;
        outline: none;
        transition: .3s;
    }

    .vehiculos-input:focus {
        border-color: #343B3E;
        box-shadow: 0 0 6px #A5E7F1;
    }

    .vehiculos-btn-primary {
        background: #B61B2E;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: .3s;
    }

    .vehiculos-btn-primary:hover {
        background: #621D25;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    thead {
        background: #A5E7F1;
    }

    thead th {
        padding: 12px;
        color: #343B3E;
        font-size: 16px;
        font-weight: 700;
        text-align: left;
    }

    tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid #E7EFEC;
        color: #343B3E;
    }

    tbody tr:hover {
        background: #F4FAFB;
    }

    .btn-edit {
        color: #343B3E;
        font-weight: 600;
        margin-right: 10px;
        text-decoration: none;
    }

    .btn-edit:hover {
        color: #621D25;
    }

    .btn-delete {
        background: #B61B2E;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: .3s;
    }

    .btn-delete:hover {
        background: #621D25;
    }
</style>

    {{-- Be like water. --}}

    <h2 class="vehiculos-title">Vehículos</h2>

    <input type="text" wire:model="buscar" class="vehiculos-input" placeholder="Buscar...">

    <a href="{{ route('vehiculos.create') }}" class="vehiculos-btn-primary">Nuevo Vehículo</a>

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
                <th>Motorista Asignado</th>
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
                    <td>{{ $v->motorista?->name ?? 'Sin motorista' }}</td>
                    <td>
                        <a href="{{ route('vehiculos.edit', $v->id) }}" class="btn-edit">Editar</a>
                        <button wire:click="eliminar({{ $v->id }})" class="btn-delete">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

