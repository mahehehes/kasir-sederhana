<?php
session_start(); // Memulai sesi PHP.
session_destroy(); // Menghancurkan semua data sesi yang tersimpan.
header("Location: login.php"); // Mengarahkan pengguna kembali ke halaman login.php setelah sesi dihapus.
exit; // Menghentikan eksekusi skrip PHP setelah mengarahkan pengguna ke halaman login.
?>