-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `co`;
CREATE TABLE `co` (
  `co_id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(100) NOT NULL,
  `cource_code` varchar(100) NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `co_list`;
CREATE TABLE `co_list` (
  `co_id_fk` int(11) NOT NULL,
  `co1` varchar(100) NOT NULL,
  `co2` varchar(100) NOT NULL,
  `co3` varchar(100) NOT NULL,
  `co4` varchar(100) NOT NULL,
  `co5` varchar(100) NOT NULL,
  `co6` varchar(100) NOT NULL,
  KEY `co_id_fk` (`co_id_fk`),
  CONSTRAINT `co_list_ibfk_1` FOREIGN KEY (`co_id_fk`) REFERENCES `co` (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-03-13 16:48:04
