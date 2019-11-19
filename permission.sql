-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 19 nov. 2019 à 19:46
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
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `nom_role` varchar(255) NOT NULL,
  `application` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(56, 'guest', 'user', 'view'),
(57, 'admin', 'utile', 'liste_user'),
(58, 'membre', 'utile', 'liste_user'),
(59, 'guest', 'utile', 'liste_user'),
(60, 'admin', 'utile', 'test'),
(62, 'admin', 'chat', 'hub'),
(63, 'admin', 'chat', 'voir_conversation'),
(64, 'admin', 'chat', 'envoyer_message'),
(65, 'membre', 'chat', 'hub'),
(66, 'membre', 'chat', 'voir_conversation'),
(67, 'membre', 'chat', 'envoyer_message'),
(68, 'admin', 'xhr', 'chat'),
(69, 'membre', 'xhr', 'chat'),
(70, 'admin', 'chat', 'supprimer_message'),
(71, 'admin', 'chat', 'editer_message'),
(72, 'membre', 'chat', 'editer_message'),
(73, 'admin', 'chat', 'validation_editer_message'),
(74, 'membre', 'chat', 'validation_editer_message'),
(75, 'guest', 'erreur', 'erreur'),
(76, 'membre', 'erreur', 'erreur'),
(77, 'admin', 'erreur', 'erreur'),
(78, 'admin', 'admin', 'hub'),
(79, 'admin', 'admin', 'publier_notification'),
(80, 'admin', 'admin', 'publier_notification'),
(81, 'admin', 'admin', 'validation_publier_notification'),
(82, 'admin', 'chat', 'envoyer_mp'),
(83, 'membre', 'chat', 'envoyer_mp'),
(84, 'admin', 'chat', 'validation_envoyer_mp'),
(85, 'membre', 'chat', 'validation_envoyer_mp'),
(86, 'admin', 'chat', 'ajouter_conversation'),
(87, 'membre', 'chat', 'ajouter_conversation'),
(88, 'admin', 'xhr', 'liste_utilisateur'),
(89, 'membre', 'xhr', 'liste_utilisateur'),
(90, 'admin', 'chat', 'validation_ajouter_conversation'),
(91, 'membre', 'chat', 'validation_ajouter_conversation'),
(92, 'admin', 'chat', 'editer_conversation'),
(93, 'membre', 'chat', 'editer_conversation'),
(94, 'admin', 'xhr', 'liste_membre_conv'),
(95, 'membre', 'xhr', 'liste_membre_conv'),
(96, 'admin', 'chat', 'validation_editer_conversation'),
(97, 'membre', 'chat', 'validation_editer_conversation'),
(98, 'admin', 'chat', 'supprimer_conversation'),
(99, 'membre', 'chat', 'supprimer_conversation');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
