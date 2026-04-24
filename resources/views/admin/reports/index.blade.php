@extends('layouts.app')

@section('page_title', 'Laporan')
@section('page_subtitle', 'Laporan penjualan Abee Hijab')

@section('content')

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1">Laporan Penjualan</h5>
        <p class="text-muted mb-0">Pantau hasil penjualan berdasarkan periode tertentu.</p>
    </div>
</div>

<!-- FILTER -->
<div class="card border-0 rounded-4 shadow-sm mb-4">
    <div class="card-body p-4">
        <form method="GET">
            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Awal</label>
                    <input type="date" name="start_date" class="form-control rounded-3"
                           value="{{ $startDate }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Akhir</label>
                    <input type="date" name="end_date" class="form-control rounded-3"
                           value="{{ $endDate }}">
                </div>

                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button class="btn rounded-pill px-4 text-white fw-semibold"
                                style="background:#b85c7a;">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>

                        <a href="{{ route('admin.reports.index') }}"
                           class="btn btn-light rounded-pill px-4">
                            Reset
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- SUMMARY -->
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-2">Total Transaksi</p>
                    <h3 class="fw-bold mb-0">{{ $totalTransactions }}</h3>
                </div>

                <div class="icon-box pink">
                    <i class="bi bi-receipt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-2">Total Item</p>
                    <h3 class="fw-bold mb-0">{{ $totalItems }}</h3>
                </div>

                <div class="icon-box blue">
                    <i class="bi bi-box"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 rounded-4 shadow-sm h-100">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-2">Pendapatan</p>
                    <h3 class="fw-bold mb-0" style="color:#b85c7a;">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="icon-box green">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="card border-0 rounded-4 shadow-sm">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table align-middle mb-0">

                <thead style="background:#fdf7f9;">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Invoice</th>
                        <th>Kasir</th>
                        <th>Tanggal</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $key => $transaction)
                        <tr style="border-bottom:1px solid #f0e6ea;">
                            <td class="ps-4 fw-semibold">{{ $key + 1 }}</td>

                            <td class="fw-semibold" style="color:#2f2f3a;">
                                {{ $transaction->invoice_number }}
                            </td>

                            <td>{{ $transaction->cashier->name ?? '-' }}</td>

                            <td class="text-muted">
                                {{ $transaction->transaction_date->format('d M Y H:i') }}
                            </td>

                            <td>
                                <span class="badge rounded-pill"
                                      style="background:#f8e8ef;color:#b85c7a;">
                                    {{ $transaction->total_item }}
                                </span>
                            </td>

                            <td class="fw-semibold" style="color:#b85c7a;">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>

                            <td>
                                @if($transaction->payment_type === 'cash')
                                    <span class="badge rounded-pill"
                                          style="background:#e8f5ee;color:#4f9d69;">
                                        Cash
                                    </span>
                                @elseif($transaction->payment_type === 'cashless')
                                    <span class="badge rounded-pill"
                                          style="background:#eef2ff;color:#6b7aa1;">
                                        {{ strtoupper($transaction->payment_method ?? '-') }}
                                    </span>
                                @else
                                    <span class="badge rounded-pill"
                                          style="background:#f1f1f1;color:#777;">
                                        -
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data laporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                @if($transactions->count() > 0)
                    <tfoot style="background:#fdf7f9;">
                        <tr>
                            <th colspan="4" class="text-end">Total</th>
                            <th>{{ $totalItems }}</th>
                            <th style="color:#b85c7a;">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                @endif

            </table>
        </div>

    </div>
</div>

<style>
.icon-box {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

.icon-box.pink { background:#f8e8ef; color:#b85c7a; }
.icon-box.blue { background:#eef2ff; color:#6b7aa1; }
.icon-box.green { background:#e8f5ee; color:#4f9d69; }
</style>

@endsection