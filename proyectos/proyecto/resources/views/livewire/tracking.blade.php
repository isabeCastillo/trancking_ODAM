<div class="tracking-page">
    <style>
        .tracking-page {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .tracking-header {
            margin-bottom: 18px;
        }

        .tracking-title {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
            color: #111827;
        }

        .tracking-subtitle {
            margin: 4px 0 0;
            font-size: 13px;
            color: #6B7280;
        }

        .tracking-card {
            background-color: #FFFFFF;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
            border: 1px solid #E5E7EB;
        }

        .tracking-search-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 16px;
        }

        .tracking-input {
            flex: 1;
            min-width: 200px;
            padding: 10px 12px;
            border-radius: 999px;
            border: 1px solid #D1D5DB;
            font-size: 14px;
            outline: none;
        }

        .tracking-input:focus {
            border-color: #B91C1C;
            box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.25);
        }

        .tracking-button {
            border: none;
            border-radius: 999px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #B91C1C, #991B1B);
            color: #FFFFFF;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .tracking-button:hover {
            filter: brightness(1.05);
        }

        .tracking-message {
            font-size: 13px;
            margin-bottom: 10px;
        }

        .tracking-message.error {
            color: #B91C1C;
        }

        .tracking-info-grid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(0, 1.3fr);
            gap: 18px;
            margin-top: 10px;
        }

        @media (max-width: 800px) {
            .tracking-info-grid {
                grid-template-columns: 1fr;
            }
        }

        .tracking-section-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 6px;
            color: #111827;
        }

        .tracking-field {
            font-size: 13px;
            margin-bottom: 4px;
            color: #374151;
        }

        .tracking-field strong {
            font-weight: 600;
        }
        
        .tracking-status-card {
            background-color: #F9FAFB;
            border-radius: 12px;
            padding: 14px 16px;
            border: 1px solid #E5E7EB;
        }

        .tracking-status-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6B7280;
            margin-bottom: 4px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-pendiente {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-en-ruta {
            background-color: #DBEAFE;
            color: #1D4ED8;
        }

        .status-entregado {
            background-color: #DCFCE7;
            color: #166534;
        }

        .tracking-steps {
            margin-top: 12px;
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #6B7280;
        }

        .tracking-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }

        .tracking-step::before {
            content: "";
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #E5E7EB;
            z-index: 0;
        }

        .tracking-step:first-child::before {
            left: 50%;
        }

        .tracking-step:last-child::before {
            right: 50%;
        }

        .tracking-step-circle {
            position: relative;
            z-index: 1;
            width: 20px;
            height: 20px;
            border-radius: 999px;
            border: 2px solid #D1D5DB;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: #6B7280;
        }

        .tracking-step.is-active .tracking-step-circle {
            border-color: #B91C1C;
            background-color: #B91C1C;
            color: #FFFFFF;
        }

        .tracking-step-label {
            margin-top: 4px;
            text-align: center;
        }

        .tracking-photo-card {
            margin-top: 16px;
            background-color: #F9FAFB;
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #E5E7EB;
        }

        .tracking-photo-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #111827;
        }

        .tracking-photo-wrapper {
            width: 100%;
            max-height: 260px;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #E5E7EB;
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tracking-photo-wrapper img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .tracking-photo-empty {
            font-size: 12px;
            color: #6B7280;
            text-align: center;
            padding: 20px 10px;
        }
    </style>

    {{-- Encabezado --}}
    <div class="tracking-header">
        <h1 class="tracking-title">Seguimiento de envíos</h1>
        <p class="tracking-subtitle">
            Ingresa el código de tracking del paquete para ver su información y estado actual.
        </p>
    </div>

    {{-- Tarjeta principal --}}
    <div class="tracking-card">

        {{-- Buscador --}}
        <div class="tracking-search-row">
            <input
                type="text"
                class="tracking-input"
                wire:model.defer="codigo"
                placeholder="Ejemplo: ENV-XXXX">
            <button class="tracking-button" wire:click="buscar">
                Buscar
            </button>
        </div>

        {{-- Mensaje si no encuentra --}}
        @if($mensaje)
            <p class="tracking-message error">{{ $mensaje }}</p>
        @endif

        {{-- Resultado --}}
        @if($envio)
            @php
                $estado = strtolower($envio->estado);
                $badgeClass = [
                    'pendiente' => 'status-badge status-pendiente',
                    'en ruta'   => 'status-badge status-en-ruta',
                    'en_transito' => 'status-badge status-en-ruta',
                    'entregado' => 'status-badge status-entregado',
                ][$estado] ?? 'status-badge';

                $step = 1;
                if ($estado === 'en ruta' || $estado === 'en_transito') $step = 2;
                elseif ($estado === 'entregado') $step = 3;
            @endphp

            <div class="tracking-info-grid">
                {{-- Columna izquierda: info del envío + foto --}}
                <div>
                    <div class="tracking-section-title">Datos del envío</div>

                    <p class="tracking-field">
                        <strong>Código:</strong> {{ $envio->codigo_tracking }}
                    </p>

                    <p class="tracking-field">
                        <strong>Tipo de envío:</strong> {{ $envio->tipo_envio }}
                    </p>

                    <p class="tracking-field">
                        <strong>Peso:</strong> {{ $envio->peso ?? 'N/A' }}
                    </p>

                    <p class="tracking-field">
                        <strong>Fecha estimada:</strong> {{ $envio->fecha_estimada }}
                    </p>

                    <div class="tracking-section-title" style="margin-top: 10px;">Remitente</div>
                    <p class="tracking-field">
                        <strong>Nombre:</strong> {{ $envio->remitente_nombre }}
                    </p>
                    <p class="tracking-field">
                        <strong>Teléfono:</strong> {{ $envio->remitente_telefono }}
                    </p>
                    <p class="tracking-field">
                        <strong>Dirección:</strong> {{ $envio->remitente_direccion }}
                    </p>

                    <div class="tracking-section-title" style="margin-top: 10px;">Destinatario</div>
                    <p class="tracking-field">
                        <strong>Nombre:</strong> {{ $envio->destinatario_nombre }}
                    </p>
                    <p class="tracking-field">
                        <strong>Teléfono:</strong> {{ $envio->destinatario_telefono }}
                    </p>
                    <p class="tracking-field">
                        <strong>Dirección:</strong> {{ $envio->destinatario_direccion }}
                    </p>

                    {{-- FOTO DEL PAQUETE REGISTRADA POR EL MOTORISTA --}}
                    <div class="tracking-photo-card">
                        <div class="tracking-photo-title">Foto del envío</div>

                        @if ($fotoActual)
                            <div class="tracking-photo-wrapper">
                                <img src="{{ asset('storage/' . $fotoActual) }}" alt="Foto reciente del envío">
                            </div>
                        @else
                            <div class="tracking-photo-empty">
                                Aún no se ha registrado ninguna fotografía para este envío.
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Columna derecha: estado actual + “progreso” --}}
                <div class="tracking-status-card">
                    <div class="tracking-status-label">Estado actual</div>
                    <div class="{{ $badgeClass }}">
                        {{ ucfirst($envio->estado) }}
                    </div>

                    <div class="tracking-steps">
                        <div class="tracking-step {{ $step >= 1 ? 'is-active' : '' }}">
                            <div class="tracking-step-circle">1</div>
                            <div class="tracking-step-label">Pendiente</div>
                        </div>
                        <div class="tracking-step {{ $step >= 2 ? 'is-active' : '' }}">
                            <div class="tracking-step-circle">2</div>
                            <div class="tracking-step-label">En ruta</div>
                        </div>
                        <div class="tracking-step {{ $step >= 3 ? 'is-active' : '' }}">
                            <div class="tracking-step-circle">3</div>
                            <div class="tracking-step-label">Entregado</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
