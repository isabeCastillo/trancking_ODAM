<div>
    {{-- ESTE ES EL ÚNICO DIV RAÍZ DEL COMPONENTE --}}
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
            --color-motorista: #3B82F6;
        }

        .form-container {
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
            padding: 30px;
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

        .alert-errors-list {
            color: var(--color-danger);
            background-color: #FEE2E2;
            border: 1px solid #FCA5A5;
            border-radius: 8px;
            padding: 15px 15px 15px 35px;
            list-style: disc;
            margin: 0 0 20px 0;
            font-size: 14px;
        }

        .alert-errors-list li {
            margin-bottom: 5px;
        }

        .error-message {
            display: block;
            color: var(--color-danger);
            font-size: 13px;
            margin-top: 5px;
            font-weight: 600;
        }

        form fieldset {
            border: 1px solid var(--color-border);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }

        form legend {
            font-weight: 700;
            color: var(--color-text-dark);
            font-size: 16px;
            padding: 0 10px;
            margin-left: -5px;
        }

        form > div {
            margin-bottom: 15px;
        }

        form fieldset > div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text-dark);
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form textarea,
        form select {
            width: 100%;
            padding: 9px 12px;
            border-radius: 6px;
            border: 1px solid var(--color-border);
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.06);
            box-sizing: border-box;
        }

        form input:focus,
        form select:focus,
        form textarea:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.2);
        }

        form textarea {
            resize: vertical;
        }

        .fieldset-group {
            display: grid;
            gap: 15px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        form fieldset > .fieldset-group {
            margin-bottom: 0;
        }

        form textarea {
            grid-column: 1 / -1;
        }

        .full-width-input input[type="text"] {
            width: 100%;
        }

        .action-buttons {
            margin-top: 25px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .action-buttons button {
            padding: 10px 20px;
            background-color: var(--color-primary);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        .action-buttons button:hover {
            background-color: var(--color-primary-dark);
            transform: translateY(-1px);
        }

        .cancel-link {
            color: var(--color-text-subtle);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 5px;
        }

        .cancel-link:hover {
            color: var(--color-text-dark);
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 10px;
            }
            .card-container {
                padding: 15px;
            }
            .fieldset-group {
                grid-template-columns: 1fr;
            }
            form fieldset > div {
                margin-bottom: 10px;
            }
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            .action-buttons button {
                width: 100%;
            }
        }
    </style>

    <div class="form-container">
        <h2 class="title-header">{{ $envio && $envio->exists ? 'Editar Envío' : 'Crear Nuevo Envío' }} </h2>

        <div class="card-container">

            @if (session('message'))
                <div class="alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-errors-list">
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="guardar">
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

                <fieldset>
                    <legend>Detalles del Paquete</legend>
                    <div class="fieldset-group">
                        <div>
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
                            <select wire:model="id_motorista" class="form-control" style="background:#f3f4f6; pointer-events:none;">

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
                            {{-- AQUÍ APARECERÁ TU MENSAJE DE ERROR --}}
                            @error('id_vehiculo')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                <div class="full-width-input">
                    <label>Código de tracking</label>
                    <input type="text" wire:model="codigo_tracking" readonly>
                    @error('codigo_tracking') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="action-buttons">
                    <button type="submit">
                        {{ $envio && $envio->exists ? 'Actualizar envío' : 'Guardar envío' }}
                    </button>

                    <a href="{{ route('envios.index') }}" class="cancel-link">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>