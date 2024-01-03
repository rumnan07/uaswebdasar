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
    <title>Tambah Buku</title>
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Buku</h2>

    <?php
    include('../koneksi.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi form disini sesuai kebutuhan (misalnya, untuk memastikan input tidak kosong)

        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $genre = $_POST['genre'];
        $keterangan = $_POST['keterangan'];
        $tanggal = $_POST['tanggal'];

        $sql = "INSERT INTO buku (judul, penulis, genre, keterangan, tanggal) 
                VALUES ('$judul', '$penulis', '$genre', '$keterangan', '$tanggal')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Data buku berhasil ditambahkan.</div>';
            // Setelah berhasil ditambahkan, redirect ke tampil.php
            header('Location: tampil.php');
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }
    ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul:</label>
            <input type="text" class="form-control" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis:</label>
            <input type="text" class="form-control" name="penulis" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre:</label>
            <input type="text" class="form-control" name="genre" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <!-- Dropdown menu untuk memilih nilai enum -->
            <select class="form-select" name="keterangan" required>
                <option value="Ada">Ada</option>
                <option value="Tidak Ada">Tidak Ada</option>
                <!-- Tambahkan opsi sesuai nilai enum yang digunakan -->
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Terbit:</label>
            <input type="text" class="form-control" name="tanggal" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Buku</button>
        <!-- Tambahkan tombol kembali tanpa menggunakan form untuk menghindari submit form -->
        <a href="tampil.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
