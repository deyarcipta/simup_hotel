<?php $__env->startSection('title', 'Laporan Sisa Hasil Usaha (SHU)'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">

        
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('laporan.shu')); ?>" class="row g-2 align-items-end">
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
                        <a href="<?php echo e(route('laporan.shu.download', ['start_date' => $startDate, 'end_date' => $endDate])); ?>"
                           class="btn btn-success w-100">
                            <i class="bx bx-download"></i> Download
                        </a>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Total Pemasukan:</strong> Rp <?php echo e(number_format($totalPemasukan, 0, ',', '.')); ?></p>
                <p><strong>Total Pengeluaran:</strong> Rp <?php echo e(number_format($totalPengeluaran, 0, ',', '.')); ?></p>
                <p><strong>Sisa Hasil Usaha (SHU):</strong> Rp <?php echo e(number_format($shu, 0, ',', '.')); ?></p>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Pembagian SHU</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Penerima</th>
                            <th class="text-center">Persentase</th>
                            <th class="text-end">Nominal (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalPersentase = collect($pembagian)->sum('persentase');
                            $totalNominal = collect($pembagian)->sum('nominal');
                        ?>
                        <?php $__currentLoopData = $pembagian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($row['penerima']); ?></td>
                                <td class="text-center"><?php echo e($row['persentase']); ?>%</td>
                                <td class="text-end"><?php echo e(number_format($row['nominal'], 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr class="fw-bold">
                            <td>Total</td>
                            <td class="text-center"><?php echo e($totalPersentase); ?>%</td>
                            <td class="text-end"><?php echo e(number_format($totalNominal, 0, ',', '.')); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/laporan/sisa_hasil_usaha.blade.php ENDPATH**/ ?>