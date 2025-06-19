<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $judul = $_POST['judul'];
    $isi   = $_POST['isi'];

    // Persiapkan dan eksekusi statement
    $stmt = $conn->prepare("INSERT INTO topik (nama, email, judul, isi) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $judul, $isi);
    $stmt->execute();
    $stmt->close(); // Tambahan: menutup statement setelah eksekusi
}

$conn->close(); // Tambahan: menutup koneksi database
header("Location: index.php");
exit;
