
<div class="mb-3">
    <label class="form-label">Jenis</label>
    <select name="jenis" id="jenis" class="form-control" required>
        <option value="">-- Pilih Jenis --</option>
        <option value="produk">Produk</option>
        <option value="jasa">Jasa</option>
    </select>
</div>


<div id="form-produk" style="display:none;">
    <div class="mb-3">
        <label class="form-label">Hubungkan ke Stok Barang</label>
        <select name="stok_barang_id" id="stok_barang_id" class="form-control">
            <option value="">-- Pilih Stok Barang --</option>
            <?php $__currentLoopData = \App\Models\StokBarang::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($stok->id); ?>">
                    <?php echo e($stok->nama_barang); ?> (Stok: <?php echo e($stok->stok); ?> <?php echo e($stok->satuan); ?>)
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    

    
</div>


<div id="form-jasa" style="display:none;">
    <div class="mb-3">
        <label class="form-label">Nama Jasa</label>
        <input type="text" name="nama_jasa" id="nama_jasa" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga_jasa" id="harga_jasa" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah_jasa" id="jumlah_jasa" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Satuan</label>
        <input type="text" name="satuan_jasa" id="satuan_jasa" class="form-control">
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisSelect = document.getElementById('jenis');
    const formProduk = document.getElementById('form-produk');
    const formJasa = document.getElementById('form-jasa');
    const stokBarangSelect = document.getElementById('stok_barang_id');

    function toggleForms() {
        if (jenisSelect.value === 'produk') {
            formProduk.style.display = 'block';
            formJasa.style.display = 'none';

            // Produk wajib
            document.getElementById('stok_barang_id').setAttribute('required', true);
            document.getElementById('harga_produk').setAttribute('required', true);

            // Jasa tidak wajib
            document.getElementById('nama_jasa').removeAttribute('required');
            document.getElementById('harga_jasa').removeAttribute('required');

        } else if (jenisSelect.value === 'jasa') {
            formProduk.style.display = 'none';
            formJasa.style.display = 'block';

            // Produk tidak wajib
            document.getElementById('stok_barang_id').removeAttribute('required');
            document.getElementById('harga_produk').removeAttribute('required');

            // Jasa wajib
            document.getElementById('nama_jasa').setAttribute('required', true);
            document.getElementById('harga_jasa').setAttribute('required', true);
        } else {
            formProduk.style.display = 'none';
            formJasa.style.display = 'none';
        }
    }

    // Auto-fill produk dari stok barang
    stokBarangSelect.addEventListener('change', function () {
        const stokId = this.value;
        if (stokId) {
            fetch(`/get-stok-barang/${stokId}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('harga_produk').value = data.harga_jual ?? '';
                    document.getElementById('stok').value = data.stok ?? '';
                    document.getElementById('satuan').value = data.satuan ?? '';
                });
        }
    });

    // Jalankan toggle saat jenis berubah
    jenisSelect.addEventListener('change', toggleForms);

    // Jalankan toggle saat halaman load (misal saat edit data)
    toggleForms();
});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/produk_jasa/partials/form.blade.php ENDPATH**/ ?>