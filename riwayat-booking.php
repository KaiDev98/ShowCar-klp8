<?php
include 'koneksi.php';
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    echo "<p>Anda belum login. Silakan <a href='login.php'>login di sini</a>.</p>";
    exit;
}

// Hindari cache agar status terbaru selalu ditampilkan
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

// Ambil data email user dari session
$email_user = $_SESSION['email'];

// Update notifikasi yang belum dibaca menjadi sudah dibaca
$update = "UPDATE booking_test_drive 
           SET dibaca_user = 1 
           WHERE email = ? AND status IN ('Disetujui', 'Ditolak') AND dibaca_user = 0";
$update_stmt = $conn->prepare($update);
$update_stmt->bind_param("s", $email_user);
$update_stmt->execute();

// Ambil data booking dan gabungkan dengan data mobil
$sql = "SELECT b.*, m.nama_mobil 
        FROM booking_test_drive b 
        JOIN mobil m ON b.id_mobil = m.id_mobil 
        WHERE b.email = ? 
        ORDER BY b.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email_user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Booking - Showroom</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
  <div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Riwayat Booking Test Drive</h1>

    <?php if ($result->num_rows > 0): ?>
      <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-gray-200">
            <tr>
              <th class="p-3 border">#</th>
              <th class="p-3 border">Mobil</th>
              <th class="p-3 border">Waktu Test Drive</th>
              <th class="p-3 border">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
              <tr class="hover:bg-gray-100">
                <td class="p-3 border"><?= $no++ ?></td>
                <td class="p-3 border"><?= htmlspecialchars($row['nama_mobil']) ?></td>
                <td class="p-3 border"><?= htmlspecialchars(date('d-m-Y H:i', strtotime($row['waktu_testdrive']))) ?></td>
                <td class="p-3 border">
                  <?php
                    $status = strtolower($row['status']);
                    if ($status == 'disetujui') {
                      echo '<span class="text-green-600 font-medium">Disetujui</span>';
                    } elseif ($status == 'ditolak') {
                      echo '<span class="text-red-600 font-medium">Ditolak</span>';
                    } else {
                      echo '<span class="text-yellow-600 font-medium">Pending</span>';
                    }
                  ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-gray-600">Belum ada riwayat booking.</p>
    <?php endif; ?>
  </div>
</body>
</html>
