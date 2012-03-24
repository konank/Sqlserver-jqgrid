-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2012 at 01:25 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jqgrid`
--

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namasiswa` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `kelas` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `namasiswa`, `alamat`, `kelas`, `status`) VALUES
(3, 'putri januarini', 'cibubur', '4KA18', 0),
(5, 'Andrey derma putra', 'bekasi', '4KA18', 0),
(22, 'hh', 'hh', 'hh', 0),
(23, 'Gandi', 'depok', '4ka 18', 1),
(24, 'hehe', 'hehe', 'hehe', 1),
(25, 'sa', 'sd', 'sd', 0),
(26, 'hehe', 'au', '89', 0),
(27, 'asd', 'Bekasi', 'asfs', 1),
(28, 'asd', 'sdgzsdg', 'sdgdsg', 0),
(29, 'asd', '', '', 0);
