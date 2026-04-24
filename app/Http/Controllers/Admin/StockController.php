<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;

class StockController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::with(['product.category'])
            ->latest()
            ->get();

        return view('admin.stocks.index', compact('variants'));
    }
}