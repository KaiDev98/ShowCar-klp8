<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = $_POST['judul'];
    $isi       = $_POST['isi'];
    $tanggal   = $_POST['tanggal_publikasi'];
    $penulis   = $_POST['penulis'];
    $status    = $_POST['status']; 

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $upload_path = 'uploads/' . $gambar;

    if (move_uploaded_file($tmp, $upload_path)) {
        $stmt = $conn->prepare("INSERT INTO berita (judul, isi, gambar, tanggal_publikasi, penulis, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $judul, $isi, $gambar, $tanggal, $penulis, $status);

        if ($stmt->execute()) {
            $_SESSION['berita_status'] = 'success';
        } else {
            $_SESSION['berita_status'] = 'error';
        }
    } else {
        $_SESSION['berita_status'] = 'upload_failed';
    }

    header('Location: tambahBerita.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Berita</title>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    form {
      max-width: 500px;
      margin: 30px auto;
      padding: 25px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
      font-family: Arial, sans-serif;
    }
    input[type="text"],
    input[type="date"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 12px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    textarea {
      height: 120px;
    }
    .btn-group {
      display: flex;
      gap: 10px;
      justify-content: space-between;
    }
    button {
      flex: 1;
      padding: 10px 0;
      border: none;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    button[name="status"][value="draft"] {
      background-color: #6c757d;
    }
    button[name="status"][value="draft"]:hover {
      background-color: #5a6268;
    }
    button[name="status"][value="publikasi"] {
      background-color: #007bff;
    }
    button[name="status"][value="publikasi"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<!-- Notifikasi SweetAlert -->
<?php
if (isset($_SESSION['berita_status'])):
    $notif = $_SESSION['berita_status'];
    unset($_SESSION['berita_status']);
?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    <?php if ($notif === 'success'): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Berita berhasil ditambahkan.',
        confirmButtonColor: '#3085d6'
      }).then(() => {
        window.location.href = 'dataBerita.php';
      });
    <?php elseif ($notif === 'error'): ?>
      Swal.fire({
        icon: 'error',
        title: 'Gagal Menyimpan!',
        text: 'Terjadi kesalahan saat menyimpan berita.',
        confirmButtonColor: '#d33'
      });
    <?php elseif ($notif === 'upload_failed'): ?>
      Swal.fire({
        icon: 'warning',
        title: 'Upload Gagal!',
        text: 'Gagal mengupload gambar.',
        confirmButtonColor: '#f0ad4e'
      });
    <?php endif; ?>
  });
</script>

<?php endif; ?>

<!-- Form Tambah Berita -->
<form action="" method="POST" enctype="multipart/form-data">
  <h2 style="text-align: center;">Tambah Berita Baru</h2>
  <input type="text" name="judul" placeholder="Judul Berita" required>
  <textarea name="isi" placeholder="Isi lengkap berita" required></textarea>
  <input type="file" name="gambar" required>
  <input type="date" name="tanggal_publikasi" required>
  <input type="text" name="penulis" placeholder="Nama Penulis" required>
  
  <div class="btn-group">
    <button type="submit" name="status" value="draft">Simpan sebagai Draft</button>
    <button type="submit" name="status" value="publikasi">Simpan & Publikasikan</button>
  </div>
</form>

</body>
</html>
