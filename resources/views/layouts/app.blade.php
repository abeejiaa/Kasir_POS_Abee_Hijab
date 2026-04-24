<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abee Hijab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #ffffff, var(--primary-light));
            border-right: 1px solid var(--border);
            padding: 24px 18px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
        }

        .brand-box {
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .brand-subtitle {
            font-size: 12px;
            color: var(--muted);
            margin: 0;
        }

        .menu-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            padding-left: 10px;
        }

        .sidebar .nav-link {
            color: #6f6f7a;
            font-size: 14px;
            font-weight: 600;
            border-radius: 999px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            transition: 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .sidebar .nav-link.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 8px 20px rgba(184, 92, 122, 0.22);
        }

        .content-area {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 78px;
            background: rgba(255, 255, 255, 0.94);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(8px);
        }

        .page-heading h4 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: var(--dark);
        }

        .page-heading p {
            margin: 2px 0 0;
            font-size: 13px;
            color: var(--muted);
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-info {
            text-align: right;
        }

        .user-info .name {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: var(--dark);
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
            font-size: 15px;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logout-btn {
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
        }

        .main-content {
            padding: 28px;
        }

        .content-card {
            background: #fff;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 12px;
            color: #aaa0a5;
            text-align: center;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .main-wrapper {
                flex-direction: column;
            }

            .content-area {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 16px 20px;
                height: auto;
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .user-box {
                width: 100%;
                justify-content: space-between;
            }

            .main-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="main-wrapper">

    <aside class="sidebar">
        <div class="brand-box">
            <img src="{{ asset('images/logo abehijab.jpeg') }}"
                 style="width:38px;height:38px;border-radius:10px;object-fit:cover;"
                 alt="Abee Hijab">

            <div>
                <div class="brand-title">Abee Hijab</div>
                <p class="brand-subtitle">Sistem Kasir & Manajemen</p>
            </div>
        </div>

        <div class="menu-title">Menu Utama</div>

        <nav class="nav flex-column">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Dashboard
                </a>

                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Kategori
                </a>

                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.variants.*') ? 'active' : '' }}">
                    <i class="bi bi-bag"></i> Produk
                </a>

                <a href="{{ route('admin.cashiers.index') }}" class="nav-link {{ request()->routeIs('admin.cashiers.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Kasir
                </a>

                <a href="{{ route('admin.stocks.index') }}" class="nav-link {{ request()->routeIs('admin.stocks.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Stok Barang
                </a>

                <a href="{{ route('admin.transactions.index') }}" class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> Daftar Transaksi
                </a>

                <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i> Laporan
                </a>
            @endif
        </nav>
    </aside>

    <div class="content-area">

        <header class="topbar">
            <div class="page-heading">
                <h4>@yield('page_title', 'Dashboard')</h4>
                <p>@yield('page_subtitle', 'Selamat datang di sistem Abee Hijab')</p>
            </div>

            <div class="user-box">
                <div class="user-info">
                    <span class="name">{{ auth()->user()->name }}</span>
                    <span class="role">{{ ucfirst(auth()->user()->role) }}</span>
                </div>

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <button
                    type="button"
                    class="btn btn-outline-danger logout-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#logoutModal"
                >
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Logout
                </button>
            </div>
        </header>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="content-card">
                @yield('content')
            </div>

            <div class="footer-note">
                © {{ date('Y') }} Abee Hijab
            </div>
        </main>

    </div>

</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-box-arrow-right text-danger" style="font-size:42px;"></i>
                </div>

                <h5 class="fw-bold mb-2">Yakin ingin logout?</h5>

                <p class="text-muted mb-4">
                    Kamu akan keluar dari sistem Abee Hijab.
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button
                        type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            Ya, Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>