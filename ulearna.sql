-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ulearna
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_activations`
--

DROP TABLE IF EXISTS `auth_activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_activations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_activations`
--

LOCK TABLES `auth_activations` WRITE;
/*!40000 ALTER TABLE `auth_activations` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_reset_password`
--

DROP TABLE IF EXISTS `auth_reset_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_reset_password` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_reset_password`
--

LOCK TABLES `auth_reset_password` WRITE;
/*!40000 ALTER TABLE `auth_reset_password` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_reset_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_roles`
--

DROP TABLE IF EXISTS `auth_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_roles`
--

LOCK TABLES `auth_roles` WRITE;
/*!40000 ALTER TABLE `auth_roles` DISABLE KEYS */;
INSERT INTO `auth_roles` VALUES (1,'administrator'),(2,'user'),(3,'trainer');
/*!40000 ALTER TABLE `auth_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_details`
--

DROP TABLE IF EXISTS `feedback_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL DEFAULT 1,
  `trainer_id` int(11) NOT NULL DEFAULT 1,
  `number` int(11) NOT NULL DEFAULT 0,
  `weight` decimal(2,2) DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_details`
--

LOCK TABLES `feedback_details` WRITE;
/*!40000 ALTER TABLE `feedback_details` DISABLE KEYS */;
INSERT INTO `feedback_details` VALUES (1,1,3,8,0.50,'2022-09-06 09:11:40','2022-09-06 13:35:56'),(2,1,4,6,0.40,'2022-09-06 09:11:40','2022-09-06 13:35:57'),(3,1,5,9,0.60,'2022-09-06 09:11:40','2022-09-06 13:35:57'),(4,1,6,7,0.70,'2022-09-06 09:11:40','2022-09-06 13:35:57'),(5,1,7,8,0.90,'2022-09-06 09:11:40','2022-09-06 13:35:57'),(6,2,3,9,0.50,'2022-09-06 09:11:40','2022-09-06 09:11:40'),(7,2,4,7,0.40,'2022-09-06 09:11:40','2022-09-06 09:11:40'),(8,2,5,9,0.60,'2022-09-06 09:11:40','2022-09-06 09:11:40'),(9,2,6,7,0.70,'2022-09-06 09:11:40','2022-09-06 09:11:40'),(10,2,7,8,0.90,'2022-09-06 09:11:40','2022-09-06 09:11:40'),(11,1,2,9,0.60,'2022-09-06 13:35:57','2022-09-06 13:35:57');
/*!40000 ALTER TABLE `feedback_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedbacks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL DEFAULT 1,
  `trainer_id` int(11) NOT NULL DEFAULT 1,
  `number` varchar(30) NOT NULL,
  `final_score` varchar(255) NOT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `reason` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
INSERT INTO `feedbacks` VALUES (1,8,2,'47','7.92','failed','I am not interested',0,'2022-09-06 09:11:39','2022-09-06 14:10:28',NULL),(2,9,2,'40','8','failed',NULL,0,'2022-09-06 09:11:39','2022-09-06 09:11:39',NULL);
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2020-11-06-213431','App\\Database\\Migrations\\AuthTables','default','App',1662454220,1),(2,'2022-09-06-122506','App\\Database\\Migrations\\CreateFeedbackTable','default','App',1662469502,2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `activate_token` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deactivated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'I\'m Admin','admin@admin.com','administrator','$2y$10$znj/0OLpZs29VXyAOPg1jO7e4gz/GJzmrkaF/4jd9ES1yGyXxYqQa',NULL,1,'',1,'2022-09-06 05:42:15','2022-09-06 05:42:15',NULL),(2,'Trainer 1','trainer1@gmail.com','trainer1','$2y$10$Eh6nOxEPLy00kzMX2fVFgOmBC3fwkLeuzACWY9uQQqHWPZt4f4pzS',NULL,3,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL),(3,'Trainer 2','trainer2@gmail.com','trainer2','$2y$10$BZv4Rnpp0KA2LyeESfiBEu.ol1TnviIdN9Z69dinQJ6ZEzVbXnlHW',NULL,3,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL),(4,'Trainer 3','trainer3@admin.com','trainer3','$2y$10$qKJB4noFRfXcbGMZEX8PQuSKxUxcbdpgMIUFWq75gxg9ZnRSnaXyG',NULL,3,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL),(5,'Trainer 4','trainer4@gmail.com','trainer4','$2y$10$oaWgRXnw1kk6QccSud6y7.aplTiyR7Zg2OM2YD8w6sY.YzUYe50M2',NULL,3,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL),(6,'Trainer 5','trainer5@gmail.com','trainer5','$2y$10$wgbdO.aHrQNyXdisHKwVOeTCQMNeQYF9GwPhcygOFQHtpQQcVYX.S',NULL,3,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL),(7,'Trainer 6','trainer6@gmail.com','trainer6','$2y$10$CMPeOnhcCUVqm2/2wmwoHehDb3TVpAt.0F5N9OgncRlbOHCNokQqC',NULL,3,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL),(8,'Candidate 1','candidate1@gmail.com','candidate1','$2y$10$1Vha2hVkBWPTgpfY0H5ki.l7syGMDmmjn0KxHnwdr4nVHKlFVRCQa',NULL,2,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL),(9,'Candidate 2','candidate2@gmail.com','candidate2','$2y$10$WLykqD4ilkxe8GH3CYmD/uHjcoqDZ0onRbgTQL1Hxem7THHvF0jHy',NULL,2,'',1,'2022-09-06 06:57:43','2022-09-06 06:57:43',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-07  0:51:41
