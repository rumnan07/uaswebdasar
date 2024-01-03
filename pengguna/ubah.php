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
    <title>Ubah Pengguna</title>
</head>
<body>

<div class="container mt-5">
    <h2>Ubah Pengguna</h2>

    <?php
    include('../koneksi.php');

    // Memeriksa apakah parameter id diberikan pada URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Mengambil data pengguna berdasarkan id
        $sql = "SELECT * FROM pengguna WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Proses form jika ada data yang dikirimkan
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama_lengkap = $_POST['nama_lengkap'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $telpon = $_POST['telpon'];

                // Query untuk mengupdate data pengguna ke database
                $updateSql = "UPDATE pengguna SET nama_lengkap = '$nama_lengkap', email = '$email', password = '$password', telpon = '$telpon' WHERE id = $id";

                if ($conn->query($updateSql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Data pengguna berhasil diubah.</div>';
                
                    // Mengarahkan ke tampil.php setelah berhasil mengubah data
                    header("Location: tampil.php");
                    exit();
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
                }
                
            }
            ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telpon" class="form-label">Telpon</label>
                    <input type="tel" class="form-control" id="telpon" name="telpon" value="<?php echo $row['telpon']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="tampil.php" class="btn btn-secondary  float-end">Kembali</a>
            </form>

            <?php
        } else {
            echo '<div class="alert alert-warning" role="alert">Data pengguna tidak ditemukan.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">ID tidak diberikan.</div>';
    }

    $conn->close();
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
