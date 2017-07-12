-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2017 at 09:04 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `cls_id` int(11) NOT NULL,
  `cls_code` varchar(10) NOT NULL,
  `cls_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`cls_id`, `cls_code`, `cls_name`) VALUES
(3, 'CLS001', 'class'),
(5, 'CLS003', 'dsfds');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_subjects`
--

CREATE TABLE `tbl_class_subjects` (
  `id` int(11) NOT NULL,
  `cls_id` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class_subjects`
--

INSERT INTO `tbl_class_subjects` (`id`, `cls_id`, `sub_id`) VALUES
(5, 'CLS001', 1),
(6, 'CLS001', 2),
(7, 'CLS002', 1),
(8, 'CLS003', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instructor`
--

CREATE TABLE `tbl_instructor` (
  `ins_id` int(11) NOT NULL,
  `ins_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_instructor`
--

INSERT INTO `tbl_instructor` (`ins_id`, `ins_name`, `address`, `email`, `contact_no`) VALUES
(1, 'aaa', 'sadasd', 'test@gmail.com', 2147483647),
(3, 'sfdd', 'dfgdfg', 'test@gmail.com', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `std_id` int(11) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `addess` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` int(10) NOT NULL,
  `class_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`std_id`, `std_name`, `addess`, `email`, `contact_no`, `class_id`) VALUES
(2, 'ffdgdf', 'dsf', 'sdsggsdg', 1234567890, 'CLS001'),
(3, 'sd', 'sdfsd', 'fsdsdssd', 1234567890, 'CLS001'),
(5, 'sfds', 'dfgdf', 'dfgdf', 1234321234, 'CLS003'),
(7, 'ddsfs', 'gdfgd', 'ino@gmail.com', 771234567, 'CLS003'),
(8, 'test', 'test', 'test@gmail.com', 1234567890, 'CLS001'),
(9, 'dsfsd', 'dsfds', 'test@gmail.com', 1234567890, 'CLS003'),
(10, 'asdasd', 'dfd', 'test@gmail.com', 1234567890, 'CLS003');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `sub_id` int(11) NOT NULL,
  `sub_code` varchar(10) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `ins_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`sub_id`, `sub_code`, `sub_name`, `ins_id`) VALUES
(1, 'CS001', 'architecture', 3),
(2, 'BM001', 'business process', 1),
(3, 'CS002', 'sgggd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_name`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`cls_id`);

--
-- Indexes for table `tbl_class_subjects`
--
ALTER TABLE `tbl_class_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `cls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_class_subjects`
--
ALTER TABLE `tbl_class_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
