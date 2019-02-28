# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.42)
# Database: sliders
# Generation Time: 2016-03-28 22:13:04 +0000
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
	('Time','30'),
	('showVideo','0'),
	('showVideoOther','0'),
	('totalTrials','10'),
	('totalPayTrials','3'),
	('showUpFee','100'),
	('mgroupsize','2'),
	('startexp','1'),
	('session','21'),
	('minValue','0'),
	('showChat','0'),
	('updateRateMS','200'),
	('lowValuePie','2'),
	('highValuePie','6'),
	('timeForDeal','2000'),
	('timeForWarning','1000'),
	('timeForIniOffer','5'),
	('robot','0'),
	('SPe','10'),
	('SPg','3'),
	('SPs','1'),
	('SPt','2');

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
  `sjnr` int(5) NOT NULL,
  `mgroup` int(5) NOT NULL,
  `informed` int(5) NOT NULL,
  `trial` int(5) NOT NULL,
  `sjnrother` int(5) NOT NULL,
  `submatch` int(5) NOT NULL,
  `piesize` varchar(11) NOT NULL,
  `startvalue` varchar(11) NOT NULL,
  `randomnr` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `matching` WRITE;
/*!40000 ALTER TABLE `matching` DISABLE KEYS */;

INSERT INTO `matching` (`sjnr`, `mgroup`, `informed`, `trial`, `sjnrother`, `submatch`, `piesize`, `startvalue`, `randomnr`)
VALUES
	(1,1,0,1,2,1,'6','2.9','954726'),
	(1,1,0,2,2,1,'2','3','245619'),
	(1,1,0,3,2,1,'2','5.1','209063'),
	(1,1,0,4,2,1,'6','4.7','781030'),
	(1,1,0,5,2,1,'2','1.1','589684'),
	(1,1,0,6,2,1,'2','3.4','894291'),
	(1,1,0,7,2,1,'2','0.6','372738'),
	(1,1,0,8,2,1,'6','5','448941'),
	(1,1,0,9,2,1,'2','1','906419'),
	(1,1,0,10,2,1,'6','2.2','2891'),
	(2,1,1,1,1,1,'6','4.9','754827'),
	(2,1,1,2,1,1,'2','0.4','806874'),
	(2,1,1,3,1,1,'2','1.9','847669'),
	(2,1,1,4,1,1,'6','3.5','102359'),
	(2,1,1,5,1,1,'2','5.5','677477'),
	(2,1,1,6,1,1,'2','1','2092'),
	(2,1,1,7,1,1,'2','3.2','103246'),
	(2,1,1,8,1,1,'6','3.7','524346'),
	(2,1,1,9,1,1,'2','1.4','98235'),
	(2,1,1,10,1,1,'6','5.1','240807'),
	(3,2,0,1,4,1,'2','0.1','443966'),
	(3,2,0,2,4,1,'2','5.4','843595'),
	(3,2,0,3,4,1,'2','1.9','375917'),
	(3,2,0,4,4,1,'6','0.7','730875'),
	(3,2,0,5,4,1,'2','0','433153'),
	(3,2,0,6,4,1,'2','5.7','352021'),
	(3,2,0,7,4,1,'6','4.5','843238'),
	(3,2,0,8,4,1,'6','1.4','207274'),
	(3,2,0,9,4,1,'6','1','223108'),
	(3,2,0,10,4,1,'6','2.6','337392'),
	(4,2,1,1,3,1,'2','3.8','378011'),
	(4,2,1,2,3,1,'2','1.3','113787'),
	(4,2,1,3,3,1,'2','4.2','597106'),
	(4,2,1,4,3,1,'6','0.4','94604'),
	(4,2,1,5,3,1,'2','4.6','75005'),
	(4,2,1,6,3,1,'2','2.9','470561'),
	(4,2,1,7,3,1,'6','3.7','96593'),
	(4,2,1,8,3,1,'6','0.3','612060'),
	(4,2,1,9,3,1,'6','0.7','771691'),
	(4,2,1,10,3,1,'6','4.8','500983'),
	(5,3,0,1,6,1,'2','0.4','115954'),
	(5,3,0,2,6,1,'2','3.2','247177'),
	(5,3,0,3,6,1,'6','0.6','741545'),
	(5,3,0,4,6,1,'2','3.2','652754'),
	(5,3,0,5,6,1,'2','1.9','236518'),
	(5,3,0,6,6,1,'6','4.2','215648'),
	(5,3,0,7,6,1,'2','3.5','651326'),
	(5,3,0,8,6,1,'2','1.2','510940'),
	(5,3,0,9,6,1,'2','1.9','729218'),
	(5,3,0,10,6,1,'2','4.9','709687'),
	(6,3,1,1,5,1,'2','4.1','254753'),
	(6,3,1,2,5,1,'2','1','132891'),
	(6,3,1,3,5,1,'6','3.4','954131'),
	(6,3,1,4,5,1,'2','0.7','513174'),
	(6,3,1,5,5,1,'2','2.2','470770'),
	(6,3,1,6,5,1,'6','2.4','913965'),
	(6,3,1,7,5,1,'2','0.5','785853'),
	(6,3,1,8,5,1,'2','2.1','868146'),
	(6,3,1,9,5,1,'2','2.8','620354'),
	(6,3,1,10,5,1,'2','2.4','67529'),
	(7,4,0,1,8,1,'6','3.7','296984'),
	(7,4,0,2,8,1,'2','4.9','830219'),
	(7,4,0,3,8,1,'6','5.3','32035'),
	(7,4,0,4,8,1,'2','2.1','925785'),
	(7,4,0,5,8,1,'6','0.6','874843'),
	(7,4,0,6,8,1,'6','0.2','657564'),
	(7,4,0,7,8,1,'2','4.6','378151'),
	(7,4,0,8,8,1,'2','3.5','704153'),
	(7,4,0,9,8,1,'2','2.9','244024'),
	(7,4,0,10,8,1,'2','2.3','254785'),
	(8,4,1,1,7,1,'6','2.4','797930'),
	(8,4,1,2,7,1,'2','1.8','310180'),
	(8,4,1,3,7,1,'6','5.7','153823'),
	(8,4,1,4,7,1,'2','5.7','589047'),
	(8,4,1,5,7,1,'6','5.6','628371'),
	(8,4,1,6,7,1,'6','1','899249'),
	(8,4,1,7,7,1,'2','2','797069'),
	(8,4,1,8,7,1,'2','3.5','755000'),
	(8,4,1,9,7,1,'2','4.3','816909'),
	(8,4,1,10,7,1,'2','0.9','913272'),
	(9,5,0,1,10,1,'2','2.8','648066'),
	(9,5,0,2,10,1,'2','4.9','451438'),
	(9,5,0,3,10,1,'6','4','411774'),
	(9,5,0,4,10,1,'2','5.7','825600'),
	(9,5,0,5,10,1,'6','4.6','422980'),
	(9,5,0,6,10,1,'2','3.9','171427'),
	(9,5,0,7,10,1,'2','5.2','905271'),
	(9,5,0,8,10,1,'6','5','534118'),
	(9,5,0,9,10,1,'2','3.4','889861'),
	(9,5,0,10,10,1,'2','1.1','418334'),
	(10,5,1,1,9,1,'2','2','9989'),
	(10,5,1,2,9,1,'2','5.9','913762'),
	(10,5,1,3,9,1,'6','3.8','447232'),
	(10,5,1,4,9,1,'2','2.3','663937'),
	(10,5,1,5,9,1,'6','4.2','392124'),
	(10,5,1,6,9,1,'2','0.6','891564'),
	(10,5,1,7,9,1,'2','4.6','875993'),
	(10,5,1,8,9,1,'6','2.6','913758'),
	(10,5,1,9,9,1,'2','3','609251'),
	(10,5,1,10,9,1,'2','4.1','226610'),
	(11,6,0,1,12,1,'2','2.3','335413'),
	(11,6,0,2,12,1,'6','2.1','165150'),
	(11,6,0,3,12,1,'2','2.7','749371'),
	(11,6,0,4,12,1,'2','1.1','78694'),
	(11,6,0,5,12,1,'2','1.7','602423'),
	(11,6,0,6,12,1,'6','1.9','445703'),
	(11,6,0,7,12,1,'2','4.5','472015'),
	(11,6,0,8,12,1,'6','4','989257'),
	(11,6,0,9,12,1,'2','4.5','7464'),
	(11,6,0,10,12,1,'6','1.6','951480'),
	(12,6,1,1,11,1,'2','2.4','420748'),
	(12,6,1,2,11,1,'6','1.3','751791'),
	(12,6,1,3,11,1,'2','0.2','983099'),
	(12,6,1,4,11,1,'2','4.4','530813'),
	(12,6,1,5,11,1,'2','1.5','114821'),
	(12,6,1,6,11,1,'6','0','268227'),
	(12,6,1,7,11,1,'2','3.2','349268'),
	(12,6,1,8,11,1,'6','2.8','748872'),
	(12,6,1,9,11,1,'2','2.6','66455'),
	(12,6,1,10,11,1,'6','5.1','657199'),
	(13,7,0,1,14,1,'6','4.5','324893'),
	(13,7,0,2,14,1,'2','0.3','387334'),
	(13,7,0,3,14,1,'6','1.1','283584'),
	(13,7,0,4,14,1,'6','0.2','513807'),
	(13,7,0,5,14,1,'2','2.6','977438'),
	(13,7,0,6,14,1,'2','1.8','392374'),
	(13,7,0,7,14,1,'6','3.7','101115'),
	(13,7,0,8,14,1,'6','3.7','896801'),
	(13,7,0,9,14,1,'6','0.2','255852'),
	(13,7,0,10,14,1,'2','2.3','423051'),
	(14,7,1,1,13,1,'6','2.6','137231'),
	(14,7,1,2,13,1,'2','1.6','347065'),
	(14,7,1,3,13,1,'6','1.2','872886'),
	(14,7,1,4,13,1,'6','2','913518'),
	(14,7,1,5,13,1,'2','1.3','216039'),
	(14,7,1,6,13,1,'2','4','650197'),
	(14,7,1,7,13,1,'6','5.3','963253'),
	(14,7,1,8,13,1,'6','0.9','843610'),
	(14,7,1,9,13,1,'6','0.2','650666'),
	(14,7,1,10,13,1,'2','2.5','26196'),
	(15,8,0,1,16,1,'2','4','883694'),
	(15,8,0,2,16,1,'2','2.2','414117'),
	(15,8,0,3,16,1,'6','2','215012'),
	(15,8,0,4,16,1,'6','3.7','428259'),
	(15,8,0,5,16,1,'6','0.4','319879'),
	(15,8,0,6,16,1,'2','1.1','695217'),
	(15,8,0,7,16,1,'2','0.9','244961'),
	(15,8,0,8,16,1,'2','1.2','598663'),
	(15,8,0,9,16,1,'2','1.7','520367'),
	(15,8,0,10,16,1,'2','4.2','669708'),
	(16,8,1,1,15,1,'2','3.9','648924'),
	(16,8,1,2,15,1,'2','0.4','968811'),
	(16,8,1,3,15,1,'6','2.3','294221'),
	(16,8,1,4,15,1,'6','0.1','482887'),
	(16,8,1,5,15,1,'6','3.4','662686'),
	(16,8,1,6,15,1,'2','4.5','953545'),
	(16,8,1,7,15,1,'2','3.4','5073'),
	(16,8,1,8,15,1,'2','0.1','995468'),
	(16,8,1,9,15,1,'2','5.3','944690'),
	(16,8,1,10,15,1,'2','0.1','502553');

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
	(1,2),
	(2,6),
	(3,7),
	(4,16),
	(5,11),
	(6,9),
	(7,10),
	(8,15),
	(9,8),
	(10,5),
	(11,14),
	(12,4),
	(13,1),
	(14,13),
	(15,12),
	(16,3);

