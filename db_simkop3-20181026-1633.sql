-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2018 at 11:33 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simkop3`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_nasabah`
--

CREATE TABLE `t01_nasabah` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text NOT NULL,
  `No_Telp_Hp` varchar(100) NOT NULL,
  `Pekerjaan` varchar(50) NOT NULL,
  `Pekerjaan_Alamat` text NOT NULL,
  `Pekerjaan_No_Telp_Hp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_nasabah`
--

INSERT INTO `t01_nasabah` (`id`, `Nama`, `Alamat`, `No_Telp_Hp`, `Pekerjaan`, `Pekerjaan_Alamat`, `Pekerjaan_No_Telp_Hp`) VALUES
(1, 'Andoko', '-', '-', '-', '-', '-'),
(2, 'Dodo', '-', '-', '-', '-', '-'),
(3, 'Hendra', '-', '-', '-', '-', '-'),
(4, 'Agam', '-', '-', '-', '-', '-'),
(5, 'Vico', '-', '-', '-', '-', '-'),
(6, 'X', '-', '-', '-', '-', '-'),
(7, 'Y', '-', '-', '-', '-', '-'),
(8, 'Z', '-', '-', '-', '-', '-'),
(9, 'A', '-', '-', '-', '-', '-'),
(10, 'B', '-', '-', '-', '--', '-'),
(11, 'C', '-', '-', '-', '-', '-'),
(12, 'D', '-', '-', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `t02_jaminan`
--

CREATE TABLE `t02_jaminan` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Merk_Type` varchar(25) NOT NULL,
  `No_Rangka` varchar(50) DEFAULT NULL,
  `No_Mesin` varchar(50) DEFAULT NULL,
  `Warna` varchar(15) DEFAULT NULL,
  `No_Pol` varchar(15) DEFAULT NULL,
  `Keterangan` text,
  `Atas_Nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t03_pinjaman`
--

CREATE TABLE `t03_pinjaman` (
  `id` int(11) NOT NULL,
  `Kontrak_No` varchar(25) NOT NULL,
  `Kontrak_Tgl` date NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Pinjaman` float(14,2) NOT NULL,
  `Angsuran_Lama` tinyint(4) NOT NULL,
  `Angsuran_Bunga_Prosen` decimal(5,2) NOT NULL DEFAULT '2.25',
  `Angsuran_Denda` decimal(5,2) NOT NULL DEFAULT '0.40',
  `Dispensasi_Denda` tinyint(4) NOT NULL DEFAULT '3',
  `Angsuran_Pokok` float(14,2) NOT NULL,
  `Angsuran_Bunga` float(14,2) NOT NULL,
  `Angsuran_Total` float(14,2) NOT NULL,
  `No_Ref` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t04_pinjamanangsuran`
--

CREATE TABLE `t04_pinjamanangsuran` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `Angsuran_Ke` tinyint(4) NOT NULL,
  `Angsuran_Tanggal` date NOT NULL,
  `Angsuran_Pokok` float(14,2) NOT NULL,
  `Angsuran_Bunga` float(14,2) NOT NULL,
  `Angsuran_Total` float(14,2) NOT NULL,
  `Sisa_Hutang` float(14,2) NOT NULL,
  `Tanggal_Bayar` date DEFAULT NULL,
  `Terlambat` smallint(6) DEFAULT NULL,
  `Total_Denda` float(14,2) DEFAULT NULL,
  `Bayar_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Non_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Total` float(14,2) DEFAULT NULL,
  `Keterangan` text,
  `pinjamantitipan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t05_pinjamanjaminan`
--

CREATE TABLE `t05_pinjamanjaminan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `jaminan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t06_pinjamantitipan`
--

CREATE TABLE `t06_pinjamantitipan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text,
  `Masuk` float(14,2) NOT NULL DEFAULT '0.00',
  `Keluar` float(14,2) NOT NULL DEFAULT '0.00',
  `Sisa` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t94_log`
--

CREATE TABLE `t94_log` (
  `id` int(11) NOT NULL,
  `index_` tinyint(4) NOT NULL,
  `subj_` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t95_logdesc`
--

CREATE TABLE `t95_logdesc` (
  `id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `desc_` text NOT NULL,
  `date_solved` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_userlevelpermissions`
--

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t98_userlevelpermissions`
--

INSERT INTO `t98_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}cf01_home.php', 8),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t01_nasabah', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t02_jaminan', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t03_pinjaman', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t04_pinjamanangsuran', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t05_pinjamanjaminan', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t06_pinjamantitipan', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t94_log', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t95_logdesc', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t96_employees', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t97_userlevels', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t98_userlevelpermissions', 0),
(-2, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t99_audittrail', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}cf01_home.php', 8),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t01_nasabah', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t02_jaminan', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t03_pinjaman', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t04_pinjamanangsuran', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t05_pinjamanjaminan', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t06_pinjamantitipan', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t94_log', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t95_logdesc', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t96_employees', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t97_userlevels', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t98_userlevelpermissions', 0),
(-2, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t99_audittrail', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}cf01_home.php', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t01_nasabah', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t02_jaminan', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t03_pinjaman', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t04_pinjamanangsuran', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t05_pinjamanjaminan', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t06_pinjamantitipan', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t94_log', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t95_logdesc', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t96_employees', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t97_userlevels', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t98_userlevelpermissions', 0),
(0, '{4A92113F-FAF7-42E0-B722-EA94135527E4}t99_audittrail', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}cf01_home.php', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t01_nasabah', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t02_jaminan', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t03_pinjaman', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t04_pinjamanangsuran', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t05_pinjamanjaminan', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t06_pinjamantitipan', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t94_log', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t95_logdesc', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t96_employees', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t97_userlevels', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t98_userlevelpermissions', 0),
(0, '{dff4fb89-88b4-4185-a58e-20f4995eb476}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2018-10-25 20:33:45', '/simkop3/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(2, '2018-10-25 20:33:50', '/simkop3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(3, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '1', '', 'Andoko'),
(4, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '1', '', '-'),
(5, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '1', '', '0'),
(6, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '1', '', '-'),
(7, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '1', '', '-'),
(8, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '1', '', '-'),
(9, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '1', '', '1'),
(10, '2018-10-25 22:37:59', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(11, '2018-10-26 09:53:31', '/simkop3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(12, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '1', '', 'Andoko'),
(13, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '1', '', '-'),
(14, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '1', '', '-'),
(15, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '1', '', '-'),
(16, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '1', '', '-'),
(17, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '1', '', '-'),
(18, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '1', '', '1'),
(19, '2018-10-26 09:54:05', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(20, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '2', '', 'Dodo'),
(21, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '2', '', '-'),
(22, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '2', '', '-'),
(23, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '2', '', '-'),
(24, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '2', '', '-'),
(25, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '2', '', '-'),
(26, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '2', '', '2'),
(27, '2018-10-26 09:58:30', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(28, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '3', '', 'Hendra'),
(29, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '3', '', '-'),
(30, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '3', '', '-'),
(31, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '3', '', '-'),
(32, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '3', '', '-'),
(33, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '3', '', '-'),
(34, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '3', '', '3'),
(35, '2018-10-26 10:53:03', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(36, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '4', '', 'Agam'),
(37, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '4', '', '-'),
(38, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '4', '', '-'),
(39, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '4', '', '-'),
(40, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '4', '', '-'),
(41, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '4', '', '-'),
(42, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '4', '', '4'),
(43, '2018-10-26 11:06:51', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(44, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '5', '', 'Vico'),
(45, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '5', '', '-'),
(46, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '5', '', '-'),
(47, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '5', '', '-'),
(48, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '5', '', '-'),
(49, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '5', '', '-'),
(50, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '5', '', '5'),
(51, '2018-10-26 11:16:07', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(52, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '6', '', 'X'),
(53, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '6', '', '-'),
(54, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '6', '', '-'),
(55, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '6', '', '-'),
(56, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '6', '', '-'),
(57, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '6', '', '-'),
(58, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '6', '', '6'),
(59, '2018-10-26 11:19:52', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(60, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '7', '', 'Y'),
(61, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '7', '', '-'),
(62, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '7', '', '-'),
(63, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '7', '', '-'),
(64, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '7', '', '-'),
(65, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '7', '', '-'),
(66, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '7', '', '7'),
(67, '2018-10-26 11:20:55', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(68, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '8', '', 'Z'),
(69, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '8', '', '-'),
(70, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '8', '', '-'),
(71, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '8', '', '-'),
(72, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '8', '', '-'),
(73, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '8', '', '-'),
(74, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '8', '', '8'),
(75, '2018-10-26 11:22:20', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(76, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '9', '', 'A'),
(77, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '9', '', '-'),
(78, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '9', '', '-'),
(79, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '9', '', '-'),
(80, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '9', '', '-'),
(81, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '9', '', '-'),
(82, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '9', '', '9'),
(83, '2018-10-26 11:25:14', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(84, '2018-10-26 12:32:12', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '10', '', 'B'),
(85, '2018-10-26 12:32:12', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '10', '', '-'),
(86, '2018-10-26 12:32:12', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '10', '', '-'),
(87, '2018-10-26 12:32:12', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '10', '', '-'),
(88, '2018-10-26 12:32:12', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '10', '', '--'),
(89, '2018-10-26 12:32:12', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '10', '', '-'),
(90, '2018-10-26 12:32:12', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '10', '', '10'),
(91, '2018-10-26 12:32:18', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(92, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '11', '', 'C'),
(93, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '11', '', '-'),
(94, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '11', '', '-'),
(95, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '11', '', '-'),
(96, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '11', '', '-'),
(97, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '11', '', '-'),
(98, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '11', '', '11'),
(99, '2018-10-26 15:34:55', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(100, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '12', '', 'D'),
(101, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '12', '', '-'),
(102, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '12', '', '-'),
(103, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '12', '', '-'),
(104, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '12', '', '-'),
(105, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '12', '', '-'),
(106, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '12', '', '12'),
(107, '2018-10-26 15:53:02', '/simkop3/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t01_nasabah`
--
ALTER TABLE `t01_nasabah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t94_log`
--
ALTER TABLE `t94_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t96_employees`
--
ALTER TABLE `t96_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t97_userlevels`
--
ALTER TABLE `t97_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t98_userlevelpermissions`
--
ALTER TABLE `t98_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t01_nasabah`
--
ALTER TABLE `t01_nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t94_log`
--
ALTER TABLE `t94_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
