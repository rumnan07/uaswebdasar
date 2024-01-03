<?php
session_start();

if($_SESSION['login'] == false){

    header('location: ../auth/login.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Pengguna</title>
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Pengguna</h2>

    <?php
    // Proses form jika ada data yang dikirimkan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('../koneksi.php');

        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $telpon = $_POST['telpon'];

        // Query untuk menambahkan data pengguna ke database
        $sql = "INSERT INTO pengguna (nama_lengkap, email, password, telpon) VALUES ('$nama_lengkap', '$email', '$password', '$telpon')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Data pengguna berhasil ditambahkan.</div>';

            // Mengarahkan ke tampil.php setelah berhasil menyimpan data
            header("Location: tampil.php");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }

        $conn->close();
    }
    ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="telpon" class="form-label">Telpon</label>
            <input type="tel" class="form-control" id="telpon" name="telpon" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="tampil.php" class="btn btn-secondary float-end">Kembali</a>
    </form>

    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
