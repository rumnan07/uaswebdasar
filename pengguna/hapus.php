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
    <title>Hapus Pengguna</title>
</head>
<body>

<div class="container mt-5">
    <h2>Hapus Pengguna</h2>

    <?php
    include('../koneksi.php');

    // Memeriksa apakah parameter id diberikan pada URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Menghapus data pengguna berdasarkan id
        $deleteSql = "DELETE FROM pengguna WHERE id = $id";

        if ($conn->query($deleteSql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Data pengguna berhasil dihapus.</div>';

            // Mengarahkan kembali ke tampil.php setelah berhasil menghapus data
            header("Location: tampil.php");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">ID tidak diberikan.</div>';
    }

    $conn->close();
    ?>

    <a href="tampil.php" class="btn btn-secondary mt-3">Kembali ke Daftar Pengguna</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
