<?php
include 'config.php'; // Mengimpor file konfigurasi database.

if(isset($_GET['id'])) { // Memeriksa apakah parameter 'id' telah disertakan dalam URL.
    $id = $_GET['id']; // Mengambil nilai 'id' dari URL.
    $query = "SELECT * FROM barang WHERE id_barang='$id'"; // Membuat query SQL untuk mengambil data barang berdasarkan id.
    $result = mysqli_query($dbconnect, $query); // Menjalankan query ke database.
    $data = mysqli_fetch_assoc($result); // Mengambil hasil query dan menyimpannya dalam bentuk array asosiatif.

    if(isset($_POST['update'])) { // Memeriksa apakah tombol "Perbarui" telah ditekan.
        $nama = $_POST['nama']; // Mengambil nilai nama barang yang diperbarui dari formulir.
        $harga = $_POST['harga']; // Mengambil nilai harga barang yang diperbarui dari formulir.
        $jumlah = $_POST['jumlah']; // Mengambil nilai jumlah stok barang yang diperbarui dari formulir.

        // Membuat query SQL untuk memperbarui data barang dalam database.
        $update_query = "UPDATE barang SET nama='$nama', harga='$harga', jumlah='$jumlah' WHERE id_barang='$id'";
        $update_result = mysqli_query($dbconnect, $update_query); // Menjalankan query untuk memperbarui data barang.

        if($update_result) { // Jika data berhasil diperbarui:
            header("Location: barang.php"); // Arahkan pengguna kembali ke halaman barang.php.
        } else { // Jika terjadi kesalahan saat memperbarui data:
            echo "Error: " . $update_query . "<br>" . mysqli_error($dbconnect); // Tampilkan pesan error.
        }
    }
}
?>

<!DOCTYPE html> <!-- Mendefinisikan tipe dokumen dan struktur dasar halaman HTML -->
<html lang="en"> <!-- Menetapkan bahasa dokumen ke bahasa Inggris -->
<head>
    <meta charset="UTF-8"> <!-- Menetapkan pengkodean karakter dokumen ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan responsif untuk perangkat seluler -->
    <title>Perbarui Barang</title> <!-- Menetapkan judul dokumen -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor file stylesheet Bootstrap -->
</head>
<body>
    <div class="container" >
        <h1>Perbarui Barang</h1>
        <!-- Formulir untuk memperbarui data barang -->
        <form method="post">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Barang" value="<?=$data['nama']?>" > <!-- Menampilkan nilai nama barang yang ada dalam database -->
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" placeholder="Harga Barang" value="<?=$data['harga']?>" > <!-- Menampilkan nilai harga barang yang ada dalam database -->
            </div>
            <div class="form-group">
                <label>Jumlah Stock</label>
                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock" value="<?=$data['jumlah']?>" > <!-- Menampilkan nilai jumlah stok barang yang ada dalam database -->
            </div>
            <!-- Tombol untuk memperbarui data atau kembali ke halaman barang.php -->
            <input type="submit" name="update" value="Perbarui" class="btn btn-primary">
            <a href="barang.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>
</html>