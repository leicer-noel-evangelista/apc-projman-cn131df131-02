-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2016 at 04:18 AM
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
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`) VALUES
(1, 'Supply', ''),
(2, 'Equipment', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `delivery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `received_by` int(11) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `pr_number` varchar(255) NOT NULL,
  `dr_number` varchar(255) NOT NULL,
  `si_number` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `is_consignment` tinyint(1) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `received_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `supplier_id`, `received_by`, `po_number`, `pr_number`, `dr_number`, `si_number`, `amount`, `is_consignment`, `remarks`, `received_date`, `created`, `updated`, `image`, `is_deleted`) VALUES
(7, 3, 12, 'PO-0000-0001', 'PR-0000-0001', 'DR-0000-0001', 'SI-0000-0001', 20000, 0, '', '2016-04-01 08:00:00', '2016-04-11 02:58:32', '2016-04-11 05:12:09', '', 0),
(8, 1, 11, 'PO-0000-0002', 'PR-0000-0002', 'DR-0000-0002', 'SI-0000-0002', 30000, 0, '', '2016-04-02 08:00:00', '2016-04-11 07:31:05', '2016-04-11 07:31:05', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_equipment`
--

CREATE TABLE IF NOT EXISTS `delivery_equipment` (
  `delivery_equipment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `equipment_code` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `warranty` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `location` varchar(255) NOT NULL,
  `is_given` tinyint(1) NOT NULL DEFAULT '0',
  `is_returned` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`delivery_equipment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `delivery_equipment`
--

INSERT INTO `delivery_equipment` (`delivery_equipment_id`, `delivery_id`, `item_id`, `equipment_code`, `brand`, `warranty`, `location`, `is_given`, `is_returned`, `is_deleted`) VALUES
(9, 7, 35, 'EC00001', 'Nike', '2017-04-01 08:00:00', 'Basement Storage', 0, 0, 0),
(10, 7, 35, 'EC00002', 'Bed Inc.', '2017-08-01 08:00:00', 'Storage A', 0, 0, 0),
(11, 7, 35, 'EC00003', 'Nike', '2017-04-01 08:00:00', 'Storage A', 1, 0, 0),
(12, 7, 35, 'EC00004', 'Adidas', '2017-04-01 08:00:00', 'Storage A', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_supply`
--

CREATE TABLE IF NOT EXISTS `delivery_supply` (
  `delivery_supply_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `batch_code` varchar(255) NOT NULL,
  `dispense` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `dosage` int(11) NOT NULL,
  `dosage_unit_id` int(11) NOT NULL,
  `age` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `is_restricted` tinyint(1) NOT NULL DEFAULT '0',
  `expiry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`delivery_supply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `delivery_supply`
--

INSERT INTO `delivery_supply` (`delivery_supply_id`, `delivery_id`, `item_id`, `batch_code`, `dispense`, `quantity`, `unit_id`, `dosage`, `dosage_unit_id`, `age`, `brand`, `is_restricted`, `expiry`, `location`, `is_deleted`) VALUES
(23, 7, 31, 'AFRC-1-1-2017-200', 5, 100, 21, 200, 13, 'Adult', 'Alaxan', 0, '2017-01-01 08:00:00', 'Storage A', 0),
(24, 7, 31, 'AFRC-1-1-2017-325', 5, 100, 21, 325, 13, 'Adult', 'Alaxan', 0, '2017-01-01 08:00:00', 'Storage B', 0),
(25, 8, 37, 'TFSOF-6-6-2018', 0, 500, 20, 5, 14, 'Kids 6-12', 'Tempra', 0, '2018-06-06 08:00:00', 'Stockroom 1', 0),
(26, 8, 38, 'TFSSF-6-6-2018', 0, 1000, 20, 5, 14, 'Kids 3+', 'Tempra', 0, '2018-06-06 08:00:00', 'Storage E', 0),
(27, 8, 40, 'TFT-12-26-2017', 1, 30, 21, 500, 13, 'Adult', 'Tempra', 1, '2017-12-26 08:00:00', 'Storage B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `description`) VALUES
(1, 'Radiology', ''),
(2, 'Blood Test', ''),
(3, 'Supplies & Equipment', ''),
(4, 'Breast Center', ''),
(5, 'Cancer Center', ''),
(6, 'Cardiovascular Center', ''),
(7, 'Emergency Department', ''),
(8, 'Eye Center', ''),
(9, 'Intensive Care Unit', ''),
(10, 'Orthopedic Center', ''),
(11, 'Pediatrics', ''),
(12, 'Psychiatry', ''),
(13, 'Pulmonary Center', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `position_id`, `first_name`, `last_name`) VALUES
(1, 1, 'Angelica', 'Mendoza'),
(2, 1, 'Jennifer', 'Lopez'),
(3, 1, 'Madeline', 'Reyes'),
(4, 1, 'Jane', 'Ramirez'),
(5, 1, 'Lorna', 'Tolentino'),
(6, 2, 'Jobert', 'Lansang'),
(7, 2, 'Mark', 'Torrez'),
(8, 3, 'Albert', 'Valdez'),
(9, 3, 'Leo', 'Martinez'),
(10, 3, 'Ana', 'Hernandez'),
(11, 4, 'Dominic', 'Sanchez'),
(12, 4, 'Sheryl', 'Anchorez'),
(13, 2, 'Gary', 'James'),
(14, 2, 'Lourdes Anne', 'Joy'),
(15, 2, 'Lito', 'Palid'),
(16, 2, 'Johnny Alex', 'Boy');

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE IF NOT EXISTS `employee_department` (
  `employee_department_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`employee_department_id`, `employee_id`, `department_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 8, 1),
(8, 9, 1),
(9, 1, 2),
(10, 3, 2),
(11, 4, 2),
(12, 7, 2),
(13, 9, 2),
(14, 10, 2),
(15, 11, 3),
(16, 12, 3),
(17, 13, 1),
(18, 14, 2),
(19, 15, 2),
(20, 16, 10);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `critical_level` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `category_id`, `name`, `code`, `description`, `critical_level`, `created`, `updated`, `is_deleted`) VALUES
(31, 1, 'Alaxan FR Capsule', 'S00001', '', 100, '2016-04-11 03:22:45', '2016-04-11 06:47:43', 0),
(32, 1, 'Alaxan Tablet', 'S00002', '', 100, '2016-04-11 03:23:25', '2016-04-11 06:47:53', 0),
(33, 1, 'Biogesic Tablet', 'S00003', '', 200, '2016-04-11 03:24:47', '2016-04-11 06:48:01', 0),
(34, 1, 'Biogesic Tablet 8B', 'S00004', '', 50, '2016-04-11 03:25:52', '2016-04-11 06:48:10', 0),
(35, 2, 'Wheel Chair', 'E00001', '', 30, '2016-04-11 06:48:35', '2016-04-11 06:50:05', 0),
(36, 2, 'Bed', 'E00002', '', 10, '2016-04-11 06:48:54', '2016-04-11 16:55:35', 0),
(37, 1, 'Tempra Forte Syrup Orange Flavor 120ml', 'S00005', '', 30, '2016-04-11 07:28:09', '2016-04-11 17:06:57', 0),
(38, 1, 'Tempra Forte Syrup Strawberry Flavor 60ml', 'S00006', '', 30, '2016-04-11 07:29:31', '2016-04-11 17:07:05', 0),
(39, 1, 'Tempra Forte Syrup Strawberry Flavor', 'S00006', '', 3, '2016-04-11 07:30:01', '2016-04-11 07:30:09', 1),
(40, 1, 'Tempra Forte Tablet', 'S00007', '', 50, '2016-04-11 16:26:07', '2016-04-11 16:26:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `first_name`, `last_name`) VALUES
(1, 'Justine', 'LLamas'),
(2, 'Marvin', 'Agustin'),
(3, 'Xavier', 'Diaz'),
(4, 'John', 'Estrada'),
(5, 'Larry', 'Campus'),
(6, 'Orlando', 'Macalintal');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `position_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `title`, `description`) VALUES
(1, 'Nurse', ''),
(2, 'Department Head', ''),
(3, 'Doctor', ''),
(4, 'Staff', '');

-- --------------------------------------------------------

--
-- Table structure for table `returned_equipment`
--

CREATE TABLE IF NOT EXISTS `returned_equipment` (
  `returned_equipment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_equipment_id` int(11) NOT NULL,
  `returned_by` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `returned_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`returned_equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `address`) VALUES
(1, 'Mercury', ''),
(2, 'South Star', ''),
(3, 'Generica', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_head_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `requested_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `type`, `requested_by`, `department_id`, `department_head_id`, `doctor_id`, `patient_id`, `requested_date`, `remarks`, `image`, `is_deleted`) VALUES
(31, 1, 1, 10, 16, 0, 0, '2016-04-11 06:55:24', '', '', 0),
(33, 1, 6, 1, 6, 0, 0, '2016-04-11 07:09:15', '', '', 0),
(36, 2, 3, 0, 0, 9, 1, '2016-04-11 16:50:52', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_item`
--

CREATE TABLE IF NOT EXISTS `transaction_item` (
  `transaction_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `delivery_item_type` int(11) NOT NULL,
  `delivery_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`transaction_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `transaction_item`
--

INSERT INTO `transaction_item` (`transaction_item_id`, `transaction_id`, `delivery_item_type`, `delivery_item_id`, `quantity`) VALUES
(47, 31, 1, 23, 5),
(48, 31, 1, 24, 5),
(49, 33, 2, 11, 1),
(53, 36, 1, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `unit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit`, `name`, `type`, `description`) VALUES
(1, 'Ci', 'CURIE', 2, ''),
(2, 'dL', 'DECILITER', 2, ''),
(3, 'g', 'GRAM', 2, ''),
(4, 'kg', 'KILOGRAM', 2, ''),
(5, 'L', 'LITER', 2, ''),
(6, 'uCi', 'MICROCURIE', 2, ''),
(7, 'ug', 'MICROGRAM', 2, ''),
(8, 'uL', 'MICROLITER', 2, ''),
(9, 'umol', 'MICROMOLE', 2, ''),
(10, 'um', 'MICRON', 2, ''),
(11, 'mCi', 'MILLICURIE', 2, ''),
(12, 'meq', 'MILLIEQUIVALENT', 2, ''),
(13, 'mg', 'MILLIGRAM', 2, ''),
(14, 'mL', 'MILLILITER', 2, ''),
(15, 'mm', 'MILLIMETER', 2, ''),
(16, 'mmol', 'MILLIMOLE', 2, ''),
(17, 'ML', 'MOLE', 2, ''),
(18, 'ng', 'NANOGRAM', 2, ''),
(19, 'nmol', 'NANOMOLE', 2, ''),
(20, 'pcs', 'PIECES', 1, ''),
(21, 'box', 'BOX', 1, ''),
(22, 'pack', 'PACK', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `username`, `password`, `first_name`, `last_name`, `last_activity`, `created`, `updated`) VALUES
(1, 1, 'admin', 'qwerty', 'BPHIMS', 'Administrator', '0000-00-00 00:00:00', '2016-03-15 06:26:54', '2016-03-15 06:26:54'),
(2, 1, 'user1', 'qwerty', 'Lacer', 'Evangelista', '0000-00-00 00:00:00', '2016-04-10 05:31:51', '2016-04-10 05:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `user_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `name`, `description`) VALUES
(1, 'admin', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
