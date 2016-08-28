# ************************************************************
# Host: localhost (MySQL 5.5.42)
# Database: concrete5
# ************************************************************

CREATE DATABASE concrete5 CHARACTER SET utf8 COLLATE utf8_general_ci;

# Dump of table populations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `populations`;

CREATE TABLE `populations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prefecture_id` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table prefectures
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prefectures`;

CREATE TABLE `prefectures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

