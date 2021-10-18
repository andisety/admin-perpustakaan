<?php
require "functions.php";

session_start();
if ($_SESSION['login'] != true) {
    header("Location: login.php");
}

global $conn;
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tbtransaksi 
    JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
    JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku WHERE idtransaksi = '$id'
");
$value = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3 class="text-center mb-5">TRANSAKSI</h3>
    <table>
        <tr>
            <td scope="col">ID Transaksi</td>
            <td>: <?= $value['kdtransaksi'] ?></td>
        </tr>
        <tr>
            <td scope="col">ID Anggota</td>
            <td>: <?= $value['kdanggota'] ?></td>
        </tr>
        <tr>
            <td scope="col">Nama</td>
            <td>: <?= $value['nama'] ?></td>
        </tr>
        <tr>
            <td scope="col">ID Buku</td>
            <td>: <?= $value['kdbuku'] ?></td>
        </tr>
        <tr>
            <td scope="col">Judul Buku</td>
            <td>: <?= $value['judulbuku'] ?></td>
        </tr>
        <tr>
            <td scope="col">Tanggal Pinjam</td>
            <td>: <?= $value['tanggal_pinjam'] ?></td>
        </tr>
        <tr>
            <td scope="col">Tanggal Kembali</td>
            <td scope="col">: <?= ($value['tanggal_kembali'] == '0000-00-00') ? 'Belum Dikembalikan' : $value['tanggal_kembali'] ?></td>

        </tr>

    </table>
    <script>
        window.print()
    </script>
</body>

</html>