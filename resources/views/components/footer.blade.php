<style>
    /* ===== MAIN FOOTER ===== */
    .site-footer { background-color: #0d1b2a; color: #cbd5e1; padding: 60px 0 0; margin-top: 60px; }
    .footer-brand-name { font-size: 1.6rem; font-weight: 800; color: #fff; letter-spacing: -0.04em; }
    .footer-brand-name span { color: #60a5fa; }
    .footer-brand-desc { font-size: 0.9rem; color: #94a3b8; line-height: 1.6; margin: 16px 0 24px; }
    .footer-social { display: flex; gap: 12px; }
    .footer-social a {
        width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.08);
        display: flex; align-items: center; justify-content: center;
        color: #94a3b8; font-size: 1rem; transition: all 0.25s ease; text-decoration: none;
    }
    .footer-social a:hover { background: #2563eb; color: #fff; transform: translateY(-2px); }

    /* ===== FOOTER COLUMNS ===== */
    .footer-col-title {
        font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px;
        text-transform: uppercase; color: #fff; margin-bottom: 20px;
    }
    .footer-nav { list-style: none; padding: 0; margin: 0; }
    .footer-nav li { margin-bottom: 12px; }
    .footer-nav a {
        color: #94a3b8; text-decoration: none; font-size: 0.9rem;
        transition: color 0.2s ease;
    }
    .footer-nav a:hover { color: #fff; }

    /* ===== NEWSLETTER ===== */
    .footer-newsletter-title { font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #fff; margin-bottom: 14px; }
    .footer-newsletter-desc { font-size: 0.88rem; color: #94a3b8; line-height: 1.5; margin-bottom: 20px; }
    .newsletter-input-group { display: flex; gap: 0; border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.12); }
    .newsletter-input-group input {
        flex: 1; background: rgba(255,255,255,0.06); border: none; outline: none;
        color: #e2e8f0; padding: 12px 16px; font-size: 0.88rem;
    }
    .newsletter-input-group input::placeholder { color: #64748b; }
    .newsletter-input-group button {
        background: #2563eb; border: none; padding: 0 18px;
        color: #fff; font-size: 1.1rem; cursor: pointer; transition: background 0.2s ease;
    }
    .newsletter-input-group button:hover { background: #1d4ed8; }
    .newsletter-privacy { font-size: 0.75rem; color: #64748b; margin-top: 10px; display: flex; align-items: center; gap: 6px; }

    /* ===== BOTTOM BAR ===== */
    .footer-bottom {
        background-color: #0d1b2a; border-top: 1px solid rgba(255,255,255,0.08);
        padding: 18px 0; margin-top: 50px;
    }
    .footer-bottom p { color: #64748b; font-size: 0.82rem; margin: 0; }
    .payment-methods { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 8px 16px; }
    .payment-badge { background: #fff; border-radius: 5px; padding: 4px 10px; font-size: 0.78rem; font-weight: 700; color: #1a1a2e; white-space: nowrap; }
    .payment-badge.visa { color: #1a1f71; }
    .payment-badge.mc { color: #eb001b; }
    .country-selector {
        display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 8px 14px;
        color: #cbd5e1; font-size: 0.88rem; cursor: pointer; text-decoration: none;
        transition: background 0.2s ease;
    }
    .country-selector:hover { background: rgba(255,255,255,0.1); color: #fff; }

    /* ===== MOBILE ===== */
    @media (max-width: 767.98px) {
        .site-footer .footer-brand-desc { max-width: 100% !important; }
        .site-footer .footer-social { justify-content: flex-start; }
        .site-footer .footer-col-title,
        .site-footer .footer-nav,
        .site-footer .footer-newsletter-title,
        .site-footer .footer-newsletter-desc { text-align: left !important; }
        .footer-bottom .col-md-6:first-child p { text-align: left !important; }
        .footer-bottom .col-md-6:last-child {
            justify-content: flex-start !important;
        }
    }
</style>


{{-- ===== FOOTER PRINCIPAL ===== --}}
<footer class="site-footer" id="site-footer">
    <div class="container">
        <div class="row g-5">

            {{-- Columna 1: Marca --}}
            <div class="col-lg-4 col-md-6">
                <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center gap-2 mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); display: flex; align-items: center; justify-content: center; padding: 0; flex-shrink: 0;">
                        <img src="{{ asset('img/icono/CentralLogo.png') }}" alt="CentralShop Logo" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="footer-brand-name" style="margin-bottom: 0;">Central<span>Shop</span></div>
                </a>
                <p class="footer-brand-desc" style="max-width: 300px;">Tu destino tecnológico de confianza. Calidad y servicio en cada compra.</p>
                <div class="footer-social align-items-center mt-3">
                    <span style="font-family: 'Outfit', sans-serif; font-size: 0.95rem; font-weight: 900; color: #fff; display: inline-block; margin-right: 12px; letter-spacing: 1px; text-shadow: 2px 2px 0px #2563eb; text-transform: uppercase;">SÍGUENOS EN:</span>
                    <a href="https://www.instagram.com/centralshop.cl" target="_blank" aria-label="Instagram" style="width: 44px; height: 44px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: #fff; border-radius: 12px;">
                        <i class="bi bi-instagram" style="font-size: 1.2rem;"></i>
                    </a>
                </div>
            </div>

            {{-- Columna 2: Tienda --}}
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="footer-col-title">Tienda</div>
                <ul class="footer-nav">
                    <li><a href="{{ route('catalogo') }}">Catálogo completo</a></li>
                    <li><a href="{{ route('catalogo') }}">Ofertas actuales</a></li>
                    <li><a href="{{ route('catalogo') }}">Novedades</a></li>
                </ul>
            </div>

            {{-- Columna 3: Soporte --}}
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="footer-col-title">Soporte</div>
                <ul class="footer-nav">
                    <li><a href="{{ route('contacto') }}">Contacto</a></li>
                    <li><a href="{{ route('preguntas') }}">Preguntas Frecuentes</a></li>
                    <li><a href="{{ route('terminos') }}">Términos</a></li>
                </ul>
            </div>

            {{-- Columna 4: Newsletter --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-newsletter-title">Únete al club</div>
                <p class="footer-newsletter-desc">Recibe ofertas exclusivas y novedades antes que nadie.</p>
                <form action="{{ route('subscribe') }}" method="POST" id="footer-newsletter-form">
                    @csrf
                    <div class="newsletter-input-group">
                        <input type="email" name="email" id="newsletter-email" placeholder="Tu correo" required>
                        <button type="submit" id="newsletter-btn"><i class="bi bi-send-fill"></i></button>
                    </div>
                    <div id="newsletter-message" class="mt-2 small d-none"></div>
                </form>
            </div>

        </div>
    </div>

    {{-- ===== BARRA INFERIOR ===== --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-6 text-start">
                    <p>© {{ now()->format('Y') }} CentralShop. Calidad garantizada.</p>
                </div>
                <div class="col-md-6 d-flex justify-content-start justify-content-md-end gap-3">
                    <div class="payment-methods border-0 bg-transparent p-0">
                        <img src="{{ asset('img/icono/logoscards.png') }}" alt="Métodos de pago" style="max-height: 50px; width: auto; filter: contrast(1.1) brightness(1.1);">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
document.getElementById('footer-newsletter-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const btn = document.getElementById('newsletter-btn');
    const msg = document.getElementById('newsletter-message');
    const privacy = document.getElementById('newsletter-privacy-text');
    const email = document.getElementById('newsletter-email').value;

    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

    fetch(form.action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        msg.classList.remove('d-none', 'text-success', 'text-danger');
        msg.classList.add(data.success ? 'text-success' : 'text-danger');
        msg.textContent = data.message;
        if(data.success) {
            form.reset();
            if(privacy) privacy.classList.add('d-none');
        }
    })
    .catch(error => {
        msg.classList.remove('d-none', 'text-success');
        msg.classList.add('text-danger');
        msg.textContent = 'Ocurrió un error. Intenta de nuevo.';
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-send-fill"></i>';
    });
});
</script>