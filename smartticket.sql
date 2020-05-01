-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 18 juin 2018 à 11:31
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smartticket`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelleCategorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon_cat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelleCategorie`, `icon_cat`) VALUES
(2, 'Cinéma', 'camera.png'),
(4, 'Musique', 'microphone.png'),
(5, 'Féstivals', NULL),
(6, 'Sport', 'soccert.png'),
(7, 'Concert', 'band.png'),
(11, 'Théatre', 'theater.png');

-- --------------------------------------------------------

--
-- Structure de la table `classebillet`
--

CREATE TABLE `classebillet` (
  `id` int(11) NOT NULL,
  `evenement_id` int(11) DEFAULT NULL,
  `tarif` double NOT NULL,
  `classe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qntbillet` int(11) NOT NULL,
  `qntStock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `classebillet`
--

INSERT INTO `classebillet` (`id`, `evenement_id`, `tarif`, `classe`, `qntbillet`, `qntStock`) VALUES
(2, 8, 60, 'classe A', 40, 38),
(3, 8, 30, 'classe B', 60, 60),
(9, 29, 100, 'zone A', 40, 33),
(10, 29, 70, 'Zone B', 40, 40),
(14, 33, 15, 'Rangée F', 30, 8),
(15, 33, 30, 'Rangée L', 30, 16),
(16, 33, 50, 'Rangée H', 15, 13),
(21, 36, 20, 'Ticket', 60, 10),
(22, 37, 15, 'Rangée F', 30, 20),
(25, 20, 30, 'Ticket', 60, 57),
(27, 42, 35, 'Ticket', 60, 47),
(28, 37, 30, 'Rangée L', 30, 22),
(29, 37, 45, 'Rangée  H', 30, 30);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `usercomd_id` int(11) DEFAULT NULL,
  `payer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `reference`, `date`, `usercomd_id`, `payer`) VALUES
(1, '5afffd31636d6', '2018-05-19 12:32:17', 19, 0),
(2, '5b0166dfa93ba', '2018-05-20 14:15:27', 19, 0),
(3, '5b0167684d786', '2018-05-20 14:17:44', 19, 0),
(4, '5b0173ddea9ad', '2018-06-16 22:24:34', 10, 1),
(5, '5b017b53f3de8', '2018-06-16 22:25:01', 10, 1),
(6, '5b02a39bbd20c', '2018-06-16 20:31:39', 10, 1),
(7, '5b0429c56303b', '2018-05-22 16:31:33', 9, 0),
(8, '5b042b7268508', '2018-05-22 16:38:42', 9, 0),
(9, '5b0568b1c3a11', '2018-05-23 15:12:17', 10, 0),
(10, '5b056d6054d11', '2018-05-23 15:32:16', 10, 0),
(11, '5b0575764e8f9', '2018-05-23 16:06:46', 10, 0),
(12, '5b071f24e2eb2', '2018-05-24 22:23:00', 10, 0),
(13, '5b071f4010540', '2018-05-24 22:23:28', 10, 0),
(14, '5b071f8d0fe0e', '2018-05-24 22:24:45', 10, 0),
(15, '5b0723c2ef24d', '2018-05-24 22:42:42', 10, 0),
(16, '5b0724a87983b', '2018-05-24 22:46:32', 10, 0),
(17, '5b0727d817eeb', '2018-06-16 22:33:59', 10, 1),
(18, '5b086a2f4f5bc', '2018-05-25 21:55:27', 10, 0),
(19, '5b08c11aa1458', '2018-05-26 04:06:18', 10, 0),
(20, '5b093a0a1c745', '2018-05-26 12:42:18', 10, 0),
(21, '5b0974045cbb6', '2018-05-26 16:49:40', 10, 0),
(22, '5b0974c945991', '2018-05-26 16:52:57', 10, 0),
(23, '5b0974cb34548', '2018-05-26 16:52:59', 10, 0),
(24, '5b098b681d184', '2018-05-26 18:29:28', 10, 0),
(25, '5b098deeec5ea', '2018-06-16 22:35:22', 10, 1),
(26, '5b10ffb93059a', '2018-06-01 10:15:22', 10, 1),
(27, '5b1112c7c7e28', '2018-06-01 11:36:14', 10, 1),
(28, '5b11ca00a82ca', '2018-06-02 00:35:03', 10, 1),
(29, '5b11cea3dd1af', '2018-06-02 00:54:47', 10, 1),
(30, '5b11d3f1ce6b7', '2018-06-02 01:17:05', 10, 0),
(31, '5b127ec5c8e03', '2018-06-02 13:25:57', 10, 0),
(32, '5b12800c1ba28', '2018-06-02 13:31:24', 10, 0),
(33, '5b1285944e112', '2018-06-02 13:55:00', 10, 0),
(34, '5b128b4cafd9c', '2018-06-02 14:19:24', 10, 0),
(35, '5b128c1481c11', '2018-06-02 14:22:44', 10, 0),
(36, '5b129e4e9a80a', '2018-06-02 15:40:30', 10, 0),
(37, '5b14098d02e82', '2018-06-03 17:35:38', 10, 1),
(38, '5b140e0fdd642', '2018-06-03 17:49:35', 10, 0),
(39, '5b14120a0f7f4', '2018-06-03 18:09:03', 10, 1),
(40, '5b142037b00da', '2018-06-03 19:08:32', 10, 1),
(41, '5b1678ca7c802', '2018-06-05 13:49:30', 10, 0),
(42, '5b17d52a0577d', '2018-06-06 14:35:54', 10, 0),
(43, '5b1cdf2c4b8d5', '2018-06-10 10:20:20', 10, 1),
(44, '5b1d536dc1ded', '2018-06-10 18:36:25', 10, 1),
(45, '5b1d5982ee939', '2018-06-10 19:02:28', 10, 1),
(46, '5b1d5ad94e90a', '2018-06-10 19:08:06', 10, 1),
(47, '5b1e9c8e894de', '2018-06-11 18:00:43', 10, 1),
(48, '5b1ea19a109cd', '2018-06-11 18:22:15', 10, 1),
(49, '5b1eaa8fc1bcb', '2018-06-11 19:00:19', 10, 1),
(50, '5b1eb3b72a2af', '2018-06-11 19:39:22', 10, 1),
(51, '5b1eb48234d7f', '2018-06-11 19:42:43', 10, 1),
(52, '5b1ebbb11955a', '2018-06-11 20:13:23', 10, 1),
(53, '5b1ebcdcf28cb', '2018-06-11 20:18:21', 10, 1),
(54, '5b1ebfeccaa3a', '2018-06-11 20:31:39', 20, 1),
(55, '5b1ec177e9fbc', '2018-06-11 20:38:01', 20, 1),
(56, '5b1ec2a359766', '2018-06-11 20:42:59', 20, 1),
(57, '5b1ec32cc60f5', '2018-06-11 20:45:16', 20, 1),
(58, '5b1ec4b7e01d3', '2018-06-11 20:52:00', 20, 1),
(59, '5b1ed228da6bc', '2018-06-11 21:49:17', 20, 1),
(60, '5b1edcfac9b57', '2018-06-11 22:35:38', 20, 1),
(61, '5b1f01b5d8b30', '2018-06-12 01:12:11', 20, 1),
(62, '5b205139283d2', '2018-06-13 01:03:48', 10, 1),
(63, '5b205487b45f4', '2018-06-13 01:17:56', 10, 1),
(64, '5b205576e8593', '2018-06-13 01:21:58', 10, 1),
(65, '5b2056fd67aed', '2018-06-16 22:53:22', 10, 1),
(66, '5b2057eb4bae4', '2018-06-13 01:32:21', 10, 1),
(67, '5b205e1ab8538', '2018-06-16 22:37:04', 10, 1),
(68, '5b20603975173', '2018-06-16 22:37:21', 10, 1),
(69, '5b2197ad81f4c', '2018-06-15 16:38:42', 18, 1),
(70, '5b219b64047d1', '2018-06-15 16:38:56', 18, 1),
(71, '5b219f9fb25ca', '2018-06-14 00:50:29', 18, 1),
(72, '5b21a3b905eef', '2018-06-15 19:46:35', 18, 1),
(73, '5b21a5fe6b88d', '2018-06-14 01:17:46', 18, 1),
(74, '5b21a72cc01d9', '2018-06-14 01:22:42', 18, 1),
(75, '5b21a89e142ea', '2018-06-14 01:29:00', 18, 1),
(76, '5b21a98acd5ca', '2018-06-15 15:04:36', 18, 1),
(77, '5b21ac434b1e0', '2018-06-14 01:44:25', 18, 1),
(78, '5b21ad976707b', '2018-06-14 01:50:13', 18, 1),
(79, '5b21d02d2cde4', '2018-06-14 04:18:10', 18, 1),
(80, '5b21d413a6f48', '2018-06-14 04:34:17', 18, 1),
(81, '5b22251421c2d', '2018-06-14 10:20:01', 18, 1),
(82, '5b22e80e694f6', '2018-06-15 00:12:00', 18, 1),
(83, '5b22f62503f17', '2018-06-15 01:14:32', 18, 1),
(84, '5b22f90ba313b', '2018-06-15 01:24:26', 18, 1),
(85, '5b22fb2aeb58d', '2018-06-15 01:33:25', 18, 1),
(86, '5b239a5b62584', '2018-06-15 12:52:42', 18, 1),
(87, '5b239d5068713', '2018-06-15 13:05:22', 18, 1),
(88, '5b23d40a18562', '2018-06-15 16:58:18', 18, 0),
(89, '5b27052b9b96c', '2018-06-18 03:33:45', 23, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreationCommentaire` datetime DEFAULT NULL,
  `evenement_id` int(11) DEFAULT NULL,
  `usercoment_id` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `content`, `dateCreationCommentaire`, `evenement_id`, `usercoment_id`, `note`) VALUES
(3, 'tres intéressant', '2018-05-12 14:07:25', 29, 13, 4),
(8, 'evenement n\'est pas attractif c\'est vraiment ennuyant', '2018-06-09 23:23:44', 33, 18, 1),
(14, 'tres intéressant', '2018-06-09 23:57:56', 37, 13, 3),
(15, 'événement inoubliable , car  l\'ambiance est chaleureuse', '2018-06-11 00:25:57', 37, 10, 4),
(16, 'événement inoubliable , car l\'ambiance est chaleureuse', '2018-06-11 00:44:44', 36, 10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `objet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `element_cmd`
--

CREATE TABLE `element_cmd` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `classebillet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `element_cmd`
--

INSERT INTO `element_cmd` (`id`, `quantite`, `commande_id`, `classebillet_id`) VALUES
(7, 2, 2, 2),
(9, 1, 2, 9),
(13, 1, 5, 9),
(14, 1, 5, 10),
(15, 1, 6, 9),
(16, 2, 6, 10),
(20, 1, 7, 10),
(23, 1, 8, 9),
(24, 2, 8, 10),
(25, 2, 9, 9),
(26, 3, 9, 10),
(27, 2, 11, 9),
(28, 2, 11, 10),
(32, 1, 15, 9),
(33, 3, 15, 10),
(34, 1, 17, 9),
(35, 2, 17, 10),
(36, 2, 18, 9),
(37, 5, 18, 10),
(38, 2, 19, 9),
(39, 2, 19, 10),
(40, 1, 20, 2),
(41, 2, 20, 3),
(42, 1, 21, 9),
(43, 2, 21, 10),
(44, 2, 24, 2),
(45, 1, 24, 3),
(48, 2, 27, 2),
(49, 1, 27, 3),
(50, 1, 27, 9),
(51, 2, 27, 10),
(52, 1, 28, 9),
(53, 0, 28, 10),
(60, 1, 31, 9),
(61, 0, 31, 10),
(65, 2, 33, 9),
(66, 0, 33, 10),
(67, 5, 34, 9),
(68, 0, 34, 10),
(70, 5, 36, 9),
(73, 2, 38, 14),
(75, 6, 39, 21),
(78, 1, 40, 22),
(81, 2, 42, 21),
(82, 2, 43, 27),
(85, 2, 46, 27),
(86, 2, 47, 21),
(87, 3, 48, 21),
(88, 2, 49, 22),
(89, 2, 50, 21),
(90, 2, 51, 21),
(91, 2, 52, 21),
(92, 2, 53, 22),
(93, 3, 53, 28),
(94, 1, 54, 22),
(95, 2, 54, 27),
(96, 1, 55, 21),
(97, 3, 56, 14),
(98, 3, 57, 27),
(99, 1, 58, 21),
(100, 2, 59, 21),
(101, 1, 60, 14),
(102, 2, 60, 21),
(103, 2, 61, 14),
(104, 2, 62, 21),
(105, 2, 63, 21),
(106, 2, 64, 21),
(107, 3, 65, 25),
(108, 2, 66, 14),
(109, 2, 66, 15),
(110, 2, 67, 14),
(111, 2, 67, 15),
(112, 2, 68, 14),
(113, 2, 68, 15),
(114, 2, 69, 21),
(115, 2, 70, 9),
(116, 2, 71, 21),
(117, 2, 72, 15),
(118, 2, 73, 21),
(119, 2, 74, 21),
(120, 2, 75, 21),
(121, 2, 76, 21),
(122, 2, 77, 21),
(123, 2, 78, 21),
(124, 1, 79, 22),
(125, 2, 79, 28),
(126, 2, 80, 22),
(127, 1, 80, 28),
(128, 1, 81, 22),
(129, 1, 81, 27),
(130, 2, 81, 28),
(131, 2, 82, 14),
(132, 2, 82, 15),
(133, 2, 83, 14),
(134, 1, 83, 15),
(135, 2, 84, 14),
(136, 1, 84, 15),
(137, 2, 85, 15),
(138, 2, 85, 16),
(139, 2, 86, 2),
(140, 2, 87, 14),
(141, 1, 88, 21),
(142, 2, 88, 27),
(143, 2, 89, 21),
(144, 1, 89, 27);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `titreEvenement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lieuEvenement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateDebutEvenement` date NOT NULL,
  `dateFinEvenement` date NOT NULL,
  `heureDebutEvenement` time NOT NULL,
  `heureFinEvenement` time NOT NULL,
  `descriptionEvenement` longtext COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `dateCreationEvenement` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `vues` int(11) DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noteGlobale` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `titreEvenement`, `path`, `lieuEvenement`, `dateDebutEvenement`, `dateFinEvenement`, `heureDebutEvenement`, `heureFinEvenement`, `descriptionEvenement`, `user_id`, `dateCreationEvenement`, `status`, `categorie_id`, `vues`, `ville`, `noteGlobale`) VALUES
