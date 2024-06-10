<?php
session_start(); // Memulai sesi PHP untuk menyimpan data sesi pengguna.
if(!isset($_SESSION['username'])) { // Memeriksa apakah pengguna sudah login.
    header("Location: login.php"); // Jika tidak, arahkan ke halaman login.
    exit; // Keluar dari skrip PHP.
}
include 'config.php'; // Mengimpor file konfigurasi database.

$view = $dbconnect->query("SELECT * FROM barang"); // Mengambil data barang dari database.

$total_harga = 0; // Inisialisasi total harga.

?>

<!DOCTYPE html> <!-- Mendefinisikan tipe dokumen dan struktur dasar halaman HTML -->
<html lang="en"> <!-- Menetapkan bahasa dokumen ke bahasa Inggris -->
<head>
    <meta charset="UTF-8"> <!-- Menetapkan pengkodean karakter dokumen ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan responsif untuk perangkat seluler -->
    <title>List Barang</title> <!-- Menetapkan judul dokumen -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor file stylesheet Bootstrap -->
</head>
<body>
    <div class="container"> <!-- Membuat div container untuk menempatkan elemen-elemen dalam halaman -->
        <h1 class="text-center mt-5">List Barang</h1> <!-- Judul halaman -->
        <!-- Tombol untuk menambahkan data barang -->
        <a href="add_barang.php" class="btn btn-primary mb-3">Tambah Data</a>
        <!-- Tombol untuk logout -->
        <a href="logout.php" class="btn btn-danger mb-3 float-right">Logout</a>
        <!-- Tombol untuk mengelola member kasir -->
        <a href="registrasi_member.php" class="btn btn-success mb-3 float-right">Kelola Member Kasir</a>
        <table class="table table-bordered"> <!-- Tabel untuk menampilkan data barang -->
            <thead>
                <tr>
                    <!-- Kolom-kolom dalam tabel -->
                    <th>ID Barang</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah Stok</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $view->fetch_array()) { // Perulangan untuk setiap data barang
                    $total_per_barang = $row['harga'] * $row['jumlah']; // Menghitung total harga untuk setiap barang
                    $total_harga += $total_per_barang; // Menambahkan total harga barang ke total harga keseluruhan
                ?>   
                <tr>
                    <!-- Kolom-kolom dalam baris tabel -->
                    <td><?=$row['id_barang']?></td> <!-- ID Barang -->
                    <td><?=$row['nama']?></td> <!-- Nama Barang -->
                    <td><?=$row['harga']?></td> <!-- Harga Barang -->
                    <td><?=$row['jumlah']?></td> <!-- Jumlah Stok Barang -->
                    <td><?=$total_per_barang?></td> <!-- Total Harga Barang -->
                    <td>
                        <!-- Tombol untuk mengedit data barang -->
                        <a href="edit_barang.php?id=<?=$row['id_barang']?>" class="btn btn-primary btn-sm">Edit</a> 
                        <!-- Tombol untuk menghapus data barang -->
                        <a href="hapus_barang.php?id=<?=$row['id_barang']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <h3 class="text-right">Total Harga: <?=$total_harga?></h3> <!-- Menampilkan total harga semua barang -->
        <!-- Formulir untuk pembayaran -->
        <form method="post">
            <div class="form-group">
                <label for="uang_bayar">Uang yang Dibayar:</label> <!-- Label untuk input uang bayar -->
                <input type="number" id="uang_bayar" name="uang_bayar" class="form-control" required> <!-- Input untuk jumlah uang yang dibayar -->
            </div>
            <input type="submit" name="submit" value="Bayar" class="btn btn-primary"> <!-- Tombol untuk melakukan pembayaran -->
        </form>

        <?php
        if(isset($_POST['submit'])) { // Memeriksa apakah tombol "Bayar" ditekan
            $uang_bayar = $_POST['uang_bayar']; // Mengambil nilai uang yang dibayar dari formulir
            
            if($uang_bayar >= $total_harga) { // Jika jumlah uang yang dibayar lebih dari atau sama dengan total harga:
                $kembalian = $uang_bayar - $total_harga; // Hitung kembalian
                echo "<p class='text-success'>Kembalian: " . $kembalian . " Rupiah</p>"; // Tampilkan kembalian
            } else { // Jika jumlah uang yang dibayar kurang dari total harga:
                $kurang = $total_harga - $uang_bayar; // Hitung jumlah uang yang kurang dibayarkan
                echo "<p class='text-danger'>Uang yang dibayar kurang: " . $kurang . " Rupiah</p>"; // Tampilkan pesan bahwa uang yang dibayarkan kurang
            }
        }
        ?>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script> <!-- Mengimpor file skrip JavaScript Bootstrap -->
</body>
</html>