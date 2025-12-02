<div>
    {{-- resources/views/livewire/admin/dashboard.blade.php --}}
<x-layouts.admin>
    <style>
    :root {
        --color-primary: #B91C1C;
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

    .required-tag {
        font-weight: 400;
        color: var(--color-text-subtle);
        font-size: 12px;
        margin-left: 5px;
    }

    .action-buttons {
        margin-top: auto;
        padding-top: 25px;
        border-top: 1px solid var(--color-border);
        display: flex;
        gap: 20px;
        align-items: center;
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
        transition: color 0.15s;
    }

    .cancel-link:hover {
        color: var(--color-primary);
    }

    @media (max-width: 600px) {
        .split-form-container {
            flex-direction: column;
            min-height: auto;
        }
        .side-metadata-panel {
            width: 100%;
            padding: 20px;
        }
        .form-panel {
            width: 100%;
            padding: 30px 20px;
        }
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        .save-button {
            width: 100%;
        }
    }
    </style>

    <div class="app-wrapper">
        <div class="split-form-container">

            {{-- PANEL LATERAL (Branding Único) --}}
            <div class="side-metadata-panel">
                <div>
                    <p class="panel-title-large">Gestión</p>
                    <p class="panel-title-large">de Roles</p>
                </div>
                
                <p class="panel-description">
                    Este formulario permite dar de alta o actualizar las credenciales y roles del personal:
                    Administradores y Motoristas.
                </p>
            </div>

            {{-- PANEL DEL FORMULARIO --}}
            <div class="form-panel">
                <header class="header-form-section">
                    <h2>
                        {{ $user && $user->exists ? 'Editar usuario' : 'Crear nuevo usuario' }}
                    </h2>
                    <p>
                        Asegúrate de asignar el rol correcto para los permisos del sistema.
                    </p>
                </header>

                {{-- Mostrar errores (Validation Errors) --}}
                @if ($errors->any())
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form wire:submit.prevent="guardar">
                    <div class="form-grid">
                        
                        {{-- Nombre --}}
                        <div class="form-group">
                            <label class="form-label">Nombre *</label>
                            <input type="text" wire:model="name" class="form-input">
                        </div>

                        {{-- Usuario (login) --}}
                        <div class="form-group">
                            <label class="form-label">Usuario (login) *</label>
                            <input type="text" wire:model="username" class="form-input">
                        </div>
                        
                        {{-- Correo --}}
                        <div class="form-group">
                            <label class="form-label">Correo</label>
                            <input type="email" wire:model="email" class="form-input">
                        </div>

                        {{-- Rol --}}
                        <div class="form-group">
                            <label class="form-label">Rol *</label>
                            <select wire:model="rol" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="motorista">Motorista</option>
                            </select>
                        </div>

                        {{-- Contraseña --}}
                        <div class="form-group full-width-field">
                            <label class="form-label">
                                Contraseña
                                <span class="required-tag">
                                    @if(!$user || !$user->exists) (obligatoria) @else (dejar en blanco para no cambiar) @endif
                                </span>
                            </label>
                            <input type="password" wire:model="password" class="form-input">
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div class="form-group full-width-field">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" wire:model="password_confirmation" class="form-input">
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="action-buttons">
                        <button type="submit" class="save-button">
                            {{ $user && $user->exists ? 'Actualizar usuario' : 'Guardar usuario' }}
                        </button>

                        <a href="{{ route('usuarios.index') }}" class="cancel-link">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
</div>
