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
    <title>Ubah Buku</title>
</head>
<body>

<div class="container mt-5">
    <h2>Ubah Buku</h2>

    <?php
    include('../koneksi.php');

    // Memeriksa apakah parameter id diberikan pada URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query untuk mendapatkan data buku berdasarkan id
        $selectSql = "SELECT * FROM buku WHERE id = $id";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id'];
                $judul = $_POST['judul'];
                $penulis = $_POST['penulis'];
                $genre = $_POST['genre'];
                $keterangan = $_POST['keterangan'];
                $tanggal = $_POST['tanggal'];

                $updateSql = "UPDATE buku SET judul='$judul', penulis='$penulis', genre='$genre', keterangan='$keterangan', tanggal='$tanggal' WHERE id=$id";

                if ($conn->query($updateSql) === TRUE) {
                    // Redirect ke tampil.php setelah berhasil diubah
                    header('Location: tampil.php');
                    exit();
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error: ' . $updateSql . '<br>' . $conn->error . '</div>';
                }
            }
    ?>
    
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="mb-3">
            <label for="judul" class="form-label">Judul:</label>
            <input type="text" class="form-control" name="judul" value="<?php echo $row['judul']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis:</label>
            <input type="text" class="form-control" name="penulis" value="<?php echo $row['penulis']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre:</label>
            <input type="text" class="form-control" name="genre" value="<?php echo $row['genre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <!-- Dropdown menu untuk memilih nilai enum -->
            <select class="form-select" name="keterangan" required>
                <option value="Ada">Ada</option>
                <option value="Yidak Ada">Tidak Ada</option>
                <!-- Tambahkan opsi sesuai nilai enum yang digunakan -->
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Terbit:</label>
            <input type="text" class="form-control" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="tampil.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
        } else {
            echo '<div class="alert alert-warning" role="alert">Buku tidak ditemukan.</div>';
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
