<?php
session_start();
include 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

$query = "
    SELECT m.*, mr.nama_merek, k.nama_kategori
    FROM mobil m
    JOIN merek mr ON m.id_merek = mr.id_merek
    JOIN kategori k ON m.id_kategori = k.id_kategori
    WHERE m.id_mobil = $id
";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    echo "Mobil tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();

$gambarList = [];
$q = $conn->query("SELECT gambar FROM gambar_mobil WHERE id_mobil = $id");
while ($row = $q->fetch_assoc()) {
    $gambarList[] = 'uploads/' . $row['gambar'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($data['nama_mobil']) ?></title>
  <link rel="stylesheet" href="assets/css/detail-mobil.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TODO" crossorigin="anonymous"> -->

  <style>
    .image-slider { position: relative; width: 100%; max-width: 600px; margin: 20px auto; overflow: hidden; border-radius: 8px; background-color: #f9f9f9; }
    .slides { display: flex; transition: transform 0.4s ease-in-out; width: calc(100% * <?= max(1, count($gambarList)) ?>); }
    .slide { min-width: 100%; }
    .slide img { display: block; width: 100%; object-fit: cover; }
    .thumbnail-container img:hover { opacity: 0.8; border: 2px solid #0288D1; }
    .btn:hover { opacity: 0.9; }
    .tab-item.active {
      border-bottom: 2px solid #0288D1;
      color: #0288D1;
    }
  </style>
</head>
<body>
  <div class="container-detail" style="display: flex; flex-wrap: wrap; gap: 40px; max-width: 1200px; margin: 40px auto;">
    <!-- Gambar dan Slider -->
    <div class="image-section" style="flex: 1 1 100%; position: relative;">
      <div class="main-image" style="position: relative;">
        <img id="mainDisplay" src="<?= htmlspecialchars($gambarList[0] ?? 'placeholder.jpg') ?>" style="width: 100%; border-radius: 8px; object-fit: cover; max-height: 500px;" />
        <button onclick="prevImage()" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background: rgba(0,0,0,0.5); border: none; color: white; padding: 10px; border-radius: 50%;">❮</button>
        <button onclick="nextImage()" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: rgba(0,0,0,0.5); border: none; color: white; padding: 10px; border-radius: 50%;">❯</button>
        <div id="imageCounter" style="position: absolute; bottom: 10px; right: 20px; background: rgba(0,0,0,0.6); color: white; padding: 5px 10px; border-radius: 5px;">
          1 / <?= count($gambarList) ?>
        </div>
      </div>
      <div class="thumbnail-container" style="display: flex; gap: 10px; margin-top: 10px; overflow-x: auto;">
        <?php foreach ($gambarList as $index => $img): ?>
          <img src="<?= htmlspecialchars($img) ?>" onclick="goToImage(<?= $index ?>)" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px; cursor: pointer;" />
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Informasi Mobil & Tombol Booking -->
    <div class="flex flex-col gap-5 flex-1 basis-2/5">
      <h1 class="text-2xl font-bold m-0"><?= htmlspecialchars($data['nama_mobil']) ?></h1>
      <div class="text-lg text-gray-600">
        <span class="font-semibold">Harga:</span> Rp <?= number_format($data['harga'], 0, ',', '.') ?>
      </div>
      <div>
        <?php if (isset($_SESSION['email'])): ?>
         <a href="booking.php?id=<?= htmlspecialchars($data['id_mobil']) ?>" class="inline-block px-5 py-2 bg-red-600 text-white rounded-md font-semibold hover:bg-red-700 transition">Booking</a>
        <?php else: ?>
        <a href="login.php" class="inline-block px-5 py-2 bg-black text-white rounded-md font-semibold hover:bg-gray-800 transition">
          Login untuk Booking
        </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Tab Navigasi & Konten -->
    <div style="flex: 1 1 100%; margin-top: 30px;">
      <div id="tabs" style="display: flex; gap: 20px; border-bottom: 2px solid #eee; padding-bottom: 10px; cursor: pointer;">
        <div class="tab-item active" data-tab="spec" style="padding: 10px; font-weight: bold;">Spesifikasi</div>
        <div class="tab-item" data-tab="video" style="padding: 10px; font-weight: bold;">Video</div>
        <div class="tab-item" data-tab="review" style="padding: 10px; font-weight: bold;">Review</div>
        <div class="tab-item" data-tab="diskusi" style="padding: 10px; font-weight: bold;">Diskusi</div>
      </div>  

      <div id="tab-contents" style="margin-top: 20px;">

         <!-- Tab Spesifikasi -->
        <div class="tab-content" id="tab-spec" style="display: block;">
          <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-2xl mx-auto">
            <h2 class="text-xl font-semibold mb-4">Spesifikasi Utama <?= htmlspecialchars($data['nama_mobil']) ?></h2>
            
            <div class="divide-y divide-gray-200">
              <div class="flex justify-between py-3">
                <span class="text-gray-600">Jenis Transmisi</span>
                <span class="font-medium"><?= htmlspecialchars($data['transmisi']) ?></span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-gray-600">Jenis Bahan Bakar</span>
                <span class="font-medium"><?= htmlspecialchars($data['bahan_bakar']) ?></span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-gray-600">Kapasitas Mesin</span>
                <span class="font-medium"><?= htmlspecialchars($data['kapasitas_mesin']) ?></span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-gray-600">Tenaga</span>
                <span class="font-medium"><?= htmlspecialchars($data['tenaga']) ?></span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-gray-600">Kapasitas Tempat Duduk</span>
                <span class="font-medium"><?= htmlspecialchars($data['kapasitas_tempat_duduk']) ?></span>
              </div>
            </div>
          </div>
        </div>


        <!-- Tab Video -->
        <div class="tab-content" id="tab-video" style="display: none;">
          <?php if (!empty($data['video_url'])): ?>
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
              <iframe src="<?= htmlspecialchars($data['video_url']) ?>" frameborder="0" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
            </div>
          <?php else: ?>
            <p>Video belum tersedia.</p>
          <?php endif; ?>
        </div>

        <!-- Tab review -->
        <div class="tab-content" id="tab-review" style="display: none;">
          <?php
          $stmt = $conn->prepare("SELECT * FROM review WHERE mobil_id = ? ORDER BY created_at DESC");
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $reviews = $stmt->get_result();

          if ($reviews->num_rows > 0):
            while ($rev = $reviews->fetch_assoc()): 
              $rating = floatval($rev['rating']);
          ?>
            <div class="bg-white border shadow-md p-6 rounded-lg mb-6">
              <!-- Judul Review -->
              <?php if (!empty($rev['judul'])): ?>
                <p class="text-2xl font-bold text-black mb-2"><?= htmlspecialchars($rev['judul']) ?></p>
              <?php endif; ?>

              <!-- Rating Bintang dan Skor -->
              <div class="flex items-center mb-2">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                  if ($rating >= $i) {
                    echo '<i class="fa-solid fa-star text-orange-500 text-xl mr-1"></i>';
                  } elseif ($rating >= ($i - 0.5)) {
                    echo '<i class="fa-solid fa-star-half-stroke text-orange-500 text-xl mr-1"></i>';
                  } else {
                    echo '<i class="fa-regular fa-star text-gray-300 text-xl mr-1"></i>';
                  }
                }
                ?>
                <span class="ml-2 text-lg font-semibold"><?= number_format($rating, 1) ?>/5</span>
                <!-- <span class="ml-3 font-medium text-gray-600">Istimewa</span> -->
              </div>

              <!-- Isi Komentar -->
              <p class="text-gray-800 leading-relaxed mb-4"><?= nl2br(htmlspecialchars($rev['komentar'])) ?></p>

              <!-- Reviewer dan Tanggal -->
              <div class="flex items-center space-x-3">
                <!-- Avatar bulat dengan inisial -->
                <div class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center font-bold">
                  <?= strtoupper($rev['nama'][0]) ?>
                </div>
                <div>
                  <p class="font-semibold text-sm"><?= htmlspecialchars($rev['nama']) ?></p>
                  <p class="text-xs text-gray-500"><?= date('d M, Y', strtotime($rev['created_at'])) ?></p>
                </div>
              </div>
            </div>
          <?php endwhile;
          else: ?>
            <p class="text-gray-600">Belum ada ulasan untuk mobil ini.</p>
          <?php endif; ?>

          <!-- Tombol Tulis Review -->
          <a href="tambahReview.php?mobil_id=<?= $id ?>" class="mt-5 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
            ✍️ Tulis Review Anda
          </a>
        </div>

        <!-- akhiran tab review -->

         <!-- Tab Diskusi -->
        <div class="tab-content" id="tab-diskusi" style="display: none;">
          <h3 class="text-xl font-bold mb-4">Diskusi Mobil</h3>

          <!-- Form Komentar Utama -->
          <form method="POST" action="tambahDiskusi.php" class="mb-5 space-y-3">
            <?php if (!isset($_SESSION['username'])): ?>
              <input type="text" name="nama" placeholder="Nama Anda" class="w-full p-2 border rounded" required>
            <?php else: ?>
              <input type="hidden" name="nama" value="<?= htmlspecialchars($_SESSION['username']) ?>">
            <?php endif; ?>

            <textarea name="komentar" placeholder="Tulis komentar atau pertanyaan..." class="w-full p-2 border rounded" required></textarea>
            <input type="hidden" name="id_mobil" value="<?= htmlspecialchars($id) ?>">

            <!-- Tombol Kirim (Merah) -->
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
              Kirim
            </button>
          </form>


        <!-- List Komentar -->
        <?php
        $komentarUtama = $conn->query("SELECT * FROM diskusi WHERE id_mobil = $id AND parent_id IS NULL ORDER BY tanggal DESC");
        while ($komentar = $komentarUtama->fetch_assoc()):
        ?>
          <div class="mb-4 p-3 border rounded">
            <strong><?= htmlspecialchars($komentar['nama']) ?></strong><br>
            <p class="mb-2"><?= nl2br(htmlspecialchars($komentar['komentar'])) ?></p>
            <small class="text-gray-500"><?= $komentar['tanggal'] ?></small>

            <!-- Balasan -->
            <?php
            $idKomentar = $komentar['id'];
            $balasan = $conn->query("SELECT * FROM diskusi WHERE parent_id = $idKomentar ORDER BY tanggal ASC");
            while ($reply = $balasan->fetch_assoc()):
            ?>
              <div class="ml-5 mt-3 p-2 border-l-4 border-blue-300 bg-gray-50 rounded">
                <strong><?= htmlspecialchars($reply['nama']) ?></strong><br>
                <p><?= nl2br(htmlspecialchars($reply['komentar'])) ?></p>
                <small class="text-gray-500"><?= $reply['tanggal'] ?></small>
              </div>
            <?php endwhile; ?>

            <!-- Form Balas -->
            <form method="POST" action="tambahDiskusi.php" class="mt-3 space-y-2 ml-5">
              <?php if (!isset($_SESSION['username'])): ?>
                <input type="text" name="nama" placeholder="Nama Anda" class="w-full p-2 border rounded" required>
              <?php else: ?>
                <input type="hidden" name="nama" value="<?= htmlspecialchars($_SESSION['username']) ?>">
              <?php endif; ?>

              <textarea name="komentar" placeholder="Balas komentar ini..." class="w-full p-2 border rounded" required></textarea>
              <input type="hidden" name="parent_id" value="<?= $komentar['id'] ?>">
              <input type="hidden" name="id_mobil" value="<?= htmlspecialchars($id) ?>">
              <!-- Contoh tombol balas -->
              <button class="px-3 py-1 bg-black text-white rounded hover:bg-gray-800">
                Balas
              </button>
            </form>
          </div>
        <?php endwhile; ?>
      </div>

  <!-- Script Slider dan Tab -->
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    const imageList = <?= json_encode($gambarList) ?>;
    let currentIndex = 0;

    function updateImage() {
      const mainDisplay = document.getElementById('mainDisplay');
      const imageCounter = document.getElementById('imageCounter');
      mainDisplay.src = imageList[currentIndex];
      imageCounter.textContent = (currentIndex + 1) + ' / ' + imageList.length;
    }

    function nextImage() {
      currentIndex = (currentIndex + 1) % imageList.length;
      updateImage();
    }

    function prevImage() {
      currentIndex = (currentIndex - 1 + imageList.length) % imageList.length;
      updateImage();
    }

    function goToImage(index) {
      currentIndex = index;
      updateImage();
    }

    // Tab navigation
    document.querySelectorAll('.tab-item').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');

        tab.classList.add('active');
        const selected = tab.getAttribute('data-tab');
        document.getElementById('tab-' + selected).style.display = 'block';
      });
    });

  const params = new URLSearchParams(window.location.search);
  const tabParam = params.get("tab");
  if (tabParam) {
    document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');

    const targetTab = document.querySelector(`.tab-item[data-tab="${tabParam}"]`);
    const targetContent = document.getElementById('tab-' + tabParam);
    if (targetTab && targetContent) {
      targetTab.classList.add('active');
      targetContent.style.display = 'block';
    }
  }

  const urlParams = new URLSearchParams(window.location.search);
  const tab = urlParams.get('tab');

  if (tab === 'diskusi') {
    document.getElementById('tab-diskusi').style.display = 'block';

    const tabLain = document.querySelectorAll('.tab-content');
    tabLain.forEach(t => {
      if (t.id !== 'tab-diskusi') {
        t.style.display = 'none';
      }
    });

    const diskusiTabNav = document.querySelector('[data-tab="diskusi"]');
    if (diskusiTabNav) {
      diskusiTabNav.classList.add('active'); // Tambah class jika kamu pakai
    }
  }

  </script>
</body>

</html>
