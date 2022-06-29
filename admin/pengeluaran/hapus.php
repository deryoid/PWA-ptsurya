<?php

require '../../config/config.php';
require '../../config/koneksi.php';

$id    = $_GET['id'];
$hapus = $koneksi->query("DELETE FROM pengeluaran WHERE id_pengeluaran = '$id'");

if ($hapus) {
   $_SESSION['pesan'] = "pengeluaran Berhasil dihapus";
   echo "<script>window.location.replace('../pengeluaran/');</script>";
}
