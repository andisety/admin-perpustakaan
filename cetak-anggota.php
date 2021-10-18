<?php
require "functions.php";

session_start();
if ($_SESSION['login'] != true) {
    header("Location: login.php");
}

$sql = "SELECT * FROM tbanggota";
$siswa = query($sql);

?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID Anggota</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($siswa as $value) : ?>
                <tr>
                    <th scope="row"><?= $no ?></th>
                    <td><?= $value["kdanggota"] ?></td>
                    <td><?= $value["nama"] ?></td>
                    <td><?= $value["jeniskelamin"] ?></td>
                    <td><?= $value["alamat"] ?></td>
                    <td><?= $value["statuss"] ?></td>
                </tr>
                <?php $no++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    window.print()
</script>