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
    SELECT nama_mobil, id_merek, id_kategori, harga, video_url, video, bahan_bakar, transmisi, kapasitas_mesin, tenaga, kapasitas_tempat_duduk 
    FROM mobil 
    WHERE id_mobil = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nama_mobil, $id_merek, $id_kategori, $harga, $video_url, $oldVideo, $bahan_bakar, $transmisi, $kapasitas_mesin, $tenaga, $kapasitas_tempat_duduk);
if (!$stmt->fetch()) {
    header("Location: index.php");
    exit;
}
$stmt->close();

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mobil  = trim($_POST['nama_mobil']);
    $id_merek    = (int) $_POST['id_merek'];
    $id_kategori = (int) $_POST['id_kategori'];
    $harga       = (int) $_POST['harga'];
    $video_url   = trim($_POST['video_url']);
    $bahan_bakar = trim($_POST['bahan_bakar']);
    $transmisi   = trim($_POST['transmisi']);
    $kapasitas_mesin = trim($_POST['kapasitas_mesin']);
    $tenaga = trim($_POST['tenaga']);
    $kapasitas_tempat_duduk = (int) $_POST['kapasitas_tempat_duduk'];

    // Upload video baru jika ada
    $videoPath = $oldVideo;
    if (!empty($_FILES['video']['name']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $tmp  = $_FILES['video']['tmp_name'];
        $name = basename($_FILES['video']['name']);
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
    }

    if (!$alert) {
        $sql = "
            UPDATE mobil SET
              nama_mobil = ?, id_merek = ?, id_kategori = ?, harga = ?, video_url = ?, video = ?,
              bahan_bakar = ?, transmisi = ?, kapasitas_mesin = ?, tenaga = ?, kapasitas_tempat_duduk = ?
            WHERE id_mobil = ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "siiisssssiii",
            $nama_mobil, $id_merek, $id_kategori, $harga, $video_url, $videoPath,
            $bahan_bakar, $transmisi, $kapasitas_mesin, $tenaga, $kapasitas_tempat_duduk, $id
        );

        if ($stmt->execute()) {
            $stmt->close();

            // Upload gambar baru
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

            $success = true;
        } else {
            $alert = "Gagal menyimpan perubahan ke database.";
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="container">
    <h1>Edit Mobil</h1>
    <a href="index.php" class="btn-back">← Kembali ke Daftar</a>

    <?php if ($alert): ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: <?= json_encode($alert) ?>,
            confirmButtonText: "OK"
          });
        });
      </script>
    <?php elseif ($success): ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: "Data mobil berhasil diperbarui.",
            confirmButtonText: "OK"
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "dataMobil.php";
            }
          });
        });
      </script>
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
            <?php while ($m = $merekResult->fetch_assoc()): ?>
              <option value="<?= $m['id_merek'] ?>" <?= $m['id_merek'] == $id_merek ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['nama_merek']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Kategori</label>
          <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while ($k = $kategoriResult->fetch_assoc()): ?>
              <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori'] == $id_kategori ? 'selected' : '' ?>>
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
        <label>Bahan Bakar</label>
        <input name="bahan_bakar" type="text" value="<?= htmlspecialchars($bahan_bakar) ?>">
      </div>

      <div class="form-group">
        <label>Transmisi</label>
        <input name="transmisi" type="text" value="<?= htmlspecialchars($transmisi) ?>">
      </div>

      <div class="form-group">
        <label>Kapasitas Mesin</label>
        <input name="kapasitas_mesin" type="text" value="<?= htmlspecialchars($kapasitas_mesin) ?>">
      </div>

      <div class="form-group">
        <label>Tenaga</label>
        <input name="tenaga" type="text" value="<?= htmlspecialchars($tenaga) ?>">
      </div>

      <div class="form-group">
        <label>Kapasitas Tempat Duduk</label>
        <input name="kapasitas_tempat_duduk" type="number" value="<?= $kapasitas_tempat_duduk ?>">
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
        <label>Upload Video Baru (Opsional)</label>
        <input type="file" name="video" accept="video/*">
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
