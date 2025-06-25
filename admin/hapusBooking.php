<?php
include 'koneksi.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id) {
  $stmt = $conn->prepare("DELETE FROM booking_test_drive WHERE id_booking = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}
header("Location: bookings.php");
exit;
