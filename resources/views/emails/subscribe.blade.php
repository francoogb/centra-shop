<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido/a a CentralShop</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0a0f1a; font-family: Arial, Helvetica, sans-serif; color: #e2e8f0; }
        .wrapper { max-width: 580px; margin: 0 auto; padding: 40px 16px; }
        .card { background: #0f172a; border: 1px solid #1e293b; border-radius: 4px; overflow: hidden; }
        .header { padding: 36px 48px 28px; text-align: center; border-bottom: 1px solid #1e293b; }
        .header img { max-height: 36px; filter: brightness(0) invert(1); }
        .accent-line { display: block; width: 40px; height: 2px; background: #2563eb; margin: 16px auto 0; }
        .body { padding: 40px 48px; }
        .label { font-size: 10px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: #2563eb; margin-bottom: 16px; }
        h1 { font-size: 22px; font-weight: 700; color: #f1f5f9; line-height: 1.4; margin-bottom: 14px; }
        p { color: #94a3b8; font-size: 14px; line-height: 1.75; margin-bottom: 14px; }
        .benefit-box { border: 1px solid #1e293b; border-left: 3px solid #2563eb; border-radius: 4px; padding: 20px 24px; margin: 28px 0; }
        .benefit-box .title { font-size: 13px; font-weight: 700; color: #f1f5f9; margin-bottom: 6px; }
        .benefit-box .desc { font-size: 13px; color: #64748b; line-height: 1.6; }
        .divider { border: none; border-top: 1px solid #1e293b; margin: 32px 0; }
        .cta-wrap { text-align: center; margin: 28px 0 8px; }
        .cta-btn { display: inline-block; background: #2563eb; color: #ffffff !important; text-decoration: none; font-size: 14px; font-weight: 700; letter-spacing: 0.5px; padding: 13px 36px; border-radius: 4px; }
        .info-row { display: table; width: 100%; border-top: 1px solid #1e293b; padding-top: 28px; }
        .info-col { display: table-cell; text-align: center; padding: 0 8px; vertical-align: top; width: 33.33%; }
        .info-label { font-size: 12px; font-weight: 700; color: #cbd5e1; margin-bottom: 3px; }
        .info-text { font-size: 11px; color: #475569; }
        .footer { padding: 24px 48px; border-top: 1px solid #1e293b; text-align: center; }
        .footer p { font-size: 11px; color: #334155; line-height: 1.7; }
        .footer a { color: #475569; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="card">

        <div class="header">
            <img src="{{ $appUrl }}/img/icono/LogoCentral.png" alt="CentralShop">
            <span class="accent-line"></span>
        </div>

        <div class="body">
            <div class="label">Suscripción Confirmada</div>
            <h1>Bienvenido/a a CentralShop</h1>
            <p>
                Gracias por suscribirte. Serás el primero en conocer nuestras ofertas, novedades y promociones exclusivas para suscriptores.
            </p>

            <div class="benefit-box">
                <div class="title">Beneficio de bienvenida</div>
                <div class="desc">Menciona este correo al contactarnos por WhatsApp y obtén envío prioritario en tu primera compra.</div>
            </div>

            <div class="cta-wrap">
                <a href="{{ $appUrl }}/catalogo" class="cta-btn">Ver el catálogo</a>
            </div>

            <hr class="divider">

            <div class="info-row">
                <div class="info-col">
                    <div class="info-label">Envío a Chile</div>
                    <div class="info-text">Todo el territorio</div>
                </div>
                <div class="info-col">
                    <div class="info-label">Atención al Cliente</div>
                    <div class="info-text">Lun–Sáb 09:00–19:00</div>
                </div>
                <div class="info-col">
                    <div class="info-label">Pago Seguro</div>
                    <div class="info-text">Webpay · Transferencia</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>
                &copy; {{ date('Y') }} CentralShop &mdash; Todos los derechos reservados<br>
                <a href="{{ $appUrl }}">centralshop.cl</a>
                &nbsp;&middot;&nbsp;
                <a href="{{ $appUrl }}/contacto">Contacto</a>
                &nbsp;&middot;&nbsp;
                <a href="{{ $appUrl }}/privacidad">Privacidad</a>
            </p>
            <p style="margin-top:10px;">Recibiste este correo porque te suscribiste en centralshop.cl</p>
        </div>

    </div>
</div>
</body>
</html>
