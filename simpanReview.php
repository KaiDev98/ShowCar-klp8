<?php
session_start();
require 'koneksi.php';

// Validasi login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    die("Anda harus login untuk memberikan ulasan.");
}

// Ambil data dari form
$nama      = $_SESSION['username'];
$mobil_id  = isset($_POST['mobil_id']) ? intval($_POST['mobil_id']) : 0;
$komentar  = trim($_POST['komentar']);
$rating    = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
$created_at = date('Y-m-d H:i:s');

// Validasi input
if (strlen($komentar) < 10) {
    die("Komentar minimal 10 karakter.");
}
if ($rating < 1 || $rating > 5) {
    die("Rating harus antara 1 sampai 5.");
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO review (nama, mobil_id, komentar, rating, created_at) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sisis", $nama, $mobil_id, $komentar, $rating, $created_at);

if ($stmt->execute()) {
    header("Location: detail_mobil.php?id=$mobil_id&review=success");
    exit();
} else {
    echo "Gagal menyimpan ulasan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
