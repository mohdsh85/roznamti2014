-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2016 at 09:31 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roz2016`
--

-- --------------------------------------------------------

--
-- Table structure for table `roz_events_2_current`
--

CREATE TABLE IF NOT EXISTS `roz_events_2_current` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `other_id` int(11) NOT NULL,
  `other_id_2` int(11) NOT NULL,
  `image` text NOT NULL,
  `other_resources` int(11) NOT NULL,
  `event_location` text NOT NULL,
  `event_rate` int(11) NOT NULL,
  `event_mapped_key` int(11) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `cat_id` (`cat_id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roz_events_2_history`
--

CREATE TABLE IF NOT EXISTS `roz_events_2_history` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `other_id` int(11) NOT NULL,
  `other_id_2` int(11) NOT NULL,
  `image` text NOT NULL,
  `other_resources` int(11) NOT NULL,
  `event_location` text NOT NULL,
  `event_rate` int(11) NOT NULL,
  `event_mapped_key` int(11) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `cat_id` (`cat_id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roz_events_2_info`
--

CREATE TABLE IF NOT EXISTS `roz_events_2_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_program_id` int(11) DEFAULT NULL,
  `mapped_key` int(1) DEFAULT '0',
  `title_ar` varchar(150) NOT NULL,
  `description_ar` text NOT NULL,
  `title_en` varchar(150) NOT NULL,
  `description_en` text NOT NULL,
  `image` text NOT NULL,
  `tagz` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_program_id` (`sub_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roz_events_3_current`
--

CREATE TABLE IF NOT EXISTS `roz_events_3_current` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `other_id` int(11) NOT NULL,
  `other_id_2` int(11) NOT NULL,
  `image` text NOT NULL,
  `other_resources` int(11) NOT NULL,
  `event_location` text NOT NULL,
  `event_rate` int(11) NOT NULL,
  `event_mapped_key` int(11) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `cat_id` (`cat_id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `roz_events_3_current`
--

INSERT INTO `roz_events_3_current` (`event_id`, `start_date`, `end_date`, `owner`, `cat_id`, `url`, `other_id`, `other_id_2`, `image`, `other_resources`, `event_location`, `event_rate`, `event_mapped_key`) VALUES
(1, 1497266100, 1497272880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(2, 1497359700, 1497366480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(3, 1497453300, 1497460080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(4, 1497546900, 1497553680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(5, 1497640500, 1497647280, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(6, 1497734100, 1497740880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(7, 1497783600, 1497789420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(8, 1497877200, 1497883020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(9, 1497970800, 1497976620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(10, 1498064400, 1498070220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(11, 1498158900, 1498164720, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(12, 1498252500, 1498258320, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(13, 1498302900, 1498308900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(14, 1498396500, 1498402500, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(15, 1498490100, 1498496100, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(16, 1498583700, 1498589700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(17, 1498678200, 1498684200, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(18, 1498770900, 1498776900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(19, 1498820400, 1498826220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(20, 1498914000, 1498919820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(21, 1499007600, 1499013420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(22, 1499101200, 1499107020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(23, 1499202900, 1499208720, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(24, 1499253300, 1499260080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(25, 1499346900, 1499353680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(26, 1499440500, 1499447280, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(27, 1499534100, 1499540880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(28, 1499627700, 1499634480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(29, 1499721300, 1499728080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(30, 1499770800, 1499776620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(31, 1499864400, 1499870220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(32, 1499958000, 1499963820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(33, 1500051600, 1500057420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(34, 1500146100, 1500151920, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(35, 1500239700, 1500245520, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(36, 1500290100, 1500296100, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(37, 1500383700, 1500389700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(38, 1500477300, 1500483300, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(39, 1500570900, 1500576900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(40, 1500665400, 1500671400, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(41, 1500758100, 1500764100, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(42, 1500807600, 1500813420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(43, 1500901200, 1500907020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(44, 1500994800, 1501000620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(45, 1501088400, 1501094220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(46, 1501190100, 1501195920, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(47, 1501240500, 1501247280, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(48, 1501334100, 1501340880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(49, 1501427700, 1501434480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(50, 1501521300, 1501528080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(51, 1501614900, 1501621680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(52, 1501708500, 1501715280, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(53, 1501758000, 1501763820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(54, 1501851600, 1501857420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(55, 1501945200, 1501951020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(56, 1502038800, 1502044620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(57, 1502133300, 1502139120, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(58, 1502226900, 1502232720, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(59, 1502277300, 1502283300, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(60, 1502370900, 1502376900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(61, 1502464500, 1502470500, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(62, 1502558100, 1502564100, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(63, 1502652600, 1502658600, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(64, 1502745300, 1502751300, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(65, 1502794800, 1502800620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(66, 1502888400, 1502894220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(67, 1502982000, 1502987820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(68, 1503075600, 1503081420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(69, 1503177300, 1503183120, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(70, 1503227700, 1503234480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(71, 1503321300, 1503328080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(72, 1503414900, 1503421680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(73, 1503508500, 1503515280, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(74, 1503602100, 1503608880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(75, 1503695700, 1503702480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(76, 1503745200, 1503751020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(77, 1503838800, 1503844620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(78, 1503932400, 1503938220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(79, 1504026000, 1504031820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(80, 1504120500, 1504126320, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(81, 1504214100, 1504219920, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(82, 1504264500, 1504270500, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(83, 1504358100, 1504364100, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(84, 1504451700, 1504457700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(85, 1504545300, 1504551300, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(86, 1504639800, 1504645800, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(87, 1504732500, 1504738500, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(88, 1504782000, 1504787820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(89, 1504875600, 1504881420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(90, 1504969200, 1504975020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(91, 1505062800, 1505068620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(92, 1505164500, 1505170320, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(93, 1505214900, 1505221680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(94, 1505308500, 1505315280, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(95, 1505402100, 1505408880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(96, 1505495700, 1505502480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(97, 1505589300, 1505596080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(98, 1505682900, 1505689680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(99, 1505732400, 1505738220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(100, 1505826000, 1505831820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(101, 1505919600, 1505925420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(102, 1506013200, 1506019020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(103, 1506107700, 1506113520, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(104, 1506201300, 1506207120, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(105, 1506251700, 1506257700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(106, 1506345300, 1506351300, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(107, 1506438900, 1506444900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(108, 1506532500, 1506538500, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(109, 1506627000, 1506633000, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(110, 1506719700, 1506725700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(111, 1506769200, 1506775020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(112, 1506862800, 1506868620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(113, 1506956400, 1506962220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(114, 1507050000, 1507055820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(115, 1507151700, 1507157520, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(116, 1507202100, 1507208880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(117, 1507295700, 1507302480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(118, 1507389300, 1507396080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(119, 1507482900, 1507489680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(120, 1507576500, 1507583280, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(121, 1507670100, 1507676880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(122, 1507719600, 1507725420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(123, 1507813200, 1507819020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(124, 1507906800, 1507912620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(125, 1508000400, 1508006220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(126, 1508094900, 1508100720, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(127, 1508188500, 1508194320, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(128, 1508238900, 1508244900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(129, 1508332500, 1508338500, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(130, 1508426100, 1508432100, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(131, 1508519700, 1508525700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(132, 1508614200, 1508620200, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(133, 1508706900, 1508712900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(134, 1508756400, 1508762220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(135, 1508850000, 1508855820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(136, 1508943600, 1508949420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(137, 1509037200, 1509043020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(138, 1509138900, 1509144720, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(139, 1509189300, 1509196080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(140, 1509282900, 1509289680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(141, 1509380100, 1509386880, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(142, 1509473700, 1509480480, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(143, 1509567300, 1509574080, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(144, 1509660900, 1509667680, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1104),
(145, 1509710400, 1509716220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(146, 1509804000, 1509809820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(147, 1509897600, 1509903420, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(148, 1509991200, 1509997020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(149, 1510085700, 1510091520, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(150, 1510179300, 1510185120, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 812),
(151, 1510229700, 1510235700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(152, 1510323300, 1510329300, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(153, 1510416900, 1510422900, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(154, 1510510500, 1510516500, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(155, 1510605000, 1510611000, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(156, 1510697700, 1510703700, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 1955),
(157, 1510747200, 1510753020, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(158, 1510840800, 1510846620, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(159, 1510934400, 1510940220, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(160, 1511028000, 1511033820, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494),
(161, 1511129700, 1511135520, 0, 3, '', 0, 0, '', 0, 'Zara Center, Wadi Saqra Street, Amman.', 0, 2494);

-- --------------------------------------------------------

--
-- Table structure for table `roz_events_3_history`
--

CREATE TABLE IF NOT EXISTS `roz_events_3_history` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `other_id` int(11) NOT NULL,
  `other_id_2` int(11) NOT NULL,
  `image` text NOT NULL,
  `other_resources` int(11) NOT NULL,
  `event_location` text NOT NULL,
  `event_rate` int(11) NOT NULL,
  `event_mapped_key` int(11) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `cat_id` (`cat_id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roz_events_3_info`
--

CREATE TABLE IF NOT EXISTS `roz_events_3_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_program_id` int(11) DEFAULT NULL,
  `mapped_key` int(1) DEFAULT '0',
  `title_ar` varchar(150) NOT NULL,
  `description_ar` text NOT NULL,
  `title_en` varchar(150) NOT NULL,
  `description_en` text NOT NULL,
  `image` text NOT NULL,
  `tagz` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_program_id` (`sub_program_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `roz_events_3_info`
--

INSERT INTO `roz_events_3_info` (`id`, `sub_program_id`, `mapped_key`, `title_ar`, `description_ar`, `title_en`, `description_en`, `image`, `tagz`) VALUES
(1, NULL, 1104, 'Edge of Tomorrow', 'Cast: Tom Cruise, Emily Blunt, Bill Paxton. An officer finds himself caught in a time loop in a war with an alien race. His skills increase as he faces the same brutal combat scenarios, and his union with a Special Forces warrior gets him closer and closer to defeating the enemy.', 'Edge of Tomorrow', 'Cast: Tom Cruise, Emily Blunt, Bill Paxton. An officer finds himself caught in a time loop in a war with an alien race. His skills increase as he faces the same brutal combat scenarios, and his union with a Special Forces warrior gets him closer and closer to defeating the enemy.', '20110508172024!Nat_geo_channel_abu_dhabi.png', ''),
(7, NULL, 812, 'Maleficent - 3D', 'Cast: Angelina Jolie, Elle Fanning. The untold story of Disney`s most iconic villain from the 1959 classic &quot;Sleeping Beauty.&quot; A beautiful, pure-hearted young woman with stunning black wings, Maleficent has an idyllic life growing up in a peaceable forest kingdom, until one day when an invading army of humans threatens the harmony of the land. Maleficent rises to be the land`s fiercest protector, but she ultimately suffers a ruthless betrayal - an act that begins to turn her pure heart to stone. Bent on revenge, Maleficent faces an epic battle with the king of the humans and, as a result, places a curse upon his newborn infant Aurora. As the child grows, Maleficent realizes that Aurora holds the key to peace in the kingdom - and to Maleficent`s true happiness as well.', 'Maleficent - 3D', 'Cast: Angelina Jolie, Elle Fanning. The untold story of Disney`s most iconic villain from the 1959 classic &quot;Sleeping Beauty.&quot; A beautiful, pure-hearted young woman with stunning black wings, Maleficent has an idyllic life growing up in a peaceable forest kingdom, until one day when an invading army of humans threatens the harmony of the land. Maleficent rises to be the land`s fiercest protector, but she ultimately suffers a ruthless betrayal - an act that begins to turn her pure heart to stone. Bent on revenge, Maleficent faces an epic battle with the king of the humans and, as a result, places a curse upon his newborn infant Aurora. As the child grows, Maleficent realizes that Aurora holds the key to peace in the kingdom - and to Maleficent`s true happiness as well.', '', ''),
(13, NULL, 1955, 'Ø³Ø§Ù„Ù… Ø£Ø¨Ùˆ Ø£Ø®ØªÙ‡', 'Ø´Ø§Ø¨ÙŒ ÙÙ‚ÙŠØ±ÙŒ Ø§Ø³Ù…Ù‡ (Ø³Ø§Ù„Ù…) ÙŠØ¹Ù…Ù„ Ø¨Ø§Ø¦Ø¹Ù‹Ø§ Ù…ØªØ¬ÙˆÙ„Ù‹Ø§ØŒ ÙŠØªØ­Ù…Ù„ Ù…Ø³Ø¦ÙˆÙ„ÙŠØ© Ø´Ù‚ÙŠÙ‚ØªÙ‡ Ø¨Ø¹Ø¯ ÙˆÙØ§Ø© ÙˆØ§Ù„Ø¯ÙŠÙ‡Ù…Ø§ØŒ Ù†ØªÙŠØ¬Ø©Ù‹ Ù„Ø°Ù„Ùƒ ÙŠØ·Ù„Ù‚ Ø¹Ù„ÙŠÙ‡ Ø§Ù„Ù…Ù‚Ø±Ø¨ÙˆÙ† Ù„Ù‡ ÙˆØ¬ÙŠØ±Ø§Ù†Ù‡ Ù„Ù‚Ø¨ (Ø³Ø§Ù„Ù… Ø£Ø¨Ùˆ Ø£Ø®ØªÙ‡). Ø¨Ø¹Ø¯ Ø£Ø­Ø¯Ø§Ø« Ø«ÙˆØ±Ø© 25 ÙŠÙ†Ø§ÙŠØ± ØªØªØ­ÙˆÙ„ Ø­ÙŠØ§ØªÙ‡ Ø¥Ù„Ù‰ Ø¬Ø­ÙŠÙ…Ù Ø®Ø§ØµØ©Ù‹ Ø¨Ø¹Ø¯ ÙˆÙ‚ÙˆØ¹Ù‡ ÙÙŠ Ø§Ù„Ø¹Ø¯ÙŠØ¯ Ù…Ù† Ø§Ù„Ù…Ø´Ø§ÙƒÙ„ Ø¨Ø³Ø¨Ø¨ Ø§Ù„Ø¨Ù„Ø·Ø¬ÙŠØ© ÙˆØ¶Ø¨Ø§Ø· Ø§Ù„Ø´Ø±Ø·Ø©ØŒ ÙˆÙŠØ­Ø§ÙˆÙ„ Ø§Ù„ØªØºÙ„Ø¨ Ø¹Ù„ÙŠÙ‡Ø§.', 'Ø³Ø§Ù„Ù… Ø£Ø¨Ùˆ Ø£Ø®ØªÙ‡', 'Ø´Ø§Ø¨ÙŒ ÙÙ‚ÙŠØ±ÙŒ Ø§Ø³Ù…Ù‡ (Ø³Ø§Ù„Ù…) ÙŠØ¹Ù…Ù„ Ø¨Ø§Ø¦Ø¹Ù‹Ø§ Ù…ØªØ¬ÙˆÙ„Ù‹Ø§ØŒ ÙŠØªØ­Ù…Ù„ Ù…Ø³Ø¦ÙˆÙ„ÙŠØ© Ø´Ù‚ÙŠÙ‚ØªÙ‡ Ø¨Ø¹Ø¯ ÙˆÙØ§Ø© ÙˆØ§Ù„Ø¯ÙŠÙ‡Ù…Ø§ØŒ Ù†ØªÙŠØ¬Ø©Ù‹ Ù„Ø°Ù„Ùƒ ÙŠØ·Ù„Ù‚ Ø¹Ù„ÙŠÙ‡ Ø§Ù„Ù…Ù‚Ø±Ø¨ÙˆÙ† Ù„Ù‡ ÙˆØ¬ÙŠØ±Ø§Ù†Ù‡ Ù„Ù‚Ø¨ (Ø³Ø§Ù„Ù… Ø£Ø¨Ùˆ Ø£Ø®ØªÙ‡). Ø¨Ø¹Ø¯ Ø£Ø­Ø¯Ø§Ø« Ø«ÙˆØ±Ø© 25 ÙŠÙ†Ø§ÙŠØ± ØªØªØ­ÙˆÙ„ Ø­ÙŠØ§ØªÙ‡ Ø¥Ù„Ù‰ Ø¬Ø­ÙŠÙ…Ù Ø®Ø§ØµØ©Ù‹ Ø¨Ø¹Ø¯ ÙˆÙ‚ÙˆØ¹Ù‡ ÙÙŠ Ø§Ù„Ø¹Ø¯ÙŠØ¯ Ù…Ù† Ø§Ù„Ù…Ø´Ø§ÙƒÙ„ Ø¨Ø³Ø¨Ø¨ Ø§Ù„Ø¨Ù„Ø·Ø¬ÙŠØ© ÙˆØ¶Ø¨Ø§Ø· Ø§Ù„Ø´Ø±Ø·Ø©ØŒ ÙˆÙŠØ­Ø§ÙˆÙ„ Ø§Ù„ØªØºÙ„Ø¨ Ø¹Ù„ÙŠÙ‡Ø§.', '', ''),
(19, NULL, 2494, '7500', 'Flight 7500 departs Los Angeles International Airport bound for Tokyo. As the overnight flight makes its way over the Pacific Ocean during its ten-hour course, the passengers encounter what appears to be a supernatural force in the cabin.', '7500', 'Flight 7500 departs Los Angeles International Airport bound for Tokyo. As the overnight flight makes its way over the Pacific Ocean during its ten-hour course, the passengers encounter what appears to be a supernatural force in the cabin.', '', '7500'),
(57, NULL, 812, 'Maleficent - 3D', 'Cast: Angelina Jolie, Elle Fanning. The untold story of Disney`s most iconic villain from the 1959 classic &quot;Sleeping Beauty.&quot; A beautiful, pure-hearted young woman with stunning black wings, Maleficent has an idyllic life growing up in a peaceable forest kingdom, until one day when an invading army of humans threatens the harmony of the land. Maleficent rises to be the land`s fiercest protector, but she ultimately suffers a ruthless betrayal - an act that begins to turn her pure heart to stone. Bent on revenge, Maleficent faces an epic battle with the king of the humans and, as a result, places a curse upon his newborn infant Aurora. As the child grows, Maleficent realizes that Aurora holds the key to peace in the kingdom - and to Maleficent`s true happiness as well.', 'Maleficent - 3D', 'Cast: Angelina Jolie, Elle Fanning. The untold story of Disney`s most iconic villain from the 1959 classic &quot;Sleeping Beauty.&quot; A beautiful, pure-hearted young woman with stunning black wings, Maleficent has an idyllic life growing up in a peaceable forest kingdom, until one day when an invading army of humans threatens the harmony of the land. Maleficent rises to be the land`s fiercest protector, but she ultimately suffers a ruthless betrayal - an act that begins to turn her pure heart to stone. Bent on revenge, Maleficent faces an epic battle with the king of the humans and, as a result, places a curse upon his newborn infant Aurora. As the child grows, Maleficent realizes that Aurora holds the key to peace in the kingdom - and to Maleficent`s true happiness as well.', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `roz_taxonmy_category`
--

CREATE TABLE IF NOT EXISTS `roz_taxonmy_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `root` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `table_for_sub_cat` varchar(200) NOT NULL,
  `table_for_sub_cat_box_2` varchar(200) NOT NULL,
  `no_keyword_search` int(11) NOT NULL,
  `showing` int(11) NOT NULL,
  `order_list` int(11) NOT NULL,
  `imageCat` varchar(200) NOT NULL,
  `extraTableImage` varchar(200) NOT NULL,
  `looking_for_other_resources_on_parse` int(11) NOT NULL,
  `is_default` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roz_taxonmy_category`
--

INSERT INTO `roz_taxonmy_category` (`id`, `root`, `title`, `table_for_sub_cat`, `table_for_sub_cat_box_2`, `no_keyword_search`, `showing`, `order_list`, `imageCat`, `extraTableImage`, `looking_for_other_resources_on_parse`, `is_default`) VALUES
(2, 0, 'TV', '', '', 0, 1, 2, '1469910070.png', '', 0, 1),
(3, 0, 'Entertainment', '', '', 0, 1, 1, '', '', 0, 0),
(4, 2, 'action', '', '', 1, 1, 0, '', '', 0, 0),
(5, 3, 'cityMall', '', '', 0, 1, 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roz_users_admin`
--

CREATE TABLE IF NOT EXISTS `roz_users_admin` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_full_name` varchar(200) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `roz_users_admin`
--

INSERT INTO `roz_users_admin` (`userId`, `user_email`, `user_password`, `user_full_name`) VALUES
(1, 'mohdsh85@gmail.com', '123456', 'shareif');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roz_events_2_current`
--
ALTER TABLE `roz_events_2_current`
  ADD CONSTRAINT `roz_events_2_current_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `roz_taxonmy_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `roz_events_2_history`
--
ALTER TABLE `roz_events_2_history`
  ADD CONSTRAINT `roz_events_2_history_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `roz_taxonmy_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `roz_events_3_current`
--
ALTER TABLE `roz_events_3_current`
  ADD CONSTRAINT `roz_events_3_current_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `roz_taxonmy_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `roz_events_3_history`
--
ALTER TABLE `roz_events_3_history`
  ADD CONSTRAINT `roz_events_3_history_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `roz_taxonmy_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
