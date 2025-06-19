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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4fafa;
        }

        .left-section {
            background-color: #f4fafa;
            padding: 60px 40px;
            min-height: 100vh;
        }

        .rating-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .star {
            position: relative;
            font-size: 2.5rem;
            color: #ccc;
            cursor: pointer;
            display: inline-block;
        }

        .star.full::before {
            content: '\f005';
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: #ffc107;
            position: absolute;
            left: 0;
            top: 0;
        }

        .star.half::before {
            content: '\f005';
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: #ffc107;
            position: absolute;
            left: 0;
            top: 0;
            clip-path: inset(0 50% 0 0);
        }

        .review-fields {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.5s ease;
            pointer-events: none;
        }

        .review-fields.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .star-base {
            font-family: "Font Awesome 6 Free";
            font-weight: 400;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .left-section {
                text-align: center;
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- KIRI -->
        <div class="col-md-5 left-section d-flex flex-column justify-content-center align-items-center">
            <h3 class="fw-bold mb-3">Apa yang Anda pikirkan tentang<br><?= htmlspecialchars($mobil['nama_mobil']) ?>?</h3>
            <img src="uploads/<?= htmlspecialchars($gambar) ?>" alt="<?= htmlspecialchars($mobil['nama_mobil']) ?>" class="img-fluid rounded shadow mt-3" style="max-height: 300px;">
        </div>

<<<<<<< HEAD
      <!-- Komentar -->
      <div>
        <label class="block mb-1 font-semibold">Review pengalaman Anda:</label>
        <textarea name="komentar" class="w-full border border-gray-300 rounded-lg p-3" rows="5" placeholder="Kami akan menyukai pendapat Anda" required minlength="10"></textarea>
        <small class="text-sm text-gray-500">Minimum 10 kata dibutuhkan</small>
      </div>
=======
        <!-- KANAN -->
        <div class="col-md-7 p-5">
            <h4 class="fw-bold mb-4">Nilai & Ulasan</h4>
            <form id="reviewForm" method="POST" action="simpanReview.php">
                <input type="hidden" name="mobil_id" value="<?= $mobil_id ?>">
                <input type="hidden" name="rating" id="ratingValue">
>>>>>>> e4f1420 (Mengupdate semua kode)

                <!-- RATING -->
                <div class="mb-4">
                    <div class="rating-container" id="starContainer">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star star-base" data-value="<?= $i ?>"><i class="fa-regular fa-star"></i></span>
                        <?php endfor; ?>
                    </div>
                </div>

<<<<<<< HEAD
      <!-- Submit -->
      <div>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow">
          Kirim
        </button>
      </div>
    </form>
  </div>
=======
                <!-- FIELD REVIEW -->
                <div class="review-fields" id="reviewFields">
                    <div class="mb-3">
                        <label class="form-label">Judul Review</label>
                        <input type="text" name="judul" class="form-control" placeholder="Judul review (min. 3 kata)" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ulasan</label>
                        <textarea name="komentar" class="form-control" rows="5" placeholder="Tulis pengalaman Anda di sini (min. 10 kata)" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Kirimkan Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
>>>>>>> e4f1420 (Mengupdate semua kode)

<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingValue');
    const reviewFields = document.getElementById('reviewFields');
    let currentRating = 0;

    stars.forEach((star, index) => {
        star.addEventListener('mousemove', (e) => {
            const rect = star.getBoundingClientRect();
            const isHalf = (e.clientX - rect.left) < (rect.width / 2);
            const value = isHalf ? index + 0.5 : index + 1;
            highlightStars(value);
        });

        star.addEventListener('click', (e) => {
            const rect = star.getBoundingClientRect();
            const isHalf = (e.clientX - rect.left) < (rect.width / 2);
            currentRating = isHalf ? index + 0.5 : index + 1;
            ratingInput.value = currentRating;
            highlightStars(currentRating);
            reviewFields.classList.add('show');
        });

        star.addEventListener('mouseleave', () => {
            highlightStars(currentRating);
        });
    });

    function highlightStars(value) {
        stars.forEach((star, index) => {
            star.className = 'star star-base'; // reset
            if (value >= index + 1) {
                star.classList.add('full');
            } else if (value >= index + 0.5) {
                star.classList.add('half');
            }
        });
    }

    // Validasi Submit
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        const judul = this.judul.value.trim();
        const komentar = this.komentar.value.trim();

        if (!ratingInput.value) {
            e.preventDefault();
            Swal.fire('Oops!', 'Silakan beri rating terlebih dahulu.', 'warning');
            return;
        }

        if (judul.split(/\s+/).length < 3) {
            e.preventDefault();
            Swal.fire('Oops!', 'Judul harus minimal 3 kata.', 'warning');
            return;
        }

        if (komentar.split(/\s+/).length < 10) {
            e.preventDefault();
            Swal.fire('Oops!', 'Review harus minimal 10 kata.', 'warning');
            return;
        }
    });

    <?php if (isset($_SESSION['review_status'])): ?>
        Swal.fire({
            icon: '<?= $_SESSION['review_status']['success'] ? 'success' : 'error' ?>',
            title: '<?= $_SESSION['review_status']['message'] ?>'
        });
        <?php unset($_SESSION['review_status']); ?>
    <?php endif; ?>
</script>
</body>
</html>
