@extends('layouts.admin')

@section('title', 'Gestión de Categorías')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <p class="text-muted mb-0">Administra los departamentos y secciones de la tienda.</p>
        </div>
        <button class="btn btn-primary fw-semibold rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            <i class="bi bi-plus-lg me-1"></i> Nueva Categoría
        </button>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-muted text-uppercase" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px; background: #0f172a;">
                    <tr>
                        <th class="ps-4 py-3 border-0">Ícono</th>
                        <th class="py-3 border-0">Nombre</th>
                        <th class="py-3 border-0">Slug</th>
                        <th class="py-3 border-0 text-center">Estado</th>
                        <th class="pe-4 py-3 border-0 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr id="row-{{ $category->id }}">
                        <td class="ps-4 py-3 border-bottom border-secondary border-opacity-10">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                <i class="bi {{ $category->icon ?? 'bi-tag' }} fs-5"></i>
                            </div>
                        </td>
                        <td class="py-3 border-bottom border-secondary border-opacity-10">
                            <h6 class="mb-0 fw-bold">{{ $category->name }}</h6>
                            <span class="text-muted" style="font-size: 0.7rem;">ID: #{{ $category->id }}</span>
                        </td>
                        <td class="py-3 border-bottom border-secondary border-opacity-10">
                            <code class="text-info bg-dark bg-opacity-50 px-2 py-1 rounded small">{{ $category->slug }}</code>
                        </td>
                        <td class="py-3 border-bottom border-secondary border-opacity-10 text-center">
                            @if($category->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Activa</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-muted rounded-pill px-3">Inactiva</span>
                            @endif
                        </td>
                        <td class="pe-4 py-3 border-bottom border-secondary border-opacity-10 text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <button class="btn btn-sm btn-outline-light border-0 text-primary edit-btn"
                                        title="Editar categoría"
                                        data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-icon="{{ $category->icon }}"
                                        data-active="{{ $category->is_active ? '1' : '0' }}"
                                        data-update-url="{{ route('admin.categories.update', $category->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-light border-0 text-danger delete-btn"
                                        title="Eliminar categoría"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-delete-url="{{ route('admin.categories.destroy', $category->id) }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-tags fs-1 d-block mb-3 opacity-50"></i>
                            <h6 class="fw-bold">No hay categorías creadas</h6>
                            <p class="small mb-0">Haz clic en "Nueva Categoría" para organizar tu tienda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ═══ MODAL: Crear Categoría ═══ --}}
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom-0 px-4 pt-4 pb-0">
        <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle-fill text-primary me-2"></i>Nueva Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-3" id="c-name" placeholder="Ej: Electrónica" required>
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold small">Ícono (Bootstrap Icon)</label>
            <input type="text" class="form-control rounded-3" id="c-icon" placeholder="Ej: bi-laptop">
            <div class="form-text text-muted">Usa nombres de <a href="https://icons.getbootstrap.com/" target="_blank" class="text-primary text-decoration-none">Bootstrap Icons</a>.</div>
          </div>
          <div class="col-12">
            <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="c-active" checked>
                <label class="form-check-label small" for="c-active">Categoría Activa</label>
            </div>
          </div>
        </div>
        <div id="c-error" class="alert alert-danger rounded-3 mt-3 d-none py-2 px-3" style="font-size:.82rem"></div>
      </div>
      <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
        <button class="btn btn-link text-white text-decoration-none rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary rounded-pill px-4 fw-semibold" id="c-save-btn">
          <span class="spinner-border spinner-border-sm me-1 d-none" id="c-spinner"></span>
          <i class="bi bi-check-lg me-1"></i>Guardar Categoría
        </button>
      </div>
    </div>
  </div>
</div>

{{-- ═══ MODAL: Editar Categoría ═══ --}}
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom-0 px-4 pt-4 pb-0">
        <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square text-primary me-2"></i>Editar Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <input type="hidden" id="e-update-url">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-3" id="e-name" required>
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold small">Ícono (Bootstrap Icon)</label>
            <input type="text" class="form-control rounded-3" id="e-icon">
          </div>
          <div class="col-12">
            <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="e-active">
                <label class="form-check-label small" for="e-active">Categoría Activa</label>
            </div>
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

