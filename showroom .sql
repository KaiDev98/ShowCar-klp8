-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2025 pada 15.49
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
  `mobil_id` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal_publikasi`, `penulis`, `mobil_id`, `id_mobil`) VALUES
(9, 'BMW Indonesia Jual M4 CSL, Hanya 2 Unit!', 'BMW Indonesia tak hanya meluncurkan Seri 3 LCI. Mereka sekaligus merilis BMW M4 CSL. Ya, Indonesia kebagian secara resmi lewat APM. Model terkencang yang mereka produksi saat ini hanya diproduksi 1.000 unit. Model ini dihadirkan sebagai hadiah khusus perayaan 50 tahun BMW M, sebagai divisi khusus performa dan balap. Desain dan spesifikasinya sudah sangat mendekati mobil balap.\r\n\r\nCSL singkatan dari “Competition, Sport, Lightweight”. Mengandalkan bumbu peningkatan tampilan dan performa mendekati mobil balap untuk BMW M4. Hadirnya M4 CSL menegaskan posisinya yang lebih ganas sebagai mobil sport, di atas M2 CS dan M5 CS. Bahkan BMW klaim mobil ini menjadi produksi tercepat saat digeber di Nurburgring Nordschleife.\r\n\r\nSpesifikasi M4 CSL mengutamakan pemangkasan bobot. Sehingga bisa memberikan performa sedekat mungkin seperti mobil balap. Eksterior terpangkas bobot sebanyak 3,6 kg dari kidney grille raksasa, lampu belakang, karpet, dan AC otomatis. Pengurangan bobot total M4 CSL sampai 109 kg dari varian standarnya, identik seperti yang terjadi pada M3 CSL dulu di generasi E46.', 'berita2.jpg', '2025-06-06', 'Admin', 0, 51),
(10, 'Xpeng Beri Kesempatan Perdana Coba X9 dan G6, Tunggu Harga Resmi', 'Seperti pada impresi perdana di peluncuran merek lalu, model G6 dan X9 mencuri perhatian. SUV G6 menawarkan siluet serupa coupe yang ramping dan aerodinamis. Beberapa keunggulannya, layar sentuh 15,6 inci, panel digital 10,2 inci, asisten suara berbasi AI, sistem audio dengan 18 speaker, panoramic glass roof, serta interior lapang berkat desain kabin rata.', 'berita3.jpg', '2006-02-04', 'Admin', 0, 49),
(11, 'Toyota Kasih Fitur Canggih Buat New Fortuner 2024, Apa Saja?', 'Perubahan pada New Fortuner tidak terbatas pada estetika, melainkan juga mencakup fitur-fitur baru. Toyota Astra Motor telah meningkatkan kenyamanan dengan memasang New Monotube Suspension yang mengurangi limbung saat manuver. Selain itu, Toyota Safety Sense 2.0 yang lebih canggih kini tersedia pada model puncak seperti VRZ 4x2 dan GR Parts Aeropackage. Toyota juga menawarkan konektivitas wifi gratis untuk hiburan internal, smartphone, dan laptop.', 'berita4.jpg', '2025-07-01', 'Admin', 0, 1),
(12, 'Mau Beli New Toyota Fortuner, Cek Dulu Skema Simulasi dengan DP 20 Persen', 'Toyota New Fortuner tak hanya mendapatkan pembaruan eksterior. Namun juga imbuhan fitur-fitur canggih. Ia menjadi pilihan baru dalam mobilitas sehari-hari maupun sebagai penunjang hobi. Tersedia banyak varian, mulai dari Rp573,7 juta hingga Rp761,7 juta on the road Jakarta. Bila Anda tertarik membeli secara kredit ke diler resmi. Bisa dapatkan dengan uang muka minimal 20 persen. Hitung-hitungannya dari Auto2000. Skema tidak mengikat dan dapat berubah sewaktu-waktu.', 'berita5.jpg', '2025-06-04', 'Admin', 0, 1),
(14, 'New Honda HR-V e:HEV Punya 5 Varian dan 2 Pilihan Mesin', 'Honda terus berinovasi dalam dunia otomotif Indonesia dengan menghadirkan New Honda HR-V e:HEV, menjadikannya SUV kompak pertama bertenaga hybrid dari pabrikan ini. Peluncuran model terbaru ini sekaligus memperkuat jajaran kendaraan elektrifikasi Honda, menawarkan efisiensi bahan bakar lebih baik, desain yang lebih futuristik, serta fitur yang semakin canggih. Dengan harga yang dimulai dari Rp399,9 juta, Honda menargetkan HR-V terbaru akan menjadi salah satu pilihan utama bagi konsumen yang mencari SUV kompak dengan performa optimal dan teknologi terkini.\r\n\r\nNew Honda HR-V kini hadir dengan lima pilihan varian, memberikan lebih banyak opsi kepada konsumen sesuai dengan kebutuhan mereka. Tersedia tipe E dan E+ yang masih mengandalkan mesin bensin konvensional, serta tiga varian hybrid yang terdiri dari HR-V e:HEV, HR-V e:HEV Modulo, dan HR-V RS e:HEV. Perbedaan utama dari setiap varian terletak pada fitur yang disematkan serta tampilan eksterior dan interiornya. Dengan hadirnya lebih banyak opsi, Honda memastikan setiap konsumen dapat memilih SUV yang sesuai dengan gaya hidup mereka.\r\n\r\nBerikut adalah harga resmi dari masing-masing varian New Honda HR-V di Indonesia:\r\n\r\nHR-V RS e:HEV (hybrid): Rp488 juta\r\nHR-V e:HEV Modulo (hybrid): Rp460,7 juta\r\nHR-V e:HEV (hybrid): Rp449 juta\r\nHR-V E+ CVT (bensin): Rp422 juta\r\nHR-V E CVT (bensin): Rp399,9 juta\r\n\r\nDari sisi tampilan, New Honda HR-V menghadirkan desain eksterior yang lebih sporty dan premium dibandingkan generasi sebelumnya. Grille depan dan bumper kini terlihat lebih tegas dengan bentuk yang lebih menonjol, serta penggunaan warna kontras yang semakin memperkuat karakter SUV ini.\r\n\r\nSektor pencahayaan juga mendapatkan peningkatan signifikan dengan hadirnya fitur Adaptive Driving Beam dan Active Cornering Light. Teknologi ini memungkinkan sistem pencahayaan menyesuaikan dengan kondisi jalan, memberikan visibilitas yang lebih baik untuk pengemudi saat berkendara di malam hari atau di area dengan pencahayaan minim. Di bagian belakang, Honda menyematkan desain lampu Full-Width Strip yang membentang selebar bodi, kini menggunakan teknologi LED yang lebih efisien dan elegan.\r\n\r\nUntuk varian HR-V e:HEV Modulo, Honda memberikan sentuhan eksterior yang lebih agresif dengan tambahan aksesori seperti Front Under Spoiler, Rear Under Spoiler, Door Visor, Side Lower Garnish, dan Exhaust Pipe Finisher. Selain itu, emblem Modulo turut disematkan sebagai tanda identitas yang membedakan varian ini dari model lainnya.', 'berita7.jpg', '2025-06-11', 'admin', 0, 51),
(15, 'Toyota Luncurkan Fortuner Diesel Hybrid 2025, Harganya Tak Murah!', 'Mengikuti perkembangan kendaraan ramah lingkungan. Toyota Kirloskar Motor (TKM) pada 2 Juni 2025 mengumumkan peluncuran Fortuner dan Legender hybrid ringan. Kendaraan kini dilengkapi dengan sistem baterai 48‑Volt. Varian anyar ini diklaim memberi efisiensi bahan bakar semakin baik, performa berkendara meningkat dan kenyamanan kian optimal. Untuk harga Fortuner Neo Drive 48V dilego INR44,72,000 (Rp850 jutaan) dan Legender Neo Drive 48V dilepas INR50,09,000 (Rp950 jutaan). \r\n\r\n“Seiring dengan pasar SUV di India yang terus tumbuh. Pelanggan mencari fitur-fitur canggih dan gaya berbeda. Baik Fortuner maupun Legender mampu memenuhi harapan ini melalui desain berani, performa bertenaga dan fitur-fitur lengkap. Ini memenuhi kebutuhan beragam pengguna. Kini, peluncuran varian Neo Drive 48V baru di kedua model menandai tonggak sejarah lain dalam perjalanan kami,” terang Varinder Wadhwa, Vice President, Sales Service Used Car Business Toyota Kirloskar Motor. \r\n\r\nJadi model pertama di segmennya, hal ini menurut Toyota India demi mengakomodasi gaya hidup pelanggan yang terus berkembang. Sekaligus memperkuat pendekatan multipath menuju netralitas karbon. Jadi, teknologi 48V baru ditujukan untuk menawarkan penghematan bahan bakar optimal, meski tak disebut berapa besarannya.', 'Toyota-New-Fortuner-Hybrid-2.avif', '2025-06-11', 'admin', 0, 1),
(16, 'Geely Indonesia Gandeng Voltron Sediakan Jaringan Charging Station', 'Untuk mendukung ekosistem kendaraan niremisi di sini. Geely Auto Indonesia secara resmi mengumumkan kolaborasi strategis dengan Voltron. Mereka bakal menyediakan fasilitas pengisian daya di seluruh jaringan diler resmi Geely. Kerja sama ini merupakan langkah kedua perusahaan dalam mendukung program percepatan penggunaan kendaraan listrik nasional. Serta transisi menuju lingkungan yang lebih bersih dan berkelanjutan. \r\npusat layanan purnajual\r\n“Kerja sama dengan Voltron ini merupakan bukti nyata komitmen Geely dalam mempercepat transisi kendaraan listrik di Indonesia. Dengan ketersediaan fasilitas charging station Voltron di jaringan diler resmi kami. Pelanggan kini dapat menikmati pengisian daya lebih praktis dan nyaman. Serta meningkatkan pengalaman kepemilikan kendaraan listrik secara menyeluruh,” ujar Yusuf Anshori, Brand Director Geely Auto Indonesia, dalam keterangan tertulis. \r\n\r\nJalinan strategis Geely Auto Indonesia dan Voltron menjadi bagian penting dari upaya bersama sektor swasta dan pemerintah. Khususnya dalam menciptakan ekosistem kendaraan listrik yang terintegrasi, mudah diakses dan ramah lingkungan.\r\n\r\nMelalui kemitraan mereka berjanji mau memperluas jaringan charging station di seluruh diler resmi di berbagai wilayah penjuru nusantara. Langkah ini tidak hanya memudahkan akses pengisian daya bagi pelanggan. Tetapi juga mendukung percepatan pengembangan ekosistem kendaraan listrik nasional. Sejalan dengan target Net Zero Emission Indonesia 2060.', 'Geely-dan-Voltron-2-500x333.avif', '2025-06-11', 'admin', 0, 1),
(17, 'Cara Curang Dongkrak Penjualan, Mobil Baru 0 Km Dijual Jadi Barang Bekas di Cina', 'Praktik Kotor Penjualan Mobil 0 Km\r\nApa yang sebenarnya terjadi di sana? Fenomena mobil bekas nol kilometer terletak di proses penjualan. Unit anyar didaftarkan sebagai mobil terjual, sering kali ke diler afiliasi atau platform pihak ketiga. Dan kemudian dijual kembali sebagai mobil seken meskipun jarak tempuhnya sedikit atau tidak ada sama sekali (0 km).\r\n\r\nManuver ini memiliki banyak tujuan. Di antaranya membantu produsen mobil mencapai target penjualan. Memungkinkan diler untuk menjual stok tidak terjual. Bahkan dalam beberapa kasus, memanfaatkan subsidi atau kebijakan ekspor terkait dengan status registrasi kendaraan.\r\n\r\nPraktik ini dinilai berhubungan erat bersama tantangan sistemik dalam industri. Kelebihan kapasitas tetap menjadi masalah mendesak. Untuk diketahui, inventory jumlah mobil penumpang nasional mencapai 3,5 juta unit pada April 2025. Beberapa produsen beroperasi dengan utilisasi kapasitas kurang dari 50 persen.\r\n\r\nHal ini mendorong taktik agresif untuk mengurangi tekanan stok. Selain itu, perang harga yang intens dan ketergantungan terhadap subsidi pemerintah. Khususnya di sektor kendaraan energi baru (NEV), telah menciptakan kondisi dan strategi penjualan tidak transparan itu.\r\n\r\nWalaupun kendaraan ini sering kali dibanderol dengan harga menarik — terkadang 30 persen di bawah MSRP asli — namun unit itu membawa risiko tersembunyi. Garansi biasanya dimulai saat pendaftaran. Artinya pembeli dapat kehilangan jaminan selama berbulan-bulan. Beberapa model juga memiliki sejumlah pinjaman yang belum dibayar. Atau riwayat kepemilikan tidak jelas. Hal itu membuat konsumen menghadapi potensi masalah hukum dan keuangan.\r\n\r\nBeberapa analis pasar memperingatkan bahwa konsekuensi jangka panjang melampaui transaksi individual. Data penjualan yang digelembungkan secara artifisial dapat menyesatkan investor. Bisa mengaburkan permintaan pasar dan mendistorsi persaingan.\r\n\r\nAmbil contoh, harga mobil bekas untuk model seperti BYD Qin L anjlok 30-40 persen di bawah banderol resmi. Alhasil memicu efek domino di antara model-model bersaing. Bahkan turut berkontribusi terhadap penurunan ekspektasi harga secara meluas. ', 'EV-mobil-listrik_03.avif', '2025-06-11', 'admin', 0, 51),
(18, 'Road Test Haval Jolion Ultra HEV: Enak Buat ke Luar Kota', 'Haval Jolion Ultra HEV hadir sebagai pesaing menarik di segmen SUV kompak dengan desain modern yang berkarakter. Tampilan eksteriornya mengusung gril besar berwarna hitam, roof rail yang mempertegas nuansa tangguh, serta garis desain agresif khas SUV masa kini. Tak hanya soal tampilan, performanya pun mengesankan berkat mesin 4-silinder 1,5 liter hybrid yang dirancang untuk efisiensi bahan bakar maksimal.\r\n\r\nKEY TAKEAWAYS\r\n\r\nPerforma dan Pengalaman Berkendara\r\nDalam perjalanan dari Jakarta ke Brebes via Tol Cipali yang lengang, Haval Jolion Ultra HEV menunjukkan karakter berkendara yang halus di putaran mesin rendah, namun tetap agresif saat berakselerasi. Mesin hybrid ini menghasilkan tenaga 187 HP dan torsi puncak 378 Nm yang dialirkan ke roda depan secara linear.\r\n\r\n', 'Test-drive-Haval-Jolion-Ultra-HEV-1.avif', '2025-06-11', 'Aqmal', 0, 48);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Disetujui','Ditolak') DEFAULT 'Pending',
  `dibaca_user` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking_test_drive`
