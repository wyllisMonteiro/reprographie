-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 21 Mai 2019 à 14:45
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `reprographie`
--

-- --------------------------------------------------------

--
-- Structure de la table `demand`
--

CREATE TABLE IF NOT EXISTS `demand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_demand` date NOT NULL,
  `date_ready_print` date NOT NULL,
  `nb_print` int(10) NOT NULL,
  `format_page` varchar(2) NOT NULL,
  `orientation` varchar(255) NOT NULL,
  `agrafage` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `demand`
--

INSERT INTO `demand` (`id`, `date_demand`, `date_ready_print`, `nb_print`, `format_page`, `orientation`, `agrafage`, `commentaire`) VALUES
(1, '2019-05-21', '2019-05-22', 2, 'A4', 'Paysage', 1, 'Commentaires');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fistname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `fistname`, `lastname`, `email`, `pass`) VALUES
(1, 'Dev', 'Dev', 'dev@gmail.com', 'dev');

-- --------------------------------------------------------

--
-- Structure de la table `user_demand`
--

CREATE TABLE IF NOT EXISTS `user_demand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(255) NOT NULL,
  `id_demand` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `user_demand`
--

INSERT INTO `user_demand` (`id`, `id_user`, `id_demand`) VALUES
(1, 1, 1);
