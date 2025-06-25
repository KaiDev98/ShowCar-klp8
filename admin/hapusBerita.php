<?php
session_start();
require '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $stmt = $pdo->prepare("DELETE FROM berita WHERE id = ?");
        if ($stmt->execute([$id])) {
            $_SESSION['berita_status'] = 'deleted';
        } else {
            $_SESSION['berita_status'] = 'delete_failed';
        }

        header("Location: dataBerita.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['berita_status'] = 'delete_failed';
        header("Location: dataBerita.php");
        exit();
    }
} else {
    $_SESSION['berita_status'] = 'invalid_id';
    header("Location: dataBerita.php");
    exit();
}
?>
<?