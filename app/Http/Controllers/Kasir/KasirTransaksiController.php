<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirTransaksiController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::with('product')
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        return view('kasir.transaksi.index', compact('variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'pay' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:product_variants,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $items = collect($request->items);

            $totalItem = 0;
            $totalPrice = 0;

            foreach ($items as $item) {
                $variant = ProductVariant::with('product')->findOrFail($item['id']);

                if ($variant->stock < $item['qty']) {
                    return back()->with('error', 'Stok produk tidak mencukupi.');
                }

                $price = $variant->product->price;
                $subtotal = $price * $item['qty'];

                $totalItem += $item['qty'];
                $totalPrice += $subtotal;
            }

            if ($request->pay < $totalPrice) {
                return back()->with('error', 'Uang bayar kurang dari total transaksi.');
            }

            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . date('YmdHis'),
                'user_id' => auth()->id(),
                'transaction_date' => now(),
                'total_item' => $totalItem,
                'total_price' => $totalPrice,
                'payment_type' => 'cash',
                'payment_method' => $request->payment_method,
                'pay' => $request->pay,
                'change' => $request->pay - $totalPrice,
            ]);

            foreach ($items as $item) {
                $variant = ProductVariant::with('product')->findOrFail($item['id']);

                $price = $variant->product->price;
                $subtotal = $price * $item['qty'];

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_variant_id' => $variant->id,
                    'qty' => $item['qty'],
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $variant->decrement('stock', $item['qty']);
            }

            DB::commit();

            return redirect()
    ->route('kasir.transaksi.receipt', $transaction->id)
    ->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    public function receipt(Transaction $transaction)
{
    $transaction->load([
        'details.productVariant.product',
        'user'
    ]);

    return view('kasir.transaksi.receipt', compact('transaction'));
}

public function history()
{
    $transactions = Transaction::with('user')
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

    return view('kasir.riwayat.index', compact('transactions'));
}

public function show(Transaction $transaction)
{
    if ($transaction->user_id !== auth()->id()) {
        abort(403);
    }

    $transaction->load([
        'details.productVariant.product',
        'user'
    ]);

    return view('kasir.riwayat.show', compact('transaction'));
}
}
