@extends('layouts.app')

@section('page_title', 'Detail Transaksi')
@section('page_subtitle', 'Informasi detail transaksi penjualan')

@section('content')
<div class="transaction-detail">

    <div class="detail-hero mb-4">
        <div>
            <span class="soft-badge">
                <i class="bi bi-receipt me-1"></i>
                Detail Transaksi
            </span>

            <h4 class="fw-bold mb-1">{{ $transaction->invoice_number }}</h4>
            <p class="text-muted mb-0">
                {{ $transaction->transaction_date->format('d M Y H:i') }}
                • Kasir: {{ $transaction->cashier->name ?? '-' }}
            </p>
        </div>

        <a href="{{ route('admin.transactions.index') }}" class="btn btn-light rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="soft-card h-100">
                <h5 class="fw-bold mb-3">Ringkasan Pembayaran</h5>

                <div class="summary-total mb-4">
                    <span>Total Bayar</span>
                    <h3>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h3>
                </div>

                <div class="info-list">
                    <div class="info-item">
                        <span>No Invoice</span>
                        <strong>{{ $transaction->invoice_number }}</strong>
                    </div>

                    <div class="info-item">
                        <span>Kasir</span>
                        <strong>{{ $transaction->cashier->name ?? '-' }}</strong>
                    </div>

                    <div class="info-item">
                        <span>Tanggal</span>
                        <strong>{{ $transaction->transaction_date->format('d M Y H:i') }}</strong>
                    </div>

                    <div class="info-item">
                        <span>Total Item</span>
                        <strong>{{ $transaction->total_item }} item</strong>
                    </div>

                    <div class="info-item">
                        <span>Pembayaran</span>
                        <strong>
                            @if($transaction->payment_type === 'cash')
                                Cash
                            @elseif($transaction->payment_type === 'cashless')
                                Cashless - {{ strtoupper($transaction->payment_method ?? '-') }}
                            @else
                                -
                            @endif
                        </strong>
                    </div>

                    <div class="info-item">
                        <span>Uang Diterima</span>
                        <strong>Rp {{ number_format($transaction->pay, 0, ',', '.') }}</strong>
                    </div>

                    <div class="info-item">
                        <span>Kembalian</span>
                        <strong>Rp {{ number_format($transaction->change ?? 0, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="soft-card">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold mb-1">Produk Dibeli</h5>
                        <p class="text-muted mb-0 small">Daftar produk dalam transaksi ini.</p>
                    </div>

                    <span class="soft-badge">
                        {{ $transaction->details->count() }} Produk
                    </span>
                </div>

                <div class="product-list">
                    @forelse($transaction->details as $key => $detail)
                        <div class="product-item">
                            <div class="product-number">
                                {{ $key + 1 }}
                            </div>

                            <div class="product-content">
                                <div class="d-flex justify-content-between gap-3 flex-wrap">
                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            {{ $detail->variant->product->name ?? '-' }}
                                        </h6>

                                        <p class="text-muted mb-0 small">
                                            Varian:
                                            {{ $detail->variant->color ?? '-' }}
                                            @if($detail->variant?->size)
                                                / {{ $detail->variant->size }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="text-end">
                                        <div class="fw-bold" style="color:#b85c7a;">
                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Tidak ada detail transaksi.
                        </div>
                    @endforelse
                </div>

                @if($transaction->details->count() > 0)
                    <div class="grand-total mt-4">
                        <span>Total Transaksi</span>
                        <strong>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<style>
    .detail-hero {
        background: linear-gradient(135deg, #fff, #fdf7f9);
        border: 1px solid #f0e6ea;
        border-radius: 24px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .soft-badge {
        display: inline-block;
        background: #f8e8ef;
        color: #b85c7a;
        border-radius: 999px;
        padding: 7px 13px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .soft-card {
        background: #fff;
        border: 1px solid #f0e6ea;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(47,47,58,.04);
    }

    .summary-total {
        background: #fdf7f9;
        border-radius: 20px;
        padding: 20px;
    }

    .summary-total span {
        color: #8b8b98;
        font-size: 13px;
        font-weight: 600;
    }

    .summary-total h3 {
        margin: 6px 0 0;
        font-weight: 800;
        color: #b85c7a;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        gap: 18px;
        border-bottom: 1px dashed #f0e6ea;
        padding-bottom: 10px;
        font-size: 14px;
    }

    .info-item span {
        color: #8b8b98;
    }

    .info-item strong {
        text-align: right;
        color: #2f2f3a;
    }

    .product-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .product-item {
        display: flex;
        gap: 14px;
        padding: 16px;
        border: 1px solid #f0e6ea;
        border-radius: 20px;
        background: #fcfcfc;
    }

    .product-number {
        width: 36px;
        height: 36px;
        border-radius: 14px;
        background: #f8e8ef;
        color: #b85c7a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        flex-shrink: 0;
    }

    .product-content {
        flex: 1;
    }

    .grand-total {
        background: #b85c7a;
        color: #fff;
        border-radius: 20px;
        padding: 18px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .grand-total strong {
        font-size: 20px;
    }

    @media(max-width: 768px) {
        .detail-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection