<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data siswa
    $query = "DELETE FROM siswa WHERE id_siswa = $id";

    if (mysqli_query($koneksi, $query)) {
        // Tambahkan ID yang dihapus ke tabel deleted_ids
        $query = "INSERT INTO deleted_ids (id_siswa) VALUES ($id)";
        mysqli_query($koneksi, $query);

        echo "Data siswa berhasil dihapus.";
        // Redirect kembali ke halaman utama
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
