<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total produk
        $totalProduk = Product::count();

        // Transaksi hari ini
        $transaksiHariIni = Transaction::whereDate('transaction_date', Carbon::today())->count();

        // Total penjualan hari ini
        $totalPenjualan = Transaction::whereDate('transaction_date', Carbon::today())
                                    ->sum('total_price');

        return view('admin.dashboard', compact(
            'totalProduk',
            'transaksiHariIni',
            'totalPenjualan'
        ));
    }
}