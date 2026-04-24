<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abee Hijab Kasir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #b85c7a;
            --primary-soft: #f8e8ef;
            --primary-light: #fdf7f9;
            --dark: #2f2f3a;
            --muted: #8b8b98;
            --border: #f0e6ea;
            --bg: #fbf8f9;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--dark);
        }

        .kasir-wrapper {
            min-height: 100vh;
        }

        .kasir-topbar {
            min-height: 76px;
            background: rgba(255, 255, 255, 0.94);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(12px);
        }

        .brand {
            min-width: 180px;
        }

        .brand h4 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
        }

        .brand small {
            color: var(--muted);
            font-size: 13px;
        }

        .kasir-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex: 1;
        }

        .kasir-nav a {
            text-decoration: none;
            color: #6f6f7a;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 18px;
            border-radius: 999px;
            transition: 0.2s ease;
            white-space: nowrap;
        }

        .kasir-nav a:hover {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .kasir-nav a.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 8px 20px rgba(184, 92, 122, 0.22);
        }

        .user-area {
            min-width: 240px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }

        .user-info {
            text-align: right;
            line-height: 1.2;
        }

        .user-info .name {
            display: block;
            font-size: 14px;
            font-weight: 700;
        }

        .user-info .role {
            font-size: 12px;
            color: var(--muted);
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--primary-soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logout-btn {
            border-radius: 999px;
            padding: 8px 15px;
            font-size: 13px;
            font-weight: 600;
        }

        .kasir-content {
            padding: 32px;
        }

        .content-card {
            background: #fff;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid var(--border);
            box-shadow: 0 12px 32px rgba(47, 47, 58, 0.04);
        }

        .footer-note {
            text-align: center;
            color: #aaa0a5;
            font-size: 12px;
            margin-top: 22px;
        }

        .modal-content {
            border-radius: 24px;
        }

        @media(max-width: 992px) {
            .kasir-topbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 18px;
                gap: 16px;
            }

            .brand,
            .user-area {
                min-width: 100%;
            }

            .kasir-nav {
                width: 100%;
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 4px;
            }

            .user-area {
                justify-content: space-between;
            }

            .kasir-content {
                padding: 18px;
            }

            .content-card {
                padding: 18px;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>

<div class="kasir-wrapper">

    <header class="kasir-topbar">
        <div class="brand d-flex align-items-center gap-2">
    <img src="{{ asset('images/logo abehijab.jpeg') }}"
         alt="logo"
         style="width:36px;height:36px;object-fit:cover;border-radius:8px;">

    <div>
        <h4 class="mb-0">Abee Hijab</h4>
        <small>Kasir Panel</small>
    </div>
</div>

        <nav class="kasir-nav">
            <a href="{{ route('kasir.dashboard') }}"
               class="{{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid me-1"></i>
                Dashboard
            </a>

            <a href="{{ route('kasir.transaksi') }}"
               class="{{ request()->routeIs('kasir.transaksi') || request()->routeIs('kasir.transaksi.*') ? 'active' : '' }}">
                <i class="bi bi-cart-check me-1"></i>
                Transaksi
            </a>

            <a href="{{ route('kasir.riwayat') }}"
   class="{{ request()->routeIs('kasir.riwayat') || request()->routeIs('kasir.riwayat.*') ? 'active' : '' }}">
    <i class="bi bi-clock-history me-1"></i>
    Riwayat
</a>
        </nav>

        <div class="user-area">
            <div class="user-info">
                <span class="name">{{ auth()->user()->name }}</span>
                <span class="role">{{ ucfirst(auth()->user()->role) }}</span>
            </div>

            <div class="avatar">
                @if(auth()->user()->photo)
                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Foto kasir">
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @endif
            </div>

            <button type="button"
                    class="btn btn-outline-danger logout-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-1"></i>
                Logout
            </button>
        </div>
    </header>

    <main class="kasir-content">
        <div class="content-card">
            @yield('content')
        </div>

        <div class="footer-note">
            © {{ date('Y') }} Abee Hijab
        </div>
    </main>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-box-arrow-right text-danger" style="font-size:42px;"></i>
                </div>

                <h5 class="fw-bold mb-2">Yakin ingin logout?</h5>
                <p class="text-muted mb-4">Kamu akan keluar dari sistem Abee Hijab.</p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>