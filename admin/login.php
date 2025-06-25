<?php
session_start();
include 'config/db.php';

// Jika sudah login, arahkan ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboardAdmin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $data['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $data['username'];

            header("Location: dashboardAdmin.php");
            exit();
        } else {
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white p-8 rounded shadow w-80">
    <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Login Admin</h2>
    <?php if (isset($error)) : ?>
      <p class="text-red-500 text-sm mb-4"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" class="w-full px-3 py-2 mb-4 border rounded" required />
      <input type="password" name="password" placeholder="Password" class="w-full px-3 py-2 mb-4 border rounded" required />
      <button type="submit" class="w-full bg-blue-700 text-white py-2 rounded hover:bg-blue-800">Login</button>
    </form>
  </div>
</body>
</html>
