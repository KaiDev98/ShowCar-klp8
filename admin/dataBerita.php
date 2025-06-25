<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Filter tab
$status_filter = '';
if (isset($_GET['tab'])) {
    if ($_GET['tab'] === 'publikasi') {
        $status_filter = "WHERE status = 'publikasi'";
    } elseif ($_GET['tab'] === 'draft') {
        $status_filter = "WHERE status = 'draft'";
    }
}

// Ambil data berita
$result = mysqli_query($conn, "SELECT * FROM berita $status_filter ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Berita - AdminMobil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
          <button id="logoutBtn" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Logout</button>
        </div>
      </header>

      <!-- Content -->
      <main class="p-6 overflow-auto">
        <div class="bg-white shadow rounded-lg p-6">
          <!-- Header + Tabs -->
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Data Berita</h2>
            <a href="tambahBerita.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">➕ Tambah Berita</a>
          </div>

          <!-- Tabs -->
          <div class="mb-4 border-b">
            <a href="dataBerita.php" class="inline-block px-4 py-2 <?= !isset($_GET['tab']) ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-500' ?>">Semua Berita</a>
            <a href="dataBerita.php?tab=publikasi" class="inline-block px-4 py-2 <?= ($_GET['tab'] ?? '') === 'publikasi' ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-500' ?>">Terpublikasi</a>
            <a href="dataBerita.php?tab=draft" class="inline-block px-4 py-2 <?= ($_GET['tab'] ?? '') === 'draft' ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-500' ?>">Draft</a>
          </div>

          <!-- Tabel -->
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
                  <th class="p-2 border">Status</th>
                  <th class="p-2 border">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                  <tr class="hover:bg-gray-100">
                    <td class="p-2 border"><?= $no++ ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['judul']) ?></td>
                    <td class="p-2 border"><?= substr(strip_tags($row['isi']), 0, 80) ?>...</td>
                    <td class="p-2 border">
                      <?php if (!empty($row['gambar'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Gambar" class="w-16 h-10 object-cover rounded" />
                      <?php else: ?>
                        <span class="text-gray-400 italic">Tidak ada</span>
                      <?php endif; ?>
                    </td>
                    <td class="p-2 border"><?= htmlspecialchars($row['tanggal_publikasi']) ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['penulis']) ?></td>
                    <td class="p-2 border">
                      <?php if ($row['status'] === 'publikasi'): ?>
                        <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Terpublikasi</span>
                      <?php elseif ($row['status'] === 'draft'): ?>
                        <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded">Draft</span>
                      <?php else: ?>
                        <span class="text-gray-500 italic">Tidak diketahui</span>
                      <?php endif; ?>
                    </td>
                    <td class="p-2 border whitespace-nowrap">
                      <div class="flex gap-3">
                        <a href="editBerita.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-800" title="Edit">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" onclick="confirmHapus(<?= $row['id'] ?>)" class="text-red-600 hover:text-red-800" title="Hapus">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      </div>
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

  <script>
    // SweetAlert konfirmasi hapus
    function confirmHapus(id) {
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Berita yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "hapusBerita.php?id=" + id;
        }
      });
    }

    // Logout SweetAlert
    document.getElementById("logoutBtn").addEventListener("click", function () {
      Swal.fire({
        title: 'Keluar?',
        text: "Anda yakin ingin logout?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "logout.php";
        }
      });
    });
  </script>

  <!-- Status Feedback -->
  <?php if (isset($_SESSION['berita_status'])): ?>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        <?php
          $status = $_SESSION['berita_status'];
          unset($_SESSION['berita_status']);

          if ($status === 'deleted') {
              echo "Swal.fire('Berhasil', 'Berita berhasil dihapus.', 'success');";
          } elseif ($status === 'delete_failed') {
              echo "Swal.fire('Gagal', 'Gagal menghapus berita.', 'error');";
          } elseif ($status === 'invalid_id') {
              echo "Swal.fire('Error', 'ID berita tidak valid.', 'warning');";
          } elseif ($status === 'updated') {
              echo "Swal.fire('Berhasil', 'Berita berhasil diperbarui.', 'success');";
          } elseif ($status === 'added') {
              echo "Swal.fire('Berhasil', 'Berita berhasil ditambahkan.', 'success');";
          }
        ?>
      });
    </script>
  <?php endif; ?>
</body>
</html>
