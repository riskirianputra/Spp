-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2018 at 03:25 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE IF NOT EXISTS `tbl_hak_akses` (
  `level_pegawai` enum('Pegawai','Admin','Wali Kelas') NOT NULL,
  `hak_akses` enum('0','1') NOT NULL,
  `jurusan` enum('0','1') NOT NULL,
  `kelas` enum('0','1') NOT NULL,
  `pengguna` enum('0','1') NOT NULL,
  `siswa` enum('0','1') NOT NULL,
  `laporan_jenis_pembayaran` enum('0','1') NOT NULL,
  `laporan_pembayaran` enum('0','1') NOT NULL,
  `laporan_siswa` enum('0','1') NOT NULL,
  `laporan_jurusan` enum('0','1') NOT NULL,
  `laporan_kelas` enum('0','1') NOT NULL,
  `laporan_pengguna` enum('0','1') NOT NULL,
  `backup` enum('0','1') NOT NULL,
  `pembayaran` enum('0','1') NOT NULL,
  `transaksi` enum('0','1') NOT NULL,
  `hapus_pembayaran` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`level_pegawai`, `hak_akses`, `jurusan`, `kelas`, `pengguna`, `siswa`, `laporan_jenis_pembayaran`, `laporan_pembayaran`, `laporan_siswa`, `laporan_jurusan`, `laporan_kelas`, `laporan_pengguna`, `backup`, `pembayaran`, `transaksi`, `hapus_pembayaran`) VALUES
