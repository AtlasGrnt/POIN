-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 05 juin 2020 à 08:27
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `poin`
--

-- --------------------------------------------------------

--
-- Structure de la table `ajout_produit`
--

DROP TABLE IF EXISTS `ajout_produit`;
CREATE TABLE IF NOT EXISTS `ajout_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `date_insert` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_ajout_produit` (`id_user`),
  KEY `fk_produit_ajout_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

DROP TABLE IF EXISTS `categorie_produit`;
CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie_produit`
--

INSERT INTO `categorie_produit` (`id`, `name`) VALUES
(1, 'écran'),
(2, 'clavier'),
(3, 'souris'),
(4, 'souris sans fil'),
(5, 'clavier sans fil'),
(6, 'tour'),
(7, 'webcam'),
(8, 'casque'),
(9, 'micro'),
(10, 'autres'),
(11, 'disque dur externe'),
(12, 'cable'),
(13, 'pc portable'),
(14, 'enceinte'),
(15, 'rétro-projecteur'),
(16, 'telephone fixe'),
(17, 'telephone portable'),
(18, 'console');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nb_produit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `detail_commande`
--

DROP TABLE IF EXISTS `detail_commande`;
CREATE TABLE IF NOT EXISTS `detail_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commande` (`id_commande`),
  KEY `fk_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `categorie` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `date_insert` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_categorie` (`categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `name`, `categorie`, `description`, `images`, `date_insert`) VALUES
(1, 'écran Samsung u28e590ds', 1, 'écran Samsung 4k neuf', 'EcranSamsung.jpg', '2020-06-04'),
(2, 'playstation 3', 18, 'playstation 3 occasion avec une manette', 'PS3.png', '2020-06-04'),
(3, 'iPhone 6SE', 17, 'iPhone 6SE coque rouge. Bonne qualité', 'iphone.png', '2020-06-04'),
(4, 'Samsung galaxy s8', 17, 'Samsung galaxy s8 coque noir. Bonne qualité', 'galaxyS8.jpg', '2020-06-04'),
(6, 'disque dur Samsung ', 11, 'disque dur externe Samsung 500go USB', 'disque.jpg', '2020-06-04');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type_user` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `password`, `email`, `type_user`) VALUES
(1, 'Admin1', '$1$Q6P8GgMY$RagMaR67Rg.wSzEOP5I/w1', 'kelian.danquigny@gmail.com', 'A'),
(2, 'clientTest', 'Test', 'test.test@gmail.com', 'C'),
(3, 'Sopra', 'Sopra', 'Sopra@gmail.com', 'E');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ajout_produit`
--
ALTER TABLE `ajout_produit`
  ADD CONSTRAINT `fk_produit_ajout_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `fk_user_ajout_produit` FOREIGN KEY (`id_user`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD CONSTRAINT `fk_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `fk_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`categorie`) REFERENCES `categorie_produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
