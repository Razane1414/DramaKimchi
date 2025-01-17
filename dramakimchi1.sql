-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 avr. 2024 à 17:12
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
-- Base de données : `dramakimchi1`
--

-- --------------------------------------------------------

--
-- Structure de la table `critiques`
--

CREATE TABLE `critiques` (
  `CritiqueID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `KdramaID` int(11) DEFAULT NULL,
  `Note` decimal(3,1) DEFAULT NULL,
  `Texte` text DEFAULT NULL,
  `DatePost` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `critiques`
--

INSERT INTO `critiques` (`CritiqueID`, `UserID`, `KdramaID`, `Note`, `Texte`, `DatePost`) VALUES
(1, 4, 3, 5.3, 'Une perle dans le genre, à ne pas manquer.', '2023-03-30 18:26:00'),
(2, 9, 3, 8.1, 'L\'histoire m\'a ému, excellente réalisation.', '2023-03-11 18:26:00'),
(3, 7, 3, 9.5, 'L\'histoire m\'a ému, excellente réalisation.', '2023-10-10 18:26:00'),
(4, 9, 6, 9.0, 'Touchant et inspirant, un véritable chef-d\'œuvre.', '2023-08-01 18:26:00'),
(5, 10, 11, 6.9, 'Un scénario original et des rebondissements inattendus.', '2023-06-21 18:26:00'),
(6, 8, 9, 6.8, 'Très bon Kdrama, j\'ai beaucoup aimé la fin.', '2024-01-20 18:27:57'),
(7, 8, 1, 9.6, 'Une perle dans le genre, à ne pas manquer.', '2023-12-24 18:27:57'),
(8, 8, 13, 6.1, 'Visuellement impressionnant, une vraie réussite esthétique.', '2023-10-17 18:27:57'),
(9, 8, 10, 7.7, 'Intrigue captivante, personnages bien développés. Recommandé !', '2023-03-24 18:27:57'),
(10, 8, 8, 7.9, 'Magnifique ! Les acteurs jouent à la perfection.', '2023-06-15 18:27:57'),
(14, 1, 1, 8.0, 'incroyable!!', '2024-02-17 23:51:01'),
(16, 1, 7, 10.0, 'mon kdrama prefere', '2024-02-18 00:18:40'),
(17, 1, 4, 6.0, 'incroyable', '2024-04-04 10:31:41'),
(18, 1, 13, 7.0, 'test', '2024-04-04 10:52:36'),
(19, 1, 5, 1.0, 'test\r\n', '2024-04-04 11:09:34'),
(20, 1, 4, 6.0, 'test', '2024-04-05 10:48:34'),
(21, 1, 4, 9.0, 'xc', '2024-04-05 13:21:37');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `GenreID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`GenreID`, `Nom`) VALUES
(1, 'Romance'),
(2, 'Action'),
(3, 'Thriller'),
(5, 'Fantastique'),
(6, 'Ecole'),
(7, 'Policier'),
(8, 'Sport'),
(9, 'Comédie'),
(10, 'Horreur');

-- --------------------------------------------------------

--
-- Structure de la table `kdramas`
--

