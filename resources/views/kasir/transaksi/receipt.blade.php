@extends('layouts.kasir')

@section('page_title', 'Nota Transaksi')
@section('page_subtitle', 'Struk pembayaran Abee Hijab')

@section('content')
<div class="receipt-page">
    <div class="receipt-card" id="printArea">

        <div class="receipt-header">
            <!-- LOGO -->
            <div class="store-logo">
                <img src="{{ asset('images/logo abehijab.jpeg') }}" alt="Abee Hijab">
            </div>

            <h4>Abee Hijab</h4>
            <p>Nota Penjualan</p>
        </div>

        <div class="receipt-info">
            <div>
                <span>No Invoice</span>
                <strong>{{ $transaction->invoice_number }}</strong>
            </div>
            <div>
                <span>Tanggal</span>
                <strong>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y H:i') }}</strong>
            </div>
            <div>
                <span>Kasir</span>
                <strong>{{ $transaction->user->name ?? '-' }}</strong>
            </div>
        </div>

        <div class="receipt-line"></div>

        <div class="receipt-items">
            @foreach($transaction->details as $detail)
                <div class="receipt-item">
                    <div class="item-top">
                        <strong>{{ $detail->productVariant->product->name ?? '-' }}</strong>
                        <strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong>
                    </div>

                    <div class="item-meta">
                        {{ $detail->productVariant->color ?? '-' }} /
                        {{ $detail->productVariant->size ?? '-' }}
                    </div>

                    <div class="item-meta">
                        {{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="receipt-line"></div>

        <div class="receipt-summary">
            <div>
                <span>Total Item</span>
                <strong>{{ $transaction->total_item }}</strong>
            </div>
            <div class="total-highlight">
                <span>Total</span>
                <strong>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
            </div>
            <div>
                <span>Metode</span>
                <strong>{{ strtoupper($transaction->payment_method) }}</strong>
            </div>
            <div>
                <span>Bayar</span>
                <strong>Rp {{ number_format($transaction->pay, 0, ',', '.') }}</strong>
            </div>
            <div>
                <span>Kembalian</span>
                <strong>Rp {{ number_format($transaction->change, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="receipt-thanks">
            <i class="bi bi-heart-fill"></i>
            <p>Terima kasih sudah berbelanja</p>
            <small>Abee Hijab</small>
        </div>

    </div>

    <div class="receipt-actions">
        <a href="{{ route('kasir.transaksi') }}" class="btn btn-light rounded-pill px-3">
            Transaksi Baru
        </a>

        <button onclick="window.print()" class="btn text-white rounded-pill px-3" style="background:#b85c7a;">
            <i class="bi bi-printer"></i>
            Print
        </button>
    </div>
</div>

<style>
.receipt-page {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.receipt-card {
    width: 320px;
    background: #fff;
    border: 1px solid #f0e6ea;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.receipt-header {
    text-align: center;
    margin-bottom: 16px;
}

/* LOGO BARU */
.store-logo {
    width: 60px;
    height: 60px;
    margin: 0 auto 10px;
    border-radius: 14px;
    background: #fff;
    padding: 6px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
}

.store-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.receipt-header h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
}

.receipt-header p {
    font-size: 12px;
    color: #888;
}

.receipt-info,
.receipt-summary {
    background: #fdf7f9;
    border-radius: 12px;
    padding: 12px;
}

.receipt-info div,
.receipt-summary div {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    margin-bottom: 6px;
}

.receipt-line {
    border-top: 1px dashed #ccc;
    margin: 14px 0;
}

.item-top {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
}

.item-meta {
    font-size: 11px;
    color: #888;
}

.total-highlight {
    border-top: 1px solid #eee;
    margin-top: 6px;
    padding-top: 6px;
    font-size: 14px;
}

.total-highlight strong {
    color: #b85c7a;
    font-size: 16px;
}

.receipt-thanks {
    text-align: center;
    margin-top: 14px;
    font-size: 11px;
    color: #777;
}

.receipt-thanks i {
    color: #b85c7a;
}

.receipt-actions {
    width: 320px;
    display: flex;
    justify-content: space-between;
    margin-top: 12px;
}

@media print {
    body * {
        visibility: hidden;
    }

    #printArea, #printArea * {
        visibility: visible;
    }

    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 280px;
        padding: 10px;
        border: none;
        box-shadow: none;
    }

    .receipt-actions,
    .kasir-topbar,
    .page-header,
    .footer-note {
        display: none !important;
    }
}
</style>
@endsection