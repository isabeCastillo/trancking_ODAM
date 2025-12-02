<div>
    <style>
        .vehiculo-page {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .vehiculo-header {
            margin-bottom: 18px;
        }

        .vehiculo-title {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
            color: #111827;
        }

        .vehiculo-subtitle {
            margin: 4px 0 0;
            font-size: 13px;
            color: #6B7280;
        }

        .vehiculo-card {
            background-color: #FFFFFF;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
            border: 1px solid #E5E7EB;
        }

        .vehiculo-section-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #111827;
        }

        .vehiculo-field {
            font-size: 13px;
            margin-bottom: 4px;
            color: #374151;
        }

        .vehiculo-field strong {
            font-weight: 600;
        }

        .vehiculo-status {
            display: inline-flex;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .vehiculo-status.activo {
            background-color: #DCFCE7;
            color: #166534;
        }

        .vehiculo-status.inactivo,
        .vehiculo-status.taller {
            background-color: #FEE2E2;
            color: #B91C1C;
        }
    </style>

    <div class="vehiculo-page">
        {{-- Encabezado --}}
        <div class="vehiculo-header">
            <h1 class="vehiculo-title">Mi vehículo asignado</h1>
            <p class="vehiculo-subtitle">
                Aquí puedes ver los datos del vehículo que tienes asignado en el sistema.
            </p>
        </div>

        <div class="vehiculo-card">
            @if($vehiculo)
                <div class="vehiculo-section-title">Detalles del vehículo</div>

                <p class="vehiculo-field">
                    <strong>Placa:</strong> {{ $vehiculo->placa }}
                </p>
                <p class="vehiculo-field">
                    <strong>Marca:</strong> {{ $vehiculo->marca }}
                </p>
                <p class="vehiculo-field">
                    <strong>Modelo:</strong> {{ $vehiculo->modelo }}
                </p>
                <p class="vehiculo-field">
                    <strong>Año:</strong> {{ $vehiculo->anio ?? 'N/D' }}
                </p>
                <p class="vehiculo-field">
                    <strong>Capacidad:</strong> {{ $vehiculo->capacidad ?? 'N/D' }}
                </p>

                @php
                    $estado = strtolower($vehiculo->estado ?? '');
                    $estadoClass = 'vehiculo-status';
                    if ($estado === 'activo') {
                        $estadoClass .= ' activo';
                    } elseif (in_array($estado, ['inactivo', 'taller'])) {
                        $estadoClass .= ' inactivo';
                    }
                @endphp

                <p class="vehiculo-field" style="margin-top:8px;">
                    <strong>Estado:</strong>
                    <span class="{{ $estadoClass }}">
                        {{ ucfirst($vehiculo->estado ?? 'Desconocido') }}
                    </span>
                </p>

            @else
                <p class="vehiculo-field">
                    Actualmente no tienes un vehículo asignado.
                </p>
            @endif
        </div>
    </div>
</div>

