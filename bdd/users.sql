-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 27 Mars 2016 à 16:37
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `shareyourwork`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(72) NOT NULL,
  `code_postal` varchar(6) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `key_connection` varchar(72) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `code_postal`, `picture`, `created_at`, `key_connection`) VALUES
(1, 'Damien', 'Duvernois', 'damien.duvernois@gmail.com', '$2y$11$fpdlRgGKpZyYAy6rMAyQw.p2ownPusKntUL.Q2oTmmC5pftKczUBW', '92800', '', '2016-03-13 15:52:51', NULL),
(2, 'Admin', 'Except', 'd.duvernois@student.isartdigit', '$2y$11$JTTeGoPWK31VNXBri.BepuZUixr5zSNtW.zNTO5jhCK91TGsslQXW', '47850', '', '2016-03-13 21:04:03', NULL),
(3, 'Admin', 'Retry', 'd.duvernois@student.isartdigital.com', '$2y$11$VhWM51I7ixONQFHUby.0DOLI1BTvlUB6piXBy0SZ/pHojI2QLxqlO', '87450', '', '2016-03-13 21:10:06', '$2y$11$FU6juAaH.guIEFxVlMqYK./7dkHcgxsJT5TQgNlXecpaYo0XWkmMW');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
