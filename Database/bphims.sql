-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2016 at 06:21 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bphims`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `delivery` (
  `delivery_id` int(10) UNSIGNED NOT NULL,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `supplier_id`, `received_by`, `po_number`, `pr_number`, `dr_number`, `si_number`, `amount`, `is_consignment`, `remarks`, `received_date`, `created`, `updated`, `image`, `is_deleted`) VALUES
(1, 1, 12, 'PO867445326-01', 'PR990240582-03', 'DR89583577891', 'SI94577811123', 15600, 0, 'fff', '2016-03-14 16:00:00', '2016-03-15 08:29:04', '2016-03-20 02:53:41', '', 0),
(2, 3, 11, 'PO833445326-01', 'PR778240582-06', 'DR89566233389', 'SI94778578123', 17340.22, 0, '', '2016-03-19 08:05:24', '2016-03-19 08:05:24', '2016-03-19 08:05:24', '', 0),
(3, 3, 11, 'PO833445326-01', 'PR778240582-06', 'DR89566233389', 'SI94778578123', 17340.22, 0, '', '2016-03-20 06:03:49', '2016-03-19 08:13:22', '2016-03-20 06:03:49', '', 1),
(4, 3, 11, 'PO833445326-01', 'PR778240582-06', 'DR89566233389', 'SI94778578123', 33332.72, 0, '', '2016-03-20 06:03:51', '2016-03-19 08:13:22', '2016-03-20 06:03:51', '', 1),
(5, 3, 11, 'PO833445326-01', 'PR778240582-06', 'DR89566233389', 'SI94778578123', 17340.22, 0, '', '2016-03-20 06:04:26', '2016-03-19 08:13:22', '2016-03-20 06:04:26', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_equipment`
--

