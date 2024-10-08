-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 06:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appsurat_gel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instansi`
--

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `depthead` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `institusi`, `nama`, `status`, `alamat`, `depthead`, `nip`, `website`, `email`, `logo`, `id_user`) VALUES
(1, 'GEL GROUP', 'Global Energi Lestari', '', 'Artha Graha Building, Lt. 30, SCBD,Sudirman, Jl. Jend. Sudirman kav. 52-53 Blok 52 - 53, RT.5/RW.3, Kel. Senayan, Kec. Kebayoran Baru, Jakarta Selatan', 'Habib', '-', 'https://gel-group.vercel.app/index.html', 'email@masrud.com', 'logo.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_surat`
--

CREATE TABLE `tbl_jenis_surat` (
  `id_jenis_surat` int(255) NOT NULL,
  `jenis_surat` varchar(255) NOT NULL,
  `s_jenis_surat` varchar(255) NOT NULL,
  `kode_surat` varchar(255) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jenis_surat`
--

INSERT INTO `tbl_jenis_surat` (`id_jenis_surat`, `jenis_surat`, `s_jenis_surat`, `kode_surat`, `divisi`, `id_user`) VALUES
(1, 'Surat Permohonan', 'SP', '', 'LEGAL', 3),
(2, 'Surat Perjanjian', '', '', 'LEGAL', 3),
(3, 'Surat External', 'BA', '', 'MSS', 4),
(4, 'Surat ke Jetty', 'BA', '', 'MSS', 4),
(5, 'Surat External Perubahan Email', 'EXT', '', 'CS', 5),
(6, 'Surat Internal Pembatal Transaksi', 'INT', '', 'CS', 5),
(7, 'Surat Penunjukan Keagenan', 'SPK', '', 'GSM', 6),
(8, 'Surat Ke Artha Graha pengajuan Kartu Akses', '', '', 'GA', 13),
(9, 'Cop Bank', 'EXT', 'TNC', 'TC', 7),
(10, 'BPJS', 'BPJSKes', 'TNC', 'TC', 7),
(11, 'Offering Letter', 'Loo', 'TNC', 'TC', 7),
(12, 'Internal Memo', 'IM', 'TNC', 'TC', 7),
(13, 'Paklaring', 'Ref', 'TNC', 'TC', 7),
(14, 'Surat Permohonan Pengembalian Dana', '', '', 'AP', 8),
(15, 'Surat Permohonan Pengembalian Dana', '', '', 'BNL', 9),
(16, 'Surat ke PLN Permohonan Pembayaran Batubara', '', '', 'AR', 10),
(17, 'Surat Permohonan Pengembalian Dana', '', '', 'TAX', 11),
(18, 'Surat Permintaan NPWP', '', '', 'TAX', 11),
(19, 'Balasan Surat Penjelasan S-373-P2DK-KPP', '', '', 'TAX', 11),
(20, 'Klarifikasi atas pencabutan pengukuhan PKP', '', '', 'TAX', 11),
(21, 'Permintaan Salinan Tunggakan Pajak', '', '', 'TAX', 11),
(22, '', '', '', 'ACC', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_klasifikasi`
--

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(5) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sett`
--

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_sett`
--

INSERT INTO `tbl_sett` (`id_sett`, `surat_masuk`, `surat_keluar`, `referensi`, `id_user`) VALUES
(1, 50, 10, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_keluar`
--

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat`, `no_agenda`, `no_surat`, `asal_surat`, `isi`, `kode`, `indeks`, `tgl_surat`, `tgl_diterima`, `file`, `keterangan`, `id_user`) VALUES
(2, 1, '001', 'JAKARTA', 'ISINYA BEGINI', '00111', 'ASA', '2024-08-31', '2024-08-31', '', 'ISI SURATNYA SEPERTI INI', 3),
(3, 2, '002', 'zcxzcxz', 'xzcxzcxz', 'xzcxz', 'zxcxzcxz', '2024-09-02', '2024-09-02', '', 'zxcxzcxz', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tulis_surat`
--

CREATE TABLE `tbl_tulis_surat` (
  `id_surat` int(11) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `nip`, `divisi`, `admin`) VALUES
(1, 'superadmin', 'sudosu', 'Global Energi Lestari', '-', 'ALL', 1),
(2, 'itsupport', 'itsupport123', 'IT', '', 'IT', 3),
(3, 'LEGAL', 'LEGAL', 'LEGAL GEL', '', 'LEGAL', 3),
(4, 'marketing', 'marketing123', 'Marketing Sales Shipping', '', 'MSS', 3),
(5, 'corsec', 'corsec123', 'CORSEC', '', 'CS', 3),
(6, 'globalsinergi', 'globalsinergi123', 'Global Sinergi Maritim', '', 'GSM', 3),
(7, 'talent', 'talent123', 'Talent and Culture', '', 'TC', 3),
(8, 'financeap', 'finance123', 'Account Payable', '', 'AP', 3),
(9, 'bankleasing', 'bank123', 'Bank and Leasing', '', 'BNL', 3),
(10, 'financear', 'finance123', 'Account Receivable', '', 'AR', 3),
(11, 'taxgel', 'taxgel123', 'TAX', '', 'TAX', 3),
(12, 'accounting', 'acc123', 'Accounting', '', 'ACC', 3),
(13, 'generalaffair', 'generalaffair123', 'General Affair', '', 'GA', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indexes for table `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `tbl_jenis_surat`
--
ALTER TABLE `tbl_jenis_surat`
  ADD PRIMARY KEY (`id_jenis_surat`);

--
-- Indexes for table `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `tbl_sett`
--
ALTER TABLE `tbl_sett`
  ADD PRIMARY KEY (`id_sett`);

--
-- Indexes for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_tulis_surat`
--
ALTER TABLE `tbl_tulis_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `id_disposisi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  MODIFY `id_klasifikasi` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
