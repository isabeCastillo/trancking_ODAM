{{-- resources/views/livewire/admin/dashboard.blade.php --}}

<x-layouts.admin>
    <style>
        .dashboard-wrapper {
            padding: 0;
        }

        .dashboard-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .dashboard-header {
            font-size: 24px;
            font-weight: 700;
        }

        .dashboard-subtitle {
            font-size: 13px;
            color: var(--color-text-subtle);
        }

        .refresh-button {
            background-color: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .refresh-button:hover {
            background-color: var(--color-primary-dark);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .dashboard-card {
            background-color: var(--color-card-bg);
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            padding: 18px;
        }

        .kpi-card {
            border: 1px solid var(--color-border);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .kpi-label {
            font-size: 12px;
            color: var(--color-text-subtle);
            text-transform: uppercase;
            font-weight: 600;
        }

        .kpi-value {
            font-size: 28px;
            font-weight: 800;
        }

        .kpi-subtext {
            font-size: 11px;
            color: var(--color-text-subtle);
        }

        .kpi-pendiente { color: #F59E0B; }
        .kpi-en-ruta  { color: #3B82F6; }
        .kpi-entregado { color: #10B981; }

        .main-grid {
            display: grid;
            grid-template-columns: 2.2fr 1.5fr;
            gap: 20px;
        }

        @media (max-width: 992px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        .card-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
        }

        .card-subtitle {
            font-size: 12px;
            color: var(--color-text-subtle);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #F3F4F6;
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 11px;
            color: var(--color-text-subtle);
            font-weight: 500;
        }

        .activity-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .activity-table th {
            padding: 8px 6px;
            font-size: 11px;
            text-transform: uppercase;
            color: var(--color-text-subtle);
            border-bottom: 2px solid var(--color-border);
            text-align: left;
        }

        .activity-table td {
            padding: 8px 6px;
            font-size: 13px;
            border-bottom: 1px solid #E5E7EB;
        }

        .activity-table tbody tr:hover {
            background-color: #F9FAFB;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-pendiente { background-color: #FEF3C7; color: #F59E0B; }
        .status-en-ruta  { background-color: #DBEAFE; color: #3B82F6; }
        .status-entregado { background-color: #D1FAE5; color: #10B981; }

        .link-accion {
            color: var(--color-primary);
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .link-accion:hover {
            text-decoration: underline;
        }

        .aux-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .mini-list {
            list-style: none;
            margin: 8px 0 0 0;
            padding: 0;
        }

        .mini-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            font-size: 13px;
            border-bottom: 1px solid var(--color-border);
        }

        .mini-list li:last-child {
            border-bottom: none;
        }

        .progress-bar-bg {
            width: 100px;
            height: 6px;
            border-radius: 999px;
            background-color: #E5E7EB;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-primary-dark));
        }

        .chip {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 999px;
            font-size: 11px;
            background-color: #F3F4F6;
            color: var(--color-text-subtle);
        }

        .chart-placeholder,
        .map-placeholder {
            width: 100%;
            border-radius: 10px;
            border: 2px dashed var(--color-border);
            font-size: 12px;
            color: var(--color-text-subtle);
            padding: 10px;
        }
    </style>

    <div class="dashboard-wrapper">
        {{-- ENCABEZADO --}}
        <div class="dashboard-header-row">
            <div>
                <div class="dashboard-header">Resumen de envíos</div>
                <div class="dashboard-subtitle">
                    Vista general del estado actual de los paquetes registrados.
                </div>
            </div>

            <button wire:click="actualizarDatos" class="refresh-button">
                🔄 Actualizar datos
            </button>
        </div>

        {{-- KPIs --}}
        <div class="kpi-grid">
            <div class="dashboard-card kpi-card">
                <div class="kpi-label">Total de envíos</div>
                <div class="kpi-value">{{ $totalEnvios }}</div>
                <div class="kpi-subtext">Incluye pendientes, en ruta y entregados.</div>
            </div>

            <div class="dashboard-card kpi-card">
                <div class="kpi-label">Pendientes</div>
                <div class="kpi-value kpi-pendiente">{{ $pendientes }}</div>
                <div class="kpi-subtext">Registrados pero aún sin salir a ruta.</div>
            </div>

            <div class="dashboard-card kpi-card">
                <div class="kpi-label">En ruta</div>
                <div class="kpi-value kpi-en-ruta">{{ $enRuta }}</div>
                <div class="kpi-subtext">Actualmente siendo transportados.</div>
            </div>

            <div class="dashboard-card kpi-card">
                <div class="kpi-label">Entregados</div>
                <div class="kpi-value kpi-entregado">{{ $entregados }}</div>
                <div class="kpi-subtext">Confirmados por el motorista.</div>
            </div>

            <div class="dashboard-card kpi-card">
                <div class="kpi-label">Sin asignar</div>
                <div class="kpi-value" style="color: var(--color-primary);">
                    {{ $porAsignar }}
                </div>
                <div class="kpi-subtext">Envíos sin motorista asignado.</div>
            </div>
        </div>

        {{-- GRID PRINCIPAL --}}
        <div class="main-grid">
            {{-- IZQUIERDA: tabla de envíos recientes --}}
            <div class="dashboard-card">
                <div class="card-title-row">
                    <div>
                        <div class="card-title">Envíos recientes</div>
                        <div class="card-subtitle">Últimos paquetes registrados.</div>
                    </div>
                    <span class="pill">
                        Últimos {{ count($enviosRecientes) }} registros
                    </span>
                </div>

                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Destinatario</th>
                            <th>Motorista</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enviosRecientes as $envio)
                            <tr>
                                <td>
                                    <strong>{{ $envio->codigo_tracking ?? ('ENV-' . $envio->id) }}</strong><br>
                                    <span style="font-size:11px;color:var(--color-text-subtle);">
                                        {{ \Carbon\Carbon::parse($envio->created_at)->format('d/m/Y H:i') }}
                                    </span>
                                </td>
                                <td>
                                    {{ $envio->destinatario_nombre }}<br>
                                    <span style="font-size:11px;color:var(--color-text-subtle);">
                                        {{ $envio->destinatario_direccion }}
                                    </span>
                                </td>
                                <td>
                                    @if ($envio->id_motorista && $envio->relationLoaded('motorista') && $envio->motorista)
                                        {{ $envio->motorista->nombre }}
                                    @elseif ($envio->id_motorista)
                                        #{{ $envio->id_motorista }}
                                    @else
                                        <span style="font-size:11px;color:#F59E0B;">Sin asignar</span>
                                    @endif
                                </td>
                                <td>
                                    @php $estado = strtolower($envio->estado); @endphp
                                    <span class="status-badge
                                        {{ $estado === 'pendiente' ? 'status-pendiente' : '' }}
                                        {{ $estado === 'en ruta' ? 'status-en-ruta' : '' }}
                                        {{ $estado === 'entregado' ? 'status-entregado' : '' }}">
                                        {{ ucfirst($estado) }}
                                    </span>
                                </td>
                                <td>
                                    @if (is_null($envio->id_motorista))
                                        <a href="{{ route('envios.edit', $envio->id) }}" class="link-accion">
                                            Asignar
                                        </a>
                                    @else
                                        <a href="{{ route('envios.edit', $envio->id) }}" class="link-accion">
                                            Ver / Editar
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:15px;">
                                    No hay envíos registrados aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- DERECHA: widgets auxiliares --}}
            <div class="aux-grid">
                {{-- Envíos por tipo --}}
                <div class="dashboard-card">
                    <div class="card-title-row">
                        <div>
                            <div class="card-title">Envíos por tipo</div>
                            <div class="card-subtitle">Distribución por tipo de envío.</div>
                        </div>
                    </div>

                    <ul class="mini-list">
                        @forelse ($enviosPorTipo as $tipo)
                            @php
                                $porcentaje = $totalEnvios > 0 ? round(($tipo->total / $totalEnvios) * 100) : 0;
                            @endphp
                            <li>
                                <div>
                                    <strong>{{ $tipo->tipo_envio ?? 'Sin especificar' }}</strong><br>
                                    <span style="font-size:11px;color:var(--color-text-subtle);">
                                        {{ $tipo->total }} envíos
                                    </span>
                                </div>
                                <div>
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill" style="width: {{ $porcentaje }}%;"></div>
                                    </div>
                                    <div style="font-size:11px;text-align:right;color:var(--color-text-subtle);">
                                        {{ $porcentaje }}%
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>No hay datos todavía.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Ranking de motoristas --}}
                <div class="dashboard-card">
                    <div class="card-title-row">
                        <div>
                            <div class="card-title">Ranking de motoristas</div>
                            <div class="card-subtitle">Más envíos asignados.</div>
                        </div>
                        <span class="chip">Top 5</span>
                    </div>

                    <ul class="mini-list">
                        @forelse ($enviosPorMotorista as $row)
                            <li>
                                <div><strong>{{ $row->motorista }}</strong></div>
                                <div style="font-size:12px;color:var(--color-text-subtle);">
                                    {{ $row->total }} envíos
                                </div>
                            </li>
                        @empty
                            <li style="font-size:12px;">
                                Aún no hay datos de motoristas o la tabla no está configurada.
                            </li>
                        @endforelse
                    </ul>
                </div>

                {{-- Envíos por día (texto, listo para un gráfico real después) --}}
                <div class="dashboard-card">
                    <div class="card-title-row">
                        <div>
                            <div class="card-title">Envíos por día (7 días)</div>
                            <div class="card-subtitle">Datos listos para gráfico.</div>
                        </div>
                    </div>

                    <div class="chart-placeholder">
                        @if ($enviosPorDia->count())
                            <div>
                                @foreach ($enviosPorDia as $dia)
                                    <div style="margin-bottom:4px;">
                                        <strong>{{ \Carbon\Carbon::parse($dia->fecha)->format('d/m') }}:</strong>
                                        {{ $dia->total }} envíos
                                    </div>
                                @endforeach
                            </div>
                        @else
                            Aún no hay suficientes datos para la última semana.
                        @endif
                    </div>
                </div>

                {{-- Zona / ciudad (placeholder) --}}
                <div class="dashboard-card">
                    <div class="card-title-row">
                        <div>
                            <div class="card-title">Distribución por zona</div>
                            <div class="card-subtitle">
                                Se activa cuando agreguen columna de ciudad/zona al envío.
                            </div>
                        </div>
                    </div>

                    <div class="map-placeholder">
                        @if ($enviosPorCiudad->count())
                            <div>
                                @foreach ($enviosPorCiudad as $ciudad)
                                    <div style="margin-bottom:4px;">
                                        <strong>{{ $ciudad->destinatario_ciudad }}:</strong>
                                        {{ $ciudad->total }} envíos
                                    </div>
                                @endforeach
                                <p style="margin-top:8px;font-size:11px;">
                                    Aquí se puede integrar un mapa con Leaflet más adelante.
                                </p>
                            </div>
                        @else
                            Cuando exista un campo de ciudad/zona en la tabla <code>envios</code>,
                            aquí aparecerán los totales por zona (y luego el mapa).
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>