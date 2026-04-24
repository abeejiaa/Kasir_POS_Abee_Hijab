@extends('layouts.app')

@section('page_title', 'Kategori')
@section('page_subtitle', 'Daftar kategori produk Abee Hijab')

@section('content')
<div class="row">

    <div class="col-12">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h5 class="fw-bold mb-1">Daftar Kategori</h5>
                <p class="text-muted mb-0">Kelola kategori produk hijab di sini.</p>
            </div>

            <a href="{{ route('admin.categories.create') }}"
               class="btn rounded-pill px-4 text-white fw-semibold"
               style="background:#b85c7a;">
                <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
            </a>
        </div>

        <!-- CARD -->
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">

                        <!-- TABLE HEAD -->
                        <thead style="background:#fdf7f9;">
                            <tr>
                                <th width="70" class="ps-4">No</th>
                                <th width="110">Gambar</th>
                                <th>Nama Kategori</th>
                                <th width="180">Tanggal Dibuat</th>
                                <th width="280" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <!-- TABLE BODY -->
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr style="border-bottom:1px solid #f0e6ea;">

                                    <td class="ps-4 fw-semibold">{{ $key + 1 }}</td>

                                    <td>
                                        @if($category->image)
                                            <img
                                                src="{{ asset('storage/' . $category->image) }}"
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
                                            {{ $category->name }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="text-muted">
                                            {{ $category->created_at->format('d M Y') }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                                            <a href="{{ route('admin.categories.show', $category->id) }}"
                                               class="btn btn-sm rounded-pill px-3 text-white"
                                               style="background:#6b7aa1;">
                                                <i class="bi bi-eye me-1"></i> Detail
                                            </a>

                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                               class="btn btn-sm rounded-pill px-3"
                                               style="background:#fff4df;color:#c98b2b;">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>

                                            <button
                                                type="button"
                                                class="btn btn-sm rounded-pill px-3 text-white"
                                                style="background:#dc3545;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $category->id }}"
                                            >
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL DELETE -->
                                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">

                                            <div class="modal-body text-center p-4">
                                                <div class="mb-3">
                                                    <i class="bi bi-exclamation-triangle-fill text-danger"
                                                       style="font-size:48px;"></i>
                                                </div>

                                                <h5 class="fw-bold mb-2">
                                                    Hapus Kategori?
                                                </h5>

                                                <p class="text-muted mb-4">
                                                    Apakah kamu yakin ingin menghapus
                                                    <strong>{{ $category->name }}</strong>?
                                                </p>

                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn btn-light rounded-pill px-4"
                                                            data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
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

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Belum ada kategori.
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