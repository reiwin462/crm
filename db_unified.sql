/*
SQLyog Community v12.5.0 (64 bit)
MySQL - 10.1.28-MariaDB : Database - db_unified
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_unified` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_unified`;

/*Table structure for table `asset_condition` */

DROP TABLE IF EXISTS `asset_condition`;

CREATE TABLE `asset_condition` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `asset_location` */

DROP TABLE IF EXISTS `asset_location`;

CREATE TABLE `asset_location` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gps_id` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `message` varbinary(255) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `asset_ownership` */

DROP TABLE IF EXISTS `asset_ownership`;

CREATE TABLE `asset_ownership` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `asset_repair` */

DROP TABLE IF EXISTS `asset_repair`;

CREATE TABLE `asset_repair` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) DEFAULT NULL,
  `repair_reason` varchar(100) DEFAULT NULL,
  `repair_details` text,
  `status` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `asset_repair_details` */

DROP TABLE IF EXISTS `asset_repair_details`;

CREATE TABLE `asset_repair_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) DEFAULT NULL,
  `repair_item` varchar(100) DEFAULT NULL,
  `repair_description` text,
  `assigned_team` varchar(100) DEFAULT NULL,
  `repair_status` varchar(50) DEFAULT NULL,
  `repair_cost` decimal(10,2) DEFAULT NULL,
  `action_taken` text,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `asset_repair_status` */

DROP TABLE IF EXISTS `asset_repair_status`;

CREATE TABLE `asset_repair_status` (
  `id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `asset_type` */

DROP TABLE IF EXISTS `asset_type`;

CREATE TABLE `asset_type` (
  `rowid` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `assets` */

DROP TABLE IF EXISTS `assets`;

CREATE TABLE `assets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `serialno` varchar(100) DEFAULT NULL,
  `modelno` varchar(100) DEFAULT NULL,
  `stock_type` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `procurement_date` date DEFAULT NULL,
  `warranty_exp_date` date DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `condition` varchar(100) DEFAULT NULL,
  `ownership` varchar(50) DEFAULT NULL,
  `comment` text,
  `gps_id` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `audit_log` */

DROP TABLE IF EXISTS `audit_log`;

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `module` varchar(30) DEFAULT NULL,
  `operation` varchar(30) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `auth_accounts` */

DROP TABLE IF EXISTS `auth_accounts`;

CREATE TABLE `auth_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(70) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `fullname` varchar(120) DEFAULT NULL,
  `level` enum('ADMIN','VIEWER','EDITOR') DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_announcement` */

DROP TABLE IF EXISTS `crm_announcement`;

CREATE TABLE `crm_announcement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `message` text,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `crm_attachment` */

DROP TABLE IF EXISTS `crm_attachment`;

CREATE TABLE `crm_attachment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) DEFAULT NULL,
  `file` varchar(40) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `crm_campaign` */

DROP TABLE IF EXISTS `crm_campaign`;

CREATE TABLE `crm_campaign` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `campaign_owner` varchar(40) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `campaign_name` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `campaign_type` varchar(30) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `campaign_status` varchar(30) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `expected_revenue` decimal(10,0) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `budgeted_cost` decimal(10,0) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `actual_cost` decimal(10,0) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `expected_response` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `start_date` datetime DEFAULT NULL COMMENT '1|DATE|NONE',
  `end_date` datetime DEFAULT NULL COMMENT '1|DATE|NONE',
  `description` varchar(50) DEFAULT NULL COMMENT '1|TEXTAREA|NONE',
  `created_by` varchar(30) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `modified_by` varchar(30) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_contacts` */

DROP TABLE IF EXISTS `crm_contacts`;

CREATE TABLE `crm_contacts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Contact_Owner` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Account_Name` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Contact_Name` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Email` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Lead_Source` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Vendor_Name` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Phone` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Other_Phone` varchar(50) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `Title` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Department` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Mobile` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Home_Phone` varchar(50) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `Fax` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Assistant` varchar(50) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `Date_of_Birth` date DEFAULT NULL COMMENT '1|DATE|NONE',
  `SkypeID` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Twitter` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Mailing_Street` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Mailing_City` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Mailing_State` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Mailing_Zip` varchar(10) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `Mailing_Country` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` varchar(15) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_country` */

DROP TABLE IF EXISTS `crm_country`;

CREATE TABLE `crm_country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_disposition` */

DROP TABLE IF EXISTS `crm_disposition`;

CREATE TABLE `crm_disposition` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_dropdown` */

