@extends('layouts.admin')

@section('title', 'Catálogo de Productos')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <p class="text-muted mb-0">Gestiona todos los productos de tu inventario. Activa la etiqueta <span class="badge bg-danger px-2 py-1"><i class="bi bi-lightning-charge-fill me-1"></i>Oferta Flash</span> para mostrarlos en el banner del inicio.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary fw-semibold rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#batchUploadModal">
                <i class="bi bi-file-earmark-spreadsheet me-1"></i> Añadir por Lote
            </button>
            <button class="btn btn-primary fw-semibold rounded-pill px-4 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#createProductModal">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Producto
            </button>
        </div>
    </div>
</div>

{{-- ─── Barra de Filtros ─── --}}
<div class="card border-0 shadow-sm rounded-4 mb-3 px-4 py-3" style="background:#1e293b;">
    <div class="row g-2 align-items-center">
        <div class="col-12 col-md-4">
            <div class="input-group input-group-sm">
                <span class="input-group-text border-0" style="background:rgba(0,0,0,.3);color:#94a3b8;"><i class="bi bi-search"></i></span>
                <input type="text" id="filter-search" class="form-control border-0 rounded-end" placeholder="Buscar por nombre…" style="background:rgba(0,0,0,.3);color:#f1f5f9;">
            </div>
        </div>
        <div class="col-6 col-md-2">
            <select id="filter-category" class="form-select form-select-sm border-0" style="background:rgba(0,0,0,.3);color:#f1f5f9;">
                <option value="">Categoría</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-md-2">
            <select id="filter-status" class="form-select form-select-sm border-0" style="background:rgba(0,0,0,.3);color:#f1f5f9;">
                <option value="">Estado</option>
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
                <option value="out">Agotado</option>
                <option value="low">Stock bajo</option>
                <option value="flash">Oferta Flash</option>
            </select>
        </div>
        <div class="col-6 col-md-2">
            <select id="filter-sort" class="form-select form-select-sm border-0" style="background:rgba(0,0,0,.3);color:#f1f5f9;">
                <option value="newest">Más recientes</option>
                <option value="oldest">Más antiguos</option>
                <option value="name-az">Nombre A–Z</option>
                <option value="name-za">Nombre Z–A</option>
                <option value="price-asc">Precio ↑</option>
                <option value="price-desc">Precio ↓</option>
                <option value="stock-asc">Stock ↑</option>
                <option value="stock-desc">Stock ↓</option>
            </select>
        </div>
        <div class="col-6 col-md-2 d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 w-100" onclick="clearFilters()">
                <i class="bi bi-x-circle me-1"></i>Limpiar
            </button>
        </div>
        <div class="col-12 col-md-12">
            <div id="filter-count" class="text-muted" style="font-size:.78rem;"></div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="products-table">
                <thead class="text-muted text-uppercase" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px; background: #0f172a;">
                    <tr>
                        <th class="ps-4 py-3 border-0">Producto</th>
                        <th class="py-3 border-0">Categoría</th>
                        <th class="py-3 border-0">Precio</th>
                        <th class="py-3 border-0">Stock</th>
                        <th class="py-3 border-0">Activo</th>
                        <th class="py-3 border-0 text-center" style="white-space:nowrap;">
                            <i class="bi bi-lightning-charge-fill text-danger me-1"></i>Oferta Flash
                        </th>
                        <th class="pe-4 py-3 border-0 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr id="row-{{ $product->id }}"
                        data-name="{{ strtolower($product->name) }}"
                        data-category="{{ $product->category_id }}"
                        data-price="{{ $product->price }}"
                        data-stock="{{ $product->stock }}"
                        data-active="{{ $product->is_active ? '1' : '0' }}"
                        data-flash="{{ $product->flash_sale ? '1' : '0' }}"
                        data-created="{{ $product->created_at->timestamp }}">
                        <td class="ps-4 py-3 border-bottom border-secondary border-opacity-10">
                            <div class="d-flex align-items-center gap-3">
                                <div class="position-relative" style="width:45px;height:45px;flex-shrink:0;">
                                    <img src="{{ $product->image }}" class="rounded-3 shadow-sm object-fit-cover w-100 h-100" alt="{{ $product->name }}">
                                    <button type="button"
                                        class="position-absolute top-0 start-0 w-100 h-100 border-0 p-0 rounded-3 d-flex align-items-center justify-content-center img-preview-btn"
                                        style="background:rgba(0,0,0,0);transition:background .2s;cursor:zoom-in;"
                                        data-img="{{ $product->image }}"
                                        data-name="{{ $product->name }}"
                                        onmouseover="this.style.background='rgba(0,0,0,.5)';this.querySelector('i').style.opacity='1'"
                                        onmouseout="this.style.background='rgba(0,0,0,0)';this.querySelector('i').style.opacity='0'">
                                        <i class="bi bi-zoom-in text-white" style="font-size:1.1rem;opacity:0;transition:opacity .2s;pointer-events:none;"></i>
                                    </button>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold">
                                        @if($product->is_book)<i class="bi bi-book-half text-primary me-1" title="Es Libro"></i>@endif
                                        {{ $product->name }}
                                    </h6>
                                    <span class="text-muted" style="font-size: 0.7rem;">ID: #{{ $product->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 border-bottom border-secondary border-opacity-10 text-muted small">
                            <i class="{{ $product->category->icon ?? 'bi-tag' }} me-1"></i> {{ $product->category->name }}
                        </td>
                        <td class="py-3 border-bottom border-secondary border-opacity-10">
                            <div class="fw-bold">${{ number_format($product->price, 0, ',', '.') }}</div>
                            @if($product->discount_price)
                                <div class="text-danger" style="font-size: 0.7rem;"><i class="bi bi-arrow-down-short"></i> Oferta: ${{ number_format($product->discount_price, 0, ',', '.') }}</div>
                            @endif
                        </td>
                        <td class="py-3 border-bottom border-secondary border-opacity-10">
                            @if($product->stock > 10)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $product->stock }} en stock</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">{{ $product->stock }} (Bajo)</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Agotado</span>
                            @endif
                        </td>
                        <td class="py-3 border-bottom border-secondary border-opacity-10">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" {{ $product->is_active ? 'checked' : '' }}>
                            </div>
                        </td>

                        {{-- ══ FLASH SALE COLUMN ══ --}}
                        <td class="py-3 border-bottom border-secondary border-opacity-10 text-center">
                            <div class="d-flex flex-column align-items-center gap-1">
                                {{-- Toggle switch --}}
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input flash-toggle"
                                           type="checkbox"
                                           role="switch"
                                           id="flash-{{ $product->id }}"
                                           {{ $product->flash_sale ? 'checked' : '' }}
                                           data-product-id="{{ $product->id }}"
                                           data-toggle-url="{{ route('admin.products.toggle-flash', $product->id) }}"
                                           title="Activar / desactivar oferta flash">
                                </div>
                                {{-- Fecha vigencia --}}
                                @if($product->flash_sale)
                                <div class="flash-dates-display" id="dates-{{ $product->id }}" style="font-size: 0.68rem; line-height: 1.4; color:#94a3b8;">
                                    @if($product->flash_sale_ends_at)
                                        <span class="text-danger fw-semibold">
                                            <i class="bi bi-clock-fill me-1"></i>Hasta {{ $product->flash_sale_ends_at->format('d/m/Y H:i') }}
                                        </span>
                                    @else
                                        <span class="text-muted">Sin fecha límite</span>
                                    @endif
                                </div>
                                @else
                                <div class="flash-dates-display" id="dates-{{ $product->id }}" style="display:none;"></div>
                                @endif
                            </div>
                        </td>

                        <td class="pe-4 py-3 border-bottom border-secondary border-opacity-10 text-end">
                            <div class="d-flex justify-content-end gap-1">
                                {{-- Botón configurar fechas flash --}}
                                <button class="btn btn-sm btn-outline-light border-0 text-danger flash-dates-btn"
                                        title="Configurar fechas de oferta flash"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-starts="{{ optional($product->flash_sale_starts_at)->format('Y-m-d\TH:i') }}"
                                        data-ends="{{ optional($product->flash_sale_ends_at)->format('Y-m-d\TH:i') }}"
                                        data-dates-url="{{ route('admin.products.flash-dates', $product->id) }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#flashDatesModal">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-light border-0 text-primary edit-btn"
                                        title="Editar producto"
                                        data-bs-toggle="modal" data-bs-target="#editProductModal"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-category="{{ $product->category_id }}"
                                        data-price="{{ $product->price }}"
                                        data-discount="{{ $product->discount_price }}"
                                        data-stock="{{ $product->stock }}"
                                        data-image="{{ $product->image }}"
                                        data-description="{{ $product->description }}"
                                        data-featured="{{ $product->is_featured ? '1' : '0' }}"
                                        data-active="{{ $product->is_active ? '1' : '0' }}"
                                        data-book="{{ $product->is_book ? '1' : '0' }}"
                                        data-update-url="{{ route('admin.products.update', $product->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-light border-0 text-danger delete-btn"
                                        title="Eliminar producto"
                                        data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-delete-url="{{ route('admin.products.destroy', $product->id) }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1 d-block mb-3 opacity-50"></i>
                            <h6 class="fw-bold">Tu catálogo está vacío</h6>
                            <p class="small mb-0">Añade productos individualmente o impórtalos por lote.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════
     MODAL: Preview de Imagen
