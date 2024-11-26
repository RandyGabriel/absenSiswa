<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaSiswa = ucwords(strtolower($_POST['namaSiswa']));

    // Cek apakah ada ID yang dihapus
    $query = "SELECT id_siswa FROM deleted_ids ORDER BY id_siswa LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika ada, gunakan ID yang dihapus
        $row = mysqli_fetch_assoc($result);
        $id_siswa = $row['id_siswa'];

        // Hapus ID dari tabel deleted_ids
        $query = "DELETE FROM deleted_ids WHERE id_siswa = $id_siswa";
        mysqli_query($koneksi, $query);
    } else {
        // Jika tidak ada, cari ID tertinggi yang ada di tabel siswa
        $query = "SELECT MAX(id_siswa) AS max_id FROM siswa";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        $id_siswa = $row['max_id'] + 1; // Tambahkan 1 dari ID tertinggi
    }

    // Query untuk menyimpan data siswa dengan ID yang ditentukan
    $query = "INSERT INTO siswa (id_siswa, nama) VALUES ($id_siswa, '$namaSiswa')";

    if (mysqli_query($koneksi, $query)) {
        echo "Data siswa berhasil disimpan.";
        // Redirect kembali ke halaman utama
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
