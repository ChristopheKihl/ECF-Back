-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 fév. 2025 à 12:04
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pizza`
--

-- --------------------------------------------------------

--
-- Structure de la table `base`
--

CREATE TABLE `base` (
  `id_base` int(11) NOT NULL,
  `nom_base` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `base`
--

INSERT INTO `base` (`id_base`, `nom_base`) VALUES
(1, 'tomate'),
(2, 'crême');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(120) DEFAULT NULL,
  `prenom_client` varchar(120) DEFAULT NULL,
  `adresse_client` varchar(255) DEFAULT NULL,
  `telephone_client` varchar(20) DEFAULT NULL,
  `email_client` varchar(120) DEFAULT NULL,
  `mot_de_passe_client` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `adresse_client`, `telephone_client`, `email_client`, `mot_de_passe_client`) VALUES
(510, 'KIHL', 'Christophe', '20, route nationale\r\n57660 GROSTENQUIN', '0620323940', 'christophe_kihl@hotmail.com', '$2y$10$Kf4gHv8i6vLa4skokVz7Ze14u5sLWnX1hU/GL55WomtNa31IvE8qy');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_pizza` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `quantite_commande` tinyint(4) DEFAULT NULL,
  `date_commande` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

CREATE TABLE `compose` (
  `id_pizza` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compose`
--

INSERT INTO `compose` (`id_pizza`, `id_ingredient`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(4, 1),
(4, 4),
(4, 5),
(4, 6),
(5, 1),
(5, 7),
(6, 1),
(6, 9),
(6, 10),
(6, 11),
(7, 1),
(7, 9),
(7, 12),
(7, 13),
(8, 1),
(8, 4),
(8, 8),
(8, 14),
(8, 15),
(9, 1),
(9, 11),
(9, 14),
(9, 16),
(9, 17),
(10, 1),
(10, 2),
(10, 13),
(10, 16),
(10, 18),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 11),
(11, 16);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `chemin_image` varchar(250) NOT NULL,
  `description_image` varchar(250) NOT NULL,
  `image_pizza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id_image`, `chemin_image`, `description_image`, `image_pizza`) VALUES
(1, 'img/pizza/marguerita.jpg', 'marguerita', 1),
(2, 'img/pizza/reine.jpg', 'reine', 2),
(3, 'img/pizza/orientale.jpg', 'orientale', 3),
(4, 'img/pizza/pepperoni.jpg', 'pepperoni', 5),
(5, 'img/pizza/chevre_miel.jpg', 'chevre miel', 6),
(6, 'img/pizza/4fromages.jpg', '', 7),
(7, 'img/pizza/raclette.jpg', 'raclette', 8),
(8, 'img/pizza/savoyarde.jpg', 'savoyarde', 9),
(9, 'img/pizza/fermiere.jpg', 'fermiere', 10),
(10, 'img/pizza/tikki_thai.jpg', 'tikki thai', 11);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id_ingredient` int(11) NOT NULL,
  `nom_ingredient` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id_ingredient`, `nom_ingredient`) VALUES
(1, 'mozarella'),
(2, 'jambon'),
(3, 'champignon'),
(4, 'oignons'),
(5, 'merguez'),
(6, 'poivron'),
(7, 'pepperoni'),
(8, 'bacon'),
(9, 'chèvre'),
(10, 'miel'),
(11, 'origan'),
(12, 'gouda'),
(13, 'emmental'),
(14, 'pommes de terre'),
(15, 'raclette'),
(16, 'lardons'),
(17, 'reblochon'),
(18, 'poulet');

-- --------------------------------------------------------

--
-- Structure de la table `pizza`
--

CREATE TABLE `pizza` (
  `id_pizza` int(11) NOT NULL,
  `nom_pizza` varchar(120) DEFAULT NULL,
  `prix_pizza` decimal(19,4) DEFAULT NULL,
  `id_base` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pizza`
--

INSERT INTO `pizza` (`id_pizza`, `nom_pizza`, `prix_pizza`, `id_base`) VALUES
(1, 'margherita', 8.5000, 1),
(2, 'reine', 10.9900, 1),
(4, 'orientale', 10.9900, 1),
(5, 'pepperoni', 8.5000, 1),
(6, 'chèvre miel', 11.9900, 2),
(7, 'quatre fromages', 12.9900, 1),
(8, 'raclette', 12.9900, 2),
(9, 'savoyarde', 12.9900, 2),
(10, 'campagnarde', 12.9900, 2),
(11, 'forestière', 12.9900, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`id_base`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_pizza`,`id_client`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `compose`
--
ALTER TABLE `compose`
  ADD PRIMARY KEY (`id_pizza`,`id_ingredient`),
  ADD KEY `id_ingredient` (`id_ingredient`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Index pour la table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id_pizza`),
  ADD KEY `id_base` (`id_base`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `base`
--
ALTER TABLE `base`
  MODIFY `id_base` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id_ingredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id_pizza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_pizza`) REFERENCES `pizza` (`id_pizza`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `compose_ibfk_1` FOREIGN KEY (`id_pizza`) REFERENCES `pizza` (`id_pizza`),
  ADD CONSTRAINT `compose_ibfk_2` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredient`);

--
-- Contraintes pour la table `pizza`
--
ALTER TABLE `pizza`
  ADD CONSTRAINT `pizza_ibfk_1` FOREIGN KEY (`id_base`) REFERENCES `base` (`id_base`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
