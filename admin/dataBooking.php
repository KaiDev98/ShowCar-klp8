<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Mengambil data booking beserta nama mobil via JOIN
$query = "SELECT b.*, m.nama_mobil 
          FROM booking_test_drive b
          JOIN mobil m ON b.id_mobil = m.id_mobil";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Booking Test Drive - AdminMobil</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
        <a href="dataMobil.php" class="block px-4 py-2 rounded hover:bg-blue-600">🚘 Data Mobil</a>
        <a href="dataBooking.php" class="block px-4 py-2 rounded bg-blue-600">📅 Data Booking</a>
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
          <span class="text-sm"><?= htmlspecialchars($_SESSION['admin_username']) ?></span>
          <button onclick="konfirmasiLogout()" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Logout</button>
        </div>
      </header>

      <!-- Content -->
      <main class="p-6 overflow-auto">
        <div class="bg-white shadow rounded-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Data Booking Test Drive</h2>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
              <thead class="bg-blue-600 text-white">
                <tr>
                  <th class="p-2 border">No</th>
                  <th class="p-2 border">Nama</th>
                  <th class="p-2 border">Mobil</th>
                  <th class="p-2 border">Waktu Test Drive</th>
                  <th class="p-2 border">Status</th>
                  <th class="p-2 border">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                  <tr class="hover:bg-gray-100">
                    <td class="p-2 border"><?= $no++ ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['nama_mobil']) ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['waktu_testdrive']) ?></td>
                    <td class="p-2 border">
                      <?php
                        $statusColor = match($row['status']) {
                          'Disetujui' => 'text-green-600',
                          'Ditolak'   => 'text-red-600',
                          default     => 'text-yellow-600'
                        };
                      ?>
                      <span class="<?= $statusColor ?> font-semibold"><?= $row['status'] ?></span>
                    </td>
                    <td class="p-2 border space-x-1">
                      <?php if ($row['status'] === 'Pending'): ?>
                        <button onclick="konfirmasiSetujui(<?= $row['id_booking'] ?>)" class="text-green-600 hover:underline">✔ Setujui</button>
                        <button onclick="konfirmasiTolak(<?= $row['id_booking'] ?>)" class="text-red-600 hover:underline">✖ Tolak</button>
                      <?php else: ?>
                        <span class="text-gray-500">-</span>
                      <?php endif; ?>
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
    function konfirmasiSetujui(id) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Booking ini akan disetujui!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, setujui!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'setujui_booking.php?id=' + id;
        }
      });
    }

    function konfirmasiTolak(id) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Booking ini akan ditolak!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, tolak!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'tolak_booking.php?id=' + id;
        }
      });
    }

    function konfirmasiLogout() {
      Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Anda akan keluar dari sesi admin.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'logout.php';
        }
      });
    }
  </script>
</body>
</html>
