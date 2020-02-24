-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 10, 2018 alle 20:01
-- Versione del server: 10.1.31-MariaDB
-- Versione PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_beekeeperunibg`
--
CREATE DATABASE IF NOT EXISTS `my_beekeeperunibg` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE `my_beekeeperunibg`;

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`id_admin`) VALUES
(0);

-- --------------------------------------------------------

--
-- Struttura della tabella `apiari`
--

DROP TABLE IF EXISTS `apiari`;
CREATE TABLE `apiari` (
  `id_apiario` int(10) NOT NULL,
  `id_venditore` int(10) NOT NULL,
  `luogo` varchar(30) CHARACTER SET latin2 COLLATE latin2_bin DEFAULT NULL,
  `altitudine` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `apiari`
--

INSERT INTO `apiari` (`id_apiario`, `id_venditore`, `luogo`, `altitudine`) VALUES
(9, 1, 'Valle alta', 3000),
(10, 2, 'Valle bassa', 2000);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cliente` int(10) NOT NULL,
  `kg_comprati_tot` int(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `kg_comprati_tot`) VALUES
(3, 100),
(4, 250);

-- --------------------------------------------------------

--
-- Struttura della tabella `colori_regina`
--

DROP TABLE IF EXISTS `colori_regina`;
CREATE TABLE `colori_regina` (
  `id_colore` int(10) NOT NULL,
  `colore` varchar(30) COLLATE latin1_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `colori_regina`
--

INSERT INTO `colori_regina` (`id_colore`, `colore`) VALUES
(1, 'Rosso'),
(2, 'Verde'),
(3, 'Azzurro'),
(4, 'Bianco'),
(5, 'Giallo');

-- --------------------------------------------------------

--
-- Struttura della tabella `famiglie`
--

DROP TABLE IF EXISTS `famiglie`;
CREATE TABLE `famiglie` (
  `id_famiglia` int(10) NOT NULL,
  `id_apiario` int(10) NOT NULL,
  `nome` varchar(30) COLLATE latin1_bin DEFAULT NULL,
  `numero_favi` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `famiglie`
--

INSERT INTO `famiglie` (`id_famiglia`, `id_apiario`, `nome`, `numero_favi`) VALUES
(13, 9, 'FAM A', 15),
(15, 10, 'FAM C', 15),
(14, 9, 'FAM B', 20),
(16, 10, 'FAM D', 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `history_anno`
--

DROP TABLE IF EXISTS `history_anno`;
CREATE TABLE `history_anno` (
  `id_hanno` int(10) NOT NULL,
  `id_famiglia` int(10) NOT NULL,
  `anno` int(10) DEFAULT NULL,
  `quantita_miele` int(10) DEFAULT NULL,
  `colore_regina` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `history_anno`
--

INSERT INTO `history_anno` (`id_hanno`, `id_famiglia`, `anno`, `quantita_miele`, `colore_regina`) VALUES
(19, 14, 2018, 600, 4),
(18, 14, 2017, 400, 4),
(22, 16, 2017, 500, 3),
(21, 15, 2018, 100, 3),
(20, 15, 2017, 750, 5),
(23, 16, 2018, 200, 2),
(17, 13, 2018, 650, 1),
(16, 13, 2017, 500, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `history_mese`
--

DROP TABLE IF EXISTS `history_mese`;
CREATE TABLE `history_mese` (
  `id_hmese` int(10) NOT NULL,
  `id_famiglia` int(10) NOT NULL,
  `data` date DEFAULT '0000-00-00',
  `num_covata` int(10) DEFAULT NULL,
  `in_salute` tinyint(1) DEFAULT NULL,
  `cibato` tinyint(1) DEFAULT NULL,
  `info_agg` text COLLATE latin1_bin
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `history_mese`
--

INSERT INTO `history_mese` (`id_hmese`, `id_famiglia`, `data`, `num_covata`, `in_salute`, `cibato`, `info_agg`) VALUES
(25, 15, '2018-04-01', 5, 1, 1, 'OK'),
(23, 14, '2018-02-01', 5, 0, 0, 'Cibare e curare'),
(22, 13, '2018-05-01', 10, 1, 0, 'Cibare'),
(24, 14, '2018-03-01', 10, 1, 1, 'Ok'),
(21, 13, '2018-04-01', 5, 1, 1, 'Ok'),
(26, 15, '2018-01-01', 10, 0, 1, 'Curare'),
(27, 16, '2018-04-01', 5, 1, 1, 'Ok'),
(28, 16, '2018-03-01', 10, 0, 0, 'Cibare e curare');

-- --------------------------------------------------------

--
-- Struttura della tabella `miele`
--

DROP TABLE IF EXISTS `miele`;
CREATE TABLE `miele` (
  `id_miele` int(10) NOT NULL,
  `id_venditore` int(10) NOT NULL,
  `id_tipo_miele` int(10) NOT NULL,
  `costo_kg` float DEFAULT NULL,
  `disponibilita` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `miele`
--

INSERT INTO `miele` (`id_miele`, `id_venditore`, `id_tipo_miele`, `costo_kg`, `disponibilita`) VALUES
(11, 2, 4, 15, 300),
(10, 2, 3, 25, 190),
(9, 1, 2, 20, 125),
(8, 1, 1, 15, 150);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

DROP TABLE IF EXISTS `prenotazioni`;
CREATE TABLE `prenotazioni` (
  `id_prenotazione` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_miele` int(10) NOT NULL,
  `quantita` int(10) DEFAULT NULL,
  `confermata` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`id_prenotazione`, `id_cliente`, `id_miele`, `quantita`, `confermata`) VALUES
(15, 3, 10, 50, 1),
(16, 3, 11, 50, 0),
(8, 3, 9, 100, 0),
(7, 3, 8, 50, 1),
(12, 4, 9, 25, 0),
(13, 4, 10, 200, 1),
(14, 4, 11, 150, 0),
(17, 3, 8, 25, 0),
(19, 3, 10, 5, 0),
(20, 4, 10, 5, 0),
(27, 4, 8, 50, 1),
(28, 4, 8, 50, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tabella_log`
--

DROP TABLE IF EXISTS `tabella_log`;
CREATE TABLE `tabella_log` (
  `id_tabella_log` int(11) NOT NULL,
  `log` text CHARACTER SET latin1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_miele`
--

DROP TABLE IF EXISTS `tipo_miele`;
CREATE TABLE `tipo_miele` (
  `id_tipo_miele` int(10) NOT NULL,
  `nome_miele` varchar(30) COLLATE latin1_bin DEFAULT NULL,
  `chiarezza` varchar(30) COLLATE latin1_bin DEFAULT NULL,
  `umidita` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `tipo_miele`
--

INSERT INTO `tipo_miele` (`id_tipo_miele`, `nome_miele`, `chiarezza`, `umidita`) VALUES
(1, 'Millefiori', 'medio', 18),
(2, 'Tiglio', 'chiaro', 16),
(3, 'Castagno', 'scuro', 17),
(4, 'Acacia', 'medio', 19);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user` text COLLATE latin1_bin NOT NULL,
  `password` text COLLATE latin1_bin NOT NULL,
  `nome` text COLLATE latin1_bin NOT NULL,
  `cognome` text COLLATE latin1_bin NOT NULL,
  `data_nascita` date NOT NULL DEFAULT '0000-00-00',
  `residenza` text COLLATE latin1_bin NOT NULL,
  `num_tel` varchar(30) COLLATE latin1_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id_user`, `user`, `password`, `nome`, `cognome`, `data_nascita`, `residenza`, `num_tel`) VALUES
(0, 'admin', 'noaFTDaLb.amM', 'Admin', 'Admin', '1970-01-01', 'Amministrazione', '00000'),
(1, 'venditore1', 'noTsY29djh14A', 'Mario', 'Rossi', '1982-02-20', 'Milano', '34811'),
(2, 'venditore2', 'noTsY29djh14A', 'Luigi', 'Bianchi', '1975-05-25', 'Roma', '34822'),
(3, 'cliente1', 'noBuFKi2gzC/E', 'Giuseppe', 'Verdi', '1963-10-10', 'Parma', '34831'),
(4, 'cliente2', 'noeUeWsywkLcM', 'Marco', 'Viola', '1965-08-15', 'Firenze', '38442');

--
-- Trigger `users`
--
DROP TRIGGER IF EXISTS `delete_is_a`;
DELIMITER $$
CREATE TRIGGER `delete_is_a` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
DELETE FROM cliente WHERE id_cliente = old.id_user;
DELETE FROM venditore WHERE id_venditore = old.id_user;
DELETE FROM admin WHERE id_admin = old.id_user;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `log_delete`;
DELIMITER $$
CREATE TRIGGER `log_delete` AFTER DELETE ON `users` FOR EACH ROW INSERT INTO tabella_log (id_tabella_log, log) VALUES (null, CONCAT('Utente "', old.user,'" eliminato dalla tabella'))
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `log_insert`;
DELIMITER $$
CREATE TRIGGER `log_insert` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO tabella_log (id_tabella_log, log) VALUES (null, CONCAT('Utente "', new.user,'" aggiunto alla tabella'))
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `log_update`;
DELIMITER $$
CREATE TRIGGER `log_update` BEFORE UPDATE ON `users` FOR EACH ROW INSERT INTO tabella_log (id_tabella_log, log) VALUES (null, CONCAT('Utente "', new.user,'" aggiornato'))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore`
--

DROP TABLE IF EXISTS `venditore`;
CREATE TABLE `venditore` (
  `id_venditore` int(10) NOT NULL,
  `kg_venduti_tot` int(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dump dei dati per la tabella `venditore`
--

INSERT INTO `venditore` (`id_venditore`, `kg_venduti_tot`) VALUES
(1, 100),
(2, 250);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indici per le tabelle `apiari`
--
ALTER TABLE `apiari`
  ADD PRIMARY KEY (`id_apiario`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indici per le tabelle `colori_regina`
--
ALTER TABLE `colori_regina`
  ADD PRIMARY KEY (`id_colore`);

--
-- Indici per le tabelle `famiglie`
--
ALTER TABLE `famiglie`
  ADD PRIMARY KEY (`id_famiglia`);

--
-- Indici per le tabelle `history_anno`
--
ALTER TABLE `history_anno`
  ADD PRIMARY KEY (`id_hanno`);

--
-- Indici per le tabelle `history_mese`
--
ALTER TABLE `history_mese`
  ADD PRIMARY KEY (`id_hmese`);

--
-- Indici per le tabelle `miele`
--
ALTER TABLE `miele`
  ADD PRIMARY KEY (`id_miele`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id_prenotazione`);

--
-- Indici per le tabelle `tabella_log`
--
ALTER TABLE `tabella_log`
  ADD PRIMARY KEY (`id_tabella_log`);

--
-- Indici per le tabelle `tipo_miele`
--
ALTER TABLE `tipo_miele`
  ADD PRIMARY KEY (`id_tipo_miele`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indici per le tabelle `venditore`
--
ALTER TABLE `venditore`
  ADD PRIMARY KEY (`id_venditore`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1256;

--
-- AUTO_INCREMENT per la tabella `apiari`
--
ALTER TABLE `apiari`
  MODIFY `id_apiario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `colori_regina`
--
ALTER TABLE `colori_regina`
  MODIFY `id_colore` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `famiglie`
--
ALTER TABLE `famiglie`
  MODIFY `id_famiglia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `history_anno`
--
ALTER TABLE `history_anno`
  MODIFY `id_hanno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `history_mese`
--
ALTER TABLE `history_mese`
  MODIFY `id_hmese` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT per la tabella `miele`
--
ALTER TABLE `miele`
  MODIFY `id_miele` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id_prenotazione` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT per la tabella `tabella_log`
--
ALTER TABLE `tabella_log`
  MODIFY `id_tabella_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT per la tabella `tipo_miele`
--
ALTER TABLE `tipo_miele`
  MODIFY `id_tipo_miele` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `venditore`
--
ALTER TABLE `venditore`
  MODIFY `id_venditore` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
