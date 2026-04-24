@extends('layouts.kasir')

@section('page_title', 'Dashboard Kasir')
@section('page_subtitle', 'Kelola transaksi penjualan Abee Hijab')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="dashboard-hero">
            <div>
                <span class="hero-badge">
                    <i class="bi bi-stars me-1"></i>
                    Kasir Panel
                </span>

                <h2>Halo, {{ auth()->user()->name }}</h2>
                <p>
                    Selamat bekerja. Kelola transaksi pelanggan Abee Hijab dengan teliti dan nyaman.
                </p>
            </div>

            <a href="{{ route('kasir.transaksi') }}" class="hero-btn">
                <i class="bi bi-cart-check me-1"></i>
                Mulai Transaksi
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div>
                <p>Transaksi Hari Ini</p>
                <h3>{{ $transaksiHariIni ?? 0 }}</h3>
                <small>Transaksi berhasil</small>
            </div>

            <div class="stat-icon pink">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div>
                <p>Penjualan Hari Ini</p>
                <h3>Rp {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}</h3>
                <small>Total pendapatan</small>
            </div>

            <div class="stat-icon green">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div>
                <p>Status Kasir</p>
                <h3 class="text-success">Aktif</h3>
                <small>Sedang login</small>
            </div>

            <div class="stat-icon yellow">
                <i class="bi bi-person-check"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="soft-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Menu Cepat</h5>
                <small class="text-muted">Akses fitur kasir</small>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <a href="{{ route('kasir.transaksi') }}" class="quick-menu">
                        <div class="quick-icon pink">
                            <i class="bi bi-cart-plus"></i>
                        </div>
                        <div>
                            <h6>Transaksi Baru</h6>
                            <p>Buat transaksi penjualan hijab.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="#" class="quick-menu">
                        <div class="quick-icon blue">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <h6>Riwayat Transaksi</h6>
                            <p>Lihat transaksi yang sudah dilakukan.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="soft-card h-100">
            <h5 class="fw-bold mb-3">Catatan Kasir</h5>

            <div class="note-box">
                <div class="note-icon">
                    <i class="bi bi-info-circle"></i>
                </div>

                <div>
                    <p>Pengingat</p>
                    <small>
                        Periksa kembali barang, metode pembayaran, dan nominal sebelum menyimpan transaksi.
                    </small>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.dashboard-hero {
    background: linear-gradient(135deg, #fff, #fdf7f9);
    border: 1px solid #f0e6ea;
    border-radius: 24px;
    padding: 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.hero-badge {
    display: inline-block;
    background: #f8e8ef;
    color: #b85c7a;
    font-size: 13px;
    font-weight: 700;
    border-radius: 999px;
    padding: 8px 14px;
    margin-bottom: 14px;
}

.dashboard-hero h2 {
    font-weight: 800;
    margin-bottom: 8px;
    color: #2f2f3a;
}

.dashboard-hero p {
    color: #8b8b98;
    margin: 0;
}

.hero-btn {
    background: #b85c7a;
    color: #fff;
    text-decoration: none;
    border-radius: 999px;
    padding: 12px 20px;
    font-weight: 700;
    white-space: nowrap;
}

.hero-btn:hover {
    color: #fff;
    background: #a84d6b;
}

.stat-card,
.soft-card {
    background: #fff;
    border: 1px solid #f0e6ea;
    border-radius: 22px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(47,47,58,.04);
}

.stat-card {
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-card p {
    color: #8b8b98;
    margin-bottom: 8px;
}

.stat-card h3 {
    font-weight: 800;
    margin-bottom: 4px;
    color: #2f2f3a;
}

.stat-card small {
    color: #8b8b98;
}

.stat-icon,
.quick-icon,
.note-icon {
    width: 54px;
    height: 54px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-icon.pink,
.quick-icon.pink {
    background: #f8e8ef;
    color: #b85c7a;
}

.stat-icon.green {
    background: #e8f5ee;
    color: #4f9d69;
}

.stat-icon.yellow {
    background: #fff4df;
    color: #c98b2b;
}

.quick-icon.blue {
    background: #eef2ff;
    color: #6b7aa1;
}

.quick-menu {
    display: flex;
    gap: 14px;
    align-items: center;
    text-decoration: none;
    border: 1px solid #f0e6ea;
    border-radius: 20px;
    padding: 18px;
    height: 100%;
    background: #fcfcfc;
    transition: .2s;
}

.quick-menu:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(47,47,58,.06);
}

.quick-menu h6 {
    color: #2f2f3a;
    font-weight: 800;
    margin-bottom: 4px;
}

.quick-menu p {
    color: #8b8b98;
    font-size: 13px;
    margin: 0;
}

.note-box {
    display: flex;
    gap: 14px;
    background: #fdf7f9;
    border-radius: 20px;
    padding: 18px;
}

.note-icon {
    background: #f8e8ef;
    color: #b85c7a;
    flex-shrink: 0;
}

.note-box p {
    color: #b85c7a;
    font-weight: 800;
    margin-bottom: 6px;
}

.note-box small {
    color: #8b8b98;
}

@media(max-width: 768px) {
    .dashboard-hero {
        flex-direction: column;
        align-items: flex-start;
    }

    .hero-btn {
        width: 100%;
        text-align: center;
    }
}
</style>
@endsection