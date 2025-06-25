<?php
require 'config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "UPDATE booking_test_drive SET status = 'Ditolak' WHERE id_booking = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: dataBooking.php");
        exit;
    } else {
        echo "Gagal menolak booking: " . mysqli_error($conn);
    }
} else {
    echo "ID booking tidak ditemukan.";
}
