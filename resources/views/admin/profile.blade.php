@extends('layouts.admin')

@section('title', 'Mi Perfil')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">

        {{-- Info actual --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                         style="width:52px;height:52px;flex-shrink:0;background:linear-gradient(135deg,#2563eb,#38bdf8);font-size:1.1rem;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-bold" style="font-size:1rem;">{{ auth()->user()->name }}</div>
                        <div class="text-muted small">{{ auth()->user()->email }}</div>
                        <span class="badge rounded-pill mt-1 px-3" style="font-size:.72rem;
                            {{ auth()->user()->is_super_admin ? 'background:rgba(245,158,11,.15);color:#f59e0b;' : 'background:rgba(59,130,246,.12);color:#3b82f6;' }}">
                            {{ auth()->user()->is_super_admin ? '⭐ Super Admin' : 'Admin' }}
                        </span>
                    </div>
                </div>

                <div id="profile-alert" class="alert d-none rounded-3 mb-3" style="font-size:.85rem;"></div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Nombre</label>
                    <input type="text" id="profile-name" class="form-control rounded-3" value="{{ auth()->user()->name }}">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Email</label>
                    <input type="email" id="profile-email" class="form-control rounded-3" value="{{ auth()->user()->email }}">
                </div>
                <button class="btn btn-primary rounded-3 fw-semibold px-4" onclick="saveProfile()">
                    <i class="bi bi-check-lg me-2"></i>Guardar cambios
                </button>
            </div>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header border-0 px-4 pt-4 pb-0 bg-transparent">
                <h6 class="fw-bold mb-0"><i class="bi bi-lock-fill me-2 text-warning"></i>Cambiar Contraseña</h6>
            </div>
            <div class="card-body p-4">
                <div id="pass-alert" class="alert d-none rounded-3 mb-3" style="font-size:.85rem;"></div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Contraseña actual</label>
                    <input type="password" id="current-password" class="form-control rounded-3" placeholder="••••••••">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Nueva contraseña</label>
                    <input type="password" id="new-password" class="form-control rounded-3" placeholder="Mínimo 8 caracteres">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Confirmar nueva contraseña</label>
                    <input type="password" id="confirm-password" class="form-control rounded-3" placeholder="Repetir contraseña">
                </div>
                <button class="btn btn-warning rounded-3 fw-semibold px-4 text-dark" onclick="changePassword()">
                    <i class="bi bi-shield-lock-fill me-2"></i>Actualizar contraseña
                </button>
            </div>
        </div>

    </div>
</div>

<script>
function saveProfile() {
    fetch('/admin/profile', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            name:  document.getElementById('profile-name').value,
            email: document.getElementById('profile-email').value,
        }),
    })
    .then(r => r.json())
    .then(data => showAlert('profile-alert', data.success ? 'Perfil actualizado correctamente.' : (data.message || 'Error.'), data.success ? 'success' : 'danger'));
}

function changePassword() {
    const np = document.getElementById('new-password').value;
    const cp = document.getElementById('confirm-password').value;
    if (np !== cp) return showAlert('pass-alert', 'Las contraseñas no coinciden.', 'danger');

    fetch('/admin/profile/password', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            current_password: document.getElementById('current-password').value,
            new_password:     np,
        }),
    })
    .then(r => r.json().then(data => ({ status: r.status, data })))
    .then(({ status, data }) => {
        if (status === 422) {
            const msg = Object.values(data.errors || {}).flat().join(' ');
            return showAlert('pass-alert', msg, 'danger');
        }
        showAlert('pass-alert', data.message, data.success ? 'success' : 'danger');
        if (data.success) {
            document.getElementById('current-password').value = '';
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
        }
    });
}

function showAlert(id, msg, type) {
    const el = document.getElementById(id);
    el.className = `alert alert-${type} rounded-3 mb-3`;
    el.textContent = msg;
    el.style.fontSize = '.85rem';
    el.classList.remove('d-none');
    setTimeout(() => el.classList.add('d-none'), 5000);
}
</script>
@endsection
