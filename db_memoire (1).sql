-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 02 mars 2024 à 23:12
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_memoire`
--

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE `domaines` (
  `ID` int(11) NOT NULL,
  `NomDomaine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`ID`, `NomDomaine`) VALUES
(1, 'INFORMATIQUE'),
(2, 'FINANCE'),
(3, 'COMMUNICATION'),
(4, 'MANAGEMENT');

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date_heure` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `memoires`
--

CREATE TABLE `memoires` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `fichier` varchar(255) NOT NULL,
  `id_etudiant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `memoires`
--

INSERT INTO `memoires` (`id`, `titre`, `description`, `fichier`, `id_etudiant`) VALUES
(1, 'test_titre1', 'Description 1', 'Projet_2.pdf', NULL),
(2, 'test_titre1', 'Description ', 'TD revision Algo.pdf', NULL),
(3, 'test_titre1', 'Description ', 'TD revision Algo.pdf', NULL),
(6, 'test_titre1', 'Test_Description1', 'MK.pdf', 2),
(8, 'test_titre 2', 'test_Description2', 'TD revision Algo.pdf', 3),
(9, 'test_titre 2', 'test_Description2', 'TD revision Algo.pdf', 3);

-- --------------------------------------------------------

--
-- Structure de la table `memoires_domaines`
--

CREATE TABLE `memoires_domaines` (
  `memoire_id` int(11) NOT NULL,
  `domaine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `memoires_themes`
--

CREATE TABLE `memoires_themes` (
  `memoire_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `ID` int(11) NOT NULL,
  `NomTheme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`ID`, `NomTheme`) VALUES
(1, 'THEME1'),
(2, 'THEME2'),
(3, 'Test1_THEME');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID` int(11) NOT NULL,
  `NomUtilisateur` varchar(255) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL,
  `TypeUtilisateur` enum('Administrateur','Etudiant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `NomUtilisateur`, `MotDePasse`, `TypeUtilisateur`) VALUES
(2, 'adminmodif', '$2y$10$W7LXgqAc8liBYa.soW2Ok.C9MaxfXT160N.lltkXrzXwHhxG2tDsq', 'Administrateur'),
(3, 'etudiant1', 'motdepasseetudiant', 'Etudiant');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `memoires`
--
ALTER TABLE `memoires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `memoires_domaines`
--
ALTER TABLE `memoires_domaines`
  ADD PRIMARY KEY (`memoire_id`,`domaine_id`),
  ADD KEY `ID_Domaine` (`domaine_id`);

--
-- Index pour la table `memoires_themes`
--
ALTER TABLE `memoires_themes`
  ADD PRIMARY KEY (`memoire_id`,`theme_id`),
  ADD KEY `ID_Theme` (`theme_id`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `memoires`
--
ALTER TABLE `memoires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `memoires`
--
ALTER TABLE `memoires`
  ADD CONSTRAINT `memoires_ibfk_1` FOREIGN KEY (`ID_Etudiant`) REFERENCES `utilisateurs` (`ID`);

--
-- Contraintes pour la table `memoires_domaines`
--
ALTER TABLE `memoires_domaines`
  ADD CONSTRAINT `fk_memoires_domaines_domaines` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_memoires_domaines_memoires` FOREIGN KEY (`memoire_id`) REFERENCES `memoires` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `memoires_themes`
--
ALTER TABLE `memoires_themes`
  ADD CONSTRAINT `fk_memoires_themes_memoires` FOREIGN KEY (`memoire_id`) REFERENCES `memoires` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_memoires_themes_themes` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
