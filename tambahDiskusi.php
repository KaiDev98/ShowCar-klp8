<?php
session_start();
include 'koneksi.php'; // pastikan koneksi ke database

// Ambil data dari form
$id_mobil = intval($_POST['id_mobil']);
$komentar = trim($_POST['komentar']);
$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null;

// Tentukan nama
if (isset($_SESSION['user'])) {
    $nama = $_SESSION['user']['username']; // atau ['nama'] jika disimpan begitu
} else {
    $nama = trim($_POST['nama']);
}

// Validasi sederhana
if ($komentar == '' || $nama == '') {
    die('Komentar atau nama tidak boleh kosong!');
}

// Siapkan query
$stmt = $conn->prepare("INSERT INTO diskusi (id_mobil, nama, komentar, parent_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issi", $id_mobil, $nama, $komentar, $parent_id);

// Eksekusi dan redirect
if ($stmt->execute()) {
header("Location: detail_mobil.php?id=$id_mobil&tab=diskusi");
exit;
} else {
    echo "Gagal menyimpan diskusi: " . $stmt->error;
}
?>
