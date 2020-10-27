-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 27 oct. 2020 à 12:24
-- Version du serveur :  10.3.15-MariaDB
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `2i_soft_pay`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE `action` (
  `id_action` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `libelle_action` varchar(45) DEFAULT NULL,
  `description_action` varchar(100) DEFAULT NULL,
  `url_action` varchar(100) DEFAULT NULL,
  `ordre_affichage_action` varchar(45) DEFAULT NULL,
  `icon_action` varchar(254) DEFAULT NULL,
  `statut` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id_action`, `id_groupe`, `libelle_action`, `description_action`, `url_action`, `ordre_affichage_action`, `icon_action`, `statut`, `created_at`, `update_at`) VALUES
(1, 1, 'Rôle', 'Ajout, modification, suppression', 'role', '1', NULL, 1, '2020-10-22 09:04:48', NULL),
(2, 1, 'Module', 'Ajout, modification, suppression', 'module', '2', NULL, 1, '2020-10-22 09:04:48', NULL),
(3, 1, 'Ajout Utilisateur', 'Ajouter les utilisateurs', 'addUser', '3', NULL, 1, '2020-10-22 09:04:48', NULL),
(4, 1, 'Liste Utilisateur', 'Listing des utilisateurs', 'lstUser', '4', NULL, 1, '2020-10-22 09:04:48', NULL),
(5, 1, 'Ajout Type Utilisateur', 'Ajouter les différents types user', 'addTypeUser', '5', NULL, 1, '2020-10-22 09:04:48', NULL),
(6, 1, 'Liste Type Utilisateur', 'Listing des types utilisateur', 'lstTypeUser', '6', NULL, 1, '2020-10-22 09:04:48', NULL),
(7, 1, 'Liste Entreprise', 'Listing des Entreprise clients', 'lstEntClt', '7', NULL, 1, '2020-10-22 09:04:48', NULL),
(8, 1, 'Liste Client', 'Listing des clients', 'lstClt', '8', NULL, 1, '2020-10-22 09:04:48', NULL),
(9, 2, 'Ajouter commission', 'Ajouter une commission', 'addCommission', '1', NULL, 1, '2020-10-22 09:04:48', NULL),
(10, 2, 'Liste Commission', 'Listing des commissions', 'lstCommission', '2', NULL, 1, '2020-10-22 09:04:48', NULL),
(11, 2, 'Dépôt | STA', 'Société de transfert d\'argent', 'sta', '3', NULL, 1, '2020-10-22 09:04:48', NULL),
(12, 2, 'Identité', 'Crud Identité', 'identite', '4', NULL, 1, '2020-10-22 09:04:48', NULL),
(13, 2, 'Pays', 'CRUD Pays', 'lstPays', '5', NULL, 1, '2020-10-22 09:04:48', NULL),
(14, 2, 'Liste Type Entreprise', 'CRUD Type Entreprise', 'lstTypeEnt', '6', NULL, 1, '2020-10-22 09:04:48', NULL),
(15, 3, 'Transaction', 'Les transactions effectuées sur le compte', 'transaction', '1', NULL, 1, '2020-10-22 09:04:48', NULL),
(16, 3, 'Solde', 'Le solde du compte', 'solde', '2', NULL, 1, '2020-10-22 09:04:48', NULL),
(17, 3, 'Page de Paiement', 'L\'ensemble des paiement réçu', 'paiement', '3', NULL, 1, '2020-10-22 09:04:48', NULL),
(18, 4, 'Générer API', 'Généreration de l\'api', 'api_cle', '1', NULL, 1, '2020-10-22 09:04:48', NULL),
(19, 1, 'Menu', 'CRUD Menu', 'menu', '9', 'lnr lnr-', 1, '2020-10-23 09:02:23', NULL),
(20, 4, 'Test', 'test1', 'test', '1', NULL, 0, '2020-10-22 15:02:15', '2020-10-22 05:02:15'),
(21, 1, 'prise', 'en main', 'main', '10', 'lnr', 1, '2020-10-23 10:32:05', '2020-10-23 12:32:05'),
(22, 1, 'zz', 'zz', 'zz', 'zz', NULL, 0, '2020-10-23 10:30:31', '2020-10-23 12:30:31'),
(23, 1, 'vet', 'et', 'eete', '3', NULL, 1, '2020-10-23 14:06:49', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cle`
--

CREATE TABLE `cle` (
  `id_cle` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `apikey` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `statut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `id_sta` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `prenom` varchar(254) DEFAULT NULL,
  `tel` varchar(254) DEFAULT NULL,
  `adresse` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `statut` int(11) DEFAULT 1,
  `user_create` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `id_sta`, `nom`, `prenom`, `tel`, `adresse`, `email`, `created_at`, `update_at`, `statut`, `user_create`) VALUES
(1, 3, 'Mahaman Tahirou', 'Zalkilphily Abass', '+22796962435', 'Niamey 2000', 'zalkiabass.456@gmail.com', '2020-10-19 14:38:31', NULL, 1, 17);

-- --------------------------------------------------------

--
-- Structure de la table `commission`
--

CREATE TABLE `commission` (
  `id_commission` int(11) NOT NULL,
  `montant_debut` varchar(254) DEFAULT NULL,
  `montant_fin` varchar(254) DEFAULT NULL,
  `frais` varchar(254) DEFAULT NULL,
  `taux` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commission`
--

INSERT INTO `commission` (`id_commission`, `montant_debut`, `montant_fin`, `frais`, `taux`, `statut`, `created_at`, `update_at`, `user_create`) VALUES
(1, '1000', '10000', '50', 0, 1, '2020-10-16 11:07:47', NULL, 3),
(2, '10000', '50000', '100', 0, 1, '2020-10-16 11:22:20', NULL, NULL),
(3, '50000', '100000', '200', 0, 1, '2020-10-16 11:22:20', NULL, NULL),
(4, '100000', '2000000', '1000', 0, 1, '2020-10-16 14:04:25', '2020-10-16 04:24:58', 3),
(5, '122', '123', '123', 1, 0, '2020-10-19 08:16:58', '2020-10-19 10:27:22', 3),
(6, '200000', '500000', '5000', 1, 1, '2020-10-19 08:36:58', NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `id_type_identite` int(11) NOT NULL,
  `id_sta` int(11) NOT NULL,
  `id_pays` int(11) NOT NULL,
  `id_type_entreprise` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `adresse` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `bp` varchar(254) DEFAULT NULL,
  `tel` varchar(254) DEFAULT NULL,
  `n_identite` varchar(254) DEFAULT NULL,
  `nom_identite` varchar(254) DEFAULT NULL,
  `prenom_identite` varchar(254) DEFAULT NULL,
  `reference` varchar(254) DEFAULT NULL,
  `description` varchar(254) DEFAULT NULL,
  `n_registration` varchar(254) DEFAULT NULL,
  `website` varchar(254) DEFAULT NULL,
  `localisation` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `statut` int(11) DEFAULT 1,
  `user_create` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `id_type_identite`, `id_sta`, `id_pays`, `id_type_entreprise`, `nom`, `adresse`, `email`, `bp`, `tel`, `n_identite`, `nom_identite`, `prenom_identite`, `reference`, `description`, `n_registration`, `website`, `localisation`, `created_at`, `update_at`, `statut`, `user_create`) VALUES
(1, 1, 1, 1, 1, 'NeAkoyDev', 'Niamey 2000 - NIGER', 'contact@neakoydev.com', '11956', '+22796962435', '1223311', 'ZALKILPHILY', 'MAHAMAN TAHIROU', '112333', 'Niger Akoy Developpement', 'RCIMMAA', 'www.neakoydev.com', 'Niamey', '2020-10-19 11:10:46', NULL, 1, 2),
(2, 1, 1, 1, 1, 'M-Corp', 'Koubia NIGER', 'mcorp@mcorp.com', '10555', '+22796964435', '1222/COM I', 'AYOUBA Hachimou', 'Moctar', 'RCCIM NIF 13253', 'Design Top', 'RCCIM NIF 13253', 'www.m-corp.com', 'Ny NIGER', '2020-10-21 08:23:09', NULL, 1, 19);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_action`
--

CREATE TABLE `groupe_action` (
  `id_groupe` int(11) NOT NULL,
  `libelle_groupe` varchar(45) DEFAULT NULL,
  `icon_groupe` varchar(255) NOT NULL,
  `bloc_menu` varchar(45) DEFAULT NULL COMMENT 'config ou simple',
  `ordre_affichage_groupe` varchar(45) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe_action`
--

INSERT INTO `groupe_action` (`id_groupe`, `libelle_groupe`, `icon_groupe`, `bloc_menu`, `ordre_affichage_groupe`, `statut`) VALUES
(1, 'Administration', 'lnr lnr-flag', 'administration', '1', 1),
(2, 'Configuration', 'lnr lnr-briefcase', 'config', '2', 1),
(3, 'Compte', 'lnr lnr-store', 'compte', '3', 1),
(4, 'Paramètre', 'lnr lnr-code', 'parametre', '4', 1),
(5, 'test', 'tets', 'lnr lnr-key', '5', 0);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id_pays` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT 1,
  `user_create` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `code`, `nom`, `created_at`, `update_at`, `statut`, `user_create`) VALUES
(1, '+227', 'NIGER', '2020-10-07 13:39:18', NULL, 1, NULL),
(2, '+234', 'NIGERIA', '2020-10-07 13:39:18', NULL, 1, NULL),
(3, '+226', 'BURKINA FASO', '2020-10-19 08:59:30', '2020-10-19 10:59:30', 0, NULL),
(4, '+225', 'COTE D\'IVOIRE', '2020-10-07 13:39:51', NULL, 1, NULL),
(5, '+221', 'Sénégal', '2020-10-19 09:12:50', NULL, 1, 3),
(6, '00213', 'Libye', '2020-10-19 09:20:02', '2020-10-19 11:20:02', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `profil_has_action`
--

CREATE TABLE `profil_has_action` (
  `id_profil` int(11) NOT NULL,
  `id_action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil_has_action`
--

INSERT INTO `profil_has_action` (`id_profil`, `id_action`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(1, 19),
(1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `sta`
--

CREATE TABLE `sta` (
  `id_sta` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `adresse` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `tel` varchar(254) DEFAULT NULL,
  `bp` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sta`
--

INSERT INTO `sta` (`id_sta`, `nom`, `adresse`, `email`, `tel`, `bp`, `created_at`, `update_at`, `user_create`, `statut`) VALUES
(1, 'BNIF UWA', 'Ny Niger', 'email@email.com', '12323', '11111', '2020-10-16 16:29:24', '2020-10-17 12:04:01', 3, 1),
(2, 'test', 'test', 'test@test.com', '1234', '1234', '2020-10-16 22:04:28', '2020-10-17 12:13:11', 3, 0),
(3, 'AL-IZZA', 'NE', 'izza@izza.com', '112212', '123456', '2020-10-16 22:14:00', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `id_commission` int(11) DEFAULT NULL,
  `id_sta` int(11) NOT NULL,
  `montant_transaction` varchar(254) DEFAULT NULL,
  `statut` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_client`, `id_entreprise`, `id_commission`, `id_sta`, `montant_transaction`, `statut`, `created_at`, `update_at`) VALUES
(1, 1, 1, 6, 3, '202000', 1, '2020-10-20 08:58:06', NULL),
(2, 1, 1, NULL, 1, '300000', 1, '2020-10-20 14:10:55', NULL),
(3, 1, 1, NULL, 3, '1000', 1, '2020-10-20 14:25:05', NULL),
(4, 1, 1, NULL, 3, '500', 1, '2020-10-20 14:27:40', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_entreprise`
--

CREATE TABLE `type_entreprise` (
  `id_type_entreprise` int(11) NOT NULL,
  `libelle` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `statut` int(11) DEFAULT 1,
  `user_create` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_entreprise`
--

INSERT INTO `type_entreprise` (`id_type_entreprise`, `libelle`, `created_at`, `update_at`, `statut`, `user_create`) VALUES
(1, 'Conception Informatique', '2020-10-07 14:00:15', NULL, 1, NULL),
(2, 'E commerce', '2020-10-07 14:00:45', '2020-10-19 11:48:23', 1, NULL),
(3, 'BTP', '2020-10-07 14:00:45', NULL, 1, NULL),
(4, 'Expertise Comptable', '2020-10-19 09:37:09', NULL, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_identite`
--

CREATE TABLE `type_identite` (
  `id_type_identite` int(11) NOT NULL,
  `libelle` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_identite`
--

INSERT INTO `type_identite` (`id_type_identite`, `libelle`, `created_at`, `update_at`, `user_create`, `statut`) VALUES
(1, 'Carte d\'identié', '2020-10-15 23:00:00', '2020-10-16 05:57:13', NULL, 1),
(2, 'PassePort', '2020-10-16 14:51:15', NULL, NULL, 1),
(3, 'AAA', '2020-10-16 16:02:03', '2020-10-16 06:03:01', NULL, 0),
(4, 'ZZZ', '2020-10-19 08:15:04', NULL, 3, 1),
(5, NULL, '2020-10-19 20:10:49', NULL, 3, 1),
(6, NULL, '2020-10-19 20:10:51', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_users`
--

CREATE TABLE `type_users` (
  `id_typeuser` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_users`
--

INSERT INTO `type_users` (`id_typeuser`, `label`, `role`, `created_at`, `updated_at`, `statut`) VALUES
(1, 'Administrateur', 'Il a tout les droits', '2020-10-06 10:03:47', NULL, 1),
(2, 'Entreprise', 'Structure client', '2020-10-07 09:37:20', NULL, 1),
(3, 'Client', 'AccÃ¨s au entreprise', '2020-10-08 08:25:09', NULL, 1),
(4, 'test', 'test', '2020-10-12 10:43:56', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_pass` varchar(255) DEFAULT NULL,
  `type_user` int(11) NOT NULL,
  `photo` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `mot_pass`, `type_user`, `photo`, `created_at`, `updated_at`, `statut`) VALUES
(2, '227Komche', 'adamoukomche@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-07 09:36:39', NULL, 1),
(3, '227Mahaman', 'zalkiabass.456@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, NULL, '2020-10-07 09:36:24', NULL, 1),
(4, '227Moctar', 'ayoubahachimou@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-07 09:38:06', NULL, 1),
(6, '2iSoft', 'contact@2isoft.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-08 09:36:19', '2020-10-08 00:00:00', 1),
(7, '227KomKoy', 'adamoukomche@gmail.com', NULL, 1, NULL, '2020-10-08 09:48:50', '2020-10-08 12:48:50', 1),
(8, '227Taheer', 'taher227@gmail.com', NULL, 2, NULL, '2020-10-08 09:37:06', '2020-10-08 12:37:06', 2),
(9, '227TestDate', 'datetest@gmail.com', NULL, 3, NULL, '2020-10-08 09:50:39', '2020-10-08 12:50:55', 2),
(10, 'New', 'new@new.com', '1111', 2, NULL, '2020-10-08 12:52:07', NULL, 1),
(11, 'Testeur', 'test@test.com', '1234', 2, NULL, '2020-10-08 12:52:47', NULL, 1),
(12, 'New', 'new@new.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-08 12:57:49', NULL, 1),
(13, 'Kômche', 'contact@neakoydev.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, NULL, '2020-10-12 09:30:47', NULL, 1),
(14, 'Testeur', 'test@tes.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-12 14:56:58', NULL, 1),
(15, 'test', 'test@tes.com', NULL, 2, NULL, '2020-10-12 14:58:28', NULL, 1),
(16, 'Moctar', 'zalkiabass.456@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-13 08:27:35', NULL, 1),
(17, 'Mahaman', 'zalkiabass.456@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, NULL, '2020-10-19 13:59:26', NULL, 1),
(18, 'test1', 'test1@test.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-19 20:12:38', NULL, 1),
(19, 'M-Corp', 'mcorp@mcorp.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, '2020-10-20 15:55:42', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id_action`),
  ADD KEY `id_groupe` (`id_groupe`);

--
-- Index pour la table `cle`
--
ALTER TABLE `cle`
  ADD PRIMARY KEY (`id_cle`),
  ADD KEY `id_entreprise` (`id_entreprise`),
  ADD KEY `id_entreprise_2` (`id_entreprise`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `id_sta` (`id_sta`),
  ADD KEY `id_sta_2` (`id_sta`);

--
-- Index pour la table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id_commission`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`),
  ADD KEY `id_type_identite` (`id_type_identite`),
  ADD KEY `id_sta` (`id_sta`),
  ADD KEY `id_pays` (`id_pays`),
  ADD KEY `id_type_entreprise` (`id_type_entreprise`);

--
-- Index pour la table `groupe_action`
--
ALTER TABLE `groupe_action`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id_pays`);

--
-- Index pour la table `profil_has_action`
--
ALTER TABLE `profil_has_action`
  ADD KEY `id_profil` (`id_profil`),
  ADD KEY `id_action` (`id_action`);

--
-- Index pour la table `sta`
--
ALTER TABLE `sta`
  ADD PRIMARY KEY (`id_sta`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_entreprise` (`id_entreprise`),
  ADD KEY `id_commission` (`id_commission`),
  ADD KEY `id_sta` (`id_sta`);

--
-- Index pour la table `type_entreprise`
--
ALTER TABLE `type_entreprise`
  ADD PRIMARY KEY (`id_type_entreprise`);

--
-- Index pour la table `type_identite`
--
ALTER TABLE `type_identite`
  ADD PRIMARY KEY (`id_type_identite`);

--
-- Index pour la table `type_users`
--
ALTER TABLE `type_users`
  ADD PRIMARY KEY (`id_typeuser`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo` (`photo`),
  ADD KEY `type_agent` (`type_user`),
  ADD KEY `type_user` (`type_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `action`
--
ALTER TABLE `action`
  MODIFY `id_action` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `cle`
--
ALTER TABLE `cle`
  MODIFY `id_cle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commission`
--
ALTER TABLE `commission`
  MODIFY `id_commission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `groupe_action`
--
ALTER TABLE `groupe_action`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id_pays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sta`
--
ALTER TABLE `sta`
  MODIFY `id_sta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_entreprise`
--
ALTER TABLE `type_entreprise`
  MODIFY `id_type_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_identite`
--
ALTER TABLE `type_identite`
  MODIFY `id_type_identite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cle`
--
ALTER TABLE `cle`
  ADD CONSTRAINT `cle_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_sta`) REFERENCES `sta` (`id_sta`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `entreprise_ibfk_2` FOREIGN KEY (`id_sta`) REFERENCES `sta` (`id_sta`),
  ADD CONSTRAINT `entreprise_ibfk_3` FOREIGN KEY (`id_type_entreprise`) REFERENCES `type_entreprise` (`id_type_entreprise`),
  ADD CONSTRAINT `entreprise_ibfk_4` FOREIGN KEY (`id_type_identite`) REFERENCES `type_identite` (`id_type_identite`),
  ADD CONSTRAINT `entreprise_ibfk_5` FOREIGN KEY (`id_pays`) REFERENCES `pays` (`id_pays`);

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`id_commission`) REFERENCES `commission` (`id_commission`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`id_sta`) REFERENCES `sta` (`id_sta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
