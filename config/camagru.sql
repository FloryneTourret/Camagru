-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  mer. 24 avr. 2019 à 12:26
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
(1, 1, 2, 'Coucou', '2019-04-18 15:35:10'),
(2, 1, 2, 'ergergty', '2019-04-18 15:40:44'),
(3, 3, 2, 'coucou', '2019-04-18 16:54:19'),
(4, 3, 2, 'afdfda', '2019-04-18 17:04:46'),
(5, 2, 6, 'Waouh !', '2019-04-18 17:52:43'),
(6, 1, 21, 'Salut BG', '2019-04-24 09:52:45'),
(7, 1, 21, 'cc', '2019-04-24 09:52:56'),
(8, 1, 21, 'bg', '2019-04-24 09:52:58'),
(9, 1, 26, 'Yo', '2019-04-24 10:24:05'),
(10, 1, 26, 'Coucou', '2019-04-24 10:24:09'),
(11, 1, 26, '&lt;h1&gt;coucou&lt;/h1&gt;', '2019-04-24 10:24:20'),
(12, 1, 26, '&lt;script&gt;alert(\'Hello\')&lt;/script&gt;', '2019-04-24 10:24:38'),
(13, 1, 20, 'lol crocmou', '2019-04-24 10:50:08'),
(14, 1, 19, 'trop mimi', '2019-04-24 10:50:27');

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
(1, 'Test', 'assets/upload/filter/ac83f837f341b616.png'),
(2, 'Test', 'assets/upload/filter/2140536278acb334.png'),
(3, 'Test', 'assets/upload/filter/9001d0aa00092a41.png'),
(4, 'ninja', 'assets/upload/filter/1a80d32062e46acc.png'),
(5, 'ninja', 'assets/upload/filter/e5cd2c7ae9341202.png');

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
(2, 2),
(2, 3),
(2, 19),
(2, 13),
(1, 21),
(1, 19),
(1, 26),
(1, 22),
(1, 28),
(1, 20);

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
(1, 'assets/upload/naplouvi/65f6af6b4f64feca.jpg', NULL, 5, '2019-04-18 14:22:49'),
(2, 'assets/upload/ftourret/07840b7886546561.jpg', NULL, 2, '2019-04-18 14:29:10'),
(3, 'assets/upload/ftourret/8bcb04f6462706d8.jpg', NULL, 2, '2019-04-18 14:29:17'),
(4, 'assets/upload/ftourret/0a1ee9a611b58639.jpg', NULL, 2, '2019-04-18 14:29:22'),
(5, 'assets/upload/ftourret/683f3972ce6e5fd8.jpg', NULL, 2, '2019-04-18 14:29:26'),
(6, 'assets/upload/ftourret/d577a21e3a32756a.jpg', NULL, 2, '2019-04-18 14:29:30'),
(7, 'assets/upload/ftourret/9289ae2eb4543fa7.jpg', NULL, 2, '2019-04-18 14:29:37'),
(8, 'assets/upload/ftourret/67deb9f839a70de0.jpg', NULL, 2, '2019-04-18 14:29:41'),
(9, 'assets/upload/ftourret/b154111357cbe156.jpg', NULL, 2, '2019-04-18 14:29:44'),
(10, 'assets/upload/ftourret/72c17cf218645e87.jpg', NULL, 2, '2019-04-18 14:29:48'),
(11, 'assets/upload/ftourret/b2fb5272910ae577.jpg', NULL, 2, '2019-04-18 14:29:52'),
(12, 'assets/upload/ftourret/fff9b0431f490875.jpg', NULL, 2, '2019-04-18 14:29:56'),
(13, 'assets/upload/ftourret/593e83cee51a6e8b.jpg', NULL, 2, '2019-04-18 14:30:00'),
(14, 'assets/upload/ftourret/e77c43aeda590eb2.jpg', NULL, 2, '2019-04-18 14:30:04'),
(15, 'assets/upload/ftourret/31a591918f484259.jpg', NULL, 2, '2019-04-18 14:30:07'),
(16, 'assets/upload/ftourret/7c5cb9e2a89408f1.jpg', NULL, 2, '2019-04-18 14:30:11'),
(17, 'assets/upload/ftourret/2f7afd62c07186d6.jpg', NULL, 2, '2019-04-18 14:30:14'),
(18, 'assets/upload/ftourret/7dda691bf0d66d97.jpg', NULL, 2, '2019-04-18 14:30:17'),
(19, 'assets/upload/lettoh/0567a6b062e0ca95.jpg', NULL, 1, '2019-04-18 14:47:58'),
(20, 'assets/upload/lettoh/09fe6229be8bba4e.jpg', NULL, 1, '2019-04-18 14:48:10'),
(22, 'assets/upload/lettoh/2be0cc54d5179627.png', NULL, 1, '2019-04-23 17:19:57'),
(23, 'assets/upload/lettoh/a707dbb11e6d0f24.png', NULL, 1, '2019-04-23 17:46:53'),
(24, 'assets/upload/lettoh/5a75956a442ba17a.png', NULL, 1, '2019-04-24 10:05:16'),
(25, 'assets/upload/lettoh/9af4d00bb073a399.png', 'Salut a tous c\'est fleonard comment ça va aujourd\'hui?', 1, '2019-04-24 10:08:13'),
(26, 'assets/upload/lettoh/06793e02f061fcfa.png', 'Yo lesk ings', 1, '2019-04-24 10:22:54'),
(27, 'assets/upload/lettoh/80f4aec08260e14e.png', 'COUCOU', 1, '2019-04-24 10:41:04'),
(28, 'assets/upload/lettoh/7576a9df40038c50.png', 'lol loperation d dent c bien passé :) ^^', 1, '2019-04-24 10:49:54');

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
(1, 'Frédéric', 'LEONARD', 'lettoh', 'lettoh08@gmail.com', 'tg', 'assets/upload/lettoh/02de54d0db88a333.jpg', '$2y$10$N9eet7EhGZfqNr5ZNb5k9eVy4BXIuxmcVP/4xD5NFUsv/pL.JABjS', 1, 1, 1, NULL, NULL),
(2, 'Floryne', 'TOURRET', 'ftourret', 'floryne.tourret@gmail.com', NULL, 'assets/upload/ftourret/47c54b7051dc1ddd.jpg', '$2y$10$iBDaoi5JQ7QKIIqLi.DWve3Qp6cAyx5PuUxGmoclQqhPl3rZ6MxsC', 1, 1, 1, NULL, NULL),
(3, 'Frédéric', 'LEONARD', 'lettard', 'frederic.leonard.pro@gmail.com', NULL, NULL, '$2y$10$LL173fJwQAKDxyx//q15BukDGX//c4x0Kzo4pkHYYZY0njcSNSwCS', 0, 1, 1, NULL, NULL);

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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `filters`
--
ALTER TABLE `filters`
  MODIFY `filter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