('Pegawai', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '0', '1', '1', '0'),
('Admin', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
('Wali Kelas', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE IF NOT EXISTS `tbl_history` (
`id_history` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `waktu_history` datetime NOT NULL,
  `keterangan_history` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id_history`, `id_pegawai`, `waktu_history`, `keterangan_history`) VALUES
(1, 1, '2018-11-07 10:19:07', 'Menambahkan Jurusan Teknik Kendaraan Ringan'),
(2, 1, '2018-11-07 10:19:22', 'Menambahkan Jurusan Teknik Sepeda Motor'),
(3, 1, '2018-11-07 10:20:07', 'Menambahkan Jurusan Teknik Instalasi Tenaga Listrik'),
(4, 1, '2018-11-07 10:21:36', 'Menambahkan Pengguna TRI HARTINI'),
(5, 1, '2018-11-07 10:22:05', 'Menambahkan Kelas TKR'),
(6, 1, '2018-11-07 10:22:15', 'Menambahkan Kelas TKR'),
(7, 1, '2018-11-07 10:22:26', 'Menambahkan Kelas TKR'),
(8, 1, '2018-11-07 10:22:36', 'Menambahkan Kelas TSM'),
(9, 1, '2018-11-07 10:22:46', 'Menambahkan Kelas TSM'),
(10, 1, '2018-11-07 10:23:01', 'Menambahkan Kelas TSM'),
(11, 1, '2018-11-07 10:23:20', 'Menambahkan Kelas TITL'),
(12, 1, '2018-11-07 10:23:31', 'Menambahkan Kelas TITL'),
(13, 1, '2018-11-07 10:23:45', 'Menambahkan Kelas TITL'),
(14, 1, '2018-11-07 10:46:47', 'Mengimport Siswa '),
(15, 1, '2018-11-07 10:47:11', 'Menambahkan Pembayaran UANG UJIAN'),
(16, 1, '2018-11-07 10:47:58', 'Melakukan Transaksi'),
(17, 1, '2018-11-07 11:02:34', 'Telah Login'),
(18, 1, '2018-11-07 17:53:08', 'Menghapus Pembayaran'),
(19, 1, '2018-11-07 18:07:25', 'Telah Logout'),
(20, 1, '2018-11-07 18:12:19', 'Telah Login'),
(21, 1, '2018-11-07 18:14:34', 'Telah Logout'),
(22, 1, '2018-11-07 18:25:22', 'Telah Login'),
(23, 1, '2018-11-07 18:25:47', 'Menambahkan Pembayaran UANG PRAKERIN / PSG'),
(24, 1, '2018-11-07 18:28:34', 'Telah Logout'),
(25, 1, '2018-11-07 18:28:41', 'Telah Login'),
(26, 1, '2018-11-07 18:35:33', 'Telah Logout'),
(27, 1, '2018-11-18 09:24:09', 'Telah Logout'),
(28, 1, '2018-11-18 09:25:30', 'Telah Login');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE IF NOT EXISTS `tbl_jurusan` (
`id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `diskripsi_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
 INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`, `diskripsi_jurusan`) VALUES
 (1, 'MIPA', 'ILMU PENGETAHUAN ALAM'),
 (2, 'IPS', 'ILMU PENGETAHUAN SOSIAL'),
 (3, 'IPK', 'ILMU PENGETAHUAN KEJURUAN');

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE IF NOT EXISTS `tbl_kelas` (
`id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `tingkat_kelas` enum('10','11','12') NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
INSERT INTO `tbl_kelas` (`id_kelas`,`id_jurusan`, `nama_kelas`, `tingkat_kelas`,  `id_pegawai`) VALUES
 (1, '1', 'MIPA-1', '10','2'),
 (2, '1', 'MIPA-2', '10','2'),
 (3, '1', 'MIPA-3', '10','2'),
 (4, '1', 'MIPA-4', '10','2'),
 (5, '1', 'MIPA-1', '11','2'),
 (6, '1', 'MIPA-2', '11','2'),
 (7, '1', 'MIPA-3', '11','2'),
 (8, '1', 'MIPA-4', '11','2'),
 (9, '1', 'MIPA-1', '12','2'),
 (10,'1', 'MIPA-2', '12','2'),
 (11,'1', 'MIPA-3', '12','2'),
 (12,'1', 'MIPA-4', '12','2'),
 (13,'1', 'MIPA-5', '12','2'),
 (14,'2', 'IPS-1', '10','2'),
 (15,'2', 'IPS-2', '10','2'),
 (16,'2', 'IPS-3', '10','2'),
 (17,'2', 'IPS-1', '11','2'),
 (18,'2', 'IPS-2', '11','2'),
 (19,'2', 'IPS-1', '12','2'),
 (20,'2', 'IPS-2', '12','2'),
 (21,'2', 'IPS-3', '12','2'),
 (22,'2', 'IPS-4', '12','2'),
 (23,'3', 'IPK-1', '10','2'),
 (24,'3', 'IPK-2', '10','2'),
 (25,'3', 'IPK-3', '10','2'),
 (26,'3', 'IPK-1', '11','2'),
 (27,'3', 'IPK-2', '11','2'),
 (28,'3', 'IPK-3', '11','2'),
 (29,'3', 'IPK-4', '11','2'),
 (30,'3', 'IPK-1', '12','2'),
 (31,'3', 'IPK-2', '12','2'),
 (32,'3', 'IPK-3', '12','2'),
 (33,'3', 'IPK-4', '12','2');
--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE IF NOT EXISTS `tbl_pegawai` (
`id_pegawai` int(11) NOT NULL,
  `nip` char(15) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `alamat_pegawai` varchar(200) NOT NULL,
  `telp_pegawai` varchar(15) NOT NULL,
  `foto_pegawai` text NOT NULL,
  `email_pegawai` varchar(100) NOT NULL,
  `password_pegawai` varchar(100) NOT NULL,
  `level_pegawai` enum('Admin','Pegawai','Wali Kelas') NOT NULL,
  `aktif_pegawai` enum('0','1') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `alamat_pegawai`, `telp_pegawai`, `foto_pegawai`, `email_pegawai`, `password_pegawai`, `level_pegawai`, `aktif_pegawai`) VALUES
(1, '2110175022', 'Administrator', 'Payakumbuh Utara Balai Cacang no.17', '085269190388', '1542507706-Logo-Tut-Wuri-Handayani-2.png', 'admin@gmail.com', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', 'Admin', '1'),
(7, '2018', 'ARIF HIDAYAT', 'PAYAKUMBUH', '085269190355', 'default.jpg', 'arif@gmail.com', 'fef1e8ae134768675eadffd7d40ab3e30458fb32', 'Wali Kelas', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
`id_pembayaran` int(11) NOT NULL,
  `nama_pembayaran` varchar(100) NOT NULL,
  `nominal_pembayaran` int(11) NOT NULL,
  `jumlah_cicilan` int(11) NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `aktif_pembayaran` enum('0','1') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `nama_pembayaran`, `nominal_pembayaran`, `jumlah_cicilan`, `id_kelas`, `aktif_pembayaran`) VALUES
(1, 'SPP JANUARI 2020', 100000, 1,'["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(2, 'SPP FEBRUARI 2020', 100000, 1,'["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(3, 'SPP MARET 2020', 100000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(4, 'SPP APRIL 2020', 100000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]','1'),
(5, 'SPP MEI 2020', 100000, 1,'["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(6, 'SPP JUNI 2020', 100000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]','1'),
(7, 'SPP JULI 2020 ', 100000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]','1'),
(8, 'SPP AGUSTUS 2020', 100000, 1,'["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(9, 'SPP SEPTEMBER 2020', 100000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(10, 'SPP OKTOBER 2020', 100000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(11, 'SPP NOVEMBER 2020', 100000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]','1');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_pembayaran_isedentil` (
`id_pembayaran_isedentil` int(11) NOT NULL,
  `nama_pembayaran` varchar(100) NOT NULL,
  `nominal_pembayaran` int(11) NOT NULL,
  `jumlah_cicilan` int(11) NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `aktif_pembayaran` enum('0','1') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `tbl_pembayaran_isedentil` (`id_pembayaran_isedentil`, `nama_pembayaran`, `nominal_pembayaran`, `jumlah_cicilan`, `id_kelas`, `aktif_pembayaran`) VALUES
(1, 'ISEDENTIL 1', 1500000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]','1'),
(2, 'ISEDENTIL 2', 1750000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]', '1'),
(3, 'ISEDENTIL 3', 2000000, 1, '["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33"]','1');


--
-- Table structure for table `tbl_siswa`
--


CREATE TABLE IF NOT EXISTS `tbl_siswa` (
`id_siswa` int(11) NOT NULL,
  `nis` char(15) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jekel_siswa` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat_siswa` text NOT NULL,
  `foto_siswa` text NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `aktif_siswa` enum('0','1','11') NOT NULL,
  `angkatan_siswa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `id_transaksi` char(15) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `nominal_transaksi` double NOT NULL,
  `pembayaran_melalui` enum('TUNAI','TRANSFER') NOT NULL,
  `file_foto` varchar(30) NOT NULL,
  `cicilan_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_transaksi_isedentil` (
  `id_transaksi_isedentil` char(15) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_pembayaran_isedentil` int(11) NOT NULL,
  `nominal_transaksi` double NOT NULL,
  `pembayaran_melalui` enum('TUNAI','TRANSFER') NOT NULL,
  `file_foto` varchar(30) NOT NULL,
  `cicilan_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
 ADD PRIMARY KEY (`level_pegawai`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
 ADD PRIMARY KEY (`id_history`), ADD KEY `id_user` (`id_pegawai`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
 ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
 ADD PRIMARY KEY (`id_kelas`), ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
 ADD PRIMARY KEY (`id_pegawai`), ADD UNIQUE KEY `nip` (`nip`), ADD UNIQUE KEY `email_pegawai` (`email_pegawai`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
 ADD PRIMARY KEY (`id_pembayaran`);

 ALTER TABLE `tbl_pembayaran_isedentil`
 ADD PRIMARY KEY (`id_pembayaran_isedentil`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
 ADD PRIMARY KEY (`id_siswa`), ADD UNIQUE KEY `nis` (`nis`), ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
 ADD PRIMARY KEY (`id_transaksi`), ADD KEY `id_siswa` (`id_siswa`), ADD KEY `id_pegawai` (`id_pegawai`);

ALTER TABLE `tbl_transaksi_isedentil`
 ADD PRIMARY KEY (`id_transaksi_isedentil`), ADD KEY `id_siswa` (`id_siswa`), ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--

ALTER TABLE `tbl_pembayaran_isedentil`
MODIFY `id_pembayaran_isedentil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
