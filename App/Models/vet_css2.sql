-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2017 at 06:11 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vet_css`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(4) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `first_name`, `last_name`, `remark`) VALUES
(1, 'John', 'Bandara', 'Math instructor'),
(2, 'Paul', 'Al-Balushi', 'PolSci instructor'),
(3, 'James', 'Ignatius', 'English instructo'),
(4, 'Peter', 'Eulogio', 'Bio instructor');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'First post', 'This is a really interesting post.', '2017-01-04 12:50:45'),
(2, 'Second post', 'This is a fascinating post!', '2017-01-04 12:50:45'),
(3, 'Third post', 'This is a very informative post.', '2017-01-04 12:50:45'),
(4, 'جديدTest Post', '2016-17 NBA season Full Game Highlights NBATV HD Live Stream Streaming 720p Youtube Official ChannelÑñ', '2017-01-30 12:40:21'),
(63, 'update', 'update 63 63 63 ', '2017-02-11 11:30:49'),
(64, 'update', 'update 63 63 63 ', '2017-02-11 11:43:48'),
(65, 'update', 'updateupdate 63 63 63 ', '2017-02-11 12:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(4) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('classroom','computer lab','drawing lab','workshop elc','workshop elx','workshop rac','workshop wld','workshop mec') COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `type`, `location`, `description`) VALUES
(1, 'Room 1', 'classroom', 'Bldg 1', NULL),
(2, 'ComLab 1', 'computer lab', 'Bldg 1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(4) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `required_period` int(4) NOT NULL COMMENT 'total number of periods required per week',
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `code`, `name`, `required_period`, `description`) VALUES
(1, 'MATH101', 'Basic Math', 2, 'Basic Math'),
(2, 'POLSCI101', 'Political Science', 2, 'Political Science'),
(3, 'ENGL101', 'Basic English', 4, 'Basic English');

-- --------------------------------------------------------

--
-- Table structure for table `subject_class`
--

CREATE TABLE `subject_class` (
  `id` int(4) NOT NULL,
  `timetable_id` int(4) NOT NULL,
  `subject_id` int(4) NOT NULL,
  `trainee_group_id` int(4) NOT NULL,
  `instructor_id` int(4) NOT NULL,
  `room_id` int(4) DEFAULT NULL,
  `meeting_time_id` int(4) DEFAULT NULL,
  `preferred_start_period` int(4) NOT NULL,
  `preferred_end_period` int(4) NOT NULL,
  `preferred_number_days` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(4) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  `term` int(4) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `year_start`, `year_end`, `term`, `remarks`) VALUES
(1, 2016, 2017, 1, 'testing 101');

-- --------------------------------------------------------

--
-- Table structure for table `trainee_group`
--

CREATE TABLE `trainee_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(50) CHARACTER SET utf8 NOT NULL,
  `level` int(4) NOT NULL,
  `remarks` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trainee_group`
--

INSERT INTO `trainee_group` (`id`, `name`, `section`, `level`, `remarks`) VALUES
(1, 'Electronics', 'Group A', 1, NULL),
(2, 'Mechtronics', 'Group A', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'admin@learn-mvc.dev', '$2y$10$LOKihHkxOKj4gXbH7yc5kOCQO/NpS1v7Yk6/TpEK/YtXQLP/udSjO'),
(2, 'user@learn-mvc.dev', '$2y$10$LOKihHkxOKj4gXbH7yc5kOCQO/NpS1v7Yk6/TpEK/YtXQLP/udSjO'),
(3, 'ercson@learn-mvc.dev', '$2y$10$yEVnvqwWzOATTCpHkjV0reb9xo9RYzjpWXBjKRU2qOSgHM3I0tzVa'),
(4, 'user1@learn-mvc.dev', '$2y$10$GMim4M4h9JOODjL7nG5CVeRsoOf6OtWO.dXVyfdzVYClm6h6/cWna'),
(5, 'user2@learn-mvc.dev', 'password'),
(6, 'user3@learn-mvc.dev', '$2y$10$mmH4E1M0bv5O1yNjNBfbMOoGK00coe97RiCMlku7O95FPjFxHx056'),
(7, 'user4@learn-mvc.dev', '$2y$10$p2rv90RC.eihJVoWWToYvu8ypJdyCcR/ol8n.IgfUz82RCq3Tmum2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD PRIMARY KEY (`id`),
  ADD INDEX KEY `subject_id` (`subject_id`),
  ADD INDEX KEY `trainee_group_id` (`trainee_group_id`),
  ADD INDEX KEY `instructor_id` (`instructor_id`),
  ADD INDEX KEY `room_id` (`room_id`),
  ADD INDEX KEY `meeting_time_id` (`meeting_time_id`),
  ADD INDEX KEY `timetable_id` (`timetable_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainee_group`
--
ALTER TABLE `trainee_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trainee_group`
--
ALTER TABLE `trainee_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD CONSTRAINT `SubjectClassInstructor` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SubjectClassRoom` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SubjectClassSubject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SubjectClassTimetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SubjectClassTraineeGroup` FOREIGN KEY (`trainee_group_id`) REFERENCES `trainee_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
