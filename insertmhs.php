<?php
require_once("Model/Mahasiswa.php");
if (isset($_POST['submit'])) {
    $mhs = new Mahasiswa();
    $data = array(
        "nama"          => $_POST['nama'],
        'npm'           => $_POST['npm'],
        'tempat_lahir'  => $_POST['tempat'],
        'tgl_lahir'     => $_POST['tgl'],
        'jk'            => $_POST['jk']
    );
    $mhs->addMhs($data);
    header('Location:index.php');
}
