<?php
$mobil = $_GET['mobil'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pembelian Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <h3>📝 Form Pembelian Mobil</h3>
    <form method="post" action="proses_pembelian.php">
        <div class="mb-3">
            <label>Mobil yang Dipilih</label>
            <input type="text" name="mobil" class="form-control" value="<?= htmlspecialchars($mobil) ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Nama Anda</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nomor Telepon</label>
            <input type="text" name="telepon" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
    </form>
</div>

</body>
</html>
