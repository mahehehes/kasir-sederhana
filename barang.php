<?php
// Memulai sesi PHP untuk memeriksa status login pengguna.
session_start();
// Memeriksa apakah pengguna sudah login. Jika belum, akan diarahkan ke halaman login.
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
// Mengimpor file konfigurasi database agar koneksi ke database tersedia.
include 'config.php';

// Menjalankan query untuk mendapatkan daftar barang dari database.
$view = $dbconnect->query("SELECT * FROM barang");

// Menginisialisasi variabel total harga.
$total_harga = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Judul halaman -->
        <h1 class="text-center mt-5">List Barang</h1>
        <!-- Tombol untuk menambah data barang -->
        <a href="add_barang.php" class="btn btn-primary mb-3">Tambah Data</a>
        <!-- Tombol untuk logout -->
        <a href="logout.php" class="btn btn-danger mb-3 float-right">Logout</a>
        <!-- Tabel untuk menampilkan daftar barang -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah Stok</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $view->fetch_array()) { 
                    // Menghitung total harga untuk setiap barang.
                    $total_per_barang = $row['harga'] * $row['jumlah'];
                    // Mengakumulasikan total harga semua barang.
                    $total_harga += $total_per_barang;
                ?>   
                <tr>
                    <!-- Menampilkan informasi barang -->
                    <td><?=$row['id_barang']?></td>
                    <td><?=$row['nama']?></td>
                    <td><?=$row['harga']?></td>
                    <td><?=$row['jumlah']?></td>
                    <td><?=$total_per_barang?></td>
                    <!-- Tombol untuk edit dan hapus barang -->
                    <td>
                        <a href="edit_barang.php?id=<?=$row['id_barang']?>" class="btn btn-primary btn-sm">Edit</a> 
                        <a href="hapus_barang.php?id=<?=$row['id_barang']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Menampilkan total harga semua barang -->
        <h3 class="text-right">Total Harga: <?=$total_harga?></h3>

        <!-- Form untuk pembayaran -->
        <form method="post">
            <div class="form-group">
                <label for="uang_bayar">Uang yang Dibayar:</label>
                <input type="number" id="uang_bayar" name="uang_bayar" class="form-control" required>
            </div>
            <!-- Tombol untuk melakukan pembayaran -->
            <input type="submit" name="submit" value="Bayar" class="btn btn-primary">
        </form>

        <?php
        // Memeriksa apakah tombol "Bayar" telah ditekan.
        if(isset($_POST['submit'])) {
            // Mengambil nilai uang yang dibayar dari formulir.
            $uang_bayar = $_POST['uang_bayar'];
            // Memeriksa apakah uang yang dibayar cukup untuk membayar total harga atau tidak.
            if($uang_bayar >= $total_harga) {
                // Jika uang cukup, menghitung kembalian dan menampilkannya.
                $kembalian = $uang_bayar - $total_harga;
                echo "<p class='text-success'>Kembalian: " . $kembalian . " Rupiah</p>";
            } else { // Jika uang yang dibayar kurang dari total harga:
                $kurang = $total_harga - $uang_bayar; // Hitung jumlah uang yang kurang dibayarkan.
                echo "<p class='text-danger'>Uang yang dibayar kurang: " . $kurang . " Rupiah</p>"; // Tampilkan pesan error bahwa uang yang dibayar kurang.
            }
        }
        ?>
    </div> <!-- Penutup div container -->
    <!-- Mengimpor skrip JavaScript Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script> <!-- Mengimpor file skrip JavaScript Bootstrap untuk meningkatkan interaksi dan responsivitas -->
</body> <!-- Penutup tag body -->
</html> <!-- Penutup tag HTML -->