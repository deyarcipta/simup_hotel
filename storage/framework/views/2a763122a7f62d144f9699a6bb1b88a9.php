<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <?php if(!empty($logoAplikasi)): ?>
        <link rel="icon" type="image/png" href="<?php echo e(asset('storage/' . $logoAplikasi)); ?>">
    <?php else: ?>
        <link rel="icon" type="image/png" href="<?php echo e(asset('default-logo.png')); ?>">
    <?php endif; ?>

    <title id="dynamicTitle"><?php echo e($namaAplikasi); ?><?php if (! empty(trim($__env->yieldContent('title')))): ?> | <?php echo $__env->yieldContent('title'); ?><?php endif; ?> | </title>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let titleElement = document.getElementById("dynamicTitle");
        let originalTitle = titleElement.innerText;
        let space = "   "; // jarak antar loop
        let index = 0;

        setInterval(function () {
            // Geser teks
            let displayed = originalTitle.substring(index) + space + originalTitle.substring(0, index);
            titleElement.innerText = displayed;

            index++;
            if (index > originalTitle.length) index = 0;
        }, 250); // Kecepatan scroll (ms)
    });
    </script>

    <link rel="stylesheet" href="<?php echo e(asset('vendor/fonts/iconify-icons.css')); ?>" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="<?php echo e(asset('vendor/css/core.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/demo.css')); ?>" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="<?php echo e(asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />

    <!-- endbuild -->

    <link rel="stylesheet" href="<?php echo e(asset('vendor/libs/apex-charts/apex-charts.css')); ?>" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php echo e(asset('vendor/js/helpers.js')); ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="<?php echo e(asset('js/config.js')); ?>"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

</head>
<body>
  <!-- Layout Wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      
      <!-- Sidebar -->
      <?php echo $__env->make('operator.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <!-- Main Content -->
      <div class="layout-page">
        <?php echo $__env->make('operator.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <!-- Page Content -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
      </div>

    </div>
  </div>
<!-- Core JS -->

    <script src="<?php echo e(asset('vendor/libs/jquery/jquery.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/js/bootstrap.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/js/menu.js')); ?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo e(asset('vendor/libs/apex-charts/apexcharts.js')); ?>"></script>

    <!-- Main JS -->

    <script src="<?php echo e(asset('js/main.js')); ?>"></script>

    <!-- Page JS -->
    <script src="<?php echo e(asset('js/dashboards-analytics.js')); ?>"></script>

<?php if(session('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '<?php echo e(session('success')); ?>',
        timer: 2000,
        showConfirmButton: false,
        didOpen: () => {
            const swalContainer = document.querySelector('.swal2-container');
            if(swalContainer) swalContainer.style.zIndex = '20000';
        }
    })
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo e(session('error')); ?>',
        didOpen: () => {
            const swalContainer = document.querySelector('.swal2-container');
            if(swalContainer) swalContainer.style.zIndex = '20000';
        }
    })
</script>
<?php endif; ?>
</body>
</html>
<?php /**PATH C:\laragon\www\simup_hotel\resources\views/operator/layouts/app.blade.php ENDPATH**/ ?>