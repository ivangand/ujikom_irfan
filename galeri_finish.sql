-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2024 pada 17.51
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`id_album`, `nama_album`, `deskripsi`, `tanggal_dibuat`, `user_id`) VALUES
(55, 'Cewek', 'cewek cewek cantik', '2024-11-07 16:00:12', NULL),
(56, 'Cowok', 'album cowok ganteng', '2024-11-07 16:33:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `album_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`id_foto`, `album_id`, `file_path`) VALUES
(18, 55, 'uploads/foto_672ce41e5ee615.77337021.jpg'),
(19, 55, 'uploads/foto_672ce4344b3959.61881466.jpeg'),
(20, 55, 'uploads/foto_672cec42e7bc44.78330859.jpeg'),
(21, 56, 'uploads/foto_672cec9d525755.49839034.jpeg'),
(22, 56, 'uploads/foto_672cecd42fc643.95464753.jpg'),
(23, 56, 'uploads/foto_672ced153748a3.27960102.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal_komentar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `photo_id`, `user_id`, `komentar`, `tanggal_komentar`) VALUES
(55, 69, 11, 'Keren banget gila', '2024-11-07 16:07:49'),
(56, 70, 11, 'Gemes banget gila', '2024-11-07 16:08:00'),
(57, 69, 11, 'Kelas', '2024-11-07 16:08:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likee`
--

CREATE TABLE `likee` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `likee`
--

INSERT INTO `likee` (`id`, `photo_id`, `user_id`, `liked_at`) VALUES
(128, 69, 12, '2024-11-07 16:09:40'),
(129, 70, 12, '2024-11-07 16:09:54'),
(130, 70, 11, '2024-11-07 16:31:47'),
(131, 69, 11, '2024-11-07 16:31:48'),
(135, 70, 8, '2024-11-07 16:46:49'),
(136, 69, 8, '2024-11-07 16:46:50'),
(137, 70, 13, '2024-11-07 16:49:30'),
(138, 69, 13, '2024-11-07 16:49:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_upload` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `photo`
--

INSERT INTO `photo` (`id`, `userid`, `judul`, `deskripsi`, `gambar`, `tanggal_upload`) VALUES
(69, 11, 'First Galeri', 'Galeri pertama saya', 'mlbb.jpg', '2024-11-07 00:00:00'),
(70, 11, 'Two Galeri', 'Galeri kedua saya', 'mbb2.avif', '2024-11-07 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp(),
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `tanggal_bergabung` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `tanggal_daftar`, `jenis_kelamin`, `tanggal_bergabung`) VALUES
(8, 'irfan', '$2y$10$WrtBEPx6snMKw6YRYlG7qeHVW9Wlk4wvgHBQwxWqd/HH/wscFV9tO', 'irfan@gmai.com', 'Irfan Ganendra', 'Indonesia', '2024-11-06 13:16:23', 'Laki-laki', '2024-11-06 20:16:23'),
(10, 'vann', '$2y$10$H/AHvM2qhgv39WNsQkISOe0AuJSyVi0vzih.gQaGIRxL2Nu1/UHz6', 'ganendra2408@gmail.com', 'Irfan Ganendra', 'Indonesia', '2024-11-07 11:56:37', 'Laki-laki', '2024-11-07 18:56:37'),
(11, 'tanto', '$2y$10$TtxElesbwTC55Krplxq91.ALjkgHFOnBvrCQhJZ/w0RAIJqd7DazK', 'ristanto@gmail.com', 'Rystanto', 'Indonesia', '2024-11-07 12:04:59', 'Laki-laki', '2024-11-07 19:04:59'),
(12, 'rizla', '$2y$10$ejz6T..luU8umfJ5e8hUgeQ2LFYY7TEUQmJS2eGkMn/hYJ55hoeaK', 'rizla@gmail.com', 'Rizla Aulia Aditya', 'Indonesia', '2024-11-07 12:09:05', 'Laki-laki', '2024-11-07 19:09:05'),
(13, 'bayu', '$2y$10$8dQt8Qci8m44y5Sl14DLSulZrDHetwaO0fVkE6cqgJrvX8qAymhMO', 'bayugemes@gmail.com', 'Bayu Firdaus', 'Indonesia', '2024-11-07 16:49:15', 'Laki-laki', '2024-11-07 23:49:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `album_id` (`album_id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `likee`
--
ALTER TABLE `likee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `likee`
--
ALTER TABLE `likee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id_album`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`);

--
-- Ketidakleluasaan untuk tabel `likee`
--
ALTER TABLE `likee`
  ADD CONSTRAINT `likee_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likee_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
