<?php
session_start();
include 'koneksi.php';

// Cek login
$is_logged_in = isset($_SESSION['user_id']);

// Ambil data berita terbaru
$berita = mysqli_query($conn, "SELECT * FROM berita WHERE status = 'publikasi' ORDER BY tanggal_publikasi DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Berita Otomotif</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="assets/css/berita-otomotif.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f6f9fc;
      margin: 0;
      padding: 0;
    }

    header {
      text-align: center;
      padding: 30px 20px 10px;
      background-color: #1a1f2b; /* warna gelap */
    }

    header h1 {
      margin: 0;
      font-size: 28px;
      color:rgb(255, 255, 255);
    }

    .btn-back {
      display: inline-block;
      margin: 20px;
      padding: 10px 20px;
      background-color: #444;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }

    .btn-back:hover {
      background-color: #666;
    }

    .news-container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
    }

    .news-container h2 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #e53935;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .news-item {
      display: flex;
      gap: 20px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      padding: 16px;
      margin-bottom: 24px;
      transition: transform 0.2s ease;
    }

    .news-item:hover {
      transform: scale(1.01);
    }

    .news-item img {
      width: 220px;
      height: 150px;
      object-fit: cover;
      border-radius: 12px;
      flex-shrink: 0;
    }

    .news-content {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .news-content h3 {
      font-size: 20px;
      font-weight: 700;
      color: #222;
      margin: 0 0 10px;
    }

    .meta {
      font-size: 13px;
      color: #666;
      margin-bottom: 10px;
    }

    .excerpt {
      font-size: 14px;
      color: #444;
      margin-bottom: 10px;
    }

    .btn-readmore {
      align-self: flex-start;
      display: inline-block;
      background-color: #e53935;
      color: #fff;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      transition: background-color 0.2s ease;
    }

    .btn-readmore:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>

<header>
  <h1>📰 Berita Otomotif Terkini</h1>
</header>

<!-- Tombol Kembali -->
<div>
  <a class="btn-back" href="<?= $is_logged_in ? 'pengguna.php' : 'index.php'; ?>">← Kembali</a>
</div>

<div class="news-container">
  <h2>🔥 Trending</h2>

  <?php while ($row = mysqli_fetch_assoc($berita)): ?>
    <div class="news-item">
      <a href="berita-detail.php?id=<?= $row['id']; ?>">
        <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['judul']); ?>" />
      </a>

      <div class="news-content">
        <h3><?= htmlspecialchars($row['judul']); ?></h3>
        <div class="meta">
          Dipublikasikan: <?= date('d M Y', strtotime($row['tanggal_publikasi'])); ?> — Oleh: <?= htmlspecialchars($row['penulis']); ?>
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
