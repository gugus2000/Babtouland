-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 09 août 2019 à 02:52
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `babtouland`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_auteur`, `id_post`, `contenu`, `date_publication`, `date_mise_a_jour`) VALUES
(1, 1, 1, 'Ceci est un commentaire qui, comme son post parent, a été écrit avec PhpMyAdmin.\r\nIl s\'agit, de la même façon que son congénère, du premier commentaire jamais écrit sur ce site', '2019-08-02 16:06:20', '0000-00-00 00:00:00'),
(2, 1, 1, 'Ce commentaire est écrit avec l’outil de publication de commentaire interne au site. Il s’agit d’une démonstration de ce système fantastique.', '2019-08-02 17:15:58', '0000-00-00 00:00:00'),
(3, 6, 1, 'Ce premier post est magnifique: on sent que ce blog est destiné à un grand avenir !', '2019-08-06 02:40:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `nom_role` varchar(255) NOT NULL,
  `application` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `permission`
--

INSERT INTO `permission` (`id`, `nom_role`, `application`, `action`) VALUES
(1, 'membre', 'post', 'fil_post'),
(2, 'membre', 'user', 'connexion'),
(3, 'membre', 'user', 'inscription'),
(4, 'membre', 'user', 'statut'),
(5, 'membre', 'user', 'validation_connexion'),
(6, 'membre', 'user', 'validation_inscription'),
(8, 'guest', 'user', 'connexion'),
(9, 'guest', 'user', 'validation_connexion'),
(10, 'guest', 'user', 'inscription'),
(11, 'guest', 'user', 'validation_inscription'),
(12, 'guest', 'user', 'statut'),
(13, 'membre', 'user', 'deconnexion'),
(14, 'admin', 'user', 'connexion'),
(15, 'admin', 'user', 'inscription'),
(16, 'admin', 'user', 'statut'),
(17, 'admin', 'user', 'validation_connexion'),
(18, 'admin', 'user', 'validation_inscription'),
(19, 'admin', 'user', 'deconnexion'),
(20, 'admin', 'post', 'fil_post'),
(21, 'admin', 'post', 'publication'),
(22, 'admin', 'post', 'validation_publication'),
(24, 'membre', 'post', 'lecture'),
(25, 'admin', 'post', 'lecture'),
(26, 'admin', 'post', 'commentaire_publication'),
(27, 'membre', 'post', 'commentaire_publication'),
(28, 'guest', 'post', 'fil_post'),
(29, 'guest', 'post', 'lecture'),
(30, 'admin', 'core', 'suppression_post'),
(31, 'admin', 'post', 'suppression'),
(32, 'membre', 'post', 'commentaire_suppression'),
(33, 'admin', 'post', 'commentaire_suppression'),
(34, 'admin', 'core', 'suppression_commentaire'),
(35, 'admin', 'post', 'edition'),
(36, 'admin', 'post', 'validation_edition'),
(37, 'admin', 'core', 'edition_post'),
(38, 'admin', 'core', 'edition_commentaire'),
(39, 'admin', 'post', 'commentaire_edition'),
(40, 'admin', 'post', 'commentaire_validation_edition'),
(41, 'membre', 'post', 'commentaire_edition'),
(42, 'membre', 'post', 'commentaire_validation_edition'),
(43, 'membre', 'user', 'edition'),
(44, 'admin', 'user', 'edition'),
(45, 'admin', 'core', 'edition_user'),
(46, 'membre', 'user', 'validation_edition'),
(47, 'admin', 'user', 'validation_edition'),
(48, 'admin', 'utile', 'a_propos'),
(49, 'membre', 'utile', 'a_propos'),
(50, 'guest', 'utile', 'a_propos'),
(51, 'admin', 'utile', 'mail'),
(52, 'membre', 'utile', 'mail'),
(53, 'guest', 'utile', 'mail'),
(54, 'admin', 'user', 'view'),
(55, 'membre', 'user', 'view'),
(56, 'guest', 'user', 'view');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `id_auteur`, `titre`, `contenu`, `date_publication`, `date_mise_a_jour`) VALUES
(1, 1, 'Premier Post', 'Ce post est complétement écrit via l’interface PhpMyAdmin. Il s’agit de tester les fonctionnalités du site à l’aide d’un post exemple.\r\nC’est donc à la fois un post dont je suis sûr qu’il sera « historique », mais aussi utile ! Quoi de mieux donc, que de de créer ce magnifique post ?', '2019-08-01 00:32:15', '0000-00-00 00:00:00'),
(5, 1, 'Validation', 'Ce commentaire est écrit avec l’outil de publication de commentaire interne au site.\r\nIl s’agit d’une démonstration de ce système fantastique.\r\n[EDIT]Je peux modifier ce post très facilement !', '2019-08-07 23:49:48', '2019-08-07 23:50:45');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `date_connexion` datetime NOT NULL,
  `banni` tinyint(1) NOT NULL,
  `nom_role` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mot_de_passe`, `avatar`, `date_inscription`, `date_connexion`, `banni`, `nom_role`, `mail`) VALUES
(1, 'gugus2000', '$2y$06$J4Ex0f9dGLmu0n5Aozj3Meey3qDOeGM6IG9hUBpvcK2ojPDoX2Jna', 'default.png', '2019-06-29 02:32:26', '2019-08-09 02:17:45', 0, 'admin', 'gugus2000@protonmail.com'),
(6, 'test', '$2y$06$dm4Nq0Dr0KNgEiC/YbRggO8SbI0qFN/k6iRXWgPkoelGgzJicjnWa', '79f5084f6e333130c62a850627ad8b10.png', '2019-07-02 21:57:47', '2019-08-09 02:35:25', 0, 'membre', 'test@gmail.com'),
(12, 'guest', '$2y$06$n7vFJl8jWF7SPwHRM2X4IORku199OzsS6hZlR05BQBlGcHOFpJIpe', 'default.png', '2019-07-24 14:08:54', '2019-08-09 02:17:56', 0, 'guest', 'guest@example.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
