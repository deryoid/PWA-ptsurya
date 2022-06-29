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
                            <h1 class="m-0 text-dark">Pemasukkan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pemasukkan</li>
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
                            <div class="card card-danger card-outline">
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
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Produk</th>
                                                    <th>Jenis Produk</th>
                                                    <th>Ukuran</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                                <tbody style="background-color: azure">
                                            <?php
                                            $no = 1;
                                            $data = $koneksi->query("SELECT * FROM detail_pemesanan AS dp
                                            LEFT JOIN pemesanan AS p ON dp.id_pemesanan = p.id_pemesanan
                                            LEFT JOIN katalog AS k ON dp.id_katalog = k.id_katalog
                                            LEFT JOIN pelanggan AS pel ON p.id_pelanggan = pel.id_pelanggan
                                            ");
                                            while ($row = $data->fetch_array()) {
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td><?= $row['nama_pelanggan'] ?></td>
                                                        <td><?= $row['tanggal_pesan'] ?></td>
                                                        <td><?= $row['nama_katalog'] ?></td>
                                                        <td><?= $row['jenis_katalog'] ?></td>
                                                        <td><?= $row['ukuran'] ?></td>
                                                        <td><?= $row['harga'] ?></td>
                                                        <td><?= $row['jumlah'] ?></td>
                                                        <td><?= $row['total'] ?></td>
                                                        
                                                    </tr>
                                            <?php } ?>
                                                </tbody>
                                                <!-- <tfoot>
                                                    <tr>
                                                        <th colspan="8" style="text-align:right;">Jumlah Keseluruhan:</th>
                                                        <th> <?php $tot = $koneksi->query("SELECT SUM(total) AS totalsel FROM detail_pemesanan")->fetch_array(); echo  $tot['totalsel']; ?></th>
                                                    </tr>
                                                </tfoot> -->
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


        <!-- MODAL FILTER CETAK -->
        <div class="modal fade" id="modal-cetak">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Filter Cetak Laporan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="print" target="blank" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control" required>
                                <option value="" selected disabled>--Pilih Bulan--</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="tahun" class="form-control" required>
                                <option value="" selected disabled>--Pilih Tahun--</option>
                                <?php for ($i=2020; $i <= date('Y'); $i++) { ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Bayar</label>
                            <select name="status_bayar" class="form-control" required>
                                <option value="" selected disabled>--Pilih Status Bayar--</option>
                                <option value="Belum Dibayar">Belum Dibayar</option>
                                <option value="Sudah Dibayar">Sudah Dibayar</option>
                            </select>
                        </div>
                   </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"> Cetak</i></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Tutup</i></button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
            </div>
        </div>
    <!-- /.modal-dialog -->

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