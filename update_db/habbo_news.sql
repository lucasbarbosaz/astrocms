-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.73-community - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table cumat.habbo_news
CREATE TABLE IF NOT EXISTS `habbo_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(5000) NOT NULL,
  `category` set('Campanhas e Atividades','Ofertas Especiais','Promoções','Quartos públicos/jogos','Atualizações','Arquitetos em Ação','Administração') NOT NULL,
  `image_url` varchar(5000) NOT NULL,
  `time` varchar(5000) NOT NULL,
  `time_expire` varchar(5000) DEFAULT NULL,
  `stext` varchar(5000) NOT NULL,
  `btext` text NOT NULL,
  `kind` enum('1','2') NOT NULL,
  `image_url_thumb` varchar(5000) NOT NULL,
  `formulario` int(11) DEFAULT '0',
  `autor` varchar(900) DEFAULT NULL,
  `comentarios` enum('0','1') DEFAULT NULL,
  `draft` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
