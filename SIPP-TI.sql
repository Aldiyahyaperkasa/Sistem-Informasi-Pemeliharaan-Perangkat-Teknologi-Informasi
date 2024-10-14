-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2024 pada 05.37
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aku_coba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_pemeliharaan`
--

CREATE TABLE `jadwal_pemeliharaan` (
  `id_jadwal` int(11) UNSIGNED NOT NULL,
  `perangkat_idaa` int(11) UNSIGNED NOT NULL,
  `department` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jadwal_pemeliharaan`
--

INSERT INTO `jadwal_pemeliharaan` (`id_jadwal`, `perangkat_idaa`, `department`, `tanggal_mulai`, `tanggal_selesai`, `status`, `user_id`, `updated_by`) VALUES
(9, 0, 'sodkqw', '2024-10-10', '2024-10-24', 'Terjadwal', 1, NULL),
(10, 0, 'IT', '2024-10-12', '2024-10-24', 'Terjadwal', 1, NULL),
(11, 0, 'aposdj', '2024-10-07', '2024-10-21', 'Terjadwal', 5, NULL),
(12, 0, 'IT', '2024-10-02', '2024-10-30', 'Terjadwal', 1, NULL),
(13, 0, 'HRD', '2024-10-10', '2024-10-29', 'Terjadwal', 1, NULL),
(14, 0, 'HRD', '2024-10-07', '2024-10-30', 'Terjadwal', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_qr`
--

CREATE TABLE `kode_qr` (
  `id_qr` int(11) UNSIGNED NOT NULL,
  `id_perangkat` int(11) UNSIGNED NOT NULL,
  `kode_qr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kode_qr`
--

INSERT INTO `kode_qr` (`id_qr`, `id_perangkat`, `kode_qr`) VALUES
(1, 1, 'QR-66c40bd7e76df-1'),
(2, 3, 'QR-66c560560f7bf-3'),
(9, 2, 'QR-66d7fb5532477-2'),
(10, 4, 'QR-66d80a06455ef-4'),
(11, 6, 'QR-66d80eaca4bd9-6'),
(12, 5, 'QR-66d80eb71e6d2-5'),
(13, 8, 'QR-66e1c1b558b0e-8'),
(14, 12, 'QR-66fe845a49431-12'),
(15, 16, 'QR-67035840d4e87-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(17, '2024-07-31-114455', 'App\\Database\\Migrations\\MigrationPengguna', 'default', 'App', 1724123959, 1),
(18, '2024-07-31-114615', 'App\\Database\\Migrations\\MigrationPerangkat', 'default', 'App', 1724123959, 1),
(19, '2024-07-31-114728', 'App\\Database\\Migrations\\MigrationKodeQr', 'default', 'App', 1724123959, 1),
(20, '2024-08-13-062942', 'App\\Database\\Migrations\\MigrationPemeliharaan', 'default', 'App', 1724123959, 1),
(21, '2024-08-14-040706', 'App\\Database\\Migrations\\MigrationRiwayatPemeliharaan', 'default', 'App', 1724123959, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Teknisi','Manajer') NOT NULL DEFAULT 'Teknisi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$5IoCFIOS63PzjspQZNLgoOTsbaekvIpwENmDFgxfxPgj2lAbYBQF.', 'Admin'),
(2, 'teknisi', '$2y$10$NWJGN4zxuENI.tEBboDnKex/knC6kIIOInNW8t61HhFNEJgF0Gtba', 'Teknisi'),
(3, 'manajer', '$2y$10$7bYqMeZLJQmpLGeXMdtHBe1sNkQqtET8Q2X1p9EZHZ8SDvjpq2Lay', 'Manajer'),
(5, 'yahya', '$2y$10$G.cobMyRvQn.AkpbXDJ5fOhcBWB.mQDhNJOxv2TMWskGU6PANGg1W', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perangkat`
--

CREATE TABLE `perangkat` (
  `id_perangkat` int(11) UNSIGNED NOT NULL,
  `nama_perangkat` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `tipe_perangkat` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `perangkat`
--

INSERT INTO `perangkat` (`id_perangkat`, `nama_perangkat`, `department`, `tipe_perangkat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PC ALDI', 'IT', 'PC', 'active', NULL, NULL),
(2, 'PC SAYA', 'KEUANGAN', 'PC', 'active', NULL, NULL),
(3, 'PRINTER MANAJER IT', 'IT', 'PRINTER', 'active', NULL, NULL),
(4, 'PC Manajer IT', 'IT', 'PC', 'active', NULL, NULL),
(5, 'PC MANAJER KEUANGAN', 'KEUANGAN', 'PC', 'active', NULL, NULL),
(6, 'ajayakan', 'idh', 'sdhfus', '', NULL, NULL),
(7, 'aksdbab', 'qjwdjqwipdj', 'kawhed', 'active', NULL, NULL),
(8, 'a;ksd', 'apkdowj', 'sdfn', '', NULL, NULL),
(9, 'lawjid', 'sodkqw', 'sdkcn', 'active', NULL, NULL),
(10, 'qoiwed', 'jdscn', 'zx,mcnasi', '', NULL, NULL),
(11, 'pwqk', 'laksmdiwq', 'dojfioejfn', 'active', NULL, NULL),
(12, 'pwqk', 'laksmdiwq', 'dojfioejfn', 'active', NULL, NULL),
(13, 'qlwij', 'aiuhd`a', 'zncs', '', NULL, NULL),
(14, 'qlwdj', 'aposdj', 'vavavavav', 'active', NULL, NULL),
(15, 'yahya', 'HRD', 'PC', 'active', NULL, NULL),
(16, 'ali', 'HRD', 'laptop', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pemeliharaan`
--

CREATE TABLE `riwayat_pemeliharaan` (
  `id_riwayat` int(11) UNSIGNED NOT NULL,
  `jadwal_id` int(11) UNSIGNED NOT NULL,
  `perangkat_id` int(11) UNSIGNED NOT NULL,
  `tanggal_pemeliharaan` date NOT NULL,
  `hasil` text NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `riwayat_pemeliharaan`
--

INSERT INTO `riwayat_pemeliharaan` (`id_riwayat`, `jadwal_id`, `perangkat_id`, `tanggal_pemeliharaan`, `hasil`, `keterangan`, `user_id`, `created_at`, `updated_at`) VALUES
(14, 0, 1, '2024-10-06', 'aks', 'ksadhwq\r\n', 2, NULL, NULL),
(15, 0, 16, '2024-10-07', 'selesai', 'selesai', 2, NULL, NULL),
(16, 0, 16, '2024-10-07', 'isi', 'isi', 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jadwal_pemeliharaan`
--
ALTER TABLE `jadwal_pemeliharaan`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `kode_qr`
--
ALTER TABLE `kode_qr`
  ADD PRIMARY KEY (`id_qr`),
  ADD KEY `kode_qr_id_perangkat_foreign` (`id_perangkat`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `perangkat`
--
ALTER TABLE `perangkat`
  ADD PRIMARY KEY (`id_perangkat`);

--
-- Indeks untuk tabel `riwayat_pemeliharaan`
--
ALTER TABLE `riwayat_pemeliharaan`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `riwayat_pemeliharaan_perangkat_id_foreign` (`perangkat_id`),
  ADD KEY `jadwal_id` (`jadwal_id`),
  ADD KEY `fk_user_riwayat` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_pemeliharaan`
--
ALTER TABLE `jadwal_pemeliharaan`
  MODIFY `id_jadwal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kode_qr`
--
ALTER TABLE `kode_qr`
  MODIFY `id_qr` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `perangkat`
--
ALTER TABLE `perangkat`
  MODIFY `id_perangkat` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pemeliharaan`
--
ALTER TABLE `riwayat_pemeliharaan`
  MODIFY `id_riwayat` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_pemeliharaan`
--
ALTER TABLE `jadwal_pemeliharaan`
  ADD CONSTRAINT `jadwal_pemeliharaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `kode_qr`
--
ALTER TABLE `kode_qr`
  ADD CONSTRAINT `kode_qr_id_perangkat_foreign` FOREIGN KEY (`id_perangkat`) REFERENCES `perangkat` (`id_perangkat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_pemeliharaan`
--
ALTER TABLE `riwayat_pemeliharaan`
  ADD CONSTRAINT `fk_user_riwayat` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id_user`),
  ADD CONSTRAINT `riwayat_pemeliharaan_perangkat_id_foreign` FOREIGN KEY (`perangkat_id`) REFERENCES `perangkat` (`id_perangkat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
