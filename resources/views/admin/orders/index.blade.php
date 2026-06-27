@extends('layouts.admin')

@section('title', 'Contactos WhatsApp')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <p class="text-muted mb-0">Clientes que hicieron clic en "Comprar por WhatsApp".</p>
        <button id="btn-bulk-delete-orders" class="btn btn-sm btn-danger rounded-pill px-3 d-none" onclick="bulkDeleteOrders()">
            <i class="bi bi-trash me-1"></i> Eliminar seleccionados
        </button>
    </div>
</div>

{{-- Tarjetas Resumen --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="rounded-circle d-flex justify-content-center align-items-center" style="width:55px;height:55px;flex-shrink:0;background:#25D366;">
                    <i class="bi bi-whatsapp text-white fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-semibold mb-1" style="font-size:.85rem;">Contactos Totales</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $total }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex justify-content-center align-items-center" style="width:55px;height:55px;flex-shrink:0;">
                    <i class="bi bi-clock-history fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-semibold mb-1" style="font-size:.85rem;">Pendientes de Cierre</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $pendientes }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex justify-content-center align-items-center" style="width:55px;height:55px;flex-shrink:0;">
                    <i class="bi bi-bag-check-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-semibold mb-1" style="font-size:.85rem;">Ventas Concretadas</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $concretadas }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabla --}}
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted text-uppercase" style="font-size:.75rem;font-weight:600;letter-spacing:.5px;">
                    <tr>
                        <th class="ps-4 py-3 border-0">
                            <input type="checkbox" id="select-all-orders" class="form-check-input" onchange="toggleAllOrders(this)">
                        </th>
                        <th class="py-3 border-0">#</th>
                        <th class="py-3 border-0">Fecha</th>
                        <th class="py-3 border-0">Producto</th>
                        <th class="py-3 border-0">Número</th>
                        <th class="py-3 border-0">Estado</th>
                        <th class="pe-4 py-3 border-0 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr id="row-{{ $contact->id }}">
                        <td class="ps-4">
                            <input type="checkbox" class="form-check-input order-check" value="{{ $contact->id }}" onchange="updateBulkBtn()">
                        </td>
                        <td class="text-muted" style="font-size:.85rem;">{{ $contact->id }}</td>
                        <td style="font-size:.85rem;">
                            <div class="fw-semibold">{{ $contact->created_at->format('d/m/Y') }}</div>
                            <div class="text-muted" style="font-size:.78rem;">{{ $contact->created_at->format('H:i') }}</div>
                        </td>
                        <td>
                            <div class="fw-semibold" style="font-size:.9rem;">{{ $contact->product_name }}</div>
                            @if($contact->product)
                                <a href="{{ route('product.show', $contact->product->slug) }}" target="_blank"
                                   class="text-muted text-decoration-none" style="font-size:.78rem;">
                                    Ver producto <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            <a href="https://wa.me/{{ $contact->phone }}" target="_blank"
                               class="text-decoration-none d-flex align-items-center gap-1" style="color:#25D366;font-size:.88rem;font-weight:600;">
                                <i class="bi bi-whatsapp"></i>
                                +{{ substr($contact->phone, 0, 2) }} {{ substr($contact->phone, 2, 1) }} {{ substr($contact->phone, 3, 4) }} {{ substr($contact->phone, 7) }}
                            </a>
                        </td>
                        <td>
                            <span class="badge rounded-pill status-badge-{{ $contact->id }}
                                {{ $contact->status === 'concretada' ? 'bg-success' : 'bg-warning text-dark' }}"
                                style="font-size:.75rem;">
                                {{ $contact->status === 'concretada' ? 'Concretada' : 'Pendiente' }}
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                @if($contact->status === 'pendiente')
                                    <button class="btn btn-sm btn-success rounded-pill px-3"
                                            onclick="updateStatus({{ $contact->id }}, 'concretada')"
                                            title="Marcar como concretada">
                                        <i class="bi bi-check-lg me-1"></i>Concretar
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                            onclick="updateStatus({{ $contact->id }}, 'pendiente')"
                                            title="Revertir a pendiente">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i>Pendiente
                                    </button>
                                @endif
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                        onclick="deleteContact({{ $contact->id }})"
                                        title="Eliminar registro">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-whatsapp fs-1 d-block mb-3 opacity-50" style="color:#25D366;"></i>
                            <h6 class="fw-bold text-dark">Aún no hay contactos registrados</h6>
                            <p class="small mb-0">Cuando un cliente haga clic en "Comprar por WhatsApp", aparecerá aquí automáticamente.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function updateStatus(id, status) {
    fetch(`/admin/orders/${id}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ status }),
    })
    .then(r => r.json())
    .then(() => location.reload());
}

function toggleAllOrders(cb) {
    document.querySelectorAll('.order-check').forEach(c => c.checked = cb.checked);
    updateBulkBtn();
}

function updateBulkBtn() {
    const any = document.querySelectorAll('.order-check:checked').length > 0;
    document.getElementById('btn-bulk-delete-orders').classList.toggle('d-none', !any);
}

function bulkDeleteOrders() {
    const ids = [...document.querySelectorAll('.order-check:checked')].map(c => c.value);
    if (!ids.length) return;
    if (!confirm(`¿Eliminar ${ids.length} registro(s) seleccionado(s)?`)) return;
    fetch('/admin/orders/bulk', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ ids }),
    })
    .then(r => r.json())
    .then(() => location.reload());
}

function deleteContact(id) {
    if (!confirm('¿Eliminar este registro?')) return;
    fetch(`/admin/orders/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(r => r.json())
    .then(() => {
        const row = document.getElementById(`row-${id}`);
        if (row) row.remove();
    });
}
</script>
@endsection
