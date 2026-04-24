@extends('layouts.app')

@section('page_title', 'Varian Produk')
@section('page_subtitle', 'Kelola varian dan stok produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1">Varian Produk</h5>
        <p class="text-muted mb-0">
            Produk: <span class="fw-semibold" style="color:#2f2f3a;">{{ $product->name }}</span>
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>

        <a href="{{ route('admin.products.variants.create', $product->id) }}"
           class="btn rounded-pill px-4 text-white fw-semibold"
           style="background:#b85c7a;">
            <i class="bi bi-plus-circle me-1"></i> Tambah Varian
        </a>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <div style="width:100px;height:100px;border-radius:18px;background:#f8e8ef;border:1px solid #f0e6ea;overflow:hidden;display:flex;align-items:center;justify-content:center;color:#b85c7a;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <i class="bi bi-image fs-3"></i>
                    @endif
                </div>
            </div>

            <div class="col-md-10">
                <h5 class="fw-bold mb-2">{{ $product->name }}</h5>

                <div class="mb-1 text-muted">
                    Harga:
                    <span class="fw-semibold" style="color:#b85c7a;">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>

                <div class="mb-1 text-muted">
                    Total Varian:
                    <span class="fw-semibold text-dark">{{ $variants->count() }}</span>
                </div>

                <div class="text-muted">
                    Total Stok:
                    <span class="fw-semibold text-dark">{{ $variants->sum('stock') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead style="background:#fdf7f9;">
                    <tr>
                        <th width="70" class="ps-4">No</th>
                        <th>Warna</th>
                        <th>Ukuran</th>
                        <th>SKU</th>
                        <th>Stok</th>
                        <th width="240" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($variants as $key => $variant)
                        <tr style="border-bottom:1px solid #f0e6ea;">
                            <td class="ps-4 fw-semibold">{{ $key + 1 }}</td>
                            <td class="fw-semibold">{{ $variant->color }}</td>
                            <td>{{ $variant->size ?: '-' }}</td>
                            <td>{{ $variant->sku ?: '-' }}</td>
                            <td>
                                <span class="badge rounded-pill"
                                      style="background:#e8f5ee;color:#4f9d69;">
                                    {{ $variant->stock }} stok
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.variants.edit', $variant->id) }}"
                                       class="btn btn-sm rounded-pill px-3"
                                       style="background:#fff4df;color:#c98b2b;">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <button
                                        type="button"
                                        class="btn btn-sm rounded-pill px-3 text-white"
                                        style="background:#dc3545;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteVariantModal{{ $variant->id }}"
                                    >
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada varian untuk produk ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($variants as $variant)
    <div class="modal fade" id="deleteVariantModal{{ $variant->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size:48px;"></i>
                    </div>

                    <h5 class="fw-bold mb-2">Hapus Varian?</h5>

                    <p class="text-muted mb-4">
                        Apakah kamu yakin ingin menghapus varian
                        <strong>{{ $variant->color }}</strong>
                        @if($variant->size)
                            ukuran <strong>{{ $variant->size }}</strong>
                        @endif
                        ?
                    </p>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button"
                                class="btn btn-light rounded-pill px-4"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <form action="{{ route('admin.variants.destroy', $variant->id) }}"
                              method="POST"
                              class="m-0">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger rounded-pill px-4">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<style>
    .modal-content {
        animation: zoomIn 0.2s ease;
    }

    @keyframes zoomIn {
        from { transform: scale(0.92); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
@endsection