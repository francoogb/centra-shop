@extends('layouts.app')

@section('title', 'Cambios y Devoluciones')

@section('styles')
<style>
    .info-page { background: #0f172a; color: #f1f5f9; padding: 60px 0 100px; min-height: 70vh; }
    .info-card { background: #1e293b; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 40px; line-height: 1.8; }
</style>
@endsection

@section('content')
<div class="info-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <h1 class="fw-bold text-white mb-3">Cambios y Devoluciones</h1>
                    <p class="text-muted">Nuestra política de satisfacción garantizada.</p>
                </div>

                <div class="info-card">
                    <h4 class="text-white mb-3">Garantía de Satisfacción</h4>
                    <p>Si no estás satisfecho con tu compra, tienes hasta 30 días para solicitar un cambio o devolución de tu dinero, siempre que el producto esté en su empaque original y sin uso.</p>
                    
                    <h4 class="text-white mt-4 mb-3">Procedimiento</h4>
                    <ol>
                        <li>Contáctanos vía WhatsApp o Email informando tu número de orden.</li>
                        <li>Envía el producto a nuestra dirección en Santiago.</li>
                        <li>Una vez recibido y revisado, procesaremos tu cambio o reembolso en un plazo de 48 horas.</li>
                    </ol>

                    <h4 class="text-white mt-4 mb-3">Garantía Legal</h4>
                    <p>Todos nuestros productos cuentan con la garantía legal de 6 meses por fallas de fabricación.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
