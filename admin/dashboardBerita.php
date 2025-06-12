<?php
session_start();
require 'config/db.php';

// Cek login dan role
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'pengelola') {
    header("Location: login.php");
    exit();
}

// Ambil data berita dari database
$query = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Pengelola Berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white min-h-screen">
      <div class="p-6 text-2xl font-bold border-b border-blue-500">📰 BeritaMobil</div>
      <nav class="p-4 space-y-2">
        <a href="dashboardBerita.php" class="block px-4 py-2 rounded hover:bg-blue-600 bg-blue-800">📋 Kelola Berita</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Header -->
      <header class="bg-white p-4 shadow flex justify-between items-center mb-6">
        <div class="text-lg font-semibold">Dashboard Pengelola Berita</div>
        <div class="flex items-center space-x-4">
          <span class="text-sm"><?= htmlspecialchars($_SESSION['username']) ?> (<?= $_SESSION['role'] ?>)</span>
          <a href="logout.php" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Logout</a>
        </div>
      </header>

      <!-- Berita Table -->
      <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Data Berita</h2>
        <table class="w-full table-auto border-collapse border border-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="border px-4 py-2 text-left">ID</th>
              <th class="border px-4 py-2 text-left">Judul</th>
              <th class="border px-4 py-2 text-left">Tanggal</th>
              <th class="border px-4 py-2 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2"><?= $row['id_berita'] ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['judul']) ?></td>
                <td class="border px-4 py-2"><?= $row['tanggal'] ?></td>
                <td class="border px-4 py-2 space-x-2">
                  <a href="editBerita.php?id=<?= $row['id_berita'] ?>" class="text-blue-600 hover:underline">Ubah</a>
                  <a href="hapusBerita.php?id=<?= $row['id_berita'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-600 hover:underline">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