DROP TABLE IF EXISTS `crm_dropdown`;

CREATE TABLE `crm_dropdown` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dropdownitem` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `crm_industry` */

DROP TABLE IF EXISTS `crm_industry`;

CREATE TABLE `crm_industry` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(40) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_lead_description` */

DROP TABLE IF EXISTS `crm_lead_description`;

CREATE TABLE `crm_lead_description` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `details` varchar(50) DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `created_datetime` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_lead_source` */

DROP TABLE IF EXISTS `crm_lead_source`;

CREATE TABLE `crm_lead_source` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_lead_stat` */

DROP TABLE IF EXISTS `crm_lead_stat`;

CREATE TABLE `crm_lead_stat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `crm_lead_status` */

DROP TABLE IF EXISTS `crm_lead_status`;

CREATE TABLE `crm_lead_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `created_datetime` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_leads` */

DROP TABLE IF EXISTS `crm_leads`;

CREATE TABLE `crm_leads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lead_owner` varchar(30) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `first_name` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `lastname` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `title` varchar(15) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `phone` varchar(20) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `mobile` varchar(20) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `lead_source` varchar(40) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_lead_source`',
  `industry` varchar(40) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_industry`',
  `company` varchar(40) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `email` varchar(40) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `fax` varchar(30) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `website` varchar(30) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `lead_status` varchar(30) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_lead_status`',
  `skype_id` varchar(30) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `twitter` varchar(30) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `secondary_email` varchar(30) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `street` varchar(50) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `city` varchar(50) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `state` varchar(20) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_state`',
  `zipcode` varchar(10) DEFAULT NULL COMMENT '0|TEXT|NONE',
  `country` varchar(30) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_country`',
  `info` text COMMENT '1|TEXTAREA|NONE',
  `create_by` varchar(20) DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `crm_notes` */

DROP TABLE IF EXISTS `crm_notes`;

CREATE TABLE `crm_notes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `title` varchar(40) DEFAULT NULL,
  `text` text,
  `file_attachment` varchar(30) DEFAULT NULL,
  `path` varbinary(40) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_sales_representative` */

DROP TABLE IF EXISTS `crm_sales_representative`;

CREATE TABLE `crm_sales_representative` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `created_datetime` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_state` */

DROP TABLE IF EXISTS `crm_state`;

CREATE TABLE `crm_state` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) DEFAULT NULL,
  `abbreviation` varchar(150) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_task` */

DROP TABLE IF EXISTS `crm_task`;

CREATE TABLE `crm_task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lead_id` int(10) DEFAULT NULL COMMENT '1|HIDDEN|NONE',
  `subject` varchar(40) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `due_date` datetime DEFAULT NULL COMMENT '1|DATE|NONE',
  `priority` enum('High','Low','Lowest','Normal') DEFAULT NULL COMMENT '1|ENUM|NONE',
  `owner` varchar(30) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `status` enum('Deferred','In Progress','Completed','Waiting for Input','Not Started') DEFAULT NULL COMMENT '1|ENUM|NONE',
  `description` text COMMENT '1|TEXTAREA|NONE',
  `created_by` varchar(30) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `crm_typeofwork` */

DROP TABLE IF EXISTS `crm_typeofwork`;

CREATE TABLE `crm_typeofwork` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `deduction_master` */

DROP TABLE IF EXISTS `deduction_master`;

CREATE TABLE `deduction_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `deduction_type` varchar(40) DEFAULT NULL,
  `amt` int(11) DEFAULT NULL,
  `period` varchar(20) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `deduction_type` */

DROP TABLE IF EXISTS `deduction_type`;

CREATE TABLE `deduction_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `email_accounts` */

DROP TABLE IF EXISTS `email_accounts`;

CREATE TABLE `email_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `email` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `comment` varchar(100) DEFAULT NULL COMMENT '1|TEXTAREA|NONE',
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `email_logs` */

DROP TABLE IF EXISTS `email_logs`;

CREATE TABLE `email_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` varchar(10) DEFAULT NULL,
  `mailto` varchar(100) DEFAULT NULL,
  `mailcc` varchar(100) DEFAULT NULL,
  `mailbcc` varchar(100) DEFAULT NULL,
  `mailsubject` varchar(100) DEFAULT NULL,
  `mailcontent` text,
  `mailattach` varchar(100) DEFAULT NULL,
  `mail_type` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Table structure for table `employee_department` */

DROP TABLE IF EXISTS `employee_department`;

CREATE TABLE `employee_department` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(100) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `employee_designation` */

DROP TABLE IF EXISTS `employee_designation`;

CREATE TABLE `employee_designation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(100) DEFAULT NULL,
  `description` varchar(40) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `employee_info` */

