<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $transactions = Transaction::with('cashier')
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('transaction_date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('transaction_date', '<=', $endDate);
            })
            ->latest()
            ->get();

        $totalTransactions = $transactions->count();
        $totalItems = $transactions->sum('total_item');
        $totalRevenue = $transactions->sum('total_price');

        return view('admin.reports.index', compact(
            'transactions',
            'totalTransactions',
            'totalItems',
            'totalRevenue',
            'startDate',
            'endDate'
        ));
    }
}