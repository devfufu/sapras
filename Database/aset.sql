-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Mar 2026 pada 19.49
-- Versi server: 8.0.45-0ubuntu0.22.04.1
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aset`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asets`
--

CREATE TABLE `asets` (
  `id_aset` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_aset` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `id_lokasi` int DEFAULT NULL,
  `volume` int DEFAULT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `kondisi` varchar(128) COLLATE utf8mb4_general_ci DEFAULT 'Baik',
  `status_aset` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `umur_ekonomis` int DEFAULT NULL,
  `jenis_bantuan` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_aset` varchar(128) COLLATE utf8mb4_general_ci DEFAULT 'Berwujud',
  `qr_code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `asets`
--

INSERT INTO `asets` (`id_aset`, `kode_aset`, `id_barang`, `id_lokasi`, `volume`, `satuan`, `harga`, `total_harga`, `kondisi`, `status_aset`, `umur_ekonomis`, `jenis_bantuan`, `jenis_aset`, `qr_code`) VALUES
('024c540f55c0445889b6635398623e94', '2025-05/7/ELK/008', 28, 11, 1, 'Unit', 3330000, 3330000, 'Baik', 'Aktif', 4, 'BospSMK', 'Berwujud', '466e2dff885e425fabd8aefe38a930fa.png'),
('061955807b7143fc88553d77e99d385e', '2025-10/4/ELK/022', 35, 48, 1, 'Unit', 2000000, 2000000, 'Baik', 'Aktif', 2, 'SMK', 'Berwujud', '858037adbbe6436b8752a07e6eec0ce9.png'),
('06648c538632438899c59a9967a13366', '2024-08/7/KOM/004', 26, 12, 1, 'Unit', 11100000, 11100000, 'Baik', 'Aktif', 4, 'Pemerintah', 'Berwujud', 'b0a2b098b9e04131b8234e9a42793e50.png'),
('1a64cbcbf4334071918fa42a30abc97a', '2025-10/7/BUK/029', 44, 10, 70, 'Buah', 6440000, 450800000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '514abc4db944428393de3e1e75ae8ca7.png'),
('1ab13366b173410985d121de4869c352', '2024-11/7/ELK/002', 25, 12, 1, 'Buah', 7500000, 7500000, 'Baik', 'Aktif', 3, 'Pemerintah', 'Berwujud', 'b5ef142423974963a502d36d2a7f5bd1.png'),
('1c772efd270842d29bffa5e53d8674c0', '2025-09/7/ELK/020', 33, 46, 1, 'Unit', 9990000, 9990000, 'Baik', 'Aktif', 5, 'BospSMK', 'Berwujud', '5a37cca1a3b14c73962358bf8c733282.png'),
('204dd61f1ec34df6a9b94392e0e2a3d8', '2024-08/7/KOM/003', 26, 7, 1, 'Unit', 11100000, 11100000, 'Baik', 'Aktif', 4, 'Pemerintah', 'Berwujud', '451592cbe2024162ba2c50b07cda1f0c.png'),
('2ea9caeb10ea4e8f81e76b6dbe10d36f', '2025-05/7/ELK/010', 30, 41, 1, 'Unit', 6000000, 6000000, 'Baik', 'Aktif', 5, 'BospSMK', 'Berwujud', '97b6c7bffb1f4d2daaa62a18e8b35acd.png'),
('3135539e2f30430a9eefcb68d2996bba', '2025-03/4/KOM/004', 22, 16, 1, 'Buah', 11100000, 11100000, 'Baik', 'Aktif', 4, 'Pribadi', 'Berwujud', '04531ae347414e5b89abf7c37a630cc1.png'),
('317938d9b530437ca4dcd105ce02bd35', '2025-09/7/ELK/016', 32, 18, 1, 'Unit', 7500000, 7500000, 'Baik', 'Aktif', 3, 'BospSMK', 'Berwujud', 'b99c4658bbab4e16b646f69ab7965e3d.png'),
('362899a8aecf41319ff6341e39b5e882', '2025-10/7/BUK/034', 53, 10, 70, 'Buah', 5250000, 367500000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', 'b12c618d84ad4b1bb062ac55f6ca0da3.png'),
('3d42a61bf0094fbfbaaf72ba1cd9c1e7', '2025-10/7/BUK/028', 45, 10, 70, 'Buah', 6790000, 475300000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '4e345a0bc6064fd59d788d2779a7e6af.png'),
('3fea3ce4a9ff491ba89372ca3f7c9d34', '2025-01/4/ALD/002', 21, 38, 10, 'Buah', 175000, 1750000, 'Baik', 'Aktif', 1, 'Pribadi', 'Berwujud', '8ad06bb278614005b996e7a06bbb5dbc.png'),
('519be9fa10da4246a5e61281aa6c92a0', '2025-05/7/ELK/007', 28, 9, 1, 'Unit', 3330000, 3330000, 'Baik', 'Aktif', 4, 'BospSMK', 'Berwujud', 'fa0506a9bb1a4708869501d8fbb25ac8.png'),
('529e8a3c65134950ab215a1c78833181', '2025-05/7/ELK/011', 30, 28, 1, 'Unit', 6000000, 6000000, 'Baik', 'Aktif', 5, 'BospSMK', 'Berwujud', '29ad9e37b5424a3497b393cc43e4dfb3.png'),
('540cf27c502149e3977a3d1a36c97c04', '2025-10/7/BUK/031', 42, 10, 72, 'Buah', 9720000, 699840000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '31bcb72b76de4508a201b2e389ead8b1.png'),
('578416ac7d704097a0067b074b5de6af', '2025-08/7/ELK/014', 31, 34, 1, 'Unit', 15540000, 15540000, 'Baik', 'Aktif', 4, 'BospSMK', 'Berwujud', 'ddc569f7eaee40fcb9eeef9c4edfc297.png'),
('599b570d3c654b1bbc3cb77f0386d5e6', '2025-10/7/BUK/032', 55, 10, 108, 'Buah', 12960000, 1399680000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '31b20ea929fe44aea0f85213c54916f5.png'),
('64b6a18457d74a3bb63a548e8f346b66', '2024-12/7/FNT/006', 27, 12, 1, 'Buah', 2000000, 2000000, 'Baik', 'Aktif', 4, 'Pemerintah', 'Berwujud', '07f325b40d9844db943ad425edec3bbc.png'),
('6537ed9a60d440e9b6e123ebe063933c', '2024-11/7/ELK/001', 25, 11, 1, 'Buah', 7500000, 7500000, 'Baik', 'Aktif', 3, 'Pemerintah', 'Berwujud', 'ae083361b4524fd487caa0d35aaa80bd.png'),
('69f90ffe154f4aaf8c940861e97d00f4', '2025-05/7/ELK/013', 30, 30, 1, 'Unit', 6000000, 6000000, 'Baik', 'Aktif', 5, 'BospSMK', 'Berwujud', '412b4a815a16493e9501ee84df423448.png'),
('6cd524434a4f43f7bae0845ddc01109f', '2025-09/7/ELK/015', 32, 15, 1, 'Unit', 7500000, 7500000, 'Baik', 'Aktif', 3, 'BospSMK', 'Berwujud', '5c4ce2299b63445588682cd984e5e059.png'),
('7832f3ac7c024f0e9af1c4eb3083c915', '2025-05/7/ELK/009', 29, 7, 1, 'Unit', 3000000, 3000000, 'Baik', 'Aktif', 4, 'BospSMK', 'Berwujud', '7c79ab71eb394e60b510651575e4b371.png'),
('7b0030ebc20a41f5a327b739810638e8', '2025-03/7/KOM/006', 23, 12, 1, 'Buah', 11100000, 11100000, 'Baik', 'Aktif', 4, 'Pemerintah', 'Berwujud', '774c13ba2778432aa55e5551e13d743f.png'),
('8774ee86006a45709ddca18862c1eb2a', '2025-10/7/BUK/026', 47, 10, 70, 'Buah', 9660000, 676200000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '56ba9dfc213347069483c24abe3c4eb4.png'),
('89846aaaa33247659e1f75300dea39d8', '2025-10/7/BUK/036', 51, 10, 72, 'Buah', 11736000, 844992000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '4d3787bdfc9e46738151c3de5b38a56d.png'),
('8da574e26bf94bc0870bd0f3188ac7bc', '2025-10/7/BUK/030', 43, 10, 70, 'Buah', 7980000, 558600000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '3952f0dae5cb470a85ceb4364f284b13.png'),
('8e16a4c4c72c4eb78e17f66f96397c96', '2025-10/4/ELK/021', 34, 48, 1, 'Unit', 2000000, 2000000, 'Baik', 'Aktif', 3, 'Pribadi', 'Berwujud', 'e3382883ab644b82be0a546d68e49a49.png'),
('9f799371c05b463987ba92dc78263730', '2025-01/4/ELK/003', 19, 12, 1, 'Buah', 95000, 95000, 'Baik', 'Aktif', 2, 'Pribadi', 'Berwujud', '1b4b74716edf4b2291f74784dc635696.png'),
('a4fbd29bcd654c6b8c5c474f0a64e105', '2025-05/7/ELK/012', 30, 29, 1, 'Unit', 6000000, 6000000, 'Baik', 'Aktif', 5, 'BospSMK', 'Berwujud', '2562fbef34974d4e9df6624ac4991625.png'),
('a7c15d7ff7204a03b86b714ff770cb59', '2025-10/7/BUK/035', 52, 10, 70, 'Buah', 8120000, 568400000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', 'b43aa14b737546758d68d424ff89a906.png'),
('afada2556ec34ddbaae25937d2c760a2', '2025-09/7/ELK/019', 32, 22, 1, 'Unit', 7500000, 7500000, 'Baik', 'Aktif', 3, 'BospSMK', 'Berwujud', '734e0bcbc7b14ba5bc06e326255a29fb.png'),
('b1d17faa01314a5587869ce15ff3bea8', '2025-10/7/FNT/037', 56, 11, 8, 'Unit', 35520000, 284160000, 'Baik', 'Aktif', 5, 'Pemerintah', 'Berwujud', '11ac5f27aaef471da4efc2ef0043d5bf.png'),
('b614d50c412d4e3f830a7c97ed3149da', '2025-09/7/ELK/017', 32, 19, 1, 'Unit', 7500000, 7500000, 'Baik', 'Aktif', 3, 'BospSMK', 'Berwujud', 'c91096aeb6bc4c8685aed2627e32bcf8.png'),
('b8dca7a9cd6342bb89955ae5ef9d7fd3', '2025-03/7/KOM/005', 22, 16, 2, 'Buah', 11100000, 22200000, 'Baik', 'Aktif', 4, 'Pemerintah', 'Berwujud', '01e4ce4b66924cba9764e1d5704ecf2c.png'),
('bb0758f40403434396c401c263a0fd36', '2025-10/7/BUK/033', 54, 10, 144, 'Buah', 19872000, 2861568000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '8798351ee1ae4b2a9bb4e292c2e22d95.png'),
('bca3ea61623744d3b605f07ac37e6a1d', '2025-10/7/KOM/039', 58, 7, 1, 'Unit', 1200000, 1200000, 'Baik', 'Aktif', 3, 'SMK', 'Berwujud', '9849608365414d8e9dfea22afc597324.png'),
('c096fd77d33c424782f078f6f313c0b0', '2025-10/7/ELK/038', 57, 24, 1, 'Unit', 2220000, 2220000, 'Baik', 'Aktif', 3, 'Pemerintah', 'Berwujud', '90dfa020426b4f1fb17b2cf55c8facf4.png'),
('c8d0326734de491ebd2c89a4c78457e8', '2025-10/7/BUK/027', 46, 10, 72, 'Buah', 9576000, 689472000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '27a604edf1244780a27f241df46a16d4.png'),
('ce1df4eff2ad4f55bafca575dda29239', '2025-10/7/BUK/025', 48, 10, 70, 'Buah', 8890000, 622300000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '157393828cec46a587ff6aa4dc022d6e.png'),
('d5fd297facbd40e5808c294a2c0d123e', '2024-08/4/ELK/001', 20, 12, 1, 'Unit', 1840000, 1840000, 'Baik', 'Aktif', 3, 'SMK', 'Berwujud', 'f8956bd52c744fa885872304f290b05e.png'),
('dbed3194edf84d3a9e2a228ad4e0a46e', '2025-10/7/BUK/024', 49, 10, 70, 'Buah', 7840000, 548800000, 'Baik', 'Aktif', 1, 'BospSMK', 'Berwujud', '6508933b91df4806ad51e35852af0576.png'),
('eccd2164be3a4203a6966c8eb99b2fcb', '2025-10/7/BUK/023', 50, 10, 80, 'Buah', 11920000, 953600000, 'Baik', 'Aktif', 1, 'Pemerintah', 'Berwujud', '25d9350cf2964323918788c3c6c09a74.png'),
('f1dffaae45cf41eba9e52a086b9cabb2', '2025-09/7/ELK/018', 32, 20, 1, 'Unit', 7500000, 7500000, 'Baik', 'Aktif', 3, 'BospSMK', 'Berwujud', '18e2fec88e68416f90774d93ae48b7c1.png'),
('fa29739950e4405080e2b11083d7083c', '2025-01/4/AKS/001', 18, 37, 1, 'Unit', 686000, 686000, 'Baik', 'Aktif', 3, 'SMK', 'Berwujud', '550e6a2ffcaa4519b30af7345aecd16f.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `merek` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_perolehan` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama_barang`, `merek`, `tahun_perolehan`) VALUES
(16, 2, 'AC 2PK', 'Panasonic', '2024'),
(17, 2, 'PRINTER', 'EPSON L', '2024'),
(18, 8, 'Timbangan Badan', 'GEA ZT120', '2025'),
(19, 2, 'Adapter AC/DC 9V 3A', 'Politron', '2025'),
(20, 2, 'Speaker Wireless PASPRO 30W', 'POLYTRON', '2024'),
(21, 6, 'Niki Bento', 'Kiara', '2025'),
(22, 4, 'PC Core i5; RAM 8 Gb; SSD 512 Gb', 'Rakitan', '2025'),
(23, 4, 'Laptop Core i5; RAM 16 Gb; SSD 512', 'Infinix', '2025'),
(24, 3, 'Meja Kursi Siswa ', 'Hasanah Jaya By GF', '2024'),
(25, 2, 'PROYEKTOR INFOCUS IN 114XV  XGA', 'INFOCUS', '2024'),
(26, 4, 'PC Core i5; RAM 8 Gb; SSD 512 Gb', 'Rakitan', '2024'),
(27, 3, 'Lemari Besi GF Series', 'GF', '2024'),
(28, 2, 'Printer Epson L3250', 'Epson', '2025'),
(29, 2, 'Dry Box Cabinet Lemari Kering Simpan Kamera 50 Liter Kaisler AC-52S', 'Kaisler', '2025'),
(30, 2, 'AC Gree 1PK', 'Gree', '2025'),
(31, 2, 'Epson EB-FH52 Full HD Projector', 'epson', '2025'),
(32, 2, 'PROYEKTOR INFOCUS IN 114XV XGA', 'Infocus', '2025'),
(33, 9, 'Kompresor Udara Shark 1hp Original', 'Shark', '2025'),
(34, 2, 'Mixer Ashley Selection - 12 ch', 'Ashley', '2025'),
(35, 2, 'MIC Ashley - MC-Four Series', 'Ashley', '2025'),
(41, 10, 'SISTEM ENGINE KENDARAAN RINGAN SMK KLS 11', 'Erlangga', '2025'),
(42, 10, 'DASAR-DASAR DESAIN KOMUNIKASI VISUAL KELAS X VOL 1', 'Erlangga', '2025'),
(43, 10, 'KARYA DESAIN KK DESAIN KOMUNIKASI VISUAL FASE F KELAS XI', 'Erlangga', '2025'),
(44, 10, 'MENERAPKAN DESIGN BRIEF KK DESAIN KOMUNIKASI VISUAL FASE F KELAS XI', 'Erlangga', '2025'),
(45, 10, 'PRINSIP DASAR DESAIN & KOMUNIKASI KK DESAIN KOMUNIKASI VISUAL FASE F KELAS XI', 'Erlangga', '2025'),
(46, 10, 'DASAR-DASAR PERHOTELAN SMK KELAS X ', 'Erlangga', '2025'),
(47, 10, 'PKK PARIWISATA UNTUK SMK/MAK KELAS XI', 'Erlangga', '2025'),
(48, 10, 'FRONT OFFICE-KK PERHOTELAN SMK KLS.11/KM REVISI', 'Erlangga', '2025'),
(49, 10, 'FRONT OFFICE-KK PERHOTELAN SMK KLS.12', 'Erlangga', '2025'),
(50, 10, 'KODING DAN KECERDASAN ARTIFISIAL SMK/MAK KLS.10/KM', 'Erlangga', '2025'),
(51, 10, 'DASAR-DASAR TJKT SMK KLS.10 VOL1/KM', 'Erlangga', '2025'),
(52, 10, 'ADMINISTRASI SISTEM JARINGAN FASE F KELAS XI VOL 1', 'Erlangga', '2025'),
(53, 10, 'KEAMANAN JARINGAN FASE F KELAS XI VOL 1', 'Erlangga', '2025'),
(54, 10, 'DASAR-DASAR TEKNIK OTOMOTIF SMK/MAK KLS.10 VOL.1/KM              ', 'Erlangga', '2025'),
(55, 10, 'PERAWATAN & PERBAIKAN ENGINE SEPEDA MOTOR SMK KLS.11/KM', 'Erlangga', '2025'),
(56, 3, 'Meja Lab TKJ Besi', 'Indorak', '2025'),
(57, 2, 'Vakum Cleaner Wet & dry 30L', 'Krisbow', '2025'),
(58, 4, 'Cromebook Lenovo', 'Lenovo', '2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_aset`
--

CREATE TABLE `data_aset` (
  `id_aset` int NOT NULL,
  `nama_aset` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_aset`
--

INSERT INTO `data_aset` (`id_aset`, `nama_aset`, `harga`) VALUES
(1, 'Full Set Komputer Core i5 Lcd 19inc Acer', 3499000),
(2, 'Full Set Komputer Core i5 Lcd 19inc Asus', 4000000),
(3, 'Full Set Komputer Core i5 Lcd 19inc Lenovo', 3000000),
(4, 'Full Set Komputer Core i5 Lcd 19inc Acer', 2925000),
(5, 'AC 2PK Panasonic', 9000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int NOT NULL,
  `kode_kategori` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_kategori` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `kode_kategori`, `nama_kategori`, `updated_at`) VALUES
(1, 'GDG', 'GEDUNG', '2020-09-24 22:48:11'),
(2, 'ELK', 'ELEKTRONIK', '2020-09-24 22:48:34'),
(3, 'FNT', 'FURNITURE', '2020-09-24 22:48:44'),
(4, 'KOM', 'KOMPUTER', '2021-11-04 13:07:08'),
(5, 'ALK', 'ALAT KEBERSIHAN', '2024-12-31 10:46:21'),
(6, 'ALD', 'ALAT DAPUR', '2024-12-31 10:46:50'),
(7, 'JST', 'JASA TUKANG', '2024-12-31 10:47:34'),
(8, 'AKS', 'ALAT KESEHATAN', '2025-01-17 13:55:06'),
(9, 'TLS', 'TOLS/Kunci', '2025-03-13 15:21:40'),
(10, 'BUK', 'Buku', '2025-08-21 11:14:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan_pengadaan`
--

CREATE TABLE `keputusan_pengadaan` (
  `id_nilai` int NOT NULL,
  `id_aset` int DEFAULT NULL,
  `id_spesifikasi` int DEFAULT NULL,
  `id_kualitas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keputusan_pengadaan`
--

INSERT INTO `keputusan_pengadaan` (`id_nilai`, `id_aset`, `id_spesifikasi`, `id_kualitas`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 1),
(3, 3, 2, 2),
(4, 4, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_kualitas`
--

CREATE TABLE `kriteria_kualitas` (
  `id_kualitas` int NOT NULL,
  `keterangan` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria_kualitas`
--

INSERT INTO `kriteria_kualitas` (`id_kualitas`, `keterangan`, `nilai`) VALUES
(1, 'Sangat Baik', 0.5),
(2, 'Baik', 0.4),
(3, 'Cukup', 0.3),
(4, 'Jelek', 0.2),
(5, 'Sangat Jelek', 0.1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_spesifikasi`
--

CREATE TABLE `kriteria_spesifikasi` (
  `id_spesifikasi` int NOT NULL,
  `keterangan` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria_spesifikasi`
--

INSERT INTO `kriteria_spesifikasi` (`id_spesifikasi`, `keterangan`, `nilai`) VALUES
(1, 'Sangat Baik', 0.5),
(2, 'Baik', 0.4),
(3, 'Cukup', 0.3),
(4, 'Jelek', 0.2),
(5, 'Sangat Jelek', 0.1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_aset`
--

CREATE TABLE `lokasi_aset` (
  `id_lokasi` int NOT NULL,
  `nama_lokasi` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lokasi_aset`
--

INSERT INTO `lokasi_aset` (`id_lokasi`, `nama_lokasi`, `updated_at`) VALUES
(5, 'GA.R.A1.01 R. Kepsek', '2025-07-22 11:27:35'),
(6, 'GA.RA1.02 R. SERBA GUNA', '2025-07-22 11:29:07'),
(7, 'GA.RA1.03 Lab DKV', '2025-07-22 11:29:21'),
(8, 'GA.RA1.04 R. TEFA', '2025-07-22 11:29:44'),
(9, 'GA.RA1.05 R. Waka & BK', '2025-07-22 11:30:19'),
(10, 'GA.1-6', '2024-12-31 10:33:09'),
(11, 'GA.RA1.07 Lab TKJ', '2025-07-22 11:30:42'),
(12, 'GA.RA1.08 TATA HUSAHA', '2025-07-22 11:31:03'),
(13, 'GA.1-9', '2024-12-31 10:34:09'),
(14, 'GA.1-10', '2024-12-31 10:34:18'),
(15, 'GA.2-1', '2024-12-31 10:34:34'),
(16, 'GA.RA2.02 Lab MM', '2025-07-22 11:35:03'),
(17, 'GA.RA2.03 R.GURU', '2025-07-22 11:35:31'),
(18, 'GA.2-4', '2024-12-31 10:35:39'),
(19, 'GA.2-5', '2024-12-31 10:35:52'),
(20, 'GA.2-6', '2024-12-31 10:36:37'),
(21, 'GA.RA2.07 MUSHOLAH ', '2025-07-22 11:34:36'),
(22, 'GA.2-8', '2024-12-31 10:37:01'),
(23, 'GA.2-9', '2024-12-31 10:37:13'),
(24, 'GA.2-10', '2024-12-31 10:37:22'),
(25, 'GA.2-11', '2024-12-31 10:37:31'),
(26, 'GA.3-1', '2024-12-31 10:38:02'),
(27, 'GA.3-2', '2024-12-31 10:38:11'),
(28, 'GA.3-3', '2024-12-31 10:38:18'),
(29, 'GA.3-4', '2024-12-31 10:38:26'),
(30, 'GA.3-5', '2024-12-31 10:38:59'),
(31, 'GA.3-6', '2024-12-31 10:39:31'),
(32, 'GA.3-7', '2024-12-31 10:39:40'),
(33, 'GA.3-8', '2024-12-31 10:39:49'),
(34, 'GA.4-1 AULA', '2024-12-31 10:40:12'),
(35, 'GB.1-1 R.Guru OTF', '2024-12-31 10:51:38'),
(36, 'GB.2-1 Lab FKK', '2024-12-31 10:52:11'),
(37, 'GB.3-1 Lab AK', '2024-12-31 10:52:27'),
(38, 'GA.1-Dapur', '2025-01-30 09:07:16'),
(39, 'GB.2-2', '2025-05-07 11:18:41'),
(40, 'GB.2-3', '2025-05-07 11:19:03'),
(41, 'GB.2-4', '2025-05-07 11:19:15'),
(42, 'GB.3-2', '2025-05-07 11:19:30'),
(43, 'GB.3-3', '2025-05-07 11:19:41'),
(44, 'GB.3-4', '2025-05-07 11:19:48'),
(45, 'LAB BENGKEL TSM', '2025-07-22 11:33:34'),
(46, 'LAB BENGKEL TKR', '2025-07-22 11:33:44'),
(47, 'R. KAJUR OTOMOTIF', '2025-07-22 11:34:07'),
(48, 'GA.1-R-Audio', '2025-10-14 11:13:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `monitoring_aset`
--

CREATE TABLE `monitoring_aset` (
  `id_monitoring` int NOT NULL,
  `id_aset` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kerusakan` text COLLATE utf8mb4_general_ci,
  `akibat` text COLLATE utf8mb4_general_ci,
  `faktor` text COLLATE utf8mb4_general_ci,
  `monitoring` text COLLATE utf8mb4_general_ci,
  `pemeliharaan` text COLLATE utf8mb4_general_ci,
  `jml_rusak` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` int NOT NULL,
  `id_lokasi` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `nama_aset` varchar(128) DEFAULT NULL,
  `volume` int DEFAULT NULL,
  `satuan` varchar(128) DEFAULT NULL,
  `harga_satuan` double DEFAULT NULL,
  `tahun_pengadaan` varchar(4) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penghapusan`
--

CREATE TABLE `penghapusan` (
  `id_penghapusan` int NOT NULL,
  `id_aset` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `faktor` text COLLATE utf8mb4_general_ci,
  `tgl_penghapusan` date DEFAULT NULL,
  `status` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama_user` varchar(125) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('1','2','3') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `jabatan`, `role`, `foto`) VALUES
(8, 'Staff Fadilah', 'staff', '$2y$10$hcRd56eU./AMDavKBpF2o.sK3C62PcmWRgGWLEKGBjS9L1s8J.PdG', 'Staf General Affair', '3', '4448c99fa244da5871ad01ddff3f57c0.jpg'),
(9, 'Kepala Bagian', 'manager', 'e10adc3949ba59abbe56e057f20f883e', 'Manager General Affair', '2', 'e68c26e4febe5422e423298f17706b97.jpg'),
(17, 'Fuad Ramadon, S.Kom', 'fuadramadon', '$2y$10$BStZd66uESLHgpyYhHGuFuKmt3wU046daRfFr/Herpy.2RU3lzbNW', 'SAPRAS', '1', NULL),
(18, 'Abdul Rohman, S.Kom', 'mamanbening', '49820149dfe5f942ffddeac182fca295', 'KA. SAPRAS ', '1', NULL),
(19, 'Andri Wijaya, S.Kom', 'andriwijaya', '$2y$10$JZPf.0D3k3PvUeTiRibn0eEzbU79fkA2NwMiL.faEu6myKVDSfQiO', 'KA. TATA USAHA', '1', NULL),
(21, 'test1', 'tes1', '$2y$10$3j.XbCta0rinJHNCaSg24uLNdB5N7NjyCk7krE1LQh6EUV.FIcn3y', 'admin', '1', NULL),
(22, 'test2', 'tes2', '$2y$10$3j.XbCta0rinJHNCaSg24uLNdB5N7NjyCk7krE1LQh6EUV.FIcn3y', 'Kaprog', '2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asets`
--
ALTER TABLE `asets`
  ADD PRIMARY KEY (`id_aset`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis` (`id_kategori`);

--
-- Indeks untuk tabel `data_aset`
--
ALTER TABLE `data_aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keputusan_pengadaan`
--
ALTER TABLE `keputusan_pengadaan`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_spesifikasi` (`id_spesifikasi`),
  ADD KEY `id_kualitas` (`id_kualitas`),
  ADD KEY `id_aset` (`id_aset`);

--
-- Indeks untuk tabel `kriteria_kualitas`
--
ALTER TABLE `kriteria_kualitas`
  ADD PRIMARY KEY (`id_kualitas`);

--
-- Indeks untuk tabel `kriteria_spesifikasi`
--
ALTER TABLE `kriteria_spesifikasi`
  ADD PRIMARY KEY (`id_spesifikasi`);

--
-- Indeks untuk tabel `lokasi_aset`
--
ALTER TABLE `lokasi_aset`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `monitoring_aset`
--
ALTER TABLE `monitoring_aset`
  ADD PRIMARY KEY (`id_monitoring`),
  ADD KEY `id_aset` (`id_aset`);

--
-- Indeks untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `penghapusan`
--
ALTER TABLE `penghapusan`
  ADD PRIMARY KEY (`id_penghapusan`),
  ADD KEY `id_aset` (`id_aset`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `data_aset`
--
ALTER TABLE `data_aset`
  MODIFY `id_aset` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `keputusan_pengadaan`
--
ALTER TABLE `keputusan_pengadaan`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kriteria_kualitas`
--
ALTER TABLE `kriteria_kualitas`
  MODIFY `id_kualitas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kriteria_spesifikasi`
--
ALTER TABLE `kriteria_spesifikasi`
  MODIFY `id_spesifikasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `lokasi_aset`
--
ALTER TABLE `lokasi_aset`
  MODIFY `id_lokasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `monitoring_aset`
--
ALTER TABLE `monitoring_aset`
  MODIFY `id_monitoring` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id_pengadaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `penghapusan`
--
ALTER TABLE `penghapusan`
  MODIFY `id_penghapusan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `asets`
--
ALTER TABLE `asets`
  ADD CONSTRAINT `asets_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asets_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_aset` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keputusan_pengadaan`
--
ALTER TABLE `keputusan_pengadaan`
  ADD CONSTRAINT `keputusan_pengadaan_ibfk_1` FOREIGN KEY (`id_spesifikasi`) REFERENCES `kriteria_spesifikasi` (`id_spesifikasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keputusan_pengadaan_ibfk_2` FOREIGN KEY (`id_kualitas`) REFERENCES `kriteria_kualitas` (`id_kualitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keputusan_pengadaan_ibfk_3` FOREIGN KEY (`id_aset`) REFERENCES `data_aset` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `monitoring_aset`
--
ALTER TABLE `monitoring_aset`
  ADD CONSTRAINT `monitoring_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD CONSTRAINT `pengadaan_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_aset` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengadaan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penghapusan`
--
ALTER TABLE `penghapusan`
  ADD CONSTRAINT `penghapusan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