DROP TABLE IF EXISTS `employee_info`;

CREATE TABLE `employee_info` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(100) DEFAULT NULL,
  `emp_nick` varchar(50) DEFAULT NULL,
  `emp_last` varchar(30) DEFAULT NULL,
  `emp_first` varchar(30) DEFAULT NULL,
  `emp_mi` varchar(30) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `marital_status` varchar(15) DEFAULT NULL,
  `emp_status` varchar(20) DEFAULT NULL,
  `add_street` varchar(50) DEFAULT NULL,
  `add_unit` varchar(5) DEFAULT NULL,
  `add_city` varchar(50) DEFAULT NULL,
  `add_country` varchar(100) DEFAULT NULL,
  `add_state` varchar(50) DEFAULT NULL,
  `add_zipcode` varchar(10) DEFAULT NULL,
  `designation` varchar(30) DEFAULT NULL,
  `hourly_rate` int(11) DEFAULT NULL,
  `monthly_rate` int(11) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Table structure for table `employee_logs` */

DROP TABLE IF EXISTS `employee_logs`;

CREATE TABLE `employee_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(30) DEFAULT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `employee_name` varchar(30) DEFAULT NULL,
  `job` varchar(25) DEFAULT NULL,
  `task` varchar(20) DEFAULT NULL,
  `scope` varchar(25) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `group_entry` enum('Y','N') DEFAULT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `employee_timesheet` */

DROP TABLE IF EXISTS `employee_timesheet`;

CREATE TABLE `employee_timesheet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(30) DEFAULT NULL,
  `employee_id` varchar(10) DEFAULT NULL,
  `employee_name` varchar(30) DEFAULT NULL,
  `payroll_period` varchar(20) DEFAULT NULL,
  `ttl_hours` int(11) DEFAULT NULL,
  `ttl_ot` int(11) DEFAULT NULL,
  `timesheet_type` varchar(40) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `status` enum('Approved','Rejected','Pending') DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `employee_type` */

DROP TABLE IF EXISTS `employee_type`;

CREATE TABLE `employee_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `equipment_tracking` */

DROP TABLE IF EXISTS `equipment_tracking`;

CREATE TABLE `equipment_tracking` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `equip_code` varchar(30) DEFAULT NULL,
  `operator_name` varchar(30) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `project_name` varchar(30) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `estimate_bidsummary` */

DROP TABLE IF EXISTS `estimate_bidsummary`;

CREATE TABLE `estimate_bidsummary` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `subdesc` varchar(100) DEFAULT NULL,
  `cost` decimal(15,2) DEFAULT NULL,
  `markup` decimal(10,0) DEFAULT NULL,
  `totalbid` decimal(15,2) DEFAULT NULL,
  `createdby` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_equipment` */

DROP TABLE IF EXISTS `estimate_equipment`;

CREATE TABLE `estimate_equipment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `rateperhour` decimal(15,2) DEFAULT NULL,
  `rateperdshift` decimal(15,2) DEFAULT NULL,
  `fuelgalpershift` decimal(15,2) DEFAULT NULL,
  `consumedgalpershift` decimal(15,2) DEFAULT NULL,
  `fuelpergal` decimal(15,2) DEFAULT NULL,
  `createdby` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_jobcost` */

DROP TABLE IF EXISTS `estimate_jobcost`;

