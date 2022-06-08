-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 01:12 AM
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
  `identifiant` varchar(50) NOT NULL,
  `supportRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informaticiens`
--

INSERT INTO `informaticiens` (`idInformaticien`, `nom`, `prenom`, `motDePasse`, `identifiant`, `supportRole`) VALUES
(1, 'Dimpré', 'Jean Sebastien', 'pass', 'js.dimpre', 1),
(2, 'Bensoussan', 'Jeremie', 'pass', 'j.bensoussan', 2),
(3, 'Naingui', 'Christopher', 'pass', 'c.naingui', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `contenuTicket` varchar(2500) NOT NULL,
  `severiteTicket` int(11) NOT NULL,
  `ticketLevel` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `titreTicket` varchar(50) NOT NULL,
  `dateCreationTicket` date NOT NULL DEFAULT current_timestamp(),
  `nomEmetteurTicket` varchar(50) NOT NULL,
  `prenomEmetteurTicket` varchar(50) NOT NULL,
  `solutionTicket` varchar(300) NOT NULL,
  `idEmetteur` int(11) NOT NULL,
  `dateResolution` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`idTicket`, `contenuTicket`, `severiteTicket`, `ticketLevel`, `statut`, `titreTicket`, `dateCreationTicket`, `nomEmetteurTicket`, `prenomEmetteurTicket`, `solutionTicket`, `idEmetteur`, `dateResolution`) VALUES
(372, 'Ma souris ne fonctionne plus, que faire ?', 3, 0, 0, 'PROBLEME DE SOURIS', '2022-05-29', 'E', 'E', 'rrr', 3, '2022-05-28'),
(373, 'Bonjour, j&#039;ai un soucis avobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLobject.parentNode.children[9].innerHTMLec ma souris de bureau. Aidez moi! qwiuohfgo3h gfoegoiejhgoieqjgqegoijeqopigjeqoigj eqoigjoiqegj oqiegj eoq[g j[eqoijgoiqerjgiqergjoeiqrg hjqeogj ojgo[ijeqoigjeqoigjhqoegjgoigrjoigejroieq jgioeqjgoiqegjnoieqrjgoeiqrj eoqri jeqrog jqeroij goij oier gfjopierqg iopeqrg ijssssssssssssssssss', 3, 0, 0, 'PROBLEME DE SOURIS', '2022-05-29', 'E', 'E', 'wwww', 3, '2022-05-28'),
(374, 'En mathématiques le problème des souris (ou des trois ou quatre chiens) est un problème de poursuite et d\'interception dans lequel on recherche le parcours et le point de rencontre de souris, placées initialement aux coins d\'un polygone régulier, qui se poursuivent.\r\n\r\nOn suppose quatre souris au sommet d\'un carré unitaire ABCD. La souris A poursuit la souris B qui poursuit la souris C qui poursuit la souris D qui poursuit la souris A. Les quatre souris se déplacent à la même vitesse constante unitaire. Au fur et à mesure des déplacements les souris parcourent des segments de droites et modifient leur trajectoire pour rester en direction de leur cible. Les souris se rencontrent après un temps d\'une unité car la distance entre deux souris voisines décroit toujours à la vitesse d\'une unité.', 1, 0, 1, 'PROBLEME DE SOURIS', '2022-05-28', 'Varricchione', 'Adrien', 'ewdfwedfrrfewfwwfer', 3, '2022-05-28'),
(375, 'Bonjour, j&#039;ai un soucis avec mon clavier d&#039;ordinateur, en effet, celui ci ne veut pas ecrire la lettre A. Que faire ?', 1, 2, 0, 'SOURIS DEFFECTUEUSE', '2022-05-29', 'Varricchione', 'Adrien', 'SOLUTION ICI', 3, '2022-05-28'),
(376, 'Voila je n&#039;ai plus de connexion internet.', 1, 0, 1, 'SOUCIS RESEAU', '2022-05-28', 'Jean-Pierre', 'Masia', 'ddd', 3, '2022-05-28'),
(377, 'Bonjour, j&#039;ai un soucis avec mon clavier d&#039;ordinateur, en effet, celui ci ne veut pas ecrire la putain de lettre A. Que faire ?', 1, 0, 1, 'SOUCIS CLAVIER', '2022-05-28', 'Dupont', 'Jean', 'wwwww', 3, '2022-05-28'),
(379, 'TESTDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDTESTDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDTESTDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD', 0, 0, 1, 'TEST', '2022-05-28', 'TEST', 'TEST', 'wwww', 3, '2022-05-28'),
(380, 'tertertetetettewyihuofihuobefriufrbheyirufehbwefruiphbferwibuhpfrewiuphbuhibvepr9fwuihpbefriuybgherfviuypgbhferqughybfervqiuypgbhefrqv', 0, 0, 1, 'TEST 255', '2022-05-28', 'Varricchione', 'Adrien', 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 3, '2022-05-28'),
(381, 'Bonjour je voudrais signaler que Elyas est une grosse salope. Merci de votre reponse ca c&#039;est actuellement une plaie de se taper ce mec en vocal sur discord a 11h42 du soir. QUE FAITES VOUS???!!!!!!!!!!!!!!!!!!!! U89HG7FIOR4532HUIBGOPF;3R42HOUBINP;3F24R1HOUNIP[ERQHUIO09[REFG2QUHOIP9[OUPFHIRWEQUHIO[WEQRFOPUIHBGFGVERWQUHBOIPWQERFGTOUIPHWEQRFOHUBIPWEFQR + Se fout de ma gueule', 0, 0, 0, 'ELYAS LA SALOPE', '2022-05-29', 'Dupont', 'Jean', 'wwww', 3, NULL);

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
(2, 'Dubuc', 'Stephane', 's.dubuc', 'pass'),
(3, 'Durand', 'Philipe', 'p.durand', 'pass');

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
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
