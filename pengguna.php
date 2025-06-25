<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<?php

include 'koneksi.php';
// Ambil brand dari URL, default 'all'
$brand_filter = isset($_GET['brand']) ? strtolower($_GET['brand']) : 'all';
?>

<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShowCar</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
    .review-card:hover {
      transform: translateY(-4px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }

    .review-slider-wrapper {
  width: 100%;
  overflow: hidden;
  position: relative;
}

    .review-slider {
      display: flex;
      gap: 1rem;
      animation: scrollLeft 20s linear infinite;
    }
    
    @keyframes scrollLeft {
      0% {
        transform: translateX(0%);
      }
      100% {
        transform: translateX(-50%); /* Karena konten diduplikat 2x */
      }
    }

    .review-slider > .col {
      flex: 0 0 auto;
      width: 300px; /* Sesuaikan dengan ukuran card */
    }

    /* Opsional: Pause saat hover */
    .review-slider-wrapper:hover .review-slider {
      animation-play-state: paused;
    }


      .car-card .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 1rem;
  }

  .car-card .card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
  }

  .car-card .card-img-top {
    transition: transform 0.3s ease;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
  }

  .car-card .card-img-top:hover {
    transform: scale(1.05);
  }

  .card-news {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 1rem;
  }

  .card-news:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
  }

  .card-news img {
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
    transition: transform 0.3s ease;
  }

  .card-news:hover img {
    transform: scale(1.05);
  }

  /* faqs */
   .faq-section {
    background: #f8f9fa;
    padding: 4rem 0;
  }

  .faq-item {
    border-bottom: 1px solid #ddd;
    padding: 1rem 0;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 1rem 0;
    border-top: 1px solid #ddd;
  }

  .faq-question h5 {
    margin: 0;
    font-weight: 600;
  }

  .faq-answer {
    display: none;
    padding-top: 0.5rem;
    color: #555;
  }

  .faq-item.active .faq-answer {
    display: block;
    animation: fadeIn 0.3s ease;
  }

  .faq-item .icon {
    font-size: 1.2rem;
    color: #dc3545;
    transition: transform 0.3s ease;
  }

  .faq-item.active .icon::before {
    content: '+'; /* default ikon plus */
    font-size: 24px;
    color: #333;
    background: #e0e0e0;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
  }

  .faq-item .icon::before {
    content: "+"; /* plus icon (Bootstrap Icons) */
    font-family: "Bootstrap Icons";
    transition: all 0.3s ease;
  }   

  .faq-item.active .faq-question .icon::before {
   content: '−';
  background: #ff0000;
  color: #fff;
  }

  .faq-right {
    position: relative;
    text-align: center;
  }

  .faq-right img {
    width: 100%;
    border-radius: 0.75rem;
    object-fit: cover;
    max-height: 400px;
  }

  .overlay-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    font-weight: bold;
    color: #fff;
    text-shadow: 2px 2px 5px rgba(0,0,0,0.4);
  }

  .overlay-text .highlight {
    color: #dc3545;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
    </style>

  </head>
  <body id="home">
    <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top">
  <div class="container">
    <a class="navbar-brand font-weight-bold text-danger" href="#">ShowCar</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-lg-center">
        <li class="nav-item mx-2">
          <a class="nav-link" href="#shop">Mobil Baru</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#berita">Berita</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#ulasan">Ulasan</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#faqs">Faqs</a>
        </li>
        <?php

          $email_user = $_SESSION['email'];
          $query = "SELECT COUNT(*) AS jumlah 
          FROM booking_test_drive 
          WHERE email = '$email_user' 
          AND status IN ('Disetujui', 'Ditolak') 
          AND dibaca_user = 0";

          $result = mysqli_query($conn, $query);
          $data = mysqli_fetch_assoc($result);
          $jumlah_notif = $data['jumlah'];
          ?>

          <!-- Navbar Notifikasi -->
          <li class="nav-item dropdown mx-2">
            <a class="nav-link position-relative" href="riwayat-booking.php">
              <i class="bi bi-bell fs-5"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notif-count">
                <?= $jumlah_notif ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </li>

      <!-- User Dropdown -->
<div class="dropdown ms-3">
  <a class="btn bg-white text-dark border-0 dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
    <i class="bi bi-person-circle fs-5"></i>
    <?= $_SESSION['username'] ?? 'Akun' ?>
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="riwayat-booking.php">Riwayat</a></li>
    <li><a class="dropdown-item" href="#" id="btn-logout">Logout</a></li>
  </ul>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById("btn-logout").addEventListener("click", function(e) {
    e.preventDefault();
    Swal.fire({
      title: "Yakin ingin logout?",
      text: "Sesi Anda akan diakhiri.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, logout"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "logout.php";
      }
    });
  });


        document.getElementById("btn-logout").addEventListener("click", function(e) {
          e.preventDefault();
          Swal.fire({
            title: "Yakin ingin logout?",
            text: "Sesi Anda akan diakhiri.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, logout"
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "logout.php";
            }
          });
        });
      </script>

    </div>
  </div>
