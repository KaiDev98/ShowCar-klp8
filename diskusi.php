<?php
require_once 'db.php';

// Ambil data topik
$topics = [];
$sql = "SELECT * FROM topik ORDER BY tanggal DESC";
if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $topics[] = $row;
    }
    $stmt->close();
} else {
    die("Query gagal: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Forum Diskusi Showroom Mobil</title>
    <link rel="stylesheet" href="assets/css/forum.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Forum Diskusi Showroom Mobil</h2>
            <p class="text-muted">Ajukan pertanyaan atau diskusikan seputar mobil di showroom kami.</p>
        </div>

        <!-- Form Topik Baru -->
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Buat Topik Baru</h5>
            </div>
            <div class="card-body">
                <form action="tambah_topik.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Anda" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="judul" class="form-control" placeholder="Judul Topik" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="isi" class="form-control" placeholder="Isi pertanyaan" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Posting</button>
                </form>
            </div>
        </div>

        <!-- Bagian Topik -->
        <h5 class="mb-3">Topik Terbaru</h5>
        <div class="forum-topics">
            <?php if (count($topics) > 0): ?>
                <?php foreach ($topics as $row): ?>
                    <div class="card forum-topic mb-3">
                        <div class="card-body">
                            <h6 class="card-title"><?= htmlspecialchars($row['judul']) ?></h6>
                            <p class="card-text text-muted">
                                <?= nl2br(htmlspecialchars(substr($row['isi'], 0, 80))) ?>...
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-secondary">
                                    Oleh: <strong><?= htmlspecialchars($row['nama']) ?></strong> | <?= $row['tanggal'] ?>
                                </small>
                                <a href="balas_topik.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    Lihat & Balas
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Belum ada topik yang diposting.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
