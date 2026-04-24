@extends('layouts.kasir')

@section('page_title', 'Transaksi')
@section('page_subtitle', 'Buat transaksi penjualan Abee Hijab')

@section('content')
<div class="row g-4">

    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Pilih Produk</h5>
                <p class="text-muted small mb-4">Cari dan tambahkan produk ke keranjang.</p>

                <div class="input-group mb-3">
                    <span class="input-group-text bg-white border-end-0 rounded-start-4">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text"
                           id="searchProduct"
                           class="form-control border-start-0 rounded-end-4"
                           placeholder="Cari nama produk hijab...">
                </div>

                <div class="d-flex gap-2 mb-4 overflow-auto pb-1" id="categoryFilter">
                    <button type="button"
                            class="btn btn-sm rounded-pill text-white filter-btn active"
                            style="background:#b85c7a;"
                            data-category="all">
                        Semua
                    </button>

                    @php
                        $categories = $variants
                            ->pluck('product.category.name')
                            ->filter()
                            ->unique()
                            ->values();
                    @endphp

                    @foreach($categories as $category)
                        <button type="button"
                                class="btn btn-sm btn-light rounded-pill filter-btn"
                                data-category="{{ strtolower($category) }}">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>

                <div class="row g-3" id="productList">
                    @forelse($variants as $variant)
                        @php
                            $product = $variant->product;
                            $categoryName = strtolower($product->category->name ?? '');
                        @endphp

                        <div class="col-xl-4 col-md-6 product-item"
                             data-name="{{ strtolower($product->name ?? '') }}"
                             data-category="{{ $categoryName }}">
                            <div class="product-card">
                                <div class="product-img">
                                    @if($product && $product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <i class="bi bi-bag-heart"></i>
                                    @endif
                                </div>

                                <div class="product-body">
                                    <h6>{{ $product->name ?? '-' }}</h6>

                                    <small>
                                        {{ $variant->color ?? '-' }} /
                                        {{ $variant->size ?? '-' }}
                                    </small>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <strong>
                                            Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                                        </strong>

                                        <span class="badge rounded-pill bg-light text-dark">
                                            Stok {{ $variant->stock }}
                                        </span>
                                    </div>

                                    <button type="button"
                                            class="btn btn-sm w-100 rounded-pill text-white mt-3 btn-add-cart"
                                            style="background:#b85c7a;"
                                            data-id="{{ $variant->id }}"
                                            data-name="{{ $product->name ?? '-' }}"
                                            data-color="{{ $variant->color ?? '-' }}"
                                            data-size="{{ $variant->size ?? '-' }}"
                                            data-price="{{ $product->price ?? 0 }}"
                                            data-stock="{{ $variant->stock }}">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center text-muted py-5">
                                Belum ada produk tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm sticky-top" style="top:100px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Keranjang</h5>

                <form action="{{ route('kasir.transaksi.store') }}" method="POST" id="transactionForm">
                    @csrf

                    <div id="cartItems">
                        <div class="text-center text-muted py-4">
                            Keranjang masih kosong.
                        </div>
                    </div>

                    <div id="cartInputs"></div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold" id="subtotalText">Rp 0</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Diskon</span>
                        <span class="fw-semibold">Rp 0</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Total</h5>
                        <h4 class="fw-bold mb-0" style="color:#b85c7a;" id="totalText">Rp 0</h4>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pembayaran</label>
                        <select name="payment_method"
                                id="paymentMethod"
                                class="form-select rounded-4"
                                required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="cash">Tunai</option>
                            <option value="transfer">Transfer</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    <div id="paymentSection" style="display:none;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Uang Bayar</label>
                            <input type="number"
                                   name="pay"
                                   id="payInput"
                                   class="form-control rounded-4"
                                   placeholder="Masukkan nominal bayar">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kembalian</label>
                            <input type="text"
                                   id="changeInput"
                                   class="form-control rounded-4"
                                   value="Rp 0"
                                   readonly>
                        </div>
                    </div>

                    <button type="button"
                            class="btn w-100 rounded-pill text-white fw-semibold py-2"
                            style="background:#b85c7a;"
                            id="btnConfirmTransaction">
                        <i class="bi bi-check-circle me-1"></i>
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="confirmTransactionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body p-4 text-center">
                <i class="bi bi-question-circle mb-3" style="font-size:52px;color:#b85c7a;"></i>

                <h5 class="fw-bold mb-2">Simpan transaksi?</h5>
                <p class="text-muted mb-4">Pastikan produk, jumlah, dan pembayaran sudah benar.</p>

                <div class="rounded-4 p-3 mb-4" style="background:#fdf7f9;">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total</span>
                        <strong id="confirmTotal">Rp 0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Metode</span>
                        <strong id="confirmMethod">-</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Jumlah Item</span>
                        <strong id="confirmItem">0</strong>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button"
                            class="btn text-white rounded-pill px-4"
                            style="background:#b85c7a;"
                            id="btnSubmitTransaction">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-card {
    border: 1px solid #f0e6ea;
    border-radius: 20px;
    padding: 14px;
    background: #fff;
    height: 100%;
    transition: .2s;
}

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(47,47,58,.08);
}