════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="imgPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
        <div class="modal-content border-0 rounded-4 shadow-lg" style="background:#0f172a;">
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h6 class="modal-title fw-semibold text-white" id="preview-modal-title"></h6>
                <button type="button" class="btn-close btn-close-white opacity-50" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3 text-center">
                <img id="preview-modal-img" src="" alt="" class="img-fluid rounded-3 shadow-sm" style="max-height:420px;object-fit:contain;background:#1e293b;">
            </div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════
     MODAL: Configurar Fechas de Oferta Flash
════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="flashDatesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                <div>
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-lightning-charge-fill text-danger me-2"></i>Configurar Oferta Flash
                    </h5>
                    <p class="text-muted small mb-0" id="flash-modal-product-name">Cargando...</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-warning alert-sm d-flex gap-2 align-items-start rounded-3 mb-4 py-2 px-3" style="font-size: 0.82rem; background: rgba(255,193,7,0.1); border-color: rgba(255,193,7,0.2); color: #ffc107;">
                    <i class="bi bi-info-circle-fill mt-1 flex-shrink-0"></i>
                    <span>La oferta se mostrará en el banner del inicio mientras esté activa y dentro del rango de fechas. Al pasar la fecha de fin el banner desaparece automáticamente.</span>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Inicio de la oferta</label>
                    <input type="datetime-local" class="form-control rounded-3" id="flash-starts-at" placeholder="Dejar vacío = desde ahora">
                    <div class="form-text text-muted">Dejar vacío para que comience de inmediato.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Fin de la oferta <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control rounded-3" id="flash-ends-at">
                    <div class="form-text text-muted">Dejar vacío = sin fecha límite (no se mostrará countdown).</div>
                </div>

                <div id="flash-modal-error" class="alert alert-danger rounded-3 d-none py-2 px-3" style="font-size: 0.82rem;"></div>
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4 pt-0 gap-2">
                <button type="button" class="btn btn-link text-white text-decoration-none rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger rounded-pill px-4 fw-semibold" id="flash-save-btn">
                    <span class="spinner-border spinner-border-sm me-2 d-none" id="flash-save-spinner" role="status"></span>
                    <i class="bi bi-lightning-charge-fill me-1"></i> Guardar Oferta Flash
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════
     MODAL: Importación Masiva (Batch Upload)
