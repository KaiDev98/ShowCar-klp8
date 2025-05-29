<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "showcar_db";
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Handle submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $car_id = $_POST['car_id'];

    $stmt = $conn->prepare("INSERT INTO review (user_name, car_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("siss", $username, $car_id, $rating, $review);
    $stmt->execute();
    $stmt->close();
}

// Get list of cars dari mobil1
$cars = $conn->query("SELECT id_mobil, nama_mobil FROM mobil1");

// Ambil data review
$reviews = $conn->query("
    SELECT r.*, m.nama_mobil 
    FROM review r 
    JOIN mobil1 m ON r.car_id = m.id_mobil 
    ORDER BY r.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Review & Rating Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .star-rating input[type="radio"] { display: none; }
    .star-rating label {
      font-size: 1.5rem; color: gray; cursor: pointer;
    }
    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
      color: gold;
    }
    .review-card { min-height: 250px; }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2 class="mb-4"><span class="me-2">🏆</span>Review & Rating Mobil</h2>

    <!-- Form Review -->
    <div class="card mb-5">
      <div class="card-header bg-primary text-white">Beri Review Mobil Anda</div>
      <div class="card-body">
        <form method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Nama Anda</label>
            <input type="text" name="username" class="form-control" id="username" required />
          </div>
          <div class="mb-3">
            <label for="car_id" class="form-label">Pilih Mobil</label>
            <select class="form-select" name="car_id" id="car_id" required>
              <option value="">-- Pilih Mobil --</option>
              <?php while ($row = $cars->fetch_assoc()): ?>
                <option value="<?= $row['id_mobil'] ?>"><?= htmlspecialchars($row['nama_mobil']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="review" class="form-label">Komentar</label>
            <textarea class="form-control" name="review" id="review" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="star-rating d-flex flex-row-reverse justify-content-end">
              <?php for ($i = 5; $i >= 1; $i--): ?>
                <input type="radio" name="rating" id="star<?= $i ?>" value="<?= $i ?>" required>
                <label for="star<?= $i ?>">★</label>
              <?php endfor; ?>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Kirim Review</button>
        </form>
      </div>
    </div>

    <!-- Daftar Review -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <?php while ($r = $reviews->fetch_assoc()): ?>
        <div class="col">
          <div class="card review-card h-100">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($r['nama_mobil']) ?></h5>
              <div class="text-warning mb-2">
                <?= str_repeat('★', $r['rating']) . str_repeat('☆', 5 - $r['rating']) ?>
              </div>
              <p class="card-text"><?= htmlspecialchars($r['comment']) ?></p>
            </div>
            <div class="card-footer text-muted small">
              <?= htmlspecialchars($r['user_name']) ?> - <?= date('d M Y', strtotime($r['created_at'])) ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
