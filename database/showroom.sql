-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2025 pada 10.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `showroom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `balasan`
--

CREATE TABLE `balasan` (
  `id` int(11) NOT NULL,
  `topik_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `balasan`
--

INSERT INTO `balasan` (`id`, `topik_id`, `nama`, `isi`, `tanggal`) VALUES
(1, 1, 'woila', 'eoi', '2025-05-30 10:48:15'),
(2, 1, 'tess', 'fad', '2025-05-30 10:48:27'),
(3, 1, 'fafdas', 'fasdf', '2025-05-30 10:48:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal_publikasi` date DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal_publikasi`, `penulis`) VALUES
(1, 'tes', 'tes', 'stir.avif', '2025-05-30', 'admin'),
(2, 'tes', 'fq', 'car1.avif', '2025-05-30', 'admin'),
(3, 'tes', 'fgq', 'tesla.avif', '2025-05-30', 'teshfbES'),
(4, 'tad', 'adaf', 'nissangtr.avif', '2025-05-30', 'adafd'),
(5, 'fadf', 'afad', 'porsche.avif', '2025-05-30', 'fadf'),
(6, '52t', 't234t', 'android-bats-material-design-dark-background-silhouette-5k-9000x5000-8513.png', '2025-05-30', 'twerwt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_test_drive`
--

CREATE TABLE `booking_test_drive` (
  `id_booking` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `merk_mobil` varchar(100) NOT NULL,
  `waktu_testdrive` datetime NOT NULL,
  `pertanyaan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking_test_drive`
--

INSERT INTO `booking_test_drive` (`id_booking`, `nama_lengkap`, `email`, `no_hp`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `merk_mobil`, `waktu_testdrive`, `pertanyaan`, `created_at`) VALUES
(1, 'Muhammad rifki', 'rifki@gmail.com', '9841414834', '1999-01-02', 'Laki-laki', 'baranti', 'pare pare', 'Avanza', '2025-04-28 13:45:00', 'tes', '2025-05-30 04:43:16'),
(2, 'Muhammad rifki', 'tes@gmail.com', 'fafd', '0044-04-13', 'Perempuan', 'wtrwe', 'wgtwrgt', 'wgwrg', '0025-03-04 14:34:00', 'gsdgsdf', '2025-05-30 04:52:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `transmission` varchar(50) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'SUV'),
(2, 'Sedan'),
(3, 'Hatchback');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `name`, `email`, `pesan`, `created_at`) VALUES
(2, 'kai', 'muhammadrifkimms@gmail.com', 'tes doang', '2025-05-30 16:47:02'),
(3, 'kai', 'muhammadrifkimms@gmail.com', 'tes doang', '2025-05-30 16:47:57'),
(4, 'tes', 'tes@gmail', 'tes', '2025-05-30 16:49:40'),
(5, 'tamu1', 'tamu1@gmail.com', 'fahfafa', '2025-05-30 23:30:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merek`
--

CREATE TABLE `merek` (
  `id_merek` int(11) NOT NULL,
  `nama_merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `merek`
--

INSERT INTO `merek` (`id_merek`, `nama_merek`) VALUES
(1, 'Toyota'),
(2, 'Honda'),
(3, 'Mitsubishi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `id_merek` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('tersedia','terjual') DEFAULT 'tersedia',
  `spesifikasi` text DEFAULT NULL,
  `video_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `nama_mobil`, `id_merek`, `id_kategori`, `harga`, `stok`, `gambar`, `status`, `spesifikasi`, `video_url`) VALUES
(1, 'Toyota Fortuner', 1, 1, 5, 3, 'fortuner.jpg', 'tersedia', NULL, NULL),
(2, 'Honda Civic', 2, 2, 450000000, 5, 'civic.jpg', 'tersedia', NULL, NULL),
(8, 'Toyota Calva', 1, 2, 2147483647, 1, 'uploads/68392c223237b_toyota-calva.avif', 'tersedia', NULL, 'https://www.youtube.com/embed/xhZvehnxLLM'),
(9, 'Honda Brio', 2, 1, 2147483647, 1, 'uploads/68392f0b3065c_honda-brio.avif', 'tersedia', NULL, 'https://www.youtube.com/embed/2VbzjWgk4Rw'),
(10, 'Toyota Rush', 1, 1, 1, 1, 'uploads/68392f56a634b_toyota-rush.avif', 'tersedia', NULL, 'https://www.youtube.com/embed/2VbzjWgk4Rw'),
(11, 'Honda Wr-V', 2, 1, 200, 1, 'uploads/68392faa8510f_honda-wr-v-avif.avif', 'terjual', NULL, 'https://www.youtube.com/embed/xhZvehnxLLM'),
(12, 'Honda Cr-V', 2, 3, 1, 1, 'uploads/683931ef2097c_honda-cr-v.avif', 'terjual', NULL, 'https://www.youtube.com/embed/xhZvehnxLLM'),
(13, 'avanza', 1, 2, 1, 1, 'uploads/6839337fa47da_toyota-rush.avif', 'tersedia', NULL, 'https://www.youtube.com/embed/xhZvehnxLLM'),
(14, 'Bmw X1', 1, 1, 1, 1, 'uploads/683934a553043_bmw-x1.avif', 'tersedia', NULL, 'https://www.youtube.com/embed/xhZvehnxLLM'),
(16, 'avanza', 1, 2, 11111, 1, 'uploads/683a476ab7ff9_bmw-x1.avif', 'tersedia', NULL, ''),
(17, 'bmw', 1, 1, 2147483647, 2, 'uploads/683a4a7cc44f0_jeep.avif', 'tersedia', 'yaudah si', 'https://www.youtube.com/embed/2VbzjWgk4Rw'),
(18, 'Tesla', 1, 1, 2147483647, 0, 'uploads/683a4c6f25b2e_tesla.avif', '', 'tesla', 'https://www.youtube.com/embed/2VbzjWgk4Rw'),
(19, 'avanza', 2, 2, 1241, 2, 'uploads/683a4d4747bdb_683924d8ccc72_car1.avif', 'terjual', 'ffa', 'https://www.youtube.com/embed/2VbzjWgk4Rw'),
(20, 'bmw', 1, 1, 34134, 1, 'uploads/683a4d9d6363a_683865d8975b3_mitsubishi.avif', 'tersedia', NULL, 'https://www.youtube.com/embed/2VbzjWgk4Rw'),
(21, 'avanza', 1, 2, 1313, 1, 'uploads/683a59525f18a_android-bats-material-design-dark-background-silhouette-5k-9000x5000-8513.png', 'tersedia', NULL, 'https://www.youtube.com/watch?v=jum8PGur1PU&pp=0gcJCbAJAYcqIYzv');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_mobil`, `nama`, `email`, `no_hp`, `alamat`, `status`, `tanggal_pesan`) VALUES
(2, 1, 'Aris Munandar', 'muhammadrifkimms@gmail.com', '4123646134', 'okemi', 'Dalam Proses', '2025-05-29 11:26:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `mobil_id` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id`, `nama`, `mobil_id`, `komentar`, `rating`, `created_at`) VALUES
(1, 'Muhammad Rifki Rusli', 1, 'yaudah si', 5, '2025-05-30 10:22:30'),
(2, 'ikki', 1, 'tes', 2, '2025-05-30 10:23:22'),
(3, 'woila', 2, 'tes', 3, '2025-05-30 10:26:33'),
(4, 'muhammad rifki', 10, 'woi penipu balikin duit gw jir', 1, '2025-05-30 22:43:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topik`
--

CREATE TABLE `topik` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `topik`
--

INSERT INTO `topik` (`id`, `nama`, `email`, `judul`, `isi`, `tanggal`) VALUES
(1, 'rifki', 'muhammadrifkimms@gmail.com', 'Avnza', 'yaudah si', '2025-05-30 10:47:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Rifki1', 'muhammadrifkimms@gmail.com', '$2y$10$rYPCgiidSuc2QTKReuE6w.4a7zxvzy8ria0Rubo0HqaLaB5Lz0E1q', '2025-05-29 11:45:59'),
(2, 'Rifki1', 'rifki@gmail.com', '$2y$10$JP5i5pOrbSJTGlg8/t/XDuHGs3FNeMPV8psTQgmjHtnvUXVXqNNm6', '2025-05-29 13:58:14'),
(3, 'ikka', 'ikka@gmail', '$2y$10$JPqKbhSFFSQNhdChEw1vwOZnAHrJXRq2bZcKDoVpdKK6C/f1ZR6yS', '2025-05-30 01:30:36'),
(4, 'tes', 'yaudahsi@gmail.com', '$2y$10$1fwXIc6mkqfkPgPeAA/0vedKhVHpU43CDx5t7fyghkquNz6o3/xDq', '2025-05-31 01:55:31'),
(8, 'Rifki1', 'rkysecret@gmail.com', '$2y$10$CRXLx8jGcrxsMrrpQ2SQ6On27y8/LPDD3cuRLmceMMXy/eNFO5N8u', '2025-05-31 01:59:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_spesifikasi`
--

CREATE TABLE `video_spesifikasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `link_video` text NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `video_spesifikasi`
--

INSERT INTO `video_spesifikasi` (`id`, `judul`, `link_video`, `deskripsi`, `created_at`) VALUES
(1, 'tes', 'https://www.youtube.com/watch?v=gDcnSL4wTWw', 'tes', '2025-05-30 03:00:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `balasan`
--
ALTER TABLE `balasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topik_id` (`topik_id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `booking_test_drive`
--
ALTER TABLE `booking_test_drive`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `id_merek` (`id_merek`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_id` (`mobil_id`);

--
-- Indeks untuk tabel `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `video_spesifikasi`
--
ALTER TABLE `video_spesifikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `balasan`
--
ALTER TABLE `balasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `booking_test_drive`
--
ALTER TABLE `booking_test_drive`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `merek`
--
ALTER TABLE `merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `topik`
--
ALTER TABLE `topik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `video_spesifikasi`
--
ALTER TABLE `video_spesifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `balasan`
--
ALTER TABLE `balasan`
  ADD CONSTRAINT `balasan_ibfk_1` FOREIGN KEY (`topik_id`) REFERENCES `topik` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_ibfk_1` FOREIGN KEY (`id_merek`) REFERENCES `merek` (`id_merek`),
  ADD CONSTRAINT `mobil_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);

--
-- Ketidakleluasaan untuk tabel `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
