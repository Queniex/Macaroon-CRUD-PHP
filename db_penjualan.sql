-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Des 2022 pada 02.09
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `harga_barang` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`) VALUES
(1, 'Bundle 1', 18000),
(2, 'Bundle 2', 17000),
(3, 'Bundle 3', 20000),
(4, 'Bundle 4', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rusialdi`
--

CREATE TABLE `rusialdi` (
  `id_nama` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `jenis_barang` varchar(25) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `tgl_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rusialdi`
--

INSERT INTO `rusialdi` (`id_nama`, `nama`, `alamat`, `hp`, `jenis_barang`, `id_barang`, `harga`, `jumlah`, `tgl_transaksi`) VALUES
(11, 'Salbiyah Quenie', 'Jl. Pluto Mungiel', '12345667', 'makanan', 3, 20000, 6, '2022-11-22'),
(13, 'Starcious Lilianax', 'Jl. Bintang Kecil', '123456899', 'makanan', 3, 18000, 9, '2022-11-22'),
(14, 'Nicholas Sander', 'Jl. Uranus Stracium', '12345433', 'makanan', 4, 18000, 5, '2022-11-22'),
(16, 'Kyouza x', 'Jl. Saturnus pelita', '123543534', 'makanan', 3, 20000, 3, '2022-11-22'),
(17, 'Anonymous 2', 'Secret Abis', '134246436', 'makanan', 1, 18000, 3, '2022-12-05'),
(24, 'Quenie Salbiyah', 'Jalan Saturnus Happy', '0811233424', 'makanan', 1, 18000, 4, '2022-12-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$ufMmhxTxSY2NySj5xu6zq.F7oqK/fedn.kRFLRstm0tAtxYNiSp3O'),
(2, 'testing', '$2y$10$mhScs5695ETs/BbqJNavMOW1AkdPwDFF2OEBQuv/ZkBHf8ywjv9Hy');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `rusialdi`
--
ALTER TABLE `rusialdi`
  ADD PRIMARY KEY (`id_nama`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rusialdi`
--
ALTER TABLE `rusialdi`
  MODIFY `id_nama` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
