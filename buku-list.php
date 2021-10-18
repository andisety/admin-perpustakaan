<?php
require "functions.php";

$halaman = 5;
$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbbuku"));
$pages = ceil($total / $halaman);

$buku = mysqli_query($conn, "SELECT * FROM tbbuku ORDER BY idbuku DESC LIMIT $mulai, $halaman ");
$no = $halaman * $page - 4;
$search = @$_POST['search'];
if (isset($_POST['cari'])) {
    if ($_POST['search'] != null) {
        $no = 1;
        $sql = "SELECT * FROM tbbuku WHERE kdbuku LIKE '%$search%'
        OR judulbuku LIKE '%$search%' 
        OR kategori LIKE '%$search%'
        OR pengarang LIKE '%$search%'
        OR penerbit LIKE '%$search%'
        OR statuss LIKE '%$search%'
         ";
        $buku = mysqli_query($conn, $sql);
    } else {
        $no = $halaman * $page - 4;
        $buku = mysqli_query($conn, "SELECT * FROM tbbuku ORDER BY idbuku DESC LIMIT $mulai, $halaman ");
    }
}

?>


<div class="row">
    <div class="col-12">
        <h3 class="text-center mb-3"> DATA BUKU</h3>
        <div class="row">
            <div class="col-3">
                <a href="index.php?page=buku-form&mode=add"><button type="button" class="btn btn-warning mb-1">Tambah Buku <i class="bi bi-person-plus-fill"></i></button></a>
                <h2 class="float-end"><a href="cetak-buku.php" target="_blank"><i class="bi bi-printer"></i></a></h2>
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
        <div id="container">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Pengarang</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">status</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($buku as $value) : ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $value["kdbuku"] ?></td>
                            <td><?= $value["judulbuku"] ?></td>
                            <td><?= $value["kategori"] ?></td>
                            <td><?= $value["pengarang"] ?></td>
                            <td><?= $value["penerbit"] ?></td>
                            <td><?= $value["statuss"] ?></td>
                            <td>
                                <div id="opsia" class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                                    <a href="index.php?page=buku-form&mode=edit&id=<?= $value['idbuku'] ?>"><span class="badge bg-success me-1">Edit <i class="bi bi-pencil-square"></i></span></a>
                                    <a href="hapus.php?id=<?= $value['idbuku'] ?>&del=buku"><span onclick="return alert('yakin mau dihapus?')" class="badge bg-danger">Hapus <i class="bi bi-x-circle-fill"></i></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php $no++ ?>
                    <?php endforeach ?>
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
                            <li class="page-item"><a class="page-link" href="index.php?page=buku-list&&halaman=<?= $previeous ?>">Previous</a></li>
                        <?php endif ?>
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <?php if ($i == $page) : ?>
                                <li class="page-item active"><a class="page-link" href="index.php?page=buku-list&&halaman=<?= $i ?>"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=buku-list&&halaman=<?= $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>
                        <?php if ($page < $pages) : ?>
                            <?php
                            $next = $page + 1;
                            ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=buku-list&&halaman=<?= $next ?>">Next</a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>