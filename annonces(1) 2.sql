-- phpMyAdmin SQL Dump
-- version 4.7.9
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1:3306
-- Généré le :  Jul 01, 2019 à 16:59
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `annonces`
--
CREATE DATABASE IF NOT EXISTS `annonces` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `annonces`;
-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `url_photo` varchar(1024) DEFAULT NULL,
  `date_publication` datetime NOT NULL,
  `prix` decimal(15,3) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_commune` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `FK_annonce_id_utilisateur` (`id_utilisateur`),
  KEY `FK_annonce_id_categorie` (`id_categorie`),
  KEY `FK_annonce_id_commune` (`id_commune`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `titre`, `description`, `url_photo`, `date_publication`, `prix`, `active`, `id_utilisateur`, `id_categorie`, `id_commune`) VALUES
(1, 'Porsche Panamera', 'Construit pour 100 passionnes. Panamera Exclusive Series.\n\nLa serie Panamera est la plus luxueuse jamais construite. Et la plus exclusive. Strictement limitée à 100 exemplaires pour le monde entier. Des details sélectionnes ont ete valorises artisanalement. Ce n''est qu''ainsi qu''il est possible d''obtenir un vehicule au caractère unique.', 'porsche-panamera.jpg', '2016-03-29 00:00:00', '150000.000', 1, 1, 2, 2),
(3, 'test', 'bl bla bla', NULL, '2016-03-31 12:42:56', '150.000', 1, 6, 3, NULL),
(4, 'bon', 'cvgt', NULL, '2016-03-31 12:48:08', '1580.000', 1, 6, 2, NULL),
(5, 'pavillon', 'super pavillon', NULL, '2016-04-01 10:47:09', '329000.000', 1, 6, 1, NULL),
(7, 'S7', 'kgjlksqgjlksgjkgsjdkgdjgdkljklgsdjflk', '', '2016-04-01 10:59:17', '900.000', 1, 6, 2, NULL),
(8, 'biere', 'bonne biere', '', '2016-04-01 11:20:08', '25.000', 1, 6, 3, NULL),
(9, 'azeaze', 'sqdsqdqs', 'just-beer-logo-crop.jpg', '2016-04-01 11:51:22', '123.000', 1, 6, 3, NULL),
(10, 'zaeaze', 'qsdsq', 'HomepageMainImg-homebrew2016 (1).png', '2016-04-01 11:53:29', '12323132.000', 1, 6, 2, NULL),
(11, 'dlm', 'df', 'beer.png', '2016-04-01 14:26:02', '12.000', 1, 6, 3, NULL),
(12, 'bobo', 'dcs', 'ferrari.jpg', '2016-04-01 14:30:19', '2580.000', 1, 6, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `libelle_categorie`) VALUES
(1, 'Immobilier'),
(2, 'Voiture'),
(3, 'Mobile');

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE IF NOT EXISTS `commune` (
  `id_commune` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(25) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `departement` varchar(2) NOT NULL,
  `region` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_commune`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `commune`
--

INSERT INTO `commune` (`id_commune`, `ville`, `code_postal`, `departement`, `region`) VALUES
(1, 'Paris', '75000', '75', 'Ile de France'),
(2, 'Vincennes', '94300', '94', 'Ile de France');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `message` text NOT NULL,
  `id_annonce` int(11) NOT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `FK_reponse_id_annonce` (`id_annonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `departement` int(2) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `mdp`, `nom`, `prenom`, `telephone`, `departement`) VALUES
(1, 'cedric@cderic.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ced', 'Ced', '0102030405', 0),
(2, 'heinzwallace@laposte.net', '12345678', 'wallace', 'max', '102547896', 0),
(3, 'heinrixh@gmx.de', '12345678', 'heini', 'boll', '075698414', 0),
(4, 'momo@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'coach', 'bobby', NULL, 0),
(5, 'lol@gmail.com', 'f924c3d1e2c8c36349b59c3ecba976efba06c72f', 'durand', 'zlatan', NULL, 0),
(6, 'a', 'b', 'a', 'a', '01', 0),
(7, 'nicolas@gmail.com', '', 'coach', 'bobby', NULL, 0),
(8, 'bono', 'bono', '', '', NULL, 0),
(12, 'diallo', 'alfa', '', '', NULL, 0),
(13, 'coucou', 'coco', '', '', NULL, 83),
(14, '', '', '92', 'allo', NULL, 0),
(15, 'test', 'untest', '', '', NULL, 93);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_annonce_id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `FK_annonce_id_commune` FOREIGN KEY (`id_commune`) REFERENCES `commune` (`id_commune`),
  ADD CONSTRAINT `FK_annonce_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_reponse_id_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `annonce` (`id_annonce`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
