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

-- Dumping structure for table salomon.nhasanxuat
CREATE TABLE IF NOT EXISTS `nhasanxuat` (
  `nsx_ma` int(11) NOT NULL AUTO_INCREMENT,
  `nsx_ten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`nsx_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table salomon.nhasanxuat: ~4 rows (approximately)
/*!40000 ALTER TABLE `nhasanxuat` DISABLE KEYS */;
REPLACE INTO `nhasanxuat` (`nsx_ma`, `nsx_ten`) VALUES
	(1, 'Apple'),
	(2, 'Samsung'),
	(3, 'HTC'),
	(4, 'Nokia');
/*!40000 ALTER TABLE `nhasanxuat` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;