-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jun 2023 om 10:00
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.2.0

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
(22, 1, '3', '1', '', '', '', '1', 4, '1', '123123123', '0', '2023-05-24 09:16:11', 2, '2023-05-24 09:16:11', 2, 0, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beewayplanning`
--

CREATE TABLE `beewayplanning` (
  `planningid` int(11) NOT NULL,
  `beewayid` varchar(11) NOT NULL,
  `planning` varchar(155) DEFAULT NULL,
  `planningwhat` varchar(2500) DEFAULT NULL,
  `planningwho` varchar(2500) DEFAULT NULL,
  `planningdeadline` datetime DEFAULT NULL,
  `planningdone` varchar(4) DEFAULT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `archive` tinyint(4) NOT NULL DEFAULT 0,
  `deletedat` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 1, 'testvak', '2023-05-23 11:06:10', 2, '2023-05-23 11:06:10', 2, 0, NULL, NULL),
(6, 21, 'rekenen berweradsf', '2023-06-02 12:08:26', 49, '2023-06-02 12:08:26', 49, 1, NULL, NULL),
(7, 21, 'asd', '2023-06-02 12:09:29', 49, '2023-06-02 12:09:29', 49, 1, NULL, NULL),
(8, 21, 'asd', '2023-06-02 12:11:51', 49, '2023-06-02 12:11:51', 49, 1, NULL, NULL);

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
(4, 0, 'dfg', '2023-06-05 08:08:25', 2, '2023-06-05 08:08:25', 2, 0, NULL, NULL),
(5, 0, '123', '2023-06-05 08:09:21', 2, '2023-06-05 08:09:21', 2, 0, NULL, NULL),
(6, 1, '342', '2023-06-05 08:26:12', 2, '2023-06-05 08:26:12', 2, 0, NULL, NULL),
(7, 1, '56', '2023-06-05 08:26:59', 2, '2023-06-05 08:26:59', 2, 0, NULL, NULL);

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
(36, 51, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` varchar(11) NOT NULL,
  `useragent` varchar(255) NOT NULL,
  `action` tinyint(1) NOT NULL COMMENT '0=select\r\n1=insert\r\n2=update\r\n3=delete\r\n4=login\r\n5=logout',
  `tableid` tinyint(4) NOT NULL COMMENT '1=beeway\r\n2=disciplines\r\n3=groups\r\n4=maintheme\r\n5=schools\r\n6=users',
  `interactionid` int(11) NOT NULL,
  `error` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no error\r\n1=Unauthorized access\r\n2=not allowed\r\n3=unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `logs`
--

INSERT INTO `logs` (`id`, `date`, `userid`, `useragent`, `action`, `tableid`, `interactionid`, `error`) VALUES
(49, '2023-05-09 06:16:40', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(50, '2023-05-09 07:03:15', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 24, 0),
(51, '2023-05-09 12:02:21', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 26, 0),
(52, '2023-05-09 12:06:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(53, '2023-05-09 12:08:05', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(54, '2023-05-09 12:11:31', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(55, '2023-05-09 12:12:49', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(56, '2023-05-09 12:12:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(57, '2023-05-09 12:21:49', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 27, 0),
(58, '2023-05-09 14:08:54', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 24, 0),
(59, '2023-05-09 14:09:21', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 24, 0),
(60, '2023-05-09 14:09:29', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 24, 0),
(61, '2023-05-09 14:11:45', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 24, 0),
(62, '2023-05-09 14:12:36', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 24, 0),
(63, '2023-05-09 14:13:27', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 24, 0),
(64, '2023-05-10 06:17:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(65, '2023-05-10 11:44:37', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(66, '2023-05-10 12:13:13', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(67, '2023-05-10 12:13:47', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 3, 0),
(68, '2023-05-10 12:14:01', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 3, 0),
(69, '2023-05-10 12:14:09', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 3, 0),
(70, '2023-05-10 12:16:23', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(71, '2023-05-10 12:16:34', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(72, '2023-05-10 12:25:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(73, '2023-05-10 12:34:34', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(74, '2023-05-10 12:34:40', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(75, '2023-05-10 13:45:35', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(76, '2023-05-10 13:45:44', '28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 28, 0),
(77, '2023-05-10 13:45:50', '28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 28, 0),
(78, '2023-05-10 13:45:54', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(79, '2023-05-10 13:59:35', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 29, 0),
(80, '2023-05-10 14:01:32', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 30, 0),
(81, '2023-05-10 14:01:40', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 30, 0),
(82, '2023-05-10 14:06:56', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 31, 0),
(83, '2023-05-10 14:13:28', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 32, 0),
(84, '2023-05-10 14:14:24', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 33, 0),
(85, '2023-05-10 14:14:38', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 33, 0),
(86, '2023-05-11 06:07:37', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(87, '2023-05-11 06:29:04', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(88, '2023-05-11 06:31:44', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(89, '2023-05-11 06:32:05', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(90, '2023-05-11 06:32:32', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(91, '2023-05-11 06:34:36', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(92, '2023-05-11 06:34:45', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(93, '2023-05-11 06:35:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(94, '2023-05-11 06:35:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(95, '2023-05-11 06:35:15', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(96, '2023-05-11 06:35:48', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(97, '2023-05-11 06:36:01', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(98, '2023-05-11 06:37:05', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(99, '2023-05-11 06:51:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 34, 0),
(100, '2023-05-11 06:51:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 35, 0),
(101, '2023-05-11 06:52:42', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 36, 0),
(102, '2023-05-11 10:49:47', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(103, '2023-05-12 06:05:14', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(104, '2023-05-12 06:46:48', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(105, '2023-05-12 07:02:23', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 5, 5, 0),
(106, '2023-05-12 07:02:39', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 5, 5, 0),
(107, '2023-05-12 07:02:48', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 5, 5, 0),
(108, '2023-05-12 07:03:31', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 7, 0),
(109, '2023-05-12 07:03:31', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 37, 0),
(111, '2023-05-12 07:06:01', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 9, 0),
(112, '2023-05-12 07:06:46', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 10, 0),
(113, '2023-05-12 07:06:54', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 11, 0),
(114, '2023-05-12 07:06:54', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 38, 0),
(115, '2023-05-12 07:08:19', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 12, 0),
(116, '2023-05-12 07:08:59', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 13, 0),
(117, '2023-05-12 07:08:59', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 39, 0),
(118, '2023-05-12 07:10:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 14, 0),
(119, '2023-05-12 07:10:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 40, 0),
(120, '2023-05-12 07:10:10', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 15, 0),
(121, '2023-05-12 07:11:29', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 16, 0),
(122, '2023-05-12 07:11:29', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 41, 0),
(123, '2023-05-12 07:11:42', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 17, 0),
(124, '2023-05-12 07:22:09', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 3, 0),
(125, '2023-05-12 07:25:51', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 42, 0),
(126, '2023-05-12 07:44:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 2, 6, 42, 0),
(127, '2023-05-15 06:37:05', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(128, '2023-05-15 07:51:34', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 3, 6, 42, 0),
(129, '2023-05-15 09:24:39', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 5, 18, 0),
(130, '2023-05-15 09:24:39', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 43, 0),
(131, '2023-05-15 09:28:05', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 3, 6, 0, 0),
(132, '2023-05-15 10:08:21', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 1, 6, 44, 0),
(133, '2023-05-15 10:08:28', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 3, 6, 44, 0),
(134, '2023-05-15 10:10:58', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 3, 6, 44, 0),
(135, '2023-05-15 12:04:42', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(136, '2023-05-15 12:04:49', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 3, 0),
(137, '2023-05-15 12:04:54', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 3, 0),
(138, '2023-05-15 12:04:56', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 3, 0),
(139, '2023-05-15 12:05:07', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 2, 0),
(140, '2023-05-15 12:43:15', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 2, 0),
(141, '2023-05-15 12:43:25', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(142, '2023-05-15 12:49:52', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 5, 6, 1, 0),
(143, '2023-05-15 12:50:07', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 4, 6, 1, 0),
(144, '2023-05-16 06:06:12', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(145, '2023-05-16 06:38:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(146, '2023-05-16 06:39:03', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(147, '2023-05-16 13:40:27', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(148, '2023-05-17 06:01:55', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(149, '2023-05-17 07:02:22', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(150, '2023-05-17 07:02:28', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(151, '2023-05-17 07:02:57', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(152, '2023-05-17 07:03:13', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 3, 0),
(153, '2023-05-17 07:03:15', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(154, '2023-05-17 07:05:40', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(155, '2023-05-17 07:05:46', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(156, '2023-05-17 07:06:39', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 3, 0),
(157, '2023-05-17 07:07:00', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(158, '2023-05-17 07:29:44', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 3, 0),
(159, '2023-05-17 07:29:51', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(160, '2023-05-17 07:30:02', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 3, 0),
(161, '2023-05-17 07:30:35', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(162, '2023-05-22 06:40:10', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(163, '2023-05-22 08:02:54', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(164, '2023-05-22 08:03:02', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(165, '2023-05-22 08:39:36', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(166, '2023-05-22 08:39:40', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(167, '2023-05-23 06:32:11', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(168, '2023-05-23 06:32:14', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(169, '2023-05-23 06:32:24', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(170, '2023-05-23 07:34:35', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(171, '2023-05-23 07:34:40', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(172, '2023-05-23 13:17:21', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(173, '2023-05-24 06:35:15', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(174, '2023-05-24 07:16:11', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 1, 22, 0),
(178, '2023-05-24 07:28:37', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 22, 0),
(179, '2023-05-24 07:28:41', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 21, 0),
(180, '2023-05-24 07:28:51', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 22, 0),
(181, '2023-05-24 07:36:07', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(182, '2023-05-24 07:36:14', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(183, '2023-05-24 07:36:20', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 22, 0),
(184, '2023-05-24 07:39:46', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 3, 0),
(185, '2023-05-24 07:39:49', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(186, '2023-05-24 07:40:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 5, 19, 0),
(187, '2023-05-24 07:40:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 6, 45, 0),
(188, '2023-05-24 07:40:07', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(189, '2023-05-24 07:40:28', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 45, 0),
(190, '2023-05-24 07:40:49', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 45, 0),
(191, '2023-05-24 07:42:30', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 45, 0),
(192, '2023-05-24 07:42:36', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 45, 0),
(193, '2023-05-24 07:42:53', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(194, '2023-05-24 07:43:12', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 5, 20, 0),
(195, '2023-05-24 07:43:12', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 6, 46, 0),
(196, '2023-05-24 07:43:22', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(197, '2023-05-24 07:43:31', '46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 46, 0),
(198, '2023-05-24 07:43:59', '46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 46, 0),
(199, '2023-05-24 07:44:16', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 45, 0),
(200, '2023-05-24 07:44:21', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 45, 0),
(201, '2023-05-24 07:44:45', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 45, 0),
(202, '2023-05-24 07:44:51', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 45, 0),
(203, '2023-05-24 07:55:00', '45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 45, 0),
(204, '2023-05-24 08:02:32', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(205, '2023-05-24 08:03:53', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 20, 0),
(206, '2023-05-24 13:27:35', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(207, '2023-05-24 13:56:42', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(208, '2023-05-24 13:56:47', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(209, '2023-05-24 14:02:31', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(210, '2023-05-24 14:02:33', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(211, '2023-05-26 07:20:15', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(212, '2023-05-26 08:20:58', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 1, 0),
(213, '2023-05-26 09:39:07', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(214, '2023-05-26 11:59:26', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(215, '2023-05-26 13:22:06', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(216, '2023-05-26 14:00:22', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(217, '2023-05-30 07:49:49', '1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36', 4, 6, 1, 0),
(218, '2023-05-30 08:39:04', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(219, '2023-05-30 08:39:13', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(220, '2023-05-30 14:19:34', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 22, 0),
(221, '2023-05-30 14:19:46', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 1, 1, 0),
(222, '2023-05-31 06:13:03', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(223, '2023-05-31 06:13:05', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(224, '2023-05-31 06:18:15', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 3, 0),
(225, '2023-05-31 06:18:21', '3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 3, 0),
(226, '2023-05-31 06:18:25', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(227, '2023-05-31 07:17:18', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 6, 47, 0),
(228, '2023-05-31 07:17:21', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(229, '2023-05-31 07:17:27', '47', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 47, 0),
(230, '2023-05-31 08:18:24', '47', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 6, 48, 0),
(231, '2023-05-31 08:56:39', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(232, '2023-05-31 09:25:58', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(233, '2023-05-31 09:26:16', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(234, '2023-05-31 09:26:48', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(235, '2023-05-31 11:01:31', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(236, '2023-05-31 11:03:04', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(237, '2023-05-31 11:04:39', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(238, '2023-05-31 11:04:44', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(239, '2023-05-31 11:31:26', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 3, 0),
(240, '2023-05-31 11:31:57', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(241, '2023-05-31 11:32:00', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(242, '2023-05-31 11:33:24', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(243, '2023-05-31 11:33:29', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(244, '2023-05-31 11:45:44', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 3, 0),
(245, '2023-05-31 11:45:47', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(246, '2023-05-31 11:47:10', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(247, '2023-05-31 11:49:29', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(248, '2023-05-31 11:50:28', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(249, '2023-05-31 11:50:32', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(250, '2023-05-31 11:50:45', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(251, '2023-05-31 11:51:11', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 3, 0),
(252, '2023-05-31 11:54:48', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(253, '2023-05-31 11:55:04', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(254, '2023-05-31 11:55:50', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(255, '2023-05-31 11:56:38', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(256, '2023-05-31 12:08:57', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(257, '2023-05-31 12:17:55', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(273, '2023-05-31 12:34:23', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(274, '2023-05-31 13:42:08', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(302, '2023-05-31 14:22:00', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 3, 6, 2, 0),
(303, '2023-05-31 14:23:04', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(304, '2023-06-01 06:34:57', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(305, '2023-06-01 07:12:13', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(306, '2023-06-01 07:12:18', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(307, '2023-06-01 07:15:41', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 5, 21, 0),
(308, '2023-06-01 07:15:42', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 6, 49, 0),
(309, '2023-06-01 07:16:39', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(310, '2023-06-01 07:16:48', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 49, 0),
(311, '2023-06-01 10:20:55', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 6, 50, 0),
(312, '2023-06-01 12:03:23', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 49, 0),
(313, '2023-06-01 12:03:33', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(314, '2023-06-01 12:07:22', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(315, '2023-06-01 12:09:18', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 1, 0),
(316, '2023-06-01 13:06:23', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 1, 0),
(317, '2023-06-01 13:06:28', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 2, 0),
(318, '2023-06-01 13:06:39', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 5, 6, 2, 0),
(319, '2023-06-01 13:06:49', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 4, 6, 49, 0),
(320, '2023-06-01 13:20:45', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 1, 6, 51, 0),
(321, '2023-06-01 13:20:53', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 6, 51, 0),
(322, '2023-06-01 13:20:58', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 2, 6, 51, 0),
(323, '2023-06-02 08:39:53', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(324, '2023-06-02 08:39:58', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(325, '2023-06-02 08:58:53', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 6, 49, 0),
(326, '2023-06-02 09:02:14', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(327, '2023-06-02 09:02:19', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(328, '2023-06-02 09:02:27', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, 6, 51, 0),
(329, '2023-06-02 09:04:09', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, 6, 51, 0),
(330, '2023-06-02 09:04:15', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, 6, 51, 0),
(331, '2023-06-02 09:04:32', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, 6, 51, 0),
(332, '2023-06-02 09:04:56', '51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 51, 0),
(333, '2023-06-02 09:05:04', '51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 51, 0),
(334, '2023-06-02 09:05:15', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, 6, 51, 0),
(335, '2023-06-02 09:05:21', '51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 51, 0),
(336, '2023-06-02 09:07:09', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 6, 49, 0),
(337, '2023-06-02 09:07:26', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(338, '2023-06-02 09:47:35', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 6, 49, 0),
(339, '2023-06-02 09:47:48', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(340, '2023-06-02 09:51:22', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 6, 49, 0),
(341, '2023-06-02 09:51:33', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(342, '2023-06-02 09:51:34', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 6, 49, 0),
(343, '2023-06-02 09:51:55', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(344, '2023-06-02 09:52:27', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 6, 49, 0),
(345, '2023-06-02 09:52:53', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 49, 0),
(346, '2023-06-02 11:43:01', '51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 51, 0),
(347, '2023-06-02 11:43:40', '49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 6, 52, 0),
(348, '2023-06-02 11:43:43', '51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 5, 6, 51, 0),
(349, '2023-06-02 11:43:53', '52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 52, 0),
(350, '2023-06-05 06:02:24', '1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 1, 0),
(351, '2023-06-05 06:03:31', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 4, 6, 2, 0),
(352, '2023-06-05 06:04:14', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, 1, 1, 0),
(353, '2023-06-05 06:04:18', '2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 2, 1, 2, 0),
(354, '2023-06-05 06:23:37', '2', '', 4, 6, 2, 0),
(355, '2023-06-05 06:23:45', '2', '', 4, 6, 2, 0),
(356, '2023-06-05 07:12:51', '2', '', 5, 6, 2, 0),
(357, '2023-06-05 07:14:50', '2', '', 4, 6, 2, 0),
(358, '2023-06-06 06:11:08', '2', '', 4, 6, 2, 0),
(359, '2023-06-06 07:44:58', '2', '', 5, 6, 2, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `maintheme`
--

CREATE TABLE `maintheme` (
  `themeid` int(11) NOT NULL,
  `schoolid` varchar(11) NOT NULL,
  `groupid` int(11) NOT NULL,
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

INSERT INTO `maintheme` (`themeid`, `schoolid`, `groupid`, `namethemep1`, `namethemep2`, `namethemep3`, `namethemep4`, `namethemep5`, `schoolyear`, `createdat`, `createdby`, `updatedat`, `updatedby`, `archive`, `deletedat`, `deletedby`) VALUES
(0, '1', 0, 'niet van toepasing', 'niet van toepasing', 'niet van toepasing', 'niet van toepasing', 'niet van toepasing', '1', '2023-05-23 08:58:16', 0, '2023-05-23 08:58:16', 0, 0, NULL, NULL),
(1, '1', 1, 'test thema 1', 'naam p2', 'naam p3', 'naam p4', 'naam p5', '1', '2023-05-03 08:19:06', 1, '2023-05-03 08:19:06', 1, 0, NULL, NULL),
(2, '1', 2, 'test thema 2', 'naam p2', 'naam p3', 'naam p4', 'naam p5', '1', '2023-05-03 08:19:14', 1, '2023-05-03 08:19:14', 1, 0, NULL, NULL),
(3, '2', 3, 'test thema 3', 'naam p2', 'naam p3', 'naam p4', 'naam p5', '1', '2023-05-03 08:19:14', 1, '2023-05-03 08:19:14', 1, 0, NULL, NULL),
(5, '1', 0, '1', '2', '3', '4', '5', '2', '2023-05-24 09:35:00', 0, '2023-05-24 09:35:00', 0, 0, NULL, NULL),
(6, '1', 0, '1', '1', '1', '1', '1', '2', '2023-06-05 08:10:06', 0, '2023-06-05 08:10:06', 0, 0, NULL, NULL),
(7, '1', 7, '12', '12', '12', '12', '12', '2', '2023-06-05 09:04:59', 0, '2023-06-05 09:04:59', 0, 0, NULL, NULL),
(8, '1', 0, '13', '13', '13', '13', '13', '2', '2023-06-05 09:07:04', 0, '2023-06-05 09:07:04', 0, 0, NULL, NULL),
(9, '1', 6, '14', '14', '14', '14', '14', '2', '2023-06-05 09:10:04', 0, '2023-06-05 09:10:04', 0, 0, NULL, NULL);

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
(21, 'asd', '2023-06-01 09:15:41', 1, '2023-06-01 09:15:41', 1, 0, NULL, NULL);

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
(0, 0, 'system', '', '', '', 3, '2023-05-09 09:29:55', 0, '2023-05-09 09:29:55', 0, 1, NULL, NULL),
(1, 0, 'superuser', 'test', 'test@test.nl', '$2y$10$PEIaTvE2w3VJw/t9iagKSu8tL1eUiGjYJqtkQ8snMoOWvW1lin6Lu', 2, '2023-05-03 08:20:53', 1, '2023-05-03 08:20:53', 1, 0, NULL, NULL),
(2, 1, 'school admin', 'test', 'een@test.nl', '$2y$10$PEIaTvE2w3VJw/t9iagKSu8tL1eUiGjYJqtkQ8snMoOWvW1lin6Lu', 1, '2023-05-03 08:21:20', 1, '2023-05-03 08:21:20', 1, 0, '2023-05-31 16:22:00', 2),
(3, 1, 'school docent', 'test', 'twee@test.nl', '$2y$10$PEIaTvE2w3VJw/t9iagKSu8tL1eUiGjYJqtkQ8snMoOWvW1lin6Lu', 0, '2023-05-10 16:14:24', 1, '2023-05-10 16:14:24', 1, 0, '2023-05-31 13:51:11', 2),
(45, 19, 'schooladmin', 'one', 'test beeway', '$2y$10$n0bNQG9rYwViXUCU38nKrORLrseI9qxpFM33UD8cjRM4LVqBQcE3q', 1, '2023-05-24 09:40:03', 1, '2023-05-24 09:40:03', 1, 0, NULL, NULL),
(48, 19, 'docent 2', 'test', 'asdf@asdf', '$2y$10$PzlD5LmLReARPFIyy9pm5eXqxdxi.w2PzfjoMeWwL1UZBQ53LKW5C', 1, '2023-05-31 10:18:24', 47, '2023-05-31 10:18:24', 47, 0, NULL, NULL),
(49, 21, 'schooladmin', 'one', 'asd', '$2y$10$/gUOnpYXN599EjE/w53xmet7cVhpuInUQi0PQGAzj2RM9wUKz21GK', 1, '2023-06-01 09:15:42', 1, '2023-06-01 09:15:42', 1, 0, NULL, NULL),
(51, 21, 'jan', 'docent 1', '3@asd.nl', '$2y$10$aZRZ0D7sYUYls9yuxh6P6.J7zFujutplNQj9Y2cjjbs8M6GFu1URy', 0, '2023-06-01 15:20:45', 49, '2023-06-02 11:05:15', 49, 0, NULL, NULL),
(52, 21, 'piet', 'docent 2', '1@asd.nl', '$2y$10$CioQR4B.1isgfKU2pr9eXOHZ6faW7mXckKKsADv1/FqYDtuYr663S', 0, '2023-06-02 13:43:40', 49, '2023-06-02 13:43:40', 49, 0, NULL, NULL);

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
  MODIFY `beewayid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `beewayobservation`
--
ALTER TABLE `beewayobservation`
  MODIFY `observationid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `beewayplanning`
--
ALTER TABLE `beewayplanning`
  MODIFY `planningid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `disciplineid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `linkgroups`
--
ALTER TABLE `linkgroups`
  MODIFY `linkgroupsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT voor een tabel `maintheme`
--
ALTER TABLE `maintheme`
  MODIFY `themeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `schools`
--
ALTER TABLE `schools`
  MODIFY `schoolid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
