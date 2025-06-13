<?php
include 'koneksi.php';
session_start();

$success = false;
$error = "";

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama_lengkap     = trim($_POST['nama_lengkap']);
    $email            = trim($_POST['email']);
    $no_hp            = trim($_POST['no_hp']);
    $tanggal_lahir    = $_POST['tanggal_lahir'];
    $gender           = $_POST['gender'];
    $alamat           = trim($_POST['alamat']);
    $kota             = trim($_POST['kota']);
    $merk_mobil       = trim($_POST['merk_mobil']);
    $waktu_testdrive  = $_POST['waktu_testdrive'];
    $pertanyaan       = !empty($_POST['pertanyaan']) ? trim($_POST['pertanyaan']) : null;

    if (!isset($_POST['agree'])) {
        $error = "Anda harus menyetujui Kebijakan Privasi.";
    } else {
        $sql = "INSERT INTO booking_test_drive (
                    nama_lengkap, email, no_hp, tanggal_lahir, gender, alamat, kota, 
                    merk_mobil, waktu_testdrive, pertanyaan, status
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssss",
            $nama_lengkap, $email, $no_hp, $tanggal_lahir, $gender, $alamat,
            $kota, $merk_mobil, $waktu_testdrive, $pertanyaan
        );

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Gagal menyimpan data: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Booking Test Drive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f7f7;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 700px;
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-top: 40px;
    }
    .form-label {
      font-weight: bold;
    }
    .notif {
      padding: 10px;
      margin-bottom: 20px;
    }
    .notif.success {
      background-color: #d4edda;
      color: #155724;
      border-left: 5px solid #28a745;
    }
    .notif.error {
      background-color: #f8d7da;
      color: #721c24;
      border-left: 5px solid #dc3545;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4">📋 Form Booking Test Drive</h2>

      <?php if ($success): ?>
        <div class="notif success">✅ Booking berhasil dikirim. Kami akan segera menghubungi Anda.</div>
        <div class="mt-3">
          <a href="pengguna.php" class="btn btn-success">⬅ Kembali ke Halaman Pengguna</a>
        </div>
      <?php elseif (!empty($error)): ?>
      <div class="notif error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <h5 class="mb-3">Informasi Pribadi</h5>

      <div class="mb-3">
        <label class="form-label" for="nama_lengkap">Nama Lengkap*</label>
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="email">Email*</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="no_hp">No. Handphone*</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="tanggal_lahir">Tanggal Lahir*</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="gender">Jenis Kelamin*</label>
        <select class="form-select" id="gender" name="gender" required>
          <option value="">-- Pilih --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label" for="alamat">Alamat*</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
      </div>

      <h5 class="mt-4 mb-3">Detail Booking</h5>

      <div class="mb-3">
        <label class="form-label" for="kota">Kota*</label>
        <input type="text" class="form-control" id="kota" name="kota" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="merk_mobil">Merk Mobil*</label>
        <input type="text" class="form-control" id="merk_mobil" name="merk_mobil" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="waktu_testdrive">Waktu Test Drive*</label>
        <input type="datetime-local" class="form-control" id="waktu_testdrive" name="waktu_testdrive" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="pertanyaan">Pertanyaan Tambahan</label>
        <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3"></textarea>
      </div>

      <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
        <label class="form-check-label" for="agree">
          Saya setuju dengan <a href="#">Kebijakan Privasi</a>.
        </label>
      </div>

      <div class="d-grid">
        <button type="submit" name="submit" class="btn btn-primary btn-lg">Kirim Booking</button>
      </div>
    </form>
  </div>
</body>
</html>
