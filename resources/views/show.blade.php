@extends('layouts.app')

@php
    $seoDesc    = $product->name . ' en Chile';
    $seoMetaDesc = 'Compra ' . $product->name . ' en CentralShop Chile. ' . Str::limit(strip_tags($product->description ?? ''), 100, '...') . ' Envíos a todo el país con Starken y Chilexpress.';
    $seoImage   = $product->image ? asset('storage/' . $product->image) : asset('img/home/Banner.png');
@endphp
@section('seo_title', 'CentralShop')
@section('seo_description', $seoDesc)
@section('seo_meta_desc', $seoMetaDesc)
@section('seo_image', $seoImage)

@section('styles')
<style>
    :root {
        --detail-bg: #111827;
        --detail-surface: #1e293b;
        --detail-surface-soft: #263449;
        --detail-surface-strong: #0f172a;
        --detail-border: rgba(255,255,255,0.08);
        --detail-text: #f1f5f9;
        --detail-muted: #94a3b8;
        --detail-blue: #3b82f6;
        --detail-blue-soft: #93c5fd;
        --detail-green: #22c55e;
    }

    .product-page {
        background: var(--detail-bg);
        padding: 40px 0 24px; /* Aumentado de 20px a 40px */
    }

    .detail-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 16px;
        color: var(--detail-muted);
        font-size: 0.78rem;
        font-weight: 600;
    }

    .detail-breadcrumb a {
        color: var(--detail-muted);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .detail-breadcrumb a:hover {
        color: var(--detail-blue-soft);
    }

    .detail-breadcrumb .current {
        color: #e2e8f0;
    }

    .detail-hero {
        padding: 20px 0 40px; /* Mas natural sin el borde */
        position: relative;
    }

    .detail-hero::before {
        content: "";
        position: absolute;
        top: -140px;
        right: -80px;
        width: 340px;
        height: 340px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(59,130,246,0.22) 0%, rgba(59,130,246,0) 72%);
        pointer-events: none;
    }

    .gallery-card {
        position: sticky;
        top: 104px;
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--detail-border);
        border-radius: 24px;
        padding: 32px; /* Mas espacio lateral */
    }

    .gallery-stage {
        position: relative;
        min-height: 430px;
        border-radius: 22px;
        border: 1px solid rgba(255,255,255,0.06);
        background:
            radial-gradient(circle at top right, rgba(59,130,246,0.2), transparent 36%),
            linear-gradient(180deg, #162235 0%, #0d1525 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 28px;
        overflow: hidden;
        cursor: zoom-in;
    }

    .gallery-stage img {
        max-width: 100%;
        max-height: 350px;
        object-fit: contain;
        filter: drop-shadow(0 18px 30px rgba(0,0,0,0.35));
        pointer-events: none;
    }

    .gallery-zoom-hint {
        position: absolute;
        bottom: 14px;
        right: 14px;
        background: rgba(0,0,0,0.55);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.12);
        color: #fff;
        border-radius: 999px;
        padding: 5px 12px;
        font-size: 0.72rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        opacity: 0;
        transition: opacity 0.2s;
        pointer-events: none;
    }

    .gallery-stage:hover .gallery-zoom-hint { opacity: 1; }

    /* Modal lightbox imagen */
    #imgLightboxModal .modal-content {
        background: rgba(5,10,20,0.97);
        border: 1px solid rgba(255,255,255,0.08);
    }
    #imgLightboxModal img {
        max-height: 80vh;
        object-fit: contain;
    }

    .discount-flag {
        position: absolute;
        top: 18px;
        left: 18px;
        background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);
        color: #fff;
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.03em;
        box-shadow: 0 10px 24px rgba(37,99,235,0.28);
    }

    .gallery-meta {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    /* Estilo Pills para Carrusel */
    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 6px;
        border-radius: 10px;
        background-color: var(--detail-blue-soft);
        opacity: 0.3;
        transition: all 0.3s ease;
        border: 0;
    }
    .carousel-indicators .active {
        width: 24px;
        opacity: 1;
        background-color: var(--detail-blue);
    }

    .gallery-thumbs {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        overflow-x: auto;
        padding-bottom: 5px;
    }
    .gallery-thumb {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        border: 2px solid transparent;
        cursor: pointer;
        background: #0f172a;
        padding: 5px;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .gallery-thumb.active {
        border-color: var(--detail-blue);
    }
    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .gallery-meta-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 14px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.05);
        color: #e2e8f0;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .gallery-meta-badge i {
        color: var(--detail-blue-soft);
    }

    .product-meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        padding: 8px 14px;
        background: rgba(59,130,246,0.12);
        border: 1px solid rgba(59,130,246,0.22);
        color: var(--detail-blue-soft);
        font-size: 0.78rem;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .stock-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(34,197,94,0.12);
        border: 1px solid rgba(34,197,94,0.2);
        color: #bbf7d0;
        font-size: 0.78rem;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .stock-chip.is-low {
        background: rgba(245,158,11,0.12);
        border-color: rgba(245,158,11,0.2);
        color: #fde68a;
    }

    .stock-chip.is-off {
        background: rgba(239,68,68,0.12);
        border-color: rgba(239,68,68,0.2);
        color: #fecaca;
    }

    .detail-title {
        font-size: 2.4rem;
        line-height: 1.06;
        letter-spacing: -0.04em;
        color: #fff;
        font-weight: 800;
        margin-bottom: 16px;
    }

    .price-row {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .current-price {
        font-family: 'Outfit', sans-serif;
        font-size: 2.2rem;
        line-height: 1;
        color: var(--detail-blue-soft);
        font-weight: 800;
    }

    .old-price {
        color: #64748b;
        text-decoration: line-through;
        font-size: 0.95rem;
        font-weight: 700;
    }

    .save-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(59,130,246,0.12);
        color: #dbeafe;
        font-size: 0.72rem;
        font-weight: 700;
    }

    .detail-copy {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 22px;
        padding: 26px 30px; /* Mas espacio interno */
        margin-bottom: 24px;
    }

    .detail-copy h2 {
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 12px;
    }

    .detail-copy p {
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.75;
        color: #cbd5e1;
    }

    .description-container {
        position: relative;
        overflow: hidden;
        max-height: 120px; /* Altura inicial para texto corto */
        transition: max-height 0.4s ease;
    }

    .description-container.expanded {
        max-height: 2000px;
    }

    .description-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        background: linear-gradient(to top, var(--detail-surface), transparent);
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 5px;
        transition: opacity 0.3s;
    }

    .description-container.expanded .description-overlay {
        opacity: 0;
        pointer-events: none;
    }

    .read-more-btn {
        background: none;
        border: none;
        color: var(--detail-blue-soft);
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        padding: 5px 10px;
        transition: all 0.2s;
    }

    .read-more-btn:hover {
        color: #fff;
        text-decoration: underline;
    }

    .product-notes {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .product-note {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 14px 16px;
    }

    .product-note span {
        display: block;
        font-size: 0.68rem;
        color: var(--detail-muted);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
    }

    .product-note strong {
        display: block;
        margin-top: 6px;
        color: #fff;
        font-size: 0.88rem;
        font-weight: 700;
    }

    .cta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .btn-detail-primary,
    .btn-detail-secondary {
        min-height: 56px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.92rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        border: 0;
        width: 100%;
    }

    .btn-detail-primary {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
        box-shadow: 0 14px 28px rgba(37,99,235,0.28);
    }

    .btn-detail-primary:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 18px 34px rgba(37,99,235,0.34);
    }

    .btn-detail-secondary {
        background: rgba(37,211,102,0.12);
        color: #86efac;
        border: 1px solid rgba(37,211,102,0.18);
    }

    .btn-detail-secondary:hover {
        color: #dcfce7;
        background: rgba(37,211,102,0.18);
        transform: translateY(-2px);
    }

    .related-section {
        padding-top: 24px;
    }

    .related-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }

    .related-title {
        margin: 0;
        color: #fff;
        font-size: 1.15rem;
        font-weight: 700;
    }

    .related-link {
        color: var(--detail-muted);
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .related-link:hover {
        color: var(--detail-blue-soft);
    }

    .related-card {
        display: block;
        height: 100%;
        text-decoration: none;
        background: var(--detail-surface);
        border: 1px solid var(--detail-border);
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.24s ease;
    }

    .related-card:hover {
        transform: translateY(-3px);
        border-color: rgba(59,130,246,0.35);
        background: var(--detail-surface-soft);
    }

    .related-image {
        height: 180px;
        background: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }

    .related-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .related-body {
        padding: 14px 15px 16px;
    }

    .related-name {
        color: #f8fafc;
        font-size: 0.86rem;
        font-weight: 700;
        line-height: 1.35;
        min-height: 2.3rem;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-price {
        color: var(--detail-blue-soft);
        font-size: 1rem;
        font-weight: 800;
    }

    .modal-buy-guide .modal-dialog {
        max-width: 840px;
    }

    .modal-buy-guide .modal-content {
        background: linear-gradient(180deg, #17263b 0%, #0f172a 100%);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 28px;
        color: #e2e8f0;
        overflow: hidden;
    }

    .modal-buy-guide .btn-close {
        filter: invert(1);
        opacity: 0.82;
    }

    .modal-commercial-side {
        position: relative;
        height: 100%;
        min-height: 100%;
        padding: 24px;
        background:
            linear-gradient(180deg, rgba(15,23,42,0.16), rgba(15,23,42,0.75)),
            radial-gradient(circle at top right, rgba(59,130,246,0.22), transparent 40%),
            linear-gradient(135deg, #1d4ed8 0%, #0f172a 100%);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .modal-commercial-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        align-self: flex-start;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(255,255,255,0.12);
        color: #dbeafe;
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: 0.04em;
    }

    .modal-commercial-copy h3 {
        margin: 0 0 10px;
        font-size: 1.45rem;
        line-height: 1.1;
        color: #fff;
        font-weight: 800;
    }

    .modal-commercial-copy p {
        margin: 0;
        color: #dbeafe;
        font-size: 0.88rem;
        line-height: 1.6;
        max-width: 290px;
    }

    .modal-commercial-image {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 260px;
        padding: 20px 10px 10px;
    }

    .modal-commercial-image img {
        max-width: 100%;
        max-height: 240px;
        object-fit: contain;
        filter: drop-shadow(0 18px 28px rgba(0,0,0,0.38));
    }

    .modal-content-side {
        padding: 24px;
    }

    .modal-content-side .modal-title {
        font-size: 1.14rem;
        font-weight: 700;
        color: #fff;
    }

    .modal-content-side .modal-subtitle {
        margin-top: 6px;
        color: #cbd5e1;
        font-size: 0.86rem;
        line-height: 1.6;
    }

    .buy-step {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 14px 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .buy-step:last-of-type {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .buy-step-number {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        border-radius: 12px;
        background: rgba(59,130,246,0.16);
        color: var(--detail-blue-soft);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
    }

    .buy-step h3 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 6px;
    }

    .buy-step p {
        margin: 0;
        color: #cbd5e1;
        font-size: 0.86rem;
        line-height: 1.55;
    }

    .modal-buy-cta {
        margin-top: 20px;
    }

    @media (max-width: 1199.98px) {
        .detail-title {
            font-size: 2.08rem;
        }

        .gallery-stage {
            min-height: 380px;
        }
    }

    @media (max-width: 991.98px) {
        .detail-hero {
            padding: 20px;
            border-radius: 24px;
        }

        .gallery-card {
            position: static;
        }

        .gallery-stage {
            min-height: 320px;
        }

        .detail-title {
            font-size: 1.8rem;
        }

        .modal-commercial-side {
            min-height: 320px;
        }
    }

    @media (max-width: 767.98px) {
        .product-notes,
        .cta-grid {
            grid-template-columns: 1fr;
        }

        .detail-title {
            font-size: 1.58rem;
        }

        .current-price {
            font-size: 1.84rem;
        }

    }
</style>
@endsection

@section('content')
@php
    $currentPrice = $product->discount_price ?? $product->price;
    $hasDiscount = !is_null($product->discount_price) && $product->price > 0;
    $discountPercent = $hasDiscount ? round((1 - ($product->discount_price / $product->price)) * 100) : null;
    $stockValue = (int) ($product->stock ?? 0);
    $stockClass = $stockValue <= 0 ? 'is-off' : ($stockValue <= 5 ? 'is-low' : '');
    $stockText = $stockValue <= 0 ? 'Consultar disponibilidad' : ($stockValue <= 5 ? "¡Solo $stockValue unidades disponibles!" : "Stock: $stockValue unidades para entrega inmediata");
    $productMessage = urlencode('Hola CentralShop, quiero informacion sobre: ' . $product->name);
@endphp

<div class="product-page">
    <div class="container-xl px-3 px-lg-4">
        <nav class="detail-breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home_inicio') }}">Inicio</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('catalogo') }}">Catalogo</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('catalogo', $product->category->slug) }}">{{ $product->category->name }}</a>
            <i class="bi bi-chevron-right"></i>
            <span class="current">{{ \Illuminate\Support\Str::limit($product->name, 42) }}</span>
        </nav>

        <section class="detail-hero">
            <div class="row g-4 g-xl-5 align-items-start">
                <div class="col-lg-6">
                    <div class="gallery-card">
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Imagen Principal -->
                                <div class="carousel-item active">
                                    <div class="gallery-stage" onclick="openLightbox('{{ $product->image }}')">
                                        @if($hasDiscount)
                                            <span class="discount-flag">-{{ $discountPercent }}% oferta</span>
                                        @endif
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                                        <span class="gallery-zoom-hint"><i class="bi bi-zoom-in"></i> Ver en grande</span>
                                    </div>
                                </div>
                                <!-- Galería Adicional -->
                                @foreach($product->images as $img)
                                    <div class="carousel-item">
                                        <div class="gallery-stage" onclick="openLightbox('{{ $img->image_path }}')">
                                            <img src="{{ $img->image_path }}" alt="{{ $product->name }}">
                                            <span class="gallery-zoom-hint"><i class="bi bi-zoom-in"></i> Ver en grande</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Miniaturas (Opcionales, se mantienen por debajo) --}}
                            @if($product->images->count() > 0)
                                <div class="gallery-thumbs">
                                    <div class="gallery-thumb active" data-bs-target="#productCarousel" data-bs-slide-to="0">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }} - imagen principal">
                                    </div>
                                    @foreach($product->images as $index => $img)
                                        <div class="gallery-thumb" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index + 1 }}">
                                            <img src="{{ $img->image_path }}" alt="{{ $product->name }} - imagen {{ $index + 2 }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product-meta-chip">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Producto destacado
                    </div>

                    <div class="stock-chip {{ $stockClass }}">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ $stockText }}
                    </div>

                    <h1 class="detail-title">{{ $product->name }}</h1>

                    <div class="price-row">
                        <span class="current-price">${{ number_format($currentPrice, 0, ',', '.') }}</span>
                        @if($hasDiscount)
                            <span class="old-price">${{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="save-badge">
                                <i class="bi bi-tag-fill"></i>
                                Ahorras {{ $discountPercent }}%
                            </span>
                        @endif
                    </div>

                    <div class="detail-copy">
                        <h2>Descripcion</h2>
                        <div id="description-container" class="description-container">
                            <p id="product-description">{{ $product->description ?: 'Producto disponible en CentralShop. Si quieres confirmar compatibilidad, tiempo de entrega o resolver dudas, te ayudamos directo por WhatsApp.' }}</p>
                            <div class="description-overlay" id="description-overlay">
                                <button type="button" class="read-more-btn" onclick="toggleDescription()">Leer más <i class="bi bi-chevron-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="product-notes">
                        <div class="product-note">
                            <span>Disponibilidad</span>
                            <strong>{{ $product->stock > 0 ? $product->stock . ' unidades' : 'Sin stock' }}</strong>
                        </div>
                        <div class="product-note">
                            <span>Estado</span>
                            <strong>{{ $product->stock > 0 ? 'Entrega inmediata' : 'Bajo pedido' }}</strong>
                        </div>
                    </div>


                    <div class="cta-grid">
                        <button type="button" class="btn-detail-primary" data-bs-toggle="modal" data-bs-target="#buyGuideModal">
                            <i class="bi bi-question-circle-fill"></i>
                            ¿Cómo comprar?
                        </button>
                        <a href="{{ route('wsp.contact', ['slug' => $product->slug, 'p' => '56942922528']) }}" target="_blank" class="btn-detail-secondary">
                            <i class="bi bi-whatsapp"></i>
                            Comprar por WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

        @if(isset($related) && $related->count() > 0)
            <section class="related-section">
                <div class="related-head">
                    <h2 class="related-title">Tambien podria interesarte</h2>
                    <a href="{{ route('catalogo', $product->category->slug) }}" class="related-link">Ver mas de {{ $product->category->name }}</a>
                </div>

                <div class="row g-3">
                    @foreach($related as $rel)
                        <div class="col-6 col-md-4 col-xl-3">
                            <a href="{{ route('product.show', $rel->slug) }}" class="related-card">
                                <div class="related-image">
                                    <img src="{{ $rel->image }}" alt="{{ $rel->name }}">
                                </div>
                                <div class="related-body">
                                    <div class="related-name">{{ $rel->name }}</div>
                                    <div class="related-price">${{ number_format($rel->discount_price ?? $rel->price, 0, ',', '.') }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</div>

{{-- Lightbox imagen grande --}}
<div class="modal fade" id="imgLightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 text-center p-2">
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" style="z-index:1;"></button>
            <img id="lightbox-img" src="" alt="{{ $product->name }}" class="img-fluid rounded-3 w-100">
        </div>
    </div>
</div>

<div class="modal fade modal-buy-guide" id="buyGuideModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="modal-commercial-side">
                        <div class="modal-commercial-badge">
                            <i class="bi bi-stars"></i>
                            Compra asistida
                        </div>

                        <div class="modal-commercial-image">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>

                        <div class="modal-commercial-copy">
                            <h3>{{ \Illuminate\Support\Str::limit($product->name, 60) }}</h3>
                            <p>Resuelve tus dudas y cierra la compra con acompanamiento directo de CentralShop.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="modal-content-side">
                        <div class="d-flex align-items-start justify-content-between gap-3">
                            <div>
                                <h2 class="modal-title">Como compramos este producto contigo</h2>
                                <p class="modal-subtitle">Por ahora trabajamos con una experiencia guiada, ideal para confirmar stock, tiempos y detalles antes de cerrar la venta.</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>

                        <div class="buy-step">
                            <span class="buy-step-number">1</span>
                            <div>
                                <h3>Nos escribes con el producto</h3>
                                <p>Te llevamos a WhatsApp con el nombre del producto listo para que el contacto sea rapido.</p>
                            </div>
                        </div>

                        <div class="buy-step">
                            <span class="buy-step-number">2</span>
                            <div>
                                <h3>Confirmamos disponibilidad</h3>
                                <p>Revisamos stock, variantes, precio final y cualquier duda tecnica antes de avanzar.</p>
                            </div>
                        </div>

                        <div class="buy-step">
                            <span class="buy-step-number">3</span>
                            <div>
                                <h3>Coordinamos la compra</h3>
                                <p>Terminamos la gestion de manera personalizada mientras el ecommerce sigue creciendo.</p>
                            </div>
                        </div>

                        <div class="modal-buy-cta">
                            <div style="display:flex;flex-direction:column;gap:8px;">
                                <a href="{{ route('wsp.contact', ['slug' => $product->slug, 'p' => '56942922528']) }}" target="_blank"
                                   style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:12px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.18);text-decoration:none;transition:background .2s;"
                                   onmouseover="this.style.background='rgba(34,197,94,0.15)'" onmouseout="this.style.background='rgba(34,197,94,0.08)'">
                                    <i class="bi bi-whatsapp" style="color:#22c55e;font-size:1.1rem;flex-shrink:0;"></i>
                                    <div>
                                        <div style="font-size:0.7rem;color:#64748b;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Contacto Principal</div>
                                        <div style="color:#f1f5f9;font-weight:700;font-size:0.9rem;">+56 9 4292 2528</div>
                                    </div>
                                </a>
                                <a href="{{ route('wsp.contact', ['slug' => $product->slug, 'p' => '56956296148']) }}" target="_blank"
                                   style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:12px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.18);text-decoration:none;transition:background .2s;"
                                   onmouseover="this.style.background='rgba(34,197,94,0.15)'" onmouseout="this.style.background='rgba(34,197,94,0.08)'">
                                    <i class="bi bi-whatsapp" style="color:#22c55e;font-size:1.1rem;flex-shrink:0;"></i>
                                    <div>
                                        <div style="font-size:0.7rem;color:#64748b;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Contacto Secundario</div>
                                        <div style="color:#f1f5f9;font-weight:700;font-size:0.9rem;">+56 9 5629 6148</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        new bootstrap.Modal(document.getElementById('imgLightboxModal')).show();
    }

    function toggleDescription() {
        const container = document.getElementById('description-container');
        const btn = document.querySelector('.read-more-btn');
        container.classList.toggle('expanded');
        
        if (container.classList.contains('expanded')) {
            btn.innerHTML = 'Leer menos <i class="bi bi-chevron-up"></i>';
        } else {
            btn.innerHTML = 'Leer más <i class="bi bi-chevron-down"></i>';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('productCarousel');
        if (carousel) {
            carousel.addEventListener('slide.bs.carousel', function(event) {
                const index = event.to;
                const thumbs = document.querySelectorAll('.gallery-thumb');
                thumbs.forEach(t => t.classList.remove('active'));
                if(thumbs[index]) thumbs[index].classList.add('active');
            });
        }

        // Verificar si la descripción necesita botón
        const container = document.getElementById('description-container');
        const content = document.getElementById('product-description');
        const overlay = document.getElementById('description-overlay');
        
        if (container && content && overlay) {
            if (content.scrollHeight <= 120) {
                overlay.style.display = 'none';
                container.style.maxHeight = 'none';
            }
        }
    });
</script>
@endpush

@push('scripts')
@php
$jsonLd = json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'Product',
            'name'        => $product->name,
            'description' => Str::limit(strip_tags($product->description ?? ''), 200),
            'sku'         => 'CS-' . $product->id,
            'brand'       => ['@type' => 'Brand', 'name' => 'CentralShop'],
            'image'       => $seoImage,
            'category'    => $product->category->name ?? '',
            'offers'      => [
                '@type'           => 'Offer',
                'url'             => route('product.show', $product->slug),
                'priceCurrency'   => 'CLP',
                'price'           => (string) ($product->discount_price ?? $product->price),
                'availability'    => ($product->stock ?? 1) > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                'itemCondition'   => 'https://schema.org/NewCondition',
                'areaServed'      => 'CL',
                'seller'          => ['@type' => 'Organization', 'name' => 'CentralShop', 'url' => 'https://centralshop.cl'],
            ],
        ],
        [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio',   'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $product->category->name ?? 'Catálogo', 'item' => route('catalogo', $product->category->slug ?? '')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $product->name],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp
<script type="application/ld+json">{!! $jsonLd !!}</script>
@endpush

@endsection
