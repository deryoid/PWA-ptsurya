<?php
require '../../config/config.php';
require '../../config/koneksi.php';
require '../../config/day.php';
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
                            <h1 class="m-0 text-dark">Gaji Karyawan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Gaji Karyawan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-success card-outline">
                                <div class="card-header">

                                    <a href="print" target="blank" class="btn bg-yellow"><i class="fa fa-print"> Cetak</i></a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php
                                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                                    ?>
                                        <div class="alert alert-info alertinfo" role="alert">
                                            <i class="fa fa-check-circle"> <?= $_SESSION['pesan']; ?></i>
                                        </div>
                                    <?php
                                        $_SESSION['pesan'] = '';
                                    }
                                    ?>

                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead class="bg-green">
                                                <tr align="center">
                                                    <th>No</th>
                                                    <th>Karyawan</th>
                                                    <th>Periode</th>
                                                    <th>Absensi</th>
                                                    <th>Gaji</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $no = 1;
                                            $data = $koneksi->query("SELECT * FROM rekapabsen AS ra
                                            LEFT JOIN karyawan AS k ON ra.id_karyawan = k.id_karyawan
                                            ORDER BY ra.id_rekap DESC");
                                            while ($row = $data->fetch_array()) {
                                            ?>
                                                <tbody style="background-color: azure">
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td>
                                                            Nama Karyawan : <?= $row['nama_karyawan'] ?><br>
                                                            Bidang : <?= $row['bidang'] ?><br>
                                                            Jabatan : <?= $row['jabatan'] ?><br>
                                                        </td>
                                                        <td>
                                                            Bulan : <?= $row['bulan'] ?><br>
                                                            Tahun : <?= $row['tahun'] ?><br>
                                                        </td>
                                                        <td>
                                                            Total Hadir : <?= $row['jumlah_hadir'] ?><br>
                                                            Total Alpa : <?= $row['jumlah_alpa'] ?><br>
                                                            Total Ijin/Sakit : <?= $row['jumlah_ijin_sakit'] ?><br>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $gapok = $row['gaji_karyawan'];
                                                            $potongan = ($row['jumlah_alpa'] * 50000);
                                                            $totalgaji = $gapok - $potongan;
                                                            ?>
                                                            Gaji Pokok : <?= rupiah($row['gaji_karyawan']) ?><br>
                                                            Potongan : <?= rupiah($potongan) ?><br>
                                                            <b><u>Total Gaji : <?= rupiah($totalgaji) ?></u></b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
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
    <?php include_once "../../templates/script.php";
    function rupiah($angka)
    {
        $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
        return $hasil;
    }
    ?>

    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    </script>

</body>

</html>