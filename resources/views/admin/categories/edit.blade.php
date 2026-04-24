@extends('layouts.app')

@section('page_title', 'Edit Kategori')
@section('page_subtitle', 'Ubah data kategori produk Abee Hijab')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="fw-bold mb-1">Form Edit Kategori</h5>
                    <p class="text-muted mb-0">Perbarui data kategori dengan benar.</p>
                </div>

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Kategori</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control rounded-3 @error('name') is-invalid @enderror"
                            placeholder="Contoh: Pashmina"
                            value="{{ old('name', $category->name) }}"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">Gambar Kategori</label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="form-control rounded-3 @error('image') is-invalid @enderror"
                            accept="image/*"
                            onchange="previewImage(event)"
                        >

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted d-block mt-2">
                            Kosongkan jika tidak ingin mengganti gambar.
                        </small>

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
                                @if($category->image)
                                    <img
                                        id="preview"
                                        src="{{ asset('storage/' . $category->image) }}"
                                        style="width:100%;height:100%;object-fit:cover;"
                                    >

                                    <div id="placeholder"
                                         class="d-none align-items-center justify-content-center w-100 h-100"
                                         style="color:#b85c7a;">
                                        <i class="bi bi-image fs-2"></i>
                                    </div>
                                @else
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
                                @endif
                            </div>

                            <small class="text-muted">
                                Format: JPG/PNG <br>
                                Rekomendasi ukuran 1:1
                            </small>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button type="submit"
                                class="btn rounded-pill px-4 text-white fw-semibold"
                                style="background:#b85c7a;">
                            <i class="bi bi-save me-1"></i> Update
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
        const placeholder = document.getElementById('placeholder');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            placeholder.classList.remove('d-flex');
            placeholder.classList.add('d-none');
        }
    }
</script>
@endsection