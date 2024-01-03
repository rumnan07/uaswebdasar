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
    <title>Tampil Buku</title>
</head>
<body>

<div class="container mt-5">
    
    <?php include('../index.php'); ?>
    <h2>Daftar Buku</h2>
    
    <?php

    include('../koneksi.php');

    $sql = "SELECT * FROM buku";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Genre</th>
                        <th>Keterangan</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['judul']}</td>
                    <td>{$row['penulis']}</td>
                    <td>{$row['genre']}</td>
                    <td>";
            // Menampilkan keterangan "Tidak Ada" jika nilainya kosong
            echo $row['keterangan'] ? $row['keterangan'] : 'Tidak Ada';
            echo "</td>
                    <td>{$row['tanggal']}</td>
                    <td>
                        <a href='ubah.php?id={$row['id']}' class='btn btn-warning'>Ubah</a>
                        <a href='hapus.php?id={$row['id']}' class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>";
        }

        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Tidak ada data buku.</div>';
    }

    $conn->close();
    ?>

    <a href="tambah.php" class="btn btn-primary">Tambah Buku</a>
    <a  href="../auth/logout.php"
    onclick="return confirm('Anda Yakin ?')" 
    class="btn btn-secondary float-end">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
