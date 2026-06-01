@extends('layouts.admin')

@section('title', 'Suscriptores & Campañas')

@section('content')

{{-- Toast de resultado --}}
<div id="toast-result" class="position-fixed bottom-0 end-0 p-3" style="z-index:9999; display:none;">
    <div id="toast-inner" class="toast show align-items-center text-white border-0 rounded-3 shadow-lg" role="alert">
        <div class="d-flex">
            <div class="toast-body fw-semibold" id="toast-msg"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="document.getElementById('toast-result').style.display='none'"></button>
        </div>
    </div>
</div>

<div class="row g-4">

    {{-- ===== PANEL CAMPAÑA ===== --}}
    <div class="col-12">
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
            <div class="card-header border-0 py-3 px-4 d-flex align-items-center gap-2" style="background: linear-gradient(90deg, #1e3a5f, #1e293b);">
                <i class="bi bi-send-fill text-info fs-5"></i>
                <h6 class="mb-0 fw-bold text-white">Enviar Campaña de Email</h6>
                <span class="ms-auto badge bg-info bg-opacity-10 text-info rounded-pill px-3" style="font-size:0.7rem;">{{ $subscribers->count() }} destinatarios</span>
            </div>
            <div class="card-body p-4">
                <div class="row g-4 align-items-start">

                    {{-- Selector --}}
                    <div class="col-lg-5">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:1px;">Seleccionar Plantilla</label>
                        <select id="template-select" class="form-select form-select-lg mb-3" onchange="previewTemplate(this.value)">
                            <option value="">— Elige una plantilla —</option>
                            <option value="oferta_flash">⚡ Oferta Flash — Descuentos por tiempo limitado</option>
                            <option value="nuevo_producto">🆕 Nuevo Producto — Catálogo actualizado</option>
                            <option value="bienvenida">👋 Bienvenida — Email de bienvenida</option>
                            <option value="promo_especial">🎉 Promo Especial — Solo para suscriptores</option>
                        </select>

                        <button id="btn-send" onclick="sendCampaign()" disabled
                            class="btn btn-primary w-100 fw-bold py-3 rounded-3 shadow-sm"
                            style="background: linear-gradient(90deg,#2563eb,#0ea5e9); border:none; font-size:1rem;">
                            <i class="bi bi-send-fill me-2"></i> Enviar a todos los suscriptores
                        </button>

                        <p class="text-muted mt-2 small text-center">
                            <i class="bi bi-info-circle me-1"></i>
                            El email se enviará a <strong class="text-white">{{ $subscribers->count() }}</strong> suscriptor(es) activo(s).
                        </p>
                    </div>

                    {{-- Preview --}}
                    <div class="col-lg-7">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:1px;">Vista Previa</label>
                        <div id="preview-box" class="rounded-3 p-4 text-center" style="background:rgba(0,0,0,0.3); border:1px dashed rgba(255,255,255,0.1); min-height:180px; display:flex; align-items:center; justify-content:center;">
                            <div class="text-muted">
                                <i class="bi bi-envelope-open fs-1 d-block mb-2 opacity-25"></i>
                                <small>Selecciona una plantilla para ver la vista previa</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ===== STATS + TABLA ===== --}}
    <div class="col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 text-white" style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);">
            <div class="card-body p-4 text-center d-flex flex-column justify-content-center py-5">
                <i class="bi bi-envelope-paper-heart fs-1 mb-2 opacity-75"></i>
                <h1 class="fw-bold mb-1" style="font-size: 4rem;">{{ $subscribers->count() }}</h1>
                <p class="mb-0 opacity-75 small text-uppercase" style="letter-spacing: 1px;">Suscriptores Activos</p>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            <div class="card-header border-0 py-3 px-4 d-flex align-items-center justify-content-between" style="background:#0f172a;">
                <span class="fw-semibold small text-muted text-uppercase" style="letter-spacing:1px;">Lista de Suscriptores</span>
                <button class="btn btn-sm btn-outline-success rounded-pill px-3 fw-semibold" onclick="exportToCSV()">
                    <i class="bi bi-file-earmark-excel me-1"></i> Exportar CSV
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-muted text-uppercase" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px; background: #0f172a;">
                            <tr>
                                <th class="ps-4 py-3 border-0">Correo Electrónico</th>
                                <th class="py-3 border-0">Fecha de Registro</th>
                                <th class="py-3 border-0 text-center">Estado</th>
                                <th class="pe-4 py-3 border-0 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $sub)
                            <tr id="row-{{ $sub->id }}">
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-envelope text-primary"></i>
                                        <span class="fw-semibold">{{ $sub->email }}</span>
                                    </div>
                                </td>
                                <td class="py-3 text-muted small">{{ $sub->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Activo</span>
                                </td>
                                <td class="pe-4 py-3 text-end">
                                    <button class="btn btn-sm btn-outline-light border-0 text-danger" onclick="deleteSubscriber({{ $sub->id }}, '{{ $sub->email }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-people fs-1 d-block mb-3 opacity-50"></i>
                                    <h6 class="fw-bold">Aún no hay suscriptores</h6>
                                    <p class="small mb-0">Los correos que los clientes ingresen en el footer de la tienda aparecerán aquí.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
const previews = {
    oferta_flash: {
        badge: '⚡ Oferta Flash',
        headline: '¡Solo por hoy! Precios increíbles en productos seleccionados',
        body: '🔥 Descuentos de hasta 40% OFF · Válido las próximas 24 horas',
        cta: 'Ver Ofertas Ahora →',
        color: '#fbbf24',
    },
    nuevo_producto: {
        badge: '🆕 Nuevo Producto',
        headline: '¡Llegaron novedades a la tienda!',
        body: '✅ Stock disponible ahora · Escríbenos por WhatsApp y te asesoramos',
        cta: 'Ver Nuevos Productos →',
        color: '#4ade80',
    },
    bienvenida: {
        badge: '👋 Bienvenida',
        headline: '¡Gracias por unirte a nuestra comunidad!',
        body: '🎁 Envío prioritario en tu primera compra · Solo menciona este email por WhatsApp',
        cta: 'Explorar la Tienda →',
        color: '#38bdf8',
    },
    promo_especial: {
        badge: '🎉 Promo Especial',
        headline: '¡Una promoción creada especialmente para ti!',
        body: '💜 Beneficio exclusivo · Menciona "SUSCRIPTOR" al escribirnos por WhatsApp',
        cta: 'Reclamar Beneficio →',
        color: '#c084fc',
    },
};

function previewTemplate(val) {
    const box = document.getElementById('preview-box');
    const btn = document.getElementById('btn-send');

    if (!val || !previews[val]) {
        box.innerHTML = `<div class="text-muted"><i class="bi bi-envelope-open fs-1 d-block mb-2 opacity-25"></i><small>Selecciona una plantilla para ver la vista previa</small></div>`;
        btn.disabled = true;
        return;
    }

    const p = previews[val];
    btn.disabled = false;

    box.innerHTML = `
        <div style="width:100%; text-align:left;">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:14px;">
                <div style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#2563eb,#0ea5e9);display:flex;align-items:center;justify-content:center;font-size:18px;">✉️</div>
                <div>
                    <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:1px;">Vista Previa del Email</div>
                    <div style="font-size:13px;font-weight:700;color:#f1f5f9;">${p.badge}</div>
                </div>
            </div>
            <div style="background:rgba(0,0,0,0.4);border-radius:10px;padding:16px;border:1px solid rgba(255,255,255,0.06);">
                <span style="display:inline-block;background:linear-gradient(90deg,#2563eb,#38bdf8);color:#fff;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:3px 12px;border-radius:100px;margin-bottom:10px;">${p.badge}</span>
                <div style="font-size:15px;font-weight:700;color:#f8fafc;margin-bottom:8px;">${p.headline}</div>
                <div style="font-size:13px;color:${p.color};margin-bottom:12px;">${p.body}</div>
                <div style="display:inline-block;background:linear-gradient(90deg,#2563eb,#0ea5e9);color:#fff;font-size:12px;font-weight:700;padding:8px 20px;border-radius:50px;">${p.cta}</div>
            </div>
        </div>
    `;
}

function sendCampaign() {
    const template = document.getElementById('template-select').value;
    if (!template) return;

    const btn = document.getElementById('btn-send');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Enviando...';

    fetch('{{ route("admin.subscribers.campaign") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ template }),
    })
    .then(r => r.json())
    .then(data => {
        showToast(data.message, data.success ? 'success' : 'danger');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-send-fill me-2"></i> Enviar a todos los suscriptores';
    })
    .catch(() => {
        showToast('Error al enviar la campaña.', 'danger');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-send-fill me-2"></i> Enviar a todos los suscriptores';
    });
}

function showToast(msg, type) {
    const wrap  = document.getElementById('toast-result');
    const inner = document.getElementById('toast-inner');
    document.getElementById('toast-msg').textContent = msg;
    inner.className = `toast show align-items-center text-white border-0 rounded-3 shadow-lg bg-${type}`;
    wrap.style.display = 'block';
    setTimeout(() => wrap.style.display = 'none', 5000);
}

function deleteSubscriber(id, email) {
    if (!confirm(`¿Eliminar a ${email}?`)) return;
    fetch(`/admin/subscribers/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const row = document.getElementById(`row-${id}`);
            row.style.transition = 'opacity 0.4s';
            row.style.opacity = '0';
            setTimeout(() => { row.remove(); location.reload(); }, 400);
        }
    });
}

function exportToCSV() {
    let csv = 'Email,Fecha\n';
    document.querySelectorAll('tbody tr').forEach(row => {
        const email = row.querySelector('span.fw-semibold')?.textContent;
        const date  = row.querySelector('td.text-muted')?.textContent.trim();
        if (email && date) csv += `${email},${date}\n`;
    });
    const a = Object.assign(document.createElement('a'), {
        href: URL.createObjectURL(new Blob([csv], { type: 'text/csv' })),
        download: 'suscriptores_centralshop.csv',
    });
    document.body.appendChild(a); a.click(); document.body.removeChild(a);
}
</script>
@endsection
