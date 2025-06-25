-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2025 pada 13.49
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
(1, 'admin', '$2y$10$N8K4rVnxcNIexR.NCiuT6eZZgQFqWtit4mDRI0g3U1x9hs1/UNO8i');

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
(3, 1, 'fafdas', 'fasdf', '2025-05-30 10:48:32'),
(4, 3, 'hai', 'tes', '2025-06-01 18:04:36');

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
  `penulis` varchar(100) DEFAULT NULL,
  `status` enum('draft','publikasi') DEFAULT 'draft',
  `mobil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal_publikasi`, `penulis`, `status`, `mobil_id`) VALUES
(9, 'BMW Indonesia Jual M4 CSL, Hanya 2 Unit!', 'BMW Indonesia tak hanya meluncurkan Seri 3 LCI. Mereka sekaligus merilis BMW M4 CSL. Ya, Indonesia kebagian secara resmi lewat APM. Model terkencang yang mereka produksi saat ini hanya diproduksi 1.000 unit. Model ini dihadirkan sebagai hadiah khusus perayaan 50 tahun BMW M, sebagai divisi khusus performa dan balap. Desain dan spesifikasinya sudah sangat mendekati mobil balap.\r\n\r\nCSL singkatan dari “Competition, Sport, Lightweight”. Mengandalkan bumbu peningkatan tampilan dan performa mendekati mobil balap untuk BMW M4. Hadirnya M4 CSL menegaskan posisinya yang lebih ganas sebagai mobil sport, di atas M2 CS dan M5 CS. Bahkan BMW klaim mobil ini menjadi produksi tercepat saat digeber di Nurburgring Nordschleife.\r\n\r\nSpesifikasi M4 CSL mengutamakan pemangkasan bobot. Sehingga bisa memberikan performa sedekat mungkin seperti mobil balap. Eksterior terpangkas bobot sebanyak 3,6 kg dari kidney grille raksasa, lampu belakang, karpet, dan AC otomatis. Pengurangan bobot total M4 CSL sampai 109 kg dari varian standarnya, identik seperti yang terjadi pada M3 CSL dulu di generasi E46.', 'berita2.jpg', '2025-06-06', 'Admin', 'draft', 0),
(11, 'Toyota Kasih Fitur Canggih Buat New Fortuner 2024, Apa Saja?', 'Perubahan pada New Fortuner tidak terbatas pada estetika, melainkan juga mencakup fitur-fitur baru. Toyota Astra Motor telah meningkatkan kenyamanan dengan memasang New Monotube Suspension yang mengurangi limbung saat manuver. Selain itu, Toyota Safety Sense 2.0 yang lebih canggih kini tersedia pada model puncak seperti VRZ 4x2 dan GR Parts Aeropackage. Toyota juga menawarkan konektivitas wifi gratis untuk hiburan internal, smartphone, dan laptop.', 'berita4.jpg', '2025-07-01', 'Admin', 'publikasi', 0),
(12, 'Mau Beli New Toyota Fortuner, Cek Dulu Skema Simulasi dengan DP 20 Persen', 'Toyota New Fortuner tak hanya mendapatkan pembaruan eksterior. Namun juga imbuhan fitur-fitur canggih. Ia menjadi pilihan baru dalam mobilitas sehari-hari maupun sebagai penunjang hobi. Tersedia banyak varian, mulai dari Rp573,7 juta hingga Rp761,7 juta on the road Jakarta. Bila Anda tertarik membeli secara kredit ke diler resmi. Bisa dapatkan dengan uang muka minimal 20 persen. Hitung-hitungannya dari Auto2000. Skema tidak mengikat dan dapat berubah sewaktu-waktu.', 'berita5.jpg', '2025-06-04', 'Admin', 'draft', 0),
(14, 'New Honda HR-V e:HEV Punya 5 Varian dan 2 Pilihan Mesin', 'Honda terus berinovasi dalam dunia otomotif Indonesia dengan menghadirkan New Honda HR-V e:HEV, menjadikannya SUV kompak pertama bertenaga hybrid dari pabrikan ini. Peluncuran model terbaru ini sekaligus memperkuat jajaran kendaraan elektrifikasi Honda, menawarkan efisiensi bahan bakar lebih baik, desain yang lebih futuristik, serta fitur yang semakin canggih. Dengan harga yang dimulai dari Rp399,9 juta, Honda menargetkan HR-V terbaru akan menjadi salah satu pilihan utama bagi konsumen yang mencari SUV kompak dengan performa optimal dan teknologi terkini.\r\n\r\nNew Honda HR-V kini hadir dengan lima pilihan varian, memberikan lebih banyak opsi kepada konsumen sesuai dengan kebutuhan mereka. Tersedia tipe E dan E+ yang masih mengandalkan mesin bensin konvensional, serta tiga varian hybrid yang terdiri dari HR-V e:HEV, HR-V e:HEV Modulo, dan HR-V RS e:HEV. Perbedaan utama dari setiap varian terletak pada fitur yang disematkan serta tampilan eksterior dan interiornya. Dengan hadirnya lebih banyak opsi, Honda memastikan setiap konsumen dapat memilih SUV yang sesuai dengan gaya hidup mereka.\r\n\r\nBerikut adalah harga resmi dari masing-masing varian New Honda HR-V di Indonesia:\r\n\r\nHR-V RS e:HEV (hybrid): Rp488 juta\r\nHR-V e:HEV Modulo (hybrid): Rp460,7 juta\r\nHR-V e:HEV (hybrid): Rp449 juta\r\nHR-V E+ CVT (bensin): Rp422 juta\r\nHR-V E CVT (bensin): Rp399,9 juta\r\n\r\nDari sisi tampilan, New Honda HR-V menghadirkan desain eksterior yang lebih sporty dan premium dibandingkan generasi sebelumnya. Grille depan dan bumper kini terlihat lebih tegas dengan bentuk yang lebih menonjol, serta penggunaan warna kontras yang semakin memperkuat karakter SUV ini.\r\n\r\nSektor pencahayaan juga mendapatkan peningkatan signifikan dengan hadirnya fitur Adaptive Driving Beam dan Active Cornering Light. Teknologi ini memungkinkan sistem pencahayaan menyesuaikan dengan kondisi jalan, memberikan visibilitas yang lebih baik untuk pengemudi saat berkendara di malam hari atau di area dengan pencahayaan minim. Di bagian belakang, Honda menyematkan desain lampu Full-Width Strip yang membentang selebar bodi, kini menggunakan teknologi LED yang lebih efisien dan elegan.\r\n\r\nUntuk varian HR-V e:HEV Modulo, Honda memberikan sentuhan eksterior yang lebih agresif dengan tambahan aksesori seperti Front Under Spoiler, Rear Under Spoiler, Door Visor, Side Lower Garnish, dan Exhaust Pipe Finisher. Selain itu, emblem Modulo turut disematkan sebagai tanda identitas yang membedakan varian ini dari model lainnya.', 'berita7.jpg', '2025-06-11', 'admin', 'publikasi', 0),
(15, 'Toyota Luncurkan Fortuner Diesel Hybrid 2025, Harganya Tak Murah!', 'Mengikuti perkembangan kendaraan ramah lingkungan. Toyota Kirloskar Motor (TKM) pada 2 Juni 2025 mengumumkan peluncuran Fortuner dan Legender hybrid ringan. Kendaraan kini dilengkapi dengan sistem baterai 48‑Volt. Varian anyar ini diklaim memberi efisiensi bahan bakar semakin baik, performa berkendara meningkat dan kenyamanan kian optimal. Untuk harga Fortuner Neo Drive 48V dilego INR44,72,000 (Rp850 jutaan) dan Legender Neo Drive 48V dilepas INR50,09,000 (Rp950 jutaan). \r\n\r\n“Seiring dengan pasar SUV di India yang terus tumbuh. Pelanggan mencari fitur-fitur canggih dan gaya berbeda. Baik Fortuner maupun Legender mampu memenuhi harapan ini melalui desain berani, performa bertenaga dan fitur-fitur lengkap. Ini memenuhi kebutuhan beragam pengguna. Kini, peluncuran varian Neo Drive 48V baru di kedua model menandai tonggak sejarah lain dalam perjalanan kami,” terang Varinder Wadhwa, Vice President, Sales Service Used Car Business Toyota Kirloskar Motor. \r\n\r\nJadi model pertama di segmennya, hal ini menurut Toyota India demi mengakomodasi gaya hidup pelanggan yang terus berkembang. Sekaligus memperkuat pendekatan multipath menuju netralitas karbon. Jadi, teknologi 48V baru ditujukan untuk menawarkan penghematan bahan bakar optimal, meski tak disebut berapa besarannya.', 'Toyota-New-Fortuner-Hybrid-2.avif', '2025-06-11', 'admin', 'draft', 0),
(16, 'Geely Indonesia Gandeng Voltron Sediakan Jaringan Charging Station', 'Untuk mendukung ekosistem kendaraan niremisi di sini. Geely Auto Indonesia secara resmi mengumumkan kolaborasi strategis dengan Voltron. Mereka bakal menyediakan fasilitas pengisian daya di seluruh jaringan diler resmi Geely. Kerja sama ini merupakan langkah kedua perusahaan dalam mendukung program percepatan penggunaan kendaraan listrik nasional. Serta transisi menuju lingkungan yang lebih bersih dan berkelanjutan. \r\npusat layanan purnajual\r\n“Kerja sama dengan Voltron ini merupakan bukti nyata komitmen Geely dalam mempercepat transisi kendaraan listrik di Indonesia. Dengan ketersediaan fasilitas charging station Voltron di jaringan diler resmi kami. Pelanggan kini dapat menikmati pengisian daya lebih praktis dan nyaman. Serta meningkatkan pengalaman kepemilikan kendaraan listrik secara menyeluruh,” ujar Yusuf Anshori, Brand Director Geely Auto Indonesia, dalam keterangan tertulis. \r\n\r\nJalinan strategis Geely Auto Indonesia dan Voltron menjadi bagian penting dari upaya bersama sektor swasta dan pemerintah. Khususnya dalam menciptakan ekosistem kendaraan listrik yang terintegrasi, mudah diakses dan ramah lingkungan.\r\n\r\nMelalui kemitraan mereka berjanji mau memperluas jaringan charging station di seluruh diler resmi di berbagai wilayah penjuru nusantara. Langkah ini tidak hanya memudahkan akses pengisian daya bagi pelanggan. Tetapi juga mendukung percepatan pengembangan ekosistem kendaraan listrik nasional. Sejalan dengan target Net Zero Emission Indonesia 2060.', 'Geely-dan-Voltron-2-500x333.avif', '2025-06-11', 'admin', 'draft', 0),
(18, 'Road Test Haval Jolion Ultra HEV: Enak Buat ke Luar Kota', 'Haval Jolion Ultra HEV hadir sebagai pesaing menarik di segmen SUV kompak dengan desain modern yang berkarakter. Tampilan eksteriornya mengusung gril besar berwarna hitam, roof rail yang mempertegas nuansa tangguh, serta garis desain agresif khas SUV masa kini. Tak hanya soal tampilan, performanya pun mengesankan berkat mesin 4-silinder 1,5 liter hybrid yang dirancang untuk efisiensi bahan bakar maksimal.\r\n\r\nKEY TAKEAWAYS\r\n\r\nPerforma dan Pengalaman Berkendara\r\nDalam perjalanan dari Jakarta ke Brebes via Tol Cipali yang lengang, Haval Jolion Ultra HEV menunjukkan karakter berkendara yang halus di putaran mesin rendah, namun tetap agresif saat berakselerasi. Mesin hybrid ini menghasilkan tenaga 187 HP dan torsi puncak 378 Nm yang dialirkan ke roda depan secara linear.\r\n\r\n', 'Test-drive-Haval-Jolion-Ultra-HEV-1.avif', '2025-06-11', 'Aqmal', 'draft', 0),
(25, 'Daihatsu Sempurnakan Gran Max 2025 dan Dilengkapi Fitur ADAS Sederhana', 'Baru saja Daihatsu Motor Co., Ltd. meluncurkan model penyegaran Gran Max Cargo 2025. Terdapat beberapa perubahan spesifikasi, termasuk perangkat keamanan. Pada saat yang sama, harga eceran yang disarankan pabrikan direvisi. Karena melonjaknya harga bahan baku dan faktor lain. Di Jepang unit dilego mulai 2.068.000 yen hingga 2.442.000 yen, atau Rp2349 juta sampai Rp274,54 juta. Mereka sangat peduli dengan keselamatan berkendara. Maka fitur canggih–bagian kecil dari ADAS–pun diterapkan.\r\n\r\nKhusus pasar Jepang, Daihatsu Gran Max Cargo diberikan preventive safety function bernama Smaashi, dengan isi fitur agak mirip dengan ADAS namun versi lebih simpel. Misalnya saja seperti Collision Warning Function & Collision Avoidance Assist Braking. Memberi peringatan dan melakukan bantuan pengereman bila ada pejalan kaki atau kendaraan di depan. \r\n\r\nLalu False Start Prevention with brake control. Bila Anda salah pijak pedal dalam kondisi tertentu, akselerasi dibatalkan. Lake Departure Warning juga diberikan, agar tetap berada di lajur sesuai garis marka. Tak ketinggalan, Auto High Beam juga terpasang supaya pencahayaan maksimal, tak menyilaukan pengendara lain. Kelengkapan fitur keselamatan lain sudah lumayan.', 'Daihatsu-Gran-Max-Jepang.avif', '2025-06-17', 'Admin', 'publikasi', 0),
(29, 'Harga Baru Jetour Dashing dan X70 Plus 2025 Semakin Terjangkau ', '“Jetour berkomitmen untuk terus menyempurnakan setiap aspek produk agar semakin bernilai dan dekat dengan kebutuhan masyarakat di sini. Salah satunya melalui optimalisasi proses rantai pasok. Kami ingin masyarakat Indonesia lebih mudah untuk memiliki Jetour dan menikmati pengalaman berkendara Travel+ yang akan mendukung aktivitas perjalanan. Serta gaya hidup pribadi dan keluarga,” terang Moch Ranggy Radiansyah, Marketing Director PT Jetour Motor Indonesia, dalam keterangan tertulis (16/6/2025). ', 'Jetour-Dashing-4.avif', '2025-06-17', 'Admin', 'publikasi', 0),
(30, 'Road Test Haval Jolion Ultra HEV: Enak Buat ke Luar Kota', 'Haval Jolion Ultra HEV hadir sebagai pesaing menarik di segmen SUV kompak dengan desain modern yang berkarakter. Tampilan eksteriornya mengusung gril besar berwarna hitam, roof rail yang mempertegas nuansa tangguh, serta garis desain agresif khas SUV masa kini. Tak hanya soal tampilan, performanya pun mengesankan berkat mesin 4-silinder 1,5 liter hybrid yang dirancang untuk efisiensi bahan bakar maksimal. KEY TAKEAWAYS Performa dan Pengalaman Berkendara Dalam perjalanan dari Jakarta ke Brebes via Tol Cipali yang lengang, Haval Jolion Ultra HEV menunjukkan karakter berkendara yang halus di putaran mesin rendah, namun tetap agresif saat berakselerasi. Mesin hybrid ini menghasilkan tenaga 187 HP dan torsi puncak 378 Nm yang dialirkan ke roda depan secara linear.', 'berita5.jpg', '2025-06-17', 'Admin', 'publikasi', 0);

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
  `waktu_testdrive` datetime NOT NULL,
  `pertanyaan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Disetujui','Ditolak') DEFAULT 'Pending',
  `dibaca_user` tinyint(1) DEFAULT 0,
  `id_mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking_test_drive`
--

INSERT INTO `booking_test_drive` (`id_booking`, `nama_lengkap`, `email`, `no_hp`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `waktu_testdrive`, `pertanyaan`, `created_at`, `status`, `dibaca_user`, `id_mobil`) VALUES
(17, 'pengguna1', 'pengguna1@gmail.com', '62626426526', '2025-06-18', 'Laki-laki', 'Pare Pare', 'Pare Pare', '2025-06-18 01:13:00', 'tes', '2025-06-17 17:16:07', 'Disetujui', 1, 54),
(18, 'pengguna1', 'pengguna1@gmail.com', '62626426526', '2025-06-11', 'Laki-laki', 'Pare pare', 'Pare Pare', '2025-06-18 01:17:00', 'tes', '2025-06-17 17:17:17', 'Ditolak', 1, 55),
(19, 'pengguna1', 'pengguna1@gmail.com', '62626426526', '2025-07-03', 'Laki-laki', 'tes', 'Pare Pare', '2025-06-18 01:18:00', 'tes', '2025-06-17 17:18:40', 'Disetujui', 1, 55),
(20, 'pengguna1', 'pengguna1@gmail.com', '4123646134', '2025-06-18', 'Perempuan', 'Pare Pare', 'Pare Pare', '2025-06-18 12:34:00', 'tes', '2025-06-18 04:34:29', 'Disetujui', 1, 54),
(21, 'rifki1', 'muhammadrifkimms@gmail.com', '0998290372', '2025-06-18', 'Laki-laki', 'Pare Pare', 'Pare Pare', '2025-06-18 13:02:00', 'tes', '2025-06-18 05:02:17', 'Disetujui', 1, 55),
(22, 'rifki1', 'muhammadrifkimms@gmail.com', '0998290372', '2025-06-18', 'Laki-laki', 'Pare Pare', 'Pare Pare', '2025-06-18 13:16:00', 'tes', '2025-06-18 05:16:54', 'Disetujui', 1, 50),
(23, 'Muhammad rifki', 'muhammadrifkimms@gmail.com', 'hafhgaf', '2025-06-18', 'Laki-laki', 'tes', 'pare pare', '2025-06-18 18:08:00', 'tes', '2025-06-18 10:08:39', 'Pending', 0, 55),
(24, 'Muhammad rifki', 'muhammadrifkimms@gmail.com', '622342342352', '2025-06-18', 'Laki-laki', 'tes', 'pare pare', '2025-06-18 18:32:00', 'resra', '2025-06-18 10:32:12', 'Ditolak', 1, 54),
(25, 'Muhammad rifki', 'muhammadrifkimms@gmail.com', '622342342352', '2025-06-18', 'Laki-laki', 'Pare Pare', 'pare pare', '2025-06-18 20:05:00', 'res', '2025-06-18 12:05:15', 'Pending', 0, 55),
(26, 'tes user', 'tesuser@gmail.com', '62626426526', '2025-06-19', 'Laki-laki', 'teses', 'Pare Pare', '2025-06-19 19:17:00', 'tes', '2025-06-19 11:17:41', 'Disetujui', 1, 50);

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
-- Struktur dari tabel `diskusi`
--

CREATE TABLE `diskusi` (
  `id` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `diskusi`
--

INSERT INTO `diskusi` (`id`, `id_mobil`, `nama`, `komentar`, `tanggal`, `parent_id`) VALUES
(1, 50, 'Muhamad Taufiq Hidayat', 'tes', '2025-06-04 13:48:19', NULL),
(2, 1, 'Rfiki', 'Bagusan mana fortuner apa fortunir?', '2025-06-04 14:11:35', NULL),
(3, 49, 'Rfiki', 'tes', '2025-06-04 14:20:44', NULL),
(4, 1, 'tes', 'es', '2025-06-04 14:40:56', 0),
(5, 49, 'tes', 'tes', '2025-06-04 14:41:21', 3),
(6, 49, 'aksa', 'aksa ji aksa makan kanji', '2025-06-04 14:42:14', 3),
(7, 49, 'Rifki1', 'tes', '2025-06-04 15:08:06', 0),
(8, 1, 'Rifki1', 'qilruwhfuihfa qjfhqgffa fiuaghfugafa', '2025-06-10 18:29:54', NULL),
(9, 1, 'Rifki1', 'qilruwhfuihfa qjfhqgffa fiuaghfugafa', '2025-06-10 18:30:01', NULL),
(10, 51, 'Rifki1', 'iuwfagfga gifiagfga fgahgfha fhgiu', '2025-06-10 18:31:24', NULL),
(11, 54, 'MUHAMMAD RIFKI RUSLI', 'Mobil ini worth to buy ga?\r\n', '2025-06-11 12:05:41', 0),
(12, 54, 'MUHAMMAD RIFKI RUSLI', 'Mobil ini worth to buy ga?\r\n', '2025-06-11 12:06:01', 0),
(13, 52, 'Aizen', 'tes', '2025-06-11 13:43:36', 0),
(14, 54, 'tes', 'tes', '2025-06-11 13:44:04', 0),
(15, 54, 'MUHAMMAD RIFKI RUSLI', 'tes', '2025-06-11 13:50:52', NULL),
(16, 54, 'yaudah si', 'tes', '2025-06-11 13:51:31', NULL),
(17, 54, 'Muhammad Rifki Rusli', 'tes', '2025-06-11 13:51:43', 16),
(18, 54, 'Rifki1', 'tes', '2025-06-11 13:57:29', NULL),
(19, 54, 'Rifki1', 'tes', '2025-06-11 13:57:37', 18),
(20, 54, 'mutiara', 'tes juga', '2025-06-11 14:01:24', 18),
(21, 54, 'aksa', 'hai mutiara', '2025-06-11 14:02:36', 18),
(22, 55, 'Rifki1', 'f;oiqhfasfd', '2025-06-12 01:59:02', NULL),
(23, 55, 'kjbfadlhsa', 'faskdnfabsdknfa', '2025-06-12 01:59:29', 22),
(24, 48, 'Rifki1', 'tres', '2025-06-19 06:54:02', NULL),
(25, 10, 'Rifki1', 'tes', '2025-06-19 11:14:05', NULL),
(26, 10, 'Rifki1', 'tes', '2025-06-19 11:14:12', 25),
(27, 10, 'Rifki Palsu', 'tes', '2025-06-19 11:14:45', 25),
(28, 2, 'pengguna1', 'tets', '2025-06-19 11:21:26', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_mobil`
--

