<?php
session_start();
include 'koneksi.php';

$nama = $_POST['nama'];
$mobil_id = $_POST['mobil_id'];
$komentar = $_POST['komentar'];
$rating = $_POST['rating'];

$sql = "INSERT INTO review (nama, mobil_id, komentar, rating) VALUES ('$nama', '$mobil_id', '$komentar', '$rating')";
if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Review berhasil dikirim!";
} else {
    $_SESSION['error'] = "Gagal menyimpan review: " . $conn->error;
}

header("Location: review.php");
exit;