.product-img {
    height: 115px;
    border-radius: 16px;
    background: #fdf7f9;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    color: #b85c7a;
    font-size: 30px;
    margin-bottom: 12px;
}

.product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-body h6 {
    font-weight: 700;
    margin-bottom: 4px;
    font-size: 15px;
}

.product-body small {
    color: #8b8b98;
    font-size: 12px;
}

.product-body strong {
    color: #b85c7a;
    font-size: 14px;
}

.filter-btn.active {
    background: #b85c7a !important;
    color: #fff !important;
}
</style>

<script>
let cart = [];
let activeCategory = 'all';

const formatRupiah = (number) => {
    return 'Rp ' + Number(number).toLocaleString('id-ID');
}

const getTotal = () => {
    return cart.reduce((total, item) => total + (item.price * item.qty), 0);
}

const getTotalItem = () => {
    return cart.reduce((total, item) => total + item.qty, 0);
}

const renderCart = () => {
    const cartItems = document.getElementById('cartItems');
    const cartInputs = document.getElementById('cartInputs');

    cartItems.innerHTML = '';
    cartInputs.innerHTML = '';

    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div class="text-center text-muted py-4">
                Keranjang masih kosong.
            </div>
        `;
    }

    cart.forEach((item, index) => {
        const subtotal = item.price * item.qty;

        cartItems.innerHTML += `
            <div class="border rounded-4 p-3 mb-3">
                <div class="d-flex justify-content-between gap-2">
                    <div>
                        <h6 class="fw-bold mb-1">${item.name}</h6>
                        <small class="text-muted">
                            ${item.color} / ${item.size}<br>
                            ${formatRupiah(item.price)} x ${item.qty}
                        </small>
                    </div>

                    <button type="button" class="btn btn-sm btn-light text-danger rounded-circle"
                            onclick="removeItem(${item.id})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="button" class="btn btn-sm btn-light rounded-circle"
                            onclick="decreaseQty(${item.id})">-</button>

                    <span class="fw-bold">${item.qty}</span>

                    <button type="button" class="btn btn-sm btn-light rounded-circle"
                            onclick="increaseQty(${item.id})">+</button>

                    <span class="ms-auto fw-semibold">
                        ${formatRupiah(subtotal)}
                    </span>
                </div>
            </div>
        `;

        cartInputs.innerHTML += `
            <input type="hidden" name="items[${index}][id]" value="${item.id}">
            <input type="hidden" name="items[${index}][qty]" value="${item.qty}">
        `;
    });

    const total = getTotal();

    document.getElementById('subtotalText').innerText = formatRupiah(total);
    document.getElementById('totalText').innerText = formatRupiah(total);

    const paymentMethod = document.getElementById('paymentMethod').value;
    const payInput = document.getElementById('payInput');

    if (paymentMethod === 'transfer' || paymentMethod === 'qris') {
        payInput.value = total;
    }

    const pay = Number(payInput.value || 0);
    document.getElementById('changeInput').value = formatRupiah(Math.max(pay - total, 0));
}

document.querySelectorAll('.btn-add-cart').forEach(button => {
    button.addEventListener('click', function () {
        const id = Number(this.dataset.id);
        const existing = cart.find(item => item.id === id);
        const stock = Number(this.dataset.stock);

        if (existing) {
            if (existing.qty >= stock) {
                alert('Stok tidak mencukupi');
                return;
            }
            existing.qty++;
        } else {
            cart.push({
                id: id,
                name: this.dataset.name,
                color: this.dataset.color,
                size: this.dataset.size,
                price: Number(this.dataset.price),
                stock: stock,
                qty: 1
            });
        }

        renderCart();
    });
});

function increaseQty(id) {
    const item = cart.find(item => item.id === id);

    if (item.qty >= item.stock) {
        alert('Stok tidak mencukupi');
        return;
    }

    item.qty++;
    renderCart();
}

function decreaseQty(id) {
    const item = cart.find(item => item.id === id);

    if (item.qty > 1) {
        item.qty--;
    } else {
        removeItem(id);
    }

    renderCart();
}

function removeItem(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
}

document.getElementById('paymentMethod').addEventListener('change', function () {
    const paymentSection = document.getElementById('paymentSection');
    const payInput = document.getElementById('payInput');
    const total = getTotal();

    if (this.value === 'cash') {
        paymentSection.style.display = 'block';
        payInput.value = '';
        payInput.setAttribute('required', true);
    } else if (this.value === 'transfer' || this.value === 'qris') {
        paymentSection.style.display = 'none';
        payInput.value = total;
        payInput.removeAttribute('required');
    } else {
        paymentSection.style.display = 'none';
        payInput.value = '';
        payInput.removeAttribute('required');
    }

    renderCart();
});

document.getElementById('payInput').addEventListener('input', renderCart);

document.getElementById('btnConfirmTransaction').addEventListener('click', function () {
    const paymentMethod = document.getElementById('paymentMethod').value;
    const pay = Number(document.getElementById('payInput').value || 0);
    const total = getTotal();

    if (cart.length === 0) {
        alert('Keranjang masih kosong');
        return;
    }

    if (!paymentMethod) {
        alert('Pilih metode pembayaran terlebih dahulu');
        return;
    }

    if (paymentMethod === 'cash' && pay < total) {
        alert('Uang bayar kurang dari total transaksi');
        return;
    }

    document.getElementById('confirmTotal').innerText = formatRupiah(total);
    document.getElementById('confirmItem').innerText = getTotalItem();
    document.getElementById('confirmMethod').innerText =
        paymentMethod === 'cash' ? 'Tunai' :
        paymentMethod === 'transfer' ? 'Transfer' :
        paymentMethod === 'qris' ? 'QRIS' : '-';

    const modal = new bootstrap.Modal(document.getElementById('confirmTransactionModal'));
    modal.show();
});

document.getElementById('btnSubmitTransaction').addEventListener('click', function () {
    this.disabled = true;
    this.innerText = 'Menyimpan...';
    document.getElementById('transactionForm').submit();
});

document.getElementById('searchProduct').addEventListener('keyup', filterProducts);

document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', function () {
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.remove('text-white');
            btn.classList.add('btn-light');
            btn.style.background = '';
        });

        this.classList.add('active');
        this.classList.add('text-white');
        this.classList.remove('btn-light');
        this.style.background = '#b85c7a';

        activeCategory = this.dataset.category;
        filterProducts();
    });
});

function filterProducts() {
    const keyword = document.getElementById('searchProduct').value.toLowerCase();

    document.querySelectorAll('.product-item').forEach(item => {
        const name = item.dataset.name;
        const category = item.dataset.category;

        const matchName = name.includes(keyword);
        const matchCategory = activeCategory === 'all' || category === activeCategory;

        item.style.display = matchName && matchCategory ? 'block' : 'none';
    });
}
</script>
@endsection