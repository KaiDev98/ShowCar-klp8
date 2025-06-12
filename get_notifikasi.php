<?php
session_start();
include 'koneksi.php';

$email = $_SESSION['email'];

$query = "SELECT merk_mobil, status, created_at FROM booking_test_drive 
          WHERE email = '$email' 
          AND status IN ('Disetujui', 'Ditolak') 
          AND dibaca_user = 0 
          ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<p class='text-muted'>Tidak ada notifikasi baru.</p>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='mb-2 p-2 border rounded bg-light'>
                <strong>Status Booking:</strong> " . htmlspecialchars($row['status']) . "<br>
                <small><strong>Mobil:</strong> " . htmlspecialchars($row['merk_mobil']) . "</small><br>
                <small><strong>Waktu:</strong> " . htmlspecialchars($row['created_at']) . "</small>
              </div>";
    }
}
?>
