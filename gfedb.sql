-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 12:18 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_teachers` ()  SELECT
    u.fname,
    u.lname,
    u.email,
    u.bio,
    GROUP_CONCAT(cat.category_name SEPARATOR ' | ') AS category_names
FROM
    users u
INNER JOIN courses c ON u.id = c.teacher_Id
INNER JOIN categories cat ON c.cat_id = cat.id
GROUP BY
    u.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_asgmt_by_course_id` (IN `course_id` INT)  SELECT
a.id AS 'asgmt_id',
a.asgmt_title,
a.asgmt_desc,
a.asgmt_file,
a.teacher_id,
a.course_id,
c.course_title
FROM assignments a
INNER JOIN courses c
WHERE a.course_id=c.id AND a.course_id=course_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_asgmt_by_teacher_id` (IN `teacher_id` INT)  SELECT
a.id AS 'asgmt_id',
a.asgmt_title,
a.asgmt_desc,
a.asgmt_file,
a.teacher_id,
a.course_id
FROM assignments a
INNER JOIN users u
WHERE a.teacher_id=u.id AND a.teacher_id=teacher_id$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_teachers_by_course_id` (IN `course_id` INT)  SELECT
u.id AS 'teacher_id',
u.fname,
u.lname,
u.email,
u.bio
FROM users u
INNER JOIN courses c
WHERE u.id = c.teacher_Id AND c.id=course_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_test_by_course_id` (IN `course_id` INT)  SELECT
t.id AS 'test_id',
t.test_title,
t.test_desc,
t.test_file,
t.teacher_id,
t.course_id,
c.course_title
FROM tests t
INNER JOIN courses c
WHERE t.course_id=c.id AND t.course_id=course_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_test_by_teacher_id` (IN `teacher_id` INT)  SELECT
t.id AS 'test_id',
t.test_title,
t.test_desc,
t.test_file,
t.teacher_id,
t.course_id
FROM tests t
INNER JOIN users u
WHERE t.teacher_id=u.id AND t.teacher_id=teacher_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `asgmt_title` varchar(255) NOT NULL,
  `asgmt_desc` text NOT NULL,
  `asgmt_file` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `asgmt_title`, `asgmt_desc`, `asgmt_file`, `teacher_id`, `course_id`) VALUES
(6, 'HTML Assignment', 'create a login / register page.', 'asgmt_just_cause_3.pdf', 3, 26);

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
(26, 'HTML & CSS Basics', 'Learn HTML & CSS step by step.', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test_title` varchar(255) NOT NULL,
  `test_desc` varchar(255) NOT NULL,
  `test_file` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_title`, `test_desc`, `test_file`, `teacher_id`, `course_id`) VALUES
(9, 'HTML Basics test', '10 quest paper.', 'abcddd.pdf', 3, 26);

-- --------------------------------------------------------

--
-- Table structure for table `upload_tests`
--

CREATE TABLE `upload_tests` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `uploaded_file` text NOT NULL,
  `status` enum('in-review','correct','incorrect','reject') NOT NULL DEFAULT 'in-review'
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
  `bio` text DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `user_type`, `bio`, `course_id`) VALUES
(1, 'Super', 'Admin', 'admin@gmail.com', '4297f44b13955235245b2497399d7a93', 'admin', NULL, NULL),
(3, 'ola', 'innocent', 'teacher@gmail.com', '4297f44b13955235245b2497399d7a93', 'teacher', 'I am teaching since 2018', NULL),
(4, 'Sana', 'sharjeel', 'teacher1@gmail.com', '4297f44b13955235245b2497399d7a93', 'teacher', NULL, NULL),
(5, 'jamal', 'hasnain', 'student@gmail.com', '4297f44b13955235245b2497399d7a93', 'student', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`);

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
  ADD KEY `teacher_Id` (`teacher_Id`),
  ADD KEY `courses_ibfk_1` (`cat_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `upload_tests`
--
ALTER TABLE `upload_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `upload_tests`
--
ALTER TABLE `upload_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`teacher_Id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
