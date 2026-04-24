<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Tampilkan daftar varian dari 1 produk
     */
    public function index(Product $product)
    {
        $variants = $product->variants()->latest()->get();

        return view('admin.products.variants.index', compact('product', 'variants'));
    }

    /**
     * Tampilkan form tambah varian
     */
    public function create(Product $product)
    {
        return view('admin.products.variants.create', compact('product'));
    }

    /**
     * Simpan varian baru
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'color' => 'required|string|max:100',
            'size'  => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'sku'   => 'nullable|string|max:100',
        ], [
            'color.required' => 'Warna wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer'  => 'Stok harus berupa angka.',
            'stock.min'      => 'Stok tidak boleh kurang dari 0.',
        ]);

        $product->variants()->create([
            'color' => $request->color,
            'size'  => $request->size,
            'stock' => $request->stock,
            'sku'   => $request->sku,
        ]);

        return redirect()->route('admin.products.variants.index', $product->id)
            ->with('success', 'Varian produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit varian
     */
    public function edit(ProductVariant $variant)
    {
        $variant->load('product');

        return view('admin.products.variants.edit', compact('variant'));
    }

    /**
     * Update varian
     */
    public function update(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'color' => 'required|string|max:100',
            'size'  => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'sku'   => 'nullable|string|max:100',
        ], [
            'color.required' => 'Warna wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer'  => 'Stok harus berupa angka.',
            'stock.min'      => 'Stok tidak boleh kurang dari 0.',
        ]);

        $variant->update([
            'color' => $request->color,
            'size'  => $request->size,
            'stock' => $request->stock,
            'sku'   => $request->sku,
        ]);

        return redirect()->route('admin.products.variants.index', $variant->product_id)
            ->with('success', 'Varian produk berhasil diperbarui.');
    }

    /**
     * Hapus varian
     */
    public function destroy(ProductVariant $variant)
    {
        $productId = $variant->product_id;

        $variant->delete();

        return redirect()->route('admin.products.variants.index', $productId)
            ->with('success', 'Varian produk berhasil dihapus.');
    }
}