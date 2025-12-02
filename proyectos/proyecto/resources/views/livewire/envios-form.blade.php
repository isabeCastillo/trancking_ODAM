{{-- resources/views/livewire/admin/listado-envios.blade.php --}}
<x-layouts.admin>

    <style>
        :root {
            --color-primary: #B91C1C;
            --color-primary-dark: #991B1B;
            --color-primary-light: #FEE2E2;
            --color-bg-app: #E5E7EB;
            --color-card-bg: #FFFFFF;
            --color-text-dark: #1F2937;
            --color-text-subtle: #6B7280;
            --color-border: #D1D5DB;
            --color-error: #DC2626;
            --color-success: #10B981;
        }

        .app-wrapper {
            padding: 20px;
            background-color: var(--color-bg-app);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .split-form-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 580px;
            background-color: var(--color-card-bg);
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .side-metadata-panel {
            width: 32%;
            background-color: var(--color-primary);
            color: var(--color-card-bg);
            padding: 40px 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }

        .panel-title-large {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 10px;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .panel-description {
            font-size: 14px;
            opacity: 0.95;
        }

        .panel-badge {
            display: inline-block;
            margin-top: 20px;
            padding: 6px 14px;
            border-radius: 999px;
            background-color: rgba(255, 255, 255, 0.12);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        .panel-footer-note {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 30px;
        }

        .form-panel {
            width: 68%;
            padding: 35px 35px 30px;
            display: flex;
            flex-direction: column;
            background-color: #F9FAFB;
        }

        .header-form-section {
            margin-bottom: 20px;
        }

        .header-form-section h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--color-text-dark);
            margin: 0;
        }

        .header-form-section p {
            font-size: 14px;
            color: var(--color-text-subtle);
            margin: 6px 0 0;
        }

        .success-banner {
            background-color: #D1FAE5;
            color: var(--color-success);
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #A7F3D0;
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 14px;
        }

        .error-list {
            list-style: disc;
            padding: 12px 18px 12px 35px;
            margin-bottom: 18px;
            border-radius: 10px;
            background-color: var(--color-primary-light);
            border: 1px solid var(--color-error);
            color: var(--color-error);
            font-size: 14px;
            font-weight: 500;
        }

        .error-list strong {
            display: block;
            margin-bottom: 6px;
        }

        .error-message {
            display: block;
            color: var(--color-error);
            font-size: 12px;
            margin-top: 4px;
            font-weight: 600;
        }

        form {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        fieldset {
            border: 1px solid var(--color-border);
            border-radius: 12px;
            padding: 16px 18px 18px;
            margin-bottom: 18px;
            background-color: #FFFFFF;
        }

        legend {
            font-weight: 700;
            color: var(--color-text-dark);
            font-size: 15px;
            padding: 0 8px;
        }

        .fieldset-group {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            margin-top: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-text-dark);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--color-border);
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
            background-color: #F9FAFB;
            transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--color-primary);
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.18);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .full-width-input {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .full-width-input input[type="text"] {
            width: 100%;
        }

        .tracking-hint {
            font-size: 12px;
            color: var(--color-text-subtle);
            margin-top: 3px;
        }

        .action-buttons {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid var(--color-border);
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .primary-button {
            border: none;
            padding: 11px 24px;
            background-color: var(--color-primary);
            color: white;
            border-radius: 999px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 10px rgba(185, 28, 28, 0.45);
            white-space: nowrap;
        }

        .primary-button:hover {
            background-color: var(--color-primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(185, 28, 28, 0.55);
        }

        .cancel-link {
            color: var(--color-text-subtle);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .cancel-link:hover {
            color: var(--color-primary);
        }

        @media (max-width: 900px) {
            .split-form-container {
                flex-direction: column;
                max-width: 100%;
            }

            .side-metadata-panel,
            .form-panel {
                width: 100%;
            }

            .side-metadata-panel {
                padding: 25px 20px;
                align-items: center;
            }

            .form-panel {
                padding: 22px 18px 20px;
            }
        }

        @media (max-width: 600px) {
            .app-wrapper {
                padding: 10px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .primary-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="app-wrapper">
        <div class="split-form-container">

            {{-- PANEL LATERAL IZQUIERDO --}}
            <div class="side-metadata-panel">
                <div>
                    <p class="panel-title-large">Gestión</p>
                    <p class="panel-title-large">de Envíos</p>
                </div>

                <p class="panel-footer-note">
                    Cada envío con un código de tracking único para que el cliente
                    pueda consultar su estado en tiempo real.
                </p>
            </div>

            {{-- PANEL DEL FORMULARIO --}}
            <div class="form-panel">

                <header class="header-form-section">
                    <h2>{{ $envio && $envio->exists ? 'Editar Envío' : 'Crear Nuevo Envío' }}</h2>
                    <p>Completa los datos del remitente, destinatario y la información del paquete.</p>
                </header>

                {{-- MENSAJE DE ÉXITO --}}
                @if (session('message'))
                    <div class="success-banner">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- ERRORES GENERALES --}}
                @if ($errors->any())
                    <ul class="error-list">
                        <strong>Por favor corrige los siguientes errores:</strong>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form wire:submit.prevent="guardar">
                    {{-- DATOS REMITENTE --}}
                    <fieldset>
                        <legend>Datos del Remitente</legend>
                        <div class="fieldset-group">
                            <div>
                                <label>Nombre *</label>
                                <input type="text" wire:model="remitente_nombre">
                                @error('remitente_nombre') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label>Teléfono</label>
                                <input type="text" wire:model="remitente_telefono">
                                @error('remitente_telefono') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label>Dirección</label>
                                <input type="text" wire:model="remitente_direccion">
                                @error('remitente_direccion') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- DATOS DESTINATARIO --}}
                    <fieldset>
                        <legend>Datos del Destinatario</legend>
                        <div class="fieldset-group">
                            <div>
                                <label>Nombre *</label>
                                <input type="text" wire:model="destinatario_nombre">
                                @error('destinatario_nombre') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label>Teléfono</label>
                                <input type="text" wire:model="destinatario_telefono">
                                @error('destinatario_telefono') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label>Dirección</label>
                                <input type="text" wire:model="destinatario_direccion">
                                @error('destinatario_direccion') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- DETALLES PAQUETE --}}
                    <fieldset>
                        <legend>Detalles del Paquete</legend>
                        <div class="fieldset-group">
                            <div style="grid-column: 1 / -1;">
                                <label>Descripción</label>
                                <textarea wire:model="descripcion" rows="3"></textarea>
                                @error('descripcion') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label>Peso (kg)</label>
                                <input type="number" step="0.01" wire:model="peso">
                                @error('peso') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label>Tipo de envío</label>
                                <input type="text" wire:model="tipo_envio" placeholder="Sobre, caja, frágil, etc.">
                                @error('tipo_envio') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label>Fecha estimada de entrega</label>
                                <input type="date" wire:model="fecha_estimada">
                                @error('fecha_estimada') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- ESTADO Y ASIGNACIONES --}}
                    <fieldset>
                        <legend>Estado y Asignaciones</legend>
                        <div class="fieldset-group">
                            <div>
                                <label>Estado *</label>
                                <select wire:model="estado">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="en_transito">En tránsito</option>
                                    <option value="entregado">Entregado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                                @error('estado') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label>Motorista</label>
                                <select wire:model="id_motorista">
                                    <option value="">-- Sin asignar --</option>
                                    @foreach($motoristas as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_motorista') <span class="error-message">{{ $message }}</span> @enderror
                            </div>


                            <div>
                                <label>Vehículo</label>
                                <select wire:model="id_vehiculo">
                                    <option value="">-- Sin asignar --</option>
                                    @foreach($vehiculos as $v)
                                        <option value="{{ $v->id }}">{{ $v->placa }} (Cap: {{ $v->capacidad }})</option>
                                    @endforeach
                                </select>
                                @error('id_vehiculo') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- CÓDIGO TRACKING --}}
                    <div class="full-width-input">
                        <label>Código de tracking</label>
                        <input type="text" wire:model="codigo_tracking" readonly>
                        <p class="tracking-hint">Este código se genera automáticamente y se usa para consultar el estado del envío.</p>
                        @error('codigo_tracking') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    {{-- ACCIONES --}}
                    <div class="action-buttons">
                        <button type="submit" class="primary-button">
                            {{ $envio && $envio->exists ? 'Actualizar envío' : 'Guardar envío' }}
                        </button>

                        <a href="{{ route('envios.index') }}" class="cancel-link">Cancelar</a>
                    </div>
                </form>

            </div>

        </div>
    </div>

</x-layouts.admin>
