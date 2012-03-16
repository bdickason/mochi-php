/*
SQLyog Community Edition- MySQL GUI v8.2 
MySQL - 5.1.37-community : Database - salon
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `user_import` */

DROP TABLE IF EXISTS `user_import`;

CREATE TABLE `user_import` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(12) DEFAULT NULL,
  `lastname` varchar(15) DEFAULT NULL,
  `addr1` varchar(25) DEFAULT NULL,
  `addr2` varchar(25) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `work_phone` varchar(8) DEFAULT NULL,
  `home_phone` varchar(8) DEFAULT NULL,
  `other_phone` varchar(8) DEFAULT NULL,
  `work_phone_area` varchar(3) DEFAULT NULL,
  `home_phone_area` varchar(3) DEFAULT NULL,
  `other_phone_area` varchar(3) DEFAULT NULL,
  `date_registered` varchar(20) DEFAULT NULL,
  `last_visit` varchar(20) DEFAULT NULL,
  `next_visit` varchar(20) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `service1_firstname` varchar(12) DEFAULT NULL,
  `service1_lastname` varchar(15) DEFAULT NULL,
  `service2_firstname` varchar(12) DEFAULT NULL,
  `service2_lastname` varchar(15) DEFAULT NULL,
  `service3_firstname` varchar(12) DEFAULT NULL,
  `service3_lastname` varchar(15) DEFAULT NULL,
  `service4_firstname` varchar(12) DEFAULT NULL,
  `service4_lastname` varchar(15) DEFAULT NULL,
  `cardlimit` varchar(5) DEFAULT NULL,
  `how_you_found_us` varchar(10) DEFAULT NULL,
  `customer_type` varchar(10) DEFAULT NULL,
  `this_year_visits` varchar(3) DEFAULT NULL,
  `last_year_visits` varchar(3) DEFAULT NULL,
  `p1` varchar(20) DEFAULT NULL,
  `p1t` enum('work','mobile','home') DEFAULT NULL,
  `p2` varchar(20) DEFAULT NULL,
  `p2t` enum('work','mobile','home') DEFAULT NULL,
  `dobp` date DEFAULT NULL,
  `regdatep` date DEFAULT NULL,
  `addr` varchar(50) DEFAULT NULL,
  `apt` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=9929 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
