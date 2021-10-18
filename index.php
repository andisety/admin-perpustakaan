<?php
session_start();
if (!$_SESSION['login'] === true) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: blanchedalmond;
        }

        #sampul {
            background-image: url("asset/image/bg1.PNG");
        }

        .box {
            margin: 10px;
            background-color: #ffffff;
            border: 1px solid white;
            opacity: 0.6;
        }

        .box h1 {
            font-weight: bold;
            color: #000000;
        }
    </style>
    <title><?= $_GET['page']  ?></title>
</head>

<body>
    <div id="sampul" class=" mb-5 fixed-top ">
        <div class="box">
            <div class="p">
                <h1 class=" text-center text-dark">PERPUSTAKAAN UMUM</h1>
                <p class="text-center ">Jl. Lembah Abang No 11, Telp: (021)55555</p>
            </div>
        </div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark shadow  ">
            <div class="container  ">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto  mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?page=beranda">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Data Master
                            </a>
                            <ul class="dropdown-menu  bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-light" href="index.php?page=anggota-list">Data Anggota</a></li>
                                <li><a class="dropdown-item text-light" href="index.php?page=buku-list"> Data Buku</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?page=transaksi-list">Transaksi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-light" href="index.php?page=laporan-transaksi&mode=pinjam">Peminjaman</a></li>
                                <li><a class="dropdown-item text-light" href="index.php?page=laporan-transaksi&mode=kembali">Pengembalian</a></li>
                            </ul>
                        </li>
                        <li class="nav-item me-auto">
                            <a onclick="return confirm('yakin mau logout ?')" class=" nav-link active" aria-current="page" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div><br><br><br><br><br><br><br>
    <div class="container-fluid ">
        <div class="row pt-2">
            <div class="col-12 ">
                <?php
                if (@$_GET['page']) {
                    $page = $_GET['page'];
                    include $page . ".php";
                } else {
                    include "beranda.php";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>