<?php
include 'db.php';
$id_topik = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = $_POST['nama'];
    $isi   = $_POST['isi'];

    $stmt = $conn->prepare("INSERT INTO balasan (topik_id, nama, isi) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id_topik, $nama, $isi);
    $stmt->execute();
}

$topik = $conn->query("SELECT * FROM topik WHERE id=$id_topik")->fetch_assoc();
$balasan = $conn->query("SELECT * FROM balasan WHERE topik_id=$id_topik ORDER BY tanggal ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Diskusi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <a href="index.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card p-3 mb-3">
        <h5><?= htmlspecialchars($topik['judul']) ?></h5>
        <p><?= nl2br(htmlspecialchars($topik['isi'])) ?></p>
        <small>Oleh: <strong><?= htmlspecialchars($topik['nama']) ?></strong> | <?= $topik['tanggal'] ?></small>
    </div>

    <h6>Balasan:</h6>
    <?php while($row = $balasan->fetch_assoc()): ?>
        <div class="card p-2 mb-2">
            <?= nl2br(htmlspecialchars($row['isi'])) ?><br>
            <small><b><?= htmlspecialchars($row['nama']) ?></b> | <?= $row['tanggal'] ?></small>
        </div>
    <?php endwhile; ?>

    <!-- Form Balasan -->
    <form method="POST" class="card p-3 mt-3">
        <h6>Balas Diskusi</h6>
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Anda" required>
        <textarea name="isi" class="form-control mb-2" placeholder="Isi balasan" rows="3" required></textarea>
        <button class="btn btn-primary">Kirim Balasan</button>
    </form>
</div>
</body>
</html>
