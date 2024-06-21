-- MySQL dump 10.13  Distrib 5.7.27-30, for Linux (x86_64)
--
-- Host: localhost    Database: u2545578_lksaru
-- ------------------------------------------------------
-- Server version	5.7.27-30

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
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `liked_games`
--

DROP TABLE IF EXISTS `liked_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `liked_games` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `training_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liked_games`
--

LOCK TABLES `liked_games` WRITE;
/*!40000 ALTER TABLE `liked_games` DISABLE KEYS */;
INSERT INTO `liked_games` VALUES (1,2,1),(2,2,4),(4,3,5),(6,3,12),(7,3,10);
/*!40000 ALTER TABLE `liked_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessionss`
--

DROP TABLE IF EXISTS `sessionss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessionss` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` text,
  `token` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=479 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessionss`
--

LOCK TABLES `sessionss` WRITE;
/*!40000 ALTER TABLE `sessionss` DISABLE KEYS */;
INSERT INTO `sessionss` VALUES (50,'5','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiNSIsImV4cCI6MTY5ODc1MDUwMX0.T7av08IsQw6m6KBLjMr9FYCp0sIRdmTb5lEnupzp_Wo'),(87,'6','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiNiIsImV4cCI6MTY5OTk1MTUzOX0.X8cge5DL0vBMV8ZpBQKysxLXvJDAgm-xw06la-P5oc8'),(99,'7','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiNyIsImV4cCI6MTcwMTA4NDA4OH0.u3SZIbeL5TAM0V3zod-Hl8bCam6l7yP1pvgcLM6ORck'),(183,'9','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiOSIsImV4cCI6MTcwMTc5NDU4OX0.mYZ2fYfZBOKE2xRdIhNYqAqh2MG-E1KA3VmU2KwP75o'),(187,'8','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiOCIsImV4cCI6MTcwMTc5NDcyMn0.HiMGL_tPyZCR9HBeG4pPMme_4_b0hjnAzPjmoLQj94s'),(198,'2','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMiIsImV4cCI6MTcwMjM5NDI4NH0.2Ua5_1MpFcr_hkp14qIjC9J7K8MyWGJFR8Xpk3BLO10'),(219,'14','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTQiLCJleHAiOjE3MDM0Mzg5MjF9.zPtKAtsQSwyStYT25zXVBoIpzHZv6WMFn4DFNRhe0EE'),(308,'13','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTMiLCJleHAiOjE3MDM1OTE0NjJ9.eu5gE_QcP4V6H1xq3h5W02R4S1eALfuGlaqeKPciiyU'),(321,'15','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTUiLCJleHAiOjE3MDM4NTY5ODR9.bUwgqdElIZzo9bo_wprehCQTCy5n9nltWDvTdFkXu28'),(360,'17','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTciLCJleHAiOjE3MDU1ODY0MDR9.1hKZo31WcEx1DovumKFF5qRL_O2fx3kF-XdRPtkaIuQ'),(462,'3','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMyIsImV4cCI6MTcwNjg4MTMyNn0.97nA6CA2bpWiygsZKIYub919SNRqjsTC6iwwHytLDQw'),(471,'25','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjUiLCJleHAiOjE3MTU4OTAzMTl9.5_fYPIuQ2Hcz07-X64UX4wIDqGblrTQKCTWqWCEy-fc'),(472,'27','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjciLCJleHAiOjE3MTcwOTA3OTV9.theEjuLRQiyj9NATvfPLtH11IB_x-RTCfz6VpvWw4lk'),(476,'26','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjYiLCJleHAiOjE3MTcxNDQwNjd9.QoSmizNMrRh5Rv0yn-xFjGFBYf6zo0pTW33TIIAXkMg'),(478,'28','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjgiLCJleHAiOjE3MTg5NTkyNTV9.S9kNU4Vxfii6sZmVk5nXGKv9VRXUwafwpCfbcYpddKs');
/*!40000 ALTER TABLE `sessionss` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `facebook_link` text,
  `youtube_link` text,
  `vk_link` text,
  `user_agreement` text,
  `privacy_policy` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'https://ya.ru/','https://ya.ru/','https://ya.ru/','https://ya.ru/','https://ya.ru/');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training`
--

