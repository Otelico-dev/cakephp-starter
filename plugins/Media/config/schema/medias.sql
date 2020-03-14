/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(60) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `caption` text,
  PRIMARY KEY (`id`),
  KEY `ref_id` (`ref_id`),
  KEY `ref` (`ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
