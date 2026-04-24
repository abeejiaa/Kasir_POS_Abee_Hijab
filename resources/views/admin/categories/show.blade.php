@extends('layouts.app')

@section('page_title', 'Detail Kategori')
@section('page_subtitle', 'Informasi lengkap kategori produk')

@section('content')
<div class="card border-0 rounded-4 shadow-sm">
    <div class="card-body p-4">
        <div class="mb-4">
            <h5 class="fw-bold mb-1">Detail Kategori</h5>
            <p class="text-muted mb-0">Lihat informasi kategori secara lengkap.</p>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-md-4">
                <div style="
                    width:100%;
                    max-width:280px;
                    height:280px;
                    border-radius:24px;
                    background:#f8e8ef;
                    border:1px solid #f0e6ea;
                    overflow:hidden;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    color:#b85c7a;
                ">
                    @if($category->image)
                        <img
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            style="width:100%;height:100%;object-fit:cover;"
                        >
                    @else
                        <i class="bi bi-image fs-1"></i>
                    @endif
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Nama Kategori</label>
                    <div class="form-control rounded-3 bg-light">{{ $category->name }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Tanggal Dibuat</label>
                    <div class="form-control rounded-3 bg-light">{{ $category->created_at->format('d F Y') }}</div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted">Terakhir Diupdate</label>
                    <div class="form-control rounded-3 bg-light">{{ $category->updated_at->format('d F Y H:i') }}</div>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                       class="btn rounded-pill px-4"
                       style="background:#fff4df;color:#c98b2b;">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="btn btn-light rounded-pill px-4">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection