<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Laporan Transaksi</h3>
    <p>Tanggal Cetak: <?php echo e(now()->format('d/m/Y H:i')); ?></p>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>Detail</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($trx->kode_transaksi); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y')); ?></td>
                    <td><?php echo e($trx->nama_pembeli ?? '-'); ?></td>
                    <td>
                        <?php $__currentLoopData = $trx->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($d->produkJasa->nama); ?> (<?php echo e($d->jumlah); ?> x Rp <?php echo e(number_format($d->harga, 0, ',', '.')); ?>)<br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>Rp <?php echo e(number_format($trx->total, 0, ',', '.')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/transaksi/transaksi_pdf.blade.php ENDPATH**/ ?>