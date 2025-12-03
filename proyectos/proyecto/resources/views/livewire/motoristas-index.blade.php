<div>
  {{-- resources/views/livewire/admin/motoristas-index.blade.php --}}
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

    .filter-actions input {
        padding: 9px 12px;
        border-radius: 6px;
        border: 1px solid var(--color-border);
        font-size: 14px;
        transition: border-color 0.2s;
        outline: none;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.06);
        width: 280px;
        max-width: 100%;
    }

    .filter-actions input:focus {
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

    /* TABLA */
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
    }

    .data-table th {
        padding: 12px 15px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        border-bottom: 1px solid var(--color-border);
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid var(--color-border);
        font-size: 14px;
        color: var(--color-text-dark);
        vertical-align: middle;
    }

    .data-table tbody tr:nth-child(even) {
        background-color: #FBFBFD;
    }

    .data-table tbody tr:hover {
        background-color: #F0F4F7;
    }

    .action-link {
        text-decoration: none;
        color: var(--color-motorista);
        font-weight: 600;
        margin-right: 12px;
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
    }

    /* 🔻 RESPONSIVE */
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
            width: 100%;
        }

        .filter-actions input {
            width: 100%;
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
            display: block;
            margin-bottom: 12px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            background-color: #FFFFFF;
        }

        .data-table td {
            display: block;
            width: 100%;
            border-bottom: 1px dashed #E5E7EB;
            position: relative;
            padding-left: 50%;
            text-align: right;
        }

        .data-table td:last-child {
            border-bottom: none;
        }

        .data-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 600;
            color: var(--color-text-subtle);
            text-align: left;
        }

        .action-link,
        .action-delete-button {
            display: inline-block;
            margin-top: 4px;
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
    <h2 class="title-header">Gestión de Motoristas</h2>

    <div class="card-container">
        {{-- Filtros --}}
        <div class="filter-actions">
            <div class="filter-controls">
                <input type="text" wire:model.live="buscar" placeholder="Buscar motorista...">
            </div>

            <a href="{{ route('motoristas.create') }}" class="create-button">
                + Nuevo Motorista
            </a>
        </div>

        {{-- Tabla --}}
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($motoristas as $m)
                    <tr>
                        <td data-label="Nombre">{{ $m->name }}</td>
                        <td data-label="Email">{{ $m->email }}</td>
                        <td data-label="Usuario">{{ $m->username }}</td>
                        <td data-label="Acciones">
                            <a href="{{ route('motoristas.edit', $m->id) }}" class="action-link">
                                Editar
                            </a>
                            <button
                                wire:click="eliminar({{ $m->id }})"
                                onclick="return confirm('¿Eliminar este motorista?')"
                                class="action-delete-button"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="4">No se encontraron motoristas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-layouts.admin>
</div>