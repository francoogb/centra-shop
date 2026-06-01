@extends('layouts.app')

@section('title', 'Quiénes Somos')

@section('styles')
<style>
    .info-page { background: #0f172a; color: #f1f5f9; padding: 60px 0 100px; min-height: 70vh; }
    .info-card { background: #1e293b; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 40px; line-height: 1.8; }
    .highlight-blue { color: #3b82f6; font-weight: 700; }
</style>
@endsection

@section('content')
<div class="info-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <h1 class="fw-bold text-white mb-3">Quiénes Somos</h1>
                    <p class="text-muted">Conoce la historia detrás de CentralShop.</p>
                </div>

                <div class="info-card">
                    <h2 class="text-white mb-4">Nuestra Misión</h2>
                    <p>En <span class="highlight-blue">CentralShop</span>, nos dedicamos a ofrecer una experiencia de compra única, combinando tecnología de vanguardia con un servicio al cliente excepcional. Nacimos con la idea de simplificar el acceso a productos de calidad en Chile, desde electrónica hasta artículos para el hogar.</p>
                    
                    <h2 class="text-white mt-5 mb-4">¿Por qué elegirnos?</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="p-3 border border-secondary border-opacity-20 rounded-3 text-center">
                                <i class="bi bi-shield-check fs-1 text-primary mb-2 d-block"></i>
                                <h6 class="fw-bold">Seguridad</h6>
                                <p class="small text-muted mb-0">Tus datos y pagos están 100% protegidos.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border border-secondary border-opacity-20 rounded-3 text-center">
                                <i class="bi bi-truck fs-1 text-primary mb-2 d-block"></i>
                                <h6 class="fw-bold">Rapidez</h6>
                                <p class="small text-muted mb-0">Envíos express para que no esperes de más.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border border-secondary border-opacity-20 rounded-3 text-center">
                                <i class="bi bi-star fs-1 text-primary mb-2 d-block"></i>
                                <h6 class="fw-bold">Calidad</h6>
                                <p class="small text-muted mb-0">Seleccionamos solo lo mejor para ti.</p>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-white mt-5 mb-4">Nuestro Compromiso</h2>
                    <p>Seguimos creciendo día a día gracias a la confianza de nuestros clientes. Nuestra meta es convertirnos en el ecommerce referente de la región, manteniendo siempre precios competitivos y una logística impecable.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
