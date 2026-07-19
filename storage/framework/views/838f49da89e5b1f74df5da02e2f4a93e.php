<?php $__env->startSection('title', 'Detail Logbook UP'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12 mb-3">
        <a href="<?php echo e(route('admin.logbook.index')); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bx bx-chevron-left"></i> Kembali ke Daftar
        </a>
    </div>

    
    <div class="col-12 col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title text-white mb-0"><i class="bx bx-calendar"></i> Ringkasan Harian</h5>
                <small class="text-white-50"><?php echo e($logbook->tanggal->format('d F Y')); ?></small>
            </div>
            <div class="card-body pt-4">
                <div class="mb-3">
                    <label class="text-muted d-block" style="font-size: 0.85rem;">Status Operasional:</label>
                    <?php if($logbook->status === 'aktif'): ?>
                        <span class="badge bg-warning text-dark"><i class="bx bx-sun"></i> Shift 1 Aktif</span>
                    <?php elseif($logbook->status === 'shift_1_selesai'): ?>
                        <span class="badge bg-info"><i class="bx bx-cloud-light-rain"></i> Shift 2 Aktif</span>
                    <?php elseif($logbook->status === 'shift_2_selesai'): ?>
                        <span class="badge bg-dark text-white"><i class="bx bx-moon"></i> Shift 3 Aktif</span>
                    <?php else: ?>
                        <span class="badge bg-success"><i class="bx bx-check-double"></i> Tutup UP</span>
                    <?php endif; ?>
                </div>

                <div class="mb-3 border-top pt-2">
                    <label class="text-muted d-block" style="font-size: 0.85rem;">Uang Kas Awal:</label>
                    <span class="fw-bold text-dark h5">Rp <?php echo e(number_format($logbook->kas_awal, 0, ',', '.')); ?></span>
                </div>

                <div class="mb-3 border-top pt-2">
                    <label class="text-muted d-block" style="font-size: 0.85rem;">Uang Kas Akhir Fisik:</label>
                    <span class="fw-bold text-success h5"><?php echo e($logbook->kas_akhir ? 'Rp ' . number_format($logbook->kas_akhir, 0, ',', '.') : 'Belum Ditutup'); ?></span>
                </div>

                <?php
                    $jumlahShiftSetting = \App\Models\Pengaturan::first()->jumlah_shift ?? 2;
                    $s1 = $logbook->details->where('shift_id', 1)->first();
                    $s2 = $logbook->details->where('shift_id', 2)->first();
                    $s3 = $logbook->details->where('shift_id', 3)->first();
                    $totalOmzet = ($s1?->total_uang ?? 0);
                    if ($jumlahShiftSetting >= 2) {
                        $totalOmzet += ($s2?->total_uang ?? 0);
                    }
                    if ($jumlahShiftSetting == 3) {
                        $totalOmzet += ($s3?->total_uang ?? 0);
                    }
                    $expectedCash = $logbook->kas_awal + $totalOmzet;
                    $diff = $logbook->kas_akhir ? ($logbook->kas_akhir - $expectedCash) : 0;
                ?>

                <div class="mb-3 border-top pt-2">
                    <label class="text-muted d-block" style="font-size: 0.85rem;">Uang Kas Diharapkan (Sistem):</label>
                    <span class="fw-bold text-dark" style="font-size: 1rem;">Rp <?php echo e(number_format($expectedCash, 0, ',', '.')); ?></span>
                </div>

                <?php if($logbook->status === 'tutup_up'): ?>
                    <div class="mb-3 border-top pt-2">
                        <label class="text-muted d-block" style="font-size: 0.85rem;">Selisih Kas Laci:</label>
                        <?php if($diff == 0): ?>
                            <span class="badge bg-label-success fw-bold"><i class="bx bx-check"></i> Cocok (Pas)</span>
                        <?php elseif($diff > 0): ?>
                            <span class="badge bg-label-success fw-bold"><i class="bx bx-plus"></i> Lebih (+ Rp <?php echo e(number_format($diff, 0, ',', '.')); ?>)</span>
                        <?php else: ?>
                            <span class="badge bg-label-danger fw-bold"><i class="bx bx-minus"></i> Kurang (- Rp <?php echo e(number_format(abs($diff), 0, ',', '.')); ?>)</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3 border-top pt-2">
                    <label class="text-muted d-block" style="font-size: 0.85rem;">Stok Detergen &amp; Pewangi:</label>
                    <span class="badge <?php echo e($logbook->stok_detergen === 'Aman' ? 'bg-label-success' : 'bg-label-danger'); ?>"><?php echo e($logbook->stok_detergen ?? '-'); ?></span>
                </div>

                <div class="mb-0 border-top pt-2">
                    <label class="text-muted d-block" style="font-size: 0.85rem;">Kondisi Mesin Laundry:</label>
                    <span class="text-dark italic fw-semibold">"<?php echo e($logbook->status_mesin ?? '-'); ?>"</span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-12 col-md-8 mb-4">
        <div class="row g-4">
            
            
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bx bx-sun text-warning me-1"></i> Shift 1 (Pagi)</h6>
                        <?php if($s1): ?>
                            <span class="badge bg-label-warning text-dark">Petugas: <?php echo e($s1->user->name ?? '-'); ?></span>
                        <?php else: ?>
                            <span class="badge bg-label-secondary">Belum Diisi</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body py-3">
                        <?php if($s1): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Layanan Laundry</th>
                                            <th class="text-center">Kuantitas</th>
                                            <th class="text-end">Tarif Riwayat</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $s1Items = DB::table('transaksi_detail')
                                            ->join('transaksi', 'transaksi_detail.transaksi_id', '=', 'transaksi.id')
                                            ->join('produk_jasa', 'transaksi_detail.produk_jasa_id', '=', 'produk_jasa.id')
                                            ->whereBetween('transaksi.created_at', [$logbook->created_at, $s1->created_at])
                                            ->select(
                                                'produk_jasa.nama as produk_nama',
                                                'transaksi_detail.harga as unit_harga',
                                                DB::raw('SUM(transaksi_detail.jumlah) as total_qty'),
                                                DB::raw('SUM(transaksi_detail.subtotal) as total_subtotal')
                                            )
                                            ->groupBy('transaksi_detail.produk_jasa_id', 'produk_jasa.nama', 'transaksi_detail.harga')
                                            ->get();
                                    ?>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $s1Items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($item->produk_nama); ?></td>
                                                <td class="text-center fw-bold">
                                                    <?php echo e((float)$item->total_qty); ?> 
                                                    <?php echo e(stripos($item->produk_nama, 'KILOAN') !== false ? 'Kg' : 'Pcs'); ?>

                                                </td>
                                                <td class="text-end">Rp <?php echo e(number_format($item->unit_harga, 0, ',', '.')); ?></td>
                                                <td class="text-end fw-bold">Rp <?php echo e(number_format($item->total_subtotal, 0, ',', '.')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted italic py-3">Tidak ada transaksi pada shift ini.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-light">
                                            <th colspan="3" class="text-end">Total Pendapatan Shift 1:</th>
                                            <th class="text-end text-primary h6 fw-bold">Rp <?php echo e(number_format($s1->total_uang, 0, ',', '.')); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted text-center my-3">Data untuk Shift 1 Pagi belum dimasukkan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <?php if($jumlahShiftSetting >= 2): ?>
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bx bx-cloud-light-rain text-info me-1"></i> Shift 2 (Siang)</h6>
                        <?php if($s2): ?>
                            <span class="badge bg-label-info">Petugas: <?php echo e($s2->user->name ?? '-'); ?></span>
                        <?php else: ?>
                            <span class="badge bg-label-secondary">Belum Diisi</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body py-3">
                        <?php if($s2): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Layanan Laundry</th>
                                            <th class="text-center">Kuantitas</th>
                                            <th class="text-end">Tarif Riwayat</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $s2Items = DB::table('transaksi_detail')
                                            ->join('transaksi', 'transaksi_detail.transaksi_id', '=', 'transaksi.id')
                                            ->join('produk_jasa', 'transaksi_detail.produk_jasa_id', '=', 'produk_jasa.id')
                                            ->whereBetween('transaksi.created_at', [$s1->created_at, $s2->created_at])
                                            ->select(
                                                'produk_jasa.nama as produk_nama',
                                                'transaksi_detail.harga as unit_harga',
                                                DB::raw('SUM(transaksi_detail.jumlah) as total_qty'),
                                                DB::raw('SUM(transaksi_detail.subtotal) as total_subtotal')
                                            )
                                            ->groupBy('transaksi_detail.produk_jasa_id', 'produk_jasa.nama', 'transaksi_detail.harga')
                                            ->get();
                                    ?>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $s2Items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($item->produk_nama); ?></td>
                                                <td class="text-center fw-bold">
                                                    <?php echo e((float)$item->total_qty); ?> 
                                                    <?php echo e(stripos($item->produk_nama, 'KILOAN') !== false ? 'Kg' : 'Pcs'); ?>

                                                </td>
                                                <td class="text-end">Rp <?php echo e(number_format($item->unit_harga, 0, ',', '.')); ?></td>
                                                <td class="text-end fw-bold">Rp <?php echo e(number_format($item->total_subtotal, 0, ',', '.')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted italic py-3">Tidak ada transaksi pada shift ini.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-light">
                                            <th colspan="3" class="text-end">Total Pendapatan Shift 2:</th>
                                            <th class="text-end text-primary h6 fw-bold">Rp <?php echo e(number_format($s2->total_uang, 0, ',', '.')); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted text-center my-3">Data untuk Shift 2 Siang belum dimasukkan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($jumlahShiftSetting == 3): ?>
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bx bx-moon text-dark me-1"></i> Shift 3 (Malam)</h6>
                        <?php if($s3): ?>
                            <span class="badge bg-label-dark">Petugas: <?php echo e($s3->user->name ?? '-'); ?></span>
                        <?php else: ?>
                            <span class="badge bg-label-secondary">Belum Diisi</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body py-3">
                        <?php if($s3): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Layanan Laundry</th>
                                            <th class="text-center">Kuantitas</th>
                                            <th class="text-end">Tarif Riwayat</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $s3Items = DB::table('transaksi_detail')
                                            ->join('transaksi', 'transaksi_detail.transaksi_id', '=', 'transaksi.id')
                                            ->join('produk_jasa', 'transaksi_detail.produk_jasa_id', '=', 'produk_jasa.id')
                                            ->whereBetween('transaksi.created_at', [$s2->created_at, $s3->created_at])
                                            ->select(
                                                'produk_jasa.nama as produk_nama',
                                                'transaksi_detail.harga as unit_harga',
                                                DB::raw('SUM(transaksi_detail.jumlah) as total_qty'),
                                                DB::raw('SUM(transaksi_detail.subtotal) as total_subtotal')
                                            )
                                            ->groupBy('transaksi_detail.produk_jasa_id', 'produk_jasa.nama', 'transaksi_detail.harga')
                                            ->get();
                                    ?>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $s3Items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($item->produk_nama); ?></td>
                                                <td class="text-center fw-bold">
                                                    <?php echo e((float)$item->total_qty); ?> 
                                                    <?php echo e(stripos($item->produk_nama, 'KILOAN') !== false ? 'Kg' : 'Pcs'); ?>

                                                </td>
                                                <td class="text-end">Rp <?php echo e(number_format($item->unit_harga, 0, ',', '.')); ?></td>
                                                <td class="text-end fw-bold">Rp <?php echo e(number_format($item->total_subtotal, 0, ',', '.')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted italic py-3">Tidak ada transaksi pada shift ini.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-light">
                                            <th colspan="3" class="text-end">Total Pendapatan Shift 3:</th>
                                            <th class="text-end text-primary h6 fw-bold">Rp <?php echo e(number_format($s3->total_uang, 0, ',', '.')); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted text-center my-3">Data untuk Shift 3 Malam belum dimasukkan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/logbook/show.blade.php ENDPATH**/ ?>