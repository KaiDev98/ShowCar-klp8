<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['berita_status'])) {
    $status = $_SESSION['berita_status'];
    unset($_SESSION['berita_status']);

    echo "<script>";
    if ($status === 'deleted') {
        echo "alert('Berita berhasil dihapus.');";
    } elseif ($status === 'delete_failed') {
        echo "alert('Gagal menghapus berita.');";
    } elseif ($status === 'invalid_id') {
        echo "alert('ID berita tidak valid.');";
    }
    echo "</script>";
}

if (isset($_SESSION['berita_status'])) {
    if ($_SESSION['berita_status'] === 'updated') {
        echo "<script>alert('Berita berhasil diperbarui.');</script>";
    }
    unset($_SESSION['berita_status']);
}

$koneksi = new mysqli("localhost", "root", "", "showroom");
$result = $koneksi->query("SELECT * FROM berita");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Berita - AdminMobil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white flex flex-col">
      <div class="p-6 text-2xl font-bold border-b border-blue-500">📰 AdminMobil</div>
      <nav class="flex-1 p-4 space-y-2">
        <a href="dashboardAdmin.php" class="block px-4 py-2 rounded hover:bg-blue-600">Dashboard</a>
        <a href="dataPengguna.php" class="block px-4 py-2 rounded hover:bg-blue-600">📋 Data Pengguna</a>
        <a href="dataMobil.php" class="block px-4 py-2 rounded hover:bg-blue-600">🚘 Data Mobil</a>
        <a href="dataBooking.php" class="block px-4 py-2 rounded hover:bg-blue-600">📅 Data Booking</a>
        <a href="dataReview.php" class="block px-4 py-2 rounded hover:bg-blue-600">📝 Data Review</a>
        <a href="dataBerita.php" class="block px-4 py-2 rounded bg-blue-600">📰 Data Berita</a>
      </nav>
      <div class="p-4 text-sm text-center border-t border-blue-500">&copy; 2025 AdminMobil</div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white p-4 shadow flex justify-between items-center mb-6">
        <div class="text-lg font-semibold">Dashboard Admin</div>
        <div class="flex items-center space-x-4">
          <input type="text" placeholder="Search..." class="px-3 py-1 border rounded-md" />
          <img src="assets/img/logo.png" alt="Admin" class="w-8 h-8 rounded-full" />
          <span class="text-sm"><?= htmlspecialchars($_SESSION['admin_username']) ?></span>
          <a href="logout.php" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Logout</a>
        </div>
      </header>

<!-- Content -->
<main class="p-6 overflow-auto">
  <div class="bg-white shadow rounded-lg p-6">
    <!-- Header Judul + Tombol -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold">Data Berita</h2>
      <a href="tambahBerita.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">➕ Tambah Berita</a>
    </div>

    <!-- Tabel Berita -->
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-left border border-gray-200">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="p-2 border">#</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Isi</th>
            <th class="p-2 border">Gambar</th>
            <th class="p-2 border">Tanggal Publikasi</th>
            <th class="p-2 border">Penulis</th>
            <th class="p-2 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr class="hover:bg-gray-100">
              <td class="p-2 border"><?= $no++ ?></td>
              <td class="p-2 border"><?= htmlspecialchars($row['judul']) ?></td>
              <td class="p-2 border"><?= htmlspecialchars($row['isi']) ?></td>
              <td class="p-2 border">
                <?php if ($row['gambar']): ?>
                  <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Gambar" class="w-16 h-10 object-cover rounded" />
                <?php else: ?>
                  <span class="text-gray-400 italic">Tidak ada</span>
                <?php endif; ?>
              </td>
              <td class="p-2 border"><?= htmlspecialchars($row['tanggal_publikasi']) ?></td>
              <td class="p-2 border"><?= htmlspecialchars($row['penulis']) ?></td>
              <td class="p-2 border flex gap-2">
                <a href="editBerita.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-800" title="Edit">
                  🖊️
                </a>
                <a href="hapusBerita.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus berita ini?')" class="text-red-600 hover:text-red-800" title="Hapus">
                  ❌
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
  <script>
    function logout() {
      window.location.href = 'logout.php';
    }
  </script>
</body>
</html>
