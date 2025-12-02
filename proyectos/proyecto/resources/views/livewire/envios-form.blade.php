
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
            --color-accent: #B91C1C;
        }

       
        .form-page-container {
            padding: 20px 30px;
            background-color: transparent; 
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--color-text-dark);
        }

        .main-card-wrapper {
            display: flex;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

       
        .left-panel-branding {
            width: 350px; 
            flex-shrink: 0;
            background-color: var(--color-accent);
            color: white;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
            text-align: center;
        }

        .left-panel-branding .branding-content {
            margin-top: 50px;
        }

        .left-panel-branding .icon-container {
            height: 120px;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-panel-branding h3 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 15px;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .left-panel-branding p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

      
        .right-form-area {
            flex-grow: 1;
            padding: 40px 50px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            color: var(--color-text-dark);
            margin-bottom: 20px;
        }

        .form-title-h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--color-text-dark);
            margin-bottom: 10px;
        }

        .form-subtitle {
            font-size: 14px;
            color: var(--color-text-subtle);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--color-border);
        }

        .form-section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-text-dark);
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid var(--color-border);
        }

       
        .input-group-row {
            display: grid;
            gap: 20px;
            margin-bottom: 20px;
            grid-template-columns: repeat(3, 1fr); 
        }
        
       
        .package-details-row {
           
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
        }

        .input-group-row label {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-text-subtle);
            text-transform: uppercase;
        }

        .input-group-row input[type="text"],
        .input-group-row input[type="number"],
        .input-group-row input[type="date"],
        .input-group-row textarea,
        .input-group-row select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid var(--color-border);
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .input-group-row input:focus,
        .input-group-row select:focus,
        .input-group-row textarea:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.2);
            outline: none;
        }

        .input-group-row textarea {
            resize: vertical;
            min-height: 80px;
        }
        
       
        .tracking-code-row .full-span {
            grid-column: span 3; 
        }

        
        .action-buttons {
            margin-top: 40px;
            display: flex;
            gap: 20px;
            align-items: center;
            justify-content: flex-start;
        }

        .main-action-button {
            padding: 12px 30px;
            background-color: var(--color-primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        .main-action-button:hover {
            background-color: var(--color-primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .cancel-link {
            color: var(--color-text-subtle);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            padding: 12px 0;
        }
        .cancel-link:hover { color: var(--color-text-dark); }

        
        .alert-success {  }
        .alert-errors-list { }

        
        @media (max-width: 992px) {
            .main-card-wrapper {
                flex-direction: column;
            }
            .left-panel-branding {
                width: 100%;
                padding: 30px 20px;
            }
            .right-form-area {
                padding: 30px 20px;
            }
            
            .input-group-row,
            .package-details-row {
                grid-template-columns: 1fr;
            }
            .tracking-code-row .full-span {
                grid-column: span 1;
            }
            .action-buttons {
                justify-content: space-between;
            }
        }
    </style>
    
    <div class="form-page-container">
        <h1 class="page-title"></h1>

        <div class="main-card-wrapper">
            
            {{-- Panel Lateral de Branding (Rojo) --}}
            <div class="left-panel-branding">
                
                <div class="icon-container">
                    {{-- Ícono de Font Awesome: Caja Abierta --}}
                    <i class="fas fa-box-open" style="font-size: 70px; color: white;"></i>
                </div>
                
                <div class="branding-content">
                    <h3>GESTIÓN DE ENVÍOS</h3>
                    <p>
                        Utiliza este formulario para registrar un nuevo envío o actualizar los datos de un envío existente, incluyendo el seguimiento, estado y asignación de personal.
                    </p>
                </div>
                
                <div style="font-size: 12px; opacity: 0.7; margin-top: auto;">
                   
                </div>
            </div>

            {{-- Contenido del Formulario --}}
            <div class="right-form-area">
                <h2 class="form-title-h2">
                    {{ $envio && $envio->exists ? 'Editar Envío' : 'Crear Nuevo Envío' }}
                </h2>
                <p class="form-subtitle"></p>

                @if (session('message'))
                    <div class="alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <ul class="alert-errors-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form wire:submit.prevent="guardar">
                    
                    {{-- REMITENTE --}}
                    <h3 class="form-section-title">Datos del Remitente</h3>
                    <div class="input-group-row">
                        <div>
                            <label>NOMBRE *</label>
                            <input type="text" wire:model="remitente_nombre" placeholder="Nombre completo">
                        </div>
                        <div>
                            <label>TELÉFONO</label>
                            <input type="text" wire:model="remitente_telefono" placeholder="">
                        </div>
                        <div>
                            <label>DIRECCIÓN</label>
                            <input type="text" wire:model="remitente_direccion" placeholder="Dirección de envío">
                        </div>
                    </div>

                    {{-- DESTINATARIO --}}
                    <h3 class="form-section-title">Datos del Destinatario</h3>
                    <div class="input-group-row">
                        <div>
                            <label>NOMBRE *</label>
                            <input type="text" wire:model="destinatario_nombre" placeholder="Nombre completo">
                        </div>
                        <div>
                            <label>TELÉFONO</label>
                            <input type="text" wire:model="destinatario_telefono" placeholder="">
                        </div>
                        <div>
                            <label>DIRECCIÓN</label>
                            <input type="text" wire:model="destinatario_direccion" placeholder="Dirección completa de entrega">
                        </div>
                    </div>

                    {{-- PAQUETE --}}
                    <h3 class="form-section-title">Detalles del Paquete</h3>
                    <div class="input-group-row package-details-row">
                        <div>
                            <label>DESCRIPCIÓN</label>
                            <textarea wire:model="descripcion" rows="3" placeholder="Contenido o detalles del paquete"></textarea>
                        </div>
                        <div>
                            <label>PESO (KG)</label>
                            <input type="number" step="0.01" wire:model="peso" placeholder="">
                        </div>
                        <div>
                            <label>TIPO DE ENVÍO</label>
                            <input type="text" wire:model="tipo_envio" placeholder="Sobre, caja, frágil, etc.">
                        </div>
                        <div>
                            <label>FECHA ESTIMADA DE ENTREGA</label>
                            <input type="date" wire:model="fecha_estimada">
                        </div>
                    </div>

                    {{-- ESTADO Y ASIGNACIONES --}}
                    <h3 class="form-section-title">Estado y Asignaciones</h3>
                    <div class="input-group-row">
                        <div>
                            <label>ESTADO *</label>
                            <select wire:model="estado">
                                <option value="pendiente">Pendiente</option>
                                <option value="en_transito">En tránsito</option>
                                <option value="entregado">Entregado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>

                        <div>
                            <label>MOTORISTA</label>
                            <select wire:model="id_motorista">
                                <option value="">-- Sin asignar --</option>
                                @foreach($motoristas as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label>VEHÍCULO</label>
                            <select wire:model="id_vehiculo">
                                <option value="">-- Sin asignar --</option>
                                @foreach($vehiculos as $v)
                                    <option value="{{ $v->id }}">{{ $v->placa }} - {{ $v->modelo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- CÓDIGO DE TRACKING --}}
                    <h3 class="form-section-title">Código de Tracking</h3>
                    <div class="input-group-row">
                        <div class="full-span">
                            <label>CÓDIGO DE TRACKING</label>
                            <input type="text" wire:model="codigo_tracking" readonly placeholder="Se generará automáticamente al guardar (ej. ENV-0004)">
                        </div>
                    </div>

                    {{-- Botones de Acción --}}
                    <div class="action-buttons">
                        <button type="submit" class="main-action-button">
                            {{ $envio && $envio->exists ? 'Actualizar envío' : 'Guardar nuevo envío' }}
                        </button>
                        <a href="{{ route('envios.index') }}" class="cancel-link">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>