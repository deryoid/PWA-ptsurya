<?php
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../config/day.php';

$bln = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);

?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN DATA </title>
</head>

<body>
  Cetak : <?= $_SESSION['username'] ?>
  <div style="float: right;">
    Tanggal Cetak :
    <?= tgl_indo(date('Y-m-d')) ?> <br>
    Halaman : 1
  </div>

  <br>
  <h3 style="text-align: center;">Laporan Daftar Pemesanan</h3>
  
                <table border="1" cellspacing="0" width="100%">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama Pengeluaran</th>
                            <th>Tanggal Pesananan</th>
                            <th>Total Pengeluaran</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        $no = 1;
                        $data = $koneksi->query("SELECT * FROM pengeluaran ORDER BY id_pengeluaran DESC");
                        while ($row = $data->fetch_array()) {
                    ?>
                        <tr align="center">
                        <td><?= $no++;?></td>
                        <td><?= $row['nama_pengeluaran'] ?></td>
                        <td><?= tgl_indo($row['tanggal_pengeluaran']) ?></td>
                        <td><?= $row['total_pengeluaran'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
    <br>

    </div>

    </div>
    <div style="text-align: center; display: inline-block; float: right;">
  <h5>
    Banjarmasin <?php echo tgl_indo(date('Y-m-d')); ?><br>
    
    <br><br><br><br>
  </h5>

</div>

</body>

</html>