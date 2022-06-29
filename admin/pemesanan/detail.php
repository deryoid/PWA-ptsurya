<?php
require '../../config/config.php';
require '../../config/koneksi.php';


$id   = $_GET['id'];
$data = $koneksi->query("SELECT * FROM pemesanan AS pem INNER JOIN pelanggan AS pel ON pem.id_pelanggan = pel.id_pelanggan
WHERE pem.id_pemesanan = '$id'")->fetch_array();
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
                            <h1 class="m-0 text-dark">Detail Pemesanan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Detail Pemesanan</li>
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
                                        <h3 class="card-title">Detail Pemesanan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body" style="background-color: white;">

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


                                        <div class="form-group row">
                                            <label for="no_telp" class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
                                            <div class="col-sm-10">
                                            <label for="" class="col-sm-2 col-form-label"> : <?= $data['tanggal_pesan'] ?></label>
                                            </div>
                                        </div>
                                                                            
                                        <div class="form-group row">
                                            <label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama </label>
                                            <div class="col-sm-10">
                                            <label for="" class="col-sm-2 col-form-label"> : <?= $data['nama_pelanggan'] ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-10">
                                            <label for="" class="col-sm-2 col-form-label"> : <?= $data['jk'] ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                            <label for="" class="col-sm-2 col-form-label"> : <?= $data['alamat'] ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                            <div class="col-sm-10">
                                            <label for="" class="col-sm-2 col-form-label"> : <?= $data['no_hp'] ?></label>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <!-- /.card-body -->

                                </div>

                            </div>
                            <!--/.col (left) -->
                            <div class="col-md-12">
                                <!-- Horizontal Form -->
                                <div class="card card-green">
                                    <div class="card-header">
                                        <h3 class="card-title">Katalog/Barang</h3>
                                    </div>
                                    
                               
                                   
                                    <!-- form start -->
                                    <div class="card-body" style="background-color: white;">

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
                                            ");
                                            while ($row = $data->fetch_array()) {
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td><?= $row['nama_katalog'] ?></td>
                                                        <td><?= $row['jenis_katalog'] ?></td>
                                                        <td><?= $row['ukuran'] ?></td>
                                                        <td><?= $row['harga'] ?></td>
                                                        <td><?= $row['jumlah'] ?></td>
                                                        <td><?= $row['total'] ?></td>
                                                    </tr>
                                            <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="6" style="text-align:right;">Jumlah :</th>
                                                        <th> <?php $tot = $koneksi->query("SELECT SUM(total) AS totalsel FROM detail_pemesanan WHERE id_pemesanan = '$id'")->fetch_array(); echo  $tot['totalsel']; ?></th>
                                                    </tr>
                                                </tfoot>
                                        </table>
                                    </div>  
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


</body>

</html>

 <!-- MODAL Print -->
 <div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg accent-blue   ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang/Katalog</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
    <!-- Start content -->
        <div class="content">
            <div class="container"> 
                <div class="row">
                     <div class="col-sm-12">
                          <div class="card-box">
                                <form class="form-horizontal" action="" method="POST">
                                    <div class="form-group row">
                                        <input type="hidden" name="id_pemesanan" value="<?php echo $id; ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_pimpinan" class="col-sm-2 col-form-label"> Katalog/Barang</label>
                                        <div class="col-sm-10">
                                        <select class="form-control select2" data-placeholder="Pilih" id="id_katalog" name="id_katalog" required>
                                                <option value=""></option>
                                                <?php
                                                $data1 = $koneksi->query("SELECT * FROM katalog ORDER BY id_katalog ASC");
                                                while ($dsn = $data1->fetch_array()) {
                                                ?>
                                                    <option value="<?= $dsn['id_katalog'] ?>"><?= $dsn['nama_katalog'] ?> - Ukuran : <?= $dsn['ukuran'] ?> - Harga Total : <?= number_format($dsn['harga'],0,',','.') ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_pimpinan" class="col-sm-2 col-form-label"> Jumlah</label>
                                        <div class="col-sm-10">
                                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                                        </div>
                                    </div>
                                        <hr>
                                        <input type="submit" name="tambahbrg" class="btn btn-primary" value="Tambah">

                                </form>
                                       
                                </div>
                            </div>                          
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['tambahbrg'])) {
        $id_pemesanan     = $_POST['id_pemesanan'];
        $id_katalog         = $_POST['id_katalog'];
        $jumlah             = $_POST['jumlah'];

        $katalog = $koneksi->query("SELECT * FROM katalog WHERE id_katalog = '$id_katalog'")->fetch_array();
        $total = $jumlah * $katalog['harga'];
            $submit = $koneksi->query("INSERT INTO detail_pemesanan VALUES (
                NULL,
                '$id_pemesanan',
                '$id_katalog',
                '$jumlah',
                '$total'
                )");

            if ($submit) {

                // $getidpem = $koneksi->query("SELECT * FROM pemesanan ORDER BY id_pemesanan DESC LIMIT 1")->fetch_array();
                $_SESSION['pesan'] = "Data Pemesanan Ditambahkan";
                echo "<script>window.history.back();</script>";
            }
        }
    ?>