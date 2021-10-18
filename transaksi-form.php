<?php
require "functions.php";
global $conn;
$mode = $_GET['mode'];
if ($mode == 'pinjam') {
    $judul = "PEMINJAMAN BUKU";
    $Transaksi = mysqli_query($conn, "SELECT kdtransaksi FROM tbtransaksi ORDER BY kdtransaksi DESC");
    $transaksi = mysqli_fetch_array($Transaksi);
    if (@$transaksi['kdtransaksi']) {
        $kd_transaksi = "TR" . (substr($transaksi['kdtransaksi'], 2) + 1);
    } else {
        $kd_transaksi = "TR" . date("y") . "0001";
    }
    $anggota = query("SELECT * FROM tbanggota WHERE statuss='Tidak Meminjam'");
    $buku = query("SELECT * FROM tbbuku WHERE statuss='Tersedia'");
} else {
    $judul = "PENGEMBALIAN BUKU";
    $id = $_GET['id'];
    $data = mysqli_query($conn, "SELECT * FROM tbtransaksi 
    JOIN tbanggota ON tbanggota.idanggota = tbtransaksi.idanggota
    JOIN tbbuku ON tbbuku.idbuku = tbtransaksi.idbuku
    WHERE idtransaksi = '$id'
");
    $val = mysqli_fetch_array($data);
    $kd_transaksi = $val['kdtransaksi'];
}

if (isset($_POST['simpan'])) {
    addTransaksi();
    echo "<script>alert('transaksi berhasil');
         document.location.href = 'index.php?page=transaksi-list';
         </script>";
}
?>
<style>
    select[readonly] {
        background: #eee;
        /*Simular campo inativo - Sugestão @GabrielRodrigues*/
        pointer-events: none;
        touch-action: none;
    }
</style>
<div class="container">
    <h3 class="text-center mb-4"><?= $judul ?></h3>
    <form action="" method="POST">
        <div class="row mb-3">
            <label for="foto" class="col-sm-2 col-form-label">ID Transaksi</label>
            <div class="col-sm-10">
                <input type="text" name="kd_transaksi" value="<?= @$kd_transaksi ?>" class="form-control" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="id_angoota" class="col-sm-2 col-form-label">Anggota</label>
            <div class="col-sm-10">
                <?php if ($mode == 'pinjam') : ?>
                    <select class="form-select" name="id_anggota" aria-label="Default select example">
                        <option selected>Pilih Data Anggota</option>
                        <?php foreach ($anggota as $value) : ?>
                            <option value="<?= $value['idanggota'] ?>"><?= $value['nama'] ?></option>
                        <?php endforeach ?>
                    </select>
                <?php else : ?>
                    <select readonly class="form-select" name="id_anggota" aria-label="Default select example">
                        <option value="<?= $val['idanggota'] ?>"><?= $val['nama'] ?></option>
                    </select>
                <?php endif ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="id_angoota" class="col-sm-2 col-form-label">Buku</label>
            <div class="col-sm-10">
                <?php if ($mode == 'pinjam') : ?>
                    <select class="form-select" name="id_buku" aria-label="Default select example">
                        <option selected>Pilih Data Buku</option>
                        <?php foreach ($buku as $value) : ?>
                            <option value="<?= $value['idbuku'] ?>"><?= $value['judulbuku'] ?></option>
                        <?php endforeach ?>
                    </select>
                <?php else : ?>
                    <select readonly class="form-select" name="id_buku" aria-label="Default select example">
                        <option value="<?= $val['idbuku'] ?>"><?= $val['judulbuku'] ?></option>
                    </select>
                <?php endif ?>
            </div>
        </div>

        <div class="row mb-3">
            <label for="buku" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
            <div class="col-sm-10">
                <input name="date_pinjam" readonly type="date" value="<?= date('Y-m-d', strtotime(date('Y/m/d'))) ?>" class="form-control" id="buku">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm('Apakah yakin data akan disimpan?')">simpan</button>
    </form>
</div>