<?php
require 'koneksi.php';

// Ambil ID dari URL dan pastikan itu angka (untuk keamanan)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Query data berita berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM berita WHERE id = $id");

// Cek jika data tidak ditemukan
if (!$result || mysqli_num_rows($result) === 0) {
    echo "<p>Berita tidak ditemukan.</p>";
    exit;
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($row['judul']); ?></title>
  <link rel="stylesheet" href="assets/css/berita-detail.css">
</head>
<body>
  <div class="article-container container my-5">
    <h1 class="text-danger"><?= htmlspecialchars($row['judul']); ?></h1>
    <div class="article-meta text-muted">
      <?= date('d M Y', strtotime($row['tanggal_publikasi'])); ?> | oleh <?= htmlspecialchars($row['penulis']); ?>
    </div>
    <?php if (!empty($row['gambar'])): ?>
      <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" class="img-fluid mb-3" alt="<?= htmlspecialchars($row['judul']); ?>">
    <?php endif; ?>
    <div class="article-content">
      <?= nl2br(htmlspecialchars($row['isi'])); ?>
    </div>
    <a class="back-link" href="berita-otomotif.php">← Kembali ke berita</a>
  </div>
</body>
</html>
