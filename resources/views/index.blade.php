@extends('layouts.app')

@section('seo_title', 'CentralShop')
@section('seo_description', 'Tienda Online en Chile: Tecnología, Hogar y Belleza')
@section('seo_meta_desc', 'Compra online en Chile fácil y seguro. Tecnología, hogar, belleza y más al mejor precio. Envíos a todo el país con Starken y Chilexpress. Paga con tarjeta o transferencia. ¡Compra hoy por WhatsApp!')

@push('seo_schema')
@php
$homepageSchema = json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => 'https://centralshop.cl/#organization',
            'name'  => 'CentralShop',
            'url'   => 'https://centralshop.cl',
            'logo'  => ['@type' => 'ImageObject', 'url' => 'https://centralshop.cl/img/icono/CentralLogo.png'],
            'contactPoint' => [
                '@type'             => 'ContactPoint',
                'telephone'         => '+56942922528',
                'contactType'       => 'customer service',
                'areaServed'        => 'CL',
                'availableLanguage' => 'Spanish',
            ],
            'sameAs' => [],
        ],
        [
            '@type'           => 'WebSite',
            '@id'             => 'https://centralshop.cl/#website',
            'url'             => 'https://centralshop.cl',
            'name'            => 'CentralShop',
            'description'     => 'Tienda online en Chile de tecnología, hogar, belleza y más',
            'publisher'       => ['@id' => 'https://centralshop.cl/#organization'],
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => ['@type' => 'EntryPoint', 'urlTemplate' => 'https://centralshop.cl/catalogo?q={search_term_string}'],
                'query-input' => 'required name=search_term_string',
            ],
            'inLanguage' => 'es-CL',
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp
<script type="application/ld+json">{!! $homepageSchema !!}</script>
@endpush

@section('styles')
<style>
/* ── Variables ─────────────────────────────── */
:root {
    --c-bg:      #111827;
    --c-card:    #1e293b;
    --c-card-h:  #263349;
    --c-border:  rgba(255,255,255,0.07);
    --c-text:    #f1f5f9;
    --c-muted:   #94a3b8;
    --c-blue:    #3b82f6;
    --c-red:     #ef4444;
    --c-red-t:   #f87171;
}

/* ── Layout ────────────────────────────────── */
.page-wrapper { padding: 16px 0 0; }
.dark-section  { padding: 28px 0 20px; }

/* ── Section header ────────────────────────── */
.sec-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; }
.sec-title { font-size:1.1rem; font-weight:700; color:var(--c-text); margin:0; }
.sec-link  { font-size:0.8rem; color:var(--c-muted); text-decoration:none; font-weight:500; }
.sec-link:hover { color:var(--c-blue); }

