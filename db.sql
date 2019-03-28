-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: bulk_sms
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `campaign`
--
CREATE DATABASE bulk_sms;
USE bulk_sms;
DROP TABLE IF EXISTS `campaign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(45) NOT NULL,
  `message` varchar(360) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `source_address` varchar(45) NOT NULL,
  `encoding` varchar(45) NOT NULL,
  `subscriber_list_id` int(11) NOT NULL DEFAULT '0',
  `plan_id` int(11) NOT NULL DEFAULT '0',
  `delivery_receipt_flag` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_number` int(11) DEFAULT NULL,
  `archived_at` datetime DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `row_current` int(11) NOT NULL DEFAULT '0',
  `submit_response_received` int(11) NOT NULL DEFAULT '0',
  `delivery_receipt_received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms_package`
--

DROP TABLE IF EXISTS `sms_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_package` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(45) NOT NULL,
  `description` varchar(360) DEFAULT '',
  `enabled` bit(1) NOT NULL DEFAULT b'0',
  `sms_quota` int(11) DEFAULT '0',
  `sms_per_second` int(11) DEFAULT '0',
  `validity` int(11) DEFAULT '0',
  `number_of_subscribers` int(11) DEFAULT '0',
  `is_registered_delivery` bit(1) DEFAULT b'0',
  `encoding_type` varchar(45) DEFAULT 'UTF-8',
  `price` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_number` int(11) DEFAULT NULL,
  `archived_at` datetime DEFAULT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscriber_template`
--

DROP TABLE IF EXISTS `subscriber_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriber_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscribers_list`
--

DROP TABLE IF EXISTS `subscribers_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers_list` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `list_name` varchar(45) NOT NULL,
  `list_table_name` varchar(100) DEFAULT NULL,
  `description` varchar(360) DEFAULT '',
  `enabled` int(11) NOT NULL DEFAULT '0',
  `sent_sms` int(11) NOT NULL DEFAULT '0',
  `expiry_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `archive_number` int(11) DEFAULT NULL,
  `archived_at` datetime DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_15`
--

DROP TABLE IF EXISTS `subscription_27_15`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_15` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1837 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_27`
--

DROP TABLE IF EXISTS `subscription_27_27`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_27` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1037 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_36`
--

DROP TABLE IF EXISTS `subscription_27_36`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_36` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_37`
--

DROP TABLE IF EXISTS `subscription_27_37`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_37` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_38`
--

DROP TABLE IF EXISTS `subscription_27_38`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_38` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_39`
--

DROP TABLE IF EXISTS `subscription_27_39`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_39` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_40`
--

DROP TABLE IF EXISTS `subscription_27_40`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_40` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_41`
--

DROP TABLE IF EXISTS `subscription_27_41`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_41` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_42`
--

DROP TABLE IF EXISTS `subscription_27_42`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_42` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_43`
--

DROP TABLE IF EXISTS `subscription_27_43`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_43` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_44`
--

DROP TABLE IF EXISTS `subscription_27_44`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_44` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_45`
--

DROP TABLE IF EXISTS `subscription_27_45`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_45` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1012 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_48`
--

DROP TABLE IF EXISTS `subscription_27_48`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_48` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_50`
--

DROP TABLE IF EXISTS `subscription_27_50`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_50` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_52`
--

DROP TABLE IF EXISTS `subscription_27_52`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_52` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_53`
--

DROP TABLE IF EXISTS `subscription_27_53`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_53` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_54`
--

DROP TABLE IF EXISTS `subscription_27_54`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_54` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_55`
--

DROP TABLE IF EXISTS `subscription_27_55`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_55` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_56`
--

DROP TABLE IF EXISTS `subscription_27_56`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_56` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_57`
--

DROP TABLE IF EXISTS `subscription_27_57`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_57` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_58`
--

DROP TABLE IF EXISTS `subscription_27_58`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_58` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_59`
--

DROP TABLE IF EXISTS `subscription_27_59`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_59` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_60`
--

DROP TABLE IF EXISTS `subscription_27_60`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_60` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_61`
--

DROP TABLE IF EXISTS `subscription_27_61`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_61` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_63`
--

