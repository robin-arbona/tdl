-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 13, 2021 at 08:01 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tdl`
--

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `creator_login` varchar(255) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`id`, `name`, `description`, `owner_id`, `creator_login`, `done`, `start_date`, `end_date`) VALUES
(1, 'Faire mon cv!', 'reprendre mon cv et rajouter mes expériences de dev', 10, '0', 0, '2021-04-07 22:28:56', '2021-04-07 22:28:56'),
(4, 'Une tache', 'Grosse tache', 10, '10', 1, '2021-04-08 20:38:27', '2012-12-12 00:00:00'),
(5, 'Une tache', 'Grosse tache ..', 10, 'lala', 0, '2021-04-08 20:46:05', '2021-04-08 20:46:05'),
(10, 'hum', 'tadam', 10, 'lala', 0, '2021-04-08 22:46:36', '2022-12-12 00:00:00'),
(12, 'zfe', 'zef', 10, 'lala', 1, '2021-04-08 22:50:53', '2012-12-12 00:00:00'),
(13, 'hum hum', '12', 10, 'lala', 0, '2021-04-08 22:51:55', '2012-12-12 00:00:00'),
(14, 'fze', 'zevd', 10, 'lala', 0, '2021-04-08 22:52:52', '2021-04-08 22:52:52'),
(15, 'lala', 'yahouu', 10, 'lala', 1, '2021-04-09 21:25:16', '2012-12-12 00:00:00'),
(17, 'tachname', 'test descriptio', 2, 'lala', 0, '2021-04-11 23:06:56', '2012-12-12 00:00:00'),
(18, 'Pour lala', 'regales toi', 10, 'robinette', 1, '2021-04-12 08:47:58', '2012-12-12 00:00:00'),
(20, 'lala', 'test h', 10, 'lala', 0, '2021-04-12 18:51:15', '2021-04-12 18:51:15'),
(21, 'Patrice doit faire à manger', 'J\'espere que ca sera bon !', 10, 'lala', 0, '2021-04-12 19:31:19', '2012-12-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `login`, `email`, `password`, `privilege`) VALUES
(1, 'test', 'lala@lal.com', '$2y$10$l7bCeJmlJcO3NA4opaaB4eIaji17sfqoD3c297PlJsq8Ot6V6YVJ.', ''),
(2, 'robinet', 'lulu@gmail.com', '$2y$10$hL31x5VTI/ghmFt2KnFbkOtF5nHVIrp/x36b3JK8j0H82ZC4O/Zxq', 'a:1:{i:0;i:10;}'),
(6, 'robinette', 'arbona.robin@gmail.com', '$2y$10$VaEkwmoBGGht7V74t/08/efwb5hxISerzpo6Xc5AGi9omAf11aXmm', 'a:1:{i:0;i:10;}'),
(8, 'test1', 'lulu@gmail.com', '$2y$10$u9Ka/FQypDX17uMCWUqxZejNOzTmZGRrDvIhWxizczwK7tKdfYKMq', ''),
(9, 'test12', 'arbona.robin@gmail.com', '$2y$10$iemBIPmwVNx3/CaLSwioHuzgyPm.TMZSiRyOShIHYR3y6.5K7xgQ.', ''),
(10, 'lala', 'lala@lal.com', '$2y$10$bIvSD2nhdNrqS67DNYZJ7OulXszUtGPBIdmfCKCFvGxAIheUPmNF6', 'a:5:{i:0;i:2;i:3;i:11;i:4;i:6;i:5;i:9;i:6;i:1;}'),
(11, 'lulu', 'lulu@gmail.com', '$2y$10$UzUMNbWO2Q7hjUy2pvCGh.3NUWDd7u4GaHlwqnzaIVH/un3LkQL6O', ''),
(17, '', '', '$2y$10$c2q.fgh.XJZ9ITSERpGf8eaeHEOF1WGM1P8NkZWlm2mza3hQETJ2i', NULL),
(23, 'testzd', 'lala@lal.com', '$2y$10$uTN5UC/xkbscG7vYJgxzP.ddBxkeADLtOb3a616P8h8pQ5wWfzlY.', NULL),
(24, 'robin', 'arbona.robin@gmail.com', '$2y$10$NWvPnZlM4dJ5x1.4Kb3/bOK5dMsFdrpjGbZ.B8Ps8OeCVWEOb8W5C', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk(user.id)` (`owner_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Task`
--
ALTER TABLE `Task`
  ADD CONSTRAINT `fk(user.id)` FOREIGN KEY (`owner_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