════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="batchUploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Importación Masiva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-4 text-muted">
                    <p class="small mb-2">Sube un archivo <strong>.CSV</strong> o <strong>.XLSX</strong> con el formato de CentralShop para añadir múltiples productos a la vez.</p>
                    <a href="#" class="text-decoration-none small fw-semibold text-primary"><i class="bi bi-download me-1"></i> Descargar plantilla de ejemplo</a>
                </div>
                
                <div class="border rounded-4 p-5 mb-4 position-relative" style="border: 2px dashed rgba(255,255,255,0.1) !important; background-color: rgba(0,0,0,0.1); cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='#38bdf8'; this.style.backgroundColor='rgba(0,0,0,0.2)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.backgroundColor='rgba(0,0,0,0.1)';">
                    <input type="file" class="position-absolute top-0 start-0 w-100 h-100 opacity-0" style="cursor: pointer;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    <i class="bi bi-cloud-arrow-up text-primary mb-2 d-block" style="font-size: 3rem;"></i>
                    <h6 class="fw-bold mt-3 mb-1">Haz clic o arrastra tu archivo aquí</h6>
                    <p class="small text-muted mb-0">Tamaño máximo: 5MB</p>
                </div>

                <div class="d-grid mt-2">
                    <button type="button" class="btn btn-primary fw-bold py-3 rounded-pill shadow-sm">Procesar Importación</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ MODAL: Crear Producto ═══ --}}
