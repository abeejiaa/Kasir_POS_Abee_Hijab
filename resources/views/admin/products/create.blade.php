@extends('layouts.app')

@section('page_title', 'Tambah Produk')
@section('page_subtitle', 'Tambahkan produk baru untuk Abee Hijab')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">

        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="fw-bold mb-1">Form Tambah Produk</h5>
                    <p class="text-muted mb-0">Isi data produk dengan lengkap dan benar.</p>
                </div>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control rounded-3 @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Pashmina Ceruty"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="category_id" class="form-select rounded-3 @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Harga</label>
                            <input
                                type="number"
                                name="price"
                                class="form-control rounded-3 @error('price') is-invalid @enderror"
                                value="{{ old('price') }}"
                                placeholder="Contoh: 50000"
                            >
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pengelolaan Stok</label>
                            <div class="p-3 rounded-4 border" style="background:#fdf7f9;border-color:#f0e6ea !important;">
                                <div class="fw-semibold mb-1" style="color:#b85c7a;">
                                    Stok berdasarkan varian
                                </div>
                                <small class="text-muted">
                                    Stok akan diatur setelah produk disimpan, berdasarkan warna dan ukuran.
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Gambar Produk</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="form-control rounded-3 @error('image') is-invalid @enderror"
                                accept="image/*"
                                onchange="previewImage(event)"
                            >
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mt-3 d-flex align-items-center gap-3">
                                <div style="
                                    width:120px;
                                    height:120px;
                                    border-radius:16px;
                                    background:#f8e8ef;
                                    border:1px solid #f0e6ea;
                                    overflow:hidden;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                ">
                                    <img
                                        id="preview"
                                        src=""
                                        style="width:100%;height:100%;object-fit:cover;display:none;"
                                    >

                                    <div id="placeholder"
                                         class="d-flex align-items-center justify-content-center w-100 h-100"
                                         style="color:#b85c7a;">
                                        <i class="bi bi-image fs-2"></i>
                                    </div>
                                </div>

                                <small class="text-muted">
                                    Format: JPG/PNG <br>
                                    Rekomendasi ukuran 1:1
                                </small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea
                                name="description"
                                rows="4"
                                class="form-control rounded-3 @error('description') is-invalid @enderror"
                                placeholder="Deskripsi produk..."
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap mt-4">
                        <button type="submit"
                                class="btn rounded-pill px-4 text-white fw-semibold"
                                style="background:#b85c7a;">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-light rounded-pill px-4">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            preview.style.display = 'none';
            placeholder.style.display = 'flex';
        }
    }
</script>
@endsection