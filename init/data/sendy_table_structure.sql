-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: sendy_visage
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `apps`
--

DROP TABLE IF EXISTS `apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apps` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `app_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_fee` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_per_recipient` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_ssl` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bounce_setup` int(11) DEFAULT '0',
  `complaint_setup` int(11) DEFAULT '0',
  `app_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allocated_quota` int(11) DEFAULT '-1',
  `current_quota` int(11) DEFAULT '0',
  `day_of_reset` int(11) DEFAULT '1',
  `month_of_next_reset` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_next_reset` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_logo_filename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowed_attachments` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'jpeg,jpg,gif,png,pdf,zip',
  `reports_only` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ares`
--

DROP TABLE IF EXISTS `ares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ares` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `list` int(11) DEFAULT NULL,
  `custom_field` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ares_emails`
--

DROP TABLE IF EXISTS `ares_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ares_emails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ares_id` int(11) DEFAULT NULL,
  `from_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plain_text` longtext COLLATE utf8mb4_unicode_ci,
  `html_text` longtext COLLATE utf8mb4_unicode_ci,
  `query_string` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_condition` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `recipients` int(100) DEFAULT '0',
  `opens` longtext COLLATE utf8mb4_unicode_ci,
  `wysiwyg` int(11) DEFAULT '0',
  `opens_tracking` int(1) DEFAULT '1',
  `links_tracking` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `app` int(11) DEFAULT NULL,
  `from_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plain_text` longtext COLLATE utf8mb4_unicode_ci,
  `html_text` longtext COLLATE utf8mb4_unicode_ci,
  `query_string` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `to_send` int(100) DEFAULT NULL,
  `to_send_lists` mediumtext COLLATE utf8mb4_unicode_ci,
  `recipients` int(100) DEFAULT '0',
  `timeout_check` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opens` longtext COLLATE utf8mb4_unicode_ci,
  `wysiwyg` int(11) DEFAULT '0',
  `quota_deducted` int(11) DEFAULT NULL,
  `send_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lists` mediumtext COLLATE utf8mb4_unicode_ci,
  `timezone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `errors` longtext COLLATE utf8mb4_unicode_ci,
  `bounce_setup` int(11) DEFAULT '0',
  `complaint_setup` int(11) DEFAULT '0',
  `opens_tracking` int(1) DEFAULT '1',
  `links_tracking` int(1) DEFAULT '1',
  `custom_fields` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `ares_emails_id` int(11) DEFAULT NULL,
  `link` varchar(1500) DEFAULT NULL,
  `clicks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_list` int(11) unsigned DEFAULT NULL,
  `app` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opt_in` int(11) DEFAULT '0',
  `confirm_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscribed_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unsubscribed_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thankyou` int(11) DEFAULT '0',
  `thankyou_subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thankyou_message` longtext COLLATE utf8mb4_unicode_ci,
  `goodbye` int(11) DEFAULT '0',
  `goodbye_subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goodbye_message` longtext COLLATE utf8mb4_unicode_ci,
  `confirmation_subject` longtext COLLATE utf8mb4_unicode_ci,
  `confirmation_email` longtext COLLATE utf8mb4_unicode_ci,
  `unsubscribe_all_list` int(11) DEFAULT '1',
  `custom_fields` longtext COLLATE utf8mb4_unicode_ci,
  `prev_count` int(100) DEFAULT '0',
  `currently_processing` int(100) DEFAULT '0',
  `total_records` int(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s3_key` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s3_secret` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_key` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tied_to` int(11) DEFAULT NULL,
  `app` int(11) DEFAULT NULL,
  `paypal` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cron` int(11) DEFAULT '0',
  `cron_ares` int(11) DEFAULT '0',
  `send_rate` int(100) DEFAULT '0',
  `language` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'en_US',
  `cron_csv` int(11) DEFAULT '0',
  `ses_endpoint` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_enabled` int(11) DEFAULT '0',
  `auth_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `queue`
--

DROP TABLE IF EXISTS `queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `query_str` longtext,
  `campaign_id` int(11) DEFAULT NULL,
  `subscriber_id` int(11) DEFAULT NULL,
  `sent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `s_id` (`subscriber_id`),
  KEY `st_id` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_fields` longtext COLLATE utf8mb4_unicode_ci,
  `list` int(11) DEFAULT NULL,
  `unsubscribed` int(11) DEFAULT '0',
  `bounced` int(11) DEFAULT '0',
  `bounce_soft` int(11) DEFAULT '0',
  `complaint` int(11) DEFAULT '0',
  `last_campaign` int(11) DEFAULT NULL,
  `last_ares` int(11) DEFAULT NULL,
  `timestamp` int(100) DEFAULT NULL,
  `join_date` int(100) DEFAULT NULL,
  `confirmed` int(11) DEFAULT '1',
  `messageID` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `s_list` (`list`),
  KEY `s_unsubscribed` (`unsubscribed`),
  KEY `s_bounced` (`bounced`),
  KEY `s_bounce_soft` (`bounce_soft`),
  KEY `s_complaint` (`complaint`),
  KEY `s_confirmed` (`confirmed`),
  KEY `s_timestamp` (`timestamp`),
  KEY `s_email` (`email`),
  KEY `s_last_campaign` (`last_campaign`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `app` int(11) DEFAULT NULL,
  `template_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html_text` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zapier`
--

DROP TABLE IF EXISTS `zapier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zapier` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subscribe_endpoint` varchar(100) DEFAULT NULL,
  `event` varchar(100) DEFAULT NULL,
  `list` int(11) DEFAULT NULL,
  `app` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-04 16:31:31