--

INSERT INTO `booking_test_drive` (`id_booking`, `nama_lengkap`, `email`, `no_hp`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `merk_mobil`, `waktu_testdrive`, `pertanyaan`, `created_at`, `status`, `dibaca_user`) VALUES
(1, 'Muhammad rifki', 'rifki@gmail.com', '9841414834', '1999-01-02', 'Laki-laki', 'baranti', 'pare pare', 'Avanza', '2025-04-28 13:45:00', 'tes', '2025-05-30 04:43:16', 'Disetujui', 0),
(2, 'Muhammad rifki', 'tes@gmail.com', 'fafd', '0044-04-13', 'Perempuan', 'wtrwe', 'wgtwrgt', 'wgwrg', '0025-03-04 14:34:00', 'gsdgsdf', '2025-05-30 04:52:27', 'Disetujui', 0),
(3, 'Rifki1', 'muhammadrifkimms@gmail.com', '081523906033', '2025-06-11', 'Laki-laki', 'Baranti', 'Pare Pare', 'Bmw M4', '2025-06-11 09:44:00', 'gw ganteng ga min?', '2025-06-11 01:51:00', 'Ditolak', 1),
(4, 'firstuser', 'firstuser@gmail.com', '089525051006', '2025-06-11', 'Perempuan', 'Soreang', 'Pare Pare', 'Honda Chivic', '2025-06-11 09:57:00', 'Gw cantik ga min?', '2025-06-11 01:57:15', 'Disetujui', 0),
(5, 'orng', 'orng@gmail.com', '089525051006', '2025-06-11', 'Perempuan', 'Soreang', 'Pare Pare', 'Chorvette ZR1', '2025-06-11 10:00:00', 'hai min ganteng', '2025-06-11 02:00:11', 'Disetujui', 0),
(6, 'Rifki1', 'muhammadrifkimms@gmail.com', '089525051006', '2025-06-11', 'Laki-laki', 'tes', 'tes', 'tes', '2025-06-11 10:03:00', 'tes', '2025-06-11 02:03:22', 'Pending', 0),
(7, 'oiihhfguwfa', 'oiihhfguwfa@gmail.com', '089525051006', '2025-06-25', 'Laki-laki', 'ffasfadf', 'Pare Pare', 'fadfa', '2025-06-11 10:04:00', 'fadf', '2025-06-11 02:04:14', 'Pending', 0),
(8, 'Aqmal', 'aqmal@gmail.com', '08954872347', '2025-06-11', 'Laki-laki', 'Baranti', 'pare pare', 'Avanza', '2025-06-11 15:42:00', 'aqmal ganteng', '2025-06-11 07:42:46', 'Disetujui', 0),
(9, 'Muhammad rifki', 'muhammadrifkimms@gmail.com', '081523906033', '2025-06-11', 'Laki-laki', 'Pare pare', 'pare pare', 'Avanza', '2025-06-11 18:08:00', 'Tes', '2025-06-11 10:09:03', 'Pending', 0),
(10, 'Rifki1', 'muhammadrifkimms@gmail.com', '08954872347', '2025-06-12', 'Laki-laki', 'Baranti', 'pare pare', 'Mitsubishi Xpander', '2025-06-12 08:17:00', NULL, '2025-06-12 00:17:43', 'Disetujui', 1),
(11, 'Muhammad rifki', 'muhammadrifkimms@gmail.com', '081523906033', '2025-06-12', 'Laki-laki', 'tes', 'pare pare', 'Bmw m4', '2025-06-12 08:37:00', NULL, '2025-06-12 00:37:17', 'Disetujui', 1),
(12, 'ikki', 'muhammadrifkimms@gmail.com', '9841414834', '2005-01-12', 'Perempuan', 'parepare', 'pare pare', 'pajero', '2025-06-12 09:40:00', '??', '2025-06-12 01:41:07', 'Disetujui', 1);

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
(23, 55, 'kjbfadlhsa', 'faskdnfabsdknfa', '2025-06-12 01:59:29', 22);

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
(1, 'Toyota Fortuner', 6, 2, 500000000, NULL, 'https://www.youtube.com/watch?v=fwPlIYflSUw', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Honda Civic', 2, 2, 450000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Toyota Rush', 1, 1, 750000000, NULL, 'https://www.youtube.com/embed/2VbzjWgk4Rw', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Nissan Gtr 20', 6, 1, 2147483647, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Manual\",\"kapasitas_mesin\":\"1500 hp\",\"tenaga\":\"20000 hp\",\"kapasitas_tempat_duduk\":\"5\"}', 'https://www.youtube.com/embed/fwPlIYflSUw', 'Bensin', 'Manual', '1500 hp', '20000 hp', '5', NULL, NULL),
(49, 'Mitsubishi Pajero Sport', 3, 1, 700500080, '{\"bahan_bakar\":\"Diesel\",\"transmisi\":\"Manual, Otomatis\",\"kapasitas_mesin\":\"2442 - 2477 cc\",\"tenaga\":\"134 - 179 hp\",\"kapasitas_tempat_duduk\":\"7 Kursi\"}', 'https://youtube.com/embed/QNt-a9ze_VM', 'Diesel', 'Manual, Otomatis', '2442 - 2477 cc', '134 - 179 hp', '7', NULL, NULL),
(50, 'Corvette ZR1', 4, 1, 299999999, '{\"bahan_bakar\":\"Diesel\",\"transmisi\":\"LT7 5.5L DOHC V8 engine\",\"kapasitas_mesin\":\"233 MPH\",\"tenaga\":\"1,064 HP\",\"kapasitas_tempat_duduk\":\"2\"}', 'https://youtube.com/embed/LGJbxUVYpBk', 'Diesel', 'LT7 5.5L DOHC V8 engine', '233 MPH', '1,064 HP', '2', NULL, NULL),
(51, 'BMW M4', 11, 1, 299999999, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"2993 cc\",\"tenaga\":\"523 - 543 hp\",\"kapasitas_tempat_duduk\":\"4\"}', 'https://youtube.com/embed/O_-CMb52WMQ', 'Bensin', 'Otomatis', '2993 cc', '523 - 543 hp', '4', NULL, NULL),
(52, 'Rolls Royce Spectre', 9, 3, 80000000, '{\"bahan_bakar\":\"Electric\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"102 kWh\",\"tenaga\":\"577 hp\",\"kapasitas_tempat_duduk\":\"4 kursi\"}', 'https://www.youtube.com/watch?v=jum8PGur1PU&pp=0gcJCbAJAYcqIYzv', 'Electric', 'Otomatis', '102 kWh', '577 hp', '4', NULL, NULL),
(53, 'Supra Mk4', 12, 1, 1444444444, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"102 kWh\",\"tenaga\":\"577 hp\",\"kapasitas_tempat_duduk\":\"4 kursi\"}', 'https://www.youtube.com/embed/xhZvehnxLLM', 'Bensin', 'Otomatis', '102 kWh', '577 hp', '4', NULL, NULL),
(54, 'Hummer EV SUV', 10, 1, 1555544433, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"Otomatis\",\"kapasitas_mesin\":\"102 kWh\",\"tenaga\":\"577 hp\",\"kapasitas_tempat_duduk\":\"4 kursi\"}', 'https://www.youtube.com/embed/2VbzjWgk4Rw', 'Bensin', 'Otomatis', '102 kWh', '577 hp', '4', NULL, NULL),
(55, 'Mitsubishi Xpander Hybrid', 3, 1, 2147483647, '{\"bahan_bakar\":\"Bensin\",\"transmisi\":\"CVT\",\"kapasitas_mesin\":\"1598 cc\",\"tenaga\":\"114 hp\",\"kapasitas_tempat_duduk\":\"7 Kursi\"}', 'https://www.youtube.com/embed/fwPlIYflSUw', 'Bensin', 'CVT', '1598 cc', '114 hp', '7', NULL, NULL);

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
  `mobil_id` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id`, `nama`, `mobil_id`, `komentar`, `rating`, `created_at`) VALUES
(3, 'woila', 2, 'tes', 3, '2025-05-30 10:26:33'),
(4, 'muhammad rifki', 10, 'woi penipu balikin duit gw jir', 1, '2025-05-30 22:43:15'),
(6, 'Muhammad Rifki', 1, 'tes', 1, '2025-06-03 23:32:12'),
(7, 'Muhamad Taufiq Hidayat', 51, 'BMW dengan series SUV yg paling saya suka , enak ,performa joss,nyaman buat jalan sendiri Dan keluarga . Terenak pokoke... 👍🏻👍🏻👍🏻😁', 5, '2025-06-04 10:34:51'),
(8, 'Muhamad Taufiq Hidayat', 51, 'tes', 2, '2025-06-04 10:40:32'),
(9, 'istimewa', 50, 'nyaman dan dan modern stylish dengan fitur 15 ADAS. dan NCAP bintang 5. so far pakai mobil ini oke banget', 5, '2025-06-04 11:48:38'),
(10, 'Rahasia', 1, 'Calya ini kendala yang paling menyebalkan dan membahayakan adalah saat tanjakan dijalan y buruk dan licin. Jika mesin mati sangat sulit mendapat traksi. Bisa mundur dan membahayakan pengendara di belakang. Sebaiknya roda penggerak dikembalikan ke penggerak roda belakang saja.', 4, '2025-06-04 11:49:24'),
(11, 'Mas Anis', 10, 'Harga tidak mahal, fasilitas lumayan, daya muat lumayan luas, irit bahan bakar kenyamanan berkendaraan mengasyikkan. Suspensi agak keras tapi masih oke sudah dilengkapi airbag', 3, '2025-06-04 11:49:56'),
(12, 'Rfiki', 50, 'tess', 4, '2025-06-11 08:02:37'),
(13, 'Rifki1', 1, 'uuwfhajfha ighafjaghfh agfajhbfa faadsf', 5, '2025-06-11 02:36:11'),
(14, 'Rifki1', 1, 'uuwfhajfha ighafjaghfh agfajhbfa faadsf', 5, '2025-06-11 02:36:27'),
(15, 'Rifki1', 51, 'menurut saya mobil ini memang worth to buy sih apalagi buat anda yang ingin tampil lebih keren', 5, '2025-06-11 02:37:43'),
(16, 'Rifki1', 49, 'tesliyefuqyer yruiq yryquwyriqw rqiygriuqg yerqorqog ryqgrugqwe', 3, '2025-06-12 05:38:12');

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
(14, 'aqmal', 'aqmal@gmail.com', '-', '2025-06-11', '$2y$10$kQdouxjFoaeEYoRR6C5hWOVK0r60zniX5wEDhgmXR6HpWV9X8N8Ku', '2025-06-11 07:41:34');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `booking_test_drive`
--
ALTER TABLE `booking_test_drive`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `gambar_mobil`
--
ALTER TABLE `gambar_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

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
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `topik`
--
ALTER TABLE `topik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
