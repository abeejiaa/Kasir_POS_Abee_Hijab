@extends('layouts.app')

@section('page_title', 'Daftar Transaksi')
@section('page_subtitle', 'Transaksi penjualan dari kasir')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1">Daftar Transaksi</h5>
        <p class="text-muted mb-0">Pantau seluruh transaksi penjualan yang dilakukan kasir.</p>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead style="background:#fdf7f9;">
                    <tr>
                        <th width="70" class="ps-4">No</th>
                        <th>No Invoice</th>
                        <th>Kasir</th>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th width="120" class="text-center">Aksi</th>
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
                                <span class="badge rounded-pill" style="background:#f8e8ef;color:#b85c7a;">
                                    {{ $transaction->total_item }} item
                                </span>
                            </td>

                            <td>
                                <span class="fw-semibold" style="color:#b85c7a;">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                @if($transaction->payment_type === 'cash')
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:#e8f5ee;color:#4f9d69;">
                                        Cash
                                    </span>
                                @elseif($transaction->payment_type === 'cashless')
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:#eef2ff;color:#6b7aa1;">
                                        Cashless - {{ strtoupper($transaction->payment_method ?? '-') }}
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:#f1f1f1;color:#777;">
                                        -
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                   class="btn btn-sm rounded-pill px-3 text-white"
                                   style="background:#6b7aa1;">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection