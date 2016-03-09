-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2016 at 07:39 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bphims`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE IF NOT EXISTS `equipments` (
  `equipment_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=217 ;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`equipment_id`, `name`, `code`, `description`, `brand`, `supplier`, `quantity`, `unit`, `location`, `created`, `updated`) VALUES
(214, 'Wheel Chair', 'TF1000', '', 'asus', 'Asus Philippines', 10, 'box', 'Stockroom A', '2016-03-08 07:32:37', '2016-03-09 04:35:04'),
(215, 'Surgery Knife', 'TF1001', '', 'Otap', 'SK Philippines', 250, 'pcs', 'Stockroom B', '2016-03-09 03:37:58', '2016-03-09 03:56:25'),
(216, 'Thermometer', 'TF1002', '', 'Kineck', 'Thermo Philippines', 100, 'pcs', 'Stockroom A', '2016-03-09 03:42:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `fore` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `dosage_unit` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `batch_code` varchar(255) NOT NULL,
  `expiry` date NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `code`, `fore`, `dosage`, `dosage_unit`, `description`, `location`, `supplier`, `unit`, `quantity`, `created`, `updated`, `batch_code`, `expiry`) VALUES
(1, 'Tempra Forte', 'TF1', '', '110', 'ML', 'Syrup, 140 ML', 'Stockroom A', '', 'pcs per bottle', 200, '2016-02-28 08:44:52', '2016-03-09 06:31:12', '2016-00001', '2017-04-03'),
(2, 'Tempra Forte', 'TF2', 'Adult', '155', 'MG', 'Syrup', 'Stockroom C', '', 'box', 300, '2016-02-28 08:44:52', '2016-03-09 06:17:50', '0', '0000-00-00'),
(21, 'Alaxan', '1535', 'Adult', '140', 'MG', '523532', 'Stockroom A', 'erw', 'pcs', 4, '2016-03-08 04:34:52', '2016-03-09 04:15:02', '0', '0000-00-00'),
(22, 'gdfff', '1214', 'Adult', '200', 'ML', '4124', 'Stockroom A', 'fsfs', 'pack', 250, '2016-03-08 04:46:58', '2016-03-08 08:01:54', '0', '0000-00-00'),
(23, 'Police officer', 'PO1', 'Adult', '57', '', 'dd', 'Stockroom A', 'ddd', 'pcs', 55, '2016-03-09 06:28:59', '0000-00-00 00:00:00', '2019-00009999', '2016-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE IF NOT EXISTS `item_category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact1` varchar(255) NOT NULL,
  `contact2` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `code`, `name`, `address`, `contact1`, `contact2`, `created`, `updated`) VALUES
(16, 'TF2016-000001', 'Tempra Philippines', 'Tondo, Manila', '787-13-20', '741-28-94', '2016-03-02 05:59:12', '2016-03-02 06:00:21'),
(17, 'TF2016-000002', 'Unilab Philippines', 'Cabuyao, Laguna', '777-88-99', '123-45-67', '2016-03-09 04:14:27', '2016-03-09 04:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `type`, `first_name`, `last_name`, `last_activity`, `created`, `updated`) VALUES
(1, 'admin', 'qwerty', 1, 'BPHIMS_ADMIN', 'BPHIMS_ADMIN', '0000-00-00 00:00:00', '2016-02-28 06:52:47', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
