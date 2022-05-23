-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 11 Jul 2021 pada 09.52
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ANGGOTA`
--

CREATE TABLE `ANGGOTA` (
  `id_anggota` char(8) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `nomor_telpon` char(13) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_bergabung` datetime NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ANGGOTA`
--

INSERT INTO `ANGGOTA` (`id_anggota`, `nama_anggota`, `nomor_telpon`, `jenis_kelamin`, `tanggal_bergabung`, `alamat`) VALUES
('IN1KXGZV', 'Devi FItriana', '098123123123', 'P', '2021-06-24 08:37:56', 'Jl. Sekar Arum, Jatimulyo, Kota Malang'),
('OAQYVXI1', 'Samsudin', '08989898989', 'L', '2021-06-25 08:49:41', 'Jl. Terusaja, Belok kanan, Gang mawar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `BUKU`
--

CREATE TABLE `BUKU` (
  `id_buku` char(5) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `id_kategori` char(5) NOT NULL,
  `id_penerbit` char(5) NOT NULL,
  `id_pengarang` char(5) NOT NULL,
  `id_rak` char(5) NOT NULL,
  `jumlah_halaman` int(11) NOT NULL,
  `tahun_cetakan` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `BUKU`
--

INSERT INTO `BUKU` (`id_buku`, `nama_buku`, `id_kategori`, `id_penerbit`, `id_pengarang`, `id_rak`, `jumlah_halaman`, `tahun_cetakan`, `gambar`) VALUES
('5XQMO', 'Romance Stories', '19AK3', 'J2S19', 'S18AJ', 'U8H19', 320, 2018, '1616379810_177f6bc2ac83d1911359.jpg'),
('CTEF7', 'Diginitate', '19AK3', 'KAQZS', 'F5W9M', 'U8H19', 332, 2020, '1625712459_2b69791609f9bf5b6a3a.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `DENDA`
--

CREATE TABLE `DENDA` (
  `id_denda` char(5) NOT NULL,
  `status_bayar` enum('LUNAS','BELUM LUNAS') NOT NULL,
  `banyak_buku` int(11) NOT NULL,
  `total_denda` bigint(20) NOT NULL,
  `total_bayar` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `DENDA`
--

INSERT INTO `DENDA` (`id_denda`, `status_bayar`, `banyak_buku`, `total_denda`, `total_bayar`) VALUES
('CQIDU', 'LUNAS', 3, 12000, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `DETAIL_PEMINJAMAN`
--

CREATE TABLE `DETAIL_PEMINJAMAN` (
  `id_transaksi` char(12) NOT NULL,
  `id_buku` char(5) NOT NULL,
  `banyak_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `DETAIL_PEMINJAMAN`
--

