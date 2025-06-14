<?php
require 'koneksi.phpphp';
$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = $id");
$row = mysqli_fetch_assoc($result);
?>

<article class="container my-5">
  <h1 class="text-danger"><?= htmlspecialchars($row['judul']) ?></h1>
  <p class="text-muted"><?= date('d M Y', strtotime($row['tanggal_publikasi'])) ?> | oleh <?= htmlspecialchars($row['penulis']) ?></p>
  <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mb-3" alt="<?= htmlspecialchars($row['judul']) ?>">
  <div><?= nl2br(htmlspecialchars($row['isi'])) ?></div>
</article>


<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($data['judul']); ?></title>
  <link rel="stylesheet" href="assets/css/berita-detail.css">
</head>
<body>
  <div class="article-container">
    <h1><?= htmlspecialchars($data['judul']); ?></h1>
    <div class="article-meta"><?= $data['tanggal_publikasi']; ?> | oleh <?= htmlspecialchars($data['penulis']); ?></div>
    <img src="uploads/<?= htmlspecialchars($data['gambar']); ?>" alt="<?= htmlspecialchars($data['judul']); ?>">
    <p><?= nl2br(htmlspecialchars($data['isi'])); ?></p>
    <a class="back-link" href="berita-otomotif.php">← Kembali ke berita</a>
  </div>
</body>
</html>
