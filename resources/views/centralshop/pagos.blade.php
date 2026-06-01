@extends('layouts.app')

@section('title', 'Medios de Pago')

@section('styles')
<style>
    .info-page { background: #0f172a; color: #f1f5f9; padding: 60px 0 100px; min-height: 70vh; }
    .info-card { background: #1e293b; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 40px; }
    .payment-icon-lg { font-size: 3rem; color: #3b82f6; margin-bottom: 20px; }
</style>
@endsection

@section('content')
<div class="info-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <h1 class="fw-bold text-white mb-3">Medios de Pago</h1>
                    <p class="text-muted">Paga de forma segura con nuestras opciones integradas.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="info-card text-center h-100">
                            <i class="bi bi-credit-card payment-icon-lg"></i>
                            <h4 class="text-white">Tarjetas de Crédito/Débito</h4>
                            <p class="small text-muted">Aceptamos Visa, Mastercard, American Express y más a través de Mercado Pago.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card text-center h-100">
                            <i class="bi bi-paypal payment-icon-lg"></i>
                            <h4 class="text-white">PayPal</h4>
                            <p class="small text-muted">Paga de forma rápida y segura con tu cuenta PayPal, ideal para compras internacionales.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card text-center h-100">
                            <i class="bi bi-bank payment-icon-lg"></i>
                            <h4 class="text-white">Transferencia Bancaria</h4>
                            <p class="small text-muted">También puedes realizar transferencias directas. Contáctanos por WhatsApp para obtener los datos.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card text-center h-100">
                            <i class="bi bi-shield-lock payment-icon-lg"></i>
                            <h4 class="text-white">Pago Seguro</h4>
                            <p class="small text-muted">Toda tu información está encriptada y protegida bajo los estándares más altos de seguridad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
