<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Motorista - Tracking ODAM</title>
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

        .motorista-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            background-color: #111827;
            color: #E5E7EB;
            display: flex;
            flex-direction: column;
            padding: 18px 16px;
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
            color: #fff;
        }

        .sidebar-footer {
            margin-top: auto;
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

        /* MAIN */
        .motorista-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .motorista-topbar {
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

        .motorista-content {
            padding: 24px;
        }

        @media (max-width: 800px) {
            .motorista-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                padding: 10px 12px;
            }

            .sidebar-footer {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="motorista-layout">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-circle">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="sidebar-logo-img">
                </div>
                <div class="sidebar-logo-text">
                    <span class="sidebar-logo-title">Tracking ODAM</span>
                    <span class="sidebar-logo-subtitle">Motorista</span>
                </div>
            </div>

            <div>
                <div class="sidebar-section-title">Principal</div>

                <a href="{{ route('motorista.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('motorista.dashboard') ? 'is-active' : '' }}">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                            <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </span>
                    <span>Mis envíos</span>
                </a>

                <div class="sidebar-section-title">Gestión</div>

                <a href="{{ route('motorista.vehiculo') }}"
                    class="sidebar-link {{ request()->routeIs('motorista.vehiculo') ? 'is-active' : '' }}">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-truck-front" viewBox="0 0 16 16">
                            <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zM4 2a1 1 0 0 0-1 1v3.9c0 .625.562 1.092 1.17.994C5.075 7.747 6.792 7.5 8 7.5s2.925.247 3.83.394A1.008 1.008 0 0 0 13 6.9V3a1 1 0 0 0-1-1zm0 1h8v3.9q0 .002 0 0l-.002.004-.005.002h-.004C11.088 6.761 9.299 6.5 8 6.5s-3.088.26-3.99.406h-.003l-.005-.002L4 6.9q0 .002 0 0z" />
                            <path d="M1 2.5A2.5 2.5 0 0 1 3.5 0h9A2.5 2.5 0 0 1 15 2.5v9c0 .818-.393 1.544-1 2v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5V14H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2a2.5 2.5 0 0 1-1-2zM3.5 1A1.5 1.5 0 0 0 2 2.5v9A1.5 1.5 0 0 0 3.5 13h9a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 12.5 1z" />
                        </svg>
                    </span>
                    <span>Mi vehículo</span>
                </a>

                <a href="{{ route('motorista.tracking') }}"
                    class="sidebar-link {{ request()->routeIs('motorista.tracking') ? 'is-active' : '' }}">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-mailbox-flag" viewBox="0 0 16 16">
                            <path d="M10.5 8.5V3.707l.854-.853A.5.5 0 0 0 11.5 2.5v-2A.5.5 0 0 0 11 0H9.5a.5.5 0 0 0-.5.5v8zM5 7c0 .334-.164.264-.415.157C4.42 7.087 4.218 7 4 7s-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0" />
                            <path d="M4 3h4v1H6.646A4 4 0 0 1 8 7v6h7V7a3 3 0 0 0-3-3V3a4 4 0 0 1 4 4v6a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v6h6V7a3 3 0 0 0-3-3" />
                        </svg>
                    </span>
                        <span>Tracking</span>
                    </a>
            </div>

            <div class="sidebar-footer">
                @auth
                <div>Sesión de:</div>
                <div style="font-size:11px;">{{ auth()->user()->name }}</div>
                @endauth

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        {{-- CONTENIDO --}}
        <div class="motorista-main">
            <header class="motorista-topbar">
                <div class="topbar-title">
                    Panel del motorista
                </div>
                <div class="topbar-user">
                    @auth
                    <div class="topbar-avatar">
                        {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div>{{ auth()->user()->name }}</div>
                        <div class="topbar-role">Motorista</div>
                    </div>
                    @endauth
                </div>
            </header>

            <main class="motorista-content">
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