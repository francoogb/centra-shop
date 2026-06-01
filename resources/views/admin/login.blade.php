<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Admin — CentralShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #020617;
            --card: #0f172a;
            --border: rgba(255,255,255,0.08);
            --text: #f8fafc;
            --muted: #94a3b8;
            --blue: #2563eb;
            --blue-hover: #1d4ed8;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
        }
        .form-control {
            background: rgba(0,0,0,0.4);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            background: rgba(0,0,0,0.5);
            border-color: var(--blue);
            color: var(--text);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
        }
        .form-control::placeholder { color: #475569; }
        .form-label { color: var(--muted); font-size: 0.85rem; font-weight: 500; margin-bottom: 6px; }
        .btn-login {
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-login:hover { background: var(--blue-hover); color: #fff; }
        .input-group-text {
            background: rgba(0,0,0,0.4);
            border: 1px solid var(--border);
            color: var(--muted);
            border-right: none;
        }
        .input-group .form-control { border-left: none; }
        .input-group .form-control:focus { border-left: none; }
        .alert-danger {
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.3);
            color: #fca5a5;
            border-radius: 10px;
            font-size: 0.875rem;
        }
        .back-link { color: var(--muted); font-size: 0.85rem; text-decoration: none; }
        .back-link:hover { color: var(--text); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-5">
            <div class="mb-3">
                <i class="bi bi-shield-lock-fill" style="font-size: 2.5rem; color: #2563eb;"></i>
            </div>
            <h4 class="fw-bold mb-1">Panel de Administración</h4>
            <p class="mb-0" style="color: var(--muted); font-size: 0.875rem;">Ingresa tus credenciales para continuar</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Correo electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="admin@centralshop.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="••••••••"
                        required
                    >
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" style="background:rgba(0,0,0,0.4);border-color:var(--border);">
                <label class="form-check-label" style="color:var(--muted);font-size:0.875rem;" for="remember">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="/" class="back-link"><i class="bi bi-arrow-left me-1"></i>Volver a la tienda</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
