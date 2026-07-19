@extends('operator.layouts.app')

@section('title', 'Dashboard Operator Laundry')

@section('content')
<div class="row">

    {{-- Pendapatan Hari Ini --}}
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-success border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success">
                    <i class="bx bx-money-withdraw" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Pendapatan Hari Ini</h6>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($pendapatanHariIni,0,',','.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Transaksi Hari Ini --}}
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-primary border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Transaksi Hari Ini</h6>
                    <h4 class="fw-bold mb-0">{{ $totalTransaksiHariIni }} Transaksi</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Produk & Jasa --}}
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-warning border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning">
                    <i class="bx bx-box" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Layanan &amp; Produk Aktif</h6>
                    <h4 class="fw-bold mb-0">{{ $totalProdukJasa }}</h4>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- LAUNDRY STATUS STATS ROW --}}
<div class="row">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm bg-label-secondary border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-secondary">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Laundry Diterima</h6>
                    <h4 class="mb-0 fw-bold">{{ $laundryDiterima }} Order</h4>
                    <small class="text-secondary">Menunggu antrean pencucian</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm bg-label-warning border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning">
                    <i class="bx bx-water" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Sedang Diproses</h6>
                    <h4 class="mb-0 fw-bold">{{ $laundryProses }} Order</h4>
                    <small class="text-warning">Proses pencucian / penyetrikaan</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 mb-3">
        <div class="card shadow-sm bg-label-info border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-info">
                    <i class="bx bx-check-circle" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Selesai Siap Diambil</h6>
                    <h4 class="mb-0 fw-bold">{{ $laundrySelesai }} Order</h4>
                    <small class="text-info">Menunggu diserahkan</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Stok Menipis --}}
    <div class="col-lg-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white fw-bold py-3 border-bottom">
                <i class="bx bx-error-alt me-1"></i> Stok Bahan Laundry Menipis
            </div>
            <ul class="list-group list-group-flush" style="max-height: 290px; overflow-y: auto;">
                @forelse($stokMenipis as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-semibold text-dark">{{ $item->nama_barang }}</span>
                        <span class="badge bg-danger">{{ $item->stok }} {{ $item->satuan ?? 'pcs' }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-center py-4 text-muted">
                        <i class="bx bx-check-shield text-success d-block mb-1" style="font-size: 2rem;"></i>
                        Semua stok bahan laundry aman
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Transaksi Terbaru (Kiri) --}}
    <div class="col-lg-8 mb-3">
        <div class="card shadow-sm">
            <div class="card-header fw-bold py-3 bg-white border-bottom">
                <i class="bx bx-history me-1"></i> Transaksi Laundry Terbaru
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Status Laundry</th>
                            <th>Pembayaran</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerbaru as $trx)
                        <tr>
                            <td class="fw-bold text-dark">{{ $trx->kode_transaksi }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                            <td>
                                <div class="fw-semibold">{{ $trx->nama_pembeli }}</div>
                                @if($trx->nomor_kamar)
                                    <small class="text-muted"><i class="bx bx-hotel"></i> Kamar: {{ $trx->nomor_kamar }}</small>
                                @endif
                            </td>
                            <td>
                                @php
                                    $lbls = ['diterima' => 'secondary', 'proses' => 'warning', 'selesai' => 'info', 'diambil' => 'success'];
                                    $lbl = $lbls[$trx->status_laundry] ?? 'secondary';
                                @endphp
                                <span class="badge bg-label-{{ $lbl }} text-uppercase">{{ $trx->status_laundry }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $trx->status_pembayaran === 'lunas' ? 'success' : 'danger' }}">{{ $trx->status_pembayaran === 'lunas' ? 'Lunas' : 'Belum Lunas' }}</span>
                            </td>
                            <td class="text-end fw-bold text-primary">Rp {{ number_format($trx->total,0,',','.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi laundry hari ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end bg-light">
                <a href="{{ route('operator.transaksi.index') }}" class="btn btn-primary btn-sm"><i class="bx bx-list-ul"></i> Lihat Semua Transaksi</a>
            </div>
        </div>
    </div>
</div>
@endsection
