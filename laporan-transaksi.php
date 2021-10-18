<?php
require "functions.php";

global $conn;

$mode = $_GET['mode'];
if ($mode == 'pinjam') {
    $judul = "TRANSAKSI PEMINJAMAN";
    $query = mysqli_query($conn, "SELECT * FROM tbtransaksi 
    JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
    JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku WHERE tanggal_pinjam !='0000-00-00'
");
} else {
    $judul = "TRANSAKSI PENGEMBALIAN";
    $query = mysqli_query($conn, "SELECT * FROM tbtransaksi 
    JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
    JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku WHERE tanggal_kembali !='0000-00-00'
");
}


?>

<h3 class="text-center mb-2"><?= $judul ?></h3>
<div class="row">
    <div class="col-3">
        <a href="index.php?page=anggota-form&mode=add"><button type="button" class="btn btn-warning mb-1">Tambah Anggota <i class="bi bi-person-plus-fill"></i></button></a>
        <h2 class="float-end"><a href="cetak-laporan.php?mode=<?= $mode ?>" target="_blank"><i class="bi bi-printer"></i></a></h2>
    </div>
    <div class="col">
        <div class="float-end">
            <form class="d-flex mb-1" action="" method="POST">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" id="search" aria-label="Search">
                <button class="btn btn-outline-success" name="cari" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped text-center">
    <thead class="table-dark ">
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Transaksi</th>
            <th scope="col">ID Anggota</th>
            <th scope="col">Nama</th>
            <th scope="col">ID Buku</th>
            <th scope="col">Judul Buku</th>
            <?php if ($mode == 'pinjam') : ?>
                <th scope="col">Tanggal Peminjaman</th>
            <?php else : ?>
                <th scope="col">Tanggal Pengembalian</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($query as $value) : ?>
            <tr>
                <th scope="row"><?= $no  ?></th>
                <td><?= $value['kdtransaksi'] ?></td>
                <td><?= $value['kdanggota'] ?></td>
                <td><?= $value['nama'] ?></td>
                <td><?= $value['kdbuku'] ?></td>
                <td><?= $value['judulbuku'] ?></td>
                <?php if ($mode == 'pinjam') : ?>
                    <td><?= $value['tanggal_pinjam'] ?></td>
                <?php else : ?>
                    <td><?= $value['tanggal_kembali'] ?></td>
                <?php endif ?>
            </tr>
        <?php $no++;
        endforeach ?>
    </tbody>
</table>