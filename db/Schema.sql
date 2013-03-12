-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 11 Mars 2013 à 09:08
-- Version du serveur: 5.5.28
-- Version de PHP: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `import_export`
--

-- --------------------------------------------------------

--
-- Structure de la table `bon`
--

CREATE TABLE IF NOT EXISTS `bon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL,
  `number` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `mode` varchar(10) NOT NULL,
  `destinataire_name` varchar(100) NOT NULL,
  `destinataire_adress1` varchar(150) NOT NULL,
  `destinataire_adress2` varchar(150) NOT NULL,
  `destinataire_zipcode` varchar(8) NOT NULL,
  `destinataire_city` varchar(50) NOT NULL,
  `destinataire_country` varchar(50) NOT NULL,
  `destinataire_phone` varchar(30) NOT NULL,
  `ligne1_quantity` int(10) NOT NULL,
  `ligne1_label` varchar(255) NOT NULL,
  `ligne1_size` float NOT NULL,
  `ligne1_price` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `expediteur`
--

CREATE TABLE IF NOT EXISTS `expediteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `adress1` varchar(150) NOT NULL,
  `adress2` varchar(150) NOT NULL,
  `zipcode` varchar(8) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `cell` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `expediteur`
--

INSERT INTO `expediteur` (`id`, `name`, `adress1`, `adress2`, `zipcode`, `city`, `country`, `phone`, `cell`) VALUES
(1, 'Alain Dissoir', 'adress1', 'adress2', '12345', 'ville', 'pays', '0123456789', '0123456789'),
(2, 'Axel Aire', '', '', '', '', '', '', ''),
(3, 'Andy Vojanbon', '', '', '', '', '', '', ''),
(4, 'Carl Ajumide', '', '', '', '', '', '', ''),
(5, 'Harry Vencouran', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`, `state`) VALUES
(1, 'Toam', 'thomas.brelet@gmail.com', NULL, '$2y$14$GMCNf3OL7alj4FMPOoVpg.fHQgjd/4O8ljD8FWyM/J.nVr06f1JD6', NULL),
(2, 'Jacky', 'jacky@gmail.com', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_role`
--

INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('admin', 0, NULL),
('user', 1, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_role_linker`
--

INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
(1, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