INSERT INTO `DETAIL_PEMINJAMAN` (`id_transaksi`, `id_buku`, `banyak_buku`) VALUES
('PY7AJXU5MHZ9', '5XQMO', 2),
('PY7AJXU5MHZ9', 'CTEF7', 1),
('NP5TAXF7VTY9', 'CTEF7', 2),
('NP5TAXF7VTY9', '5XQMO', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `DETAIL_PENGEMBALIAN`
--

CREATE TABLE `DETAIL_PENGEMBALIAN` (
  `id_transaksi` char(12) NOT NULL,
  `id_buku` char(5) NOT NULL,
  `banyak_buku_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `DETAIL_PENGEMBALIAN`
--

INSERT INTO `DETAIL_PENGEMBALIAN` (`id_transaksi`, `id_buku`, `banyak_buku_kembali`) VALUES
('PY7AJXU5MHZ9', '5XQMO', 2),
('PY7AJXU5MHZ9', 'CTEF7', 1),
('NP5TAXF7VTY9', 'CTEF7', 0),
('NP5TAXF7VTY9', '5XQMO', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `KATEGORI_BUKU`
--

CREATE TABLE `KATEGORI_BUKU` (
  `id_kategori` char(5) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `KATEGORI_BUKU`
--

INSERT INTO `KATEGORI_BUKU` (`id_kategori`, `nama_kategori`) VALUES
('19AK3', 'ROMANCE'),
('3MJIT', 'FINANCIAL'),
('8DJ2J', 'HORROR'),
('AXLS5', 'MATHEMATICS'),
('FIZ4B', 'TRAVEL'),
('IWZ6U', 'COMICS'),
('YLX3E', 'EDUCATION');

-- --------------------------------------------------------

--
-- Struktur dari tabel `PEGAWAI`
--

CREATE TABLE `PEGAWAI` (
  `id_pegawai` char(8) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `nomor_telpon` char(13) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `PEGAWAI`
--

INSERT INTO `PEGAWAI` (`id_pegawai`, `nama_pegawai`, `nomor_telpon`, `jenis_kelamin`, `alamat`) VALUES
('S89AK2K1', 'Muhammad Djaja Suparmans', '082726372617', 'L', '        Jl. Anggrek, Kec. Wagir, Kab. Malang, Jawa Timur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `PENERBIT`
--

CREATE TABLE `PENERBIT` (
  `id_penerbit` char(5) NOT NULL,
  `nama_penerbit` varchar(25) NOT NULL,
  `telp_penerbit` char(13) NOT NULL,
  `alamat_penerbit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `PENERBIT`
--

INSERT INTO `PENERBIT` (`id_penerbit`, `nama_penerbit`, `telp_penerbit`, `alamat_penerbit`) VALUES
('07HWW', 'LASKAR PELANGI', '089234234234', 'Jl. Songgoriti, Kota Batu, Malang'),
('EFPSL', 'RAJAWALI', '089345345345', 'Jl. Sukowati, Sukowati, Bali'),
('IEZRD', 'MAHAMERU PRESS', '089098098098', 'Jl. Sinangkir, Klakah, Pasuruan'),
('J2S19', 'BINTANG GEMILANG', '082773827182', 'jL. Surabaya, Lowokwaru, Kota Malang'),
('KAQZS', 'JAYA ABADI', '0887726716172', 'Jl. Aspal, Blok B, No. 32, Kota Surabaya'),
('RAIZC', 'GRAMEDIA', '089123123123', 'Jl. Mentok kiri, belok kanan, Kota Malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `PENGARANG`
--

CREATE TABLE `PENGARANG` (
  `id_pengarang` char(5) NOT NULL,
  `nama_pengarang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `PENGARANG`
--

INSERT INTO `PENGARANG` (`id_pengarang`, `nama_pengarang`) VALUES
('07IKQ', 'SANJAYA'),
('6HU1O', 'SAMSUDIN'),
('F5W9M', 'JANARKO'),
('F7OYR', 'UMI KULSUM'),
('FQYWE', 'JOKOBODO'),
('GAE9S', 'BOPAK'),
('JDOLN', 'ANDRE'),
('KHXWB', 'SULE'),
('S18AJ', 'DELI SUSANTO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `RAK_BUKU`
--

CREATE TABLE `RAK_BUKU` (
  `id_rak` char(5) NOT NULL,
  `nomor_rak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `RAK_BUKU`
--

INSERT INTO `RAK_BUKU` (`id_rak`, `nomor_rak`) VALUES
('0DGV9', 5),
('8K1N2', 2),
('DHSU7', 3),
('U8H19', 1),
('UH547', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `TRANSAKSI`
--

CREATE TABLE `TRANSAKSI` (
  `id_transaksi` char(12) NOT NULL,
  `tanggal_peminjaman` datetime NOT NULL,
  `tanggal_harus_kembali` datetime NOT NULL,
  `status` enum('SELESAI','PROGRESS','DENDA') NOT NULL,
  `id_anggota` char(8) NOT NULL,
  `id_pegawai` char(8) NOT NULL,
  `id_denda` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `TRANSAKSI`
--

INSERT INTO `TRANSAKSI` (`id_transaksi`, `tanggal_peminjaman`, `tanggal_harus_kembali`, `status`, `id_anggota`, `id_pegawai`, `id_denda`) VALUES
('NP5TAXF7VTY9', '2021-07-06 11:08:09', '2021-07-06 08:56:30', 'PROGRESS', 'IN1KXGZV', '9K12KK2J', NULL),
('PY7AJXU5MHZ9', '2021-06-29 08:37:59', '2021-07-06 08:37:59', 'SELESAI', 'IN1KXGZV', '9K12KK2J', 'CQIDU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `USER`
--

CREATE TABLE `USER` (
  `id_user` char(8) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('admin','pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `USER`
--

INSERT INTO `USER` (`id_user`, `username`, `password`, `level`) VALUES
('9K12KK2J', 'admin', '$2y$10$WSZwjq98TlLYn5tnDvpgqe276a8teeVeRBtEbIRYfhoJN79F3I8oy', 'admin'),
('S89AK2K1', 'djajas', '$2y$10$4zOez6de1xjnWer4oKggvOBLcHCC9Tya3YnTossy2WhwwgwWlyWMC', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ANGGOTA`
--
ALTER TABLE `ANGGOTA`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `BUKU`
--
ALTER TABLE `BUKU`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `DENDA`
--
ALTER TABLE `DENDA`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `KATEGORI_BUKU`
--
ALTER TABLE `KATEGORI_BUKU`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `PEGAWAI`
--
ALTER TABLE `PEGAWAI`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `PENERBIT`
--
ALTER TABLE `PENERBIT`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `PENGARANG`
--
ALTER TABLE `PENGARANG`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indeks untuk tabel `RAK_BUKU`
--
ALTER TABLE `RAK_BUKU`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `TRANSAKSI`
--
ALTER TABLE `TRANSAKSI`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
