<div>
    {{-- resources/views/livewire/admin/vehiculos-form.blade.php --}}
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
        max-width: 900px;
        min-height: 550px;
        background-color: var(--color-card-bg);
        border-radius: 16px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .side-metadata-panel {
        width: 30%;
        background-color: var(--color-primary);
        color: var(--color-card-bg);
        padding: 40px 25px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-align: center;
    }

    .panel-title-large {
        font-size: 30px;
        font-weight: 900;
        margin-bottom: 10px;
        line-height: 1.2;
        text-transform: uppercase;
    }

    .panel-description {
        font-size: 14px;
        opacity: 0.9;
    }

    .form-panel {
        width: 70%;
        padding: 40px;
        display: flex;
        flex-direction: column;
    }

    .header-form-section {
        margin-bottom: 25px;
    }

    .header-form-section h2 {
        font-size: 24px;
        font-weight: 700;
        color: var(--color-text-dark);
        margin-top: 0;
    }

    .header-form-section p {
        font-size: 14px;
        color: var(--color-text-subtle);
        margin: 5px 0 0;
    }

    .error-list {
        list-style: none;
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        background-color: var(--color-primary-light);
        border: 1px solid var(--color-error);
        color: var(--color-error);
        font-size: 14px;
        font-weight: 600;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    @media (min-width: 768px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .full-width-field {
            grid-column: 1 / 3;
        }
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--color-text-dark);
        margin-bottom: 6px;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid var(--color-border);
        font-size: 15px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.3);
    }

    .action-buttons {
        margin-top: auto;
        padding-top: 25px;
        border-top: 1px solid var(--color-border);
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    .save-button {
        border: none;
        padding: 12px 25px;
        background-color: var(--color-primary);
        color: white;
        border-radius: 999px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.1s;
        box-shadow: 0 4px 10px rgba(185, 28, 28, 0.4);
    }

    .save-button:hover {
        background-color: var(--color-primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(185, 28, 28, 0.5);
    }

    .cancel-link {
        color: var(--color-text-subtle);
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
    }

    .cancel-link:hover {
        color: var(--color-primary);
    }

    @media (max-width: 900px) {
        .app-wrapper {
            align-items: flex-start;
            padding: 16px;
        }

        .split-form-container {
            flex-direction: column;
            max-width: 100%;
            min-height: auto;
        }

        .side-metadata-panel {
            width: 100%;
            padding: 24px 20px;
            text-align: center;
        }

        .form-panel {
            width: 100%;
            padding: 24px 20px 28px;
        }

        .panel-title-large {
            font-size: 24px;
        }
    }

    @media (max-width: 480px) {
        .header-form-section h2 {
            font-size: 20px;
        }

        .app-wrapper {
            padding: 12px;
        }

        .form-panel {
            padding: 20px 16px 24px;
        }

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .save-button,
        .cancel-link {
            width: 100%;
            text-align: center;
        }
    }
</style>


    <div class="app-wrapper">
        <div class="split-form-container">

            {{-- PANEL LATERAL --}}
            <div class="side-metadata-panel">
                <div>
                    <p class="panel-title-large">Gestión</p>
                    <p class="panel-title-large">de Vehículos</p>
                </div>

                <p class="panel-description">
                    Administra los vehículos de la flota, asigna motoristas y define su estado operativo.
                </p>
            </div>

            {{-- PANEL DEL FORMULARIO --}}
            <div class="form-panel">
                <header class="header-form-section">
                    <h2>{{ $vehiculo ? 'Editar Vehículo' : 'Nuevo Vehículo' }}</h2>
                    <p>Completa los datos del vehículo y asigna un motorista si corresponde.</p>
                </header>

                {{-- ERRORES --}}
                @if (session('error'))
                    <ul class="error-list">
                        <li>{{ session('error') }}</li>
                    </ul>
                @endif

                @if ($errors->any())
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form wire:submit.prevent="save">
                    <div class="form-grid">

                        <div class="form-group">
                            <label class="form-label">Placa *</label>
                            <input type="text" wire:model="placa" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Marca *</label>
                            <input type="text" wire:model="marca" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Modelo *</label>
                            <input type="text" wire:model="modelo" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Color *</label>
                            <input type="text" wire:model="color" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Capacidad *</label>
                            <input type="number" wire:model="capacidad" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tipo *</label>
                            <input type="text" wire:model="tipo" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Estado *</label>
                            <select wire:model="estado" class="form-select">
                                <option value="Disponible">Disponible</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                            </select>
                        </div>

                        <div class="form-group full-width-field">
                            <label class="form-label">Motorista asignado</label>
                            <select wire:model="user_id" class="form-select">
                                <option value="">Sin motorista</option>
                                @foreach ($motoristas as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="save-button">
                            {{ $vehiculo ? 'Actualizar Vehículo' : 'Guardar Vehículo' }}
                        </button>

                        <a href="{{ route('vehiculos.index') }}" class="cancel-link">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
</div>