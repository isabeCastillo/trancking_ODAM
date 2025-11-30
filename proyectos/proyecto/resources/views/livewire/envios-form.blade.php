<div>
    {{-- Success is as dangerous as failure. --}}
    <h2>{{ $envio && $envio->exists ? 'Editar envío' : 'Crear envío' }}</h2>

    @if (session('message'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('message') }}
        </div>
    @endif

    {{-- Para ver si hay errores de validación --}}
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form wire:submit.prevent="guardar">
        {{-- REMITENTE --}}
        <fieldset style="margin-bottom: 15px;">
            <legend>Remitente</legend>

            <div>
                <label>Nombre *</label><br>
                <input type="text" wire:model="remitente_nombre">
            </div>

            <div>
                <label>Teléfono</label><br>
                <input type="text" wire:model="remitente_telefono">
            </div>

            <div>
                <label>Dirección</label><br>
                <input type="text" wire:model="remitente_direccion">
            </div>
        </fieldset>

        {{-- DESTINATARIO --}}
        <fieldset style="margin-bottom: 15px;">
            <legend>Destinatario</legend>

            <div>
                <label>Nombre *</label><br>
                <input type="text" wire:model="destinatario_nombre">
            </div>

            <div>
                <label>Teléfono</label><br>
                <input type="text" wire:model="destinatario_telefono">
            </div>

            <div>
                <label>Dirección</label><br>
                <input type="text" wire:model="destinatario_direccion">
            </div>
        </fieldset>

        {{-- PAQUETE --}}
        <fieldset style="margin-bottom: 15px;">
            <legend>Datos del paquete</legend>

            <div>
                <label>Descripción</label><br>
                <textarea wire:model="descripcion" rows="3"></textarea>
            </div>

            <div>
                <label>Peso (kg)</label><br>
                <input type="number" step="0.01" wire:model="peso">
            </div>

            <div>
                <label>Tipo de envío</label><br>
                <input type="text" wire:model="tipo_envio" placeholder="Sobre, caja, frágil, etc.">
            </div>

            <div>
                <label>Fecha estimada de entrega</label><br>
                <input type="date" wire:model="fecha_estimada">
            </div>
        </fieldset>

        {{-- ESTADO Y ASIGNACIONES --}}
        <fieldset style="margin-bottom: 15px;">
            <legend>Estado y asignaciones</legend>

            <div>
                <label>Estado *</label><br>
                <select wire:model="estado">
                    <option value="pendiente">Pendiente</option>
                    <option value="en_transito">En tránsito</option>
                    <option value="entregado">Entregado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>

            <div>
                <label>Motorista</label><br>
                <select wire:model="id_motorista">
                    <option value="">-- Sin asignar --</option>
                    @foreach($motoristas as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Vehículo</label><br>
                <select wire:model="id_vehiculo">
                    <option value="">-- Sin asignar --</option>
                    @foreach($vehiculos as $v)
                        <option value="{{ $v->id }}">{{ $v->placa }} - {{ $v->modelo }}</option>
                    @endforeach
                </select>
            </div>
        </fieldset>

        {{-- CÓDIGO DE TRACKING --}}
        <div style="margin-bottom: 15px;">
            <label>Código de tracking</label><br>
            <input type="text" wire:model="codigo_tracking" readonly>
        </div>

        <div style="margin-top: 10px;">
            <button type="submit">
                {{ $envio && $envio->exists ? 'Actualizar envío' : 'Guardar envío' }}
            </button>

            <a href="{{ route('envios.index') }}" style="margin-left: 10px;">Cancelar</a>
        </div>
    </form>

</div>
