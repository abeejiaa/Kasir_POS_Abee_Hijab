@extends('layouts.app')

@section('content')
<div class="row g-4">

    <!-- WELCOME CARD -->
    <div class="col-12">
        <div class="card border-0 rounded-4 shadow-sm" style="background:#fdf7f9;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <div>
                        <span class="badge rounded-pill px-3 py-2 mb-3"
                              style="background:#f8e8ef; color:#b85c7a;">
                            Admin Panel
                        </span>

                        <h2 class="fw-bold mb-2">
                            Halo, Admin 👋
                        </h2>

                        <p class="text-muted mb-0">
                            Selamat datang di sistem manajemen Abee Hijab.
                            Kelola data produk, transaksi, dan laporan dengan mudah.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted mb-2">Total Produk</p>
                    <h3 class="fw-bold mb-1">{{ $totalProduk ?? 0 }}</h3>
                    <small class="text-muted">Produk tersedia</small>
                </div>

                <div class="rounded-4 d-flex align-items-center justify-content-center"
                     style="width:58px;height:58px;background:#f8e8ef;color:#b85c7a;">
                    <i class="bi bi-bag fs-3"></i>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted mb-2">Transaksi Hari Ini</p>
                    <h3 class="fw-bold mb-1">{{ $transaksiHariIni ?? 0 }}</h3>
                    <small class="text-muted">Transaksi berhasil</small>
                </div>

                <div class="rounded-4 d-flex align-items-center justify-content-center"
                     style="width:58px;height:58px;background:#e8f5ee;color:#4f9d69;">
                    <i class="bi bi-receipt fs-3"></i>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted mb-2">Total Penjualan</p>
                    <h3 class="fw-bold mb-1">
                        Rp {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted">Hari ini</small>
                </div>

                <div class="rounded-4 d-flex align-items-center justify-content-center"
                     style="width:58px;height:58px;background:#fff4df;color:#c98b2b;">
                    <i class="bi bi-cash-stack fs-3"></i>
                </div>

            </div>
        </div>
    </div>

    <!-- QUICK MENU -->
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Menu Cepat</h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                            <div class="border rounded-4 p-4 h-100" style="background:#fcfcfc;">
                                <i class="bi bi-bag fs-3" style="color:#b85c7a;"></i>
                                <h6 class="fw-bold text-dark mt-3 mb-1">Kelola Produk</h6>
                                <p class="text-muted small mb-0">
                                    Tambah dan edit produk hijab.
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('admin.transactions.index') }}" class="text-decoration-none">
                            <div class="border rounded-4 p-4 h-100" style="background:#fcfcfc;">
                                <i class="bi bi-receipt fs-3" style="color:#6b7aa1;"></i>
                                <h6 class="fw-bold text-dark mt-3 mb-1">Transaksi</h6>
                                <p class="text-muted small mb-0">
                                    Lihat semua transaksi.
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('admin.reports.index') }}" class="text-decoration-none">
                            <div class="border rounded-4 p-4 h-100" style="background:#fcfcfc;">
                                <i class="bi bi-bar-chart fs-3" style="color:#4f9d69;"></i>
                                <h6 class="fw-bold text-dark mt-3 mb-1">Laporan</h6>
                                <p class="text-muted small mb-0">
                                    Lihat laporan penjualan.
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('admin.cashiers.index') }}" class="text-decoration-none">
                            <div class="border rounded-4 p-4 h-100" style="background:#fcfcfc;">
                                <i class="bi bi-people fs-3" style="color:#c98b2b;"></i>
                                <h6 class="fw-bold text-dark mt-3 mb-1">Data Kasir</h6>
                                <p class="text-muted small mb-0">
                                    Kelola akun kasir.
                                </p>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- NOTE -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Catatan Admin</h5>

                <div class="rounded-4 p-3" style="background:#fdf7f9;">
                    <p class="fw-semibold mb-2" style="color:#b85c7a;">Tips</p>
                    <p class="text-muted small mb-0">
                        Pastikan stok selalu diperbarui dan laporan dicek secara berkala untuk menjaga operasional tetap lancar.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection