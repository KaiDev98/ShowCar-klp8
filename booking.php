<?php
include 'koneksi.php';
session_start();

$success = false;
$error = "";

// Cek apakah ada id mobil dari URL
$id_mobil = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id_mobil <= 0) {
    die("Mobil tidak valid.");
}

// Ambil nama mobil berdasarkan id
$query = $conn->prepare("SELECT nama_mobil FROM mobil WHERE id_mobil = ?");
$query->bind_param("i", $id_mobil);
$query->execute();
$result = $query->get_result();
if ($result->num_rows === 0) {
    die("Mobil tidak ditemukan.");
}
$mobil = $result->fetch_assoc();
$nama_mobil = $mobil['nama_mobil'];

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama_lengkap     = trim($_POST['nama_lengkap']);
    $email            = trim($_POST['email']);
    $no_hp            = trim($_POST['no_hp']);
    $tanggal_lahir    = $_POST['tanggal_lahir'];
    $gender           = $_POST['gender'];
    $alamat           = trim($_POST['alamat']);
    $kota             = trim($_POST['kota']);
    $waktu_testdrive  = $_POST['waktu_testdrive'];
    $pertanyaan       = !empty($_POST['pertanyaan']) ? trim($_POST['pertanyaan']) : null;

    if (!isset($_POST['agree'])) {
        $error = "Anda harus menyetujui Kebijakan Privasi.";
    } elseif (!preg_match('/^[0-9]{1,12}$/', $no_hp)) {
        $error = "Nomor HP tidak valid. Harus berupa angka dan maksimal 12 digit.";
    } else {
        $sql = "INSERT INTO booking_test_drive (
                    id_mobil, nama_lengkap, email, no_hp, tanggal_lahir, gender, alamat, kota, 
                    waktu_testdrive, pertanyaan, status
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "isssssssss",
            $id_mobil, $nama_lengkap, $email, $no_hp, $tanggal_lahir, $gender,
            $alamat, $kota, $waktu_testdrive, $pertanyaan
        );

        if ($stmt->execute()) {
            $_SESSION['booking_success'] = true;
            header("Location: booking.php?id=" . $id_mobil);
            exit;
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4">📋 Booking Test Drive: <?= htmlspecialchars($nama_mobil) ?></h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
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
        <label for="no_hp" class="form-label">Nomor HP</label>
        <input type="text" class="form-control" name="no_hp" id="no_hp"
               pattern="[0-9]{1,12}" maxlength="12" inputmode="numeric" required
               title="Masukkan maksimal 12 digit angka saja.">
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

  <!-- JavaScript untuk mencegah karakter non-angka & lebih dari 12 digit -->
  <script>
    document.getElementById('no_hp').addEventListener('input', function () {
      this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);
    });
  </script>

  <?php if (isset($_SESSION['booking_success'])): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Booking Berhasil!',
        text: 'Kami akan segera menghubungi Anda.',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = 'pengguna.php';
      });
    </script>
    <?php unset($_SESSION['booking_success']); ?>
  <?php endif; ?>
</body>
</html>
