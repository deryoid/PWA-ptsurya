<?php
include '../config/config.php';
include '../config/koneksi.php';

$no =1;
$tglmulai   = $_POST['tglmulai'];
$tglselesai = $_POST['tglselesai'];
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


    Cetak : <?= $_SESSION['username'] ?><br>
    Laporan Dari : <?= tgl_indo($tglmulai) ?> S/d <?= tgl_indo($tglselesai) ?> 
    <div style="float: right;">
        Tanggal Cetak :
        <?= tgl_indo(date('Y-m-d')) ?> <br>
        Halaman : 1
    </div>
    
  <br>
  <h3 style="text-align: center;">Laporan Arus Kas</h3>
  <h4 style="text-align: left;">Pemasukkan</h4>
    <div class="row">
        <div class="col-sm-12">
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
                WHERE (tanggal_pesan BETWEEN '$tglmulai' AND '$tglselesai')
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
            <tfoot>
                <tr>
                    <th colspan="8" style="text-align:right;">Jumlah :</th>
                    <th> <?php $tot = $koneksi->query("SELECT SUM(total) AS totalsel FROM detail_pemesanan AS
                    dp LEFT JOIN pemesanan AS p ON dp.id_pemesanan = p.id_pemesanan
                     WHERE (p.tanggal_pesan BETWEEN '$tglmulai' AND '$tglselesai')")->fetch_array(); echo  $tot['totalsel']; ?></th>
                </tr>
            </tfoot>
                </table>
        </div>
        <br>
        <hr>
        <br>
        <h4 style="text-align: left;">Pengeluaran</h4>
        <div class="col-sm-12">
        <table border="1" cellspacing="0" width="100%">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Pengeluaran</th>
                        <th>Tanggal Pesananan</th>
                        <th>Total Pengeluaran</th>
                    </tr>
                </thead>
                    <tbody style="background-color: azure">
                <?php
                $no = 1;
                $data = $koneksi->query("SELECT * FROM pengeluaran 
                WHERE (tanggal_pengeluaran BETWEEN '$tglmulai' AND '$tglselesai')
                ");
                while ($row = $data->fetch_array()) {
                ?>
                        <tr>
                            <td align="center"><?= $no++ ?></td>
                            <td><?= $row['nama_pengeluaran'] ?></td>
                        <td><?= tgl_indo($row['tanggal_pengeluaran']) ?></td>
                        <td><?= $row['total_pengeluaran'] ?></td>
                            
                        </tr>
                <?php } ?>
                    </tbody>
                    <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right;">Jumlah :</th>
                    <th> <?php $totpeng = $koneksi->query("SELECT SUM(total_pengeluaran) AS totalpel FROM pengeluaran WHERE (tanggal_pengeluaran BETWEEN '$tglmulai' AND '$tglselesai')")->fetch_array(); echo  $totpeng['totalpel']; ?></th>
                </tr>
            </tfoot>
                </table>
        </div>
    </div>
    <br>
    <h2> Keuntungan :
    <b><?php  
                    $untung = $tot['totalsel'] - $totpeng['totalpel'] ; 
                    echo $untung; ?></b></h2>
    
                

    </div>

    </div>
    <div style="text-align: center; display: inline-block; float: right;">
    
    <div style="text-align: center; display: inline-block; float: right;">
  <h5>
    Banjarmasin <?php echo tgl_indo(date('Y-m-d')); ?><br>
    
    <!-- <br><br><br><br>
    Istana Print -->
  </h5>
</div>

</body>

</html>

<script>
    <?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }

    ?>
</script>