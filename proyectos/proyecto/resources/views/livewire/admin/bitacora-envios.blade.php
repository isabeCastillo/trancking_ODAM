<div>
    {{-- resources/views/livewire/admin/bitacora-envios.blade.php --}}
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
            }

            .log-container {
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
                position: relative;
            }

            .data-table tbody tr:nth-child(even) {
                background-color: #FBFBFD;
            }

            .data-table tbody tr:hover {
                background-color: #F0F4F7;
            }

            .empty-row td {
                text-align: center;
                padding: 30px;
                color: var(--color-text-subtle);
                font-style: italic;
                border-bottom: none;
            }

            .estado-badge {
                padding: 4px 10px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.4px;
                display: inline-block;
            }

            .estado-pendiente {
                background-color: rgba(245, 158, 11, 0.15);
                color: #B45309;
            }

            .estado-en-ruta {
                background-color: rgba(59, 130, 246, 0.15);
                color: #1D4ED8;
            }

            .estado-entregado {
                background-color: rgba(16, 185, 129, 0.15);
                color: #047857;
            }

            @media (max-width: 600px) {
                .log-container {
                    padding: 10px;
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
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                    background-color: white;
                }

                .data-table td {
                    display: block;
                    text-align: right;
                    padding-left: 50%;
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

                .data-table tbody tr:last-child td {
                    border-bottom: none;
                }
            }
        </style>

        <div class="log-container">
            <h2 class="title-header">Bitácora de cambios de envíos</h2>

            <div class="card-container">

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Código tracking</th>
                                <th>Motorista responsable</th>
                                <th>Estado (antes → después)</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registros as $registro)
                                <tr>
                                    <td data-label="Fecha">
                                        {{ $registro->fecha_hora
                                            ? $registro->fecha_hora->format('d/m/Y H:i')
                                            : $registro->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td data-label="Código tracking">
                                        {{ $registro->envio->codigo_tracking ?? 'N/A' }}
                                    </td>

                                    <td data-label="Motorista">
                                        {{ $registro->usuario->name ?? 'N/A' }}
                                    </td>

                                    <td data-label="Estado">
                                        {{-- badge para estado nuevo --}}
                                        @php
                                            $nuevo = strtolower($registro->estado_nuevo);
                                            $claseEstado =
                                                $nuevo === 'pendiente' ? 'estado-pendiente' :
                                                ($nuevo === 'en ruta' ? 'estado-en-ruta' :
                                                ($nuevo === 'entregado' ? 'estado-entregado' : ''));
                                        @endphp

                                        <span>{{ ucfirst($registro->estado_anterior) }}</span>
                                        →
                                        <span class="estado-badge {{ $claseEstado }}">
                                            {{ ucfirst($registro->estado_nuevo) }}
                                        </span>
                                    </td>

                                    <td data-label="Comentario">
                                        {{ $registro->comentario ?? 'Sin comentario' }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row">
                                    <td colspan="5">
                                        No hay registros en la bitácora todavía.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-layouts.admin>
</div>
