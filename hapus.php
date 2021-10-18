<?php
require "functions.php";
$id = $_GET['id'];
$del = @$_GET['del'];
if ($del == 'anggota') {
    $sql = "DELETE FROM tbanggota WHERE idanggota = '$id'";
    mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            alert('data berhasil hapus');
            document.location.href = 'index.php?page=anggota-list';
            </script>";
    } else {
        echo "<script>
        alert('data gagal dihapus');
        </script>";
    }
} else {
    $sql = "DELETE FROM tbbuku WHERE idbuku = '$id'";
    mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            alert('data berhasil hapus');
            document.location.href = 'index.php?page=buku-list';
            </script>";
    } else {
        echo "<script>
        alert('data gagal dihapus');
        </script>";
    }
}
