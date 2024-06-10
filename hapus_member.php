<?php
session_start(); // Memulai sesi untuk pengelolaan login.
include 'config.php'; // Mengimpor file konfigurasi database.

if(!isset($_SESSION['username'])) { // Memeriksa apakah pengguna belum login.
    header("Location: login.php"); // Mengarahkan pengguna kembali ke halaman login.
    exit; // Menghentikan eksekusi skrip.
}

if(isset($_GET['id'])) { // Memeriksa apakah parameter 'id' telah disertakan dalam URL.
    $id = $_GET['id']; // Mengambil nilai ID member dari URL.
    $query = "DELETE FROM member WHERE id_member='$id'"; // Membuat query untuk menghapus data member berdasarkan ID.
    $result = $dbconnect->query($query); // Menjalankan query di database.

    if($result) { // Jika penghapusan berhasil:
        header("Location: list_member.php"); // Arahkan pengguna kembali ke halaman list_member.php.
    } else { // Jika terjadi kesalahan saat menghapus data member:
        echo "Gagal menghapus data member."; // Tampilkan pesan kesalahan.
    }
}
?>