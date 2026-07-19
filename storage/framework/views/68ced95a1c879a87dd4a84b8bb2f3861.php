<?php $__env->startSection('title', 'Rekap Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5>Rekap Transaksi</h5>

        <form method="GET" action="<?php echo e(route('transaksi.rekap')); ?>" class="row g-2 align-items-center">
            
            <div class="col-md-4">
                <input type="date" name="start_date" value="<?php echo e($startDate); ?>" class="form-control" required>
            </div>

            
            <div class="col-md-4">
                <input type="date" name="end_date" value="<?php echo e($endDate); ?>" class="form-control" required>
            </div>

            
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
            </div>

            
            <div class="col-md-2">
                <a href="<?php echo e(route('transaksi.rekap.download', ['start_date' => $startDate, 'end_date' => $endDate])); ?>" 
                   class="btn btn-success w-100">
                    <i class="bx bx-download"></i> Download
                </a>
            </div>
        </form>
    </div>

    <div class="card-body">
        <?php if(count($rekap) > 0): ?>
            <p><strong>Total Penjualan:</strong> Rp <?php echo e(number_format($rekap->sum('total'), 0, ',', '.')); ?></p>
            <p><strong>Jumlah Transaksi:</strong> <?php echo e($rekap->count()); ?></p>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pembeli</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php echo e($t->kode_transaksi); ?>

                                <div class="text-muted mt-1" style="font-size: 0.75rem; font-weight: normal;">
                                    <i class="bx bx-user text-primary" style="font-size: 0.85rem;"></i> Kasir: <strong><?php echo e($t->user->name ?? 'System'); ?></strong>
                                </div>
                            </td>
                            <td><?php echo e($t->tanggal->format('d-m-Y')); ?></td>
                            <td><?php echo e($t->nama_pembeli ?? '-'); ?></td>
                            <td>Rp <?php echo e(number_format($t->total, 0, ',', '.')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada transaksi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/transaksi/rekap.blade.php ENDPATH**/ ?>