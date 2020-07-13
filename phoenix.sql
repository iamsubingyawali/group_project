-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 12:05 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phoenix`
--
CREATE DATABASE IF NOT EXISTS `phoenix` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phoenix`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `firstname`, `surname`, `email`) VALUES
(1, 'admin', '$2y$10$j7EjJnYGCHTFmoBDZ.lvV.UvpDoWq3.GiQiTLP/4PdyzUOiLBDBiS', 'Admin', 'Admin', 'admin@admin.com'),
(4, 'subin', '$2y$10$duOPvEhRBYAQV/8sh3Hx0Omd2IknvLUVrFqostchzMV19jyvm2QYK', 'Subin', 'Gyawali', 'subin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `ann_id` int(10) NOT NULL,
  `announcement` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `course_id` int(10) NOT NULL,
  `stf_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `assess_id` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` datetime NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `course_id` int(10) NOT NULL,
  `stf_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attend_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Absent',
  `course_id` int(10) NOT NULL,
  `std_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `title`) VALUES
(23, 'Computer Networks'),
(24, 'Operating Systems'),
(25, 'Database'),
(26, 'Modern Networks'),
(27, 'Web Programming'),
(28, 'Web Development');

-- --------------------------------------------------------

--
-- Table structure for table `course_topics`
--

CREATE TABLE `course_topics` (
  `topic_id` int(10) NOT NULL,
  `topic_num` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stf_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `topic_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(10) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `marks` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `std_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `name`) VALUES
(10, 'Computing'),
(11, 'BBA'),
(12, 'MBA'),
(13, 'Software Engineering'),
(14, 'Network Engineering'),
(15, 'A Level');

-- --------------------------------------------------------

--
-- Table structure for table `program_courses`
--