CREATE TABLE `estimate_jobcost` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `actualmisc` decimal(15,2) DEFAULT NULL,
  `actuallabor` decimal(15,2) DEFAULT NULL,
  `actualequipment` decimal(15,2) DEFAULT NULL,
  `actualmaterial` decimal(15,2) DEFAULT NULL,
  `actualsubcon` decimal(15,2) DEFAULT NULL,
  `jblabor` decimal(15,2) DEFAULT NULL,
  `jbmisc` decimal(15,2) DEFAULT NULL,
  `jbpermmaterial` decimal(15,2) DEFAULT NULL,
  `jbsupplies` decimal(15,2) DEFAULT NULL,
  `jboutequip` decimal(15,2) DEFAULT NULL,
  `jbsubstence` decimal(15,2) DEFAULT NULL,
  `jbbackcharge` decimal(15,2) DEFAULT NULL,
  `grossmargin` decimal(15,2) DEFAULT NULL,
  `internalequip` decimal(15,2) DEFAULT NULL,
  `ohprofit` decimal(15,2) DEFAULT NULL,
  `createdby` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_labor` */

DROP TABLE IF EXISTS `estimate_labor`;

CREATE TABLE `estimate_labor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `rate` decimal(15,2) DEFAULT NULL,
  `fringe_perhour` decimal(15,2) DEFAULT NULL,
  `cost_perhour` decimal(15,2) DEFAULT NULL,
  `diem_pershift` decimal(15,2) DEFAULT NULL,
  `cost_pershift` decimal(15,2) DEFAULT NULL,
  `prt` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_master` */

DROP TABLE IF EXISTS `estimate_master`;

CREATE TABLE `estimate_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `estimatedby` varchar(100) DEFAULT NULL,
  `estimateddate` date DEFAULT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `project_type` varchar(100) DEFAULT NULL,
  `client` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `typeofwork` varchar(50) DEFAULT NULL,
  `stdshift` int(5) DEFAULT NULL,
  `premshift1` int(5) DEFAULT NULL,
  `premshift2` int(5) DEFAULT NULL,
  `unitqty` decimal(10,0) DEFAULT NULL,
  `totaldays` int(5) DEFAULT NULL,
  `points` decimal(10,0) DEFAULT NULL,
  `prt` decimal(15,2) DEFAULT NULL,
  `fuelcost` decimal(15,2) DEFAULT NULL,
  `sales_tax` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_material` */

DROP TABLE IF EXISTS `estimate_material`;

CREATE TABLE `estimate_material` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `units` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `costperunit` decimal(15,2) DEFAULT NULL,
  `totalcost` decimal(15,2) DEFAULT NULL,
  `salestax` decimal(15,2) DEFAULT NULL,
  `createdby` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_misc` */

DROP TABLE IF EXISTS `estimate_misc`;

