<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Abee Hijab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #b85c7a;
            --primary-dark: #a84d6b;
            --primary-soft: #f8e8ef;
            --primary-light: #fdf7f9;
            --dark: #2f2f3a;
            --muted: #8b8b98;
            --border: #f0e6ea;
            --bg: #fbf8f9;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(248,232,239,.9), transparent 35%),
                radial-gradient(circle at bottom right, rgba(255,244,247,.95), transparent 35%),
                var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: var(--dark);
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background: rgba(255,255,255,.95);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 36px;
            box-shadow: 0 22px 55px rgba(47,47,58,.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        /* 🔥 LOGO IMPROVED */
        .logo-img {
            width: 90px;
            height: 90px;
            margin: 0 auto 18px;
            border-radius: 26px;
            background: #ffffff;
            padding: 6px;
            border: 2px solid #f1dbe3;
            box-shadow: 0 12px 28px rgba(184, 92, 122, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo-img::after {
            content: "";
            position: absolute;
            inset: -4px;
            border-radius: 28px;
            background: linear-gradient(135deg, #f8e8ef, #ffffff);
            z-index: -1;
        }

        .logo-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        .logo h1 {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .logo p {
            font-size: 13px;
            color: var(--muted);
            margin: 0;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-control {
            height: 48px;
            border-radius: 999px;
            border: 1px solid var(--border);
            padding: 10px 16px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .15rem rgba(184, 92, 122, .15);
        }

        /* FIX autofill biru */
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
            -webkit-text-fill-color: var(--dark) !important;
        }

        .input-group .form-control {
            border-right: 0;
            border-radius: 999px 0 0 999px;
        }

        .toggle-password-btn {
            height: 48px;
            border: 1px solid var(--border);
            border-left: 0;
            background: #fff;
            color: var(--primary);
            border-radius: 0 999px 999px 0;
            padding: 0 16px;
        }

        .btn-login {
            background: var(--primary);
            border: none;
            border-radius: 999px;
            padding: 12px;
            font-weight: 700;
            box-shadow: 0 12px 24px rgba(184, 92, 122, .25);
        }

        .btn-login:hover {
            background: var(--primary-dark);
        }

        .alert {
            font-size: 13px;
            border-radius: 14px;
        }

        .footer-text {
            text-align: center;
            font-size: 12px;
            color: #aaa0a5;
            margin-top: 24px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <div class="logo">

        <div class="logo-img">
            <img src="{{ asset('images/logo abehijab.jpeg') }}" alt="Abee Hijab">
        </div>

        <h1>Abee Hijab</h1>
        <p>Sistem Kasir & Manajemen Toko</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ secure_url('/login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" placeholder="Masukkan email">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <div class="input-group">
                <input type="password" id="password" name="password"
                       class="form-control" placeholder="Masukkan password">

                <button type="button" class="btn toggle-password-btn"
                        onclick="togglePassword()" id="toggleBtn">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-login text-white">
                <i class="bi bi-box-arrow-in-right me-1"></i>
                Login
            </button>
        </div>
    </form>

    <div class="footer-text">
        © {{ date('Y') }} Abee Hijab
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const btn = document.getElementById('toggleBtn');

    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        input.type = 'password';
        btn.innerHTML = '<i class="bi bi-eye"></i>';
    }
}
</script>

</body>
</html>