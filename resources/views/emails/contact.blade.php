<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje de contacto</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0a0f1a; font-family: Arial, Helvetica, sans-serif; color: #e2e8f0; }
        .wrapper { max-width: 580px; margin: 0 auto; padding: 40px 16px; }
        .card { background: #0f172a; border: 1px solid #1e293b; border-radius: 4px; overflow: hidden; }
        .header { padding: 32px 48px 24px; border-bottom: 1px solid #1e293b; }
        .header img { max-height: 32px; filter: brightness(0) invert(1); display: block; }
        .header-meta { margin-top: 20px; }
        .header-meta .label { font-size: 10px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: #2563eb; }
        .header-meta h1 { font-size: 18px; font-weight: 700; color: #f1f5f9; margin-top: 6px; }
        .body { padding: 32px 48px; }
        .field { margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #1e293b; }
        .field:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .field-label { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #475569; margin-bottom: 6px; }
        .field-value { font-size: 14px; color: #cbd5e1; line-height: 1.65; }
        .field-value a { color: #2563eb; text-decoration: none; }
        .cta-wrap { margin-top: 28px; padding-top: 24px; border-top: 1px solid #1e293b; }
        .cta-btn { display: inline-block; background: #2563eb; color: #ffffff !important; text-decoration: none; font-size: 13px; font-weight: 700; letter-spacing: 0.5px; padding: 11px 28px; border-radius: 4px; }
        .footer { padding: 20px 48px; border-top: 1px solid #1e293b; }
        .footer p { font-size: 11px; color: #334155; line-height: 1.7; }
        .footer a { color: #475569; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="card">

        <div class="header">
            <img src="{{ url('/') }}/img/icono/LogoCentral.png" alt="CentralShop">
            <div class="header-meta">
                <div class="label">Formulario de Contacto</div>
                <h1>Nuevo mensaje recibido</h1>
            </div>
        </div>

        <div class="body">
            <div class="field">
                <div class="field-label">Nombre</div>
                <div class="field-value">{{ $contactName }}</div>
            </div>
            <div class="field">
                <div class="field-label">Correo electrónico</div>
                <div class="field-value"><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></div>
            </div>
            <div class="field">
                <div class="field-label">Asunto</div>
                <div class="field-value">{{ $contactSubject }}</div>
            </div>
            <div class="field">
                <div class="field-label">Mensaje</div>
                <div class="field-value" style="white-space: pre-line;">{{ $contactMessage }}</div>
            </div>

            <div class="cta-wrap">
                <a href="mailto:{{ $contactEmail }}" class="cta-btn">Responder a {{ $contactName }}</a>
            </div>
        </div>

        <div class="footer">
            <p>
                Notificación automática de <a href="{{ url('/') }}">centralshop.cl</a>
                &nbsp;&middot;&nbsp;
                <a href="{{ url('/admin') }}">Panel de administración</a>
            </p>
        </div>

    </div>
</div>
</body>
</html>
