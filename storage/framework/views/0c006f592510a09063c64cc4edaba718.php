<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <span class="app-brand-text demo menu-text fw-bolder">SIMUP LAUNDRY</span>
  </div>

  <ul class="menu-inner py-1">
    
    <li class="menu-item <?php echo e(request()->is('admin/dashboard*') ? 'active' : ''); ?>">
      <a href="<?php echo e(url('/admin/dashboard')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home"></i>
        <div>Dashboard</div>
      </a>
    </li>

    
    <li class="menu-item <?php echo e(request()->is('admin/kelola-user*') ? 'active' : ''); ?>">
      <a href="<?php echo e(url('/admin/kelola-user')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div>Kelola User</div>
      </a>
    </li>

    
    <li class="menu-item <?php echo e(request()->is('admin/logbook*') ? 'active' : ''); ?>">
      <a href="<?php echo e(route('admin.logbook.index')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-book-content"></i>
        <div>Logbook UP</div>
      </a>
    </li>

    
    <li class="menu-item <?php echo e(request()->is('admin/produk-jasa*') || request()->is('admin/stok-barang*') ? 'open active' : ''); ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-data"></i>
        <div>Manajemen Data</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php echo e(request()->is('admin/produk-jasa*') ? 'active' : ''); ?>">
          <a href="<?php echo e(url('/admin/produk-jasa')); ?>" class="menu-link">
            <div>Produk &amp; Jasa</div>
          </a>
        </li>
        <li class="menu-item <?php echo e(request()->is('admin/stok-barang*') ? 'active' : ''); ?>">
          <a href="<?php echo e(url('/admin/stok-barang')); ?>" class="menu-link">
            <div>Stok Barang</div>
          </a>
        </li>
      </ul>
    </li>

    
    <li class="menu-item <?php echo e(request()->is('admin/transaksi*') || request()->is('admin/rekap-transaksi*') ? 'open active' : ''); ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cart"></i>
        <div>Transaksi</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php echo e(request()->is('admin/transaksi*') ? 'active' : ''); ?>">
          <a href="<?php echo e(url('/admin/transaksi')); ?>" class="menu-link">
            <div>Transaksi Harian</div>
          </a>
        </li>
        <li class="menu-item <?php echo e(request()->is('admin/rekap-transaksi*') ? 'active' : ''); ?>">
          <a href="<?php echo e(url('/admin/rekap-transaksi')); ?>" class="menu-link">
            <div>Rekap Transaksi</div>
          </a>
        </li>
      </ul>
    </li>

    
    <li class="menu-item <?php echo e(request()->is('admin/pengeluaran-lain*') ? 'active' : ''); ?>">
      <a href="<?php echo e(url('/admin/pengeluaran-lain')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
        <div>Pengeluaran Lain</div>
      </a>
    </li>

    
    <li class="menu-item <?php echo e(request()->is('admin/laporan*') ? 'open active' : ''); ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-bar-chart"></i>
            <div>Laporan</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/laporan/buku-besar*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('laporan.buku-besar')); ?>" class="menu-link">
                    <div>Buku Besar Keuangan</div>
                </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/laporan/shu*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('laporan.shu')); ?>" class="menu-link">
                    <div>Sisa Hasil Usaha (SHU)</div>
                </a>
            </li>
        </ul>
    </li>

    
    <li class="menu-item <?php echo e(request()->is('admin/pengaturan*') ? 'active' : ''); ?>">
      <a href="<?php echo e(url('/admin/pengaturan')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div>Pengaturan</div>
      </a>
    </li>
  </ul>
</aside>
<?php /**PATH C:\laragon\www\simup_hotel\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>