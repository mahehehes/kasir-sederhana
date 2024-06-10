<?php
session_start(); // Memulai sesi PHP.
include 'config.php'; // Mengimpor file konfigurasi database.

if(!isset($_SESSION['username'])) { // Memeriksa apakah pengguna telah login.
    header("Location: login.php"); // Jika belum, arahkan ke halaman login.
    exit; // Keluar dari skrip PHP.
}

if(isset($_POST['submit'])) { // Memeriksa apakah tombol "Submit" pada formulir telah ditekan.
    $id = $_POST['id']; // Mengambil nilai ID member dari formulir.
    $nama = $_POST['nama']; // Mengambil nilai nama dari formulir.
    $gender = $_POST['gender']; // Mengambil nilai jenis kelamin dari formulir.
    $alamat = $_POST['alamat']; // Mengambil nilai alamat dari formulir.

    // Membuat query SQL untuk mengupdate data member berdasarkan ID.
    $query = "UPDATE member SET nama='$nama', gender='$gender', alamat='$alamat' WHERE id_member='$id'";
    $result = $dbconnect->query($query); // Menjalankan query ke database.

    if($result) { // Jika data berhasil diupdate:
        header("Location: list_member.php"); // Arahkan pengguna kembali ke halaman list_member.php.
    } else { // Jika terjadi kesalahan saat mengupdate data:
        echo "Gagal mengupdate data member."; // Tampilkan pesan kesalahan.
    }
}

if(isset($_GET['id'])) { // Memeriksa apakah parameter 'id' telah disertakan dalam URL.
    $id = $_GET['id']; // Mengambil nilai ID member dari URL.
    $query = "SELECT * FROM member WHERE id_member='$id'"; // Membuat query SQL untuk mengambil data member berdasarkan ID.
    $result = $dbconnect->query($query); // Menjalankan query ke database.
    $row = $result->fetch_assoc(); // Mengambil hasil query dan menyimpannya dalam bentuk array asosiatif.
}
?>