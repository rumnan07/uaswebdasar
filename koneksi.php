<?php
$host = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$nama_database = "uasrumnan"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $nama_database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengatur karakter set ke UTF-8 (opsional)
$conn->set_charset("utf8");

// Menjalankan query untuk mengatur zona waktu (opsional)
$conn->query("SET time_zone = '+00:00'");

// Fungsi untuk membersihkan dan mencegah SQL injection
function clean_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($data))));
}

// Menutup koneksi dengan menggunakan $koneksi->close(); pada akhir skrip atau setelah selesai penggunaan.
?>
