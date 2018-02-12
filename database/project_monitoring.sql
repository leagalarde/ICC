-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2018 at 10:19 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_rep_tbl`
--

CREATE TABLE `client_rep_tbl` (
  `cr_id` int(11) NOT NULL,
  `cr_first_name` varchar(50) DEFAULT ' ',
  `cr_last_name` varchar(50) DEFAULT ' ',
  `cr_email` varchar(50) DEFAULT ' ',
  `cr_contact` varchar(20) DEFAULT '0',
  `cr_address` varchar(100) NOT NULL DEFAULT ' ',
  `cr_position` varchar(50) DEFAULT ' ',
  `cl_no` int(11) DEFAULT '0',
  `cr_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_rep_tbl`
--

INSERT INTO `client_rep_tbl` (`cr_id`, `cr_first_name`, `cr_last_name`, `cr_email`, `cr_contact`, `cr_address`, `cr_position`, `cl_no`, `cr_delete`) VALUES
(1, 'sample name', ' ', 'sample@email.com', '1234567', ' ', 'sample position', 1, 1),
(2, 'sample name', ' ', 'sample@email.com', '1230249123', ' ', 'sample position', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_tbl`
--

CREATE TABLE `client_tbl` (
  `cl_no` int(11) NOT NULL,
  `cl_company` varchar(200) DEFAULT ' ',
  `cl_email` varchar(50) DEFAULT ' ',
  `cl_contact` varchar(20) DEFAULT '0',
  `cl_address` varchar(200) DEFAULT ' ',
  `cl_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_tbl`
--

INSERT INTO `client_tbl` (`cl_no`, `cl_company`, `cl_email`, `cl_contact`, `cl_address`, `cl_delete`) VALUES
(1, 'sample Company', 'sample@email.com', '1234567', 'sample Address', 1),
(2, 'sample Company', 'sample@email.com', '091234541221', 'sample Address', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contract_bill_tbl`
--

CREATE TABLE `contract_bill_tbl` (
  `cb_id` int(11) NOT NULL,
  `cb_total` double DEFAULT '0',
  `cb_paid` double DEFAULT '0',
  `cb_balance` double DEFAULT '0',
  `cb_budget` double NOT NULL DEFAULT '0',
  `cb_expense` double NOT NULL DEFAULT '0',
  `cb_budget_left` double NOT NULL DEFAULT '0',
  `cb_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_bill_tbl`
--

INSERT INTO `contract_bill_tbl` (`cb_id`, `cb_total`, `cb_paid`, `cb_balance`, `cb_budget`, `cb_expense`, `cb_budget_left`, `cb_delete`) VALUES
(1, 77642217.033, 11646332.555, 65995884.478, 77642217.033, 59864990.74, 17777226.293000005, 0),
(2, 3249663569.19, 1689825055.98, 1559838513.21, 3249663569.19, 2326128.57, 3247337440.62, 0),
(3, 46454.32, 6968.148, 39486.172, 46454.32, 0, 46454.32, 1),
(4, 13510764.39, 2026614.659, 11484149.731, 13510764.39, 0, 13510764.39, 0),
(5, 1353737.37, 203060.606, 1150676.764, 1353737.37, 50000, 1303737.37, 1),
(6, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(7, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(8, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(9, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(10, 195212.83, 29281.92, 165930.91, 195212.83, 0, 195212.83, 0),
(11, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(12, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(13, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(14, 1836631.32, 275494.7, 1561136.62, 1836631.32, 0, 1836631.32, 0),
(15, 1836631.32, 275494.7, 1561136.62, 1836631.32, 0, 1836631.32, 0),
(16, 1836631.32, 275494.7, 1561136.62, 1836631.32, 0, 1836631.32, 0),
(17, 1836631.32, 275494.7, 1561136.62, 1836631.32, 0, 1836631.32, 0),
(18, 1836631.32, 275494.7, 1561136.62, 1836631.32, 0, 1836631.32, 0),
(19, 1836631.32, 275494.7, 1561136.62, 1836631.32, 0, 1836631.32, 0),
(20, 188836.61, 28325.491, 160511.119, 188836.61, 0, 188836.61, 1),
(21, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(22, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(23, 0, 0, 0, 0, 0, 0, 0),
(24, 0, 0, 0, 0, 0, 0, 0),
(25, 0, 0, 0, 0, 0, 0, 0),
(26, 0, 0, 0, 0, 0, 0, 0),
(27, 0, 0, 0, 0, 0, 0, 0),
(28, 0, 0, 0, 0, 0, 0, 0),
(29, 0, 0, 0, 0, 0, 0, 0),
(30, 0, 0, 0, 0, 0, 0, 0),
(31, 0, 0, 0, 0, 0, 0, 0),
(32, 0, 0, 0, 0, 0, 0, 0),
(33, 0, 0, 0, 0, 0, 0, 0),
(34, 0, 0, 0, 0, 0, 0, 0),
(35, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(36, 188836.61, 28325.49, 160511.12, 188836.61, 0, 188836.61, 0),
(37, 4343242.03, 651486.3, 3691755.73, 4343242.03, 0, 4343242.03, 0),
(38, 377673.22, 56650.98, 321022.24, 377673.22, 0, 377673.22, 1),
(39, 377673.22, 56650.98, 321022.24, 377673.22, 0, 377673.22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contract_info_tbl`
--

CREATE TABLE `contract_info_tbl` (
  `ci_no` int(11) NOT NULL,
  `ci_name` varchar(200) DEFAULT ' ',
  `ci_date` date DEFAULT '1111-11-11',
  `ci_signedby` varchar(30) DEFAULT ' ',
  `cl_no` int(11) NOT NULL DEFAULT '0',
  `ci_desc` varchar(20) DEFAULT ' ',
  `ci_payment_mode` varchar(20) NOT NULL DEFAULT ' ',
  `cb_id` int(11) DEFAULT '0',
  `ci_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_info_tbl`
--

INSERT INTO `contract_info_tbl` (`ci_no`, `ci_name`, `ci_date`, `ci_signedby`, `cl_no`, `ci_desc`, `ci_payment_mode`, `cb_id`, `ci_delete`) VALUES
(1, 'Road Upgrading  based on Gravel Road Strategies', '2017-05-17', 'Liam', 1, 'Horizontal', ' ', 1, 0),
(2, 'Baywalk', '2017-10-19', 'Kaleb McGregor', 2, 'Horizontal', ' ', 2, 0),
(3, 'dpwh road excavating ', '2017-11-28', 'marc', 3, 'Horizontal', ' ', 3, 1),
(4, 'Road Pavement', '2017-12-06', 'Jocel Ticar', 4, 'Horizontal', ' ', 4, 0),
(5, 'construction of road baykal', '2018-01-13', 'marc bsuante', 5, 'Horizontal', ' ', 5, 1),
(6, ' ', '2018-01-31', ' ', 6, 'Horizontal', ' ', 6, 0),
(7, ' ', '2018-01-31', ' ', 7, 'Horizontal', ' ', 7, 0),
(8, ' ', '2018-01-31', ' ', 8, 'Horizontal', ' ', 8, 0),
(9, ' ', '2018-01-31', ' ', 9, 'Horizontal', ' ', 9, 0),
(10, ' ', '2018-01-31', ' ', 10, 'Horizontal', ' ', 10, 0),
(11, ' ', '2018-01-31', ' ', 11, 'Horizontal', ' ', 11, 0),
(12, ' ', '2018-01-31', ' ', 12, 'Horizontal', ' ', 12, 0),
(13, ' ', '2018-01-31', ' ', 13, 'Horizontal', ' ', 13, 0),
(14, ' ', '2018-02-13', ' ', 14, 'Vertical', ' ', 14, 0),
(15, ' ', '2018-02-13', ' ', 15, 'Vertical', ' ', 15, 0),
(16, ' ', '2018-02-13', ' ', 16, 'Vertical', ' ', 16, 0),
(17, ' ', '2018-02-13', ' ', 17, 'Vertical', ' ', 17, 0),
(18, ' ', '2018-02-13', ' ', 18, 'Vertical', ' ', 18, 0),
(19, ' ', '2018-02-13', ' ', 19, 'Vertical', ' ', 19, 0),
(20, 'asdf', '2018-01-31', 'asdf', 20, 'Horizontal', ' ', 20, 1),
(21, ' ', '2018-02-05', ' ', 4, 'Horizontal', ' ', 21, 0),
(22, ' ', '2018-02-05', ' ', 4, 'Horizontal', ' ', 22, 0),
(23, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 23, 0),
(24, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 24, 0),
(25, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 25, 0),
(26, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 26, 0),
(27, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 27, 0),
(28, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 28, 0),
(29, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 29, 0),
(30, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 30, 0),
(31, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 31, 0),
(32, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 32, 0),
(33, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 33, 0),
(34, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 34, 0),
(35, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 35, 0),
(36, ' ', '2018-02-07', ' ', 4, 'Horizontal', ' ', 36, 0),
(37, ' ', '2018-02-08', ' ', 1, 'Horizontal', ' ', 37, 0),
(38, ' ', '2018-02-09', ' ', 1, 'Horizontal', ' ', 38, 0),
(39, ' ', '2018-02-09', ' ', 2, 'Horizontal', ' ', 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `emp_id` int(11) NOT NULL,
  `emp_first_name` varchar(50) DEFAULT NULL,
  `emp_middle_initial` varchar(50) DEFAULT NULL,
  `emp_last_name` varchar(50) DEFAULT NULL,
  `emp_address` varchar(500) DEFAULT NULL,
  `emp_email` varchar(200) DEFAULT NULL,
  `emp_contact` bigint(20) DEFAULT NULL,
  `emp_proxy` int(11) DEFAULT NULL,
  `emp_status` int(11) NOT NULL DEFAULT '0',
  `emp_image` varchar(50) NOT NULL DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`emp_id`, `emp_first_name`, `emp_middle_initial`, `emp_last_name`, `emp_address`, `emp_email`, `emp_contact`, `emp_proxy`, `emp_status`, `emp_image`) VALUES
(8, 'Julia Marie', 'F', 'Ticar', 'Quezon City', 'julmarie@gmail.com', 9182755, NULL, 0, 'eng3.jpg'),
(11, 'Hannah Joy', 'A', 'Odo', 'Pureza Station', 'hahhaahjoy@gmail.com', 9161976759, NULL, 0, '15595510_1285011494855183_1031426035_o.jpg'),
(14, 'Marc Christian', 'Gleyo', 'Busante', 'SJDM, Bulacan', 'mcbusante@gmail.com', 928123, NULL, 0, 'eng4.jpg'),
(15, 'Lea', 'G', 'Alarde', 'IDK', 'lea@gmail.com', 923412, NULL, 0, 'eng1.jpg'),
(16, 'Kenji', 'R', 'San Juan', 'San Juan', 'kenji@gmail.com', 912231, NULL, 0, 'user1.jpg'),
(18, 'Edita', 'Palacpac', 'Paet', 'Barangay Lucap, Alaminos City, Pangasinan', 'engrpaet@gmail.com', 199933673, NULL, 0, 'eng3.jpg'),
(21, 'Pedro Gabriel', 'B', 'Langit', 'pasay', 'pedrogab@gmail.com', 9981725213, NULL, 0, 'eng2.jpg'),
(22, 'James', 'G', 'Pagal', 'Bulacan', 'JpG@gmail.com', 9502732876, NULL, 0, 'picture.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--

CREATE TABLE `equipment_category` (
  `ec_id` int(11) NOT NULL,
  `ec_category` varchar(25) DEFAULT NULL,
  `ec_quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_category`
--

INSERT INTO `equipment_category` (`ec_id`, `ec_category`, `ec_quantity`) VALUES
(1, 'Air Compressor', 5),
(2, 'Applicator Machine', 5),
(3, 'Backhoe', 3),
(4, 'Backhoe w/ Breaker', 3),
(5, 'Bar Bender', 3),
(6, 'Bar Cutter', 0),
(7, 'Boomtruck', 0),
(8, 'Bulldozer', 0),
(9, 'Bulldozer w/ Ripper', 0),
(10, 'Cargo Truck', 0),
(11, 'Chainsaw', 0),
(12, 'Concrete Batching Plant', 0),
(13, 'Concrete Cutter', 0),
(14, 'Dump Truck', 0),
(15, 'Kneading Machine', 0),
(16, 'Lowbed Trailer', 0),
(17, 'One Bagger Mixer', 0),
(18, 'Payloader', 0),
(19, 'Transit Mixer', 0),
(20, 'Water Truck', 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_deployed_tbl`
--

CREATE TABLE `equipment_deployed_tbl` (
  `ed_id` int(11) NOT NULL,
  `ed_date` date DEFAULT NULL,
  `ei_id` int(11) DEFAULT NULL,
  `proj_no` int(11) DEFAULT NULL,
  `ed_start_date` date NOT NULL DEFAULT '1111-11-11',
  `ed_total_days` int(11) NOT NULL DEFAULT '0',
  `ed_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_deployed_tbl`
--

INSERT INTO `equipment_deployed_tbl` (`ed_id`, `ed_date`, `ei_id`, `proj_no`, `ed_start_date`, `ed_total_days`, `ed_delete`) VALUES
(1, '2017-05-25', 1, 1, '2017-07-10', 14, 0),
(2, '2017-05-25', 2, 1, '2017-05-30', 5, 0),
(3, '2017-05-25', 3, 1, '2017-11-16', 21, 0),
(4, '2017-05-25', 4, 1, '2017-12-23', 19, 0),
(5, '2017-05-25', 19, 1, '2017-09-11', 17, 0),
(6, '2017-10-19', 16, 2, '2017-10-30', 30, 0),
(7, '2017-10-19', 14, 2, '2017-12-14', 34, 0),
(8, '2017-10-19', 15, 2, '2018-01-24', 25, 0),
(9, '2017-11-06', 11, 3, '2017-11-28', 25, 0),
(10, '2017-12-04', 10, 4, '2017-12-06', 51, 0),
(11, '2017-12-04', 5, 4, '2017-12-15', 21, 0),
(12, '2018-01-22', 6, 5, '2018-01-21', 5, 0),
(13, '2018-01-22', 12, 5, '2018-01-13', 2, 0),
(14, '2018-01-31', 7, 12, '2018-01-18', 1, 0),
(15, '2018-01-31', 8, 13, '2018-01-31', 1, 0),
(16, '2018-01-09', 9, 20, '2018-01-31', 1, 0),
(17, '2018-02-05', 9, 21, '2018-02-05', 1, 0),
(18, '2018-02-05', 11, 22, '2018-02-05', 1, 0),
(19, '2018-02-08', 12, 37, '2018-02-08', 2, 0),
(20, '2018-02-09', 13, 38, '2018-02-09', 1, 0),
(21, '2018-02-09', 13, 39, '2018-02-09', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_info_tbl`
--

CREATE TABLE `equipment_info_tbl` (
  `ei_id` int(11) NOT NULL,
  `ei_manufacturer` varchar(20) DEFAULT NULL,
  `ei_serial_model_plate` varchar(20) DEFAULT NULL,
  `ei_capacity_unit` varchar(10) DEFAULT NULL,
  `ei_capacity_qty` int(11) DEFAULT NULL,
  `ei_inspection_date` date DEFAULT NULL,
  `ei_inspection_valid_until` date DEFAULT NULL,
  `ei_status` varchar(30) NOT NULL,
  `ec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_info_tbl`
--

INSERT INTO `equipment_info_tbl` (`ei_id`, `ei_manufacturer`, `ei_serial_model_plate`, `ei_capacity_unit`, `ei_capacity_qty`, `ei_inspection_date`, `ei_inspection_valid_until`, `ei_status`, `ec_id`) VALUES
(1, 'CAT', 'XP-2886', 'Myg', 2, '1111-11-11', '1111-11-11', 'Deployed', 1),
(2, 'CAT', 'MJLB-9258', 'Kg', 900, '2015-08-28', '2020-08-20', 'Available', 2),
(3, 'Hitachi', '9K81-S023', 'Myg', 2, '1111-11-11', '1111-11-11', 'Available', 3),
(4, 'Volvo', 'MK-5', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 4),
(5, 'Evbuar', 'GT-8700', 'Kg', 100, '1111-11-11', '1111-11-11', 'Available', 5),
(6, 'CAT', 'ALC-928', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 1),
(7, 'CAT', 'QY-9800', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 1),
(8, 'CAT', 'KO-5209', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 1),
(9, 'CAT', 'P4N-C4K3', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 1),
(10, 'CAT', 'P1-ZZ4', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 2),
(11, 'CAT', 'H0N3Y', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 2),
(12, 'CAT', 'C0RN-D0G', 'Myg', 2, '1111-11-11', '1111-11-11', 'Available', 2),
(13, 'CAT', 'C4k3', 'Kg', 900, '1111-11-11', '1111-11-11', 'Available', 2),
(14, 'CAT', 'CH1-CK3N-F1L-L3T', 'Kg', 980, '1111-11-11', '1111-11-11', 'Available', 3),
(15, 'CAT', 'B4-C0N', 'Myg', 1, '1111-11-11', '1111-11-11', 'Available', 3),
(16, 'CAT', 'FR1-3S', 'Kg', 975, '1111-11-11', '1111-11-11', 'Available', 4),
(17, 'CAT', 'C0RN-B33F', 'Kg', 850, '1111-11-11', '1111-11-11', 'Available', 4),
(18, 'CAT', 'P1K-N1K', 'Kg', 750, '1111-11-11', '1111-11-11', 'Available', 5),
(19, 'CAT', 'PR1-NGL3S', 'Kg', 800, '1111-11-11', '1111-11-11', 'Available', 5);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_jobrequest_tbl`
--

CREATE TABLE `equipment_jobrequest_tbl` (
  `ejr_no` int(11) NOT NULL,
  `ejr_date` date NOT NULL DEFAULT '1111-11-11',
  `ejr_driver_name` varchar(30) NOT NULL DEFAULT ' ',
  `ed_id` int(11) NOT NULL DEFAULT '0',
  `ejr_location` varchar(40) NOT NULL DEFAULT ' ',
  `emp_id` int(11) NOT NULL DEFAULT '0',
  `ejr_problems` varchar(500) NOT NULL DEFAULT ' ',
  `ejr_work_done` varchar(500) NOT NULL DEFAULT ' ',
  `ejr_repaired_by` varchar(30) NOT NULL DEFAULT '',
  `ejr_date_start` date NOT NULL DEFAULT '1111-11-11',
  `ejr_date_completed` date NOT NULL DEFAULT '1111-11-11',
  `equip_trial_id` int(11) NOT NULL DEFAULT '0',
  `ejr_delete` int(11) NOT NULL DEFAULT '0',
  `ejr_checkedby` varchar(50) NOT NULL DEFAULT ' ',
  `ejr_checked_date` date NOT NULL DEFAULT '1111-11-11'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_jobrequest_tbl`
--

INSERT INTO `equipment_jobrequest_tbl` (`ejr_no`, `ejr_date`, `ejr_driver_name`, `ed_id`, `ejr_location`, `emp_id`, `ejr_problems`, `ejr_work_done`, `ejr_repaired_by`, `ejr_date_start`, `ejr_date_completed`, `equip_trial_id`, `ejr_delete`, `ejr_checkedby`, `ejr_checked_date`) VALUES
(1, '2017-11-28', 'andon', 1, '', 11, '', '', '', '1111-11-11', '1111-11-11', 0, 0, '', '1111-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_request_tbl`
--

CREATE TABLE `equipment_request_tbl` (
  `er_id` int(11) NOT NULL,
  `er_date` date NOT NULL DEFAULT '1111-11-11',
  `er_reason` varchar(500) NOT NULL DEFAULT ' ',
  `er_status` varchar(20) NOT NULL DEFAULT ' ',
  `er_qty` int(11) NOT NULL DEFAULT '0',
  `er_item` varchar(30) NOT NULL DEFAULT ' ',
  `proj_no` int(11) NOT NULL,
  `ed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equip_trial`
--

CREATE TABLE `equip_trial` (
  `equip_trial_id` int(11) NOT NULL,
  `et_trialrun_by` varchar(30) NOT NULL DEFAULT ' ',
  `et_date` date NOT NULL DEFAULT '1111-11-11',
  `et_result` varchar(50) NOT NULL DEFAULT ' ',
  `et_turned_over` varchar(50) NOT NULL DEFAULT ' ',
  `et_accept_by` varchar(50) NOT NULL DEFAULT ' ',
  `ejr_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tbl`
--

CREATE TABLE `invoice_tbl` (
  `invoice_id` int(11) NOT NULL,
  `invoice_no` varchar(30) NOT NULL DEFAULT ' ',
  `proj_no` int(11) NOT NULL,
  `proj_percentage` double NOT NULL DEFAULT '15',
  `proj_accpercentage` double NOT NULL DEFAULT '15',
  `invoice_date` date NOT NULL,
  `invoice_due` date NOT NULL,
  `invoice_amount` double NOT NULL,
  `invoice_image` varchar(100) NOT NULL DEFAULT 'payment.jpg',
  `invoice_status` varchar(20) NOT NULL DEFAULT 'Unpaid',
  `invoice_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_tbl`
--

INSERT INTO `invoice_tbl` (`invoice_id`, `invoice_no`, `proj_no`, `proj_percentage`, `proj_accpercentage`, `invoice_date`, `invoice_due`, `invoice_amount`, `invoice_image`, `invoice_status`, `invoice_delete`) VALUES
(3, 'INVC1503024346', 2, 67, 52, '2017-08-18', '2017-08-31', 1689825055.98, 'payment.jpg', 'Paid', 0),
(4, '0', 5, 15, 15, '2018-01-13', '2018-01-13', 203060.606, 'payment.jpg', 'Paid', 0),
(5, '0', 6, 15, 15, '2018-01-30', '2018-01-30', 28325.49, 'payment.jpg', 'Paid', 0),
(6, '0', 7, 15, 15, '2018-01-30', '2018-01-30', 28325.49, 'payment.jpg', 'Paid', 0),
(7, '0', 8, 15, 15, '2018-01-30', '2018-01-30', 28325.49, 'payment.jpg', 'Paid', 0),
(8, '0', 9, 15, 15, '2018-01-30', '2018-01-30', 28325.49, 'payment.jpg', 'Paid', 0),
(9, '0', 10, 15, 15, '2018-01-30', '2018-01-30', 29281.92, 'payment.jpg', 'Paid', 0),
(10, '0', 11, 15, 15, '2018-01-30', '2018-01-30', 28325.49, 'payment.jpg', 'Paid', 0),
(11, '0', 12, 15, 15, '2018-01-30', '2018-01-30', 28325.49, 'payment.jpg', 'Paid', 0),
(12, '0', 13, 15, 15, '2018-01-30', '2018-01-30', 28325.49, 'payment.jpg', 'Paid', 0),
(13, '0', 14, 15, 15, '2018-01-31', '2018-01-31', 275494.7, 'payment.jpg', 'Paid', 0),
(14, '0', 15, 15, 15, '2018-01-31', '2018-01-31', 275494.7, 'payment.jpg', 'Paid', 0),
(15, '0', 16, 15, 15, '2018-01-31', '2018-01-31', 275494.7, 'payment.jpg', 'Paid', 0),
(16, '0', 17, 15, 15, '2018-01-31', '2018-01-31', 275494.7, 'payment.jpg', 'Paid', 0),
(17, '0', 18, 15, 15, '2018-01-31', '2018-01-31', 275494.7, 'payment.jpg', 'Paid', 0),
(18, '0', 19, 15, 15, '2018-01-31', '2018-01-31', 275494.7, 'payment.jpg', 'Paid', 0),
(19, '0', 20, 15, 15, '2018-01-31', '2018-01-31', 28325.491, 'payment.jpg', 'Paid', 0),
(20, '0', 21, 15, 15, '2018-02-05', '2018-02-05', 28325.49, 'payment.jpg', 'Paid', 0),
(21, '0', 22, 15, 15, '2018-02-05', '2018-02-05', 28325.49, 'payment.jpg', 'Paid', 0),
(22, '0', 23, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(23, '0', 24, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(24, '0', 25, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(25, '0', 26, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(26, '0', 27, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(27, '0', 28, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(28, '0', 29, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(29, '0', 30, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(30, '0', 31, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(31, '0', 32, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(32, '0', 33, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(33, '0', 34, 15, 15, '2018-02-07', '2018-02-07', 0, 'payment.jpg', 'Paid', 0),
(34, '0', 35, 15, 15, '2018-02-07', '2018-02-07', 28325.49, 'payment.jpg', 'Paid', 0),
(35, '0', 36, 15, 15, '2018-02-07', '2018-02-07', 28325.49, 'payment.jpg', 'Paid', 0),
(36, '0', 37, 15, 15, '2018-02-08', '2018-02-08', 651486.3, 'payment.jpg', 'Paid', 0),
(37, '0', 38, 15, 15, '2018-02-09', '2018-02-09', 56650.98, 'payment.jpg', 'Paid', 0),
(38, '0', 39, 15, 15, '2018-02-09', '2018-02-09', 56650.98, 'payment.jpg', 'Paid', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `notif_id` int(11) NOT NULL,
  `notif_description` varchar(250) NOT NULL DEFAULT ' ',
  `notif_from` int(11) NOT NULL DEFAULT '0',
  `notif_to` varchar(11) NOT NULL DEFAULT ' ',
  `proj_no` int(11) NOT NULL,
  `notif_date` datetime NOT NULL DEFAULT '1111-11-11 00:00:00',
  `notif_url` varchar(100) NOT NULL DEFAULT ' ',
  `notif_pm_url` varchar(50) NOT NULL DEFAULT '',
  `notif_admin_status` varchar(20) NOT NULL DEFAULT 'unview',
  `notif_pm_status` varchar(20) NOT NULL DEFAULT 'unview',
  `notif_icon` varchar(50) NOT NULL DEFAULT 'calendar-icon.png',
  `notif_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_tbl`
--

INSERT INTO `notification_tbl` (`notif_id`, `notif_description`, `notif_from`, `notif_to`, `proj_no`, `notif_date`, `notif_url`, `notif_pm_url`, `notif_admin_status`, `notif_pm_status`, `notif_icon`, `notif_delete`) VALUES
(1, '1+ tasks of project Road Upgrading based on Gravel Road Strategies, Traffic Benchmark for Upgrading to paved road were delayed on their deadline.', 11, '11', 1, '2017-10-18 18:50:32', '/project_edit?id=1', '/PM_project_edit?id=1', 'view', 'unview', 'delay.ico', 0),
(2, 'You need to update project phase and project task''s start date and end date. (Baywalk Construction)', 22, '22', 2, '2017-10-19 02:30:49', '/project_edit?id=2', '/PM_project_edit?id=2', 'view', 'view', 'delay.ico', 0),
(3, '2+ tasks of project Road Upgrading based on Gravel Road Strategies, Traffic Benchmark for Upgrading to paved road must be completed in less than 2 weeks.', 11, '11', 1, '2017-11-28 02:21:01', '/project_edit?id=1', '/PM_project_edit?id=1', 'view', 'unview', 'calendar-icon.png', 0),
(4, 'You need to update project phase and project task''s start date and end date. (road excavating)', 22, '22', 3, '2017-11-28 03:28:05', '/project_edit?id=3', '/PM_project_edit?id=3', 'view', 'view', 'delay.ico', 0),
(5, '2+ tasks of project Road Upgrading based on Gravel Road Strategies, Traffic Benchmark for Upgrading to paved road were delayed on their deadline.', 11, '11', 1, '2017-12-05 14:57:09', '/project_edit?id=1', '/PM_project_edit?id=1', 'view', 'unview', 'delay.ico', 0),
(6, 'You can now request partial payment for project road excavating', 8, '8', 3, '2017-12-05 15:44:15', '/project_edit?id=3', '/PM_project_edit?id=3', 'view', 'unview', 'proj.png', 0),
(7, 'You need to update project phase and project task''s start date and end date. (Road Pavement of Balara Highschool)', 16, '16', 4, '2017-12-06 11:20:40', '/project_edit?id=4', '/PM_project_edit?id=4', 'view', 'view', 'delay.ico', 0),
(8, 'You can now request partial payment for project Baywalk Construction', 8, '8', 2, '2017-12-17 12:34:09', '/project_edit?id=2', '/PM_project_edit?id=2', 'view', 'unview', 'proj.png', 0),
(9, 'You can now request partial payment for project road excavating', 8, '8', 3, '2018-01-05 01:33:18', '/project_edit?id=3', '/PM_project_edit?id=3', 'view', 'unview', 'proj.png', 0),
(10, '1+ tasks of project Road Pavement of Balara Highschool must be completed in less than 2 weeks.', 16, '16', 4, '2018-01-13 02:25:37', '/project_edit?id=4', '/PM_project_edit?id=4', 'view', 'view', 'calendar-icon.png', 0),
(11, '1+ tasks of project construction of road baykal must be completed in less than 2 weeks.', 16, '16', 5, '2018-01-13 02:25:37', '/project_edit?id=5', '/PM_project_edit?id=5', 'view', 'view', 'calendar-icon.png', 0),
(12, 'Road Upgrading based on Gravel Road Strategies, Traffic Benchmark for Upgrading to paved road must be completed in a month. Project termination point is on 2018-02-01', 11, '11', 1, '2018-01-30 17:00:35', '/project_edit?id=1', '/PM_project_edit?id=1', 'view', 'unview', 'proj.png', 0),
(13, '3+ tasks of project Road Upgrading based on Gravel Road Strategies, Traffic Benchmark for Upgrading to paved road must be completed in less than 2 weeks.', 11, '11', 1, '2018-01-30 17:00:35', '/project_edit?id=1', '/PM_project_edit?id=1', 'view', 'unview', 'calendar-icon.png', 0),
(14, 'a must be completed in a month. Project termination point is on 2018-02-01', 11, '11', 12, '2018-01-30 17:00:35', '/project_edit?id=12', '/PM_project_edit?id=12', 'view', 'unview', 'proj.png', 0),
(15, '3+ tasks of project a must be completed in less than 2 weeks.', 11, '11', 12, '2018-01-30 17:00:36', '/project_edit?id=12', '/PM_project_edit?id=12', 'view', 'unview', 'calendar-icon.png', 0),
(16, 'You can now request partial payment for project Road Pavement of Balara Highschool', 8, '8', 4, '2018-02-03 02:11:34', '/project_edit?id=4', '/PM_project_edit?id=4', 'view', 'unview', 'proj.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `payment_id` int(11) NOT NULL,
  `payment_refno` varchar(50) NOT NULL DEFAULT ' ',
  `payment_amount` bigint(100) NOT NULL DEFAULT '0',
  `invoice_id` varchar(50) NOT NULL DEFAULT '0',
  `proj_no` int(11) NOT NULL,
  `payment_date` date NOT NULL DEFAULT '1111-11-11',
  `payment_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`payment_id`, `payment_refno`, `payment_amount`, `invoice_id`, `proj_no`, `payment_date`, `payment_delete`) VALUES
(7, 'PYMNT1515565280', 1689825056, 'INVC1503024346', 2, '2018-01-10', 0),
(8, 'PYMNT1515810291', 203061, '0', 5, '2018-01-13', 0),
(9, 'PYMNT1517329383', 28325, '0', 6, '2018-01-30', 0),
(10, 'PYMNT1517329470', 28325, '0', 7, '2018-01-30', 0),
(11, 'PYMNT1517329507', 28325, '0', 8, '2018-01-30', 0),
(12, 'PYMNT1517329579', 28325, '0', 9, '2018-01-30', 0),
(13, 'PYMNT1517329607', 29282, '0', 10, '2018-01-30', 0),
(14, 'PYMNT1517329667', 28325, '0', 11, '2018-01-30', 0),
(15, 'PYMNT1517330075', 28325, '0', 12, '2018-01-30', 0),
(16, 'PYMNT1517330120', 28325, '0', 13, '2018-01-30', 0),
(17, 'PYMNT1517391572', 275495, '0', 14, '2018-01-31', 0),
(18, 'PYMNT1517391681', 275495, '0', 15, '2018-01-31', 0),
(19, 'PYMNT1517391728', 275495, '0', 16, '2018-01-31', 0),
(20, 'PYMNT1517391732', 275495, '0', 17, '2018-01-31', 0),
(21, 'PYMNT1517391735', 275495, '0', 18, '2018-01-31', 0),
(22, 'PYMNT1517391737', 275495, '0', 19, '2018-01-31', 0),
(23, 'PYMNT1517395625', 28325, '0', 20, '2018-01-31', 0),
(24, 'PYMNT1517843603', 28325, '0', 21, '2018-02-05', 0),
(25, 'PYMNT1517843686', 28325, '0', 22, '2018-02-05', 0),
(26, 'PYMNT1518008796', 0, '0', 23, '2018-02-07', 0),
(27, 'PYMNT1518009484', 0, '0', 24, '2018-02-07', 0),
(28, 'PYMNT1518009795', 0, '0', 25, '2018-02-07', 0),
(29, 'PYMNT1518009890', 0, '0', 26, '2018-02-07', 0),
(30, 'PYMNT1518010031', 0, '0', 27, '2018-02-07', 0),
(31, 'PYMNT1518010035', 0, '0', 28, '2018-02-07', 0),
(32, 'PYMNT1518010045', 0, '0', 29, '2018-02-07', 0),
(33, 'PYMNT1518010064', 0, '0', 30, '2018-02-07', 0),
(34, 'PYMNT1518010066', 0, '0', 31, '2018-02-07', 0),
(35, 'PYMNT1518010075', 0, '0', 32, '2018-02-07', 0),
(36, 'PYMNT1518010087', 0, '0', 33, '2018-02-07', 0),
(37, 'PYMNT1518010127', 0, '0', 34, '2018-02-07', 0),
(38, 'PYMNT1518010180', 28325, '0', 35, '2018-02-07', 0),
(39, 'PYMNT1518010242', 28325, '0', 36, '2018-02-07', 0),
(40, 'PYMNT1518102940', 651486, '0', 37, '2018-02-08', 0),
(41, 'PYMNT1518173775', 56651, '0', 38, '2018-02-09', 0),
(42, 'PYMNT1518184837', 56651, '0', 39, '2018-02-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `phase_tbl`
--

CREATE TABLE `phase_tbl` (
  `phase_id` int(11) NOT NULL,
  `phase_title` varchar(20) NOT NULL,
  `phase_description` varchar(50) NOT NULL,
  `phase_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phase_tbl`
--

INSERT INTO `phase_tbl` (`phase_id`, `phase_title`, `phase_description`, `phase_delete`) VALUES
(1, 'Part A', 'Facilities for the Engineer', 0),
(2, 'Part B', 'Provision for Safety and Health', 0),
(3, 'Part C', 'Earthworks', 0),
(4, 'Part D', 'Aggregate  Sub-base and Base Course', 0),
(5, 'Part E', 'Surface Courses', 0),
(6, 'Part F', 'Structures (RCBC & Other Structures)', 0),
(7, 'Part G', 'Drainage and Slope Protection', 0),
(8, 'Part H', 'Miscellaneous Structures', 0),
(9, 'Part I', 'Special', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plan_tbl`
--

CREATE TABLE `plan_tbl` (
  `plan_id` int(11) NOT NULL,
  `plan_description` varchar(30) DEFAULT NULL,
  `plan_unit` varchar(11) DEFAULT NULL,
  `plan_unit_cost` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_tbl`
--

INSERT INTO `plan_tbl` (`plan_id`, `plan_description`, `plan_unit`, `plan_unit_cost`) VALUES
(1, 'Roadway Excavation', 'Cu.m.', 1860.30),
(2, 'Structure Excavation', 'Cu.m.', 299.99),
(4, 'Reinforcing Steel Bars', 'Kgs', 49.99);

-- --------------------------------------------------------

--
-- Table structure for table `project_info_tbl`
--

CREATE TABLE `project_info_tbl` (
  `pi_id` int(11) NOT NULL,
  `pi_title` varchar(200) NOT NULL DEFAULT ' ',
  `pi_description` varchar(500) NOT NULL DEFAULT ' ',
  `emp_id` int(11) DEFAULT '0',
  `pi_construction_site` varchar(200) NOT NULL DEFAULT ' ',
  `pi_floor_no` varchar(30) NOT NULL DEFAULT ' ',
  `pi_floor_area` varchar(30) NOT NULL DEFAULT ' ',
  `pi_road_length` varchar(30) NOT NULL DEFAULT ' ',
  `pi_road_type` varchar(100) NOT NULL DEFAULT '0',
  `pi_remarks` varchar(500) NOT NULL DEFAULT 'You have no REMARKS.',
  `proj_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_info_tbl`
--

INSERT INTO `project_info_tbl` (`pi_id`, `pi_title`, `pi_description`, `emp_id`, `pi_construction_site`, `pi_floor_no`, `pi_floor_area`, `pi_road_length`, `pi_road_type`, `pi_remarks`, `proj_no`) VALUES
(1, 'Road Upgrading based on Gravel Road Strategies, Traffic Benchmark for Upgrading to paved road', 'Upgrading Tinoc Road based on Gravel Road Strategies  from Unpaved to Paved', 11, 'Tinoc - Buguias Road', '0', '0', '2288 KM', 'Unpaved to Paved', 'You have no REMARKS.', 1),
(2, 'Baywalk Construction', 'Baywalk Construction of Baybay lopez, pangasinan', 22, 'Baybay lopez, Pangasinan', '0', '0', '736 KM', 'Rough', 'You have no REMARKS.', 2),
(3, 'road excavating', 'asdasd', 22, 'bulacan', '0', '0', '20', 'paved', 'You have no REMARKS.', 3),
(4, 'Road Pavement of Balara Highschool', 'Road Pavement', 16, 'Balara Q.C', '0', '0', '5  km', 'pavement', 'You have no REMARKS.', 4),
(5, 'construction of road baykal', 'paved', 16, 'baykal', '0', '0', '2', 'PAVED', 'You have no REMARKS.', 5),
(6, 'a', 'a', 11, 'a', '0', '0', 'a', 'a', 'You have no REMARKS.', 12),
(7, 'a', 'a', 11, 'a', '0', '0', 'a', 'a', 'You have no REMARKS.', 13),
(8, 'asdf', 'asdf', 11, 'asdf', '0', '0', 'asdf', 'asdf', 'You have no REMARKS.', 20),
(9, 'a', '\r\na', 11, 'a', '0', '0', 'a', 'a', 'You have no REMARKS.', 21),
(10, 'a', 'a', 11, 'a', '0', '0', 'a', 'a', 'You have no REMARKS.', 22),
(11, 'sample project', 'sample', 11, 'sample site', '0', '0', 'sample', 'sample', 'You have no REMARKS.', 37),
(12, 'a', 'a', 11, 'a', '0', '0', 'a', 'a', 'You have no REMARKS.', 38),
(13, 'sample project', 'sample', 11, 'sample site', '0', '0', 'sample', 'sample', 'You have no REMARKS.', 39);

-- --------------------------------------------------------

--
-- Table structure for table `project_phase_tbl`
--

CREATE TABLE `project_phase_tbl` (
  `pp_id` int(11) NOT NULL,
  `phase_id` int(11) DEFAULT NULL,
  `pp_start_date` date DEFAULT NULL,
  `pp_end_date` date DEFAULT NULL,
  `pp_status` varchar(20) DEFAULT 'Pending',
  `pp_percentage` int(11) DEFAULT '0',
  `pp_budget` double NOT NULL DEFAULT '0',
  `pp_expense` double NOT NULL DEFAULT '0',
  `proj_no` int(11) DEFAULT NULL,
  `pp_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_phase_tbl`
--

INSERT INTO `project_phase_tbl` (`pp_id`, `phase_id`, `pp_start_date`, `pp_end_date`, `pp_status`, `pp_percentage`, `pp_budget`, `pp_expense`, `proj_no`, `pp_delete`) VALUES
(1, 1, '2017-05-25', '2018-02-01', 'On Going', 37, 0, 0, 1, 0),
(2, 2, '2017-05-25', '2018-01-31', 'On Going', 20, 0, 0, 1, 0),
(3, 3, '2017-05-25', '2018-01-15', 'On Going', 80, 0, 0, 1, 0),
(4, 3, '2017-10-19', '2018-02-15', 'On Going', 50, 0, 0, 2, 0),
(5, 2, '2017-10-19', '2018-02-15', 'Complete', 100, 0, 0, 2, 0),
(6, 3, '2017-11-06', '1111-11-11', 'Pending', 0, 0, 0, 3, 0),
(7, 1, '2017-12-04', '2018-02-01', 'Pending', 0, 0, 0, 4, 0),
(8, 3, '2017-12-04', '2018-01-25', 'Pending', 0, 0, 0, 4, 0),
(9, 1, '2018-01-22', '2018-03-07', 'On Going', 10, 0, 0, 5, 0),
(10, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 6, 0),
(11, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 7, 0),
(12, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 8, 0),
(13, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 9, 0),
(14, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 10, 0),
(15, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 11, 0),
(16, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 12, 0),
(17, 1, '2018-01-31', '1111-11-11', 'Pending', 0, 0, 0, 13, 0),
(18, 3, '2018-02-14', '1111-11-11', 'Pending', 0, 0, 0, 14, 0),
(19, 3, '2018-02-14', '1111-11-11', 'Pending', 0, 0, 0, 15, 0),
(20, 3, '2018-02-14', '1111-11-11', 'Pending', 0, 0, 0, 16, 0),
(21, 3, '2018-02-14', '1111-11-11', 'Pending', 0, 0, 0, 17, 0),
(22, 3, '2018-02-14', '1111-11-11', 'Pending', 0, 0, 0, 18, 0),
(23, 3, '2018-02-14', '1111-11-11', 'Pending', 0, 0, 0, 19, 0),
(24, 1, '2018-01-09', '1111-11-11', 'Pending', 0, 0, 0, 20, 0),
(25, 1, '2018-02-05', '1111-11-11', 'Pending', 0, 0, 0, 21, 0),
(26, 1, '2018-02-05', '1111-11-11', 'Pending', 0, 0, 0, 22, 0),
(27, 1, '2018-02-07', '1111-11-11', 'Pending', 0, 0, 0, 35, 0),
(28, 1, '2018-02-07', '1111-11-11', 'Pending', 0, 0, 0, 36, 0),
(29, 1, '2018-02-08', '1111-11-11', 'Pending', 0, 0, 0, 37, 0),
(30, 1, '2018-02-09', '1111-11-11', 'Pending', 0, 0, 0, 38, 0),
(31, 1, '2018-02-09', '1111-11-11', 'Pending', 0, 0, 0, 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_task_tbl`
--

CREATE TABLE `project_task_tbl` (
  `pt_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `pt_start_date` date NOT NULL DEFAULT '0000-00-00',
  `pt_end_date` date NOT NULL DEFAULT '0000-00-00',
  `pt_date_completed` date NOT NULL,
  `pt_percentage` int(11) NOT NULL DEFAULT '0',
  `pt_proj_percentage` double NOT NULL,
  `pt_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `pt_expense` double NOT NULL DEFAULT '0',
  `pp_id` int(11) NOT NULL,
  `pt_qty` double NOT NULL,
  `pt_total_cost` bigint(100) NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `proj_no` int(11) NOT NULL,
  `pt_reason_delay` varchar(500) NOT NULL DEFAULT '0',
  `pt_reason_expense` varchar(500) NOT NULL DEFAULT '0',
  `pt_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_task_tbl`
--

INSERT INTO `project_task_tbl` (`pt_id`, `task_id`, `pt_start_date`, `pt_end_date`, `pt_date_completed`, `pt_percentage`, `pt_proj_percentage`, `pt_status`, `pt_expense`, `pp_id`, `pt_qty`, `pt_total_cost`, `invoice_id`, `proj_no`, `pt_reason_delay`, `pt_reason_expense`, `pt_delete`) VALUES
(1, 1, '2017-05-25', '2018-02-01', '2017-10-18', 50, 2.0843425289004394, 'On Going', 809164.88, 1, 8.57, 1618330, 0, 1, '0', '0', 0),
(2, 2, '2017-05-25', '2018-01-30', '2017-10-18', 10, 0.25142614090608634, 'On Going', 0, 1, 1, 195213, 0, 1, '0', '0', 0),
(3, 7, '2017-05-25', '2018-02-01', '2017-10-18', 50, 6.546001278968913, 'On Going', 2541230.26, 1, 8.57, 5082461, 0, 1, '0', '0', 0),
(4, 3, '2017-05-25', '2018-01-31', '2017-10-18', 20, 0.1768272149437039, 'On Going', 27458.51, 2, 1, 137293, 0, 1, '0', '0', 0),
(5, 5, '2017-05-25', '2017-11-30', '2017-10-18', 80, 0.016317617507773104, 'On Going', 10135.49, 3, 6, 12669, 0, 1, '0', '0', 0),
(6, 8, '2017-05-25', '2017-12-05', '2017-10-18', 80, 90.9250852149092, 'On Going', 56477001.6, 3, 200, 70596252, 0, 1, '0', '0', 0),
(7, 8, '2017-10-19', '2018-02-15', '2017-08-18', 100, 67.35579688963254, 'Complete', 2188836, 4, 6201, 2188836793, 0, 2, '0', '0', 0),
(8, 4, '2017-10-19', '2018-02-15', '2017-10-19', 0, 32.63997828625638, 'Pending', 0, 4, 6201, 1060689483, 0, 2, '0', '0', 0),
(9, 3, '2017-10-19', '2018-02-15', '2017-10-19', 100, 0.004224824111076245, 'Complete', 137292.57, 5, 1, 137293, 0, 2, '0', '0', 0),
(10, 5, '2017-11-06', '1111-11-11', '2017-11-06', 0, 100, 'Pending', 0, 6, 22, 46454, 0, 3, '0', '0', 0),
(11, 1, '2017-12-04', '2018-02-01', '2017-12-06', 0, 2.7953505005204224, 'Pending', 0, 7, 2, 377673, 0, 4, '0', '0', 0),
(12, 2, '2017-12-04', '2018-02-01', '2017-12-06', 0, 7.22434439551351, 'Pending', 0, 7, 5, 976064, 0, 4, '0', '0', 0),
(13, 7, '2017-12-04', '2018-02-01', '2017-12-06', 0, 35.115855943069995, 'Pending', 0, 7, 8, 4744421, 0, 4, '0', '0', 0),
(14, 8, '2017-12-04', '2018-01-25', '2017-12-06', 0, 54.864449160896065, 'Pending', 0, 8, 21, 7412606, 0, 4, '0', '0', 0),
(15, 1, '2018-01-22', '2018-03-05', '2018-01-13', 20, 27.898559083140324, 'On Going', 50000, 9, 2, 377673, 0, 5, '0', '0', 0),
(16, 2, '2018-01-22', '2018-02-08', '2018-01-13', 0, 72.10144091685967, 'Pending', 0, 9, 5, 976064, 0, 5, '0', '0', 0),
(17, 1, '2018-01-31', '1111-11-11', '2018-01-31', 0, 0.09955696620480531, 'Pending', 0, 16, 1, 188836, 0, 12, '0', '0', 0),
(18, 1, '2018-01-31', '1111-11-11', '2018-01-31', 0, 0.09955696620480531, 'Pending', 0, 17, 1, 188836, 0, 13, '0', '0', 0),
(19, 1, '2018-01-09', '1111-11-11', '2018-01-09', 0, 100, 'Pending', 0, 24, 1, 188837, 0, 20, '0', '0', 0),
(20, 1, '2018-02-05', '1111-11-11', '2018-02-05', 0, 0.09955696620480531, 'Pending', 0, 25, 1, 188836, 0, 21, '0', '0', 0),
(21, 1, '2018-02-05', '1111-11-11', '2018-02-05', 0, 0.09955696620480531, 'Pending', 0, 26, 1, 188836, 0, 22, '0', '0', 0),
(22, 1, '2018-02-07', '1111-11-11', '2018-02-07', 0, 0.09955696620480531, 'Pending', 0, 27, 1, 188836, 0, 35, '0', '0', 0),
(23, 1, '2018-02-07', '1111-11-11', '2018-02-07', 0, 0.09955696620480531, 'Pending', 0, 28, 1, 188836, 0, 36, '0', '0', 0),
(24, 1, '2018-02-08', '1111-11-11', '2018-02-08', 0, 0.00009209710102202155, 'Pending', 0, 29, 23, 4343242, 0, 37, '0', '0', 0),
(25, 1, '2018-02-09', '1111-11-11', '2018-02-09', 0, 0.09982174537024363, 'Pending', 0, 30, 2, 377673, 0, 38, '0', '0', 0),
(26, 1, '2018-02-09', '1111-11-11', '2018-02-09', 0, 0.09982174537024363, 'Pending', 0, 31, 2, 377673, 0, 39, '0', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_tbl`
--

CREATE TABLE `project_tbl` (
  `proj_no` int(11) NOT NULL,
  `proj_start_date` date DEFAULT NULL,
  `proj_end_date` date DEFAULT NULL,
  `proj_complete_date` date NOT NULL,
  `proj_status` varchar(20) DEFAULT 'On Going',
  `proj_percentage` int(11) DEFAULT '0',
  `proj_created_date` date NOT NULL,
  `ci_no` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_tbl`
--

INSERT INTO `project_tbl` (`proj_no`, `proj_start_date`, `proj_end_date`, `proj_complete_date`, `proj_status`, `proj_percentage`, `proj_created_date`, `ci_no`, `deleted`) VALUES
(1, '2017-05-25', '2018-02-01', '2017-10-18', 'On Going', 77, '2017-10-18', 1, 1),
(2, '2017-10-19', '2018-02-15', '2017-10-19', 'On Going', 67, '2017-10-19', 2, 1),
(3, '2017-11-06', '2017-12-30', '2017-11-28', 'On Going', 0, '2017-11-28', 3, 1),
(4, '2017-12-04', '2018-09-22', '2017-12-06', 'Pending', 0, '2017-12-06', 4, 1),
(5, '2018-01-22', '2018-04-11', '2018-01-13', 'On Going', 6, '2018-01-13', 5, 1),
(6, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 6, 0),
(7, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 7, 0),
(8, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 8, 0),
(9, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 9, 0),
(10, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 10, 0),
(11, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 11, 0),
(12, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 12, 1),
(13, '2018-01-31', '2018-02-01', '2018-01-30', 'On Going', 0, '2018-01-30', 13, 1),
(14, '2018-02-14', '2018-09-22', '2018-01-31', 'On Going', 0, '2018-01-31', 14, 0),
(15, '2018-02-14', '2018-09-22', '2018-01-31', 'On Going', 0, '2018-01-31', 15, 0),
(16, '2018-02-14', '2018-09-22', '2018-01-31', 'On Going', 0, '2018-01-31', 16, 0),
(17, '2018-02-14', '2018-09-22', '2018-01-31', 'On Going', 0, '2018-01-31', 17, 0),
(18, '2018-02-14', '2018-09-22', '2018-01-31', 'On Going', 0, '2018-01-31', 18, 0),
(19, '2018-02-14', '2018-09-22', '2018-01-31', 'On Going', 0, '2018-01-31', 19, 0),
(20, '2018-01-09', '2018-02-14', '2018-01-31', 'On Going', 0, '2018-01-31', 20, 1),
(21, '2018-02-05', '2018-03-20', '2018-02-05', 'On Going', 0, '2018-02-05', 21, 1),
(22, '2018-02-05', '2018-02-06', '2018-02-05', 'On Going', 0, '2018-02-05', 22, 1),
(23, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 23, 0),
(24, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 24, 0),
(25, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 25, 0),
(26, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 26, 0),
(27, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 27, 0),
(28, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 28, 0),
(29, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 29, 0),
(30, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 30, 0),
(31, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 31, 0),
(32, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 32, 0),
(33, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 33, 0),
(34, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 34, 0),
(35, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 35, 0),
(36, '2018-02-07', '2018-02-08', '2018-02-07', 'On Going', 0, '2018-02-07', 36, 0),
(37, '2018-02-08', '2018-02-09', '2018-02-08', 'On Going', 0, '2018-02-08', 37, 1),
(38, '2018-02-09', '2018-02-10', '2018-02-09', 'On Going', 0, '2018-02-09', 38, 1),
(39, '2018-02-09', '2018-02-10', '2018-02-09', 'On Going', 0, '2018-02-09', 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proj_percentage_history_tbl`
--

CREATE TABLE `proj_percentage_history_tbl` (
  `pph_id` int(11) NOT NULL,
  `proj_no` int(11) NOT NULL,
  `pph_percentage_added` double NOT NULL DEFAULT '15',
  `pph_percentage` double NOT NULL DEFAULT '15',
  `pph_date` date NOT NULL DEFAULT '1111-11-11',
  `pph_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proj_percentage_history_tbl`
--

INSERT INTO `proj_percentage_history_tbl` (`pph_id`, `proj_no`, `pph_percentage_added`, `pph_percentage`, `pph_date`, `pph_delete`) VALUES
(1, 1, 0, 0, '2017-05-25', 0),
(2, 1, 0.12571307045304317, 0.12571307045304317, '2017-10-18', 0),
(3, 1, 0.025142614090608636, 0.025142614090608636, '2017-10-18', 0),
(4, 1, 1.0673138785408283, 1.0673138785408283, '2017-10-18', 0),
(5, 1, 3.340314518025285, 4.340314518025285, '2017-10-18', 0),
(6, 1, 0.37567996101402557, 4.375679961014026, '2017-10-18', 0),
(7, 1, 0.37567996101402557, 4.375679961014026, '2017-10-18', 0),
(8, 1, 0.37567996101402557, 4.375679961014026, '2017-10-18', 0),
(9, 1, 0.38873405502024383, 4.388734055020244, '2017-10-18', 0),
(10, 1, 73.12880222694761, 77.12880222694761, '2017-10-18', 0),
(11, 2, 0, 0, '2017-10-19', 0),
(12, 2, 0.004224824111076245, 0.004224824111076245, '2017-10-19', 0),
(13, 2, 6.739804513074331, 6.739804513074331, '2017-10-19', 0),
(14, 2, 60.36002171374362, 67.36002171374362, '2017-08-18', 0),
(15, 3, 0, 0, '2017-11-06', 0),
(16, 4, 0, 0, '2017-12-04', 0),
(17, 5, 0, 0, '2018-01-22', 0),
(18, 5, 5.579711816628064, 5.579711816628064, '2018-01-13', 0),
(19, 6, 0, 0, '2018-01-31', 0),
(20, 7, 0, 0, '2018-01-31', 0),
(21, 8, 0, 0, '2018-01-31', 0),
(22, 9, 0, 0, '2018-01-31', 0),
(23, 10, 0, 0, '2018-01-31', 0),
(24, 11, 0, 0, '2018-01-31', 0),
(25, 12, 0, 0, '2018-01-31', 0),
(26, 13, 0, 0, '2018-01-31', 0),
(27, 14, 0, 0, '2018-02-14', 0),
(28, 15, 0, 0, '2018-02-14', 0),
(29, 16, 0, 0, '2018-02-14', 0),
(30, 17, 0, 0, '2018-02-14', 0),
(31, 18, 0, 0, '2018-02-14', 0),
(32, 19, 0, 0, '2018-02-14', 0),
(33, 20, 0, 0, '2018-01-09', 0),
(34, 21, 0, 0, '2018-02-05', 0),
(35, 22, 0, 0, '2018-02-05', 0),
(36, 23, 0, 0, '2018-02-07', 0),
(37, 24, 0, 0, '2018-02-07', 0),
(38, 25, 0, 0, '2018-02-07', 0),
(39, 26, 0, 0, '2018-02-07', 0),
(40, 27, 0, 0, '2018-02-07', 0),
(41, 28, 0, 0, '2018-02-07', 0),
(42, 29, 0, 0, '2018-02-07', 0),
(43, 30, 0, 0, '2018-02-07', 0),
(44, 31, 0, 0, '2018-02-07', 0),
(45, 32, 0, 0, '2018-02-07', 0),
(46, 33, 0, 0, '2018-02-07', 0),
(47, 34, 0, 0, '2018-02-07', 0),
(48, 35, 0, 0, '2018-02-07', 0),
(49, 36, 0, 0, '2018-02-07', 0),
(50, 37, 0, 0, '2018-02-08', 0),
(51, 38, 0, 0, '2018-02-09', 0),
(52, 39, 0, 0, '2018-02-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `req_items_tbl`
--

CREATE TABLE `req_items_tbl` (
  `req_item_id` int(11) NOT NULL,
  `req_qty` int(11) NOT NULL DEFAULT '0',
  `req_items` varchar(20) NOT NULL DEFAULT ' ',
  `req_remark` varchar(100) NOT NULL DEFAULT ' ',
  `req_delete` int(11) NOT NULL DEFAULT '0',
  `req_status` varchar(15) NOT NULL DEFAULT 'Sent',
  `ejr_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_items_tbl`
--

INSERT INTO `req_items_tbl` (`req_item_id`, `req_qty`, `req_items`, `req_remark`, `req_delete`, `req_status`, `ejr_no`) VALUES
(1, 1, 'Air Compressor', '', 0, 'Sent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_tbl`
--

CREATE TABLE `task_tbl` (
  `task_id` int(11) NOT NULL,
  `task_item_no` varchar(20) NOT NULL,
  `task_description` varchar(100) NOT NULL,
  `task_type` varchar(20) NOT NULL,
  `task_unit` varchar(20) NOT NULL,
  `task_unit_cost` double NOT NULL,
  `phase_id` int(11) NOT NULL,
  `task_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_tbl`
--

INSERT INTO `task_tbl` (`task_id`, `task_item_no`, `task_description`, `task_type`, `task_unit`, `task_unit_cost`, `phase_id`, `task_delete`) VALUES
(1, 'A-1.a', 'Temporary Facilities for Engineers', 'Default', 'mos', 188836.61, 1, 0),
(2, 'A-1.b', 'Provide/Furnish Equipment', 'Default', 'ls', 195212.83, 1, 0),
(3, 'B-1', 'Provision for Safety & Health', 'Default', 'lot', 137292.57, 2, 0),
(4, '101(1)', 'Clearing and Grubbing', 'Horizontal', 'sq.m.', 171051.36, 3, 0),
(5, '100(2)', 'Removal of RCPC and Storm Drain', 'Horizontal', 'in.m.', 2111.56, 3, 0),
(7, 'A-1.c', 'Provide Vehicle for Engineers', 'Default', 'mos', 593052.57, 1, 0),
(8, '101(3)', 'Removal of Existing Concrete Pavement', 'Horizontal', 'sq.m.', 352981.26, 3, 0),
(9, 'AB21', 'road excavating', 'Horizontal', 'KG', 25, 2, 0),
(10, 'a', 'a', 'Horizontal', 'a', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timeext_request_tbl`
--

CREATE TABLE `timeext_request_tbl` (
  `ter_id` int(11) NOT NULL,
  `ter_no` varchar(50) NOT NULL DEFAULT ' ',
  `ter_date` date NOT NULL DEFAULT '1111-11-11',
  `ter_days` int(11) NOT NULL DEFAULT '0',
  `ter_amount` double NOT NULL DEFAULT '0',
  `ter_reason` varchar(50) NOT NULL DEFAULT ' ',
  `ter_remarks` varchar(50) NOT NULL DEFAULT '  ',
  `ter_status` varchar(20) NOT NULL DEFAULT ' Waiting',
  `proj_no` int(11) NOT NULL,
  `ter_original_enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeext_request_tbl`
--

INSERT INTO `timeext_request_tbl` (`ter_id`, `ter_no`, `ter_date`, `ter_days`, `ter_amount`, `ter_reason`, `ter_remarks`, `ter_status`, `proj_no`, `ter_original_enddate`) VALUES
(1, ' ', '2017-12-05', 2, 0, 'Delay in progress payments', '5', 'Waiting', 1, '2018-02-01'),
(2, ' ', '2018-01-13', 5, 0, 'Shortage of labors ', '5', 'Waiting', 5, '2018-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `el_position` varchar(20) NOT NULL,
  `remember_token` varchar(255) NOT NULL DEFAULT '0',
  `el_status` int(11) NOT NULL DEFAULT '0',
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `el_position`, `remember_token`, `el_status`, `emp_id`) VALUES
(12, 'admin', '$2y$10$rO3C0qc0fyAYVD6ZaJuQp.lb41nfnkWUWyt69D47Oq1W66Y/GjiNS', 'Admin', '', 0, 8),
(13, 'hannah', '$2y$10$wdHVJgLX2Av/UckizT0pKODRQxC6wFSXRu4pv0.ANZxXd72t8ur42', 'Project Manager', '', 0, 11),
(14, 'user', '$2y$10$ik5EDpeCuedjiCQHNcSS1.bIwx/36YHuDne5Z9oDJmDxPo39OwtPy', 'Admin', '0', 0, 14),
(15, 'lea', '$2y$10$mDnXSrT8BwCotSTENk6tcugQfdkUY4ng1utDQAOJhiSFddNuUDjwG', 'Project Manager', '0', 0, 15),
(16, 'kenji', '$2y$10$oajVOf9PB.8.Wzl9grNdE.CazTtVrWrYiW3vqm21pg9iO/beLp2/y', 'Project Manager', '0', 0, 16),
(18, 'edith', '$2y$10$nxqSnl9iz9Mrf5Cpp/M0IOmaplF2h2s86NdKFq1UskoBX4sKIHX.C', 'Admin', '0', 0, 18),
(21, 'pedro', '$2y$10$0gjrkh8LIW9btWiqNii2Tet5/sHJ/4cI/ppLu3Gbj1ZcMXJqNEJX2', 'Project Manager', '0', 0, 21),
(22, 'james', '$2y$10$nm55UPE3Y/DH0QR/TxFqSOFD2qQzy.P94j41.j9BYue9hfht1obQO', 'Project Manager', '0', 0, 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_rep_tbl`
--
ALTER TABLE `client_rep_tbl`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `client_FK` (`cl_no`);

--
-- Indexes for table `client_tbl`
--
ALTER TABLE `client_tbl`
  ADD PRIMARY KEY (`cl_no`);

--
-- Indexes for table `contract_bill_tbl`
--
ALTER TABLE `contract_bill_tbl`
  ADD PRIMARY KEY (`cb_id`);

--
-- Indexes for table `contract_info_tbl`
--
ALTER TABLE `contract_info_tbl`
  ADD PRIMARY KEY (`ci_no`),
  ADD KEY `cb_id` (`cb_id`),
  ADD KEY `cl_no` (`cl_no`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `equipment_category`
--
ALTER TABLE `equipment_category`
  ADD PRIMARY KEY (`ec_id`);

--
-- Indexes for table `equipment_deployed_tbl`
--
ALTER TABLE `equipment_deployed_tbl`
  ADD PRIMARY KEY (`ed_id`),
  ADD KEY `proj_no` (`proj_no`);

--
-- Indexes for table `equipment_info_tbl`
--
ALTER TABLE `equipment_info_tbl`
  ADD PRIMARY KEY (`ei_id`),
  ADD KEY `ec_id` (`ec_id`);

--
-- Indexes for table `equipment_jobrequest_tbl`
--
ALTER TABLE `equipment_jobrequest_tbl`
  ADD PRIMARY KEY (`ejr_no`);

--
-- Indexes for table `equipment_request_tbl`
--
ALTER TABLE `equipment_request_tbl`
  ADD PRIMARY KEY (`er_id`);

--
-- Indexes for table `equip_trial`
--
ALTER TABLE `equip_trial`
  ADD PRIMARY KEY (`equip_trial_id`);

--
-- Indexes for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `phase_tbl`
--
ALTER TABLE `phase_tbl`
  ADD PRIMARY KEY (`phase_id`);

--
-- Indexes for table `plan_tbl`
--
ALTER TABLE `plan_tbl`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `project_info_tbl`
--
ALTER TABLE `project_info_tbl`
  ADD PRIMARY KEY (`pi_id`),
  ADD KEY `proj_no` (`proj_no`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `project_phase_tbl`
--
ALTER TABLE `project_phase_tbl`
  ADD PRIMARY KEY (`pp_id`),
  ADD KEY `project_FK` (`proj_no`),
  ADD KEY `phase_id` (`phase_id`);

--
-- Indexes for table `project_task_tbl`
--
ALTER TABLE `project_task_tbl`
  ADD PRIMARY KEY (`pt_id`),
  ADD KEY `plan_id` (`task_id`),
  ADD KEY `proj_no` (`proj_no`),
  ADD KEY `pp_id` (`pp_id`);

--
-- Indexes for table `project_tbl`
--
ALTER TABLE `project_tbl`
  ADD PRIMARY KEY (`proj_no`),
  ADD KEY `contract_info_FK` (`ci_no`);

--
-- Indexes for table `proj_percentage_history_tbl`
--
ALTER TABLE `proj_percentage_history_tbl`
  ADD PRIMARY KEY (`pph_id`);

--
-- Indexes for table `req_items_tbl`
--
ALTER TABLE `req_items_tbl`
  ADD PRIMARY KEY (`req_item_id`);

--
-- Indexes for table `task_tbl`
--
ALTER TABLE `task_tbl`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `phase_id` (`phase_id`);

--
-- Indexes for table `timeext_request_tbl`
--
ALTER TABLE `timeext_request_tbl`
  ADD PRIMARY KEY (`ter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_FK` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_rep_tbl`
--
ALTER TABLE `client_rep_tbl`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client_tbl`
--
ALTER TABLE `client_tbl`
  MODIFY `cl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contract_bill_tbl`
--
ALTER TABLE `contract_bill_tbl`
  MODIFY `cb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `contract_info_tbl`
--
ALTER TABLE `contract_info_tbl`
  MODIFY `ci_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `equipment_category`
--
ALTER TABLE `equipment_category`
  MODIFY `ec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `equipment_deployed_tbl`
--
ALTER TABLE `equipment_deployed_tbl`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `equipment_info_tbl`
--
ALTER TABLE `equipment_info_tbl`
  MODIFY `ei_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `equipment_jobrequest_tbl`
--
ALTER TABLE `equipment_jobrequest_tbl`
  MODIFY `ejr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `equipment_request_tbl`
--
ALTER TABLE `equipment_request_tbl`
  MODIFY `er_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `equip_trial`
--
ALTER TABLE `equip_trial`
  MODIFY `equip_trial_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `phase_tbl`
--
ALTER TABLE `phase_tbl`
  MODIFY `phase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `plan_tbl`
--
ALTER TABLE `plan_tbl`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project_info_tbl`
--
ALTER TABLE `project_info_tbl`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `project_phase_tbl`
--
ALTER TABLE `project_phase_tbl`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `project_task_tbl`
--
ALTER TABLE `project_task_tbl`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `project_tbl`
--
ALTER TABLE `project_tbl`
  MODIFY `proj_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `proj_percentage_history_tbl`
--
ALTER TABLE `proj_percentage_history_tbl`
  MODIFY `pph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `req_items_tbl`
--
ALTER TABLE `req_items_tbl`
  MODIFY `req_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `task_tbl`
--
ALTER TABLE `task_tbl`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `timeext_request_tbl`
--
ALTER TABLE `timeext_request_tbl`
  MODIFY `ter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract_info_tbl`
--
ALTER TABLE `contract_info_tbl`
  ADD CONSTRAINT `contract_info_tbl_ibfk_1` FOREIGN KEY (`cb_id`) REFERENCES `contract_bill_tbl` (`cb_id`);

--
-- Constraints for table `equipment_deployed_tbl`
--
ALTER TABLE `equipment_deployed_tbl`
  ADD CONSTRAINT `equipment_deployed_tbl_ibfk_1` FOREIGN KEY (`proj_no`) REFERENCES `project_tbl` (`proj_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
