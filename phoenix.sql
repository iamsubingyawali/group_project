-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2020 at 04:35 PM
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
(2, 'subinA', '$2y$10$FySjfHZfaujBgdQmtDOHlOT3GAaLYRVOhbQqb4dcfgrYqRh8afP/S', 'Subin', 'Gyawali', 'subingyawali@gmail.com');

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

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`ann_id`, `announcement`, `date`, `course_id`, `stf_id`) VALUES
(1, 'Content Added', '2020-02-03 14:07:58', 8, 20002),
(2, 'Files Uploaded', '2020-02-03 14:42:04', 8, 20002),
(3, 'Assessment Added', '2020-02-03 14:46:58', 8, 20002),
(4, 'Content Added', '2020-02-06 14:33:33', 18, 20002),
(5, 'Content Added', '2020-02-06 14:33:33', 18, 20002),
(6, 'Content Added', '2020-02-06 14:33:33', 18, 20002);

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

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`assess_id`, `description`, `deadline`, `file`, `course_id`, `stf_id`) VALUES
(7, 'This is First Term Assignment. Project Brief is attached below. Please Read Carefully and complete the assignment within time.', '2020-02-29 12:59:59', 'group3_report.pdf', 8, 20002);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attend_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `course_id` int(10) NOT NULL,
  `std_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attend_id`, `date`, `status`, `course_id`, `std_id`) VALUES
(21, '2020-02-06', 'Present', 8, 20202),
(22, '2020-02-06', 'Present', 8, 20203),
(23, '2020-02-06', 'Present', 8, 20207),
(24, '2020-02-06', 'Absent', 8, 20204),
(25, '2020-02-07', 'Present', 8, 20204),
(26, '2020-02-07', 'Present', 8, 20202),
(27, '2020-02-07', 'Present', 8, 20203),
(28, '2020-02-07', 'Present', 8, 20207),
(29, '2020-02-05', 'Present', 8, 20207),
(30, '2020-02-05', 'Absent', 8, 20204),
(31, '2020-02-05', 'Absent', 8, 20202),
(32, '2020-02-05', 'Absent', 8, 20203),
(33, '2020-02-08', 'Absent', 8, 20204),
(34, '2020-02-08', 'Absent', 8, 20202),
(35, '2020-02-08', 'Absent', 8, 20203),
(36, '2020-02-08', 'Absent', 8, 20207);

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
(1, 'Computer Networks'),
(2, 'Operating Systems'),
(3, 'Modern Networks'),
(5, 'Computer Communications'),
(6, 'Computer Systems'),
(8, 'Web Programming'),
(9, 'Database'),
(11, 'Group Project'),
(12, 'Problem Solving'),
(14, 'Database 2'),
(18, 'Web Development'),
(21, 'Accounting');

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

--
-- Dumping data for table `course_topics`
--

INSERT INTO `course_topics` (`topic_id`, `topic_num`, `name`, `course_id`) VALUES
(1, 1, 'Server Setup and PHP Introduction', 8),
(2, 2, 'Control Structures and Loops', 8),
(3, 3, 'Functions', 8),
(4, 4, 'Arrays and User Input', 8),
(5, 5, 'Introduction to MySQL', 8),
(6, 6, 'Server Setup and PHP Introduction', 8),
(28, 7, 'Testing', 8),
(29, 1, 'Introduction', 18);

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

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `name`, `stf_id`, `course_id`, `topic_id`) VALUES
(9, '13-proposal-marking grid (2).doc', 20002, 8, 1),
(10, 'Copy of Gantt example (gantt(1).xls)-1.xls', 20002, 8, 1),
(11, 'Introduction-to-project-management(1).ppt', 20002, 8, 1),
(12, 'Project Proposal(1).docx', 20002, 8, 1),
(13, 'ProjectProposal Group Project 2013.docx', 20002, 8, 1),
(14, 'Skills Analysis Sheet (GP).doc', 20002, 8, 1),
(16, 'Introduction-to-project-management(1).ppt', 20002, 8, 3),
(18, 'ProjectProposal Group Project 2013.docx', 20002, 8, 3),
(49, 'group3_report.pdf', 20002, 8, 28),
(50, 'group3_report.pdf', 20002, 8, 2),
(51, 'Screenshot (49).png', 20002, 18, 29),
(52, 'Screenshot (50).png', 20002, 18, 29),
(53, 'Screenshot (51).png', 20002, 18, 29);

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

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grade`, `marks`, `date`, `std_id`, `course_id`) VALUES
(1, 'A+', 89, '2020-02-04 09:02:31', 20204, 8),
(2, 'A-', 70, '2020-02-04 09:02:37', 20204, 8),
(3, 'G', 0, '2020-02-04 09:03:51', 20204, 8),
(4, '-', 110, '2020-02-04 09:04:02', 20204, 8),
(5, 'A+', 100, '2020-02-04 09:04:32', 20204, 8),
(6, 'A+', 90, '2020-02-04 09:07:55', 20203, 8),
(7, 'A+', 90, '2020-02-04 09:08:01', 20204, 8);

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
(1, 'Network Engineering'),
(2, 'Software Engineering'),
(3, 'BBA'),
(4, 'MBA'),
(5, 'Environmental Science'),
(6, 'A-Level');

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
(1, 5),
(1, 1),
(1, 9),
(1, 11),
(1, 3),
(2, 14),
(1, 9),
(2, 18);

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
(20001, 'Deepak', 'Karna', 'deepak.karna@gmail.com', '9810111213', '1880-08-08', 'Male', 'Jorpati', '$2y$10$vJjMDKpb235LkSAZmRR9yudmWGoQuVNM4o/qGmunM7jEkudv6Dkei', 'default.png'),
(20002, 'Ganesh', 'Khatri', 'ganesh.khatri@gmail.com', '9848737286', '1890-09-19', 'Male', 'Thapagaun', '$2y$10$xDhRG8BxfmqLgLrF36y0QuaQiw4mpL9FzJ4Te.bO/FKAFz974SYyu', '5e415f39211b74.81479658.jpg'),
(20003, 'Niresh', 'Dhakal', 'niresh@gmail.com', '9821912151', '2020-02-14', 'Male', 'Narayantar', '$2y$10$ddTP6aiccwKC6NdluqoBheWL8eZ5hMNvGrWf5YGM56yHpQAuV7nmC', '5e3a5848127cc2.37727395.jpg');

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
(20002, 8),
(20001, 2),
(20001, 11),
(20003, 2),
(20001, 3),
(20002, 18);

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
(20202, 5),
(20202, 9),
(20204, 6),
(20203, 6),
(20203, 8),
(20204, 11),
(20202, 11),
(20203, 11),
(20204, 8),
(20204, 8),
(20202, 8),
(20207, 8),
(20203, 18);

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
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`upd_id`, `std_id`, `course_id`, `file`) VALUES
(20, 20203, 8, 'group3_report.pdf'),
(23, 20203, 8, 'CSY2027 Group Project Body-2014-15(1)(1).doc');

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
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `ann_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `assess_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attend_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `course_topics`
--
ALTER TABLE `course_topics`
  MODIFY `topic_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `stf_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20005;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `std_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20209;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `upd_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
