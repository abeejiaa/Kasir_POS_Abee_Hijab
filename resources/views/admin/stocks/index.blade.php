@extends('layouts.app')

@section('page_title', 'Stok Barang')
@section('page_subtitle', 'Pantau stok produk berdasarkan varian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1">Daftar Stok Barang</h5>
        <p class="text-muted mb-0">Stok ditampilkan berdasarkan varian warna dan ukuran produk.</p>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead style="background:#fdf7f9;">
                    <tr>
                        <th width="70" class="ps-4">No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Warna</th>
                        <th>Ukuran</th>
                        <th>SKU</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($variants as $key => $variant)
                        <tr style="border-bottom:1px solid #f0e6ea;">
                            <td class="ps-4 fw-semibold">{{ $key + 1 }}</td>

                            <td class="fw-semibold" style="color:#2f2f3a;">
                                {{ $variant->product->name ?? '-' }}
                            </td>

                            <td>
                                <span class="badge rounded-pill" style="background:#f8e8ef;color:#b85c7a;">
                                    {{ $variant->product->category->name ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $variant->color }}</td>

                            <td>{{ $variant->size ?: '-' }}</td>

                            <td>
                                <span class="text-muted">{{ $variant->sku ?: '-' }}</span>
                            </td>

                            <td>
                                @if($variant->stock <= 5)
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:#fdeaea;color:#dc3545;">
                                        {{ $variant->stock }} Stok Menipis
                                    </span>
                                @elseif($variant->stock <= 15)
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:#fff4df;color:#c98b2b;">
                                        {{ $variant->stock }} Stok Sedang
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:#e8f5ee;color:#4f9d69;">
                                        {{ $variant->stock }} Aman
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data stok barang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection