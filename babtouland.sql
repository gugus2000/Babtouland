-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 03 déc. 2019 à 18:21
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_auteur`, `id_post`, `contenu`, `date_publication`, `date_mise_a_jour`) VALUES
(1, 1, 1, 'Ceci est un commentaire qui, comme son post parent, a été écrit avec PhpMyAdmin.\r\nIl s\'agit, de la même façon que son congénère, du premier commentaire jamais écrit sur ce site', '2019-08-02 16:06:20', '0000-00-00 00:00:00'),
(2, 1, 1, 'Ce commentaire est écrit avec l’outil de publication de commentaire interne au site. Il s’agit d’une démonstration de ce système fantastique.', '2019-08-02 17:15:58', '0000-00-00 00:00:00'),
(3, 6, 1, 'Ce premier post est magnifique: on sent que ce blog est destiné à un grand avenir !', '2019-08-06 02:40:28', '0000-00-00 00:00:00'),
(4, 1, 6, '[align=\"left\"][b]C\'est cool:[/b]\r\n[list]\r\n[*]Ça permet  de  mettre un peu de [i]beauté[/i][/*]\r\n[*]Je peux m\'amuser[/*]\r\n[*]Ça vaut le coup[/*]\r\n[/list][/align]', '2019-08-11 16:59:39', '2019-08-11 17:00:06'),
(5, 1, 7, 'Ça fonctionne [b]correctement[/b] !', '2019-09-17 00:48:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `valeur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `configuration`
--

INSERT INTO `configuration` (`id`, `id_utilisateur`, `nom`, `valeur`) VALUES
(1, 1, 'lang', 'FR'),
(3, 1, 'post_fil_post_nombre_posts', '2');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `nom`, `description`) VALUES
(1, 'General', 'Tout membre du site peut communiquer dans ce salon de discussion !'),
(2, 'Groupe privé des administrateurs', 'Tout seul sur ce groupe, Yeah! :('),
(3, 'MP entre lapin et gugus2000', 'Messages privés entre lapin et gugus2000');

-- --------------------------------------------------------

--
-- Structure de la table `liaisonconversationutilisateur`
--

