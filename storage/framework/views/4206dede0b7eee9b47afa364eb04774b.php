<?php $__env->startSection('title', 'Buku Besar Keuangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('laporan.buku-besar')); ?>" class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="start_date" value="<?php echo e($startDate); ?>" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="<?php echo e($endDate); ?>" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo e(route('laporan.buku-besar.download', ['start_date' => $startDate, 'end_date' => $endDate])); ?>" class="btn btn-success w-100">
                            <i class="bx bx-download"></i> Download
                        </a>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Buku Besar Keuangan</h5>
            </div>
            <div class="card-body">
                
                <div class="mb-3">
                    <h6 class="fw-bold">Saldo Akhir: 
                        Rp <?php echo e(number_format($bukuBesar->last()['saldo'] ?? 0, 0, ',', '.')); ?>

                    </h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th class="text-end">Debit</th>
                                <th class="text-end">Kredit</th>
                                <th class="text-end">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $bukuBesar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($row['tanggal']); ?></td>
                                    <td><?php echo e($row['keterangan']); ?></td>
                                    <td class="text-end"><?php echo e($row['debit'] ? 'Rp ' . number_format($row['debit'], 0, ',', '.') : '-'); ?></td>
                                    <td class="text-end"><?php echo e($row['kredit'] ? 'Rp ' . number_format($row['kredit'], 0, ',', '.') : '-'); ?></td>
                                    <td class="text-end"><?php echo e('Rp ' . number_format($row['saldo'], 0, ',', '.')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            
                            <tr class="fw-bold">
                                <td colspan="4" class="text-end">Saldo Akhir</td>
                                <td class="text-end">
                                    Rp <?php echo e(number_format($bukuBesar->last()['saldo'] ?? 0, 0, ',', '.')); ?>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/laporan/buku_besar.blade.php ENDPATH**/ ?>