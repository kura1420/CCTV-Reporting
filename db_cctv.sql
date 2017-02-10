-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2017 at 04:52 PM
-- Server version: 5.6.31-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cctv`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `account_username` varchar(50) NOT NULL,
  `account_password` varchar(35) NOT NULL,
  `account_level` int(1) NOT NULL,
  `account_identity` varchar(50) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_by` varchar(50) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_by` varchar(50) NOT NULL,
  `delete_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_username`, `account_password`, `account_level`, `account_identity`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES
('buling', '4297f44b13955235245b2497399d7a93', 2, 'ahmad buling', '', NULL, '', NULL, '', NULL),
('nicolas', '4297f44b13955235245b2497399d7a93', 3, 'nicolas', '', NULL, '', NULL, '', NULL),
('syakur', '4297f44b13955235245b2497399d7a93', 4, 'abdul syakur', '', NULL, '', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_store`
--

CREATE TABLE IF NOT EXISTS `account_store` (
  `line` int(11) NOT NULL,
  `account_username` varchar(50) NOT NULL,
  `store_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `issue_id` varchar(15) NOT NULL,
  `issue_title` varchar(100) NOT NULL,
  `issue_customer` varchar(50) DEFAULT NULL,
  `issue_notepelapor` text NOT NULL,
  `issue_pelapor` varchar(50) NOT NULL,
  `issue_start` timestamp NULL DEFAULT NULL,
  `issue_finish` timestamp NULL DEFAULT NULL,
  `issue_status` int(1) NOT NULL DEFAULT '0',
  `issue_priority` int(1) NOT NULL,
  `issue_notecctv` text NOT NULL,
  `issue_cctv` varchar(50) NOT NULL,
  `issue_confirmstatus` tinyint(1) NOT NULL DEFAULT '0',
  `issue_notemanagement` text NOT NULL,
  `issue_management` varchar(50) NOT NULL,
  `issue_notelaporan` text NOT NULL,
  `store_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issue_pic`
--

CREATE TABLE IF NOT EXISTS `issue_pic` (
  `pic_id` int(5) NOT NULL,
  `pic_name` varchar(50) NOT NULL,
  `pic_fromlevelaccount` char(10) NOT NULL,
  `issue_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `store_id` varchar(15) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `store_email` varchar(50) NOT NULL,
  `store_telp` varchar(13) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `update_by` varchar(50) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `delete_by` varchar(50) NOT NULL,
  `delete_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_username`);

--
-- Indexes for table `account_store`
--
ALTER TABLE `account_store`
  ADD PRIMARY KEY (`line`),
  ADD KEY `account_username` (`account_username`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `issue_pelapor` (`issue_pelapor`),
  ADD KEY `issue_pelapor_2` (`issue_pelapor`),
  ADD KEY `issue_cctv` (`issue_cctv`),
  ADD KEY `issue_management` (`issue_management`),
  ADD KEY `store_id_2` (`store_id`);

--
-- Indexes for table `issue_pic`
--
ALTER TABLE `issue_pic`
  ADD PRIMARY KEY (`pic_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_store`
--
ALTER TABLE `account_store`
  MODIFY `line` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `issue_pic`
--
ALTER TABLE `issue_pic`
  MODIFY `pic_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_store`
--
ALTER TABLE `account_store`
  ADD CONSTRAINT `account_store_ibfk_1` FOREIGN KEY (`account_username`) REFERENCES `account` (`account_username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_store_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
