@extends('layouts.app')

@section('page_title', 'Produk')
@section('page_subtitle', 'Daftar produk Abee Hijab')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h5 class="fw-bold mb-1">Daftar Produk</h5>
                <p class="text-muted mb-0">Kelola data produk hijab di sini.</p>
            </div>

            <a href="{{ route('admin.products.create') }}"
               class="btn rounded-pill px-4 text-white fw-semibold"
               style="background:#b85c7a;">
                <i class="bi bi-plus-circle me-1"></i> Tambah Produk
            </a>
        </div>

        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead style="background:#fdf7f9;">
                            <tr>
                                <th width="70" class="ps-4">No</th>
                                <th width="100">Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th width="280" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($products as $key => $product)
                                <tr style="border-bottom:1px solid #f0e6ea;">
                                    <td class="ps-4 fw-semibold">{{ $key + 1 }}</td>

                                    <td>
                                        @if($product->image)
                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                width="60"
                                                height="60"
                                                style="object-fit:cover;border-radius:14px;border:1px solid #f0e6ea;"
                                            >
                                        @else
                                            <div class="d-flex align-items-center justify-content-center"
                                                 style="width:60px;height:60px;border-radius:14px;background:#f8e8ef;color:#b85c7a;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="fw-semibold" style="color:#2f2f3a;">
                                            {{ $product->name }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill"
                                              style="background:#f8e8ef;color:#b85c7a;">
                                            {{ $product->category->name ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="fw-semibold" style="color:#b85c7a;">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill"
                                              style="background:#e8f5ee;color:#4f9d69;">
                                            {{ $product->stock }} stok
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="{{ route('admin.products.show', $product->id) }}"
                                               class="btn btn-sm rounded-pill px-3 text-white"
                                               style="background:#6b7aa1;">
                                                <i class="bi bi-eye me-1"></i> Detail
                                            </a>

                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                               class="btn btn-sm rounded-pill px-3"
                                               style="background:#fff4df;color:#c98b2b;">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>

                                            <button
                                                type="button"
                                                class="btn btn-sm rounded-pill px-3 text-white"
                                                style="background:#dc3545;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $product->id }}"
                                            >
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Belum ada produk yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@foreach($products as $product)
    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size:48px;"></i>
                    </div>

                    <h5 class="fw-bold mb-2">Hapus Produk?</h5>

                    <p class="text-muted mb-4">
                        Apakah kamu yakin ingin menghapus produk
                        <strong>{{ $product->name }}</strong>?
                    </p>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button"
                                class="btn btn-light rounded-pill px-4"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <form action="{{ route('admin.products.destroy', $product->id) }}"
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
        from {
            transform: scale(0.92);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>
@endsection