/*!40000 ALTER TABLE `matchingSP` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table paymentSession
# ------------------------------------------------------------

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

CREATE TABLE `subjects` (
  `ppnr` int(5) NOT NULL,
  `trial` int(5) NOT NULL,
  `lab` varchar(11) NOT NULL,
  `session` int(11) NOT NULL,
  `currentpage` varchar(160) NOT NULL,
  `role` int(5) NOT NULL,
  `totearning` varchar(11) NOT NULL,
  `strategy` text NOT NULL,
  `comments` text NOT NULL,
  `datestamp` date NOT NULL,
  `timestamp` time NOT NULL,
  `sValue` decimal(10,1) DEFAULT NULL,
  `started` int(11) DEFAULT NULL,
  `timeBothStartedVideo` varchar(40) DEFAULT NULL,
  `blocked` int(11) DEFAULT NULL,
  `insMaxPage` int(11) DEFAULT NULL,
  `age` int(5) NOT NULL,
  `marital` varchar(30) DEFAULT NULL,
  `birthPlace` varchar(30) DEFAULT NULL,
  `ethnicity` varchar(30) DEFAULT NULL,
  `motherEnglish` varchar(11) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `vision` varchar(30) DEFAULT NULL,
  `politics` varchar(11) DEFAULT NULL,
  `education` varchar(11) DEFAULT NULL,
  `sex` varchar(11) NOT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `sexOr` varchar(11) DEFAULT NULL,
  `subID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeMarks
# ------------------------------------------------------------

CREATE TABLE `timeMarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `timeStamp` varchar(30) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table trialInfo
# ------------------------------------------------------------

CREATE TABLE `trialInfo` (
  `ppnr1` int(11) DEFAULT NULL,
  `ppnr2` int(11) DEFAULT NULL,
  `trial` int(11) DEFAULT NULL,
  `timeStartVideo` varchar(60) DEFAULT NULL,
  `endTime` varchar(60) DEFAULT NULL,
  `sValue` varchar(11) DEFAULT NULL,
  `timeStartScript` varchar(60) DEFAULT NULL,
  `pie` int(11) DEFAULT NULL,
  `agreement` int(11) DEFAULT NULL,
  `payoff` varchar(11) DEFAULT NULL,
  `videoSaved` int(11) DEFAULT NULL,
  `timeStartedBoth` varchar(60) DEFAULT NULL,
  `timeStartedPayoff` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
