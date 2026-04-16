-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2025 pada 04.11
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
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) UNSIGNED NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `halaman` int(5) NOT NULL,
  `ringkasan` text NOT NULL,
  `id_penulis` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `id_penerbit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `isbn`, `tahun_terbit`, `halaman`, `ringkasan`, `id_penulis`, `id_kategori`, `id_penerbit`) VALUES
(10, 'Buku Social Sciences Madilog Tan Malaka: Materialisme Dialektika&Logika', 'ISBN 9786025792403', '2024', 564, 'Buku Madilog karya Tan Malaka adalah ringkasan filsafat materialisme, dialektika, dan logika yang bertujuan membebaskan bangsa dari pola pikir mistik dan irasional menuju pemikiran ilmiah dan kritis. Buku ini menganalisis pemikiran umum dengan dasar materialisme, yaitu realitas nyata sebagai pijakan, dialektika untuk memahami perubahan, dan logika sebagai metode berpikir, sehingga bangsa dapat maju dan merdeka secara intelektual. ', 9, 6, 5),
(11, 'Seorang Wanita yang Ingin Menjadi Pohon Semangka di Kehidupan Berikutnya', '978-602-06-8127-6', '2025', 224, '“Buku ini seperti teman yang memahami luka-luka terdalam tanpa banyak bicara—mengajak kita merenungi penyesalan, berdamai dengan masa lalu, dan membayangkan harapan baru, untuk bisa menjadi sesuatu yang lebih sederhana seperti pohon semangka di kehidupan berikutnya.” —Naela Ali, Penulis\r\n\r\nJawab dengan cepat: Seandainya terlahir kembali di kehidupan berikutnya, kamu ingin menjadi apa? Berikut beberapa jawaban unik yang pernah kudengar baik dalam ruang praktik maupun ketika ngobrol santai dengan teman-teman:\r\n\r\n“Aku ingin menjadi ubur-ubur, melayang bebas tanpa tekanan atasan dan ekspektasi sosial.”\r\n\r\n“Aku ingin menjadi pohon pinus, karena tinggi dan keren.”\r\n\r\n“Aku ingin menjadi ikan mas koki. Katanya memorinya cuma bertahan lima detik, jadi aku tidak akan overthinking.”\r\n\r\nSuatu hari, seorang pasien perempuan mengatakan bahwa ia ingin terlahir kembali menjadi bunga matahari. Terdengar sangat indah, ya? Tapi, di sesi berikutnya, dia merevisi pendapatnya. “Aku ingin menjadi pohon semangka di kehidupan berikutnya.” Kehidupan seperti apa yang dia alami sampai berpikir lebih baik menjadi pohon semangka?\r\n\r\nIni adalah buku tentang kekecewaan, penyesalan, dan ketidaksempurnaan. Buku ini cocok untuk kalian yang sering dituduh kurang bersyukur, yang suka duduk di kursi minimarket di akhir hari, yang ingin belajar menanam bunga matahari, dan tentunya yang masih mencari arti dari kata kebahagiaan.', 10, 7, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(5, 'cerita horor'),
(6, 'Filsafat '),
(7, 'Self-Improvement');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(10) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`) VALUES
(5, 'PT Graha', 'kambangsari'),
(6, 'Gramedia', 'Gedung Kompas Gramedia Blok 1/lantai 3, Jl. Palmerah Barat No. 29-37, Jakarta, 10270'),
(7, 'Penerbit NARASI', 'Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(10) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL,
  `biodata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`, `biodata`) VALUES
(7, 'aida sari', 'panjer'),
(8, 'ramawati', 'kedungwinangun'),
(9, 'Tan Malaka', 'Tan Malaka adalah seorang negarawan, guru, pahlawan nasional, dan filsuf Indonesia berhaluan Marxisme yang lahir pada 2 Juni 1897 di Nagari Pandan Gadang, Sumatera Barat, dan meninggal pada 21 Februari 1949\r\n. Dikenal sebagai \"Bapak Republik Indonesia\" karena gagasannya yangvisioner, ia merupakan pendiri Partai Murba dan Persatuan Perjuangan. Ia juga dikenal sebagai pejuang kemerdekaan yang gigih, termasuk dengan ideologi revolusi bersenjata, dan memiliki peran penting dalam pergerakan kiri baik di dalam maupun luar negeri. '),
(10, 'dr. Andreas Kurniawan, Sp.KJ', '\r\n\r\ndr. Andreas Kurniawan, Sp.KJ adalah seorang psikiater lulusan Universitas Indonesia yang cukup mudah dikenali dengan rambutnya yang gondrong, telinga ditindik, dan obsesinya pada Doraemon. Di media sosialnya, dia menampilkan persona sebagai \"psikiater yang suka bercanda\".\r\n\r\nBuku pertamanya sebagai psikiater, Seorang Pria yang Melalui Duka dengan Mencuci Piring, meraih IKAPI Awards 2024 kategori Book of the Year.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_penulis` (`id_penulis`),
  ADD KEY `id_kategori` (`id_kategori`,`id_penerbit`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
