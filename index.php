<?php
require 'config/config.php';
require 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<?php
include 'templates_public/head.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <script>
    if (!navigator.serviceWorker?.controller) {
      navigator.serviceWorker?.register("./sw.js").then(function(reg) {
        console.log("Service worker has been registered for scope: " + reg.scope);
      });
    }
  </script>
  <div class="wrapper">

    <!-- Navbar -->
    <?php
    include 'templates_public/navbar.php';
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include 'templates_public/sidebar.php';
    ?>

    <!--- Navbar Top -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #55A846; width:100%;">
      <div class="container-fluid">
        <img src="<?= base_url(); ?>/assets/dist/img/logo-surya.jpeg" class="mr-3" style="width: 30px;" alt="">
        <a class="navbar-brand" href="index" style="color: white;">PT. SURYA SATRIA TIMUR</a>

        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('public/index') ?>" style="color: black;">Katalog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="" href="<?= base_url('index') ?>" style="color: black;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('public/pemesanan/tambah') ?>" style="color: black;">Pemesanan</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--- End Navbar -->

    <!-- Bottom Navbar -->
    <nav class="navbar navbar-dark navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none" style="background-color:#55A846;">
      <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
          <a href="<?= base_url('public/index') ?>" class="nav-link text-center" style="color: white;">
            <i class="fas fa-tachometer-alt"></i>
            <span class="small d-block">Katalog</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('index') ?>" class="nav-link text-center" style="color: white;">
            <i class="fas fa-home"></i>
            <span class="small d-block">Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('public/pemesanan/tambah') ?>" class="nav-link text-center" style="color: white;">
            <i class="fas fa-store-alt"></i>
            <span class="small d-block">Pemesanan</span>
          </a>
        </li>
      </ul>
    </nav>
    <br>
    <br>
    <br>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">

            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="card mt-2 mb-2 text-center">
              <h1 class="m-0 text-dark">PT SURYA SATRIA UTAMA</h1>
              <img src="<?= base_url(); ?>/assets/dist/img/logo-surya.png" width="100%" alt="">
              <a href="login" class="btn btn-sm btn-block bg-green"><i class="fas fa-sign-in-alt">Login</i></a>
            </div>
          </div>

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <?php
    include 'templates_public/footer.php';
    ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Script -->
  <?php
  include 'templates_public/script.php';
  ?>
</body>

</html>