<div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom-0 px-4 pt-4 pb-0">
        <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle-fill text-primary me-2"></i>Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row g-3">
          <div class="col-12"><label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label><input type="text" class="form-control rounded-3" id="c-name" required></div>
          <div class="col-md-6"><label class="form-label fw-semibold small">Categoría <span class="text-danger">*</span></label>
            <select class="form-select rounded-3" id="c-category">
              @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach
            </select></div>
          <div class="col-md-3"><label class="form-label fw-semibold small">Precio <span class="text-danger">*</span></label><div class="input-group"><span class="input-group-text bg-dark border-0 text-muted">$</span><input type="number" min="0" step="1" class="form-control rounded-end" id="c-price"></div></div>
          <div class="col-md-3"><label class="form-label fw-semibold small">Precio Oferta</label><div class="input-group"><span class="input-group-text bg-dark border-0 text-muted">$</span><input type="number" min="0" step="1" class="form-control rounded-end" id="c-discount"></div></div>
          <div class="col-md-3"><label class="form-label fw-semibold small">Stock <span class="text-danger">*</span></label><input type="number" min="0" class="form-control rounded-3" id="c-stock" value="0"></div>
          <div class="col-md-6"><label class="form-label fw-semibold small">Imagen Principal <span class="text-danger">*</span></label><input type="file" class="form-control rounded-3" id="c-image" accept="image/*"></div>
          <div class="col-md-6"><label class="form-label fw-semibold small">Galería de Imágenes <span class="text-muted">(Lote)</span></label><input type="file" class="form-control rounded-3" id="c-gallery" accept="image/*" multiple></div>
          <div class="col-12"><label class="form-label fw-semibold small">Descripción</label><textarea class="form-control rounded-3" id="c-description" rows="3"></textarea></div>
          <div class="col-md-6 d-flex align-items-center gap-3">
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="c-featured"><label class="form-check-label small" for="c-featured">Destacado</label></div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="c-active" checked><label class="form-check-label small" for="c-active">Activo</label></div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="c-book"><label class="form-check-label small" for="c-book"><i class="bi bi-book me-1"></i>Es Libro</label></div>
          </div>
        </div>
        <div id="c-error" class="alert alert-danger rounded-3 mt-3 d-none py-2 px-3" style="font-size:.82rem"></div>
      </div>
      <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
        <button class="btn btn-link text-white text-decoration-none rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary rounded-pill px-4 fw-semibold" id="c-save-btn">
          <span class="spinner-border spinner-border-sm me-1 d-none" id="c-spinner"></span>
          <i class="bi bi-check-lg me-1"></i>Guardar Producto
        </button>
      </div>
    </div>
  </div>
</div>

