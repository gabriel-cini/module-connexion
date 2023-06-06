-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 juin 2023 à 16:34
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `module-connexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `prenom`, `nom`, `password`) VALUES
(2, 'admin', 'admin', 'admin', '$2y$10$2tUiN7eCb4jZrRBmaewy9.54n7usaUNT/b6PSBYrsGDzRBqtyKiTC'),
(3, 'gg', 'gg', 'gg', '$2y$10$xqDHQJ3A0ZoKl1.Mlo11Y.Z/AFRIREyATKXjHwGYWP6RmrTsh3Uqu'),
(4, 'gga', 'gga', 'gg', '$2y$10$6nLZHCNDLDHeyNujqtWzfOG7Ygl4/ga2ACO.ZOELM0FlHRZ6KUcOS'),
(5, 'ggb', 'ggb', 'ggb', '$2y$10$0C6Ogu1GYhSvU7BrzJge/efv0EFA51PbHJtu9zKUNGPPPFigpmx06'),
(6, 'gabo13', 'Gabriel', 'Cini', '$2y$10$bh7s0Mu7mKcwZ1/LhO/45OGGWo3qqqFJJyVxTDf.gTCeFtWwXcY1G'),
(7, 'gabo1313', 'Jean', 'Dupont', '$2y$10$BNDTB48EG.wPOhzDwa8pPe7nTQIT4WgF6E68hc7Gd8se3YkBejhJO'),
(8, 'gb12', 'gb', 'gbb', '$2y$10$0BKcDQU50lIn6BaPuHTDb.GEMVvXlZRNewvTvFSZk2Zt2.cIG8C4K');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
