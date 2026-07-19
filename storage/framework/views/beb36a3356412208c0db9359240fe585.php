<?php $__env->startSection('title', 'Stok Barang'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Daftar Stok Barang</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
                    <i class="bx bx-plus"></i> Tambah Stok
                </button>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $stokBarang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->nama_barang); ?></td>
                                    <td><?php echo e($item->satuan ?? '-'); ?></td>
                                    <td><?php echo e($item->stok); ?></td>
                                    <td>Rp <?php echo e(number_format($item->harga_beli,0,',','.')); ?></td>
                                    <td>Rp <?php echo e(number_format($item->harga_jual,0,',','.')); ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm btnEdit" data-id="<?php echo e($item->id); ?>">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <form action="<?php echo e(route('stok-barang.destroy', $item->id)); ?>" method="POST" style="display:inline-block;">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
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


<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('stok-barang.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Stok Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('admin.stok_barang.partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEdit" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Stok Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('admin.stok_barang.partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btnEdit').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`<?php echo e(url('admin/stok-barang/data')); ?>/${id}`)
                .then(res => res.json())
                .then(data => {
                    const formEdit = document.getElementById('formEdit');
                    formEdit.querySelector('input[name="nama_barang"]').value = data.nama_barang;
                    formEdit.querySelector('input[name="satuan"]').value = data.satuan ?? '';
                    formEdit.querySelector('input[name="stok"]').value = data.stok;
                    formEdit.querySelector('input[name="harga_beli"]').value = data.harga_beli ?? '';
                    formEdit.querySelector('input[name="harga_jual"]').value = data.harga_jual ?? '';
                    formEdit.setAttribute('action', `<?php echo e(url('admin/stok-barang')); ?>/${id}`);
                    new bootstrap.Modal(document.getElementById('modalEdit')).show();
                });
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/stok_barang/index.blade.php ENDPATH**/ ?>