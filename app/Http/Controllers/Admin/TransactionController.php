<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['cashier', 'details'])
            ->latest()
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load([
            'cashier',
            'details.variant.product',
        ]);

        return view('admin.transactions.show', compact('transaction'));
    }
}