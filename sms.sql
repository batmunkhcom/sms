-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2012 at 09:44 PM
-- Server version: 5.1.65
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `azmn_smsaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `receiver` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `operator` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '0',
  `cnt` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `validated`
--

DROP TABLE IF EXISTS `validated`;
CREATE TABLE IF NOT EXISTS `validated` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varbinary(255) NOT NULL,
  `cnt` int(11) unsigned NOT NULL DEFAULT '0',
  `str1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str24` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str25` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `str26` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
