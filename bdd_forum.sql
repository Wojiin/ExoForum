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
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Général'),
	(2, 'Tutoriels'),
	(3, 'Annonces'),
	(4, 'Astuces');

-- Listage de la structure de table forum_quentin_maia. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `topic_id` int NOT NULL,
  `creationDate` datetime DEFAULT (now()),
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `idx_post_user` (`user_id`),
  KEY `idx_post_topic` (`topic_id`),
  CONSTRAINT `fk_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.post : ~23 rows (environ)
INSERT INTO `post` (`id_post`, `user_id`, `topic_id`, `creationDate`, `content`) VALUES
	(1, 1, 1, '2024-01-10 09:06:00', 'Bonjour à tous — merci d\'avoir rejoint le forum ! Présentez-vous ici.'),
	(2, 3, 1, '2024-01-11 10:15:00', 'Salut, moi c\'est Alice, ravie d\'être ici :)'),
	(3, 3, 2, '2024-03-03 10:05:00', 'J\'ai suivi ce guide et ça fonctionne : étape 1 -> ... étape 2 -> ...'),
	(4, 2, 2, '2024-03-03 11:00:00', 'Merci @alice — j\'ai ajouté une précision sur la compatibilité.'),
	(5, 4, 4, '2024-04-21 12:40:00', 'Je travaille sur un petit projet Node.js; qui veut collaborer ?'),
	(6, 1, 5, '2024-06-15 12:05:00', 'Le nouveau règlement entre en vigueur aujourd\'hui. Merci de le lire.'),
	(7, 5, 6, '2024-07-02 18:25:00', 'Je signale un message qui semble contenir un lien frauduleux.'),
	(8, NULL, 4, '2024-04-22 09:00:00', 'Réponse anonyme / importée (utilisateur supprimé)'),
	(9, 2, 3, '2024-04-02 09:30:00', 'Quelques astuces : nettoyer le cache, augmenter la mémoire, ...'),
	(10, 4, 3, '2024-04-02 10:00:00', 'Merci pour les astuces, ça a aidé mon poste de travail.'),
	(11, NULL, 11, '2025-11-20 11:03:35', '#showtooltip\r\n/stopcasting\r\n/cast [target=mouseover] Cercle de soins(Rang 5)'),
	(12, NULL, 2, '2025-11-20 11:07:51', 'J&#039;y comprends rien help me plz'),
	(13, NULL, 2, '2025-11-20 11:10:29', 'Ah c&#039;est bon d&eacute;so'),
	(14, NULL, 12, '2025-11-20 11:12:15', 'Et pas l&agrave; ?'),
	(15, NULL, 12, '2025-11-20 11:26:17', 'Maintenant &ccedil;a devrait marcher'),
	(16, NULL, 12, '2025-11-20 11:28:27', 'Bon cette fois c&#039;est la bonne'),
	(17, NULL, 12, '2025-11-20 11:35:15', 'J&#039;y crois &agrave; mort'),
	(18, NULL, 12, '2025-11-20 11:35:26', 'stp'),
	(19, NULL, 2, '2025-11-20 11:36:29', 'sdsdsd'),
	(20, NULL, 1, '2025-11-20 11:37:40', 'Salut l&#039;&eacute;quipe'),
	(21, NULL, 5, '2025-11-20 11:38:34', 'Mais il est nul ce nouveau r&egrave;glement'),
	(22, NULL, 12, '2025-11-20 11:39:47', 'En fait il manquait juste un point virgule'),
	(23, NULL, 2, '2025-11-20 11:49:43', 'EUREKA');

-- Listage de la structure de table forum_quentin_maia. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `category_id` int NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `creationDate` datetime DEFAULT (now()),
  `closed` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'non',
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `idx_topic_user` (`user_id`),
  KEY `idx_topic_category` (`category_id`),
  CONSTRAINT `fk_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `fk_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.topic : ~9 rows (environ)
INSERT INTO `topic` (`id_topic`, `user_id`, `category_id`, `title`, `creationDate`, `closed`) VALUES
	(1, 1, 1, 'Bienvenue sur le forum', '2024-01-10 09:05:00', 'non'),
	(2, 3, 2, 'Comment installer X sous Windows', '2024-03-03 10:00:00', 'non'),
	(3, 2, 2, 'Trucs et astuces pour optimiser Y', '2024-04-01 14:10:00', 'non'),
	(4, 4, 1, 'Projets en cours — partagez vos idées', '2024-04-20 09:30:00', 'non'),
	(5, 1, 3, 'Mise à jour du règlement du forum', '2024-06-15 12:00:00', 'oui'),
	(6, 5, 1, 'Signalement : message suspect', '2024-07-02 18:22:00', 'non'),
	(10, NULL, 2, 'Comment &eacute;plucher des oignons avec une paille ?', '2025-11-20 09:54:33', 'non'),
	(11, NULL, 2, 'Utiliser le stopcast &agrave; bon escient', '2025-11-20 10:57:53', 'non'),
	(12, NULL, 2, 'Pourquoi &ccedil;a fonctionne ici ?', '2025-11-20 11:12:04', 'non');

-- Listage de la structure de table forum_quentin_maia. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'member',
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `registrationDate` datetime NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `banned` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'non',
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_quentin_maia.user : ~6 rows (environ)
INSERT INTO `user` (`id_user`, `role`, `username`, `registrationDate`, `email`, `password`, `banned`) VALUES
	(1, 'admin', 'Admin_Quentin', '2024-01-10 09:00:00', 'admin@forum.test', 'e4abae53cc1cebe5fe89ea93882c699a5e71ab0bbf42a83b7d833975b61c4a41', 'non'),
	(2, 'moderator', 'Mod_Maia', '2024-01-12 11:30:00', 'maia.mod@forum.test', '47df472a45e962fe28bf79f98e38a00fb3b556dcbbb6d47305b32ce949da7559', 'non'),
	(3, 'member', 'alice', '2024-03-02 15:20:00', 'alice@example.test', '21c0f1f1beb75d904c5ba3b332fb4b256f78d76a5d9846089692a0b51959427b', 'non'),
	(4, 'member', 'bob', '2024-04-18 08:05:00', 'bob@example.test', '2f31135ee63dd7ca3065ea933ca44449f176d255d548b2c6489a370840a5cfdf', 'non'),
	(5, 'member', 'charlie', '2024-05-10 20:45:00', 'charlie@example.test', '92287277c7aa523e555526c996229f3e9c78462b0fcc0acfe82e59d5973086e1', 'oui'),
	(13, 'member', 'enzo', '2025-11-18 00:00:00', 'enzo@exemple.fr', '$2y$10$6pnwmA2qrSe9dIgrOkIr3evHYDzjFW6ghwrvKO8ADG2Gnfu4nJCei', 'non');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
