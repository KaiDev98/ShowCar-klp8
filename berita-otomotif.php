<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil data berita terbaru
$berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal_publikasi DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Berita Otomotif</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="assets/css/berita-otomotif.css" rel="stylesheet" />
</head>
<body>

<header>
  <h1>📰 Berita Otomotif Terkini</h1>
</header>

<div class="news-container">
  <h2>🔥 Trending</h2>

  <?php while ($row = mysqli_fetch_assoc($berita)): ?>
    <div class="news-item">
      <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['judul']); ?>" />

      <div class="news-content">
        <h3><?= htmlspecialchars($row['judul']); ?></h3>
        <div class="meta">
          Dipublikasikan: <?= date('d M Y', strtotime($row['tanggal_publikasi'])); ?> —
          Oleh: <?= htmlspecialchars($row['penulis']); ?>
        </div>
        <p class="excerpt">
          <?= mb_strimwidth(strip_tags($row['isi']), 0, 150, '...'); ?>
        </p>
        <a class="btn-readmore" href="berita-detail.php?id=<?= $row['id']; ?>">Read More ›</a>
      </div>
    </div>
  <?php endwhile; ?>

</div>

</body>
</html>
