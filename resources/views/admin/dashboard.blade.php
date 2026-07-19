@extends('admin.layouts.app')

@section('title', 'Dashboard SIMUP Laundry')

@section('content')
<div class="row">

    {{-- Pendapatan Bulan Ini --}}
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-success border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success">
                    <i class="bx bx-money-withdraw" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Pendapatan Bulan Ini</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($pendapatanBulanIni,0,',','.') }}</h4>
                    <small class="text-success"><i class="bx bx-up-arrow-alt"></i> +{{ number_format($persentasePendapatan, 1) }}% dari bulan lalu</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengeluaran Bulan Ini --}}
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-danger border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-danger">
                    <i class="bx bx-credit-card" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Pengeluaran Bulan Ini</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($pengeluaranBulanIni,0,',','.') }}</h4>
                    <small class="text-danger"><i class="bx bx-down-arrow-alt"></i> {{ number_format($persentasePengeluaran, 1) }}% dari bulan lalu</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Laba / Rugi --}}
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-primary border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary">
                    <i class="bx bx-line-chart" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Laba / Rugi</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($labaRugi,0,',','.') }}</h4>
                    <small class="{{ $labaRugi >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $labaRugi >= 0 ? 'Laba' : 'Rugi' }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Transaksi --}}
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-warning border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Total Transaksi</h6>
                    <h4 class="mb-0 fw-bold">{{ $totalTransaksi }}</h4>
                    <small class="text-muted text-warning">Bulan ini</small>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- LAUNDRY STATUS STATS ROW --}}
<div class="row">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-secondary border-4" style="background-color: #f5f5f9;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-secondary">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Laundry Diterima</h6>
                    <h4 class="mb-0 fw-bold text-secondary">{{ $laundryDiterima }} Order</h4>
                    <small class="text-secondary">Menunggu antrean pencucian</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-warning border-4" style="background-color: #fffdf5;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning">
                    <i class="bx bx-water" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Sedang Diproses</h6>
                    <h4 class="mb-0 fw-bold text-warning">{{ $laundryProses }} Order</h4>
                    <small class="text-warning">Proses pencucian / penyetrikaan</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 mb-3">
        <div class="card shadow-sm border-start border-info border-4" style="background-color: #f5fcfd;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-info">
                    <i class="bx bx-check-circle" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Selesai Siap Diambil</h6>
                    <h4 class="mb-0 fw-bold text-info">{{ $laundrySelesai }} Order</h4>
                    <small class="text-info">Menunggu pengambilan pelanggan</small>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- LOGBOOK UP STATS ROW --}}
<div class="row">
    {{-- Omzet Logbook Bulan Ini --}}
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-info border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-info">
                    <i class="bx bx-book-content" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Omzet Logbook UP (Bulan Ini)</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($logbookPendapatanBulanIni,0,',','.') }}</h4>
                    <small class="text-info"><i class="bx bx-calendar"></i> Pencatatan Shift</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Uang Kas UP --}}
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-success border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success">
                    <i class="bx bx-wallet" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Kas Laci UP Terakhir</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($latestLogbookKas,0,',','.') }}</h4>
                    <small class="text-success"><i class="bx bx-lock-alt"></i> Saldo Kas Riil</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Kertas & Mesin --}}
    <div class="col-lg-4 col-md-12 mb-3">
        <div class="card shadow-sm border-start border-secondary border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-secondary">
                    <i class="bx bx-spray-can" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Stok Deterjen &amp; Pewangi</h6>
                    <h4 class="mb-0 fw-bold text-{{ $stokDetergenStatus === 'Aman' ? 'success' : 'danger' }}">{{ $stokDetergenStatus }}</h4>
                    <small class="text-secondary">Status Hari Terakhir</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Grafik Penjualan --}}
    <div class="col-lg-8 mb-3">
        <div class="card shadow">
            <div class="card-header bg-white py-3 fw-bold text-dark border-bottom">
                <i class="bx bx-line-chart me-1"></i> Grafik Penjualan Bulanan
            </div>
            <div class="card-body">
                <canvas id="grafikPenjualan" height="120"></canvas>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="col-lg-4 mb-3">
        <div class="card shadow">
            <div class="card-header bg-danger text-white py-3 fw-bold border-bottom">
                <i class="bx bx-error-alt me-1"></i> Stok Barang Laundry Menipis
            </div>
            <ul class="list-group list-group-flush" style="max-height: 290px; overflow-y: auto;">
                @forelse($stokMenipis as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-semibold text-dark">{{ $item->nama_barang }}</span>
                            <small class="d-block text-muted">Beli: Rp {{ number_format($item->harga_beli,0,',','.') }}</small>
                        </div>
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
</div>

<div class="row">
    {{-- Grafik Omzet Logbook UP --}}
    <div class="col-lg-12 mb-3">
        <div class="card shadow">
            <div class="card-header bg-white py-3 fw-bold text-dark border-bottom">
                <i class="bx bx-bar-chart-alt-2"></i> Grafik Pendapatan Omzet Logbook UP (6 Bulan Terakhir)
            </div>
            <div class="card-body">
                <canvas id="grafikLogbook" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Transaksi Terbaru --}}
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header bg-white py-3 fw-bold text-dark border-bottom">
                <i class="bx bx-history me-1"></i> 5 Transaksi Laundry Terbaru
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
                        @foreach($transaksiTerbaru as $trx)
                        <tr>
                            <td class="fw-bold text-dark">{{ $trx->kode_transaksi }}</td>
                            <td>{{ $trx->tanggal->format('d/m/Y') }}</td>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end bg-light">
                <a href="{{ route('transaksi.index') }}" class="btn btn-primary btn-sm"><i class="bx bx-list-ul"></i> Lihat Semua Transaksi</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('grafikPenjualan').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($bulanPenjualan) !!},
        datasets: [{
            label: 'Penjualan Laundry (Rp)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: '#36A2EB',
            tension: 0.15,
            fill: true,
            data: {!! json_encode($dataPenjualan) !!}
        }]
    }
});

var ctxLogbook = document.getElementById('grafikLogbook').getContext('2d');
var chartLogbook = new Chart(ctxLogbook, {
    type: 'bar',
    data: {
        labels: {!! json_encode($bulanPenjualan) !!},
        datasets: [{
            label: 'Omzet Logbook UP (Rp)',
            backgroundColor: 'rgba(40, 167, 69, 0.2)',
            borderColor: '#28a745',
            borderWidth: 2,
            data: {!! json_encode($dataLogbook) !!}
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endpush
