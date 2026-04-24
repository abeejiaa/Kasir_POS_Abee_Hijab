@extends('layouts.app')

@section('page_title', 'Edit Varian')
@section('page_subtitle', 'Perbarui data varian produk')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="fw-bold mb-1">Form Edit Varian</h5>
                    <p class="text-muted mb-0">
                        Produk: <span class="fw-semibold" style="color:#2f2f3a;">{{ $variant->product->name }}</span>
                    </p>
                </div>

                <form action="{{ route('admin.variants.update', $variant->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="color" class="form-label fw-semibold">Warna</label>
                            <input
                                type="text"
                                id="color"
                                name="color"
                                class="form-control rounded-3 @error('color') is-invalid @enderror"
                                value="{{ old('color', $variant->color) }}"
                                placeholder="Contoh: Hitam"
                            >
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="size" class="form-label fw-semibold">Ukuran</label>
                            <input
                                type="text"
                                id="size"
                                name="size"
                                class="form-control rounded-3 @error('size') is-invalid @enderror"
                                value="{{ old('size', $variant->size) }}"
                                placeholder="Contoh: All Size / M / L"
                            >
                            @error('size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="stock" class="form-label fw-semibold">Stok</label>
                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                class="form-control rounded-3 @error('stock') is-invalid @enderror"
                                value="{{ old('stock', $variant->stock) }}"
                                min="0"
                            >
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="sku" class="form-label fw-semibold">SKU</label>
                            <input
                                type="text"
                                id="sku"
                                name="sku"
                                class="form-control rounded-3 @error('sku') is-invalid @enderror"
                                value="{{ old('sku', $variant->sku) }}"
                                placeholder="Contoh: PSH-HITAM-AS"
                            >
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap mt-4">
                        <button type="submit"
                                class="btn rounded-pill px-4 text-white fw-semibold"
                                style="background:#b85c7a;">
                            <i class="bi bi-save me-1"></i> Update
                        </button>

                        <a href="{{ route('admin.products.variants.index', $variant->product_id) }}"
                           class="btn btn-light rounded-pill px-4">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection