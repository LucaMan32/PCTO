
CREATE DATABASE pcto;

USE pcto;

CREATE TABLE `azienda` (
  `NomeA` varchar(15) NOT NULL,
  `Città` varchar(15) NOT NULL,
  `Indirizzo` varchar(50) NOT NULL,
  `Email` varchar(16) NOT NULL,
  `N_Telefono` varchar(12) NOT NULL,
  `Tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `azienda`
--

INSERT INTO `azienda` (`NomeA`, `Città`, `Indirizzo`, `Email`, `N_Telefono`, `Tipo`) VALUES
('Acer', 'Roma', 'Via Rossi 80', 'acer@gmail.com', '123456789', 'Informatica'),
('Apple', 'Toronto', Via Canada 71', 'apple@gmail.com', '123456789', 'Informatica'),
('Dechatlon', 'Venezia', 'Via Vittorio Veneto 12', 'direzione@dechat.com', '123456789', 'Altro'),
('Game Stop', 'Genova', 'Via Parini 8', 'gamestop@gs.com', '123456789', 'Elettronica'),
('Mediaworld', 'Milano', 'Corso Como 3', 'mediaworld@gmail.com', '123456789', 'Elettronica'),
('Microsoft', 'Milano', 'Via dei MIle 3', 'microsoft@window.com', '123456789', 'Informatica');

CREATE TABLE `corso` (
  `Cod_Corso` int(4) NOT NULL,
  `OreC` int(2) NOT NULL,
  `DataEsame` date NOT NULL,
  `NomeA` varchar(15) NOT NULL,
  `Matricola` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `corso` (`Cod_Corso`, `OreC`, `DataEsame`, `NomeA`, `Matricola`) VALUES
(7, 20, '2020-04-06', 'Game Stop', 7);

CREATE TABLE `stage` (
  `Cod_Stage` int(4) NOT NULL,
  `Anno` int(4) NOT NULL,
  `Durata` int(11) NOT NULL,
  `NomeA` varchar(15) NOT NULL,
  `Matricola` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `stage` (`Cod_Stage`, `Anno`, `Durata`, `NomeA`, `Matricola`) VALUES
(1, 2020, 10, 'Acer', 7),
(3, 2020, 20, 'Microsoft', 8),
(2, 2020, 15, 'Game Stop', 6);

CREATE TABLE `studente` (
  `Matricola` int(4) NOT NULL,
  `Nome` varchar(15) NOT NULL,
  `Cognome` varchar(15) NOT NULL,
  `Cod_Fiscale` varchar(16) NOT NULL,
  `Data_Nascita` date NOT NULL,
  `Classe` varchar(5) NOT NULL,
  `OrePCTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `studente` (`Matricola`, `Nome`, `Cognome`, `Cod_Fiscale`, `Data_Nascita`, `Classe`, `OrePCTO`) VALUES
(2, 'Edoardo ', 'Esposito', 'ESPEDR23E21918JM', '2021-03-21', '4IA1', 120),
(3, 'Luca', 'Rossi', 'bmnht562621921', '2021-03-03', '3AL', 0),
(4, 'Lorenzo', 'Verdi', 'lkjhsad', '2021-04-07', '4IA1', 9),
(5, 'Andrea', 'Bianchi', 'dfdasdada', '2021-04-15', '5IA1', 80),
(6, 'Giacomo', 'Ricci', 'ndhdhshdhs', '2021-04-16', '4IA1', 10),
(7, 'Gianluca', 'Molin', 'bmnht562621921', '2020-05-05', '2A', 0),
(8, 'Patrizio', 'Damante', 'PTDJsjuasgfsa', '2021-04-26', '3B', 120),
(9, 'William', 'Casati', 'WLLCST09A22E213C', '2021-04-06', '2A', 0),

CREATE TABLE `users` (
  `idUtente` varchar(40) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`idUtente`, `nome`, `cognome`, `password`, `hash`) VALUES
('concetta@coordinatore.edu.it', 'Concetta', 'Perone', 'cOncetta.12345', '$2y$10$NydVxhE4izYAjTbYJxgecu2fAocT1M2XvffSD.KjdI8HXVcx5xZ/6'),
('matteo@iismajorana.edu.it', 'Matteo', 'Insigne', 'mAtteo.12345', '$2y$10$jhBTDB0yPt2Q5iHJzDwyzeSO2bJ8rcAr1WjgE48PyKQg58JI6C7QG');

ALTER TABLE `azienda`
  ADD PRIMARY KEY (`NomeA`);

ALTER TABLE `corso`
  ADD PRIMARY KEY (`Cod_Corso`),
  ADD KEY `Matricola` (`Matricola`),
  ADD KEY `NomeA` (`NomeA`);

ALTER TABLE `stage`
  ADD PRIMARY KEY (`Cod_Stage`),
  ADD KEY `NomeAzienda` (`NomeA`),
  ADD KEY `Matricola` (`Matricola`);

ALTER TABLE `studente`
  ADD PRIMARY KEY (`Matricola`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`idUtente`);

ALTER TABLE `corso`
  ADD CONSTRAINT `corso_ibfk_1` FOREIGN KEY (`Matricola`) REFERENCES `studente` (`Matricola`),
  ADD CONSTRAINT `corso_ibfk_2` FOREIGN KEY (`NomeA`) REFERENCES `azienda` (`NomeA`);

ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`Matricola`) REFERENCES `studente` (`Matricola`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`NomeA`) REFERENCES `azienda` (`NomeA`);
COMMIT;
