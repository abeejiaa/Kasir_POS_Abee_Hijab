<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // tanggal hari ini
        $today = Carbon::today();

        // jumlah transaksi hari ini
        $transaksiHariIni = Transaction::whereDate('transaction_date', $today)
            ->count();

        // total penjualan hari ini
        $totalPenjualan = Transaction::whereDate('transaction_date', $today)
            ->sum('total_price');

        return view('kasir.dashboard', compact(
            'transaksiHariIni',
            'totalPenjualan'
        ));
    }
}