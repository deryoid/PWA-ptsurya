<?php

require '../../config/config.php';
require '../../config/koneksi.php';

$id    = $_GET['id'];
$hapus = $koneksi->query("DELETE FROM detail_pemesanan WHERE id_dp = '$id'");

if ($hapus) {
   $_SESSION['pesan'] = "Barang/Katalog Berhasil dihapus";
   echo "<script>window.history.back();</script>";
}
