@extends('layouts.app')

@section('title', 'Política de Privacidad')

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
                    <h1 class="fw-bold text-white mb-3">Política de Privacidad</h1>
                    <p class="text-muted">Cómo protegemos y manejamos tus datos personales.</p>
                </div>

                <div class="info-card">
                    <h4 class="text-white mb-3">Privacidad Garantizada</h4>
                    <p>En CentralShop, tu privacidad es nuestra prioridad. Solo recolectamos la información necesaria para procesar tus pedidos y mejorar tu experiencia de compra.</p>
                    
                    <h4 class="text-white mt-4 mb-3">Uso de Información</h4>
                    <p>Tus datos nunca serán compartidos con terceros sin tu consentimiento explícito, excepto para fines logísticos de entrega de tus productos.</p>

                    <h4 class="text-white mt-4 mb-3">Cookies</h4>
                    <p>Utilizamos cookies para personalizar el contenido y analizar nuestro tráfico, lo que nos permite ofrecerte una navegación más fluida y relevante.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
