-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 jul 2023 om 16:12
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beeway`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beeway`
--

CREATE TABLE `beeway` (
  `beewayid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `groupid` varchar(11) NOT NULL,
  `beewayname` varchar(155) NOT NULL,
  `begood` varchar(3) DEFAULT NULL,
  `beenough` varchar(3) DEFAULT NULL,
  `benotgood` varchar(3) DEFAULT NULL,
  `mainthemeid` varchar(11) NOT NULL,
  `themeperiodid` int(11) NOT NULL,
  `disciplineid` varchar(11) NOT NULL,
  `concretegoal` varchar(2500) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `lock` int(11) NOT NULL DEFAULT 0 COMMENT '0=unlocked\r\nanything else=locked',
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `beeway`
--

INSERT INTO `beeway` (`beewayid`, `schoolid`, `groupid`, `beewayname`, `begood`, `beenough`, `benotgood`, `mainthemeid`, `themeperiodid`, `disciplineid`, `concretegoal`, `status`, `lock`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(24, 1, '5', '2 333333', '2', '2', '2', '1', 1, '2', '2sdfsdfsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfasdf\r\nsdfsfasdfas\r\ndfasdfadfasdf sadf sdf sd\r\n\r\nasdf afsdfasdf \r\nasdf \r\nsad\r\n\r\n\r\n\r\nsadfasdf fsdf s', '0', 3, '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', 3, 0, NULL, NULL),
(25, 2, '9', '5', '5', '5', '5', '1', 1, '2', '5', '0', 0, '2023-06-13 11:09:41', NULL, '2023-06-13 11:09:41', 3, 0, NULL, NULL),
(26, 1, '8', 'test 6 7 88888888', '6', '6', '6', '4', 4, '2', '6666666 7777777\r\n8888888 9999999\r\n1010101 1111111\r\n2222222 3333333\r\n4444444dfsd df sd fsd fsdf \r\n\r\n\r\nde 8ters update test', '0', 0, '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', 2, 0, NULL, NULL),
(28, 1, '1', 'test test 223', '1', '1', '1', '1', 1, '1', 'sdfsdfsdfsdf', '0', 0, '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', 2, 0, NULL, NULL),
(29, 1, '4', 'test delete', '1', '', '', '1', 1, '11', 'test delete\r\n\r\ntest met nieuwe textereas\r\ntest met nieuwe textereas\r\ntest met nieuwe textereas\r\ntest met nieuwe textereas\r\ntest met nieuwe textereas\r\ntest met nieuwe textereas', '0', 0, '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', 3, 1, '2023-06-27 09:00:41', 3),
(30, 1, '5', 'bb', '', '', '', '1', 1, '1', 'bb', '0', 0, '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beewayobservation`
--

CREATE TABLE `beewayobservation` (
  `observationid` int(11) NOT NULL,
  `beewayid` int(11) NOT NULL,
  `dataclass` varchar(2500) DEFAULT NULL,
  `learninggoal` varchar(2500) DEFAULT NULL,
  `evaluation` varchar(2500) DEFAULT NULL,
  `workgoal` varchar(2500) DEFAULT NULL,
  `action` varchar(2500) DEFAULT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) NOT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `beewayobservation`
--

INSERT INTO `beewayobservation` (`observationid`, `beewayid`, `dataclass`, `learninggoal`, `evaluation`, `workgoal`, `action`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(1, 24, 'o', 'o', 'o', 'odsfdf     sddsdsddssd', 'odsfsdfsdfsdfsdfsdfsdfs', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(2, 24, 'o', 'o', 'o', 'o', 'osdfsdfsdfsdf', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(3, 24, 'o', 'o', 'o', 'o', 'o', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(4, 24, 'o', 'o', 'o', 'o', '', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(5, 24, 'o', 'o', 'oo', 'o', 'o', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(6, 24, 'o', 'o', '', 'oo', 'o', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(7, 24, 'o', 'o', 'o', 'o', 'o', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(8, 24, 'o', 'oo', 'o', 'o', 'o', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(9, 25, 'jhgf', 'gf', 'hjgf', 'h', 'fkhv', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(10, 25, ' ', 'nbv', 'nbv', 'b', 'v', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(11, 25, 'b', 'v', 'mbv', 'v', 'nbv', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(12, 25, '', '', 'vb', 'nmv', 'nbvnbv', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(13, 25, 'nbv', '', '', 'bv', 'nbv', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(14, 25, 'nmbv', 'b', '', '', 'bv', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(15, 25, 'nmbv', 'nbv', 'nbv', 'bv', 'nbv', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(16, 25, '', 'bnvnbvn', '', '', '', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL),
(17, 26, '7', '7', '7', '7', '7', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(18, 26, '7', '7', '8', '8', '8', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(19, 26, '7', '8', '7', '77', '7', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(20, 26, '7', '7', '8', '8', '8', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(21, 26, '7', '7', '7', '77', '7', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(22, 26, '8', '8', '8', '8', '8', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(23, 26, '7', '77', '7', '7', '7', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(24, 26, '7', '8', '8', '77777777777777777777', '88888888', '2023-06-14 10:58:46', 0, '2023-06-14 10:58:46', 0, 0, NULL, NULL),
(25, 28, '11', '11', '', '11', '11', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(26, 28, '11', '11', '1', '11', '11', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(27, 28, '11', '1', '11', '11', '11', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(28, 28, '2', '1', '1', '1', '11', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(29, 28, '11', '11', '11', '11', '1', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(30, 28, '1', '2', '1', '1', '1', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(31, 28, '1', '1', '2', '11', '11', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(32, 28, '11', '11', '2', '1', '1', '2023-06-26 14:43:23', 0, '2023-06-26 14:43:23', 0, 0, NULL, NULL),
(33, 29, '', '222', '', '', '', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(34, 29, '', '', '', '', '', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(35, 29, '', '2', 'test delete', '22', '2', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(36, 29, '2', '2', '', '2', '', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(37, 29, '', '', '2', '', '2', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(38, 29, '2', 'test delete', 'test delete', '', '', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(39, 29, '', '', '', '', '', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(40, 29, '', 'test delete', '', '', '', '2023-06-27 08:54:16', 0, '2023-06-27 08:54:16', 0, 1, '2023-06-27 09:00:41', 3),
(41, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL),
(42, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL),
(43, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL),
(44, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL),
(45, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL),
(46, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL),
(47, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL),
(48, 30, '', '', '', '', '', '2023-06-27 13:52:23', 0, '2023-06-27 13:52:23', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beewayplanning`
--

CREATE TABLE `beewayplanning` (
  `planningid` int(11) NOT NULL,
  `beewayid` int(11) NOT NULL,
  `planning` varchar(155) DEFAULT NULL,
  `planningwhat` varchar(2500) DEFAULT NULL,
  `planningwho` varchar(2500) DEFAULT NULL,
  `planningdeadline` varchar(255) DEFAULT NULL,
  `planningdone` varchar(4) DEFAULT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `beewayplanning`
--

INSERT INTO `beewayplanning` (`planningid`, `beewayid`, `planning`, `planningwhat`, `planningwho`, `planningdeadline`, `planningdone`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedBy`) VALUES
(1, 24, 'p', 'p', 'p', 'p', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(2, 24, 'p', 'p', 'p', 'p', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(3, 24, 'p', 'p', 'p', 'p', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(4, 24, 'p', 'p', 'p', 'p', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(5, 24, 'p', 'p', 'pddf sdf s df sdf  sdfsdfsdf sdfsdf asdfeth\r\ndfsdf sd fsdf sdfsdf sdf s\r\nfsf', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(6, 24, 'p', 'p', 'p', 'p', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(7, 24, 'p', 'p', 'pp', 'p', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(8, 24, 'p', 'p', 'p', 'p', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(9, 25, '', 'jkj', 'hkj', 'jk', '1', '2023-06-13 11:09:41', NULL, '2023-06-13 11:09:41', NULL, 0, NULL, NULL),
(10, 25, 'hjgf', 'g', 'fh', 'gf', '1', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(11, 25, '', 'gf', 'hgf', 'hjgf', '1', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(12, 25, 'gfjh', 'gf', 'hjgf', 'g', '1', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(13, 25, 'gf', 'jhg', 'f', 'hjgf', '1', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(14, 25, 'fj', 'gf', 'hjgf', 'hjg', '1', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(15, 25, 'hjgf', 'hjg', 'fhj', 'gf', '1', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(16, 25, 'fhj', 'gf', 'j', 'fj', '1', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(17, 26, '6', '8', '8', '8', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(18, 26, '6', '6', '6', '6', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(19, 26, '6', '6', '6', '6', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(20, 26, '6', '6', '66', '6', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(21, 26, '6', '6', '6', '6', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(22, 26, '6', '6', '6', '6', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(23, 26, '6', '8', '8', '8', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(24, 26, '8', '8', '8', '8', '1', '2023-06-14 10:58:46', NULL, '2023-06-14 10:58:46', NULL, 0, NULL, NULL),
(25, 28, '1', '1', '1', '111111111111111', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(26, 28, '2', '1', '1', '1', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(27, 28, '1', '1', '1', '1', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(28, 28, '1', '1', '1', '1', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(29, 28, '1', '2', '1', '1', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(30, 28, '2', '2', '2', '2', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(31, 28, '2', '2', '1', '2', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(32, 28, '2', '1', '11', '11', '1', '2023-06-26 14:43:23', NULL, '2023-06-26 14:43:23', NULL, 0, NULL, NULL),
(33, 29, 'test delete', '2', '2', '2', '1', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(34, 29, '2', '2', '22', '2', '1', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(35, 29, '2', '', '2', '2', '0', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(36, 29, '2', '2', '', '22', '0', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(37, 29, '2', '2test delete', '2', '2', '1', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(38, 29, '22', '2', '2', '', '0', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(39, 29, '2', '2', '2', '', '0', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(40, 29, '', '', '', '', '0', '2023-06-27 08:54:16', NULL, '2023-06-27 08:54:16', NULL, 1, '2023-06-27 09:00:41', 3),
(41, 30, 'sdfsd fsdfsdfs dfsd fsdfs dfsdfsdfsdfsdf   ', 'sdf', '', '', '1', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL),
(42, 30, '', '', '', 'sd', '0', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL),
(43, 30, '', 'asdf', '', 'asdf', '0', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL),
(44, 30, 'fasdf', 'asdf', '', '', '0', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL),
(45, 30, '', '', 'asdfasdfasdfasd', '', '0', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL),
(46, 30, '', '', '', '', '0', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL),
(47, 30, '', 'as', '', 'asdfasdfasdfasdfasdfsadfsadf', '0', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL),
(48, 30, '', 'df', 'as', 'df', '0', '2023-06-27 13:52:23', NULL, '2023-06-27 13:52:23', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `disciplines`
--

CREATE TABLE `disciplines` (
  `disciplineid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `disciplinename` varchar(55) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) NOT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `disciplines`
--

INSERT INTO `disciplines` (`disciplineid`, `schoolid`, `disciplinename`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(1, 1, 'rekenen', '2023-05-03 08:16:59', 1, '2023-05-03 08:16:59', 1, 0, NULL, NULL),
(2, 1, 'lezen', '2023-05-03 08:17:16', 1, '2023-05-03 08:17:16', 1, 0, NULL, NULL),
(3, 1, 'testvak', '2023-05-23 11:06:10', 2, '2023-05-23 11:06:10', 2, 1, NULL, NULL),
(6, 21, 'rekenen berweradsf', '2023-06-02 12:08:26', 49, '2023-06-02 12:08:26', 49, 1, NULL, NULL),
(7, 21, 'asd', '2023-06-02 12:09:29', 49, '2023-06-02 12:09:29', 49, 1, NULL, NULL),
(8, 21, 'asd', '2023-06-02 12:11:51', 49, '2023-06-02 12:11:51', 49, 1, NULL, NULL),
(9, 1, 'sdfsd', '2023-06-07 08:10:34', 2, '2023-06-07 08:10:34', 2, 1, NULL, NULL),
(10, 1, '1', '2023-06-08 14:23:30', 2, '2023-06-08 14:23:30', 2, 1, NULL, NULL),
(11, 1, 'sdfadf', '2023-06-14 09:50:49', 2, '2023-06-14 09:50:49', 2, 0, NULL, NULL),
(12, 1, 'qwerty', '2023-06-14 09:50:55', 2, '2023-06-14 09:50:55', 2, 0, NULL, NULL),
(13, 1, '3452452345', '2023-06-15 09:30:18', 2, '2023-06-15 09:30:18', 2, 1, '2023-06-15 09:30:24', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE `groups` (
  `groupid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `groups` varchar(3) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) NOT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `groups`
--

INSERT INTO `groups` (`groupid`, `schoolid`, `groups`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(1, 21, '2', '2023-05-03 08:18:01', 1, '2023-05-03 08:18:01', 1, 0, NULL, NULL),
(2, 21, '6', '2023-05-03 08:18:09', 1, '2023-05-03 08:18:09', 1, 0, NULL, NULL),
(3, 21, '3', '2023-05-09 13:54:26', 0, '2023-05-09 13:54:26', 0, 0, NULL, NULL),
(4, 1, 'dfg', '2023-06-05 08:08:25', 2, '2023-06-05 08:08:25', 2, 0, NULL, NULL),
(5, 1, '123', '2023-06-05 08:09:21', 2, '2023-06-05 08:09:21', 2, 0, NULL, NULL),
(9, 1, 'tes', '2023-06-08 14:15:13', 2, '2023-06-08 14:15:13', 2, 1, NULL, NULL),
(10, 1, 'tes', '2023-06-28 08:56:43', 2, '2023-06-28 08:56:43', 2, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `linkgroups`
--

CREATE TABLE `linkgroups` (
  `linkgroupsid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `linkgroups`
--

INSERT INTO `linkgroups` (`linkgroupsid`, `userid`, `groupid`, `archive`) VALUES
(4, 21, 1, 0),
(5, 21, 2, 0),
(6, 26, 2, 0),
(7, 27, 1, 0),
(8, 27, 3, 0),
(11, 24, 2, 0),
(12, 29, 2, 0),
(14, 30, 3, 0),
(18, 33, 1, 0),
(19, 33, 3, 0),
(23, 42, 2, 0),
(25, 47, 1, 0),
(26, 47, 2, 0),
(36, 51, 1, 0),
(61, 58, 4, 0),
(62, 58, 5, 0),
(80, 3, 4, 0),
(81, 3, 5, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` varchar(11) NOT NULL,
  `useragent` varchar(255) NOT NULL,
  `action` tinyint(1) NOT NULL COMMENT '0=select\r\n1=insert\r\n2=update\r\n3=delete\r\n4=login\r\n5=logout\r\n6=restore',
  `info` varchar(255) DEFAULT NULL,
  `tableid` tinyint(4) NOT NULL COMMENT '1=beeway\r\n2=disciplines\r\n3=groups\r\n4=maintheme\r\n5=schools\r\n6=users',
  `interactionid` int(11) NOT NULL,
  `error` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no error\r\n1=Unauthorized access\r\n2=not allowed\r\n3=unknown\r\n4=failed login\r\n5=failed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `logs`
--

INSERT INTO `logs` (`id`, `date`, `userid`, `useragent`, `action`, `info`, `tableid`, `interactionid`, `error`) VALUES
(400, '2023-06-06 12:05:13', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'disciplines\' where schoolid is 22 has been deleted.', 2, 22, 0),
(401, '2023-06-06 12:05:13', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'beewayplanning\' and \'beewayobservation\' where beewayid is in () has been archived where beeway.schoolid is 22.', 1, 22, 0),
(402, '2023-06-06 12:05:13', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'School with schoolid 22 has been archived.', 5, 22, 0),
(403, '2023-06-06 12:10:46', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '', 5, 23, 0),
(404, '2023-06-06 12:10:46', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '', 6, 54, 0),
(405, '2023-06-06 12:10:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'users\' where schoolid is 23 has been deleted.', 6, 23, 0),
(406, '2023-06-06 12:10:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'maintheme\' where schoolid is 23 has been deleted.', 4, 23, 0),
(407, '2023-06-06 12:10:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'groups\' where schoolid is 23 has been deleted.', 3, 23, 0),
(408, '2023-06-06 12:10:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'disciplines\' where schoolid is 23 has been deleted.', 2, 23, 0),
(409, '2023-06-06 12:10:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'School with schoolid 23 has been archived.', 5, 23, 0),
(410, '2023-06-06 12:12:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '', 5, 24, 0),
(411, '2023-06-06 12:12:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '', 6, 55, 0),
(412, '2023-06-06 12:12:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'users\' where schoolid is 24 has been deleted.', 6, 24, 0),
(413, '2023-06-06 12:12:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'maintheme\' where schoolid is 24 has been deleted.', 4, 24, 0),
(414, '2023-06-06 12:12:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'groups\' where schoolid is 24 has been deleted.', 3, 24, 0),
(415, '2023-06-06 12:12:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'disciplines\' where schoolid is 24 has been deleted.', 2, 24, 0),
(416, '2023-06-06 12:12:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'School with schoolid 24 has been archived.', 5, 24, 0),
(417, '2023-06-06 12:29:19', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'school created', 5, 25, 0),
(418, '2023-06-06 12:29:19', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'User added for new school 25', 6, 56, 0),
(419, '2023-06-06 12:48:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '', 6, 57, 0),
(420, '2023-06-06 12:51:14', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'user deleted', 6, 57, 0),
(421, '2023-06-07 06:08:44', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(422, '2023-06-07 06:10:19', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, '', 6, 1, 0),
(423, '2023-06-07 06:10:24', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(424, '2023-06-07 06:15:41', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(425, '2023-06-07 07:05:56', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, '', 6, 2, 0),
(426, '2023-06-07 07:06:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(427, '2023-06-07 08:41:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, '', 6, 1, 0),
(428, '2023-06-07 08:41:38', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(429, '2023-06-07 09:59:58', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, '', 6, 2, 0),
(430, '2023-06-07 10:00:02', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(431, '2023-06-08 06:06:49', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(432, '2023-06-08 07:00:26', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'user added', 6, 58, 0),
(433, '2023-06-08 07:02:56', '0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 0, 0),
(434, '2023-06-08 07:03:31', '0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 0, 0),
(435, '2023-06-08 07:05:21', '0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, '', 6, 0, 0),
(436, '2023-06-08 07:05:25', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, '', 6, 2, 0),
(437, '2023-06-08 07:05:28', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(438, '2023-06-08 07:40:38', '0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'user added', 6, 59, 0),
(439, '2023-06-08 07:40:48', '0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'user deleted', 6, 59, 0),
(440, '2023-06-08 08:23:16', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 1, 0),
(441, '2023-06-08 08:23:20', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(442, '2023-06-08 10:18:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, '', 6, 58, 0),
(443, '2023-06-08 12:14:36', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 1, 0),
(444, '2023-06-08 12:14:41', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(445, '2023-06-08 12:15:13', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '', 3, 9, 0),
(446, '2023-06-08 12:23:30', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '', 2, 10, 0),
(447, '2023-06-08 12:24:06', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, '', 2, 10, 0),
(448, '2023-06-08 12:27:20', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'Unauthorized access, user does not exist or is archived', 6, 2, 0),
(449, '2023-06-08 12:34:53', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, '', 2, 9, 0),
(450, '2023-06-08 12:36:06', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, '', 2, 3, 0),
(451, '2023-06-08 13:44:53', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 2, 0),
(452, '2023-06-08 13:44:56', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(453, '2023-06-08 13:46:01', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 1, 0),
(454, '2023-06-08 13:46:39', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(455, '2023-06-08 13:57:05', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 2, 0),
(456, '2023-06-08 13:57:11', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(457, '2023-06-09 07:12:55', '0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 0, 0),
(458, '2023-06-09 07:43:20', '0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 0, 0),
(459, '2023-06-09 07:43:26', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 2, 0),
(460, '2023-06-09 08:09:29', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 2, 0),
(461, '2023-06-09 08:11:46', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(462, '2023-06-09 11:28:51', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 'User logout', 6, 1, 0),
(463, '2023-06-12 06:41:56', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 'User login', 6, 1, 0),
(464, '2023-06-12 06:42:09', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 5, 25, 0),
(465, '2023-06-12 06:42:24', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 58, 0),
(466, '2023-06-12 06:42:29', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 58, 0),
(467, '2023-06-12 06:42:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 5, 25, 0),
(468, '2023-06-12 06:50:32', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(469, '2023-06-12 06:50:39', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(470, '2023-06-12 14:24:00', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(471, '2023-06-13 06:18:42', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(472, '2023-06-13 07:37:18', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(473, '2023-06-13 07:37:24', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(474, '2023-06-13 08:05:18', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 24, 0),
(475, '2023-06-13 09:15:30', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(476, '2023-06-13 09:18:14', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(477, '2023-06-13 12:08:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(478, '2023-06-13 13:13:23', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, NULL, 6, 0, 1),
(479, '2023-06-13 13:13:34', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(480, '2023-06-13 14:17:21', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(481, '2023-06-13 14:17:27', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(482, '2023-06-13 14:17:29', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(483, '2023-06-13 14:17:32', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(484, '2023-06-13 14:17:36', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(485, '2023-06-13 14:17:40', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(486, '2023-06-13 14:17:44', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(487, '2023-06-14 06:13:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(488, '2023-06-14 07:33:04', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 58, 0),
(489, '2023-06-14 07:33:51', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 58, 0),
(490, '2023-06-14 07:36:26', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 5, 25, 0),
(491, '2023-06-14 07:37:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 5, 25, 0),
(492, '2023-06-14 07:38:42', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(493, '2023-06-14 07:38:53', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 4, 5, 0),
(494, '2023-06-14 07:39:01', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 4, 5, 0),
(495, '2023-06-14 07:39:08', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 4, 5, 0),
(496, '2023-06-14 07:40:12', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 4, 5, 0),
(497, '2023-06-14 07:45:50', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 4, 5, 0),
(498, '2023-06-14 07:50:49', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, NULL, 2, 11, 0),
(499, '2023-06-14 07:50:55', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, NULL, 2, 12, 0),
(500, '2023-06-14 07:51:52', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(501, '2023-06-14 07:52:13', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(502, '2023-06-14 07:53:01', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(503, '2023-06-14 07:57:15', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(504, '2023-06-14 07:57:21', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(505, '2023-06-14 07:57:49', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(506, '2023-06-14 07:58:30', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(507, '2023-06-14 07:59:57', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 0, 5),
(508, '2023-06-14 08:00:50', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 12, 0),
(509, '2023-06-14 08:57:12', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(510, '2023-06-14 08:57:18', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(511, '2023-06-14 09:00:16', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 26, 0),
(512, '2023-06-14 09:01:05', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 26, 0),
(513, '2023-06-15 06:55:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(514, '2023-06-15 06:55:52', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(515, '2023-06-15 06:55:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(516, '2023-06-15 07:23:58', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(517, '2023-06-15 07:24:03', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(518, '2023-06-15 07:30:18', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, NULL, 2, 13, 0),
(519, '2023-06-15 07:30:21', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 2, 13, 0),
(520, '2023-06-15 07:30:24', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, NULL, 2, 13, 0),
(521, '2023-06-16 07:16:28', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(522, '2023-06-16 07:16:58', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(523, '2023-06-16 07:17:05', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(524, '2023-06-16 13:21:58', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'school created', 5, 26, 0),
(525, '2023-06-16 13:21:58', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'User added for new school 26', 6, 10000, 0),
(526, '2023-06-16 13:22:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'users\' where schoolid is 26 has been deleted.', 6, 26, 0),
(527, '2023-06-16 13:22:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'maintheme\' where schoolid is 26 has been deleted.', 4, 26, 0),
(528, '2023-06-16 13:22:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'groups\' where schoolid is 26 has been deleted.', 3, 26, 0),
(529, '2023-06-16 13:22:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'disciplines\' where schoolid is 26 has been deleted.', 2, 26, 0),
(530, '2023-06-16 13:22:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'School with schoolid 26 has been archived.', 5, 26, 0),
(531, '2023-06-26 06:08:26', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(532, '2023-06-26 06:08:45', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 26, 0),
(533, '2023-06-26 09:30:26', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 26, 0),
(534, '2023-06-26 11:04:09', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(535, '2023-06-27 06:10:28', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(536, '2023-06-27 06:10:32', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(537, '2023-06-27 06:45:18', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, NULL, 1, 0, 1),
(538, '2023-06-27 06:54:34', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, NULL, 1, 0, 5),
(539, '2023-06-27 06:58:25', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(540, '2023-06-27 06:58:28', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(541, '2023-06-27 07:00:29', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(542, '2023-06-27 07:00:32', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(543, '2023-06-27 07:00:41', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'beeway deleted', 1, 29, 0),
(544, '2023-06-27 07:00:50', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(545, '2023-06-27 07:00:53', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(546, '2023-06-27 07:01:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'school created', 5, 27, 0),
(547, '2023-06-27 07:01:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 'User added for new school 27', 6, 10001, 0),
(548, '2023-06-27 07:02:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'users\' where schoolid is 27 has been deleted.', 6, 27, 0),
(549, '2023-06-27 07:02:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'maintheme\' where schoolid is 27 has been deleted.', 4, 27, 0),
(550, '2023-06-27 07:02:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'groups\' where schoolid is 27 has been deleted.', 3, 27, 0),
(551, '2023-06-27 07:02:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'Everything from \'disciplines\' where schoolid is 27 has been deleted.', 2, 27, 0),
(552, '2023-06-27 07:02:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 3, 'School with schoolid 27 has been archived.', 5, 27, 0),
(553, '2023-06-27 11:15:42', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(554, '2023-06-27 11:15:47', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(555, '2023-06-28 06:52:00', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(556, '2023-06-28 06:53:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(557, '2023-06-28 06:56:22', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 58, 0),
(558, '2023-06-28 06:56:37', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 58, 0),
(559, '2023-06-28 06:56:43', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, NULL, 3, 10, 0),
(560, '2023-06-28 06:56:57', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(561, '2023-06-28 08:55:15', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(562, '2023-06-28 08:55:34', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(563, '2023-06-28 08:55:40', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(564, '2023-06-28 08:55:40', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(565, '2023-06-28 08:55:45', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(566, '2023-06-28 08:55:45', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(567, '2023-06-28 08:55:58', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(568, '2023-06-28 08:55:58', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(569, '2023-06-28 08:56:20', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(570, '2023-06-28 08:56:27', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(571, '2023-06-28 08:56:31', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(572, '2023-06-28 08:56:39', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(573, '2023-06-28 08:57:25', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(574, '2023-06-28 08:57:41', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(575, '2023-06-28 08:57:47', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(576, '2023-06-28 08:57:52', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(577, '2023-06-28 08:57:56', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(578, '2023-06-28 08:57:56', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(579, '2023-06-28 09:00:48', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(580, '2023-06-28 09:01:06', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(581, '2023-06-28 11:40:29', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(582, '2023-06-28 11:40:34', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(583, '2023-06-28 11:40:34', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(584, '2023-06-28 11:40:36', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(585, '2023-06-28 11:40:36', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(586, '2023-06-28 11:40:47', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(587, '2023-06-28 11:41:02', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(588, '2023-06-28 11:41:13', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(589, '2023-06-28 11:41:15', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(590, '2023-06-28 11:41:20', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(591, '2023-06-28 11:41:20', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(592, '2023-06-28 12:31:36', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(593, '2023-06-28 12:31:48', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(594, '2023-06-28 12:32:05', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(595, '2023-06-28 12:32:13', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(596, '2023-06-28 12:32:17', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(597, '2023-06-28 12:32:17', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(598, '2023-06-28 12:32:31', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(599, '2023-06-28 12:33:29', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(600, '2023-06-28 12:33:45', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(601, '2023-06-28 12:33:45', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(602, '2023-06-28 12:33:49', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(603, '2023-06-28 12:33:49', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(604, '2023-06-29 08:18:51', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(605, '2023-06-29 12:14:39', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(606, '2023-06-29 12:14:43', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(607, '2023-06-29 12:21:49', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(608, '2023-06-29 12:21:54', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(609, '2023-06-29 12:22:08', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 6, 3, 0),
(610, '2023-06-30 11:19:00', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(611, '2023-06-30 11:19:03', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(612, '2023-06-30 12:35:54', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(613, '2023-06-30 12:36:02', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(614, '2023-06-30 12:36:21', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(615, '2023-06-30 12:36:29', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(616, '2023-06-30 13:24:17', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(617, '2023-07-03 06:48:30', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(618, '2023-07-05 08:30:57', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(619, '2023-07-05 13:01:01', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(620, '2023-07-05 13:01:05', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(621, '2023-07-05 13:02:47', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 6, NULL, 5, 0, 1),
(622, '2023-07-05 13:06:35', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(623, '2023-07-05 13:06:37', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(624, '2023-07-05 13:06:38', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(625, '2023-07-05 13:08:23', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(626, '2023-07-05 13:08:24', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(627, '2023-07-05 13:08:25', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(628, '2023-07-05 13:08:25', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(629, '2023-07-05 13:08:26', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(630, '2023-07-05 13:08:26', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(631, '2023-07-05 13:08:36', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(632, '2023-07-05 13:08:37', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(633, '2023-07-05 13:08:39', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(634, '2023-07-05 13:08:39', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(635, '2023-07-05 13:08:40', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(636, '2023-07-05 13:08:40', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(637, '2023-07-05 13:08:41', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(638, '2023-07-05 13:08:50', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, NULL, 1, 0, 5),
(639, '2023-07-06 07:00:06', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(640, '2023-07-06 08:46:01', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(641, '2023-07-06 08:46:05', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(642, '2023-07-06 08:46:11', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(643, '2023-07-06 08:46:14', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(644, '2023-07-06 12:29:38', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(645, '2023-07-06 12:29:50', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(646, '2023-07-06 12:29:56', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(647, '2023-07-06 12:30:17', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(648, '2023-07-06 12:30:21', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(649, '2023-07-06 12:51:46', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(650, '2023-07-06 12:53:27', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(651, '2023-07-06 13:06:23', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(652, '2023-07-07 06:40:16', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(653, '2023-07-07 06:40:20', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(654, '2023-07-07 11:26:24', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 2, 0),
(655, '2023-07-07 11:26:29', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 2, 0),
(656, '2023-07-10 06:10:20', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0),
(657, '2023-07-10 06:24:34', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 3, 0),
(658, '2023-07-10 06:24:38', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(659, '2023-07-10 06:24:38', '9999', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 0, 4),
(660, '2023-07-10 06:24:41', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(661, '2023-07-10 06:28:22', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(662, '2023-07-10 06:29:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0),
(663, '2023-07-10 07:37:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, NULL, 6, 1, 0),
(664, '2023-07-10 07:37:39', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 3, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `maintheme`
--

CREATE TABLE `maintheme` (
  `themeid` int(11) NOT NULL,
  `schoolid` varchar(11) NOT NULL,
  `namethemep1` varchar(55) NOT NULL,
  `namethemep2` varchar(55) NOT NULL,
  `namethemep3` varchar(55) NOT NULL,
  `namethemep4` varchar(55) DEFAULT NULL,
  `namethemep5` varchar(55) DEFAULT NULL,
  `schoolyear` varchar(10) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) NOT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `maintheme`
--

INSERT INTO `maintheme` (`themeid`, `schoolid`, `namethemep1`, `namethemep2`, `namethemep3`, `namethemep4`, `namethemep5`, `schoolyear`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(0, '1', 'niet van toepasing', 'niet van toepasing', 'niet van toepasing', 'niet van toepasing', 'niet van toepasing', '1', '2023-05-23 08:58:16', 0, '2023-05-23 08:58:16', 0, 0, NULL, NULL),
(1, '1', 'test thema 1', 'naam p2', 'naam p3', 'naam p4', 'naam p5', '1', '2023-05-03 08:19:06', 1, '2023-05-03 08:19:06', 1, 0, NULL, NULL),
(2, '1', 'test thema 2', 'naam p2', 'naam p3', 'naam p4', 'naam p5', '1', '2023-05-03 08:19:14', 1, '2023-05-03 08:19:14', 1, 0, NULL, NULL),
(3, '2', 'test thema 3', 'naam p2', 'naam p3', 'naam p4', 'naam p5', '1', '2023-05-03 08:19:14', 1, '2023-05-03 08:19:14', 1, 0, NULL, NULL),
(5, '1', '1 2', '2 2', '3 2', '4 2', '5 2', '2', '2023-05-24 09:35:00', 0, '2023-05-24 09:35:00', 0, 0, NULL, NULL),
(6, '1', '1', '1', '1', '1', '1', '2', '2023-06-05 08:10:06', 0, '2023-06-05 08:10:06', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `schools`
--

CREATE TABLE `schools` (
  `schoolid` int(11) NOT NULL,
  `schoolname` varchar(155) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) NOT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `schools`
--

INSERT INTO `schools` (`schoolid`, `schoolname`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(0, '', '2023-05-03 08:19:39', 0, '2023-05-03 08:19:39', 0, 0, NULL, NULL),
(1, 'mijnschool', '2023-05-03 08:19:49', 1, '2023-05-03 08:19:49', 1, 0, NULL, NULL),
(2, 'nietmijnschool', '2023-05-03 16:06:18', 1, '2023-05-03 16:06:18', 1, 0, NULL, NULL),
(19, 'test beeway', '2023-05-24 09:40:03', 1, '2023-05-24 09:40:03', 1, 0, NULL, NULL),
(21, 'asd', '2023-06-01 09:15:41', 1, '2023-06-01 09:15:41', 1, 0, NULL, NULL),
(22, 'test', '2023-06-06 13:40:13', 1, '2023-06-06 13:40:13', 1, 1, '2023-06-06 14:05:13', 1),
(23, 'test', '2023-06-06 14:10:46', 1, '2023-06-06 14:10:46', 1, 1, '2023-06-06 14:10:52', 1),
(24, 'test', '2023-06-06 14:12:00', 1, '2023-06-06 14:12:00', 1, 1, '2023-06-06 14:12:03', 1),
(25, 'dfdfsdfsdfs', '2023-06-06 14:29:19', 1, '2023-06-14 09:37:03', 1, 0, NULL, NULL),
(26, 'test', '2023-06-16 15:21:58', 1, '2023-06-16 15:21:58', 1, 1, '2023-06-16 15:22:33', 1),
(27, 'test', '2023-06-27 09:01:33', 1, '2023-06-27 09:01:33', 1, 1, '2023-06-27 09:02:10', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) NOT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userid`, `schoolid`, `firstname`, `lastname`, `email`, `password`, `role`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(0, 0, 'system', '', '', '', 2, '2023-05-09 09:29:55', 0, '2023-05-09 09:29:55', 0, 1, NULL, NULL),
(1, 0, 'superuser', 'test', 'test@test.nl', '$2y$10$PEIaTvE2w3VJw/t9iagKSu8tL1eUiGjYJqtkQ8snMoOWvW1lin6Lu', 2, '2023-05-03 08:20:53', 1, '2023-05-03 08:20:53', 1, 0, NULL, NULL),
(2, 1, 'school admin', 'test', 'een@test.nl', '$2y$10$PEIaTvE2w3VJw/t9iagKSu8tL1eUiGjYJqtkQ8snMoOWvW1lin6Lu', 1, '2023-05-03 08:21:20', 1, '2023-05-03 08:21:20', 1, 0, NULL, NULL),
(3, 1, 'school docent', 'test', 'twee@test.nl', '$2y$10$PEIaTvE2w3VJw/t9iagKSu8tL1eUiGjYJqtkQ8snMoOWvW1lin6Lu', 0, '2023-05-10 16:14:24', 1, '2023-06-29 14:22:08', 2, 0, NULL, NULL),
(45, 19, 'schooladmin', 'one', 'test beeway', '$2y$10$n0bNQG9rYwViXUCU38nKrORLrseI9qxpFM33UD8cjRM4LVqBQcE3q', 1, '2023-05-24 09:40:03', 1, '2023-05-24 09:40:03', 1, 0, NULL, NULL),
(48, 19, 'docent 2', 'test', 'asdf@asdf', '$2y$10$PzlD5LmLReARPFIyy9pm5eXqxdxi.w2PzfjoMeWwL1UZBQ53LKW5C', 1, '2023-05-31 10:18:24', 47, '2023-05-31 10:18:24', 47, 0, NULL, NULL),
(49, 21, 'schooladmin', 'one', 'asd', '$2y$10$/gUOnpYXN599EjE/w53xmet7cVhpuInUQi0PQGAzj2RM9wUKz21GK', 1, '2023-06-01 09:15:42', 1, '2023-06-01 09:15:42', 1, 0, NULL, NULL),
(51, 21, 'jan', 'docent 1', '3@asd.nl', '$2y$10$aZRZ0D7sYUYls9yuxh6P6.J7zFujutplNQj9Y2cjjbs8M6GFu1URy', 0, '2023-06-01 15:20:45', 49, '2023-06-02 11:05:15', 49, 0, NULL, NULL),
(52, 21, 'piet', 'docent 2', '1@asd.nl', '$2y$10$CioQR4B.1isgfKU2pr9eXOHZ6faW7mXckKKsADv1/FqYDtuYr663S', 0, '2023-06-02 13:43:40', 49, '2023-06-02 13:43:40', 49, 0, NULL, NULL),
(53, 22, 'schooladmin', 'one', 'test', '$2y$10$oYsR32Frz2GatgFnU7rN8OP8eqix1xKCFwFZkyn/dDO0nmgiIau96', 1, '2023-06-06 13:40:13', 1, '2023-06-06 13:40:13', 1, 1, '2023-06-06 14:05:13', 1),
(54, 23, 'schooladmin', 'one', 'test', '$2y$10$0QFKs763k8tNnJ4.dK4/5OLg9QPuQ1nXeraHLqL/EdKaVMwBbY.oi', 1, '2023-06-06 14:10:46', 1, '2023-06-06 14:10:46', 1, 1, '2023-06-06 14:10:52', 1),
(55, 24, 'schooladmin', 'one', 'test', '$2y$10$aC.xWf.eRx3hMzgqw2Mti..OdKtX3u2BFwo2nGkI5iQ6a9PEcd.pq', 1, '2023-06-06 14:12:00', 1, '2023-06-06 14:12:00', 1, 1, '2023-06-06 14:12:03', 1),
(56, 25, 'schooladmin', 'one', 'test', '$2y$10$LoC4GOPZbON3SQtYtEaamO.Ic0PIQOG/CWPDakVwx7fGGXMGvk4wq', 1, '2023-06-06 14:29:19', 1, '2023-06-06 14:29:19', 1, 0, NULL, NULL),
(57, 25, '1', '1', '1@2.nl', '$2y$10$jdNiGl8Dbymkim6NJ7S6IuBFJrYKdmz.feNrY2kSEpWVUzkBSMJpa', 0, '2023-06-06 14:48:10', 1, '2023-06-06 14:48:10', 1, 1, '2023-06-06 14:51:14', 1),
(58, 1, 'fsdf', 'fsdf', 'test@23452349999', '$2y$10$a6W89uKVv50y/9gy3b3JLeDgSpczWKvDugEfwu6ZIwkoiX5VRdh7a', 0, '2023-06-08 09:00:26', 2, '2023-06-28 08:56:37', 2, 0, NULL, NULL),
(59, 1, 'asd', 'asd', 'asd@mijnschool', '$2y$10$6r7LdjjpFJ/6HW4WJK/iROLJ2O6JjDeum7n76pCDFFQ.MhZTlcjYi', 1, '2023-06-08 09:40:38', 0, '2023-06-08 09:40:38', 0, 1, '2023-06-08 09:40:48', 0),
(9999, 0, 'system', 'monitor', '', '', 3, '2023-06-13 11:28:08', 0, '2023-06-13 11:28:08', 0, 0, NULL, NULL),
(10000, 26, 'schooladmin', 'one', 'test', '$2y$10$6ZkuGd7BEHA1.A34i48ymeURWMcKhu52/qummz3LHMjIvjSaU2KzC', 1, '2023-06-16 15:21:58', 1, '2023-06-16 15:21:58', 1, 1, '2023-06-16 15:22:33', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `beeway`
--
ALTER TABLE `beeway`
  ADD PRIMARY KEY (`beewayid`);

--
-- Indexen voor tabel `beewayobservation`
--
ALTER TABLE `beewayobservation`
  ADD PRIMARY KEY (`observationid`);

--
-- Indexen voor tabel `beewayplanning`
--
ALTER TABLE `beewayplanning`
  ADD PRIMARY KEY (`planningid`);

--
-- Indexen voor tabel `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`disciplineid`);

--
-- Indexen voor tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupid`);

--
-- Indexen voor tabel `linkgroups`
--
ALTER TABLE `linkgroups`
  ADD PRIMARY KEY (`linkgroupsid`);

--
-- Indexen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `maintheme`
--
ALTER TABLE `maintheme`
  ADD PRIMARY KEY (`themeid`);

--
-- Indexen voor tabel `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`schoolid`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `beeway`
--
ALTER TABLE `beeway`
  MODIFY `beewayid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `beewayobservation`
--
ALTER TABLE `beewayobservation`
  MODIFY `observationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT voor een tabel `beewayplanning`
--
ALTER TABLE `beewayplanning`
  MODIFY `planningid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT voor een tabel `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `disciplineid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `linkgroups`
--
ALTER TABLE `linkgroups`
  MODIFY `linkgroupsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=665;

--
-- AUTO_INCREMENT voor een tabel `maintheme`
--
ALTER TABLE `maintheme`
  MODIFY `themeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `schools`
--
ALTER TABLE `schools`
  MODIFY `schoolid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
