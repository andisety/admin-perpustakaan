<?php
require "functions.php";
global $conn;
$halaman = 5;
$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbtransaksi 
JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku"));
$pages = ceil($total / $halaman);

$transaksi = mysqli_query($conn, "SELECT * FROM tbtransaksi 
JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku ORDER BY idtransaksi DESC LIMIT $mulai, $halaman ");
$no = $halaman * $page - 4;
$search = @$_POST['search'];
if (isset($_POST['cari'])) {
    if ($_POST['search'] != null) {
        $no = 1;
        $sql = "SELECT * FROM tbtransaksi 
        JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
        JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku WHERE tbtransaksi.kdtransaksi LIKE '%$search%'
        OR tbanggota.idanggota LIKE '%$search%' 
        OR tbanggota.nama LIKE '%$search%'
        OR tbbuku.idbuku LIKE '%$search%'
        OR tbbuku.judulbuku LIKE '%$search%'
        OR tbtransaksi.tanggal_pinjam LIKE '%$search%'
        OR tbtransaksi.tanggal_kembali LIKE '%$search%'
         ";
        $transaksi = mysqli_query($conn, $sql);
    } else {
        $no = $halaman * $page - 4;
        $transaksi = mysqli_query($conn, "SELECT * FROM tbtransaksi 
        JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
        JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku ORDER BY idtransaksi DESC LIMIT $mulai, $halaman  ");
    }
}

?>

<h3 class="text-center mb-2">TRANSAKSI</h3>
<div class="row">
    <div class="col-3">
        <a href="index.php?page=transaksi-form&mode=pinjam"><button type="button" class="btn btn-warning mb-1">Tambah Transaksi <i class="bi bi-person-plus-fill"></i></button></a>
        <h2 class="float-end"><a href="cetak-transaksi.php" target="_blank"><i class="bi bi-printer"></i></a></h2>
    </div>
    <div class="col">
        <div class="float-end">
            <form class="d-flex mb-1" action="" method="POST">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" id="search" aria-label="Search">
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
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal kembali</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        if (is_array($transaksi) || is_object($transaksi)) {
            foreach ($transaksi as $value) : ?>
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
                    <td>
                        <a href="cetak-nota.php?id=<?= $value['idtransaksi'] ?>" target="_blank"><span class="badge bg-success me-1">Cetak Nota <i class="bi bi-card-image"></i></span></a>
                        <?php if ($value['tanggal_kembali'] == '0000-00-00') : ?>
                            <a href="index.php?page=transaksi-form&mode=kembali&id=<?= $value['idtransaksi'] ?>"><span class="badge bg-primary me-1">Pengembalian <i class="bi bi-back"></i></i></span></a>
                        <?php else : ?>

                        <?php endif ?>
                    </td>
                </tr>
            <?php
                $no++;
            endforeach ?>
        <?php } ?>
    </tbody>
</table>
<p>Jumlah Data : <?= $total ?></p>
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example ms-auto">
        <ul class=" pagination">
            <?php if ($page > 1) : ?>
                <?php
                $previeous = $page - 1;
                ?>
                <li class="page-item"><a class="page-link" href="index.php?page=transaksi-list&&halaman=<?= $previeous ?>">Previous</a></li>
            <?php endif ?>
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <?php if ($i == $page) : ?>
                    <li class="page-item active"><a class="page-link" href="index.php?page=transaksi-list&&halaman=<?= $i ?>"><?= $i ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=transaksi-list&&halaman=<?= $i ?>"><?= $i ?></a></li>
                <?php endif ?>
            <?php endfor ?>
            <?php if ($page < $pages) : ?>
                <?php
                $next = $page + 1;
                ?>
                <li class="page-item"><a class="page-link" href="index.php?page=transaksi-list&&halaman=<?= $next ?>">Next</a></li>
            <?php endif ?>
        </ul>
    </nav>
</div>