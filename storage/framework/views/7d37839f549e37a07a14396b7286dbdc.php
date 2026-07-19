<?php $__env->startSection('title', 'Dashboard SIMUP Laundry'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-success border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success">
                    <i class="bx bx-money-withdraw" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Pendapatan Bulan Ini</h6>
                    <h4 class="mb-0 fw-bold">Rp <?php echo e(number_format($pendapatanBulanIni,0,',','.')); ?></h4>
                    <small class="text-success"><i class="bx bx-up-arrow-alt"></i> +<?php echo e(number_format($persentasePendapatan, 1)); ?>% dari bulan lalu</small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-danger border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-danger">
                    <i class="bx bx-credit-card" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Pengeluaran Bulan Ini</h6>
                    <h4 class="mb-0 fw-bold">Rp <?php echo e(number_format($pengeluaranBulanIni,0,',','.')); ?></h4>
                    <small class="text-danger"><i class="bx bx-down-arrow-alt"></i> <?php echo e(number_format($persentasePengeluaran, 1)); ?>% dari bulan lalu</small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-primary border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary">
                    <i class="bx bx-line-chart" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Laba / Rugi</h6>
                    <h4 class="mb-0 fw-bold">Rp <?php echo e(number_format($labaRugi,0,',','.')); ?></h4>
                    <small class="<?php echo e($labaRugi >= 0 ? 'text-success' : 'text-danger'); ?>">
                        <?php echo e($labaRugi >= 0 ? 'Laba' : 'Rugi'); ?>

                    </small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-warning border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Total Transaksi</h6>
                    <h4 class="mb-0 fw-bold"><?php echo e($totalTransaksi); ?></h4>
                    <small class="text-muted text-warning">Bulan ini</small>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-secondary border-4" style="background-color: #f5f5f9;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-secondary">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Laundry Diterima</h6>
                    <h4 class="mb-0 fw-bold text-secondary"><?php echo e($laundryDiterima); ?> Order</h4>
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
                    <h4 class="mb-0 fw-bold text-warning"><?php echo e($laundryProses); ?> Order</h4>
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
                    <h4 class="mb-0 fw-bold text-info"><?php echo e($laundrySelesai); ?> Order</h4>
                    <small class="text-info">Menunggu pengambilan pelanggan</small>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-info border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-info">
                    <i class="bx bx-book-content" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Omzet Logbook UP (Bulan Ini)</h6>
                    <h4 class="mb-0 fw-bold">Rp <?php echo e(number_format($logbookPendapatanBulanIni,0,',','.')); ?></h4>
                    <small class="text-info"><i class="bx bx-calendar"></i> Pencatatan Shift</small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-success border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success">
                    <i class="bx bx-wallet" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Kas Laci UP Terakhir</h6>
                    <h4 class="mb-0 fw-bold">Rp <?php echo e(number_format($latestLogbookKas,0,',','.')); ?></h4>
                    <small class="text-success"><i class="bx bx-lock-alt"></i> Saldo Kas Riil</small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4 col-md-12 mb-3">
        <div class="card shadow-sm border-start border-secondary border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-secondary">
                    <i class="bx bx-spray-can" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Stok Deterjen &amp; Pewangi</h6>
                    <h4 class="mb-0 fw-bold text-<?php echo e($stokDetergenStatus === 'Aman' ? 'success' : 'danger'); ?>"><?php echo e($stokDetergenStatus); ?></h4>
                    <small class="text-secondary">Status Hari Terakhir</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    
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

    
    <div class="col-lg-4 mb-3">
        <div class="card shadow">
            <div class="card-header bg-danger text-white py-3 fw-bold border-bottom">
                <i class="bx bx-error-alt me-1"></i> Stok Barang Laundry Menipis
            </div>
            <ul class="list-group list-group-flush" style="max-height: 290px; overflow-y: auto;">
                <?php $__empty_1 = true; $__currentLoopData = $stokMenipis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-semibold text-dark"><?php echo e($item->nama_barang); ?></span>
                            <small class="d-block text-muted">Beli: Rp <?php echo e(number_format($item->harga_beli,0,',','.')); ?></small>
                        </div>
                        <span class="badge bg-danger"><?php echo e($item->stok); ?> <?php echo e($item->satuan ?? 'pcs'); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-center py-4 text-muted">
                        <i class="bx bx-check-shield text-success d-block mb-1" style="font-size: 2rem;"></i>
                        Semua stok bahan laundry aman
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    
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
                        <?php $__currentLoopData = $transaksiTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="fw-bold text-dark"><?php echo e($trx->kode_transaksi); ?></td>
                            <td><?php echo e($trx->tanggal->format('d/m/Y')); ?></td>
                            <td>
                                <div class="fw-semibold"><?php echo e($trx->nama_pembeli); ?></div>
                                <?php if($trx->nomor_kamar): ?>
                                    <small class="text-muted"><i class="bx bx-hotel"></i> Kamar: <?php echo e($trx->nomor_kamar); ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $lbls = ['diterima' => 'secondary', 'proses' => 'warning', 'selesai' => 'info', 'diambil' => 'success'];
                                    $lbl = $lbls[$trx->status_laundry] ?? 'secondary';
                                ?>
                                <span class="badge bg-label-<?php echo e($lbl); ?> text-uppercase"><?php echo e($trx->status_laundry); ?></span>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($trx->status_pembayaran === 'lunas' ? 'success' : 'danger'); ?>"><?php echo e($trx->status_pembayaran === 'lunas' ? 'Lunas' : 'Belum Lunas'); ?></span>
                            </td>
                            <td class="text-end fw-bold text-primary">Rp <?php echo e(number_format($trx->total,0,',','.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end bg-light">
                <a href="<?php echo e(route('transaksi.index')); ?>" class="btn btn-primary btn-sm"><i class="bx bx-list-ul"></i> Lihat Semua Transaksi</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('grafikPenjualan').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($bulanPenjualan); ?>,
        datasets: [{
            label: 'Penjualan Laundry (Rp)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: '#36A2EB',
            tension: 0.15,
            fill: true,
            data: <?php echo json_encode($dataPenjualan); ?>

        }]
    }
});

var ctxLogbook = document.getElementById('grafikLogbook').getContext('2d');
var chartLogbook = new Chart(ctxLogbook, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($bulanPenjualan); ?>,
        datasets: [{
            label: 'Omzet Logbook UP (Rp)',
            backgroundColor: 'rgba(40, 167, 69, 0.2)',
            borderColor: '#28a745',
            borderWidth: 2,
            data: <?php echo json_encode($dataLogbook); ?>

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>