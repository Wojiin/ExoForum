-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.4.3 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_quentin_maia
CREATE DATABASE IF NOT EXISTS `forum_quentin_maia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_quentin_maia`;

-- Listage de la structure de table forum_quentin_maia. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.category : ~0 rows (environ)

-- Listage de la structure de table forum_quentin_maia. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `id_topic` int NOT NULL,
  `creation_date` datetime NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `post_ibfk_id_user` (`id_user`),
  KEY `post_ibfk_id_topic` (`id_topic`),
  CONSTRAINT `post_ibfk_id_topic` FOREIGN KEY (`id_topic`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `post_ibfk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.post : ~0 rows (environ)

-- Listage de la structure de table forum_quentin_maia. report
CREATE TABLE IF NOT EXISTS `report` (
  `id_user` int NOT NULL,
  `id_topic` int NOT NULL,
  `reporting_date` datetime NOT NULL,
  `commentary` text,
  KEY `report_ibfk_id_topic` (`id_topic`),
  KEY `report_ibfk_id_user` (`id_user`),
  CONSTRAINT `report_ibfk_id_topic` FOREIGN KEY (`id_topic`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `report_ibfk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.report : ~0 rows (environ)

-- Listage de la structure de table forum_quentin_maia. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `id_category` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `creation_date` datetime NOT NULL,
  `closed` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'non',
  PRIMARY KEY (`id_topic`),
  KEY `topic_ibfk_id_user` (`id_user`),
  KEY `topic_ibfk_id_category` (`id_category`),
  CONSTRAINT `topic_ibfk_id_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `topic_ibfk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.topic : ~0 rows (environ)

-- Listage de la structure de table forum_quentin_maia. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `pseudonyme` varchar(100) NOT NULL,
  `registration_date` datetime NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `banned` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'non',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.user : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
