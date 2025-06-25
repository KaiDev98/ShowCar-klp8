<?php
session_start();
require 'config/db.php';

// Cek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Ambil data dari database
$total_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_mobil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mobil"))['total'];
$total_berita = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM berita"))['total'];
$total_review = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM review"))['total'];
$total_booking_tes_drive = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking_test_drive"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white min-h-screen">
      <div class="p-6 text-2xl font-bold border-b border-blue-500">🚗 AdminMobil</div>
      <nav class="p-4 space-y-2">
        <a href="dataPengguna.php" class="block px-4 py-2 rounded hover:bg-blue-600">📋 Data Pengguna</a>
        <a href="dataMobil.php" class="block px-4 py-2 rounded hover:bg-blue-600">🚘 Data Mobil</a>
        <a href="dataBooking.php" class="block px-4 py-2 rounded hover:bg-blue-600">📅 Data Booking</a>
        <a href="dataReview.php" class="block px-4 py-2 rounded hover:bg-blue-600">📝 Data Review</a>
        <a href="dataBerita.php" class="block px-4 py-2 rounded hover:bg-blue-600">📰 Data Berita</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Header -->
      <header class="bg-white p-4 shadow flex justify-between items-center mb-6">
        <div class="text-lg font-semibold">Dashboard Admin</div>
        <div class="flex items-center space-x-4">
          <input type="text" placeholder="Search..." class="px-3 py-1 border rounded-md" />
          <img src="assets/img/logo.png" alt="Admin" class="w-8 h-8 rounded-full" />
          <span class="text-sm"><?= htmlspecialchars($_SESSION['admin_username']) ?></span>
          <button id="logoutBtn" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Logout</button>
        </div>
      </header>

      <!-- Dynamic Panels -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg">
          <h3 class="text-sm text-gray-500">Total Pengguna</h3>
          <p class="text-2xl font-bold text-blue-700"><?= $total_user ?></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg">
          <h3 class="text-sm text-gray-500">Total Mobil</h3>
          <p class="text-2xl font-bold text-green-600"><?= $total_mobil ?></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg">
          <h3 class="text-sm text-gray-500">Total Berita</h3>
          <p class="text-2xl font-bold text-yellow-600"><?= $total_berita ?></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg">
          <h3 class="text-sm text-gray-500">Total Booking Test Drive</h3>
          <p class="text-2xl font-bold text-pink-600"><?= $total_booking_tes_drive ?></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg">
          <h3 class="text-sm text-gray-500">Total Review</h3>
          <p class="text-2xl font-bold text-indigo-600"><?= $total_review ?></p>
        </div>
      </div>
    </main>
  </div>

  <script>
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
      e.preventDefault();
      Swal.fire({
        title: 'Konfirmasi Logout',
        text: "Anda yakin ingin keluar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'logout.php';
        }
      });
    });
  </script>
</body>
</html>
