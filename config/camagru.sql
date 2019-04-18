-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  jeu. 18 avr. 2019 à 14:50
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
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `picture_id` int(11) NOT NULL,
  `picture_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `picture_title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `picture_desc` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `picture_user_id` int(11) NOT NULL,
  `picture_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`picture_id`, `picture_path`, `picture_title`, `picture_desc`, `picture_user_id`, `picture_date`) VALUES
(1, 'assets/upload/naplouvi/65f6af6b4f64feca.jpg', NULL, NULL, 5, '2019-04-18 14:22:49'),
(2, 'assets/upload/ftourret/07840b7886546561.jpg', NULL, NULL, 2, '2019-04-18 14:29:10'),
(3, 'assets/upload/ftourret/8bcb04f6462706d8.jpg', NULL, NULL, 2, '2019-04-18 14:29:17'),
(4, 'assets/upload/ftourret/0a1ee9a611b58639.jpg', NULL, NULL, 2, '2019-04-18 14:29:22'),
(5, 'assets/upload/ftourret/683f3972ce6e5fd8.jpg', NULL, NULL, 2, '2019-04-18 14:29:26'),
(6, 'assets/upload/ftourret/d577a21e3a32756a.jpg', NULL, NULL, 2, '2019-04-18 14:29:30'),
(7, 'assets/upload/ftourret/9289ae2eb4543fa7.jpg', NULL, NULL, 2, '2019-04-18 14:29:37'),
(8, 'assets/upload/ftourret/67deb9f839a70de0.jpg', NULL, NULL, 2, '2019-04-18 14:29:41'),
(9, 'assets/upload/ftourret/b154111357cbe156.jpg', NULL, NULL, 2, '2019-04-18 14:29:44'),
(10, 'assets/upload/ftourret/72c17cf218645e87.jpg', NULL, NULL, 2, '2019-04-18 14:29:48'),
(11, 'assets/upload/ftourret/b2fb5272910ae577.jpg', NULL, NULL, 2, '2019-04-18 14:29:52'),
(12, 'assets/upload/ftourret/fff9b0431f490875.jpg', NULL, NULL, 2, '2019-04-18 14:29:56'),
(13, 'assets/upload/ftourret/593e83cee51a6e8b.jpg', NULL, NULL, 2, '2019-04-18 14:30:00'),
(14, 'assets/upload/ftourret/e77c43aeda590eb2.jpg', NULL, NULL, 2, '2019-04-18 14:30:04'),
(15, 'assets/upload/ftourret/31a591918f484259.jpg', NULL, NULL, 2, '2019-04-18 14:30:07'),
(16, 'assets/upload/ftourret/7c5cb9e2a89408f1.jpg', NULL, NULL, 2, '2019-04-18 14:30:11'),
(17, 'assets/upload/ftourret/2f7afd62c07186d6.jpg', NULL, NULL, 2, '2019-04-18 14:30:14'),
(18, 'assets/upload/ftourret/7dda691bf0d66d97.jpg', NULL, NULL, 2, '2019-04-18 14:30:17'),
(19, 'assets/upload/lettoh/0567a6b062e0ca95.jpg', NULL, NULL, 1, '2019-04-18 14:47:58'),
(20, 'assets/upload/lettoh/09fe6229be8bba4e.jpg', NULL, NULL, 1, '2019-04-18 14:48:10');

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
(1, 'Frédéric', 'LEONARD', 'lettoh', 'lettoh08@gmail.com', 'Je suis Fred', 'assets/upload/lettoh/02de54d0db88a333.jpg', '$2y$10$N9eet7EhGZfqNr5ZNb5k9eVy4BXIuxmcVP/4xD5NFUsv/pL.JABjS', 0, 1, 1, NULL, NULL),
(2, 'Floryne', 'TOURRET', 'ftourret', 'floryne.tourret@gmail.com', NULL, 'assets/upload/ftourret/47c54b7051dc1ddd.jpg', '$2y$10$iBDaoi5JQ7QKIIqLi.DWve3Qp6cAyx5PuUxGmoclQqhPl3rZ6MxsC', 1, 1, 1, NULL, NULL),
(3, 'Frédéric', 'LEONARD', 'lettard', 'frederic.leonard.pro@gmail.com', NULL, NULL, '$2y$10$LL173fJwQAKDxyx//q15BukDGX//c4x0Kzo4pkHYYZY0njcSNSwCS', 0, 1, 1, NULL, NULL);

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
