<?php
require "functions.php";

session_start();
if ($_SESSION['login'] != true) {
    header("Location: login.php");
}

$sql = "SELECT * FROM tbbuku";
$siswa = query($sql);

?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Buku</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Kategori</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($siswa as $value) : ?>
                <tr>
                    <th scope="row"><?= $no ?></th>
                    <td><?= $value["kdbuku"] ?></td>
                    <td><?= $value["judulbuku"] ?></td>
                    <td><?= $value["kategori"] ?></td>
                    <td><?= $value["pengarang"] ?></td>
                    <td><?= $value["penerbit"] ?></td>
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