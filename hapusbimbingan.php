<?php
include("./Model/Bimbingan.php");
$bim = new Bimbingan();
$id = $_GET['id'];
$delete = $bim->delete($id);
if (!$delete) {
    echo "<script>alert('Data tidak ada yang dihapus'); window.location='index.php';</script>";
} else {
    header('Location:index.php');
}
