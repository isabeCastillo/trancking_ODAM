{{-- resources/views/components/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Tracking ODAM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @livewireStyles

    <style>
        :root {
            --color-primary: #B91C1C;
            --color-primary-dark: #991B1B;
            --color-bg-app: #F3F4F6;
            --color-card-bg: #FFFFFF;
            --color-text-dark: #111827;
            --color-text-subtle: #6B7280;
            --color-border: #E5E7EB;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: var(--color-bg-app);
            color: var(--color-text-dark);
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background-color: #111827; /* gris muy oscuro casi negro */
            color: #E5E7EB;
            display: flex;
            flex-direction: column;
            padding: 20px 18px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .sidebar-logo-circle {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 16px;
        }

        .sidebar-logo-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo-title {
            font-weight: 700;
            font-size: 15px;
        }

        .sidebar-logo-subtitle {
            font-size: 11px;
            color: #9CA3AF;
        }

        .sidebar-nav {
            flex: 1;
        }

        .sidebar-section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6B7280;
            margin-bottom: 6px;
            margin-top: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 8px 10px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 4px;
            text-decoration: none;
            color: #E5E7EB;
            transition: background-color 0.15s, color 0.15s, transform 0.1s;
        }

        .sidebar-link span.icon {
            width: 18px;
            display: inline-block;
            margin-right: 6px;
            text-align: center;
        }

        .sidebar-link:hover {
            background-color: #1F2937;
            transform: translateX(1px);
        }

        .sidebar-link.is-active {
            background: linear-gradient(90deg, var(--color-primary), var(--color-primary-dark));
            color: white;
        }

        .sidebar-footer {
            margin-top: 10px;
            border-top: 1px solid #1F2937;
            padding-top: 10px;
            font-size: 12px;
            color: #9CA3AF;
        }

        .logout-button {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 7px 10px;
            margin-top: 8px;
            background-color: #DC2626;
            color: white;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #B91C1C;
        }

        /* CONTENIDO PRINCIPAL */
        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .admin-topbar {
            height: 60px;
            background-color: var(--color-card-bg);
            border-bottom: 1px solid var(--color-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 600;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .topbar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .topbar-role {
            font-size: 11px;
            color: var(--color-text-subtle);
        }

        .admin-content {
            padding: 24px;
        }

        @media (max-width: 800px) {
            .admin-layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                padding: 10px 12px;
            }
            .sidebar-nav {
                display: flex;
                gap: 6px;
            }
            .sidebar-footer {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="admin-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-circle">OD</div>
            <div class="sidebar-logo-text">
                <span class="sidebar-logo-title">Tracking ODAM</span>
                <span class="sidebar-logo-subtitle">Panel de administración</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-title">Principal</div>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                <span class="icon">📊</span>
                <span>Dashboard</span>
            </a>

            <div class="sidebar-section-title">Gestión</div>

            <a href="{{ route('envios.index') }}"
               class="sidebar-link {{ request()->routeIs('envios.*') ? 'is-active' : '' }}">
                <span class="icon">📦</span>
                <span>Envíos</span>
            </a>

            <a href="{{ route('motoristas.index') }}"
               class="sidebar-link {{ request()->routeIs('motoristas.*') ? 'is-active' : '' }}">
                <span class="icon">🚚</span>
                <span>Motoristas</span>
            </a>

            <a href="{{ route('vehiculos.index') }}"
               class="sidebar-link {{ request()->routeIs('vehiculos.*') ? 'is-active' : '' }}">
                <span class="icon">🚛</span>
                <span>Vehículos</span>
            </a>

            <a href="{{ route('usuarios.index') }}"
               class="sidebar-link {{ request()->routeIs('usuarios.*') ? 'is-active' : '' }}">
                <span class="icon">👤</span>
                <span>Usuarios</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div>Sesión activa</div>
            @auth
                <div style="font-size: 11px;">{{ auth()->user()->name }}</div>
            @endauth

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <div class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-title">
                @yield('page-title', 'Panel de Administración')
            </div>

            <div class="topbar-user">
                @auth
                    <div class="topbar-avatar">
                        {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div>{{ auth()->user()->name }}</div>
                        <div class="topbar-role">Administrador</div>
                    </div>
                @endauth
            </div>
        </header>

        <main class="admin-content">
            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
