<?php
require_once("Model/Bimbingan.php");
if (isset($_POST['submitt'])) {
    $bimb = new Bimbingan();
    $data = array(
        "mahasiswa"           => $_POST['mhs'],
        "dosen"          => $_POST['dosen'],
        "tgl_bimbingan"  =>  $_POST['tgl'],
        "materi_bimbingan" => $_POST['materi']
    );
    $bimb->addBimbingan($data);
    header('Location:index.php');
}
