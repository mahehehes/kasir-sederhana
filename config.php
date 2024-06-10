<?php
$host = "localhost"; // Nama host database, biasanya localhost jika berjalan secara lokal.
$user = "root"; // Nama pengguna database.
$pass = ""; // Kata sandi pengguna database, default kosong untuk XAMPP dan WAMP.
$db = "db_hesti"; // Nama database yang digunakan.

$dbconnect = new mysqli($host, $user, $pass, $db); // Membuat koneksi baru ke database menggunakan mysqli.

if($dbconnect->connect_error){ // Memeriksa apakah terjadi kesalahan saat menghubungkan ke database.
    die("Koneksi gagal: " . $dbconnect->connect_error); // Jika terjadi kesalahan, tampilkan pesan error dan hentikan eksekusi skrip.
}
?>