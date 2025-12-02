<div>
    {{-- resources/views/livewire/admin/listado-envios.blade.php --}}
<x-layouts.admin>
    <style>
        :root {
            --color-primary: #B91C1C;
            --color-primary-dark: #991B1B;
            --color-bg-light: #F9FAFB;
            --color-text-dark: #374151;
            --color-text-subtle: #6B7280;
            --color-border: #E5E7EB;
            --color-success: #10B981;
            --color-danger: #EF4444;
            --color-envio-pendiente: #F59E0B; 
            --color-envio-transito: #3B82F6;  
            --color-envio-entregado: #10B981; 
            --color-envio-cancelado: #EF4444; 
        }

       
        .shipment-management-container {
            padding: 20px 30px;
            background-color: var(--color-bg-light);
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .title-header {
            font-size: 26px;
            font-weight: 700;
            color: var(--color-text-dark);
            margin-bottom: 30px;
        }

        .card-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

      
        .alert-success {
            background-color: #D1FAE5;
            color: var(--color-success);
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #A7F3D0;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 14px;
        }

       
        .filter-actions {
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        .filter-controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-actions input,
        .filter-actions select {
            padding: 9px 12px;
            border-radius: 6px;
            border: 1px solid var(--color-border);
            font-size: 14px;
            transition: border-color 0.2s;
            outline: none;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.06);
            min-width: 150px; 
        }

        .filter-actions input:focus,
        .filter-actions select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.2);
        }

        .create-button {
            text-decoration: none;
            padding: 9px 18px;
            background-color: var(--color-primary);
            color: white;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.2s, transform 0.1s;
            white-space: nowrap;
        }

        .create-button:hover {
            background-color: var(--color-primary-dark);
            transform: translateY(-1px);
        }

       
        .table-wrapper {
            overflow-x: auto; 
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            min-width: 800px; 
        }

        .data-table thead tr {
            background-color: var(--color-bg-light);
            color: var(--color-text-dark);
            text-align: left;
        }

        .data-table th {
            padding: 12px 15px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--color-border);
            white-space: nowrap;
        }

        .data-table td {
            padding: 12px 15px;
            font-size: 14px;
            border-bottom: 1px solid var(--color-border);
            vertical-align: middle;
            color: var(--color-text-dark);
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #FBFBFD;
        }

        .data-table tbody tr:hover {
            background-color: #F0F4F7;
        }

       
        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
            letter-spacing: 0.5px;
            display: inline-block;
            white-space: nowrap;
        }

        .status-pendiente {
            background-color: rgba(245, 158, 11, 0.15);
            color: var(--color-envio-pendiente);
        }
        .status-en_transito {
            background-color: rgba(59, 130, 246, 0.15);
            color: var(--color-envio-transito);
        }
        .status-entregado {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--color-envio-entregado);
        }
        .status-cancelado {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--color-envio-cancelado);
        }


      
        .action-link {
            text-decoration: none;
            color: var(--color-envio-transito); 
            font-weight: 600;
            margin-right: 12px;
            transition: color 0.15s;
            font-size: 13px;
        }

        .action-link:hover {
            color: var(--color-primary);
        }

        .action-delete-button {
            background-color: transparent;
            color: var(--color-danger);
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .action-delete-button:hover {
            background-color: #FEE2E2;
        }

        .empty-row td {
            text-align: center;
            padding: 30px;
            color: var(--color-text-subtle);
            font-style: italic;
            border-bottom: none;
        }

        .pagination-links {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

       
        @media (max-width: 600px) {
            .shipment-management-container {
                padding: 10px;
            }
            .filter-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-controls {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }
            .data-table {
              
                min-width: 100%;
                border: none;
                border-radius: 0;
            }
            .data-table thead {
                display: none; 
            }
            .data-table td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px dashed #DDD;
            }
            .data-table td::before {
               
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 15px;
                font-weight: 700;
                text-align: left;
                color: var(--color-text-dark);
            }
            .data-table tbody tr {
                margin-bottom: 15px;
                border: 1px solid var(--color-border);
                border-radius: 8px;
                display: block;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }
            .data-table tbody tr:last-child td {
                border-bottom: none;
            }
        }
    </style>

    <div class="shipment-management-container">
        <h2 class="title-header">Listado de Envíos </h2>

        <div class="card-container">

            @if (session('message'))
                <div class="alert-success">
                    {{ session('message') }}
                </div>
            @endif

            {{-- Filtros y Acciones --}}
            <div class="filter-actions">
                <div class="filter-controls">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Buscar tracking, remitente, destinatario"
                    >

                    <select wire:model.live="estado">
                        <option value="">Todos los estados</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en transito">En tránsito</option>
                        <option value="entregado">Entregado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>

                    <select wire:model.live="motoristaId">
                        <option value="">Todos los motoristas</option>
                        @foreach($motoristas as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>

                <a href="{{ route('envios.create') }}" class="create-button">
                    + Crear envío
                </a>
            </div>

            {{-- Tabla de Envíos --}}
            <div class="table-wrapper">
                <table class="data-table">
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
                                <td data-label="Código">{{ $envio->codigo_tracking }}</td>
                                <td data-label="Remitente">{{ $envio->remitente_nombre }}</td>
                                <td data-label="Destinatario">{{ $envio->destinatario_nombre }}</td>
                                <td data-label="Estado">
                                    <span class="status-badge status-{{ str_replace(' ', '_', $envio->estado) }}">
                                        {{ ucfirst($envio->estado) }}
                                    </span>
                                </td>
                                <td data-label="Motorista">{{ optional($envio->motorista)->name ?? 'No asignado' }}</td>
                                <td data-label="Vehículo">{{ $envio->vehiculo->placa ?? 'Sin asignar' }}</td>
                                <td data-label="Fecha estimada">{{ $envio->fecha_estimada }}</td>
                                <td data-label="Acciones">
                                    <a href="{{ route('envios.edit', $envio) }}" class="action-link">
                                        Editar
                                    </a>
                                    <button
                                        type="button"
                                        wire:click="eliminar({{ $envio->id }})"
                                        onclick="return confirm('¿Seguro que deseas eliminar el envío {{ $envio->codigo_tracking }}?')"
                                        class="action-delete-button"
                                    >
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="8">
                                    No se encontraron envíos que coincidan con los filtros.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="pagination-links">
                {{ $envios->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>
</div>
