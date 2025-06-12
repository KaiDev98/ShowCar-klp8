<?php
include 'koneksi.php';

$name  = $_POST['name'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

$sql = "INSERT INTO kontak (name, email, pesan) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $pesan);

if ($stmt->execute()) {
  echo "<script>
    alert('Pesan berhasil dikirim!');
    window.location.href = 'index.php';
  </script>";
} else {
  echo "Terjadi kesalahan: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
