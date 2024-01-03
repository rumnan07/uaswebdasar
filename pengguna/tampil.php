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
    <title>Tampil Pengguna</title>
</head>
<body>

<div class="container mt-5">
<?php include('../index.php'); ?>
    <h2>Daftar Pengguna</h2>
    <h5>Selamat datang : <?php echo $_SESSION['nama_lengkap'];  ?> </h5>


    <?php
    include('../koneksi.php');

    $sql = "SELECT * FROM pengguna";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Telpon</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nama_lengkap']}</td>
                    <td>{$row['email']}</td>
                    <td>*****</td> <!-- Menyembunyikan password dengan karakter bintang (*) -->
                    <td>{$row['telpon']}</td>
                    <td>{$row['role']}</td>
                    <td>
                        <a href='ubah.php?id={$row['id']}' class='btn btn-warning'>Ubah</a>
                        <a href='hapus.php?id={$row['id']}' class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>";
        }

        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Tidak ada data pengguna.</div>';
    }

    $conn->close();
    ?>

    <a href="tambah.php" class="btn btn-primary">Tambah Pengguna</a>
    <a  href="../auth/logout.php"
    onclick="return confirm('Anda Yakin ?')" 
    class="btn btn-secondary mb-3 float-end">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
