-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table midb.rssgenerator_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `rssgenerator_type` DISABLE KEYS */;
INSERT INTO `rssgenerator_type` (`type`, `longName`, `description`, `enabled`, `creationTS`) VALUES
	('DescargasDD', 'DescargasDD', 'https://descargasdd.com/', 1, '2019-02-14 11:58:09'),
	('Hispashare', 'Hispashare', 'http://www.hispashare.com/', 1, '2019-02-14 11:57:21');
/*!40000 ALTER TABLE `rssgenerator_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
