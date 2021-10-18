<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <title>cetak laporan</title>
</head>

<body>
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
    <table class="table table-bordered  text-center">
        <thead class="">
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
    <script>
        window.print()
    </script>
</body>

</html>