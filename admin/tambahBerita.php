<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal_publikasi'];
    $penulis = $_POST['penulis'];
    $mobil_id = $_POST['id_mobil'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $upload_path = '../uploads/' . $gambar;

    if (move_uploaded_file($tmp, $upload_path)) {
        $stmt = $conn->prepare("INSERT INTO berita (judul, isi, gambar, tanggal_publikasi, penulis, id_mobil) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $penulis, $mobil_id);
        if ($stmt->execute()) {
            $_SESSION['berita_status'] = 'success';
            header('Location: dataBerita.php');
            exit();
        } else {
            $_SESSION['berita_status'] = 'error';
        }
    } else {
        $_SESSION['berita_status'] = 'upload_failed';
    }

    // Tetap di halaman tambah jika gagal
    header('Location: tambahBerita.php');
    exit();
}
?>


<!-- HTML START -->
<?php
// Tampilkan notifikasi jika ada status
if (isset($_SESSION['berita_status'])) {
    $status = $_SESSION['berita_status'];
    unset($_SESSION['berita_status']); // Clear setelah ditampilkan
    echo "<script>";
    if ($status === 'success') {
        echo "alert('Berita berhasil ditambahkan!');";
    } elseif ($status === 'error') {
        echo "alert('Terjadi kesalahan saat menyimpan berita.');";
    } elseif ($status === 'upload_failed') {
        echo "alert('Gagal mengupload gambar.');";
    }
    echo "</script>";
}
?>

<!-- Style & Form -->
<style>
  form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
  }
  input[type="text"],
  input[type="date"],
  input[type="file"],
  textarea,
  select {
    width: 100%;
    padding: 8px;
    margin-top: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  button {
    padding: 10px 15px;
    background-color: #007BFF;
    border: none;
    color: white;
    border-radius: 4px;
    cursor: pointer;
  }
  button:hover {
    background-color: #0056b3;
  }
</style>

<form action="" method="POST" enctype="multipart/form-data">
  <input type="text" name="judul" placeholder="Judul" required><br>
  <textarea name="isi" placeholder="Isi berita" required></textarea><br>
  <input type="file" name="gambar" required><br>
  <input type="date" name="tanggal_publikasi" required><br>
  <input type="text" name="penulis" placeholder="Penulis" required><br>

  <!-- Dropdown mobil -->
  <?php
  $mobil_result = $conn->query("SELECT id_mobil, nama_mobil FROM mobil ORDER BY nama_mobil");
  ?>
  <select name="id_mobil" required>
    <option value="">-- Pilih Mobil --</option>
    <?php while ($mobil = $mobil_result->fetch_assoc()): ?>
      <option value="<?= $mobil['id_mobil'] ?>"><?= htmlspecialchars($mobil['nama_mobil']) ?></option>
    <?php endwhile; ?>
  </select>

  <button type="submit">Tambah Berita</button>
</form>