CREATE TABLE `gambar_mobil` (
  `id` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gambar_mobil`
--

INSERT INTO `gambar_mobil` (`id`, `id_mobil`, `gambar`) VALUES
(60, 48, '1748999088_1748928163_nissan 1.jpg'),
(61, 48, '1748999088_1748928163_nissan 2.jpg'),
(62, 48, '1748999088_1748928163_nissan 3.jpg'),
(63, 48, '1748999088_1748928163_nissan 4.jpg'),
(64, 48, '1748999088_1748928163_nissan.jpg'),
(65, 1, 'fortuner1.jpg'),
(66, 1, 'fortuner2.jpg'),
(67, 1, 'fortuner3.jpg'),
(68, 1, 'fortuner4.jpg'),
(69, 1, 'fortuner5.jpg'),
(70, 1, 'fortuner1.jpg'),
(71, 1, 'fortuner2.jpg'),
(72, 1, 'fortuner3.jpg'),
(73, 1, 'fortuner4.jpg'),
(74, 1, 'fortuner5.jpg'),
(75, 2, 'civic1.jpg'),
(76, 2, 'civic2.jpg'),
(77, 2, 'civic3.jpg'),
(78, 2, 'civic4.jpg'),
(79, 2, 'civic5.jpg'),
(80, 10, 'rush1.jpg'),
(81, 10, 'rush2.jpg'),
(82, 10, 'rush3.jpg'),
(83, 10, 'rush4.jpg'),
(84, 10, 'rush5.jpg'),
(85, 49, '1749002640_pajero1.jpg'),
(86, 49, '1749002640_pajero2.jpg'),
(87, 49, '1749002640_pajero3.jpg'),
(88, 49, '1749002640_pajero4.jpg'),
(89, 49, '1749002640_pajero5.jpg'),
(90, 50, '1749003337_corvette1.jpg'),
(91, 50, '1749003337_corvette2.jpg'),
(92, 50, '1749003337_corvette3.jpg'),
(93, 50, '1749003337_corvette4.jpg'),
(94, 50, '1749003337_corvette5.jpg'),
(95, 51, '1749003852_BMWM4-1.jpg'),
(96, 51, '1749003852_BMWM4-2.jpg'),
(97, 51, '1749003852_BMWM4-3.jpg'),
(98, 51, '1749003852_BMWM4-4.jpg'),
(99, 51, '1749003852_BMWM4-5.jpg'),
(100, 52, '1749622352_rolls-royce-spectre-front-angle-low-view-917702.avif'),
(101, 52, '1749622352_rolls-royce-spectre-full-front-view-894527.avif'),
(102, 52, '1749622352_rolls-royce-spectre-full-rear-view-266553.avif'),
(103, 52, '1749622352_rolls-royce-spectre-rear-cross-side-view-978065.avif'),
(104, 52, '1749622352_rolls-royce-spectre-top-view-261661.avif'),
(105, 53, '1749622614_th (1).jpeg'),
(106, 53, '1749622614_th (2).jpeg'),
(107, 53, '1749622614_th (3).jpeg'),
(108, 53, '1749622614_th.jpeg'),
(109, 53, '1749622614_toyota-avanza-avif.avif'),
(110, 54, '1749622841_th (4).jpeg'),
(111, 54, '1749622841_th (5).jpeg'),
(112, 54, '1749622841_th (6).jpeg'),
(113, 54, '1749622841_th (7).jpeg'),
(114, 54, '1749622841_th (8).jpeg'),
(115, 55, '1749686749_mitsubishi-xpander-hybrid-door-handle-461137.avif'),
(116, 55, '1749686749_mitsubishi-xpander-hybrid-front-angle-low-view-909472.avif'),
(117, 55, '1749686749_mitsubishi-xpander-hybrid-front-medium-view-864899.avif'),
(118, 55, '1749686749_mitsubishi-xpander-hybrid-full-front-view-159021.avif'),
(119, 55, '1749686749_mitsubishi-xpander-hybrid-grille-view-756692.avif');

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
(5, 'tamu1', 'tamu1@gmail.com', 'fahfafa', '2025-05-30 23:30:15'),
(6, 'first user', 'firstuser@gmail.com', 'first', '2025-06-01 09:30:07');

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
(3, 'Mitsubishi'),
(4, 'Chevrolet'),
(5, 'Jeep'),
(6, 'Nissan'),
(7, 'Tesla'),
(8, 'Mercedes Benz'),
(9, 'Rolls Royce'),
(10, 'Hummer'),
(11, 'BMW'),
(12, 'Supra'),
(13, 'Porsche');

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
  `spesifikasi` text DEFAULT NULL,
  `video_url` text DEFAULT NULL,
  `bahan_bakar` varchar(50) DEFAULT NULL,
  `transmisi` varchar(50) DEFAULT NULL,
  `kapasitas_mesin` varchar(50) DEFAULT NULL,
  `tenaga` varchar(50) DEFAULT NULL,
  `kapasitas_tempat_duduk` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `nama_mobil`, `id_merek`, `id_kategori`, `harga`, `spesifikasi`, `video_url`, `bahan_bakar`, `transmisi`, `kapasitas_mesin`, `tenaga`, `kapasitas_tempat_duduk`, `deskripsi`, `video`) VALUES
(1, 'Toyota Fortuner', 6, 1, 500000011, NULL, 'https://www.youtube.com/watch?v=fwPlIYflSUw', 'Bensin', 'Manual, CVT', '1497 - 1498 cc', '119', '5', NULL, NULL),
(2, 'Honda Civic', 2, 2, 980000000, NULL, 'https://youtu.be/ZlBgkK0buPU?si=u6282fJr0ClGQWMM', 'Bensin', 'Manual, CVT', '1497 - 1498 cc', '119', '6', NULL, NULL),
(10, 'Toyota Rush', 1, 1, 750000000, NULL, 'https://www.youtube.com/embed/2VbzjWgk4Rw', 'Bensin', 'Manual, CVT', '1497 - 1498 cc', '119', '3', NULL, NULL),
(48, 'Nissan Gtr 20', 6, 1, 790000000, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Manual\",\"kapasitas_mesin\":\"1500 hp\",\"tenaga\":\"20000 hp\",\"kapasitas_tempat_duduk\":\"5\"}', 'https://www.youtube.com/embed/fwPlIYflSUw', 'Bensin', 'Manual', '1500 hp', '20000', '5', NULL, NULL),
(49, 'Mitsubishi Pajero Sport', 3, 1, 700500080, '{\"bahan_bakar\":\"Diesel\",\"transmisi\":\"Manual, Otomatis\",\"kapasitas_mesin\":\"2442 - 2477 cc\",\"tenaga\":\"134 - 179 hp\",\"kapasitas_tempat_duduk\":\"7 Kursi\"}', 'https://youtube.com/embed/QNt-a9ze_VM', 'Diesel', 'Manual, Otomatis', '2442 - 2477 cc', '134 - 179 hp', '7', NULL, NULL),
(50, 'Corvette ZR1', 4, 1, 299999999, '{\"bahan_bakar\":\"Diesel\",\"transmisi\":\"LT7 5.5L DOHC V8 engine\",\"kapasitas_mesin\":\"233 MPH\",\"tenaga\":\"1,064 HP\",\"kapasitas_tempat_duduk\":\"2\"}', 'https://youtube.com/embed/LGJbxUVYpBk', 'Diesel', 'LT7 5.5L DOHC V8 engine', '233 MPH', '1,064 HP', '2', NULL, NULL),
(51, 'BMW M4', 11, 1, 299999999, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"2993 cc\",\"tenaga\":\"523 - 543 hp\",\"kapasitas_tempat_duduk\":\"4\"}', 'https://youtube.com/embed/O_-CMb52WMQ', 'Bensin', 'Otomatis', '2993 cc', '523 - 543 hp', '4', NULL, NULL),
(52, 'Rolls Royce Spectre', 9, 3, 80000000, '{\"bahan_bakar\":\"Electric\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"102 kWh\",\"tenaga\":\"577 hp\",\"kapasitas_tempat_duduk\":\"4 kursi\"}', 'https://www.youtube.com/watch?v=jum8PGur1PU&pp=0gcJCbAJAYcqIYzv', 'Electric', 'Otomatis', '102 kWh', '577 hp', '4', NULL, NULL),
(53, 'Supra Mk4', 12, 1, 1444444444, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"102 kWh\",\"tenaga\":\"577 hp\",\"kapasitas_tempat_duduk\":\"4 kursi\"}', 'https://www.youtube.com/embed/xhZvehnxLLM', 'Bensin', 'Otomatis', '102 kWh', '577 hp', '4', NULL, NULL),
(54, 'Hummer EV SUV', 10, 1, 1555544433, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"102 kWh\",\"tenaga\":\"577 hp\",\"kapasitas_tempat_duduk\":\"4 kursi\"}', 'https://www.youtube.com/embed/2VbzjWgk4Rw', 'Bensin', 'Otomatis', '102 kWh', '577 hp', '4', NULL, NULL),
(55, 'Mitsubishi Xpander Hybrid', 3, 1, 999000000, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"CVT\",\"kapasitas_mesin\":\"1598 cc\",\"tenaga\":\"114 hp\",\"kapasitas_tempat_duduk\":\"7 Kursi\"}', 'https://www.youtube.com/embed/fwPlIYflSUw', 'Bensin', 'CVT', '1598 cc', '114', '7', NULL, NULL);

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
-- Struktur dari tabel `pengelolaberita`
--

CREATE TABLE `pengelolaberita` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `mobil_id` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id`, `nama`, `judul`, `mobil_id`, `komentar`, `rating`, `created_at`) VALUES
(3, 'woila', NULL, 2, 'tes', 3.0, '2025-05-30 10:26:33'),
(4, 'muhammad rifki', NULL, 10, 'woi penipu balikin duit gw jir', 1.0, '2025-05-30 22:43:15'),
(6, 'Muhammad Rifki', NULL, 1, 'tes', 1.0, '2025-06-03 23:32:12'),
(7, 'Muhamad Taufiq Hidayat', NULL, 51, 'BMW dengan series SUV yg paling saya suka , enak ,performa joss,nyaman buat jalan sendiri Dan keluarga . Terenak pokoke... 👍🏻👍🏻👍🏻😁', 5.0, '2025-06-04 10:34:51'),
(8, 'Muhamad Taufiq Hidayat', NULL, 51, 'tes', 2.0, '2025-06-04 10:40:32'),
(9, 'istimewa', NULL, 50, 'nyaman dan dan modern stylish dengan fitur 15 ADAS. dan NCAP bintang 5. so far pakai mobil ini oke banget', 5.0, '2025-06-04 11:48:38'),
(10, 'Rahasia', NULL, 1, 'Calya ini kendala yang paling menyebalkan dan membahayakan adalah saat tanjakan dijalan y buruk dan licin. Jika mesin mati sangat sulit mendapat traksi. Bisa mundur dan membahayakan pengendara di belakang. Sebaiknya roda penggerak dikembalikan ke penggerak roda belakang saja.', 4.0, '2025-06-04 11:49:24'),
(11, 'Mas Anis', NULL, 10, 'Harga tidak mahal, fasilitas lumayan, daya muat lumayan luas, irit bahan bakar kenyamanan berkendaraan mengasyikkan. Suspensi agak keras tapi masih oke sudah dilengkapi airbag', 3.0, '2025-06-04 11:49:56'),
(12, 'Rfiki', NULL, 50, 'tess', 4.0, '2025-06-11 08:02:37'),
(13, 'Rifki1', NULL, 1, 'uuwfhajfha ighafjaghfh agfajhbfa faadsf', 5.0, '2025-06-11 02:36:11'),
(14, 'Rifki1', NULL, 1, 'uuwfhajfha ighafjaghfh agfajhbfa faadsf', 5.0, '2025-06-11 02:36:27'),
(15, 'Rifki1', NULL, 51, 'menurut saya mobil ini memang worth to buy sih apalagi buat anda yang ingin tampil lebih keren', 5.0, '2025-06-11 02:37:43'),
(16, 'Rifki1', NULL, 49, 'tesliyefuqyer yruiq yryquwyriqw rqiygriuqg yerqorqog ryqgrugqwe', 3.0, '2025-06-12 05:38:12'),
(17, 'Rifki1', NULL, 55, 'nice uahgfagdf gafga fga aiuhfiu ahfgafasdf', 4.0, '2025-06-17 13:51:32'),
(18, 'Rifki1', NULL, 55, 'waw mobil ini sangat bagus saya berenca untuk membelikan anak saya mobil Xpander ini , selain desainnya bagus saya pikir mobil ini juga worth it untuk di pakai jalan jalan.', 3.0, '2025-06-17 14:01:59'),
(19, 'Rifki1', NULL, 55, 'fahfalhdfa haf iagfgaf afiugah figaif afgafgafhajfhfu', 1.0, '2025-06-17 14:13:08'),
(20, 'Rifki1', NULL, 55, 'te hafhafhakjf abfabfkja bfahbfaj gf fjalfhahf afhau fagfa', 2.5, '2025-06-17 20:42:01'),
(21, 'Rifki1', NULL, 55, 'sdufhhfa ahfa fajfkabkjdfhakj fajgfjag fadsf', 4.5, '2025-06-17 20:44:04'),
(22, 'Rifki1', NULL, 55, 'fadsadfa fa faf a sdfafafasdfads fasf ads fadf asdfa sfa fdasdfafafad', 3.0, '2025-06-17 20:44:28'),
(23, 'Rifki1', NULL, 55, 'ysudah hdsfh93582875b %$#@%#$%#@%@45', 3.5, '2025-06-17 20:45:50'),
(24, 'Rifki1', NULL, 55, 'affjhqfh fuhh  rea ffqf fefaffa vsdsdv', 0.5, '2025-06-17 20:47:24'),
(25, 'Rifki1', NULL, 10, 'Setelah pertimbangan dan banding membandingkan dengn merek lain akhirnya pilihan saya jatuh kepada mobil ini. Sejauh ini puas mengendarai Rush S GR Sport 2024.', 4.5, '2025-06-17 21:06:29'),
(26, 'Rifki1', NULL, 10, 'Setelah lelah mengurus mobil yang langka dan kurang mampu digunakan di segala medan, apalagi terkait perbaikan dan sparepart yang sulit didapat, saya dan istri memutuskan meminang New Rush, mobil sejuta umat, apalagi posisi kami di salah satu kota di Kalimantan. Praktis karena mudah digunakan oleh pria dan wanita, cuman pesan istri harus polos aja agar jangan terlalu gagah mobilnya tidak usah pake tanduk2an, aksesoris untuk mempercantik saja yang boleh..hehe. Fungsional karena dapat digunakan di segala medan, baik perkotaan dan jalan lintas provinsi-kabupaten. Nilai guna tinggi, jika dijual lagi, harga tidak jatuh, mesin terkenal bandel, sparepart melimpah dari berbagai tingkatan kualitas, aksesoris aftermarker banyak di pasaran.', 5.0, '2025-06-17 21:07:35'),
(27, 'Rifki1', 'Si jantan macho lelaki', 10, 'Stelah ganti mobil ini dari mpv fwd ke suv rwd, saya jadi PD, bandel elegan, walo agak boros dari fwd, tapi jalan kebun rusak, terasa mantap. Istri suka kuda jantan sperti aku dan rush.', 1.5, '2025-06-17 21:15:47'),
(28, 'Rifki1', 'Tidak kehujanan saat hujan diperjalan', 10, 'Walau harganya dibawah roda 2 tetap mendingan roda 4, jika hujan diperjalanan tidak kehujanan. Review atas kendaraan toyota Rush tahun 2018 yang saya kendarai adalah Desain bagus, nyanan, performa menarik.alat keselamatan ada air bag,dealer mudah ditemui dan ramah, service center mudah didapat, profesional, ramah, rapi, mobil bersih setelah service karena di cuci bersih, salam.', 4.5, '2025-06-17 21:19:23'),
(29, 'pengguna1', 'KELEBIHAN DAN KEKURANGAN PP KERJA NAIK ADV 150', 2, 'Setelah 3 hari nyoba Adv 150 untuk pulang pergi kerja, maka saya tulis review nya naik adv, jalanan dari kampung saya ke kota bisa dibilang banyak medan, mulai dari menanjak, jalanan berbatu, jalanan berlubang, sampe hiruk pikuk macet pada jam kerja, awalnya di jalanan kampung dg jalan berbatu dan naik turun, suspensi adv ini empuk kali, tidak kerasa kalau lagi dijalan batuan, rodanya gede jadi PD libas jalanan batuan gini, walaupun agak,ngeri kepleset pasir, tp motor ini enak di kendarai. Untuk saya yg tingginya 165, motor ini masih sangat tinggi sampai jinjit jika berhenti di lampu merah, Pd sih naik matic gede kya adv ini, jinjit dikit juga ngga papa ?. Untuk jalanan kota nih yg kalo jam berangkat sama pulang kerja pasti ada aja macetnya, untuk salip kiri kanan antara mobil saat macet, saya kurang berani karena saya ngerasa ini motor lebar banget, takut nyenggol spion mobil,apalagi kaki susah bngt napak ke jalan, jadi untuk liuk-liuk di kemacetan pake adv saya ngga bisa PD kaya libas jalan berbatu. Lampu led di adv ini menurut saya kya lampu mobil kali ya, terangnya minta ampun, lampu jauhnya juga luar biasa, nge dim motor didepan kita juga langsung minggir ?, seru sih naik adv malem2, sendirian pun rasanya ngga bakal takut karena lampunya terang banget. Saatnya ulas kekurangan di motor ini menurut saya lho ya, pertama, motor ini tinggi banget, kedua jok motor ini lebar kaya jidat, boncengin cewek kecil bakal krasa jongkok kali tu cewe ???. Ketiga, motor ini dipake salip2 di kemacetan kurang greget, karena bodynya yg gede di tambah stang yg lebar mau nyempil di antara mobil juga mikir2. Kelebihannya ini motor ya nambah kegantengan, kliatan gagah, nambah pd karena lebih tinggi dr pd motor lain, suspensinya lembut banget, ban lebar mau belok kaya valentino rossi juga masih aman ?, body futuristik, daaaan lampunya itu terang kaya lampu mobil ?. Kalo harga ya 11 12 sama pcx. Kalo suka gaya adventure ya pake ini adv, kalo suka santai, pilih pcx.. wassalamualaikum.', 1.5, '2025-06-18 00:30:04'),
(30, 'Rifki1', 'Fortuner is the best', 1, 'Selama pakai mobil ini ga ada ga enaknya, enak terus. Saya rekomendasi kan rekan2 pakai mobil ini. Apalagi buat berpetualang top deh...', 3.5, '2025-06-18 20:11:15'),
(31, 'Rifki1', 'Mantap lah pokoknya', 1, 'Toyota Fortuner mobil yang saya impikan selama ini, mudah mudahan bisa mengganti mobil saya sekarang dengan mobil Toyota Fortuner yang model sekarang, terima kasih', 2.5, '2025-06-18 20:35:08'),
(32, 'Rifki1', 'FORTUNER TRD LUXURY 2020', 1, 'Exterior tampilan Toyota Fortuner terlihat sangat gagah dengan desain baru yang terlihat pada bagian grille, bumper dan lampu utama depan, yang Terutama pada tTRD terlihat semakin keren menurut saya. Lampu utama mobil telah menggunakan lampu LED Bi-Beam. Kenyamanan dan keamanan sangat baik karena bentuknya yang besar.\r\n\r\nDesain\r\nDesain Lampu Depan Fortuner Facelift. Selain menggunakan tombol, Power Back Door juga dapat aktif menggunakan kaki, apabila kunci berada dekat dengan pintu bagasi. Fitur kick sensor akan sangat berguna, apabila kedua tangan anda membawa barang, dan ingin membuka pintu bagasi.\r\n\r\nKenyamanan\r\nDari sisi kenyamanan, kursi pengemudi Toyota Fortuner mengikuti bentuk dan lekukan kaki pengemudi. Pada plafon kabin kursi baris kedua terdapat cekungan agar menambah ruang untuk kepala. Saat dipakai dijalan yang rusak tidak terasa bergoyang.\r\n\r\nPerforma\r\nToyota Fortuner terbaru mendapatkan 3 pilihan tipe mengemudi,yang sangat bermanfaat sekali. ECO Mode, pilihan mengemudi hemat bahan bakar serta akselerasi yang halus. Normal mode. Power Mode, mode ini dapat aktif jika pengemudi memerlukan akselerasi cepat serta memaksimalkan response mesin.\r\n\r\nKeselamatan\r\nTidak diragukan lagi dari segi keamanan . Control stabilitas mobil / Vehicle stability control (VSC). Fitur keamanan ini akan membantu pengemudi dalam menjaga kestabilan mobil saat bermanuver, terutama saat menikung pada kecepatan tinggi. Fitur VSC tersedia pada semua Toyota Fortuner facelift. Hill assist control (HAC). Fitur ini berfungsi untuk menahan laju mundur mobil saat perpindahan kaki dari pedal rem ke pedal gas pada posisi jalan tanjakan. Fitur HAC sekarang sudah terdapat pada semua tipe Fortuner facelift. Peringatan lampu hazzard yang otomatis akan menyala, baik lampu depan dan lampu belakang jika pengemudi melakukan pengereman secara mendadak. Tujuannya untuk memberitahu pengguna jalan lain untuk waspada. Fitur peringatan lampu hazzard sekarang terdapat pada semua Toyota Fortuner facelift. A-TRC (active traction control). Fitur ini akan menyeimbangkan traksi ban mobil, jika ada salah satu dari ban mobil Toyota Fortuner yang mengalami spin. Fitur A-TRC sekarang terdapat pada semua All New Fortuner facelift. Kursi Isofix untuk tempat baby chair. SRS air bag terdapat pada semua varian hanya saja pada varian 4×2 hanya terdapat 3 posisi air bag. Yaitu dua pada bagian depan dan 1 pada bagian lutut pengemudi. Berbeda dengan varian 4×4, terdapat 7 posisi air bag. Fitur rem ABS (Anti-lock Braking System) dan fitur EBD (Electronic brakeforce distribution) ada pada semua tipe. Untuk mengetahui cara kerja rem ABS pada mobil, mohon untuk mengklik link! Brake assist juga ada pada semua varian. Untuk sensor parkir pada bagian belakang bamper terdapat 4 sensor, sedangkan pada bamper depan terdapat 2 sensor. Untuk tipe TRD sudah menggunakan New Surround Monitor, dengan kamera belakang, kamera pada spion dan kamera pada bamper depan.\r\n\r\nPengalaman Road Trip\r\nSangat menyenangkan, walaupun jalan rusak sangat nyaman dan tidak terasa. Tanjakan yang tinggi dan terjal pun goyangnya tidak berasa. Tiada duanya.', 1.5, '2025-06-18 20:44:01'),
(33, 'Rifki1', 'Mobil ini bagus', 55, 'mobil ini nyaman di pakai dan worth it untuk harganya akjfkljafh ahfajbfaj gfaf ahdiua faufkgasdhfd yqdfuhausdfha giqafhadgsf  ifqhefdgf agljhgqeghf uyweyrgw t', 4.0, '2025-06-19 08:56:03'),
(34, 'Rifki1', 'Harga Baru Jetour Dashing dan X70 Plus 2025 Semakin Terjangkau', 10, 'tgwfgsdgsagsgsgqt qfafafdasf afafasdfa dfasf asdfadsfasfa sfasfafasfggh dfgmghmgmg mgtthmgmf ijhfajhd afgaj fajfg agfaf augfahgf jagfjg afgahfg ajagf fasjkdhafh agfa fgafa fagfah faf afafa', 2.5, '2025-06-19 19:13:48');

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
(1, 'rifki', 'muhammadrifkimms@gmail.com', 'Avnza', 'yaudah si', '2025-05-30 10:47:31'),
(2, 'Muhammad Rifki Rusli', 'muhammadrifkimms@gmail.com', 'avanza', 'tes', '2025-06-01 16:52:58'),
(3, 'aksa', 'muhammadrifkimms@gmail.com', 'tes', 'yes', '2025-06-01 18:04:27'),
(4, 'Muhammad Rifki Rusli', 'muhammadrifkimms@gmail.com', 'tes', 'tes', '2025-06-01 18:35:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) DEFAULT '-',
  `join_date` date DEFAULT curdate(),
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `contact`, `join_date`, `password`, `created_at`) VALUES
(1, 'Rifki1', 'muhammadrifkimms@gmail.com', '-', '2025-05-31', '$2y$10$rYPCgiidSuc2QTKReuE6w.4a7zxvzy8ria0Rubo0HqaLaB5Lz0E1q', '2025-05-29 11:45:59'),
(2, 'Rifki1', 'rifki@gmail.com', '-', '2025-05-31', '$2y$10$JP5i5pOrbSJTGlg8/t/XDuHGs3FNeMPV8psTQgmjHtnvUXVXqNNm6', '2025-05-29 13:58:14'),
(4, 'tes', 'yaudahsi@gmail.com', '-', '2025-05-31', '$2y$10$1fwXIc6mkqfkPgPeAA/0vedKhVHpU43CDx5t7fyghkquNz6o3/xDq', '2025-05-31 01:55:31'),
(8, 'Rifki1', 'rkysecret@gmail.com', '-', '2025-05-31', '$2y$10$CRXLx8jGcrxsMrrpQ2SQ6On27y8/LPDD3cuRLmceMMXy/eNFO5N8u', '2025-05-31 01:59:41'),
(9, 'firstuser', 'firstuser@gmail.com', '-', '2025-06-01', '$2y$10$KDtdp7T96Y5IjKUz6iYLCO1KlVfAH1EZ3eOzWWtIwXRwo8RHTW.GG', '2025-06-01 10:03:08'),
(10, 'aksa', 'aksa@gmail.com', '-', '2025-06-01', '$2y$10$hcLdzk5KIpVPIhyMukG.5uBd0ZfaUrdu/lwNAdNLAhr4wBVdSK5Pu', '2025-06-01 10:03:54'),
(11, 'seconduser', 'seconduser@gmail.com', '-', '2025-06-01', '$2y$10$tvJvfxrlgi9l5XGsIPJkHeuIvpCcl9TLrI1JG4BuCPvikHu2tLjh2', '2025-06-01 10:33:38'),
(12, 'Aizen', 'Aizen@gmail.com', '-', '2025-06-02', '$2y$10$sOgtkh23sc4LeMRPKvz4Euzp6OkFxa3WOMSAAocUhPnNQk80GavIm', '2025-06-02 07:08:21'),
(13, 'orng', 'orng@gmail.com', '-', '2025-06-11', '$2y$10$7Wo0FP/zyH3U45YRCxCccudMpQinx5xBWs3AdMBEXRABdlDB48DdK', '2025-06-11 01:58:48'),
(14, 'aqmal', 'aqmal@gmail.com', '-', '2025-06-11', '$2y$10$kQdouxjFoaeEYoRR6C5hWOVK0r60zniX5wEDhgmXR6HpWV9X8N8Ku', '2025-06-11 07:41:34'),
(15, 'userbaru', 'userbaru@gmail.com', '-', '2025-06-15', '$2y$10$ynLZ4Q6bUqHKIegkRfbHee/bwD2Nd00bD48e88F5nt9pIJ0Lx3fWi', '2025-06-15 07:45:37'),
(16, 'pengguna1', 'pengguna1@gmail.com', '-', '2025-06-18', '$2y$10$A5DhuNxxO29rPAGJ.vgk1O.N7MNiMzFoLN5clBXXfYpOt2VVNRHZu', '2025-06-17 16:26:49'),
(17, 'tesuser', 'tesuser@gmail.com', '-', '2025-06-19', '$2y$10$qOuq.4pP7A3i9pRtFReUY.S1cYtJhNAWzAG9rPO0DkKC7JuRNiC.e', '2025-06-19 11:16:57');

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
-- Indeks untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `gambar_mobil`
--
ALTER TABLE `gambar_mobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mobil` (`id_mobil`);

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
-- Indeks untuk tabel `pengelolaberita`
--
ALTER TABLE `pengelolaberita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `balasan`
--
ALTER TABLE `balasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `booking_test_drive`
--
ALTER TABLE `booking_test_drive`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `gambar_mobil`
--
ALTER TABLE `gambar_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `merek`
--
ALTER TABLE `merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengelolaberita`
--
ALTER TABLE `pengelolaberita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `topik`
--
ALTER TABLE `topik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Ketidakleluasaan untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `diskusi_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gambar_mobil`
--
ALTER TABLE `gambar_mobil`
  ADD CONSTRAINT `gambar_mobil_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`) ON DELETE CASCADE;

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
