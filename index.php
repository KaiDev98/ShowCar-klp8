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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
    <link href="assets/css/style.css" rel="stylesheet"/>

  </head>
  <body id="home">
    <!-- NAVBAR -->
    <nav
      class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top"
    >
      <div class="container">
        <a class="navbar-brand font-weight-bold text-danger" href="#"
          >ShowCar</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="navbar-nav">
            <li class="nav-item mx-2">
              <a class="nav-link" href="#shop">Mobil Baru</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#ulasan">Ulasan</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#berita">Berita</a>
            </li>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#faqs">Faqs</a>
            </li>
          </ul>
          <div class="ml-3">
            <a href="login.php" class="btn btn-outline-danger mx-1">Login</a>
            <a href="register.php" class="btn btn-danger mx-1">Register</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- akhiran navbar -->

    <!-- section -->
         <section class="hero">
      <div class="blur-overlay"></div>
      <div class="vertical-text">Tampilkan Mobil Baru</div>
      <div class="hero-content">
        <p class="tagline">/ Mobil Dalam Langkah Mudah</p>
        <h1 class="title">
          Cara Sempurna Untuk Mengeksplor<br />Dan Cek Mobil Di Platform Kami
        </h1>
        <div class="cta-buttons">
          <button class="btn red" onclick="window.location.href='#porsche'">
           Jelajahi Mobil
          </button>
          <button class="btn outline" onclick="window.location.href='#shop'">
            Lihat Katalog
          </button>
        </div>
        <div class="icons">
          <span class="social-text">Kami ada di media sosial:</span>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
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
    <div class="row" id="carGrid">
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
      ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4 car-card" data-brand="<?= $brand ?>">
          <div class="card h-100 shadow-sm">
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

    <!-- review -->
     <h2 id="ulasan"  style="text-align:center; margin-top:40px;" class="fw-bold">🏆 Ulasan dari Pelanggan Kami</h2>
<p style="text-align:center; margin-bottom:30px;">Temukan apa yang dikatakan pelanggan yang sudah membeli mobil</p>

<div class="review-container">
  <?php
  $result = $conn->query("SELECT r.*, m.nama_mobil FROM review r JOIN mobil m ON r.mobil_id = m.id_mobil ORDER BY r.created_at DESC LIMIT 3");
  while ($row = $result->fetch_assoc()) {
      $stars = str_repeat("★", $row['rating']) . str_repeat("☆", 5 - $row['rating']);
      echo "<div class='review-card'>";
      echo "<div class='stars'>$stars</div>";
      echo "<div class='review-date'>" . date("d M Y", strtotime($row['created_at'])) . "</div>";
      echo "<div class='review-title'>“" . htmlspecialchars(substr($row['komentar'], 0, 30)) . "…”</div>";
      echo "<p>" . nl2br(htmlspecialchars($row['komentar'])) . "</p>";
      echo "<div class='review-footer'>";
      echo "<strong>" . htmlspecialchars($row['nama']) . "</strong><br>";
      echo $row['nama_mobil'];
      echo "</div>";
      echo "</div>";
  }
  ?>
</div>

<div style="text-align:center; margin-top:20px;">
  <a href="ulasan.php" class="lihat-link  text-danger">Lihat lebih banyak ulasan</a>
</div>

     <!-- akhiran review -->

