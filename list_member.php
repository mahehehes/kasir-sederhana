<?php
// Memulai sesi PHP.
session_start();
// Mengimpor file konfigurasi database.
include 'config.php';

// Memeriksa apakah pengguna belum login, jika ya, maka arahkan ke halaman login.php.
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Membuat query SQL untuk mengambil data dari tabel member.
$query = "SELECT * FROM member";
// Menjalankan query ke database.
$result = $dbconnect->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Member Di Kasir</title>
    <!-- Mengimpor file stylesheet Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Judul halaman -->
        <h1 class="text-center mt-5">List Member Di Kasir</h1>
        <!-- Tombol untuk kembali ke halaman barang2.php -->
        <a href="barang2.php" class="btn btn-primary mb-3 float-right">Kembali</a>
        <!-- Tombol untuk menambahkan member baru -->
        <a href="registrasi_member.php" class="btn btn-primary mb-3 float-right">Tambah Member</a>
        <!-- Tabel untuk menampilkan data member -->
        <table class="table table-bordered">
            <thead>
                <!-- Header kolom-kolom dalam tabel -->
                <tr>
                    <th>ID Member</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Melakukan iterasi untuk setiap baris hasil query
                while ($row = $result->fetch_assoc()) { ?>
                <!-- Menampilkan data dari setiap baris dalam tabel -->
                <tr>
                    <!-- Kolom ID Member -->
                    <td><?= $row['id_member'] ?></td>
                    <!-- Kolom Nama -->
                    <td><?= $row['nama'] ?></td>
                    <!-- Kolom Gender -->
                    <td><?= ($row['gender'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
                    <!-- Kolom Alamat -->
                    <td><?= $row['alamat'] ?></td>
                    <!-- Kolom untuk aksi (Edit dan Hapus) -->
                    <td>
                        <!-- Tombol untuk mengedit data member -->
                        <a href="edit_member.php?id=<?= $row['id_member'] ?>" class="btn btn-primary btn-sm">Edit</a> 
                        <!-- Tombol untuk menghapus data member -->
                        <a href="hapus_member.php?id=<?= $row['id_member'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Mengimpor file script Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>