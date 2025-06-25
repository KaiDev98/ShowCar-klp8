<?php
require 'koneksi.php';

// Ambil ID dari URL, pastikan valid (angka)
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Query berita berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM berita WHERE id = $id");

// Jika tidak ada hasil, tampilkan pesan error
if (!$result || mysqli_num_rows($result) == 0) {
    die("Berita tidak ditemukan.");
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($data['judul']); ?></title>
  <link rel="stylesheet" href="assets/css/berita-detail.css">
</head>
<body>
  <div class="article-container">
    <h1><?= htmlspecialchars($data['judul']); ?></h1>
    <div class="article-meta">
      <?= date('d M Y', strtotime($data['tanggal_publikasi'])); ?> | oleh <?= htmlspecialchars($data['penulis']); ?>
    </div>
    <img src="uploads/<?= htmlspecialchars($data['gambar']); ?>" alt="<?= htmlspecialchars($data['judul']); ?>" class="img-fluid mb-3">
    <p><?= nl2br(htmlspecialchars($data['isi'])); ?></p>
    <a class="back-link" href="berita-otomotif.php">← Kembali ke berita</a>
  </div>
</body>
</html>
