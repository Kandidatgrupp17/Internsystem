CREATE DATABASE `CHARM_System` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `CHARM_System`;
-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2012 at 10:17 AM
-- Server version: 5.5.22
-- PHP Version: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CHARM_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `AccessID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`AccessID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`AccessID`, `Name`) VALUES
(1, 'CHARMk'),
(2, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Kon` varchar(30) NOT NULL,
  `Sektion` varchar(30) NOT NULL,
  `Vardtyp` varchar(50) NOT NULL,
  `Onskat_foretag` varchar(50) NOT NULL,
  `Beratta_om_dig_sjalv` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `UserID`, `Name`, `Email`, `Kon`, `Sektion`, `Vardtyp`, `Onskat_foretag`, `Beratta_om_dig_sjalv`) VALUES
(3, 6, 'Caroline Strandberg', 'castra@student.chalmers.se', 'Kvinna', 'D', 'Ovrigt', 'Foretag3', 'IT-Carro här!'),
(5, 4, 'Oscar Carlsson', 'coscar@student.chalmers.se', 'Man', 'D', 'Foretagsvard', 'Foretag3', 'Hej');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `UserID` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `host_type` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`UserID`, `status`, `host_type`, `company`) VALUES
(4, 'Vantande', 'Ej_tilldelad', ''),
(6, 'Antagen', 'Foretagsvard', 'ACME nr0' );

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('32eedfd39f754f98b829674b621a938a', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.19 (KHTML, like Gecko) Ubuntu/12.04 Chromium/18.0.1025.151 Chrome/18.0.1', 1337069232, ''),
('44e86e5dc2330380e98894f1da371b5b', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.19 (KHTML, like Gecko) Ubuntu/12.04 Chromium/18.0.1025.151 Chrome/18.0.1', 1337029440, 'a:4:{s:9:"user_data";s:0:"";s:6:"UserID";s:1:"0";s:5:"Email";N;s:8:"loggedin";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `Serienummer` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `Tid` text NOT NULL,
  `Draft` int(11) NOT NULL,
  `Organisationsnamn` text NOT NULL,
  `Organisationsnummer` text NOT NULL,
  `Typ_av_organisation` text NOT NULL,
  `Telefonnummer` text NOT NULL,
  `Kommentar` text NOT NULL,
  `Antal_barstolar` int(11) NOT NULL,
  `Bildskarm` text NOT NULL,
  `FID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`Serienummer`, `SID`, `Tid`, `Draft`, `Organisationsnamn`, `Organisationsnummer`, `Typ_av_organisation`, `Telefonnummer`, `Kommentar`, `Antal_barstolar`, `Bildskarm`, `FID`) VALUES
(1, 0, '13:15', 1, 'Foretag1 AB', '012431', 'Ideell', 716123234, 'Tom', 5, 'Typ 5', 8),
(2, 1, '13:15', 1, 'Foretag2 HB', '0121235', 'Foretag', 716123234, 'Tom', 4, 'Typ 1', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(30) NOT NULL,
  `Password` text NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Institute` varchar(4) NOT NULL,
  `Registered` date NOT NULL,
  `AccessID` int(11) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Email`, `Password`, `FirstName`, `LastName`, `Institute`, `Registered`, `AccessID`) VALUES
(4, 'coscar@student.chalmers.se', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Oscar', 'Carlsson', 'KfKb', '2012-05-03', 2),
(0, 'anton@student.chalmers.se', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Anton', 'Svensson', 'E', '2012-05-06', 2),
(6, 'castra@student.chalmers.se', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Caroline', 'Strandberg', 'D', '2012-05-07', 2),
(8, 'max@charm.chalmers.se', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Max', 'Sikström', 'F', '2012-05-12', 1),
(9, 'mirac@student.chalmers.se', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mirac', 'Günes', 'D', '2012-05-13', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
