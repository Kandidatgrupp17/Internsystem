

CREATE DATABASE `CHARM_System` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `CHARM_System`;

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(30) NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(16) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

/* ########Kanske behövs############
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
*/

CREATE TABLE IF NOT EXISTS `companies` (
  `Serienummer` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `Tid` text NOT NULL,
  `Draft` int(11) NOT NULL,
  `Organisationsnamn` text NOT NULL,
  `Organisationsnummer` text NOT NULL,
  `Typ av organisation` text NOT NULL,
  `Telefonnummer` int(11) NOT NULL,
  `Kommentar` text NOT NULL,
  `Antal barstolar` int(11) NOT NULL,
  `Bildskärm` text NOT NULL,
  `FID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;