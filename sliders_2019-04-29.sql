# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.23)
# Database: sliders
# Generation Time: 2019-04-29 11:33:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table commonParameters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `commonParameters`;

CREATE TABLE `commonParameters` (
  `Name` varchar(22) NOT NULL,
  `Value` varchar(11) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `commonParameters` WRITE;
/*!40000 ALTER TABLE `commonParameters` DISABLE KEYS */;

INSERT INTO `commonParameters` (`Name`, `Value`)
VALUES
	('NPlayers','16'),
	('Steps','0.1'),
	('maxValue','6'),
	('Time','30000'),
	('showVideo','0'),
	('showVideoOther','0'),
	('totalTrials','10'),
	('totalPayTrials','3'),
	('showUpFee','100'),
	('mgroupsize','2'),
	('startexp','0'),
	('session','29'),
	('minValue','0'),
	('showChat','0'),
	('updateRateMS','200'),
	('lowValuePie','2'),
	('highValuePie','6'),
	('timeForDeal','2000'),
	('timeForWarning','1000'),
	('timeForIniOffer','5000'),
	('robot','0'),
	('SPe','10'),
	('SPg','3'),
	('SPs','1'),
	('SPt','2'),
	('treatment','1');

/*!40000 ALTER TABLE `commonParameters` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table instructions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `instructions`;

CREATE TABLE `instructions` (
  `part` int(11) NOT NULL,
  `pagenumber` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `nameinmenu` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `instructions` WRITE;
/*!40000 ALTER TABLE `instructions` DISABLE KEYS */;

INSERT INTO `instructions` (`part`, `pagenumber`, `filename`, `nameinmenu`)
VALUES
	(1,0,'instructions1.php','Welcome'),
	(1,1,'instructions2.php','Basics 1'),
	(1,2,'instructions3.php','Basics 2'),
	(2,3,'instructions4.php','Example'),
	(1,5,'instructions6chat.php','Chat and Video Recording'),
	(1,7,'quiz2.php','Quiz questions 2'),
	(1,6,'quiz1.php','Quiz questions 1'),
	(1,8,'quiz3.php','Quiz questions 3'),
	(1,9,'quiz4.php','Quiz questions 4'),
	(2,0,'instructions1.php','Welcome'),
	(2,1,'instructions2.php','Basics 1'),
	(2,2,'instructions3.php','Basics 2'),
	(2,6,'quiz1.php','Quiz questions 1'),
	(2,7,'quiz2.php','Quiz questions 2'),
	(2,8,'quiz3.php','Quiz questions 3'),
	(2,5,'instructions6nochat.php','Video Recording'),
	(1,3,'instructions4.php','Example'),
	(1,4,'instructions5.php','Payment and Rounds'),
	(2,4,'instructions5.php','Payment and Rounds');

/*!40000 ALTER TABLE `instructions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table LogChats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `LogChats`;

CREATE TABLE `LogChats` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ppnr` int(11) DEFAULT NULL,
  `trial` int(11) DEFAULT NULL,
  `Chat` text,
  `time` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table matching
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matching`;

CREATE TABLE `matching` (
  `sjnr` int(5) DEFAULT NULL,
  `mgroup` int(5) DEFAULT NULL,
  `informed` int(5) DEFAULT NULL,
  `trial` int(5) DEFAULT NULL,
  `sjnrother` int(5) DEFAULT NULL,
  `submatch` int(5) DEFAULT NULL,
  `piesize` int(5) DEFAULT NULL,
  `startvalue` varchar(11) DEFAULT '',
  `randomnr` varchar(11) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `matching` WRITE;
/*!40000 ALTER TABLE `matching` DISABLE KEYS */;

INSERT INTO `matching` (`sjnr`, `mgroup`, `informed`, `trial`, `sjnrother`, `submatch`, `piesize`, `startvalue`, `randomnr`)
VALUES
	(1,1,0,1,2,1,2,'2.2','129313'),
	(1,1,0,2,2,1,2,'2.3','333956'),
	(1,1,0,3,2,1,6,'5.8','600057'),
	(1,1,0,4,2,1,6,'5','511517'),
	(1,1,0,5,2,1,6,'2.9','763871'),
	(1,1,0,6,2,1,6,'4.9','54916'),
	(1,1,0,7,2,1,6,'0.9','245520'),
	(1,1,0,8,2,1,6,'5.3','790236'),
	(1,1,0,9,2,1,6,'4.6','164459'),
	(1,1,0,10,2,1,2,'1.1','840094'),
	(2,1,1,1,1,1,2,'3.1','352424'),
	(2,1,1,2,1,1,2,'0.9','466778'),
	(2,1,1,3,1,1,6,'5.4','271387'),
	(2,1,1,4,1,1,6,'2.3','245047'),
	(2,1,1,5,1,1,6,'3.5','2631'),
	(2,1,1,6,1,1,6,'0.5','87022'),
	(2,1,1,7,1,1,6,'0.4','280267'),
	(2,1,1,8,1,1,6,'5.4','395270'),
	(2,1,1,9,1,1,6,'5.3','452369'),
	(2,1,1,10,1,1,2,'0.5','380290'),
	(3,2,0,1,4,1,2,'2','961279'),
	(3,2,0,2,4,1,6,'0.6','520661'),
	(3,2,0,3,4,1,6,'5.2','566243'),
	(3,2,0,4,4,1,2,'1.3','763150'),
	(3,2,0,5,4,1,2,'3.5','409888'),
	(3,2,0,6,4,1,2,'1.8','237336'),
	(3,2,0,7,4,1,2,'4.8','634368'),
	(3,2,0,8,4,1,6,'2','958402'),
	(3,2,0,9,4,1,2,'0.1','272161'),
	(3,2,0,10,4,1,2,'3.9','10454'),
	(4,2,1,1,3,1,2,'4.4','743279'),
	(4,2,1,2,3,1,6,'4.1','549781'),
	(4,2,1,3,3,1,6,'3.1','938206'),
	(4,2,1,4,3,1,2,'3.7','660020'),
	(4,2,1,5,3,1,2,'0.8','324268'),
	(4,2,1,6,3,1,2,'4.1','308397'),
	(4,2,1,7,3,1,2,'0.7','125980'),
	(4,2,1,8,3,1,6,'5.8','203301'),
	(4,2,1,9,3,1,2,'5.9','93421'),
	(4,2,1,10,3,1,2,'4.2','390833'),
	(5,3,0,1,6,1,2,'2.1','133217'),
	(5,3,0,2,6,1,6,'0.1','721593'),
	(5,3,0,3,6,1,6,'4','784905'),
	(5,3,0,4,6,1,2,'2.6','408871'),
	(5,3,0,5,6,1,6,'0.6','885437'),
	(5,3,0,6,6,1,6,'4.7','250798'),
	(5,3,0,7,6,1,2,'4.9','624961'),
	(5,3,0,8,6,1,6,'0.3','581310'),
	(5,3,0,9,6,1,6,'0','585330'),
	(5,3,0,10,6,1,2,'3.6','256497'),
	(6,3,1,1,5,1,2,'3.8','589340'),
	(6,3,1,2,5,1,6,'5.3','252646'),
	(6,3,1,3,5,1,6,'5.1','792116'),
	(6,3,1,4,5,1,2,'3.5','133158'),
	(6,3,1,5,5,1,6,'1.4','929403'),
	(6,3,1,6,5,1,6,'0.6','586784'),
	(6,3,1,7,5,1,2,'5.5','918087'),
	(6,3,1,8,5,1,6,'3','634272'),
	(6,3,1,9,5,1,6,'5.9','253477'),
	(6,3,1,10,5,1,2,'3','971185'),
	(7,4,0,1,8,1,6,'0.1','325725'),
	(7,4,0,2,8,1,6,'0.7','612710'),
	(7,4,0,3,8,1,2,'2.9','793416'),
	(7,4,0,4,8,1,2,'5.3','547359'),
	(7,4,0,5,8,1,2,'4.6','58558'),
	(7,4,0,6,8,1,2,'0.2','135230'),
	(7,4,0,7,8,1,2,'3.1','673566'),
	(7,4,0,8,8,1,2,'2.6','48770'),
	(7,4,0,9,8,1,6,'1.7','864885'),
	(7,4,0,10,8,1,6,'1.7','7869'),
	(8,4,1,1,7,1,6,'3.4','136812'),
	(8,4,1,2,7,1,6,'4.4','711988'),
	(8,4,1,3,7,1,2,'3.3','115360'),
	(8,4,1,4,7,1,2,'3.7','336323'),
	(8,4,1,5,7,1,2,'3.5','659452'),
	(8,4,1,6,7,1,2,'2.1','754594'),
	(8,4,1,7,7,1,2,'1.1','629220'),
	(8,4,1,8,7,1,2,'5','945786'),
	(8,4,1,9,7,1,6,'0.1','281079'),
	(8,4,1,10,7,1,6,'2.8','394798'),
	(9,5,0,1,10,1,6,'0.4','194075'),
	(9,5,0,2,10,1,6,'1.5','302274'),
	(9,5,0,3,10,1,6,'2.5','669745'),
	(9,5,0,4,10,1,2,'0.7','548400'),
	(9,5,0,5,10,1,6,'0.1','692555'),
	(9,5,0,6,10,1,2,'1.7','856525'),
	(9,5,0,7,10,1,6,'0.1','422277'),
	(9,5,0,8,10,1,6,'3.4','649042'),
	(9,5,0,9,10,1,2,'1.8','378252'),
	(9,5,0,10,10,1,6,'1.2','359691'),
	(10,5,1,1,9,1,6,'4','289836'),
	(10,5,1,2,9,1,6,'4.9','469726'),
	(10,5,1,3,9,1,6,'1.6','41917'),
	(10,5,1,4,9,1,2,'1.9','951012'),
	(10,5,1,5,9,1,6,'0.7','282057'),
	(10,5,1,6,9,1,2,'3.7','338361'),
	(10,5,1,7,9,1,6,'3.6','728830'),
	(10,5,1,8,9,1,6,'0.4','889620'),
	(10,5,1,9,9,1,2,'2.9','915761'),
	(10,5,1,10,9,1,6,'4.6','437955'),
	(11,6,0,1,12,1,6,'0.8','427702'),
	(11,6,0,2,12,1,2,'3.3','375211'),
	(11,6,0,3,12,1,2,'0.7','800977'),
	(11,6,0,4,12,1,6,'5.2','467295'),
	(11,6,0,5,12,1,6,'5.5','820067'),
	(11,6,0,6,12,1,2,'2.5','384006'),
	(11,6,0,7,12,1,2,'5.5','890893'),
	(11,6,0,8,12,1,6,'5.7','3865'),
	(11,6,0,9,12,1,2,'5.9','232635'),
	(11,6,0,10,12,1,6,'4.6','47018'),
	(12,6,1,1,11,1,6,'2.5','253011'),
	(12,6,1,2,11,1,2,'1.7','89733'),
	(12,6,1,3,11,1,2,'3.2','144072'),
	(12,6,1,4,11,1,6,'0.2','516075'),
	(12,6,1,5,11,1,6,'5.7','130704'),
	(12,6,1,6,11,1,2,'1','764157'),
	(12,6,1,7,11,1,2,'4.8','507842'),
	(12,6,1,8,11,1,6,'2.8','993787'),
	(12,6,1,9,11,1,2,'0.8','742338'),
	(12,6,1,10,11,1,6,'2.6','731463'),
	(13,7,0,1,14,1,2,'2.8','9557'),
	(13,7,0,2,14,1,6,'2','766786'),
	(13,7,0,3,14,1,6,'5.6','362844'),
	(13,7,0,4,14,1,2,'4.7','89609'),
	(13,7,0,5,14,1,2,'2.8','797718'),
	(13,7,0,6,14,1,2,'2.7','844658'),
	(13,7,0,7,14,1,6,'2.2','326341'),
	(13,7,0,8,14,1,6,'4.4','24689'),
	(13,7,0,9,14,1,2,'2.2','37614'),
	(13,7,0,10,14,1,2,'2.9','391619'),
	(14,7,1,1,13,1,2,'5.1','571207'),
	(14,7,1,2,13,1,6,'3','189285'),
	(14,7,1,3,13,1,6,'2.4','90671'),
	(14,7,1,4,13,1,2,'6','999431'),
	(14,7,1,5,13,1,2,'3.4','354095'),
	(14,7,1,6,13,1,2,'1.9','673430'),
	(14,7,1,7,13,1,6,'2.8','689433'),
	(14,7,1,8,13,1,6,'4','308222'),
	(14,7,1,9,13,1,2,'0.5','174884'),
	(14,7,1,10,13,1,2,'5.8','385941'),
	(15,8,0,1,16,1,6,'1.8','945926'),
	(15,8,0,2,16,1,6,'4.5','765490'),
	(15,8,0,3,16,1,6,'5.9','954061'),
	(15,8,0,4,16,1,2,'5.5','346114'),
	(15,8,0,5,16,1,2,'3.1','848598'),
	(15,8,0,6,16,1,2,'3.8','446109'),
	(15,8,0,7,16,1,2,'5.9','86852'),
	(15,8,0,8,16,1,6,'2.3','399311'),
	(15,8,0,9,16,1,6,'4.3','420962'),
	(15,8,0,10,16,1,2,'1.9','706822'),
	(16,8,1,1,15,1,6,'5.5','707383'),
	(16,8,1,2,15,1,6,'2.2','45137'),
	(16,8,1,3,15,1,6,'3.8','697494'),
	(16,8,1,4,15,1,2,'5.2','546931'),
	(16,8,1,5,15,1,2,'6','601516'),
	(16,8,1,6,15,1,2,'0.3','641196'),
	(16,8,1,7,15,1,2,'0.7','963090'),
	(16,8,1,8,15,1,6,'0.5','567285'),
	(16,8,1,9,15,1,6,'4.4','610842'),
	(16,8,1,10,15,1,2,'0.9','795150');

/*!40000 ALTER TABLE `matching` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table matchingSP
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matchingSP`;

CREATE TABLE `matchingSP` (
  `ppnr1` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ppnr2` int(11) DEFAULT NULL,
  PRIMARY KEY (`ppnr1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `matchingSP` WRITE;
/*!40000 ALTER TABLE `matchingSP` DISABLE KEYS */;

INSERT INTO `matchingSP` (`ppnr1`, `ppnr2`)
VALUES
	(1,15),
	(2,10),
	(3,2),
	(4,12),
	(5,1),
	(6,7),
	(7,14),
	(8,11),
	(9,8),
	(10,5),
	(11,6),
	(12,16),
	(13,9),
	(14,4),
	(15,13),
	(16,3);

/*!40000 ALTER TABLE `matchingSP` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table paymentSession
# ------------------------------------------------------------

DROP TABLE IF EXISTS `paymentSession`;

CREATE TABLE `paymentSession` (
  `ppnr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment` varchar(11) DEFAULT NULL,
  `paymentSP` varchar(11) DEFAULT NULL,
  `paymentSPOther` varchar(11) DEFAULT NULL,
  `totalPayment` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ppnr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table sliderLog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sliderLog`;

CREATE TABLE `sliderLog` (
  `ppnr1` int(11) DEFAULT NULL,
  `ppnr2` int(11) DEFAULT NULL,
  `time` varchar(60) DEFAULT NULL,
  `sValue1` varchar(60) DEFAULT NULL,
  `sValue2` varchar(60) DEFAULT NULL,
  `trial` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table socialPref
# ------------------------------------------------------------

DROP TABLE IF EXISTS `socialPref`;

CREATE TABLE `socialPref` (
  `ppnr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `disadvIneq` varchar(60) DEFAULT NULL,
  `advIneq` varchar(60) DEFAULT NULL,
  `earnings` int(11) DEFAULT NULL,
  `earningsOther` int(11) DEFAULT NULL,
  PRIMARY KEY (`ppnr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table subjects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `ppnr` int(5) NOT NULL,
  `trial` int(5) NOT NULL,
  `lab` varchar(11) DEFAULT '',
  `session` int(11) NOT NULL,
  `currentpage` varchar(160) DEFAULT '',
  `role` int(5) DEFAULT NULL,
  `totearning` varchar(11) DEFAULT '',
  `strategy` text,
  `comments` text,
  `datestamp` date DEFAULT NULL,
  `timestamp` time DEFAULT NULL,
  `sValue` decimal(10,1) DEFAULT NULL,
  `started` int(11) DEFAULT NULL,
  `timeBothStartedVideo` varchar(40) DEFAULT NULL,
  `blocked` int(11) DEFAULT NULL,
  `insMaxPage` int(11) DEFAULT NULL,
  `age` int(5) DEFAULT NULL,
  `marital` varchar(30) DEFAULT NULL,
  `birthPlace` varchar(30) DEFAULT NULL,
  `ethnicity` varchar(30) DEFAULT NULL,
  `motherEnglish` varchar(11) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `vision` varchar(30) DEFAULT NULL,
  `politics` varchar(11) DEFAULT NULL,
  `education` varchar(11) DEFAULT NULL,
  `sex` varchar(11) DEFAULT '',
  `gender` varchar(11) DEFAULT NULL,
  `sexOr` varchar(11) DEFAULT NULL,
  `subID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeMarks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeMarks`;

CREATE TABLE `timeMarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `timeStamp` varchar(30) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `ppnr` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table trialInfo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trialInfo`;

CREATE TABLE `trialInfo` (
  `ppnr1` int(11) DEFAULT NULL,
  `ppnr2` int(11) DEFAULT NULL,
  `trial` int(11) DEFAULT NULL,
  `timeStarted` varchar(60) DEFAULT NULL,
  `pie` int(11) DEFAULT NULL,
  `endTime` varchar(60) DEFAULT NULL,
  `sValue` varchar(11) DEFAULT NULL,
  `agreement` int(11) DEFAULT NULL,
  `payoff` varchar(30) DEFAULT NULL,
  `errorFlag` int(11) DEFAULT NULL,
  `timeStartedBoth` varchar(60) DEFAULT NULL,
  `timeStartedPayoff` varchar(60) DEFAULT NULL,
  `timeStartVideo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