CREATE TABLE `delivery_equipment` (
  `delivery_equipment_id` int(10) UNSIGNED NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `equipment_code` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `warranty` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `location` varchar(255) NOT NULL,
  `is_given` tinyint(1) NOT NULL DEFAULT '0',
  `is_returned` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_equipment`
--

INSERT INTO `delivery_equipment` (`delivery_equipment_id`, `delivery_id`, `item_id`, `equipment_code`, `brand`, `warranty`, `location`, `is_given`, `is_returned`, `is_deleted`) VALUES
(1, 2, 21, 'E', 'asd', '2016-03-23 16:00:00', 'sdsd', 1, 0, 0),
(2, 2, 21, 'EC9', 'Tokyo', '2016-04-29 16:00:00', 'FFFSD', 0, 0, 1),
(3, 2, 24, 'XXXe', 'YYYe', '2016-03-25 16:00:00', 'EEEEe', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_supply`
--

CREATE TABLE `delivery_supply` (
  `delivery_supply_id` int(10) UNSIGNED NOT NULL,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_supply`
--

INSERT INTO `delivery_supply` (`delivery_supply_id`, `delivery_id`, `item_id`, `batch_code`, `dispense`, `quantity`, `unit_id`, `dosage`, `dosage_unit_id`, `age`, `brand`, `is_restricted`, `expiry`, `location`, `is_deleted`) VALUES
(1, 1, 1, 'BC000001', 100, 100, 20, 500, 14, '4+', 'Mercury', 0, '2016-06-22 16:00:00', 'Storage A', 0),
(2, 1, 2, 'BC000001', 0, 199, 20, 200, 14, '8+', 'Mercury', 0, '2016-06-22 16:00:00', 'Storage A', 0),
(3, 1, 2, 'BC000001', 0, 200, 20, 310, 2, '4+', 'ADC', 0, '2016-06-22 16:00:00', 'S-A', 0),
(4, 1, 16, '77', 0, 66, 20, 400, 19, '7+', 'Johnson', 1, '2016-06-22 16:00:00', 'SB0', 0),
(5, 1, 12, '97776', 0, 800, 20, 7, 15, '6', '5', 0, '2016-06-22 16:00:00', '4', 1),
(6, 1, 15, '11', 0, 22, 4, 33, 3, '44', '55', 0, '2016-06-22 16:00:00', '66', 1),
(7, 1, 4, 'BC000001', 0, 55, 16, 100, 15, '7+', 'GGH', 0, '2016-06-22 16:00:00', 'SSB', 0),
(8, 1, 19, '110', 0, 720, 8, 320, 7, '11+', '550', 0, '2016-06-22 16:00:00', '34', 0),
(9, 1, 19, '110', 0, 220, 8, 330, 7, '6+', '550', 0, '2016-06-22 16:00:00', '660', 0),
(10, 1, 19, '110', 0, 220, 8, 330, 7, '3+', '550', 0, '2016-06-22 16:00:00', '660', 1),
(11, 1, 19, '110', 0, 220, 8, 330, 7, '10+', '550', 1, '2016-06-22 16:00:00', '660', 1),
(12, 1, 12, '9', 0, 800, 8, 7, 15, '6', '5', 0, '2016-06-22 16:00:00', '4', 1),
(13, 1, 2, '1', 800, 800, 1, 3, 2, '4', '5', 0, '2016-06-22 16:00:00', '7', 1),
(14, 1, 2, '1', 0, 2000, 1, 3, 2, '4', '5', 0, '2016-06-22 16:00:00', '7', 1),
(15, 1, 2, '1', 0, 80, 1, 3, 2, '4', '5', 0, '2016-06-22 16:00:00', '7', 1),
(16, 2, 1, 'BC000002', 155, 155, 21, 57, 13, '13+', 'GGD', 0, '2016-06-22 16:00:00', 'FF', 0),
(17, 2, 2, 'BC000002', 550, 550, 22, 55, 7, '3+', 'Akola', 0, '2016-06-22 16:00:00', 'DF', 0),
(18, 2, 3, 'BC000002', 0, 57, 21, 88, 14, '>3', 'KKL', 0, '2016-06-22 16:00:00', 'GG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `description`) VALUES
(1, 'Radiology', ''),
(2, 'Blood Test', ''),
(3, 'Supplies & Equipment', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(10) UNSIGNED NOT NULL,
  `position_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `employee_department` (
  `employee_department_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(20, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `critical_level` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `category_id`, `name`, `code`, `description`, `critical_level`, `created`, `updated`, `is_deleted`) VALUES
(1, 1, 'Aboraclimyl', 'I00001', '', 20, '2016-03-15 07:43:51', '2016-03-15 08:35:13', 0),
(2, 1, 'Acetanilide', 'I00002', '', 20, '2016-03-15 07:49:50', '2016-03-20 07:03:48', 0),
(3, 1, 'Acetazolamide', 'I00003', '', 25, '2016-03-15 07:49:50', '2016-03-15 08:33:56', 0),
(4, 1, 'Acetohexamide', 'I00004', '', 10, '2016-03-15 07:49:50', '2016-03-15 08:33:58', 0),
(5, 1, 'Acetylcarbromal', 'I00005', '', 15, '2016-03-15 07:49:50', '2016-03-20 07:03:51', 0),
(6, 1, 'Brometone', 'I00006', '', 10, '2016-03-15 07:49:50', '2016-03-15 08:34:03', 0),
(7, 1, 'Bromisoval', 'I00007', '', 10, '2016-03-15 07:49:50', '2016-03-15 08:34:05', 0),
(8, 1, 'Canagliflozin', 'I00008', '', 15, '2016-03-15 07:49:50', '2016-03-15 08:34:07', 0),
(9, 1, 'Canakinumab', 'I00009', '', 10, '2016-03-15 07:49:50', '2016-03-15 08:34:10', 0),
(10, 1, 'Carbamazepine', 'I00010', '', 10, '2016-03-15 07:49:50', '2016-03-15 08:34:13', 0),
(11, 1, 'Cyclophosphamide', 'I00011', '', 10, '2016-03-15 07:49:50', '2016-03-15 08:34:16', 0),
(12, 1, 'Cycloserine', 'I00012', '', 15, '2016-03-15 07:49:50', '2016-03-15 08:34:18', 0),
(13, 1, 'Diethylcarbamazine', 'I00013', '', 20, '2016-03-15 07:49:50', '2016-03-15 08:34:21', 0),
(14, 1, 'Dimercaprol', 'I00014', '', 20, '2016-03-15 07:49:50', '2016-03-15 08:34:24', 0),
(15, 1, 'Dimethylfumarate', 'I00015', '', 20, '2016-03-15 07:49:50', '2016-03-15 08:34:26', 0),
(16, 1, 'Embutramide', 'I00016', '', 20, '2016-03-15 07:49:50', '2016-03-15 08:34:29', 0),
(17, 1, 'Emtricitabine', 'I00017', '', 20, '2016-03-15 07:49:50', '2016-03-15 08:34:31', 0),
(18, 1, 'Evolocumab', 'I00018', '', 25, '2016-03-15 07:49:50', '2016-03-15 08:34:34', 0),
(19, 1, 'Exemestane', 'I00019', '', 25, '2016-03-15 07:49:50', '2016-03-15 08:34:36', 0),
(20, 1, 'Ezetimibe', 'I00020', '', 25, '2016-03-15 07:49:50', '2016-03-15 08:34:39', 0),
(21, 2, 'Wheel Chair', 'I00021', 'ff', 2, '2016-03-15 08:35:55', '2016-03-21 10:04:22', 0),
(22, 1, 'asdasda', '232', '3434', 232342, '2016-03-20 07:24:09', '2016-03-20 07:42:13', 1),
(23, 2, 'Flashlight', 'I000042', 'Flashlight is a song', 5, '2016-03-20 07:24:41', '2016-03-20 07:54:04', 1),
(24, 2, 'Scalpel', 'I00045', 'Something', 50, '2016-03-20 07:30:33', '2016-03-20 07:40:28', 0),
(25, 2, 'sdf', 'w345345', '5353535', 345353, '2016-03-20 07:54:34', '2016-03-20 07:54:41', 1),
(26, 2, 'yhyyhy', '8777', '5568', 8, '2016-03-20 07:55:05', '2016-03-20 07:55:10', 1),
(27, 1, 'fhhghghg', '56', '3434', 32234, '2016-03-20 07:55:29', '2016-03-20 07:55:33', 1),
(28, 2, 'FFd', 'FF', '333', 22, '2016-03-21 10:04:39', '2016-03-21 10:04:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `position` (
  `position_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `returned_equipment` (
  `returned_equipment_id` int(10) UNSIGNED NOT NULL,
  `delivery_equipment_id` int(11) NOT NULL,
  `returned_by` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `returned_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `transaction` (
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_head_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `requested_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `type`, `requested_by`, `department_id`, `department_head_id`, `doctor_id`, `patient_id`, `requested_date`, `remarks`, `image`) VALUES
(1, 1, 2, 1, 1, 0, 0, '2016-03-22 06:54:02', '', ''),
(2, 1, 1, 1, 13, 0, 0, '2016-04-06 08:29:40', 'asad', ''),
(3, 1, 1, 1, 16, 0, 0, '2016-04-06 09:03:31', 'Hey', ''),
(4, 1, 3, 1, 6, 0, 0, '2016-04-06 09:06:03', 'fff', ''),
(5, 1, 6, 1, 13, 0, 0, '2016-04-06 09:07:16', 'aa', ''),
(6, 1, 5, 1, 16, 0, 0, '2016-04-06 09:09:45', 'ddd', ''),
(7, 1, 4, 1, 13, 0, 0, '2016-04-06 09:11:21', 'ddd', ''),
(8, 1, 1, 1, 6, 0, 0, '2016-04-06 09:11:48', 'ggg', ''),
(9, 1, 5, 2, 14, 0, 0, '2016-04-06 09:16:16', 'a', ''),
(10, 1, 1, 1, 13, 0, 0, '2016-04-06 09:57:00', '', ''),
(11, 2, 3, 0, 0, 8, 1, '2016-04-06 10:39:41', 'dsd', ''),
(12, 2, 5, 0, 0, 9, 1, '2016-04-06 10:41:10', 'ddddsd', ''),
(13, 1, 8, 1, 6, 0, 0, '2016-04-06 10:43:14', 'sf', ''),
(14, 1, 3, 2, 7, 0, 0, '2016-04-06 10:44:17', 'asd', ''),
(15, 1, 4, 1, 6, 0, 0, '2016-04-06 16:06:44', 'a', ''),
(16, 1, 1, 1, 6, 0, 0, '2016-04-06 16:16:51', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_item`
--

CREATE TABLE `transaction_item` (
  `transaction_item_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `delivery_item_type` int(11) NOT NULL,
  `delivery_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_item`
--

INSERT INTO `transaction_item` (`transaction_item_id`, `transaction_id`, `delivery_item_type`, `delivery_item_id`, `quantity`) VALUES
(1, 1, 1, 1, 2),
(2, 1, 1, 2, 4),
(3, 1, 2, 1, 1),
(4, 2, 1, 14, 10),
(5, 2, 2, 3, 1),
(6, 3, 1, 16, 100),
(7, 3, 2, 1, 1),
(8, 4, 1, 16, 10),
(9, 4, 2, 3, 1),
(10, 4, 2, 1, 1),
(11, 5, 1, 16, 1),
(12, 6, 1, 16, 2),
(13, 7, 1, 16, 10),
(14, 8, 1, 16, 31),
(15, 8, 2, 3, 1),
(16, 9, 1, 16, 1),
(17, 9, 2, 3, 1),
(18, 9, 2, 1, 1),
(19, 11, 1, 1, 90),
(20, 12, 1, 1, 2),
(21, 13, 1, 1, 2),
(22, 13, 1, 17, 460),
(23, 14, 1, 17, 50),
(24, 15, 1, 13, 800),
(25, 16, 1, 17, 40);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(10) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `username`, `password`, `first_name`, `last_name`, `last_activity`, `created`, `updated`) VALUES
(1, 1, 'admin', 'qwerty', 'BPHIMS', 'Administrator', '0000-00-00 00:00:00', '2016-03-15 06:26:54', '2016-03-15 06:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `name`, `description`) VALUES
(1, 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `delivery_equipment`
--
ALTER TABLE `delivery_equipment`
  ADD PRIMARY KEY (`delivery_equipment_id`);

--
-- Indexes for table `delivery_supply`
--
ALTER TABLE `delivery_supply`
  ADD PRIMARY KEY (`delivery_supply_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`employee_department_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `returned_equipment`
--
ALTER TABLE `returned_equipment`
  ADD PRIMARY KEY (`returned_equipment_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD PRIMARY KEY (`transaction_item_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `delivery_equipment`
--
ALTER TABLE `delivery_equipment`
  MODIFY `delivery_equipment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `delivery_supply`
--
ALTER TABLE `delivery_supply`
  MODIFY `delivery_supply_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `employee_department_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `returned_equipment`
--
ALTER TABLE `returned_equipment`
  MODIFY `returned_equipment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `transaction_item`
--
ALTER TABLE `transaction_item`
  MODIFY `transaction_item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
