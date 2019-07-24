-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2019 at 08:00 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satria`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(60) NOT NULL,
  `password` varchar(20) NOT NULL,
  `akses` enum('kepeg','atasan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `akses`) VALUES
('admin', 'admin', 'kepeg'),
('atasan', 'atasan', 'atasan');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tgl_cuti` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jns_cuti` varchar(20) DEFAULT NULL,
  `status` enum('menunggu','ditolak','disetujui') NOT NULL,
  `status_cuti` enum('menunggu','ditolak','disetujui') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `nip`, `tgl_cuti`, `tgl_selesai`, `jns_cuti`, `status`, `status_cuti`) VALUES
(5, '10515211', '2019-07-11', '2019-07-15', NULL, 'disetujui', 'disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(2, 'Kepegawaian'),
(3, 'Pemasaran');

-- --------------------------------------------------------

--
-- Table structure for table `gol`
--

CREATE TABLE `gol` (
  `id_gol` int(11) NOT NULL,
  `nama_gol` varchar(15) NOT NULL,
  `pangkat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gol`
--

INSERT INTO `gol` (`id_gol`, `nama_gol`, `pangkat`) VALUES
(2, '1A', 'I/A'),
(3, '2A', 'ii/a');

-- --------------------------------------------------------

--
-- Table structure for table `kenaikan`
--

CREATE TABLE `kenaikan` (
  `id_kenaikan` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('fungsional','struktural') NOT NULL,
  `berkas` varchar(100) DEFAULT NULL,
  `asal` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `status` enum('menunggu','ditolak','disetujui') NOT NULL,
  `status_kenaikan` enum('menunggu','ditolak','disetujui') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kenaikan`
--

INSERT INTO `kenaikan` (`id_kenaikan`, `nip`, `tanggal`, `jenis`, `berkas`, `asal`, `tujuan`, `status`, `status_kenaikan`) VALUES
(4, '10515211', '2019-07-11', 'struktural', '1562822941.pdf', 3, 2, 'disetujui', 'disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tgl_mutasi` date NOT NULL,
  `asal` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `berkas` varchar(100) DEFAULT NULL,
  `status_validasi` enum('menunggu','ditolak','diijinkan') NOT NULL,
  `status_mutasi` enum('menunggu','disetujui','ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`id_mutasi`, `nip`, `tgl_mutasi`, `asal`, `tujuan`, `berkas`, `status_validasi`, `status_mutasi`) VALUES
(4, '10515211', '2019-07-11', 3, 2, '1562822930.pdf', 'diijinkan', 'disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id_gol` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `nama_pegawai` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `jabatan` varchar(60) NOT NULL,
  `status_perkawinan` enum('menikah','belum menikah') NOT NULL,
  `status_pegawai` enum('aktif','mutasi','pensiun','cuti') NOT NULL,
  `pend_terakhir` varchar(15) NOT NULL,
  `jenis` enum('struktural') NOT NULL,
  `mulai_kerja` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `password`, `id_gol`, `id_divisi`, `nama_pegawai`, `email`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `jabatan`, `status_perkawinan`, `status_pegawai`, `pend_terakhir`, `jenis`, `mulai_kerja`) VALUES
('10515211', '10515211', 2, 2, '10515211', 'indra.gunanda@gmail.com', '10515211', '1800-09-29', 'laki-laki', 'islam', '10515211', 'menikah', 'aktif', 'SD', 'struktural', '2019-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tingkat_pend` varchar(20) NOT NULL,
  `nama_sekolah` varchar(20) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL,
  `pimpinan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pensiun`
--

CREATE TABLE `pensiun` (
  `id_pensiun` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `pensiun` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `berkas` varchar(100) DEFAULT NULL,
  `status` enum('menunggu','ditolak','disetujui') NOT NULL,
  `status_pensiun` enum('menunggu','ditolak','disetujui') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pensiun`
--

INSERT INTO `pensiun` (`id_pensiun`, `nip`, `tanggal`, `pensiun`, `keterangan`, `berkas`, `status`, `status_pensiun`) VALUES
(7, '10515211', '2019-07-12', NULL, NULL, '1562822910.pdf', 'disetujui', 'disetujui');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `nip_index` (`nip`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `gol`
--
ALTER TABLE `gol`
  ADD PRIMARY KEY (`id_gol`);

--
-- Indexes for table `kenaikan`
--
ALTER TABLE `kenaikan`
  ADD PRIMARY KEY (`id_kenaikan`),
  ADD KEY `nip_index` (`nip`),
  ADD KEY `divisi` (`asal`,`tujuan`),
  ADD KEY `kenaikan_ibfk_1` (`tujuan`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `nip_index` (`nip`),
  ADD KEY `divisi` (`asal`,`tujuan`),
  ADD KEY `tujuan` (`tujuan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `ix_gol` (`id_gol`),
  ADD KEY `ix_divisi` (`id_divisi`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD KEY `nip_index` (`nip`);

--
-- Indexes for table `pensiun`
--
ALTER TABLE `pensiun`
  ADD PRIMARY KEY (`id_pensiun`),
  ADD KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gol`
--
ALTER TABLE `gol`
  MODIFY `id_gol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kenaikan`
--
ALTER TABLE `kenaikan`
  MODIFY `id_kenaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pensiun`
--
ALTER TABLE `pensiun`
  MODIFY `id_pensiun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kenaikan`
--
ALTER TABLE `kenaikan`
  ADD CONSTRAINT `asal` FOREIGN KEY (`asal`) REFERENCES `gol` (`id_gol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kenaikan_ibfk_1` FOREIGN KEY (`tujuan`) REFERENCES `gol` (`id_gol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nip` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`asal`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mutasi_ibfk_2` FOREIGN KEY (`tujuan`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mutasi_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_gol`) REFERENCES `gol` (`id_gol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD CONSTRAINT `pendidikan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pensiun`
--
ALTER TABLE `pensiun`
  ADD CONSTRAINT `pensiun_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
