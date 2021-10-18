<?php
require "functions.php";
global $conn;
$mode = $_GET['mode'];
if ($mode == 'add') {
    $judul = "FORM TAMBAH DATA BUKU";
    $query = mysqli_query($conn, "SELECT kdbuku FROM tbbuku ORDER BY kdbuku DESC");
    $buku = mysqli_fetch_array($query);
    if (@$buku['kdbuku']) {
        $kdbuku = "BK" . (substr($buku['kdbuku'], 2) + 1);
    } else {
        $kdbuku = "BK" . date("y") . "0001";
    }
} else {
    $judul = "FORM EDIT DATA BUKU";
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tbbuku WHERE idbuku = '$id'");
    $buku = mysqli_fetch_assoc($query);
}

if (isset($_POST["tambah"])) {

    if (tambah_buku() > 0) {
        echo "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'index.php?page=buku-list';
        </script>";
    } else {
        echo "<script>
        alert('data gagal ditambahkan');
        </script>
        ";
    }
}
?>

<div class="container">
    <h3 class="text-center mb-5"><?= $judul  ?></h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <a href="index.php?page=buku-list"><span class="badge bg-primary me-1">back </span></a>
        <div class="row mb-3">
            <label for="id_angoota" class="col-sm-2 col-form-label">Kode Buku</label>
            <div class="col-sm-10">
                <?php if ($mode == 'add') : ?>
                    <input type="text" value="<?= @$kdbuku ?>" name="kd_buku" class="form-control" id="kd_anggota" readonly>
                <?php else : ?>
                    <input type="text" value="<?= @$buku['kdbuku'] ?>" name="kd_buku" class="form-control" id="kd_anggota" readonly>
                <?php endif ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Judul Buku</label>
            <div class="col-sm-10">
                <input type="text" name="judul_buku" value="<?= @$buku['judulbuku'] ?>" class="form-control" id="nama" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <input type="text" name="kategori" value="<?= @$buku['kategori'] ?>" class="form-control" id="nama" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Pengarang</label>
            <div class="col-sm-10">
                <input type="text" name="pengarang" value="<?= @$buku['pengarang'] ?>" class="form-control" id="nama" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Penerbit</label>
            <div class="col-sm-10">
                <input type="text" name="penerbit" value="<?= @$buku['penerbit'] ?>" class="form-control" id="nama" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="tambah" onclick="return confirm('Apakah yakin data akan ditambahkan?')">Tambah</button>
    </form>
</div>