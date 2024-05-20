-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: saribu_gonjong2
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_groups`
--

DROP TABLE IF EXISTS `auth_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups`
--

LOCK TABLES `auth_groups` WRITE;
/*!40000 ALTER TABLE `auth_groups` DISABLE KEYS */;
INSERT INTO `auth_groups` VALUES (1,'admin','Site Administrator'),(2,'user','Regular User');
/*!40000 ALTER TABLE `auth_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_groups_users` (
  `group_id` int unsigned NOT NULL DEFAULT '0',
  `user_id` int unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_users`
--

LOCK TABLES `auth_groups_users` WRITE;
/*!40000 ALTER TABLE `auth_groups_users` DISABLE KEYS */;
INSERT INTO `auth_groups_users` VALUES (1,2),(1,8),(2,11),(2,12),(2,13),(2,14);
/*!40000 ALTER TABLE `auth_groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_logins`
--

LOCK TABLES `auth_logins` WRITE;
/*!40000 ALTER TABLE `auth_logins` DISABLE KEYS */;
INSERT INTO `auth_logins` VALUES (1,'::1','akunuser',NULL,'2022-11-19 02:30:00',0),(2,'::1','akunuser',NULL,'2022-11-19 02:30:09',0),(3,'::1','strongestakutagawa@gmail.com',1,'2022-11-19 02:43:38',1),(4,'::1','strongestakutagawa@gmail.com',1,'2022-11-19 02:44:51',1),(5,'::1','strongestakutagawa@gmail.com',1,'2022-11-19 02:52:08',1),(6,'::1','strongestakutagawa@gmail.com',1,'2022-11-19 03:28:14',1),(7,'::1','strongestakutagawa@gmail.com',1,'2022-11-19 03:30:35',1),(8,'::1','strongestakutagawa@gmail.com',1,'2022-11-19 03:30:57',1),(9,'::1','strongestakutagawa@gmail.com',1,'2022-11-20 22:47:48',1),(10,'::1','strongestakutagawa@gmail.com',1,'2022-11-20 22:52:56',1),(11,'::1','strongestakutagawa@gmail.com',1,'2022-11-20 22:54:24',1),(12,'::1','strongestakutagawa@gmail.com',1,'2022-11-20 23:07:08',1),(13,'::1','strongestakutagawa@gmail.com',1,'2022-11-21 08:42:52',1),(14,'::1','strongestakutagawa@gmail.com',1,'2022-11-21 23:59:38',1),(15,'::1','strongestakutagawa@gmail.com',1,'2022-11-22 06:04:36',1),(16,'::1','strongestakutagawa@gmail.com',1,'2022-11-22 06:05:20',1),(17,'::1','akunadmin1@gmail.com',2,'2022-11-22 23:55:50',1),(18,'::1','akunadmin1@gmail.com',2,'2022-11-23 00:05:38',1),(19,'::1','akunadmin1@gmail.com',2,'2022-11-23 00:05:47',1),(20,'::1','akunadmin1@gmail.com',2,'2022-11-28 21:14:00',1),(21,'::1','akunadmin1@gmail.com',2,'2022-11-29 17:58:31',1),(22,'::1','akunadmin1@gmail.com',2,'2022-12-02 02:36:02',1),(23,'::1','akunadmin1@gmail.com',2,'2022-12-02 03:09:41',1),(24,'::1','akunadmin1@gmail.com',2,'2022-12-02 03:28:04',1),(25,'::1','akunadmin1@gmail.com',2,'2022-12-02 09:19:30',1),(26,'::1','akunadmin1@gmail.com',2,'2022-12-02 10:19:22',1),(27,'::1','akunadmin1@gmail.com',2,'2022-12-02 20:30:30',1),(28,'::1','akunadmin1@gmail.com',2,'2022-12-05 02:12:55',1),(29,'::1','akunadmin1@gmail.com',2,'2022-12-06 02:54:22',1),(30,'::1','strongestakutagawa@gmail.com',1,'2022-12-09 01:21:57',1),(31,'::1','akunadmin1@gmail.com',2,'2022-12-09 01:22:25',1),(32,'::1','akunadmin1@gmail.com',2,'2022-12-10 08:48:01',1),(33,'::1','akunadmin1@gmail.com',2,'2022-12-13 21:35:53',1),(34,'::1','akunadmin1@gmail.com',2,'2022-12-15 03:23:22',1),(35,'::1','akunadmin1@gmail.com',2,'2022-12-15 18:55:11',1),(36,'::1','akunadmin1@gmail.com',2,'2022-12-19 02:03:46',1),(37,'::1','akunadmin1@gmail.com',2,'2022-12-19 02:56:59',1),(38,'::1','akunadmin1@gmail.com',2,'2022-12-19 02:58:54',1),(39,'::1','akunadmin1@gmail.com',2,'2022-12-19 06:17:44',1),(40,'::1','akunadmin1@gmail.com',2,'2022-12-19 06:51:33',1),(41,'::1','akunadmin1@gmail.com',2,'2022-12-19 20:35:40',1),(42,'::1','akunadmin1@gmail.com',2,'2022-12-19 20:55:24',1),(43,'::1','akunadmin1@gmail.com',2,'2022-12-20 02:45:03',1),(44,'::1','akunadmin1@gmail.com',2,'2022-12-23 22:51:15',1),(45,'::1','akunadmin1@gmail.com',2,'2022-12-25 22:52:02',1),(46,'::1','akunadmin1@gmail.com',2,'2022-12-26 22:43:52',1),(47,'::1','akunadmin1@gmail.com',2,'2022-12-27 22:56:09',1),(48,'::1','akunadmin1@gmail.com',2,'2023-01-06 21:04:44',1),(49,'::1','akunadmin1@gmail.com',2,'2023-01-07 02:53:15',1),(50,'::1','akunadmin1@gmail.com',2,'2023-01-09 23:56:24',1),(51,'::1','akunadmin1@gmail.com',2,'2023-01-10 02:24:19',1),(52,'::1','akunadmin1@gmail.com',2,'2023-01-10 06:25:31',1),(53,'::1','akunadmin1@gmail.com',2,'2023-01-12 02:27:57',1),(54,'::1','akunadmin1@gmail.com',2,'2023-01-12 07:32:28',1),(55,'::1','akunadmin1@gmail.com',2,'2023-01-12 21:20:47',1),(56,'::1','blablabla@gmail.com',4,'2023-01-13 01:05:40',1),(57,'::1','akunadmin1@gmail.com',2,'2023-01-13 05:18:17',1),(58,'::1','blablabla@gmail.com',4,'2023-01-16 04:59:27',1),(59,'::1','blablabla@gmail.com',4,'2023-01-22 07:52:34',1),(60,'::1','blablabla@gmail.com',4,'2023-01-24 21:27:04',1),(61,'::1','akunadmin1@gmail.com',2,'2023-05-17 05:48:34',1),(62,'::1','akunadmin1@gmail.com',2,'2023-05-20 02:58:02',1),(63,'::1','akunadmin1@gmail.com',2,'2023-05-20 03:35:31',1),(64,'::1','jasjh@gmail.com',5,'2023-05-20 03:37:26',1),(65,'::1','jasjh@gmail.com',5,'2023-05-20 09:58:07',1),(66,'::1','jasjh@gmail.com',5,'2023-05-20 09:59:32',1),(67,'::1','jasjh@gmail.com',5,'2023-05-20 10:05:56',1),(68,'::1','jasjh@gmail.com',5,'2023-05-20 10:09:05',1),(69,'::1','jasjh@gmail.com',5,'2023-05-20 10:11:59',1),(70,'::1','jasjh@gmail.com',5,'2023-05-20 10:16:25',1),(71,'::1','jasjh@gmail.com',5,'2023-05-20 10:18:15',1),(72,'::1','jasjh@gmail.com',5,'2023-05-20 10:19:15',1),(73,'::1','jasjh@gmail.com',5,'2023-05-20 10:19:24',1),(74,'::1','jasjh@gmail.com',5,'2023-05-20 10:19:56',1),(75,'::1','jasjh@gmail.com',5,'2023-05-20 10:20:10',1),(76,'::1','jasjh@gmail.com',5,'2023-05-20 10:21:04',1),(77,'::1','jasjh@gmail.com',5,'2023-05-20 10:21:41',1),(78,'::1','jasjh@gmail.com',5,'2023-05-20 10:22:50',1),(79,'::1','jasjh@gmail.com',5,'2023-05-20 10:23:08',1),(80,'::1','jasjh@gmail.com',5,'2023-05-20 10:25:53',1),(81,'::1','jasjh@gmail.com',5,'2023-05-20 10:26:34',1),(82,'::1','jasjh@gmail.com',5,'2023-05-20 10:27:51',1),(83,'::1','jasjh@gmail.com',5,'2023-05-20 10:31:16',1),(84,'::1','jasjh@gmail.com',5,'2023-05-20 10:34:53',1),(85,'::1','jasjh@gmail.com',5,'2023-05-20 10:40:13',1),(86,'::1','jasjh@gmail.com',5,'2023-05-20 10:40:29',1),(87,'::1','jasjh@gmail.com',5,'2023-05-20 10:41:27',1),(88,'::1','jasjh@gmail.com',5,'2023-05-20 10:48:16',1),(89,'::1','jasjh@gmail.com',5,'2023-05-20 21:36:34',1),(90,'::1','jasjh@gmail.com',5,'2023-05-20 21:37:21',1),(91,'::1','jasjh@gmail.com',5,'2023-05-20 21:41:59',1),(92,'::1','jasjh@gmail.com',5,'2023-05-20 21:44:58',1),(93,'::1','jasjh@gmail.com',5,'2023-05-20 21:47:54',1),(94,'::1','jasjh@gmail.com',5,'2023-05-20 21:50:13',1),(95,'::1','jasjh@gmail.com',5,'2023-05-21 08:45:20',1),(96,'::1','jasjh@gmail.com',5,'2023-05-21 08:46:46',1),(97,'::1','jasjh@gmail.com',5,'2023-05-21 08:48:39',1),(98,'::1','jasjh@gmail.com',5,'2023-05-21 09:04:46',1),(99,'::1','jasjh@gmail.com',5,'2023-05-21 09:05:01',1),(100,'::1','jasjh@gmail.com',5,'2023-05-21 09:05:18',1),(101,'::1','jasjh@gmail.com',5,'2023-05-22 02:33:45',1),(102,'::1','accuser2',NULL,'2023-05-22 04:09:53',0),(103,'::1','accuser2',NULL,'2023-05-22 04:10:01',0),(104,'::1','accuser2',NULL,'2023-05-22 04:10:07',0),(105,'::1','accuser2',NULL,'2023-05-22 04:10:13',0),(106,'::1','accuser1',NULL,'2023-05-22 04:10:19',0),(107,'::1','akunadmin1@gmail.com',2,'2023-05-22 04:10:25',1),(108,'::1','accuser2',NULL,'2023-05-22 04:10:49',0),(109,'::1','accuser3',NULL,'2023-05-22 04:11:19',0),(110,'::1','accuser3',NULL,'2023-05-22 04:11:32',0),(111,'::1','accuser1',NULL,'2023-05-22 04:12:55',0),(112,'::1','akunuser1',NULL,'2023-05-22 04:13:47',0),(113,'::1','dsd@gmail.com',6,'2023-05-22 04:18:23',1),(114,'::1','accsatu',NULL,'2023-05-22 04:28:59',0),(115,'::1','hsaj@gmail.com',7,'2023-05-22 04:29:36',1),(116,'::1','athifah27zahra',NULL,'2023-05-22 04:31:23',0),(117,'::1','athifah27zahra',NULL,'2023-05-22 04:31:31',0),(118,'::1','athifah27zahra',NULL,'2023-05-22 04:31:39',0),(119,'::1','shjsha@gmail.com',8,'2023-05-22 04:36:03',1),(120,'::1','shjsha@gmail.com',8,'2023-05-22 04:36:43',1),(121,'::1','akunadmin1@gmail.com',2,'2023-05-28 23:50:19',1),(122,'::1','shjash@gmail.com',9,'2023-05-29 00:13:15',1),(123,'::1','shjash@gmail.com',9,'2023-05-29 03:43:40',1),(124,'::1','akunadmin1@gmail.com',2,'2023-05-29 04:14:06',1),(125,'::1','akunadmin1@gmail.com',2,'2023-05-30 04:07:13',1),(126,'::1','akunadmin1@gmail.com',2,'2023-05-30 08:06:46',1),(127,'::1','akunadmin1@gmail.com',2,'2023-05-30 08:18:49',1),(140,'::1','akunadmin1@gmail.com',2,'2023-06-29 08:17:48',1),(141,'::1','akunadmin1@gmail.com',2,'2023-06-29 11:01:09',1),(142,'::1','gypsum',NULL,'2023-06-29 22:00:08',0),(143,'::1','zahra',NULL,'2023-06-29 22:00:13',0),(144,'::1','athifahh',NULL,'2023-06-29 22:00:19',0),(145,'::1','athifah',NULL,'2023-06-29 22:00:24',0),(146,'::1','sassahj@gmail.com',11,'2023-06-29 22:01:12',1),(147,'::1','akunadmin1@gmail.com',2,'2023-06-29 22:18:18',1),(148,'::1','akunadmin1@gmail.com',2,'2023-06-30 02:23:49',1),(149,'::1','akunadmin1@gmail.com',2,'2023-06-30 02:25:02',1),(150,'::1','akunadmin1@gmail.com',2,'2023-06-30 16:10:27',1),(151,'::1','sassahj@gmail.com',11,'2023-07-01 05:40:57',1),(152,'::1','akunadmin1@gmail.com',2,'2023-07-01 06:43:26',1),(153,'::1','akunadmin1@gmail.com',2,'2023-07-01 17:28:51',1),(154,'::1','akunadmin1@gmail.com',2,'2023-07-03 21:48:21',1),(155,'::1','akunadmin1@gmail.com',2,'2023-07-05 02:57:07',1),(156,'::1','akunadmin1@gmail.com',2,'2023-07-05 19:35:36',1),(157,'::1','akunadmin1@gmail.com',2,'2023-07-06 00:48:15',1),(158,'::1','akunadmin1@gmail.com',2,'2023-07-09 00:14:37',1),(159,'::1','akunadmin1@gmail.com',2,'2023-07-09 04:45:14',1),(160,'::1','akunadmin1@gmail.com',2,'2023-07-09 07:24:16',1),(161,'::1','akunadmin1@gmail.com',2,'2023-07-11 03:57:21',1),(162,'::1','akunadmin1@gmail.com',2,'2023-07-11 04:02:01',1),(163,'::1','akunadmin1@gmail.com',2,'2023-07-11 04:45:43',1),(164,'::1','akunadmin1@gmail.com',2,'2023-07-12 11:58:32',1),(165,'::1','akunadmin1@gmail.com',2,'2023-07-14 06:56:37',1),(166,'::1','1711523011@student.unand.ac.id',11,'2023-07-20 18:57:54',1),(167,'::1','akunadmin1@gmail.com',2,'2023-07-21 03:40:05',1),(168,'::1','1711523011@student.unand.ac.id',11,'2023-07-21 04:10:11',1),(169,'::1','akunadmin1@gmail.com',2,'2023-07-21 04:14:01',1),(170,'::1','1711523011@student.unand.ac.id',11,'2023-07-23 01:29:59',1),(171,'::1','akunadmin1@gmail.com',2,'2023-07-24 03:53:03',1),(172,'::1','1711523011@student.unand.ac.id',11,'2023-07-24 04:51:01',1),(173,'::1','1711523011@student.unand.ac.id',11,'2023-07-24 21:27:31',1),(174,'::1','1711523011@student.unand.ac.id',11,'2023-07-24 22:02:58',1),(175,'::1','akunadmin1@gmail.com',2,'2023-07-24 23:16:20',1),(176,'::1','akunadmin1@gmail.com',2,'2023-07-27 03:20:06',1),(177,'::1','akunadmin1@gmail.com',2,'2023-07-27 16:50:49',1),(178,'::1','akunadmin1@gmail.com',2,'2023-07-28 02:14:49',1),(179,'::1','akunadmin1@gmail.com',2,'2023-07-28 02:14:54',1),(180,'::1','akunadmin1@gmail.com',2,'2023-07-28 04:29:25',1),(181,'::1','akunadmin1@gmail.com',2,'2023-07-28 07:29:51',1),(182,'::1','akunadmin1@gmail.com',2,'2023-07-28 07:29:57',1),(183,'::1','akunadmin1@gmail.com',2,'2023-07-28 22:39:55',1),(184,'::1','akunadmin1@gmail.com',2,'2023-07-29 03:48:16',1),(185,'::1','akunadmin1@gmail.com',2,'2023-07-29 08:03:21',1),(186,'::1','akunadmin1@gmail.com',2,'2023-07-29 23:28:24',1),(187,'::1','akunadmin1@gmail.com',2,'2023-07-30 00:50:56',1),(188,'::1','akunadmin1@gmail.com',2,'2023-07-30 01:09:42',1),(189,'::1','akunadmin1@gmail.com',2,'2023-07-30 01:10:15',1),(190,'::1','akunadmin1@gmail.com',2,'2023-08-01 00:58:06',1),(191,'::1','akunadmin1@gmail.com',2,'2023-08-03 03:50:35',1),(192,'::1','akunadmin1@gmail.com',2,'2023-08-03 07:36:10',1),(193,'::1','akunadmin1@gmail.com',2,'2023-08-05 23:47:36',1),(194,'::1','akunadmin1@gmail.com',2,'2023-08-11 00:13:17',1),(195,'::1','1711523011@student.unand.ac.id',11,'2023-08-11 01:44:47',1),(196,'::1','athifahh',NULL,'2023-08-11 01:59:38',0),(197,'::1','gypsum',NULL,'2023-08-11 01:59:42',0),(198,'::1','zahra',NULL,'2023-08-11 01:59:45',0),(199,'::1','athifah',NULL,'2023-08-11 01:59:49',0),(200,'::1','dhjshd@gmail.com',12,'2023-08-11 02:00:33',1),(201,'::1','akunadmin1@gmail.com',2,'2023-08-11 04:08:37',1),(202,'::1','dhjshd@gmail.com',12,'2023-08-11 04:31:38',1),(203,'::1','akunadmin1@gmail.com',2,'2023-08-11 04:32:07',1),(204,'::1','dhjshd@gmail.com',12,'2023-08-11 04:32:28',1),(205,'::1','akunadmin1@gmail.com',2,'2023-08-11 04:37:41',1),(206,'::1','akunadmin1@gmail.com',2,'2023-08-11 21:34:09',1),(207,'::1','akunadmin1@gmail.com',2,'2023-08-11 22:43:49',1),(208,'::1','dhjshd@gmail.com',12,'2023-08-11 22:57:09',1),(209,'::1','dhjshd@gmail.com',12,'2023-08-12 01:42:24',1),(210,'::1','akunadmin1@gmail.com',2,'2023-08-12 02:48:53',1),(211,'::1','akunadmin1@gmail.com',2,'2023-08-12 18:27:33',1),(212,'::1','akunadmin1@gmail.com',2,'2023-08-15 10:35:08',1),(213,'::1','dhjshd@gmail.com',12,'2023-08-15 10:46:19',1),(214,'::1','dhjshd@gmail.com',12,'2023-08-16 03:32:29',1),(215,'::1','akunadmin1@gmail.com',2,'2023-08-16 03:34:16',1),(216,'::1','akunadmin1@gmail.com',2,'2023-08-16 03:42:57',1),(217,'::1','akunadmin1@gmail.com',2,'2023-08-18 21:50:12',1),(218,'::1','akunadmin1@gmail.com',2,'2023-08-18 22:10:06',1),(219,'::1','dhjshd@gmail.com',12,'2023-08-18 23:55:13',1),(220,'::1','akunadmin1@gmail.com',2,'2023-08-19 03:18:08',1),(221,'::1','dhjshd@gmail.com',12,'2023-08-19 04:01:57',1),(222,'::1','akunadmin1@gmail.com',2,'2023-08-22 07:33:49',1),(223,'::1','dhjshd@gmail.com',12,'2023-08-26 16:49:51',1),(224,'::1','dhjshd@gmail.com',12,'2023-08-31 04:35:23',1),(225,'::1','1711523011@student.unand.ac.id',11,'2023-08-31 05:06:41',1),(226,'::1','akunadmin1@gmail.com',2,'2023-08-31 05:17:20',1),(227,'::1','1711523011@student.unand.ac.id',11,'2023-08-31 05:18:13',1),(228,'::1','akunadmin1@gmail.com',2,'2023-08-31 09:38:33',1),(229,'::1','akunadmin1@gmail.com',2,'2023-09-19 10:35:16',1),(230,'::1','1711523011@student.unand.ac.id',11,'2023-09-20 15:13:04',1),(231,'::1','1711523011@student.unand.ac.id',11,'2023-09-28 16:02:57',1),(232,'::1','akunadmin1@gmail.com',2,'2023-09-30 15:24:02',1),(233,'::1','akunadmin1@gmail.com',2,'2023-09-30 20:48:41',1),(234,'::1','dhjshd@gmail.com',12,'2023-09-30 20:49:09',1),(235,'::1','1711523011@student.unand.ac.id',11,'2023-09-30 20:49:33',1),(236,'::1','akunadmin1@gmail.com',2,'2023-09-30 20:49:54',1),(237,'::1','1711523011@student.unand.ac.id',11,'2023-09-30 20:50:21',1),(238,'::1','akunadmin1@gmail.com',2,'2023-09-30 21:27:13',1),(239,'::1','1711523011@student.unand.ac.id',11,'2023-09-30 21:27:43',1),(240,'::1','akunadmin1@gmail.com',2,'2023-09-30 21:44:38',1),(241,'::1','dhjshd@gmail.com',12,'2023-09-30 21:53:30',1),(242,'::1','akunadmin1@gmail.com',2,'2023-09-30 21:57:49',1),(243,'::1','akunadmin1@gmail.com',2,'2023-09-30 22:48:09',1),(244,'::1','akunadmin1@gmail.com',2,'2023-10-01 20:43:21',1),(245,'::1','akunadmin1@gmail.com',2,'2023-10-02 01:37:15',1),(246,'::1','akunadmin1@gmail.com',2,'2023-10-02 10:11:21',1),(247,'::1','akunadmin1@gmail.com',2,'2023-10-02 21:31:45',1),(248,'::1','akunadmin1@gmail.com',2,'2023-10-04 10:30:31',1),(249,'::1','akunadmin1@gmail.com',2,'2023-10-04 12:01:41',1),(250,'::1','akunadmin1@gmail.com',2,'2023-10-04 16:57:13',1),(251,'::1','akunadmin1@gmail.com',2,'2023-10-04 22:30:13',1),(252,'::1','akunadmin1@gmail.com',2,'2023-10-04 10:53:03',1),(253,'::1','dhjshd@gmail.com',12,'2023-10-04 10:53:41',1),(254,'::1','akunadmin1@gmail.com',2,'2023-10-04 23:09:48',1),(255,'::1','akunadmin1@gmail.com',2,'2023-10-05 14:36:56',1),(256,'::1','akunadmin1@gmail.com',2,'2023-10-06 19:34:52',1),(257,'::1','1711523011@student.unand.ac.id',11,'2023-10-07 00:29:32',1),(258,'::1','akunadmin1@gmail.com',2,'2023-10-07 07:19:23',1),(259,'::1','1711523011@student.unand.ac.id',11,'2023-10-07 08:29:57',1),(260,'::1','akunadmin1@gmail.com',2,'2023-10-07 08:41:28',1),(261,'::1','dhjshd@gmail.com',12,'2023-10-07 08:44:56',1),(262,'::1','akunadmin1@gmail.com',2,'2023-10-10 12:04:39',1),(263,'::1','dhjshd@gmail.com',12,'2023-10-10 14:38:06',1),(264,'::1','akunadmin1@gmail.com',2,'2023-10-10 14:42:15',1),(265,'::1','dhjshd@gmail.com',12,'2023-10-10 14:42:57',1),(266,'::1','akunadmin1@gmail.com',2,'2023-10-10 14:55:12',1),(267,'::1','1711523011@student.unand.ac.id',11,'2023-10-10 14:55:35',1),(268,'::1','akunadmin1@gmail.com',2,'2023-10-10 14:56:20',1),(269,'::1','1711523011@student.unand.ac.id',11,'2023-10-10 14:56:50',1),(270,'::1','akunadmin1@gmail.com',2,'2023-10-10 15:01:06',1),(271,'::1','1711523011@student.unand.ac.id',11,'2023-10-10 15:01:43',1),(272,'::1','akunadmin1@gmail.com',2,'2023-10-11 14:47:33',1),(273,'::1','akunadmin1@gmail.com',2,'2023-10-14 06:13:13',1),(274,'::1','dhjshd@gmail.com',12,'2023-10-14 11:54:02',1),(275,'::1','akunadmin1@gmail.com',2,'2023-10-14 11:56:43',1),(276,'::1','dhjshd@gmail.com',12,'2023-10-14 11:58:45',1),(277,'::1','akunadmin1@gmail.com',2,'2023-10-14 12:00:35',1),(278,'::1','akunadmin1@gmail.com',2,'2023-10-17 10:42:02',1),(279,'::1','akunadmin1@gmail.com',2,'2023-10-17 15:49:54',1),(280,'::1','dhjshd@gmail.com',12,'2023-10-17 17:06:06',1),(281,'::1','akunadmin1@gmail.com',2,'2023-10-21 09:40:11',1),(282,'::1','akunadmin1@gmail.com',2,'2023-10-21 09:54:59',1),(283,'::1','akunadmin1@gmail.com',2,'2023-10-21 15:39:34',1),(284,'::1','akunadmin1@gmail.com',2,'2023-10-24 09:48:35',1),(285,'::1','akunadmin1@gmail.com',2,'2023-10-24 16:12:23',1),(286,'::1','dhjshd@gmail.com',12,'2023-10-24 16:13:38',1),(287,'::1','1711523011@student.unand.ac.id',11,'2023-10-24 16:14:12',1),(288,'::1','akunadmin1@gmail.com',2,'2023-10-24 16:20:02',1),(289,'::1','dhjshd@gmail.com',12,'2023-10-24 17:52:16',1),(290,'::1','1711523011@student.unand.ac.id',11,'2023-10-24 17:52:46',1),(291,'::1','akunadmin1@gmail.com',2,'2023-10-27 15:05:54',1),(292,'::1','dhjshd@gmail.com',12,'2023-10-31 14:14:29',1),(293,'::1','dhjshd@gmail.com',12,'2023-11-01 11:27:19',1),(294,'::1','akunadmin1@gmail.com',2,'2023-11-01 16:55:58',1),(295,'::1','akunadmin1@gmail.com',2,'2023-11-02 10:17:45',1),(296,'::1','akunadmin1@gmail.com',2,'2023-11-02 15:28:46',1),(297,'::1','dhjshd@gmail.com',12,'2023-11-09 15:07:47',1),(298,'::1','dhjshd@gmail.com',12,'2023-11-10 16:46:29',1),(299,'::1','dhjshd@gmail.com',12,'2023-11-10 19:09:43',1),(300,'::1','akunadmin1@gmail.com',2,'2023-11-11 10:13:58',1),(301,'::1','dhjshd@gmail.com',12,'2023-11-11 14:54:45',1),(302,'::1','dhjshd@gmail.com',12,'2023-11-11 14:54:54',1),(303,'::1','akunadmin1@gmail.com',2,'2023-12-10 13:21:16',1),(304,'::1','dhjshd@gmail.com',12,'2023-12-10 13:22:05',1),(305,'::1','akunadmin1@gmail.com',2,'2023-12-10 13:23:10',1),(306,'::1','dhjshd@gmail.com',12,'2023-12-10 13:24:59',1),(307,'::1','akunadmin1@gmail.com',2,'2023-12-10 13:32:28',1),(308,'::1','dhjshd@gmail.com',12,'2023-12-10 13:49:04',1),(309,'::1','dhjshd@gmail.com',12,'2023-12-10 16:19:30',1),(310,'::1','akunadmin1@gmail.com',2,'2023-12-13 12:53:45',1),(311,'::1','dhjshd@gmail.com',12,'2023-12-13 12:57:49',1),(312,'::1','akunadmin1@gmail.com',2,'2023-12-13 13:05:38',1),(313,'::1','dhjshd@gmail.com',12,'2023-12-13 13:59:10',1),(314,'::1','dhjshd@gmail.com',12,'2023-12-13 14:02:57',1),(315,'::1','akunadmin1@gmail.com',2,'2023-12-13 14:06:28',1),(316,'::1','akunadmin1@gmail.com',2,'2023-12-14 14:03:28',1),(317,'::1','akunadmin1@gmail.com',2,'2023-12-14 17:02:02',1),(318,'::1','akunadmin1@gmail.com',2,'2023-12-14 17:13:55',1),(319,'::1','akunadmin1@gmail.com',2,'2023-12-14 17:15:25',1),(320,'::1','akunadmin1@gmail.com',2,'2023-12-15 11:34:33',1),(321,'::1','akunadmin1@gmail.com',2,'2023-12-15 11:46:37',1),(322,'::1','akunadmin1@gmail.com',2,'2023-12-16 17:34:24',1),(323,'::1','akunadmin1@gmail.com',2,'2023-12-16 17:47:01',1),(324,'::1','akunadmin1@gmail.com',2,'2023-12-16 17:54:25',1),(325,'::1','akunadmin1@gmail.com',2,'2023-12-16 21:54:12',1),(326,'::1','dhjshd@gmail.com',12,'2023-12-16 23:01:51',1),(327,'::1','akunadmin1@gmail.com',2,'2023-12-16 23:49:16',1),(328,'::1','akunadmin1@gmail.com',2,'2023-12-17 12:07:50',1),(329,'::1','akunadmin1@gmail.com',2,'2023-12-17 16:11:43',1),(330,'::1','dhjshd@gmail.com',12,'2023-12-17 16:17:10',1),(331,'::1','1711523011@student.unand.ac.id',11,'2023-12-17 16:24:12',1),(332,'::1','akunadmin1@gmail.com',2,'2023-12-17 16:26:04',1),(333,'::1','1711523011@student.unand.ac.id',11,'2023-12-17 16:30:00',1),(334,'::1','akunadmin1@gmail.com',2,'2023-12-17 16:44:22',1),(335,'::1','akunadmin1@gmail.com',2,'2023-12-17 17:18:08',1),(336,'::1','akunadmin1@gmail.com',2,'2023-12-17 17:19:04',1),(337,'::1','dhjshd@gmail.com',12,'2023-12-21 08:19:00',1),(338,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 10:55:00',1),(339,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 19:37:22',1),(340,'::1','akunadmin1@gmail.com',2,'2023-12-21 19:40:13',1),(341,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 19:40:50',1),(342,'::1','akunadmin1@gmail.com',2,'2023-12-21 19:41:38',1),(343,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 19:42:27',1),(344,'::1','akunadmin1@gmail.com',2,'2023-12-21 19:43:36',1),(345,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 19:44:31',1),(346,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 20:00:52',1),(347,'::1','akunadmin1@gmail.com',2,'2023-12-21 20:01:19',1),(348,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 20:01:43',1),(349,'::1','akunadmin1@gmail.com',2,'2023-12-21 20:03:33',1),(350,'::1','1711523011@student.unand.ac.id',11,'2023-12-21 20:04:10',1),(351,'::1','akunadmin1@gmail.com',2,'2023-12-21 20:05:16',1),(352,'::1','1711523011@student.unand.ac.id',11,'2023-12-22 05:29:46',1),(353,'::1','dhjshd@gmail.com',12,'2023-12-22 05:30:15',1),(354,'::1','akunadmin1@gmail.com',2,'2023-12-22 05:31:30',1),(355,'::1','akunadmin1@gmail.com',2,'2023-12-22 07:45:02',1),(356,'::1','akunadmin1@gmail.com',2,'2023-12-22 10:16:37',1),(357,'::1','1711523011@student.unand.ac.id',11,'2023-12-22 14:34:50',1),(358,'::1','dhjshd@gmail.com',12,'2023-12-22 14:34:59',1),(359,'::1','akunadmin1@gmail.com',2,'2023-12-22 14:49:32',1),(360,'::1','akunadmin1@gmail.com',2,'2023-12-22 14:49:57',1),(361,'::1','1711523011@student.unand.ac.id',11,'2023-12-22 16:08:53',1),(362,'::1','1711523011@student.unand.ac.id',11,'2023-12-22 16:55:43',1),(363,'::1','akunadmin1@gmail.com',2,'2023-12-22 16:56:02',1),(364,'::1','1711523011@student.unand.ac.id',11,'2023-12-23 06:22:08',1),(365,'::1','akunadmin1@gmail.com',2,'2023-12-23 06:22:58',1),(366,'::1','1711523011@student.unand.ac.id',11,'2023-12-23 06:23:22',1),(367,'::1','akunadmin1@gmail.com',2,'2023-12-23 06:51:59',1),(368,'::1','akunadmin1@gmail.com',2,'2023-12-23 06:58:26',1),(369,'::1','1711523011@student.unand.ac.id',11,'2023-12-23 06:58:57',1),(370,'::1','akunadmin1@gmail.com',2,'2023-12-23 07:32:00',1),(371,'::1','1711523011@student.unand.ac.id',11,'2023-12-23 07:59:44',1),(372,'::1','akunadmin1@gmail.com',2,'2023-12-23 15:36:51',1),(373,'::1','1711523011@student.unand.ac.id',11,'2023-12-23 15:49:04',1),(374,'::1','dhjshd@gmail.com',12,'2023-12-23 15:49:18',1),(375,'::1','akunadmin1@gmail.com',2,'2023-12-24 09:37:51',1),(376,'::1','1711523011@student.unand.ac.id',11,'2023-12-24 09:40:10',1),(377,'::1','1711523011@student.unand.ac.id',11,'2023-12-24 09:46:34',1),(378,'::1','1711523011@student.unand.ac.id',11,'2023-12-24 09:47:08',1),(379,'::1','akunadmin1@gmail.com',2,'2023-12-24 09:49:29',1),(380,'::1','1711523011@student.unand.ac.id',11,'2023-12-24 09:49:47',1),(381,'::1','akunadmin1@gmail.com',2,'2023-12-24 09:50:36',1),(382,'::1','dhjshd@gmail.com',12,'2023-12-24 09:51:10',1),(383,'::1','akunadmin1@gmail.com',2,'2023-12-24 09:52:00',1),(384,'::1','dhjshd@gmail.com',12,'2023-12-25 14:45:19',1),(385,'::1','dhjshd@gmail.com',12,'2023-12-26 11:29:22',1),(386,'::1','akunadmin1@gmail.com',2,'2023-12-26 11:50:23',1),(387,'::1','akunadmin1@gmail.com',2,'2023-12-26 16:36:56',1),(388,'::1','akunadmin1@gmail.com',2,'2023-12-26 16:44:50',1),(389,'::1','dhjshd@gmail.com',12,'2023-12-26 16:46:17',1),(390,'::1','akunadmin1@gmail.com',2,'2023-12-26 16:50:37',1),(391,'::1','dhjshd@gmail.com',12,'2023-12-26 16:53:18',1),(392,'::1','akunadmin1@gmail.com',2,'2023-12-26 16:53:38',1),(393,'::1','dhjshd@gmail.com',12,'2023-12-26 16:53:58',1),(394,'::1','akunadmin1@gmail.com',2,'2023-12-26 16:55:25',1),(395,'::1','akunadmin1@gmail.com',2,'2023-12-26 16:57:23',1),(396,'::1','dhjshd@gmail.com',12,'2023-12-26 16:57:37',1),(397,'::1','akunadmin1@gmail.com',2,'2023-12-26 16:58:14',1),(398,'::1','dhjshd@gmail.com',12,'2023-12-26 16:59:01',1),(399,'::1','dhjshd@gmail.com',12,'2023-12-26 17:33:25',1),(400,'::1','akunadmin1@gmail.com',2,'2023-12-26 18:07:46',1),(401,'::1','dhjshd@gmail.com',12,'2023-12-26 18:09:18',1),(402,'::1','akunadmin1@gmail.com',2,'2023-12-27 14:55:05',1),(403,'::1','dhjshd@gmail.com',12,'2023-12-27 14:55:15',1),(404,'::1','akunadmin1@gmail.com',2,'2023-12-27 15:07:29',1),(405,'::1','dhjshd@gmail.com',12,'2023-12-27 15:08:03',1),(406,'::1','akunadmin1@gmail.com',2,'2023-12-27 15:15:54',1),(407,'::1','dhjshd@gmail.com',12,'2023-12-27 15:16:34',1),(408,'::1','akunadmin1@gmail.com',2,'2023-12-27 15:24:03',1),(409,'::1','dhjshd@gmail.com',12,'2023-12-27 15:39:32',1),(410,'::1','dhjshd@gmail.com',12,'2023-12-28 06:30:51',1),(411,'::1','akunadmin1@gmail.com',2,'2023-12-28 06:48:22',1),(412,'::1','dhjshd@gmail.com',12,'2023-12-28 06:49:53',1),(413,'::1','dhjshd@gmail.com',12,'2023-12-28 06:50:07',1),(414,'::1','akunadmin1@gmail.com',2,'2023-12-28 06:50:20',1),(415,'::1','dhjshd@gmail.com',12,'2023-12-28 06:55:09',1),(416,'::1','akunadmin1@gmail.com',2,'2023-12-28 06:55:36',1),(417,'::1','1711523011@student.unand.ac.id',11,'2023-12-28 07:17:18',1),(418,'::1','dhjshd@gmail.com',12,'2023-12-28 08:22:27',1),(419,'::1','akunadmin1@gmail.com',2,'2023-12-28 08:22:46',1),(420,'::1','dhjshd@gmail.com',12,'2023-12-28 08:35:18',1),(421,'::1','akunadmin1@gmail.com',2,'2023-12-28 08:35:51',1),(422,'::1','dhjshd@gmail.com',12,'2023-12-29 11:27:35',1),(423,'::1','akunadmin1@gmail.com',2,'2023-12-29 11:47:38',1),(424,'::1','akunadmin1@gmail.com',2,'2023-12-31 21:38:13',1),(425,'::1','dhjshd@gmail.com',12,'2024-01-01 10:03:52',1),(426,'::1','dhjshd@gmail.com',12,'2024-01-02 14:42:34',1),(427,'::1','akunadmin1@gmail.com',2,'2024-01-02 14:54:08',1),(428,'::1','dhjshd@gmail.com',12,'2024-01-02 15:01:32',1),(429,'::1','dhjshd@gmail.com',12,'2024-01-02 15:30:52',1),(430,'::1','akunadmin1@gmail.com',2,'2024-01-02 15:37:33',1),(431,'::1','dhjshd@gmail.com',12,'2024-01-08 13:30:23',1),(432,'::1','akunadmin1@gmail.com',2,'2024-01-11 10:50:55',1),(433,'::1','dhjshd@gmail.com',12,'2024-01-11 11:19:02',1),(434,'::1','akunadmin1@gmail.com',2,'2024-01-11 11:32:11',1),(435,'::1','dhjshd@gmail.com',12,'2024-01-11 11:49:47',1),(436,'::1','akunadmin1@gmail.com',2,'2024-01-11 12:29:19',1),(437,'::1','1711523011@student.unand',12,'2024-01-11 12:30:00',1),(438,'::1','akunadmin1@gmail.com',2,'2024-01-11 12:31:05',1),(439,'::1','1711523011@student.unand',12,'2024-01-11 12:33:44',1),(440,'::1','akunadmin1@gmail.com',2,'2024-01-11 12:39:11',1),(441,'::1','akunadmin1@gmail.com',2,'2024-01-11 12:53:18',1),(442,'::1','1711523011@student.unand',12,'2024-01-11 20:49:29',1),(443,'::1','akunadmin1@gmail.com',2,'2024-01-11 20:56:55',1),(444,'::1','akunadmin1@gmail.com',2,'2024-01-11 20:57:59',1),(445,'::1','1711523011@student.unand',12,'2024-01-11 21:00:25',1),(446,'::1','1711523011@student.unand',12,'2024-01-11 21:05:24',1),(447,'::1','akunadmin1@gmail.com',2,'2024-01-11 21:05:42',1),(448,'::1','1711523011@student.unand',12,'2024-01-11 21:15:12',1),(449,'::1','akunadmin1@gmail.com',2,'2024-01-11 21:21:11',1),(450,'::1','1711523011@student.unand',12,'2024-01-11 21:30:08',1),(451,'::1','akunadmin1@gmail.com',2,'2024-01-11 22:04:31',1),(452,'::1','1711523011@student.unand',12,'2024-01-11 22:07:19',1),(453,'::1','akunadmin1@gmail.com',2,'2024-01-11 22:24:17',1),(454,'::1','1711523011@student.unand',12,'2024-01-11 22:26:57',1),(455,'::1','akunadmin1@gmail.com',2,'2024-01-11 23:05:39',1),(456,'::1','1711523011@student.unand',12,'2024-01-11 23:08:04',1),(457,'::1','1711523011@student.unand',12,'2024-01-11 23:16:37',1),(458,'::1','akunadmin1@gmail.com',2,'2024-01-11 23:19:18',1),(459,'::1','1711523011@student.unand',12,'2024-01-11 23:21:48',1),(460,'::1','akunadmin1@gmail.com',2,'2024-01-12 08:54:15',1),(461,'::1','akunadmin1@gmail.com',2,'2024-01-12 08:54:22',1),(462,'::1','1711523011@student.unand',12,'2024-01-12 09:19:25',1),(463,'::1','akunadmin1@gmail.com',2,'2024-01-12 10:52:36',1),(464,'::1','akunadmin1@gmail.com',2,'2024-01-12 11:05:26',1),(465,'::1','1711523011@student.unand',12,'2024-01-20 18:12:58',1),(466,'::1','akunadmin1@gmail.com',2,'2024-01-20 20:32:02',1),(467,'::1','akunadmin1@gmail.com',2,'2024-01-21 16:54:35',1),(468,'::1','1711523011@student.unand',12,'2024-01-21 16:58:03',1),(469,'::1','1711523011@student.unand',12,'2024-01-22 10:35:31',1),(470,'::1','akunadmin1@gmail.com',2,'2024-01-22 10:36:34',1),(471,'::1','1711523011@student.unand.ac.id',11,'2024-01-22 10:53:59',1),(472,'::1','1711523011@student.unand',12,'2024-01-24 06:13:08',1),(473,'::1','akunadmin1@gmail.com',2,'2024-01-24 06:13:47',1),(474,'::1','1711523011@student.unand',12,'2024-01-25 07:49:51',1),(475,'::1','akunadmin1@gmail.com',2,'2024-01-25 11:04:41',1),(476,'::1','akunadmin1@gmail.com',2,'2024-01-25 11:07:36',1),(477,'::1','akunadmin1@gmail.com',2,'2024-01-25 11:17:38',1),(478,'::1','akunadmin1@gmail.com',2,'2024-01-25 11:46:10',1),(479,'::1','1711523011@student.unand',12,'2024-01-25 11:54:41',1),(480,'::1','1711523011@student.unand',12,'2024-01-25 14:35:01',1),(481,'::1','akunadmin1@gmail.com',2,'2024-01-25 14:37:47',1),(482,'::1','akunadmin1@gmail.com',2,'2024-01-25 15:05:52',1),(483,'::1','1711523011@student.unand',12,'2024-01-26 09:35:43',1),(484,'::1','akunadmin1@gmail.com',2,'2024-01-26 11:36:37',1),(485,'::1','1711523011@student.unand.ac.id',11,'2024-01-26 11:52:41',1),(486,'::1','1711523011@student.unand',12,'2024-01-26 12:09:50',1),(487,'::1','akunadmin1@gmail.com',2,'2024-01-26 13:16:40',1),(488,'::1','1711523011@student.unand',12,'2024-01-26 14:03:26',1),(489,'::1','1711523011@student.unand.ac.id',11,'2024-01-26 16:31:43',1),(490,'::1','1711523011@student.unand.ac.id',11,'2024-01-26 17:43:28',1),(491,'::1','1711523011@student.unand',12,'2024-01-26 18:30:57',1),(492,'::1','1711523011@student.unand',12,'2024-01-27 04:39:00',1),(493,'::1','akunadmin1@gmail.com',2,'2024-01-27 04:57:48',1),(494,'::1','1711523011@student.unand',12,'2024-01-27 05:41:12',1),(495,'::1','akunadmin1@gmail.com',2,'2024-01-27 06:03:33',1),(496,'::1','1711523011@student.unand',12,'2024-01-27 07:05:03',1),(497,'::1','akunadmin1@gmail.com',2,'2024-01-27 07:09:21',1),(498,'::1','1711523011@student.unand',12,'2024-01-29 11:46:46',1),(499,'::1','1711523011@student.unand.ac.id',11,'2024-01-29 12:34:06',1),(500,'::1','akunadmin1@gmail.com',2,'2024-01-29 12:41:54',1),(501,'::1','akunadmin1@gmail.com',2,'2024-01-29 12:43:27',1),(502,'::1','1711523011@student.unand.ac.id',11,'2024-01-29 12:45:53',1),(503,'::1','akunadmin1@gmail.com',2,'2024-01-29 13:29:43',1),(504,'::1','1711523011@student.unand.ac.id',11,'2024-01-30 22:09:55',1),(505,'::1','akunadmin1@gmail.com',2,'2024-01-30 22:20:25',1),(506,'::1','1711523011@student.unand',12,'2024-01-30 22:39:32',1),(507,'::1','1711523011@student.unand.ac.id',11,'2024-01-30 22:40:15',1),(508,'::1','akunadmin1@gmail.com',2,'2024-01-30 22:59:35',1),(509,'::1','1711523011@student.unand',12,'2024-01-30 23:12:10',1),(510,'::1','akunadmin1@gmail.com',2,'2024-01-31 12:53:25',1),(511,'::1','1711523011@student.unand',12,'2024-01-31 13:23:35',1),(512,'::1','akunadmin1@gmail.com',2,'2024-01-31 13:58:08',1),(513,'::1','akunadmin1@gmail.com',2,'2024-01-31 17:45:43',1),(514,'::1','akunadmin1@gmail.com',2,'2024-02-01 06:30:12',1),(515,'::1','akunadmin1@gmail.com',2,'2024-02-01 07:25:17',1),(516,'::1','1711523011@student.unand',12,'2024-02-01 08:03:35',1),(517,'::1','forgi@gmail.com',13,'2024-02-01 08:04:12',1),(518,'::1','1711523011@student.unand',12,'2024-02-01 08:36:22',1),(519,'::1','1711523011@student.unand.ac.id',11,'2024-02-01 09:12:42',1),(520,'::1','1711523011@student.unand',12,'2024-02-01 11:04:46',1),(521,'::1','1711523011@student.unand.ac.id',11,'2024-02-01 12:37:58',1),(522,'::1','akunadmin1@gmail.com',2,'2024-02-01 12:39:00',1),(523,'::1','1711523011@student.unand.ac.id',11,'2024-02-01 13:01:09',1),(524,'::1','akunadmin1@gmail.com',2,'2024-02-03 08:08:22',1),(525,'::1','1711523011@student.unand',12,'2024-02-03 09:44:51',1),(526,'::1','akunadmin1@gmail.com',2,'2024-02-03 09:52:55',1),(527,'::1','1711523011@student.unand.ac.id',11,'2024-02-05 15:30:29',1),(528,'::1','1711523011@student.unand',12,'2024-02-05 15:45:47',1),(529,'::1','1711523011@student.unand',12,'2024-02-06 11:14:22',1),(530,'::1','akunadmin1@gmail.com',2,'2024-02-06 11:17:00',1),(531,'::1','forgi@gmail.com',13,'2024-02-06 11:22:20',1),(532,'::1','1711523011@student.unand',12,'2024-02-06 11:25:13',1),(533,'::1','akunadmin1@gmail.com',2,'2024-02-06 11:32:30',1),(534,'::1','1711523011@student.unand',12,'2024-02-06 11:56:37',1),(535,'::1','akunadmin1@gmail.com',2,'2024-02-06 12:11:30',1),(536,'::1','akunadmin1@gmail.com',2,'2024-02-06 17:35:30',1),(537,'::1','akunadmin1@gmail.com',2,'2024-02-07 09:39:09',1),(538,'::1','1711523011@student.unand.ac.id',11,'2024-02-07 09:46:17',1),(539,'::1','akunadmin1@gmail.com',2,'2024-02-07 09:52:46',1),(540,'::1','1711523011@student.unand.ac.id',11,'2024-02-07 09:56:39',1),(541,'::1','1711523011@student.unand',12,'2024-02-07 11:13:31',1),(542,'::1','akunadmin1@gmail.com',2,'2024-02-07 11:27:12',1),(543,'::1','akunadmin1@gmail.com',2,'2024-02-07 15:59:06',1),(544,'::1','1711523011@student.unand',12,'2024-02-08 07:34:30',1),(545,'::1','akunadmin1@gmail.com',2,'2024-02-08 09:09:13',1),(546,'::1','1711523011@student.unand',12,'2024-02-08 09:12:45',1),(547,'::1','forgi@gmail.com',13,'2024-02-08 14:10:51',1),(548,'::1','1711523011@student.unand',12,'2024-02-08 14:39:05',1),(549,'::1','akunadmin1@gmail.com',2,'2024-02-08 15:03:53',1),(550,'::1','forgi@gmail.com',13,'2024-02-09 09:29:38',1),(551,'::1','akunadmin1@gmail.com',2,'2024-02-09 21:14:56',1),(552,'::1','akunadmin1@gmail.com',2,'2024-02-12 15:25:38',1),(553,'::1','akunadmin1@gmail.com',2,'2024-02-12 20:58:54',1),(554,'::1','akunadmin1@gmail.com',2,'2024-02-13 10:17:59',1),(555,'::1','akunadmin1@gmail.com',2,'2024-02-13 13:36:40',1),(556,'::1','1711523011@student.unand',12,'2024-02-17 14:21:03',1),(557,'::1','akunadmin1@gmail.com',2,'2024-02-19 16:08:03',1),(558,'::1','1711523011@student.unand.ac.id',11,'2024-02-19 16:08:43',1),(559,'::1','akunadmin1@gmail.com',2,'2024-03-06 12:40:09',1),(560,'::1','forgi@gmail.com',13,'2024-03-06 12:48:22',1),(561,'::1','akunadmin1@gmail.com',2,'2024-03-06 12:51:32',1),(562,'::1','1711523011@student.unand',12,'2024-03-06 13:48:21',1),(563,'::1','forgi@gmail.com',13,'2024-03-07 07:28:00',1),(564,'::1','forgi@gmail.com',13,'2024-03-07 12:38:07',1),(565,'::1','akunadmin1@gmail.com',2,'2024-03-07 12:45:42',1),(566,'::1','1711523011@student.unand',12,'2024-03-07 12:51:35',1),(567,'::1','1711523011@student.unand',12,'2024-03-21 10:26:39',1),(568,'::1','1711523011@student.unand',12,'2024-03-21 10:32:21',1),(569,'::1','1711523011@student.unand.ac.id',11,'2024-03-21 10:45:29',1),(570,'::1','akunadmin1@gmail.com',2,'2024-03-21 10:46:56',1),(571,'::1','akunadmin1@gmail.com',2,'2024-03-21 10:47:41',1),(572,'::1','forgi@gmail.com',13,'2024-03-21 10:48:00',1),(573,'::1','1711523011@student.unand',12,'2024-03-21 10:48:12',1),(574,'::1','1711523011@student.unand.ac.id',11,'2024-03-21 10:48:22',1),(575,'::1','athifah27zahra@gmail.com',14,'2024-03-21 10:54:50',1);
/*!40000 ALTER TABLE `auth_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`),
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_tokens`
--

LOCK TABLES `auth_tokens` WRITE;
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `tourism_package_id` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `users_id` int unsigned NOT NULL,
  `date` date NOT NULL,
  `total_member` int DEFAULT NULL,
  `total_price` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_time` time DEFAULT NULL,
  `status` varchar(2) CHARACTER SET utf8mb3 DEFAULT NULL,
  `comment` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL,
  `confirmation_date` datetime DEFAULT NULL,
  `admin_confirm` int unsigned DEFAULT NULL,
  `review` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `proof_of_payment` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL,
  `payment_accepted_date` datetime DEFAULT NULL,
  `payment_accepted_by` int unsigned DEFAULT NULL,
  `canceled_at` datetime DEFAULT NULL,
  `canceled_by` int unsigned DEFAULT NULL,
  `refund_date` datetime DEFAULT NULL,
  `refund_by` int unsigned DEFAULT NULL,
  `proof_of_refund` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bank_account` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`tourism_package_id`,`users_id`,`date`),
  KEY `fk_booking_users1_idx` (`users_id`) /*!80000 INVISIBLE */,
  KEY `fk_booking_users2_idx` (`admin_confirm`) /*!80000 INVISIBLE */,
  KEY `fk_booking_users3_idx1` (`payment_accepted_by`) /*!80000 INVISIBLE */,
  KEY `fk_booking_users4_idx1` (`refund_by`),
  KEY `canceled_by` (`canceled_by`) /*!80000 INVISIBLE */,
  KEY `tourism_package_idx` (`tourism_package_id`),
  CONSTRAINT `canceled_by` FOREIGN KEY (`canceled_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_booking_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_booking_users2` FOREIGN KEY (`admin_confirm`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_booking_users3` FOREIGN KEY (`payment_accepted_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_booking_users4` FOREIGN KEY (`refund_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tourism_package` FOREIGN KEY (`tourism_package_id`) REFERENCES `tourism_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES ('T01',11,'2024-02-05',5,650000,'2024-01-29','12:34:36','2','please process fast, thankyou!','2024-01-29 12:43:46',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T01',11,'2024-02-15',10,1300000,'2024-02-07','10:12:09','14','please process.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T01',11,'2024-02-16',5,650000,'2024-02-01','13:01:38','2','process please',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T01',11,'2024-03-28',5,650000,'2024-03-21','10:45:55','6','dg','2024-03-21 10:47:50',2,NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-21 10:49:12',11,NULL,NULL,NULL,NULL),('T01',12,'2024-02-07',4,650000,'2024-01-31','15:14:03','12','please process, thanks!','2024-01-31 15:17:25',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T01',12,'2024-02-10',4,650000,'2024-02-03','09:46:21','10','please process.','2024-02-03 09:53:28',2,NULL,NULL,'2024-02-03 09:54:10','451f02a06ef5d3fd5141a76e18cb8a14.jpg','2024-02-03 09:54:41',2,'2024-02-03 09:56:08',12,'2024-02-03 09:56:35',2,'451f02a06ef5d3fd5141a76e18cb8a14.jpg','BRI - ATHIFAH -74736437'),('T01',12,'2024-02-13',5,650000,'2024-02-06','11:16:39','13','process please.','2024-02-06 11:17:17',2,'nice package',5,'2024-02-06 11:17:42','716e27923b7373ccef327f86e6e7d240.jpg','2024-02-06 11:18:15',2,NULL,NULL,NULL,NULL,NULL,NULL),('T01',12,'2024-02-14',10,1300000,'2024-02-07','11:25:26','10','please process.','2024-02-07 11:31:46',2,NULL,NULL,'2024-02-07 11:34:20','c6725a42528b43cf6da2aeab1b99e90d.jpg','2024-02-07 11:50:58',2,'2024-02-07 11:58:03',12,'2024-02-07 12:14:24',2,'c6725a42528b43cf6da2aeab1b99e90d.jpg','BRI - ATHIFAH - 3717392'),('T01',12,'2024-02-15',7,910000,'2024-02-08','14:40:47','14','process please','2024-02-08 15:10:59',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T01',13,'2024-02-08',5,650000,'2024-02-01','08:07:09','8','Please process fast, thankyou','2024-02-01 08:12:20',2,NULL,NULL,'2024-02-01 08:15:26','1020d7dc733bf2d44eab4dac63969c08.jpg','2024-02-01 08:17:56',2,'2024-02-01 08:25:15',13,'2024-02-01 08:26:21',2,'1020d7dc733bf2d44eab4dac63969c08.jpg','BRI - ATHIFAH - 7463793741635'),('T01',13,'2024-03-15',6,780000,'2024-03-07','12:39:44','10','please process fast','2024-03-07 12:46:29',2,NULL,NULL,'2024-03-07 12:47:28','75ec4e93a3fbcdb1abbf3ab642e45c60.jpg','2024-03-07 12:47:53',2,'2024-03-07 12:49:16',13,'2024-03-07 12:49:49',2,'75ec4e93a3fbcdb1abbf3ab642e45c60.jpg','BRI - Athifah - 12345678'),('T06',12,'2024-02-02',6,NULL,'2024-01-27','07:43:04','14','rwe','2024-01-27 07:48:33',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T07',12,'2024-02-25',9,NULL,'2024-01-25','09:38:58','14','hkjh','2024-02-01 11:37:49',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T07',13,'2024-02-25',11,6050000,'2024-02-09','09:33:03','14','process please',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T08',11,'2024-02-07',6,830000,'2024-01-29','12:37:40','12','please process.',NULL,NULL,NULL,NULL,'2024-01-29 12:57:01','5f2285da66f57015a3a8d12f103fdfe8.jpg','2024-01-29 12:57:33',2,'2024-01-29 12:59:29',11,'2024-01-29 13:01:31',2,'5f2285da66f57015a3a8d12f103fdfe8.jpg','BRI - ATHIFAH -8437247834'),('T09',11,'2024-02-14',5,NULL,'2024-01-29','12:39:27','14','process, thanks.','2024-01-29 14:13:12',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T10',12,'2024-02-06',5,NULL,'2024-01-30','23:12:33','7','dfs','2024-01-31 14:23:01',2,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 15:13:34',12,NULL,NULL,NULL,'BRI - ATHIFAH - 7398729813'),('T11',12,'2024-02-04',5,775000,'2024-01-30','23:13:19','7','dads','2024-01-31 14:32:44',2,NULL,NULL,'2024-01-31 15:11:54','2e70f71d6bf6e271940b098abad7bb87.jpg','2024-01-31 15:12:04',2,'2024-01-31 16:05:43',12,'2024-01-31 16:06:04',2,'','BNI - ATHIFAH - 042547354'),('T14',12,'2024-02-15',5,1450000,'2024-02-01','08:39:28','14','process please.','2024-02-01 08:44:37',2,NULL,NULL,'2024-02-01 09:01:12','','2024-02-01 09:03:47',2,'2024-02-01 09:06:07',12,'2024-02-01 09:07:26',2,'af84bbd463d8d4bc68a2f610d4eea20e.jpg','BRI - ATHIFAH - 73723729372'),('T17',11,'2024-02-08',4,370000,'2024-02-01','09:38:58','10','process please.','2024-02-01 09:45:02',2,NULL,NULL,'2024-02-01 09:47:37','7a637fb4466b34eabc35aee2383ec878.jpg','2024-02-01 09:55:01',2,'2024-02-01 09:58:21',11,'2024-02-01 09:59:25',2,'7a637fb4466b34eabc35aee2383ec878.jpg','BRI - ATHIFAH - 74893724732'),('T18',12,'2024-02-02',5,NULL,'2024-02-03','10:08:18','14','process.','2024-02-03 10:09:23',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T19',12,'2024-02-10',10,NULL,'2024-02-03','10:19:24','2','please process',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T22',11,'2024-02-14',10,1500000,'2024-02-07','10:07:25','14','gfdg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T23',12,'2024-02-14',10,2150000,'2024-02-07','14:48:48','8','process please.','2024-02-08 09:17:08',2,NULL,NULL,'2024-02-08 09:58:00','ad2c69aa7c53a933c81431914906bc84.jpg','2024-02-08 09:58:13',2,'2024-02-08 10:27:31',12,'2024-02-08 10:41:30',2,'ad2c69aa7c53a933c81431914906bc84.jpg','BRI - ATHIFAH - 372613'),('T24',12,'2024-02-15',7,1255000,'2024-02-08','11:12:58','8','process please.','2024-02-08 11:20:05',2,NULL,NULL,'2024-02-08 12:16:29','ebc1ed4cbff5a63faba94092af118abe.jpg','2024-02-08 12:18:13',2,'2024-02-08 13:02:05',12,'2024-02-08 13:04:19',2,'ebc1ed4cbff5a63faba94092af118abe.jpg','BRI - ATHIFAH - 7382738'),('T25',13,'2024-03-14',5,1750000,'2024-03-07','12:42:33','2','please process',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('T26',13,'2024-03-14',5,1150000,'2024-03-07','12:45:18','2','please process',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_facility_rumah_gadang`
--

DROP TABLE IF EXISTS `detail_facility_rumah_gadang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_facility_rumah_gadang` (
  `rumah_gadang_id` varchar(3) NOT NULL,
  `facility_id` varchar(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rumah_gadang_id`,`facility_id`),
  KEY `fk_detail_facility_rumah_gadang_facility_rumah_gadang1_idx` (`facility_id`),
  KEY `fk_detail_facility_rumah_gadang_rumah_gadang1_idx` (`rumah_gadang_id`),
  CONSTRAINT `fk_detail_facility_rumah_gadang_facility_rumah_gadang1` FOREIGN KEY (`facility_id`) REFERENCES `facility_rumah_gadang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_facility_rumah_gadang_rumah_gadang1` FOREIGN KEY (`rumah_gadang_id`) REFERENCES `rumah_gadang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_facility_rumah_gadang`
--

LOCK TABLES `detail_facility_rumah_gadang` WRITE;
/*!40000 ALTER TABLE `detail_facility_rumah_gadang` DISABLE KEYS */;
INSERT INTO `detail_facility_rumah_gadang` VALUES ('R01','02','2023-12-31 15:04:58','2023-12-31 15:04:58'),('R01','03','2023-12-31 15:04:58','2023-12-31 15:04:58'),('R01','04','2023-12-31 15:04:58','2023-12-31 15:04:58'),('R01','F01','2023-12-31 15:04:58','2023-12-31 15:04:58'),('R01','F02','2023-12-31 15:04:58','2023-12-31 15:04:58'),('R01','F07','2023-12-31 15:04:58','2023-12-31 15:04:58'),('R02','02','2024-02-13 03:56:02','2024-02-13 03:56:02'),('R02','04','2024-02-13 03:56:02','2024-02-13 03:56:02'),('R05','02','2024-02-13 03:56:46','2024-02-13 03:56:46'),('R05','04','2024-02-13 03:56:46','2024-02-13 03:56:46'),('R06','02','2024-02-13 03:57:17','2024-02-13 03:57:17'),('R06','04','2024-02-13 03:57:17','2024-02-13 03:57:17'),('R06','F07','2024-02-13 03:57:17','2024-02-13 03:57:17'),('R07','02','2024-02-13 03:59:37','2024-02-13 03:59:37'),('R07','04','2024-02-13 03:59:37','2024-02-13 03:59:37'),('R07','F03','2024-02-13 03:59:38','2024-02-13 03:59:38'),('R08','02','2024-02-13 04:24:02','2024-02-13 04:24:02'),('R08','04','2024-02-13 04:24:02','2024-02-13 04:24:02'),('R08','05','2024-02-13 04:24:02','2024-02-13 04:24:02'),('R09','02','2024-02-13 04:24:16','2024-02-13 04:24:16'),('R09','04','2024-02-13 04:24:16','2024-02-13 04:24:16'),('R10','02','2024-02-13 04:20:35','2024-02-13 04:20:35'),('R10','04','2024-02-13 04:20:35','2024-02-13 04:20:35'),('R11','02','2024-02-13 04:23:20','2024-02-13 04:23:20'),('R11','04','2024-02-13 04:23:20','2024-02-13 04:23:20'),('R12','02','2024-02-13 06:37:30','2024-02-13 06:37:30'),('R12','04','2024-02-13 06:37:30','2024-02-13 06:37:30'),('R13','02','2024-02-13 06:39:30','2024-02-13 06:39:30'),('R13','04','2024-02-13 06:39:30','2024-02-13 06:39:30'),('R14','02','2024-02-13 06:41:25','2024-02-13 06:41:25'),('R14','04','2024-02-13 06:41:25','2024-02-13 06:41:25'),('R14','F03','2024-02-13 06:41:25','2024-02-13 06:41:25'),('R14','F04','2024-02-13 06:41:25','2024-02-13 06:41:25'),('R15','02','2024-02-13 06:44:48','2024-02-13 06:44:48'),('R15','04','2024-02-13 06:44:48','2024-02-13 06:44:48'),('R16','04','2024-02-13 06:46:40','2024-02-13 06:46:40'),('R17','02','2024-02-13 06:49:38','2024-02-13 06:49:38'),('R17','04','2024-02-13 06:49:38','2024-02-13 06:49:38'),('R18','02','2024-02-13 06:50:52','2024-02-13 06:50:52'),('R18','04','2024-02-13 06:50:52','2024-02-13 06:50:52'),('R19','02','2024-02-13 07:21:38','2024-02-13 07:21:38'),('R19','04','2024-02-13 07:21:38','2024-02-13 07:21:38'),('R20','02','2024-02-13 07:24:10','2024-02-13 07:24:10'),('R20','04','2024-02-13 07:24:10','2024-02-13 07:24:10'),('R20','05','2024-02-13 07:24:10','2024-02-13 07:24:10'),('R20','F03','2024-02-13 07:24:10','2024-02-13 07:24:10'),('R20','F05','2024-02-13 07:24:10','2024-02-13 07:24:10'),('R20','F06','2024-02-13 07:24:10','2024-02-13 07:24:10'),('R21','02','2024-02-13 07:24:59','2024-02-13 07:24:59'),('R21','04','2024-02-13 07:24:59','2024-02-13 07:24:59'),('R22','02','2024-02-13 07:25:29','2024-02-13 07:25:29'),('R22','04','2024-02-13 07:25:29','2024-02-13 07:25:29'),('R23','02','2024-02-13 07:38:34','2024-02-13 07:38:34'),('R23','04','2024-02-13 07:38:34','2024-02-13 07:38:34'),('R23','F03','2024-02-13 07:38:34','2024-02-13 07:38:34'),('R24','02','2024-02-13 07:39:13','2024-02-13 07:39:13'),('R24','04','2024-02-13 07:39:13','2024-02-13 07:39:13'),('R25','02','2024-02-13 07:39:37','2024-02-13 07:39:37'),('R25','04','2024-02-13 07:39:37','2024-02-13 07:39:37'),('R26','02','2024-02-13 07:40:12','2024-02-13 07:40:12'),('R26','04','2024-02-13 07:40:12','2024-02-13 07:40:12'),('R27','02','2024-02-13 07:41:21','2024-02-13 07:41:21'),('R27','04','2024-02-13 07:41:21','2024-02-13 07:41:21'),('R27','F03','2024-02-13 07:41:21','2024-02-13 07:41:21'),('R27','F06','2024-02-13 07:41:21','2024-02-13 07:41:21'),('R28','02','2024-02-13 07:45:47','2024-02-13 07:45:47'),('R28','04','2024-02-13 07:45:47','2024-02-13 07:45:47'),('R29','02','2024-02-13 07:52:05','2024-02-13 07:52:05'),('R29','04','2024-02-13 07:52:05','2024-02-13 07:52:05'),('R30','02','2024-02-13 07:54:10','2024-02-13 07:54:10'),('R30','04','2024-02-13 07:54:10','2024-02-13 07:54:10'),('R31','02','2024-02-13 07:56:18','2024-02-13 07:56:18'),('R31','04','2024-02-13 07:56:18','2024-02-13 07:56:18'),('R31','F06','2024-02-13 07:56:18','2024-02-13 07:56:18');
/*!40000 ALTER TABLE `detail_facility_rumah_gadang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_package`
--

DROP TABLE IF EXISTS `detail_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_package` (
  `tourism_package_id` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `day` varchar(1) NOT NULL,
  `activity` varchar(2) NOT NULL,
  `activity_type` varchar(2) NOT NULL,
  `description` tinytext,
  `id_object` varchar(4) NOT NULL,
  PRIMARY KEY (`tourism_package_id`,`day`,`activity`),
  KEY `detail_package` (`tourism_package_id`,`day`),
  CONSTRAINT `detail_package` FOREIGN KEY (`tourism_package_id`, `day`) REFERENCES `package_day` (`tourism_package_id`, `day`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_package`
--

LOCK TABLES `detail_package` WRITE;
/*!40000 ALTER TABLE `detail_package` DISABLE KEYS */;
INSERT INTO `detail_package` VALUES ('T01','1','1','SP','Welcome Drink','SP01'),('T01','1','2','A','Village Tour','A01'),('T01','1','3','A','Lunch','A02'),('T01','1','4','TO','Liuang River Area Games','O06'),('T01','1','5','TO','Agritourism','O03'),('T01','1','6','HP','PDRI Museum Tour','HP01'),('T01','1','7','SP','Souvenir','SP01'),('T02','1','1','A','Welcome Drink','A03'),('T02','1','2','A','Village Tour','A01'),('T02','1','3','A','Lunch','A02'),('T02','1','4','TO','Liuang River Area Games','O06'),('T02','1','5','TO','Agritourism','O03'),('T02','1','6','HP','PDRI Museum Tour','HP01'),('T02','1','7','SP','Souvenir','SP01'),('T03','1','1','A','Welcome Drink','A03'),('T03','1','2','A','Village Tour','A01'),('T03','1','3','A','Lunch','A02'),('T03','1','4','TO','Liuang River Area Games','O06'),('T03','1','5','TO','Agritourism','O03'),('T03','1','6','HP','PDRI Museum Tour','HP01'),('T03','1','7','SP','Souvenir','SP01'),('T04','1','0','RG','dv','UP01'),('T05','1','1','RG','Welcome Drink','A03'),('T05','1','2','RG','Village Tour','A01'),('T05','1','3','RG','Lunch','A02'),('T05','1','4','RG','Liuang River Area Games','O06'),('T05','1','5','RG','Agritourism','O03'),('T05','1','6','RG','PDRI Museum Tour','HP01'),('T05','1','7','RG','Souvenir','SP01'),('T05','1','8','H','cdf','ST01'),('T06','1','1','A','Welcome Drink','A03'),('T06','1','2','A','Village Tour','A01'),('T06','1','3','A','Lunch','A02'),('T06','1','4','TO','Liuang River Area Games','O06'),('T06','1','5','TO','Agritourism','O03'),('T06','1','6','HP','PDRI Museum Tour','HP01'),('T06','1','7','SP','Souvenir','SP01'),('T07','1','1','A','Welcoming by Sarugo Village Residents','A03'),('T07','1','2','TO','Welcome Drink with Orange Juice','R01'),('T07','1','3','A','Getting around Sarugo Village with Tour Guide','A01'),('T07','1','4','TO','Visit Orange Garden','O03'),('T07','1','5','A','Traditional Performing Arts','A04'),('T07','1','6','TO','Looking for sunset at Sarugo Peak','O01'),('T07','2','1','A','Getting Breakfast','A02'),('T07','2','2','TO','Visit Lubuak Liuang River','O06'),('T07','2','3','S','Learning to Cook','ST01'),('T07','2','4','S','Learning to Engrave','ST02'),('T07','2','5','A','Fishing Eeel and Resurrect Lukah','A05'),('T08','1','1','ST','Want to cooking Rendang','ST01'),('T08','1','2','TO','Attending orange garden','O03'),('T09','1','1','RG','Welcome Drink','A03'),('T09','1','2','RG','Village Tour','A01'),('T09','1','3','RG','Lunch','A02'),('T09','1','4','RG','Liuang River Area Games','O06'),('T09','1','5','RG','Agritourism','O03'),('T09','1','6','RG','PDRI Museum Tour','HP01'),('T09','1','7','RG','Souvenir','SP01'),('T09','1','8','TO','Visit forbidden fish','O02'),('T10','1','1','RG','fdsf','UP01'),('T11','1','1','RG','Welcome Drink','A03'),('T11','1','2','RG','Village Tour','A01'),('T11','1','3','RG','Lunch','A02'),('T11','1','4','RG','Liuang River Area Games','O06'),('T11','1','5','RG','Agritourism','O03'),('T11','1','6','RG','PDRI Museum Tour','HP01'),('T11','1','7','RG','Souvenir','SP01'),('T11','1','8','A','Looking for Nira','A02'),('T12','1','1','TO','Welcoming by Sarugo Residents','R01'),('T12','1','2','SP','Welcome drink with orange juice','SP01'),('T12','1','3','A','Tour around Sarugo village','A01'),('T12','1','4','TO','Agritourism at orange garden','O03'),('T12','1','5','TO','Looking for sunset at Sarugo Peak','O01'),('T12','2','1','A','Breakfast','A02'),('T12','2','2','TO','Visit Lubuak Liuang (taking a bath or playing water games)','O06'),('T12','2','3','S','Learning to Cook','ST01'),('T12','2','4','S','Learning to Woven','ST02'),('T12','2','5','A','Fishing eel and resurrect Lukah','A05'),('T12','2','6','UP','Talking at Lapau','UP14'),('T12','3','1','HP','Tracing back PDRI','HP01'),('T12','3','2','A','Gunuang Omeh Tour','A06'),('T12','3','3','A','Nira water processing','A07'),('T12','3','4','S','Learning to Randai','ST03'),('T13','1','1','A','Welcome Drink with orange juice','A09'),('T13','1','2','A','Saribu Gonjong Tour','A01'),('T13','2','1','TO','Sunsrise Sarugo Peak','O01'),('T13','2','2','Ru','Breakfast','R01'),('T13','2','3','A','Painting/Engraving Education','A08'),('T13','2','4','TO','Agritourism to Orange Garden','O03'),('T13','2','5','TO','Forbidden Fish Tour','O02'),('T13','2','6','A','Art Performances','A04'),('T13','3','1','Ru','Breakfast','R01'),('T13','3','2','HP','Tracing Back History of PDRI','HP01'),('T13','3','3','TO','Visit Talempong Batu','O09'),('T13','3','4','TO','Visit Tan Malaka\'s Home of Birth','O10'),('T13','3','5','TO','Ikan Banyak Tour','O11'),('T14','1','1','RG','Welcome Drink','A03'),('T14','1','2','RG','Village Tour','A01'),('T14','1','3','RG','Lunch','A02'),('T14','1','4','RG','Liuang River Area Games','O06'),('T14','1','5','RG','Agritourism','O03'),('T14','1','6','RG','PDRI Museum Tour','HP01'),('T14','1','7','RG','Souvenir','SP01'),('T14','1','8','A','Painting','A08'),('T17','1','1','A','take a walk around sarugo village','A01'),('T17','1','2','A','tour around gunuang omeh','A06'),('T17','1','3','TO','visit orange garden','O03'),('T18','1','1','RG','Welcome Drink','SP01'),('T18','1','2','RG','Village Tour','A01'),('T18','1','3','RG','Lunch','A02'),('T18','1','4','RG','Liuang River Area Games','O06'),('T18','1','5','RG','Agritourism','O03'),('T18','1','6','RG','PDRI Museum Tour','HP01'),('T18','1','7','RG','Souvenir','SP01'),('T18','1','8','H','Learning to cook','ST01'),('T19','1','1','A','tour keliling kampung','A01'),('T19','1','2','A','manciang baluik','A05'),('T20','1','1','RG','Welcome Drink','SP01'),('T20','1','2','RG','Village Tour','A01'),('T20','1','3','RG','Lunch','A02'),('T20','1','4','RG','Liuang River Area Games','O06'),('T20','1','5','RG','Agritourism','O03'),('T20','1','6','RG','PDRI Museum Tour','HP01'),('T20','1','7','RG','Souvenir','SP01'),('T20','1','8','H','fewf','ST01'),('T21','1','1','ST','gfdg','ST01'),('T22','1','1','ST','gfdg','ST01'),('T23','1','1','RG','Welcome Drink','SP01'),('T23','1','2','RG','Village Tour','A01'),('T23','1','3','RG','Lunch','A02'),('T23','1','4','RG','Liuang River Area Games','O06'),('T23','1','5','RG','Agritourism','O03'),('T23','1','6','RG','PDRI Museum Tour','HP01'),('T23','1','7','RG','Souvenir','SP01'),('T23','1','8','H','Learning to Cook','ST01'),('T24','1','1','A','explore gunuang omeh','A06'),('T24','1','2','TO','visit orange garden','O03'),('T25','1','1','RG','Welcome Drink','SP01'),('T25','1','2','RG','Village Tour','A01'),('T25','1','3','RG','Lunch','A02'),('T25','1','4','RG','Liuang River Area Games','O06'),('T25','1','5','RG','Agritourism','O03'),('T25','1','6','RG','PDRI Museum Tour','HP01'),('T25','1','7','RG','Souvenir','SP01'),('T25','1','8','A','memancing','A05'),('T26','1','1','A','keliling kampung','A01'),('T26','1','2','ST','belajar memasak','ST01');
/*!40000 ALTER TABLE `detail_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_service_package`
--

DROP TABLE IF EXISTS `detail_service_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_service_package` (
  `tourism_package_id` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `service_package_id` varchar(3) CHARACTER SET utf8mb3 NOT NULL,
  `status` varchar(1) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`tourism_package_id`,`service_package_id`),
  KEY `fk_detail_facility_package_tourism_package1_idx` (`tourism_package_id`) /*!80000 INVISIBLE */,
  KEY `fk_detail_service` (`service_package_id`),
  CONSTRAINT `fk_detail_facility_package_facility_package1` FOREIGN KEY (`service_package_id`) REFERENCES `service_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_package` FOREIGN KEY (`tourism_package_id`) REFERENCES `tourism_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_service_package`
--

LOCK TABLES `detail_service_package` WRITE;
/*!40000 ALTER TABLE `detail_service_package` DISABLE KEYS */;
INSERT INTO `detail_service_package` VALUES ('T01','S02','1'),('T01','S03','1'),('T01','S04','1'),('T01','S05','1'),('T01','S07','1'),('T01','S08','1'),('T01','S09','0'),('T01','S10','0'),('T01','S11','0'),('T02','S02','1'),('T02','S03','1'),('T02','S04','1'),('T02','S05','1'),('T02','S07','1'),('T02','S08','1'),('T02','S09','0'),('T02','S10','0'),('T02','S11','0'),('T03','S02','1'),('T03','S03','1'),('T03','S04','1'),('T03','S05','1'),('T03','S07','1'),('T03','S08','1'),('T03','S09','0'),('T03','S10','0'),('T03','S11','0'),('T04','S01','1'),('T05','S02','1'),('T05','S03','1'),('T05','S04','1'),('T05','S05','1'),('T05','S07','1'),('T05','S08','1'),('T05','S09','0'),('T05','S10','0'),('T05','S11','0'),('T06','S02','1'),('T06','S03','1'),('T06','S04','1'),('T06','S05','1'),('T06','S07','1'),('T06','S08','1'),('T06','S09','0'),('T06','S10','0'),('T06','S11','0'),('T07','S01','1'),('T07','S02','1'),('T07','S03','1'),('T07','S04','1'),('T07','S05','1'),('T07','S07','1'),('T07','S09','0'),('T07','S10','0'),('T07','S11','0'),('T08','S04','1'),('T08','S05','1'),('T09','S02','1'),('T09','S03','1'),('T09','S04','1'),('T09','S05','1'),('T09','S07','1'),('T09','S08','1'),('T09','S09','0'),('T09','S10','0'),('T09','S11','0'),('T10','S01','1'),('T11','S02','1'),('T11','S03','1'),('T11','S04','1'),('T11','S05','1'),('T11','S07','1'),('T11','S08','1'),('T11','S09','0'),('T11','S10','0'),('T11','S11','0'),('T12','S01','1'),('T12','S02','1'),('T12','S03','1'),('T12','S04','1'),('T12','S05','1'),('T12','S06','1'),('T12','S09','0'),('T12','S10','0'),('T12','S11','0'),('T13','S01','1'),('T13','S02','1'),('T13','S03','1'),('T13','S04','1'),('T13','S05','1'),('T13','S09','0'),('T13','S10','0'),('T13','S11','0'),('T14','S01','1'),('T14','S02','1'),('T14','S03','1'),('T14','S04','1'),('T14','S05','1'),('T14','S07','1'),('T14','S08','1'),('T14','S09','0'),('T14','S10','0'),('T14','S11','0'),('T17','S03','1'),('T17','S04','1'),('T17','S05','1'),('T18','S01','1'),('T18','S02','1'),('T18','S03','1'),('T18','S04','1'),('T18','S05','1'),('T18','S07','1'),('T18','S08','1'),('T19','S01','1'),('T19','S03','1'),('T19','S07','1'),('T20','S02','1'),('T20','S03','1'),('T20','S04','1'),('T20','S05','1'),('T20','S07','1'),('T20','S08','1'),('T21','S01','1'),('T22','S01','1'),('T23','S01','1'),('T23','S02','1'),('T23','S03','1'),('T23','S04','1'),('T23','S05','1'),('T23','S07','1'),('T23','S08','1'),('T24','S01','1'),('T24','S03','1'),('T24','S07','1'),('T25','S01','1'),('T25','S02','1'),('T25','S03','1'),('T25','S04','1'),('T25','S05','1'),('T25','S07','1'),('T25','S08','1'),('T25','S09','0'),('T25','S10','0'),('T25','S11','0'),('T26','S01','1'),('T26','S03','1');
/*!40000 ALTER TABLE `detail_service_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facility_rumah_gadang`
--

DROP TABLE IF EXISTS `facility_rumah_gadang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facility_rumah_gadang` (
  `id` varchar(3) NOT NULL,
  `facility` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facility_rumah_gadang`
--

LOCK TABLES `facility_rumah_gadang` WRITE;
/*!40000 ALTER TABLE `facility_rumah_gadang` DISABLE KEYS */;
INSERT INTO `facility_rumah_gadang` VALUES ('02','Prayer Tools',NULL,'2023-08-12 13:01:22'),('03','Shower',NULL,NULL),('04','Kitchen',NULL,NULL),('05','Fan',NULL,NULL),('F01','Sitting Closet','2023-05-29 20:46:14','2023-06-29 15:21:26'),('F02','Water Heater','2023-06-29 15:21:47','2023-06-29 15:21:47'),('F03','Television','2023-06-29 15:22:18','2023-06-29 15:22:18'),('F04','Washing Machine','2023-06-29 15:22:55','2023-06-29 15:22:55'),('F05','Refrigerator','2023-06-29 15:23:48','2023-06-29 15:23:48'),('F06','Rice Cooker','2023-06-29 15:25:59','2023-06-29 15:25:59'),('F07','Induction Cooker','2023-06-29 15:29:47','2023-06-29 15:29:47');
/*!40000 ALTER TABLE `facility_rumah_gadang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_history_place`
--

DROP TABLE IF EXISTS `gallery_history_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_history_place` (
  `id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `history_place_id` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gallery_history_place_history_place1_idx` (`history_place_id`),
  CONSTRAINT `fk_gallery_history_place_history_place1` FOREIGN KEY (`history_place_id`) REFERENCES `history_place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_history_place`
--

LOCK TABLES `gallery_history_place` WRITE;
/*!40000 ALTER TABLE `gallery_history_place` DISABLE KEYS */;
INSERT INTO `gallery_history_place` VALUES ('004','1706176794_d78cc627400dbf6e6002.jpg','HP01'),('005','1707728288_0f775599c3ca9da8652a.jpg','HP02'),('006','1707728381_b689ad3a833d4fcdea0d.jpeg','HP03'),('007','1707728938_eabfb9446509c14c9bcf.jpg','HP04');
/*!40000 ALTER TABLE `gallery_history_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_rumah_gadang`
--

DROP TABLE IF EXISTS `gallery_rumah_gadang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_rumah_gadang` (
  `id` varchar(3) NOT NULL,
  `rumah_gadang_id` varchar(3) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `gallery_rumah_gadang_ibfk_2` (`rumah_gadang_id`),
  CONSTRAINT `gallery_rumah_gadang_ibfk_1` FOREIGN KEY (`rumah_gadang_id`) REFERENCES `rumah_gadang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gallery_rumah_gadang_ibfk_2` FOREIGN KEY (`rumah_gadang_id`) REFERENCES `rumah_gadang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_rumah_gadang`
--

LOCK TABLES `gallery_rumah_gadang` WRITE;
/*!40000 ALTER TABLE `gallery_rumah_gadang` DISABLE KEYS */;
INSERT INTO `gallery_rumah_gadang` VALUES ('01','R19','1707808881_f2c650cfd18a46b6c2a5.jpg','2024-02-13 07:21:38','2024-02-13 07:21:38'),('012','R01','1704035093_fb16e468dd05914085f9.jpeg','2023-12-31 15:04:58','2023-12-31 15:04:58'),('013','R01','1704035093_042be8a7f2ba29802af3.jpeg','2023-12-31 15:04:58','2023-12-31 15:04:58'),('014','R01','1704035068_1980012bd32e468ed601.jpg','2023-12-31 15:04:58','2023-12-31 15:04:58'),('015','R01','1704035068_ab48d13a4b8b0bd2e0c3.jpg','2023-12-31 15:04:58','2023-12-31 15:04:58'),('016','R01','1704035065_cf3ed42e6089d928f2d4.jpg','2023-12-31 15:04:59','2023-12-31 15:04:59'),('017','R01','1704035065_845765676717fe30b649.jpg','2023-12-31 15:04:59','2023-12-31 15:04:59'),('034','R02','1707796545_128c4686162f518e0c26.jpg','2024-02-13 03:56:03','2024-02-13 03:56:03'),('035','R02','1707796545_6689d82bcbcab8d6ebfe.jpg','2024-02-13 03:56:03','2024-02-13 03:56:03'),('036','R02','1707796547_627fb0f7beb4ba1aa948.jpg','2024-02-13 03:56:03','2024-02-13 03:56:03'),('037','R05','1707796580_7d78ebb6047fa7168c3d.jpg','2024-02-13 03:56:46','2024-02-13 03:56:46'),('038','R05','1707796580_09cad0ba86f2b5d14264.jpg','2024-02-13 03:56:46','2024-02-13 03:56:46'),('039','R05','1707796583_839903a4a8892c7f864b.jpg','2024-02-13 03:56:46','2024-02-13 03:56:46'),('040','R06','1707796617_d6b90ac7d06fb02b5557.jpg','2024-02-13 03:57:18','2024-02-13 03:57:18'),('041','R06','1707796617_2c7c3a96bc7475183bd4.jpg','2024-02-13 03:57:18','2024-02-13 03:57:18'),('042','R06','1707796619_31ed55ec920b2d76b354.jpg','2024-02-13 03:57:18','2024-02-13 03:57:18'),('043','R07','1707796747_a0662021595ef104607d.jpg','2024-02-13 03:59:38','2024-02-13 03:59:38'),('044','R07','1707796741_7366e4b9b4171e150aaf.jpg','2024-02-13 03:59:38','2024-02-13 03:59:38'),('045','R07','1707796741_2b7255adeedcf38b2008.jpg','2024-02-13 03:59:38','2024-02-13 03:59:38'),('046','R07','1707796705_03f844769bf4961ca01b.jpg','2024-02-13 03:59:38','2024-02-13 03:59:38'),('047','R07','1707796705_a84b623f8a62d7aed687.jpg','2024-02-13 03:59:38','2024-02-13 03:59:38'),('048','R07','1707796707_a0d59abd44a932eb23b1.jpg','2024-02-13 03:59:38','2024-02-13 03:59:38'),('049','R07','1707796707_946983cca3ab8889aa0f.jpg','2024-02-13 03:59:38','2024-02-13 03:59:38'),('058','R10','1707798022_cc9583e956c1bcabcf89.jpg','2024-02-13 04:20:35','2024-02-13 04:20:35'),('059','R10','1707798016_4c53a01a6724709f45e8.jpg','2024-02-13 04:20:35','2024-02-13 04:20:35'),('060','R10','1707798016_b6f5f628074f66e769f0.jpg','2024-02-13 04:20:35','2024-02-13 04:20:35'),('061','R11','1707798162_2eed82fcbfe9c636c0f6.jpg','2024-02-13 04:23:20','2024-02-13 04:23:20'),('062','R11','1707798156_383888ed01a7c52029b3.jpg','2024-02-13 04:23:20','2024-02-13 04:23:20'),('063','R11','1707798156_a6fe7215feaf58be6329.jpg','2024-02-13 04:23:20','2024-02-13 04:23:20'),('064','R08','1707798234_59b97ee0f66d38a4d52b.jpg','2024-02-13 04:24:03','2024-02-13 04:24:03'),('065','R08','1707798234_30546275425c6876f0a9.jpg','2024-02-13 04:24:03','2024-02-13 04:24:03'),('066','R08','1707798236_64525ba9a5b882fda85f.jpg','2024-02-13 04:24:03','2024-02-13 04:24:03'),('067','R08','1707798236_5361033c1560e10bbab4.jpg','2024-02-13 04:24:03','2024-02-13 04:24:03'),('068','R08','1707798238_7f061adf556f5a32bc01.jpg','2024-02-13 04:24:03','2024-02-13 04:24:03'),('069','R09','1707798250_fb7e655923c5f7c8a0a4.jpg','2024-02-13 04:24:16','2024-02-13 04:24:16'),('070','R09','1707798250_d790cb283db56e43e462.jpg','2024-02-13 04:24:16','2024-02-13 04:24:16'),('071','R09','1707798253_a1386b6191b616e5aabe.jpg','2024-02-13 04:24:16','2024-02-13 04:24:16'),('072','R12','1707806234_b70451c318bc37d1c553.jpg','2024-02-13 06:37:30','2024-02-13 06:37:30'),('073','R12','1707806230_05b9904355dae1187ffb.jpg','2024-02-13 06:37:30','2024-02-13 06:37:30'),('074','R12','1707806230_59fd0d71b02d14f0373b.jpg','2024-02-13 06:37:30','2024-02-13 06:37:30'),('075','R13','1707806337_f8b0ca38ac3506e7593c.jpg','2024-02-13 06:39:30','2024-02-13 06:39:30'),('076','R13','1707806337_19167be39921ed048bbe.jpg','2024-02-13 06:39:30','2024-02-13 06:39:30'),('077','R14','1707806455_df64aaf4ea18f9519198.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('078','R14','1707806455_6c2d3270a7c65ac32a66.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('079','R14','1707806444_ac49fd55da706e795ce4.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('080','R14','1707806437_4b0853eef5a7c6fe803f.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('081','R14','1707806442_35a33e4cd8751634dd22.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('082','R14','1707806437_2bc668d204269806d3ec.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('083','R14','1707806439_54da70b958646490814b.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('084','R14','1707806446_42582706e8709e412d47.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('085','R14','1707806439_3bac2192071a845e0c7a.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('086','R14','1707806441_e21c76bdff5b9dcf65ea.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('087','R14','1707806444_edb588188cc6cf2cf591.jpg','2024-02-13 06:41:26','2024-02-13 06:41:26'),('088','R15','1707806670_1400372ef5ae661e8554.jpg','2024-02-13 06:44:49','2024-02-13 06:44:49'),('089','R15','1707806670_b579c9804c825fc4d8dd.jpg','2024-02-13 06:44:49','2024-02-13 06:44:49'),('090','R16','1707806785_2b7bc408c4aab721cd51.jpg','2024-02-13 06:46:41','2024-02-13 06:46:41'),('091','R16','1707806785_29899a1818bbf9246f98.jpg','2024-02-13 06:46:41','2024-02-13 06:46:41'),('092','R16','1707806762_614932daed3f91705fd2.jpg','2024-02-13 06:46:41','2024-02-13 06:46:41'),('093','R16','1707806764_a1ea0956288467b089cf.jpg','2024-02-13 06:46:41','2024-02-13 06:46:41'),('094','R16','1707806762_5be3c185e8b3f09c52cc.jpg','2024-02-13 06:46:41','2024-02-13 06:46:41'),('095','R16','1707806764_6184c4acc710ed1ff44d.jpg','2024-02-13 06:46:41','2024-02-13 06:46:41'),('096','R17','1707806964_13d324d81b20f999d703.jpg','2024-02-13 06:49:38','2024-02-13 06:49:38'),('097','R17','1707806964_b0019fec2e0369d0f49a.jpg','2024-02-13 06:49:38','2024-02-13 06:49:38'),('098','R18','1707807025_8088e311c2dfb51ffc3e.jpg','2024-02-13 06:50:52','2024-02-13 06:50:52'),('099','R18','1707807025_add7349a6c8f99a342d3.jpg','2024-02-13 06:50:52','2024-02-13 06:50:52'),('100','R19','1707808895_625a95130cbe5560c1c9.jpg','2024-02-13 07:21:38','2024-02-13 07:21:38'),('101','R20','1707809046_02d2c2f64a88e0ca0d82.jpg','2024-02-13 07:24:11','2024-02-13 07:24:11'),('102','R20','1707809046_f769e8acb6ed8b0f4115.jpg','2024-02-13 07:24:11','2024-02-13 07:24:11'),('103','R20','1707809035_f133b0e420621bd05963.jpg','2024-02-13 07:24:11','2024-02-13 07:24:11'),('104','R20','1707809036_005bbffacd3b844d32ed.jpg','2024-02-13 07:24:11','2024-02-13 07:24:11'),('105','R20','1707809038_bf69f088c7ab5e5eac03.jpg','2024-02-13 07:24:11','2024-02-13 07:24:11'),('106','R21','1707809095_e0633dcbafa41c82ce68.jpg','2024-02-13 07:24:59','2024-02-13 07:24:59'),('107','R21','1707809095_aec1d85a328899b395c9.jpg','2024-02-13 07:24:59','2024-02-13 07:24:59'),('108','R22','1707809125_3e1d2ff4b3efb3c63aad.jpg','2024-02-13 07:25:29','2024-02-13 07:25:29'),('109','R22','1707809125_d6b450cb8a7aac78a17f.jpg','2024-02-13 07:25:29','2024-02-13 07:25:29'),('110','R23','1707809904_dd52f57d91bc16c54d2b.jpg','2024-02-13 07:38:34','2024-02-13 07:38:34'),('111','R23','1707809897_c7cdb6138f05ed61890c.jpg','2024-02-13 07:38:34','2024-02-13 07:38:34'),('112','R23','1707809882_94d94173310f70bc525d.jpg','2024-02-13 07:38:35','2024-02-13 07:38:35'),('113','R23','1707809882_2cd2386523e0eac3e6b5.jpg','2024-02-13 07:38:35','2024-02-13 07:38:35'),('114','R23','1707809883_0582f051451a6028fd6b.jpg','2024-02-13 07:38:35','2024-02-13 07:38:35'),('115','R23','1707809884_9fb9dc9e7a2323f43ad3.jpg','2024-02-13 07:38:35','2024-02-13 07:38:35'),('116','R23','1707809886_9855d1abc9308348b456.jpg','2024-02-13 07:38:35','2024-02-13 07:38:35'),('117','R24','1707809950_661453e7d8bad0c974f2.jpg','2024-02-13 07:39:13','2024-02-13 07:39:13'),('118','R24','1707809946_a2ec197eccfd21726873.jpg','2024-02-13 07:39:13','2024-02-13 07:39:13'),('119','R25','1707809974_5f30ab5cec50309279ea.jpg','2024-02-13 07:39:37','2024-02-13 07:39:37'),('120','R25','1707809974_7a016d56b4c5d7c52ab2.jpg','2024-02-13 07:39:38','2024-02-13 07:39:38'),('121','R26','1707810008_ad4b10a3b14a5fbc2e9c.jpg','2024-02-13 07:40:12','2024-02-13 07:40:12'),('122','R26','1707810009_12a15deadcfa41d7c41c.jpg','2024-02-13 07:40:12','2024-02-13 07:40:12'),('123','R27','1707810076_1b4bac438b99cddff092.jpg','2024-02-13 07:41:21','2024-02-13 07:41:21'),('124','R27','1707810071_86325e2fde2d96f352ca.jpg','2024-02-13 07:41:21','2024-02-13 07:41:21'),('125','R27','1707810061_e435fe0b0bc558f5d7c4.jpg','2024-02-13 07:41:22','2024-02-13 07:41:22'),('126','R27','1707810062_5ed7f8f42f85d94c63bf.jpg','2024-02-13 07:41:22','2024-02-13 07:41:22'),('127','R27','1707810063_d5134de32614723f1ac8.jpg','2024-02-13 07:41:22','2024-02-13 07:41:22'),('128','R27','1707810064_b191ba3c3cfc948adaa9.jpg','2024-02-13 07:41:22','2024-02-13 07:41:22'),('129','R27','1707810066_8fdd9e6467cf4ac6fae9.jpg','2024-02-13 07:41:22','2024-02-13 07:41:22'),('130','R27','1707810066_d13fbfea443f2e26eb1f.jpg','2024-02-13 07:41:22','2024-02-13 07:41:22'),('131','R27','1707810068_ee1721bcd6d8d92b6e04.jpg','2024-02-13 07:41:22','2024-02-13 07:41:22'),('132','R28','1707810130_281e832f521fba84642e.jpg','2024-02-13 07:45:47','2024-02-13 07:45:47'),('133','R28','1707810129_247b3e19559c0adb66ca.jpg','2024-02-13 07:45:47','2024-02-13 07:45:47'),('134','R29','1707810706_a10a4b50442a34fc2fe6.jpg','2024-02-13 07:52:06','2024-02-13 07:52:06'),('135','R29','1707810706_907084182c7b472a0979.jpg','2024-02-13 07:52:06','2024-02-13 07:52:06'),('136','R30','1707810804_98ce978538c8f21529d6.jpg','2024-02-13 07:54:10','2024-02-13 07:54:10'),('137','R30','1707810804_1a6b9f90accd175a260d.jpg','2024-02-13 07:54:10','2024-02-13 07:54:10'),('138','R31','1707810930_98e747c8b2bdcd67e3f7.jpg','2024-02-13 07:56:18','2024-02-13 07:56:18'),('139','R31','1707810930_5120b68c147471c74ee7.jpg','2024-02-13 07:56:18','2024-02-13 07:56:18'),('140','R31','1707810907_e48fcb80ae776501f3cc.jpg','2024-02-13 07:56:18','2024-02-13 07:56:18'),('141','R31','1707810907_4cf42942402a24dd23b4.jpg','2024-02-13 07:56:19','2024-02-13 07:56:19'),('142','R31','1707810909_90aa0b101006c155f78b.jpg','2024-02-13 07:56:19','2024-02-13 07:56:19'),('143','R31','1707810910_349c0d0b05fdf06054aa.jpg','2024-02-13 07:56:19','2024-02-13 07:56:19'),('144','R31','1707810912_a7a1a9bd6dc6bd6dac83.jpg','2024-02-13 07:56:19','2024-02-13 07:56:19');
/*!40000 ALTER TABLE `gallery_rumah_gadang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_souvenir_place`
--

DROP TABLE IF EXISTS `gallery_souvenir_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_souvenir_place` (
  `id` varchar(3) NOT NULL,
  `url` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `souvenir_place_id` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_gallery_souvenir_place_souvenir_place1_idx` (`souvenir_place_id`),
  CONSTRAINT `fk_gallery_souvenir_place_souvenir_place1` FOREIGN KEY (`souvenir_place_id`) REFERENCES `souvenir_place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_souvenir_place`
--

LOCK TABLES `gallery_souvenir_place` WRITE;
/*!40000 ALTER TABLE `gallery_souvenir_place` DISABLE KEYS */;
INSERT INTO `gallery_souvenir_place` VALUES ('002','1706176357_8882031f780c5ae81354.jpg',NULL,NULL,'SP01');
/*!40000 ALTER TABLE `gallery_souvenir_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_tourism_package`
--

DROP TABLE IF EXISTS `gallery_tourism_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_tourism_package` (
  `id` varchar(3) CHARACTER SET utf8mb3 NOT NULL,
  `tourism_package_id` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb3 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `gallery_tourism_package_ibfk_1` (`tourism_package_id`),
  CONSTRAINT `gallery_tourism_package_ibfk_1` FOREIGN KEY (`tourism_package_id`) REFERENCES `tourism_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_tourism_package`
--

LOCK TABLES `gallery_tourism_package` WRITE;
/*!40000 ALTER TABLE `gallery_tourism_package` DISABLE KEYS */;
INSERT INTO `gallery_tourism_package` VALUES ('060','T12','1707812102_1725e0f9072f5854ba47.jpg','2024-02-13 08:15:21','2024-02-13 08:15:21'),('062','T12','1707812073_5c150e6f4bb1a3da42e0.jpg','2024-02-13 08:15:21','2024-02-13 08:15:21'),('064','T12','1707812073_89b8a670b8015d515237.jpg','2024-02-13 08:15:21','2024-02-13 08:15:21'),('066','T12','1707812075_f2029bc778de135049a5.jpeg','2024-02-13 08:15:21','2024-02-13 08:15:21'),('068','T12','1707812075_1e904067546f4c4d167e.jpg','2024-02-13 08:15:21','2024-02-13 08:15:21'),('070','T12','1707812077_9617592748fd7e84bac8.jpg','2024-02-13 08:15:21','2024-02-13 08:15:21'),('072','T13','1707815188_26d676dca263e4b7dd83.jpg','2024-02-13 09:06:42','2024-02-13 09:06:42'),('074','T13','1707815182_22487e125fbe6f0a9ca4.jpg','2024-02-13 09:06:42','2024-02-13 09:06:42'),('076','T13','1707815187_4598b8004f67d207123f.jpeg','2024-02-13 09:06:42','2024-02-13 09:06:42'),('078','T13','1707815184_92de43cceab038fbaae6.jpeg','2024-02-13 09:06:42','2024-02-13 09:06:42'),('080','T13','1707815182_6e6ddd3371e590926e5e.jpg','2024-02-13 09:06:42','2024-02-13 09:06:42'),('082','T13','1707815184_b889f80ddf99000b960d.jpg','2024-02-13 09:06:42','2024-02-13 09:06:42'),('084','T01','1709703628_c1f53f56b2b5faebd47c.jpg','2024-03-06 05:42:26','2024-03-06 05:42:26'),('086','T01','1709703628_7f3bc5933db5513c99b0.jpg','2024-03-06 05:42:26','2024-03-06 05:42:26'),('088','T01','1709703626_3c5fda3e76d42e95e6fc.jpg','2024-03-06 05:42:26','2024-03-06 05:42:26'),('090','T01','1709703626_36871149b53b92880948.jpeg','2024-03-06 05:42:26','2024-03-06 05:42:26'),('092','T01','1709703630_4811adc8769b553dc4c1.jpeg','2024-03-06 05:42:26','2024-03-06 05:42:26'),('094','T07','1709704306_2575b047a6c1bd98471b.jpg','2024-03-06 05:52:05','2024-03-06 05:52:05'),('096','T07','1709704304_8a0d581bba278165dd22.jpeg','2024-03-06 05:52:05','2024-03-06 05:52:05'),('098','T07','1709704306_5642189f61e1287e3b70.jpg','2024-03-06 05:52:05','2024-03-06 05:52:05'),('100','T07','1709704304_b39cbbcff1e9e6f9f708.jpg','2024-03-06 05:52:06','2024-03-06 05:52:06'),('102','T07','1709704308_bb9b6cd8ac1d78bb14e4.jpeg','2024-03-06 05:52:06','2024-03-06 05:52:06'),('104','T07','1709704308_06d0570d333a384db243.jpg','2024-03-06 05:52:06','2024-03-06 05:52:06'),('106','T07','1709704310_38c8858b576c48c73a3d.jpg','2024-03-06 05:52:06','2024-03-06 05:52:06');
/*!40000 ALTER TABLE `gallery_tourism_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_umkm_place`
--

DROP TABLE IF EXISTS `gallery_umkm_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_umkm_place` (
  `id` varchar(3) NOT NULL,
  `umkm_place_id` varchar(4) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `umkm_place_id` (`umkm_place_id`),
  CONSTRAINT `gallery_umkm_place_ibfk_1` FOREIGN KEY (`umkm_place_id`) REFERENCES `umkm_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_umkm_place`
--

LOCK TABLES `gallery_umkm_place` WRITE;
/*!40000 ALTER TABLE `gallery_umkm_place` DISABLE KEYS */;
INSERT INTO `gallery_umkm_place` VALUES ('020','UP14','1706175484_30a4a1d317f3f2505a54.jpg',NULL,NULL),('021','UP01','1707727173_c79b0ef85ee57a7ebd65.jpg',NULL,NULL),('022','UP02','1707727207_be4717751a9a8d5683b5.jpg',NULL,NULL),('023','UP03','1707727237_8adb7a8321fde579d1af.jpg',NULL,NULL),('024','UP04','1707727261_7aef07b5920cf9f7eddb.jpg',NULL,NULL),('025','UP05','1707727374_a92d7cd664399b3e668e.jpg',NULL,NULL),('026','UP06','1707727420_c24ef7ecea8dd6074fb3.jpg',NULL,NULL),('027','UP08','1707727459_4d902304701846b9b37a.jpg',NULL,NULL),('028','UP09','1707727480_ecda54df9b141eb3e668.jpg',NULL,NULL),('029','UP11','1707727775_488532ac7050bf34f075.jpg',NULL,NULL),('030','UP12','1707727917_5025666a132ce38cf064.jpg',NULL,NULL),('031','UP13','1707728105_a3ff3762a47b01e09c71.jpg',NULL,NULL);
/*!40000 ALTER TABLE `gallery_umkm_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_worship_place`
--

DROP TABLE IF EXISTS `gallery_worship_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_worship_place` (
  `id` varchar(3) NOT NULL,
  `worship_place_id` varchar(4) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `gallery_worship_place_ibfk_1` (`worship_place_id`),
  CONSTRAINT `gallery_worship_place_ibfk_1` FOREIGN KEY (`worship_place_id`) REFERENCES `worship_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_worship_place`
--

LOCK TABLES `gallery_worship_place` WRITE;
/*!40000 ALTER TABLE `gallery_worship_place` DISABLE KEYS */;
INSERT INTO `gallery_worship_place` VALUES ('003',NULL,'1691809671_43aae547ce98b62a0210.jpg',NULL,NULL),('004',NULL,'1691809665_86e024889bc9eac79730.jpg',NULL,NULL),('005',NULL,'1696258041_5fa17d1a8d8202655f74.jpg',NULL,NULL),('010','WP02','1704947582_045e5533ca61f07a200b.jpg',NULL,NULL),('011','WP01','1707726417_870d764d0b90b5de3f45.jpg',NULL,NULL),('012','WP03','1707726563_28262a9505288945f271.jpg',NULL,NULL);
/*!40000 ALTER TABLE `gallery_worship_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_place`
--

DROP TABLE IF EXISTS `history_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_place` (
  `id` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_place`
--

LOCK TABLES `history_place` WRITE;
/*!40000 ALTER TABLE `history_place` DISABLE KEYS */;
INSERT INTO `history_place` VALUES ('HP01','Monumen Nasional PDRI','Kampuang Sarugo Sei. Dadok','09:00:00','15:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0ú:º[£Y@ƒ®z•¿*ÅÆ¡Y@\Ìng‰„•¿õ>Ÿ¡Y@p×¦w‰•¿ÀE‚ Y@\Ş-\Ú-•¿ü‘}\ëY@v¿¯6k••¿dºÆY@­jIG9˜•¿¶3§&œY@^ªˆ‰¼›•¿L\'È¾šY@k=&Rš•¿ş\è@{šY@ûY¬•¿4o0/›Y@³K¯(€½•¿\ë,\Ä4Y@¿Á|hÕ•¿>\rŸY@E\Ö\ZJí•¿B}&V¡Y@3SZK\0–¿Å´Ê§¢Y@ˆû#g¼–¿#\å\İG¤Y@‚=\Èü•¿\ç~=¦Y@9Bò\ìò•¿<\Ñ\Z¨Y@ü®c·*ä•¿1[²ªY@\ËòuşÓ•¿x\Ş|Ù¬Y@\İ”œ¸Á•¿„-vû¬Y@-\ç÷¢â¤•¿	Ö‚(©Y@Q\Ó\Ó\ì&•¿Û¢qM¦Y@K\ë\Ê\Â2‘•¿ú:º[£Y@ƒ®z•¿',-0.02124900,100.36944300,'The PDRI National Monument or Monumen Nasional Bela Negara is a memorial monument erected to commemorate the history of the struggle of the Emergency Government of the Republic of Indonesia (PDRI), the organizer of the government of the Republic of Indonesia when the capital of Indonesia fell to the Dutch in the Second Dutch Military Aggression. The monument was built in an area of 40 hectares in one of the areas that was once the base of PDRI.'),('HP02','Tugu PDRI','Kampuang Sarugo Sei. Dadok','12:00:00','12:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0g\Å&\è\åY@{[ú\á1Mª¿7U÷\È\æY@\Z¥Kÿ’Tª¿lN\×\çY@)\'5»Jª¿6\È$#\çY@\é\è]afDª¿g\Å&\è\åY@{[ú\á1Mª¿',-0.05137200,100.35785300,'This monument was established by the people of Koto Tinggi and the Emergency Government of the Republic of Indonesia in Koto Tinggi at that time as a commemoration of the events / history of the struggle and formation of the Republic of Indonesia in the Central Sumatra region in the post-independence period. The PDRI monument is located approximately 200m south of the PDRI office. The monument is divided into three parts, namely the bottom, centre and top. The lower part is cylindrical with a diameter of 1 metre and 50 cm thick. At the bottom, the front and back sides are tapered to create a flat area measuring 70 cm wide and 50 cm high. On the front side there is an inscription that reads \"LANDJUTKAN PERJANGAN 17-8-1949\". While on the back side it is written \"THE STANDING OF THE WEST SUMATERA GOVERNMENT AND THE EMERGENCY GOVERNMENT OF THE RI DURING THE SECOND BELANDA MILITARY ACTION 19-12-1948\". The centre is in the shape of a five-square with each side measuring 45 cm, height 45 cm. . The top part is shaped like a mosque dome or a jasmine flower bud, with a diameter and height of 50 cm.'),('HP03','Monumen PDRI','Kampuang Sarugo Sei. Dadok','00:00:00','12:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\n\Z\éû\ßY@“f=ª¿?\n\áY@;\ßô\Ó$ª¿\\T‹ˆ\âY@_\Ë\Ğiª¿\'[nz\áY@–­šŒ\Ï	ª¿\n\Z\éû\ßY@“f=ª¿',-0.05093100,100.35750700,'This monument was established by the people of Koto Tinggi and the Emergency Government of the Republic of Indonesia in Koto Tinggi at that time as a commemoration of the events / history of the struggle and formation of the Republic of Indonesia in the Central Sumatra region in the post-independence period. The PDRI monument is located approximately 50 m south of the PDRI office.'),('HP04','Kantor PDRI','Kampuang Sarugo Sei. Dadok','00:00:00','12:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\06ı\Ñ\ÜY@÷M«2ç©¿¬v¨\ŞY@Àk\á\Ã6ó©¿/;ù\ŞY@úÁ¯G—\í©¿_8!¾\İY@ôÙ¦£á©¿6ı\Ñ\ÜY@÷M«2ç©¿',-0.05062800,100.35729200,'This office was established by the people of Koto Tinggi for the Emergency Government of the Republic of Indonesia in Koto Tinggi at that time as a location to formulate strategies and tactics and the formation of the Republic of Indonesia in the Central Sumatra region in the post-independence period. ');
/*!40000 ALTER TABLE `history_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017-11-20-223112','Myth\\Auth\\Database\\Migrations\\CreateAuthTables','default','Myth\\Auth',1666592649,1),(2,'2022-10-22-064616','App\\Database\\Migrations\\RumahGadang','default','App',1666592651,1),(3,'2022-10-22-065310','App\\Database\\Migrations\\FacilityRumahGadang','default','App',1666592653,1),(4,'2022-10-22-065750','App\\Database\\Migrations\\DetailFacilityRumahGadang','default','App',1666592655,1),(5,'2022-10-22-073947','App\\Database\\Migrations\\GalleryRumahGadang','default','App',1666592658,1),(6,'2022-10-22-074142','App\\Database\\Migrations\\Recommendation','default','App',1666592659,1),(7,'2022-10-22-074826','App\\Database\\Migrations\\UMKMPlace','default','App',1666592660,1),(8,'2022-10-22-075008','App\\Database\\Migrations\\GalleryUMKMPlace','default','App',1666592661,1),(9,'2022-10-22-075312','App\\Database\\Migrations\\WorshipPlace','default','App',1666592661,1),(10,'2022-10-22-075328','App\\Database\\Migrations\\GalleryWorshipPlace','default','App',1666592663,1),(11,'2022-10-22-075340','App\\Database\\Migrations\\SouvenirPlace','default','App',1666592664,1),(12,'2022-10-22-075354','App\\Database\\Migrations\\GallerySouvenirPlace','default','App',1666592665,1),(13,'2022-10-22-080654','App\\Database\\Migrations\\Account','default','App',1666592665,1),(14,'2022-10-23-010248','App\\Database\\Migrations\\Review','default','App',1666592666,1),(15,'2022-10-24-051507','App\\Database\\Migrations\\Role','default','App',1666592666,1),(16,'2022-10-24-052047','App\\Database\\Migrations\\TourismPackage','default','App',1666592667,1),(17,'2022-10-24-052622','App\\Database\\Migrations\\DetailPackageTourism','default','App',1666592669,1),(18,'2022-10-24-053417','App\\Database\\Migrations\\FacilityTourismPackage','default','App',1666592669,1),(19,'2022-10-28-141710','App\\Database\\Migrations\\GalleryTourismPackage','default','App',1666966732,2),(20,'2022-10-29-062427','App\\Database\\Migrations\\PackageActivities','default','App',1667025245,3),(21,'2022-10-29-062807','App\\Database\\Migrations\\DetailPackageActivities','default','App',1667025247,3),(22,'2022-11-21-060607','App\\Database\\Migrations\\VisitHistory','default','App',1669010842,4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_day`
--

DROP TABLE IF EXISTS `package_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_day` (
  `tourism_package_id` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `day` varchar(1) NOT NULL,
  `description` text,
  PRIMARY KEY (`tourism_package_id`,`day`),
  KEY `tourism_package_id` (`tourism_package_id`),
  CONSTRAINT `tourism_package_id` FOREIGN KEY (`tourism_package_id`) REFERENCES `tourism_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_day`
--

LOCK TABLES `package_day` WRITE;
/*!40000 ALTER TABLE `package_day` DISABLE KEYS */;
INSERT INTO `package_day` VALUES ('T01','1','Activities are carried out 1 day with local wisdom.'),('T02','1','Activities are carried out 1 day with local wisdom.'),('T03','1','Activities are carried out 1 day with local wisdom.'),('T04','1','vdsf'),('T05','1','Activities are carried out 1 day with local wisdom.'),('T06','1','Activities are carried out 1 day with local wisdom.'),('T07','1','This activities for day 1'),('T07','2','This activities for day 1'),('T08','1','Just for 1 day package'),('T09','1','Activities are carried out 1 day with local wisdom.'),('T10','1','fsdf'),('T11','1','Activities are carried out 1 day with local wisdom.'),('T12','1','This activity for day 1'),('T12','2','Activities for day 2'),('T12','3','Activites for day 3'),('T13','1','Activity for day 1'),('T13','2','Activity for day 2'),('T13','3','Activity for day 3'),('T14','1','Activities are carried out 1 day with local wisdom.'),('T17','1','i want to spend this day to tour around koto tinggi'),('T18','1','Activities are carried out 1 day with local wisdom.'),('T19','1','day 1'),('T20','1','Activities are carried out 1 day with local wisdom.'),('T21','1','gdgf'),('T22','1','gdgf'),('T23','1','Activities are carried out 1 day with local wisdom.'),('T24','1','this day will be full of exploring sarugo village'),('T25','1','Activities are carried out 1 day with local wisdom.'),('T26','1','hari kesatu');
/*!40000 ALTER TABLE `package_day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recommendation`
--

DROP TABLE IF EXISTS `recommendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendation` (
  `id` varchar(1) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendation`
--

LOCK TABLES `recommendation` WRITE;
/*!40000 ALTER TABLE `recommendation` DISABLE KEYS */;
INSERT INTO `recommendation` VALUES ('1','Highly Recommended',NULL,NULL),('2','Recommended',NULL,NULL),('3','Less Recommended',NULL,NULL),('4','Not Recommended',NULL,NULL),('5','Maintenance',NULL,NULL);
/*!40000 ALTER TABLE `recommendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rumah_gadang`
--

DROP TABLE IF EXISTS `rumah_gadang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rumah_gadang` (
  `id` varchar(3) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `price` int DEFAULT '0',
  `geom` geometry DEFAULT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `recom` varchar(1) DEFAULT '2',
  `description` text,
  `video_url` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_rumah_gadang_recommendation1_idx` (`recom`),
  CONSTRAINT `fk_rumah_gadang_recommendation1` FOREIGN KEY (`recom`) REFERENCES `recommendation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rumah_gadang`
--

LOCK TABLES `rumah_gadang` WRITE;
/*!40000 ALTER TABLE `rumah_gadang` DISABLE KEYS */;
INSERT INTO `rumah_gadang` VALUES ('R01','Datuak Mangguang 1','Kampuang Sarugo Jorong Sungai Dadok','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0	\0\0\0F¼+qSY@\Ót,¥í–¿…5\ßRY@›\Â\ïK¢—¿\á\ÅSY@\Òm‰\\p—¿\í‡3\ZTY@ñq\\|Àò–¿¢\ï\ĞSY@ÕÅ$ï–¿F¼+qSY@\Ót,¥í–¿F¼+qSY@ˆ4+%î–¿F¼+qSY@\Ót,¥í–¿F¼+qSY@\Ót,¥í–¿',-0.02243720,100.34884565,'081275165713','Homestay','1','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1704035063_3b18605907d912a8aced.mp4',NULL,'2023-12-31 15:04:58'),('R02','Datuak Majo Indo 1','Kampuang Sarugo Sei Dadok','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\Í\nÚSY@§\éjÍ½–¿\Í\nÚSY@\Ò\×Áj½Ü–¿\Í\nÚ«TY@ôÀj%Ş–¿\Ì\n\Z·TY@\ë\åjÀ–¿\Î\nš\ìSY@\ÉN\çj5¿–¿\Í\nÚSY@§\éjÍ½–¿',-0.02227010,100.34888708,'082289097535','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Kutianyie tribe.','1707796544_1e034d816800398ff0fa.mp4','2022-12-19 07:36:50','2024-02-13 03:56:02'),('R05','Datuak Gindo Bosa 1','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0ª·V\rIY@\è\Ò\æJA”¿«·V:IY@³¥§\æ.l”¿©·\Ö\ÆKY@Î‡ª\æ^i”¿«·Ö™KY@{ñÁ\æ*R”¿ª·xKY@¼\Õ\æz>”¿ª·V\rIY@\è\Ò\æJA”¿',-0.01985676,100.34829190,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Pisang tribe.','1707796579_75035865fab0859f271f.mp4','2023-05-29 18:48:01','2024-02-13 03:56:46'),('R06','Datuak Bandaro Sati','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0¼?.nSY@²mP§¦u–¿¼?®sUY@¯\Ù@§N‚–¿»?®TVY@üe§d–¿¼?®eTY@–¯y§\æS–¿¼?.nSY@²mP§¦u–¿',-0.02189294,100.34893070,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Piliang tribe.','1707796616_13926cc0b2cc2b3aea91.mp4','2023-05-29 18:51:58','2024-02-13 03:57:17'),('R07','Datuak Pangulu Sati','Desa Wisata Kampuang Sarugo ','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0Q½xTY@#m\Äû€–¿P½EuSY@]Æû°·–¿P½YUY@q‘‰ûœ¼–¿R½\àUY@wÔ–û²–¿P½gVY@\Ã¹û¤––¿Q½xTY@#m\Äû€–¿',-0.02211402,100.34893373,'081275165713','Homestay','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Sikumbang tribe.','1707796647_5589053aa3af5f8e320e.mp4','2023-05-29 18:59:00','2024-02-13 03:59:37'),('R08','Datuak Lelo Anso 1','Desa Wisata Kampuang Sarugo','09:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0Å…SÿWY@«ñ¾Át–¿Ä…\ÇWY@\ßò½í„–¿Å…‰YY@­\æ½–¿Å…S\îYY@¿û½1}–¿Å…SÿWY@«ñ¾Át–¿',-0.02197805,100.34917324,'081275165713','Homestay','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Pitopang tribe.','1707798233_d1bd0fb652d1d72311d2.mp4','2023-05-29 19:12:28','2024-02-13 04:24:02'),('R09','Datuak Lelo Anso 2','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0W\Ú^^XY@\ã ‰\Ï‘–¿X\Ú^lYY@ƒ\Ïò•–¿V\Ú^™YY@~\"t\Ïæ¡–¿V\Ú^?YY@\" ^\Ïz³–¿W\ÚùWY@½üf\Ïr¬–¿W\Ú^^XY@\ã ‰\Ï‘–¿',-0.02210332,100.34916907,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Piliang tribe.','1707798250_34b668219903b460c0d4.mp4','2023-05-29 19:14:53','2024-02-13 04:24:16'),('R10','Datuak Bandaro Itam','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\áTŠXY@mRó¼–¿\äTJ WY@	û\Õ<Ó–¿\áTŠ¹XY@û…\ÑÀÖ–¿\âT\n*YY@\ì\îŒ¿–¿\áTŠXY@mRó¼–¿',-0.02225263,100.34914521,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Piliang tribe.','1707798029_bc052871c3c98bb5c663.mp4','2023-05-29 19:18:09','2024-02-13 04:20:35'),('R11','Datuak Junjuang 1','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0-WY@ºÿÃªé–¿\íFVY@Â¿–\Ò—¿\íúVY@]yr—¿\í®WY@an­>û–¿-XY@0¹ªZı–¿­„XY@%C¸\Îò–¿-WY@ºÿÃªé–¿',-0.02245353,100.34908433,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Banuhampu tribe.','1707798170_6ad3b69bf8d1823b9b37.mp4','2023-05-29 19:19:44','2024-02-13 04:23:20'),('R12','Datuak Bandaro Kayo','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0E´UY@2\Ñ\Ó—¿Dô\ØTY@`8°„ —¿Fô_UY@Œt­ \"—¿E4VY@-X\ÎP	—¿E´UY@2\Ñ\Ó—¿',-0.02253670,100.34896757,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707806241_6109c91ecb41028305ad.mp4','2023-05-29 19:23:02','2024-02-13 06:37:30'),('R13','Datuak Majo Indo 2','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\00œ\Ë&[Y@\ÑUõ#rˆ–¿/œK[Y@u&\Û#Š–¿/œKx\\Y@—f\Ù#ò–¿0œm\\Y@£|ô#&‰–¿0œ\Ë&[Y@\ÑUõ#rˆ–¿',-0.02204779,100.34935100,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Kutianyie tribe.','1707806357_7f7a60dc5ea83fb22749.mp4','2023-05-29 19:24:54','2024-02-13 06:39:30'),('R14','Datuak Rangkayo Bosa','Desa Wisata Kampuang sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\Ø\\Y@Ó¤,úÅ¶–¿\Ú÷[Y@2ÿ	ú1Ò–¿\Ù\Ğ]Y@‚	ú\åÒ–¿\ÚI]Y@$ı)úá¸–¿\Ø\\Y@Ó¤,úÅ¶–¿',-0.02223524,100.34940346,'081275165713','Homestay','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707806475_75b92385e307855661a6.mp4','2023-05-29 19:30:43','2024-02-13 06:41:25'),('R15','Datuak  Mangguang 2','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ß\îÄ«ZY@©\ãiV—¿\à\î\\Y@ø¶\Øi\Æ—¿\à\îD£[Y@1··i*—¿\ß\î\Ä÷YY@1­\Ãiò —¿\ß\îÄ«ZY@©\ãiV—¿',-0.02255712,100.34930692,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707806679_23ac8daf3d7c0ff0552d.mp4','2023-05-29 19:32:27','2024-02-13 06:44:48'),('R16','Datuak Bandaro Kali','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0§KdûYY@@õ1¦(—¿§Kdc[Y@­\ë1b0—¿¥K\ä\ÅZY@\Ç1\ÎK—¿§KdGYY@\Ö*\Ò1^C—¿§KdûYY@@õ1¦(—¿',-0.02268306,100.34926352,'081275165713','Homestay','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707806793_0365393518cd65ebf08d.mp4','2023-05-29 19:35:21','2024-02-13 06:46:40'),('R17','Datuak Mangguang 3','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0•*Z\Û_Y@\ê\é5£–¿•*Z_Y@]\é4×¥–¿•*\Úx`Y@¢…\å4§¨–¿•*\Ú\Ò`Y@.j5s‘–¿•*Z\Û_Y@\ê\é5£–¿',-0.02207811,100.34961941,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707806975_4c254c9834c29cb7bc19.mp4','2023-05-29 19:38:20','2024-02-13 06:49:38'),('R18','Datuak Mangguang 4','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0²ƒ4:bY@7\Çi”–¿²ƒôzaY@ø®¥!¯–¿²ƒtEbY@‡Ÿ\r´–¿°ƒ4cY@\ï/¿½š–¿²ƒ4:bY@7\Çi”–¿',-0.02211087,100.34974935,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707807042_20c97543308ad2d05e16.mp4','2023-05-29 19:40:41','2024-02-13 06:50:51'),('R19','Datuak Majo Tuan 1','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0^nC_Y@\Í/w#«–¿^n\é^Y@V¶	w_É–¿_nT\Õ_Y@ø\'w/Ì–¿_nT/`Y@TM,wó­–¿^nC_Y@\Í/w#«–¿',-0.02220025,100.34958177,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707808880_12f614987d6011d521f2.mp4','2023-05-29 19:42:16','2024-02-13 07:21:38'),('R20','Datuak Pangulu Bosa','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0a\×Á`Y@òyk\ìL¸–¿a`Y@2M<\ìİ–¿`TaY@Q±8\ì`\à–¿a\×üaY@fg\ìĞ»–¿a\×Á`Y@òyk\ìL¸–¿',-0.02226387,100.34967302,'081275165713','Homestay','1','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Melayu tribe.','1707809021_9c0f28390d8e11bc3758.mp4','2023-05-29 19:43:59','2024-02-13 07:24:10'),('R21','Datuak Majo Tuan 2','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\Æ!2\Â^Y@Reô¸É–¿\Æ!2h^Y@G#\ÕTâ–¿\Æ!rT_Y@¸\ß\Î@ç–¿\Æ!2\Ğ_Y@“	\ïğÍ–¿\Æ!2\Â^Y@Reô¸É–¿',-0.02231020,100.34955506,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Koto tribe.','1707809078_0e5c66c52cf29a478a95.mp4','2023-05-29 19:47:06','2024-02-13 07:24:59'),('R22','Datuak  Johor 1','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\Züšğ`Y@\Ó]â–¿üši`Y@\ê\Â\Ö\Ò—¿\ZüšJaY@	\'\Ó\Ò\í—¿\Zü\Ú\ÜaY@¹¬üÒ•æ–¿\Züšğ`Y@\Ó]â–¿',-0.02241763,100.34967881,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Melayu tribe.','1707809110_0d5d3167e155d9515cea.mp4','2023-05-29 19:48:28','2024-02-13 07:25:28'),('R23','Datuak Parapatiah nan Sabatang 1','Desa Wisata  Saribu Gonjong','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0•±L\Ñ]Y@ÿ÷K<0î–¿•±?]Y@fF\"<ˆ—¿”±Œ^Y@0\Z<\Ü—¿–±._Y@\ë	B<\ìõ–¿•±L\Ñ]Y@ÿ÷K<0î–¿',-0.02246675,100.34950031,'081275165713','Homestay','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Caniago tribe.','1707809870_d1e3f142157a972e80f4.mp4','2023-05-29 19:51:38','2024-02-13 07:38:34'),('R24','Datuak Tan Tamo','Desa Wisata Saribu Gonjong','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0s°†W`Y@°g\å;¬—¿r°\ç_Y@\ãQ»;)—¿r°›`Y@Š\ã´;ğ-—¿q°†8aY@û\ß;˜\r—¿s°†W`Y@°g\å;¬—¿',-0.02256510,100.34964365,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Melayu tribe.','1707809927_1ea6aff97471bac6ce6f.mp4','2023-05-29 19:53:06','2024-02-13 07:39:13'),('R25','Datuak Junjuang 2','Desa Wisata Kampuang Sarugo','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0şuÌ¦]Y@Cz}Q¤—¿ÿuLc]Y@¾\ãaQ¼4—¿ÿu9^Y@:9^QŒ7—¿şuŒ|^Y@\î\çxQ(#—¿şuÌ¦]Y@Cz}Q¤—¿',-0.02262724,100.34948347,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Banuhampu tribe.','1707809962_360379815f86ed9c1a40.mp4','2023-05-29 19:55:37','2024-02-13 07:39:37'),('R26','Datuak Johor 2','Desa Wisata Saribu Gonjong','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\Z7›ÀcY@AR\ĞVÏ–¿7›\ícY@±\ë¹Vá–¿\Z7¸dY@2º»V­ß–¿7›ûdY@\0\â¨Vqî–¿7[\ÑeY@1—«VUì–¿7\Û`eY@-‡\ÖV•Ê–¿\Z7›ÀcY@AR\ĞVÏ–¿',-0.02232557,100.34990143,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Melayu tribe.','1707809986_76e36a9c09ff1fd5b87d.mp4','2023-05-29 19:57:14','2024-02-13 07:40:12'),('R27','Datuak Rajo Marajo 2','Desa Wisata Saribu Gonjong','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0¿\Ä\ïaY@\Ãù)—¿¿D¬aY@½û\êøc;—¿¿‚bY@P\çø3>—¿¿\Ä\ĞbY@l1\0ù7+—¿¿\Ä\ïaY@\Ãù)—¿',-0.02265799,100.34974635,'081275165713','Homestay','1','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Pisang tribe.','1707810030_7c4eeb94265c1ab2c55a.mp4','2023-05-29 19:58:30','2024-02-13 07:41:21'),('R28','Datuak Gindo  Bosa 2','Desa Wisata Saribu Gonjong','09:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0E½A\ÔcY@¨-ô8—¿C½A§cY@’•\ÈU—¿B½fdY@¾\Ñ\äW—¿C½}dY@4\ä*;—¿E½A\ÔcY@¨-ô8—¿',-0.02273721,100.34985784,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Pisang tribe.','1707810138_b9f054f585580d749364.mp4','2023-05-29 19:59:43','2024-02-13 07:45:47'),('R29','Datuak Junjuang 3','Desa Wisata Saribu Gonjong','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\È\ãnY@@-\èdIË—¿\Èc–mY@-\Åd™ä—¿Ÿ\Èc…oY@VO¼d\íê—¿ \È\ãõoY@\ãr\àd\éĞ—¿\È\ãnY@@-\èdIË—¿',-0.02329676,100.35051111,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Banuhampu tribe.','1707810717_9fef3f383cf83259a9e5.mp4','2023-05-29 20:02:14','2024-02-13 07:52:05'),('R30','Datuak Parapatiah nan Sabatang 2','Desa Wisata Saribu Gonjong','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ÈcfY@<û\Ëd­ß—¿\È\ãwfY@nÒd\0˜¿Ÿ\È#rhY@1¦©dIø—¿Ÿ\Èc\ÉgY@¯µ\×d=×—¿\ÈcfY@<û\Ëd­ß—¿',-0.02335980,100.35005111,'081275165713','Residential Hou','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Caniago tribe.','1707810843_997d3ceb4a033a122315.mp4','2023-05-29 20:03:41','2024-02-13 07:54:09'),('R31','Datuak Rajo Marajo 1','Desa Wisata Saribu  Gonjong','07:00:00','17:00:00',0,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0T5\Ğ^bY@Š5‹¶—¿T5SbY@ñ‰ñ\Ãç—¿S5\ĞócY@§\ï+é—¿T5dY@X6×µ—¿T5\Ğ^bY@Š5‹¶—¿',-0.02325250,100.34980501,'081275165713','Homestay','2','In 1818 the village of Saribu Gonjong experienced a fire that burned down the houses of the villagers, so that some of them looked for a new place to live outside the village. Then around the 1900s they rebuilt the house that was burned down. A few years after that, in 1926, there was another fire, so the important documents in the Balai Adat hanged. That important documents in the Customary Hall were burned down. After experiencing the fire without a sense of despair, the residents rebuilt the village by working together with the wisdom of the village. That habits can still be seen today. This Rumah Gadang is inhabited by the Pisang tribe.',NULL,'2023-05-29 20:05:08','2024-02-13 07:56:18');
/*!40000 ALTER TABLE `rumah_gadang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_package`
--

DROP TABLE IF EXISTS `service_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_package` (
  `id` varchar(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_package`
--

LOCK TABLES `service_package` WRITE;
/*!40000 ALTER TABLE `service_package` DISABLE KEYS */;
INSERT INTO `service_package` VALUES ('S01','Homestay',100000,NULL,'2023-08-12 13:14:45','2'),('S02','Parking',0,NULL,NULL,'3'),('S03','Guide',150000,NULL,NULL,'4'),('S04','Entry Fee for Orange Garden',15000,NULL,'2024-02-13 03:46:03','1'),('S05','Meal',50000,NULL,'2024-02-13 03:46:31','2'),('S06','1 Art Package',30000,NULL,NULL,'1'),('S07','Transportation',300000,NULL,NULL,'4'),('S08','Souvenirs',25000,NULL,NULL,'1'),('S09','Personal Expenses',0,NULL,NULL,'1'),('S10','Guide Tips',0,NULL,NULL,'3'),('S11','Eat Outside the Package',0,NULL,NULL,'1');
/*!40000 ALTER TABLE `service_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souvenir_place`
--

DROP TABLE IF EXISTS `souvenir_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `souvenir_place` (
  `id` varchar(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souvenir_place`
--

LOCK TABLES `souvenir_place` WRITE;
/*!40000 ALTER TABLE `souvenir_place` DISABLE KEYS */;
INSERT INTO `souvenir_place` VALUES ('SP01','Souvenir Kampuang Sarugo','Kampuang Sarugo Sei. Dadok','081275165713',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0ğğ\èeY@\ØdzˆF—¿üÌ´XeY@&«\ïW\\—¿%w\ØDfY@Qòc`—¿rµ_ˆfY@|\Í vK—¿ğğ\èeY@\ØdzˆF—¿',-0.02282000,100.34997000,'10:00:00','16:00:00','Souvenir Kampuang Sarugo provides a variety of interesting souvenirs, ranging from ashtrays, key chains, drinking sets to custom paintings.',NULL,NULL);
/*!40000 ALTER TABLE `souvenir_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_place`
--

DROP TABLE IF EXISTS `study_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_place` (
  `id` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `price` int DEFAULT NULL,
  `category` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_place`
--

LOCK TABLES `study_place` WRITE;
/*!40000 ALTER TABLE `study_place` DISABLE KEYS */;
INSERT INTO `study_place` VALUES ('ST01','Belajar Memasak',-0.02245628,100.34949050,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0§øÆ­]Y@2¹vUé–¿§ø]Y@Áv—¿§øÆ^Y@1\èv9—¿¦ø\Æ_Y@>k®v\Åñ–¿§øÆ­]Y@2¹vUé–¿',500000,'3'),('ST02','Belajar Anyaman',-0.02255980,100.34930456,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ÓÅ…ZY@p\Z‚d	—¿Ó…óYY@\ÓOl‚h#—¿\ÓE}[Y@òc‚p*—¿Ó…\\Y@´(ƒ‚\Ô—¿\ÓÅ…ZY@p\Z‚d	—¿',25000,'1'),('ST03','Belajar Randai',-0.02279884,100.35010092,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0s´QŒgY@¯¢H\ŞJ—¿r´Ñ¢gY@m\êzHfh—¿s´hY@ğ\Æ|Hşf—¿t´ÑƒhY@™\ï¤H\ÂH—¿s´QŒgY@¯¢H\ŞJ—¿',500000,'3');
/*!40000 ALTER TABLE `study_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tourism_activity`
--

DROP TABLE IF EXISTS `tourism_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tourism_activity` (
  `id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `price` int DEFAULT NULL,
  `category` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tourism_activity`
--

LOCK TABLES `tourism_activity` WRITE;
/*!40000 ALTER TABLE `tourism_activity` DISABLE KEYS */;
INSERT INTO `tourism_activity` VALUES ('A01','Tour Keliling Kampung',-0.02279341,100.34972269,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\é°-™aY@Ü¶7ÿ\ìQ—¿\ç°-laY@\Ã3ÿpU—¿\é°\Õ,bY@a\Ú)b\\—¿\ç°]JbY@]/ÿX—¿\é°-™aY@Ü¶7ÿ\ìQ—¿',0,'3'),('A02','Makan Siang Bajamba',-0.02222400,100.34971900,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\Ú\Ô/\ÇaY@.z¼`Ë–¿hur†bY@ß¹Aş\ãÎ–¿En\á\ÔbY@ı½4»–¿ºÜ»aY@?§ ?¹–¿\Ú\Ô/\ÇaY@.z¼`Ë–¿',25000,'1'),('A03','Penyambutan',-0.02340879,100.35027047,_binary '\æ\0\0\0\0\0\0\0\0	\0\0\0ôm\0xjY@@0:\Óô—¿óm\0¥jY@z«+ºø—¿ômºjY@cq)º¨ù—¿ôm\Ø\ÛjY@,%:¼ü—¿ómXòjY@/\":\Øş—¿òm 1kY@Ÿ%:bü—¿ômP\ëjY@\æ‡.:ö—¿óm@°jY@õ4ºò—¿ôm\0xjY@@0:\Óô—¿',1500000,'3'),('A04','Pertunjukan Seni',-0.02279359,100.34911952,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ÕV\ØWY@’\ÏøKO—¿\ÕşkXY@y/ô\ÏR—¿\Õ\ÖXY@&\Ô\ã_—¿\ÕÆ†WY@…W\é‹ûZ—¿\ÕV\ØWY@’\ÏøKO—¿',1500000,'3'),('A05','Manciang Boluik dan Mambangkik Luka',-0.02388900,100.35111100,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ÉM`wY@\Ç):’\Ë˜¿±•†\ĞwY@~ ı|˜¿ò÷ALxY@UU“{˜¿tP\ÓxY@\êúOH|˜¿3\Í*\"yY@A¾\ßÃ€€˜¿t/\æyY@ÿ\ÔÓ¢™‚˜¿\\wNzY@A¾\ßÃ€€˜¿\ßÈ—«zY@Y\Óq/z˜¿†!rúzY@Š–—W	q˜¿zE¦2{Y@BÅ‚.g˜¿,zLI{Y@œÃµ\Ú\Ã^˜¿\Ó_ù={Y@\Ú]û]3T˜¿L7\äzY@òr\"\âM˜¿\ë¤cszY@6õp¸EO˜¿ªB¨÷yY@`\ÉU,~S˜¿\Âú?‡yY@Í†FÁU˜¿d\ä\Ñ2wY@\àEˆ\'`˜¿p3\ËTwY@»Y(>\ãg˜¿p3\ËTwY@ò%Tp˜¿\n=¬wY@µj|\ËAu˜¿\ÉM`wY@\Ç):’\Ë˜¿',600000,'3'),('A06','Tour Gunuang Omeh',-0.02304212,100.35005510,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ÑuE\ïfY@q‰=w’—¿\ÑuU*gY@\Îv=‡ —¿\Ñuµ«gY@.kx=Å—¿\ÑukgY@L/Œ=.—¿\ÑuE\ïfY@q‰=w’—¿',0,'3'),('A07','Pengolahan Air Nira',-0.02583800,100.34611000,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0Û‹h;&Y@71\Ém eš¿ò¶-%&Y@\\¯Dû³zš¿iŸ\ØT\'Y@\Él5\Ó|š¿ªfv\'Y@õG½L¹gš¿Û‹h;&Y@71\Ém eš¿',500000,'3'),('A08','Painting/Engraving Education',-0.02256047,100.34930526,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0;ApPZY@1ø¼­—¿;A°\ÔYY@ 5Ø¼I$—¿:Ağt[Y@V\êÏ¼*—¿;A04\\Y@™\Ññ¼™—¿;A0S[Y@\Ô\æú¼‘	—¿;ApPZY@1ø¼­—¿',300000,'3'),('A09','Welcome Drink with Orange Juice',-0.02312778,100.35026971,_binary '\æ\0\0\0\0\0\0\0\0\0\0\09E¡<iY@\'ó±÷&¢—¿8E\á\ÜjY@C1w÷\nÍ—¿8E¡flY@„ˆŠ÷ú¾—¿8E\á¯jY@\Ş\Í\É÷’—¿9E¡<iY@\'ó±÷&¢—¿',200000,'3');
/*!40000 ALTER TABLE `tourism_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tourism_object`
--

DROP TABLE IF EXISTS `tourism_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tourism_object` (
  `id` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `price` int DEFAULT NULL,
  `category` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tourism_object`
--

LOCK TABLES `tourism_object` WRITE;
/*!40000 ALTER TABLE `tourism_object` DISABLE KEYS */;
INSERT INTO `tourism_object` VALUES ('O01','Puncak Sarugo',-0.02228000,100.34843000,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0n°&LY@;šÙ¤¯–¿Q\â\Î\àJY@c5§Ü–¿\à»MY@46*&%ó–¿œVe:OY@)m»\Z\êÁ–¿n°&LY@;šÙ¤¯–¿',0,'3'),('O02','Wisata Ikan Larangan',-0.02309705,100.35192336,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0PL\ïƒY@ñ<†¹:Ã—¿PŒb…Y@\ì Š¹jÀ—¿PL±…Y@›¹Â³—¿P\Ì!†Y@.¤¹n­—¿P\ÌÕ†Y@\'ù¨¹ê©—¿PLÍ‡Y@fÙ«¹Î§—¿PŒŒˆY@:Ä­¹f¦—¿PW‰Y@R«®¹²¥—¿P\Ìÿ‰Y@‹±¹–£—¿PŠY@²¾Â¹î–—¿P„‰Y@jÊ¹N‘—¿PÌ—ˆY@Å‰Ç¹j“—¿PL\'ˆY@\ZQË¹š—¿Ph‡Y@jÊ¹N‘—¿PL¿†Y@Å‰Ç¹j“—¿P-†Y@Z”Æ¹”—¿P¦…Y@ğÅ¹Ò”—¿PŒ…Y@1\âÀ¹V˜—¿PLv„Y@ò¾¹rš—¿PŒsƒY@›\×Á¹¢——¿P\Ì÷‚Y@\ZQË¹š—¿PL‡‚Y@,Ğ¹—¿PŒ8‚Y@‚\ãÓ¹FŠ—¿PÈY@Z”Æ¹”—¿PŒ8‚Y@ò¾¹rš—¿P\ÌÊ‚Y@vA¸¹ª—¿PL;ƒY@¯¯¹ş¤—¿PŒ ƒY@?à©¹6©—¿P\ÌØƒY@°TŸ¹ò°—¿P\Ì„Y@!É”¹®¸—¿PL\ïƒY@ñ<†¹:Ã—¿',0,'3'),('O03','Kebun Jeruk',-0.02514639,100.35463662,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0&\Ë°Y@xleí°™¿%Ë·²Y@`ú\í1—™¿\'Ë¦´Y@ò–<\í\ÑÉ™¿&Ë©±Y@/\n\íÁè™¿&\Ë°Y@xleí°™¿',15000,'1'),('O06','Lubuak Liuang',-0.02309106,100.35189438,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0®~\"ú€Y@\á¿ ?†—¿®~bØ€Y@bFG—¿­~¢=Y@Î3’—¿¯~¢ÄY@¼\Ó·•—¿®~\"¼‚Y@(,£š—¿­~b/„Y@AvşŸ—¿¯~\"~„Y@‡\Õõã¥—¿®~âŸ„Y@\Ì4\í7¬—¿­~\"«„Y@\Å\Ùûº—¿®~¢Á„Y@¼q\ÌÄ—¿®~¢¢…Y@!K\Ñ›À—¿®~â­…Y@Ó³\á§´—¿®~b†Y@øI\ëŸ­—¿¯~â»†Y@\ßÿñ³¨—¿®~\"¨‡Y@ÅµøÇ£—¿¯~\â}ˆY@‚¹ù£—¿¯~¢S‰Y@‚¹ù£—¿¯~¢ŠY@×€ıC —¿­~bü‰Y@¼\Ó·•—¿®~bH‰Y@Î3’—¿­~âœ‡Y@Î3’—¿®~bÒ†Y@¾\rO”—¿®~¢¢…Y@¨;™—¿®~¢…Y@(,£š—¿®~\âE„Y@\Ï	Ó——¿¯~b¨ƒY@ú³›“—¿¯~¢Ò‚Y@¹p—¿­~b‚Y@_\ã§‡—¿®~â¢Y@v\Êó†—¿®~\"ú€Y@\á¿ ?†—¿',0,'3'),('O08','Lapau',-0.02292143,100.34994533,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0pòušdY@´yP‡{—¿qòõ\ëeY@K.D«„—¿pòµgfY@	AT·x—¿qò5\ÊeY@³\Ï[s—¿qò5eY@vEd\Ãl—¿pòušdY@´yP‡{—¿',0,'3'),('O09','Talempong Batu',-0.06899717,100.39194667,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0†\ßü¯Y@Á\ä\ì1¦±¿†\ß|™Y@Šú”ì²¬±¿†\ßüY@iŒ\ìf­±¿…\ß|µY@Ğ®\İì¸¦±¿†\ßü¯Y@Á\ä\ì1¦±¿',NULL,'3'),('O10','Rumah Kelahiran Tan Malaka',-0.08825714,100.41947496,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0š;H\Ø\ZY@F\ä\ëF“¶¿š;”\×\ZY@\Üqm™¶¿šûğ\Ø\ZY@\Êö.Äœ¶¿š»\Æ\Ù\ZY@(û¬p–¶¿š;H\Ø\ZY@F\ä\ëF“¶¿',NULL,'3'),('O11','Wisata Ikan Banyak',-0.08119388,100.40868600,_binary '\æ\0\0\0\0\0\0\0\0\0\0\05[8s\'\ZY@j¬—\ÔWÅ´¿5[x\Ê&\ZY@w£PÔÉ´¿6[¸j(\ZY@®W\Ô\æÌ´¿5[8)\ZY@\ãz\\\Ô\ÛÈ´¿5[8s\'\ZY@j¬—\ÔWÅ´¿',2000,'1');
/*!40000 ALTER TABLE `tourism_object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tourism_package`
--

DROP TABLE IF EXISTS `tourism_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tourism_package` (
  `id` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int DEFAULT '0',
  `capacity` int DEFAULT NULL,
  `contact_person` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `custom` varchar(1) CHARACTER SET utf8mb3 DEFAULT NULL,
  `video_url` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tourism_package`
--

LOCK TABLES `tourism_package` WRITE;
/*!40000 ALTER TABLE `tourism_package` DISABLE KEYS */;
INSERT INTO `tourism_package` VALUES ('T01','1 Day Tour',650000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','0','1709703627_0603cbc2e582d9cf330d.mp4','2023-06-29 03:40:21','2024-03-06 05:42:24'),('T02','1 Day Tour',1300000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-01-27 00:18:32','2024-01-27 00:18:32'),('T03','1 Day Tour',1170000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-01-27 00:19:03','2024-01-27 00:19:03'),('T04','Custom by sei 2024-01-27 07:28:43',500000,0,'','','1',NULL,'2024-01-27 00:29:00','2024-01-27 00:29:00'),('T05','1 Day Tour extended by sei 2024-01-27 07',1150000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-01-27 00:29:43','2024-01-27 00:29:43'),('T06','1 Day Tour by sei 2024-01-27 07:43:04',780000,0,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-01-27 00:43:04','2024-01-27 00:43:04'),('T07','2 Day 2 Night',5500000,10,'085213416723','This package include 2 day and 1 night in Sarugo Village.','0','1709704305_3db72da8978e0edb8f7a.mp4','2024-01-27 01:59:24','2024-03-06 05:52:03'),('T08','Custom by seni 2024-01-29 12:34:46',830000,0,'','','1',NULL,'2024-01-29 05:37:38','2024-01-29 05:37:38'),('T09','1 Day Tour extended by seni 2024-01-29 1',650000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-01-29 05:39:26','2024-01-29 05:39:26'),('T10','Custom by sei 2024-01-30 23:12:16',500000,0,'','','1',NULL,'2024-01-30 16:12:32','2024-01-30 16:12:32'),('T11','1 Day Tour extended by sei 2024-01-30 23:12:57',775000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-01-30 16:13:17','2024-01-30 16:13:17'),('T12','3 Days 2 Night v1',6500000,10,'085213416722','This package for 3 days','0','1707812110_88f0d870458f346f12bd.mp4','2024-01-31 05:56:25','2024-02-13 08:15:18'),('T13','3 Day 2 Night v2',4700000,10,'085213416722','This package for 3 days','0','1707815193_63cfbb79943650b1d60f.mp4','2024-01-31 06:00:35','2024-02-13 09:06:40'),('T14','1 Day Tour extended by sei 2024-02-01 08:36:22',1450000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-02-01 01:39:27','2024-02-01 01:39:27'),('T15','Custom by seni 2024-02-01 09:12:42',520000,0,'','','1',NULL,'2024-02-01 02:29:55','2024-02-01 02:29:55'),('T16','Custom by seni 2024-02-01 09:12:42',520000,0,'','','1',NULL,'2024-02-01 02:30:42','2024-02-01 02:30:42'),('T17','Custom by seni 2024-02-01 09:36:19',370000,0,'','','1',NULL,'2024-02-01 02:38:57','2024-02-01 02:38:57'),('T18','1 Day Tour extended by sei 2024-02-03 09:57:47',1650000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-02-03 03:08:17','2024-02-03 03:08:17'),('T19','Custom by sei 2024-02-03 10:17:51',2050000,0,'','','1',NULL,'2024-02-03 03:19:24','2024-02-03 03:19:24'),('T20','1 Day Tour extended by seni 2024-02-07 09:50:47',1150000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-02-07 02:51:51','2024-02-07 02:51:51'),('T21','Custom by seni 2024-02-07 09:58:58',1500000,0,'','','1',NULL,'2024-02-07 02:59:19','2024-02-07 02:59:19'),('T22','Custom by seni 2024-02-07 09:58:58',1500000,0,'','','1',NULL,'2024-02-07 03:07:25','2024-02-07 03:07:25'),('T23','1 Day Tour extended by sei 2024-02-07 13:31:09',2150000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-02-07 07:48:47','2024-02-07 07:48:47'),('T24','Custom by sei 2024-02-08 10:52:47',1255000,0,'','','1',NULL,'2024-02-08 04:12:56','2024-02-08 04:12:56'),('T25','1 Day Tour extended by athifah 2024-03-07 12:40:05',1750000,5,'085213416723','This is a 1-day package. Guests who come will be given a welcome drink and then invited to walk around Sarugo village on foot. After that guests will be served lunch by \"Makan Bajamba\". Then invited to Lubuak Liuang for water tourism such as swimming or feeding prohibited fish (Gariang fish). After that, visit the orange orchard which can be picked directly. Then you will be invited to the PDRI museum and end up buying souvenirs.','1',NULL,'2024-03-07 05:42:32','2024-03-07 05:42:32'),('T26','Custom by athifah 2024-03-07 12:42:49',1150000,0,'','','1',NULL,'2024-03-07 05:45:18','2024-03-07 05:45:18');
/*!40000 ALTER TABLE `tourism_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `umkm_place`
--

DROP TABLE IF EXISTS `umkm_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umkm_place` (
  `id` varchar(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `umkm_place`
--

LOCK TABLES `umkm_place` WRITE;
/*!40000 ALTER TABLE `umkm_place` DISABLE KEYS */;
INSERT INTO `umkm_place` VALUES ('UP01','Kedai Harian Wafi','Kampuang Sarugo Sei Dadok','085265932209',6,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0¬\àX\ë]Y@\â¡\Å\ËòB—¿­\à:^Y@²\Ù\Ë.4—¿­\à\Ø\â^Y@/‚\Ó\Ëf8—¿­\à\Ø_Y@}\Ì\Ë>—¿®\àXr^Y@\ÆH½\ËFI—¿¬\àX\ë]Y@\â¡\Å\ËòB—¿',-0.02270023,100.34951725,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP02','Lapau Nek Tinas','Kampuang Sarugo Sei Dadok','081277660990',10,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ët\Ë	\\Y@\í¤šn#—¿\êtË\\Y@3+š¾—¿\êt\Ëq]Y@\ì#š^—¿\êtö\\Y@õ‹š*+—¿\ët\Ë	\\Y@\í¤šn#—¿',-0.02257330,100.34941048,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP03','Lapau Harian Biru','Kampuang Sarugo Sei Dadok','085836711038',5,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0—‘\ÕXY@¿+‚ÿ­d—¿´pYY@\Ò\ê?\Æ7o—¿¨ö¿YY@ö\Ö|g—¿‹µ	AXY@ı\ÅÇ‚Z—¿—‘\ÕXY@¿+‚ÿ­d—¿',-0.02284000,100.34915000,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP04','Lapau Harian Puja','Kampuang Sarugo Sei Dadok','081275146048',5,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0C­@ZY@U\\Cş¨û–¿B\í\ÒZY@Ô‘7ş\Ì—¿A-e[Y@=cLş ô–¿A-±ZY@<QVş\äì–¿C­@ZY@U\\Cş¨û–¿',-0.02243365,100.34929345,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP05','Lapau Harian Aifa','Kampuang Sarugo Sei Dadok','082289097535',4,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0oğ…\ÉTY@\Òf\æ\Ã—¿ÀƒUY@t6.-4!—¿i[(ôUY@ˆü<k—¿@±UY@](ª\È2—¿oğ…\ÉTY@\Òf\æ\Ã—¿',-0.02256000,100.34894000,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP06','Kadai Harian Aisyah','Kampuang Sarugo Sei Dadok','82289097531',2,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0q\Ñ$^Y@Y°\Â\Òe–¿ó\"n©^Y@\Ô@˜€j–¿Aaõ\ì^Y@rÁüıb–¿\Ûj\Ö_Y@k\æ\Úa]–¿¾¬O^Y@Ù–g)Y–¿q\Ñ$^Y@Y°\Â\Òe–¿',-0.02185000,100.34952000,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP08','Harian Buk Dewi','Kampuang Sarugo Sei Dadok','082385316266',4,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0jŠ[`jY@\Ãe6\\˜¿Fi%ckY@\Ï5\'Š\ës˜¿où£mY@ú¯F\Ñ^˜¿F\ÜR½kY@\î@ò\èF˜¿jŠ[`jY@\Ãe6\\˜¿',-0.02372000,100.35025000,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP09','Lapau Tek Gadih','Kampuang Sarugo Sei Dadok','085375663000',8,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0Cª(^eY@6–ğ8 ˜¿\ÒJkfY@¶ºKâ¬˜¿ûô	gY@½f¾ƒŸ˜¿`x€‚fY@\Ãğ1%’˜¿Cª(^eY@6–ğ8 ˜¿',-0.02404000,100.34998000,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP11','Kadai Dendi','Kampuang Sarugo Sei Dadok','082392257168',10,'08:00:00','22:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0= ÇƒˆY@z\äj¿Í—¿\äø¡ÒˆY@¸w\rú\ÒÛ—¿õ][‰ŠY@šz\İ\"0Ö—¿N:ŠY@\ãR•¶¸Æ—¿= ÇƒˆY@z\äj¿Í—¿',-0.02325000,100.35214000,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP12','Kadai Buk Rita','Kampuang Sarugo Sei Dadok','085263880273',8,'07:00:00','20:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0rIz½ Y@”\×\ï.¼7£¿~˜s\ß Y@Ä“\İ\Ì\èG£¿N›q\Z\"Y@Ä“\İ\Ì\èG£¿Zw=\â!Y@\rl•`q8£¿rIz½ Y@”\×\ï.¼7£¿',-0.03754000,100.34580000,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP13','Lapau Ni Ranti','Kampuang Sarugo Sei. Dadok','082289097535',9,'07:00:00','23:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0‡†eeY@½¼\àÿ6¶—¿††”NeY@£»ÿ¢Ñ—¿‡†\ÍfY@¸ÿ¾Ó—¿‡†\ÍfY@\é\Ñ\Şÿ·—¿‡†eeY@½¼\àÿ6¶—¿',-0.02321236,100.34997888,'Provides a wide variety of daily needs ranging from household needs to selling various kinds of food and soft drinks.',NULL,NULL),('UP14','Kadai Meeting Point','Kampuang Sarugo Sei. Dadok','081266498665',10,'08:00:00','21:00:00',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0ıµ\Û\ídY@~\é\àL\Ér—¿üµ€eY@€ø\ïL‰g—¿üµfY@>¦\åLEo—¿üµ[^eY@}“\ÕL9{—¿ıµ\Û\ídY@~\é\àL\Ér—¿',-0.02289345,100.34994375,'Sells a wide variety of snacks, hot and cold drinks',NULL,NULL);
/*!40000 ALTER TABLE `umkm_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'default.jpg',
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'akunadmin1@gmail.com','accadmin1','$2y$10$tU4uhGIg1N78joufhTYM8.4BWOjPiLerMxqCTzk6rQc7fmPQwdsly',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2022-11-22 23:53:51','2022-11-22 23:53:51',NULL,'Athifah','Zahra','1685438768_114983eb6db39d5c3c5b.png','Jln. Tan Malaka','091234546'),(8,'shjsha@gmail.com','athifah27zahra','$2y$10$kFqDfVumb5.Hrc9VhBLibOpwo55VcbPp6wPwlD.ZSxoZTgQvYlFx6',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-05-22 04:35:54','2023-05-22 04:35:54',NULL,NULL,NULL,'default.jpg',NULL,NULL),(11,'1711523011@student.unand.ac.id','seni','$2y$10$Yd0KUpg5UQ1iV1M/gBxfOOO0TmZ6kIGdQfnDzeLceNOTENP2QAODW',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-06-29 22:00:53','2023-06-29 22:00:53',NULL,'Athifah','Zahra','default.jpg','Payakumbuh','08123456789'),(12,'1711523011@student.unand','sei','$2y$10$oUazoYMbX/EDPCqg5QF8YuW5jg9zPM79xmE3aFSE7iG87vxvWgom2',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-08-11 02:00:28','2023-08-11 02:00:28',NULL,'Athifah','Zahra','default.jpg','Padang','081237482947'),(13,'forgi@gmail.com','athifah','$2y$10$co/9PrqkoYcsGhI45o/06OHJH5EbrJjhdhmlRsgg/ucJUoYQ010BK',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-02-01 08:04:08','2024-02-01 08:04:08',NULL,'Athifah','Zahra','default.jpg',NULL,'081323457452'),(14,'athifah27zahra@gmail.com','sisteminformasi','$2y$10$M4NWMKyblaaJ0iKiv6saT.0NhDW7zWPE2wI9T.Qv2OGGFmgIKdDA2',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-03-21 10:54:28','2024-03-21 10:54:28',NULL,NULL,NULL,'default.jpg',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `village`
--

DROP TABLE IF EXISTS `village`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `village` (
  `id` varchar(5) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `geom` geometry NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `village`
--

LOCK TABLES `village` WRITE;
/*!40000 ALTER TABLE `village` DISABLE KEYS */;
INSERT INTO `village` VALUES ('1','Nagari Koto Tinggi',_binary '\æ\0\0\0\0\0\0\0\0\È\0\0\0-\Ë|¬…Y@\Åú«l\Ä8¤?\ßóhOnY@P0AC£?³Ja9Y@¿‚4c\Ñt¢?”‰[1Y@Mv}0:j¢?„\n³uY@3§\Ëbbó¡?\Z™‘‹ûY@Ş½\íSŸ¡?_\ÎlW\èY@õ–f*¡?\Íj\Ë\ÊÀY@¾ù\êôÍŸ?\Ü}3Ö£Y@ğ[c†|†?˜¬\å)†Y@w\Ô=W\0øœ?ü &<|Y@qv\ÆRœ?<“hY@\åZHÀ˜?ñ\È\àcY@„‰õü˜?KKöaY@\ã}fZ¬ò–?\Ó\Ã+¤WY@C\Ğ,d	Æ”?€\n\ì\ÖWY@c‘\Ë$L”?ü•„úLY@rP\ÂLÛ?¢\Ù\Ğ(8Y@~©Ÿ7‰?ü\'n\Ë6Y@ost¦\Zˆ?\Z;<\ß*Y@Å±‰\'S„?92Eo\'Y@Ry\à÷oƒ?òûH[&Y@~«u\âr¼‚?\0W²c#Y@2ŠŠ\İ\ã?A4Y@j¹\ØY™u?M\ÓY@B·ò\í¸<q?gŒ\Å%ıY@N—jt’b?`‰”\æY@o n˜²M?\Âa³m\âY@&Àp\à¿>S\ÙşºY@\Â&|\0œ(c¿	^Y@vUû\Ïõ\Øq¿‘ù6³LY@p…f0{¿Ãvø\ëY@j±%õ¯ö¿\Â#\àÆœY@¥1ZGU„¿H\á\âòY@d\"¥\Ù<ƒ¿n­å„¿Y@fz\Ó>g„¿\Ø9‡Y@Gj\ëñŒÇ†¿Vb•4Y@N¬r–£‘¿›\0nY@›¨J\0£p’¿®{¬\ÏY@üE\Z&d1“¿¶sPx¿Y@i€Ş½í“¿.¿x«Y@g4|È•¿ˆÁWÏ¤Y@\Ú\Ä\Éı–¿¹¼Ş¢¸Y@;yG|\İØš¿•]\ÕşóY@k\ëLF: ¿¥)§\â\ëY@‰®°…Å¡¿\'8P;WY@a}}¤¿ø»Áa³Y@œ\ì°\ÓYw¥¿$ª”\ĞY@u*\'È¥¿ñ«(\ØY@\ë\à¶\ïö¥¿ ŒñaöY@A1\r7¦¿kšwœ\"Y@6ñº~Á¦¿¶·\0ÙY@¨Uô‡f¨¿~\rÒñY@#ÇŒ¦i«¿K\0ş)Y@4\Ø\ÔyTü«¿~\Şù\êOY@“Fzv¬¿/uFJiY@\×3\ÂÛƒ¬¿1‹šùŸY@\Ïd¬¿\Ñó]\0\ĞY@aS(fª¿i\êw\áY@ ¢\ÇÍ©¿-š)ùY@\ê\ÊÀ«Š©¿\É\æªyY@ Ø¯\à#©¿~À¨IY@›kCÅ¨¿…*4Y@°­Ÿş³æ§¿ƒ\×Ó³EY@ùk\r\0°•§¿¾…u\ã]Y@€(˜1k¨¿\ÜÛˆ‚tY@ÀGX¯}\\ª¿I\Ú\èwY@…4tı\Ìj«¿\0	€Y@k‹!\ï¬¿EÕ¯t¾Y@b\Ó\ïg®¿¨wL8\ÏY@\æ\Å.öÃ®¿\é\ß\äm\ÛY@@E=›¯¿.\Ü^w\ßY@¢¤\Ïı‹°¿aY@\Ñ\æ8·	÷²¿ŒO@Y@úŞ•£³¿\\“nKdY@«N½$„ı³¿¼¢Jƒ‘Y@…–uÿX´¿üĞ»g“Y@ù¸Ûš¢µ¿\æ\ã—¾Y@£–A{üµ¿6T1:\ÅY@Ë±99¶¿°\Â\Òe\ÖY@:\nk¾¥÷¶¿µ|n²\×Y@‹=IˆM·¿\0“(\ÅY@*\Û,s™·¿3J<E³Y@5s’÷»Á·¿\ÎË¼°Y@_ª\ãB/\í·¿XŠ‰rY@)D\Û\Æú·¿ú÷tĞ€Y@´¨ô¸ü·¿N\×nŠY@%Àú‰¸¿E\î1œY@Wx—‹øN¸¿8=ŞšªY@6_€\Ø-]¸¿qCç¯Y@Y0ñGQg¸¿–\n…cñY@]\0u^¾P·¿oºe‡øY@„\ç\Ş\Ã%·¿˜¾\×Y@V€\ï6oœ¶¿\ì\0>.Y@#!\Ğôm¶¿7C`›CY@ÉŸ^\ß=öµ¿O]ù,OY@»ö`­5ïµ¿\Èca\ãUY@ÿ\ÊJ“RĞµ¿7\r›ZY@p«\ÅLG¥µ¿\Í^WY@&8õäµ¿¤¾QY@i1ßƒ|µ¿¯\á3#MY@pÊÃ°hµ¿™šoHY@\Ï\Ï\ÙBµ¿ª[\âmJY@\r\ã\É\Éµ¿\ÕA¹HY@—|¢¡5õ´¿»]/MY@\Û>š <â´¿h$B#XY@l—\İ8Î´¿¤’µaY@¸“<Ä´¿¸0uY@\n^™\\1È´¿U/°}Y@£aLŸÂ´¿\'\\\ÙOY@<T˜­«´¿£L¤Y@\Ô\á\×ş„i´¿·„×‰¦Y@røIZ–T´¿­dl­Y@)lPE;´¿JÎ‰=´Y@XÆ†nö´¿„J\\Ç¸Y@Y‚1Ç—õ³¿e\ãÁ»Y@s…\×\äß³¿\èª\ÔG»Y@ªmy›\íÀ³¿\åôP6ÀY@6\Ze¢­³¿‹a˜]ÁY@>$?‡³¿›’¬\Ã\ÑY@s\ã\Ìe³¿\\b§\×Y@¨Ù¨óM?³¿\â<œÀôY@üf¬G+³¿;*\rY@\ív\Â_İ²¿!œY@²Y?Gõç²¿?\à&HY@\à\êJ\Ö×²¿fñ¨Y@·YaŸ¥Ğ²¿’‹\ÖöY@²¸ÿ\Ètè²¿­÷\í8Y@\ë*“\ĞLæ²¿÷\0İ—3Y@-öMPy²¿\ÚsO2Y@¬iƒ¸=²¿8w\ì4Y@¯É¿;²¿–.3Y@}\Æ*J®²¿<{x\à-Y@\È!‡-\âà±¿®º\ÕY@•\n\ÏğT±¿…$³zY@\Ú\Í\ç7±¿·±~\Ø÷Y@q\ê^‚®Ø°¿]Â¡·øY@¤Ä®\íí–°¿)\íhw#Y@Ñ¦e°¿\ÍÿP\Õ)Y@*n„EE°¿^kJ\rHY@ƒ¥º€—°¿…Õ³{MY@…ü}°¿\îkRY@\Ëx°¿Z\×h9PY@»ø6X“°¿¯!8.cY@ô ó·ó³¯¿\Ä|ÔºhY@¯¢õ¦Ø‡¯¿şVüpY@\Î{/¾h¯¿FºúƒY@\îù«Æ®¿\Ú_\Ñ‘Y@Oy\ÏÜ{®¿6Vb•Y@¢\ëgV[V®¿X\"«Y@½+ÌŒÈ­¿ÿ\Zµg»Y@•öa­¿\Ğ5‚C\ŞY@’zª\'ù¬¿7\ËÀ\\\æY@”0\Óö¯¬¬¿Rµ‚K\ìY@\Ô>\ÍÉ‹¬¿Ì—`Y@ÌŠòY|¬¿*k@)Y@ôßƒ\×.m¬¿\è@ \áEY@|\ÙÑ“b¬¿\Ä\İ.SY@À¶Ù³Bì«¿c\ÉfXVY@+P‹ÁÃ´«¿x-|XY@¦\É\ÖD°»ª¿÷)}\×VY@r•ó ˜ª¿31]ˆUY@$M½®º©¿n¢–\æVY@—\Å\Ä\æ\ãÚ¨¿¿¢¶h\\Y@¶Gÿ‹¦¿$ø:iY@\Ï\Å:°wÚ¥¿uT|Y@š\â»\ŞG¥¿ğ\Û\ãµY@7ñ¿ğ¥£¿‡Ÿ¤e\ÉY@4ğ¯\Ôi£¿½xõ\àY@:n$z¢¿[\ëC\ÍY@Qx\Zz\Õ¢¿œ0a4«Y@¥—Á½×¡¿”ö_˜Y@_¦7\ísÆ¡¿“hY@› —›¹¡¿‘Q\è†Y@9¨§ˆ¡¿½Ù‹\r‚Y@\ã–·~U¡¿\Ëb:Y@ÏDÃ½ ¿u|Y@ş2t ¿õ³9sY@ú[œŒ… ¿O¯”eY@\Ókk… ¿ò0£aY@@ù»wÔ˜ ¿öğÀ[ûY@\îw(\nô‰ ¿s¸ûÁ\åY@\ß,\Õ¼ ¿€J•({Y@\Æ*J®8¡¿Æ¹òşdY@\ÖX\Â\Ú;¡¿H f\í[Y@‹ªA-¡¿€qºv3Y@\Ê[dñQ5 ¿>†}ñûY@]ğ³\ÛxÁ™¿I1›[üY@\é¸¡’¿h9u\nY@s÷”÷\Ìí‘¿÷ V‡Y@ş`ì¿›\ÊY@sªk£ğ¿2C>CY@õ#ñr\"‹¿$[•–Y@\Ó~n\×ğY¿±ÇŸƒY@\ÖJ2¼£R?ôöŒ\é.Y@fLÁ\ZgÓ?\Ärğñ®Y@©3÷ğ½—? Añc\ÌY@\á)\äJ=¢?—\á?\İÀY@\Æü\ÜĞ”¢?˜š©µY@úT_§¢Â¢?-\Ë|¬…Y@\Åú«l\Ä8¤?');
/*!40000 ALTER TABLE `village` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit_history`
--

DROP TABLE IF EXISTS `visit_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visit_history` (
  `rumah_gadang_id` varchar(3) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `date_visit` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `review` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rumah_gadang_id`,`user_id`,`date_visit`),
  KEY `fk_visit_history_users1_idx` (`user_id`),
  KEY `fk_visit_history_rumah_gadang1_idx` (`rumah_gadang_id`),
  CONSTRAINT `fk_visit_history_rumah_gadang1` FOREIGN KEY (`rumah_gadang_id`) REFERENCES `rumah_gadang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_visit_history_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit_history`
--

LOCK TABLES `visit_history` WRITE;
/*!40000 ALTER TABLE `visit_history` DISABLE KEYS */;
INSERT INTO `visit_history` VALUES ('R01',12,'2023-08-31',NULL,NULL,5,'sangat bagus'),('R01',13,'2024-02-08',NULL,NULL,5,'looks nice!'),('R05',12,'2024-03-07',NULL,NULL,5,'rumah gadangnya bagus'),('R14',11,'2023-10-07',NULL,NULL,5,'rumah gadangnya bagus sekali'),('R20',12,'2023-08-26',NULL,NULL,5,'bagus sekali!'),('R27',11,'2023-10-10',NULL,NULL,5,'Rumah Gadangnya terlihat sangat bersih dan terawat.');
/*!40000 ALTER TABLE `visit_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worship_place`
--

DROP TABLE IF EXISTS `worship_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `worship_place` (
  `id` varchar(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `building_size` int DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worship_place`
--

LOCK TABLES `worship_place` WRITE;
/*!40000 ALTER TABLE `worship_place` DISABLE KEYS */;
INSERT INTO `worship_place` VALUES ('WP01','Musala','Desa Wisata Saribu Gonjong',100,500,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0E\êr\Å_Y@W\Şõ´Õ—¿G\êr˜_Y@\àÈ´Zõ—¿Fê²’aY@‡ñÅ´v÷—¿E\ê2©aY@ƒóó´jÖ—¿E\êr\Å_Y@W\Şõ´Õ—¿',-0.02333922,100.34964772,'This musala is a place of worship for the residents of Kampuang Sarugo. It is also used as a TPA for children to learn religious knowledge.',NULL,NULL),('WP02','Mesjid Sei Dadok','Desa Wisata Saribu Gonjong',64,75,_binary '\æ\0\0\0\0\0\0\0\0\r\0\0\0ú*\î£iY@²À5\ï4—¿ù*\î’kY@„¼5s8—¿ù*n\ÖkY@¨\Ì5\Ë+—¿ù*\î\ÍlY@8/\Ç50—¿ú*nmY@\âR\æ5—¿ú*®\ákY@\æ\ê5K—¿ù*nlY@e\Öõ5\'—¿ú*®yjY@\Üş5\Ó—¿ú*\îWjY@e\Öõ5\'—¿ù*.UiY@ù5W	—¿ø*\îiY@d/\è5³—¿ú*\îıiY@\Ú\à5S—¿ú*\î£iY@²À5\ï4—¿',-0.02257972,100.35028629,'This mosque is the oldest mosque in Kampuang Sarugo. This mosque was established as an axis and reference for the Rumah Gadang to face the Qibla direction.',NULL,NULL),('WP03','Masjid Sholihin','Pua Data, Koto Tinggi',100,500,_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ÉÚ·!Y@\ì\r¿ê£¿\Éšn#Y@\Ş\ë¾\Ìò£¿\Éš©$Y@½[&¿®ã£¿\ÉZ	#Y@¦‰I¿ŠÚ£¿\ÉÚ·!Y@\ì\r¿ê£¿',-0.03886925,100.34589785,'Sholihin Mosque was founded in 1948. This mosque is one of the places of worship for Muslims, especially for people who live in Pua Data.',NULL,NULL);
/*!40000 ALTER TABLE `worship_place` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-30 13:05:01
