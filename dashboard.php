<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
</head>
<body>
    <form action="simpan_siswa.php" method="post">
        Masukkan Nama Siswa:
        <input type="text" name="namaSiswa" required>
        <button type="submit" name="simpan">Simpan</button>
    </form>
    <div class="tabelInputSiswa">
        <!-- Tempat untuk menampilkan daftar siswa -->
        <?php
        // Menyertakan file koneksi ke database
        include 'koneksi.php';

        // Query untuk mengambil data siswa
        $query = "SELECT * FROM siswa ORDER BY id_siswa ASC";
        $result = mysqli_query($koneksi, $query);

        echo "<table border='1'>
        <tr>
            <th>ID Siswa</th>
            <th>Nama Siswa</th>
            <th>Action</th>
        </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $formatted_id = str_pad($row['id_siswa'], 4, '0', STR_PAD_LEFT); // Format ID menjadi 4 digit dengan nol di depan
            $namaSiswa = ucwords(strtolower($row['nama'])); // Membuat kapital pada huruf pertama setiap kata
            echo "<tr>";
            echo "<td>" . $formatted_id . "</td>";
            echo "<td>" . $namaSiswa . "</td>";
            echo "<td><a href='delete_siswa.php?id=" . $row['id_siswa'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus siswa ini?\")'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";

        mysqli_close($koneksi);
        ?>
    </div>
</body>
</html>
