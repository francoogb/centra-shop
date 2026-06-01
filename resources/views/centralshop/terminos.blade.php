@extends('layouts.app')

@section('seo_title', 'CentralShop')
@section('seo_description', 'Términos y Condiciones')
@section('seo_meta_desc', 'Lee los términos y condiciones de CentralShop. Ley 19.496 del Consumidor Chile. Compras, envíos, devoluciones y garantías.')

@section('title', 'Términos y Condiciones — CentralShop')

@section('styles')
<style>
    .info-page { background: #0f172a; color: #f1f5f9; padding: 60px 0 100px; min-height: 70vh; }
    .info-card { background: #1e293b; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 44px; line-height: 1.85; }
    .legal-section { margin-bottom: 32px; }
    .legal-section h4 { color: #f8fafc; font-weight: 700; font-size: 1rem; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid rgba(255,255,255,0.07); }
    .legal-section p, .legal-section li { color: #94a3b8; font-size: 0.93rem; }
    .legal-section ul { padding-left: 20px; }
    .legal-section ul li { margin-bottom: 6px; }
    .legal-section strong { color: #cbd5e1; }
    .last-update { background: rgba(59,130,246,0.08); border: 1px solid rgba(59,130,246,0.18); border-radius: 10px; padding: 10px 16px; font-size: 0.8rem; color: #60a5fa; display: inline-block; margin-bottom: 32px; }
</style>
@endsection

@section('content')
<div class="info-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="text-center mb-5">
                    <h1 class="fw-bold text-white mb-3">Términos y Condiciones</h1>
                    <p class="text-muted">Lee atentamente estos términos antes de usar nuestros servicios.</p>
                </div>

                <div class="info-card">
                    <div class="last-update"><i class="bi bi-calendar3 me-1"></i> Última actualización: Mayo 2026</div>

                    <div class="legal-section">
                        <h4>1. Aceptación de los Términos</h4>
                        <p>Al acceder y utilizar el sitio web de <strong>CentralShop</strong> (en adelante, "el Sitio"), declaras haber leído, comprendido y aceptado los presentes Términos y Condiciones en su totalidad. Si no estás de acuerdo con alguno de estos términos, te pedimos que no utilices nuestros servicios. Estos términos se rigen por la legislación vigente en <strong>Chile</strong>.</p>
                    </div>

                    <div class="legal-section">
                        <h4>2. Descripción del Servicio</h4>
                        <p>CentralShop es una tienda online que opera exclusivamente en <strong>Chile</strong>, ofreciendo productos a través de su catálogo digital. Las compras se coordinan mediante <strong>WhatsApp</strong>, sin que exista un proceso de pago automatizado en el Sitio. CentralShop actúa como intermediario entre el catálogo de productos y el cliente final.</p>
                    </div>

                    <div class="legal-section">
                        <h4>3. Disponibilidad de Productos y Precios</h4>
                        <ul>
                            <li>Todos los productos están sujetos a <strong>disponibilidad de stock</strong> al momento de la compra.</li>
                            <li>Los precios están expresados en <strong>pesos chilenos (CLP) e incluyen IVA</strong>, conforme a la legislación tributaria chilena.</li>
                            <li>CentralShop se reserva el derecho de modificar precios sin previo aviso. El precio válido es el acordado al momento de confirmar el pedido por WhatsApp.</li>
                            <li>En caso de error tipográfico en el precio publicado, CentralShop se reserva el derecho de cancelar el pedido informando al cliente.</li>
                        </ul>
                    </div>

                    <div class="legal-section">
                        <h4>4. Proceso de Compra</h4>
                        <p>El proceso de compra se realiza de la siguiente manera:</p>
                        <ul>
                            <li>El cliente selecciona el producto en el Sitio y contacta a CentralShop vía WhatsApp.</li>
                            <li>Se confirma disponibilidad, precio y datos de envío.</li>
                            <li>El cliente realiza el pago según el método acordado (transferencia bancaria o Mercado Pago).</li>
                            <li>CentralShop confirma la recepción del pago y coordina el despacho.</li>
                        </ul>
                    </div>

                    <div class="legal-section">
                        <h4>5. Envíos</h4>
                        <ul>
                            <li>Los envíos se realizan únicamente dentro del <strong>territorio chileno</strong>.</li>
                            <li>El costo de envío se informa al cliente antes de confirmar la compra.</li>
                            <li>Los tiempos de entrega son estimados y pueden variar según la región y el courier utilizado.</li>
                            <li>CentralShop no se hace responsable por retrasos causados por el servicio de courier una vez despachado el paquete.</li>
                        </ul>
                    </div>

                    <div class="legal-section">
                        <h4>6. Devoluciones y Garantía</h4>
                        <p>De conformidad con la <strong>Ley N° 19.496 sobre Protección de los Derechos de los Consumidores</strong>:</p>
                        <ul>
                            <li>El cliente tiene derecho a solicitar la reparación, cambio o devolución del producto dentro de <strong>3 meses</strong> desde la recepción en caso de defectos de fabricación.</li>
                            <li>En caso de productos que no correspondan a lo descrito, el cliente podrá solicitar el cambio dentro de <strong>10 días hábiles</strong> desde la recepción.</li>
                            <li>No se aceptan devoluciones por cambio de opinión una vez despachado el producto, salvo acuerdo expreso.</li>
                            <li>Los gastos de devolución corren por cuenta del cliente, salvo que el defecto sea imputable a CentralShop.</li>
                        </ul>
                    </div>

                    <div class="legal-section">
                        <h4>7. Responsabilidad</h4>
                        <p>CentralShop no se hace responsable por:</p>
                        <ul>
                            <li>Daños indirectos o consecuentes derivados del uso o imposibilidad de uso del Sitio.</li>
                            <li>Interrupciones, errores o fallos técnicos del Sitio fuera de su control.</li>
                            <li>Uso indebido que el cliente haga de los productos adquiridos.</li>
                        </ul>
                    </div>

                    <div class="legal-section">
                        <h4>8. Propiedad Intelectual</h4>
                        <p>Todo el contenido del Sitio — incluyendo textos, imágenes, logotipos, íconos y diseño gráfico — es propiedad de CentralShop o de sus respectivos titulares, y está protegido por las leyes de propiedad intelectual vigentes en Chile. Queda prohibida su reproducción total o parcial sin autorización expresa.</p>
                    </div>

                    <div class="legal-section">
                        <h4>9. Privacidad y Datos Personales</h4>
                        <p>El tratamiento de tus datos personales se rige por nuestra <a href="{{ route('privacidad') }}" class="text-info">Política de Privacidad</a>, en conformidad con la <strong>Ley N° 19.628 sobre Protección de la Vida Privada</strong> de Chile.</p>
                    </div>

                    <div class="legal-section">
                        <h4>10. Modificaciones</h4>
                        <p>CentralShop se reserva el derecho de modificar estos Términos y Condiciones en cualquier momento. Los cambios serán publicados en esta página con la fecha de actualización correspondiente. El uso continuado del Sitio después de dichos cambios implica la aceptación de los nuevos términos.</p>
                    </div>

                    <div class="legal-section mb-0">
                        <h4>11. Contacto y Jurisdicción</h4>
                        <p>Para cualquier consulta sobre estos términos, puedes contactarnos a través de nuestra <a href="{{ route('contacto') }}" class="text-info">página de contacto</a>. Cualquier controversia derivada del uso del Sitio se someterá a los <strong>tribunales competentes de Chile</strong>, renunciando las partes a cualquier otro fuero.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