CREATE TABLE `liaisonconversationutilisateur` (
  `id_conversation` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liaisonconversationutilisateur`
--

INSERT INTO `liaisonconversationutilisateur` (`id_conversation`, `id_utilisateur`) VALUES
(1, 1),
(2, 1),
(1, 6),
(1, 13),
(1, 16),
(1, 17),
(1, 30),
(3, 13),
(3, 1),
(1, 39);

-- --------------------------------------------------------

--
-- Structure de la table `liaisonnotificationutilisateur`
--

CREATE TABLE `liaisonnotificationutilisateur` (
  `id_notification` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liaisonnotificationutilisateur`
--

INSERT INTO `liaisonnotificationutilisateur` (`id_notification`, `id_utilisateur`) VALUES
(27, 6),
(27, 17),
(27, 30);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_conversation` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_conversation`, `id_auteur`, `contenu`, `date_publication`, `date_mise_a_jour`) VALUES
(1, 1, 1, 'Premier message envoyé (avec PhpMyAdmin)!\r\nComme tous les premiers messages, il mérite d\'être connu dans le mode entier.', '2019-08-18 18:05:00', '0000-00-00 00:00:00'),
(2, 1, 1, 'Voici un deuxième message, cette fois ci écrit avec le formulaire accessible à tous !', '2019-09-30 20:34:09', '2019-09-30 20:34:09'),
(3, 1, 1, 'ça marche \\o/', '2019-09-30 20:40:24', '2019-09-30 20:40:24'),
(4, 1, 13, 'T\'es sur?', '2019-09-30 22:07:04', '2019-09-30 22:07:04'),
(5, 1, 13, 'Ah oui !', '2019-09-30 22:07:17', '2019-09-30 22:07:17'),
(6, 1, 13, 'le temps est géré ! C\'est formidable', '2019-09-30 23:25:39', '2019-09-30 23:25:39'),
(7, 1, 13, 'ça a pris du temps...', '2019-09-30 23:26:11', '2019-09-30 23:26:11'),
(8, 1, 13, 'je flood', '2019-09-30 23:27:46', '2019-09-30 23:27:46'),
(9, 1, 13, 'spam', '2019-09-30 23:27:53', '2019-09-30 23:27:53'),
(10, 1, 13, 'spam', '2019-09-30 23:28:00', '2019-09-30 23:28:00'),
(12, 1, 1, 'Reste:\r\n-la modification des messages\r\n-la suppressions des messages\r\n-la gestion des nouvelles conversations (conversation sans message)', '2019-09-30 23:56:32', '2019-09-30 23:56:32'),
(13, 1, 1, '(et peut être après le bbcode)', '2019-09-30 23:56:59', '2019-09-30 23:56:59'),
(14, 1, 1, 'j\'en ai finis pour aujourd\'hui !', '2019-09-30 23:58:43', '2019-09-30 23:58:43'),
(15, 1, 13, 'un message !', '2019-10-02 20:08:43', '2019-10-02 20:08:43'),
(16, 1, 13, 'test 2', '2019-10-02 20:10:04', '2019-10-02 20:10:04'),
(17, 1, 13, 'test 3', '2019-10-02 20:11:48', '2019-10-02 20:11:48'),
(18, 1, 13, 'affiche toi !', '2019-10-02 20:14:14', '2019-10-02 20:14:14'),
(19, 1, 13, 'test', '2019-10-02 20:15:44', '2019-10-02 20:15:44'),
(20, 1, 13, 'bon…', '2019-10-02 20:40:34', '2019-10-02 20:40:34'),
(21, 1, 13, 'des fois ça marche...', '2019-10-02 20:40:43', '2019-10-02 20:40:43'),
(22, 1, 13, 'des fois non...', '2019-10-02 20:40:51', '2019-10-02 20:40:51'),
(23, 1, 13, 'lol', '2019-10-02 20:41:36', '2019-10-02 20:41:36'),
(24, 1, 13, 'me saoule', '2019-10-02 20:41:43', '2019-10-02 20:41:43'),
(25, 1, 13, 'ah', '2019-10-02 20:42:47', '2019-10-02 20:42:47'),
(26, 1, 13, 'triste', '2019-10-02 20:42:52', '2019-10-02 20:42:52'),
(27, 1, 13, 'test', '2019-10-03 15:51:19', '2019-10-03 15:51:19'),
(28, 1, 13, 'lol', '2019-10-03 15:51:34', '2019-10-03 15:51:34'),
(29, 1, 13, 'ah', '2019-10-03 15:53:12', '2019-10-03 15:53:12'),
(30, 1, 13, 'verif', '2019-10-03 15:57:45', '2019-10-03 15:57:45'),
(31, 1, 13, 'dernier', '2019-10-03 15:59:28', '2019-10-03 15:59:28'),
(32, 1, 13, 'ah...', '2019-10-03 15:59:51', '2019-10-03 15:59:51'),
(33, 1, 13, 'alala', '2019-10-03 16:33:51', '2019-10-03 16:33:51'),
(34, 1, 13, 'alala', '2019-10-03 16:33:53', '2019-10-03 16:33:53'),
(35, 1, 13, 'test', '2019-10-03 16:43:08', '2019-10-03 16:43:08'),
(36, 1, 13, 'ok', '2019-10-03 16:43:18', '2019-10-03 16:43:18'),
(37, 1, 13, 'message', '2019-10-03 17:15:22', '2019-10-03 17:15:22'),
(38, 1, 13, 'test', '2019-10-03 17:16:00', '2019-10-03 17:16:00'),
(39, 1, 13, 'aie', '2019-10-03 17:18:47', '2019-10-03 17:18:47'),
(40, 1, 13, 'bon...', '2019-10-03 17:19:05', '2019-10-03 17:19:05'),
(41, 1, 1, 'bon...', '2019-10-03 17:22:20', '2019-10-03 17:22:20'),
(42, 1, 13, 'lol', '2019-10-03 17:22:40', '2019-10-03 17:22:40'),
(43, 1, 1, 'tu l\'a dit', '2019-10-03 17:22:53', '2019-10-03 17:22:53'),
(44, 1, 13, 'aller', '2019-10-03 17:25:33', '2019-10-03 17:25:33'),
(45, 1, 13, 'bon...', '2019-10-03 17:33:40', '2019-10-03 17:33:40'),
(46, 1, 13, 'peut être?', '2019-10-03 17:34:45', '2019-10-03 17:34:45'),
(47, 1, 13, 'ok...', '2019-10-03 17:35:33', '2019-10-03 17:35:33'),
(48, 1, 13, '...', '2019-10-03 17:36:18', '2019-10-03 17:36:18'),
(49, 1, 13, 'on y croit', '2019-10-03 17:37:06', '2019-10-03 17:37:06'),
(50, 1, 13, 'ok', '2019-10-03 17:38:01', '2019-10-03 17:38:01'),
(51, 1, 13, 'o0', '2019-10-03 17:38:58', '2019-10-03 17:38:58'),
(52, 1, 13, 'yes', '2019-10-03 17:40:10', '2019-10-03 17:40:10'),
(53, 1, 13, '?', '2019-10-03 17:44:13', '2019-10-03 17:44:13'),
(54, 1, 13, '\\o/', '2019-10-03 17:44:42', '2019-10-03 17:44:42'),
(55, 1, 13, 'let\'s do this', '2019-10-03 17:45:38', '2019-10-03 17:45:38'),
(56, 1, 13, 'oki', '2019-10-03 17:47:02', '2019-10-03 17:47:02'),
(57, 1, 1, 'yep', '2019-10-03 17:47:18', '2019-10-03 17:47:18'),
(58, 1, 13, 'reçu', '2019-10-03 17:47:36', '2019-10-03 17:47:36'),
(59, 1, 13, 'plusieurs', '2019-10-03 17:48:22', '2019-10-03 17:48:22'),
(60, 1, 13, 'messages', '2019-10-03 17:48:30', '2019-10-03 17:48:30'),
(61, 1, 13, 'à', '2019-10-03 17:48:35', '2019-10-03 17:48:35'),
(62, 1, 13, 'la', '2019-10-03 17:48:40', '2019-10-03 17:48:40'),
(63, 1, 13, 'chaine', '2019-10-03 17:48:46', '2019-10-03 17:48:46'),
(64, 1, 1, 'reçu', '2019-10-03 17:49:29', '2019-10-03 17:49:29'),
(65, 1, 13, 'autre test', '2019-10-03 17:52:34', '2019-10-03 17:52:34'),
(66, 1, 13, 'ok...', '2019-10-03 17:53:42', '2019-10-03 17:53:42'),
(67, 1, 13, 'bon...', '2019-10-03 17:54:14', '2019-10-03 17:54:14'),
(68, 1, 13, 'pry', '2019-10-03 17:54:44', '2019-10-03 17:54:44'),
(69, 1, 13, 'for your', '2019-10-03 17:55:57', '2019-10-03 17:55:57'),
(70, 1, 13, 'pride', '2019-10-03 17:56:09', '2019-10-03 17:56:09'),
(71, 1, 1, 'ça marche !!! \\o/', '2019-10-03 17:56:29', '2019-10-03 17:56:29'),
(72, 1, 17, 'alright', '2019-10-03 22:50:35', '2019-10-03 22:50:35'),
(73, 1, 1, 'salut le nouveau', '2019-10-03 22:50:50', '2019-10-03 22:50:50'),
(74, 1, 16, 'moi aussi je suis nouveau !', '2019-10-03 22:52:51', '2019-10-03 22:52:51'),
(75, 1, 1, 'bah salut à toi !', '2019-10-03 22:53:05', '2019-10-03 22:53:05'),
(76, 1, 16, 'l\'affichage est un peu buggé par contre (sur Opera)', '2019-10-03 22:54:05', '2019-10-03 22:54:05'),
(77, 1, 17, 'je confirme, sur Vivaldi aussi', '2019-10-03 22:54:19', '2019-10-03 22:54:19'),
(80, 1, 1, 'un peu plus clean\r\n[EDIT] lol', '2019-10-06 21:45:01', '2019-10-15 21:19:40'),
(81, 1, 1, 'great', '2019-11-06 18:27:21', '2019-11-06 18:27:21'),
(82, 1, 13, '?', '2019-11-06 18:28:28', '2019-11-06 18:28:28'),
(83, 1, 13, 'que se passe-t-il ?', '2019-11-06 18:43:24', '2019-11-06 18:43:24'),
(84, 1, 1, 'le nouveau système de notification fonctionne !', '2019-11-06 18:51:07', '2019-11-06 18:51:07'),
(85, 1, 13, 'Ah', '2019-11-06 18:52:50', '2019-11-06 18:52:50'),
(86, 1, 13, 'pas mal', '2019-11-06 18:53:18', '2019-11-06 18:53:18'),
(87, 1, 1, 'tavu', '2019-11-06 18:53:41', '2019-11-06 18:53:41'),
(88, 1, 1, 'Qu\'en penses-tu?', '2019-11-06 19:40:51', '2019-11-06 19:40:51'),
(89, 1, 13, 'vraiment cool', '2019-11-06 19:44:33', '2019-11-06 19:44:33'),
(90, 1, 1, 'merci :)', '2019-11-06 19:44:56', '2019-11-06 19:44:56'),
(91, 3, 13, 'Test', '2019-11-09 18:03:56', '2019-11-09 18:03:56');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_publication` datetime NOT NULL,
  `contenu_defaut` text NOT NULL,
  `contenu_FR` text NOT NULL,
  `contenu_EN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `type`, `date_publication`, `contenu_defaut`, `contenu_FR`, `contenu_EN`) VALUES
