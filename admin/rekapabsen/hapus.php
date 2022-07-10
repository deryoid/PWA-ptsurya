<?php

require '../../config/config.php';
require '../../config/koneksi.php';

$id    = $_GET['id'];
$hapus = $koneksi->query("DELETE FROM rekapabsen WHERE id_rekapabsen = '$id'");

if ($hapus) {
   $_SESSION['pesan'] = "Rekap Absen Berhasil dihapus";
   echo "<script>window.location.replace('../rekapabsen/');</script>";
}
