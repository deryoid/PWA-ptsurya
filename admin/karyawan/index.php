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
                            <h1 class="m-0 text-dark">Karyawan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Karyawan</li>
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
                                    <a href="tambah" class="btn bg-blue"><i class="fa fa-plus-circle"> Tambah Data</i></a>
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
                                                    <th>Nama Karyawan</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>TTL</th>
                                                    <th>Agama</th>
                                                    <th>Pendidikan</th>
                                                    <th>Jurusan</th>
                                                    <th>Alamat</th>
                                                    <th>Hp</th>
                                                    <th>Bidang</th>
                                                    <th>Jabatan</th>
                                                    <th>Gaji</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $no = 1;
                                            $data = $koneksi->query("SELECT * FROM karyawan ORDER BY id_karyawan DESC");
                                            while ($row = $data->fetch_array()) {
                                            ?>
                                                <tbody style="background-color: azure">
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td><?= $row['nama_karyawan'] ?></td>
                                                        <td><?= $row['jk'] ?></td>
                                                        <td><?= $row['tempat_lahir'] . ', ' . tgl_indo($row['tgl_lahir']) ?></td>
                                                        <td><?= $row['agama'] ?></td>
                                                        <td><?= $row['pendidikan'] ?></td>
                                                        <td><?= $row['jurusan'] ?></td>
                                                        <td><?= $row['alamat'] ?></td>
                                                        <td><?= $row['hp'] ?></td>
                                                        <td><?= $row['bidang'] ?></td>
                                                        <td><?= $row['jabatan'] ?></td>
                                                        <td><?= rupiah($row['gaji_karyawan']) ?></td>
                                                        <td align="center">
                                                            <a href="edit?id=<?= $row['id_karyawan'] ?>" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                                            <a href="hapus?id=<?= $row['id_karyawan'] ?>" class="btn btn-danger btn-sm alert-hapus" title="Hapus"><i class="fa fa-trash"></i></a>
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