<?php
session_start();
require '../config/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data berita
$stmt = $pdo->prepare("SELECT * FROM berita WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika tidak ada data
if (!$data) {
    echo "Data tidak ditemukan.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $tanggal = $_POST['tanggal_publikasi'];
    $penulis = $_POST['penulis'];
    $status  = $_POST['status'];

    // Cek apakah ada gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, '../uploads/' . $gambar);
    } else {
        $gambar = $data['gambar'];
    }

    // Update data termasuk status
    $stmt = $pdo->prepare("UPDATE berita SET judul = ?, isi = ?, gambar = ?, tanggal_publikasi = ?, penulis = ?, status = ? WHERE id = ?");
    $stmt->execute([$judul, $isi, $gambar, $tanggal, $penulis, $status, $id]);

    $_SESSION['berita_status'] = 'updated';
    header('Location: dataBerita.php');
    exit();
}
?>

<!-- Style -->
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f8;
    padding: 20px;
  }
  form {
    max-width: 550px;
    margin: 30px auto;
    padding: 25px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }
  form input, form textarea, form select {
    width: 100%;
    padding: 10px;
    margin-top: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
  }
  form textarea {
    resize: vertical;
    min-height: 100px;
  }
  form button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
  }
  form button:hover {
    background-color: #0056b3;
  }
  h2 {
    text-align: center;
    color: #333;
  }
</style>

<!-- Form Edit -->
<h2>Edit Berita</h2>
<form action="" method="POST" enctype="multipart/form-data">
  <label for="judul">Judul</label>
  <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required>

  <label for="isi">Isi Berita</label>
  <textarea name="isi" required><?= htmlspecialchars($data['isi']) ?></textarea>

  <label for="gambar">Gambar (kosongkan jika tidak ingin mengubah)</label>
  <input type="file" name="gambar">

  <label for="tanggal_publikasi">Tanggal Publikasi</label>
  <input type="date" name="tanggal_publikasi" value="<?= $data['tanggal_publikasi'] ?>" required>

  <label for="penulis">Penulis</label>
  <input type="text" name="penulis" value="<?= htmlspecialchars($data['penulis']) ?>" required>

  <label for="status">Status</label>
  <select name="status" required>
    <option value="draft" <?= $data['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
    <option value="publikasi" <?= $data['status'] === 'publikasi' ? 'selected' : '' ?>>Publikasi</option>
  </select>

  <button type="submit">Simpan Perubahan</button>
</form>
