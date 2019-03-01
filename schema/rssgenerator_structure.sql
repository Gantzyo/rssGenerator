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

-- Dumping structure for table midb.rssgenerator_cookie
CREATE TABLE IF NOT EXISTS `rssgenerator_cookie` (
  `Type_type` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `updateTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Type_type`,`name`),
  KEY `rssgenerator_cookie_updatets_idx` (`updateTS`) USING BTREE,
  CONSTRAINT `rssgenerator_cookie_type` FOREIGN KEY (`Type_type`) REFERENCES `rssgenerator_type` (`type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cookies específicas para cada tipo de sitio';

-- Data exporting was unselected.
-- Dumping structure for table midb.rssgenerator_feed
CREATE TABLE IF NOT EXISTS `rssgenerator_feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `creationTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rssgenerator_feed_name_idx` (`name`),
  KEY `rssgenerator_feed_enabled_idx` (`enabled`),
  KEY `rssgenerator_feed_creationts_idx` (`creationTS`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Feeds únicos (Cada feed combina diversas fuentes)';

-- Data exporting was unselected.
-- Dumping structure for table midb.rssgenerator_feed_has_site
CREATE TABLE IF NOT EXISTS `rssgenerator_feed_has_site` (
  `Feed_id` int(11) NOT NULL,
  `Site_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `creationTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Feed_id`,`Site_id`),
  KEY `rssgenerator_feed_has_site_site` (`Site_id`),
  KEY `rssgenerator_feed_has_site_enabled_idx` (`enabled`),
  KEY `rssgenerator_feed_has_site_updatets_idx` (`updateTS`) USING BTREE,
  KEY `rssgenerator_feed_has_site_creationts_idx` (`creationTS`) USING BTREE,
  CONSTRAINT `rssgenerator_rss_multirss` FOREIGN KEY (`Feed_id`) REFERENCES `rssgenerator_feed` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rssgenerator_rss_site` FOREIGN KEY (`Site_id`) REFERENCES `rssgenerator_site` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla relacional entre un feed y los sitios que combina';

-- Data exporting was unselected.
-- Dumping structure for table midb.rssgenerator_last_site_update
CREATE TABLE IF NOT EXISTS `rssgenerator_last_site_update` (
  `Site_id` int(11) NOT NULL,
  `lastUpdate` varchar(1024) NOT NULL,
  `updateTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Site_id`),
  KEY `rssgenerator_last_site_update_updatets_idx` (`updateTS`) USING BTREE,
  CONSTRAINT `rssgenerator_last_site_update_site` FOREIGN KEY (`Site_id`) REFERENCES `rssgenerator_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Última actualización del sitio para comprobar si ha habido cambios. NO EDITAR MANUALMENTE!!';

-- Data exporting was unselected.
-- Dumping structure for table midb.rssgenerator_site
CREATE TABLE IF NOT EXISTS `rssgenerator_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `Type_type` varchar(50) NOT NULL,
  `url` varchar(1024) NOT NULL,
  `idWeb` varchar(1024) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `creationTS` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rssgenerator_site_url_idx` (`url`(255)),
  KEY `rssgenerator_site_enabled_idx` (`enabled`),
  KEY `rssgenerator_site_type` (`Type_type`),
  KEY `rssgenerator_site_creationts_idx` (`creationTS`) USING BTREE,
  CONSTRAINT `rssgenerator_site_type` FOREIGN KEY (`Type_type`) REFERENCES `rssgenerator_type` (`type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Sitios únicos que luego se cargarán en uno o varios feeds';

-- Data exporting was unselected.
-- Dumping structure for table midb.rssgenerator_type
CREATE TABLE IF NOT EXISTS `rssgenerator_type` (
  `type` varchar(50) NOT NULL,
  `longName` varchar(255) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `creationTS` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`type`),
  KEY `rssgenerator_type_enabled_idx` (`enabled`),
  KEY `rssgenerator_type_creationts_idx` (`creationTS`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipos de sitios conocidos';

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
