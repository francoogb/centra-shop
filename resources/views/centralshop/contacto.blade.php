@extends('layouts.app')

@section('seo_title', 'CentralShop')
@section('seo_description', 'Contacto y Atención al Cliente')
@section('seo_meta_desc', 'Contáctanos por WhatsApp o formulario. Atención personalizada de lunes a sábado. CentralShop, tu tienda online en Chile.')

@section('title', 'Contacto — CentralShop')

@section('styles')
<style>
    .info-page { background: #0f172a; color: #f1f5f9; padding: 60px 0 100px; min-height: 70vh; }
    .info-card { background: #1e293b; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 36px; }
    .online-badge { background: rgba(34,197,94,0.1); color: #22c55e; padding: 6px 16px; border-radius: 30px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 20px; }
    .contact-item { display: flex; align-items: center; gap: 16px; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.06); transition: transform 0.2s; }
    .contact-item:last-child { border-bottom: none; }
    .contact-item:hover { transform: translateX(6px); }
    .contact-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
    .form-control, .form-select { background: #0f172a !important; border-color: rgba(255,255,255,0.1) !important; color: #f1f5f9 !important; padding: 12px 16px; border-radius: 10px; font-size: 0.93rem; }
    .form-control:focus, .form-select:focus { border-color: #3b82f6 !important; box-shadow: 0 0 0 3px rgba(59,130,246,0.15) !important; }
    .form-control::placeholder { color: #475569 !important; }
    .form-label { font-size: 0.83rem; font-weight: 600; color: #94a3b8; margin-bottom: 6px; }
    .wsp-btn { background: linear-gradient(90deg,#15803d,#16a34a); color: #fff; border: none; border-radius: 50px; padding: 14px 28px; font-weight: 700; font-size: 1rem; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; transition: opacity 0.2s; }
    .wsp-btn:hover { opacity: 0.9; color: #fff; }
    .schedule-box { background: rgba(59,130,246,0.06); border: 1px solid rgba(59,130,246,0.15); border-radius: 12px; padding: 16px 18px; margin-top: 20px; }
    #form-success { display: none; background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25); border-radius: 12px; padding: 20px; color: #4ade80; text-align: center; }
    #form-success i { font-size: 2rem; display: block; margin-bottom: 8px; }
    .text-muted { color: #64748b !important; }
</style>
@endsection

@section('content')
<div class="info-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="text-center mb-5">
                    <span class="online-badge">
                        <span style="width:8px;height:8px;background:#22c55e;border-radius:50%;display:inline-block;"></span>
                        Tienda 100% Online — Solo Chile
                    </span>
                    <h1 class="fw-bold text-white mb-3">Ponte en contacto</h1>
                    <p class="text-muted mx-auto" style="max-width:580px;">Operamos exclusivamente en Chile a través de nuestra plataforma digital. Respondemos rápido por WhatsApp o puedes dejarnos un mensaje.</p>
                </div>

                <div class="row g-4">

                    {{-- Banner Comercial e Info --}}
                    <div class="col-md-5">
                        <div class="info-card h-100 d-flex flex-column p-0 overflow-hidden" style="position:relative;">
                            <!-- Banner de Fondo -->
                            <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:url('{{ asset('img/home/Banner.png') }}') center center / cover no-repeat; z-index:0;"></div>
                            <!-- Overlay oscuro para legibilidad -->
                            <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(180deg, rgba(15,23,42,0.7) 0%, rgba(15,23,42,0.95) 100%); z-index:1;"></div>

                            <div class="p-4 p-lg-5" style="position:relative; z-index:2; flex-grow:1;">
                                <h3 class="fw-bold text-white mb-4" style="font-family:'Outfit',sans-serif; line-height:1.2;">¿Tienes alguna duda o necesitas ayuda?</h3>
                                <p class="text-white-50 mb-4" style="font-size:1rem; line-height:1.7;">
                                    Estamos aquí para asesorarte en tu próxima compra. En <span class="text-white fw-bold">CentralShop</span> nos apasiona brindarte la mejor experiencia digital en Chile, con productos seleccionados y atención humana a un clic de distancia.
                                </p>

                                <div class="d-flex flex-column gap-3 mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="contact-icon bg-primary bg-opacity-20 text-primary" style="width:36px;height:36px;font-size:1rem;">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <span class="text-white small fw-semibold">Garantía de Satisfacción</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="contact-icon bg-primary bg-opacity-20 text-primary" style="width:36px;height:36px;font-size:1rem;">
                                            <i class="bi bi-truck"></i>
                                        </div>
                                        <span class="text-white small fw-semibold">Envíos Seguros a todo Chile</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 p-lg-5 pt-0" style="position:relative; z-index:2;">
                                <div class="schedule-box m-0" style="background:rgba(255,255,255,0.05); border-color:rgba(255,255,255,0.1);">
                                    <div class="small fw-bold text-white mb-2" style="letter-spacing:0.5px;">
                                        <i class="bi bi-clock me-1 text-primary"></i> HORARIO DE ATENCIÓN
                                    </div>
                                    <div class="small text-white-50 lh-lg" style="font-size:0.75rem;">
                                        LUNES A VIERNES: 09:00 – 19:00<br>
                                        SÁBADOS: 10:00 – 14:00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario --}}
                    <div class="col-md-7">
                        <div class="info-card">
                            <h5 class="fw-bold text-white mb-1">Envíanos un mensaje</h5>
                            <p class="text-muted small mb-4">Te respondemos a la brevedad en horario de atención.</p>

                            <div id="form-success">
                                <i class="bi bi-check-circle-fill"></i>
                                <div class="fw-bold fs-6 mb-1">¡Mensaje enviado!</div>
                                <div class="small opacity-75">Nos comunicaremos contigo a la brevedad.</div>
                            </div>

                            <form id="contact-form">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nombre Completo *</label>
                                        <input type="text" name="name" class="form-control" placeholder="Ej: Juan Pérez" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Correo Electrónico *</label>
                                        <input type="email" name="email" class="form-control" placeholder="tu@correo.cl" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Asunto *</label>
                                        <select name="subject" class="form-control form-select" required>
                                            <option value="" disabled selected>Selecciona una opción</option>
                                            <option>Consulta sobre un producto</option>
                                            <option>Estado de mi pedido</option>
                                            <option>Devoluciones o Garantía</option>
                                            <option>Problema con mi compra</option>
                                            <option>Sugerencia</option>
                                            <option>Otro</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Tu Mensaje *</label>
                                        <textarea name="message" class="form-control" rows="4" placeholder="Cuéntanos en qué podemos ayudarte..." required></textarea>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button type="submit" id="btn-contact" class="btn btn-primary fw-bold py-3 w-100 rounded-pill shadow-sm" style="font-size:1rem;">
                                            <i class="bi bi-send-fill me-2"></i> Enviar Mensaje
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btn-contact');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Enviando...';

    const data = new FormData(this);

    fetch('{{ route("contacto.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('[name=_token]').value,
            'Accept': 'application/json',
        },
        body: data,
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            document.getElementById('contact-form').style.display = 'none';
            document.getElementById('form-success').style.display = 'block';
        } else {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-send-fill me-2"></i> Enviar Mensaje';
            alert('Ocurrió un error. Por favor intenta de nuevo.');
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-send-fill me-2"></i> Enviar Mensaje';
    });
});
</script>
@endsection
