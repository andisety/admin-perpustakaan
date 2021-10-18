<?php
$conn = mysqli_connect("localhost", "root", "", "dbpus");


function query($query)
{
    global $conn;
    $siswa = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($siswa)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah()
{
    $mode               = $_GET['mode'];
    global $conn;
    $kd_anggota         = $_POST["kd_anggota"];
    $nama               = $_POST["nama"];
    $jenis_kelamin      = $_POST["jenis_kelamin"];
    $alamat             = $_POST["alamat"];
    $nama_file          = $_FILES['foto']['name'];
    $foto_lama          = $_POST["foto_lama"];
    $foto_edit          = $_FILES['foto']['name'];
    $id_anggota         = @$_GET["id"];





    if ($mode == 'add') {
        if (!empty($nama_file)) {
            $lokasi_file    = $_FILES['foto']['tmp_name'];
            $tipe_file      = pathinfo($nama_file, PATHINFO_EXTENSION);
            $file_foto      = $kd_anggota . "." . $tipe_file;
            $folder         = "asset/image/$file_foto";
            move_uploaded_file($lokasi_file, $folder);
        } else {
            $file_foto = "default.png";
        }
        $sql = "INSERT INTO tbanggota VALUES('', '$nama', '$kd_anggota', '$jenis_kelamin', '$alamat', 'Tidak meminjam', '$file_foto' )";
        $query = mysqli_query($conn, $sql);
        return mysqli_affected_rows($conn);
    } else {
        if (!empty($foto_edit)) {
            $lokasi_file    = $_FILES['foto']['tmp_name'];
            $tipe_file      = pathinfo($foto_edit, PATHINFO_EXTENSION);
            $foto_edit      = $id_anggota . "." . $tipe_file;
            $folder         = "asset/image/$foto_edit";
            move_uploaded_file($lokasi_file, $folder);
        } else {
            $foto_edit = $foto_lama;
        }

        $sql = "UPDATE tbanggota SET nama = '$nama',
                                        kdanggota   = '$kd_anggota',
                                        jeniskelamin= '$jenis_kelamin',
                                        alamat      = '$alamat',
                                        foto        = '$foto_edit' WHERE idanggota = '$id_anggota'";
        $query = mysqli_query($conn, $sql);
        return mysqli_affected_rows($conn);
    }
}

function login()
{
    global $conn;
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        $username = "-";
    } elseif (empty($password)) {
        $password = "-";
    }

    $sql = "SELECT * FROM tbadmin WHERE username = '$username'";
    $check = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($check);
    if ($admin == null) {
        return false;
    } else {
        if ($password === $admin['password']) {
            return true;
        } else {
            return false;
        }
    }
}

function addTransaksi()
{
    global $conn;
    $mode = $_GET['mode'];
    $id = @$_GET['id'];

    $kd_transaksi = $_POST['kd_transaksi'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $date_pinjam = date("Y-m-d");
    $date_kembali = date("Y-m-d");
    if ($mode == 'pinjam') {
        //add transaksi

        mysqli_query($conn, "INSERT INTO tbtransaksi VALUES('','$kd_transaksi', '$id_anggota', '$id_buku', '$date_pinjam','')");

        //update status
        mysqli_query($conn, "UPDATE tbanggota SET statuss='Meminjam' WHERE idanggota ='$id_anggota'");

        mysqli_query($conn, "UPDATE tbbuku SET statuss='Dipinjam' WHERE idbuku ='$id_buku'");
    } else {
        //upgrade transaksi
        mysqli_query($conn, "UPDATE tbtransaksi SET tanggal_kembali = '$date_kembali' WHERE idtransaksi = '$id'");

        //update status
        mysqli_query($conn, "UPDATE tbanggota SET statuss='Tidak Meminjam' WHERE idanggota ='$id_anggota'");

        mysqli_query($conn, "UPDATE tbbuku SET statuss='Tersedia' WHERE idbuku ='$id_buku'");
    }
}

function tambah_buku()
{
    global $conn;
    $mode              = $_GET['mode'];
    $id                = @$_GET["id"];
    $kd_buku           = $_POST["kd_buku"];
    $judul             = $_POST["judul_buku"];
    $kategori          = $_POST["kategori"];
    $pengarang         = $_POST["pengarang"];
    $penerbit          = $_POST["penerbit"];

    if ($mode == 'add') {
        $query = "INSERT INTO tbbuku VALUES('', '$kd_buku', '$judul', '$kategori', '$pengarang', '$penerbit', 'Tersedia')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        $query = "UPDATE tbbuku SET 
        kdbuku='$kd_buku',
        judulbuku= '$judul',
        kategori= '$kategori',
        pengarang= '$pengarang',
        penerbit= '$penerbit',
        statuss= 'Tersedia' WHERE idbuku= '$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}
