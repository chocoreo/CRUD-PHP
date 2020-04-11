<?php
require_once("Model/Bimbingan.php");
if (isset($_POST['update'])) {
    $bimb = new Bimbingan();
    $id = $_GET['id'];
    $data = array(
        "mahasiswa"           => $_POST['mhs'],
        "dosen"               => $_POST['dosen'],
        "tgl_bimbingan"       => $_POST['tgl'],
        "materi_bimbingan"    => $_POST['materi']
    );
    $bimb->editBimbingan($id, $data);
    header('Location:index.php');
} else {
    echo "<script>alert('Data tidak diupdate'); window.location='index.php';</script>";
}
 