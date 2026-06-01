@extends('layouts.admin')

@section('title', 'Dashboard Principal')

@section('content')
<div class="row g-4 mb-4">
    <!-- Total Productos -->
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <div class="card-body p-4 position-relative z-1">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px; text-transform: uppercase;">Total Productos</h6>
                        <h2 class="fw-bold mb-0">{{ $productsCount }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-20 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                </div>
                <div class="text-success small fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-up-short fs-5"></i> <span>En inventario</span>
                </div>
            </div>
            <!-- Decoración sutil de fondo -->
            <div class="position-absolute bottom-0 end-0 opacity-10 mb-n3 me-n2">
                <i class="bi bi-box-seam" style="font-size: 5rem;"></i>
            </div>
        </div>
    </div>
    
    <!-- Total Categorías -->
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <div class="card-body p-4 position-relative z-1">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px; text-transform: uppercase;">Categorías</h6>
                        <h2 class="fw-bold mb-0">{{ $categoriesCount }}</h2>
                    </div>
                    <div class="bg-info bg-opacity-20 text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-tags fs-4"></i>
                    </div>
                </div>
                <div class="text-info small fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-check2-circle fs-6"></i> <span>Departamentos activos</span>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 opacity-10 mb-n3 me-n2">
                <i class="bi bi-tags" style="font-size: 5rem;"></i>
            </div>
        </div>
    </div>
    
    <!-- Pedidos Pendientes -->
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <div class="card-body p-4 position-relative z-1">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px; text-transform: uppercase;">Pedidos Nuevos</h6>
                        <h2 class="fw-bold mb-0">0</h2>
                    </div>
                    <div class="bg-warning bg-opacity-20 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-cart-check fs-4"></i>
                    </div>
                </div>
                <div class="text-danger small fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-clock fs-6"></i> <span>Pendientes de revisión</span>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 opacity-10 mb-n3 me-n2">
                <i class="bi bi-cart-check" style="font-size: 5rem;"></i>
            </div>
        </div>
    </div>

    <!-- Ganancias -->
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <div class="card-body p-4 position-relative z-1">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px; text-transform: uppercase;">Ganancias (Mes)</h6>
                        <h2 class="fw-bold mb-0">$0</h2>
                    </div>
                    <div class="bg-success bg-opacity-20 text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-currency-dollar fs-4"></i>
                    </div>
                </div>
                <div class="text-muted small fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-bar-chart fs-6"></i> <span>Crecimiento mensual</span>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 opacity-10 mb-n3 me-n2">
                <i class="bi bi-currency-dollar" style="font-size: 5rem;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Últimos Productos -->
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden mb-4">
            <div class="card-header border-bottom border-secondary border-opacity-10 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center" style="background: #0f172a;">
                <h5 class="fw-bold mb-0">Últimos Productos Añadidos</h5>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold">Ver Todo</a>
            </div>
            <div class="card-body p-0">
                @if($latestProducts->isEmpty())
                <div class="py-5 text-center text-muted">
                    <i class="bi bi-inbox fs-1 text-secondary opacity-30 mb-3 d-block"></i>
                    <h6>No hay productos</h6>
                    <p class="small mb-4">Empieza a llenar tu catálogo ahora mismo.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary fw-semibold rounded-pill px-4">Añadir Producto</a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-muted text-uppercase" style="font-size: 0.65rem; font-weight: 700; letter-spacing: 1px; background: rgba(0,0,0,0.1);">
                            <tr>
                                <th class="ps-4 py-2 border-0">Producto</th>
                                <th class="py-2 border-0">Precio</th>
                                <th class="pe-4 py-2 border-0 text-end">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestProducts as $product)
                            <tr>
                                <td class="ps-4 py-3 border-bottom border-secondary border-opacity-10">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="position-relative">
                                            <img src="{{ $product->image }}" class="rounded-3 shadow-sm object-fit-cover" width="42" height="42" alt="{{ $product->name }}">
                                            @if($product->flash_sale)
                                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger" style="padding: 3px; font-size: 0.5rem;">
                                                    <i class="bi bi-lightning-fill"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold" style="font-size: 0.9rem;">{{ $product->name }}</h6>
                                            <span class="text-muted" style="font-size: 0.75rem;">{{ $product->category->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 border-bottom border-secondary border-opacity-10">
                                    <span class="fw-bold">${{ number_format($product->price, 0, ',', '.') }}</span>
                                </td>
                                <td class="pe-4 py-3 border-bottom border-secondary border-opacity-10 text-end">
                                    @if($product->is_active)
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2" style="font-size: 0.65rem;">Activo</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-muted rounded-pill px-2" style="font-size: 0.65rem;">Oculto</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas & Estado del Sistema -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-header border-bottom border-secondary border-opacity-10 pt-4 pb-3 px-4" style="background: #0f172a;">
                <h5 class="fw-bold mb-0">Acciones Rápidas</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary fw-semibold rounded-pill py-2 text-start px-3 d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-plus-lg me-2"></i> Nuevo Producto</span>
                        <i class="bi bi-chevron-right small opacity-50"></i>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary bg-opacity-10 border-secondary border-opacity-25 text-white fw-semibold rounded-pill py-2 text-start px-3 d-flex align-items-center justify-content-between hover-action">
                        <span><i class="bi bi-folder-plus me-2 text-info"></i> Crear Categoría</span>
                        <i class="bi bi-chevron-right small opacity-50"></i>
                    </a>
                    <a href="#" class="btn btn-secondary bg-opacity-10 border-secondary border-opacity-25 text-white fw-semibold rounded-pill py-2 text-start px-3 d-flex align-items-center justify-content-between hover-action">
                        <span><i class="bi bi-megaphone me-2 text-warning"></i> Ofertas Flash</span>
                        <i class="bi bi-chevron-right small opacity-50"></i>
                    </a>
                </div>

                <style>
                    .hover-action {
                        transition: all 0.2s ease;
                        background: rgba(255, 255, 255, 0.05);
                    }
                    .hover-action:hover {
                        background: rgba(255, 255, 255, 0.1) !important;
                        border-color: rgba(255, 255, 255, 0.3) !important;
                        transform: translateX(4px);
                        color: #fff !important;
                    }
                </style>

                <hr class="my-4 opacity-10">

                <div class="system-status">
                    <h6 class="text-muted fw-bold small mb-3 text-uppercase" style="letter-spacing: 1px;">Estado de la Tienda</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="small">Visibilidad</span>
                        <span class="badge bg-success rounded-pill">Público</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="small">Modo Mantenimiento</span>
                        <span class="text-muted small">Desactivado</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="small">Version Laravel</span>
                        <span class="text-muted small">12.0.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
