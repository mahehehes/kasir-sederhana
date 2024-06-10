<?php
session_start(); // Memulai sesi PHP.

include 'config.php'; // Mengimpor file konfigurasi database yang mungkin berisi informasi koneksi ke database.

if(!isset($_SESSION['username'])) { // Memeriksa apakah pengguna sudah login. Jika belum, arahkan kembali ke halaman login.
    header("Location: login.php");
    exit; // Memberhentikan eksekusi skrip PHP untuk menghentikan pemrosesan lebih lanjut.
}

if(isset($_POST['submit'])) { // Memeriksa apakah tombol submit telah ditekan pada formulir.
    $id = $_POST['id']; // Mengambil nilai ID member dari formulir.
    $nama = $_POST['nama']; // Mengambil nilai nama member dari formulir.
    $gender = $_POST['gender']; // Mengambil nilai gender member dari formulir.
    $alamat = $_POST['alamat']; // Mengambil nilai alamat member dari formulir.

    // Membuat query SQL untuk menyimpan data member baru ke dalam tabel member di database.
    $query = "INSERT INTO member (id_member, nama, gender, alamat) VALUES ('$id', '$nama', '$gender', '$alamat')";
    $result = $dbconnect->query($query); // Menjalankan query ke database.

    if($result) { // Jika data berhasil disimpan ke dalam database:
        header("Location: list_member.php"); // Arahkan pengguna kembali ke halaman list_member.php.
    } else { // Jika terjadi kesalahan:
        echo "Gagal menyimpan data member."; // Tampilkan pesan error.
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Member</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Registrasi Member</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="id">ID Member:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="list_member.php" class="btn btn-primary">Lihat Member Kasir</a>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>