<?php
// hapusMobil.php
include '../koneksi.php';

// Ambil dan sanitasi ID mobil
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    $deletionError = false;

    /* ===========================
       1. Ambil semua path gambar di tabel gambar_mobil
       =========================== */
    $stmtImgPaths = $conn->prepare("SELECT gambar FROM gambar_mobil WHERE id_mobil = ?");
    $stmtImgPaths->bind_param("i", $id);
    if (!$stmtImgPaths->execute()) {
        $deletionError = true;
    } else {
        $resultImg = $stmtImgPaths->get_result();
        while ($row = $resultImg->fetch_assoc()) {
            $relativePath = $row['gambar']; // misal: "uploads/abc123.jpg"
            $fullPath     = __DIR__ . '/../' . $relativePath;
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }
    }
    $stmtImgPaths->close();

    /* ===========================
       2. Hapus baris di tabel gambar_mobil
       =========================== */
    if (!$deletionError) {
        $stmtDeleteImgs = $conn->prepare("DELETE FROM gambar_mobil WHERE id_mobil = ?");
        $stmtDeleteImgs->bind_param("i", $id);
        if (!$stmtDeleteImgs->execute()) {
            $deletionError = true;
        }
        $stmtDeleteImgs->close();
    }

    /* ===========================
       3. (Opsional) Hapus file video jika ada di tabel mobil
       =========================== */
    if (!$deletionError) {
        $stmtVideo = $conn->prepare("SELECT video FROM mobil WHERE id_mobil = ?");
        $stmtVideo->bind_param("i", $id);
        if ($stmtVideo->execute()) {
            $stmtVideo->bind_result($videoPath);
            if ($stmtVideo->fetch() && $videoPath) {
                $fullVideoPath = __DIR__ . '/../' . $videoPath;
                if (file_exists($fullVideoPath)) {
                    @unlink($fullVideoPath);
                }
            }
        } else {
            $deletionError = true;
        }
        $stmtVideo->close();
    }

    /* ===========================
       4. Hapus baris di tabel mobil
       =========================== */
    if (!$deletionError) {
        $stmtDeleteMobil = $conn->prepare("DELETE FROM mobil WHERE id_mobil = ?");
        $stmtDeleteMobil->bind_param("i", $id);
        if (!$stmtDeleteMobil->execute()) {
            $deletionError = true;
        }
        $stmtDeleteMobil->close();
    }

    if ($deletionError) {
        echo '<script>
                alert("Gagal menghapus mobil. Silakan coba lagi.");
                window.location.href = "index.php";
              </script>';
        exit;
    } else {
        echo '<script>
                alert("Berhasil menghapus mobil.");
                window.location.href = "index.php";
              </script>';
        exit;
    }
}

// Jika $id <= 0, langsung redirect tanpa popup
header("Location: index.php");
exit;
?>