CREATE TABLE `kdramas` (
  `KdramaID` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `AnneeSortie` year(4) DEFAULT NULL,
  `Synopsis` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `kdramas`
--

INSERT INTO `kdramas` (`KdramaID`, `Titre`, `Genre`, `AnneeSortie`, `Synopsis`, `Image`) VALUES
(1, 'Crash Landing on You', '', '2019', 'Une héritière sud-coréenne atterrit accidentellement en Corée du Nord, où elle rencontre et tombe amoureuse d\'un officier de l\'armée.', 'images/crash_landing_on_you.jpg'),
(2, 'Descendants of the Sun', '', '2016', 'Une histoire d\'amour se développe entre un chirurgien et un officier des forces spéciales.', 'images/descendants_of_the_sun.jpg'),
(3, 'Kingdom', '', '2019', 'Dans un cadre historique, un prince héritier enquête sur une épidémie qui transforme les gens en zombies.', 'images/kingdom.jpg'),
(4, 'Signal', '', '2016', 'Des détectives du présent et un détective du passé communiquent via talkie-walkie pour résoudre des affaires non résolues de longue date.', 'images/signal.jpg'),
(5, 'Mon amour venu des étoiles', '', '2013', 'Un extraterrestre sur Terre depuis des siècles tombe amoureux d\'une actrice populaire.', 'images/mon_amour_venu_des_etoiles.jpg'),
(6, 'Reply 1988', '', '2015', 'Cinq familles vivant dans la même ruelle en 1988 font face à la vie et à l\'amour.', 'images/reply_1988.jpg'),
(7, 'My Name', '', '2021', 'Dévastée par le meurtre de son père, une femme mise sa vengeance sur un puissant caïd de la pègre, qui la charge d\'infiltrer la police.', 'images/my_name.jpg'),
(8, 'Sky Castle', '', '2018', 'Des familles riches vont à l\'extrême pour assurer le succès de leurs enfants.', 'images/sky_castle.jpg'),
(9, 'Start-Up', '', '2020', 'De jeunes entrepreneurs aspirant à lancer leurs rêves virtuels dans la réalité concourent pour le succès et l\'amour dans le monde impitoyable de la haute technologie en Corée.', 'images/start_up.jpg'),
(10, 'Itaewon Class', '', '2020', 'Un ex-détenu et ses amis luttent pour réaliser leurs ambitions et ouvrir un bar dans la rue.', 'images/itaewon_class.jpg'),
(11, 'Vincenzo', '', '2021', 'Un consigliere de la mafia vient en Corée pour récupérer de l\'or et se retrouve impliqué dans la lutte contre une corporation corrompue.', 'images/vincenzo.jpg'),
(12, 'The Penthouse', '', '2020', 'Les résidents d\'un immeuble de luxe sont impliqués dans de multiples scandales, secrets et meurtres, révélant les longueurs extrêmes auxquelles ils sont prêts à aller pour sécuriser leur statut et leur richesse.', 'images/the_penthouse_war_in_life.jpg'),
(13, 'Weightlifting Fairy Kim Bok-Joo', '', '2016', 'L\'histoire d\'une jeune haltérophile, Kim Bok-Joo, et de son chemin vers l\'amour et le succès en tant qu\'athlète.', 'images/weightlifting_fairy_kim_bok_joo.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `kdramasgenres`
--

CREATE TABLE `kdramasgenres` (
  `KdramaID` int(11) NOT NULL,
  `GenreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `kdramasgenres`
--

INSERT INTO `kdramasgenres` (`KdramaID`, `GenreID`) VALUES
(1, 1),
(1, 2),
(1, 9),
(2, 1),
(2, 2),
(2, 9),
(3, 10),
(4, 5),
(4, 7),
(5, 1),
(6, 1),
(6, 6),
(6, 9),
(7, 2),
(7, 3),
(7, 7),
(8, 6),
(8, 9),
(9, 1),
(10, 1),
(10, 9),
(11, 2),
(11, 3),
(11, 7),
(12, 2),
(12, 6),
(13, 1),
(13, 6),
(13, 8);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `UserID` int(11) NOT NULL,
  `NomUtilisateur` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL,
  `Genre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`UserID`, `NomUtilisateur`, `Email`, `MotDePasse`, `Genre`) VALUES
(1, 'TEST', 'test@gmail.com', 'test', ''),
(2, 'Evelyn81', 'evelyn81@yahoo.com', 'Evelyn*2024', ''),
(3, 'Harper66', 'harper66@hotmail.com', 'Harper66#$', ''),
(4, 'Harper60', 'harper60@example.com', 'Secure!60', ''),
(5, 'Henry77', 'henry77@gmail.com', 'Henry!77%', ''),
(6, 'Lucas6', 'lucas6@yahoo.com', 'Lucas@2024', ''),
(7, 'Evelyn81', 'evelyn81_new@gmail.com', 'Pass*8123', ''),
(8, 'Liam96', 'liam96@hotmail.com', 'Liam#9601', ''),
(9, 'Olivia70', 'olivia70@yahoo.com', 'Olivia!70$', ''),
(10, 'Jacob97', 'jacob97@example.com', 'Jacob*9797', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateursgenres`
--

CREATE TABLE `utilisateursgenres` (
  `UserID` int(11) NOT NULL,
  `GenreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateursgenres`
--

INSERT INTO `utilisateursgenres` (`UserID`, `GenreID`) VALUES
(1, 1),
(1, 10),
(2, 1),
(2, 8),
(2, 9),
(3, 2),
(3, 5),
(3, 6),
(4, 1),
(4, 2),
(4, 8),
(5, 3),
(5, 7),
(5, 9),
(6, 1),
(6, 3),
(6, 10),
(7, 3),
(7, 5),
(7, 7),
(8, 3),
(8, 5),
(8, 10),
(9, 3),
(9, 9),
(9, 10),
(10, 1),
(10, 2),
(10, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `critiques`
--
ALTER TABLE `critiques`
  ADD PRIMARY KEY (`CritiqueID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `KdramaID` (`KdramaID`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`GenreID`);

--
-- Index pour la table `kdramas`
--
ALTER TABLE `kdramas`
  ADD PRIMARY KEY (`KdramaID`);

--
-- Index pour la table `kdramasgenres`
--
ALTER TABLE `kdramasgenres`
  ADD PRIMARY KEY (`KdramaID`,`GenreID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`UserID`);

--
-- Index pour la table `utilisateursgenres`
--
ALTER TABLE `utilisateursgenres`
  ADD PRIMARY KEY (`UserID`,`GenreID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `critiques`
--
ALTER TABLE `critiques`
  MODIFY `CritiqueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `GenreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `kdramas`
--
ALTER TABLE `kdramas`
  MODIFY `KdramaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `critiques`
--
ALTER TABLE `critiques`
  ADD CONSTRAINT `critiques_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `utilisateurs` (`UserID`),
  ADD CONSTRAINT `critiques_ibfk_2` FOREIGN KEY (`KdramaID`) REFERENCES `kdramas` (`KdramaID`);

--
-- Contraintes pour la table `kdramasgenres`
--
ALTER TABLE `kdramasgenres`
  ADD CONSTRAINT `kdramasgenres_ibfk_1` FOREIGN KEY (`KdramaID`) REFERENCES `kdramas` (`KdramaID`),
  ADD CONSTRAINT `kdramasgenres_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`GenreID`);

--
-- Contraintes pour la table `utilisateursgenres`
--
ALTER TABLE `utilisateursgenres`
  ADD CONSTRAINT `utilisateursgenres_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `utilisateurs` (`UserID`),
  ADD CONSTRAINT `utilisateursgenres_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`GenreID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
