/*
SQLyog Community v11.52 (64 bit)
MySQL - 5.6.17 : Database - taxfiler
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`taxfiler` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `taxfiler`;

/*Table structure for table `assign_user_list` */

DROP TABLE IF EXISTS `assign_user_list`;

CREATE TABLE `assign_user_list` (
  `as_id` int(10) NOT NULL AUTO_INCREMENT,
  `unlists_u_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `as_status` smallint(5) DEFAULT NULL,
  `as_crated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`as_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `assign_user_list` */

insert  into `assign_user_list`(`as_id`,`unlists_u_id`,`client_id`,`as_status`,`as_crated_at`) values (1,6,8,1,'2015-12-20 20:54:45'),(2,7,9,1,'2015-12-21 02:15:03');

/*Table structure for table `dependent` */

DROP TABLE IF EXISTS `dependent`;

CREATE TABLE `dependent` (
  `dependent_id` int(10) NOT NULL AUTO_INCREMENT,
  `d_user_id` int(15) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text,
  `mail_id` varchar(50) DEFAULT NULL,
  `current_year` varchar(20) DEFAULT NULL,
  `status` smallint(5) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`dependent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `dependent` */

insert  into `dependent`(`dependent_id`,`d_user_id`,`first_name`,`last_name`,`dob`,`occupation`,`phone`,`address`,`mail_id`,`current_year`,`status`,`added_at`,`updated_at`) values (6,4,'Dileep','DKumar','dob','occupation','8500222765','address','abc@gmail.com',NULL,1,'2015-12-13 14:51:31','2015-12-13 14:51:31'),(7,4,'Dileep','DKumar','dob','occupation','8500222765','address','abc@gmail.com',NULL,1,'2015-12-13 14:51:31','2015-12-13 14:51:31'),(8,4,'Dileep','DKumar','dob','occupation','8500222765','address','abc@gmail.com',NULL,1,'2015-12-13 14:51:31','2015-12-13 14:51:31'),(9,4,'Dileep','DKumar','dob','occupation','8500222765','address','abc@gmail.com',NULL,1,'2015-12-13 14:51:31','2015-12-13 14:51:31'),(10,4,'Dileep','DKumar','dob','occupation','8500222765','address','abc@gmail.com',NULL,1,'2015-12-13 14:51:32','2015-12-13 14:51:32');

/*Table structure for table `forgetpassword` */

DROP TABLE IF EXISTS `forgetpassword`;

CREATE TABLE `forgetpassword` (
  `forget_pwd_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `token_id` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`forget_pwd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `forgetpassword` */

/*Table structure for table `processing_status` */

DROP TABLE IF EXISTS `processing_status`;

CREATE TABLE `processing_status` (
  `ps_id` int(11) NOT NULL AUTO_INCREMENT,
  `ps_user_id` int(11) DEFAULT NULL,
  `ps_state` int(10) DEFAULT NULL,
  `ps_added_at` datetime DEFAULT NULL,
  `ps_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `processing_status` */

insert  into `processing_status`(`ps_id`,`ps_user_id`,`ps_state`,`ps_added_at`,`ps_updated_at`) values (1,4,2,'2015-12-16 07:58:33','2015-12-18 01:11:05'),(2,5,1,'2015-12-16 08:00:50',NULL),(3,8,0,'2015-12-21 00:59:02',NULL),(4,9,0,'2015-12-21 00:59:05',NULL);

/*Table structure for table `referral_friends` */

DROP TABLE IF EXISTS `referral_friends`;

CREATE TABLE `referral_friends` (
  `rf_id` int(10) NOT NULL AUTO_INCREMENT,
  `rf_user_id` int(10) DEFAULT NULL,
  `rf_on_name` varchar(50) DEFAULT NULL,
  `rf_on_email` varchar(50) DEFAULT NULL,
  `rf_on_phone` varchar(50) DEFAULT NULL,
  `rf_name` varchar(50) DEFAULT NULL,
  `rf_email` varchar(50) DEFAULT NULL,
  `rf_phone` varchar(50) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `status` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`rf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `referral_friends` */

insert  into `referral_friends`(`rf_id`,`rf_user_id`,`rf_on_name`,`rf_on_email`,`rf_on_phone`,`rf_name`,`rf_email`,`rf_phone`,`added_at`,`status`) values (4,NULL,'Dileep','dileepkumarkonda@gmail.com','8500222765','Kumar','dkonda@aapthitech.com','8500222765','2015-12-07 14:11:32',1);

/*Table structure for table `schedules_timings` */

DROP TABLE IF EXISTS `schedules_timings`;

CREATE TABLE `schedules_timings` (
  `timing_id` int(10) NOT NULL AUTO_INCREMENT,
  `sc_user_id` int(50) DEFAULT NULL,
  `schedule_dt` varchar(50) DEFAULT NULL,
  `schedule_period` varchar(50) DEFAULT NULL,
  `status` smallint(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`timing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `schedules_timings` */

insert  into `schedules_timings`(`timing_id`,`sc_user_id`,`schedule_dt`,`schedule_period`,`status`,`created_at`,`updated_at`) values (3,1,'2015-12-02 23:48:17','12',1,'2015-12-02 19:18:36',NULL),(4,1,'2015-12-02 23:48:17','121',1,'2015-12-02 19:19:49',NULL),(5,4,'5551210  ','121',1,'2015-12-06 12:59:01',NULL);

/*Table structure for table `spouse` */

DROP TABLE IF EXISTS `spouse`;

CREATE TABLE `spouse` (
  `spouse_id` int(10) NOT NULL AUTO_INCREMENT,
  `s_user_id` int(10) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` smallint(2) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`spouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `spouse` */

insert  into `spouse`(`spouse_id`,`s_user_id`,`first_name`,`last_name`,`dob`,`occupation`,`phone`,`status`,`added_at`,`updated_at`) values (5,1,'Devi','Raj','04011988','Software Engineer','9989500502',1,'2015-12-09 22:39:50','2015-12-12 07:07:34'),(8,4,'Anagha','sarath','27-11-1990','software','7799802045',1,'2015-12-13 06:08:32','2015-12-13 06:23:12'),(9,5,'','','','','',1,'2015-12-13 08:05:18',NULL);

/*Table structure for table `synopsys` */

DROP TABLE IF EXISTS `synopsys`;

CREATE TABLE `synopsys` (
  `synopsys_id` int(10) NOT NULL AUTO_INCREMENT,
  `synopsys_user_id` int(11) DEFAULT NULL,
  `synopsys_file` varchar(50) DEFAULT NULL,
  `synopsys_status` smallint(5) DEFAULT NULL,
  `synopsys_created_at` datetime DEFAULT NULL,
  `synopsys_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`synopsys_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `synopsys` */

insert  into `synopsys`(`synopsys_id`,`synopsys_user_id`,`synopsys_file`,`synopsys_status`,`synopsys_created_at`,`synopsys_updated_at`) values (1,9,'sxxx.pdf',1,'2015-12-21 03:42:07','2015-12-21 03:42:11');

/*Table structure for table `upload_pdfs` */

DROP TABLE IF EXISTS `upload_pdfs`;

CREATE TABLE `upload_pdfs` (
  `up_id` int(10) NOT NULL AUTO_INCREMENT,
  `up_user_id` int(50) DEFAULT NULL,
  `w2pdf` text,
  `p1099Int` text,
  `hsa` text,
  `ira` text,
  `healthcard` text,
  `current_year` varchar(20) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`up_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `upload_pdfs` */

insert  into `upload_pdfs`(`up_id`,`up_user_id`,`w2pdf`,`p1099Int`,`hsa`,`ira`,`healthcard`,`current_year`,`status`,`created_at`,`updated_at`) values (1,4,'State Bank of India.pdf','','State Bank of India.pdf','State Bank of India.pdf','State Bank of India.pdf',NULL,1,'2015-12-13 11:10:27',NULL),(2,4,'State Bank of India.pdf','','State Bank of India.pdf','State Bank of India.pdf','State Bank of India.pdf',NULL,1,'2015-12-13 11:10:27',NULL),(3,4,'State Bank of India.pdf','','State Bank of India.pdf','State Bank of India.pdf','State Bank of India.pdf',NULL,1,'2015-12-13 11:10:27',NULL),(4,4,'State Bank of India.pdf','','State Bank of India.pdf','State Bank of India.pdf','State Bank of India.pdf',NULL,1,'2015-12-13 11:10:28',NULL),(5,4,'State Bank of India.pdf','','State Bank of India.pdf','State Bank of India.pdf','State Bank of India.pdf',NULL,1,'2015-12-13 11:10:28',NULL),(6,4,'CERT- BLANK, main site1.pdf','','CERT- BLANK, main site1.pdf','Business Credit.pdf','Auto Insurance Quote.pdf',NULL,1,'2015-12-13 11:25:41',NULL),(7,4,'CERT- BLANK, main site1.pdf','','CERT- BLANK, main site1.pdf','Business Credit.pdf','Auto Insurance Quote.pdf',NULL,1,'2015-12-13 11:25:41',NULL),(8,4,'CERT- BLANK, main site1.pdf','','CERT- BLANK, main site1.pdf','Business Credit.pdf','Auto Insurance Quote.pdf',NULL,1,'2015-12-13 11:25:42',NULL),(9,4,'CERT- BLANK, main site1.pdf','','CERT- BLANK, main site1.pdf','Business Credit.pdf','Auto Insurance Quote.pdf',NULL,1,'2015-12-13 11:25:42',NULL),(10,4,'CERT- BLANK, main site1.pdf','','CERT- BLANK, main site1.pdf','Business Credit.pdf','Auto Insurance Quote.pdf',NULL,1,'2015-12-13 11:25:42',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `locked_pwd` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `user_type_id` int(50) DEFAULT NULL,
  `logged_ip` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0-active 1-deactive',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_name`,`email`,`password`,`locked_pwd`,`date_added`,`date_updated`,`user_type_id`,`logged_ip`,`status`) values (1,'Dileep','dkonda@aapthitech.com','ea452f3b31ac158c119a0b295740d63e','dileep','2015-11-26 20:09:37','2015-12-12 07:07:28',1,'127.0.0.1',1),(4,'sarath','sarath.anagha@gmail.com','3bad6af0fa4b8b330d162e19938ee981','sarath','2015-12-06 12:25:42','2015-12-13 16:00:36',2,NULL,1),(5,'Hello','xyz@gmail.com','6451d62c34ba801398a21df221f675b6','sarath2@S','2015-12-13 06:25:47','2015-12-13 08:02:01',2,NULL,1),(6,'Unlist1','abc@gmail.com','ea452f3b31ac158c119a0b295740d63e','dileep','2015-12-04 00:53:10','2015-12-21 00:53:25',3,'127.0.0.1',1),(7,'Unlist','def@gmail.com','ea452f3b31ac158c119a0b295740d63e','dileep','2015-12-21 00:54:27','2015-12-21 00:54:31',3,'127.0.0.1',1),(8,'NewUser','hij@gmail.com','ea452f3b31ac158c119a0b295740d63e','dileep','2015-12-05 00:55:26','2015-12-21 00:55:33',2,NULL,1),(9,'NewUser2','klm@gmail.com','ea452f3b31ac158c119a0b295740d63e','dileep','2015-12-21 00:55:55','2015-12-21 00:55:59',2,'',1);

/*Table structure for table `user_details` */

DROP TABLE IF EXISTS `user_details`;

CREATE TABLE `user_details` (
  `user_details_id` int(12) NOT NULL AUTO_INCREMENT,
  `u_user_id` int(15) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `current_emp` varchar(10) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `address` text,
  `city_name` varchar(50) DEFAULT NULL,
  `state_name` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `apt_no` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `alterphone` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `tax_id_type` varchar(10) DEFAULT NULL,
  `dependent` varchar(5) DEFAULT NULL,
  `relation_ship` varchar(10) DEFAULT NULL,
  `ssnitin` varchar(10) DEFAULT NULL,
  `visa_type` varchar(15) DEFAULT NULL,
  `c_location` varchar(10) DEFAULT NULL,
  `filling_status` varchar(10) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`user_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `user_details` */

insert  into `user_details`(`user_details_id`,`u_user_id`,`first_name`,`last_name`,`occupation`,`current_emp`,`dob`,`address`,`city_name`,`state_name`,`zip`,`apt_no`,`phone`,`alterphone`,`status`,`tax_id_type`,`dependent`,`relation_ship`,`ssnitin`,`visa_type`,`c_location`,`filling_status`,`date_added`,`date_updated`) values (1,1,'Dileep','Kumar','occupation','Aapthi','986256','Address','City name','state name','500049','78787','8500222765','8500222765',1,'1855','1','rq','s2-s3-s4','1','EEE','2','2015-11-26 20:09:37','2015-12-12 07:07:28'),(4,4,'sarath','chandra','software','hf','16-05-1990','ssss','','dfq','523002','dsad','8500222765','67',1,'','2',NULL,NULL,NULL,'RESOURCEON','2','2015-12-06 12:25:42','2015-12-13 16:00:36'),(5,5,'Hello','World','software','zczxczc','cxzczxc','','','','czxczc','','7799802044','zczczc',1,'','Yes',NULL,NULL,NULL,'sadsadasd','zxczxczxc','2015-12-13 06:25:47','2015-12-13 08:02:02'),(6,6,'Unlist1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8500222765','8500222765',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,7,'Unlist2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8500222765','8500222765',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,8,'NewUser1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8500222765','8500222765',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,9,'NewUser2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8500222765','8500222765',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `user_type_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_type` */

insert  into `user_type`(`user_type_id`,`user_type`,`status`) values (1,'admin',1),(2,'user',1),(3,'agent',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
