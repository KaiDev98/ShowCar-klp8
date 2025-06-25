<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "showroom");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data review
$sql = "SELECT * FROM review ORDER BY created_at DESC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ulasan Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    
<body class="bg-gray-50 text-gray-800">
    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold mb-2">Ulasan dari Pelanggan Kami</h2>
            <p class="text-gray-600 text-sm">Berikut ulasan pelanggan kami</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition">
                    <div class="flex items-center text-yellow-500 mb-2">
                        <?= str_repeat('⭐', $row['rating']); ?>
                    </div>
                    <p class="text-sm text-right text-gray-500"><?= date('d M Y', strtotime($row['created_at'])); ?></p>
                    <p class="font-semibold text-lg mb-1">“<?= htmlspecialchars($row['komentar']); ?>”</p>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars($row['nama']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
    
</body>
</html>
