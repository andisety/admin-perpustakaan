<?php
include "functions.php";
session_start();
if (!$_SESSION['login'] === true) {
    header("Location: login.php");
}
$id_anggota = $_GET['id'];
$sql = "SELECT * FROM tbanggota WHERE idanggota = '$id_anggota'";
$cetak = query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cetak kartu</title>
    <style>
        div {
            width: 400px;
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div>
        <h1>Kartu Anggota</h1>
        <table>
            <tr>
                <TD>FOTO</TD>
                <TD> <img src="asset/image/<?= $cetak[0]['foto'] ?>" alt="" width="70px"></TD>
            </tr>
            <tr>
                <TD>ID Anggota</TD>
                <TD> : <?= $cetak[0]['kdanggota'] ?></TD>
            </tr>
            <tr>
                <TD>Nama</TD>
                <TD> : <?= $cetak[0]['nama'] ?></TD>
            </tr>
            <tr>
                <TD>Alamat</TD>
                <TD> : <?= $cetak[0]['alamat'] ?></TD>
            </tr>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>