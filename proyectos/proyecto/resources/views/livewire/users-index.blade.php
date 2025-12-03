<div>
    {{-- resources/views/livewire/admin/dashboard.blade.php --}}
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
            --color-admin: #B91C1C;
            --color-motorista: #3B82F6;
        }

        /* estructura y encabezados */
        .user-management-container {
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
            min-width: 220px;
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
            width: 100%;
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border: 1px solid var(--color-border);
            border-radius: 8px;
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

        .rol-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .rol-admin {
            background-color: rgba(185, 28, 28, 0.15);
            color: var(--color-admin);
        }

        .rol-motorista {
            background-color: rgba(59, 130, 246, 0.15);
            color: var(--color-motorista);
        }

        .action-link {
            text-decoration: none;
            color: var(--color-motorista);
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

        .current-user-tag {
            color: var(--color-text-subtle);
            font-style: italic;
            font-size: 13px;
            margin-left: 5px;
        }

        .pagination-links {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .empty-row td {
            text-align: center;
            padding: 30px;
            color: var(--color-text-subtle);
            font-style: italic;
            border-bottom: none;
        }

        @media (max-width: 800px) {
            .user-management-container {
                padding: 12px;
            }

            .filter-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .filter-controls {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .filter-actions input,
            .filter-actions select {
                width: 100%;
                min-width: 0;
            }

            .create-button {
                width: 100%;
                text-align: center;
            }

            .data-table {
                border: none;
                border-radius: 0;
            }

            .data-table thead {
                display: none;
            }

            .data-table tbody tr {
                margin-bottom: 15px;
                border: 1px solid var(--color-border);
                border-radius: 8px;
                display: block;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
                background-color: #FFFFFF;
            }

            .data-table td {
                display: block;
                text-align: right;
                padding-left: 50%;
                border: none;
                border-bottom: 1px dashed #DDD;
                position: relative;
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

            .data-table tbody tr:last-child td {
                border-bottom: none;
            }

            .pagination-links {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .title-header {
                font-size: 22px;
                margin-bottom: 20px;
            }
        }
    </style>

    <div class="user-management-container">
        <h2 class="title-header">Gestión de Usuarios</h2>
        
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
                        placeholder="Buscar por nombre, usuario o correo"
                    >

                    <select wire:model.live="rol">
                        <option value="">Todos los roles</option>
                        <option value="admin">Admin</option>
                        <option value="motorista">Motorista</option>
                    </select>
                </div>
                
                <a href="{{ route('usuarios.create') }}" class="create-button">
                    + Crear usuario
                </a>
            </div>

            {{-- Tabla de Usuarios --}}
            <div class="table-wrapper">
                <table class="data-table">
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
                                <td data-label="Nombre">{{ $user->name }}</td>
                                <td data-label="Usuario">{{ $user->username }}</td>
                                <td data-label="Correo">{{ $user->email }}</td>
                                <td data-label="Rol">
                                    <span class="rol-badge rol-{{ $user->rol }}">
                                        {{ $user->rol }}
                                    </span>
                                </td>
                                <td data-label="Acciones">
                                    <a href="{{ route('usuarios.edit', $user) }}" class="action-link">
                                        Editar
                                    </a>
                                    
                                    @if(auth()->id() !== $user->id)
                                        <button
                                            type="button"
                                            wire:click="eliminar({{ $user->id }})"
                                            onclick="return confirm('¿Seguro que deseas eliminar a {{ $user->name }}?')"
                                            class="action-delete-button"
                                        >
                                            Eliminar
                                        </button>
                                    @else
                                        <span class="current-user-tag">(Tú)</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="5">
                                    No se encontraron usuarios que coincidan con los filtros.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="pagination-links">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>
</div>