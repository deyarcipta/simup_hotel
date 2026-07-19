<?php $__env->startSection('title', 'Riwayat Logbook Unit Produksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-12 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h5 class="text-white-50 mb-1">Total Omzet Logbook UP</h5>
                    <h2 class="text-white mb-0 fw-bold">Rp <?php echo e(number_format($totalOmzet, 0, ',', '.')); ?></h2>
                    <p class="mb-0 mt-1 text-white-50" style="font-size: 0.85rem;">
                        Periode: <strong><?php echo e(\Carbon\Carbon::create()->month($bulan)->translatedFormat('F')); ?> <?php echo e($tahun); ?></strong>
                    </p>
                </div>
                <div class="d-none d-md-block" style="font-size: 4rem; opacity: 0.25;">
                    <i class="bx bx-wallet"></i>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header pb-2 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <h5 class="mb-0 fw-bold text-dark"><i class="bx bx-list-ul me-1"></i> Logbook Harian UP</h5>
                
                
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <form method="GET" action="<?php echo e(route('admin.logbook.index')); ?>" class="d-flex gap-2 align-items-center">
                        <select name="bulan" class="form-select form-select-sm" onchange="this.form.submit()">
                            <?php for($m = 1; $m <= 12; $m++): ?>
                                <option value="<?php echo e($m); ?>" <?php echo e($bulan == $m ? 'selected' : ''); ?>>
                                    <?php echo e(\Carbon\Carbon::create()->month($m)->translatedFormat('F')); ?>

                                </option>
                            <?php endfor; ?>
                        </select>
                        <select name="tahun" class="form-select form-select-sm" onchange="this.form.submit()">
                            <?php $__currentLoopData = $listTahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t); ?>" <?php echo e($tahun == $t ? 'selected' : ''); ?>><?php echo e($t); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>

                    <div class="d-flex gap-1">
                        <a href="<?php echo e(route('admin.logbook.download-pdf', ['bulan' => $bulan, 'tahun' => $tahun])); ?>" class="btn btn-sm btn-danger shadow-sm">
                            <i class="bx bxs-file-pdf me-1"></i> PDF
                        </a>
                        <a href="<?php echo e(route('admin.logbook.download-excel', ['bulan' => $bulan, 'tahun' => $tahun])); ?>" class="btn btn-sm btn-success shadow-sm">
                            <i class="bx bxs-spreadsheet me-1"></i> Excel/CSV
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <?php
                                $jumlahShiftSetting = \App\Models\Pengaturan::first()->jumlah_shift ?? 2;
                            ?>
                            <tr>
                                <th>Tanggal</th>
                                <th>Status Hari</th>
                                <th>Kas Awal</th>
                                <th>Kas Akhir</th>
                                <th>Omzet Shift 1</th>
                                <?php if($jumlahShiftSetting >= 2): ?>
                                    <th>Omzet Shift 2</th>
                                <?php endif; ?>
                                <?php if($jumlahShiftSetting == 3): ?>
                                    <th>Omzet Shift 3</th>
                                <?php endif; ?>
                                <th>Total Omzet</th>
                                <th>Detergen</th>
                                <th>Mesin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $s1 = $logbook->details->where('shift_id', 1)->first();
                                $s2 = $logbook->details->where('shift_id', 2)->first();
                                $s3 = $logbook->details->where('shift_id', 3)->first();
                                $totalHarian = ($s1?->total_uang ?? 0);
                                if ($jumlahShiftSetting >= 2) {
                                    $totalHarian += ($s2?->total_uang ?? 0);
                                }
                                if ($jumlahShiftSetting == 3) {
                                    $totalHarian += ($s3?->total_uang ?? 0);
                                }
                            ?>
                            <tr>
                                <td class="fw-semibold text-dark"><?php echo e($logbook->tanggal->format('d/m/Y')); ?></td>
                                <td>
                                    <?php if($logbook->status === 'aktif'): ?>
                                        <span class="badge bg-warning text-dark"><i class="bx bx-sun"></i> Shift 1 Aktif</span>
                                    <?php elseif($logbook->status === 'shift_1_selesai'): ?>
                                        <span class="badge bg-info"><i class="bx bx-cloud-light-rain"></i> Shift 2 Aktif</span>
                                    <?php elseif($logbook->status === 'shift_2_selesai'): ?>
                                        <span class="badge bg-dark text-white"><i class="bx bx-moon"></i> Shift 3 Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-success"><i class="bx bx-check-double"></i> Tutup UP</span>
                                    <?php endif; ?>
                                </td>
                                <td>Rp <?php echo e(number_format($logbook->kas_awal, 0, ',', '.')); ?></td>
                                <td><?php echo e($logbook->kas_akhir ? 'Rp ' . number_format($logbook->kas_akhir, 0, ',', '.') : '-'); ?></td>
                                <td>Rp <?php echo e(number_format($s1?->total_uang ?? 0, 0, ',', '.')); ?></td>
                                <?php if($jumlahShiftSetting >= 2): ?>
                                    <td>Rp <?php echo e(number_format($s2?->total_uang ?? 0, 0, ',', '.')); ?></td>
                                <?php endif; ?>
                                <?php if($jumlahShiftSetting == 3): ?>
                                    <td>Rp <?php echo e(number_format($s3?->total_uang ?? 0, 0, ',', '.')); ?></td>
                                <?php endif; ?>
                                <td class="fw-bold text-primary">Rp <?php echo e(number_format($totalHarian, 0, ',', '.')); ?></td>
                                <td>
                                    <?php if($logbook->stok_detergen === 'Aman'): ?>
                                        <span class="badge bg-label-success">Aman</span>
                                    <?php elseif($logbook->stok_detergen === 'Habis'): ?>
                                        <span class="badge bg-label-danger">Habis</span>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 100px;" title="<?php echo e($logbook->status_mesin ?? '-'); ?>">
                                        <?php echo e($logbook->status_mesin ?? '-'); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.logbook.show', $logbook->id)); ?>" class="btn btn-xs btn-outline-primary">
                                        <i class="bx bx-show me-1"></i> Rincian
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="<?php echo e(8 + ($jumlahShiftSetting >= 2 ? 1 : 0) + ($jumlahShiftSetting == 3 ? 1 : 0)); ?>" class="text-center py-4 text-muted">
                                    <i class="bx bx-calendar-x mb-2" style="font-size: 2.5rem;"></i>
                                    <p class="mb-0">Tidak ada riwayat logbook pada periode ini.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/logbook/index.blade.php ENDPATH**/ ?>