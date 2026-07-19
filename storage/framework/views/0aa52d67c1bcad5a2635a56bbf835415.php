<?php $__env->startSection('title', 'Produk & Jasa'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Daftar Produk & Jasa</h5>
                
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success mb-3">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Stok/Jumlah</th>
                                <th>Satuan</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $produkJasa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->nama); ?></td>
                                    <td><span class="badge bg-label-info"><?php echo e(ucfirst($item->jenis)); ?></span></td>
                                    <td>Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                                    <td>
                                        <?php if($item->jenis === 'produk'): ?>
                                            <?php echo e($item->stokBarang->stok ?? '-'); ?>

                                        <?php else: ?>
                                            <?php echo e($item->jumlah ?? '-'); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->satuan ?? '-'); ?></td>
                                    
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data</td>
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

<?php echo $__env->make('operator.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/operator/produk_jasa/index.blade.php ENDPATH**/ ?>