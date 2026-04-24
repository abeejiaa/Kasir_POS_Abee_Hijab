@extends('layouts.app')

@section('page_title', 'Detail Produk')
@section('page_subtitle', 'Informasi lengkap produk Abee Hijab')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h5 class="fw-bold mb-1">Detail Produk</h5>
        <p class="text-muted mb-0">Lihat informasi produk dan varian stoknya.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>

        <a href="{{ route('admin.products.edit', $product->id) }}"
           class="btn rounded-pill px-4"
           style="background:#fff4df;color:#c98b2b;">
            <i class="bi bi-pencil-square me-1"></i> Edit Produk
        </a>

        <a href="{{ route('admin.products.variants.index', $product->id) }}"
           class="btn rounded-pill px-4 text-white"
           style="background:#b85c7a;">
            <i class="bi bi-list-ul me-1"></i> Kelola Varian
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <div style="
                    width:100%;
                    height:320px;
                    border-radius:24px;
                    background:#f8e8ef;
                    border:1px solid #f0e6ea;
                    overflow:hidden;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    color:#b85c7a;
                ">
                    @if($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            style="width:100%;height:100%;object-fit:cover;"
                        >
                    @else
                        <div>
                            <i class="bi bi-image fs-1 d-block mb-2"></i>
                            <span>Tidak ada gambar</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Informasi Produk</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Nama Produk</label>
                        <div class="form-control rounded-3 bg-light">{{ $product->name }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Kategori</label>
                        <div class="form-control rounded-3 bg-light">{{ $product->category->name ?? '-' }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Harga</label>
                        <div class="form-control rounded-3 bg-light">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Total Stok</label>
                        <div class="form-control rounded-3 bg-light">
                            {{ $product->variants->sum('stock') }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Jumlah Varian</label>
                        <div class="form-control rounded-3 bg-light">
                            {{ $product->variants->count() }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Tanggal Dibuat</label>
                        <div class="form-control rounded-3 bg-light">
                            {{ $product->created_at->format('d F Y') }}
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-muted">Deskripsi</label>
                        <div class="form-control rounded-3 bg-light" style="min-height:100px;">
                            {{ $product->description ?: 'Belum ada deskripsi produk.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h5 class="fw-bold mb-0">Daftar Varian</h5>

                    <a href="{{ route('admin.products.variants.create', $product->id) }}"
                       class="btn btn-sm rounded-pill text-white px-3"
                       style="background:#b85c7a;">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Varian
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead style="background:#fdf7f9;">
                            <tr>
                                <th width="70">No</th>
                                <th>Warna</th>
                                <th>Ukuran</th>
                                <th>SKU</th>
                                <th>Stok</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($product->variants as $key => $variant)
                                <tr style="border-bottom:1px solid #f0e6ea;">
                                    <td>{{ $key + 1 }}</td>
                                    <td class="fw-semibold">{{ $variant->color }}</td>
                                    <td>{{ $variant->size ?: '-' }}</td>
                                    <td>{{ $variant->sku ?: '-' }}</td>
                                    <td>
                                        <span class="badge rounded-pill"
                                              style="background:#e8f5ee;color:#4f9d69;">
                                            {{ $variant->stock }} stok
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Belum ada varian untuk produk ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($product->variants->count() > 0)
                    <div class="mt-3">
                        <a href="{{ route('admin.products.variants.index', $product->id) }}"
                           class="btn btn-light rounded-pill btn-sm px-3">
                            Kelola Semua Varian
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection