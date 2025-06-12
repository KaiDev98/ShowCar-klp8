<?php
session_start();

// Jika sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: login.php");
    exit();
}

// Jika belum login, arahkan ke form login
header("Location login.php");
exit();
?>
