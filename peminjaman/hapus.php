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
    <title>Hapus Peminjaman</title>
</head>
<body>

<div class="container mt-5">
    <h2>Hapus Peminjaman</h2>

    <?php
    include('../koneksi.php');

    // Proses hapus data jika ada parameter ID yang dikirimkan
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Hapus data peminjaman berdasarkan ID
        $sql = "DELETE FROM peminjaman WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Data peminjaman berhasil dihapus.</div>';
            echo '<script>setTimeout(function() {window.location.href = "tampil.php";}, 2000);</script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">ID Peminjaman tidak ditemukan.</div>';
    }

    $conn->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