DROP TABLE IF EXISTS `subscription_27_63`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_63` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_64`
--

DROP TABLE IF EXISTS `subscription_27_64`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_64` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_65`
--

DROP TABLE IF EXISTS `subscription_27_65`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_65` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_68`
--

DROP TABLE IF EXISTS `subscription_27_68`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_68` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_73`
--

DROP TABLE IF EXISTS `subscription_27_73`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_73` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_74`
--

DROP TABLE IF EXISTS `subscription_27_74`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_74` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_27_75`
--

DROP TABLE IF EXISTS `subscription_27_75`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_27_75` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_52_19`
--

DROP TABLE IF EXISTS `subscription_52_19`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_52_19` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_53_20`
--

DROP TABLE IF EXISTS `subscription_53_20`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_53_20` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_21`
--

DROP TABLE IF EXISTS `subscription_65_21`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_21` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1080 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_22`
--

DROP TABLE IF EXISTS `subscription_65_22`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_22` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_23`
--

DROP TABLE IF EXISTS `subscription_65_23`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_23` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_28`
--

DROP TABLE IF EXISTS `subscription_65_28`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_28` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_29`
--

DROP TABLE IF EXISTS `subscription_65_29`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_29` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_30`
--

DROP TABLE IF EXISTS `subscription_65_30`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_30` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_31`
--

DROP TABLE IF EXISTS `subscription_65_31`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_31` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_32`
--

DROP TABLE IF EXISTS `subscription_65_32`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_32` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_33`
--

DROP TABLE IF EXISTS `subscription_65_33`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_33` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_34`
--

DROP TABLE IF EXISTS `subscription_65_34`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_34` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_35`
--

DROP TABLE IF EXISTS `subscription_65_35`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_35` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_46`
--

DROP TABLE IF EXISTS `subscription_65_46`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_46` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_47`
--

DROP TABLE IF EXISTS `subscription_65_47`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_47` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_49`
--

DROP TABLE IF EXISTS `subscription_65_49`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_49` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_51`
--

DROP TABLE IF EXISTS `subscription_65_51`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_51` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_66`
--

DROP TABLE IF EXISTS `subscription_65_66`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_66` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_67`
--

DROP TABLE IF EXISTS `subscription_65_67`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_67` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_69`
--

DROP TABLE IF EXISTS `subscription_65_69`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_69` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_70`
--

DROP TABLE IF EXISTS `subscription_65_70`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_70` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_71`
--

DROP TABLE IF EXISTS `subscription_65_71`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_71` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_72`
--

DROP TABLE IF EXISTS `subscription_65_72`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_72` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_65_76`
--

DROP TABLE IF EXISTS `subscription_65_76`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_65_76` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_68_62`
--

DROP TABLE IF EXISTS `subscription_68_62`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_68_62` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_77_77`
--

DROP TABLE IF EXISTS `subscription_77_77`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_77_77` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_address` varchar(500) DEFAULT NULL,
  `subscribe_at` datetime DEFAULT NULL,
  `unsubscribe_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `encrypted_password` varchar(128) DEFAULT '',
  `reset_password_token` varchar(255) DEFAULT '',
  `reset_password_sent_at` datetime DEFAULT NULL,
  `signup_token` varchar(255) DEFAULT NULL,
  `signup_token_sent_at` datetime DEFAULT NULL,
  `remember_created_at` datetime DEFAULT NULL,
  `sign_in_count` int(11) DEFAULT '0',
  `current_sign_in_at` datetime DEFAULT NULL,
  `last_sign_in_at` datetime DEFAULT NULL,
  `current_sign_in_ip` varchar(255) DEFAULT '',
  `last_sign_in_ip` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` varchar(255) DEFAULT '',
  `first_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `country_region` varchar(255) DEFAULT '',
  `company` varchar(255) DEFAULT '',
  `date_of_birth` datetime DEFAULT NULL,
  `country_code` varchar(255) DEFAULT '',
  `mobile_number` varchar(45) DEFAULT '',
  `archive_number` varchar(255) DEFAULT '',
  `archived_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_users_on_email` (`email`),
  UNIQUE KEY `signup_token_UNIQUE` (`signup_token`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-13 21:50:06
