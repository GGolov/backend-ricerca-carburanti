-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mag 30, 2017 alle 08:35
-- Versione del server: 5.6.33-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_ggtests`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `impianti`
--

CREATE TABLE IF NOT EXISTS `impianti` (
  `idImpianto` int(11) NOT NULL,
  `Gestore` varchar(247) CHARACTER SET latin1 NOT NULL,
  `Bandiera` varchar(24) CHARACTER SET latin1 NOT NULL,
  `Tipo_Impianto` varchar(14) CHARACTER SET latin1 NOT NULL,
  `Nome_Impianto` varchar(96) CHARACTER SET latin1 NOT NULL,
  `Indirizzo` varchar(106) CHARACTER SET latin1 NOT NULL,
  `Comune` varchar(34) CHARACTER SET latin1 NOT NULL,
  `Provincia` varchar(2) CHARACTER SET latin1 NOT NULL,
  `Latitudine` decimal(18,15) NOT NULL,
  `Longitudine` decimal(20,16) NOT NULL,
  PRIMARY KEY (`idImpianto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
