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
    <!-- <img src="<?= base_url('assets/dist/img/istana-print.png') ?>" align="left" width="90" height="90">
<img src="<?= base_url('assets/dist/img/blank.jpg') ?>" align="right" width="90" height="90">
  <p align="center"><b>
    <font size="5">ISTANA PRINT</font><br>
    <font size="3">
        Jl. Bridgen H. Hasan Basri, kayutangi (Samping ALFAMART) <br>
        Telp : 0812 5834 9128 - 0858 2821 1851 <br>
        Email : istanaprintkayutangi@gmail.com
    </font>
    <hr size="2px" color="black">
  </b></p> -->

    Cetak : <?= $_SESSION['username'] ?>
    <div style="float: right;">
        Tanggal Cetak :
        <?= tgl_indo(date('Y-m-d')) ?> <br>
        Halaman : 1
    </div>

    <br>
    <div style="text-align: center; font-size: 18;">
        Rekap Absen Karyawan
    </div>
    <br>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" width="100%">
                    <thead class="bg-green">
                        <tr align="center">
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Periode</th>
                            <th>Absensi</th>
                        </tr>
                    </thead>
                    <?php
                    function rupiah($angka)
                    {
                        $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
                        return $hasil;
                    }
                    $no = 1;
                    $data = $koneksi->query("SELECT * FROM rekapabsen AS ra
                                            LEFT JOIN karyawan AS k ON ra.id_karyawan = k.id_karyawan
                                            ORDER BY ra.id_rekap DESC");
                    while ($row = $data->fetch_array()) {
                    ?>
                        <tbody >
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td>
                                    Nama Karyawan : <?= $row['nama_karyawan'] ?><br>
                                    Bidang : <?= $row['bidang'] ?><br>
                                    Jabatan : <?= $row['jabatan'] ?><br>
                                    Gaji Pokok : <?= rupiah($row['gaji_karyawan']) ?>
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
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
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