{{-- ═══ MODAL: Eliminar Categoría ═══ --}}
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom-0 px-4 pt-4 pb-0">
        <h5 class="modal-title fw-bold text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Eliminar Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body px-4 py-3">
        <p class="text-muted mb-1">¿Estás seguro de que quieres eliminar esta categoría?</p>
        <p class="fw-bold text-white mb-0" id="d-category-name"></p>
        <div class="alert alert-danger mt-3 rounded-3 py-2 px-3" style="font-size:.82rem; background: rgba(220,38,38,0.1); border-color: rgba(220,38,38,0.2); color: #f87171;">
            <i class="bi bi-exclamation-circle me-1"></i>Se eliminarán también todos los productos asociados.
        </div>
        <input type="hidden" id="d-delete-url">
        <input type="hidden" id="d-category-id">
        <div id="d-error" class="alert alert-danger rounded-3 mt-2 d-none py-2 px-3" style="font-size:.82rem"></div>
      </div>
      <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
        <button class="btn btn-link text-white text-decoration-none rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
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
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    // ─── Crear Categoría ──────────────────────────────────────────────────
    const storeUrl = '{{ route("admin.categories.store") }}';
    document.getElementById('c-save-btn')?.addEventListener('click', function(){
        const err=document.getElementById('c-error'), spin=document.getElementById('c-spinner');
        err.classList.add('d-none'); spin.classList.remove('d-none'); this.disabled=true;
        
        const body = {
            name:      document.getElementById('c-name').value,
            icon:      document.getElementById('c-icon').value || null,
            is_active: document.getElementById('c-active').checked,
        };

        fetch(storeUrl,{
            method:'POST',
            headers:{'X-CSRF-TOKEN':csrf,'Content-Type':'application/json','Accept':'application/json'},
            body:JSON.stringify(body)
        })
        .then(r=>r.json()).then(d=>{
            if(d.success){
                window.location.reload();
            } else {
                const msgs = d.errors ? Object.values(d.errors).flat().join(' ') : (d.message||'Error al guardar.');
                err.textContent=msgs; err.classList.remove('d-none');
            }
        }).catch(()=>{ err.textContent='Error de conexión.'; err.classList.remove('d-none'); })
        .finally(()=>{ spin.classList.add('d-none'); this.disabled=false; });
    });

    // ─── Editar Categoría ─────────────────────────────────────────────────
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            document.getElementById('e-update-url').value = this.dataset.updateUrl;
            document.getElementById('e-name').value       = this.dataset.name;
            document.getElementById('e-icon').value       = this.dataset.icon || '';
            document.getElementById('e-active').checked   = this.dataset.active === '1';
            document.getElementById('e-error').classList.add('d-none');
        });
    });
    document.getElementById('e-save-btn')?.addEventListener('click', function(){
        const url=document.getElementById('e-update-url').value;
        const err=document.getElementById('e-error'), spin=document.getElementById('e-spinner');
        err.classList.add('d-none'); spin.classList.remove('d-none'); this.disabled=true;
        
        const body = {
            name:      document.getElementById('e-name').value,
            icon:      document.getElementById('e-icon').value || null,
            is_active: document.getElementById('e-active').checked,
        };

        fetch(url,{
            method:'PUT',
            headers:{'X-CSRF-TOKEN':csrf,'Content-Type':'application/json','Accept':'application/json'},
            body:JSON.stringify(body)
        })
        .then(r=>r.json()).then(d=>{
            if(d.success){
                window.location.reload();
            } else {
                const msgs = d.errors ? Object.values(d.errors).flat().join(' ') : (d.message||'Error al guardar.');
                err.textContent=msgs; err.classList.remove('d-none');
            }
        }).catch(()=>{ err.textContent='Error de conexión.'; err.classList.remove('d-none'); })
        .finally(()=>{ spin.classList.add('d-none'); this.disabled=false; });
    });

    // ─── Eliminar Categoría ───────────────────────────────────────────────
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            document.getElementById('d-category-name').textContent = this.dataset.name;
            document.getElementById('d-delete-url').value         = this.dataset.deleteUrl;
            document.getElementById('d-category-id').value         = this.dataset.id;
            document.getElementById('d-error').classList.add('d-none');
        });
    });
    document.getElementById('d-confirm-btn')?.addEventListener('click', function(){
        const url=document.getElementById('d-delete-url').value;
        const cid=document.getElementById('d-category-id').value;
        const err=document.getElementById('d-error'), spin=document.getElementById('d-spinner');
        err.classList.add('d-none'); spin.classList.remove('d-none'); this.disabled=true;
        
        fetch(url,{method:'DELETE',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
        .then(r=>r.json()).then(d=>{
            if(d.success){
                const row=document.getElementById('row-'+cid);
                if(row){ row.style.transition='opacity .4s'; row.style.opacity='0'; setTimeout(()=>row.remove(),400); }
                bootstrap.Modal.getInstance(document.getElementById('deleteCategoryModal'))?.hide();
            } else { err.textContent=d.message||'Error al eliminar.'; err.classList.remove('d-none'); }
        }).catch(()=>{ err.textContent='Error de conexión.'; err.classList.remove('d-none'); })
        .finally(()=>{ spin.classList.add('d-none'); this.disabled=false; });
    });
});
</script>
@endsection