(4, 'succes', '2019-11-01 23:58:49', 'it\'s a success', 'c\'est un succès', 'it\'s a success'),
(7, 'succes', '2019-11-05 20:11:09', 'Test', '', ''),
(9, 'succes', '2019-11-05 20:27:09', 'J\'Y CROIS !', '', ''),
(27, 'succes', '2019-11-05 20:57:01', 'Le système de notification est maintenant pleinement fonctionnel !', '', ''),
(28, 'succes', '2019-11-06 19:57:24', 'test chat', '', ''),
(29, 'succes', '2019-11-06 20:02:19', 'test chat', '', ''),
(30, 'attention', '2019-11-29 21:05:13', 'Notif de test', '', ''),
(31, 'attention', '2019-11-29 21:06:17', 'encore une', '', ''),
(32, 'attention', '2019-11-29 21:14:03', 'une autre?', '', ''),
(33, 'attention', '2019-11-29 21:14:36', 'oui', '', '');

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
(99, 'membre', 'chat', 'supprimer_conversation'),
(100, 'admin', 'user', 'configurations'),
(101, 'membre', 'user', 'configurations'),
(102, 'guest', 'user', 'configurations'),
(103, 'admin', 'user', 'validation_configurations'),
(104, 'membre', 'user', 'validation_configurations'),
(105, 'guest', 'user', 'validation_configurations');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `id_auteur`, `titre`, `contenu`, `date_publication`, `date_mise_a_jour`) VALUES
(1, 1, 'Premier Post', 'Ce post est complétement écrit via l’interface PhpMyAdmin. Il s’agit de tester les fonctionnalités du site à l’aide d’un post exemple.\r\nC’est donc à la fois un post dont je suis sûr qu’il sera « historique », mais aussi utile ! Quoi de mieux donc, que de de créer ce magnifique post ?', '2019-08-01 00:32:15', '0000-00-00 00:00:00'),
(5, 1, 'Validation', 'Ce commentaire est écrit avec l’outil de publication de commentaire interne au site.\r\nIl s’agit d’une démonstration de ce système fantastique.\r\n[i][b][EDIT][/b]Je peux modifier ce post très facilement ![/i]', '2019-08-07 23:49:48', '2019-08-10 23:08:22'),
(6, 1, 'Test du BBCode', 'Le [b]BBCode[/b] est [u]maintenant[/u] [i]en action[/i] [s]sur le site [/s]!\r\n[float float=\"right\"][img src=\"https://images.unsplash.com/photo-1565448647285-a1493650c38c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80\"]Une belle image de galaxie[/img][/float]\r\n[url=https://qwant.com title=\"Le site de Qwant\"]Qwant[/url]\r\n[link url=https://qwant.com]\r\n[align align=\"left\"][list][*]test 1[/*]\r\n[*]test 2[/*][/list][/align]', '2019-08-10 19:34:30', '2019-08-11 16:02:34'),
(7, 1, 'Test', 'Test du site avec la nouvelle structure de [i]template[/i] interne', '2019-09-17 00:48:02', '2019-09-17 00:55:04');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mot_de_passe`, `avatar`, `date_inscription`, `date_connexion`, `banni`, `nom_role`, `mail`) VALUES
(1, 'gugus2000', '$2y$06$J4Ex0f9dGLmu0n5Aozj3Meey3qDOeGM6IG9hUBpvcK2ojPDoX2Jna', '3300c9d7942ada5e5d2cb4ac2a1c482e.png', '2019-06-29 02:32:26', '2019-12-01 17:17:02', 0, 'admin', 'gugus2000@protonmail.com'),
(6, 'test', '$2y$06$dm4Nq0Dr0KNgEiC/YbRggO8SbI0qFN/k6iRXWgPkoelGgzJicjnWa', '79f5084f6e333130c62a850627ad8b10.png', '2019-07-02 21:57:47', '2019-08-17 17:21:45', 0, 'membre', 'test@gmail.com'),
(12, 'guest', '$2y$06$n7vFJl8jWF7SPwHRM2X4IORku199OzsS6hZlR05BQBlGcHOFpJIpe', 'default.png', '2019-07-24 14:08:54', '2019-12-03 15:14:08', 0, 'guest', 'guest@example.com'),
(13, 'lapin', '$2y$06$iodWXLLCU9p4LuIcS3vyge05ExiJDz99WTbc0qSTT1nf2cMq54x7i', 'default.png', '2019-08-09 17:52:05', '2019-12-03 15:08:11', 0, 'membre', 'lapin@carotte.com'),
(16, 'saito', '$2y$06$alK3dk39XdjRbJe4O8C5euTgrdLkURZ.PLOMloODLoUrWFU.x1ITK', '6a146bb2561d18a1ec11c60d6fbaab21.jpg', '2019-10-03 22:31:05', '2019-12-03 15:14:00', 0, 'membre', 'znt@mail.ext'),
(17, 'vivaldi', '$2y$06$OUvJj0M.BpfhfpScQCRhDuO6XiV7Ho.7YGOkAfswbDIuoEwHP48/m', 'default.png', '2019-10-03 22:43:49', '2019-10-03 22:55:52', 0, 'membre', 'vivaldi'),
(30, 'allez', '$2y$06$WupXGnBERQjSIIOwckS0S.xuBgvzTPPAkIEv48zeyYLqDAQ0vbMiG', 'default.png', '2019-10-28 03:47:39', '2019-10-28 03:52:27', 0, 'membre', 'allez'),
(39, 'routage', '$2y$06$obNJYNNHQbRcsEPKd/QW9.pN.CtdHz5JVanvHTEvXP/hizcEJjSke', 'default.png', '2019-11-30 17:10:00', '2019-11-30 17:12:06', 0, 'membre', 'routing@example.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
