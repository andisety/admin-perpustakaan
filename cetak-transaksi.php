<?php
session_start();
if ($_SESSION['login'] != true) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cetak transaksi</title>
</head>

<body>
    <?php
    require "functions.php";
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM tbtransaksi 
    JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
    JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku
");
    ?>

    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Transaksi</th>
                    <th scope="col">ID Anggota</th>
                    <th scope="col">Nama</th>
                    <th scope="col">ID Buku</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal kembali</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($query as $value) : ?>
                    <tr>
                        <th scope="row"><?= $no  ?></th>
                        <td><?= $value['kdtransaksi'] ?></td>
                        <td><?= $value['kdanggota'] ?></td>
                        <td><?= $value['nama'] ?></td>
                        <td><?= $value['kdbuku'] ?></td>
                        <td><?= $value['judulbuku'] ?></td>
                        <td><?= $value['tanggal_pinjam'] ?></td>
                        <td><?php
                            if ($value['tanggal_kembali'] == '0000-00-00') {
                                echo "Belum Dikembalikan";
                            } else {
                                echo $value['tanggal_kembali'];
                            } ?></td>
                    </tr>
                <?php
                    $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>