{{-- ═══ MODAL: Editar Producto ═══ --}}
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom-0 px-4 pt-4 pb-0">
        <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square text-primary me-2"></i>Editar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <input type="hidden" id="e-id">
        <input type="hidden" id="e-update-url">
        <div class="row g-3">
          <div class="col-12"><label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label><input type="text" class="form-control rounded-3" id="e-name" required></div>
          <div class="col-md-6"><label class="form-label fw-semibold small">Categoría <span class="text-danger">*</span></label>
            <select class="form-select rounded-3" id="e-category">
              @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach
            </select></div>
          <div class="col-md-3"><label class="form-label fw-semibold small">Precio <span class="text-danger">*</span></label><div class="input-group"><span class="input-group-text bg-dark border-0 text-muted">$</span><input type="number" min="0" step="1" class="form-control rounded-end" id="e-price"></div></div>
          <div class="col-md-3"><label class="form-label fw-semibold small">Precio Oferta</label><div class="input-group"><span class="input-group-text bg-dark border-0 text-muted">$</span><input type="number" min="0" step="1" class="form-control rounded-end" id="e-discount"></div></div>
          <div class="col-md-3"><label class="form-label fw-semibold small">Stock <span class="text-danger">*</span></label><input type="number" min="0" class="form-control rounded-3" id="e-stock"></div>
          <div class="col-md-6"><label class="form-label fw-semibold small">Cambiar Imagen Principal</label><input type="file" class="form-control rounded-3" id="e-image" accept="image/*"></div>
          <div class="col-md-6"><label class="form-label fw-semibold small">Añadir a la Galería <span class="text-muted">(Lote)</span></label><input type="file" class="form-control rounded-3" id="e-gallery" accept="image/*" multiple></div>
          <div class="col-12"><label class="form-label fw-semibold small">Descripción</label><textarea class="form-control rounded-3" id="e-description" rows="3"></textarea></div>
          <div class="col-md-6 d-flex align-items-center gap-3">
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="e-featured"><label class="form-check-label small" for="e-featured">Destacado</label></div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="e-active"><label class="form-check-label small" for="e-active">Activo</label></div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="e-book"><label class="form-check-label small" for="e-book"><i class="bi bi-book me-1"></i>Es Libro</label></div>
          </div>
        </div>
        <div id="e-error" class="alert alert-danger rounded-3 mt-3 d-none py-2 px-3" style="font-size:.82rem"></div>
      </div>
      <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
        <button class="btn btn-link text-white text-decoration-none rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary rounded-pill px-4 fw-semibold" id="e-save-btn">
          <span class="spinner-border spinner-border-sm me-1 d-none" id="e-spinner"></span>
          <i class="bi bi-check-lg me-1"></i>Guardar Cambios
        </button>
      </div>
    </div>
  </div>
</div>

{{-- ═══ MODAL: Eliminar Producto ═══ --}}
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom-0 px-4 pt-4 pb-0">
        <h5 class="modal-title fw-bold text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Eliminar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body px-4 py-3">
        <p class="text-muted mb-1">¿Estás seguro de que quieres eliminar este producto?</p>
        <p class="fw-bold text-dark mb-0" id="d-product-name"></p>
        <div class="alert alert-danger mt-3 rounded-3 py-2 px-3" style="font-size:.82rem"><i class="bi bi-exclamation-circle me-1"></i>Esta acción <strong>no se puede deshacer</strong>.</div>
        <input type="hidden" id="d-delete-url">
        <input type="hidden" id="d-product-id">
        <div id="d-error" class="alert alert-danger rounded-3 mt-2 d-none py-2 px-3" style="font-size:.82rem"></div>
      </div>
      <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
        <button class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-danger rounded-pill px-4 fw-semibold" id="d-confirm-btn">
          <span class="spinner-border spinner-border-sm me-1 d-none" id="d-spinner"></span>
          <i class="bi bi-trash me-1"></i>Sí, eliminar
        </button>
      </div>
    </div>
  </div>
</div>

