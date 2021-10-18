<?php
require "functions.php";
$halaman = 5;
$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbanggota"));
$pages = ceil($total / $halaman);

$siswa = mysqli_query($conn, "SELECT * FROM tbanggota ORDER BY idanggota DESC LIMIT $mulai, $halaman ");
$no = $halaman * $page - 4;
$search = @$_POST['search'];
if (isset($_POST['cari'])) {
    if ($_POST['search'] != null) {
        $no = 1;
        $sql = "SELECT * FROM tbanggota WHERE kdanggota LIKE '%$search%' OR nama LIKE '%$search%' OR alamat LIKE '%$search%' ";
        $siswa = mysqli_query($conn, $sql);
    } else {
        $no = $halaman * $page - 4;
        $siswa = mysqli_query($conn, "SELECT * FROM tbanggota ORDER BY idanggota DESC LIMIT $mulai, $halaman ");
    }
}



?>
<div class="row">
    <div class="col-12">
        <h3 class="text-center mb-2"> DATA ANGGOTA</h3>
        <div class="row">
            <div class="col-3">
                <a href="index.php?page=anggota-form&mode=add"><button type="button" class="btn btn-warning mb-1">Tambah Anggota <i class="bi bi-person-plus-fill"></i></button></a>
                <h2 class="float-end"><a href="cetak-anggota.php" target="_blank"><i class="bi bi-printer"></i></a></h2>
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
        <div id="container">
            <table class="table  table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Anggota</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                        <th id="opsi" scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($siswa as $value) : ?>
                        <tr>
                            <th scope="row"><?= @$no  ?></th>
                            <td><?= $value["kdanggota"] ?></td>
                            <td><?= $value["nama"] ?></td>
                            <td style="height: 100px" class="d-flex justify-content-center">
                                <img src="asset/image/<?= $value['foto'] ?>" alt="foto">
                            </td>
                            <td><?= $value["jeniskelamin"] ?></td>
                            <td><?= $value["alamat"] ?></td>
                            <td><?= $value["statuss"] ?></td>
                            <td>
                                <div id="opsia" class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                                    <a href="cetak-kartu.php?id=<?= $value['idanggota'] ?>" target="_blank"><span class="badge bg-primary me-1">Cetak Kartu <i class="bi bi-card-image"></i></span></a>
                                    <a href="index.php?page=anggota-form&mode=edit&id=<?= $value['idanggota'] ?>"><span class="badge bg-success me-1">Edit <i class="bi bi-pencil-square"></i></span></a>
                                    <a href="hapus.php?id=<?= $value['idanggota'] ?>del=anggota"><span onclick="return alert('yakin mau dihapus?')" class="badge bg-danger">Hapus <i class="bi bi-x-circle-fill"></i></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php @$no++ ?>
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
                            <li class="page-item"><a class="page-link" href="index.php?page=anggota-list&&halaman=<?= $previeous ?>">Previous</a></li>
                        <?php endif ?>
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <?php if ($i == $page) : ?>
                                <li class="page-item active"><a class="page-link" href="index.php?page=anggota-list&&halaman=<?= $i ?>"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=anggota-list&&halaman=<?= $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>
                        <?php if ($page < $pages) : ?>
                            <?php
                            $next = $page + 1;
                            ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=anggota-list&&halaman=<?= $next ?>">Next</a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>