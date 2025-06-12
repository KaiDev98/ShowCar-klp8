<?php
include 'koneksi.php';

// Ambil data mobil berdasarkan ID
$id_mobil = $_GET['id'] ?? '';
$mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil = '$id_mobil'");
$m = mysqli_fetch_assoc($mobil);

// Proses form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $status = 'Dalam Proses';

    $query = "INSERT INTO pembelian (id_mobil, nama, email, no_hp, alamat, status)
              VALUES ('$id_mobil', '$nama', '$email', '$no_hp', '$alamat', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pesanan berhasil dikirim!'); window.location='pengguna.php';</script>";
    } else {
        echo "Gagal menyimpan pesanan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pembelian</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Form Pembelian Mobil</h2>
  <div class="card">
    <div class="card-header">
      Anda akan membeli: <strong><?= $m['nama_mobil'] ?></strong>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>No HP</label>
          <input type="text" name="no_hp" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat Lengkap</label>
          <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
        <a href="pengguna.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
