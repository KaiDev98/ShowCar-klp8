<?php
include 'koneksi.php';
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Review Mobil</title>
  <link rel="stylesheet" href="assets/css/review-style.css">
</head>
<body>

<div class="container">

  <?php if (isset($_SESSION['success'])): ?>
    <div class="notif success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="notif error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
  <?php endif; ?>

  <h2>🏆 Review & Rating Mobil</h2>

  <form action="simpan_review.php" method="POST">
    <label>Nama Anda:</label>
    <input type="text" name="nama" required>

    <label>Pilih Mobil:</label>
    <select name="mobil_id" required>
      <option value="">-- Pilih Mobil --</option>
      <?php
      $result = $conn->query("SELECT * FROM mobil");
      while($row = $result->fetch_assoc()) {
          echo "<option value='{$row['id_mobil']}'>" . htmlspecialchars($row['nama_mobil']) . "</option>";
      }
      ?>
    </select>

    <label>Komentar:</label>
    <textarea name="komentar" rows="4" required></textarea>

    <label>Rating:</label>
    <select name="rating" required>
      <?php for($i=1;$i<=5;$i++) echo "<option value='$i'>$i</option>"; ?>
    </select>

    <button type="submit">Kirim Review</button>
  </form>
  <hr>

  <h3>📋 Daftar Review</h3>
  <div class="review-list">
  <?php
  $result = $conn->query("SELECT r.*, m.nama_mobil FROM review r JOIN mobil m ON r.mobil_id = m.id_mobil ORDER BY r.created_at DESC");
  while ($row = $result->fetch_assoc()) {
      echo "<div class='card'>";
      echo "<strong>" . htmlspecialchars($row['nama_mobil']) . "</strong><br>";
      echo "<div class='star'>" . str_repeat("★", $row['rating']) . str_repeat("☆", 5 - $row['rating']) . "</div>";
      echo "<p>" . nl2br(htmlspecialchars($row['komentar'])) . "</p>";
      echo "<small>by <strong>" . htmlspecialchars($row['nama']) . "</strong> - " . $row['created_at'] . "</small>";
      echo "</div>";
  }
  ?>
  </div>
</div>

</body>
</html>
