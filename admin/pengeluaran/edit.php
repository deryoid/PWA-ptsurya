<?php
require '../../config/config.php';
require '../../config/koneksi.php';
$id   = $_GET['id'];
$data = $koneksi->query("SELECT * FROM pengeluaran WHERE id_pengeluaran = '$id'");
$row  = $data->fetch_array();
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
                            <h1 class="m-0 text-dark">Ubah Pengeluaran</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pengeluaran</li>
                                <li class="breadcrumb-item active">Ubah Data</li>
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
                                        <h3 class="card-title">Karyawan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body" style="background-color: white;">



                                    <div class="form-group row">
                                            <label for="nama_katalog" class="col-sm-2 col-form-label">Pengeluaran</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama_pengeluaran" name="nama_pengeluaran" value="<?= $row['nama_pengeluaran']; ?>">
                                            </div>
                                        </div>
                                       

                                    <div class="form-group row">
                                        <label for="jenis_katalog" class="col-sm-2 col-form-label">Tanggal Pengeluaran</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="tanggal_pengeluaran" value="<?= $row['tanggal_pengeluaran']; ?>">
                                        </div>
                                    </div>

                                 
                                    <div class="form-group row">
                                        <label for="jenis_katalog" class="col-sm-2 col-form-label">Total Pengeluaran</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="total_pengeluaran" value="<?= $row['total_pengeluaran']; ?>">
                                        </div>
                                    </div>


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer" style="background-color: white;">
                                        <a href="<?= base_url('admin/pengeluaran/') ?>" class="btn bg-gradient-secondary float-right"><i class="fa fa-arrow-left"> Batal</i></a>
                                        <button type="submit" name="submit" class="btn bg-gradient-primary float-right mr-2"><i class="fa fa-save"> Ubah</i></button>
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
        $nama_pengeluaran = $_POST['nama_pengeluaran'];
        $tanggal_pengeluaran            = $_POST['tanggal_pengeluaran'];
        $total_pengeluaran  = $_POST['total_pengeluaran'];


        $submit = $koneksi->query("UPDATE pengeluaran SET  
                            nama_pengeluaran     = '$nama_pengeluaran',
                            tanggal_pengeluaran  = '$tanggal_pengeluaran',
                            total_pengeluaran    = '$total_pengeluaran'
                            WHERE 
                            id_pengeluaran = '$id'");

        if ($submit) {
            $_SESSION['pesan'] = "Data pengeluaran Diubah";
            echo "<script>window.location.replace('../pengeluaran/');</script>";
        }
    }

    ?>

</body>

</html>