@extends('layouts.app')

@section('title', 'Centro de Ayuda')

@section('styles')
<style>
    .info-page { background: #0f172a; color: #f1f5f9; padding: 60px 0 100px; min-height: 70vh; }
    .info-card { background: #1e293b; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 40px; }
    .help-card { transition: transform 0.3s ease; cursor: pointer; }
    .help-card:hover { transform: translateY(-5px); background: rgba(59, 130, 246, 0.05); border-color: #3b82f6; }
</style>
@endsection

@section('content')
<div class="info-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h1 class="fw-bold text-white mb-3">¿En qué podemos ayudarte?</h1>
                    <p class="text-muted">Busca por categorías o contáctanos directamente.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="{{ route('preguntas') }}" class="text-decoration-none">
                            <div class="info-card help-card text-center h-100">
                                <i class="bi bi-question-circle fs-1 text-primary mb-3 d-block"></i>
                                <h5 class="text-white">Preguntas Frecuentes</h5>
                                <p class="small text-muted mb-0">Respuestas rápidas a las dudas más comunes de nuestros usuarios.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('pagos') }}" class="text-decoration-none">
                            <div class="info-card help-card text-center h-100">
                                <i class="bi bi-credit-card fs-1 text-primary mb-3 d-block"></i>
                                <h5 class="text-white">Pagos y Facturación</h5>
                                <p class="small text-muted mb-0">Información sobre métodos de pago y comprobantes de compra.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('envios') }}" class="text-decoration-none">
                            <div class="info-card help-card text-center h-100">
                                <i class="bi bi-truck fs-1 text-primary mb-3 d-block"></i>
                                <h5 class="text-white">Envíos y Entregas</h5>
                                <p class="small text-muted mb-0">Todo lo que necesitas saber sobre plazos y estados de envío.</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="info-card mt-5 text-center">
                    <h4 class="text-white mb-3">¿No encontraste lo que buscabas?</h4>
                    <p class="text-muted">Nuestro equipo de soporte está disponible de Lunes a Viernes de 9:00 a 18:00.</p>
                    <a href="{{ route('contacto') }}" class="btn btn-primary rounded-pill px-5 fw-bold mt-2">Hablar con un Humano</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
