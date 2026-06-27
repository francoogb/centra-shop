@extends('layouts.admin')

@section('title', 'Usuarios del Panel')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Gestiona los accesos al panel de administración.</p>
    <button class="btn btn-primary rounded-pill px-4 fw-semibold" onclick="openModal()">
        <i class="bi bi-person-plus-fill me-2"></i>Nuevo Usuario
    </button>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted text-uppercase" style="font-size:.75rem;font-weight:600;letter-spacing:.5px;">
                    <tr>
                        <th class="ps-4 py-3 border-0">Usuario</th>
                        <th class="py-3 border-0">Email</th>
                        <th class="py-3 border-0 text-center">Rol</th>
                        <th class="py-3 border-0 text-center">Registro</th>
                        <th class="pe-4 py-3 border-0 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr id="user-row-{{ $user->id }}">
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                     style="width:38px;height:38px;flex-shrink:0;background:linear-gradient(135deg,#2563eb,#38bdf8);font-size:.85rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold" style="font-size:.9rem;">{{ $user->name }}</div>
                                    @if($user->id === auth()->id())
                                        <span style="font-size:.72rem;color:#64748b;">Tú</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-3" style="font-size:.88rem;">{{ $user->email }}</td>
                        <td class="py-3 text-center">
                            @if($user->is_super_admin)
                                <span class="badge rounded-pill px-3" style="background:rgba(245,158,11,.15);color:#f59e0b;font-size:.75rem;">
                                    <i class="bi bi-shield-fill-check me-1"></i>Super Admin
                                </span>
                            @else
                                <span class="badge rounded-pill px-3" style="background:rgba(59,130,246,.12);color:#3b82f6;font-size:.75rem;">
                                    <i class="bi bi-person-fill me-1"></i>Admin
                                </span>
                            @endif
                        </td>
                        <td class="py-3 text-center text-muted" style="font-size:.85rem;">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="pe-4 py-3 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', {{ $user->is_super_admin ? 'true' : 'false' }})">
                                    <i class="bi bi-pencil me-1"></i>Editar
                                </button>
                                @if($user->id !== auth()->id())
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                        onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Crear/Editar Usuario --}}
<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg" style="background:#1e293b;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold text-white" id="modal-title">Nuevo Usuario</h5>
                <button type="button" class="btn-close btn-close-white opacity-50" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <div id="form-error" class="alert alert-danger d-none rounded-3" style="font-size:.85rem;"></div>
                <input type="hidden" id="user-id">

                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Nombre</label>
                    <input type="text" id="user-name" class="form-control rounded-3" style="background:#0f172a;border-color:rgba(255,255,255,.1);color:#f1f5f9;" placeholder="Nombre completo">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Email</label>
                    <input type="email" id="user-email" class="form-control rounded-3" style="background:#0f172a;border-color:rgba(255,255,255,.1);color:#f1f5f9;" placeholder="correo@ejemplo.com">
                </div>
                <div class="mb-3" id="password-field">
                    <label class="form-label text-muted small fw-semibold">Contraseña <span id="password-hint" class="opacity-50">(dejar vacío para no cambiar)</span></label>
                    <input type="password" id="user-password" class="form-control rounded-3" style="background:#0f172a;border-color:rgba(255,255,255,.1);color:#f1f5f9;" placeholder="Mínimo 8 caracteres">
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">Rol</label>
                    <select id="user-role" class="form-select rounded-3" style="background:#0f172a;border-color:rgba(255,255,255,.1);color:#f1f5f9;">
                        <option value="0">Admin — acceso estándar</option>
                        <option value="1">Super Admin — acceso total + gestión de usuarios</option>
                    </select>
                </div>
                <button class="btn btn-primary w-100 rounded-3 fw-semibold py-2" onclick="saveUser()" id="btn-save">
                    Guardar Usuario
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let editingId = null;

function openModal() {
    editingId = null;
    document.getElementById('modal-title').textContent = 'Nuevo Usuario';
    document.getElementById('user-id').value = '';
    document.getElementById('user-name').value = '';
    document.getElementById('user-email').value = '';
    document.getElementById('user-password').value = '';
    document.getElementById('user-role').value = '0';
    document.getElementById('password-hint').style.display = 'none';
    document.getElementById('form-error').classList.add('d-none');
    new bootstrap.Modal(document.getElementById('userModal')).show();
}

function openEditModal(id, name, email, isSuperAdmin) {
    editingId = id;
    document.getElementById('modal-title').textContent = 'Editar Usuario';
    document.getElementById('user-id').value = id;
    document.getElementById('user-name').value = name;
    document.getElementById('user-email').value = email;
    document.getElementById('user-password').value = '';
    document.getElementById('user-role').value = isSuperAdmin ? '1' : '0';
    document.getElementById('password-hint').style.display = '';
    document.getElementById('form-error').classList.add('d-none');
    new bootstrap.Modal(document.getElementById('userModal')).show();
}

function saveUser() {
    const btn = document.getElementById('btn-save');
    const id = document.getElementById('user-id').value;
    const body = {
        name:           document.getElementById('user-name').value,
        email:          document.getElementById('user-email').value,
        password:       document.getElementById('user-password').value,
        is_super_admin: document.getElementById('user-role').value,
    };

    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Guardando...';

    const url    = id ? `/admin/users/${id}` : '/admin/users';
    const method = id ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify(body),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            const err = document.getElementById('form-error');
            err.textContent = Object.values(data.errors || {}).flat().join(' ') || 'Error al guardar.';
            err.classList.remove('d-none');
        }
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = 'Guardar Usuario';
    });
}

function deleteUser(id, name) {
    if (!confirm(`¿Eliminar al usuario "${name}"? Esta acción no se puede deshacer.`)) return;
    fetch(`/admin/users/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const row = document.getElementById(`user-row-${id}`);
            if (row) row.remove();
        }
    });
}
</script>
@endsection
