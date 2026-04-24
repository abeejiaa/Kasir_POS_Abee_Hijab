@extends('layouts.app')

@section('page_title', 'Tambah Kasir')
@section('page_subtitle', 'Tambahkan akun kasir baru')

@section('content')
<div class="row">
    <div class="col-lg-9 mx-auto">
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="fw-bold mb-1">Form Tambah Kasir</h5>
                    <p class="text-muted mb-0">Isi data akun kasir dengan benar.</p>
                </div>

                <form action="{{ route('admin.cashiers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Kasir</label>
                            <input type="text" name="name"
                                   class="form-control rounded-3 @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Contoh: Siti Aisyah">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email"
                                   class="form-control rounded-3 @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="Contoh: kasir1@gmail.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password"
                                   class="form-control rounded-3 @error('password') is-invalid @enderror"
                                   placeholder="Masukkan password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control rounded-3"
                                   placeholder="Ulangi password">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Foto Kasir</label>
                            <input type="file" name="photo" id="photo"
                                   class="form-control rounded-3 @error('photo') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(event)">
                            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            <div class="mt-3 d-flex align-items-center gap-3">
                                <div style="width:120px;height:120px;border-radius:16px;background:#f8e8ef;border:1px solid #f0e6ea;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                                    <img id="preview" src="" style="width:100%;height:100%;object-fit:cover;display:none;">
                                    <div id="placeholder" class="d-flex align-items-center justify-content-center w-100 h-100" style="color:#b85c7a;">
                                        <i class="bi bi-person-image fs-2"></i>
                                    </div>
                                </div>

                                <small class="text-muted">
                                    Format: JPG/PNG <br>
                                    Kosongkan jika tidak perlu foto.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap mt-4">
                        <button type="submit" class="btn rounded-pill px-4 text-white fw-semibold" style="background:#b85c7a;">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('admin.cashiers.index') }}" class="btn btn-light rounded-pill px-4">
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
    }
}
</script>
@endsection