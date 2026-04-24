@extends('layouts.app')

@section('page_title', 'Data Kasir')
@section('page_subtitle', 'Kelola akun kasir Abee Hijab')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1">Daftar Kasir</h5>
        <p class="text-muted mb-0">Kelola akun user dengan role kasir.</p>
    </div>

    <a href="{{ route('admin.cashiers.create') }}"
       class="btn rounded-pill px-4 text-white fw-semibold"
       style="background:#b85c7a;">
        <i class="bi bi-plus-circle me-1"></i> Tambah Kasir
    </a>
</div>

<div class="card border-0 rounded-4 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead style="background:#fdf7f9;">
                    <tr>
                        <th width="70" class="ps-4">No</th>
                        <th width="90">Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="220" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($cashiers as $key => $cashier)
                        <tr style="border-bottom:1px solid #f0e6ea;">
                            <td class="ps-4 fw-semibold">{{ $key + 1 }}</td>

                            <td>
                                @if($cashier->photo)
                                    <img src="{{ asset('storage/' . $cashier->photo) }}"
                                         alt="{{ $cashier->name }}"
                                         style="width:46px;height:46px;object-fit:cover;border-radius:50%;border:1px solid #f0e6ea;">
                                @else
                                    <div style="width:46px;height:46px;border-radius:50%;background:#f8e8ef;color:#b85c7a;display:flex;align-items:center;justify-content:center;font-weight:800;border:1px solid #f0e6ea;">
                                        {{ strtoupper(substr($cashier->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            <td class="fw-semibold" style="color:#2f2f3a;">{{ $cashier->name }}</td>
                            <td class="text-muted">{{ $cashier->email }}</td>

                            <td>
                                <span class="badge rounded-pill" style="background:#f8e8ef;color:#b85c7a;">
                                    {{ ucfirst($cashier->role) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.cashiers.edit', $cashier->id) }}"
                                       class="btn btn-sm rounded-pill px-3"
                                       style="background:#fff4df;color:#c98b2b;">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm rounded-pill px-3 text-white"
                                            style="background:#dc3545;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteCashierModal{{ $cashier->id }}">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data kasir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($cashiers as $cashier)
<div class="modal fade" id="deleteCashierModal{{ $cashier->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size:48px;"></i>
                </div>

                <h5 class="fw-bold mb-2">Hapus Data Kasir?</h5>
                <p class="text-muted mb-4">
                    Apakah kamu yakin ingin menghapus akun kasir
                    <strong>{{ $cashier->name }}</strong>?
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('admin.cashiers.destroy', $cashier->id) }}" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection