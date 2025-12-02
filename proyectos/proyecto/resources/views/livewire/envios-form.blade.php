<div>
    {{-- resources/views/livewire/envios-form.blade.php --}}

    <x-layouts.admin>
        <style>
            .form-card {
                background-color: var(--color-card-bg);
                border-radius: 12px;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
                padding: 18px;
                max-width: 1000px;
                margin: 0 auto;
            }

            .form-title {
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 4px;
            }

            .form-subtitle {
                font-size: 13px;
                color: var(--color-text-subtle);
                margin-bottom: 16px;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 14px 20px;
            }

            .field-label {
                font-size: 12px;
                color: var(--color-text-subtle);
                margin-bottom: 2px;
            }

            .field-input,
            .field-select,
            .field-textarea {
                width: 100%;
                font-size: 13px;
                padding: 8px 10px;
                border-radius: 8px;
                border: 1px solid var(--color-border);
            }

            .field-textarea {
                min-height: 70px;
                resize: vertical;
            }

            .field-error {
                font-size: 11px;
                color: #DC2626;
            }

            .form-actions {
                margin-top: 18px;
                display: flex;
                justify-content: flex-end;
                gap: 10px;
            }

            .btn-primary {
                border: none;
                border-radius: 999px;
                padding: 8px 18px;
                background-color: var(--color-primary);
                color: #fff;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
            }

            .btn-primary:hover {
                background-color: var(--color-primary-dark);
            }

            .btn-secondary {
                border-radius: 999px;
                padding: 8px 18px;
                font-size: 13px;
                border: 1px solid var(--color-border);
                background-color: #fff;
                cursor: pointer;
            }

            .section-title {
                font-size: 14px;
                font-weight: 600;
                margin-top: 10px;
                margin-bottom: 4px;
            }
        </style>

        <div class="form-card">
            <div class="form-title">
                {{ $modoEdicion ? 'Editar envío' : 'Registrar nuevo envío' }}
            </div>
            <div class="form-subtitle">
                Completa los datos del remitente, destinatario y detalles del paquete.
            </div>

            @if (session()->has('mensaje'))
            <div style="padding:8px 10px; border-radius:8px; background:#D1FAE5; color:#065F46; font-size:13px; margin-bottom:10px;">
                {{ session('mensaje') }}
            </div>
            @endif

            <form wire:submit.prevent="guardar">
                {{-- REMITENTE --}}
                <div class="section-title">Datos del remitente</div>
                <div class="form-grid">
                    <div>
                        <div class="field-label">Nombre</div>
                        <input type="text" class="field-input" wire:model.defer="remitente_nombre">
                        @error('remitente_nombre') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Teléfono</div>
                        <input type="text" class="field-input" wire:model.defer="remitente_telefono">
                        @error('remitente_telefono') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Dirección</div>
                        <input type="text" class="field-input" wire:model.defer="remitente_direccion">
                        @error('remitente_direccion') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- DESTINATARIO --}}
                <div class="section-title">Datos del destinatario</div>
                <div class="form-grid">
                    <div>
                        <div class="field-label">Nombre</div>
                        <input type="text" class="field-input" wire:model.defer="destinatario_nombre">
                        @error('destinatario_nombre') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Teléfono</div>
                        <input type="text" class="field-input" wire:model.defer="destinatario_telefono">
                        @error('destinatario_telefono') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Dirección</div>
                        <input type="text" class="field-input" wire:model.defer="destinatario_direccion">
                        @error('destinatario_direccion') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- DETALLE DEL PAQUETE --}}
                <div class="section-title">Detalle del envío</div>
                <div class="form-grid">
                    <div>
                        <div class="field-label">Descripción del paquete</div>
                        <textarea class="field-textarea" wire:model.defer="descripcion"></textarea>
                        @error('descripcion') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Peso (kg)</div>
                        <input type="number" step="0.01" class="field-input" wire:model.defer="peso">
                        @error('peso') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Tipo de envío</div>
                        <input type="text" class="field-input" wire:model.defer="tipo_envio">
                        @error('tipo_envio') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Fecha estimada</div>
                        <input type="date" class="field-input" wire:model.defer="fecha_estimada">
                        @error('fecha_estimada') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- ASIGNACIÓN Y ESTADO --}}
                <div class="section-title">Asignación y estado</div>
                @if (session('error'))
                <div style="padding:8px 10px; border-radius:8px; background:#DC2626; color:#fff; font-size:13px; margin-bottom:10px;">
                    {{ session('error') }}
                </div>
                @endif
                <div class="form-grid">
                    <div>
                        <div class="field-label">Motorista</div>
                        <select class="field-select" wire:model.defer="id_motorista">
                            <option value="">-- Sin asignar --</option>
                            @foreach ($motoristas as $motorista)
                            <option value="{{ $motorista->id }}">{{ $motorista->name }}</option>
                            @endforeach
                        </select>
                        @error('id_motorista') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Vehículo</div>
                        <select class="field-select" wire:model.defer="id_vehiculo">
                            <option value="">-- Sin asignar --</option>
                            @foreach ($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->id }}">{{ $vehiculo->placa ?? $vehiculo->nombre ?? 'Vehículo #'.$vehiculo->id }}</option>
                            @endforeach
                        </select>
                        @error('id_vehiculo') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Estado</div>
                        <select class="field-select" wire:model.defer="estado">
                            <option value="pendiente">Pendiente</option>
                            <option value="en ruta">En ruta</option>
                            <option value="entregado">Entregado</option>
                        </select>
                        @error('estado') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <div class="field-label">Código de tracking</div>
                        <input type="text" class="field-input" wire:model.defer="codigo_tracking">
                        @error('codigo_tracking') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('envios.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        {{ $modoEdicion ? 'Guardar cambios' : 'Guardar envío' }}
                    </button>
                </div>
            </form>
        </div>
    </x-layouts.admin>
</div>