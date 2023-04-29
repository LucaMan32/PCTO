-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 19, 2021 alle 09:05
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `azienda`
--

CREATE TABLE `azienda` (
  `NomeA` varchar(15) NOT NULL,
  `Città` varchar(15) NOT NULL,
  `Indirizzo` varchar(50) NOT NULL,
  `Email` varchar(16) NOT NULL,
  `N_Telefono` varchar(12) NOT NULL,
  `Tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `azienda`
--

INSERT INTO `azienda` (`NomeA`, `Città`, `Indirizzo`, `Email`, `N_Telefono`, `Tipo`) VALUES
('Acer', 'Roma', 'Via Rossi 80', 'acer.com', '123', 'Informatica'),
('Dechatlon', 'Venezia', 'Via Vittorio Veneto', 'direzione@dechat', '098', 'Altro'),
('Game Stop', 'Genova', 'Via Parini 8', 'gamestop.com', '123', 'Elettronica'),
('Mediaworld', 'Milano', 'Corso Como 3', 'mediaworld.com', '123', 'Elettronica'),
('Microsoft', 'Milano', 'Via dei MIle 3', 'microsoft.com', '123', 'Informatica');

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `Cod_Corso` int(4) NOT NULL,
  `OreC` int(2) NOT NULL,
  `DataEsame` date NOT NULL,
  `NomeA` varchar(15) NOT NULL,
  `Matricola` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`Cod_Corso`, `OreC`, `DataEsame`, `NomeA`, `Matricola`) VALUES
(7, 20, '2021-04-06', 'Game Stop', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `stage`
--

CREATE TABLE `stage` (
  `Cod_Stage` int(4) NOT NULL,
  `Anno` int(4) NOT NULL,
  `Durata` int(11) NOT NULL,
  `NomeA` varchar(15) NOT NULL,
  `Matricola` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stage`
--

INSERT INTO `stage` (`Cod_Stage`, `Anno`, `Durata`, `NomeA`, `Matricola`) VALUES
(1, 2019, 10, 'Acer', 7),
(9, 2020, 20, 'Microsoft', 8),
(11, 2019, 15, 'Game Stop', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `studente`
--

CREATE TABLE `studente` (
  `Matricola` int(4) NOT NULL,
  `Nome` varchar(15) NOT NULL,
  `Cognome` varchar(15) NOT NULL,
  `Cod_Fiscale` varchar(16) NOT NULL,
  `Data_Nascita` date NOT NULL,
  `Classe` varchar(5) NOT NULL,
  `OrePCTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `studente`
--

INSERT INTO `studente` (`Matricola`, `Nome`, `Cognome`, `Cod_Fiscale`, `Data_Nascita`, `Classe`, `OrePCTO`) VALUES
(2, 'Edoardo ', 'Esposito', 'ESPEDR23E21918JM', '2021-03-21', '4IA1', 120),
(3, 'Luca', 'Rossi', 'bmnht562621921', '2021-03-03', '3AL', 0),
(4, 'Lorenzo', 'Verdi', 'lkjhsad', '2021-04-07', '4IA1', 9),
(5, 'Andrea', 'Bianchi', 'dfdasdada', '2021-04-15', '5IA1', 80),
(6, 'Giacomo', 'Ricci', 'ndhdhshdhs', '2021-04-16', '4IA1', 10),
(7, 'Gianluca', 'Molin', 'bmnht562621921', '2020-05-05', '2A', 0),
(8, 'Patrizio', 'Damante', 'PTDJsjuasgfsa', '2021-04-26', '3B', 120),
(9, 'William', 'Casati', 'WLLCST09A22E213C', '2021-04-06', '2A', 0),
(19, 'LORENZO', 'VERDI', 'fafaffaf', '2002-09-20', '5IA1', 23);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `idUtente` varchar(40) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`idUtente`, `nome`, `cognome`, `password`, `hash`) VALUES
('concetta@iismajorana.edu.it', '', '', 'cOncetta.12345', '$2y$10$NydVxhE4izYAjTbYJxgecu2fAocT1M2XvffSD.KjdI8HXVcx5xZ/6'),
('matteo@iismajorana.edu.it', 'Matteo', 'Barone', 'mAtteo.12345', '$2y$10$jhBTDB0yPt2Q5iHJzDwyzeSO2bJ8rcAr1WjgE48PyKQg58JI6C7QG');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `azienda`
--
ALTER TABLE `azienda`
  ADD PRIMARY KEY (`NomeA`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`Cod_Corso`),
  ADD KEY `Matricola` (`Matricola`),
  ADD KEY `NomeA` (`NomeA`);

--
-- Indici per le tabelle `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`Cod_Stage`),
  ADD KEY `NomeAzienda` (`NomeA`),
  ADD KEY `Matricola` (`Matricola`);

--
-- Indici per le tabelle `studente`
--
ALTER TABLE `studente`
  ADD PRIMARY KEY (`Matricola`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUtente`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `corso_ibfk_1` FOREIGN KEY (`Matricola`) REFERENCES `studente` (`Matricola`),
  ADD CONSTRAINT `corso_ibfk_2` FOREIGN KEY (`NomeA`) REFERENCES `azienda` (`NomeA`);

--
-- Limiti per la tabella `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`Matricola`) REFERENCES `studente` (`Matricola`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`NomeA`) REFERENCES `azienda` (`NomeA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