{{-- ════ SCRIPTS ════ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

    // ─── Preview Imagen ──────────────────────────────────────────────────
    const previewModal = new bootstrap.Modal(document.getElementById('imgPreviewModal'));
    document.querySelectorAll('.img-preview-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('preview-modal-img').src   = this.dataset.img;
            document.getElementById('preview-modal-img').alt   = this.dataset.name;
            document.getElementById('preview-modal-title').textContent = this.dataset.name;
            previewModal.show();
        });
    });

    // ─── Flash Toggle ────────────────────────────────────────────────────
    document.querySelectorAll('.flash-toggle').forEach(toggle => {
        toggle.addEventListener('change', function () {
            const pid = this.dataset.productId, url = this.dataset.toggleUrl;
            const dd = document.getElementById('dates-' + pid), was = this.checked;
            this.disabled = true;
            fetch(url, {method:'POST',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
            .then(r=>r.json()).then(d=>{ if(d.success){ if(dd) dd.style.display=d.flash_sale?'':'none'; const row=this.closest('tr'); if(row) row.dataset.flash=d.flash_sale?'1':'0'; } else this.checked=!was; })
            .catch(()=>{ this.checked=!was; }).finally(()=>{ this.disabled=false; });
        });
    });

    // ─── Flash Dates Modal ───────────────────────────────────────────────
    let fId=null, fUrl=null;
    document.querySelectorAll('.flash-dates-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            fId=this.dataset.productId; fUrl=this.dataset.datesUrl;
            document.getElementById('flash-modal-product-name').textContent=this.dataset.productName;
            document.getElementById('flash-starts-at').value=this.dataset.starts||'';
            document.getElementById('flash-ends-at').value=this.dataset.ends||'';
            document.getElementById('flash-modal-error').classList.add('d-none');
        });
    });
    document.getElementById('flash-save-btn')?.addEventListener('click', function(){
        if(!fUrl) return;
        const s=document.getElementById('flash-starts-at').value, e=document.getElementById('flash-ends-at').value;
        const err=document.getElementById('flash-modal-error'), spin=document.getElementById('flash-save-spinner');
        err.classList.add('d-none'); spin.classList.remove('d-none'); this.disabled=true;
        fetch(fUrl,{method:'POST',headers:{'X-CSRF-TOKEN':csrf,'Content-Type':'application/json','Accept':'application/json'},body:JSON.stringify({flash_sale_starts_at:s||null,flash_sale_ends_at:e||null})})
        .then(r=>r.json()).then(d=>{
            if(d.success){
                const tog=document.getElementById('flash-'+fId); if(tog) tog.checked=true;
                const dd=document.getElementById('dates-'+fId);
                if(dd){ dd.innerHTML=e?`<span class="text-danger fw-semibold"><i class="bi bi-clock-fill me-1"></i>Hasta ${new Date(e).toLocaleDateString('es-CL')} ${new Date(e).toLocaleTimeString('es-CL',{hour:'2-digit',minute:'2-digit'})}</span>`:`<span class="text-muted">Sin fecha límite</span>`; dd.style.display=''; }
                bootstrap.Modal.getInstance(document.getElementById('flashDatesModal'))?.hide();
            } else { err.textContent=d.message||'Error al guardar.'; err.classList.remove('d-none'); }
        }).catch(()=>{ err.textContent='Error de conexión.'; err.classList.remove('d-none'); })
        .finally(()=>{ spin.classList.add('d-none'); this.disabled=false; });
    });

    // ─── Crear Producto ──────────────────────────────────────────────────
    const storeUrl = '{{ route("admin.products.store") }}';
    document.getElementById('c-save-btn')?.addEventListener('click', function(){
        const err=document.getElementById('c-error'), spin=document.getElementById('c-spinner');
        err.classList.add('d-none'); spin.classList.remove('d-none'); this.disabled=true;
        
        const formData = new FormData();
        formData.append('name', document.getElementById('c-name').value);
        formData.append('category_id', document.getElementById('c-category').value);
        formData.append('price', document.getElementById('c-price').value);
        formData.append('discount_price', document.getElementById('c-discount').value || '');
        formData.append('stock', document.getElementById('c-stock').value);
        formData.append('description', document.getElementById('c-description').value || '');
        formData.append('is_featured', document.getElementById('c-featured').checked ? '1' : '0');
        formData.append('is_active', document.getElementById('c-active').checked ? '1' : '0');
        formData.append('is_book', document.getElementById('c-book').checked ? '1' : '0');
        
        const fileInput = document.getElementById('c-image');
        if(fileInput.files.length > 0) {
            formData.append('image', fileInput.files[0]);
        }

        const galleryInput = document.getElementById('c-gallery');
        if(galleryInput.files.length > 0) {
            for(let i=0; i<galleryInput.files.length; i++) {
                formData.append('gallery[]', galleryInput.files[i]);
            }
        }

        fetch(storeUrl,{method:'POST',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'},body:formData})
        .then(r=>r.json()).then(d=>{
            if(d.success){
                bootstrap.Modal.getInstance(document.getElementById('createProductModal'))?.hide();
                window.location.reload();
            } else {
                const msgs = d.errors ? Object.values(d.errors).flat().join(' ') : (d.message||'Error al guardar.');
                err.textContent=msgs; err.classList.remove('d-none');
            }
        }).catch(()=>{ err.textContent='Error de conexión.'; err.classList.remove('d-none'); })
        .finally(()=>{ spin.classList.add('d-none'); this.disabled=false; });
    });
    document.getElementById('createProductModal')?.addEventListener('hidden.bs.modal', ()=>{
        ['c-name','c-price','c-discount','c-stock','c-image','c-description'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value=''; });
        document.getElementById('c-featured').checked=false;
        document.getElementById('c-active').checked=true;
        document.getElementById('c-error').classList.add('d-none');
    });

    // ─── Editar Producto ─────────────────────────────────────────────────
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            document.getElementById('e-id').value          = this.dataset.id;
            document.getElementById('e-update-url').value  = this.dataset.updateUrl;
            document.getElementById('e-name').value        = this.dataset.name;
            document.getElementById('e-category').value   = this.dataset.category;
            document.getElementById('e-price').value       = this.dataset.price;
            document.getElementById('e-discount').value    = this.dataset.discount||'';
            document.getElementById('e-stock').value       = this.dataset.stock;
            document.getElementById('e-image').value       = ''; // Reset file input
            document.getElementById('e-description').value = this.dataset.description||'';
            document.getElementById('e-featured').checked  = this.dataset.featured==='1';
            document.getElementById('e-active').checked    = this.dataset.active==='1';
            document.getElementById('e-book').checked      = this.dataset.book==='1';
            document.getElementById('e-error').classList.add('d-none');
        });
    });
    document.getElementById('e-save-btn')?.addEventListener('click', function(){
        const url=document.getElementById('e-update-url').value;
        const err=document.getElementById('e-error'), spin=document.getElementById('e-spinner');
        err.classList.add('d-none'); spin.classList.remove('d-none'); this.disabled=true;
        
        const formData = new FormData();
        formData.append('name', document.getElementById('e-name').value);
        formData.append('category_id', document.getElementById('e-category').value);
        formData.append('price', document.getElementById('e-price').value);
        formData.append('discount_price', document.getElementById('e-discount').value || '');
        formData.append('stock', document.getElementById('e-stock').value);
        formData.append('description', document.getElementById('e-description').value || '');
        formData.append('is_featured', document.getElementById('e-featured').checked ? '1' : '0');
        formData.append('is_active', document.getElementById('e-active').checked ? '1' : '0');
        formData.append('is_book', document.getElementById('e-book').checked ? '1' : '0');
        formData.append('_method', 'PUT');
        
        const fileInput = document.getElementById('e-image');
        if(fileInput.files.length > 0) {
            formData.append('image', fileInput.files[0]);
        }

        const galleryInput = document.getElementById('e-gallery');
        if(galleryInput.files.length > 0) {
            for(let i=0; i<galleryInput.files.length; i++) {
                formData.append('gallery[]', galleryInput.files[i]);
            }
        }

        fetch(url,{method:'POST',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'},body:formData})
        .then(r=>r.json()).then(d=>{
            if(d.success){
                bootstrap.Modal.getInstance(document.getElementById('editProductModal'))?.hide();
                window.location.reload();
            } else {
                const msgs = d.errors ? Object.values(d.errors).flat().join(' ') : (d.message||'Error al guardar.');
                err.textContent=msgs; err.classList.remove('d-none');
            }
        }).catch(()=>{ err.textContent='Error de conexión.'; err.classList.remove('d-none'); })
        .finally(()=>{ spin.classList.add('d-none'); this.disabled=false; });
    });

    // ─── Eliminar Producto ───────────────────────────────────────────────
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            document.getElementById('d-product-name').textContent = this.dataset.name;
            document.getElementById('d-delete-url').value         = this.dataset.deleteUrl;
            document.getElementById('d-product-id').value         = this.dataset.id;
            document.getElementById('d-error').classList.add('d-none');
        });
    });
    document.getElementById('d-confirm-btn')?.addEventListener('click', function(){
        const url=document.getElementById('d-delete-url').value;
        const pid=document.getElementById('d-product-id').value;
        const err=document.getElementById('d-error'), spin=document.getElementById('d-spinner');
        err.classList.add('d-none'); spin.classList.remove('d-none'); this.disabled=true;
        fetch(url,{method:'DELETE',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
        .then(r=>r.json()).then(d=>{
            if(d.success){
                bootstrap.Modal.getInstance(document.getElementById('deleteProductModal'))?.hide();
                const row=document.getElementById('row-'+pid);
                if(row){ row.style.transition='opacity .4s'; row.style.opacity='0'; setTimeout(()=>row.remove(),400); }
            } else { err.textContent=d.message||'Error al eliminar.'; err.classList.remove('d-none'); }
        }).catch(()=>{ err.textContent='Error de conexión.'; err.classList.remove('d-none'); })
        .finally(()=>{ spin.classList.add('d-none'); this.disabled=false; });
    });
});

