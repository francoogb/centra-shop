@extends('layouts.app')

@section('seo_title', 'CentralShop')
@section('seo_description', ($currentCategory ? $currentCategory->name : 'Catálogo de Productos') . ' en Chile')
@section('seo_meta_desc', 'Explora ' . ($currentCategory ? $currentCategory->name : 'nuestro catálogo completo') . ' en CentralShop Chile. Los mejores precios con envíos a todo el país. Paga con tarjeta o transferencia.')

@section('styles')
<style>
    [x-cloak] { display: none !important; }

    :root {
        --catalog-bg: #111827;
        --catalog-surface: #1e293b;
        --catalog-surface-soft: #263449;
        --catalog-border: rgba(255,255,255,0.06);
        --catalog-text: #f1f5f9;
        --catalog-muted: #94a3b8;
        --catalog-accent: #3b82f6;
    }

    .catalog-page {
        padding: 24px 0 80px;
        background: var(--catalog-bg);
        color: var(--catalog-text);
        min-height: 80vh;
    }

    .catalog-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 24px;
        color: var(--catalog-muted);
        font-size: 0.78rem;
        font-weight: 500;
    }

    .catalog-breadcrumb a {
        color: var(--catalog-muted);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .catalog-breadcrumb a:hover {
        color: var(--catalog-accent);
    }

    .catalog-breadcrumb .current {
        color: #fff;
        font-weight: 600;
    }

    /* SoloTodo Sidebar Styles */
    .solotodo-sidebar-title {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 16px;
        color: #fff;
    }
    .results-count {
        color: var(--catalog-accent);
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .clear-filters {
        font-size: 0.75rem;
        color: var(--catalog-muted);
        text-decoration: none;
        background: rgba(255,255,255,0.05);
        padding: 4px 10px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .clear-filters:hover {
        background: rgba(255,255,255,0.1);
        color: #fff;
    }
    .filter-section {
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--catalog-border);
    }
    .filter-label {
        font-weight: 700;
        margin-bottom: 14px;
        display: block;
        font-size: 0.8rem;
        color: var(--catalog-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-group-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 700;
        color: #fff;
    }
    .sidebar-link {
        color: var(--catalog-muted);
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 0.88rem;
        display: block;
        padding: 6px 0;
    }
    .sidebar-link:hover {
        color: var(--catalog-accent);
        padding-left: 4px;
    }
    .sidebar-link.active {
        color: #fff;
        font-weight: 700;
        padding-left: 4px;
        border-left: 2px solid var(--catalog-accent);
        padding-left: 10px;
    }

    .form-control {
        background-color: rgba(0,0,0,0.2) !important;
        border-color: var(--catalog-border) !important;
        color: #fff !important;
    }
    .form-control:focus {
        border-color: var(--catalog-accent) !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }
    .form-control::placeholder {
        color: rgba(255,255,255,0.2) !important;
    }

    /* SoloTodo Card Styles */
    .product-card {
        background: var(--catalog-surface);
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--catalog-border);
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        border-color: rgba(59, 130, 246, 0.3);
    }
    .product-image-container {
        background: #0f172a;
        width: 100%;
        padding-bottom: 100%;
        position: relative;
        overflow: hidden;
    }
    .product-card-img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    .product-card:hover .product-card-img {
        transform: translate(-50%, -50%) scale(1.05);
    }
    .product-info-container {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .category-badge {
        background: rgba(59, 130, 246, 0.1);
        color: var(--catalog-accent);
        font-size: 0.65rem;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        align-self: flex-start;
        margin-bottom: 12px;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    .product-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.4;
        margin-bottom: 8px;
        height: 2.8em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .product-price-main {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--catalog-accent);
        margin-bottom: 15px;
    }
    .discount-tag-solotodo {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #ef4444;
        color: #fff;
        font-weight: 800;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 6px;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-view-detail {
        background: rgba(255,255,255,0.05);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.1);
        font-weight: 700;
        font-size: 0.85rem;
        padding: 10px;
        border-radius: 10px;
        transition: all 0.2s;
    }
    .btn-view-detail:hover {
        background: var(--catalog-accent);
        border-color: var(--catalog-accent);
        color: #fff;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #cbd5e1;
    }

    .empty-state i {
        font-size: 4rem;
        color: #475569;
        margin-bottom: 16px;
        display: block;
    }

    .empty-state h5 {
        color: #fff;
    }
</style>
@endsection

@section('content')
@php
    // Logic for categories can be simplified here if needed
@endphp
<div class="catalog-page">
    <div class="container-xl px-3 px-lg-4">
        <nav class="catalog-breadcrumb mb-4" aria-label="breadcrumb">
            <a href="{{ route('home_inicio') }}">Inicio</a>
            <i class="bi bi-chevron-right mx-2"></i>
            <span class="current">Catalogo</span>
        </nav>

        <div class="row g-4">
            <!-- Sidebar Filters (SoloTodo Style) -->
            <div class="col-lg-3">
                <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                <h1 class="solotodo-sidebar-title">{{ $currentCategory ? $currentCategory->name : 'Catalogo' }}</h1>
                <div class="results-count">
                    {{ $products->count() }} resultados
                    <a href="{{ route('catalogo') }}" class="clear-filters">Borrar Filtros</a>
                </div>

                <form action="{{ route('catalogo', $currentCategory?->slug) }}" method="GET">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    <div class="filter-section">
                        <span class="filter-label">Rango de Precio</span>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Min">
                            <span class="text-muted">-</span>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Max">
                        </div>
                        <button type="submit" class="btn btn-accent btn-sm w-100 text-white fw-bold" style="background: var(--catalog-accent);">Filtrar</button>
                    </div>
                </form>

                <div class="filter-section">
                    <div class="filter-group-header">
                        <span>Categorias</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="mt-2">
                        <ul class="list-unstyled">
                            @foreach($categories as $cat)
                            <li class="mb-2">
                                <a href="{{ route('catalogo', $cat->slug) }}" 
                                   class="sidebar-link {{ $currentCategory?->id === $cat->id ? 'active' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="filter-section">
                    <div class="filter-group-header">
                        <span>Estado</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-end mb-4 gap-3 align-items-center">
                    <span class="text-white-50 small fw-bold">Items por pág.</span>
                    <select class="form-select form-select-sm bg-dark text-white border-secondary" style="width: auto;">
                        <option>20</option>
                        <option>40</option>
                    </select>
                </div>

                @if($products->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-box-seam"></i>
                    <h5 class="fw-bold">Sin productos encontrados</h5>
                    <p class="mb-4">Intenta ajustar tus filtros de búsqueda.</p>
                </div>
                @else
                <div class="row g-3">
                    @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="product-card">
                            <div class="product-image-container">
                                @if($product->discount_price)
                                    @php $pct = round((1 - $product->discount_price / $product->price) * 100) @endphp
                                    <div class="discount-tag-solotodo">-{{ $pct }}%</div>
                                @endif
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-card-img">
                            </div>
                            <div class="product-info-container">
                                <div class="category-badge">{{ $product->category->name }}</div>
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                                    <h3 class="product-title">{{ $product->name }}</h3>
                                </a>
                                <div class="product-price-main">
                                    ${{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}
                                </div>
                                
                                <!-- Specs removed to save height -->

                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-light btn-sm mt-auto w-100 py-2" style="border-color: rgba(255,255,255,0.1); font-weight: 700;">
                                    Ver Detalle
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
