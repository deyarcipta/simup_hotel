<?php $__env->startSection('title', 'Dashboard Operator Laundry'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-success border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success">
                    <i class="bx bx-money-withdraw" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Pendapatan Hari Ini</h6>
                    <h4 class="fw-bold mb-0">Rp <?php echo e(number_format($pendapatanHariIni,0,',','.')); ?></h4>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-primary border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Transaksi Hari Ini</h6>
                    <h4 class="fw-bold mb-0"><?php echo e($totalTransaksiHariIni); ?> Transaksi</h4>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm border-start border-warning border-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning">
                    <i class="bx bx-box" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Layanan &amp; Produk Aktif</h6>
                    <h4 class="fw-bold mb-0"><?php echo e($totalProdukJasa); ?></h4>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm bg-label-secondary border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-secondary">
                    <i class="bx bx-receipt" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Laundry Diterima</h6>
                    <h4 class="mb-0 fw-bold"><?php echo e($laundryDiterima); ?> Order</h4>
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
                    <h4 class="mb-0 fw-bold"><?php echo e($laundryProses); ?> Order</h4>
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
                    <h4 class="mb-0 fw-bold"><?php echo e($laundrySelesai); ?> Order</h4>
                    <small class="text-info">Menunggu diserahkan</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-lg-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white fw-bold py-3 border-bottom">
                <i class="bx bx-error-alt me-1"></i> Stok Bahan Laundry Menipis
            </div>
            <ul class="list-group list-group-flush" style="max-height: 290px; overflow-y: auto;">
                <?php $__empty_1 = true; $__currentLoopData = $stokMenipis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-semibold text-dark"><?php echo e($item->nama_barang); ?></span>
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
                        <?php $__empty_1 = true; $__currentLoopData = $transaksiTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-bold text-dark"><?php echo e($trx->kode_transaksi); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y')); ?></td>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi laundry hari ini</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end bg-light">
                <a href="<?php echo e(route('operator.transaksi.index')); ?>" class="btn btn-primary btn-sm"><i class="bx bx-list-ul"></i> Lihat Semua Transaksi</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('operator.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/operator/dashboard.blade.php ENDPATH**/ ?>