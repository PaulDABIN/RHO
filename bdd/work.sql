-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Lun 30 Mai 2016 à 12:34
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `work`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id_annonce` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `texte` text NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `codepostal` int(11) NOT NULL,
  `date` date NOT NULL,
  `jour` date NOT NULL,
  `id_owner` int(11) NOT NULL,
  `departement` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `titre`, `texte`, `categorie`, `codepostal`, `date`, `jour`, `id_owner`, `departement`, `image`) VALUES
(1, 'areréréa"ra', 'azdzzdqscqscfqsfq', 'suisse', 77377, '2016-05-25', '2016-06-19', 3, '', ''),
(3, 'zadfazdazdazd', 'dddddddzdazdazdazdazd', 'france', 92400, '2016-05-18', '2016-07-11', 1, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `interet`
--

CREATE TABLE `interet` (
  `id` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `etat` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `interet`
--

INSERT INTO `interet` (`id`, `id_annonce`, `id_owner`, `id_user`, `etat`) VALUES
(1, 1, 2, 5, 'en attente'),
(6, 1, 2, 5, 'en attente'),
(7, 1, 2, 5, 'en attente'),
(8, 1, 2, 5, 'en attente'),
(9, 1, 2, 5, 'en attente');

-- --------------------------------------------------------

--
-- Index pour les tables exportées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id_annonce`);

--
-- Index pour la table `interet`
--
ALTER TABLE `interet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `interet`
--
ALTER TABLE `interet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;