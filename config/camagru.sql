-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  ven. 26 avr. 2019 à 14:17
-- Version du serveur :  5.5.61
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_picture_id` int(11) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_user_id`, `comment_picture_id`, `comment_content`, `comment_date`) VALUES
(1, 1, 4, 'Un pandquin !', '2019-04-26 14:04:18'),
(2, 2, 6, 'Tchin !', '2019-04-26 14:05:22'),
(3, 2, 6, 'Tchin !', '2019-04-26 14:05:23'),
(4, 5, 7, 'Trop mignon! &lt;3', '2019-04-26 14:15:58');

-- --------------------------------------------------------

--
-- Structure de la table `filters`
--

CREATE TABLE `filters` (
  `filter_id` int(11) NOT NULL,
  `filter_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `filter_path` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `filters`
--

INSERT INTO `filters` (`filter_id`, `filter_name`, `filter_path`) VALUES
(5, 'Batman', 'assets/upload/filter/c69784c7989b57cd.png'),
(7, 'Oreilles', 'assets/upload/filter/201aefdc1b632b14.png'),
(8, 'Funny face', 'assets/upload/filter/228d6a619ebb9f65.png'),
(9, 'Lunettes moustache', 'assets/upload/filter/46521e1d15a2f617.png'),
(11, 'Bob', 'assets/upload/filter/0b2a0b205ec3d3cd.png'),
(12, 'Chauve', 'assets/upload/filter/5750c339945aea24.png'),
(13, 'Trump', 'assets/upload/filter/45bdf8cdfb076dbd.png'),
(14, 'Chaaaaat', 'assets/upload/filter/aca1ca081de6c2fd.png'),
(15, 'Tchin', 'assets/upload/filter/c37bb29e4d4252c6.png'),
(16, 'Plop', 'assets/upload/filter/66ff58eb4fa80ed9.png'),
(17, 'My name is Trump', 'assets/upload/filter/fa821ab70ce6f455.png'),
(18, 'Oh', 'assets/upload/filter/9f0dab8f35e0f380.png');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `like_user_id` int(11) NOT NULL,
  `like_picture_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`like_user_id`, `like_picture_id`) VALUES
(1, 4),
(2, 6),
(5, 7),
(5, 5),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `picture_id` int(11) NOT NULL,
  `picture_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `picture_desc` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `picture_user_id` int(11) NOT NULL,
  `picture_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`picture_id`, `picture_path`, `picture_desc`, `picture_user_id`, `picture_date`) VALUES
(1, 'assets/upload/ftourret/281c395904290ae0.png', 'Aaaah', 2, '2019-04-26 14:01:17'),
(2, 'assets/upload/ftourret/13a5cb516437670d.png', 'Coucou les copains', 2, '2019-04-26 14:02:19'),
(3, 'assets/upload/ftourret/fa2021d3a66cee47.png', 'Oh la la ça pue', 2, '2019-04-26 14:02:48'),
(4, 'assets/upload/ftourret/2cff76ef74878ec1.jpg', 'Je sais. Ça a aucun sens', 2, '2019-04-26 14:03:14'),
(5, 'assets/upload/lettoh/a655cd7b81684606.jpg', 'Je suis BatCat', 1, '2019-04-26 14:03:51'),
(6, 'assets/upload/lettoh/2c0a4d319cae4260.jpg', 'Santé !', 1, '2019-04-26 14:05:04'),
(7, 'assets/upload/ftourret/235c16d847825d28.jpg', 'Mon chat. Ou pas.', 2, '2019-04-26 14:05:46'),
(8, 'assets/upload/jdoe/c4a9d27ed2a300d1.jpg', 'Voilà.', 5, '2019-04-26 14:16:39');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `biography` varchar(255) DEFAULT NULL,
  `path_profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `notif` tinyint(1) NOT NULL DEFAULT '1',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) DEFAULT NULL,
  `token_expiration` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `login`, `email`, `biography`, `path_profile_picture`, `password`, `admin`, `notif`, `enabled`, `token`, `token_expiration`) VALUES
(1, 'Frédéric', 'LEONARD', 'lettoh', 'lettoh08@gmail.com', NULL, 'assets/upload/lettoh/6baa595273d327de.jpg', '$2y$10$N9eet7EhGZfqNr5ZNb5k9eVy4BXIuxmcVP/4xD5NFUsv/pL.JABjS', 1, 0, 1, NULL, NULL),
(2, 'Floryne', 'TOURRET', 'ftourret', 'floryne.tourret@gmail.com', NULL, 'assets/upload/ftourret/6ea00144c09ab536.jpg', '$2y$10$iBDaoi5JQ7QKIIqLi.DWve3Qp6cAyx5PuUxGmoclQqhPl3rZ6MxsC', 1, 0, 1, NULL, NULL),
(3, 'Frédéric', 'LEONARD', 'lettard', 'frederic.leonard.pro@gmail.com', NULL, NULL, '$2y$10$LL173fJwQAKDxyx//q15BukDGX//c4x0Kzo4pkHYYZY0njcSNSwCS', 0, 1, 0, NULL, NULL),
(4, 'Floryne', 'TOURRET', 'floryne', 'floryne.tourret.pro@gmail.com', NULL, NULL, '$2y$10$KNuX97t7Y.HqGWn/A.28l.Dnf6PZe5Z2VG6NuJeqvlODT59QiDPWC', 0, 1, -1, NULL, NULL),
(5, 'John', 'DOE', 'jdoe', 'jdoe@student.le-101.fr', NULL, NULL, '$2y$10$iwGRbpn.KqNIXPmVvD8z6eWLnpe8lORnmBgoR5xuRS7.KjuYeg11q', 0, 1, 1, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Index pour la table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`filter_id`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`picture_id`,`picture_path`),
  ADD UNIQUE KEY `picture_path` (`picture_path`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `filters`
--
ALTER TABLE `filters`
  MODIFY `filter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