</nav>
    <!-- akhiran navbar -->

    <!-- Hero Section sebagai background gambar dengan teks minimal -->
    <section class="hero d-flex align-items-center justify-content-center text-center text-white"
            style="position: relative; height: 100vh; background: url('assets/img/car1.jpg') center center / cover no-repeat;">
      
      <!-- Overlay untuk efek gelap -->
      <div class="overlay" style="position: absolute; top: 0; left: 0; 
          width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4); z-index: 1;"></div>

      <!-- Konten utama -->
      <div class="container position-relative" style="z-index: 2;">
        <h1 class="display-4 fw-bold">Selamat Datang Di ShowCar</h1>
        <p class="lead">Temukan mobil impian Anda bersama kami.</p>
      </div>
    </section>
    <!-- akhiran section -->

    <!-- brand logo -->
    <div class="brand-row">
      <a href="https://www.chevrolet.com" target="_blank">
        <img
          src="https://static.vecteezy.com/system/resources/previews/020/498/757/original/chevrolet-brand-logo-car-symbol-with-name-white-design-usa-automobile-illustration-with-black-background-free-vector.jpg"
          alt="Chevrolet"
        />
      </a>

      <a href="https://www.jeep.com" target="_blank">
        <img
          src="https://tse4.mm.bing.net/th?id=OIP.jz71Zina4ioOEgRTtmB_YgHaE8&pid=Api&P=0&h=180"
          alt="Jeep"
        />
      </a>

      <a href="https://www.mitsubishi-motors.com" target="_blank">
        <img
          src="https://tse3.mm.bing.net/th?id=OIP.jsJs9t1UXntOqAfG06DqsAHaGB&pid=Api&P=0&h=180"
          alt="Mitsubishi"
        />
      </a>

      <a href="https://www.tesla.com" target="_blank">
        <img
          src="https://tse3.mm.bing.net/th?id=OIP.11aeOv9S0j4jTrUQRWbj7QHaHa&pid=Api&P=0&h=180"
          alt="Tesla"
        />
      </a>

      <a href="https://www.mercedes-benz.com" target="_blank">
        <img
          src="https://static.vecteezy.com/ti/vetor-gratis/p1/20502492-mercedes-benz-marca-logotipo-simbolo-com-nome-branco-projeto-alemao-carro-automovel-ilustracao-com-preto-fundo-gratis-vetor.jpg"
          alt="Mercedes-Benz"
        />
      </a>

      <a href="https://www.rolls-roycemotorcars.com" target="_blank">
        <img
          src="https://tse2.mm.bing.net/th?id=OIP.3f5e_4vMl8rbWQ7DiWVkGgHaGB&pid=Api&P=0&h=180"
          alt="Rolls-Royce"
        />
      </a>

      <a href="https://www.hummer.com" target="_blank">
        <img
          src="https://tse2.mm.bing.net/th?id=OIP.otaRtMs1k5u17mBQhOnHKgHaGB&pid=Api&P=0&h=180"
          alt="Hummer"
        />
      </a>
    </div>
    <!-- akhiran logo -->

    <!-- car -->
    <?php require 'config/db.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <section id="shop" class="py-5 bg-light">
      <div class="container">
        <p class="text-danger text-uppercase fw-bold mb-2 text-center">New Popular Car</p>
        <h2 class="fw-bold text-center mb-4">Shop Populer New Car</h2>

        <!-- Filter Merek -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
          <button class="btn btn-outline-dark btn-sm active filter-btn" data-filter="all">Show All</button>
          <?php
          $brands = $conn->query("
            SELECT DISTINCT mr.nama_merek
            FROM mobil m
            JOIN merek mr ON m.id_merek = mr.id_merek
          ");
          while ($b = $brands->fetch_assoc()):
            $brandName = htmlspecialchars($b['nama_merek']);
          ?>
            <button class="btn btn-outline-dark btn-sm filter-btn" data-filter="<?= $brandName ?>"><?= $brandName ?></button>
          <?php endwhile; ?>
        </div>

        <!-- Grid Mobil -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="carGrid">
          <?php
          $cars = $conn->query("
            SELECT
              m.id_mobil,
              m.nama_mobil,
              mr.nama_merek,
              k.nama_kategori,
              m.harga
            FROM mobil m
            JOIN merek mr ON m.id_merek = mr.id_merek
            JOIN kategori k ON m.id_kategori = k.id_kategori
            ORDER BY m.id_mobil DESC
          ");
          $i = 0;
          while ($row = $cars->fetch_assoc()):
            $id       = (int)$row['id_mobil'];
            $name     = htmlspecialchars($row['nama_mobil']);
            $brand    = htmlspecialchars($row['nama_merek']);
            $category = htmlspecialchars($row['nama_kategori']);
            $price    = number_format($row['harga'], 0, ',', '.');

            $imgQuery = $conn->query("SELECT gambar FROM gambar_mobil WHERE id_mobil = $id LIMIT 1");
            $imgSrc = 'uploads/default.jpg';
            if ($imgQuery && $img = $imgQuery->fetch_assoc()) {
              $imgSrc = 'uploads/' . htmlspecialchars($img['gambar']);
            }

            // Delay animasi: lebih singkat
            $delay = 0.05 * $i++;
          ?>
            <div class="col car-card animate__animated animate__fadeInUp" style="animation-delay: <?= $delay ?>s;" data-brand="<?= $brand ?>">
              <div class="card h-100 shadow-sm border-0">
                <img
                  src="<?= $imgSrc ?>"
                  class="card-img-top"
                  alt="<?= $name ?>"
                  style="height: 180px; object-fit: cover; cursor: pointer;"
                  onclick="window.location.href='detail_mobil.php?id=<?= $id ?>'"
                  onerror="this.src='uploads/default.jpg'"
                >
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?= $name ?></h5>
                  <p class="text-muted mb-2"><?= $category ?></p>
                  <div class="mt-auto d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Rp<?= $price ?></span>
                    <a href="detail_mobil.php?id=<?= $id ?>" class="btn btn-sm btn-danger">Cek Detail</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section>

    <!-- Script Filter -->
    <script>
      document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const filter = btn.getAttribute('data-filter');
          document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');

          document.querySelectorAll('.car-card').forEach(card => {
            const brand = card.getAttribute('data-brand');
            card.style.display = (filter === 'all' || brand === filter) ? 'block' : 'none';
          });
        });
      });
    </script>
    <!-- akhiran car -->

    <!-- review rating -->
    <section id="ulasan" class="py-5 bg-white">
      <div class="container">
        <h2 class="text-center fw-bold mb-2">Ulasan dari Pelanggan Kami</h2>
        <p class="text-center text-muted mb-4">Temukan apa yang dikatakan pelanggan kami</p>

        <div class="review-slider-wrapper overflow-hidden">
          <div class="review-slider d-flex">
            <?php
            $result = $conn->query("
              SELECT r.*, m.nama_mobil 
              FROM review r 
              JOIN mobil m ON r.mobil_id = m.id_mobil 
              ORDER BY r.created_at DESC 
              LIMIT 4
            ");

            $reviews = [];
            while ($row = $result->fetch_assoc()) {
              $reviews[] = $row;
            }

            // Loop dua kali agar efek scroll seamless
            for ($i = 0; $i < 2; $i++) {
              foreach ($reviews as $row) {
                $rating = floatval($row['rating']);
                $starsHTML = '';
                for ($j = 1; $j <= 5; $j++) {
                  if ($rating >= $j) {
                    $starsHTML .= '<i class="fa-solid fa-star text-warning"></i> ';
                  } elseif ($rating >= ($j - 0.5)) {
                    $starsHTML .= '<i class="fa-solid fa-star-half-stroke text-warning"></i> ';
                  } else {
                    $starsHTML .= '<i class="fa-regular fa-star text-secondary"></i> ';
                  }
                }

                $full_komentar = htmlspecialchars($row['komentar']);
                $short_komentar = implode(' ', array_slice(explode(' ', $full_komentar), 0, 30)) . '...';

                echo '<div class="col">';
                echo '<div class="card h-100 shadow-sm border-0 review-card" 
                        data-bs-toggle="modal" 
                        data-bs-target="#reviewModal" 
                        data-nama="' . htmlspecialchars($row['nama']) . '" 
                        data-judul="' . htmlspecialchars($row['judul']) . '" 
                        data-komentar="' . $full_komentar . '" 
                        data-rating="' . $row['rating'] . '" 
                        data-mobil="' . htmlspecialchars($row['nama_mobil']) . '" 
                        data-tanggal="' . date("d M Y", strtotime($row['created_at'])) . '">';
                echo '<div class="card-body">';
                echo '<div class="d-flex justify-content-between align-items-center mb-2">';
                echo '<div>' . $starsHTML . '</div>';
                echo '<small class="text-muted">' . date("d M Y", strtotime($row['created_at'])) . '</small>';
                echo '</div>';
                echo '<h6 class="card-title fw-semibold">“' . htmlspecialchars($row['judul']) . '”</h6>';
                echo '<p class="card-text text-truncate small">' . $short_komentar . '</p>';
                echo '</div>';
                echo '<div class="card-footer bg-transparent border-top-0">';
                echo '<small class="text-muted"><strong>' . htmlspecialchars($row['nama']) . '</strong> - ' . htmlspecialchars($row['nama_mobil']) . '</small>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            }
            ?>
          </div>
        </div>

        <div class="text-center mt-4">
          <a href="ulasan.php" class="btn btn-outline-danger btn-sm">Lihat lebih banyak ulasan</a>
        </div>
      </div>
    </section>

    <!-- MODAL ULASAN -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title" id="modalRating"></div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5 class="fw-bold mb-2" id="modalJudul"></h5>
            <p id="modalKomentar"></p>
            <hr>
            <p class="mb-1"><strong id="modalNama"></strong></p>
            <p class="text-muted mb-1" id="modalMobil"></p>
            <p class="text-end text-muted small" id="modalTanggal"></p>
          </div>
        </div>
      </div>
    </div>

    <script>
      const reviewCards = document.querySelectorAll('.review-card');
      const modalJudul = document.getElementById('modalJudul');
      const modalKomentar = document.getElementById('modalKomentar');
      const modalRating = document.getElementById('modalRating');
      const modalNama = document.getElementById('modalNama');
      const modalMobil = document.getElementById('modalMobil');
      const modalTanggal = document.getElementById('modalTanggal');

      reviewCards.forEach(card => {
        card.addEventListener('click', function () {
          const data = {
            judul: this.getAttribute('data-judul'),
            komentar: this.getAttribute('data-komentar'),
            nama: this.getAttribute('data-nama'),
            rating: this.getAttribute('data-rating'),
            mobil: this.getAttribute('data-mobil'),
            tanggal: this.getAttribute('data-tanggal'),
          };

          modalJudul.textContent = '“' + data.judul + '”';
          modalKomentar.textContent = data.komentar;
          modalNama.textContent = data.nama;
          modalMobil.textContent = data.mobil;
          modalTanggal.textContent = data.tanggal;

          let rating = parseFloat(data.rating);
          let stars = '';
          for (let i = 1; i <= 5; i++) {
            if (rating >= i) {
              stars += '<i class="fa-solid fa-star text-warning"></i> ';
            } else if (rating >= (i - 0.5)) {
              stars += '<i class="fa-solid fa-star-half-stroke text-warning"></i> ';
            } else {
              stars += '<i class="fa-regular fa-star text-secondary"></i> ';
            }
          }
          modalRating.innerHTML = stars;
        });
      });
    </script>
    <!-- akhiran review rating -->

     <!-- berita -->
<?php
require 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM berita WHERE status = 'publikasi'");
?>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 id="berita" class="fw-bold">Berita Otomotif Dan Review</h2>
    <a href="berita-otomotif.php" class="btn btn-link text-danger fw-semibold">
      Baca Semua Berita Terbaru <i class="bi bi-arrow-right"></i>
    </a>
  </div>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <?php
    $i = 0;
    while($row = mysqli_fetch_assoc($result)):
      $delay = 0.05 * $i++;
    ?>
      <div class="col animate__animated animate__fadeInUp" style="animation-delay: <?= $delay ?>s;">
        <a href="berita-detail.php?id=<?= $row['id']; ?>" class="text-decoration-none text-dark">
          <div class="card card-news h-100 shadow-sm border-0">
            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($row['judul']) ?>" style="height: 180px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h6 class="card-title fw-bold">
                <?= htmlspecialchars($row['judul']) ?>
              </h6>
              <p class="text-muted small mb-1">
                <?= htmlspecialchars($row['penulis']) ?>, <?= date('d M Y', strtotime($row['tanggal_publikasi'])) ?>
              </p>
              <p class="card-text small mb-2">
                <?= substr(strip_tags($row['isi']), 0, 80) ?>...
                <span class="text-danger">Baca Selengkapnya</span>
              </p>
            </div>
          </div>
        </a>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<!-- akhiran berita -->

    <!-- faq -->
    <section id="faqs" class="faq-section">
      <div class="container">
        <div class="row">
          <!-- Hanya FAQ kiri saja -->
          <div class="col-12">
            <h2 class="fw-bold mb-4">FAQs</h2>

            <div class="faq-item active">
              <div class="faq-question">
                <h5>Apa itu ShowCar?</h5>
                <span class="icon"></span>
              </div>
              <div class="faq-answer">
                <p>ShowCar merupakan platform penjualan mobil secara online.</p>
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question">
                <h5>Bagaimana saya dapat menghubungi ShowCar?</h5>
                <span class="icon"></span>
              </div>
              <div class="faq-answer">
                <p>Anda dapat menghubungi nomor kami 82075289374.</p>
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question">
                <h5>Bagaimana saya dapat memesan mobil secara online?</h5>
                <span class="icon"></span>
              </div>
              <div class="faq-answer">
                <p>Silakan login/register di website, pilih mobil, isi data, dan tunggu tim kami menghubungi Anda.</p>
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question">
                <h5>Bagaimana cara melihat detail mobil?</h5>
                <span class="icon"></span>
              </div>
              <div class="faq-answer">
                <p>Silakan login dan klik tombol 'buy' untuk melihat detail mobil.</p>
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question">
                <h5>Apakah ShowCar menjual mobil baru?</h5>
                <span class="icon"></span>
              </div>
              <div class="faq-answer">
                <p>Ya, ShowCar hanya menjual mobil baru.</p>
              </div>
            </div>

            <!-- Tambahkan pertanyaan lainnya sesuai kebutuhan -->
          </div>
        </div>
      </div>
    </section>
     <!-- akhiran faq -->

      <!-- footer -->
    <footer>
      <div class="footer-section">
        <div class="container footer-flex">
          <!-- Left: Logo, Description, Social -->
          <div class="footer-left">
            <h2 class="footer-logo">ShowCar</h2>
            <p class="footer-description">Hubungi Juga kami di sosial Media</p>
            <div class="footer-right">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>Di Buat Oleh Kelompok 8</p>
      </div>
    </footer>
       <!-- akhiran footer -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelector('.filter-btn.active').classList.remove('active');
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');
      document.querySelectorAll('.car-card').forEach(card => {
        card.style.display = (filter === 'all' || card.dataset.brand === filter) ? '' : 'none';
      });
    });
  });

  document.querySelectorAll('.faq-item').forEach(item => {
    item.querySelector('.faq-question').addEventListener('click', () => {
      item.classList.toggle('active');
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    const notifikasi = [
      { message: "Booking anda disetujui", read: false },
      { message: "Booking anda ditolak", read: false }
    ];

    const notifMenu = document.getElementById("notif-menu");
    const notifCount = document.getElementById("notif-count");

    function renderNotifikasi() {
      notifMenu.innerHTML = '';
      let unreadCount = 0;

      notifikasi.forEach((n, i) => {
        if (!n.read) unreadCount++;
        notifMenu.innerHTML += `
          <li>
            <a href="#" class="dropdown-item small text-wrap" onclick="markAsRead(${i})">${n.message}</a>
          </li>
        `;
      });

      if (notifikasi.length === 0) {
        notifMenu.innerHTML = '<li class="text-muted text-center">Tidak ada notifikasi</li>';
      }

      notifCount.innerText = unreadCount;
      notifCount.style.display = unreadCount > 0 ? 'inline-block' : 'none';
    }

    window.markAsRead = function (index) {
      notifikasi[index].read = true;
      renderNotifikasi();
    };

    renderNotifikasi();
  });

  document.getElementById("notificationDropdown").addEventListener("click", function (e) {
    e.preventDefault();

    fetch("get_notifikasi.php")
      .then(res => res.text())
      .then(data => {
        document.getElementById("notifBody").innerHTML = data;
        new bootstrap.Modal(document.getElementById("notifModal")).show();
        document.getElementById("notif-count").innerText = '0';
      });

    fetch("tandai_dibaca.php");
  });

  document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".car-card");
    cards.forEach((card, index) => {
      setTimeout(() => {
        card.classList.add("show");
      }, index * 150);
    });
  });
</script>
