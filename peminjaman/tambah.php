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
    <title>Tambah Peminjaman</title>
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Peminjaman</h2>

    <?php
    include('../koneksi.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_pengguna = clean_input($_POST['id_pengguna']);
        $id_buku = clean_input($_POST['id_buku']);
        $tanggal_peminjaman = clean_input($_POST['tanggal_peminjaman']);
        $tanggal_kembali = clean_input($_POST['tanggal_kembali']);
        $catatan = clean_input($_POST['catatan']);

        $sql = "INSERT INTO peminjaman (id_pengguna, id_buku, tanggal_peminjaman, tanggal_kembali, catatan) 
                VALUES ('$id_pengguna', '$id_buku', '$tanggal_peminjaman', '$tanggal_kembali', '$catatan')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Data peminjaman berhasil ditambahkan.</div>';
            echo '<script>setTimeout(function() {window.location.href = "tampil.php";}, 2000);</script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }
    ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="id_pengguna" class="form-label">ID Pengguna:</label>
            <input type="text" class="form-control" name="id_pengguna" required>
        </div>
        <div class="mb-3">
            <label for="id_buku" class="form-label">ID Buku:</label>
            <input type="text" class="form-control" name="id_buku" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman:</label>
            <input type="text" class="form-control" name="tanggal_peminjaman" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label>
            <input type="text" class="form-control" name="tanggal_kembali" required>
        </div>
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan:</label>
            <input type="text" class="form-control" name="catatan" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Peminjaman</button>
        
        <a href="tampil.php" class="btn btn-secondary  float-end">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
