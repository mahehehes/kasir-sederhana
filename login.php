<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Mengimpor file stylesheet Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menambahkan gaya khusus untuk halaman */
        body {
            background-color: #f8f9fa; /* Warna latar belakang */
        }
        .container {
            margin-top: 50px; /* Jarak atas dari elemen dalam container */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Judul halaman -->
        <h1 class="text-center mb-4">Halaman Login Kasir</h1>
        <!-- Formulir login -->
        <form action="procces_login.php" method="post">
            <!-- Kotak input untuk username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <!-- Kotak input untuk password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- Tombol untuk mengirimkan formulir -->
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>