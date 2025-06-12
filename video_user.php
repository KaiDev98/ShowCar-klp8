<?php
$koneksi = new mysqli("localhost", "root", "", "showroom_mobil");
$data = $koneksi->query("SELECT * FROM video_spesifikasi ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lihat Video Spesifikasi Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <h2 class="mb-4">🚗 Spesifikasi Mobil (Video)</h2>

    <div class="row">
        <?php while ($row = $data->fetch_assoc()) { ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5><?= $row['judul'] ?></h5>
                        <iframe width="100%" height="250" src="<?= $row['link_video'] ?>" frameborder="0" allowfullscreen></iframe>
                        <p class="mt-2"><?= $row['deskripsi'] ?></p>
                        <a href="form_pembelian.php?mobil=<?= urlencode($row['judul']) ?>" class="btn btn-success">Saya Tertarik</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
