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
-- Dumping data for table `apps`
--

LOCK TABLES `apps` WRITE;
/*!40000 ALTER TABLE `apps` DISABLE KEYS */;
REPLACE INTO `apps` VALUES (1,1,'Visage','Visage','no-reply@visage.jobs','no-reply@visage.jobs','USD','','','','','ssl','tech@visage.jobs','password',0,0,'s4ujT08g9oRbVFqxM6qcFNLnFVFnsL',-1,0,1,'',NULL,NULL,'1.png','jpeg,jpg,gif,png,pdf,zip',0);
/*!40000 ALTER TABLE `apps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ares`
--

LOCK TABLES `ares` WRITE;
/*!40000 ALTER TABLE `ares` DISABLE KEYS */;
/*!40000 ALTER TABLE `ares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ares_emails`
--

LOCK TABLES `ares_emails` WRITE;
/*!40000 ALTER TABLE `ares_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `ares_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
REPLACE INTO `login` VALUES (1,'Emmanuel Marboeuf','Visage','tech@visage.jobs','e9c43c7637ecc774eb3524870044b83fd6011127a07a19dd3b035d171c3b78da7bfb3354ca0311a3db81399cc44f5da04ca59dbc9c3751b36588227f55e00fc5','AKIAIPRQN3AYGINNXRAQ','NgVBOxtH6KEYjdPcu5r5xPqiaTHtwqHpEM8oPCNN','JbWa37jWGkBm626pmTOA','cMzXN5POnqIOM9rVFyA1fZOZ6w5BJNud','America/Los_Angeles',NULL,NULL,'',0,0,1,'en_US',0,'email.us-west-2.amazonaws.com',0,NULL),(2,'Visage','Visage','no-reply@visage.jobs','e0237d5f4d9a66efd749a2b1eecf6775bb636140f345b064070c8e2b1bd6e0d6a41efe10a75baec42449b7ab9d65d08b22dfe5ca357912c261f63839a99c3fb4',NULL,NULL,NULL,NULL,'America/Los_Angeles',1,1,NULL,0,0,0,'en_US',0,NULL,0,NULL);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `queue`
--

LOCK TABLES `queue` WRITE;
/*!40000 ALTER TABLE `queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
/*!40000 ALTER TABLE `template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `zapier`
--

LOCK TABLES `zapier` WRITE;
/*!40000 ALTER TABLE `zapier` DISABLE KEYS */;
/*!40000 ALTER TABLE `zapier` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-07 18:02:43
