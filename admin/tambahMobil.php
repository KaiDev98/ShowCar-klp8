<?php
session_start();
require '../config/db.php';                 // ← sesuaikan path config (di luar /admin)

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$koneksi = new mysqli('localhost', 'root', '', 'showroom');
if ($koneksi->connect_error) die('Koneksi gagal: '.$koneksi->connect_error);

$merek_result    = $koneksi->query("SELECT id_merek, nama_merek FROM merek");
$kategori_result = $koneksi->query("SELECT id_kategori, nama_kategori FROM kategori");

/* ===========================  PROSES SUBMIT  =========================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* --- Tangkap input --- */
    $nama_mobil  = $_POST['nama_mobil'];
    $id_merek    = $_POST['id_merek'];
    $id_kategori = $_POST['id_kategori'];
    $harga       = $_POST['harga'];

    $video_url   = $_POST['video_url']             ?? '';
    $bahan_bakar = $_POST['bahan_bakar']           ?? '';
    $transmisi   = $_POST['transmisi']             ?? '';
    $kap_mesin   = $_POST['kapasitas_mesin']       ?? '';
    $tenaga      = $_POST['tenaga']                ?? '';
    $kap_kursi   = $_POST['kapasitas_tempat_duduk']?? '';

    $spesifikasi = json_encode([
        'bahan_bakar'            => $bahan_bakar,
        'transmisi'              => $transmisi,
        'kapasitas_mesin'        => $kap_mesin,
        'tenaga'                 => $tenaga,
        'kapasitas_tempat_duduk' => $kap_kursi
    ]);

    /* --- Validasi jumlah gambar --- */
    $totalGambar = count($_FILES['gambar']['name']);
    if ($totalGambar < 5) {
        die('Minimal upload 5 gambar.');
    }

    /* --- Folder upload (⟶ satu level di atas /admin) --- */
    $webUploadDir  = 'uploads/';                          // dipakai di HTML / DB
    $diskUploadDir = dirname(__DIR__).'/'.$webUploadDir;  // path di server

    if (!is_dir($diskUploadDir)) {
        mkdir($diskUploadDir, 0777, true);
    }

    /* =================  INSERT DATA MOBIL  (tanpa kolom gambar)  ================= */
    $stmt = $koneksi->prepare("
        INSERT INTO mobil
        (nama_mobil, id_merek, id_kategori, harga,
         spesifikasi, video_url, bahan_bakar, transmisi,
         kapasitas_mesin, tenaga, kapasitas_tempat_duduk)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)
    ");
    $stmt->bind_param(
        'siiissssssi',
        $nama_mobil, $id_merek, $id_kategori, $harga,
        $spesifikasi, $video_url, $bahan_bakar, $transmisi,
        $kap_mesin, $tenaga, $kap_kursi
    );
    if (!$stmt->execute()) {
        die('Gagal insert mobil: '.$stmt->error);
    }

    $id_mobil = $stmt->insert_id;
    $stmt->close();

    /* =================  UPLOAD SEMUA GAMBAR  ================= */
    for ($i = 0; $i < $totalGambar; $i++) {
        if ($_FILES['gambar']['error'][$i] !== 0) {
            continue; // Lewati file yang error
        }

        $fileName   = time().'_'.basename($_FILES['gambar']['name'][$i]);
        $targetPath = $diskUploadDir.$fileName; // path fisik

        if (move_uploaded_file($_FILES['gambar']['tmp_name'][$i], $targetPath)) {
            $stmtImg = $koneksi->prepare("
                INSERT INTO gambar_mobil (id_mobil, gambar)
                VALUES (?, ?)
            ");
            $stmtImg->bind_param('is', $id_mobil, $fileName);
            $stmtImg->execute();
            $stmtImg->close();
        }
    }

    // Tampilkan popup “Anda berhasil menambahkan mobil” lalu redirect
    echo '<script>
            alert("Anda berhasil menambahkan mobil");
            window.location.href = "dataMobil.php";
          </script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mobil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
  <div class="max-w-2xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-semibold mb-4">Tambah Mobil</h2>
    <form method="POST" enctype="multipart/form-data">
      <!-- Nama Mobil -->
      <div class="mb-4">
        <label class="block">Nama Mobil</label>
        <input type="text" name="nama_mobil" required class="w-full border p-2 rounded">
      </div>

      <!-- Merek -->
      <div class="mb-4">
        <label class="block">Merek</label>
        <select name="id_merek" required class="w-full border p-2 rounded">
          <option value="">-- Pilih Merek --</option>
          <?php while ($merek = $merek_result->fetch_assoc()): ?>
            <option value="<?= $merek['id_merek'] ?>"><?= htmlspecialchars($merek['nama_merek']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Kategori -->
      <div class="mb-4">
        <label class="block">Kategori</label>
        <select name="id_kategori" required class="w-full border p-2 rounded">
          <option value="">-- Pilih Kategori --</option>
          <?php while ($kategori = $kategori_result->fetch_assoc()): ?>
            <option value="<?= $kategori['id_kategori'] ?>"><?= htmlspecialchars($kategori['nama_kategori']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Harga -->
      <div class="mb-4">
        <label class="block">Harga</label>
        <input type="number" name="harga" required class="w-full border p-2 rounded">
      </div>

      <!-- Upload Gambar -->
      <div class="mb-4">
        <label class="block">Upload Gambar (Minimal 5)</label>
        <input type="file" name="gambar[]" accept="image/*" multiple required class="w-full border p-2 rounded">
      </div>

      <!-- Spesifikasi -->
      <div class="mb-4">
        <label class="block">Bahan Bakar</label>
        <input type="text" name="bahan_bakar" class="w-full border p-2 rounded">
      </div>

      <div class="mb-4">
        <label class="block">Transmisi</label>
        <input type="text" name="transmisi" class="w-full border p-2 rounded">
      </div>

      <div class="mb-4">
        <label class="block">Kapasitas Mesin</label>
        <input type="text" name="kapasitas_mesin" class="w-full border p-2 rounded">
      </div>

      <div class="mb-4">
        <label class="block">Tenaga</label>
        <input type="text" name="tenaga" class="w-full border p-2 rounded">
      </div>

      <div class="mb-4">
        <label class="block">Kapasitas Tempat Duduk</label>
        <input type="text" name="kapasitas_tempat_duduk" class="w-full border p-2 rounded">
      </div>

      <div class="mb-4">
        <label class="block">Video URL</label>
        <input type="text" name="video_url" class="w-full border p-2 rounded">
      </div>

      <div class="text-right">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>

