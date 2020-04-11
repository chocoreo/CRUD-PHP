<?php
require_once("Model/Mahasiswa.php");
$mhs = new Mahasiswa();
$id = $_GET['id'];
$delete = $mhs->delete($id);
if (!$delete) {
    echo "<script>alert('Data tidak ada yang dihapus'); window.location='index.php';</script>";
} else {
    header('Location:index.php');
}