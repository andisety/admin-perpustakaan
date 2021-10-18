<?php
require "functions.php";
global $conn;
$mode = $_GET['mode'];
if ($mode == 'add') {
    $judul = "FORM TAMBAH DATA ANGGOTA";
    $query = mysqli_query($conn, "SELECT kdanggota FROM tbanggota ORDER BY kdanggota DESC");
    $anggota = mysqli_fetch_array($query);
    if (@$anggota['kdanggota']) {
        $kdanggota = "AG" . (substr($anggota['kdanggota'], 2) + 1);
    } else {
        $kdanggota = "AG" . date("y") . "0001";
    }
} else {
    $judul = "FORM EDIT DATA ANGGOTA";
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tbanggota WHERE idanggota = '$id'");
    $anggota = mysqli_fetch_assoc($query);
}

if (isset($_POST["tambah"])) {

    if (tambah() > 0) {
        echo "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'index.php?page=anggota-list';
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
        <a href="index.php?page=anggota-list"><span class="badge bg-primary me-1">back </span></a>
        <div class="row mb-3">
            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                <?php if ($mode == 'edit') : ?>
                    <img id="blah" src="asset/image/<?= @$anggota['foto'] ?>" width="100px" class="img-edit">
                <?php else : ?>
                    <img id="blah" src="" width="100px" class="img-edit">
                <?php endif ?>
                <input type="file" id="gambar" name="foto" class="form-control mt-3" id="foto">
                <input type="hidden" id="gambar" name="foto_lama" value="<?= $anggota['foto'] ?>" class="form-control mt-3" id="foto">
            </div>
        </div>
        <div class="row mb-3">
            <label for="id_angoota" class="col-sm-2 col-form-label">ID Anggota</label>
            <div class="col-sm-10">
                <?php if ($mode == 'add') : ?>
                    <input type="text" value="<?= @$kdanggota ?>" name="kd_anggota" class="form-control" id="kd_anggota" readonly>
                <?php else : ?>
                    <input type="text" value="<?= @$anggota['kdanggota'] ?>" name="kd_anggota" class="form-control" id="kd_anggota" readonly>
                <?php endif ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">

                <input type="text" name="nama" value="<?= @$anggota['nama'] ?>" class="form-control" id="nama" required>
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1" value="pria" <?= (@$anggota['jeniskelamin']) == 'pria' ? "checked" : "" ?>>
                    <label class="form-check-label" for="gridRadios1">
                        Pria
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2" value="wanita" <?= (@$anggota['jeniskelamin']) == 'wanita' ? "checked" : "" ?>>
                    <label class="form-check-label" for="gridRadios2">
                        Wanita
                    </label>
                </div>
            </div>
        </fieldset>
        <div class="row mb-3">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <div class="form-floating">
                    <textarea class="form-control" name="alamat"><?= @$anggota['alamat']  ?></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="tambah" onclick="return confirm('Apakah yakin data akan ditambahkan?')">Tambah</button>
    </form>
</div>
<script src="asset/js/jquery-3.6.0.min.js">
</script>
<script>
    function readUrl(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#blah").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0])
        }
    }
    $("#gambar").change(function() {
        readUrl(this);
    })
</script>