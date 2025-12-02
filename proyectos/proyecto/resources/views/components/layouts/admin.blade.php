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
            background-color: #111827;
            color: #E5E7EB;
            display: flex;
            flex-direction: column;
            padding: 20px 18px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .sidebar-logo-circle {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            overflow: hidden;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #F87171;
        }

        .sidebar-logo-img {
            width: 80%;
            height: 80%;
            object-fit: contain;
            display: block;
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
                <div class="sidebar-logo-circle">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="sidebar-logo-img">
                </div>
                <div class="sidebar-logo-text">
                    <span class="sidebar-logo-title">Tracking ODAM</span>
                    <span class="sidebar-logo-subtitle">Panel de Administración</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="sidebar-section-title">Principal</div>

                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                            <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-3 0V7H7v7zm-5 0v-3H2v3z" />
                        </svg></span>
                    <span>Dashboard</span>
                </a>

                <div class="sidebar-section-title">Gestión</div>

                <a href="{{ route('envios.index') }}"
                    class="sidebar-link {{ request()->routeIs('envios.*') ? 'is-active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                        </svg></span>
                    <span>Envíos</span>
                </a>

                <a href="{{ route('motoristas.index') }}"
                    class="sidebar-link {{ request()->routeIs('motoristas.*') ? 'is-active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg></span>
                    <span>Motoristas</span>
                </a>

                <a href="{{ route('vehiculos.index') }}"
                    class="sidebar-link {{ request()->routeIs('vehiculos.*') ? 'is-active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck-front" viewBox="0 0 16 16">
                            <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zM4 2a1 1 0 0 0-1 1v3.9c0 .625.562 1.092 1.17.994C5.075 7.747 6.792 7.5 8 7.5s2.925.247 3.83.394A1.008 1.008 0 0 0 13 6.9V3a1 1 0 0 0-1-1zm0 1h8v3.9q0 .002 0 0l-.002.004-.005.002h-.004C11.088 6.761 9.299 6.5 8 6.5s-3.088.26-3.99.406h-.003l-.005-.002L4 6.9q0 .002 0 0z" />
                            <path d="M1 2.5A2.5 2.5 0 0 1 3.5 0h9A2.5 2.5 0 0 1 15 2.5v9c0 .818-.393 1.544-1 2v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5V14H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2a2.5 2.5 0 0 1-1-2zM3.5 1A1.5 1.5 0 0 0 2 2.5v9A1.5 1.5 0 0 0 3.5 13h9a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 12.5 1z" />
                        </svg></span>
                    <span>Vehículos</span>
                </a>

                <a href="{{ route('usuarios.index') }}"
                    class="sidebar-link {{ request()->routeIs('usuarios.*') ? 'is-active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                        </svg></span>
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

    <script
        src="{{ asset('vendor/livewire/livewire.js') }}"
        data-csrf="{{ csrf_token() }}"
        data-update-uri="/proyecto/public/livewire/update"
        data-navigate-once="true">
    </script>
</body>
</html>