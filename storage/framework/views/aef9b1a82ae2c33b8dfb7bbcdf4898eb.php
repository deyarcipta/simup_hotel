<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <span class="app-brand-text demo menu-text fw-bolder">SIMUP LAUNDRY</span>
  </div>
  <ul class="menu-inner py-1">
    <li class="menu-item <?php echo e(request()->is('operator/dashboard*') ? 'active' : ''); ?>">
      <a href="<?php echo e(url('/operator/dashboard')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home"></i>
        <div>Dashboard</div>
      </a>
    </li>
    <li class="menu-item <?php echo e(request()->is('operator/produk-jasa*') ? 'active' : ''); ?>">
      <a href="<?php echo e(url('/operator/produk-jasa')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-data"></i>
        <div>Produk & Jasa</div>
      </a>
    </li>
    <li class="menu-item <?php echo e(request()->is('operator/transaksi*') ? 'active' : ''); ?>">
      <a href="<?php echo e(url('/operator/transaksi')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cart"></i>
        <div>Transaksi</div>
      </a>
    </li>
    
    <li class="menu-item <?php echo e(request()->is('operator/logbook*') ? 'active' : ''); ?>">
      <a href="<?php echo e(route('operator.logbook.index')); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-book-content"></i>
        <div>Logbook Hari Ini</div>
      </a>
    </li>
  </ul>
</aside>
<?php /**PATH C:\laragon\www\simup_hotel\resources\views/operator/layouts/sidebar.blade.php ENDPATH**/ ?>