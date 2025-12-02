<div>
    <style>
    /*colores base*/
    :root {
        --color-primary: #B91C1C;
        --color-primary-dark: #991B1B;
        --color-text-card-bg: #FFFFFF;
        --color-side-bg-light: #FF6F6F;
        --color-secondary-bg: #E7E5E4;
        --color-text: #243043;
        --color-text-subtle: #6b7280;
        --color-border: #e0e4ea;
        --color-error: #b91c1c;
    }
    /*panel derecho*/
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background-color: var(--color-secondary-bg);
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .login-card-container {
        width: 90%;
        max-width: 900px;
        display: flex;
        border-radius: 16px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        overflow: hidden;
        min-height: 520px;
    }

    /*panel izquierdo*/
    .side-panel {
        width: 40%;
        background: linear-gradient(135deg, var(--color-side-bg-light) 0%, var(--color-primary) 100%);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        padding: 30px 20px;
    }
    .side-panel:hover {
        transform: scale(1.05);
    }


    /*efecto de capas geométricas sutiles*/
    .side-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            linear-gradient(20deg, transparent 65%, rgba(255, 255, 255, 0.1) 65.1%),
            linear-gradient(160deg, transparent 70%, rgba(0, 0, 0, 0.05) 70.1%);
    }

    .panel-content {
        z-index: 1;
        text-align: center;
    }

    .panel-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 5px;
        letter-spacing: 3px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .panel-tagline {
        font-size: 16px;
        opacity: 0.95;
    }

    /*login-card */
    .login-card {
        width: 60%;
        background: var(--color-text-card-bg);
        border-radius: 0 16px 16px 0;
        box-shadow: none;
        border: none;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-header {
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: flex-start;
        margin-bottom: 12px;
    }

    .login-icon {
        font-size: 38px;
        color: var(--color-primary);
    }

    .login-title {
        font-size: 30px;
        font-weight: 700;
        color: var(--color-text);
        margin: 0;
    }

    .login-subtitle {
        text-align: left;
        margin: 0 0 30px 0;
        font-size: 15px;
        color: var(--color-text-subtle);
    }

    /*formulario y boton*/
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 6px;
    }

    .form-input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid var(--color-border);
        font-size: 16px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
        background: var(--color-text-card-bg);
    }

    .form-input:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(185,28,28,0.35);
    }

    .login-button {
        width: 100%;
        border: none;
        border-radius: 999px;
        padding: 12px 14px;
        margin-top: 25px;
        background: linear-gradient(45deg, var(--color-primary), var(--color-primary-dark));
        color: var(--color-text-card-bg);
        font-size: 17px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 10px rgba(185,28,28,0.3);
        transition: transform 0.15s, box-shadow 0.15s;
    }

    .login-button:hover {
        box-shadow: 0 8px 18px rgba(185,28,28,0.5);
        transform: translateY(-2px);
    }

    .login-button:active {
        transform: translateY(0);
        box-shadow: none;
    }

    .login-footer {
        margin-top: 25px;
        text-align: center;
        font-size: 13px;
        color: var(--color-text-subtle);
    }
        .password-wrapper {
        position: relative;
        width: 100%;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        cursor: pointer;
        font-size: 12px;
        color: var(--color-text-subtle);
        padding: 0;
    }

    .toggle-password:hover {
        color: var(--color-primary);
    }

    /*error, logo y resposivo*/
    .login-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        font-size: 13px;
        padding: 8px 10px;
        border-radius: 8px;
        margin-bottom: 12px;
    }

    .input-error-text {
        font-size: 12px;
        color: #b91c1c;
        margin-top: 2px;
    }

    .logo img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f3f4f6;
        box-shadow: 0 8px 20px rgba(255,255,255,0.3);
        background-color: white;
        margin-bottom: 20px;
        transition: transform 0.2s ease;
    }

    .logo img:hover {
        transform: scale(1.05);
    }

    @media (max-width: 1024px) {
        .login-card-container {
            max-width: 700px;
            min-height: 480px;
        }

        .side-panel {
            width: 35%;
            padding: 20px 15px;
        }

        .login-card {
            width: 65%;
            padding: 40px 30px;
        }

        .panel-title {
            font-size: 28px;
            letter-spacing: 2px;
        }

        .logo img {
            width: 120px;
            height: 120px;
            margin-bottom: 15px;
        }
    }

    @media (max-width: 768px) {
        .login-card-container {
            max-width: 420px;
            min-height: auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            flex-direction: column;
            border-radius: 16px; 
        }

        .side-panel {
            width: 100%;
            min-height: 120px; 
            border-radius: 16px 16px 0 0; 
            padding: 20px 15px;
            order: -1; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .panel-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        
        .logo img {
            width: 70px;
            height: 70px; 
            margin-bottom: 8px;
            border-width: 2px;
            box-shadow: none; 
        }
        
        .panel-title {
            font-size: 22px;
            letter-spacing: 1px;
            margin-bottom: 0;
        }
        
        .panel-tagline {
            display: none;
        }

        .login-card {
            width: 100%;
            border-radius: 0 0 16px 16px; 
            padding: 30px 25px;
            align-items: center;
            text-align: center;
        }
        .login-header {
            justify-content: center; 
            width: 100%;
            margin-bottom: 10px;
        }
        
        .login-icon {
            font-size: 30px;
        }

        .login-title {
            font-size: 24px;
        }
        
        .login-subtitle {
            text-align: center; 
            width: 100%;
            margin-bottom: 20px;
        }

        .form-group {
            width: 100%;
        }

        .form-label {
            text-align: left;
            width: 100%;
        }

        .login-button {
            margin-top: 20px;
        }

        .login-footer {
            margin-top: 20px;
        }
    }
    </style>

    {{-- INICIO DEL HTML DE LA VISTA --}}
    <div class="login-wrapper">
        <div class="login-card-container"> 
            
            {{-- Panel Lateral Izquierdo (Toque visual navideño) --}}
            <div class="side-panel">
                <div class="panel-content">
                    <div class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </div>
                    <span class="panel-title">Tracking ODAM</span>
                    <br><br>
                    <p class="panel-tagline">
                        Te damos la bienvenida a nuestro sistema de paquetería,
                        en el que puedes manejar tus envíos de manera rápida, fácil y segura.
                    </p>
                </div>
            </div>

            {{-- Panel de Login (Formulario) --}}
            <div class="login-card">
                <div class="login-header">
                    <span class="login-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                        </svg>
                    </span>
                    <h1 class="login-title">Bienvenido</h1>
                </div>

                <p class="login-subtitle">
                    Inicia sesión para gestionar tus envíos.
                </p>

                {{-- Manejo de Errores (Livewire) --}}
                @error('auth')
                    <div class="login-error">{{ $message }}</div>
                @enderror
                
                <form wire:submit.prevent="login">
                    
                    {{-- Campo Usuario --}}
                    <div class="form-group">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" id="username" class="form-input" wire:model="username" placeholder="Ingresa tu usuario" required>
                        @error('username')
                            <p class="input-error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo Contraseña --}}
                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>

                        <div class="password-wrapper">
                            <input type="{{ $mostrarPassword ? 'text' : 'password' }}" id="password" class="form-input" wire:model="password" placeholder="••••••••" required>
                            <button type="button" class="toggle-password" wire:click="$toggle('mostrarPassword')">
                                {{ $mostrarPassword ? 'Ocultar' : 'Mostrar' }}
                            </button>
                        </div>

                        @error('password')
                            <p class="input-error-text">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Botón de Iniciar Sesión (Rojo con efecto de elevación) --}}
                    <button type="submit" class="login-button">
                        <span>Iniciar Sesión</span>
                    </button>
                </form>

                <div class="login-footer">
                    Sistema de Gestión de Envíos &copy; 2025
                </div>
            </div>
        </div>
    </div>
</div>