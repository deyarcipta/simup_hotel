<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi #<?php echo e($transaksi->kode_transaksi); ?></title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11.5px;
            line-height: 1.3;
            width: 75mm; /* Cocok untuk printer termal 58mm atau 80mm */
            margin: 0 auto;
            padding: 8px;
            color: #000;
            background-color: #fff;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .header {
            margin-bottom: 8px;
        }
        .header-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
        .meta-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
        }
        .meta-table td {
            vertical-align: top;
            padding: 1px 0;
        }
        .items-table th {
            border-bottom: 1px dashed #000;
            text-align: left;
            font-weight: bold;
            padding-bottom: 3px;
        }
        .items-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .total-section {
            margin-top: 6px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
        }
        .footer {
            margin-top: 15px;
            font-size: 10px;
        }
        
        /* Menyembunyikan tombol print saat dicetak */
        @media print {
            .no-print {
                display: none;
            }
        }
        
        .no-print-btn {
            background-color: #5d5fef;
            color: white;
            border: none;
            padding: 6px 12px;
            font-family: sans-serif;
            font-size: 12px;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            width: 100%;
            max-width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Tombol Cetak Manual (Hanya muncul di layar) -->
    <div class="no-print">
        <button onclick="window.print()" class="no-print-btn">Cetak Nota</button>
    </div>

    <div class="header text-center">
        <?php if(!empty($pengaturan->logo)): ?>
            <div style="margin-bottom: 6px;">
                <img src="<?php echo e(asset('storage/' . $pengaturan->logo)); ?>" alt="Logo" style="max-height: 40px; width: auto; object-fit: contain;">
            </div>
        <?php endif; ?>
        <span class="header-title"><?php echo e($pengaturan->nama_aplikasi ?? 'SIMUP Laundry Hotel'); ?></span><br>
        <?php if(!empty($pengaturan->nama_sekolah)): ?>
            <span><?php echo e($pengaturan->nama_sekolah); ?></span><br>
        <?php endif; ?>
        <?php if(!empty($pengaturan->alamat)): ?>
            <span style="font-size: 10px;"><?php echo e($pengaturan->alamat); ?></span><br>
        <?php endif; ?>
        <?php if(!empty($pengaturan->telepon)): ?>
            <span>Telp: <?php echo e($pengaturan->telepon); ?></span><br>
        <?php endif; ?>
    </div>

    <div class="divider"></div>

    <!-- Metadata Transaksi -->
    <table class="meta-table">
        <tr>
            <td style="width: 35%;">No. Nota</td>
            <td style="width: 5%;">:</td>
            <td style="width: 60%;" class="bold"><?php echo e($transaksi->kode_transaksi); ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?php echo e($transaksi->created_at->format('d/m/Y H:i')); ?></td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>:</td>
            <td><?php echo e($transaksi->user->name ?? 'Operator'); ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>:</td>
            <td class="bold"><?php echo e($transaksi->nama_pembeli); ?> (<?php echo e(strtoupper($transaksi->jenis_pelanggan)); ?>)</td>
        </tr>
        <?php if($transaksi->jenis_pelanggan === 'tamu' && !empty($transaksi->nomor_kamar)): ?>
        <tr>
            <td>No. Kamar</td>
            <td>:</td>
            <td class="bold"><?php echo e($transaksi->nomor_kamar); ?></td>
        </tr>
        <?php endif; ?>
        <?php if(!empty($transaksi->nomor_wa)): ?>
        <tr>
            <td>No. WA</td>
            <td>:</td>
            <td><?php echo e($transaksi->nomor_wa); ?></td>
        </tr>
        <?php endif; ?>
        <?php if($transaksi->tanggal_selesai): ?>
        <tr>
            <td>Est. Selesai</td>
            <td>:</td>
            <td><?php echo e($transaksi->tanggal_selesai->format('d/m/Y H:i')); ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <div class="divider"></div>

    <!-- Rincian Item/Layanan -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%;">Layanan</th>
                <th style="width: 15%; text-align: center;">Qty</th>
                <th style="width: 35%; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transaksi->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <span><?php echo e($detail->produkJasa->nama); ?></span><br>
                        <span style="font-size: 10px; color: #555;"><?php echo e((float)$detail->jumlah); ?> x Rp <?php echo e(number_format($detail->harga, 0, ',', '.')); ?></span>
                    </td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo e((float)$detail->jumlah); ?></td>
                    <td style="text-align: right; vertical-align: middle;">Rp <?php echo e(number_format($detail->subtotal, 0, ',', '.')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="divider"></div>

    <!-- Ringkasan Total & Pembayaran -->
    <div class="total-section">
        <div class="total-row bold" style="font-size: 12px;">
            <span>TOTAL AKHIR:</span>
            <span>Rp <?php echo e(number_format($transaksi->total, 0, ',', '.')); ?></span>
        </div>
        <div class="total-row">
            <span>Status Pembayaran:</span>
            <span class="bold"><?php echo e($transaksi->status_pembayaran === 'lunas' ? 'LUNAS' : 'BELUM LUNAS'); ?></span>
        </div>
        <div class="total-row">
            <span>Status Laundry:</span>
            <span class="bold text-uppercase"><?php echo e($transaksi->status_laundry); ?></span>
        </div>
    </div>

    <div class="divider"></div>

    <div class="footer text-center">
        <span>Terima kasih atas kepercayaan Anda</span><br>
        <span>Layanan Laundry Berkualitas & Terpercaya</span>
        <div style="margin-top: 8px; font-size: 8px; font-style: italic; color: #555;">
            Sistem Laundry dibuat dan dikembangkan oleh Wistin Teknologi
        </div>
    </div>

    <script>
        // Otomatis trigger dialog cetak saat halaman dimuat
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\simup_hotel\resources\views/shared/transaksi/print.blade.php ENDPATH**/ ?>