<!-- berita -->
<?php
require 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM berita");
?>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 id="berita" class="fw-bold">Berita Otomotif Dan Review</h2>
    <a href="berita-otomotif.php" class="btn btn-link text-danger fw-semibold">
      Baca Semua Berita Terbaru <i class="bi bi-arrow-right"></i>
    </a>
  </div>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <div class="col">
        <a href="berita-detail.php?id=<?= $row['id']; ?>" class="text-decoration-none text-dark">
          <div class="card h-100 shadow-sm border-0">
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
 
    <!-- FAQ -->
    <section id="faqs" class="faq-container">
      <div class="faq-left">
        <h2>FAQs</h2>
        <div class="faq-item active">
          <div class="faq-question">
            <h5>Apa itu ShowCar?</h5>
            <span class="icon">−</span>
          </div>
          <div class="faq-answer">
            <p>ShowCar Merupakan platform penjualan mobil secara Online</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            <h5>Bagaimana saya dapat menghubungi ShowCar?</h5>
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Anda dapat menghubungi nomor kami 82075289374</p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Bagaimana saya dapat memesan mobil secara online?</h5>
            <span class="icon">-</span>
          </div>
          <div class="faq-answer">
            <p>
              Silahkan kunjungi website resmi Showcar. Lakukan login / regist,
              pilih mobil, isi data sesuai petunju, dan lakukan pemesanan.
              Silahkan tunggu tim kami menghubungi anda.
            </p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Bagaimana cara melihat detail mobil?</h5>
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            <p>
              Silahkan login atau regist dan buttuon buy pada mobil untuk
              melihat detail
            </p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Apakah Showcar menjual mobil baru?</h5>
            <span class="icon">-</span>
          </div>
          <div class="faq-answer">
            <p>Showcar hanya menjual mobil baru.</p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Apakah saya perlu mendaftar akun?</h5>
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Ya, anda butuh akun jika ingin membeli mobil baru.</p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Apakah bisa melakukan test drive?</h5>
            <span class="icon">-</span>
          </div>
          <div class="faq-answer">
            <p>Anda dapat melakukan test drive jika membeli mobil</p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Bagaimana mengetahui mobil masih tersedia?</h5>
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Jika mobil masih tampil di website, mobil masih tersedia</p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Apakah Showcar melayani seluruh Indonesia?</h5>
            <span class="icon">-</span>
          </div>
          <div class="faq-answer">
            <p>Showcar hanya melayani kota Pare pare dan sekitarnya</p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>
              Bagaimana saya tahu status pemesanan mobil yang akan dibeli?
            </h5>
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            <p>
              Akan muncul konfirmasi di halaman website bahwa anda telah
              melakukan pemesanan dan silahkan tunggu tim kami menghubungi anda.
            </p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Bagaimana metode pembayaran di Showcar?</h5>
            <span class="icon">-</span>
          </div>
          <div class="faq-answer">
            <p>
              Anda dapat melakukan di toko fisik, baik tunai maupun non tunai.
            </p>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <h5>Bagaimana saya dapat menghubungi layanan service ShowCar?</h5>
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Anda dapat menghubungi nomor kami 82075289374</p>
          </div>
        </div>

        <!-- Tambah item lainnya sesuai kebutuhan -->
      </div>

      <div class="faq-right">
        <div class="image-container">
          <img src="assets/img/footer.jpg" alt="ShowCar" />
        </div>
        <div class="overlay-text">
          <span>Show</span><span class="highlight">Car</span>
        </div>
      </div>
    </section>
    <!-- akhiran faq -->

    <!-- Footer Start -->
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
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
      const indicators = document.querySelectorAll(".indicator div");
      const cards = document.querySelectorAll(".card-wrapper");

      indicators.forEach((indicator) => {
        indicator.addEventListener("click", () => {
          const index = indicator.dataset.index;

          // Update active indicator
          indicators.forEach((i) => i.classList.remove("active"));
          indicator.classList.add("active");

          // Switch cards with animation
          cards.forEach((card) => {
            if (card.dataset.index === index) {
              card.classList.add("active");
            } else {
              card.classList.remove("active");
            }
          });
        });
      });

        // Ambil semua elemen dengan class 'faq-question'
  const faqQuestions = document.querySelectorAll('.faq-question');

  faqQuestions.forEach((question) => {
    question.addEventListener('click', () => {
      const item = question.parentElement;
      const icon = question.querySelector('.icon');

      // Toggle class 'active' untuk menampilkan/sembunyikan jawaban
      item.classList.toggle('active');

      // Ubah simbol ikon + atau -
      if (item.classList.contains('active')) {
        icon.textContent = '−';
      } else {
        icon.textContent = '+';
      }

      // Tutup semua item lainnya (jika hanya ingin satu terbuka sekaligus)
      faqQuestions.forEach((otherQuestion) => {
        const otherItem = otherQuestion.parentElement;
        const otherIcon = otherQuestion.querySelector('.icon');
        if (otherItem !== item) {
          otherItem.classList.remove('active');
          otherIcon.textContent = '+';
        }
      });
    });
  });
    </script>
  </body>
</html>
