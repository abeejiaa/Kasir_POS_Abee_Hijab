@extends('layouts.app')

@section('page_title', 'Tambah Kategori')
@section('page_subtitle', 'Tambahkan kategori baru untuk produk Abee Hijab')

@section('content')
<div class="row">

    <div class="col-lg-8 mx-auto">

        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">

                <!-- HEADER -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-1">Form Tambah Kategori</h5>
                    <p class="text-muted mb-0">Isi data kategori dengan lengkap dan benar.</p>
                </div>

                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kategori</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control rounded-3 @error('name') is-invalid @enderror"
                            placeholder="Contoh: Pashmina"
                            value="{{ old('name') }}"
                        >

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- GAMBAR -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Gambar Kategori</label>

                        <input
                            type="file"
                            name="image"
                            class="form-control rounded-3 @error('image') is-invalid @enderror"
                            accept="image/*"
                            onchange="previewImage(event)"
                        >

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- PREVIEW -->
                        <div class="mt-3 d-flex align-items-center gap-3">

                            <div style="
                                width:120px;
                                height:120px;
                                border-radius:16px;
                                background:#f8e8ef;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                overflow:hidden;
                                border:1px solid #f0e6ea;
                            ">
                                <img
                                    id="preview"
                                    src=""
                                    style="width:100%;height:100%;object-fit:cover; display:none;"
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

                    <!-- BUTTON -->
                    <div class="d-flex gap-2">

                        <button type="submit"
                                class="btn rounded-pill px-4 text-white fw-semibold"
                                style="background:#b85c7a;">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('admin.categories.index') }}"
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
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    }
</script>
@endsection