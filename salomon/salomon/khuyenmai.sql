-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.29-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table salomon.khuyenmai
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `km_ma` int(11) NOT NULL AUTO_INCREMENT,
  `km_ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kh_noidung` text COLLATE utf8_unicode_ci,
  `kh_tungay` date DEFAULT NULL,
  `km_denngay` date DEFAULT NULL,
  PRIMARY KEY (`km_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table salomon.khuyenmai: ~0 rows (approximately)
/*!40000 ALTER TABLE `khuyenmai` DISABLE KEYS */;
/*!40000 ALTER TABLE `khuyenmai` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
