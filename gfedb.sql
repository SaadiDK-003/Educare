-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 03:38 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_courses` ()  SELECT
c.id AS 'course_id',
c.course_title,
c.course_desc,
cat.category_name 
FROM courses c
INNER JOIN categories cat
ON c.cat_id = cat.id
ORDER BY cat.category_name, c.course_title$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_courses_by_teacher_id` (IN `teacher_id` INT)  SELECT
c.id AS 'course_id',
c.course_title,
c.course_desc,
c.cat_id
FROM courses c
INNER JOIN users u
WHERE c.teacher_Id=u.id AND c.teacher_Id=teacher_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_course_by_cat_id` (IN `cat_id` INT)  SELECT
c.id AS 'course_id',
c.course_title,
c.course_desc,
cat.category_name
FROM courses c
INNER JOIN categories cat
ON c.cat_id = cat.id
WHERE c.cat_id=cat_id
ORDER BY cat.category_name, c.course_title$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Web Development'),
(2, 'Data Science'),
(3, 'Digital Marketing'),
(4, 'Graphic Design'),
(5, 'Artifical Intelligence'),
(6, 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `course_desc` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `teacher_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `course_desc`, `cat_id`, `teacher_Id`) VALUES
(2, 'HTML & CSS Basics', 'Learn HTML & CSS with very easy step by step tutorials.', 1, 3),
(15, 'Vector Arts Basics', 'Learn Vector arts and kjaslkdjlkjlkasd klajsdklaj klasjdlkasdj lkasjdklasjdklsadjaslkdasldkasljdkl', 4, 3),
(16, 'JavaScript Basics', 'Learn JS', 1, 4);

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
(1, 'Super', 'Admin', 'admin@gmail.com', '4297f44b13955235245b2497399d7a93', 'admin', NULL),
(3, 'teacher1', 'abc', 'teacher@gmail.com', '4297f44b13955235245b2497399d7a93', 'teacher', NULL),
(4, 'teacher2', 'test', 'teacher1@gmail.com', '4297f44b13955235245b2497399d7a93', 'teacher', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `teacher_Id` (`teacher_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`teacher_Id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
