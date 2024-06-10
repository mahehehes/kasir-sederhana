<?php
session_start(); // Memulai sesi PHP.

include 'config.php'; // Mengimpor file konfigurasi database.

if(isset($_POST['username'], $_POST['password'])) { // Memeriksa apakah username dan password telah disubmit melalui form.
    $username = $_POST['username']; // Mengambil nilai username dari form.
    $password = $_POST['password']; // Mengambil nilai password dari form.

    if($username === 'admin' && $password === 'admin123') { // Memeriksa apakah username dan password yang dimasukkan sesuai dengan yang diharapkan.
        $_SESSION['username'] = $username; // Menyimpan username dalam sesi untuk menandakan bahwa pengguna telah login.
        header("Location: barang2.php"); // Mengarahkan pengguna ke halaman barang2.php setelah login berhasil.
    } else {
        echo "Username atau password salah."; // Menampilkan pesan kesalahan jika username atau password tidak sesuai.
    }
}
?>