(8, 'FESTIVAL DU RAP TUNISIEN', 'Affich385x235.jpg', 'Coupole De Rades', '2018-04-04', '2018-04-06', '18:00:00', '20:00:00', '<p>FESTIVAL DU RAP TUNISIEN M&amp;M com events lance le festival du Rap tunisien, avec une panoplie de stars confirm&eacute;s et adul&eacute;es par des millions de fans; les meilleurs rappeurs et Dj pour 4 heures de musique non Stop dans la coupole de elmenzeh , les billets en ligne sur teskerti.tn et traveltodo ,ainsi que les pdv ,coupole d\'elMenzah,,cin&eacute;ma le colis&eacute;e , salon de th&eacute; 716 infoline</p>', 10, '2018-04-02 20:12:53', '1', 5, 67, 'Sfax', NULL),
(16, 'CONVERSATION', 'H.jpg', 'Salle Carthage 1 Carthage Thalasso Resort', '2018-04-14', '2018-04-16', '16:30:00', '18:30:00', 'CONVERSATION : OMAR EL OUAER & YASMINE AZAIEZ , HELWESS : NOUR HARKATI & AYT\r\n\r\nNée en 1988, Yasmine Azaiez violoniste tunisienne a commencé le violon à Londres à l’âge de 4 ans avec Helen Brunner selon la méthode Suzuki.\r\nEn Mars 2006 à l’âge de 17 ans', 13, '2018-04-05 14:36:48', '0', 4, 4, 'Monastir', NULL),
(20, 'JALEN N’GONDA , AMADOU & MARIAM', 'motherland-1688-95242145614-original-e1519037874837.jpg', 'Salle Carthage 1 Carthage ', '2018-04-06', '2018-04-08', '18:30:00', '20:00:00', 'Né dans le Maryland, Jalen N’Gonda a choisi Liverpool comme terre d’accueil afin de s’épanouir en tant que musicien. Il s’intéresse à la musique à l’âge de 11 ans, en fouillant dans la collection d’albums Jazz, Hip Hop et Soul de son père. Quelques années', 11, '2018-04-05 17:22:26', '1', 7, 7, 'Bizerte', NULL),
(26, 'GHALIA BEN ALI', 'Banner.jpg', 'Le Carpe Diem', '2018-06-02', '2018-06-30', '22:09:10', '03:08:11', 'Ghalia Benali a grandi en Tunisie entourée non seulement des icônes de la musique du moyen orient mais aussi de la chanson française, des musiques de films indiens et de la poésie arabe. Ce sont les fondements de sa carrière musicale.', 15, '2018-05-03 09:00:00', '0', 2, 5, 'Tunis', NULL),
(29, 'FESTIVAL EL KAADA', 'unnamed-file.jpeg', 'kantawi', '2018-05-26', '2018-05-30', '16:00:00', '20:00:00', '<p>Le festival El Kaada Ramadan 2018 vous donne la possibilit&eacute; de&nbsp;b&eacute;n&eacute;ficier d&rsquo;un abonnement pour les 4 Soir&eacute;es anim&eacute;es :\r\n26 Mai 2018 ( Hedi Donia &amp; Alianza Live Band )\r\n</p>', 18, '2018-05-17 12:29:48', '1', 5, 36, 'Sousse', NULL),
(33, 'AU SUIVANT', '0ac89787d3e9b708a7f415f633bf6dc3bae9be73.jpeg', 'Rio', '2018-06-25', '2018-07-03', '18:30:00', '20:30:00', '<p>Au suivant<br />Le voyage au c&oelig;ur du monde magique du Kafichata des ann&eacute;es 60<br />Le spectacle incontournable de Ramadan 2018<br />&laquo; Au suivant &raquo; : Com&eacute;die musicale grin&ccedil;ante qui se passe dans un caf&eacute; chan', 10, '2018-06-02 19:47:24', '1', 2, 22, 'Tunis', NULL),
(36, 'FI RIHAB EL 3ACHKIN', 'df2236a0ab992489b456557c585fb540db607416.jpeg', 'Le Palais des congrés', '2018-07-04', '2018-07-07', '18:30:00', '12:00:00', '<p><em>Afin d\'afficher les r&eacute;sultats les plus pertinents, nous avons omis quelques entr&eacute;es qui sont tr&egrave;s similaires aux 10&nbsp;entr&eacute;es actuelles.</em></p>', 10, '2018-06-02 20:24:13', '1', 4, 35, 'Mahdia', NULL),
(37, 'HADHRET RJEL TOUNES', '81165601ec0fdf68be084abc0df9c0dffc01bd78.jpeg', 'Théâtre Moncef Korot', '2018-06-29', '2018-07-03', '20:30:00', '22:30:00', '<p>Zone El Mourouj - Banlieue sud : 90 707 707<br />Zone Bardo - Manar: 94 207 204<br />Zone Ariana - Manzah - centre urbain nord: 98 411 212 / 98 411 217 / 98 411 215<br />Zone Cit&eacute; el Khadhra - Charguia : 97 957 333</p>', 10, '2018-06-02 20:35:33', '1', 7, 8, 'nabeul', 0),
(42, 'JAZZ Le KEF', 'dbcb77614550517225ac0aee5e314e949469bae5.png', 'Kassba', '2018-06-30', '2018-07-01', '18:30:00', '20:30:00', '<p>Le &laquo;Tunisia Siccaveneria international Jazz Festival- Sicca Jazz&raquo; aura lieu cette ann&eacute;e sous le slogan de &laquo;The road to Jugurtha&raquo;, la grande mesa se pla&ccedil;ant comme &eacute;tant la destination attractive de la r&eacute;gion pour cette 4&egrave;me &eacute;dition du festival.</p>\r\n<h4>La musique pour la pr&eacute;servation du patrimoine culturel immat&eacute;riel</h4>\r\n<p>Depuis 2015, des dizaines d&rsquo;artistes nationaux et internationaux ont cr&eacute;&eacute; l&rsquo;&eacute;v&eacute;nement dans la ville du Kef &agrave; travers le projet de ce Festival de Jazz unique en son genre.</p>\r\n<p>D&rsquo;Anouar Brahem &agrave; Iyeoka, en passant par Paco Sery et Rabih Abou Khalil ou encore Omar El Ouaer, le public venus des quatre coins du pays et m&ecirc;me de l&rsquo;&eacute;tranger a pu appr&eacute;cier des spectacles, des show cases, des expositions et des masterclasses de qualit&eacute; dans des lieux aussi prestigieux qu&rsquo;inattendus. Cette ann&eacute;e encore, l&rsquo;&eacute;quipe du festival r&eacute;it&egrave;re l&rsquo;exp&eacute;rience avec un programme plus dense et plus riche s&rsquo;&eacute;talant sur une semaine durant le mois de mars.</p>', 18, '2018-05-24 22:47:24', '1', 5, 13, 'Le Kef', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateCreationCompte` datetime DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `prenom`, `adresse`, `dateCreationCompte`, `tel`, `path`) VALUES
(9, 'ghazouani', 'ghazouani', 'chaimaghazouani3@gmail.com', 'chaimaghazouani3@gmail.com', 1, '7cv5yo8n4akgckwo4gsok8g0so4cgko', '$2y$13$7cv5yo8n4akgckwo4gsokuNXyCM7lleXb2mKVXK2ToVHI/Ph0uyYq', '2018-06-17 22:06:13', 0, 0, NULL, 'RyKVZrHIUgrw_OOYst0SrH4ZSCye0gW3IRM00lNdFg0', '2018-04-30 10:13:41', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 0, NULL, 'chaima', 'Oued Elil Manouba', '2018-05-03 19:13:06', 50122530, 'profile.png'),
(10, 'chaima', 'chaima', 'chaima@gmail.com', 'chaima@gmail.com', 1, 'ntv4d7pblnkkowcws8k8g8wgsckcc8o', '$2y$13$ntv4d7pblnkkowcws8k8guCbnGNokDnvP2sXnJx8szwdSLA4QBrCm', '2018-06-18 11:31:03', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'chaima', 'Manouba', '2018-04-19 10:13:13', 25302730, '8cebcd9d2f516df37630100a1efccbe3e6b682c4.png'),
(11, 'asma', 'asma', 'asma@gmail.com', 'asma@gmail.com', 1, 'ikbirc7ehq0wko4g04kc84c8wsg8484', '$2y$13$ikbirc7ehq0wko4g04kc8u7LdsGH8vwPEbMMN9D0ytIKyK7ojAIsO', '2018-06-15 23:03:30', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'nouri', 'tunis', '2018-04-02 13:26:17', 97253654, 'ff0c6f86236eb21f3c12f89f8cffebeedcc75d8d.png'),
(13, 'wissem', 'wissem', 'wissem@gmail.com', 'wissem@gmail.com', 1, '8h7mqgtk2y4oksgg0wo40swg80kc8o4', '$2y$13$8h7mqgtk2y4oksgg0wo40eVRGbjznOuvj.awsinTen5xnToHDrRIi', '2018-06-12 10:20:49', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'alouane', 'Sousse', '2018-04-12 00:00:00', 96235485, '112797223614390a9807b2b4219fa37cc6e55610.png'),
(14, 'mariem', 'mariem', 'mariem@gmail.com', 'mariem@gmail.com', 1, '51f4zooi4xgcs8k0wksscskcwok8o8s', '$2y$13$51f4zooi4xgcs8k0wkssceveyL7sA1hsT7dfmtqAxCEku1cVJlkLe', '2018-05-12 12:15:14', 1, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'mariem', 'tunis', '2018-04-25 00:00:00', 50126932, 'profile.png'),
(15, 'intissar', 'intissar', 'intissar@gmail.com', 'intissar@gmail.com', 1, 'n37tk9ulbuo4ww400kwgkkcwwgwsgwo', '$2y$13$n37tk9ulbuo4ww400kwgkeeguw3q806jKOnTh6VRqJ1drsVACPgtO', '2018-05-08 02:51:04', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'intissar', 'safex', '2018-05-16 00:00:00', 22036598, 'profile.png'),
(17, 'alouane', 'alouane', 'aloune@gmail.com', 'aloune@gmail.com', 1, 'efs7j78flvcwkccs4404w8gos8scg0o', '$2y$13$efs7j78flvcwkccs4404wuHy/uKl.FgSPD4RvptM8EfwfX9v7bpG6', '2018-05-08 02:52:59', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'wissem', 'Ghazela Araina', '2018-06-03 00:00:00', 23052154, 'profile.png'),
(18, 'nada', 'nada', 'ghazouaninada02@gmail.com', 'ghazouaninada02@gmail.com', 1, '9x9g9kkixe880o04o4c0oswc0sckskg', '$2y$13$9x9g9kkixe880o04o4c0oeIEUNzT67E6pHfqN5h8btWDjIbEhZVaK', '2018-06-17 22:21:44', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'ghazouani', 'ghzela', '2018-06-08 00:00:00', 21000000, '0341cc02589c54330cfcabb8909b6a31108dabee.png'),
(19, 'nemri', 'nemri', 'nournemri@gmail.com', 'nournemri@gmail.com', 1, 'nxoxiz1ozhw8skc4884gsgcskc04cok', '$2y$13$nxoxiz1ozhw8skc4884gseOWSq9.Vh4C9wRe4oAXW5ZPcoHJoYUPW', '2018-05-18 19:01:14', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'nour', 'hawria', '2018-05-18 00:00:00', 27369852, 'profile.png'),
(20, 'mejri', 'mejri', 'mejri@gmail.com', 'mejri@gmail.com', 1, 'qm3e9ebfkc0o8ogw0wog4s4kcockkk8', '$2y$13$qm3e9ebfkc0o8ogw0wog4e1sYeHaiImC4nwlvCYMSbErSZ3xjqbpe', '2018-06-11 20:20:41', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'molka', 'tunis', '2018-05-16 00:00:00', 27857452, 'd371c53852e224faaa16bd51d3261e33a38143da.png'),
(21, 'nibrass', 'nibrass', 'nibrass@gmail.com', 'nibrass@gmail.com', 1, 'c7kgepb5se8008gs0ks8w0sww4koscw', '$2y$13$c7kgepb5se8008gs0ks8wuQM8oD2pRWnU/jzRQBzneVGJLW5WKsry', NULL, 1, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'nibrass', 'jandouba', '2018-06-12 00:00:00', 25632154, 'profile.png'),
(22, 'Ghaz', 'ghaz', 'Malika@gmail.com', 'malika@gmail.com', 1, 'm27arrir5g0c8ggk0o08sgwwc0sc000', '$2y$13$m27arrir5g0c8ggk0o08sefkqrWmYesLEeSWSz/iutcTy53xqaOb6', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Malika', 'Manouba', '2018-06-05 00:00:00', 94036251, '1dccc6ee2568fc64a4b712c8bc80187055fcd131.jpeg'),
(23, 'kouki', 'kouki', 'badreddinekouki11@hotmail.com', 'badreddinekouki11@hotmail.com', 1, 'c9ywguob70g0kggww4g0ckgwco0gkos', '$2y$13$c9ywguob70g0kggww4g0ceu8mjL2ld4oeYoIso231osgqwaMbctO2', '2018-06-18 02:56:28', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'badr', NULL, NULL, 23125896, 'profile.png');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `active`) VALUES
(1, 'a@gmail.com', '1'),
(2, 'sweet.ammouna@hotmail.com', ''),
(3, 'ali@gmail.com', '1'),
(4, 'flen@gmail.com', '1');

-- --------------------------------------------------------

--
-- Structure de la table `temoignage`
--

CREATE TABLE `temoignage` (
  `id` int(11) NOT NULL,
  `usertemg_id` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreationtemoignage` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `temoignage`
--

INSERT INTO `temoignage` (`id`, `usertemg_id`, `content`, `dateCreationtemoignage`) VALUES
(1, 10, 'partique, complet, simple d\'utlisation, personalisable, Bref, parfait! ', '2018-05-10 00:00:00'),
(3, 13, 'SmartTicket est un outil essentiel dans l\'organisation de la finale réginale de notre concours de chant. Au delà d\'un simple soutien, le site propose tout un panel de possibilité permettant la vente en ligne de places, la visiblité de l\'événement.', '2018-05-08 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateGeneration` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elementcmd_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id`, `reference`, `dateGeneration`, `status`, `elementcmd_id`) VALUES
(1, 'ytlkkn', '2018-06-16 00:00:00', '', 15),
(2, 'azerrtyu', '2018-06-16 12:30:00', '0', 14),
(4, 'azerrtyu', '2018-06-16 12:30:00', '0', 14),
(5, '5b22f6d859968', '2018-06-15 01:14:32', '0', 133),
(6, '5b22f6d8ee7da', '2018-06-15 01:14:32', '0', 133),
(7, '5b22f6d8ef75a', '2018-06-15 01:14:32', '0', 134),
(8, '5b22f92a7a958', '2018-06-15 01:24:26', '0', 135),
(9, '5b22f92aad81f', '2018-06-15 01:24:26', '0', 135),
(10, '5b22f92aae8a1', '2018-06-15 01:24:26', '0', 136),
(11, '5b22fb45f218d', '2018-06-15 01:33:25', '0', 137),
(12, '5b22fb4a37b23', '2018-06-15 01:33:30', '0', 137),
(13, '5b22fb4a39009', '2018-06-15 01:33:30', '0', 138),
(14, '5b22fb4a3a8ad', '2018-06-15 01:33:30', '0', 138),
(15, '5b239a7abecd6', '2018-06-15 12:52:42', '0', 139),
(16, '5b239a8221542', '2018-06-15 12:52:50', '0', 139),
(17, '5b239d728f6a9', '2018-06-15 13:05:22', '0', 140),
(18, '5b239d746eb20', '2018-06-15 13:05:24', '0', 140),
(19, '5b23a754c4ee3', '2018-06-15 13:47:32', '0', 114),
(20, '5b23a7565afa9', '2018-06-15 13:47:34', '0', 114),
(21, '5b23a780b4831', '2018-06-15 13:48:16', '0', 115),
(22, '5b23a7821ede7', '2018-06-15 13:48:18', '0', 115),
(23, '5b23a7938e4d4', '2018-06-15 13:48:35', '0', 117),
(24, '5b23a794ef60b', '2018-06-15 13:48:36', '0', 117),
(25, '5b23b964d94eb', '2018-06-15 15:04:36', '0', 121),
(26, '5b23b966298da', '2018-06-15 15:04:38', '0', 121),
(27, '5b23cf72a15e3', '2018-06-15 16:38:42', '0', 114),
(28, '5b23cf73e4062', '2018-06-15 16:38:43', '0', 114),
(29, '5b23cf8051c0b', '2018-06-15 16:38:56', '0', 115),
(30, '5b23cf81327a5', '2018-06-15 16:38:57', '0', 115),
(31, '5b23fb7bb5611', '2018-06-15 19:46:35', '0', 117),
(32, '5b23fb8177401', '2018-06-15 19:46:41', '0', 117),
(33, '5b25500d6822a', '2018-06-16 19:59:41', '0', 13),
(34, '5b2550298d732', '2018-06-16 20:00:09', '0', 13),
(35, '5b25550438ede', '2018-06-16 20:20:52', '0', 15),
(36, '5b255505ad351', '2018-06-16 20:20:53', '0', 15),
(37, '5b255505b007f', '2018-06-16 20:20:53', '0', 15),
(38, '5b255505b27a0', '2018-06-16 20:20:53', '0', 15),
(39, '5b255505b61b8', '2018-06-16 20:20:53', '0', 15),
(40, '5b255505b93c0', '2018-06-16 20:20:53', '0', 15),
(41, '5b255505bbd51', '2018-06-16 20:20:53', '0', 15),
(42, '5b255505be77d', '2018-06-16 20:20:53', '0', 15),
(43, '5b255505c25a3', '2018-06-16 20:20:53', '0', 15),
(44, '5b255505c5b35', '2018-06-16 20:20:53', '0', 15),
(45, '5b255505ca68b', '2018-06-16 20:20:53', '0', 15),
(46, '5b255505cdf21', '2018-06-16 20:20:53', '0', 15),
(47, '5b255505d135f', '2018-06-16 20:20:53', '0', 15),
(48, '5b255505d36cc', '2018-06-16 20:20:53', '0', 15),
(49, '5b255505d5c1d', '2018-06-16 20:20:53', '0', 15),
(50, '5b255505d8878', '2018-06-16 20:20:53', '0', 15),
(51, '5b255505da7c9', '2018-06-16 20:20:53', '0', 15),
(52, '5b255505dcbe0', '2018-06-16 20:20:53', '0', 15),
(53, '5b255505df6c8', '2018-06-16 20:20:53', '0', 15),
(54, '5b255505e18b1', '2018-06-16 20:20:53', '0', 15),
(55, '5b255505e38c6', '2018-06-16 20:20:53', '0', 15),
(56, '5b255505e6229', '2018-06-16 20:20:53', '0', 15),
(57, '5b255505e8c2f', '2018-06-16 20:20:53', '0', 15),
(58, '5b255505eaa26', '2018-06-16 20:20:53', '0', 15),
(59, '5b255505ec8e2', '2018-06-16 20:20:53', '0', 15),
(60, '5b255505ef919', '2018-06-16 20:20:53', '0', 15),
(61, '5b255505f3a2f', '2018-06-16 20:20:53', '0', 15),
(62, '5b25550601ccb', '2018-06-16 20:20:54', '0', 15),
(63, '5b25550606564', '2018-06-16 20:20:54', '0', 15),
(64, '5b25550609095', '2018-06-16 20:20:54', '0', 15),
(65, '5b2555060bd0c', '2018-06-16 20:20:54', '0', 15),
(66, '5b2555060f9c4', '2018-06-16 20:20:54', '0', 15),
(67, '5b2555061281c', '2018-06-16 20:20:54', '0', 15),
(68, '5b25550614993', '2018-06-16 20:20:54', '0', 15),
(69, '5b255506177a5', '2018-06-16 20:20:54', '0', 15),
(70, '5b2555061bfaa', '2018-06-16 20:20:54', '0', 15),
(71, '5b2555061fa38', '2018-06-16 20:20:54', '0', 15),
(72, '5b25550622c32', '2018-06-16 20:20:54', '0', 15),
(73, '5b25550625704', '2018-06-16 20:20:54', '0', 15),
(74, '5b25550628b10', '2018-06-16 20:20:54', '0', 15),
(75, '5b2555062bf97', '2018-06-16 20:20:54', '0', 15),
(76, '5b2555062f19f', '2018-06-16 20:20:54', '0', 15),
(77, '5b25578bdb136', '2018-06-16 20:31:39', '0', 15),
(78, '5b25578c7aa34', '2018-06-16 20:31:40', '0', 15),
(79, '5b25578c7bdd8', '2018-06-16 20:31:40', '0', 15),
(80, '5b25578c7ca4f', '2018-06-16 20:31:40', '0', 15),
(81, '5b25578c7d683', '2018-06-16 20:31:40', '0', 15),
(82, '5b25578c7e2e2', '2018-06-16 20:31:40', '0', 15),
(83, '5b25578c7f010', '2018-06-16 20:31:40', '0', 15),
(84, '5b25578c7fc52', '2018-06-16 20:31:40', '0', 15),
(85, '5b25578c80816', '2018-06-16 20:31:40', '0', 15),
(86, '5b25578c813e8', '2018-06-16 20:31:40', '0', 15),
(87, '5b25578c81fb8', '2018-06-16 20:31:40', '0', 15),
(88, '5b25578c82b83', '2018-06-16 20:31:40', '0', 15),
(89, '5b25578c83f3f', '2018-06-16 20:31:40', '0', 15),
(90, '5b25578c84c88', '2018-06-16 20:31:40', '0', 15),
(91, '5b25578c8588e', '2018-06-16 20:31:40', '0', 15),
(92, '5b25578c86552', '2018-06-16 20:31:40', '0', 15),
(93, '5b25578c87499', '2018-06-16 20:31:40', '0', 15),
(94, '5b25578c884cc', '2018-06-16 20:31:40', '0', 15),
(95, '5b25578c8911f', '2018-06-16 20:31:40', '0', 15),
(96, '5b25578c89efe', '2018-06-16 20:31:40', '0', 15),
(97, '5b25578c8acd6', '2018-06-16 20:31:40', '0', 15),
(98, '5b25578c8baf9', '2018-06-16 20:31:40', '0', 15),
(99, '5b25578c8c70d', '2018-06-16 20:31:40', '0', 15),
(100, '5b25578c8d2cb', '2018-06-16 20:31:40', '0', 15),
(101, '5b25578c8de7d', '2018-06-16 20:31:40', '0', 15),
(102, '5b25578c8eb28', '2018-06-16 20:31:40', '0', 15),
(103, '5b25578c8fb87', '2018-06-16 20:31:40', '0', 15),
(104, '5b25578c90820', '2018-06-16 20:31:40', '0', 15),
(105, '5b25578c9148c', '2018-06-16 20:31:40', '0', 15),
(106, '5b25578c9208e', '2018-06-16 20:31:40', '0', 15),
(107, '5b25578c92c98', '2018-06-16 20:31:40', '0', 15),
(108, '5b25578c93c98', '2018-06-16 20:31:40', '0', 15),
(109, '5b25578c94bd3', '2018-06-16 20:31:40', '0', 15),
(110, '5b25578c95816', '2018-06-16 20:31:40', '0', 15),
(111, '5b25578c963fc', '2018-06-16 20:31:40', '0', 15),
(112, '5b25578c96fb8', '2018-06-16 20:31:40', '0', 15),
(113, '5b25578c97de2', '2018-06-16 20:31:40', '0', 15),
(114, '5b25578c98a08', '2018-06-16 20:31:40', '0', 15),
(115, '5b25578c999d6', '2018-06-16 20:31:40', '0', 15),
(116, '5b25578c9a681', '2018-06-16 20:31:40', '0', 15),
(117, '5b25578c9b250', '2018-06-16 20:31:40', '0', 15),
(118, '5b25578c9c3b1', '2018-06-16 20:31:40', '0', 15),
(119, '5b2557999d67f', '2018-06-16 20:31:53', '0', 13),
(120, '5b2557abe6f3e', '2018-06-16 20:32:11', '0', 13),
(121, '5b2557d7ae6ae', '2018-06-16 20:32:55', '0', 34),
(122, '5b25721e7dc8f', '2018-06-16 22:25:02', '0', 13),
(123, '5b25743780f30', '2018-06-16 22:33:59', '0', 34),
(124, '5b2574f0b0b0e', '2018-06-16 22:37:04', '0', 110),
(125, '5b2574f213a3e', '2018-06-16 22:37:06', '0', 110),
(126, '5b2574f21648a', '2018-06-16 22:37:06', '0', 111),
(127, '5b2574f2199e0', '2018-06-16 22:37:06', '0', 111),
(128, '5b257501b875c', '2018-06-16 22:37:21', '0', 112),
(129, '5b2575030cd3e', '2018-06-16 22:37:23', '0', 112),
(130, '5b2575030ee38', '2018-06-16 22:37:23', '0', 113),
(131, '5b25750312209', '2018-06-16 22:37:23', '0', 113),
(132, '5b25751005a9f', '2018-06-16 22:37:36', '0', 107),
(133, '5b2575114e54a', '2018-06-16 22:37:37', '0', 107),
(134, '5b257511511b1', '2018-06-16 22:37:37', '0', 107),
(135, '5b2578c2cf999', '2018-06-16 22:53:22', '0', 107),
(136, '5b2578c46718e', '2018-06-16 22:53:24', '0', 107),
(137, '5b2578c46a215', '2018-06-16 22:53:24', '0', 107),
(138, '5b27059e729bd', '2018-06-18 03:06:38', '0', 143),
(139, '5b2705a44bdf4', '2018-06-18 03:06:44', '0', 143),
(140, '5b2705a44de06', '2018-06-18 03:06:44', '0', 144),
(141, '5b270bf98eb9f', '2018-06-18 03:33:45', '0', 143),
(142, '5b270bfaa0515', '2018-06-18 03:33:46', '0', 143),
(143, '5b270bfaa2648', '2018-06-18 03:33:46', '0', 144);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classebillet`
--
ALTER TABLE `classebillet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DC4CF252FD02F13` (`evenement_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67DE1707BD` (`usercomd_id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BCFD02F13` (`evenement_id`),
  ADD KEY `IDX_67F068BCAD66EBB1` (`usercoment_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `element_cmd`
--
ALTER TABLE `element_cmd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_78948FA882EA2E54` (`commande_id`),
  ADD KEY `IDX_78948FA85099B1B6` (`classebillet_id`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B26681EA76ED395` (`user_id`),
  ADD KEY `IDX_B26681EBCF5E72D` (`categorie_id`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignage`
--
ALTER TABLE `temoignage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BDADBC461F402975` (`usertemg_id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97A0ADA33D5E8BD8` (`elementcmd_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `classebillet`
--
ALTER TABLE `classebillet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `element_cmd`
--
ALTER TABLE `element_cmd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `temoignage`
--
ALTER TABLE `temoignage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classebillet`
--
ALTER TABLE `classebillet`
  ADD CONSTRAINT `FK_DC4CF252FD02F13` FOREIGN KEY (`evenement_id`) REFERENCES `evenement` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DE1707BD` FOREIGN KEY (`usercomd_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BCAD66EBB1` FOREIGN KEY (`usercoment_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_67F068BCFD02F13` FOREIGN KEY (`evenement_id`) REFERENCES `evenement` (`id`);

--
-- Contraintes pour la table `element_cmd`
--
ALTER TABLE `element_cmd`
  ADD CONSTRAINT `FK_78948FA85099B1B6` FOREIGN KEY (`classebillet_id`) REFERENCES `classebillet` (`id`),
  ADD CONSTRAINT `FK_78948FA882EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_B26681EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_B26681EBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `temoignage`
--
ALTER TABLE `temoignage`
  ADD CONSTRAINT `FK_BDADBC461F402975` FOREIGN KEY (`usertemg_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_97A0ADA33D5E8BD8` FOREIGN KEY (`elementcmd_id`) REFERENCES `element_cmd` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
