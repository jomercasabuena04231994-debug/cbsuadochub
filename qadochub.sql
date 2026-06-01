-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 10:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qadochub`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(10) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `date_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(10) NOT NULL,
  `college_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`) VALUES
(1, 'College of Agriculture and Natural Resources'),
(5, 'College of Arts and Letters'),
(6, 'College of Engineering and Food Science'),
(9, 'College of Medicine'),
(10, 'College of Law');

-- --------------------------------------------------------

--
-- Table structure for table `programoffereing`
--

CREATE TABLE `programoffereing` (
  `prog_id` int(10) NOT NULL,
  `prog_college` varchar(50) NOT NULL,
  `prog_name` varchar(50) NOT NULL,
  `prog_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programoffereing`
--

INSERT INTO `programoffereing` (`prog_id`, `prog_college`, `prog_name`, `prog_level`) VALUES
(1, 'College of Development Education', 'Bachelor of Elementary Education', 'Level IV'),
(2, 'College of Development Education', 'Bachelor of Secondary Education', 'Level IV'),
(3, 'College of Arts and Sciences', 'Bachelor of Science in Environmental Science', 'Level IV'),
(4, 'College of Arts and Sciences', 'Bachelor of Science in Biology', 'Level III'),
(5, 'College of Agriculture and Natural Resources', 'Bachelor of Science in Agriculture', 'Level IV'),
(6, 'College of Agriculture and Natural Resources', 'Bachelor of Science in Agroforestry', 'Level IV'),
(8, 'College of Economics and Management', 'Bachelor of Science in Tourism Management', 'Level III'),
(9, 'College of Economics and Management', 'Bachelor of Science in Agribusiness', 'Level III'),
(10, 'College of Engineering and Food Science', 'Bachelor of Science in Agricultural and Biosystems', 'Level IV'),
(11, 'College of Engineering and Food Science', 'Bachelor of Science on Food Technology', 'Level IV'),
(13, 'College of Agriculture and Natural Resources', 'Bachelor of Agricultural Technology', 'Level III'),
(14, 'College of Health Sciences', 'Bachelor of Science in Nursing', 'Level I'),
(15, 'College of Accountancy and Finance', 'Bachelor of Science in Accountancy', 'Level II'),
(18, 'College of Industrial Technology', 'Bachelor of Science in Electronics', 'Level I'),
(19, 'College of Agriculture and Natural Resources', 'BS Environmental Science', 'Level I'),
(21, 'College of Medicine', 'Doctor of Medicine', 'Level I');

-- --------------------------------------------------------

--
-- Table structure for table `qadocument`
--

CREATE TABLE `qadocument` (
  `doc_id` int(10) NOT NULL,
  `doc_area` varchar(10) NOT NULL,
  `doc_title` varchar(50) NOT NULL,
  `doc_type` varchar(50) NOT NULL,
  `docuploadedby` varchar(50) NOT NULL,
  `doc_timeupload` date NOT NULL,
  `doc_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qadocument`
--

INSERT INTO `qadocument` (`doc_id`, `doc_area`, `doc_title`, `doc_type`, `docuploadedby`, `doc_timeupload`, `doc_file`) VALUES
(52, 'Area 2', 'Area 1', 'Policy', 'Casabuena, Jomer O.', '2025-12-11', 'Lesson 6 - Parts of the System Unit.pdf'),
(57, '0', 'QS', 'Guideline', 'Jomer O. Casabuena', '2025-12-10', 'doc_6939b396033736.87014555.pdf'),
(58, 'Area 2', 'Quality Manual', 'Policy', 'Casabuena Jomer', '2025-12-10', 'doc_6939b3d6ca9831.22204410.pdf'),
(84, '2', 'Sample2', 'Manual', 'Casabuena, Jomer O.', '2025-12-13', 'doc_693ccac0ab8a10.75965307.pdf'),
(85, '1', 'Sample Today', 'Policy', 'Casabuena Jomer', '2026-04-27', 'doc_69eef2de999dc0.35130218.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `qadocument2`
--

CREATE TABLE `qadocument2` (
  `doc_id2` int(10) NOT NULL,
  `doc_title2` varchar(50) NOT NULL,
  `doc_type2` varchar(50) NOT NULL,
  `docuploadedBy2` varchar(50) NOT NULL,
  `doc_timeupload2` date NOT NULL,
  `doc_file2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qadocument2`
--

INSERT INTO `qadocument2` (`doc_id2`, `doc_title2`, `doc_type2`, `docuploadedBy2`, `doc_timeupload2`, `doc_file2`) VALUES
(1, 'Documents 2', 'Documents 2', 'Documents 2', '0000-00-00', 'Documents 2'),
(3, 'Area 2', 'Guideline', 'Casabuena, Jomer O.', '2025-12-11', 'Lesson 7 - Computer Data Representation.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` int(25) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_initial` varchar(1) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `last_name`, `first_name`, `middle_initial`, `email_address`, `username`, `password`, `role`, `department`) VALUES
(37, 'Casabuena', 'Jomer', 'O', 'jcasabuena@gbox.edu.ph', 'admin', 'admin', 'Accreditor', 'GED'),
(46, 'Paniterce', 'Arelene April', 'T', 'arleneapril.paniterce@cbsua.edu.ph', 'arlene', 'arlene', 'Accreditor', 'CAS-GED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`),
  ADD UNIQUE KEY `announcement_id` (`announcement_id`,`title`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `programoffereing`
--
ALTER TABLE `programoffereing`
  ADD PRIMARY KEY (`prog_id`);

--
-- Indexes for table `qadocument`
--
ALTER TABLE `qadocument`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `qadocument2`
--
ALTER TABLE `qadocument2`
  ADD PRIMARY KEY (`doc_id2`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `programoffereing`
--
ALTER TABLE `programoffereing`
  MODIFY `prog_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `qadocument`
--
ALTER TABLE `qadocument`
  MODIFY `doc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `qadocument2`
--
ALTER TABLE `qadocument2`
  MODIFY `doc_id2` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
