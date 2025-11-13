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
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.category : ~0 rows (environ)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Général'),
	(2, 'Tutoriels'),
	(3, 'Annonces');

-- Listage de la structure de table forum_quentin_maia. post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` int DEFAULT NULL,
  `idTopic` int NOT NULL,
  `creationDate` datetime NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `post_ibfk_id_user` (`idUser`) USING BTREE,
  KEY `post_ibfk_id_topic` (`idTopic`) USING BTREE,
  CONSTRAINT `post_ibfk_id_topic` FOREIGN KEY (`idTopic`) REFERENCES `topic` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_ibfk_id_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.post : ~0 rows (environ)
INSERT INTO `post` (`id`, `idUser`, `idTopic`, `creationDate`, `content`) VALUES
	(1, 1, 1, '2024-01-10 09:06:00', 'Bonjour à tous — merci d\'avoir rejoint le forum ! Présentez-vous ici.'),
	(2, 3, 1, '2024-01-11 10:15:00', 'Salut, moi c\'est Alice, ravie d\'être ici :)'),
	(3, 3, 2, '2024-03-03 10:05:00', 'J\'ai suivi ce guide et ça fonctionne : étape 1 -> ... étape 2 -> ...'),
	(4, 2, 2, '2024-03-03 11:00:00', 'Merci @alice — j\'ai ajouté une précision sur la compatibilité.'),
	(5, 4, 4, '2024-04-21 12:40:00', 'Je travaille sur un petit projet Node.js; qui veut collaborer ?'),
	(6, 1, 5, '2024-06-15 12:05:00', 'Le nouveau règlement entre en vigueur aujourd\'hui. Merci de le lire.'),
	(7, 5, 6, '2024-07-02 18:25:00', 'Je signale un message qui semble contenir un lien frauduleux.'),
	(8, NULL, 4, '2024-04-22 09:00:00', 'Réponse anonyme / importée (utilisateur supprimé)'),
	(9, 2, 3, '2024-04-02 09:30:00', 'Quelques astuces : nettoyer le cache, augmenter la mémoire, ...'),
	(10, 4, 3, '2024-04-02 10:00:00', 'Merci pour les astuces, ça a aidé mon poste de travail.');

-- Listage de la structure de table forum_quentin_maia. report
CREATE TABLE IF NOT EXISTS `report` (
  `idUser` int NOT NULL,
  `idTopic` int NOT NULL,
  `reporting_date` datetime NOT NULL,
  `commentary` text,
  KEY `report_ibfk_id_topic` (`idTopic`) USING BTREE,
  KEY `report_ibfk_id_user` (`idUser`) USING BTREE,
  CONSTRAINT `report_ibfk_id_topic` FOREIGN KEY (`idTopic`) REFERENCES `topic` (`id`),
  CONSTRAINT `report_ibfk_id_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.report : ~0 rows (environ)
INSERT INTO `report` (`idUser`, `idTopic`, `reporting_date`, `commentary`) VALUES
	(4, 6, '2024-07-02 18:40:00', 'Contenu suspect / lien potentiellement malveillant — à vérifier.'),
	(3, 5, '2024-06-16 08:00:00', 'Une phrase du règlement me semble ambiguë, merci de clarifier.');

-- Listage de la structure de table forum_quentin_maia. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` int DEFAULT NULL,
  `idCategory` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `creationDate` datetime NOT NULL,
  `closed` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'non',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `topic_ibfk_id_user` (`idUser`) USING BTREE,
  KEY `topic_ibfk_id_category` (`idCategory`) USING BTREE,
  CONSTRAINT `topic_ibfk_id_category` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `topic_ibfk_id_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.topic : ~0 rows (environ)
INSERT INTO `topic` (`id`, `idUser`, `idCategory`, `title`, `creationDate`, `closed`) VALUES
	(1, 1, 1, 'Bienvenue sur le forum', '2024-01-10 09:05:00', 'non'),
	(2, 3, 2, 'Comment installer X sous Windows', '2024-03-03 10:00:00', 'non'),
	(3, 2, 2, 'Trucs et astuces pour optimiser Y', '2024-04-01 14:10:00', 'non'),
	(4, 4, 1, 'Projets en cours — partagez vos idées', '2024-04-20 09:30:00', 'non'),
	(5, 1, 3, 'Mise à jour du règlement du forum', '2024-06-15 12:00:00', 'oui'),
	(6, 5, 1, 'Signalement : message suspect', '2024-07-02 18:22:00', 'non');

-- Listage de la structure de table forum_quentin_maia. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `registrationDate` datetime NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `banned` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'non',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.user : ~0 rows (environ)
INSERT INTO `user` (`id`, `role`, `username`, `registrationDate`, `email`, `password`, `banned`) VALUES
	(1, 'admin', 'Admin_Quentin', '2024-01-10 09:00:00', 'admin@forum.test', 'e4abae53cc1cebe5fe89ea93882c699a5e71ab0bbf42a83b7d833975b61c4a41', 'non'),
	(2, 'moderator', 'Mod_Maia', '2024-01-12 11:30:00', 'maia.mod@forum.test', '47df472a45e962fe28bf79f98e38a00fb3b556dcbbb6d47305b32ce949da7559', 'non'),
	(3, 'member', 'alice', '2024-03-02 15:20:00', 'alice@example.test', '21c0f1f1beb75d904c5ba3b332fb4b256f78d76a5d9846089692a0b51959427b', 'non'),
	(4, 'member', 'bob', '2024-04-18 08:05:00', 'bob@example.test', '2f31135ee63dd7ca3065ea933ca44449f176d255d548b2c6489a370840a5cfdf', 'non'),
	(5, 'member', 'charlie', '2024-05-10 20:45:00', 'charlie@example.test', '92287277c7aa523e555526c996229f3e9c78462b0fcc0acfe82e59d5973086e1', 'oui');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
