<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administración - CentralShop</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --admin-bg: #020617;
            --admin-sidebar: #0f172a;
            --admin-card: #1e293b;
            --admin-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg);
            color: var(--text-main);
        }
        .admin-sidebar {
            width: 260px;
            height: 100vh;
            background: var(--admin-sidebar);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding-top: 20px;
            transition: all 0.3s;
            border-right: 1px solid var(--admin-border);
        }
        .admin-main {
            margin-left: 260px;
            padding: 20px 30px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .sidebar-link {
            color: #94a3b8;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            border-left-color: #38bdf8;
        }
        .sidebar-link i {
            font-size: 1.2rem;
        }
        .admin-topbar {
            background: var(--admin-card);
            padding: 15px 30px;
            border-radius: 12px;
            border: 1px solid var(--admin-border);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* Overrides para cards y tablas en modo oscuro */
        .card { background-color: var(--admin-card); border: 1px solid var(--admin-border); color: var(--text-main); }
        .text-dark, .fw-bold, .fw-semibold, h1, h2, h3, h4, h5, h6 { color: var(--text-main) !important; }
        .text-muted { color: var(--text-muted) !important; }
        .bg-white { background-color: var(--admin-card) !important; }
        .bg-light { background-color: rgba(255,255,255,0.05) !important; }
        
        /* Tablas */
        .table { color: var(--text-main) !important; --bs-table-bg: transparent; --bs-table-border-color: var(--admin-border); --bs-table-color: var(--text-main); }
        .table thead th { background-color: #0f172a !important; color: var(--text-muted) !important; border-bottom: 2px solid var(--admin-border) !important; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1px; }
        .table tbody td { color: var(--text-main) !important; border-bottom-color: var(--admin-border) !important; }
        .table-hover tbody tr:hover { background-color: rgba(255,255,255,0.04) !important; }
        
        /* Badges de Stock y Estados (Mayor Contraste) */
        .badge.bg-opacity-10 { background-opacity: 0.2 !important; }
        .text-success { color: #4ade80 !important; } /* Verde esmeralda brillante */
        .text-warning { color: #fbbf24 !important; } /* Ámbar brillante */
        .text-danger { color: #f87171 !important; }  /* Rojo coral brillante */
        .bg-success.bg-opacity-10 { background-color: rgba(74, 222, 128, 0.15) !important; }
        .bg-warning.bg-opacity-10 { background-color: rgba(251, 191, 36, 0.15) !important; }
        .bg-danger.bg-opacity-10 { background-color: rgba(248, 113, 113, 0.15) !important; }

        /* Inputs y Modales */
        .modal-content { background-color: var(--admin-card); color: var(--text-main); border: 1px solid var(--admin-border); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .modal-header, .modal-footer { border-color: var(--admin-border); }
        .form-control, .form-select { background-color: rgba(0,0,0,0.3); border-color: var(--admin-border); color: var(--text-main) !important; }
        .form-control:focus, .form-select:focus { background-color: rgba(0,0,0,0.4); border-color: #3b82f6; color: var(--text-main) !important; box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25); }
        .form-check-input { background-color: rgba(255,255,255,0.1); border-color: var(--admin-border); }
        .form-check-input:checked { background-color: #3b82f6; border-color: #3b82f6; }

        /* Botones y Elementos de Interfaz */
        .btn-light { background-color: rgba(255,255,255,0.1) !important; border-color: var(--admin-border) !important; color: #3b82f6 !important; }
        .btn-light:hover { background-color: rgba(255,255,255,0.15) !important; color: #60a5fa !important; }
        .sidebar-link.text-info { color: #38bdf8 !important; }
        .sidebar-link.text-info:hover { background: rgba(56, 189, 248, 0.1); color: #7dd3fc !important; }
        
        /* Scrollbars (Webkit) */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: var(--admin-bg); }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #334155; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="admin-sidebar shadow-lg">
        <div class="text-start mb-4 px-4">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none d-flex align-items-center gap-3">
                <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;">
                    <img src="{{ asset('img/icono/CentralLogo.png') }}" alt="Logo" width="32" height="32" style="object-fit: contain;">
                </div>
                <div>
                    <div class="fw-bold text-white lh-1" style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; letter-spacing: -0.5px;">CentralShop</div>
                    <div class="text-white-50 small mt-1" style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Panel de Control</div>
                </div>
            </a>
        </div>

        <div class="d-flex flex-column gap-1">
            <div class="px-4 text-uppercase mb-2 mt-2" style="color: #64748b; font-size: 0.7rem; font-weight: 600; letter-spacing: 1px;">Principal</div>
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            
            <div class="px-4 text-uppercase mb-2 mt-4" style="color: #64748b; font-size: 0.7rem; font-weight: 600; letter-spacing: 1px;">Catálogo</div>
            
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i> Categorías
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i> Productos
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-cart-check-fill"></i> Pedidos <span class="badge bg-danger ms-auto rounded-pill" style="font-size: 0.65rem;">Nuevos</span>
            </a>
            
            <div class="px-4 text-uppercase mb-2 mt-4" style="color: #64748b; font-size: 0.7rem; font-weight: 600; letter-spacing: 1px;">Marketing</div>
            
            <a href="{{ route('admin.subscribers.index') }}" class="sidebar-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Suscriptores
            </a>
            <a href="{{ route('admin.products.index') }}#flash" class="sidebar-link">
                <i class="bi bi-lightning-charge-fill text-danger"></i>
                <span>Ofertas Flash</span>
                <span class="ms-auto badge bg-danger rounded-pill" style="font-size:0.6rem;">ACTIVO</span>
            </a>

            <div class="px-4 text-uppercase mb-2 mt-4" style="color: #64748b; font-size: 0.7rem; font-weight: 600; letter-spacing: 1px;">Cuenta</div>

            <a href="{{ route('admin.profile') }}" class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Mi Perfil
            </a>

            @if(auth()->user()->is_super_admin)
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Usuarios
            </a>
            @endif

            <div class="px-4 text-uppercase mb-2 mt-4" style="color: #64748b; font-size: 0.7rem; font-weight: 600; letter-spacing: 1px;">Sistema</div>

            <a href="/" class="sidebar-link mt-auto text-info">
                <i class="bi bi-box-arrow-left"></i> Volver a la Tienda
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Topbar -->
        <div class="admin-topbar">
            <div>
                <h4 class="mb-0 fw-bold text-dark">@yield('title', 'Panel de Control')</h4>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="/" target="_blank" class="btn btn-sm btn-light fw-semibold text-primary border"><i class="bi bi-eye me-1"></i> Ver Tienda</a>
                <div class="vr mx-1"></div>
                <div class="d-flex align-items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1e293b&color=fff" class="rounded-circle shadow-sm" width="38" alt="Admin">
                    <div class="d-none d-md-block">
                        <div class="fw-bold small text-dark lh-1">{{ auth()->user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light fw-semibold" style="color:#f87171 !important;" title="Cerrar sesión">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Dynamic Content -->
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
