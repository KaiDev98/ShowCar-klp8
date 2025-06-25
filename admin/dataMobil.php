<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli("localhost", "root", "", "showroom");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$sql = "SELECT * FROM mobil";
$result = $koneksi->query($sql);
if (!$result) {
    die("Query error: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Mobil - AdminMobil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white flex flex-col">
      <div class="p-6 text-2xl font-bold border-b border-blue-500">🚗 AdminMobil</div>
      <nav class="flex-1 p-4 space-y-2">
        <a href="dashboardAdmin.php" class="block px-4 py-2 rounded hover:bg-blue-600">Dashboard</a>
        <a href="dataPengguna.php" class="block px-4 py-2 rounded hover:bg-blue-600">📋 Data Pengguna</a>
        <a href="dataMobil.php" class="block px-4 py-2 rounded bg-blue-600">🚘 Data Mobil</a>
        <a href="dataBooking.php" class="block px-4 py-2 rounded hover:bg-blue-600">📅 Data Booking</a>
        <a href="dataReview.php" class="block px-4 py-2 rounded hover:bg-blue-600">📝 Data Review</a>
        <a href="dataBerita.php" class="block px-4 py-2 rounded hover:bg-blue-600">📰 Data Berita</a>
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
          <span class="text-sm"><?= htmlspecialchars($_SESSION['admin_username']); ?></span>
          <button id="btn-logout" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Logout</button>
        </div>
      </header>

      <!-- Content -->
      <main class="p-6 overflow-auto">
        <div class="bg-white shadow rounded-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Data Mobil</h2>
            <a href="tambahMobil.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Mobil</a>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
              <thead class="bg-blue-600 text-white">
                <tr>
                  <th class="p-2 border">#</th>
                  <th class="p-2 border">Nama Mobil</th>
                  <th class="p-2 border">Harga</th>
                  <th class="p-2 border">Bahan Bakar</th>
                  <th class="p-2 border">Transmisi</th>
                  <th class="p-2 border">Mesin</th>
                  <th class="p-2 border">Tenaga</th>
                  <th class="p-2 border">Kapasitas</th>
                  <th class="p-2 border">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                  <tr class="hover:bg-gray-100">
                    <td class="p-2 border"><?= $no++; ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['nama_mobil']); ?></td>
                    <td class="p-2 border">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['bahan_bakar']); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['transmisi']); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['kapasitas_mesin']); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['tenaga']); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['kapasitas_tempat_duduk']); ?> org</td>
                    <td class="p-2 border space-x-2">
                      <a href="editMobil.php?id=<?= $row['id_mobil']; ?>" class="text-blue-600 hover:text-blue-800" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" 
                         class="btn-hapus text-red-600 hover:text-red-800" 
                         data-id="<?= $row['id_mobil']; ?>" 
                         data-nama="<?= htmlspecialchars($row['nama_mobil']); ?>" 
                         title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- SweetAlert2 Script -->
  <script>
    // Hapus Mobil
    document.querySelectorAll('.btn-hapus').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        const nama = this.getAttribute('data-nama');

        Swal.fire({
          title: 'Hapus Mobil?',
          text: `Apakah Anda yakin ingin menghapus mobil "${nama}"?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `hapusMobil.php?id=${id}`;
          }
        });
      });
    });

    // Logout Admin
    document.getElementById('btn-logout').addEventListener('click', function (e) {
      e.preventDefault();
      Swal.fire({
        title: 'Konfirmasi Logout',
        text: "Apakah Anda yakin ingin keluar?",
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
