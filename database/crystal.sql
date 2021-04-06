-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Apr 2021 pada 12.30
-- Versi server: 8.0.23-0ubuntu0.20.04.1
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crystal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `content`
--

CREATE TABLE `content` (
  `id` tinyint NOT NULL,
  `nama` varchar(30) NOT NULL,
  `deskripsi_pendek` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `logo` varchar(30) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `tahun_rilis` year NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB;

--
-- Dumping data untuk tabel `content`
--

INSERT INTO `content` (`id`, `nama`, `deskripsi_pendek`, `deskripsi`, `email`, `notelp`, `no_hp`, `logo`, `favicon`, `tahun_rilis`, `updated_at`) VALUES
(1, 'Crytal Dev', 'Web Admin Starter Kit v0.4', 'Web Admin Starter Kit v0.4', 'crystal@flexfy.my.id', NULL, NULL, 'logo-606be8ec1f58b.png', 'favicon-606be845c2a9f.svg', 2020, '2021-04-06 11:51:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` tinyint UNSIGNED NOT NULL,
  `label` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `parent` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `position` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `label`, `url`, `icon`, `parent`, `position`, `deleted_at`) VALUES
(1, 'Settings', '#settings', 'fa fa-gear', 0, 2, NULL),
(2, 'Users / Admin', 'settings/users/', 'fa fa-users', 1, 1, NULL),
(3, 'Dashboard', '/', 'fa fa-tachometer', 0, 1, NULL),
(4, 'User Privileges', 'settings/privilege/', 'fa fa-lock', 1, 3, NULL),
(5, 'Menu Manager', 'settings/menu/', 'fa fa-align-justify', 1, 4, NULL),
(7, 'Role', 'settings/role/', 'fa fa-users', 1, 2, NULL),
(8, 'Module', 'settings/module/', 'fa fa-folder', 7, 1, '2021-04-05 07:59:43'),
(12, 'Access', 'settings/access/', 'fa fa-folder-open', 1, 6, '2021-04-05 08:03:11'),
(13, 'Content', 'settings/content/', 'fa fa-rss-square', 1, 5, NULL),
(15, 'Notification Label', 'settings/notification_label/', 'fa fa-check-square', 1, 6, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
--

CREATE TABLE `notification` (
  `id` int UNSIGNED NOT NULL,
  `users` int UNSIGNED NOT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `pesan` varchar(255) NOT NULL,
  `foto` varchar(30) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `label` tinyint UNSIGNED NOT NULL,
  `status` enum('seen','unseen') NOT NULL DEFAULT 'unseen',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `requested_at` datetime DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `notification`
--

INSERT INTO `notification` (`id`, `users`, `judul`, `pesan`, `foto`, `url`, `label`, `status`, `created_at`, `requested_at`) VALUES
(1, 1, 'Kehadiran Pegawai', 'kehadiran pegawai seakrang terus meningkat!!', NULL, NULL, 1, 'seen', '2021-03-24 08:30:03', '2021-03-25 09:18:57'),
(2, 1, 'Laporan', 'Ada maling di kampung sebelah', NULL, NULL, 2, 'seen', '2021-03-24 10:04:20', '2021-03-25 09:19:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification_label`
--

CREATE TABLE `notification_label` (
  `id` tinyint UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `color` varchar(20) NOT NULL DEFAULT 'primary',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `notification_label`
--

INSERT INTO `notification_label` (`id`, `nama`, `icon`, `color`, `created_at`, `deleted_at`) VALUES
(1, 'General', 'nlabel-605dadc1599eb.png', 'primary', '2021-03-24 13:54:47', NULL),
(2, 'Important', 'important.png', 'danger', '2021-03-24 13:54:47', NULL),
(3, 'New', 'nlabel-606bf0e30a09f.png', 'info', '2021-03-26 15:29:49', NULL),
(4, 'New 2', 'nlabel-606bed40d4824.jpg', 'default', '2021-04-06 12:10:24', '2021-04-06 12:26:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission`
--

CREATE TABLE `permission` (
  `id` mediumint UNSIGNED NOT NULL,
  `role` tinyint UNSIGNED NOT NULL,
  `module` tinyint UNSIGNED NOT NULL,
  `access` varchar(10) NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `permission`
--

INSERT INTO `permission` (`id`, `role`, `module`, `access`) VALUES
(57, 3, 2, 'option1'),
(62, 3, 3, 'EXPORT'),
(63, 3, 3, 'DELETE'),
(64, 3, 1, 'VIEW'),
(65, 3, 3, 'VIEW'),
(66, 2, 2, 'VIEW'),
(67, 2, 3, 'VIEW'),
(69, 2, 7, 'VIEW'),
(70, 2, 4, 'VIEW'),
(72, 2, 1, 'VIEW'),
(73, 3, 7, 'ADD'),
(74, 3, 7, 'EDIT'),
(75, 3, 4, 'DELETE'),
(76, 3, 5, 'DELETE'),
(77, 3, 5, 'EDIT'),
(78, 3, 13, 'EDIT'),
(79, 3, 13, 'ADD'),
(80, 3, 13, 'VIEW'),
(81, 2, 2, 'ADD'),
(82, 2, 3, 'ADD'),
(83, 2, 4, 'ADD'),
(84, 2, 1, 'ADD'),
(85, 2, 7, 'ADD'),
(86, 2, 5, 'VIEW'),
(87, 2, 13, 'VIEW'),
(88, 2, 15, 'VIEW'),
(89, 2, 5, 'ADD'),
(90, 2, 13, 'ADD'),
(91, 2, 15, 'ADD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` tinyint UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama`, `deleted_at`) VALUES
(1, 'Superadmin', NULL),
(2, 'Admin', NULL),
(3, 'Guest', NULL),
(4, 'Guse', '2021-04-04 18:57:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` tinyint UNSIGNED NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `foto`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Taufik Maulana', NULL, '', 'users-606978854a4e9.jpg', 'superadmin', 'taufikm9977@gmail.com', 1, '880d5b05cc01fac8261f9e84406e6c02dfe187d8', '2021-03-15 19:48:05', '2021-04-04 15:27:49', NULL),
(2, 'Rahmi Chairani', NULL, '', 'users-606978f06d7f5.jpg', 'rahmicr', 'rahmrchairani@gmail.com', 2, '18e40e1401eef67e1ae69efab09afb71f87ffb81', '2021-03-15 22:23:55', '2021-04-04 15:29:36', NULL),
(3, 'Mara Mawardien', NULL, NULL, NULL, 'maramawardien', 'maramawardien@gmail.com', 1, '18e40e1401eef67e1ae69efab09afb71f87ffb81', '2021-03-15 22:29:43', NULL, '2021-03-16 11:37:07'),
(4, 'Taufik', NULL, '', 'users-606b1dbd5227a.jpg', 'samsuls', 'taufikmaulana003@gmail.com', 3, 'df6bbf9c0d74a1f16c607dde25ad65c03c519428', '2021-03-15 22:30:48', '2021-04-05 21:25:01', NULL),
(6, 'Dokie', '1997-01-29', 'L', 'users-606b1dae9e0c3.jpg', 'dokie123', 'dokie@gmail.com', 2, '880d5b05cc01fac8261f9e84406e6c02dfe187d8', '2021-03-24 12:10:46', '2021-04-05 21:24:46', NULL),
(7, 'Andhika', NULL, '', 'users-606978539d88f.jpg', 'andhika', 'andhika@flexfy.my.id', 3, '880d5b05cc01fac8261f9e84406e6c02dfe187d8', '2021-04-04 13:14:40', '2021-04-04 15:26:59', NULL),
(8, 'Mara Mawardien', '2021-04-09', 'L', 'users-6069778eb1e67.jpg', 'maramawardien2', 'maramawardien@gmail.com', 3, '880d5b05cc01fac8261f9e84406e6c02dfe187d8', '2021-04-04 13:26:23', '2021-04-04 15:25:54', NULL),
(9, '2312312312', NULL, 'L', 'image-606963bc82bda.jpg', '123123', '123123@asda.sds', 1, '7c222fb2927d828af22f592134e8932480637c0d', '2021-04-04 13:59:08', NULL, '2021-04-04 15:33:03'),
(10, 'Falahudan Akbar', '0000-00-00', 'P', 'user-606965e04b8aa.jpg', 'flahudan', 'flahudan@gmail.com', 3, '880d5b05cc01fac8261f9e84406e6c02dfe187d8', '2021-04-04 14:08:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_keys`
--

CREATE TABLE `users_keys` (
  `id` int UNSIGNED NOT NULL,
  `users` int UNSIGNED NOT NULL,
  `ip_address` varchar(30) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(50) NOT NULL,
  `token2` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_access` datetime DEFAULT NULL,
  `firebase_token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `users_keys`
--

INSERT INTO `users_keys` (`id`, `users`, `ip_address`, `user_agent`, `token`, `token2`, `last_login`, `last_access`, `firebase_token`) VALUES
(9, 1, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36', 'aa2e7af904203d26edb53148be3491ebb9142847', '06fb7feb2335915d73ec6f12911bfecde03e7fc2', '2021-04-06 10:08:54', '2021-04-06 10:08:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `verify`
--

CREATE TABLE `verify` (
  `id` smallint UNSIGNED NOT NULL,
  `users` int UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `status` enum('Avaliable','Expired') NOT NULL DEFAULT 'Avaliable',
  `expired_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `verify`
--

INSERT INTO `verify` (`id`, `users`, `token`, `ip_address`, `user_agent`, `status`, `expired_at`, `created_at`) VALUES
(5, 4, '6A31189E1DF44722D2C603D2D01F37F817F53D5E', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36', 'Expired', '2021-03-24 10:57:46', '2021-03-23 23:06:15'),
(6, 1, 'A38A9B5F58A3918994FA6646B4EC1838AFF7875E', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36', 'Avaliable', '2021-03-24 13:23:00', '2021-03-24 08:34:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `label` (`label`),
  ADD KEY `users` (`users`);

--
-- Indeks untuk tabel `notification_label`
--
ALTER TABLE `notification_label`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `module` (`module`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `users_keys`
--
ALTER TABLE `users_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users` (`users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `content`
--
ALTER TABLE `content`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `notification_label`
--
ALTER TABLE `notification_label`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `permission`
--
ALTER TABLE `permission`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users_keys`
--
ALTER TABLE `users_keys`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `verify`
--
ALTER TABLE `verify`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`label`) REFERENCES `notification_label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_2` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `permission_ibfk_3` FOREIGN KEY (`module`) REFERENCES `menu` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `verify_ibfk_1` FOREIGN KEY (`users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
