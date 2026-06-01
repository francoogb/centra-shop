<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO básico --}}
    <title>@yield('seo_description', 'Compra Online en Chile con Envíos a Todo el País') | @yield('seo_title', 'CentralShop')</title>
    <meta name="description" content="@yield('seo_meta_desc', '✅ Tienda online en Chile con envíos rápidos a todo el país. Tecnología, hogar, belleza y más al mejor precio. Compra fácil por WhatsApp y paga con tarjeta o transferencia.')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="CentralShop Chile">
    <meta name="geo.region" content="CL">
    <meta name="geo.placename" content="Chile">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="es-CL" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="CentralShop">
    <meta property="og:title" content="@yield('seo_description', 'Compra Online en Chile') | @yield('seo_title', 'CentralShop')">
    <meta property="og:description" content="@yield('seo_meta_desc', '✅ Tienda online en Chile con envíos a todo el país. Tecnología, hogar, belleza y más al mejor precio. Compra fácil por WhatsApp.')">
    <meta property="og:image" content="@yield('seo_image', asset('img/home/Banner.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="es_CL">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('seo_description', 'Compra Online en Chile') | @yield('seo_title', 'CentralShop')">
    <meta name="twitter:description" content="@yield('seo_meta_desc', '✅ Tienda online en Chile. Envíos a todo el país. Compra fácil por WhatsApp.')">
    <meta name="twitter:image" content="@yield('seo_image', asset('img/home/Banner.png'))">

    <link rel="icon" type="image/png" href="{{ asset('img/icono/CentralLogo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="apple-touch-icon" href="{{ asset('img/icono/CentralLogo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet"></noscript>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary-dark: #0f172a;
            --primary-blue: #3b82f6;
            --primary-blue-hover: #2563eb;
            --accent-sky: #38bdf8;
            --bg-page: #111827;
            --bg-card: #1e293b;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --border-dark: rgba(255,255,255,0.07);
            --border-radius: 12px;
            --border-radius-lg: 20px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.4);
            --shadow-md: 0 4px 15px rgba(0,0,0,0.4);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.5);
            --header-bg: #0d1b2a;
            --header-bg-soft: #13263a;
            --header-border: rgba(255,255,255,0.08);
            --header-text: #f8fafc;
            --header-muted: #94a3b8;
            --header-accent: #3b82f6;
            --header-accent-soft: #60a5fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .outfit {
            font-family: 'Outfit', sans-serif;
        }

        .page-header-shell {
            position: sticky;
            top: 0;
            z-index: 1080;
            background: var(--header-bg);
            border-bottom: 1px solid var(--header-border);
            box-shadow: 0 16px 34px rgba(0, 0, 0, 0.28);
        }

        .page-header-main {
            min-height: 78px;
        }

        .page-header-main .container-xl {
            display: flex;
            align-items: center;
            gap: 18px;
            min-height: 78px;
        }

        .brand-cluster {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }

        .brand-menu-toggle {
            display: none;
        }

        .brand-menu-toggle {
            width: 44px;
            height: 44px;
            border: 1px solid var(--header-border);
            border-radius: 14px;
            background: rgba(255,255,255,0.05);
            color: var(--header-text);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: var(--transition);
        }

        .brand-menu-toggle:hover {
            background: rgba(255,255,255,0.1);
            color: var(--header-accent);
            transform: translateY(-1px);
        }

        .brand-menu-toggle i {
            font-size: 1.05rem;
        }

        .store-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .store-brand-mark {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--header-accent) 0%, var(--header-accent-soft) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            padding: 0;
        }

        .store-brand-logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .store-brand-copy {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.1;
        }

        .store-brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: #fff;
            margin: 0;
        }

        .store-brand-title span {
            color: var(--header-accent-soft);
        }

        .store-brand-subtitle {
            font-size: 0.66rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.48);
            margin: 0;
        }

        .header-search-form {
            flex: 0 1 500px;
            max-width: 500px;
            margin-left: auto;
        }

        .header-search-box {
            display: flex;
            align-items: center;
            min-height: 44px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.05);
            overflow: hidden;
            transition: var(--transition);
        }

        .header-search-box:focus-within {
            border-color: rgba(245, 158, 11, 0.72);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.12);
        }

        .header-search-box input {
            width: 100%;
            border: 0;
            outline: none;
            background: transparent;
            color: var(--header-text);
            padding: 0 16px;
            font-size: 0.88rem;
        }

        .header-search-box input::placeholder {
            color: rgba(255,255,255,0.42);
        }

        .header-search-btn {
            width: 48px;
            height: 44px;
            border: 0;
            background: transparent;
            color: #93c5fd;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .header-search-btn:hover {
            background: rgba(59,130,246,0.16);
            color: #dbeafe;
        }

        .header-links {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: 8px;
        }

        .header-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: rgba(255,255,255,0.86);
            font-size: 0.92rem;
            font-weight: 600;
            transition: var(--transition);
            white-space: nowrap;
        }

        .header-link:hover,
        .header-link.is-active {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .header-link i {
            color: var(--header-accent);
        }

        .header-link-button {
            border: 0;
            background: transparent;
        }


        .header-nav-dropdown .dropdown-toggle::after,
        .header-profile-dropdown .dropdown-toggle::after {
            margin-left: 0;
            border-top-color: rgba(255,255,255,0.56);
            vertical-align: middle;
        }

        .header-nav-dropdown .dropdown-toggle.show::after,
        .header-profile-dropdown .dropdown-toggle.show::after {
            border-top-color: var(--header-accent);
        }

        .mega-menu-panel {
            width: 600px;
            right: 0;
            left: auto;
            margin-top: 12px;
            padding: 0;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 22px;
            background: #122235;
            box-shadow: 0 26px 60px rgba(0,0,0,0.34);
            overflow: hidden;
        }

        .mega-menu-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            background: linear-gradient(135deg, rgba(59,130,246,0.15) 0%, rgba(15,23,42,0) 70%);
        }

        .mega-menu-title {
            font-size: 0.98rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .mega-menu-subtitle {
            margin-top: 4px;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.62);
        }

        .mega-menu-link {
            color: #f8fafc;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .mega-menu-link:hover {
            color: var(--header-accent);
        }

        .mega-menu-layout {
            display: block;
        }

        .mega-menu-spotlight {
            position: relative;
            padding: 24px;
            border-left: 1px solid rgba(255,255,255,0.07);
            background: #0f172a;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: 100%;
            overflow: hidden;
        }

        .mega-menu-spotlight::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(180deg, rgba(15,23,42,0) 0%, rgba(15,23,42,0.9) 80%);
            z-index: 1;
        }

        .mega-menu-spotlight-img {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.6;
            filter: saturate(1.2) brightness(0.8);
        }

        .mega-menu-spotlight-content {
            position: relative;
            z-index: 2;
        }

        .mega-menu-spotlight-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(59,130,246,0.12);
            color: #bfdbfe;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .mega-menu-spotlight-title {
            margin: 18px 0 8px;
            color: #fff;
            font-size: 1.28rem;
            font-weight: 800;
            line-height: 1.05;
        }

        .mega-menu-spotlight-text {
            color: rgba(255,255,255,0.68);
            font-size: 0.84rem;
            line-height: 1.6;
            margin: 0 0 18px;
        }

        .mega-menu-spotlight-stats {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .mega-menu-spotlight-stat {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.05);
            color: #e2e8f0;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .mega-menu-spotlight-stat i {
            color: var(--header-accent);
        }

        .mega-menu-spotlight-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-height: 44px;
            padding: 0 16px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: #fff;
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 700;
            box-shadow: 0 14px 24px rgba(37,99,235,0.26);
            transition: var(--transition);
        }

        .mega-menu-spotlight-cta:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 18px 28px rgba(37,99,235,0.32);
        }

        .mega-menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            padding: 20px 22px 22px;
        }

        .mega-category-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 12px;
            text-decoration: none;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .mega-category-item:hover {
            background: rgba(255,255,255,0.06);
            color: var(--header-accent);
            transform: translateX(5px);
        }

        .mega-category-item i {
            font-size: 1.1rem;
            color: var(--header-accent-soft);
            opacity: 0.8;
        }

        .mega-category-name {
            display: block;
        }

        .mega-category-meta {
            display: block;
            margin-top: 4px;
            font-size: 0.74rem;
            color: rgba(255,255,255,0.56);
        }

        .mega-category-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 8px;
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(59,130,246,0.14);
            color: #bfdbfe;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .mobile-category-item {
            justify-content: space-between;
        }

        .mobile-category-main {
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .mobile-category-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 24px;
            padding: 0 8px;
            border-radius: 999px;
            background: rgba(59,130,246,0.14);
            color: #bfdbfe;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .header-actions {
            display: flex;
            align-items: center;
            margin-left: 8px;
        }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 16px;
            border: 1px solid rgba(59,130,246,0.35);
            border-radius: 14px;
            background: rgba(59,130,246,0.08);
            color: #93c5fd;
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition);
            cursor: pointer;
        }

        .info-chip:hover {
            background: rgba(59,130,246,0.18);
            color: #bfdbfe;
            border-color: rgba(59,130,246,0.6);
            transform: translateY(-1px);
        }

        .info-chip i {
            font-size: 1rem;
        }

        .header-mobile-search {
            display: none;
            padding: 0 0 14px;
        }

        .header-mobile-search .container-xl {
            padding-top: 2px;
        }

        .mobile-sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 1090;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .mobile-sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: -320px;
            width: 300px;
            height: 100vh;
            background: linear-gradient(180deg, #0d1b2a 0%, #10253b 100%);
            z-index: 1100;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(0,0,0,0.28);
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.06);
        }

        .mobile-sidebar.show {
            left: 0;
        }

        .mobile-sidebar-header {
            padding: 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mobile-sidebar-close {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
            color: rgba(255,255,255,0.72);
            transition: var(--transition);
        }

        .mobile-sidebar-close:hover {
            color: var(--header-accent);
            background: rgba(255,255,255,0.08);
        }

        .mobile-sidebar-body {
            padding: 12px;
        }

        .mobile-nav-title {
            padding: 14px 14px 8px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.35);
        }

        .mobile-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 14px;
            color: rgba(255,255,255,0.86);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.92rem;
            transition: var(--transition);
        }

        .mobile-nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }

        .mobile-nav-item i {
            width: 22px;
            color: var(--header-accent);
            font-size: 1rem;
        }

        .mobile-nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.07);
            margin: 10px 14px;
        }

        .footer-custom {
            background-color: var(--primary-dark);
            color: white;
            padding: 50px 0 0;
            margin-top: 80px;
        }

        .footer-top-section {
            padding-bottom: 40px;
        }

        .footer-brand {
            margin-bottom: 18px;
        }

        .footer-desc {
            color: #94a3b8;
            font-size: 0.85rem;
            line-height: 1.7;
            max-width: 320px;
        }

        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
            color: #94a3b8;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .footer-social a:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
        }

        .footer-title {
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 22px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            font-size: 0.88rem;
            transition: var(--transition);
        }

        .footer-link:hover {
            color: var(--accent-sky);
            padding-left: 6px;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            color: #94a3b8;
            font-size: 0.85rem;
        }

        .footer-contact-item i {
            color: var(--accent-sky);
            font-size: 1rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .footer-payment {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .footer-payment-item {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 30px;
            background: rgba(255,255,255,0.08);
            border-radius: 6px;
            color: #94a3b8;
            font-size: 1rem;
            transition: var(--transition);
        }

        .footer-payment-item:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .footer-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin: 0;
        }

        .footer-bottom {
            padding: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-bottom-text {
            color: #64748b;
            font-size: 0.78rem;
        }

        .footer-bottom-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.78rem;
            margin-left: 20px;
            transition: color 0.3s;
        }

        .footer-bottom-links a:hover {
            color: var(--accent-sky);
        }

        @media (max-width: 1399.98px) {
            .header-search-form {
                max-width: 400px;
            }

            .header-link {
                padding-left: 10px;
                padding-right: 10px;
            }

            .mega-menu-panel {
                width: min(760px, 84vw);
            }

            .mega-menu-layout {
                grid-template-columns: 230px minmax(0, 1fr);
            }
        }

        @media (max-width: 991.98px) {
            .header-search-form {
                display: none;
            }

            .header-links {
                display: none;
            }

            .header-actions {
                display: none;
            }

            .header-mobile-search {
                display: block;
            }

            .brand-menu-toggle {
                display: inline-flex;
            }

            .page-header-main .container-xl {
                min-height: 72px;
            }

            .store-brand-mark {
                width: 44px;
                height: 44px;
                border-radius: 14px;
            }

            .store-brand-title {
                font-size: 1.35rem;
            }
        }

        @media (max-width: 767.98px) {
            .page-header-main .container-xl {
                gap: 12px;
                min-height: 68px;
            }

            .store-brand-copy {
                display: none;
            }

            .mobile-sidebar .store-brand-copy {
                display: flex;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-bottom-links a {
                margin: 0 10px;
            }
        }

        @media (max-width: 575.98px) {
            .brand-menu-toggle {
                width: 40px;
                height: 40px;
                border-radius: 12px;
            }

            .page-header-main .container-xl {
                gap: 10px;
            }
        }
    </style>
    @yield('styles')

    @stack('seo_schema')
</head>
<body>
    @php
        $headerCategories = \App\Models\Category::where('is_active', true)
            ->where('slug', '!=', 'ofertas')
            ->withCount([
                'products as active_products_count' => function ($query) {
                    $query->where('is_active', true);
                }
            ])
            ->orderBy('name')
            ->get();
        $featuredHeaderCategory = $headerCategories->sortByDesc('active_products_count')->first();
    @endphp

    <div class="mobile-sidebar-overlay" id="mobileOverlay" onclick="closeMobileSidebar()"></div>

    <aside class="mobile-sidebar" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <a href="{{ route('home_inicio') }}" class="store-brand">
                <span class="store-brand-mark">
                    <img src="{{ asset('img/icono/CentralLogo.png') }}" alt="CentralShop Logo" class="store-brand-logo">
                </span>
                <span class="store-brand-copy">
                    <span class="store-brand-title">Central<span>Shop</span></span>
                    <span class="store-brand-subtitle">lo que necesitas</span>
                </span>
            </a>
            <button class="mobile-sidebar-close" type="button" onclick="closeMobileSidebar()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="mobile-sidebar-body">
            <div class="mobile-nav-title">Navegacion</div>
            <a href="{{ route('home_inicio') }}" class="mobile-nav-item" onclick="closeMobileSidebar()">
                <i class="bi bi-house-door"></i> Inicio
            </a>
            <a href="{{ route('catalogo', 'ofertas') }}" class="mobile-nav-item" onclick="closeMobileSidebar()">
                <i class="bi bi-fire"></i> Ofertas
            </a>
            <a href="{{ route('catalogo') }}" class="mobile-nav-item" onclick="closeMobileSidebar()">
                <i class="bi bi-grid"></i> Categorias
            </a>
            <a href="#site-footer" class="mobile-nav-item" onclick="closeMobileSidebar()">
                <i class="bi bi-chat-dots"></i> Contacto
            </a>

            <div class="mobile-nav-divider"></div>
            <div class="mobile-nav-title">Categorias</div>

            @foreach($headerCategories as $category)
                <a href="{{ route('catalogo', $category->slug) }}" class="mobile-nav-item mobile-category-item" onclick="closeMobileSidebar()">
                    <span class="mobile-category-main">
                        <i class="{{ $category->icon ?? 'bi bi-tag-fill' }}"></i>
                        {{ $category->name }}
                    </span>
                    <span class="mobile-category-count">{{ $category->active_products_count }}</span>
                </a>
            @endforeach
        </div>
    </aside>

    <header class="page-header-shell">
        <div class="page-header-main">
            <div class="container-xl px-3 px-lg-4">
             <div class="brand-cluster">
    
                    <button class="brand-menu-toggle d-lg-none" type="button" aria-label="Abrir menu" onclick="openMobileSidebar()">
                        <i class="bi bi-list"></i>
                    </button>

                    <a href="{{ route('home_inicio') }}" class="store-brand" aria-label="CentralShop Inicio">
                        <span class="store-brand-mark">
                            <img src="{{ asset('img/icono/CentralLogo.png') }}" alt="CentralShop Logo" class="store-brand-logo">
                        </span>
                        <span class="store-brand-copy">
                            <span class="store-brand-title">
                                Central<span>Shop</span>
                            </span>
                            <span class="store-brand-subtitle">
                                lo que necesitas
                            </span>
                        </span>
                    </a>

                </div>
                <form action="{{ route('catalogo') }}" method="GET" class="header-search-form">
                    <div class="header-search-box">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Busca un producto">
                        <button class="header-search-btn" type="submit" aria-label="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <nav class="header-links" aria-label="Enlaces principales">
                    <a href="{{ route('catalogo', 'ofertas') }}" class="header-link">
                        <i class="bi bi-fire"></i> Ofertas
                    </a>
                    <div class="dropdown header-nav-dropdown">
                        <button class="header-link header-link-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                        </button>
                        <div class="dropdown-menu mega-menu-panel border-0 dropdown-menu-end">
                            <div class="mega-menu-head">
                                <div>
                                    <div class="mega-menu-title">Explora todas las categorias</div>
                                    <div class="mega-menu-subtitle">Encuentra rapido lo que tu tienda necesita mostrar.</div>
                                </div>
                                <a href="{{ route('catalogo') }}" class="mega-menu-link">Ver catalogo</a>
                            </div>
                            <div class="mega-menu-layout">
                                <div class="mega-menu-grid" style="grid-template-columns: repeat(2, 1fr); align-content: start; padding: 18px 22px 22px;">
                                    @foreach($headerCategories as $category)
                                        <a href="{{ route('catalogo', $category->slug) }}" class="mega-category-item">
                                            <i class="{{ $category->icon ?? 'bi bi-tag-fill' }}"></i>
                                            <span class="mega-category-name">{{ $category->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('contacto') }}" class="header-link {{ request()->routeIs('contacto') ? 'is-active' : '' }}">
                        Contacto
                    </a>
                 
                </nav>

                <div class="header-actions">
                    <button type="button" class="info-chip" data-bs-toggle="modal" data-bs-target="#modalInfo">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Info</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="header-mobile-search">
            <div class="container-xl px-3 px-lg-4">
                <form action="{{ route('catalogo') }}" method="GET">
                    <div class="header-search-box">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Busca un producto">
                        <button class="header-search-btn" type="submit" aria-label="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    @yield('content')

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openMobileSidebar() {
            document.getElementById('mobileSidebar').classList.add('show');
            document.getElementById('mobileOverlay').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            document.getElementById('mobileSidebar').classList.remove('show');
            document.getElementById('mobileOverlay').classList.remove('show');
            document.body.style.overflow = '';
        }
    </script>
    @stack('scripts')

    <!-- Modal: Info / Contacto -->
    <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="background:transparent; border-radius:28px; overflow:hidden;">
                <div class="row g-0" style="min-height:480px;">

                    <!-- Lado izquierdo: Branding -->
                    <div class="col-md-5 d-flex flex-column justify-content-between p-4" style="position:relative; overflow:hidden; background:#0f172a;">
                        <!-- Banner de fondo -->
                        <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:url('{{ asset('img/home/Banner.png') }}') center center / cover no-repeat;"></div>
                        <!-- Overlay oscuro para legibilidad -->
                        <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(160deg,rgba(15,23,42,0.82) 0%,rgba(29,78,216,0.88) 100%);"></div>

                        <div style="position:relative;z-index:1;">
                            <span style="display:inline-flex;align-items:center;gap:8px;padding:7px 14px;border-radius:999px;background:rgba(255,255,255,0.12);color:#bfdbfe;font-size:0.72rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;">
                                <i class="bi bi-shield-check-fill"></i> Tienda Verificada
                            </span>
                            <h3 style="margin:24px 0 10px;color:#fff;font-family:'Outfit',sans-serif;font-size:1.6rem;font-weight:800;line-height:1.1;text-shadow:0 2px 8px rgba(0,0,0,0.5);">
                                Central<span style="color:#93c5fd;">Shop</span>
                            </h3>
                            <p style="color:#bfdbfe;font-size:0.88rem;line-height:1.6;margin:0;">
                                Tu tienda de confianza. Atención personalizada, productos seleccionados y compra directa por WhatsApp.
                            </p>
                        </div>

                        <div class="d-flex flex-column gap-2 mt-4" style="position:relative;z-index:1;">
                            <div style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:14px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);">
                                <i class="bi bi-truck" style="color:#93c5fd;font-size:1rem;flex-shrink:0;"></i>
                                <div>
                                    <div style="color:#fff;font-size:0.8rem;font-weight:700;">Envíos</div>
                                    <div style="color:#bfdbfe;font-size:0.76rem;">Chile · A todo el país</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lado derecho: Cómo comprar -->
                    <div class="col-md-7 d-flex flex-column p-4" style="background:linear-gradient(180deg,#17263b 0%,#0f172a 100%);color:#e2e8f0;">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <div style="color:#fff;font-weight:700;font-size:1rem;" id="modalInfoLabel">¿Cómo comprar?</div>
                                <div style="color:#94a3b8;font-size:0.78rem;margin-top:2px;">Simple y sin complicaciones</div>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar" style="opacity:0.7;"></button>
                        </div>

                        <div class="d-flex flex-column" style="gap:0;">
                            <div class="d-flex gap-3 align-items-start py-3" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                                <div style="width:32px;height:32px;flex-shrink:0;border-radius:10px;background:rgba(59,130,246,0.16);color:#93c5fd;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.88rem;">1</div>
                                <div>
                                    <div style="color:#fff;font-weight:700;font-size:0.88rem;margin-bottom:2px;">Explora nuestro catálogo</div>
                                    <div style="color:#94a3b8;font-size:0.8rem;line-height:1.5;">Descubre productos que inspiren tu zen interior.</div>
                                </div>
                            </div>
                            <div class="d-flex gap-3 align-items-start py-3" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                                <div style="width:32px;height:32px;flex-shrink:0;border-radius:10px;background:rgba(59,130,246,0.16);color:#93c5fd;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.88rem;">2</div>
                                <div>
                                    <div style="color:#fff;font-weight:700;font-size:0.88rem;margin-bottom:2px;">Anota tus productos</div>
                                    <div style="color:#94a3b8;font-size:0.8rem;line-height:1.5;">Haz una lista con nombres y cantidades de los artículos que te interesan.</div>
                                </div>
                            </div>
                            <div class="d-flex gap-3 align-items-start py-3" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                                <div style="width:32px;height:32px;flex-shrink:0;border-radius:10px;background:rgba(59,130,246,0.16);color:#93c5fd;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.88rem;">3</div>
                                <div>
                                    <div style="color:#fff;font-weight:700;font-size:0.88rem;margin-bottom:2px;">Contáctanos</div>
                                    <div style="color:#94a3b8;font-size:0.8rem;line-height:1.5;">Envíanos un mensaje con los detalles de tu pedido.</div>
                                </div>
                            </div>
                            <div class="d-flex gap-3 align-items-start py-3">
                                <div style="width:32px;height:32px;flex-shrink:0;border-radius:10px;background:rgba(34,197,94,0.16);color:#4ade80;display:flex;align-items:center;justify-content:center;font-size:0.95rem;">
                                    <i class="bi bi-check2"></i>
                                </div>
                                <div>
                                    <div style="color:#fff;font-weight:700;font-size:0.88rem;margin-bottom:2px;">Coordina el envío</div>
                                    <div style="color:#94a3b8;font-size:0.8rem;line-height:1.5;">Organizaremos el pago y la entrega de tus productos.</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto pt-3" style="border-top:1px solid rgba(255,255,255,0.06);">
                            <p style="color:#475569;font-size:0.74rem;margin:0;text-align:center;">
                                <i class="bi bi-whatsapp" style="color:#4ade80;"></i>
                                Disponibles por WhatsApp · Respondemos a la brevedad
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
