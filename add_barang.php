<?php
include 'config.php'; // Mengimpor file konfigurasi database.

if(isset($_POST['simpan'])) { // Memeriksa apakah tombol "Simpan" telah ditekan.
    $nama = $_POST['nama']; // Mengambil nilai nama barang dari formulir.
    $harga = $_POST['harga']; // Mengambil nilai harga barang dari formulir.
    $jumlah = $_POST['jumlah']; // Mengambil nilai jumlah stok barang dari formulir.

    // Membuat query SQL untuk menyimpan data barang baru ke dalam database.
    $query = "INSERT INTO barang (nama, harga, jumlah) VALUES ('$nama', '$harga', '$jumlah')";
    $result = mysqli_query($dbconnect, $query); // Menjalankan query ke database.

    if($result) { // Jika data berhasil disimpan ke dalam database:
        header("Location: barang.php"); // Arahkan pengguna kembali ke halaman barang.php.
    } else { // Jika terjadi kesalahan:
        echo "Error: " . $query . "<br>" . mysqli_error($dbconnect); // Tampilkan pesan error.
    }
}
?>

<!DOCTYPE html> <!-- Mendefinisikan tipe dokumen dan struktur dasar halaman HTML -->
<html lang="en"> <!-- Menetapkan bahasa dokumen ke bahasa Inggris -->
<head>
    <meta charset="UTF-8"> <!-- Menetapkan pengkodean karakter dokumen ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan responsif untuk perangkat seluler -->
    <title>Tambah Barang</title> <!-- Menetapkan judul dokumen -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor file stylesheet Bootstrap -->
</head>
<body>
    <div class="container">
        <h1>Tambah Barang</h1>
        <!-- Formulir untuk menambahkan barang baru -->
        <form method="post">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" placeholder="Harga Barang" required>
            </div>
            <div class="form-group">
                <label>Jumlah Stock</label>
                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock" required>
            </div>
            <!-- Tombol untuk menyimpan data atau kembali ke halaman barang.php -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            <a href="barang.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>
</html>