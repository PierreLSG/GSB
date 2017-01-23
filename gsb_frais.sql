-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 05 Août 2016 à 16:18
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gsb_frais`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
`id` int(11) NOT NULL,
  `idVisiteur` int(11) NOT NULL,
  `idFicheFrais` int(11) NOT NULL,
  `commentaire` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `idVisiteur`, `idFicheFrais`, `commentaire`) VALUES
(1, 3, 2, 'Rien a signaler');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
`id` int(11) NOT NULL,
  `libelle` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
(1, 'Saisie clôturée'),
(2, 'Fiche créée, saisie en cours'),
(3, 'Remboursée'),
(4, 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE IF NOT EXISTS `fichefrais` (
`id` int(11) NOT NULL,
  `idVisiteur` int(11) NOT NULL,
  `idEtat` int(11) NOT NULL,
  `dateFrais` date NOT NULL,
  `nbJustificatifs` int(11) NOT NULL,
  `montantValide` decimal(10,2) NOT NULL,
  `dateModif` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fichefrais`
--

INSERT INTO `fichefrais` (`id`, `idVisiteur`, `idEtat`, `dateFrais`, `nbJustificatifs`, `montantValide`, `dateModif`) VALUES
(2, 3, 4, '2016-07-04', 2, '1575.00', '2016-07-04');

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE IF NOT EXISTS `fonction` (
`id` int(11) NOT NULL,
  `libelle` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`id`, `libelle`) VALUES
(1, 'admin'),
(2, 'visiteur'),
(3, 'comptable');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE IF NOT EXISTS `fraisforfait` (
`id` int(11) NOT NULL,
  `libelle` varchar(100) CHARACTER SET utf8 NOT NULL,
  `montant` decimal(5,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
(1, 'Forfait Etape', '110.00'),
(2, 'Frais Kilométrique', '0.62'),
(3, 'Nuitée Hôtel', '80.00'),
(4, 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE IF NOT EXISTS `lignefraisforfait` (
`id` int(11) NOT NULL,
  `idFicheFrais` int(11) NOT NULL,
  `idVisiteur` int(11) NOT NULL,
  `idFraisForfait` int(11) NOT NULL,
  `mois` varchar(10) CHARACTER SET utf8 NOT NULL,
  `quantite` int(11) NOT NULL,
  `date` date NOT NULL,
  `valider` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`id`, `idFicheFrais`, `idVisiteur`, `idFraisForfait`, `mois`, `quantite`, `date`, `valider`) VALUES
(1, 2, 3, 2, '2016-08-01', 50, '2016-08-04', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE IF NOT EXISTS `lignefraishorsforfait` (
`id` int(11) NOT NULL,
  `idFicheFrais` int(11) NOT NULL,
  `idVisiteur` int(11) NOT NULL,
  `libelle` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `montant` decimal(10,0) NOT NULL,
  `justificatif` varchar(255) NOT NULL,
  `dateSaissie` date NOT NULL,
  `valider` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `idFicheFrais`, `idVisiteur`, `libelle`, `date`, `montant`, `justificatif`, `dateSaissie`, `valider`) VALUES
(1, 2, 3, 'resto', '2016-08-02', '100', 'Calendrier L1-SIO 15-17 A.pdf', '2016-08-04', 1),
(2, 2, 3, 'rest', '2016-08-07', '1444', 'Calendrier L1-SIO 15-17 A - Copie.pdf', '2016-08-05', 1),
(3, 2, 3, 'resto', '2016-08-02', '447', '', '2016-07-05', 0);

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
`id` int(11) NOT NULL,
  `nom` varchar(250) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(250) CHARACTER SET utf8 NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 NOT NULL,
  `mdp` varchar(100) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cp` varchar(5) CHARACTER SET utf8 NOT NULL,
  `ville` varchar(50) CHARACTER SET utf8 NOT NULL,
  `dateEmbauche` date NOT NULL,
  `idFonction` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`, `idFonction`) VALUES
(1, 'Renon', 'Jérémy', 'Jrenon', 'c044f4dd6964056a421d15b54a29e0710f55e30f', '63 rue de Verdun', '69100', 'villeurbanne', '2016-04-11', 1),
(3, 'visiteur', 'visiteur', 'visiteur', '922391a72f5d8792a0b66b6cb3674d5eae454bda', '69 rue de la chambre', '69120', 'Vaulx en Velin', '2000-02-02', 2),
(4, 'comptable', 'comptable', 'comptable', '4e2db6fec2963c59052e9068b82b12a07e376a8f', '63 rue de la pipe', '69000', 'lyon', '1996-02-22', 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fonction`
--
ALTER TABLE `fonction`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fraisforfait`
--
ALTER TABLE `fraisforfait`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `fonction`
--
ALTER TABLE `fonction`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `fraisforfait`
--
ALTER TABLE `fraisforfait`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `visiteur`
--
ALTER TABLE `visiteur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