DROP TABLE IF EXISTS `training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `training` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `difficulty` int(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `maxlevel` int(11) NOT NULL DEFAULT '1',
  `thislevel` int(11) NOT NULL DEFAULT '1',
  `information` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training`
--

LOCK TABLES `training` WRITE;
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
INSERT INTO `training` VALUES (1,'Алфавит',10,'attention','card-img10.svg',1,1,'Тебе нужно громко назвать верхнюю букву и одновременно поднимать правую руку, если под ней буква \"П\", или левую руку, если там буква \"Л\". Если же это буква \"О\", то поднимай обе руки.'),(2,'Поиск букв',48,'attention','card-img10.svg',1,1,'Ищи буквы, которые расположены над таблицей, и нажимай на них. '),(3,'Скорость чтения',62,'attention','card-img10.svg',1,1,'Тебе нужно прочитать текст. Читать вслух не нужно.'),(4,'Быстрый счет',100,'speed','card-img4.svg',1,1,'Настрой тренажер согласно рекомендациям куратора (или сделай это самостоятельно). Считай в уме и вписывай результат в поле ответа.'),(5,'Пары по буквам',50,'memory','card-img8.svg',3,1,'На каждой клетке спрятана определенная буква. Тебе необходимо запомнить эти буквы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(6,'Пары по буквам',80,'memory','card-img8.svg',3,2,'На каждой клетке спрятана определенная буква. Тебе необходимо запомнить эти буквы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(7,'Пары по буквам',100,'memory','card-img8.svg',3,3,'На каждой клетке спрятана определенная буква. Тебе необходимо запомнить эти буквы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(8,'Пары по картинкам',20,'memory','card-img11.svg',5,1,'На каждой клетке спрятан предмет. Тебе необходимо запомнить эти предметы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(9,'Пары по картинкам',40,'memory','card-img11.svg',5,2,'На каждой клетке спрятан предмет. Тебе необходимо запомнить эти предметы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(10,'Пары по картинкам',60,'memory','card-img11.svg',5,3,'На каждой клетке спрятан предмет. Тебе необходимо запомнить эти предметы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(11,'Пары по картинкам',80,'memory','card-img11.svg',5,4,'На каждой клетке спрятан предмет. Тебе необходимо запомнить эти предметы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(12,'Пары по картинкам',100,'memory','card-img11.svg',5,5,'На каждой клетке спрятан предмет. Тебе необходимо запомнить эти предметы и найти их пары. \r\n\r\nДелать это нужно как можно быстрее!'),(13,'Расставьте предметы',20,'memory','card-img2.svg',5,1,'Тебе нужно запомнить расположение предметов за заданное время. Затем расставить их на доске по памяти и нажать \"готово\". \r\n\r\nДелать это нужно как можно быстрее!'),(14,'Расставьте предметы',40,'memory','card-img2.svg',5,2,'Тебе нужно запомнить расположение предметов за заданное время. Затем расставить их на доске по памяти и нажать \"готово\". \r\n\r\nДелать это нужно как можно быстрее!'),(15,'Расставьте предметы',60,'memory','card-img2.svg',5,3,'Тебе нужно запомнить расположение предметов за заданное время. Затем расставить их на доске по памяти и нажать \"готово\". \r\n\r\nДелать это нужно как можно быстрее!'),(16,'Расставьте предметы',80,'memory','card-img2.svg',5,4,'Тебе нужно запомнить расположение предметов за заданное время. Затем расставить их на доске по памяти и нажать \"готово\". \r\n\r\nДелать это нужно как можно быстрее!'),(17,'Расставьте предметы',100,'memory','card-img2.svg',5,5,'Тебе нужно запомнить расположение предметов за заданное время. Затем расставить их на доске по памяти и нажать \"готово\". \r\n\r\nДелать это нужно как можно быстрее!'),(18,'Исчезающие блоки',60,'memory','card-img9.svg',2,1,'Тебе нужно запомнить расположение блоков за заданное время. Затем расположить их в нужных местах по памяти и нажать \"проверить\". \r\n\r\nДелать это нужно как можно быстрее!'),(19,'Исчезающие блоки',100,'memory','card-img9.svg',2,2,'Тебе нужно запомнить расположение блоков за заданное время. Затем расположить их в нужных местах по памяти и нажать \"проверить\". \r\n\r\nДелать это нужно как можно быстрее!'),(20,'Поиск цифр по возрастанию',20,'attention','card-img11.svg',4,1,'Ищи числа в порядке возрастания и нажимай на них.'),(21,'Поиск цифр по возрастанию',60,'attention','card-img11.svg',4,2,'Ищи числа в порядке возрастания и нажимай на них.'),(22,'Поиск цифр по возрастанию',80,'attention','card-img11.svg',4,3,'Ищи числа в порядке возрастания и нажимай на них.'),(24,'Поиск цифр по возрастанию',100,'attention','card-img11.svg',4,4,'Ищи числа в порядке возрастания и нажимай на них.'),(25,'Выбор правильного маршрута',20,'mind','card-img8.svg',3,1,'Слушай инструкцию и следи глазами за маршрутом, не нажимая на клетки. Нажми только на конечную точку маршрута, когда инструкция закончится.'),(26,'Выбор правильного маршрута',40,'mind','card-img8.svg',3,2,'Слушай инструкцию и следи глазами за маршрутом, не нажимая на клетки. Нажми только на конечную точку маршрута, когда инструкция закончится.'),(27,'Выбор правильного маршрута',80,'mind','card-img8.svg',3,3,'Слушай инструкцию и следи глазами за маршрутом, не нажимая на клетки. Нажми только на конечную точку маршрута, когда инструкция закончится.');
/*!40000 ALTER TABLE `training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_results`
--

DROP TABLE IF EXISTS `training_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `training_results` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `training_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `click_count` int(10) DEFAULT NULL,
  `result_time` double DEFAULT NULL,
  `true_clicks` int(10) DEFAULT NULL,
  `false_clicks` int(10) DEFAULT NULL,
  `date_end` bigint(19) DEFAULT NULL,
  `scores` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_results`
--

LOCK TABLES `training_results` WRITE;
/*!40000 ALTER TABLE `training_results` DISABLE KEYS */;
INSERT INTO `training_results` VALUES (1,2,2,7,2.7,7,0,1697555048,NULL),(2,2,2,10,4.3,7,1,1697555530,NULL),(3,2,2,8,4.9,7,1,1698021598,41),(4,2,2,8,4.9,7,1,1698021598,41),(5,2,2,8,4.9,7,1,1698021598,41),(6,2,2,7,2.5,7,0,1698021617,42),(7,2,2,7,1.9,7,0,1698021625,42),(8,8,2,10,11.5,4,6,1698021871,18),(9,8,2,11,8.3,4,7,1698021883,17),(10,8,2,10,9.1,4,6,1698055297,18),(11,8,2,7,18.1,4,3,1698055346,21),(12,13,2,3,NULL,0,3,1698100327,3),(13,13,2,3,NULL,3,0,1698100395,18),(14,13,2,3,NULL,0,3,1698100406,7),(15,13,2,3,NULL,0,3,1698100465,0),(16,8,2,6,6.7,4,2,1698193256,22),(17,13,2,3,NULL,0,3,1698249322,0),(18,13,2,3,NULL,3,0,1698249343,18),(19,2,2,8,7.7,7,1,1698249365,41),(20,2,2,7,1.9,7,0,1698249372,42),(21,2,4,7,8.9,7,0,1698305373,42),(22,13,3,3,NULL,0,3,1698386196,0),(23,13,3,3,NULL,1,2,1698386212,4),(24,18,2,0,0,5,0,1698517684,25),(25,25,2,0,0,3,0,1698675203,15),(26,25,2,0,0,10,0,1698675219,50),(27,18,2,0,0,5,0,1699283653,25),(28,8,2,7,8.4,4,3,1699283989,21),(29,14,6,4,0,1,3,1699943496,3),(30,14,6,4,0,1,3,1699943496,3),(31,14,6,4,0,0,4,1699946923,0),(32,14,6,4,0,0,4,1699946923,0),(33,14,6,4,0,0,4,1699946923,0),(34,14,6,4,0,0,4,1699946923,0),(35,14,6,4,0,0,4,1699946923,0),(36,14,6,4,0,0,4,1699946923,0),(37,14,6,4,0,0,4,1699946923,0),(38,14,6,4,0,0,4,1699946923,0),(39,14,6,4,0,0,4,1699946924,0),(40,14,6,4,0,0,4,1699946924,0),(41,14,6,4,0,0,4,1699946924,0),(42,14,6,4,0,0,4,1699946924,0),(43,14,6,4,0,0,4,1699946924,0),(44,14,6,4,0,0,4,1699946924,0),(45,14,6,4,0,0,4,1699946924,0),(46,14,6,4,0,0,4,1699946924,0),(47,5,8,59,112.1,12,47,1701786153,25),(48,6,8,67,115.2,18,49,1701786894,59),(49,7,8,146,240.5,24,122,1701787361,22),(50,8,8,9,14.6,4,5,1701787409,19),(51,8,8,9,14.6,4,5,1701787409,19),(52,9,8,16,26.6,8,8,1701787503,40),(53,10,8,37,60.6,12,25,1701787602,47),(54,20,9,9,9.1,9,0,1701787617,54),(55,20,9,9,5,9,0,1701787646,54),(56,21,9,16,12.1,16,0,1701787784,96),(57,13,8,3,0,0,3,1701787870,0),(58,22,9,25,25.8,25,0,1701787884,150),(59,22,9,25,25.8,25,0,1701787884,150),(60,24,9,51,109.8,49,2,1701788036,292),(61,24,9,51,109.8,49,2,1701788036,292),(62,24,9,51,109.8,49,2,1701788036,292),(63,14,8,4,0,0,4,1701788069,0),(64,14,8,4,0,0,4,1701788069,0),(65,18,8,0,0,2,0,1701788288,10),(66,18,8,0,0,2,0,1701788288,10),(67,18,8,0,0,2,0,1701788288,10),(68,18,8,0,0,2,0,1701788288,10),(69,18,8,0,0,2,0,1701788288,10),(70,18,8,0,0,2,0,1701788288,10),(71,18,8,0,0,-2,0,1701788303,0),(72,18,8,0,0,-2,0,1701788303,0),(73,18,8,0,0,-2,0,1701788303,0),(74,18,8,0,0,-2,0,1701788303,0),(75,18,8,0,0,-2,0,1701788303,0),(76,18,8,0,0,-2,0,1701788303,0),(77,18,8,0,0,0,0,1701788314,0),(78,18,8,0,0,0,0,1701788314,0),(79,18,8,0,0,0,0,1701788314,0),(80,18,8,0,0,0,0,1701788314,0),(81,18,8,0,0,0,0,1701788314,0),(82,18,8,0,0,0,0,1701788314,0),(83,19,8,0,0,-1,0,1701788441,0),(84,25,9,0,0,3,0,1701788563,15),(85,25,9,0,0,10,2,1701788582,46),(86,25,9,0,0,10,2,1701788614,46),(87,25,9,0,0,6,2,1701788630,26),(88,12,8,90,150.1,24,66,1701788702,78),(89,26,9,0,0,10,2,1701788831,46),(90,27,9,0,0,10,2,1701788913,46),(91,27,9,0,0,10,2,1701788913,46),(92,13,8,3,0,0,3,1701789016,0),(93,14,8,4,0,0,4,1701789040,0),(94,27,9,0,0,6,2,1701789054,26),(95,15,8,5,0,0,5,1701789065,0),(96,27,9,0,0,10,2,1701789091,46),(97,16,8,6,0,1,5,1701789091,1),(98,17,8,9,0,0,9,1701789123,0),(99,18,8,0,0,3,0,1701789166,15),(100,19,8,0,0,-5,0,1701789216,0),(101,14,8,4,0,0,4,1701789670,0),(102,19,8,0,0,-2,0,1701789772,0),(103,18,9,0,0,5,0,1701789922,25),(104,2,8,7,10.7,7,0,1701789923,42),(105,2,8,8,6,7,1,1701789943,41),(106,11,9,65,105.9,18,47,1701790081,61),(107,2,8,7,5.3,7,0,1701790155,42),(108,21,8,18,16,16,2,1701790524,94),(109,21,8,18,16,16,2,1701790524,94),(110,2,10,11,27.3,10,1,1702639551,59),(111,2,10,11,27.3,10,1,1702639551,59),(112,14,15,4,0,2,2,1703853029,10),(113,14,15,4,0,0,4,1703853065,0),(114,25,15,0,0,3,2,1703853143,11),(115,25,15,0,0,3,2,1703853143,11),(116,25,15,0,0,3,2,1703853143,11),(117,25,15,0,0,3,2,1703853155,11),(118,25,15,0,0,3,2,1703853155,11),(119,25,15,0,0,3,2,1703853155,11),(120,25,15,0,0,3,0,1703853173,15),(121,25,15,0,0,3,0,1703853173,15),(122,25,15,0,0,3,0,1703853173,15),(123,14,17,4,0,3,1,1705571612,17),(124,14,17,4,0,3,1,1705571629,17),(125,14,17,4,0,4,0,1705571645,24),(126,14,17,4,0,3,1,1705571662,17),(127,14,17,4,0,3,1,1705571680,17),(128,14,17,4,0,3,1,1705571706,17),(129,14,17,4,0,4,0,1705571730,24),(130,15,17,5,0,2,3,1705571946,9),(131,15,17,5,0,4,1,1705571965,23),(132,18,17,0,0,5,0,1705572321,25),(133,18,17,0,0,5,0,1705572337,25),(134,18,17,0,0,5,0,1705572347,25),(135,18,17,0,0,5,0,1705572360,25),(136,18,17,0,0,5,0,1705572420,25),(137,18,17,0,0,5,0,1705572431,25),(138,2,17,9,29.8,9,0,1705580498,54),(139,2,17,9,11.3,7,0,1705580515,44),(140,2,17,9,27.5,9,0,1705580616,54),(141,20,17,9,6.4,9,0,1705580902,54),(142,20,17,13,9.5,9,4,1705580916,50),(143,21,17,32,17.1,16,16,1705580947,80),(144,21,17,43,25.5,16,27,1705580990,69),(145,13,3,3,0,0,3,1706280416,0),(146,16,3,6,0,0,6,1706280465,0),(147,17,3,9,0,0,9,1706340066,0),(148,25,3,0,0,4,0,1706340366,20),(149,18,3,0,0,4,0,1706340512,20),(150,18,3,0,0,-2,0,1706340523,0),(151,18,3,0,0,3,0,1706340598,15),(152,19,3,0,0,-1,0,1706340615,0),(153,26,3,0,0,6,0,1706340686,30),(154,27,3,0,0,3,0,1706340699,15),(155,25,3,0,0,3,0,1706340712,15),(156,18,3,0,0,5,0,1706343341,25),(157,19,3,0,0,-4,0,1706343362,0),(158,2,3,7,11.7,7,0,1706874377,42),(159,2,25,7,15.3,7,0,1715886584,42),(160,2,25,7,15.3,7,0,1715886585,42),(161,2,25,14,6.4,14,0,1715886602,84),(162,2,25,14,6.4,14,0,1715886602,84),(163,2,25,7,9.2,7,0,1715886644,42),(164,2,25,18,17,17,1,1715886668,101),(165,2,25,28,11.1,27,1,1715886687,161),(166,5,26,69,242.3,12,57,1717136230,15);
/*!40000 ALTER TABLE `training_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text,
  `role` int(10) DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'dmtr.off.p@gmail.com','Wireql','$2y$10$0YRAMrvvDybmg1lBhevSLurS9znILL0VdonmTpMAscH6V4Hcl.0gK',2),(3,'kim55@ya.ru','Ким','$2y$10$VEIyYVSXB/tYfeAnxpilnuEu2u89JYBDVHTOGTfe1ER.wXCclrk/W',2),(4,'test@test.ru','Дмитрий','$2y$10$wdY.fXDwZ9xuSj761qqIFe6878Cslmhb/kIVSd12KdYa5icbtR2PC',2),(5,'ash987@mail.ru','vhh','$2y$10$.BOnLmhA6rRUw5c/4D8JN.sBxtYqxkUa4V5HMASTBYYeuMsbPjBqy',1),(6,'kristina-mart@bk.ru','Кристина','$2y$10$TYAON/ne7.2ZL9Hu6JWJhu07/JNYIrsouUuxeGriRPPbOGLpvMwa.',1),(7,'vladislavna1991@mail.ru','Павлова К.В. ','$2y$10$Symbm5QbrW4lxXj5AtD0wOoOj9.5/ZewUCWOU3Wq3lecH0L2hXky.',1),(8,'vladislavna_1991@mail.ru','Павлова Кристина Владиславовна ','$2y$10$K4.agmY4dxPlwqPnglFTgePEHFJ/RRy5bK83yw/kqAj2rnrSDUi/.',1),(9,'lesyapilot89185@gmail.com','Елена Огрызко','$2y$10$kSCWNMCr4oCKEAw7OKzp/O6.Ps7EJHiIGyeliBoS6mHPAYyNHe5DC',1),(10,'bahadirovasadbek19@gmail.com','Asad','$2y$10$YKgCGa4mEJUq5FzSfSEjf.hlFT2jMV.Xupp1eW28MZa.3jHnk6oLu',1),(11,'asd@2.2','еуые','$2y$10$0yqOzD/IbYTwEvx2n3mlU.N2u2pWy/gqhMBEcjznyROFYSX9u7Siy',1),(12,'test@test.test','test','$2y$10$Cc0Bn04ZmGSid/pk2XnIN.5UUcnn44bta3T/C8NVlWePa3NJSgv3a',1),(13,'novikovn383@gmail.com','Разраб с кворк','$2y$10$h4g7xHPjXd9eoTkA2NB/OeVJAChs00QkjdZ3ouEqDD78mBLGo2sNi',1),(14,'dignijipsi@gufum.com','Иван Иванов','$2y$10$mgMPzVEMQSsYZ.kbbwC54unjRfo3GN/D/NVIs0Z8LIon3NqrKL8Pi',1),(15,'sjkhdbf@skjdnf.ru','1','$2y$10$KEQ8GCZoQggLt2GVvIgVt.dODFxjFOAsHyVN8YRri54/sOPLvnKoW',1),(16,'rfrfrfr@mail.ru','Bova','$2y$10$9u12cGkyFz3MxweOr80glen4YBjWxh1ITNUyi3TJum/xdP7rxYFRO',1),(17,'marina.reforme@gmail.com','Марина Пархоменко','$2y$10$3SVpIvaL4w876dcFpbcNdu8GpsOZvQQQbXCasCWh.PfurNWP9kbi6',1),(18,'olesya_karpina@mail.ru','Олеся Иванова','$2y$10$m1LgY4mb4HEItPgrKB8fTOmF3Cjas0.fJHW3fscPLnxhQJn/g.QyS',1),(19,'ivan@mail.ru','иван','$2y$10$RBbZg.bL5sYPbPHZd4b3B.m6uKBfKiIZE7q/4Ap3sBplxVap8sJUS',1),(20,'stryko.val85@gmail.com','test','$2y$10$ieHs87vfwppn2S7gfz6kkePn55jD8mDXe.pPwPELUF.NsopMhQq8.',2),(21,'stryko.val@gmail.com','test','$2y$10$oZx1tAuyxgE.EgYbZN5J1O2kTNumNppyvj39nCBtHHFniGK68ASNi',1),(22,'test@mail.ru','test','$2y$10$PUcO38xSPiUM2m3isEsxcOEFIsH8mmtFVMSeIhd96gLM7xHkfxjQ.',1),(23,'t@mail.ru','t','$2y$10$sEisb8y34HFjciSqX3hQb.wnb8pbkzhEbSr2c.WBUZUXMaunGTWHW',1),(24,'test1@mail.ru','test','$2y$10$.wqxKHv0uY0BWv/EitWQ8uBLAHM/aAaiCuYSG/tvU6lnsjMCV1Bri',1),(25,'nata2631@list.ru','Наталья Анатольевна','$2y$10$Xotr65SW0ML614X5S397suL9twcWTP45mcIwJ2JKrskrwA4ATdqp6',1),(26,'varlamova.courses@gmail.com','Кристина Варламова','$2y$10$IinK9t19BBYmQoi4ZJPkWecRXLWlYhk1NMfoXuC98KPhaOYpyoeuO',1),(27,'webabbas9@gmail.com','Abbas','$2y$10$zoYaMm7Brus904ksSc19ZOxoNJZv1wS8g3dhmW5sxR9TmZKZUm4U.',1),(28,'webabbas92@gmail.com','abbas ergahsaliyev','$2y$10$.hci8WsQ2aeaoiQOjj0Yw.8nKNDk2GC2UtZp0bI6.ME2u7oMEBiSG',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-21 15:42:04
