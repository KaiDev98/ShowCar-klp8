<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$mobil_id = isset($_GET['mobil_id']) ? intval($_GET['mobil_id']) : 0;

// Ambil data mobil
$stmt = $conn->prepare("SELECT nama_mobil FROM mobil WHERE id_mobil = ?");
$stmt->bind_param("i", $mobil_id);
$stmt->execute();
$result = $stmt->get_result();
$mobil = $result->fetch_assoc();

if (!$mobil) {
    die("Mobil tidak ditemukan.");
}

// Ambil gambar mobil
$stmt_gambar = $conn->prepare("SELECT gambar FROM gambar_mobil WHERE id_mobil = ? LIMIT 1");
$stmt_gambar->bind_param("i", $mobil_id);
$stmt_gambar->execute();
$result_gambar = $stmt_gambar->get_result();
$gambar_data = $result_gambar->fetch_assoc();
$gambar = $gambar_data ? $gambar_data['gambar'] : 'default.jpg';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Review <?= htmlspecialchars($mobil['nama_mobil']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen font-sans">

  <!-- Kiri: Gambar & Judul -->
  <div class="w-2/5 bg-slate-100 p-10 flex flex-col items-center justify-center">
    <h2 class="text-xl font-semibold text-center mb-4">
      Apa yang Anda pikirkan tentang <br><span class="text-red-600"><?= htmlspecialchars($mobil['nama_mobil']) ?></span>?
    </h2>
    <img src="uploads/<?= htmlspecialchars($gambar) ?>" alt="<?= htmlspecialchars($mobil['nama_mobil']) ?>" class="w-full max-w-sm rounded-lg shadow-md">
  </div>

  <!-- Kanan: Form Review -->
  <div class="w-3/5 p-10">
    <h3 class="text-2xl font-bold mb-2">Nilai & Ulasan</h3>
    <p class="mb-6 text-gray-700"><strong><?= htmlspecialchars($mobil['nama_mobil']) ?></strong></p>

    <form method="POST" action="simpanReview.php" class="space-y-6">
      <input type="hidden" name="mobil_id" value="<?= $mobil_id ?>">

      <!-- Rating -->
      <div>
        <label class="block mb-2 font-semibold">Rating:</label>
        <div id="starRating" class="flex space-x-1 text-3xl text-gray-300 cursor-pointer">
          <input type="hidden" name="rating" id="ratingValue" required>
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span data-value="<?= $i ?>" class="star hover:text-yellow-400">★</span>
          <?php endfor; ?>
        </div>
      </div>

      <!-- Komentar -->
      <div>
        <label class="block mb-1 font-semibold">Review pengalaman Anda:</label>
        <textarea name="komentar" class="w-full border border-gray-300 rounded-lg p-3" rows="5" placeholder="Kami akan menyukai pendapat Anda" required minlength="10"></textarea>
        <small class="text-sm text-gray-500">Minimum 10 kata dibutuhkan</small>
      </div>

      <!-- Judul -->
      <div>
        <label class="block mb-1 font-semibold">Judul:</label>
        <input type="text" name="judul" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Judul" required minlength="3">
        <small class="text-sm text-gray-500">Minimum 3 kata dibutuhkan</small>
      </div>

      <!-- Submit -->
      <div>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow">
          Kirimkan
        </button>
      </div>
    </form>
  </div>

  <!-- Script bintang interaktif -->
  <script>
    const stars = document.querySelectorAll("#starRating .star");
    const ratingValue = document.getElementById("ratingValue");

    stars.forEach(star => {
      star.addEventListener("click", () => {
        const value = star.getAttribute("data-value");
        ratingValue.value = value;

        stars.forEach(s => {
          s.classList.remove("text-yellow-400");
          if (s.getAttribute("data-value") <= value) {
            s.classList.add("text-yellow-400");
          }
        });
      });

      star.addEventListener("mouseover", () => {
        const value = star.getAttribute("data-value");
        stars.forEach(s => {
          s.classList.remove("text-yellow-400");
          if (s.getAttribute("data-value") <= value) {
            s.classList.add("text-yellow-400");
          }
        });
      });

      star.addEventListener("mouseout", () => {
        const value = ratingValue.value;
        stars.forEach(s => {
          s.classList.remove("text-yellow-400");
          if (s.getAttribute("data-value") <= value) {
            s.classList.add("text-yellow-400");
          }
        });
      });
    });
  </script>

</body>
</html>