// ─── Filtros ─────────────────────────────────────────────────────────────────
function applyFilters() {
    const search   = document.getElementById('filter-search').value.toLowerCase().trim();
    const category = document.getElementById('filter-category').value;
    const status   = document.getElementById('filter-status').value;
    const sort     = document.getElementById('filter-sort').value;

    const tbody = document.querySelector('#products-table tbody');
    const rows  = Array.from(tbody.querySelectorAll('tr[data-name]'));

    let visible = 0;

    rows.forEach(row => {
        const name    = row.dataset.name;
        const cat     = row.dataset.category;
        const price   = parseFloat(row.dataset.price);
        const stock   = parseInt(row.dataset.stock);
        const active  = row.dataset.active === '1';
        const flash   = row.dataset.flash  === '1';

        let show = true;

        if (search   && !name.includes(search))  show = false;
        if (category && cat !== category)         show = false;

        if (status === 'active'   && !active)       show = false;
        if (status === 'inactive' && active)        show = false;
        if (status === 'out'      && stock !== 0)   show = false;
        if (status === 'low'      && (stock === 0 || stock > 10)) show = false;
        if (status === 'flash'    && !flash)        show = false;

        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    // Ordenar filas visibles
    const visibleRows = rows.filter(r => r.style.display !== 'none');
    visibleRows.sort((a, b) => {
        switch (sort) {
            case 'oldest':    return parseInt(a.dataset.created) - parseInt(b.dataset.created);
            case 'name-az':   return a.dataset.name.localeCompare(b.dataset.name);
            case 'name-za':   return b.dataset.name.localeCompare(a.dataset.name);
            case 'price-asc': return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
            case 'price-desc':return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
            case 'stock-asc': return parseInt(a.dataset.stock)   - parseInt(b.dataset.stock);
            case 'stock-desc':return parseInt(b.dataset.stock)   - parseInt(a.dataset.stock);
            default:          return parseInt(b.dataset.created) - parseInt(a.dataset.created); // newest
        }
    });
    visibleRows.forEach(r => tbody.appendChild(r));

    const total = rows.length;
    const countEl = document.getElementById('filter-count');
    countEl.textContent = visible === total
        ? `${total} productos en total`
        : `Mostrando ${visible} de ${total} productos`;
}

function clearFilters() {
    document.getElementById('filter-search').value   = '';
    document.getElementById('filter-category').value = '';
    document.getElementById('filter-status').value   = '';
    document.getElementById('filter-sort').value     = 'newest';
    applyFilters();
}

document.addEventListener('DOMContentLoaded', function () {
    ['filter-search','filter-category','filter-status','filter-sort'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', applyFilters);
    });
    applyFilters();
});
</script>
@endsection
