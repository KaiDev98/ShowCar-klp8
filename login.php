<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "showroom";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if ($userData && password_verify($password, $userData['password'])) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['username'] = $userData['username'];
        $_SESSION['email'] = $userData['email']; // ✅ FIX: simpan email
        header("Location: pengguna.php");
        exit;
    } else {
        $message = "Email atau kata sandi salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login SOCA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3f1f3;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
      max-width: 600px;
      width: 100%;
      background-color: white;
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .login-container h2 {
      font-weight: bold;
    }

    .logo span {
      font-size: 28px;
    }

    .form-label {
      font-weight: 600;
      margin-bottom: 6px;
      text-align: left;
      display: block;
    }

    .form-control {
      height: 44px;
      border-radius: 8px;
      font-size: 15px;
    }

    .btn-login {
      background-color: #ff0000;
      color: white;
      font-weight: bold;
      font-size: 18px;
      padding: 10px;
      border-radius: 10px;
      margin-top: 20px;
      width: 100%;
    }

    .btn-login:hover {
      background-color: #cc0000;
    }

    .small-link {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="login-container">
      <div class="logo mb-3">
        <span style="color:red;font-weight:bold;">So</span><span style="color:black;font-weight:bold;">Car</span> 🚗
      </div>
      <h2 class="mb-2">Login ke SOCA</h2>
      <p class="small-link mb-4">Belum punya Akun SOCA? <a href="register.php" class="text-danger">Daftar</a></p>

      <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= $message ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3 text-start">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
        </div>
        <div class="mb-3 text-start">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
        </div>

        <button type="submit" class="btn btn-login">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
