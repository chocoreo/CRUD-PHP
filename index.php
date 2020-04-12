<?php
require_once("./Model/Bimbingan.php");
require_once("./Model/Mahasiswa.php");

$bim = new Bimbingan();
$mhs = new Mahasiswa();
$getMhs = $mhs->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1822250042</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        th {
            background-color: yellow;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="justify-content-center mt-2">
            <div class="nav nav-pills justify-content-center" id="nav-tab">
                <a class="nav-item nav-link active" id="nav-bimb-tab" data-toggle="tab" href="#nav-bimb" role="tab">Jadwal Bimbingan</a>
                <a class="nav-item nav-link" id="nav-mhs-tab" data-toggle="tab" href="#nav-mhs" role="tab">Daftar Mahasiswa</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-bimb" role="tabpanel">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#modelId">
                    Input Jadwal
                </button>
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Input Jadwal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="insertbimbingan.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        Nama Dosen
                                        <input type="text" name="dosen" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        Nama Mahasiswa
                                        <select name="mhs" class="form-control form-control-sm selectpicker" data-live-search="true">
                                            <?php
                                            foreach ($getMhs as $a) :
                                                $nm = $a['nama'];
                                            ?>
                                                <option value="<?= $nm ?>"><?= $nm ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Tanggal
                                        <input type="datetime-local" name="tgl" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        Materi Bimbingan
                                        <textarea name="materi" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="submitt" class="btn btn-sm btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="table">
                        <thead>
                            <tr>
                                <th class="font-weight-normal">No</th>
                                <th class="font-weight-normal">Nama Dosen</th>
                                <th class="font-weight-normal">Nama Mahasiswa</th>
                                <th class="font-weight-normal">Materi Bimbingan</th>
                                <th class="font-weight-normal">Tanggal Bimbingan</th>
                                <th class="font-weight-normal">Jam Bimbingan</th>
                                <th class="font-weight-normal">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($bim->getAll() as $a) {
                                $no++;
                            ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $no ?></t>
                                    <td><?= $a['dosen'] ?></td>
                                    <td><?= $a['mahasiswa'] ?></td>
                                    <td><?= $a['materi_bimbingan'] ?></td>
                                    <td class="align-middle text-center"><?= DATE("d-m-Y", strtotime($a['tgl_bimbingan'])) ?></td>
                                    <td class="align-middle text-center"><?= DATE("H:i:s", strtotime($a['tgl_bimbingan'])) ?></td>
                                    <td class="align-middle text-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatee<?= $a['id'] ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="updatee<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Jadwal Bimbingan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="updatebimbingan.php?id=<?= $a['id'] ?>" method="POST">
                                                        <div class="modal-body text-left">
                                                            <div class="form-group">
                                                                Dosen
                                                                <input type="text" name="dosen" class="form-control form-control-sm" value="<?= $a['dosen'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                Mahasiswa
                                                                <select name="mhs" class="form-control form-control-sm selectpicker" data-live-search="true">
                                                                    <option value="<?= $a['mahasiswa'] ?>" selected><?= $a['mahasiswa'] ?></option>
                                                                    <?php
                                                                    foreach ($getMhs as $b) {
                                                                        echo "<option value='$b[nama]'>$b[nama]</option>";
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                Tanggal Bimbingan
                                                                <input type="datetime-local" class="form-control form-control-sm" name="tgl" required>
                                                            </div>
                                                            <div class="form-group">
                                                                Materi
                                                                <textarea name="materi" class="form-control form-control-sm"><?= $a['materi_bimbingan'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="update" class="btn btn-sm btn-primary" value="Update">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="hapusbimbingan.php?id=<?= $a['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-mhs" role="tabpanel">
                <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#modelId2">
                    Input Data Mahasiswa
                </button>
                <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Input Data Mahasiswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="insertmhs.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        NPM
                                        <input type="number" class="form-control form-control-sm" name="npm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" />
                                    </div>
                                    <div class="form-group">
                                        Nama Mahasiswa
                                        <input type="text" name="nama" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        Tempat Lahir
                                        <input type="text" name="tempat" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        Tanggal Lahir
                                        <input type="date" name="tgl" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jk" value="L" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Laki-Laki
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jk" value="P">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-sm btn-primary" name="submit" value="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="table1">
                        <thead>
                            <th class="font-weight-normal">No</th>
                            <th class="font-weight-normal">NPM</th>
                            <th class="font-weight-normal">Nama</th>
                            <th class="font-weight-normal">Tempat Lahir</th>
                            <th class="font-weight-normal">Tanggal Lahir</th>
                            <th class="font-weight-normal">Jenis Kelamin</th>
                            <th class="font-weight-normal">Opsi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($getMhs as $dt) :
                                $no++;
                            ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $no ?></td>
                                    <td class="align-middle text-center"><?= $dt['npm'] ?></td>
                                    <td class="align-middle"><?= $dt['nama'] ?></td>
                                    <td class="align-middle text-center"><?= $dt['tempat_lahir'] ?></td>
                                    <td class="align-middle text-center"><?= $dt['tgl_lahir'] ?></td>
                                    <?php
                                    if ($dt['jk'] == "L") {
                                        echo "<td class='align-middle text-center'>Laki-Laki</td>";
                                    } else if ($dt['jk'] == "P") {
                                        echo "<td class='align-middle text-center'>Perempuan</td>";
                                    } else {
                                        echo "<td class='align-middle text-center'>Tidak terdefinisi</td>";
                                    }
                                    ?>
                                    <td class="align-middle text-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update<?= $dt['id'] ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="update<?= $dt['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Data Mahasiswa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="updatemhs.php?id=<?= $dt['id'] ?>" method="POST">
                                                        <div class="modal-body text-left">
                                                            <div class="form-group row">
                                                                <label for="nama" class="col-sm-4 col-form-label">NPM</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="npm" class="form-control form-control-sm" value="<?= $dt['npm'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="category" class="col-sm-4 col-form-label">Nama</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="nama" class="form-control form-control-sm" value="<?= $dt['nama'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="unit" class="col-sm-4 col-form-label">Tempat Lahir</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="tempat" class="form-control form-control-sm" value="<?= $dt['tempat_lahir'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="unit" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                                                <div class="col-sm-8">
                                                                    <input type="date" name="tgl" class="form-control form-control-sm" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                                                                    <div class="col-sm-8">
                                                                        <?php
                                                                        if ($dt['jk'] == "L") {
                                                                            echo "<div class='form-check'>
                                                                            <input class='form-check-input' type='radio' name='jk' value='L' checked>
                                                                            <label class='form-check-label' for='gridRadios1'>
                                                                                Laki-Laki
                                                                            </label>
                                                                        </div>
                                                                        <div class='form-check'>
                                                                            <input class='form-check-input' type='radio' name='jk' value='P'>
                                                                            <label class='form-check-label' for='gridRadios2'>
                                                                                Perempuan
                                                                            </label>
                                                                        </div>";
                                                                        } elseif ($dt['jk'] == "P") {
                                                                            echo "<div class='form-check'>
                                                                            <input class='form-check-input' type='radio' name='jk' value='L'>
                                                                            <label class='form-check-label' for='gridRadios1'>
                                                                                Laki-Laki
                                                                            </label>
                                                                        </div>
                                                                        <div class='form-check'>
                                                                            <input class='form-check-input' type='radio' name='jk' value='P' checked>
                                                                            <label class='form-check-label' for='gridRadios2'>
                                                                                Perempuan
                                                                            </label>
                                                                        </div>";
                                                                        } else {
                                                                            echo "<div class='form-check'>
                                                                            <input class='form-check-input' type='radio' name='jk' value='L'>
                                                                            <label class='form-check-label' for='gridRadios1'>
                                                                                Laki-Laki
                                                                            </label>
                                                                        </div>
                                                                        <div class='form-check'>
                                                                            <input class='form-check-input' type='radio' name='jk' value='P'>
                                                                            <label class='form-check-label' for='gridRadios2'>
                                                                                Perempuan
                                                                            </label>
                                                                        </div>";
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="update" class="btn btn-sm btn-primary" value="Update">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="hapusmhs.php?id=<?= $dt['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
            $('#table1').DataTable();
        });
        $(function() {
            $('select').selectpicker();
        });
    </script>
</body>

</html>