-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2017 at 03:45 AM
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
  `id_number` int(10) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `id_number`, `first_name`, `last_name`, `note`) VALUES
(1, 2017001, 'Study', 'Break', 'BRK Study Break'),
(2, 2017002, 'Abdulaziz', 'Abid Galm Al Hinai', 'ELC - Instructor'),
(3, 2017003, 'Abdulaziz', 'Jumah Al Shamaki', 'RAC - Instructor'),
(4, 2017004, 'Abdullah', 'Maher.Abdullah', 'ELC - Instructor'),
(5, 2017005, 'Abdurahiman', 'Puthan', 'ENG - Instructor'),
(6, 2017006, 'Ahmed', 'Mahsob', 'BUS - Instructor'),
(7, 2017007, 'Ahmed', 'AL-Maqbali', 'ENG - Instructor'),
(8, 2017008, 'Ali', 'Mohammed Ali Salih', 'ENG - Instructor'),
(9, 2017009, 'Ammar', 'Bin Mosbah', 'MECH - Instructor'),
(10, 2017010, 'antonio', 'Buca', 'PHY - Instructor'),
(11, 2017011, 'Aref', 'Al ajmi', 'ENG - Instructor'),
(12, 2017012, 'Asma', 'AL-', 'ENG - Instructor'),
(13, 2017013, 'Asma', 'Al Farsi', 'PHY - Instructor'),
(14, 2017014, 'Ayeesha', 'Yasmin', 'PHY - Instructor'),
(15, 2017015, 'Ayoub', 'Al Oufi', 'MATH - Instructor'),
(16, 2017016, 'Bilal', 'Al Arqenah', 'PHY - Instructor'),
(17, 2017017, 'Carlo', 'Romion', 'PE - Instructor'),
(18, 2017018, 'Conrado', 'Torres', 'ELX - Instructor'),
(19, 2017019, 'Ericson', 'Billedo', 'IT - Instructor'),
(20, 2017020, 'Euclid', 'Santiago', 'ELC - Instructor'),
(21, 2017021, 'Eulogio', 'Oderon', 'ELX - Instructor'),
(22, 2017022, 'Fatma', 'AL-Blushi', 'ENG - Instructor'),
(23, 2017023, 'Fatma', 'Al Balushi', 'IT - Instructor'),
(24, 2017024, 'Ghalib', 'Al Amri', 'MECH - Instructor'),
(25, 2017025, 'Hermogenes', 'Baculo', 'ELC - Instructor'),
(26, 2017026, 'Ibrahim', 'Saif Said Al Mawaali', 'ELC - Instructor'),
(27, 2017027, 'Ignatius', 'Rodrigues', 'ELC - Instructor'),
(28, 2017028, 'Jaffar', 'Al. Bahrani', 'MATH - Instructor'),
(29, 2017029, 'Jenier', 'Galarpe', 'WEL - Instructor'),
(30, 2017030, 'Julie', 'Mathew Senil', 'ENG - Instructor'),
(31, 2017031, 'Juluis', 'Dabon', 'RAC - Instructor'),
(32, 2017032, 'Kannan', 'subash chandra bose', 'DRW - Instructor'),
(33, 2017033, 'Karunadas', 'Parakunnath', 'ELC - Instructor'),
(34, 2017034, 'Macario', 'Barredo', 'MECH - Instructor'),
(35, 2017035, 'Mansoor', 'Al Balushi', 'ENG - Instructor'),
(36, 2017036, 'Marwan', 'ahmed. Almamari', 'ENG - Instructor'),
(37, 2017037, 'Maryam', 'AL-Mamary', 'ENG - Instructor'),
(38, 2017038, 'Mohammed', 'Mahmoud Saliem', 'BUS - Instructor'),
(39, 2017039, 'Mohammed', 'Nasser Abdullah Al Balushi', 'BUS - Instructor'),
(40, 2017040, 'Mohammed', 'Al-BAlushi', 'ENG - Instructor'),
(41, 2017041, 'Mohammed', 'Nabbhan Al Nabbhani', 'ENG - Instructor'),
(42, 2017042, 'Mohammed', 'ALNabhani', 'ENG - Instructor'),
(43, 2017043, 'Mohammed', 'Vaziruddin', 'MATH - Instructor'),
(44, 2017044, 'mohammed', 'al-basyuni al-said al qal youbi', 'RAC - Instructor'),
(45, 2017045, 'Mohammed', 'Ramdan Salim', 'WEL - Instructor'),
(46, 2017046, 'Mustafa', 'Metwally', 'DRW - Instructor'),
(47, 2017047, 'NAGAPAVAN', '.N', 'MATH - Instructor'),
(48, 2017048, 'Nasir', 'Al Hinai', 'MECH - Instructor'),
(49, 2017049, 'Norman', 'De Ocampo', 'RAC - Instructor'),
(50, 2017050, 'Osamah', 'Mohammad Ahmmad Al-Shobaki', 'RAC - Instructor'),
(51, 2017051, 'Dayanithi', 'Dayanithi', 'BUS - Instructor'),
(52, 2017052, 'Regina', 'Formaran', 'PE - Instructor'),
(53, 2017053, 'Rojesb', 'Chaladatb', 'DRW - Instructor'),
(54, 2017054, 'Rommel', 'A. Rosales', 'WEL - Instructor'),
(55, 2017055, 'Sajith', 'Bandara', 'IT - Instructor'),
(56, 2017056, 'Sheikha', 'Ali Said Al-Badi', 'IT - Instructor'),
(57, 2017057, 'Silpa', 'Sarah Abraham', 'ENG - Instructor'),
(58, 2017058, 'Taoufik', 'Ouelhazi', 'WEL - Instructor'),
(59, 2017059, 'Vara', 'Prasad Reddy Subbi Reddy', 'IT - Instructor'),
(60, 2017060, 'Vijaya', 'kumar', 'IT - Instructor'),
(61, 2017061, 'vinay', 'kumar', 'ENG - Instructor'),
(62, 2017062, 'William', 'Caniedo', 'ELX - Instructor'),
(63, 2017063, 'Fatma Mosa', 'Al-', 'BUS - Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(4) NOT NULL,
  `timetable_id` int(4) NOT NULL,
  `subject_class_id` int(4) NOT NULL,
  `trainee_group_id` int(4) NOT NULL,
  `subject_id` int(4) NOT NULL,
  `instructor_id` int(4) NOT NULL,
  `time_slot` int(4) DEFAULT NULL,
  `room_id` int(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `timetable_id`, `subject_class_id`, `trainee_group_id`, `subject_id`, `instructor_id`, `time_slot`, `room_id`, `timestamp`) VALUES
(1, 1, 1, 31, 18, 20, 32, 11, '2017-03-30 14:24:48'),
(2, 1, 1, 31, 18, 20, 33, 11, '2017-03-30 14:24:48'),
(3, 1, 1, 31, 18, 20, 34, 11, '2017-03-30 14:24:48'),
(4, 1, 1, 31, 18, 20, 24, 11, '2017-03-30 14:24:49'),
(5, 1, 1, 31, 18, 20, 25, 11, '2017-03-30 14:24:49'),
(6, 1, 1, 31, 18, 20, 8, 11, '2017-03-30 14:24:49'),
(7, 1, 1, 31, 18, 20, 9, 11, '2017-03-30 14:24:49'),
(8, 1, 1, 31, 18, 20, 10, 11, '2017-03-30 14:24:49'),
(9, 1, 1, 31, 18, 20, 2, 11, '2017-03-30 14:24:49'),
(10, 1, 1, 31, 18, 20, 3, 11, '2017-03-30 14:24:49'),
(11, 2, 2, 4, 2, 51, 4, 1, '2017-03-30 14:26:10'),
(12, 2, 2, 4, 2, 51, 5, 1, '2017-03-30 14:26:10'),
(13, 2, 2, 4, 2, 51, 26, 1, '2017-03-30 14:26:10'),
(14, 2, 2, 4, 2, 51, 27, 1, '2017-03-30 14:26:10'),
(15, 2, 2, 4, 2, 51, 8, 1, '2017-03-30 14:26:10'),
(16, 2, 2, 4, 2, 51, 9, 1, '2017-03-30 14:26:10'),
(60, 4, 4, 31, 18, 20, 33, 10, '2017-03-31 05:45:41'),
(61, 4, 4, 31, 18, 20, 34, 10, '2017-03-31 05:45:41'),
(62, 4, 4, 31, 18, 20, 26, 10, '2017-03-31 05:45:41'),
(63, 4, 4, 31, 18, 20, 27, 10, '2017-03-31 05:45:42'),
(64, 4, 4, 31, 18, 20, 0, 10, '2017-03-31 05:45:42'),
(65, 4, 4, 31, 18, 20, 1, 10, '2017-03-31 05:45:42'),
(66, 4, 4, 31, 18, 20, 2, 10, '2017-03-31 05:45:42'),
(67, 4, 4, 31, 18, 20, 16, 10, '2017-03-31 05:45:42'),
(68, 4, 4, 31, 18, 20, 17, 10, '2017-03-31 05:45:42'),
(69, 4, 4, 31, 18, 20, 18, 10, '2017-03-31 05:45:42'),
(70, 5, 5, 4, 2, 51, 3, 2, '2017-03-31 05:47:54'),
(71, 5, 5, 4, 2, 51, 4, 2, '2017-03-31 05:47:54'),
(72, 5, 5, 4, 2, 51, 33, 2, '2017-03-31 05:47:54'),
(73, 5, 5, 4, 2, 51, 34, 2, '2017-03-31 05:47:54'),
(74, 5, 5, 4, 2, 51, 21, 2, '2017-03-31 05:47:54'),
(75, 5, 5, 4, 2, 51, 22, 2, '2017-03-31 05:47:54'),
(76, 6, 6, 4, 2, 63, 35, 5, '2017-03-31 06:08:11'),
(77, 6, 6, 4, 2, 63, 36, 5, '2017-03-31 06:08:11'),
(78, 6, 6, 4, 2, 63, 11, 5, '2017-03-31 06:08:11'),
(79, 6, 6, 4, 2, 63, 12, 5, '2017-03-31 06:08:11'),
(80, 6, 6, 4, 2, 63, 6, 5, '2017-03-31 06:08:11'),
(81, 6, 6, 4, 2, 63, 7, 5, '2017-03-31 06:08:11'),
(82, 6, 7, 4, 4, 51, 4, 5, '2017-03-31 06:08:11'),
(83, 6, 7, 4, 4, 51, 5, 5, '2017-03-31 06:08:11'),
(84, 6, 7, 4, 4, 51, 8, 5, '2017-03-31 06:08:12'),
(85, 6, 7, 4, 4, 51, 9, 5, '2017-03-31 06:08:12'),
(86, 6, 7, 4, 4, 51, 24, 5, '2017-03-31 06:08:12'),
(87, 6, 7, 4, 4, 51, 25, 5, '2017-03-31 06:08:12'),
(88, 6, 8, 4, 48, 47, 2, 5, '2017-03-31 06:08:12'),
(89, 6, 8, 4, 48, 47, 3, 5, '2017-03-31 06:08:12'),
(90, 6, 8, 4, 48, 47, 33, 5, '2017-03-31 06:08:12'),
(91, 6, 8, 4, 48, 47, 34, 5, '2017-03-31 06:08:12'),
(92, 6, 9, 4, 56, 5, 37, 22, '2017-03-31 06:08:12'),
(93, 6, 9, 4, 56, 5, 38, 22, '2017-03-31 06:08:12'),
(94, 6, 9, 4, 56, 5, 39, 22, '2017-03-31 06:08:12'),
(95, 6, 10, 4, 44, 63, 30, 3, '2017-03-31 06:08:12'),
(96, 6, 10, 4, 44, 63, 31, 3, '2017-03-31 06:08:12'),
(97, 6, 10, 4, 44, 63, 21, 3, '2017-03-31 06:08:12'),
(98, 6, 11, 10, 8, 63, 33, 2, '2017-03-31 06:08:12'),
(99, 6, 11, 10, 8, 63, 34, 2, '2017-03-31 06:08:12'),
(100, 6, 11, 10, 8, 63, 17, 2, '2017-03-31 06:08:12'),
(101, 6, 11, 10, 8, 63, 18, 2, '2017-03-31 06:08:12'),
(102, 6, 11, 10, 8, 63, 25, 2, '2017-03-31 06:08:12'),
(103, 6, 11, 10, 8, 63, 26, 2, '2017-03-31 06:08:12'),
(104, 6, 12, 10, 9, 51, 14, 1, '2017-03-31 06:08:12'),
(105, 6, 12, 10, 9, 51, 15, 1, '2017-03-31 06:08:12'),
(106, 6, 12, 10, 9, 51, 22, 1, '2017-03-31 06:08:12'),
(107, 6, 12, 10, 9, 51, 23, 1, '2017-03-31 06:08:13'),
(108, 6, 12, 10, 9, 51, 28, 1, '2017-03-31 06:08:13'),
(109, 6, 12, 10, 9, 51, 29, 1, '2017-03-31 06:08:13'),
(110, 6, 13, 10, 11, 51, 11, 1, '2017-03-31 06:08:13'),
(111, 6, 13, 10, 11, 51, 12, 1, '2017-03-31 06:08:13'),
(112, 6, 13, 10, 11, 51, 37, 1, '2017-03-31 06:08:13'),
(113, 6, 13, 10, 11, 51, 38, 1, '2017-03-31 06:08:13'),
(114, 6, 13, 10, 11, 51, 2, 1, '2017-03-31 06:08:13'),
(115, 6, 13, 10, 11, 51, 3, 1, '2017-03-31 06:08:13'),
(116, 6, 14, 31, 58, 26, 32, 10, '2017-03-31 06:08:13'),
(117, 6, 14, 31, 58, 26, 33, 10, '2017-03-31 06:08:13'),
(118, 6, 14, 31, 58, 26, 18, 10, '2017-03-31 06:08:13'),
(119, 6, 14, 31, 58, 26, 19, 10, '2017-03-31 06:08:13'),
(120, 6, 14, 31, 58, 26, 24, 10, '2017-03-31 06:08:13'),
(121, 6, 14, 31, 58, 26, 25, 10, '2017-03-31 06:08:13'),
(122, 6, 14, 31, 58, 26, 8, 10, '2017-03-31 06:08:13'),
(123, 6, 15, 31, 35, 25, 26, 11, '2017-03-31 06:08:13'),
(124, 6, 15, 31, 35, 25, 27, 11, '2017-03-31 06:08:13'),
(125, 6, 15, 31, 35, 25, 9, 11, '2017-03-31 06:08:13'),
(126, 6, 15, 31, 35, 25, 10, 11, '2017-03-31 06:08:13'),
(127, 6, 16, 31, 53, 16, 28, 2, '2017-03-31 06:08:13'),
(128, 6, 16, 31, 53, 16, 29, 2, '2017-03-31 06:08:13'),
(129, 6, 16, 31, 53, 16, 1, 2, '2017-03-31 06:08:14'),
(130, 6, 16, 31, 53, 16, 2, 2, '2017-03-31 06:08:14'),
(131, 6, 17, 4, 50, 15, 19, 3, '2017-03-31 06:08:14'),
(132, 6, 17, 4, 50, 15, 20, 3, '2017-03-31 06:08:14'),
(133, 6, 17, 4, 50, 15, 13, 3, '2017-03-31 06:08:14'),
(134, 6, 17, 4, 50, 15, 14, 3, '2017-03-31 06:08:14'),
(135, 6, 18, 4, 56, 5, 26, 22, '2017-03-31 06:08:14'),
(136, 6, 18, 4, 56, 5, 27, 22, '2017-03-31 06:08:14'),
(137, 6, 18, 4, 56, 5, 28, 22, '2017-03-31 06:08:14'),
(138, 7, 20, 31, 18, 20, 1, 10, '2017-03-31 06:53:59'),
(139, 7, 20, 31, 18, 20, 2, 10, '2017-03-31 06:53:59'),
(140, 7, 20, 31, 18, 20, 3, 10, '2017-03-31 06:53:59'),
(141, 7, 20, 31, 18, 20, 8, 10, '2017-03-31 06:53:59'),
(142, 7, 20, 31, 18, 20, 9, 10, '2017-03-31 06:53:59'),
(143, 7, 20, 31, 18, 20, 32, 10, '2017-03-31 06:53:59'),
(144, 7, 20, 31, 18, 20, 33, 10, '2017-03-31 06:53:59'),
(145, 7, 20, 31, 18, 20, 34, 10, '2017-03-31 06:53:59'),
(146, 7, 20, 31, 18, 20, 26, 10, '2017-03-31 06:53:59'),
(147, 7, 20, 31, 18, 20, 27, 10, '2017-03-31 06:53:59'),
(148, 7, 21, 31, 58, 26, 0, 10, '2017-03-31 06:53:59'),
(149, 7, 21, 31, 58, 26, 16, 10, '2017-03-31 06:53:59'),
(150, 7, 21, 31, 58, 26, 17, 10, '2017-03-31 06:53:59'),
(151, 7, 21, 31, 58, 26, 24, 10, '2017-03-31 06:54:00'),
(152, 7, 21, 31, 58, 26, 25, 10, '2017-03-31 06:54:00'),
(153, 7, 21, 31, 58, 26, 10, 10, '2017-03-31 06:54:00'),
(154, 7, 21, 31, 58, 26, 11, 10, '2017-03-31 06:54:00'),
(155, 8, 22, 4, 2, 63, 0, 3, '2017-03-31 16:01:24'),
(156, 8, 22, 4, 2, 63, 1, 3, '2017-03-31 16:01:24'),
(157, 8, 22, 4, 2, 63, 38, 3, '2017-03-31 16:01:24'),
(158, 8, 22, 4, 2, 63, 39, 3, '2017-03-31 16:01:24'),
(159, 8, 22, 4, 2, 63, 13, 3, '2017-03-31 16:01:24'),
(160, 8, 22, 4, 2, 63, 14, 3, '2017-03-31 16:01:24'),
(161, 8, 23, 4, 4, 51, 11, 2, '2017-03-31 16:01:24'),
(162, 8, 23, 4, 4, 51, 12, 2, '2017-03-31 16:01:24'),
(163, 8, 23, 4, 4, 51, 33, 2, '2017-03-31 16:01:24'),
(164, 8, 23, 4, 4, 51, 34, 2, '2017-03-31 16:01:25'),
(165, 8, 23, 4, 4, 51, 29, 2, '2017-03-31 16:01:25'),
(166, 8, 23, 4, 4, 51, 30, 2, '2017-03-31 16:01:25'),
(167, 8, 24, 4, 48, 47, 18, 1, '2017-03-31 16:01:25'),
(168, 8, 24, 4, 48, 47, 19, 1, '2017-03-31 16:01:25'),
(169, 8, 24, 4, 48, 47, 6, 1, '2017-03-31 16:01:25'),
(170, 8, 24, 4, 48, 47, 7, 1, '2017-03-31 16:01:25'),
(171, 8, 25, 4, 56, 5, 35, 22, '2017-03-31 16:01:25'),
(172, 8, 25, 4, 56, 5, 36, 22, '2017-03-31 16:01:25'),
(173, 8, 25, 4, 56, 5, 37, 22, '2017-03-31 16:01:25'),
(174, 8, 26, 4, 44, 63, 9, 3, '2017-03-31 16:01:25'),
(175, 8, 26, 4, 44, 63, 16, 3, '2017-03-31 16:01:25'),
(176, 8, 26, 4, 44, 63, 17, 3, '2017-03-31 16:01:25'),
(177, 8, 27, 10, 8, 63, 10, 3, '2017-03-31 16:01:25'),
(178, 8, 27, 10, 8, 63, 11, 3, '2017-03-31 16:01:25'),
(179, 8, 27, 10, 8, 63, 33, 3, '2017-03-31 16:01:25'),
(180, 8, 27, 10, 8, 63, 34, 3, '2017-03-31 16:01:25'),
(181, 8, 27, 10, 8, 63, 18, 3, '2017-03-31 16:01:25'),
(182, 8, 27, 10, 8, 63, 19, 3, '2017-03-31 16:01:25'),
(183, 8, 28, 10, 9, 51, 16, 1, '2017-03-31 16:01:25'),
(184, 8, 28, 10, 9, 51, 17, 1, '2017-03-31 16:01:25'),
(185, 8, 28, 10, 9, 51, 38, 1, '2017-03-31 16:01:25'),
(186, 8, 28, 10, 9, 51, 39, 1, '2017-03-31 16:01:26'),
(187, 8, 28, 10, 9, 51, 13, 1, '2017-03-31 16:01:26'),
(188, 8, 28, 10, 9, 51, 14, 1, '2017-03-31 16:01:26'),
(189, 8, 29, 10, 11, 51, 25, 2, '2017-03-31 16:01:26'),
(190, 8, 29, 10, 11, 51, 26, 2, '2017-03-31 16:01:26'),
(191, 8, 29, 10, 11, 51, 6, 2, '2017-03-31 16:01:26'),
(192, 8, 29, 10, 11, 51, 7, 2, '2017-03-31 16:01:26'),
(193, 8, 29, 10, 11, 51, 21, 2, '2017-03-31 16:01:26'),
(194, 8, 29, 10, 11, 51, 22, 2, '2017-03-31 16:01:26'),
(195, 8, 30, 31, 58, 26, 19, 11, '2017-03-31 16:01:26'),
(196, 8, 30, 31, 58, 26, 24, 11, '2017-03-31 16:01:26'),
(197, 8, 30, 31, 58, 26, 25, 11, '2017-03-31 16:01:26'),
(198, 8, 30, 31, 58, 26, 32, 11, '2017-03-31 16:01:26'),
(199, 8, 30, 31, 58, 26, 33, 11, '2017-03-31 16:01:26'),
(200, 8, 30, 31, 58, 26, 9, 11, '2017-03-31 16:01:26'),
(201, 8, 30, 31, 58, 26, 10, 11, '2017-03-31 16:01:26'),
(202, 8, 31, 31, 35, 25, 16, 10, '2017-03-31 16:01:26'),
(203, 8, 31, 31, 35, 25, 17, 10, '2017-03-31 16:01:26'),
(204, 8, 31, 31, 35, 25, 2, 10, '2017-03-31 16:01:26'),
(205, 8, 31, 31, 35, 25, 3, 10, '2017-03-31 16:01:26'),
(206, 8, 32, 31, 53, 16, 22, 3, '2017-03-31 16:01:26'),
(207, 8, 32, 31, 53, 16, 23, 3, '2017-03-31 16:01:26'),
(208, 8, 32, 31, 53, 16, 27, 3, '2017-03-31 16:01:26'),
(209, 8, 32, 31, 53, 16, 28, 3, '2017-03-31 16:01:27'),
(210, 8, 33, 4, 50, 15, 25, 1, '2017-03-31 16:01:27'),
(211, 8, 33, 4, 50, 15, 26, 1, '2017-03-31 16:01:27'),
(212, 8, 33, 4, 50, 15, 2, 1, '2017-03-31 16:01:27'),
(213, 8, 33, 4, 50, 15, 3, 1, '2017-03-31 16:01:27'),
(214, 8, 34, 4, 56, 5, 21, 22, '2017-03-31 16:01:27'),
(215, 8, 34, 4, 56, 5, 22, 22, '2017-03-31 16:01:27'),
(216, 8, 34, 4, 56, 5, 23, 22, '2017-03-31 16:01:27'),
(217, 9, 37, 4, 2, 63, 33, 3, '2017-04-02 15:46:58'),
(218, 9, 37, 4, 2, 63, 34, 3, '2017-04-02 15:46:58'),
(219, 9, 37, 4, 2, 63, 11, 3, '2017-04-02 15:46:58'),
(220, 9, 37, 4, 2, 63, 12, 3, '2017-04-02 15:46:58'),
(221, 9, 37, 4, 2, 63, 5, 3, '2017-04-02 15:46:58'),
(222, 9, 37, 4, 2, 63, 6, 3, '2017-04-02 15:46:58'),
(223, 9, 38, 4, 4, 51, 19, 2, '2017-04-02 15:46:58'),
(224, 9, 38, 4, 4, 51, 20, 2, '2017-04-02 15:46:58'),
(225, 9, 38, 4, 4, 51, 13, 2, '2017-04-02 15:46:58'),
(226, 9, 38, 4, 4, 51, 14, 2, '2017-04-02 15:46:58'),
(227, 9, 38, 4, 4, 51, 1, 2, '2017-04-02 15:46:58'),
(228, 9, 38, 4, 4, 51, 2, 2, '2017-04-02 15:46:59'),
(229, 9, 39, 4, 48, 47, 38, 1, '2017-04-02 15:46:59'),
(230, 9, 39, 4, 48, 47, 39, 1, '2017-04-02 15:46:59'),
(231, 9, 39, 4, 48, 47, 27, 1, '2017-04-02 15:46:59'),
(232, 9, 39, 4, 48, 47, 28, 1, '2017-04-02 15:46:59'),
(233, 9, 40, 4, 56, 5, 35, 22, '2017-04-02 15:46:59'),
(234, 9, 40, 4, 56, 5, 36, 22, '2017-04-02 15:46:59'),
(235, 9, 40, 4, 56, 5, 37, 22, '2017-04-02 15:46:59'),
(236, 9, 41, 4, 44, 63, 22, 5, '2017-04-02 15:46:59'),
(237, 9, 41, 4, 44, 63, 23, 5, '2017-04-02 15:46:59'),
(238, 9, 41, 4, 44, 63, 4, 5, '2017-04-02 15:46:59'),
(239, 9, 42, 10, 8, 63, 24, 5, '2017-04-02 15:46:59'),
(240, 9, 42, 10, 8, 63, 25, 5, '2017-04-02 15:46:59'),
(241, 9, 42, 10, 8, 63, 17, 5, '2017-04-02 15:47:00'),
(242, 9, 42, 10, 8, 63, 18, 5, '2017-04-02 15:47:00'),
(243, 9, 42, 10, 8, 63, 0, 5, '2017-04-02 15:47:00'),
(244, 9, 42, 10, 8, 63, 1, 5, '2017-04-02 15:47:00'),
(245, 9, 43, 10, 9, 51, 6, 1, '2017-04-02 15:47:00'),
(246, 9, 43, 10, 9, 51, 7, 1, '2017-04-02 15:47:00'),
(247, 9, 43, 10, 9, 51, 29, 1, '2017-04-02 15:47:00'),
(248, 9, 43, 10, 9, 51, 30, 1, '2017-04-02 15:47:00'),
(249, 9, 43, 10, 9, 51, 10, 1, '2017-04-02 15:47:00'),
(250, 9, 43, 10, 9, 51, 11, 1, '2017-04-02 15:47:00'),
(251, 9, 44, 10, 11, 51, 3, 2, '2017-04-02 15:47:00'),
(252, 9, 44, 10, 11, 51, 4, 2, '2017-04-02 15:47:00'),
(253, 9, 44, 10, 11, 51, 21, 2, '2017-04-02 15:47:00'),
(254, 9, 44, 10, 11, 51, 22, 2, '2017-04-02 15:47:00'),
(255, 9, 44, 10, 11, 51, 33, 2, '2017-04-02 15:47:00'),
(256, 9, 44, 10, 11, 51, 34, 2, '2017-04-02 15:47:00'),
(257, 9, 45, 31, 58, 26, 25, 10, '2017-04-02 15:47:00'),
(258, 9, 45, 31, 58, 26, 26, 10, '2017-04-02 15:47:00'),
(259, 9, 45, 31, 58, 26, 19, 10, '2017-04-02 15:47:00'),
(260, 9, 45, 31, 58, 26, 34, 10, '2017-04-02 15:47:00'),
(261, 9, 45, 31, 58, 26, 35, 10, '2017-04-02 15:47:00'),
(262, 9, 45, 31, 58, 26, 8, 10, '2017-04-02 15:47:01'),
(263, 9, 45, 31, 58, 26, 9, 10, '2017-04-02 15:47:01'),
(264, 9, 46, 31, 35, 25, 32, 10, '2017-04-02 15:47:01'),
(265, 9, 46, 31, 35, 25, 33, 10, '2017-04-02 15:47:01'),
(266, 9, 46, 31, 35, 25, 0, 10, '2017-04-02 15:47:01'),
(267, 9, 46, 31, 35, 25, 1, 10, '2017-04-02 15:47:01'),
(268, 9, 47, 31, 53, 16, 12, 5, '2017-04-02 15:47:01'),
(269, 9, 47, 31, 53, 16, 13, 5, '2017-04-02 15:47:01'),
(270, 9, 47, 31, 53, 16, 38, 5, '2017-04-02 15:47:01'),
(271, 9, 47, 31, 53, 16, 39, 5, '2017-04-02 15:47:01'),
(272, 9, 48, 4, 50, 15, 8, 2, '2017-04-02 15:47:01'),
(273, 9, 48, 4, 50, 15, 9, 2, '2017-04-02 15:47:01'),
(274, 9, 48, 4, 50, 15, 25, 2, '2017-04-02 15:47:01'),
(275, 9, 48, 4, 50, 15, 26, 2, '2017-04-02 15:47:01'),
(276, 9, 49, 4, 56, 5, 16, 22, '2017-04-02 15:47:01'),
(277, 9, 49, 4, 56, 5, 17, 22, '2017-04-02 15:47:01'),
(278, 9, 49, 4, 56, 5, 18, 22, '2017-04-02 15:47:01'),
(279, 9, 50, 31, 50, 15, 14, 3, '2017-04-02 15:47:01'),
(280, 9, 50, 31, 50, 15, 15, 3, '2017-04-02 15:47:02'),
(281, 9, 50, 31, 50, 15, 30, 3, '2017-04-02 15:47:02'),
(282, 9, 50, 31, 50, 15, 31, 3, '2017-04-02 15:47:02'),
(283, 9, 51, 31, 56, 5, 21, 22, '2017-04-02 15:47:02'),
(284, 9, 51, 31, 56, 5, 22, 22, '2017-04-02 15:47:02'),
(285, 9, 51, 31, 56, 5, 23, 22, '2017-04-02 15:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'insert', 'this is insertinsertinsert', '2017-03-17 04:27:32'),
(2, 'insert', 'this is insertinsertinsert', '2017-03-17 04:29:51'),
(3, 'insert', 'this is insertinsertinsert', '2017-03-17 04:35:48'),
(4, 'insert', 'this is insertinsertinsert', '2017-03-17 04:58:28'),
(5, 'insert', 'this is insertinsertinsert', '2017-03-17 04:58:44'),
(6, 'update', 'updateupdate 646464 ', '2017-03-17 04:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(4) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `type`, `location`, `description`) VALUES
(1, 'Room 1', 1, 'Bldg 1', 'Regular classroom'),
(2, 'Room 2', 1, 'Bldg 1', 'Regular classroom'),
(3, 'Room 3', 1, 'Main Building', 'Regular classroom'),
(4, 'Room 4', 13, 'Main Building', 'Dedicated room for ELX lecture classes'),
(5, 'Room 5', 1, 'Main Building', 'Regular classroom'),
(6, 'Mecha WRKSHOP 1', 3, 'Main Building', 'Mechatronics workshop'),
(7, 'Mecha WRKSHOP 2', 3, 'Main Building', 'Mechatronics workshop'),
(8, 'ELX WRKSHOP 1', 6, 'Main Building', 'Electronics workshop'),
(9, 'ELX WRKSHOP 2', 6, 'Main Building', 'Electronics workshop'),
(10, 'ELC WRKSHOP 1', 7, 'Main Building', 'Electrical workshop'),
(11, 'ELC WRKSHOP 2', 7, 'Main Building', 'Electrical workshop'),
(12, 'WLD WRKSHOP 1', 4, 'Main Building', 'Welding & Fabrication workshop'),
(13, 'WLD WRKSHOP 2', 4, 'Main Building', 'Welding & Fabrication workshop'),
(14, 'RAC WRKSHOP 1', 5, 'Main Building', 'RAC workshop'),
(15, 'RAC WRKSHOP 2', 5, 'Main Building', 'RAC workshop'),
(16, 'ELC Classroom 1', 12, 'Main Building', '	Dedicated room for ELC lecture classes'),
(17, 'CRVN 1', 10, 'Caravan', 'Rooms for English Foundation Program'),
(18, 'CRVN 2', 10, 'Caravan', 'Rooms for English Foundation Program'),
(19, 'CRVN 3', 10, 'Caravan', 'Rooms for English Foundation Program'),
(20, 'CRVN 4', 10, 'Caravan', 'Rooms for English Foundation Program'),
(21, 'CRVN 5', 10, 'Caravan', 'Rooms for English Foundation Program'),
(22, 'CRVN 11', 11, 'Caravan', 'Rooms for non-English Foundation Program'),
(23, 'Computer LAB 1', 2, 'Main Building', 'Maintained by Mr. Eric'),
(24, 'Computer LAB 2', 2, 'Main Building', 'Maintained by Mr. Vijay'),
(25, 'Any Room ', 9, 'Campus', 'Free room');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `name`, `description`) VALUES
(1, 'Classroom', 'Default room type'),
(2, 'Computer LAB', 'Used for IT classes'),
(3, 'Workshop-MECH', 'Mechatronics workshop'),
(4, 'Workshop-WELD', 'Welding workshop'),
(5, 'Workshop-RAC', 'RAC Workshop'),
(6, 'Workshop-ELX', 'Electronics workshop'),
(7, 'Workshop-ELC', 'Electical workshop'),
(8, 'Drawing LAB', 'Laboratory for autocad subject'),
(9, 'Free Room', 'Mess hall, lounge'),
(10, 'Caravan', 'Rooms for English Foundation Program'),
(11, 'Caravan-Converted room', 'Rooms for non-English Foundation Program'),
(12, 'ELC-Converted room', 'Dedicated room for ELC lecture classes'),
(13, 'ELX-Converted room', 'Dedicated room for ELX lecture classes');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(4) NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `required_period` int(4) NOT NULL COMMENT 'total number of periods required per week',
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `code`, `name`, `required_period`, `description`) VALUES
(1, 'BBSSM 1101', 'PRINCIPLES OF MARKETING ', 6, ''),
(2, 'BBSSM 1102', 'INTRODUCTION TO SELLING ', 6, ''),
(3, 'BBSSM 1103', 'ECONOMICS', 6, ''),
(4, 'BBSSM 1201', 'BUSINESS ETHICS', 6, ''),
(5, 'BBSSM 1202', 'ADVERTISIMENT & PROMOTION', 6, ''),
(6, 'BBSSM 1203', 'CONSUMER BEHAVIOR ', 6, ''),
(7, 'BBSSM 1204', 'BUSINESS RESEARCH METHODS', 6, ''),
(8, 'BBSSM 2101', 'DIRECT MARKETING ', 6, ''),
(9, 'BBSSM 2102', 'RETAILING MANAGEMENT ', 6, ''),
(10, 'BBSSM 2103', 'RETAIL PRICING STRAGEGIES ', 6, ''),
(11, 'BBSSM 2104', 'PROFESSIONAL SELLING ', 6, ''),
(12, 'BBSSM 2201', 'CUSTOMER RELATIONSHIP MGT.', 6, ''),
(13, 'BBSSM 2201x', 'MANAGEMENT AND ORGANIZATION ', 10, ''),
(14, 'BBSSM 2204', 'MARKETING COMMUINCATION', 10, ''),
(15, 'BBSSM 2204x', 'GRADUATION PROJECT ', 10, ''),
(16, 'CHEM 1101', 'Chemistry 1', 4, ''),
(17, 'CHEM 1202', 'Chemistry 2', 4, ''),
(18, 'EECIM 1101', 'Basic Electricity and System', 10, ''),
(19, 'EECIM 1102', 'Basic Electronics and Circuits', 10, ''),
(20, 'EECIM 1103', 'Fundamental Digital Electronics Circuits', 10, ''),
(21, 'EECIM 1203', 'ELX-?', 7, ''),
(22, 'EECIM 1204', 'Installation, Servicing Audio-Video Systems', 5, ''),
(23, 'EECIM 1205', 'Switched-Mode Power Supplies & Autovolt Power', 10, ''),
(24, 'EECIM 1206', 'Electronics Devices Servicing 1', 10, ''),
(25, 'EECIM 1305', 'ELX-?', 5, ''),
(26, 'EECIM 2107', 'Personal Computers and Multimedia Devices', 10, ''),
(27, 'EECIM 2108', 'Computer System Data Comm. & Internetworking', 10, ''),
(28, 'EECIM 2109', 'Graduation Project 1', 10, ''),
(29, 'EECIM 2210', 'Security Alarm systems', 10, ''),
(30, 'EECIM 2211', 'Electronics Devices Servicing 2', 10, ''),
(31, 'EECIM 2212', 'Graduation Project 2', 10, ''),
(32, 'EELIHW 1101', 'Health and Safety Precautions', 1, ''),
(33, 'EELIHW 1102', 'Basic Electricity(AC/DC) &Electrical Code', 5, ''),
(34, 'EELIHW 1103', 'Tools, Instruments, Electric wires and cable works', 5, ''),
(35, 'EELIHW 1204', 'Basic Electronics', 4, ''),
(36, 'EELIHW 1205', 'Electrical-Circuits and Protection Devices', 10, ''),
(37, 'EELIHW 1206', 'Three Phase Principles', 10, ''),
(38, 'EENDR 1101', 'Engineering Drawing 1', 10, ''),
(39, 'EENDR 1202', 'Engineering Drawing 2', 10, ''),
(40, 'ENG 1101', 'TECHNICAL WRITING ', 3, ''),
(41, 'ENG 1202', 'TECHNICAL COMMUNICATION  ', 3, ''),
(42, 'ENTRP 1202', 'ENTREPRENEURSHIP', 10, ''),
(43, 'ENTRP 1101', 'Entrepreneurship 1', 3, ''),
(44, 'ENTRP 1203', 'Entrepreneurship 2', 3, ''),
(45, 'INBS 1202', 'E- COMMERCE ', 4, ''),
(46, 'INTE 1101 ', 'ADVANCED IT SKILLS ', 4, ''),
(47, 'INTE 1202', 'INTRODUCTION TO C++ Programming', 4, ''),
(48, 'MTBS 1202', 'BUSINESS MATHIMATICS', 4, ''),
(49, 'MTCL 1101', 'Calculus', 4, ''),
(50, 'MTCL 1202', 'Engineering Mathematics', 4, ''),
(51, 'MTST 1101', 'STATISTICS ', 4, ''),
(52, 'PHYS 1101', 'Physics 1', 4, ''),
(53, 'PHYS 1202', 'Physics 2', 4, ''),
(54, 'PRMG 1101', 'ENTREPRENEURSHIP', 10, ''),
(55, 'PUENG 2101', 'Public Speaking', 3, ''),
(56, 'TCENG 1202', 'Technical Communication', 3, ''),
(57, 'TWENG 1101', 'TECHNICAL WRINTING ', 3, ''),
(58, 'EELIHW 1203', 'EELIHW-x', 7, ''),
(59, 'EELIHW 2107', 'EELIHW-y', 8, ''),
(60, 'EELIHW 2108', 'EELIHW-z', 5, ''),
(61, 'EELIHW 2209', 'EELIHW-u', 12, ''),
(62, 'EELIHW 2210', 'EELIHW-w', 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `subject_class`
--

CREATE TABLE `subject_class` (
  `id` int(4) NOT NULL,
  `timetable_id` int(4) NOT NULL,
  `subject_id` int(4) NOT NULL,
  `trainee_group_id` int(4) NOT NULL,
  `instructor_id` int(4) DEFAULT NULL,
  `room_id` int(4) DEFAULT NULL,
  `room_type_id` int(4) NOT NULL,
  `room_id_final` int(4) DEFAULT NULL,
  `room_fixed` int(11) DEFAULT NULL,
  `preferred_start_period` int(4) DEFAULT NULL,
  `preferred_end_period` int(4) DEFAULT NULL,
  `preferred_number_days` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `subject_class`
--

INSERT INTO `subject_class` (`id`, `timetable_id`, `subject_id`, `trainee_group_id`, `instructor_id`, `room_id`, `room_type_id`, `room_id_final`, `room_fixed`, `preferred_start_period`, `preferred_end_period`, `preferred_number_days`) VALUES
(1, 1, 18, 31, 20, 25, 7, NULL, NULL, 1, 4, 4),
(2, 2, 2, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(4, 4, 18, 31, 20, 25, 7, NULL, NULL, 1, 4, 4),
(5, 5, 2, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(6, 6, 2, 4, 63, 25, 1, NULL, NULL, 1, 8, 3),
(7, 6, 4, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(8, 6, 48, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(9, 6, 56, 4, 5, 22, 11, NULL, 1, 1, 8, 1),
(10, 6, 44, 4, 63, 25, 1, NULL, NULL, 1, 8, 2),
(11, 6, 8, 10, 63, 25, 1, NULL, NULL, 1, 4, 3),
(12, 6, 9, 10, 51, 25, 1, NULL, NULL, 1, 8, 3),
(13, 6, 11, 10, 51, 25, 1, NULL, NULL, 1, 8, 3),
(14, 6, 58, 31, 26, 25, 7, NULL, NULL, 1, 4, 4),
(15, 6, 35, 31, 25, 25, 7, NULL, NULL, 1, 4, 2),
(16, 6, 53, 31, 16, 25, 1, NULL, NULL, 1, 8, 2),
(17, 6, 50, 4, 15, 25, 1, NULL, NULL, 1, 8, 2),
(18, 6, 56, 4, 5, 22, 11, NULL, 1, 1, 8, 1),
(19, 1, 58, 31, 26, 25, 7, NULL, NULL, 1, 4, 4),
(20, 7, 18, 31, 20, 25, 7, NULL, NULL, 1, 4, 4),
(21, 7, 58, 31, 26, 25, 7, NULL, NULL, 1, 4, 4),
(22, 8, 2, 4, 63, 25, 1, NULL, NULL, 1, 8, 3),
(23, 8, 4, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(24, 8, 48, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(25, 8, 56, 4, 5, 22, 11, NULL, 1, 1, 8, 1),
(26, 8, 44, 4, 63, 25, 1, NULL, NULL, 1, 8, 2),
(27, 8, 8, 10, 63, 25, 1, NULL, NULL, 1, 4, 3),
(28, 8, 9, 10, 51, 25, 1, NULL, NULL, 1, 8, 3),
(29, 8, 11, 10, 51, 25, 1, NULL, NULL, 1, 8, 3),
(30, 8, 58, 31, 26, 25, 7, NULL, NULL, 1, 4, 4),
(31, 8, 35, 31, 25, 25, 7, NULL, NULL, 1, 4, 2),
(32, 8, 53, 31, 16, 25, 1, NULL, NULL, 1, 8, 2),
(33, 8, 50, 4, 15, 25, 1, NULL, NULL, 1, 8, 2),
(34, 8, 56, 4, 5, 22, 11, NULL, 1, 1, 8, 1),
(35, 8, 50, 31, 15, 25, 1, NULL, NULL, 1, 8, 2),
(36, 8, 56, 31, 5, 22, 11, NULL, 1, 1, 8, 1),
(37, 9, 2, 4, 63, 25, 1, NULL, NULL, 1, 8, 3),
(38, 9, 4, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(39, 9, 48, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(40, 9, 56, 4, 5, 22, 11, NULL, 1, 1, 8, 1),
(41, 9, 44, 4, 63, 25, 1, NULL, NULL, 1, 8, 2),
(42, 9, 8, 10, 63, 25, 1, NULL, NULL, 1, 4, 3),
(43, 9, 9, 10, 51, 25, 1, NULL, NULL, 1, 8, 3),
(44, 9, 11, 10, 51, 25, 1, NULL, NULL, 1, 8, 3),
(45, 9, 58, 31, 26, 25, 7, NULL, NULL, 1, 4, 4),
(46, 9, 35, 31, 25, 25, 7, NULL, NULL, 1, 4, 2),
(47, 9, 53, 31, 16, 25, 1, NULL, NULL, 1, 8, 2),
(48, 9, 50, 4, 15, 25, 1, NULL, NULL, 1, 8, 2),
(49, 9, 56, 4, 5, 22, 11, NULL, 1, 1, 8, 1),
(50, 9, 50, 31, 15, 25, 1, NULL, NULL, 1, 8, 2),
(51, 9, 56, 31, 5, 22, 11, NULL, 1, 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(4) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  `term` varchar(100) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `current` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `year_start`, `year_end`, `term`, `remarks`, `created`, `current`) VALUES
(1, 2020, 2021, '1', 'test', '2017-03-30 11:02:39', 0),
(2, 2020, 2021, '1', 'test', '2017-03-30 14:25:40', 0),
(4, 2020, 2021, '1', 'test This table 3 CONFLICT(S).', '2017-03-31 05:45:41', 0),
(5, 2020, 2021, '1', 'test This table has 0 CONFLICT(S).', '2017-03-31 05:47:54', 0),
(6, 2025, 2026, '1', 'Demo to test GA. This table has 0 CONFLICT(S).', '2017-03-31 05:56:21', 0),
(7, 2020, 2021, '1', 'test This table has 0 CONFLICT(S).', '2017-03-31 06:53:59', 0),
(8, 2025, 2026, '1', 'Demo to test GA. This table has 0 CONFLICT(S). This table has 0 CONFLICT(S).', '2017-03-31 16:01:15', 0),
(9, 2025, 2026, '1', 'Demo to test GA. This table has 0 CONFLICT(S). This table has 0 CONFLICT(S). This table has 0 CONFLI', '2017-04-02 15:46:42', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `trainee_group`
--

INSERT INTO `trainee_group` (`id`, `name`, `section`, `level`, `remarks`) VALUES
(1, 'BUS-1A', 'A', 1, 'Term 1 Sales & Marketing Trainees'),
(2, 'BUS-1B', 'B', 1, 'Term 1 Sales & Marketing Trainees'),
(3, 'BUS-1C', 'C', 1, 'Term 1 Sales & Marketing Trainees'),
(4, 'BUS-2A', 'A', 2, 'Term 2 Sales & Marketing Trainees'),
(5, 'BUS-2B', 'B', 2, 'Term 2 Sales & Marketing Trainees'),
(6, 'BUS-2C', 'C', 2, 'Term 2 Sales & Marketing Trainees'),
(7, 'BUS-3A', 'A', 3, 'Term 3 Sales & Marketing Trainees'),
(8, 'BUS-3B', 'B', 3, 'Term 3 Sales & Marketing Trainees'),
(9, 'BUS-3C', 'C', 3, 'Term 3 Sales & Marketing Trainees'),
(10, 'BUS-4A', 'A', 4, 'Term 4 Sales & Marketing Trainees'),
(11, 'BUS-4B', 'B', 4, 'Term 4 Sales & Marketing Trainees'),
(12, 'BUS-4C', 'C', 4, 'Term 4 Sales & Marketing Trainees'),
(13, 'BUS-5A', 'A', 5, 'Term 5 Sales & Marketing Trainees'),
(14, 'BUS-5B', 'B', 5, 'Term 5 Sales & Marketing Trainees'),
(15, 'BUS-5C', 'C', 5, 'Term 5 Sales & Marketing Trainees'),
(16, 'BUS-6A', 'A', 6, 'Term 6 Sales & Marketing Trainees'),
(17, 'BUS-6B', 'B', 6, 'Term 6 Sales & Marketing Trainees'),
(18, 'BUS-6C', 'C', 6, 'Term 6 Sales & Marketing Trainees'),
(19, 'BUS-7A', 'A', 7, 'Term 7 Sales & Marketing Trainees'),
(20, 'BUS-7B', 'B', 7, 'Term 7 Sales & Marketing Trainees'),
(21, 'BUS-7C', 'C', 7, 'Term 7 Sales & Marketing Trainees'),
(22, 'BUS-8A', 'A', 8, 'Term 8 Sales & Marketing Trainees'),
(23, 'BUS-8B', 'B', 8, 'Term 8 Sales & Marketing Trainees'),
(24, 'BUS-8C', 'C', 8, 'Term 8 Sales & Marketing Trainees'),
(25, 'BUS-9A', 'A', 9, 'Term 9 Sales & Marketing Trainees'),
(26, 'BUS-9B', 'B', 9, 'Term 9 Sales & Marketing Trainees'),
(27, 'BUS-9C', 'C', 9, 'Term 9 Sales & Marketing Trainees'),
(28, 'ELC-1A', 'A', 1, 'Term 1 Electrical Trainees'),
(29, 'ELC-1B', 'B', 1, 'Term 1 Electrical Trainees'),
(30, 'ELC-1C', 'C', 1, 'Term 1 Electrical Trainees'),
(31, 'ELC-2A', 'A', 2, 'Term 2 Electrical Trainees'),
(32, 'ELC-2B', 'B', 2, 'Term 2 Electrical Trainees'),
(33, 'ELC-2C', 'C', 2, 'Term 2 Electrical Trainees'),
(34, 'ELC-3A', 'A', 3, 'Term 3 Electrical Trainees'),
(35, 'ELC-3B', 'B', 3, 'Term 3 Electrical Trainees'),
(36, 'ELC-3C', 'C', 3, 'Term 3 Electrical Trainees'),
(37, 'ELC-4A', 'A', 4, 'Term 4 Electrical Trainees'),
(38, 'ELC-4B', 'B', 4, 'Term 4 Electrical Trainees'),
(39, 'ELC-4C', 'C', 4, 'Term 4 Electrical Trainees'),
(40, 'ELC-5A', 'A', 5, 'Term 5 Electrical Trainees'),
(41, 'ELC-5B', 'B', 5, 'Term 5 Electrical Trainees'),
(42, 'ELC-5C', 'C', 5, 'Term 5 Electrical Trainees'),
(43, 'ELC-6A', 'A', 6, 'Term 6 Electrical Trainees'),
(44, 'ELC-6B', 'B', 6, 'Term 6 Electrical Trainees'),
(45, 'ELC-6C', 'C', 6, 'Term 6 Electrical Trainees'),
(46, 'ELC-7A', 'A', 7, 'Term 7 Electrical Trainees'),
(47, 'ELC-7B', 'B', 7, 'Term 7 Electrical Trainees'),
(48, 'ELC-7C', 'C', 7, 'Term 7 Electrical Trainees'),
(49, 'ELC-8A', 'A', 8, 'Term 8 Electrical Trainees'),
(50, 'ELC-8B', 'B', 8, 'Term 8 Electrical Trainees'),
(51, 'ELC-8C', 'C', 8, 'Term 8 Electrical Trainees'),
(52, 'ELC-9A', 'A', 9, 'Term 9 Electrical Trainees'),
(53, 'ELC-9B', 'B', 9, 'Term 9 Electrical Trainees'),
(55, 'ELX-1A', 'A', 1, 'Term 1 Electronics Trainees'),
(56, 'ELX-1B', 'B', 1, 'Term 1 Electronics Trainees'),
(57, 'ELX-1C', 'C', 1, 'Term 1 Electronics Trainees'),
(58, 'ELX-2A', 'A', 2, 'Term 2 Electronics Trainees'),
(59, 'ELX-2B', 'B', 2, 'Term 2 Electronics Trainees'),
(60, 'ELX-2C', 'C', 2, 'Term 2 Electronics Trainees'),
(61, 'ELX-3A', 'A', 3, 'Term 3 Electronics Trainees'),
(62, 'ELX-3B', 'B', 3, 'Term 3 Electronics Trainees'),
(63, 'ELX-3C', 'C', 3, 'Term 3 Electronics Trainees'),
(64, 'ELX-4A', 'A', 4, 'Term 4 Electronics Trainees'),
(65, 'ELX-4B', 'B', 4, 'Term 4 Electronics Trainees'),
(66, 'ELX-4C', 'C', 4, 'Term 4 Electronics Trainees'),
(67, 'ELX-5A', 'A', 5, 'Term 5 Electronics Trainees'),
(68, 'ELX-5B', 'B', 5, 'Term 5 Electronics Trainees'),
(69, 'ELX-5C', 'C', 5, 'Term 5 Electronics Trainees'),
(70, 'ELX-6A', 'A', 6, 'Term 6 Electronics Trainees'),
(71, 'ELX-6B', 'B', 6, 'Term 6 Electronics Trainees'),
(72, 'ELX-6C', 'C', 6, 'Term 6 Electronics Trainees'),
(73, 'ELX-7A', 'A', 7, 'Term 7 Electronics Trainees'),
(74, 'ELX-7B', 'B', 7, 'Term 7 Electronics Trainees'),
(75, 'ELX-7C', 'C', 7, 'Term 7 Electronics Trainees'),
(76, 'ELX-8A', 'A', 8, 'Term 8 Electronics Trainees'),
(77, 'ELX-8B', 'B', 8, 'Term 8 Electronics Trainees'),
(78, 'ELX-8C', 'C', 8, 'Term 8 Electronics Trainees'),
(79, 'ELX-9A', 'A', 9, 'Term 9 Electronics Trainees'),
(80, 'ELX-9B', 'B', 9, 'Term 9 Electronics Trainees'),
(81, 'ELX-9C', 'C', 9, 'Term 9 Electronics Trainees'),
(82, 'MECHA-1A', 'A', 1, 'Term 1 Mechatronics Trainees'),
(83, 'MECHA-1B', 'B', 1, 'Term 1 Mechatronics Trainees'),
(84, 'MECHA-1C', 'C', 1, 'Term 1 Mechatronics Trainees'),
(85, 'MECHA-2A', 'A', 2, 'Term 2 Mechatronics Trainees'),
(86, 'MECHA-2B', 'B', 2, 'Term 2 Mechatronics Trainees'),
(87, 'MECHA-2C', 'C', 2, 'Term 2 Mechatronics Trainees'),
(88, 'MECHA-3A', 'A', 3, 'Term 3 Mechatronics Trainees'),
(89, 'MECHA-3B', 'B', 3, 'Term 3 Mechatronics Trainees'),
(90, 'MECHA-3C', 'C', 3, 'Term 3 Mechatronics Trainees'),
(91, 'MECHA-4A', 'A', 4, 'Term 4 Mechatronics Trainees'),
(92, 'MECHA-4B', 'B', 4, 'Term 4 Mechatronics Trainees'),
(93, 'MECHA-4C', 'C', 4, 'Term 4 Mechatronics Trainees'),
(94, 'MECHA-5A', 'A', 5, 'Term 5 Mechatronics Trainees'),
(95, 'MECHA-5B', 'B', 5, 'Term 5 Mechatronics Trainees'),
(96, 'MECHA-5C', 'C', 5, 'Term 5 Mechatronics Trainees'),
(97, 'MECHA-6A', 'A', 6, 'Term 6 Mechatronics Trainees'),
(98, 'MECHA-6B', 'B', 6, 'Term 6 Mechatronics Trainees'),
(99, 'MECHA-6C', 'C', 6, 'Term 6 Mechatronics Trainees'),
(100, 'MECHA-7A', 'A', 7, 'Term 7 Mechatronics Trainees'),
(101, 'MECHA-7B', 'B', 7, 'Term 7 Mechatronics Trainees'),
(102, 'MECHA-7C', 'C', 7, 'Term 7 Mechatronics Trainees'),
(103, 'MECHA-8A', 'A', 8, 'Term 8 Mechatronics Trainees'),
(104, 'MECHA-8B', 'B', 8, 'Term 8 Mechatronics Trainees'),
(105, 'MECHA-8C', 'C', 8, 'Term 8 Mechatronics Trainees'),
(106, 'MECHA-9A', 'A', 9, 'Term 9 Mechatronics Trainees'),
(107, 'MECHA-9B', 'B', 9, 'Term 9 Mechatronics Trainees'),
(108, 'MECHA-9C', 'C', 9, 'Term 9 Mechatronics Trainees'),
(109, 'RAC-1A', 'A', 1, 'Term 1 Ref & Aircon Trainees'),
(110, 'RAC-1B', 'B', 1, 'Term 1 Ref & Aircon Trainees'),
(111, 'RAC-1C', 'C', 1, 'Term 1 Ref & Aircon Trainees'),
(112, 'RAC-2A', 'A', 2, 'Term 2 Ref & Aircon Trainees'),
(113, 'RAC-2B', 'B', 2, 'Term 2 Ref & Aircon Trainees'),
(114, 'RAC-2C', 'C', 2, 'Term 2 Ref & Aircon Trainees'),
(115, 'RAC-3A', 'A', 3, 'Term 3 Ref & Aircon Trainees'),
(116, 'RAC-3B', 'B', 3, 'Term 3 Ref & Aircon Trainees'),
(117, 'RAC-3C', 'C', 3, 'Term 3 Ref & Aircon Trainees'),
(118, 'RAC-4A', 'A', 4, 'Term 4 Ref & Aircon Trainees'),
(119, 'RAC-4B', 'B', 4, 'Term 4 Ref & Aircon Trainees'),
(120, 'RAC-4C', 'C', 4, 'Term 4 Ref & Aircon Trainees'),
(121, 'RAC-5A', 'A', 5, 'Term 5 Ref & Aircon Trainees'),
(122, 'RAC-5B', 'B', 5, 'Term 5 Ref & Aircon Trainees'),
(123, 'RAC-5C', 'C', 5, 'Term 5 Ref & Aircon Trainees'),
(124, 'RAC-6A', 'A', 6, 'Term 6 Ref & Aircon Trainees'),
(125, 'RAC-6B', 'B', 6, 'Term 6 Ref & Aircon Trainees'),
(126, 'RAC-6C', 'C', 6, 'Term 6 Ref & Aircon Trainees'),
(127, 'RAC-7A', 'A', 7, 'Term 7 Ref & Aircon Trainees'),
(128, 'RAC-7B', 'B', 7, 'Term 7 Ref & Aircon Trainees'),
(129, 'RAC-7C', 'C', 7, 'Term 7 Ref & Aircon Trainees'),
(130, 'RAC-8A', 'A', 8, 'Term 8 Ref & Aircon Trainees'),
(131, 'RAC-8B', 'B', 8, 'Term 8 Ref & Aircon Trainees'),
(132, 'RAC-8C', 'C', 8, 'Term 8 Ref & Aircon Trainees'),
(133, 'RAC-9A', 'A', 9, 'Term 9 Ref & Aircon Trainees'),
(134, 'RAC-9B', 'B', 9, 'Term 9 Ref & Aircon Trainees'),
(135, 'RAC-9C', 'C', 9, 'Term 9 Ref & Aircon Trainees'),
(136, 'WELD-1A', 'A', 1, 'Term 1 Weldin & Fabrication Trainees'),
(137, 'WELD-1B', 'B', 1, 'Term 1 Weldin & Fabrication Trainees'),
(138, 'WELD-1C', 'C', 1, 'Term 1 Weldin & Fabrication Trainees'),
(139, 'WELD-2A', 'A', 2, 'Term 2 Weldin & Fabrication Trainees'),
(140, 'WELD-2B', 'B', 2, 'Term 2 Weldin & Fabrication Trainees'),
(141, 'WELD-2C', 'C', 2, 'Term 2 Weldin & Fabrication Trainees'),
(142, 'WELD-3A', 'A', 3, 'Term 3 Weldin & Fabrication Trainees'),
(143, 'WELD-3B', 'B', 3, 'Term 3 Weldin & Fabrication Trainees'),
(144, 'WELD-3C', 'C', 3, 'Term 3 Weldin & Fabrication Trainees'),
(145, 'WELD-4A', 'A', 4, 'Term 4 Weldin & Fabrication Trainees'),
(146, 'WELD-4B', 'B', 4, 'Term 4 Weldin & Fabrication Trainees'),
(147, 'WELD-4C', 'C', 4, 'Term 4 Weldin & Fabrication Trainees'),
(148, 'WELD-5A', 'A', 5, 'Term 5 Weldin & Fabrication Trainees'),
(149, 'WELD-5B', 'B', 5, 'Term 5 Weldin & Fabrication Trainees'),
(150, 'WELD-5C', 'C', 5, 'Term 5 Weldin & Fabrication Trainees'),
(151, 'WELD-6A', 'A', 6, 'Term 6 Weldin & Fabrication Trainees'),
(152, 'WELD-6B', 'B', 6, 'Term 6 Weldin & Fabrication Trainees'),
(153, 'WELD-6C', 'C', 6, 'Term 6 Weldin & Fabrication Trainees'),
(154, 'WELD-7A', 'A', 7, 'Term 7 Weldin & Fabrication Trainees'),
(155, 'WELD-7B', 'B', 7, 'Term 7 Weldin & Fabrication Trainees'),
(156, 'WELD-7C', 'C', 7, 'Term 7 Weldin & Fabrication Trainees'),
(157, 'WELD-8A', 'A', 8, 'Term 8 Weldin & Fabrication Trainees'),
(158, 'WELD-8B', 'B', 8, 'Term 8 Weldin & Fabrication Trainees'),
(159, 'WELD-8C', 'C', 8, 'Term 8 Weldin & Fabrication Trainees'),
(160, 'WELD-9A', 'A', 9, 'Term 9 Weldin & Fabrication Trainees'),
(161, 'WELD-9B', 'B', 9, 'Term 9 Weldin & Fabrication Trainees'),
(162, 'WELD-9C', 'C', 9, 'Term 9 Weldin & Fabrication Trainees'),
(165, 'ELC-9C', 'C', 9, 'Term 9 Electrical Trainees');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL DEFAULT '',
  `rights` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `password`, `rights`) VALUES
(1, 'admin@admin.com', 'John', 'Doe', '$2y$10$LOKihHkxOKj4gXbH7yc5kOCQO/NpS1v7Yk6/TpEK/YtXQLP/udSjO', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetable_id` (`timetable_id`),
  ADD KEY `subject_class_id` (`subject_class_id`),
  ADD KEY `meeting_room_id` (`room_id`),
  ADD KEY `trainee_group_id` (`trainee_group_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `instructor_id` (`instructor_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type` (`room_type_id`),
  ADD KEY `timetable_id` (`timetable_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `trainee_group_id` (`trainee_group_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `room_id` (`room_id`);

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `trainee_group`
--
ALTER TABLE `trainee_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_instructor_id` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_subject_class_id` FOREIGN KEY (`subject_class_id`) REFERENCES `subject_class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_timetable_id` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_trainee_group_id` FOREIGN KEY (`trainee_group_id`) REFERENCES `trainee_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `type` FOREIGN KEY (`type`) REFERENCES `room_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD CONSTRAINT `instructor` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_type` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trainee_group` FOREIGN KEY (`trainee_group_id`) REFERENCES `trainee_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
