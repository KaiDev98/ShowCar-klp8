<?php
include '../koneksi.php';
$alert = "";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$merekResult    = $conn->query("SELECT id_merek, nama_merek FROM merek");
$kategoriResult = $conn->query("SELECT id_kategori, nama_kategori FROM kategori");

// Ambil data mobil
$stmt = $conn->prepare("
    SELECT nama_mobil, id_merek, id_kategori, harga, video_url, video 
    FROM mobil 
    WHERE id_mobil = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nama_mobil, $id_merek, $id_kategori, $harga, $video_url, $oldVideo);
if (!$stmt->fetch()) {
    header("Location: index.php");
    exit;
}
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mobil  = trim($_POST['nama_mobil']);
    $id_merek    = (int) $_POST['id_merek'];
    $id_kategori = (int) $_POST['id_kategori'];
    $harga       = (int) $_POST['harga'];
    $video_url   = trim($_POST['video_url']);

    // Tangani upload video baru (jika ada)
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $tmp      = $_FILES['video']['tmp_name'];
        $name     = basename($_FILES['video']['name']);
        $newVideo = "uploads/" . uniqid() . "_" . $name;
        $fullPath = __DIR__ . '/../' . $newVideo;
        if (move_uploaded_file($tmp, $fullPath)) {
            if ($oldVideo && file_exists(__DIR__ . '/../' . $oldVideo)) {
                @unlink(__DIR__ . '/../' . $oldVideo);
            }
            $videoPath = $newVideo;
        } else {
            $alert = "Gagal mengupload video baru.";
        }
    } else {
        $videoPath = $oldVideo;
    }

    if (!$alert) {
        $sql = "
            UPDATE mobil SET
              nama_mobil = ?,
              id_merek = ?,
              id_kategori = ?,
              harga = ?,
              video_url = ?,
              video = ?
            WHERE id_mobil = ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "siiissi",
            $nama_mobil,
            $id_merek,
            $id_kategori,
            $harga,
            $video_url,
            $videoPath,
            $id
        );

        if ($stmt->execute()) {
            $stmt->close();

            // 🔽 Proses upload gambar hanya jika update berhasil
            if (!empty($_FILES['gambar']['name'][0])) {
                $totalFiles = count($_FILES['gambar']['name']);
                for ($i = 0; $i < $totalFiles; $i++) {
                    $tmpName  = $_FILES['gambar']['tmp_name'][$i];
                    $fileName = basename($_FILES['gambar']['name'][$i]);
                    $ext      = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newName  = 'uploads/' . uniqid() . '.' . $ext;

                    if (move_uploaded_file($tmpName, __DIR__ . '/../' . $newName)) {
                        $stmt2 = $conn->prepare("INSERT INTO gambar_mobil (id_mobil, gambar) VALUES (?, ?)");
                        $stmt2->bind_param("is", $id, $newName);
                        $stmt2->execute();
                        $stmt2->close();
                    }
                }
            }

            // Tampilkan popup, lalu redirect ke index.php
            echo '<script>
                    alert("Anda berhasil mengedit mobil");
                    window.location.href = "index.php";
                  </script>';
            exit;
        } else {
            $alert = "Gagal menyimpan perubahan: " . $stmt->error;
            $stmt->close();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Mobil</title>
  <link rel="stylesheet" href="assets/css/edit-mobil.css">
</head>
<body>
  <div class="container">
    <h1>Edit Mobil</h1>
    <a href="index.php" class="btn-back">← Kembali ke Daftar</a>

    <?php if ($alert): ?>
      <p class="alert"><?= htmlspecialchars($alert) ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Mobil</label>
        <input name="nama_mobil" type="text" value="<?= htmlspecialchars($nama_mobil) ?>" required>
      </div>

      <div class="form-inline">
        <div class="form-group">
          <label>Merek</label>
          <select name="id_merek" required>
            <option value="">-- Pilih Merek --</option>
            <?php while($m = $merekResult->fetch_assoc()): ?>
              <option value="<?= $m['id_merek'] ?>" <?= $m['id_merek']==$id_merek ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['nama_merek']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while($k = $kategoriResult->fetch_assoc()): ?>
              <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori']==$id_kategori ? 'selected' : '' ?>>
                <?= htmlspecialchars($k['nama_kategori']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label>Harga</label>
        <input name="harga" type="number" value="<?= $harga ?>" required>
      </div>

      <div class="form-group">
        <label>Link Video (opsional)</label>
        <input name="video_url" type="url" value="<?= htmlspecialchars($video_url) ?>">
      </div>

      <div class="form-group">
        <label>Video Saat Ini</label><br>
        <?php if ($oldVideo): ?>
          <video controls>
            <source src="<?= htmlspecialchars($oldVideo) ?>" type="video/mp4">
            Browser Anda tidak mendukung tag video.
          </video>
        <?php else: ?>
          <p>(Tidak ada video)</p>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label>Upload Gambar Baru</label>
        <input type="file" name="gambar[]" accept="image/*" multiple>
      </div>

      <input type="submit" value="Update Mobil">
    </form>
  </div>
</body>
</html>