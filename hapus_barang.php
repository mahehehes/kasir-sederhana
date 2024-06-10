<?php
include 'config.php'; // Mengimpor file konfigurasi database.

if(isset($_GET['id'])) { // Memeriksa apakah parameter 'id' telah disertakan dalam URL.
    $id = $_GET['id']; // Mengambil nilai ID barang dari URL.
    $delete = $dbconnect->query("DELETE FROM barang WHERE id_barang = '$id'"); // Menghapus data barang dari database berdasarkan ID.

    if($delete) { // Jika penghapusan berhasil:
        header("Location: barang.php"); // Arahkan pengguna kembali ke halaman barang.php.
    } else { // Jika terjadi kesalahan saat menghapus data:
        echo "Gagal menghapus data."; // Tampilkan pesan kesalahan.
    }
}
?>