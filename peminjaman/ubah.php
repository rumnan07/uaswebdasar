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
    <title>Ubah Peminjaman</title>
</head>
<body>

<div class="container mt-5">
    <h2>Ubah Peminjaman</h2>

    <?php
    include('../koneksi.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $id_pengguna = clean_input($_POST['id_pengguna']);
        $id_buku = clean_input($_POST['id_buku']);
        $tanggal_peminjaman = clean_input($_POST['tanggal_peminjaman']);
        $tanggal_kembali = clean_input($_POST['tanggal_kembali']);
        $catatan = clean_input($_POST['catatan']);

        $sql = "UPDATE peminjaman SET 
                id_pengguna='$id_pengguna', 
                id_buku='$id_buku', 
                tanggal_peminjaman='$tanggal_peminjaman', 
                tanggal_kembali='$tanggal_kembali', 
                catatan='$catatan' 
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Data peminjaman berhasil diubah.</div>';
            echo '<script>setTimeout(function() {window.location.href = "tampil.php";}, 2000);</script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    } else {
        // Jika metode bukan POST, ambil data peminjaman yang akan diubah
        $id = $_GET['id'];
        $sql = "SELECT * FROM peminjaman WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_pengguna = $row['id_pengguna'];
            $id_buku = $row['id_buku'];
            $tanggal_peminjaman = $row['tanggal_peminjaman'];
            $tanggal_kembali = $row['tanggal_kembali'];
            $catatan = $row['catatan'];
        } else {
            echo '<div class="alert alert-warning" role="alert">Data peminjaman tidak ditemukan.</div>';
        }
    }
    ?>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="id_pengguna" class="form-label">ID Pengguna:</label>
            <input type="text" class="form-control" name="id_pengguna" value="<?php echo $id_pengguna; ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_buku" class="form-label">ID Buku:</label>
            <input type="text" class="form-control" name="id_buku" value="<?php echo $id_buku; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman:</label>
            <input type="text" class="form-control" name="tanggal_peminjaman" value="<?php echo $tanggal_peminjaman; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label>
            <input type="text" class="form-control" name="tanggal_kembali" value="<?php echo $tanggal_kembali; ?>" required>
        </div>
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan:</label>
            <input type="text" class="form-control" name="catatan" value="<?php echo $catatan; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        
        <a href="tampil.php" class="btn btn-secondary  float-end">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
