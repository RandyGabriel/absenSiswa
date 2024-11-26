<?php
$host = "localhost"; // Alamat server database
$user = "root"; // Nama pengguna database
$password = ""; // Kata sandi pengguna database
$database = "siswa_db"; // Nama database yang ingin diakses

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Memeriksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil";
?>
