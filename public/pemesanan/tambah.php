<?php
require '../../config/config.php';
require '../../config/koneksi.php';

$no = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan ORDER BY id_pelanggan DESC");
$id_pelanggan = mysqli_fetch_array($no);
$id = $id_pelanggan['id_pelanggan'];

$urut = substr($id, 3, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
  $format = "PLG" . "00" . $tambah;
} else if (strlen($tambah) == 2) {
  $format = "PLG" . "0" . $tambah;
} else {
  $format = "PLG" . $tambah;
}

?>
<!DOCTYPE html>
<html>
<?php
include '../../templates_public/head.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        include '../../templates_public/navbar.php';
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include '../../templates_public/sidebar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Pemesanan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pemesanan</li>
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
                                <div class="card card-red">
                                    <div class="card-header">
                                        <h3 class="card-title">Pemesanan</h3>
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
                                                <input type="date" class="form-control" id="" name="tanggal_pesan" value="<?php echo date("Y-m-d") ; ?>">
                                            </div>
                                        </div>
                                                                            
                                        <div class="form-group row">
                                            <label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-10">
                                                <select name="jk" class="form-control" required>
                                                    <option value="">--Pilih--</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer" style="background-color: white;">
                                        <a href="<?= base_url('admin/pemesanan/') ?>" class="btn bg-gradient-secondary float-right"><i class="fa fa-arrow-left"> Batal</i></a>
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

        <?php include_once "../../templates_public/footer.php"; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <?php include_once "../../templates_public/script.php"; ?>

    <?php
    if (isset($_POST['submit'])) {
        $id_pelanggan       = $format;
        $nama_pelanggan     = $_POST['nama_pelanggan'];
        $jk                 = $_POST['jk'];
        $alamat             = $_POST['alamat'];
        $no_hp              = $_POST['no_hp'];

        $tanggal_pesan       = $_POST['tanggal_pesan'];

        $pelanggan = $koneksi->query("INSERT INTO pelanggan VALUES (
            '$id_pelanggan',
            '$nama_pelanggan',
            '$jk',
            '$alamat',
            '$no_hp'
            )");
        


            $submit = $koneksi->query("INSERT INTO pemesanan VALUES (
                NULL,
                '$tanggal_pesan',
                '$id_pelanggan'
                )");

            if ($submit) {

                $getidpem = $koneksi->query("SELECT * FROM pemesanan ORDER BY id_pemesanan DESC LIMIT 1")->fetch_array();
                $_SESSION['pesan'] = "Data Pemesanan Ditambahkan";
                echo "<script>window.location.replace('../pemesanan/detail?id=$getidpem[id_pemesanan]');</script>";
            }
        }
    ?>


</body>

</html>