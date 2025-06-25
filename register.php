<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "showroom";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Cek apakah email sudah terdaftar
    $cek = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        $message = "<div class='alert alert-danger'>Email sudah terdaftar. Silakan gunakan email lain.</div>";
    } else {
        // Simpan ke database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['register_success'] = $username; // ✅ Set flag sukses
            header("Location: register.php"); // ✅ Redirect ulang
            exit;
        } else {
            $message = "<div class='alert alert-danger'>Gagal mendaftar: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

    $cek->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar SOCA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #f1f0f2;
    }
    .register-box {
      max-width: 400px;
      background-color: white;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .btn-daftar {
      background-color: #ff0000;
      color: white;
      font-weight: bold;
      font-size: 18px;
      border-radius: 8px;
    }
    .btn-daftar:hover {
      background-color: #cc0000;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.1rem rgba(0,123,255,.25);
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="register-box text-center">
      <h3 class="mb-1"><span style="color: red;">So</span><span style="color: black;">Car 🚗</span></h3>
      <h4 class="fw-bold mb-2">Daftar Sekarang</h4>
      <p class="mb-4">Sudah punya Akun SOCA? <a href="login.php" class="text-danger fw-semibold">Masuk</a></p>

      <!-- Pesan dari PHP -->
      <?php if ($message): ?>
        <?= $message ?>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3 text-start">
          <input type="text" class="form-control" placeholder="Masukkan username anda" name="username" required>
        </div>
        <div class="mb-3 text-start">
          <input type="email" class="form-control" placeholder="example@gmail.com" name="email" required>
        </div>
        <div class="mb-3 text-start">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>

        <p class="text-start small">Pastikan Email yang anda Masukkan aktif</p>

        <div class="form-check text-start mb-3">
          <input class="form-check-input" type="checkbox" id="privacyCheck" required checked>
          <label class="form-check-label small" for="privacyCheck">
            Dengan mendaftar, saya menyetujui <a href="#" class="text-danger">Kebijakan Privasi</a>
          </label>
        </div>

        <button type="submit" class="btn btn-daftar w-100">Daftar</button>
      </form>
    </div>
  </div>

  <?php if (isset($_SESSION['register_success'])): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Registrasi Berhasil!',
        text: 'Selamat datang, <?= $_SESSION['register_success'] ?>! Silakan login untuk melanjutkan.',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = 'login.php';
      });
    </script>
    <?php unset($_SESSION['register_success']); ?>
  <?php endif; ?>
</body>
</html>
