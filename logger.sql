-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 11:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logger`
--

-- --------------------------------------------------------

--
-- Table structure for table `informaticiens`
--

CREATE TABLE `informaticiens` (
  `idInformaticien` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `identifiant` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informaticiens`
--

INSERT INTO `informaticiens` (`idInformaticien`, `nom`, `prenom`, `motDePasse`, `identifiant`) VALUES
(1, 'Dimpré', 'Jean Sebastien', 'pass', 'js.dimpre'),
(2, 'Bensoussan', 'Jeremie', 'pass', 'j.bensoussan'),
(3, 'Naingui', 'Christopher', 'pass', 'c.naingui');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `contenuTicket` varchar(300) NOT NULL,
  `severiteTicket` int(11) NOT NULL,
  `erreur` varchar(100) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `titreTicket` varchar(50) NOT NULL,
  `dateCreationTicket` date NOT NULL DEFAULT current_timestamp(),
  `nomEmetteurTicket` varchar(50) NOT NULL,
  `prenomEmetteurTicket` varchar(50) NOT NULL,
  `solutionTicket` varchar(300) NOT NULL,
  `idEmetteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
  `nomUtilisateur` varchar(50) NOT NULL,
  `prenomUtilisateur` varchar(50) NOT NULL,
  `identifiantUtilisateur` varchar(25) NOT NULL,
  `motDePasseUtilisateur` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `identifiantUtilisateur`, `motDePasseUtilisateur`) VALUES
(1, 'Durand', 'Philipe', 'p.durand', 'pass'),
(2, 'Dubuc', 'Stephane', 's.dubuc', 'pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informaticiens`
--
ALTER TABLE `informaticiens`
  ADD PRIMARY KEY (`idInformaticien`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informaticiens`
--
ALTER TABLE `informaticiens`
  MODIFY `idInformaticien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
