@extends('layouts.app')

@section('title', 'Envíos y Entregas')

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
                    <h1 class="fw-bold text-white mb-3">Envíos y Entregas</h1>
                    <p class="text-muted">Información sobre plazos y costos de envío.</p>
                </div>

                <div class="info-card">
                    <h4 class="text-white mb-3">Cobertura Nacional</h4>
                    <p>Realizamos envíos a todo el territorio nacional chileno, llegando incluso a las zonas más extremas.</p>
                    
                    <h4 class="text-white mt-4 mb-3">Tiempos de Entrega</h4>
                    <ul>
                        <li><strong>Región Metropolitana:</strong> 24 a 48 horas hábiles.</li>
                        <li><strong>Otras Regiones:</strong> 3 a 5 días hábiles.</li>
                    </ul>

                    <h4 class="text-white mt-4 mb-3">Seguimiento</h4>
                    <p>Una vez procesado tu pedido, recibirás un número de seguimiento para que puedas monitorear tu paquete en tiempo real.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
