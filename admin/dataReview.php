<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli("localhost", "root", "", "showroom");

$query = "
  SELECT r.*, m.nama_mobil 
  FROM review r
  JOIN mobil m ON r.mobil_id = m.id_mobil
  ORDER BY r.created_at DESC
";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Review - AdminMobil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
        <a href="dataBooking.php" class="block px-4 py-2 rounded hover:bg-blue-600">📅 Data Booking</a>
        <a href="dataReview.php" class="block px-4 py-2 rounded bg-blue-600">📝 Data Review</a>
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
          <button id="logoutBtn" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Logout</button>
        </div>
      </header>

      <!-- Content -->
      <main class="p-6 overflow-auto">
        <div class="bg-white shadow rounded-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Data Review</h2>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
              <thead class="bg-blue-600 text-white">
                <tr>
                  <th class="p-2 border">#</th>
                  <th class="p-2 border">Nama</th>
                  <th class="p-2 border">Mobil</th>
                  <th class="p-2 border">Komentar</th>
                  <th class="p-2 border">Rating</th>
                  <th class="p-2 border">Dibuat Pada</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($result->num_rows > 0): ?>
                  <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-100">
                      <td class="p-2 border"><?= $no++ ?></td>
                      <td class="p-2 border"><?= htmlspecialchars($row['nama']) ?></td>
                      <td class="p-2 border"><?= htmlspecialchars($row['nama_mobil']) ?></td>
                      <td class="p-2 border whitespace-pre-line"><?= nl2br(htmlspecialchars($row['komentar'])) ?></td>
                      <td class="p-2 border">
                        <?php
                          $rating = (int) $row['rating'];
                          for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                              echo '<i class="fas fa-star text-yellow-400"></i>';
                            } else {
                              echo '<i class="far fa-star text-gray-300"></i>';
                            }
                          }
                        ?>
                      </td>
                      <td class="p-2 border"><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">Belum ada data review.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- SweetAlert Logout -->
  <script>
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
</body>
</html>
