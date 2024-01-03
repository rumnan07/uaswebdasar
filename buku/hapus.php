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
    <title>Hapus Buku</title>
</head>
<body>

<div class="container mt-5">
    <h2>Hapus Buku</h2>

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

                $deleteSql = "DELETE FROM buku WHERE id = $id";

                if ($conn->query($deleteSql) === TRUE) {
                    // Redirect ke tampil.php setelah berhasil dihapus
                    header('Location: tampil.php');
                    exit();
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error: ' . $deleteSql . '<br>' . $conn->error . '</div>';
                }
            }
    ?>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <p>Apakah Anda yakin ingin menghapus buku dengan judul "<?php echo $row['judul']; ?>"?</p>

        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        <a href="tampil.php" class="btn btn-secondary">Tidak, Kembali</a>
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
