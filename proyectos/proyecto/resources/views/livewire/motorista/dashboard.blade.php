<div>
    <x-layouts.motorista>
        <style>
            .motorista-grid {
                display: grid;
                grid-template-columns: 1.5fr 2fr;
                gap: 20px;
            }
            @media (max-width: 900px) {
                .motorista-grid {
                    grid-template-columns: 1fr;
                }
            }

            .panel-card {
                background-color: var(--color-card-bg);
                border-radius: 12px;
                box-shadow: 0 3px 10px rgba(0,0,0,0.06);
                padding: 16px;
            }

            .panel-title {
                font-size: 17px;
                font-weight: 700;
                margin-bottom: 6px;
            }

            .panel-subtitle {
                font-size: 12px;
                color: var(--color-text-subtle);
                margin-bottom: 10px;
            }

            .envios-list {
                max-height: 400px;
                overflow-y: auto;
                margin-top: 8px;
            }

            .envio-item {
                padding: 8px 10px;
                border-radius: 10px;
                border: 1px solid var(--color-border);
                margin-bottom: 6px;
                cursor: pointer;
                font-size: 13px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .envio-item:hover {
                background-color: #F9FAFB;
            }

            .envio-item.is-active {
                border-color: var(--color-primary);
                background-color: #FEF2F2;
            }

            .badge-estado {
                padding: 3px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
            }

            .badge-pendiente { background:#FEF3C7; color:#F59E0B; }
            .badge-en-ruta  { background:#DBEAFE; color:#3B82F6; }
            .badge-entregado{ background:#D1FAE5; color:#10B981; }

            .field-label {
                font-size: 12px;
                color: var(--color-text-subtle);
                margin-bottom: 2px;
            }
            .field-value {
                font-size: 14px;
                margin-bottom: 6px;
            }

            .estado-select, .comentario-textarea, .file-input {
                width: 100%;
                font-size: 13px;
                padding: 8px 10px;
                border-radius: 8px;
                border: 1px solid var(--color-border);
                margin-bottom: 8px;
            }

            .submit-button {
                border: none;
                border-radius: 999px;
                padding: 8px 18px;
                background-color: var(--color-primary);
                color: #fff;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
            }
            .submit-button:hover {
                background-color: var(--color-primary-dark);
            }

            .alert {
                padding: 8px 10px;
                border-radius: 8px;
                font-size: 13px;
                margin-bottom: 10px;
            }
            .alert-success {
                background-color: #D1FAE5;
                color: #065F46;
            }
            .alert-empty {
                background-color: #FEF3C7;
                color: #92400E;
            }
        </style>

        <div>
            <h2 style="margin-top:0; margin-bottom:10px;">Mis envíos asignados</h2>
            <p style="margin-top:0; font-size:13px; color:var(--color-text-subtle);">
                Revisa los paquetes que tienes asignados, actualiza su estado y sube evidencia de entrega.
            </p>

            @if (session()->has('mensaje'))
                <div class="alert alert-success">
                    {{ session('mensaje') }}
                </div>
            @endif

            <div class="motorista-grid">
                {{-- LISTA DE ENVIOS --}}
                <div class="panel-card">
                    <div class="panel-title">Envíos</div>
                    <div class="panel-subtitle">
                        Solo se muestran los paquetes que están asignados a tu usuario.
                    </div>

                    @if ($envios->count())
                        <div class="envios-list">
                            @foreach ($envios as $envio)
                                @php $estado = strtolower($envio->estado); @endphp
                                <div
                                    class="envio-item {{ $envioSeleccionado && $envioSeleccionado->id === $envio->id ? 'is-active' : '' }}"
                                    wire:click="seleccionarEnvio({{ $envio->id }})"
                                >
                                    <div>
                                        <div style="font-weight:600;">
                                            {{ $envio->codigo_tracking ?? ('ENV-' . $envio->id) }}
                                        </div>
                                        <div style="font-size:11px; color:var(--color-text-subtle);">
                                            {{ $envio->destinatario_nombre }}
                                            – {{ \Carbon\Carbon::parse($envio->created_at)->format('d/m H:i') }}
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge-estado
                                            {{ $estado === 'pendiente' ? 'badge-pendiente' : '' }}
                                            {{ $estado === 'en ruta' ? 'badge-en-ruta' : '' }}
                                            {{ $estado === 'entregado' ? 'badge-entregado' : '' }}">
                                            {{ ucfirst($estado) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-empty">
                            No tienes envíos asignados por el momento.
                        </div>
                    @endif
                </div>

                {{-- DETALLE Y FORMULARIO --}}
                <div class="panel-card">
                    <div class="panel-title">Detalle del envío</div>
                    <div class="panel-subtitle">
                        Cambia el estado, agrega comentarios y evidencia fotográfica.
                    </div>

                    @if ($envioSeleccionado)
                        <div style="margin-bottom:12px;">
                            <div class="field-label">Código de tracking</div>
                            <div class="field-value">
                                <strong>{{ $envioSeleccionado->codigo_tracking ?? ('ENV-' . $envioSeleccionado->id) }}</strong>
                            </div>

                            <div class="field-label">Destinatario</div>
                            <div class="field-value">
                                {{ $envioSeleccionado->destinatario_nombre }}<br>
                                <span style="font-size:12px; color:var(--color-text-subtle);">
                                    {{ $envioSeleccionado->destinatario_direccion }}
                                </span>
                            </div>

                            <div class="field-label">Descripción del paquete</div>
                            <div class="field-value">
                                {{ $envioSeleccionado->descripcion ?? 'Sin descripción.' }}
                            </div>
                        </div>

                        <form wire:submit.prevent="actualizarEnvio">
                            <div>
                                <label class="field-label" for="estado">Estado del envío</label>
                                <select id="estado" class="estado-select" wire:model="estado">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="en ruta">En ruta</option>
                                    <option value="entregado">Entregado</option>
                                </select>
                                @error('estado') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="field-label" for="comentario">Comentario</label>
                                <textarea id="comentario" rows="3" class="comentario-textarea"
                                        placeholder="Ej. Paquete dejado en recepción, destinatario no se encontraba..."
                                        wire:model="comentario"></textarea>
                                @error('comentario') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="field-label" for="foto">Evidencia fotográfica</label>
                                <input id="foto" type="file" class="file-input" wire:model="foto" accept="image/*">
                                @error('foto') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror

                                @if ($foto)
                                    <div style="font-size:12px; color:var(--color-text-subtle); margin-top:4px;">
                                        Imagen lista para subir.
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="submit-button">
                                Guardar actualización
                            </button>
                        </form>
                    @else
                        <div class="alert alert-empty">
                            Selecciona un envío de la lista de la izquierda para ver su detalle.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-layouts.motorista>
</div>
