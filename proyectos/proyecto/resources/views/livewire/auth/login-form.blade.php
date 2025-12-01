<style>
/* ------------------------------------------- */
/* COLORES BASE (Navidad / Profesional) */
/* ------------------------------------------- */
:root {
    --color-primary: #B91C1C;       /* Rojo principal (Navidad) */
    --color-primary-dark: #991B1B;
    --color-text-card-bg: #FFFFFF;  /* Blanco para el panel de formulario */
    --color-side-bg-light: #FF6F6F; /* Rojo claro para degradado lateral */
    --color-secondary-bg: #E7E5E4;  /* Fondo de la página (Nieve/Gris claro) */
    --color-text: #243043;          /* Gris oscuro para títulos */
    --color-text-subtle: #6b7280;   /* Gris para subtítulos y footer */
    --color-border: #e0e4ea;
    --color-error: #b91c1c;
}

/* ------------------------------------------- */
/* 1. ESTRUCTURA PRINCIPAL Y CONTENEDOR DIVIDIDO */
/* ------------------------------------------- */
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
    max-width: 900px; /* Tarjeta ancha para el efecto dividido */
    display: flex;
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.25); /* Sombra más pronunciada */
    overflow: hidden;
    min-height: 520px;
}

/* ------------------------------------------- */
/* 2. PANEL LATERAL IZQUIERDO (Estilo Gráfico Navideño) */
/* ------------------------------------------- */
.side-panel {
    width: 40%;
    /* Degradado de rojo claro a rojo intenso (Navidad) */
    background: linear-gradient(135deg, var(--color-side-bg-light) 0%, var(--color-primary) 100%);
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    padding: 30px 20px;
}

/* Efecto de capas geométricas sutiles (el diseño de la imagen) */
.side-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    /* Dibujamos formas rojas/blancas sutiles */
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

/* ------------------------------------------- */
/* 3. PANEL DE LOGIN (Formulario) - Usando .login-card */
/* ------------------------------------------- */
.login-card {
    width: 60%;
    background: var(--color-text-card-bg);
    border-radius: 0 16px 16px 0;
    box-shadow: none;
    border: none;
    padding: 50px 40px; /* Buen padding para que respire */
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
    color: var(--color-primary); /* Icono en rojo */
}

.login-title {
    font-size: 30px;
    font-weight: 700;
    color: var(--color-text); /* Título en color oscuro para contraste */
    margin: 0;
}

.login-subtitle {
    text-align: left;
    margin: 0 0 30px 0; /* Más espacio */
    font-size: 15px;
    color: var(--color-text-subtle);
}

/* ------------------------------------------- */
/* 4. FORMULARIO Y BOTÓN */
/* ------------------------------------------- */
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
    padding: 12px 14px; /* Mayor padding para mayor sensación de calidad */
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
    box-shadow: 0 0 0 3px rgba(185,28,28,0.35); /* Efecto glow rojo */
}

.login-button {
    width: 100%;
    border: none;
    border-radius: 999px; /* Botón de píldora */
    padding: 12px 14px;
    margin-top: 25px; /* Más espacio sobre el botón */
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

/* ------------------------------------------- */
/* 5. ERRORES Y RESPONSIVIDAD */
/* ------------------------------------------- */
.login-error {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: var(--color-error);
    font-size: 14px;
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.input-error-text {
    font-size: 12px;
    color: var(--color-error);
    margin-top: 4px;
}
@media (max-width: 768px) {
    .login-card-container {
        max-width: 420px;
        min-height: auto;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        flex-direction: column;
    }
    .side-panel {
        display: none;
    }
    .login-card {
        width: 100%;
        border-radius: 16px;
        padding: 35px 30px;
        align-items: flex-start;
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
                    <img src="" alt="" srcset="">
                </div>
                <span class="panel-title">Tracking ODAM</span>
                <br><br>
                <p class="panel-tagline">
                    Te damos la bienvenida a nuestro sistema de paquetería,
                    donde puedes gestionar tus envíos de forma rápida, sencilla y segura.
                </p>
            </div>
        </div>

        {{-- Panel de Login (Formulario) --}}
        <div class="login-card">
            <div class="login-header">
                <span class="login-icon">🎁</span> {{-- Icono navideño/paquete --}}
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
                    <input type="password" id="password" class="form-input" wire:model="password" placeholder="••••••••" required>
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