/* ── Hero ──────────────────────────────────── */
.hero-dark {
    background: linear-gradient(135deg,#0f172a 0%,#1e293b 60%,#0f172a 100%);
    border-radius:20px; padding:44px 48px; position:relative; overflow:hidden;
    border:1px solid var(--c-border); margin-bottom:8px;
}
.hero-dark::before {
    content:''; position:absolute; top:-40%; right:-10%; width:500px; height:500px;
    background:radial-gradient(circle,rgba(59,130,246,0.12) 0%,transparent 70%);
    border-radius:50%; pointer-events:none;
}
.hero-badge {
    display:inline-flex; align-items:center; gap:6px;
    background:rgba(59,130,246,0.12); border:1px solid rgba(59,130,246,0.2);
    color:#93c5fd; padding:5px 14px; border-radius:50px; font-size:0.75rem;
    font-weight:600; letter-spacing:.03em; margin-bottom:20px;
}
.hero-h1 { font-size:2.6rem; font-weight:800; line-height:1.1; color:#fff; margin-bottom:14px; }
.hero-h1 span { color:var(--c-blue); }
.hero-sub { font-size:0.95rem; color:var(--c-muted); margin-bottom:28px; max-width:420px; }
.hero-btn {
    display:inline-flex; align-items:center; gap:8px;
    background:var(--c-blue); color:#fff; padding:12px 28px;
    border-radius:12px; font-weight:600; font-size:0.9rem; text-decoration:none;
    transition:all .25s; box-shadow:0 4px 20px rgba(59,130,246,.35);
}
.hero-btn:hover { background:#2563eb; transform:translateY(-2px); color:#fff; box-shadow:0 8px 28px rgba(59,130,246,.45); }

.hero-stats { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; }
.hero-stat {
    background:rgba(255,255,255,0.05); border:1px solid var(--c-border);
    border-radius:14px; padding:18px 20px; text-align:center;
}
.hero-stat-num { font-size:1.8rem; font-weight:800; color:#fff; line-height:1; }
.hero-stat-lbl { font-size:0.72rem; color:var(--c-muted); font-weight:500; margin-top:4px; }

/* ── Categories strip ──────────────────────── */
.cats-row {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 12px;
}
@media (max-width: 991px) {
    .cats-row {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 8px;
        scrollbar-width: none;
    }
    .cats-row::-webkit-scrollbar { display: none; }
}
.cat-tile {
    flex: 1;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    background: var(--c-card);
    border: 1px solid var(--c-border);
    border-radius: 16px;
    padding: 12px 10px;
    text-decoration: none;
    transition: all 0.25s ease;
}
.cat-tile:hover { background: var(--c-card-h); border-color: var(--c-blue); transform: translateY(-3px); }
.cat-tile i    { font-size: 1.3rem; color: var(--c-blue); transition: all 0.2s; }
@media (max-width: 991px) {
    .cat-tile {
        flex: 0 0 130px;
    }
}
.cat-tile span {
    font-size: 0.68rem;
    font-weight: 700;
    color: #cbd5e1;
    text-align: center;
    line-height: 1.2;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 1.7rem; /* Espacio para exactamente 2 líneas */
}

.cat-tile-icon-wrap {
    width: 44px;
    height: 44px;
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.05);
}
.cat-tile:hover .cat-tile-icon-wrap {
    background: rgba(59,130,246,0.1);
    border-color: rgba(59,130,246,0.3);
    transform: translateY(-2px);
}
.cat-tile:hover i { color: #fff; }

/* Ver todas card style al final - Hereda de cat-tile */
.cat-tile.see-all-card {
    border-color: rgba(59,130,246,0.2);
}
.cat-tile.see-all-card:hover {
    border-color: var(--c-blue);
}

/* ── Flash Sale ────────────────────────────── */
.flash-wrapper {
    background:linear-gradient(135deg,rgba(239,68,68,.08) 0%,rgba(249,115,22,.04) 100%);
    border:1px solid rgba(239,68,68,.18); border-radius:16px; padding:22px 24px; margin-bottom:32px;
}
.flash-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; }
.flash-title { display:flex; align-items:center; gap:8px; font-size:1.1rem; font-weight:700; color:#f87171; }
.flash-badge {
    background:var(--c-red); color:#fff; font-size:0.88rem; font-weight:700;
    padding:5px 14px; border-radius:8px; font-variant-numeric:tabular-nums; letter-spacing:1px;
}
.flash-row {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    scrollbar-width: none; /* Firefox */
    padding-bottom: 4px;
    -ms-overflow-style: none; /* IE/Edge */
}
.flash-row::-webkit-scrollbar { display: none; } /* Chrome/Safari */

.flash-card {
    flex-shrink:0; width:170px; background:#1a1f2e;
    border:1px solid rgba(239,68,68,.18); border-radius:12px; overflow:hidden;
    text-decoration:none; display:block; transition:all .2s;
}
.flash-card:hover { border-color:rgba(239,68,68,.5); transform:translateY(-3px); }
.flash-card .img-wrap {
    height:140px; background:#0d1117; display:flex; align-items:center;
    justify-content:center; padding:12px; position:relative;
}
.flash-card .img-wrap img { max-height:100%; object-fit:contain; }
.disc-badge {
    position:absolute; top:8px; left:8px; background:var(--c-red);
    color:#fff; font-size:0.65rem; font-weight:700; padding:2px 7px; border-radius:5px;
}
.flash-card .info { padding:10px 12px; }
.flash-card .name {
    font-size:0.78rem; color:#e2e8f0; font-weight:600; line-height:1.3;
    height:2rem; overflow:hidden; display:-webkit-box;
    -webkit-line-clamp:2; -webkit-box-orient:vertical; margin-bottom:6px;
}
.flash-card .old { font-size:0.7rem; color:#6b7280; text-decoration:line-through; }
.flash-card .price { font-size:1rem; font-weight:700; color:var(--c-red-t); }

/* ── Product cards (general) ───────────────── */
.prods-row { display:flex; gap:12px; overflow-x:auto; scrollbar-width:thin; scrollbar-color:#334155 transparent; padding-bottom:6px; }
.prods-row::-webkit-scrollbar { height:4px; }
.prods-row::-webkit-scrollbar-thumb { background:#334155; border-radius:4px; }

.prod-card {
    flex-shrink:0; width:180px; background:var(--c-card);
    border:1px solid var(--c-border); border-radius:12px; overflow:hidden;
    text-decoration:none; display:block; transition:all .22s;
}
.prod-card:hover { background:var(--c-card-h); border-color:var(--c-blue); transform:translateY(-3px); }
.prod-card .img-wrap {
    height:155px; background:#0f172a; display:flex; align-items:center;
    justify-content:center; padding:14px; position:relative;
}
.prod-card .img-wrap img { max-height:100%; object-fit:contain; }
.prod-card .info { padding:12px; }
.prod-card .name {
    font-size:0.8rem; color:var(--c-text); font-weight:600; line-height:1.3;
    height:2.1rem; overflow:hidden; display:-webkit-box;
    -webkit-line-clamp:2; -webkit-box-orient:vertical; margin-bottom:8px;
}
.prod-card .old   { font-size:0.7rem; color:#6b7280; text-decoration:line-through; }
.prod-card .price { font-size:1.05rem; font-weight:700; color:var(--c-blue); }
.new-badge {
    position:absolute; top:8px; right:8px; background:var(--c-blue);
    color:#fff; font-size:0.6rem; font-weight:700; padding:2px 7px; border-radius:5px;
}
.card-pills-overlay {
    position: absolute; bottom: 8px; left: 8px; right: 8px;
    display: flex; gap: 4px; flex-wrap: wrap; pointer-events: none;
}
.card-pill {
    background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px);
    color: #fff; font-size: 0.62rem; font-weight: 700;
    padding: 3px 8px; border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    text-transform: uppercase; letter-spacing: 0.03em;
}

/* ── Divider ───────────────────────────────── */
.dark-divider { border:none; border-top:1px solid var(--c-border); margin:0; }

/* ── Responsive ────────────────────────────── */
/* ── Mascot Banners (SoloTodo Style) ── */
.mascot-banners-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin: 0 0 32px 0; /* Alineado a la izquierda */
    max-width: 960px;
}
@media (max-width: 768px) {
    .mascot-banners-grid {
        display: flex;
        overflow-x: auto;
        gap: 12px;
        padding-bottom: 8px;
        scrollbar-width: none;
        -ms-overflow-style: none;
        scroll-snap-type: x mandatory;
        margin-right: -1rem;
    }
    .mascot-banners-grid::-webkit-scrollbar { display: none; }
    .mascot-banner {
        flex: 0 0 calc(100% - 30px);
        min-height: 140px;
        scroll-snap-align: center;
    }
}

/* ── Category Pills (Mobile) ── */
.cat-pills-container {
    padding: 4px 0 10px;
    margin-top: 10px;
}
.cat-pills-scroll {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding: 10px 0;
}
.cat-pills-scroll::-webkit-scrollbar { display: none; }

.cat-pill {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #1a202c;
    border: 1px solid rgba(255,255,255,0.08);
    color: #e2e8f0;
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 0.82rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.cat-pill:active { transform: scale(0.95); }
.cat-pill i {
    font-size: 0.95rem;
    color: var(--c-blue);
}

.mascot-banner {
    border-radius: 16px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 180px;
    transition: transform 0.2s ease;
    border: 1px solid rgba(255,255,255,0.05);
}
.mascot-banner:hover {
    transform: translateY(-4px);
}
.mascot-banner.blue {
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
}
.mascot-banner.dark {
    background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
}
.mascot-banner-info {
    position: relative;
    z-index: 2;
    max-width: 60%;
}
.mascot-banner-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 16px;
}
@media (max-width: 768px) {
    .mascot-banner-title { font-size: 1.1rem; }
    .mascot-banner { min-height: 150px; padding: 20px; }
}
.mascot-banner-btn {
    display: inline-block;
    background: #fff;
    color: #111827;
    padding: 6px 16px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}
.mascot-banner-img-wrap {
    position: absolute;
    right: -10px; /* Un poco de desborde para efecto 3D */
    bottom: -10px;
    height: 110%;
    width: 50%;
    display: flex;
    align-items: flex-end;
    justify-content: flex-end;
    pointer-events: none;
    z-index: 1;
}
.mascot-banner-img {
    height: 100%;
    width: auto;
    object-fit: contain;
    filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3)); /* Le da profundidad */
    transition: transform 0.3s ease;
}
.mascot-banner:hover .mascot-banner-img {
    transform: scale(1.05) translateY(-5px); /* Efecto de movimiento al pasar el mouse */
}

/* ── Popular Categories Grid (SoloTodo Style) ── */
.pop-cats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}
@media (max-width: 768px) {
    .pop-cats-grid {
        grid-template-columns: 1fr;
    }
    .pop-cat-card { height: 160px; }
}
.pop-cat-card {
    background: #1a202c;
    border-radius: 20px;
    height: 180px;
    display: flex;
    overflow: hidden;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(255,255,255,0.05);
}
.pop-cat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.4);
    border-color: rgba(59,130,246,0.3);
}
.pop-cat-info {
    flex: 1;
    padding: 24px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    z-index: 2;
}
.pop-cat-title {
    font-size: 1.3rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 4px;
    line-height: 1.2;
}
.pop-cat-sub {
    font-size: 0.85rem;
    color: #94a3b8;
    margin-bottom: 18px;
}
.pop-cat-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--c-blue);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: 1px solid rgba(59,130,246,0.3);
    padding: 6px 14px;
    border-radius: 50px;
    align-self: flex-start;
    transition: all 0.2s;
}
.pop-cat-card:hover .pop-cat-btn {
    background: var(--c-blue);
    color: #fff;
}
.pop-cat-visual {
    width: 42%;
    background: linear-gradient(135deg, #1e3a8a 0%, var(--c-blue) 100%);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.pop-cat-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.pop-cat-card:hover .pop-cat-img {
    transform: scale(1.1) rotate(-3deg);
}

@media(max-width:991px){
    .pop-cats-grid { grid-template-columns: 1fr; }
    .pop-cat-card { height: 160px; }
}
    /* 🎡 PRODUCT CAROUSEL SYSTEM */
    .prods-carousel-wrapper {
        position: relative;
        overflow: hidden;
        margin: 0 -5px;
    }
    .prods-row.carousel-mode {
        display: flex;
        flex-wrap: nowrap;
        gap: 15px;
        overflow-x: auto;
        scroll-behavior: smooth;
        scrollbar-width: none;
        padding: 5px;
    }
    .prods-row.carousel-mode::-webkit-scrollbar { display: none; }
    .prods-row.carousel-mode .prod-card {
        flex: 0 0 200px;
    }
    
    .carousel-nav {
        display: flex;
        gap: 8px;
    }
    .btn-nav {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: 1px solid rgba(59,130,246,0.2);
        background: rgba(59,130,246,0.1);
        color: var(--c-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-nav:hover {
        background: var(--c-blue);
        color: #fff;
        box-shadow: 0 0 15px rgba(59,130,246,0.4);
    }
    
    /* Dots para el slider móvil */
    .mascot-dots {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }
    .mascot-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        transition: all 0.3s ease;
    }
    .mascot-dot.active {
        background: var(--c-blue);
        width: 20px;
        border-radius: 10px;
    }
</style>
@endsection

@push('scripts')
<script>
    function scrollCarousel(id, direction) {
        const container = document.getElementById(id);
        if(!container) return;
        const card = container.querySelector('.prod-card') || container.querySelector('.flash-card');
        if(!card) return;
        
        const cardWidth = card.offsetWidth;
        const gap = 12; // Ajustado al gap de CSS
        const scrollAmount = cardWidth + gap;
        
        container.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }

    function autoAdvance(id) {
        const container = document.getElementById(id);
        if(!container) return;
        setInterval(() => {
            if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                container.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                scrollCarousel(id, 1);
            }
        }, 5000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        autoAdvance('flash-sale-section');
        autoAdvance('featured-carousel');
        autoAdvance('latest-carousel');

        // Sincronizar dots del slider de mascotas
        const mascotGrid = document.querySelector('.mascot-banners-grid');
        const mascotDots = document.querySelectorAll('.mascot-dot');
        if(mascotGrid && mascotDots.length > 0) {
            mascotGrid.addEventListener('scroll', () => {
                const scrollLeft = mascotGrid.scrollLeft;
                const itemWidth = mascotGrid.querySelector('.mascot-banner').offsetWidth + 12; // 12 is gap
                const index = Math.round(scrollLeft / itemWidth);
                mascotDots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
            }, { passive: true });
        }
    });
</script>
@endpush

@section('content')
<div class="container-xl px-3 px-lg-4 page-wrapper">

    {{-- ══════════ MASCOT HERO BANNERS ══════════ --}}
    <div class="adsense-top-placeholder mt-5 pt-3 text-center">
        <!-- PEGA AQUÍ TU CÓDIGO DE GOOGLE ADSENSE -->
        <!-- <ins class="adsbygoogle" ...></ins> -->
    </div>

    {{-- Categorías en formato Pills (Mobile) --}}
    <div class="cat-pills-container d-lg-none">
        <div class="cat-pills-scroll">
            <a href="{{ route('catalogo', 'ofertas') }}" class="cat-pill">
                <i class="bi bi-fire" style="color:#f87171"></i> Ofertas
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('catalogo', $cat->slug) }}" class="cat-pill">
                <i class="{{ $cat->icon ?? 'bi bi-tag' }}"></i> {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>


    <section class="dark-section mt-4 pt-4">
        <div class="sec-head">
            <h2 class="sec-title"><i class="bi bi-stars me-2" style="color:var(--c-blue)"></i>Lo más reciente</h2>
        </div>
        <div class="mascot-banners-grid">
            <!-- Banner 1: Construcción -->
            <a href="{{ route('catalogo', 'herramientas') }}" class="mascot-banner blue">
                <div class="mascot-banner-info">
                    <h3 class="mascot-banner-title">Herramientas de<br>Construcción Profesional</h3>
                    <div class="mascot-banner-btn">Ver Catálogo</div>
                </div>
                <div class="mascot-banner-img-wrap">
                    <img src="{{ asset('img/icono/builder.png') }}" alt="Construcción" class="mascot-banner-img">
                </div>
            </a>

            <!-- Banner 2: Ofertas -->
            <a href="{{ route('catalogo', 'ofertas') }}" class="mascot-banner dark">
                <div class="mascot-banner-info">
                    <h3 class="mascot-banner-title">Ofertas Especiales<br>y Descuentos Top</h3>
                    <div class="mascot-banner-btn">Aprovechar ahora</div>
                </div>
                <div class="mascot-banner-img-wrap">
                    <img src="{{ asset('img/icono/offert.png') }}" alt="Ofertas" class="mascot-banner-img">
                </div>
            </a>
        </div>
        
        {{-- Dots para móvil --}}
        <div class="mascot-dots d-lg-none">
            <div class="mascot-dot active"></div>
            <div class="mascot-dot"></div>
        </div>
    </section>


    {{-- ══════════ CATEGORÍAS ══════════ --}}
    <section class="dark-section">
        <div class="sec-head">
            <h2 class="sec-title"><i class="bi bi-grid-3x3-gap me-2" style="color:var(--c-blue)"></i>Categorías</h2>
        </div>
        <div class="cats-row">
            @foreach($categories->take(6) as $cat)
            <a href="{{ route('catalogo', $cat->slug) }}" class="cat-tile">
                <div class="cat-tile-icon-wrap">
                    <i class="bi {{ $cat->icon }}"></i>
                </div>
                <span>{{ $cat->name }}</span>
            </a>
            @endforeach
            
            <!-- Tarjeta Final: Ver Todas (Posición 7) -->
            <a href="{{ route('catalogo') }}" class="cat-tile see-all-card">
                <div class="cat-tile-icon-wrap">
                    <i class="bi bi-plus-square-fill"></i>
                </div>
                <span>Explorar todas</span>
            </a>
        </div>
    </section>

    <hr class="dark-divider">

    {{-- ══════════ OFERTAS FLASH ══════════ --}}
    @if($flashProducts->isNotEmpty())
    @php $flashEndsAt = $flashProducts->whereNotNull('flash_sale_ends_at')->min('flash_sale_ends_at'); @endphp
    <section class="dark-section">
        <div class="flash-wrapper">
            <div class="flash-head">
                <div class="flash-title">
                    <i class="bi bi-lightning-charge-fill"></i> Ofertas Flash
                    @if($flashEndsAt)<small style="font-size:.7rem;color:#9ca3af;font-weight:400">· Tiempo limitado</small>@endif
                </div>
                @if($flashEndsAt)
                <div class="d-flex align-items-center gap-3">
                    <span id="flash-countdown" class="flash-badge" data-ends="{{ $flashEndsAt->toIso8601String() }}">--:--:--</span>
                    <div class="carousel-nav">
                        <button class="btn-nav" onclick="scrollCarousel('flash-sale-section', -1)"><i class="bi bi-chevron-left"></i></button>
                        <button class="btn-nav" onclick="scrollCarousel('flash-sale-section', 1)"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
                @endif
            </div>
            <div class="flash-row" id="flash-sale-section">
                @foreach($flashProducts as $prod)
                @php
                    $disc = $prod->discount_price && $prod->price > 0 ? round((1 - $prod->discount_price/$prod->price)*100) : null;
                    $dprice = $prod->discount_price ?? $prod->price;
                @endphp
                <a href="{{ route('product.show', $prod->slug) }}" class="flash-card">
                    <div class="img-wrap">
                        @if($disc)<span class="disc-badge">-{{ $disc }}%</span>@endif
                        <img src="{{ $prod->image }}" alt="{{ $prod->name }}">
                    </div>
                    <div class="info">
                        <div class="name">{{ $prod->name }}</div>
                        @if($prod->discount_price)<div class="old">${{ number_format($prod->price,0,',','.') }}</div>@endif
                        <div class="price">${{ number_format($dprice,0,',','.') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    <script>
    (function(){
        const el=document.getElementById('flash-countdown');
        const sec=document.getElementById('flash-sale-section');
        if(!el) return;
        const end=new Date(el.dataset.ends);
        function pad(n){return String(n).padStart(2,'0');}
        function tick(){
            const diff=end-new Date();
            if(diff<=0){if(sec)sec.closest('.dark-section').style.display='none';clearInterval(t);return;}
            const h=Math.floor(diff/3600000),m=Math.floor(diff%3600000/60000),s=Math.floor(diff%60000/1000);
            el.textContent=pad(h)+':'+pad(m)+':'+pad(s);
        }
        tick(); const t=setInterval(tick,1000);
    })();
    </script>
    <hr class="dark-divider">
    @endif


    {{-- ══════════ PRODUCTOS DESTACADOS ══════════ --}}
    {{-- ══════════ CATEGORÍAS POPULARES ══════════ --}}
    <section class="dark-section">
        <div class="sec-head">
            <h2 class="sec-title"><i class="bi bi-fire me-2" style="color:#ef4444"></i>Categorías populares</h2>
        </div>
        
        <div class="pop-cats-grid">
            <!-- Tecnología -->
            <a href="{{ route('catalogo', 'tech') }}" class="pop-cat-card">
                <div class="pop-cat-info">
                    <h3 class="pop-cat-title">Mundo<br>Tech</h3>
                    <p class="pop-cat-sub">Lo último en innovación</p>
                    <div class="pop-cat-btn">Ver ofertas <i class="bi bi-arrow-right"></i></div>
                </div>
                <div class="pop-cat-visual">
                    <img src="{{ asset('img/home/Tecnologias.png') }}" alt="Tecnología" class="pop-cat-img">
                </div>
            </a>

            <!-- Belleza -->
            <a href="{{ route('catalogo', 'belleza') }}" class="pop-cat-card">
                <div class="pop-cat-info">
                    <h3 class="pop-cat-title">Belleza y<br>Cuidado</h3>
                    <p class="pop-cat-sub">Tu bienestar es prioridad</p>
                    <div class="pop-cat-btn">Ver ofertas <i class="bi bi-arrow-right"></i></div>
                </div>
                <div class="pop-cat-visual">
                    <img src="{{ asset('img/home/belleza.png') }}" alt="Belleza" class="pop-cat-img">
                </div>
            </a>

            <!-- Seguridad -->
            <a href="{{ route('catalogo', 'seguridad') }}" class="pop-cat-card">
                <div class="pop-cat-info">
                    <h3 class="pop-cat-title">Sistemas de<br>Seguridad</h3>
                    <p class="pop-cat-sub">Protege lo que más quieres</p>
                    <div class="pop-cat-btn">Ver ofertas <i class="bi bi-arrow-right"></i></div>
                </div>
                <div class="pop-cat-visual">
                    <img src="{{ asset('img/home/cameras.png') }}" alt="Seguridad" class="pop-cat-img">
                </div>
            </a>

            <!-- Cocina -->
            <a href="{{ route('catalogo', 'cocina') }}" class="pop-cat-card">
                <div class="pop-cat-info">
                    <h3 class="pop-cat-title">Cocina y<br>Hogar</h3>
                    <p class="pop-cat-sub">Equipa tu espacio ideal</p>
                    <div class="pop-cat-btn">Ver ofertas <i class="bi bi-arrow-right"></i></div>
                </div>
                <div class="pop-cat-visual">
                    <img src="{{ asset('img/home/cocina.png') }}" alt="Cocina" class="pop-cat-img">
                </div>
            </a>
        </div>
    </section>

    {{-- ══════════ PRODUCTOS DESTACADOS ══════════ --}}
    <section class="dark-section">
        <div class="sec-head">
            <h2 class="sec-title"><i class="bi bi-star-fill me-2" style="color:#f59e0b"></i>Productos Destacados</h2>
            <div class="carousel-nav ms-auto">
                <button class="btn-nav" onclick="scrollCarousel('featured-carousel', -1)"><i class="bi bi-chevron-left"></i></button>
                <button class="btn-nav" onclick="scrollCarousel('featured-carousel', 1)"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
        @if($featured->isEmpty())
        <p class="text-center" style="color:var(--c-muted);padding:32px 0">Aún no hay productos destacados.</p>
        @else
        <div class="prods-carousel-wrapper">
            <div class="prods-row carousel-mode" id="featured-carousel">
                @foreach($featured as $prod)
                @php $dprice = $prod->discount_price ?? $prod->price; @endphp
                <a href="{{ route('product.show', $prod->slug) }}" class="prod-card">
                    <div class="img-wrap">
                        @if($prod->is_featured)<span class="new-badge">⭐ Top</span>@endif
                        <img src="{{ $prod->image }}" alt="{{ $prod->name }}">
                    </div>
                    <div class="info">
                        <div class="name">{{ $prod->name }}</div>
                        @if($prod->discount_price)<div class="old">${{ number_format($prod->price,0,',','.') }}</div>@endif
                        <div class="price">${{ number_format($dprice,0,',','.') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </section>

    <hr class="dark-divider">





    {{-- ══════════ ÚLTIMOS PRODUCTOS ══════════ --}}
    <section class="dark-section">
        <div class="sec-head">
            <h2 class="sec-title"><i class="bi bi-clock-history me-2" style="color:var(--c-blue)"></i>Últimos ingresados</h2>
            <div class="carousel-nav ms-auto">
                <button class="btn-nav" onclick="scrollCarousel('latest-carousel', -1)"><i class="bi bi-chevron-left"></i></button>
                <button class="btn-nav" onclick="scrollCarousel('latest-carousel', 1)"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
        @if($allProducts->isEmpty())
        <p class="text-center" style="color:var(--c-muted);padding:32px 0">Pronto habrá productos disponibles.</p>
        @else
        <div class="prods-carousel-wrapper">
            <div class="prods-row carousel-mode" id="latest-carousel">
                @foreach($allProducts as $prod)
                @php $dprice = $prod->discount_price ?? $prod->price; @endphp
                <a href="{{ route('product.show', $prod->slug) }}" class="prod-card">
                    <div class="img-wrap">
                        @if($prod->discount_price)
                        @php $disc=round((1-$prod->discount_price/$prod->price)*100); @endphp
                        <span class="disc-badge" style="right:8px;left:auto;top:8px;background:var(--c-red);">-{{ $disc }}%</span>
                        @endif
                        
                        @if($prod->created_at >= now()->subDays(7))
                        <span class="new-badge" style="left:8px;right:auto;top:8px;background:#10b981;">NUEVO</span>
                        @endif

                        <img src="{{ $prod->image }}" alt="{{ $prod->name }}">
                        
                        <div class="card-pills-overlay">
                            <span class="card-pill">{{ $prod->category->name }}</span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="name">{{ $prod->name }}</div>
                        @if($prod->discount_price)<div class="old">${{ number_format($prod->price,0,',','.') }}</div>@endif
                        <div class="price">${{ number_format($dprice,0,',','.') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </section>


    <div style="height:48px"></div>
</div>
@endsection