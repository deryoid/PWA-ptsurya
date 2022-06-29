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