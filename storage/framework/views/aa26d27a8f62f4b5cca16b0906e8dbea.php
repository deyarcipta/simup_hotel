<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 6px;
        }
        th {
            background-color: #f2f2f2;
        }
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h3>Rekap Transaksi</h3>
    <p>Periode: <?php echo e($startDate); ?> s/d <?php echo e($endDate); ?></p>
    <p>Tanggal Cetak: <?php echo e($tanggalCetak); ?></p>

    <table>
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Tanggal</th>
                <th>Nama Pembeli</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php echo e($t->kode_transaksi); ?><br>
                        <small style="color: #666; font-size: 10px;">Kasir: <?php echo e($t->user->name ?? 'System'); ?></small>
                    </td>
                    <td><?php echo e(\Carbon\Carbon::parse($t->tanggal)->format('d-m-Y')); ?></td>
                    <td><?php echo e($t->nama_pembeli ?? '-'); ?></td>
                    <td>Rp <?php echo e(number_format($t->total, 0, ',', '.')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <p><strong>Total Penjualan:</strong> Rp <?php echo e(number_format($rekap->sum('total'), 0, ',', '.')); ?></p>
    <p><strong>Jumlah Transaksi:</strong> <?php echo e($rekap->count()); ?></p>
</body>
</html>
<?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/transaksi/rekap_transaksi_pdf.blade.php ENDPATH**/ ?>