CREATE TABLE `program_courses` (
  `program_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_courses`
--

INSERT INTO `program_courses` (`program_id`, `course_id`) VALUES
(13, 25),
(14, 23),
(14, 24),
(14, 25),
(14, 27),
(13, 27);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `stf_id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`stf_id`, `firstname`, `surname`, `email`, `phone`, `birthdate`, `gender`, `address`, `password`, `profile_img`) VALUES
(20001, 'Deepak', 'Karna', 'deepak.karna@gmail.com', '0000000', '1880-08-08', 'Male', 'Jorpati', '$2y$10$vJjMDKpb235LkSAZmRR9yudmWGoQuVNM4o/qGmunM7jEkudv6Dkei', '5f0c2fb1ef31b2.50541877.jpg'),
(20002, 'Ganesh', 'Khatri', 'ganesh.khatri@gmail.com', '0000000', '1890-09-19', 'Male', 'Thapagaun', '$2y$10$xDhRG8BxfmqLgLrF36y0QuaQiw4mpL9FzJ4Te.bO/FKAFz974SYyu', '5e415f39211b74.81479658.jpg'),
(20003, 'Niresh', 'Dhakal', 'niresh@gmail.com', '0000000', '2020-02-14', 'Male', 'Narayantar', '$2y$10$ddTP6aiccwKC6NdluqoBheWL8eZ5hMNvGrWf5YGM56yHpQAuV7nmC', '5e3a5848127cc2.37727395.jpg'),
(20008, 'Indra', 'Basnet', 'indra.basnet@gmail.com', '0000000', '2020-07-17', 'Male', 'Kathmandu', '$2y$10$MzWCnZaGCmqS7URiQzpu8unjuzNNfUnRLxW44jUQMaEC0sn1SIF.K', '5f0c2f5486a594.93584094.jpeg'),
(20009, 'Khagendra', 'Shah', 'khshah@gmail.com', '0000000', '2020-06-10', 'Male', 'Kathmandu', '$2y$10$c.xPfu7EQIK/IKK4byuTYO/nn3a65jcamaV10sO2pXJT.TXmreqNW', '5f0c2f2362f158.79950763.jpg'),
(20010, 'Anita', 'Gurung', 'anita@gmail.com', '0000000', '2020-06-01', 'Female', 'Kathmandu', '$2y$10$RV93oiBCaQFGnzND5dtNQ.eX66q9wZHQKQf5YG7VgLRAXmuU1yNzW', '5f0c2e70d4a715.89879565.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff_courses`
--

CREATE TABLE `staff_courses` (
  `stf_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_courses`
--

INSERT INTO `staff_courses` (`stf_id`, `course_id`) VALUES
(20002, 27),
(20002, 28),
(20003, 24),
(20008, 23),
(20001, 23),
(20010, 25),
(20009, 26);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `std_id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`std_id`, `firstname`, `surname`, `email`, `phone`, `birthdate`, `gender`, `address`, `password`, `profile_img`) VALUES
(20202, 'Nitesh', 'Ghimire', 'nitesh.ghimire2@gmail.com', '9844416811', '1890-09-09', 'Male', 'Narayantar', '$2y$10$yH/d2HvYDGqDJP9BpEARSu5JHDwgMgnRt1Hi1hX2wknMgKiwr/gRu', 'default.png'),
(20203, 'Paribhasha', 'Pradhan', 'paridhan.bannu@gmail.com', '9843805170', '1890-09-09', 'Female', 'Narayantar', '$2y$10$yd6J8BA2E46FeZ20/XWj6.u0OZr8CBk46klHmpSabOqq6acV/VGhi', '5e330e21286886.56515809.jpeg'),
(20204, 'Dijee', 'Lama', 'dijee190@gmail.com', '9860942421', '1890-09-09', 'Female', 'Bouddha', '$2y$10$QO0WqU0cYWamnDI9.suAHuOLs6UnNJN6Ft4LluOPHNNoEBMGMz/2m', '5e331a926fed46.43618740.jpg'),
(20207, 'Subin', 'Gyawali', 'subingyawali@gmail.com', '9821912151', '1999-06-08', 'Male', 'Ratopul', '$2y$10$pugV1seYEOJqLARdI3JN/.YEWnhd.v9WfWdiQFirPwSup7i20aVVi', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `std_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`std_id`, `course_id`) VALUES
(20204, 23),
(20202, 23),
(20203, 23),
(20207, 23),
(20204, 24),
(20202, 24),
(20203, 24),
(20207, 24),
(20204, 25),
(20202, 25),
(20203, 25),
(20207, 25);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `upd_id` int(10) NOT NULL,
  `std_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`ann_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `stf_id` (`stf_id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`assess_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `stf_id` (`stf_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attend_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_topics`
--
ALTER TABLE `course_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `course_topics_ibfk_1` (`course_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `stf_id` (`stf_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `grades_ibfk_1` (`course_id`),
  ADD KEY `grades_ibfk_2` (`std_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `program_courses`
--
ALTER TABLE `program_courses`
  ADD KEY `program_courses_ibfk_1` (`course_id`),
  ADD KEY `program_courses_ibfk_2` (`program_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`stf_id`),
  ADD KEY `stf_id` (`stf_id`);

--
-- Indexes for table `staff_courses`
--
ALTER TABLE `staff_courses`
  ADD KEY `staff_courses_ibfk_1` (`stf_id`),
  ADD KEY `staff_courses_ibfk_2` (`course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD KEY `student_courses_ibfk_1` (`std_id`),
  ADD KEY `student_courses_ibfk_2` (`course_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`upd_id`),
  ADD KEY `uploads_ibfk_1` (`std_id`),
  ADD KEY `uploads_ibfk_2` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `ann_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `assess_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attend_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `course_topics`
--
ALTER TABLE `course_topics`
  MODIFY `topic_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `stf_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20011;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `std_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20211;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `upd_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `announcements_ibfk_2` FOREIGN KEY (`stf_id`) REFERENCES `staffs` (`stf_id`);

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `assessments_ibfk_2` FOREIGN KEY (`stf_id`) REFERENCES `staffs` (`stf_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `students` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_topics`
--
ALTER TABLE `course_topics`
  ADD CONSTRAINT `course_topics_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`stf_id`) REFERENCES `staffs` (`stf_id`),
  ADD CONSTRAINT `files_ibfk_3` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`topic_id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `students` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program_courses`
--
ALTER TABLE `program_courses`
  ADD CONSTRAINT `program_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `program_courses_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_courses`
--
ALTER TABLE `staff_courses`
  ADD CONSTRAINT `staff_courses_ibfk_1` FOREIGN KEY (`stf_id`) REFERENCES `staffs` (`stf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uploads_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
