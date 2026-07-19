<?php $__env->startSection('title', 'Kasir Laundry & Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<?php if(!$hasStartedLogbook): ?>
<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 text-center py-5">
            <div class="card-body">
                <div class="mb-4">
                    <i class="bx bx-lock-alt text-warning animate-bounce" style="font-size: 5rem;"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2">Hari Operasional Belum Dimulai!</h3>
                <p class="text-muted mx-auto" style="max-width: 500px;">
                    Maaf, operator tidak dapat menambahkan transaksi sebelum memulai logbook harian terlebih dahulu. Silakan masuk ke menu "Logbook Hari Ini" untuk memulai shift.
                </p>
                <div class="mt-4">
                    <a href="<?php echo e(route('operator.logbook.index')); ?>" class="btn btn-warning text-dark fw-bold btn-lg shadow-sm">
                        <i class="bx bx-book-open me-1"></i> Buka Menu Logbook Hari Ini
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="row">
    <div class="col-12">
        
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-kasir-tab" data-bs-toggle="pill" data-bs-target="#pills-kasir" type="button" role="tab" aria-controls="pills-kasir" aria-selected="true">
                    <i class="bx bx-calculator me-1"></i> Mesin Kasir POS
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-riwayat-tab" data-bs-toggle="pill" data-bs-target="#pills-riwayat" type="button" role="tab" aria-controls="pills-riwayat" aria-selected="false">
                    <i class="bx bx-history me-1"></i> Pelacakan Cucian (Riwayat)
                </button>
            </li>
        </ul>

        <div class="tab-content p-0" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-kasir" role="tabpanel" aria-labelledby="pills-kasir-tab">
                <div class="row">
                    
                    <div class="col-lg-8 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-header pb-2 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                                <h5 class="card-title mb-0">Etalase Layanan & Produk Laundry</h5>
                                <div class="d-flex gap-2 w-100 w-sm-auto">
                                    <input type="text" id="search-etalase" class="form-control form-control-sm" placeholder="Cari layanan...">
                                </div>
                            </div>
                            
                            
                            <div class="px-4 pb-3">
                                <div class="d-flex gap-2 flex-wrap">
                                    <button class="btn btn-xs btn-outline-primary active filter-btn" data-filter="semua">Semua</button>
                                    <button class="btn btn-xs btn-outline-primary filter-btn" data-filter="jasa">Jasa Laundry</button>
                                    <button class="btn btn-xs btn-outline-primary filter-btn" data-filter="produk">Produk Toko</button>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 etalase-grid" style="max-height: 580px; overflow-y: auto; padding: 5px;">
                                    <?php $__currentLoopData = $produkJasa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $stok = $item->jenis === 'produk' ? ($item->stokBarang?->stok ?? 0) : null;
                                            $isOutOfStock = $item->jenis === 'produk' && $stok <= 0;
                                        ?>
                                        <div class="col etalase-item" 
                                             data-id="<?php echo e($item->id); ?>" 
                                             data-nama="<?php echo e($item->nama); ?>" 
                                             data-harga="<?php echo e($item->harga); ?>" 
                                             data-jenis="<?php echo e($item->jenis); ?>"
                                             data-stok="<?php echo e($stok ?? 99999); ?>">
                                             <div class="card h-100 border rounded-3 p-3 text-center position-relative etalase-card shadow-sm cursor-pointer <?php echo e($isOutOfStock ? 'opacity-50 bg-light' : ''); ?>" 
                                                 style="transition: all 0.2s;"
                                                 onclick="<?php echo e(!$isOutOfStock ? 'addToCart('.$item->id.')' : ''); ?>">
                                                
                                                
                                                <span class="badge position-absolute top-0 start-50 translate-middle-y <?php echo e($item->jenis === 'jasa' ? 'bg-info' : 'bg-success'); ?>" style="font-size: 0.7rem;">
                                                    <?php echo e($item->jenis === 'jasa' ? 'Layanan Jasa' : 'Produk'); ?>

                                                </span>
                                                
                                                <div class="mt-2 mb-1 fw-bold text-dark" title="<?php echo e($item->nama); ?>" style="font-size: 0.9rem; line-height: 1.2; min-height: 2.4em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                    <?php echo e($item->nama); ?>

                                                </div>
                                                
                                                <div class="text-primary fw-semibold mb-2" style="font-size: 0.9rem;">
                                                    Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?><?php if($item->jenis === 'jasa' && str_contains(strtolower($item->nama), 'kiloan')): ?>/kg <?php endif; ?>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                                    <?php if($item->jenis === 'produk'): ?>
                                                        <small class="text-muted" style="font-size: 0.75rem;">
                                                            Stok: <span class="fw-bold text-<?php echo e($isOutOfStock ? 'danger' : 'success'); ?>"><?php echo e($stok); ?> <?php echo e($item->satuan ?? 'pcs'); ?></span>
                                                        </small>
                                                    <?php else: ?>
                                                        <small class="text-muted" style="font-size: 0.75rem;">
                                                            Layanan Laundry
                                                        </small>
                                                    <?php endif; ?>
                                                    
                                                    <?php if($isOutOfStock): ?>
                                                        <button class="btn btn-xs btn-secondary" disabled>Habis</button>
                                                    <?php else: ?>
                                                        <button class="btn btn-xs btn-primary"><i class="bx bx-plus"></i></button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                            <div class="card-header pb-2 border-bottom">
                                <h5 class="card-title mb-0 d-flex align-items-center">
                                    <i class="bx bx-cart-alt me-2 text-primary" style="font-size: 1.5rem;"></i> Cucian Pelanggan
                                </h5>
                            </div>
                            
                            <div class="card-body flex-grow-1 overflow-y-auto overflow-x-hidden py-2" id="cart-list" style="max-height: 400px; min-height: 250px;">
                                
                                <div class="text-center text-muted my-5">
                                    <i class="bx bx-basket" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Keranjang masih kosong.<br>Klik item di etalase untuk menambahkan.</p>
                                </div>
                            </div>

                            <div class="card-footer bg-light border-top mt-auto">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted fw-semibold">Total Pembayaran:</span>
                                    <span class="h4 mb-0 fw-bold text-primary" id="cart-total-display">Rp 0</span>
                                </div>
                                <button type="button" class="btn btn-primary w-100 btn-lg shadow-sm py-2" id="btn-checkout" onclick="openCheckoutModal()" disabled>
                                    <i class="bx bx-check-circle me-1"></i> Lanjut Ke Detail Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade" id="pills-riwayat" role="tabpanel" aria-labelledby="pills-riwayat-tab">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Transaksi & Pelacakan Cucian</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-3">
                             <form method="GET" action="<?php echo e(route('operator.transaksi.index')); ?>" class="d-flex gap-2">
                                 <input type="hidden" name="tab" value="riwayat">
                                 <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" class="form-control" placeholder="Cari kode transaksi, pembeli, atau kamar...">
                                 <button class="btn btn-secondary"><i class="bx bx-search"></i> Cari</button>
                             </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle" style="min-width: 1000px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Tanggal &amp; Estimasi</th>
                                        <th>Pelanggan</th>
                                        <th>Status Laundry</th>
                                        <th>Status Bayar</th>
                                        <th>Total</th>
                                        <th>Rincian Cucian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="fw-bold text-dark"><?php echo e($trx->kode_transaksi); ?></td>
                                        <td>
                                            <div><strong>Masuk:</strong> <?php echo e($trx->created_at->format('d/m/Y H:i')); ?></div>
                                            <?php if($trx->tanggal_selesai): ?>
                                                <div class="text-info"><strong>Estimasi:</strong> <?php echo e(\Carbon\Carbon::parse($trx->tanggal_selesai)->format('d/m/Y H:i')); ?></div>
                                            <?php else: ?>
                                                <div class="text-muted">Estimasi: -</div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-secondary text-uppercase d-block mb-1"><?php echo e($trx->jenis_pelanggan); ?></span>
                                            <div class="fw-bold text-dark"><?php echo e($trx->nama_pembeli); ?></div>
                                            <?php if($trx->nomor_kamar): ?>
                                                <div class="text-muted" style="font-size: 0.8rem;"><i class="bx bx-hotel"></i> Kamar: <strong><?php echo e($trx->nomor_kamar); ?></strong></div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                                $statusClasses = [
                                                    'diterima' => 'secondary',
                                                    'proses'   => 'warning',
                                                    'selesai'  => 'info',
                                                    'diambil'  => 'success'
                                                ];
                                                $lbl = $statusClasses[$trx->status_laundry] ?? 'secondary';
                                            ?>
                                            <span class="badge bg-label-<?php echo e($lbl); ?> text-uppercase mb-2 d-inline-block"><?php echo e($trx->status_laundry); ?></span>
                                            
                                            
                                            <form action="<?php echo e(route('operator.transaksi.update-status', $trx->id)); ?>" method="POST" class="d-flex align-items-center gap-1 mt-1">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                <select name="status_laundry" class="form-select form-select-sm" style="font-size: 0.75rem; padding: 2px 5px;" onchange="this.form.submit()">
                                                    <option value="diterima" <?php echo e($trx->status_laundry === 'diterima' ? 'selected' : ''); ?>>Diterima</option>
                                                    <option value="proses" <?php echo e($trx->status_laundry === 'proses' ? 'selected' : ''); ?>>Diproses</option>
                                                    <option value="selesai" <?php echo e($trx->status_laundry === 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                                    <option value="diambil" <?php echo e($trx->status_laundry === 'diambil' ? 'selected' : ''); ?>>Diambil</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <?php if($trx->status_pembayaran === 'lunas'): ?>
                                                <span class="badge bg-label-success text-uppercase d-block mb-2">Lunas</span>
                                            <?php else: ?>
                                                <span class="badge bg-label-danger text-uppercase d-block mb-2">Belum Lunas</span>
                                            <?php endif; ?>
                                            
                                            
                                            <form action="<?php echo e(route('operator.transaksi.update-status', $trx->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                <input type="hidden" name="status_pembayaran" value="<?php echo e($trx->status_pembayaran === 'lunas' ? 'belum_lunas' : 'lunas'); ?>">
                                                <button class="btn btn-xs <?php echo e($trx->status_pembayaran === 'lunas' ? 'btn-outline-danger' : 'btn-success'); ?> w-100" style="font-size: 0.7rem; padding: 2px;">
                                                    Mark as <?php echo e($trx->status_pembayaran === 'lunas' ? 'Belum Lunas' : 'Lunas'); ?>

                                                </button>
                                            </form>
                                        </td>
                                        <td class="fw-bold text-primary">Rp <?php echo e(number_format($trx->total, 0, ',', '.')); ?></td>
                                        <td>
                                            <ul class="mb-0 ps-3 text-muted" style="font-size: 0.85rem;">
                                                <?php $__currentLoopData = $trx->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($d->produkJasa->nama); ?> (<?php echo e((float)$d->jumlah); ?> x Rp <?php echo e(number_format($d->harga, 0, ',', '.')); ?>)</li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="<?php echo e(route('operator.transaksi.print', $trx->id)); ?>" target="_blank" class="btn btn-icon btn-outline-primary btn-sm" title="Cetak Nota"><i class="bx bx-printer"></i></a>
                                                <?php if($trx->nomor_wa): ?>
                                                    <a href="<?php echo $trx->getWaUrl(); ?>" target="_blank" class="btn btn-icon btn-outline-success btn-sm" title="Kirim WhatsApp"><i class="bx bxl-whatsapp" style="font-size: 1.25rem;"></i></a>
                                                <?php endif; ?>
                                                <?php if($trx->user_id === Auth::id() && $trx->created_at->isToday()): ?>
                                                    <form action="<?php echo e(route('operator.transaksi.destroy', $trx->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Kuantitas stok barang akan dikembalikan.')">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button class="btn btn-icon btn-outline-danger btn-sm" title="Hapus"><i class="bx bx-trash"></i></button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted text-nowrap align-self-center" style="font-size: 0.85rem;" title="Hanya pembuat transaksi di hari yang sama yang dapat menghapus"><i class="bx bx-lock-alt"></i> Terkunci</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">Belum ada data transaksi untuk pencarian ini.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="mt-3 d-flex justify-content-center">
                            <?php echo e($transaksi->links('pagination::bootstrap-5')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-dark"><i class="bx bx-detail me-1 text-primary"></i> Detail Layanan &amp; Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Pelanggan</label>
                        <select class="form-select" id="jenis_pelanggan" onchange="toggleRoomInput()" required>
                            <option value="umum" selected>Pelanggan Umum</option>
                            <option value="tamu">Tamu Hotel (Charge ke Kamar)</option>
                            <option value="internal">Internal Hotel (Department Use)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" id="label-nama-pelanggan">Nama Pelanggan / Tamu</label>
                        <input type="text" class="form-control" id="nama_pembeli" placeholder="Masukkan nama..." required value="Umum">
                    </div>
                    <div class="mb-3" id="room-input-container" style="display: none;">
                        <label class="form-label fw-bold">Nomor Kamar</label>
                        <input type="text" class="form-control" id="nomor_kamar" placeholder="Contoh: Room 205 / 308">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor WhatsApp</label>
                        <input type="text" class="form-control" id="nomor_wa" placeholder="Contoh: 081234567890">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Pembayaran</label>
                        <select class="form-select" id="status_pembayaran" required>
                            <option value="lunas">Lunas (Cash / Transfer)</option>
                            <option value="belum_lunas" selected>Belum Lunas / Charge Room</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Estimasi Selesai Laundry</label>
                        <input type="datetime-local" class="form-control" id="tanggal_selesai">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="submitCheckout()"><i class="bx bx-save me-1"></i> Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<style>
    .etalase-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
        border-color: #566a7f !important;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }
    .cart-qty-input::-webkit-outer-spin-button,
    .cart-qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .cart-qty-input[type=number] {
        -moz-appearance: textfield;
    }
    .cart-qty-input {
        padding: 2px 4px !important;
        font-size: 0.85rem !important;
        height: 28px !important;
    }
</style>


<script>
    let cart = [];

    // Filter kategori etalase
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            document.querySelectorAll('.etalase-item').forEach(item => {
                const itemJenis = item.getAttribute('data-jenis');
                if (filterValue === 'semua' || itemJenis === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Fitur pencarian etalase
    document.getElementById('search-etalase').addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        document.querySelectorAll('.etalase-item').forEach(item => {
            const name = item.getAttribute('data-nama').toLowerCase();
            const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
            const itemJenis = item.getAttribute('data-jenis');
            
            const matchesSearch = name.includes(query);
            const matchesFilter = activeFilter === 'semua' || itemJenis === activeFilter;
            
            if (matchesSearch && matchesFilter) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Tambah item ke Cart
    function addToCart(id) {
        const itemElement = document.querySelector(`.etalase-item[data-id="${id}"]`);
        if (!itemElement) return;

        const name = itemElement.getAttribute('data-nama');
        const price = parseFloat(itemElement.getAttribute('data-harga'));
        const type = itemElement.getAttribute('data-jenis');
        const stock = parseInt(itemElement.getAttribute('data-stok'));

        // Cari apakah item sudah ada di cart
        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            if (type === 'produk' && existingItem.qty >= stock) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Terbatas',
                    text: `Jumlah tidak boleh melebihi stok yang tersedia (${stock} pcs).`
                });
                return;
            }
            existingItem.qty++;
        } else {
            cart.push({
                id: id,
                name: name,
                price: price,
                qty: 1,
                type: type,
                stock: stock
            });
        }
        
        renderCart();
    }

    // Ubah kuantitas di cart
    function updateQty(id, change) {
        const item = cart.find(item => item.id === id);
        if (!item) return;

        const newQty = item.qty + change;
        if (newQty <= 0) {
            removeFromCart(id);
            return;
        }

        if (item.type === 'produk' && newQty > item.stock) {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Terbatas',
                text: `Jumlah tidak boleh melebihi stok yang tersedia (${item.stock} pcs).`
            });
            return;
        }

        item.qty = newQty;
        renderCart();
    }

    // Set kuantitas secara langsung (input manual desimal)
    function setQtyDirect(id, val) {
        const item = cart.find(item => item.id === id);
        if (!item) return;

        let qty = parseFloat(val);
        if (isNaN(qty) || qty <= 0) {
            qty = 1;
        }

        if (item.type === 'produk' && qty > item.stock) {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Terbatas',
                text: `Jumlah tidak boleh melebihi stok yang tersedia (${item.stock} pcs).`
            });
            qty = item.stock;
        }

        // Bulatkan desimal jika produk agar tetap integer
        if (item.type === 'produk') {
            qty = Math.round(qty);
        }

        item.qty = qty;
        renderCart();
    }

    // Hapus item dari cart
    function removeFromCart(id) {
        cart = cart.filter(item => item.id !== id);
        renderCart();
    }

    // Render HTML Keranjang
    function renderCart() {
        const cartList = document.getElementById('cart-list');
        const btnCheckout = document.getElementById('btn-checkout');
        const totalDisplay = document.getElementById('cart-total-display');

        if (cart.length === 0) {
            cartList.innerHTML = `
                <div class="text-center text-muted my-5">
                    <i class="bx bx-basket" style="font-size: 3rem;"></i>
                    <p class="mt-2">Keranjang masih kosong.<br>Klik item di etalase untuk menambahkan.</p>
                </div>
            `;
            btnCheckout.disabled = true;
            totalDisplay.innerText = 'Rp 0';
            return;
        }

        let total = 0;
        let html = '<div class="list-group list-group-flush">';

        cart.forEach(item => {
            const subtotal = item.price * item.qty;
            total += subtotal;

            html += `
                 <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-bottom">
                    <div style="max-width: 45%; flex-grow: 1; min-width: 0;">
                        <div class="fw-bold text-dark text-truncate" title="${item.name}">${item.name}</div>
                        <small class="text-muted">Rp ${formatRupiah(item.price)}</small>
                    </div>
                    <div class="d-flex align-items-center gap-1 flex-shrink-0">
                        <button class="btn btn-xs btn-outline-secondary px-2" onclick="updateQty(${item.id}, -1)">-</button>
                        <input type="number" class="form-control form-control-sm text-center fw-bold cart-qty-input" style="width: 50px;" step="0.01" min="0.01" value="${item.qty}" onchange="setQtyDirect(${item.id}, this.value)">
                        <button class="btn btn-xs btn-outline-secondary px-2" onclick="updateQty(${item.id}, 1)">+</button>
                        <button class="btn btn-xs btn-outline-danger border-0 ms-1" onclick="removeFromCart(${item.id})">
                            <i class="bx bx-trash" style="font-size: 1.1rem;"></i>
                        </button>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        cartList.innerHTML = html;
        totalDisplay.innerText = 'Rp ' + formatRupiah(total);
        btnCheckout.disabled = false;
    }

    // Fungsi Format Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    // Mengontrol input nomor kamar berdasarkan jenis pelanggan
    function toggleRoomInput() {
        const jenisPelanggan = document.getElementById('jenis_pelanggan').value;
        const roomContainer = document.getElementById('room-input-container');
        const paymentSelect = document.getElementById('status_pembayaran');
        const labelNama = document.getElementById('label-nama-pelanggan');
        
        if (jenisPelanggan === 'tamu') {
            roomContainer.style.display = 'block';
            paymentSelect.value = 'belum_lunas'; // Tamu hotel biasanya charge ke kamar (belum lunas di laundry)
            labelNama.innerText = 'Nama Tamu';
        } else {
            roomContainer.style.display = 'none';
            document.getElementById('nomor_kamar').value = '';
            paymentSelect.value = 'lunas';
            if (jenisPelanggan === 'internal') {
                labelNama.innerText = 'Nama / Departemen Internal';
            } else {
                labelNama.innerText = 'Nama Pelanggan';
            }
        }
    }

    // Buka Modal Checkout
    function openCheckoutModal() {
        if (cart.length === 0) return;
        
        // Set estimasi selesai default (2 hari ke depan)
        const date = new Date();
        date.setDate(date.getDate() + 2);
        // Format ISO local untuk input datetime-local
        const localDateTime = new Date(date.getTime() - date.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
        document.getElementById('tanggal_selesai').value = localDateTime;
        
        const myModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        myModal.show();
    }

    // Kirim AJAX checkout dari modal
    function submitCheckout() {
        const namaPembeli = document.getElementById('nama_pembeli').value.trim();
        const jenisPelanggan = document.getElementById('jenis_pelanggan').value;
        const nomorKamar = document.getElementById('nomor_kamar').value.trim();
        const nomorWa = document.getElementById('nomor_wa').value.trim();
        const statusPembayaran = document.getElementById('status_pembayaran').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;

        if (!namaPembeli) {
            Swal.fire({ icon: 'warning', title: 'Input Tidak Valid', text: 'Nama Pembeli wajib diisi!' });
            return;
        }

        if (jenisPelanggan === 'tamu' && !nomorKamar) {
            Swal.fire({ icon: 'warning', title: 'Input Tidak Valid', text: 'Nomor Kamar wajib diisi untuk Tamu Hotel!' });
            return;
        }

        const modalElement = document.getElementById('checkoutModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);

        // Tutup modal
        if (modalInstance) modalInstance.hide();

        const btnCheckout = document.getElementById('btn-checkout');
        btnCheckout.disabled = true;
        btnCheckout.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memproses...';

        // Persiapkan payload cart
        const cartPayload = cart.map(item => ({
            produk_jasa_id: item.id,
            jumlah: item.qty
        }));

        fetch('<?php echo e(route("operator.transaksi.store")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                cart: cartPayload,
                nama_pembeli: namaPembeli,
                jenis_pelanggan: jenisPelanggan,
                nomor_kamar: nomorKamar,
                nomor_wa: nomorWa,
                status_pembayaran: statusPembayaran,
                tanggal_selesai: tanggalSelesai
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Terjadi kesalahan sistem.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                let showDeny = data.wa_url ? true : false;
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Transaksi POS berhasil disimpan!',
                    showCancelButton: true,
                    showDenyButton: showDeny,
                    confirmButtonText: 'Cetak Nota',
                    denyButtonText: 'Kirim WhatsApp',
                    cancelButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                        denyButton: 'btn btn-success me-2',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        const printUrl = `<?php echo e(url('operator/transaksi')); ?>/${data.transaksi_id}/print`;
                        window.open(printUrl, '_blank');
                    } else if (result.isDenied && data.wa_url) {
                        window.open(data.wa_url, '_blank');
                    }
                    cart = [];
                    renderCart();
                    window.location.href = "<?php echo e(route('operator.transaksi.index')); ?>?tab=riwayat";
                });
            } else {
                throw new Error(data.message || 'Transaksi gagal disimpan.');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Transaksi Gagal',
                text: error.message
            });
            btnCheckout.disabled = false;
            btnCheckout.innerHTML = '<i class="bx bx-check-circle me-1"></i> Simpan &amp; Bayar';
        });
    }

    // Pertahankan tab riwayat transaksi jika parameter URL tab=riwayat terdeteksi
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        if (activeTab === 'riwayat') {
            const tabElement = document.getElementById('pills-riwayat-tab');
            if (tabElement) {
                const tabTrigger = new bootstrap.Tab(tabElement);
                tabTrigger.show();
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('operator.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simup_hotel\resources\views/operator/transaksi/index.blade.php ENDPATH**/ ?>