<?php
require_once("Model/Mahasiswa.php");
if (isset($_POST['update'])) {
    $mhs = new Mahasiswa();
    $id = $_GET['id'];
    $data = array(
        "nama"          => $_POST['nama'],
        'npm'           => $_POST['npm'],
        'tempat_lahir'  => $_POST['tempat'],
        'tgl_lahir'     => $_POST['tgl'],
        'jk'            => $_POST['jk']
    );
    $mhs->editMhs($id,$data);
    header('Location:index.php');
}
