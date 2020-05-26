-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db5000217374.hosting-data.io
-- Généré le : mar. 26 mai 2020 à 20:18
-- Version du serveur :  5.7.28-log
-- Version de PHP : 7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs212220`
--

-- --------------------------------------------------------

--
-- Structure de la table `ip_list`
--

CREATE TABLE `ip_list` (
  `id` int(255) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `navigateur` varchar(255) NOT NULL,
  `date` int(15) NOT NULL,
  `json` varchar(1000) NOT NULL,
  `page` varchar(255) NOT NULL,
  `orientation` varchar(255) NOT NULL,
  `screen` varchar(255) NOT NULL,
  `viewport` varchar(255) NOT NULL,
  `diagonal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ip_list`
--
ALTER TABLE `ip_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ip_list`
--
ALTER TABLE `ip_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
