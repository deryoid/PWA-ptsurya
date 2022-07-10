<?php
require '../../config/config.php';
require '../../config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<?php
include '../../templates/head.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        include '../../templates/navbar.php';
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include '../../templates/sidebar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Rekap Absen</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Rekap Absen</li>
                                <li class="breadcrumb-item active">Tambah Data</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- left column -->
                    <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Horizontal Form -->
                                <div class="card card-green">
                                    <div class="card-header">
                                        <h3 class="card-title">Rekap Absen</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body" style="background-color: white;">


                                        <div class="form-group row">
                                            <label for="nama_katalog" class="col-sm-2 col-form-label">Karyawan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" data-placeholder="Pilih" name="id_karyawan" data-placeholder="Pilih Nama ">
                                                    <option value=""></option>
                                                    <?php
                                                    $data1 = $koneksi->query("SELECT * FROM karyawan ORDER BY id_karyawan ASC");
                                                    while ($dsn = $data1->fetch_array()) {
                                                    ?>
                                                        <option value="<?= $dsn['id_karyawan'] ?>"><?= $dsn['nama_karyawan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_katalog" class="col-sm-2 col-form-label">Bulan</label>
                                            <div class="col-sm-10">
                                                <select name="bulan" class="form-control" required>
                                                    <option value="" disabled selected>--Pilih--</option>
                                                    <option value="Januari">Januari</option>
                                                    <option value="Febuari">Febuari</option>
                                                    <option value="Maret">Maret</option>
                                                    <option value="April">April</option>
                                                    <option value="Mei">Mei</option>
                                                    <option value="Juni">Juni</option>
                                                    <option value="Juli">Juli</option>
                                                    <option value="Agustus">Agustus</option>
                                                    <option value="September">September</option>
                                                    <option value="Oktober">Oktober</option>
                                                    <option value="November">November</option>
                                                    <option value="Desember">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_katalog" class="col-sm-2 col-form-label">Tahun</label>
                                            <div class="col-sm-10">
                                                <select name="tahun" class="form-control" required>
                                                    <option value="" disabled selected>--Pilih--</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2020">2020</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="jenis_katalog" class="col-sm-2 col-form-label">Jumlah Hadir</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="jumlah_hadir" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jenis_katalog" class="col-sm-2 col-form-label">Jumlah Tidak Hadir</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="jumlah_alpa" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jenis_katalog" class="col-sm-2 col-form-label">Jumlah Ijin/Sakit</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="jumlah_ijin_sakit" required>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer" style="background-color: white;">
                                        <a href="<?= base_url('admin/rekapabsen/') ?>" class="btn bg-gradient-secondary float-right"><i class="fa fa-arrow-left"> Batal</i></a>
                                        <button type="submit" name="submit" class="btn bg-gradient-primary float-right mr-2"><i class="fa fa-save"> Simpan</i></button>
                                    </div>
                                    <!-- /.card-footer -->

                                </div>

                            </div>
                            <!--/.col (left) -->
                        </div>

                    </form>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include_once "../../templates/footer.php"; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <?php include_once "../../templates/script.php"; ?>


    <?php
    if (isset($_POST['submit'])) {
        $id_karyawan = $_POST['id_karyawan'];
        $bulan            = $_POST['bulan'];
        $tahun  = $_POST['tahun'];
        $jumlah_hadir     = $_POST['jumlah_hadir'];
        $jumlah_alpa         = $_POST['jumlah_alpa'];
        $jumlah_ijin_sakit    = $_POST['jumlah_ijin_sakit'];


        $submit = $koneksi->query("INSERT INTO rekapabsen VALUES (
            NULL,
            '$id_karyawan',
            '$bulan',
            '$tahun',
            '$jumlah_hadir',
            '$jumlah_alpa',
            '$jumlah_ijin_sakit'
            )");

        if ($submit) {

            $_SESSION['pesan'] = "Data Rekap Absen Ditambahkan";
            echo "<script>window.location.replace('../rekapabsen/');</script>";
        }
    }
    ?>


</body>

</html>