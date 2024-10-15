-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 02:02 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gfedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admint`
--

CREATE TABLE `admint` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Fname` varchar(30) NOT NULL,
  `Admin_Lname` varchar(30) NOT NULL,
  `Admin_Email` varchar(70) NOT NULL,
  `Admin_Pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admint`
--

INSERT INTO `admint` (`Admin_ID`, `Admin_Fname`, `Admin_Lname`, `Admin_Email`, `Admin_Pass`) VALUES
(11111, 'Ghaida', 'Alghamdi', 'Ghaida@gmail.com', 'Ghaida1234');

-- --------------------------------------------------------

--
-- Table structure for table `assit`
--

CREATE TABLE `assit` (
  `Assi_ID` int(11) NOT NULL,
  `Assi_Title` varchar(60) NOT NULL,
  `Assi_Des` varchar(70) DEFAULT NULL,
  `Assi_File` varchar(100) NOT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Teacher_ID` int(11) DEFAULT NULL,
  `Course_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courset`
--

CREATE TABLE `courset` (
  `Course_ID` int(11) NOT NULL,
  `Course_Title` varchar(60) NOT NULL,
  `Admin_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studentt`
--

CREATE TABLE `studentt` (
  `Student_ID` int(11) NOT NULL,
  `Student_Fname` varchar(20) NOT NULL,
  `Student_Lname` varchar(20) NOT NULL,
  `Student_Email` varchar(60) NOT NULL,
  `Student_Pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentt`
--

INSERT INTO `studentt` (`Student_ID`, `Student_Fname`, `Student_Lname`, `Student_Email`, `Student_Pass`) VALUES
(1, 'Lana', 'Alghamdi', 'Lana@g.com', 'Lana1234'),
(2, 'Rahaf', 'Alghamdi', 'Rahaf@x.com', 'Rahaf1234'),
(21, 'Ahmed', 'Alghamdi', 'Ahmed@x.com', 'Ahmed1234'),
(22, 'Amal', 'Alghamdi', 'Amal@gmail.com', 'Amal1234'),
(23, 'Amal', 'Student_Lname', 'Student_Email', 'Amal1234'),
(24, 'Amal', 'Student_Lname', 'Student_Email', 'Amal1234'),
(25, 'Amal', 'Alghamdi', 'Amal@gmail.com', 'Amal1234');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Teacher_ID` int(11) NOT NULL,
  `Teacher_Fname` varchar(60) NOT NULL,
  `Teacher_Lname` varchar(60) NOT NULL,
  `Teacher_Email` varchar(80) NOT NULL,
  `Teacher_Pass` varchar(30) NOT NULL,
  `Course_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testt`
--

CREATE TABLE `testt` (
  `Test_ID` int(11) NOT NULL,
  `Test_Title` varchar(60) NOT NULL,
  `Test_Des` varchar(70) DEFAULT NULL,
  `Test_File` varchar(100) NOT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Teacher_ID` int(11) DEFAULT NULL,
  `Course_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','teacher','student') NOT NULL DEFAULT 'student',
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `user_type`, `course_id`) VALUES
(1, 'Super', 'Admin', 'admin@gmail.com', '4297f44b13955235245b2497399d7a93', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admint`
--
ALTER TABLE `admint`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `assit`
--
ALTER TABLE `assit`
  ADD PRIMARY KEY (`Assi_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`),
  ADD KEY `Course_ID` (`Course_ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courset`
--
ALTER TABLE `courset`
  ADD PRIMARY KEY (`Course_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `studentt`
--
ALTER TABLE `studentt`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Teacher_ID`),
  ADD KEY `Course_ID` (`Course_ID`);

--
-- Indexes for table `testt`
--
ALTER TABLE `testt`
  ADD PRIMARY KEY (`Test_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`),
  ADD KEY `Course_ID` (`Course_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admint`
--
ALTER TABLE `admint`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11113;

--
-- AUTO_INCREMENT for table `assit`
--
ALTER TABLE `assit`
  MODIFY `Assi_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courset`
--
ALTER TABLE `courset`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentt`
--
ALTER TABLE `studentt`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Teacher_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testt`
--
ALTER TABLE `testt`
  MODIFY `Test_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assit`
--
ALTER TABLE `assit`
  ADD CONSTRAINT `assit_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `studentt` (`Student_ID`),
  ADD CONSTRAINT `assit_ibfk_2` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`Teacher_ID`),
  ADD CONSTRAINT `assit_ibfk_3` FOREIGN KEY (`Course_ID`) REFERENCES `courset` (`Course_ID`);

--
-- Constraints for table `courset`
--
ALTER TABLE `courset`
  ADD CONSTRAINT `courset_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `admint` (`Admin_ID`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `courset` (`Course_ID`);

--
-- Constraints for table `testt`
--
ALTER TABLE `testt`
  ADD CONSTRAINT `testt_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `studentt` (`Student_ID`),
  ADD CONSTRAINT `testt_ibfk_2` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`Teacher_ID`),
  ADD CONSTRAINT `testt_ibfk_3` FOREIGN KEY (`Course_ID`) REFERENCES `courset` (`Course_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
