<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user
$user_id = $_SESSION['user_id'];
$nama = $_SESSION['username'];

// Ambil data dari form
$mobil_id = isset($_POST['mobil_id']) ? intval($_POST['mobil_id']) : 0;
$judul = trim($_POST['judul']);
$rating = isset($_POST['rating']) ? floatval($_POST['rating']) : 0;
$komentar = trim($_POST['komentar']);

// Validasi input
if (mb_strlen($judul) < 3) {
    die("Judul minimal 3 karakter.");
}
if (mb_strlen($komentar) < 10) {
    die("Komentar minimal 10 karakter.");
}
if ($rating < 0.5 || $rating > 5) {
    die("Rating harus antara 0.5 sampai 5.");
}

// Sanitasi komentar dan judul untuk mencegah XSS
$judul_sanitized = htmlspecialchars($judul, ENT_QUOTES, 'UTF-8');
$komentar_sanitized = htmlspecialchars($komentar, ENT_QUOTES, 'UTF-8');

// Simpan data ke database
$stmt = $conn->prepare("INSERT INTO review (mobil_id, nama, judul, rating, komentar, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("issds", $mobil_id, $nama, $judul_sanitized, $rating, $komentar_sanitized);

if ($stmt->execute()) {
    header("Location: detail_mobil.php?id=$mobil_id&review=success");
    exit();
} else {
    echo "Gagal menyimpan ulasan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