CREATE TABLE `estimate_misc` (
  `id` int(10) NOT NULL DEFAULT '0',
  `code` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `units` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `costperunit` decimal(15,2) DEFAULT NULL,
  `totalcost` decimal(15,2) DEFAULT NULL,
  `createdby` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_subcon` */

DROP TABLE IF EXISTS `estimate_subcon`;

CREATE TABLE `estimate_subcon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `subcon` varchar(100) DEFAULT NULL,
  `typeofwork` varchar(100) DEFAULT NULL,
  `quote` decimal(15,2) DEFAULT NULL,
  `createdby` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_summary` */

DROP TABLE IF EXISTS `estimate_summary`;

CREATE TABLE `estimate_summary` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `laborstd` decimal(15,2) DEFAULT NULL,
  `labor1` decimal(15,2) DEFAULT NULL,
  `labor2` decimal(15,2) DEFAULT NULL,
  `equipment` decimal(15,2) DEFAULT NULL,
  `material` decimal(15,2) DEFAULT NULL,
  `mobilization` decimal(15,2) DEFAULT NULL,
  `subcontract` decimal(15,2) DEFAULT NULL,
  `liabilities` decimal(15,2) DEFAULT NULL,
  `pricecf` decimal(15,2) DEFAULT NULL,
  `pricept` decimal(15,2) DEFAULT NULL,
  `createdby` varbinary(20) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `estimate_worktype` */

DROP TABLE IF EXISTS `estimate_worktype`;

CREATE TABLE `estimate_worktype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `expenses_type` */

DROP TABLE IF EXISTS `expenses_type`;

CREATE TABLE `expenses_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(100) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `infokit_lessons` */

DROP TABLE IF EXISTS `infokit_lessons`;

CREATE TABLE `infokit_lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `attachment` varchar(70) DEFAULT NULL,
  `attachment_type` varchar(50) DEFAULT NULL,
  `created_by` varchar(70) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `infokit_topics` */

DROP TABLE IF EXISTS `infokit_topics`;

CREATE TABLE `infokit_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(70) DEFAULT NULL,
  `description` text,
  `lesson_sequence` text,
  `created_by` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `job_scheduling` */

DROP TABLE IF EXISTS `job_scheduling`;

CREATE TABLE `job_scheduling` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(30) DEFAULT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `employee_name` varchar(30) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `ttl_hour` int(2) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `user` varchar(15) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `leave_request` */

DROP TABLE IF EXISTS `leave_request`;

CREATE TABLE `leave_request` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(30) DEFAULT NULL,
  `employee_id` int(20) DEFAULT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `leave_type` varchar(20) DEFAULT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `status` enum('Pending','Rejected','Approved') DEFAULT 'Pending',
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `leave_type` */

DROP TABLE IF EXISTS `leave_type`;

CREATE TABLE `leave_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(100) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `materials` */

DROP TABLE IF EXISTS `materials`;

CREATE TABLE `materials` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `online_sessions` */

DROP TABLE IF EXISTS `online_sessions`;

CREATE TABLE `online_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `online_sessions_crm` */

DROP TABLE IF EXISTS `online_sessions_crm`;

CREATE TABLE `online_sessions_crm` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `overtime_request` */

DROP TABLE IF EXISTS `overtime_request`;

CREATE TABLE `overtime_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(30) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `status` enum('Pending','Rejected','Approved') DEFAULT 'Pending',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(20) DEFAULT NULL,
  `approver` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `payroll_master` */

DROP TABLE IF EXISTS `payroll_master`;

CREATE TABLE `payroll_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `timesheet` varchar(10) DEFAULT NULL,
  `period` varchar(10) DEFAULT NULL,
  `ttl_deduction` int(11) DEFAULT NULL,
  `ttl_gross` int(11) DEFAULT NULL,
  `ttl_net` int(11) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `payroll_period` */

DROP TABLE IF EXISTS `payroll_period`;

CREATE TABLE `payroll_period` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `project_bidders` */

DROP TABLE IF EXISTS `project_bidders`;

CREATE TABLE `project_bidders` (
  `id` int(10) NOT NULL DEFAULT '0',
  `project_id` int(10) DEFAULT NULL,
  `list` text,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `project_bidding` */

DROP TABLE IF EXISTS `project_bidding`;

CREATE TABLE `project_bidding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_date` datetime DEFAULT NULL,
  `bid_agent` varchar(20) DEFAULT NULL,
  `job_name` varchar(70) DEFAULT NULL,
  `project_type` varchar(50) DEFAULT NULL,
  `bid_completed` int(11) DEFAULT NULL,
  `rebid` enum('Y','N') DEFAULT NULL,
  `old_bid_date` datetime DEFAULT NULL,
  `prebid_meeting_date` datetime DEFAULT NULL,
  `job_location` varchar(70) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `project_valuation` varchar(100) DEFAULT NULL,
  `sc_method` varchar(50) DEFAULT NULL,
  `delivery_system` varchar(50) DEFAULT NULL,
  `owner_type` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `web_info` longtext,
  `website` varchar(100) DEFAULT NULL,
  `sales_officer` varchar(100) DEFAULT NULL,
  `lead_description` varchar(100) DEFAULT NULL,
  `attachment` text,
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Table structure for table `project_call_logs` */

DROP TABLE IF EXISTS `project_call_logs`;

CREATE TABLE `project_call_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` varchar(10) DEFAULT NULL,
  `callnotes` text COMMENT '1|TEXTAREA|NONE',
  `disposition` varchar(100) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_disposition`',
  `callback_date` datetime DEFAULT NULL COMMENT '1|DATETIME|NONE',
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `callback_notify` varchar(10) DEFAULT 'NO',
  `acknowledge_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `project_engineers` */

DROP TABLE IF EXISTS `project_engineers`;

CREATE TABLE `project_engineers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `list` text,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `project_future_leads` */

DROP TABLE IF EXISTS `project_future_leads`;

CREATE TABLE `project_future_leads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `link` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `lead_source` varchar(50) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_lead_source`',
  `type_of_work` varchar(50) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_typeofwork`',
  `engineers_list` text,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `project_lead_stat` */

DROP TABLE IF EXISTS `project_lead_stat`;

CREATE TABLE `project_lead_stat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `project_leads` */

DROP TABLE IF EXISTS `project_leads`;

CREATE TABLE `project_leads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_no` varchar(20) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `project_name` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `lead_status` varchar(50) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_lead_description`',
  `sales_representative` varchar(50) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_sales_representative`',
  `bid_date` date DEFAULT NULL COMMENT '1|DATE|NONE',
  `client_name` varchar(150) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `type_of_work` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `address` varchar(150) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `bid_value` decimal(15,2) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `lead_source` varchar(20) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_lead_source`',
  `project_status` varchar(50) DEFAULT NULL COMMENT '1|DROPDOWN|SELECT description FROM `crm_lead_stat`',
  `link` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `job_address` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `specification` text COMMENT '1|TEXTAREA|NONE',
  `project_scope` text,
  `more_info` text,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `help` varchar(50) DEFAULT 'YES' COMMENT '1|DROPDOWN|SELECT description FROM `crm_sales_representative`',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Table structure for table `project_planholders` */

DROP TABLE IF EXISTS `project_planholders`;

CREATE TABLE `project_planholders` (
  `id` int(10) NOT NULL DEFAULT '0',
  `project_id` int(10) DEFAULT NULL,
  `list` text,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `project_rfi` */

DROP TABLE IF EXISTS `project_rfi`;

CREATE TABLE `project_rfi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `project_number` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `project_name` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `specification_number` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `project_engineer` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `structural_engineer` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `contact_no_1` varchar(20) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `contact_no_2` varchar(20) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `email_address` varchar(50) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `rfi_request` text COMMENT '1|TEXTAREA|NONE',
  `send_to` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `send_date` date DEFAULT NULL COMMENT '1|DATE|NONE',
  `reply_from_engineer` text COMMENT '1|TEXTAREA|NONE',
  `date_recieved` date DEFAULT NULL COMMENT '1|DATE|NONE',
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `project_type` */

DROP TABLE IF EXISTS `project_type`;

CREATE TABLE `project_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_firestore` varchar(100) DEFAULT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `client_name` varchar(50) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `project_type` varchar(20) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `rate_equipment` */

DROP TABLE IF EXISTS `rate_equipment`;

CREATE TABLE `rate_equipment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `equip_no` int(11) DEFAULT NULL,
  `class` varchar(30) DEFAULT NULL,
  `fa_rate` int(11) DEFAULT NULL,
  `geo_rate` int(11) DEFAULT NULL,
  `make` varchar(30) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `ot_factor` varchar(20) DEFAULT NULL,
  `row_delay` float DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `rate_labor` */

DROP TABLE IF EXISTS `rate_labor`;

CREATE TABLE `rate_labor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class` varchar(30) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `st_hour` int(11) DEFAULT NULL,
  `st_rate` int(11) DEFAULT NULL,
  `ot_hour` int(11) DEFAULT NULL,
  `ot_rate` int(11) DEFAULT NULL,
  `dt_hour` int(11) DEFAULT NULL,
  `dt_rate` int(11) DEFAULT NULL,
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `tbldocuments` */

DROP TABLE IF EXISTS `tbldocuments`;

CREATE TABLE `tbldocuments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `doc_filename` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `doc_keywords` varchar(100) DEFAULT NULL COMMENT '1|TEXT|NONE',
  `doc_Content` text COMMENT '1|TEXTAREA|NONE',
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Table structure for table `tblplan` */

DROP TABLE IF EXISTS `tblplan`;

CREATE TABLE `tblplan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `detail` varchar(100) DEFAULT NULL,
  `filename_path` varchar(100) DEFAULT NULL,
  `filename_type` varchar(50) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Table structure for table `template_bidsummary` */

DROP TABLE IF EXISTS `template_bidsummary`;

CREATE TABLE `template_bidsummary` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worktype` int(5) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `subcat` varchar(100) DEFAULT NULL,
  `markup` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Table structure for table `template_equipment` */

DROP TABLE IF EXISTS `template_equipment`;

CREATE TABLE `template_equipment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worktype` int(5) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `rateperhour` decimal(15,2) DEFAULT NULL,
  `fuelpergal` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

/*Table structure for table `template_labor` */

DROP TABLE IF EXISTS `template_labor`;

CREATE TABLE `template_labor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worktype` int(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `hourlyrate` decimal(15,2) DEFAULT NULL,
  `fringecost` decimal(15,2) DEFAULT NULL,
  `diem` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

/*Table structure for table `template_material` */

DROP TABLE IF EXISTS `template_material`;

CREATE TABLE `template_material` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worktype` int(5) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `units` varchar(50) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `costperunit` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Table structure for table `template_misc` */

DROP TABLE IF EXISTS `template_misc`;

CREATE TABLE `template_misc` (
  `id` int(10) NOT NULL DEFAULT '0',
  `worktype` int(5) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `units` varchar(50) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `costperunit` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `template_subcon` */

DROP TABLE IF EXISTS `template_subcon`;

CREATE TABLE `template_subcon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worktype` int(10) DEFAULT NULL,
  `subcon` varchar(100) DEFAULT NULL,
  `typeofwork` varchar(100) DEFAULT NULL,
  `quote` decimal(15,2) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `timesheet_type` */

DROP TABLE IF EXISTS `timesheet_type`;

CREATE TABLE `timesheet_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(40) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
