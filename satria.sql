-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2019 at 06:03 PM
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
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `nama_divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `nama_divisi`) VALUES
(2, 'Kepegawaian'),
(3, 'Pemasaran'),
(5, 'tEST');

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
  `status_cuti` enum('menunggu','ditolak','disetujui') NOT NULL,
  `berkas` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `nip`, `tgl_cuti`, `tgl_selesai`, `jns_cuti`, `status`, `status_cuti`, `berkas`) VALUES
(1, '105152111111111', '2019-07-25', '2019-07-30', 'Cuti Besar', 'menunggu', 'menunggu', '1563893233.pdf');

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
(1, '105152111111111', '2019-07-23', 4, 5, '1563882945.pdf', 'menunggu', 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id_gol` int(11) NOT NULL,
  `id_sub_bagian` int(11) NOT NULL,
  `nama_pegawai` varchar(20) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `jabatan` varchar(60) NOT NULL,
  `status_perkawinan` enum('menikah','belum menikah') NOT NULL,
  `status_pegawai` enum('aktif','mutasi','pensiun','cuti') NOT NULL,
  `jenis` enum('struktural') NOT NULL,
  `mulai_kerja` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `password`, `id_gol`, `id_sub_bagian`, `nama_pegawai`, `no_hp`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `jabatan`, `status_perkawinan`, `status_pegawai`, `jenis`, `mulai_kerja`) VALUES
('105152111111111', '10515211', 2, 4, 'Indra Gunanda', '081214267695', 'Banjar', '1999-07-23', 'perempuan', 'islam', 'Test', 'menikah', 'aktif', 'struktural', '2019-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_diklat`
--

CREATE TABLE `pegawai_diklat` (
  `id_pd` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_diklat` varchar(100) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_pendidikan`
--

CREATE TABLE `pegawai_pendidikan` (
  `id_pp` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tingkat_pend` varchar(20) NOT NULL,
  `nama_sekolah` varchar(20) NOT NULL,
  `bulan_lulus` varchar(2) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai_pendidikan`
--

INSERT INTO `pegawai_pendidikan` (`id_pp`, `nip`, `tingkat_pend`, `nama_sekolah`, `bulan_lulus`, `tahun_lulus`) VALUES
(2, '105152111111111', 'SD', 'Test', '12', '2019');

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

-- --------------------------------------------------------

--
-- Table structure for table `sub_bagian`
--

CREATE TABLE `sub_bagian` (
  `id_sub_bagian` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `nama_sub` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_bagian`
--

INSERT INTO `sub_bagian` (`id_sub_bagian`, `id_bagian`, `nama_sub`) VALUES
(4, 2, 'OB'),
(5, 3, 'Packing'),
(6, 5, 'Sub');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `nip_index` (`nip`);

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
  ADD KEY `mutasi_ibfk_2` (`tujuan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `ix_gol` (`id_gol`),
  ADD KEY `ix_divisi` (`id_sub_bagian`);

--
-- Indexes for table `pegawai_diklat`
--
ALTER TABLE `pegawai_diklat`
  ADD PRIMARY KEY (`id_pd`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `pegawai_pendidikan`
--
ALTER TABLE `pegawai_pendidikan`
  ADD PRIMARY KEY (`id_pp`),
  ADD KEY `nip_index` (`nip`);

--
-- Indexes for table `pensiun`
--
ALTER TABLE `pensiun`
  ADD PRIMARY KEY (`id_pensiun`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `sub_bagian`
--
ALTER TABLE `sub_bagian`
  ADD PRIMARY KEY (`id_sub_bagian`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gol`
--
ALTER TABLE `gol`
  MODIFY `id_gol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kenaikan`
--
ALTER TABLE `kenaikan`
  MODIFY `id_kenaikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai_diklat`
--
ALTER TABLE `pegawai_diklat`
  MODIFY `id_pd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai_pendidikan`
--
ALTER TABLE `pegawai_pendidikan`
  MODIFY `id_pp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pensiun`
--
ALTER TABLE `pensiun`
  MODIFY `id_pensiun` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_bagian`
--
ALTER TABLE `sub_bagian`
  MODIFY `id_sub_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`asal`) REFERENCES `sub_bagian` (`id_sub_bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mutasi_ibfk_2` FOREIGN KEY (`tujuan`) REFERENCES `sub_bagian` (`id_sub_bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mutasi_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_gol`) REFERENCES `gol` (`id_gol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`id_sub_bagian`) REFERENCES `sub_bagian` (`id_sub_bagian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai_diklat`
--
ALTER TABLE `pegawai_diklat`
  ADD CONSTRAINT `pegawai_diklat_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai_pendidikan`
--
ALTER TABLE `pegawai_pendidikan`
  ADD CONSTRAINT `pegawai_pendidikan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pensiun`
--
ALTER TABLE `pensiun`
  ADD CONSTRAINT `pensiun_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_bagian`
--
ALTER TABLE `sub_bagian`
  ADD CONSTRAINT `sub_bagian_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
