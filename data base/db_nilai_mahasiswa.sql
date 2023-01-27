-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_nilai_mahasiswa
CREATE DATABASE IF NOT EXISTS `db_nilai_mahasiswa` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `db_nilai_mahasiswa`;

-- Dumping structure for table db_nilai_mahasiswa.tb_admin
CREATE TABLE IF NOT EXISTS `tb_admin` (
  `kode_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_admin`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_nilai_mahasiswa.tb_admin: ~1 rows (approximately)
DELETE FROM `tb_admin`;
/*!40000 ALTER TABLE `tb_admin` DISABLE KEYS */;
INSERT INTO `tb_admin` (`kode_admin`, `nama`) VALUES
	(1, 'Alvi');
/*!40000 ALTER TABLE `tb_admin` ENABLE KEYS */;

-- Dumping structure for table db_nilai_mahasiswa.tb_detail_dosen
CREATE TABLE IF NOT EXISTS `tb_detail_dosen` (
  `NIP` varchar(25) NOT NULL,
  `kode_mk` varchar(6) NOT NULL,
  `jam_mengajar` int(11) NOT NULL,
  UNIQUE KEY `kode_mk` (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_nilai_mahasiswa.tb_detail_dosen: ~3 rows (approximately)
DELETE FROM `tb_detail_dosen`;
/*!40000 ALTER TABLE `tb_detail_dosen` DISABLE KEYS */;
INSERT INTO `tb_detail_dosen` (`NIP`, `kode_mk`, `jam_mengajar`) VALUES
	('0203018101', 'DIP002', 14),
	('022100105', 'DIP004', 30),
	('0229117102', 'INF001', 20);
/*!40000 ALTER TABLE `tb_detail_dosen` ENABLE KEYS */;

-- Dumping structure for table db_nilai_mahasiswa.tb_dosen
CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `nip` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kode_dosen` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`nip`) USING BTREE,
  UNIQUE KEY `kode_dosen` (`kode_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_nilai_mahasiswa.tb_dosen: ~3 rows (approximately)
DELETE FROM `tb_dosen`;
/*!40000 ALTER TABLE `tb_dosen` DISABLE KEYS */;
INSERT INTO `tb_dosen` (`nip`, `nama`, `kode_dosen`) VALUES
	('0203018101', 'Adi Sucipto, S.Kom., M.T.', 2),
	('022100105', 'Adhie Thyo Priandika, S.Kom., M.Kom.', 1),
	('0229117102', 'Riduwan Napianto, S.E., M.Kom.', 3);
/*!40000 ALTER TABLE `tb_dosen` ENABLE KEYS */;

-- Dumping structure for table db_nilai_mahasiswa.tb_mahasiswa
CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `npm` varchar(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_pk` enum('TI','TK','SI','IF','SIA') NOT NULL,
  `Semester` enum('1','2','3','4','5','6','7','8','9','10') NOT NULL,
  `alamat` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_nilai_mahasiswa.tb_mahasiswa: ~4 rows (approximately)
DELETE FROM `tb_mahasiswa`;
/*!40000 ALTER TABLE `tb_mahasiswa` DISABLE KEYS */;
INSERT INTO `tb_mahasiswa` (`id`, `npm`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `id_pk`, `Semester`, `alamat`) VALUES
	(1, '20313015', 'Alvi Suhartanto', 'L', '2001-12-14', 'TI', '5', 'Antasari'),
	(2, '20313007', 'Yeria Ari Sandi', 'L', '2002-01-06', 'TI', '5', 'Way Halim'),
	(3, '20313009', 'Fahreja Aditya', 'L', '2000-06-06', 'TI', '5', 'Kedaton'),
	(4, '20313012', 'Tirta Tegar Laksana', 'L', '2002-10-10', 'TI', '5', 'Natar');
/*!40000 ALTER TABLE `tb_mahasiswa` ENABLE KEYS */;

-- Dumping structure for table db_nilai_mahasiswa.tb_mata_kuliah
CREATE TABLE IF NOT EXISTS `tb_mata_kuliah` (
  `kode_mk` varchar(6) NOT NULL,
  `nama_mk` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL,
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_nilai_mahasiswa.tb_mata_kuliah: ~6 rows (approximately)
DELETE FROM `tb_mata_kuliah`;
/*!40000 ALTER TABLE `tb_mata_kuliah` DISABLE KEYS */;
INSERT INTO `tb_mata_kuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
	('DIP001', 'Bahasa Indonesia', 3),
	('DIP002', 'Kewirausahaan', 3),
	('DIP003', 'Bahasa Inggris', 3),
	('DIP004', 'Aplikom', 3),
	('INF001', 'Sistem Operasi', 4),
	('INF002', 'Aljabar Linier', 2);
/*!40000 ALTER TABLE `tb_mata_kuliah` ENABLE KEYS */;

-- Dumping structure for table db_nilai_mahasiswa.tb_nilai
CREATE TABLE IF NOT EXISTS `tb_nilai` (
  `nim` varchar(9) NOT NULL,
  `kode_mk` varchar(6) NOT NULL,
  `nilai` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_nilai_mahasiswa.tb_nilai: ~6 rows (approximately)
DELETE FROM `tb_nilai`;
/*!40000 ALTER TABLE `tb_nilai` DISABLE KEYS */;
INSERT INTO `tb_nilai` (`nim`, `kode_mk`, `nilai`) VALUES
	('J3C112048', 'DIP002', 'A'),
	('J3C112144', 'DIP002', 'AB'),
	('J3C112167', 'DIP002', 'B'),
	('J3C112048', 'DIP004', 'BC'),
	('J3C112144', 'DIP004', 'AB'),
	('J3C112167', 'DIP004', 'C');
/*!40000 ALTER TABLE `tb_nilai` ENABLE KEYS */;

-- Dumping structure for table db_nilai_mahasiswa.tb_program_keahlian
CREATE TABLE IF NOT EXISTS `tb_program_keahlian` (
  `id_pk` varchar(3) NOT NULL,
  `nama_pk` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table db_nilai_mahasiswa.tb_program_keahlian: 5 rows
DELETE FROM `tb_program_keahlian`;
/*!40000 ALTER TABLE `tb_program_keahlian` DISABLE KEYS */;
INSERT INTO `tb_program_keahlian` (`id_pk`, `nama_pk`) VALUES
	('SIA', 'Sistem Informasi Akuntansi'),
	('SI', 'Sistem Informasi'),
	('IF', 'Informatika'),
	('TK', 'Teknik Komputer'),
	('TI', 'Teknologi Informasi');
/*!40000 ALTER TABLE `tb_program_keahlian` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
