@extends('layouts.kasir')

@section('content')
<div class="history-wrapper">

    <div class="history-header">
        <div>
            <span class="history-badge">
                <i class="bi bi-clock-history me-1"></i>
                Riwayat Kasir
            </span>
            <h4>Riwayat Transaksi</h4>
            <p>Daftar transaksi penjualan yang sudah dilakukan.</p>
        </div>

        <a href="{{ route('kasir.transaksi') }}" class="btn-new">
            <i class="bi bi-plus-circle me-1"></i>
            Transaksi Baru
        </a>
    </div>

    <div class="history-filter">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchHistory" placeholder="Cari invoice atau metode pembayaran...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table history-table align-middle">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>

            <tbody id="historyTable">
                @forelse($transactions as $transaction)
                    <tr class="history-row"
                        data-search="{{ strtolower($transaction->invoice_number . ' ' . $transaction->payment_method) }}">
                        <td>
                            <div class="invoice-box">
                                <div class="invoice-icon">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <div>
                                    <strong>{{ $transaction->invoice_number }}</strong>
                                    <small>Kasir: {{ $transaction->user->name ?? '-' }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="date-box">
                                <strong>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</strong>
                                <small>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('H:i') }}</small>
                            </div>
                        </td>

                        <td>
                            <span class="item-pill">
                                {{ $transaction->total_item }} item
                            </span>
                        </td>

                        <td>
                            <strong class="price-text">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>
                            <span class="method-badge">
                                {{ strtoupper($transaction->payment_method) }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="action-group">
                                <a href="{{ route('kasir.riwayat.show', $transaction->id) }}"
                                   class="btn-action detail">
                                    Detail
                                </a>

                                <a href="{{ route('kasir.transaksi.receipt', $transaction->id) }}"
                                   class="btn-action nota">
                                    <i class="bi bi-printer me-1"></i>
                                    Nota
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-receipt-cutoff"></i>
                                <h6>Belum ada transaksi</h6>
                                <p>Transaksi yang sudah disimpan akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $transactions->links() }}
    </div>

</div>

<style>
.history-wrapper {
    background: #fff;
}

.history-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 22px;
}

.history-badge {
    display: inline-block;
    background: #f8e8ef;
    color: #b85c7a;
    font-size: 13px;
    font-weight: 700;
    border-radius: 999px;
    padding: 7px 13px;
    margin-bottom: 12px;
}

.history-header h4 {
    font-weight: 800;
    margin-bottom: 4px;
    color: #2f2f3a;
}

.history-header p {
    color: #8b8b98;
    margin: 0;
}

.btn-new {
    background: #b85c7a;
    color: #fff;
    border-radius: 999px;
    padding: 11px 18px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
}

.btn-new:hover {
    background: #a84d6b;
    color: #fff;
}

.history-filter {
    margin-bottom: 18px;
}

.search-box {
    max-width: 420px;
    background: #fbf8f9;
    border: 1px solid #f0e6ea;
    border-radius: 999px;
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-box i {
    color: #b85c7a;
}

.search-box input {
    border: none;
    outline: none;
    background: transparent;
    width: 100%;
    font-size: 14px;
}

.history-table {
    border-collapse: separate;
    border-spacing: 0 10px;
}

.history-table thead th {
    color: #8b8b98;
    font-size: 13px;
    font-weight: 700;
    border: none;
    padding: 10px 14px;
}

.history-table tbody tr {
    background: #fff;
    box-shadow: 0 6px 20px rgba(47,47,58,.04);
}

.history-table tbody td {
    border-top: 1px solid #f0e6ea;
    border-bottom: 1px solid #f0e6ea;
    padding: 16px 14px;
}

.history-table tbody td:first-child {
    border-left: 1px solid #f0e6ea;
    border-radius: 18px 0 0 18px;
}

.history-table tbody td:last-child {
    border-right: 1px solid #f0e6ea;
    border-radius: 0 18px 18px 0;
}

.invoice-box {
    display: flex;
    align-items: center;
    gap: 12px;
}

.invoice-icon {
    width: 42px;
    height: 42px;
    border-radius: 14px;
    background: #f8e8ef;
    color: #b85c7a;
    display: flex;
    align-items: center;
    justify-content: center;
}

.invoice-box strong {
    display: block;
    color: #2f2f3a;
    font-size: 14px;
}

.invoice-box small,
.date-box small {
    color: #8b8b98;
    font-size: 12px;
}

.date-box strong {
    display: block;
    color: #2f2f3a;
    font-size: 14px;
}

.item-pill {
    background: #fdf7f9;
    color: #6f6f7a;
    border-radius: 999px;
    padding: 7px 12px;
    font-size: 13px;
    font-weight: 700;
}

.price-text {
    color: #b85c7a;
    font-size: 15px;
}

.method-badge {
    background: #f8e8ef;
    color: #b85c7a;
    border-radius: 999px;
    padding: 7px 12px;
    font-size: 12px;
    font-weight: 800;
}

.action-group {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
}

.btn-action {
    border-radius: 999px;
    padding: 7px 13px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}

.btn-action.detail {
    background: #f7f7f8;
    color: #2f2f3a;
}

.btn-action.nota {
    background: #b85c7a;
    color: #fff;
}

.empty-state {
    text-align: center;
    padding: 44px 20px;
    color: #8b8b98;
}

.empty-state i {
    font-size: 42px;
    color: #b85c7a;
    margin-bottom: 10px;
}

.empty-state h6 {
    color: #2f2f3a;
    font-weight: 800;
    margin-bottom: 4px;
}

@media(max-width: 768px) {
    .history-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .btn-new,
    .search-box {
        width: 100%;
    }

    .btn-new {
        text-align: center;
    }
}
</style>

<script>
document.getElementById('searchHistory').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();

    document.querySelectorAll('.history-row').forEach(row => {
        const search = row.dataset.search;
        row.style.display = search.includes(keyword) ? '' : 'none';
    });
});
</script>
@endsection