-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 jun 2023 om 16:19
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

INSERT INTO `beeway` (`beewayid`, `schoolid`, `groupid`, `beewayname`, `begood`, `beenough`, `benotgood`, `mainthemeid`, `themeperiodid`, `disciplineid`, `concretegoal`, `status`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(1, 1, '6', 'eerste beeway', '0', '12', '', '1', 2, '1', 'beeway doel, leuk he fgddddeeeeeeeeee', '0', '2023-05-03 08:15:03', 1, '2023-05-03 08:15:03', 2, 0, NULL, NULL),
(2, 1, '2', 'tweede beeway', '67', '12', '45', '1', 2, '2', 'beeway doel, leuk hesdfgsdfgsdfg', '0', '2023-05-03 08:15:42', 1, '2023-05-03 08:15:42', 2, 0, NULL, NULL),
(3, 1, '1', 'derde beeway', '23', '567', '23', '1', 5, '2', 'beeway doel, stom he', '0', '2023-05-03 08:16:14', 1, '2023-05-03 08:16:14', 2, 0, NULL, NULL),
(18, 1, '1', 'testschoolid', NULL, '13', '14', '1', 4, '1', 'doel leuk he', '0', '2023-05-23 10:59:02', 2, '2023-05-23 10:59:02', 2, 0, NULL, NULL),
(19, 1, '1', 'eerste beeway', '0', '12', '45', '1', 4, '1', 'beeway doel, leuk he', '0', '2023-05-24 08:41:42', 2, '2023-05-24 08:41:42', 2, 0, NULL, NULL),
(20, 1, '3', '3', '11', '11', '11', '1', 1, '3', 'beeway doel, leuk he', '0', '2023-05-24 08:44:08', 2, '2023-05-24 08:44:08', 2, 0, NULL, NULL),
(21, 1, '1', '2', '2', '2', '2', '1', 2, '2', 'hoe veel worden kunnen we nu hier van lezen of is dit minder dan 35?', '0', '2023-05-24 09:07:21', 2, '2023-05-24 09:07:21', 2, 0, NULL, NULL),
(22, 1, '3', '1', '', '', '', '1', 4, '1', '123123123', '0', '2023-05-24 09:16:11', 2, '2023-05-24 09:16:11', 2, 0, NULL, NULL),
(24, 1, '2', '2', '2', '2', '2', '1', 1, '2', '2', '0', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', 2, 0, NULL, NULL),
(25, 1, '5', '5', '5', '5', '5', '5', 0, '2', '5', '0', '2023-06-13 11:09:41', NULL, '2023-06-13 11:09:41', NULL, 0, NULL, NULL);

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
(1, 24, 'o', 'o', 'o', 'o', 'o', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
(2, 24, 'o', 'o', 'o', 'o', 'o', '2023-06-13 09:44:31', 0, '2023-06-13 09:44:31', 0, 0, NULL, NULL),
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
(16, 25, '', 'bnvnbvn', '', '', '', '2023-06-13 11:09:42', 0, '2023-06-13 11:09:42', 0, 0, NULL, NULL);

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
(1, 24, 'p', 'p', 'p', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(2, 24, 'p', 'p', 'p', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(3, 24, 'p', 'p', 'p', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(4, 24, 'p', 'p', 'p', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(5, 24, 'p', 'p', 'p', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(6, 24, 'p', 'p', 'p', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(7, 24, 'p', 'p', 'pp', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(8, 24, 'p', 'p', 'p', 'p', '1', '2023-06-13 09:44:31', NULL, '2023-06-13 09:44:31', NULL, 0, NULL, NULL),
(9, 25, '', 'jkj', 'hkj', 'jk', '0', '2023-06-13 11:09:41', NULL, '2023-06-13 11:09:41', NULL, 0, NULL, NULL),
(10, 25, 'hjgf', 'g', 'fh', 'gf', '0', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(11, 25, '', 'gf', 'hgf', 'hjgf', '0', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(12, 25, 'gfjh', 'gf', 'hjgf', 'g', '0', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(13, 25, 'gf', 'jhg', 'f', 'hjgf', '0', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(14, 25, 'fj', 'gf', 'hjgf', 'hjg', '0', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(15, 25, 'hjgf', 'hjg', 'fhj', 'gf', '0', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL),
(16, 25, 'fhj', 'gf', 'j', 'fj', '0', '2023-06-13 11:09:42', NULL, '2023-06-13 11:09:42', NULL, 0, NULL, NULL);

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
(10, 1, '1', '2023-06-08 14:23:30', 2, '2023-06-08 14:23:30', 2, 1, NULL, NULL);

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
(6, 0, 'sdf', '2023-06-07 08:10:39', 2, '2023-06-07 08:10:39', 2, 0, NULL, NULL),
(7, 0, 'sdf', '2023-06-07 08:10:43', 2, '2023-06-07 08:10:43', 2, 0, NULL, NULL),
(8, 0, 'sdf', '2023-06-07 08:10:58', 2, '2023-06-07 08:10:58', 2, 0, NULL, NULL),
(9, 1, 'tes', '2023-06-08 14:15:13', 2, '2023-06-08 14:15:13', 2, 1, NULL, NULL);

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
(1, 3, 1, 1),
(2, 3, 2, 1),
(4, 21, 1, 0),
(5, 21, 2, 0),
(6, 26, 2, 0),
(7, 27, 1, 0),
(8, 27, 3, 0),
(9, 24, 1, 1),
(10, 24, 2, 1),
(11, 24, 2, 0),
(12, 29, 2, 0),
(13, 30, 3, 1),
(14, 30, 3, 0),
(15, 33, 1, 1),
(16, 33, 2, 1),
(17, 33, 3, 1),
(18, 33, 1, 0),
(19, 33, 3, 0),
(20, 3, 1, 1),
(21, 3, 2, 1),
(22, 42, 2, 1),
(23, 42, 2, 0),
(24, 44, 2, 1),
(25, 47, 1, 0),
(26, 47, 2, 0),
(27, 51, 2, 1),
(28, 51, 3, 1),
(29, 51, 2, 1),
(30, 51, 3, 1),
(31, 51, 2, 1),
(32, 51, 3, 1),
(33, 51, 2, 1),
(34, 51, 3, 1),
(35, 51, 1, 1),
(36, 51, 1, 0),
(37, 58, 3, 1),
(38, 58, 4, 1),
(39, 58, 3, 1),
(40, 58, 4, 1),
(41, 58, 3, 0),
(42, 58, 4, 0);

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
(486, '2023-06-13 14:17:44', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, NULL, 6, 1, 0);

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
(5, '1', '1', '2', '3', '4', '5', '2', '2023-05-24 09:35:00', 0, '2023-05-24 09:35:00', 0, 0, NULL, NULL),
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
(25, 'sdfdsf', '2023-06-06 14:29:19', 1, '2023-06-12 08:42:33', 1, 0, NULL, NULL);

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
(3, 1, 'school docent', 'test', 'twee@test.nl', '$2y$10$PEIaTvE2w3VJw/t9iagKSu8tL1eUiGjYJqtkQ8snMoOWvW1lin6Lu', 0, '2023-05-10 16:14:24', 1, '2023-05-10 16:14:24', 1, 0, NULL, NULL),
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
(58, 1, 'fsdf', 'fsdf', 'test@2345234', '$2y$10$xniw77iQyX9qiMQLMHKkeeumnFw8YSZzqUvHKQSTpdsA682Kn7rcq', 0, '2023-06-08 09:00:26', 2, '2023-06-12 08:42:29', 1, 0, NULL, NULL),
(59, 1, 'asd', 'asd', 'asd@mijnschool', '$2y$10$6r7LdjjpFJ/6HW4WJK/iROLJ2O6JjDeum7n76pCDFFQ.MhZTlcjYi', 1, '2023-06-08 09:40:38', 0, '2023-06-08 09:40:38', 0, 1, '2023-06-08 09:40:48', 0),
(9999, 0, 'system', 'monitor', '', '', 3, '2023-06-13 11:28:08', 0, '2023-06-13 11:28:08', 0, 0, NULL, NULL);

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
  MODIFY `beewayid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `beewayobservation`
--
ALTER TABLE `beewayobservation`
  MODIFY `observationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `beewayplanning`
--
ALTER TABLE `beewayplanning`
  MODIFY `planningid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `disciplineid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `linkgroups`
--
ALTER TABLE `linkgroups`
  MODIFY `linkgroupsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;

--
-- AUTO_INCREMENT voor een tabel `maintheme`
--
ALTER TABLE `maintheme`
  MODIFY `themeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `schools`
--
ALTER TABLE `schools`
  MODIFY `schoolid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
