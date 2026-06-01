@extends('layouts.app')

@section('seo_title', 'CentralShop')
@section('seo_description', 'Preguntas Frecuentes')
@section('seo_meta_desc', '¿Dudas sobre tu compra? Resolvemos tus preguntas sobre envíos, pagos, devoluciones y cómo comprar en CentralShop Chile.')

@section('title', 'Preguntas Frecuentes — CentralShop')

@section('styles')
<style>
    .info-page { background: #0f172a; color: #f1f5f9; padding: 60px 0 100px; min-height: 70vh; }
    .faq-header-badge { display: inline-block; background: rgba(59,130,246,0.12); color: #60a5fa; border: 1px solid rgba(59,130,246,0.25); padding: 6px 18px; border-radius: 100px; font-size: 0.78rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 18px; }
    .faq-category-label { font-size: 0.7rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #3b82f6; margin: 36px 0 12px; }
    .accordion-item { background: transparent; border: 1px solid rgba(255,255,255,0.08); margin-bottom: 10px; border-radius: 14px !important; overflow: hidden; }
    .accordion-button { background: #1e293b; color: #f1f5f9; font-weight: 600; font-size: 0.95rem; padding: 18px 22px; border-radius: 14px !important; }
    .accordion-button:not(.collapsed) { background: linear-gradient(90deg,#1d4ed8,#2563eb); color: #fff; box-shadow: none; }
    .accordion-button::after { filter: brightness(0) invert(1); }
    .accordion-body { background: #0f172a; color: #94a3b8; line-height: 1.75; padding: 18px 22px; font-size: 0.93rem; }
    .accordion-body strong { color: #f1f5f9; }
    .wsp-cta { background: linear-gradient(135deg,#15803d,#16a34a); border-radius: 16px; padding: 28px 32px; display: flex; align-items: center; gap: 20px; margin-top: 40px; }
    .wsp-cta a { background:#fff; color:#15803d; font-weight:700; padding:12px 28px; border-radius:50px; text-decoration:none; font-size:0.95rem; white-space:nowrap; }
    .wsp-cta a:hover { background:#f0fdf4; }
    .text-muted { color: #64748b !important; }
</style>
@endsection

@section('content')
<div class="info-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="text-center mb-5">
                    <span class="faq-header-badge">Centro de Ayuda</span>
                    <h1 class="fw-bold text-white mb-3">Preguntas Frecuentes</h1>
                    <p class="text-muted">Todo lo que necesitas saber sobre CentralShop. Si tienes más dudas, escríbenos por WhatsApp.</p>
                </div>

                {{-- COMPRAS --}}
                <div class="faq-category-label"><i class="bi bi-bag-check me-1"></i> Proceso de Compra</div>
                <div class="accordion" id="faqCompras">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                                ¿Cómo realizo una compra?
                            </button>
                        </h2>
                        <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faqCompras">
                            <div class="accordion-body">
                                Es muy simple: <strong>navega el catálogo</strong>, encuentra el producto que te interesa y haz clic en el botón <strong>"Comprar por WhatsApp"</strong>. Se abrirá un chat directo con nosotros donde podrás coordinar tu pedido, confirmar disponibilidad y acordar el pago — todo en minutos.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2">
                                ¿Necesito crear una cuenta para comprar?
                            </button>
                        </h2>
                        <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqCompras">
                            <div class="accordion-body">
                                No. CentralShop funciona <strong>100% a través de WhatsApp</strong>, sin registro ni contraseñas. Solo necesitas tu nombre y dirección de envío al momento de coordinar tu pedido.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q3">
                                ¿Puedo pedir varios productos en una sola compra?
                            </button>
                        </h2>
                        <div id="q3" class="accordion-collapse collapse" data-bs-parent="#faqCompras">
                            <div class="accordion-body">
                                Sí. Al contactarnos por WhatsApp puedes mencionar todos los productos que desees y te generamos un <strong>total unificado</strong> con envío único.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- PAGOS --}}
                <div class="faq-category-label"><i class="bi bi-credit-card me-1"></i> Pagos</div>
                <div class="accordion" id="faqPagos">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q4">
                                ¿Qué métodos de pago aceptan?
                            </button>
                        </h2>
                        <div id="q4" class="accordion-collapse collapse" data-bs-parent="#faqPagos">
                            <div class="accordion-body">
                                Aceptamos <strong>transferencia bancaria</strong> (todos los bancos chilenos), <strong>Mercado Pago</strong> (tarjetas de crédito/débito, cuotas), y <strong>efectivo</strong> en casos especiales coordinados previamente.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q5">
                                ¿Los precios incluyen IVA?
                            </button>
                        </h2>
                        <div id="q5" class="accordion-collapse collapse" data-bs-parent="#faqPagos">
                            <div class="accordion-body">
                                Sí, todos los precios publicados en el sitio están expresados en <strong>pesos chilenos (CLP) e incluyen IVA</strong>. No hay cobros adicionales ocultos.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q6">
                                ¿Puedo pagar en cuotas?
                            </button>
                        </h2>
                        <div id="q6" class="accordion-collapse collapse" data-bs-parent="#faqPagos">
                            <div class="accordion-body">
                                Sí, mediante <strong>Mercado Pago</strong> puedes pagar en cuotas con tu tarjeta de crédito. Las cuotas disponibles dependen de tu banco. Consúltanos por WhatsApp para más información.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ENVIOS --}}
                <div class="faq-category-label"><i class="bi bi-truck me-1"></i> Envíos y Entregas</div>
                <div class="accordion" id="faqEnvios">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q7">
                                ¿Realizan envíos a todo Chile?
                            </button>
                        </h2>
                        <div id="q7" class="accordion-collapse collapse" data-bs-parent="#faqEnvios">
                            <div class="accordion-body">
                                Sí, despachamos a <strong>todas las regiones de Chile</strong>, desde Arica y Parinacota hasta Magallanes, a través de Starken, Chilexpress y Correos de Chile. Los tiempos de entrega varían según la región.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q8">
                                ¿Cuánto demora mi pedido en llegar?
                            </button>
                        </h2>
                        <div id="q8" class="accordion-collapse collapse" data-bs-parent="#faqEnvios">
                            <div class="accordion-body">
                                <strong>Región Metropolitana:</strong> 1 a 3 días hábiles.<br>
                                <strong>Regiones cercanas (V, VI, VII):</strong> 2 a 4 días hábiles.<br>
                                <strong>Regiones extremas:</strong> 4 a 7 días hábiles.<br>
                                Los plazos se cuentan desde la confirmación del pago.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q9">
                                ¿Cómo hago seguimiento a mi pedido?
                            </button>
                        </h2>
                        <div id="q9" class="accordion-collapse collapse" data-bs-parent="#faqEnvios">
                            <div class="accordion-body">
                                Una vez despachado tu pedido, te enviamos el <strong>número de seguimiento</strong> por WhatsApp para que puedas rastrearlo directamente en el sitio del courier.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- DEVOLUCIONES --}}
                <div class="faq-category-label"><i class="bi bi-arrow-return-left me-1"></i> Devoluciones y Garantía</div>
                <div class="accordion" id="faqDevoluciones">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q10">
                                ¿Tienen política de devoluciones?
                            </button>
                        </h2>
                        <div id="q10" class="accordion-collapse collapse" data-bs-parent="#faqDevoluciones">
                            <div class="accordion-body">
                                Sí. Según la <strong>Ley N° 19.496 del Consumidor</strong>, tienes <strong>10 días hábiles</strong> desde la recepción para solicitar cambio o devolución si el producto presenta defectos o no corresponde a lo descrito. Escríbenos por WhatsApp con fotos del producto y coordinamos sin problemas.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q11">
                                ¿Qué hago si mi producto llegó dañado?
                            </button>
                        </h2>
                        <div id="q11" class="accordion-collapse collapse" data-bs-parent="#faqDevoluciones">
                            <div class="accordion-body">
                                Fotografía el producto y el embalaje al recibirlo y comunícate con nosotros <strong>dentro de las 48 horas</strong> siguientes a la entrega. Gestionamos el reenvío o reembolso según corresponda sin costo adicional para ti.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- CTA WhatsApp --}}
                <div class="wsp-cta mt-5">
                    <div class="flex-grow-1">
                        <div class="fw-bold text-white fs-5 mb-1">¿No encontraste tu respuesta?</div>
                        <div class="text-white opacity-75 small">Escríbenos por WhatsApp y te respondemos al instante.</div>
                    </div>
                    <a href="https://wa.me/56942922528" target="_blank">
                        <i class="bi bi-whatsapp me-1"></i> Consultar ahora
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
