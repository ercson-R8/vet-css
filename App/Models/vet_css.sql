-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2017 at 05:03 PM
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
(18, 2017018, 'Enrique Jojo', 'Enrique', 'ELX - Instructor'),
(19, 2017019, 'Ericson', 'Billedo', 'IT - Instructor'),
(20, 2017020, 'Euclid', 'Santiago', 'ELC - Instructor'),
(21, 2017021, 'Eulogio Odie', 'Oderon', 'ELX - Instructor'),
(22, 2017022, 'Fatma', 'AL-Blushi', 'ENG - Instructor'),
(23, 2017023, 'Fatma', 'Al Balushi', 'IT - Instructor'),
(24, 2017024, 'Ghalib', 'Al Amri', 'MECH - Instructor'),
(25, 2017025, 'Hermogenes Henry', 'Baculo', 'ELC - Instructor'),
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
(1, 1, 1, 4, 3, 39, 21, 3, '2017-04-26 12:43:44'),
(2, 1, 1, 4, 3, 39, 22, 3, '2017-04-26 12:43:44'),
(3, 1, 1, 4, 3, 39, 3, 5, '2017-04-26 12:43:44'),
(4, 1, 1, 4, 3, 39, 4, 5, '2017-04-26 12:43:44'),
(5, 1, 1, 4, 3, 39, 8, 1, '2017-04-26 12:43:44'),
(6, 1, 1, 4, 3, 39, 9, 1, '2017-04-26 12:43:44'),
(7, 1, 2, 4, 5, 39, 19, 5, '2017-04-26 12:43:44'),
(8, 1, 2, 4, 5, 39, 20, 5, '2017-04-26 12:43:44'),
(9, 1, 2, 4, 5, 39, 24, 5, '2017-04-26 12:43:44'),
(10, 1, 2, 4, 5, 39, 25, 5, '2017-04-26 12:43:45'),
(11, 1, 2, 4, 5, 39, 0, 5, '2017-04-26 12:43:45'),
(12, 1, 2, 4, 5, 39, 1, 5, '2017-04-26 12:43:45'),
(13, 1, 3, 4, 46, 47, 37, 3, '2017-04-26 12:43:45'),
(14, 1, 3, 4, 46, 47, 38, 3, '2017-04-26 12:43:45'),
(15, 1, 3, 4, 46, 47, 12, 2, '2017-04-26 12:43:45'),
(16, 1, 3, 4, 46, 47, 13, 2, '2017-04-26 12:43:45'),
(17, 1, 4, 4, 53, 5, 29, 22, '2017-04-26 12:43:45'),
(18, 1, 4, 4, 53, 5, 5, 22, '2017-04-26 12:43:45'),
(19, 1, 4, 4, 53, 5, 6, 22, '2017-04-26 12:43:45'),
(20, 1, 5, 4, 42, 39, 14, 1, '2017-04-26 12:43:45'),
(21, 1, 5, 4, 42, 39, 33, 2, '2017-04-26 12:43:45'),
(22, 1, 5, 4, 42, 39, 34, 2, '2017-04-26 12:43:45'),
(23, 1, 6, 4, 1, 1, 35, 26, '2017-04-26 12:43:45'),
(24, 1, 6, 4, 1, 1, 18, 26, '2017-04-26 12:43:45'),
(25, 1, 6, 4, 1, 1, 27, 26, '2017-04-26 12:43:45'),
(26, 1, 6, 4, 1, 1, 2, 26, '2017-04-26 12:43:45'),
(27, 1, 6, 4, 1, 1, 10, 26, '2017-04-26 12:43:45'),
(28, 2, 11, 4, 3, 39, 24, 2, '2017-04-26 13:28:43'),
(29, 2, 11, 4, 3, 39, 25, 2, '2017-04-26 13:28:43'),
(30, 2, 11, 4, 3, 39, 0, 5, '2017-04-26 13:28:43'),
(31, 2, 11, 4, 3, 39, 1, 5, '2017-04-26 13:28:43'),
(32, 2, 11, 4, 3, 39, 19, 3, '2017-04-26 13:28:43'),
(33, 2, 11, 4, 3, 39, 20, 3, '2017-04-26 13:28:43'),
(34, 2, 12, 4, 5, 39, 16, 3, '2017-04-26 13:28:43'),
(35, 2, 12, 4, 5, 39, 17, 3, '2017-04-26 13:28:43'),
(36, 2, 12, 4, 5, 39, 9, 2, '2017-04-26 13:28:43'),
(37, 2, 12, 4, 5, 39, 10, 2, '2017-04-26 13:28:43'),
(38, 2, 12, 4, 5, 39, 35, 2, '2017-04-26 13:28:43'),
(39, 2, 12, 4, 5, 39, 36, 2, '2017-04-26 13:28:43'),
(40, 2, 13, 4, 46, 47, 12, 5, '2017-04-26 13:28:43'),
(41, 2, 13, 4, 46, 47, 13, 5, '2017-04-26 13:28:43'),
(42, 2, 13, 4, 46, 47, 32, 1, '2017-04-26 13:28:44'),
(43, 2, 13, 4, 46, 47, 33, 1, '2017-04-26 13:28:44'),
(44, 2, 14, 4, 53, 5, 28, 22, '2017-04-26 13:28:44'),
(45, 2, 14, 4, 53, 5, 3, 22, '2017-04-26 13:28:44'),
(46, 2, 14, 4, 53, 5, 4, 22, '2017-04-26 13:28:44'),
(47, 2, 15, 4, 42, 39, 8, 2, '2017-04-26 13:28:44'),
(48, 2, 15, 4, 42, 39, 5, 2, '2017-04-26 13:28:44'),
(49, 2, 15, 4, 42, 39, 26, 2, '2017-04-26 13:28:44'),
(50, 2, 16, 4, 1, 1, 27, 26, '2017-04-26 13:28:44'),
(51, 2, 16, 4, 1, 1, 2, 26, '2017-04-26 13:28:44'),
(52, 2, 16, 4, 1, 1, 34, 26, '2017-04-26 13:28:44'),
(53, 2, 16, 4, 1, 1, 11, 26, '2017-04-26 13:28:44'),
(54, 2, 16, 4, 1, 1, 18, 26, '2017-04-26 13:28:44'),
(55, 2, 17, 7, 6, 51, 0, 2, '2017-04-26 13:28:44'),
(56, 2, 17, 7, 6, 51, 1, 2, '2017-04-26 13:28:44'),
(57, 2, 17, 7, 6, 51, 11, 1, '2017-04-26 13:28:44'),
(58, 2, 17, 7, 6, 51, 12, 1, '2017-04-26 13:28:44'),
(59, 2, 17, 7, 6, 51, 16, 5, '2017-04-26 13:28:44'),
(60, 2, 17, 7, 6, 51, 17, 5, '2017-04-26 13:28:44'),
(61, 2, 18, 7, 7, 51, 13, 2, '2017-04-26 13:28:44'),
(62, 2, 18, 7, 7, 51, 2, 2, '2017-04-26 13:28:44'),
(63, 2, 18, 7, 7, 51, 27, 3, '2017-04-26 13:28:44'),
(64, 2, 18, 7, 7, 51, 28, 3, '2017-04-26 13:28:45'),
(65, 2, 18, 7, 7, 51, 8, 3, '2017-04-26 13:28:45'),
(66, 2, 18, 7, 7, 51, 9, 3, '2017-04-26 13:28:45'),
(67, 2, 19, 7, 8, 51, 19, 2, '2017-04-26 13:28:45'),
(68, 2, 19, 7, 8, 51, 20, 2, '2017-04-26 13:28:45'),
(69, 2, 19, 7, 8, 51, 32, 3, '2017-04-26 13:28:45'),
(70, 2, 19, 7, 8, 51, 33, 3, '2017-04-26 13:28:45'),
(71, 2, 19, 7, 8, 51, 24, 3, '2017-04-26 13:28:45'),
(72, 2, 19, 7, 8, 51, 25, 3, '2017-04-26 13:28:45'),
(73, 2, 20, 7, 1, 1, 10, 26, '2017-04-26 13:28:45'),
(74, 2, 20, 7, 1, 1, 26, 26, '2017-04-26 13:28:45'),
(75, 2, 20, 7, 1, 1, 34, 26, '2017-04-26 13:28:45'),
(76, 2, 20, 7, 1, 1, 3, 26, '2017-04-26 13:28:45'),
(77, 2, 20, 7, 1, 1, 18, 26, '2017-04-26 13:28:45'),
(78, 3, 26, 4, 3, 39, 0, 1, '2017-04-26 14:21:58'),
(79, 3, 26, 4, 3, 39, 1, 1, '2017-04-26 14:21:59'),
(80, 3, 26, 4, 3, 39, 32, 5, '2017-04-26 14:21:59'),
(81, 3, 26, 4, 3, 39, 33, 5, '2017-04-26 14:21:59'),
(82, 3, 26, 4, 3, 39, 25, 3, '2017-04-26 14:21:59'),
(83, 3, 26, 4, 3, 39, 26, 3, '2017-04-26 14:21:59'),
(84, 3, 27, 4, 5, 39, 19, 3, '2017-04-26 14:21:59'),
(85, 3, 27, 4, 5, 39, 20, 3, '2017-04-26 14:21:59'),
(86, 3, 27, 4, 5, 39, 37, 1, '2017-04-26 14:21:59'),
(87, 3, 27, 4, 5, 39, 38, 1, '2017-04-26 14:21:59'),
(88, 3, 27, 4, 5, 39, 13, 5, '2017-04-26 14:21:59'),
(89, 3, 27, 4, 5, 39, 14, 5, '2017-04-26 14:21:59'),
(90, 3, 28, 4, 46, 47, 5, 5, '2017-04-26 14:21:59'),
(91, 3, 28, 4, 46, 47, 6, 5, '2017-04-26 14:21:59'),
(92, 3, 28, 4, 46, 47, 16, 5, '2017-04-26 14:21:59'),
(93, 3, 28, 4, 46, 47, 17, 5, '2017-04-26 14:21:59'),
(94, 3, 29, 4, 53, 5, 29, 22, '2017-04-26 14:21:59'),
(95, 3, 29, 4, 53, 5, 30, 22, '2017-04-26 14:22:00'),
(96, 3, 29, 4, 53, 5, 11, 22, '2017-04-26 14:22:00'),
(97, 3, 30, 4, 42, 39, 8, 1, '2017-04-26 14:22:00'),
(98, 3, 30, 4, 42, 39, 9, 1, '2017-04-26 14:22:00'),
(99, 3, 30, 4, 42, 39, 2, 1, '2017-04-26 14:22:00'),
(100, 3, 31, 4, 1, 1, 18, 26, '2017-04-26 14:22:00'),
(101, 3, 31, 4, 1, 1, 10, 26, '2017-04-26 14:22:00'),
(102, 3, 31, 4, 1, 1, 3, 26, '2017-04-26 14:22:00'),
(103, 3, 31, 4, 1, 1, 34, 26, '2017-04-26 14:22:00'),
(104, 3, 31, 4, 1, 1, 27, 26, '2017-04-26 14:22:00'),
(105, 3, 32, 7, 6, 51, 4, 1, '2017-04-26 14:22:00'),
(106, 3, 32, 7, 6, 51, 5, 1, '2017-04-26 14:22:00'),
(107, 3, 32, 7, 6, 51, 35, 5, '2017-04-26 14:22:00'),
(108, 3, 32, 7, 6, 51, 36, 5, '2017-04-26 14:22:00'),
(109, 3, 32, 7, 6, 51, 21, 5, '2017-04-26 14:22:00'),
(110, 3, 32, 7, 6, 51, 22, 5, '2017-04-26 14:22:00'),
(111, 3, 33, 7, 7, 51, 16, 3, '2017-04-26 14:22:00'),
(112, 3, 33, 7, 7, 51, 17, 3, '2017-04-26 14:22:00'),
(113, 3, 33, 7, 7, 51, 37, 2, '2017-04-26 14:22:00'),
(114, 3, 33, 7, 7, 51, 38, 2, '2017-04-26 14:22:00'),
(115, 3, 33, 7, 7, 51, 29, 5, '2017-04-26 14:22:00'),
(116, 3, 33, 7, 7, 51, 30, 5, '2017-04-26 14:22:00'),
(117, 3, 34, 7, 8, 51, 13, 2, '2017-04-26 14:22:01'),
(118, 3, 34, 7, 8, 51, 14, 2, '2017-04-26 14:22:01'),
(119, 3, 34, 7, 8, 51, 19, 2, '2017-04-26 14:22:01'),
(120, 3, 34, 7, 8, 51, 20, 2, '2017-04-26 14:22:01'),
(121, 3, 34, 7, 8, 51, 32, 3, '2017-04-26 14:22:01'),
(122, 3, 34, 7, 8, 51, 33, 3, '2017-04-26 14:22:01'),
(123, 3, 35, 7, 1, 1, 18, 26, '2017-04-26 14:22:01'),
(124, 3, 35, 7, 1, 1, 3, 26, '2017-04-26 14:22:01'),
(125, 3, 35, 7, 1, 1, 34, 26, '2017-04-26 14:22:01'),
(126, 3, 35, 7, 1, 1, 11, 26, '2017-04-26 14:22:01'),
(127, 3, 35, 7, 1, 1, 27, 26, '2017-04-26 14:22:01'),
(128, 3, 36, 55, 19, 21, 11, 9, '2017-04-26 14:22:01'),
(129, 3, 36, 55, 19, 21, 12, 9, '2017-04-26 14:22:01'),
(130, 3, 36, 55, 19, 21, 2, 9, '2017-04-26 14:22:01'),
(131, 3, 36, 55, 19, 21, 3, 9, '2017-04-26 14:22:01'),
(132, 3, 36, 55, 19, 21, 16, 8, '2017-04-26 14:22:01'),
(133, 3, 36, 55, 19, 21, 17, 8, '2017-04-26 14:22:01'),
(134, 3, 36, 55, 19, 21, 18, 8, '2017-04-26 14:22:01'),
(135, 3, 37, 55, 20, 62, 33, 9, '2017-04-26 14:22:01'),
(136, 3, 37, 55, 20, 62, 34, 9, '2017-04-26 14:22:01'),
(137, 3, 37, 55, 20, 62, 35, 9, '2017-04-26 14:22:01'),
(138, 3, 37, 55, 20, 62, 0, 9, '2017-04-26 14:22:01'),
(139, 3, 37, 55, 20, 62, 1, 9, '2017-04-26 14:22:01'),
(140, 3, 37, 55, 20, 62, 26, 9, '2017-04-26 14:22:02'),
(141, 3, 37, 55, 20, 62, 27, 9, '2017-04-26 14:22:02'),
(142, 3, 38, 55, 47, 28, 32, 2, '2017-04-26 14:22:02'),
(143, 3, 38, 55, 47, 28, 21, 1, '2017-04-26 14:22:02'),
(144, 3, 38, 55, 47, 28, 22, 1, '2017-04-26 14:22:02'),
(145, 3, 38, 55, 47, 28, 24, 5, '2017-04-26 14:22:02'),
(146, 3, 39, 55, 54, 37, 37, 22, '2017-04-26 14:22:02'),
(147, 3, 39, 55, 54, 37, 38, 22, '2017-04-26 14:22:02'),
(148, 3, 39, 55, 54, 37, 10, 22, '2017-04-26 14:22:02'),
(149, 3, 40, 55, 45, 19, 13, 23, '2017-04-26 14:22:02'),
(150, 3, 40, 55, 45, 19, 14, 23, '2017-04-26 14:22:02'),
(151, 3, 40, 55, 45, 19, 28, 23, '2017-04-26 14:22:02'),
(152, 3, 40, 55, 45, 19, 29, 23, '2017-04-26 14:22:02'),
(153, 4, 42, 4, 3, 39, 29, 3, '2017-04-26 14:34:51'),
(154, 4, 42, 4, 3, 39, 30, 3, '2017-04-26 14:34:51'),
(155, 4, 42, 4, 3, 39, 35, 2, '2017-04-26 14:34:51'),
(156, 4, 42, 4, 3, 39, 36, 2, '2017-04-26 14:34:51'),
(157, 4, 42, 4, 3, 39, 0, 1, '2017-04-26 14:34:51'),
(158, 4, 42, 4, 3, 39, 1, 1, '2017-04-26 14:34:51'),
(159, 4, 43, 4, 5, 39, 12, 3, '2017-04-26 14:34:51'),
(160, 4, 43, 4, 5, 39, 13, 3, '2017-04-26 14:34:52'),
(161, 4, 43, 4, 5, 39, 16, 3, '2017-04-26 14:34:52'),
(162, 4, 43, 4, 5, 39, 17, 3, '2017-04-26 14:34:52'),
(163, 4, 43, 4, 5, 39, 5, 3, '2017-04-26 14:34:52'),
(164, 4, 43, 4, 5, 39, 6, 3, '2017-04-26 14:34:52'),
(165, 4, 44, 4, 46, 47, 8, 3, '2017-04-26 14:34:52'),
(166, 4, 44, 4, 46, 47, 9, 3, '2017-04-26 14:34:52'),
(167, 4, 44, 4, 46, 47, 3, 3, '2017-04-26 14:34:52'),
(168, 4, 44, 4, 46, 47, 4, 3, '2017-04-26 14:34:52'),
(169, 4, 45, 4, 53, 5, 26, 22, '2017-04-26 14:34:52'),
(170, 4, 45, 4, 53, 5, 32, 22, '2017-04-26 14:34:52'),
(171, 4, 45, 4, 53, 5, 33, 22, '2017-04-26 14:34:52'),
(172, 4, 46, 4, 42, 39, 24, 1, '2017-04-26 14:34:52'),
(173, 4, 46, 4, 42, 39, 25, 1, '2017-04-26 14:34:52'),
(174, 4, 46, 4, 42, 39, 21, 5, '2017-04-26 14:34:52'),
(175, 4, 47, 4, 1, 1, 34, 26, '2017-04-26 14:34:52'),
(176, 4, 47, 4, 1, 1, 11, 26, '2017-04-26 14:34:52'),
(177, 4, 47, 4, 1, 1, 2, 26, '2017-04-26 14:34:52'),
(178, 4, 47, 4, 1, 1, 18, 26, '2017-04-26 14:34:52'),
(179, 4, 47, 4, 1, 1, 27, 26, '2017-04-26 14:34:52'),
(180, 4, 48, 7, 6, 51, 19, 2, '2017-04-26 14:34:53'),
(181, 4, 48, 7, 6, 51, 20, 2, '2017-04-26 14:34:53'),
(182, 4, 48, 7, 6, 51, 5, 1, '2017-04-26 14:34:53'),
(183, 4, 48, 7, 6, 51, 6, 1, '2017-04-26 14:34:53'),
(184, 4, 48, 7, 6, 51, 8, 5, '2017-04-26 14:34:53'),
(185, 4, 48, 7, 6, 51, 9, 5, '2017-04-26 14:34:53'),
(186, 4, 49, 7, 7, 51, 37, 2, '2017-04-26 14:34:53'),
(187, 4, 49, 7, 7, 51, 38, 2, '2017-04-26 14:34:53'),
(188, 4, 49, 7, 7, 51, 27, 2, '2017-04-26 14:34:53'),
(189, 4, 49, 7, 7, 51, 28, 2, '2017-04-26 14:34:53'),
(190, 4, 49, 7, 7, 51, 16, 5, '2017-04-26 14:34:53'),
(191, 4, 49, 7, 7, 51, 17, 5, '2017-04-26 14:34:53'),
(192, 4, 50, 7, 8, 51, 12, 5, '2017-04-26 14:34:53'),
(193, 4, 50, 7, 8, 51, 13, 5, '2017-04-26 14:34:53'),
(194, 4, 50, 7, 8, 51, 24, 3, '2017-04-26 14:34:53'),
(195, 4, 50, 7, 8, 51, 25, 3, '2017-04-26 14:34:53'),
(196, 4, 50, 7, 8, 51, 3, 2, '2017-04-26 14:34:53'),
(197, 4, 50, 7, 8, 51, 4, 2, '2017-04-26 14:34:53'),
(198, 4, 51, 7, 1, 1, 11, 26, '2017-04-26 14:34:53'),
(199, 4, 51, 7, 1, 1, 26, 26, '2017-04-26 14:34:53'),
(200, 4, 51, 7, 1, 1, 18, 26, '2017-04-26 14:34:53'),
(201, 4, 51, 7, 1, 1, 34, 26, '2017-04-26 14:34:54'),
(202, 4, 51, 7, 1, 1, 2, 26, '2017-04-26 14:34:54'),
(203, 4, 52, 55, 19, 21, 0, 9, '2017-04-26 14:34:54'),
(204, 4, 52, 55, 19, 21, 1, 9, '2017-04-26 14:34:54'),
(205, 4, 52, 55, 19, 21, 2, 9, '2017-04-26 14:34:54'),
(206, 4, 52, 55, 19, 21, 24, 8, '2017-04-26 14:34:54'),
(207, 4, 52, 55, 19, 21, 25, 8, '2017-04-26 14:34:54'),
(208, 4, 52, 55, 19, 21, 11, 9, '2017-04-26 14:34:54'),
(209, 4, 52, 55, 19, 21, 12, 9, '2017-04-26 14:34:54'),
(210, 4, 53, 55, 20, 62, 3, 9, '2017-04-26 14:34:54'),
(211, 4, 53, 55, 20, 62, 4, 9, '2017-04-26 14:34:54'),
(212, 4, 53, 55, 20, 62, 16, 8, '2017-04-26 14:34:54'),
(213, 4, 53, 55, 20, 62, 17, 8, '2017-04-26 14:34:54'),
(214, 4, 53, 55, 20, 62, 32, 9, '2017-04-26 14:34:54'),
(215, 4, 53, 55, 20, 62, 33, 9, '2017-04-26 14:34:54'),
(216, 4, 53, 55, 20, 62, 34, 9, '2017-04-26 14:34:54'),
(217, 4, 54, 55, 47, 28, 22, 3, '2017-04-26 14:34:54'),
(218, 4, 54, 55, 47, 28, 6, 5, '2017-04-26 14:34:54'),
(219, 4, 54, 55, 47, 28, 27, 1, '2017-04-26 14:34:54'),
(220, 4, 54, 55, 47, 28, 28, 1, '2017-04-26 14:34:54'),
(221, 4, 55, 55, 54, 37, 29, 22, '2017-04-26 14:34:54'),
(222, 4, 55, 55, 54, 37, 30, 22, '2017-04-26 14:34:54'),
(223, 4, 55, 55, 54, 37, 8, 22, '2017-04-26 14:34:55'),
(224, 4, 56, 55, 45, 19, 20, 23, '2017-04-26 14:34:55'),
(225, 4, 56, 55, 45, 19, 21, 23, '2017-04-26 14:34:55'),
(226, 4, 56, 55, 45, 19, 37, 23, '2017-04-26 14:34:55'),
(227, 4, 56, 55, 45, 19, 38, 23, '2017-04-26 14:34:55'),
(228, 4, 57, 55, 1, 1, 10, 26, '2017-04-26 14:34:55'),
(229, 4, 57, 55, 1, 1, 35, 26, '2017-04-26 14:34:55'),
(230, 4, 57, 55, 1, 1, 26, 26, '2017-04-26 14:34:55'),
(231, 4, 57, 55, 1, 1, 19, 26, '2017-04-26 14:34:55'),
(232, 4, 57, 55, 1, 1, 2, 26, '2017-04-26 14:34:55'),
(233, 5, 58, 4, 3, 39, 0, 3, '2017-04-26 14:37:49'),
(234, 5, 58, 4, 3, 39, 1, 3, '2017-04-26 14:37:49'),
(235, 5, 58, 4, 3, 39, 24, 3, '2017-04-26 14:37:49'),
(236, 5, 58, 4, 3, 39, 25, 3, '2017-04-26 14:37:49'),
(237, 5, 58, 4, 3, 39, 11, 2, '2017-04-26 14:37:49'),
(238, 5, 58, 4, 3, 39, 12, 2, '2017-04-26 14:37:49'),
(239, 5, 59, 4, 5, 39, 13, 2, '2017-04-26 14:37:49'),
(240, 5, 59, 4, 5, 39, 27, 2, '2017-04-26 14:37:49'),
(241, 5, 59, 4, 5, 39, 3, 5, '2017-04-26 14:37:49'),
(242, 5, 59, 4, 5, 39, 4, 5, '2017-04-26 14:37:49'),
(243, 5, 59, 4, 5, 39, 19, 1, '2017-04-26 14:37:49'),
(244, 5, 59, 4, 5, 39, 20, 1, '2017-04-26 14:37:49'),
(245, 5, 60, 4, 46, 47, 16, 3, '2017-04-26 14:37:49'),
(246, 5, 60, 4, 46, 47, 17, 3, '2017-04-26 14:37:50'),
(247, 5, 60, 4, 46, 47, 35, 1, '2017-04-26 14:37:50'),
(248, 5, 60, 4, 46, 47, 36, 1, '2017-04-26 14:37:50'),
(249, 5, 61, 4, 53, 5, 33, 22, '2017-04-26 14:37:50'),
(250, 5, 61, 4, 53, 5, 8, 22, '2017-04-26 14:37:50'),
(251, 5, 61, 4, 53, 5, 9, 22, '2017-04-26 14:37:50'),
(252, 5, 62, 4, 42, 39, 32, 5, '2017-04-26 14:37:50'),
(253, 5, 62, 4, 42, 39, 28, 5, '2017-04-26 14:37:50'),
(254, 5, 62, 4, 42, 39, 29, 5, '2017-04-26 14:37:50'),
(255, 5, 63, 4, 1, 1, 26, 26, '2017-04-26 14:37:50'),
(256, 5, 63, 4, 1, 1, 2, 26, '2017-04-26 14:37:50'),
(257, 5, 63, 4, 1, 1, 18, 26, '2017-04-26 14:37:50'),
(258, 5, 63, 4, 1, 1, 10, 26, '2017-04-26 14:37:50'),
(259, 5, 63, 4, 1, 1, 34, 26, '2017-04-26 14:37:50'),
(260, 5, 64, 7, 6, 51, 9, 5, '2017-04-26 14:37:50'),
(261, 5, 64, 7, 6, 51, 10, 5, '2017-04-26 14:37:50'),
(262, 5, 64, 7, 6, 51, 21, 2, '2017-04-26 14:37:50'),
(263, 5, 64, 7, 6, 51, 22, 2, '2017-04-26 14:37:50'),
(264, 5, 64, 7, 6, 51, 35, 3, '2017-04-26 14:37:50'),
(265, 5, 64, 7, 6, 51, 36, 3, '2017-04-26 14:37:51'),
(266, 5, 65, 7, 7, 51, 17, 1, '2017-04-26 14:37:51'),
(267, 5, 65, 7, 7, 51, 18, 1, '2017-04-26 14:37:51'),
(268, 5, 65, 7, 7, 51, 0, 2, '2017-04-26 14:37:51'),
(269, 5, 65, 7, 7, 51, 1, 2, '2017-04-26 14:37:51'),
(270, 5, 65, 7, 7, 51, 24, 2, '2017-04-26 14:37:51'),
(271, 5, 65, 7, 7, 51, 25, 2, '2017-04-26 14:37:51'),
(272, 5, 66, 7, 8, 51, 3, 1, '2017-04-26 14:37:51'),
(273, 5, 66, 7, 8, 51, 4, 1, '2017-04-26 14:37:51'),
(274, 5, 66, 7, 8, 51, 12, 1, '2017-04-26 14:37:51'),
(275, 5, 66, 7, 8, 51, 13, 1, '2017-04-26 14:37:51'),
(276, 5, 66, 7, 8, 51, 27, 1, '2017-04-26 14:37:51'),
(277, 5, 66, 7, 8, 51, 28, 1, '2017-04-26 14:37:51'),
(278, 5, 67, 7, 1, 1, 2, 26, '2017-04-26 14:37:51'),
(279, 5, 67, 7, 1, 1, 11, 26, '2017-04-26 14:37:51'),
(280, 5, 67, 7, 1, 1, 34, 26, '2017-04-26 14:37:51'),
(281, 5, 67, 7, 1, 1, 19, 26, '2017-04-26 14:37:51'),
(282, 5, 67, 7, 1, 1, 26, 26, '2017-04-26 14:37:51'),
(283, 5, 68, 55, 19, 21, 36, 8, '2017-04-26 14:37:51'),
(284, 5, 68, 55, 19, 21, 35, 8, '2017-04-26 14:37:51'),
(285, 5, 68, 55, 19, 21, 8, 9, '2017-04-26 14:37:51'),
(286, 5, 68, 55, 19, 21, 9, 9, '2017-04-26 14:37:51'),
(287, 5, 68, 55, 19, 21, 10, 9, '2017-04-26 14:37:51'),
(288, 5, 68, 55, 19, 21, 24, 9, '2017-04-26 14:37:52'),
(289, 5, 68, 55, 19, 21, 25, 9, '2017-04-26 14:37:52'),
(290, 5, 69, 55, 20, 62, 0, 8, '2017-04-26 14:37:52'),
(291, 5, 69, 55, 20, 62, 1, 8, '2017-04-26 14:37:52'),
(292, 5, 69, 55, 20, 62, 17, 8, '2017-04-26 14:37:52'),
(293, 5, 69, 55, 20, 62, 16, 8, '2017-04-26 14:37:52'),
(294, 5, 69, 55, 20, 62, 19, 8, '2017-04-26 14:37:52'),
(295, 5, 69, 55, 20, 62, 26, 9, '2017-04-26 14:37:52'),
(296, 5, 69, 55, 20, 62, 13, 9, '2017-04-26 14:37:52'),
(297, 5, 70, 55, 47, 28, 4, 3, '2017-04-26 14:37:52'),
(298, 5, 70, 55, 47, 28, 2, 5, '2017-04-26 14:37:52'),
(299, 5, 70, 55, 47, 28, 20, 5, '2017-04-26 14:37:52'),
(300, 5, 70, 55, 47, 28, 21, 5, '2017-04-26 14:37:52'),
(301, 5, 71, 55, 54, 37, 12, 22, '2017-04-26 14:37:52'),
(302, 5, 71, 55, 54, 37, 5, 22, '2017-04-26 14:37:52'),
(303, 5, 71, 55, 54, 37, 6, 22, '2017-04-26 14:37:52'),
(304, 5, 72, 55, 45, 19, 32, 23, '2017-04-26 14:37:52'),
(305, 5, 72, 55, 45, 19, 33, 23, '2017-04-26 14:37:52'),
(306, 5, 72, 55, 45, 19, 28, 23, '2017-04-26 14:37:52'),
(307, 5, 72, 55, 45, 19, 29, 23, '2017-04-26 14:37:52'),
(308, 5, 73, 55, 1, 1, 27, 26, '2017-04-26 14:37:52'),
(309, 5, 73, 55, 1, 1, 3, 26, '2017-04-26 14:37:53'),
(310, 5, 73, 55, 1, 1, 18, 26, '2017-04-26 14:37:53'),
(311, 5, 73, 55, 1, 1, 11, 26, '2017-04-26 14:37:53'),
(312, 5, 73, 55, 1, 1, 34, 26, '2017-04-26 14:37:53');

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
(25, 'Any Room ', 9, 'Campus', 'any room'),
(26, 'Free Room', 14, 'Free Room', 'Free Room'),
(27, 'ELC WRKSHOP 3', 7, 'Main Building', 'Electrical workshop');

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
(9, 'Same Type Room', 'Same Type Room'),
(10, 'Caravan', 'Rooms for English Foundation Program'),
(11, 'Caravan-Converted room', 'Rooms for non-English Foundation Program'),
(12, 'ELC-Converted room', 'Dedicated room for ELC lecture classes'),
(13, 'ELX-Converted room', 'Dedicated room for ELX lecture classes'),
(14, 'Free Room', 'Free Room');

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
(1, 'STUDY BREAK', 'STUDY BREAK', 5, ''),
(2, 'BBSSM 1101', 'PRINCIPLES OF MARKETING ', 6, ''),
(3, 'BBSSM 1102', 'INTRODUCTION TO SELLING ', 6, ''),
(4, 'BBSSM 1103', 'ECONOMICS', 6, ''),
(5, 'BBSSM 1201', 'BUSINESS ETHICS', 6, ''),
(6, 'BBSSM 1202', 'ADVERTISIMENT & PROMOTION', 6, ''),
(7, 'BBSSM 1203', 'CONSUMER BEHAVIOR ', 6, ''),
(8, 'BBSSM 1204', 'BUSINESS RESEARCH METHODS', 6, ''),
(9, 'BBSSM 2101', 'DIRECT MARKETING ', 6, ''),
(10, 'BBSSM 2102', 'RETAILING MANAGEMENT ', 6, ''),
(11, 'BBSSM 2103', 'RETAIL PRICING STRAGEGIES ', 6, ''),
(12, 'BBSSM 2104', 'PROFESSIONAL SELLING ', 6, ''),
(13, 'BBSSM 2201', 'CUSTOMER RELATIONSHIP MGT.', 6, ''),
(14, 'BBSSM 2201x', 'MANAGEMENT AND ORGANIZATION ', 10, ''),
(15, 'BBSSM 2204', 'MARKETING COMMUINCATION', 10, ''),
(16, 'BBSSM 2204x', 'GRADUATION PROJECT ', 10, ''),
(17, 'CHEM 1101', 'Chemistry 1', 4, ''),
(18, 'CHEM 1202', 'Chemistry 2', 4, ''),
(19, 'EECIM 1101', 'Basic Electricity and System', 7, ''),
(20, 'EECIM 1102', 'Basic Electronics and Circuits', 7, ''),
(21, 'EECIM 1103', 'Fundamental Digital Electronics Circuits', 10, ''),
(22, 'EECIM 1203', 'ELX-?', 7, ''),
(23, 'EECIM 1204', 'Installation, Servicing Audio-Video Systems', 5, ''),
(24, 'EECIM 1205', 'Switched-Mode Power Supplies & Autovolt Power', 10, ''),
(25, 'EECIM 1206', 'Electronics Devices Servicing 1', 10, ''),
(26, 'EECIM 1305', 'ELX-?', 5, ''),
(27, 'EECIM 2107', 'Personal Computers and Multimedia Devices', 10, ''),
(28, 'EECIM 2108', 'Computer System Data Comm. & Internetworking', 10, ''),
(29, 'EECIM 2109', 'Graduation Project 1', 10, ''),
(30, 'EECIM 2210', 'Security Alarm systems', 10, ''),
(31, 'EECIM 2211', 'Electronics Devices Servicing 2', 10, ''),
(32, 'EECIM 2212', 'Graduation Project 2', 10, ''),
(33, 'EELIHW 1101', 'Health and Safety Precautions', 1, ''),
(34, 'EELIHW 1102', 'Basic Electricity(AC/DC) &Electrical Code', 5, ''),
(35, 'EELIHW 1103', 'Tools, Instruments, Electric wires and cable works', 5, ''),
(36, 'EELIHW 1204', 'Basic Electronics', 4, ''),
(37, 'EELIHW 1205', 'Electrical-Circuits and Protection Devices', 10, ''),
(38, 'EELIHW 1206', 'Three Phase Principles', 10, ''),
(39, 'EENDR 1101', 'Engineering Drawing 1', 10, ''),
(40, 'EENDR 1202', 'Engineering Drawing 2', 10, ''),
(41, 'ENTRP 1101', 'Entrepreneurship 1', 3, ''),
(42, 'ENTRP 1203', 'Entrepreneurship 2', 3, ''),
(43, 'INBS 1202', 'E- COMMERCE ', 4, ''),
(44, 'INTE 1101 ', 'ADVANCED IT SKILLS ', 4, ''),
(45, 'INTE 1202', 'INTRODUCTION TO C++ Programming', 4, ''),
(46, 'MTBS 1202', 'BUSINESS MATHEMATICS', 4, ''),
(47, 'MTCL 1101', 'Calculus', 4, ''),
(48, 'MTCL 1202', 'Engineering Mathematics', 4, ''),
(49, 'MTST 1101', 'STATISTICS ', 4, ''),
(50, 'PHYS 1101', 'Physics 1', 4, ''),
(51, 'PHYS 1202', 'Physics 2', 4, ''),
(52, 'PUENG 2101', 'Public Speaking', 3, ''),
(53, 'TCENG 1202', 'Technical Communication', 3, ''),
(54, 'TWENG 1101', 'TECHNICAL WRINTING ', 3, ''),
(55, 'EELIHW 1203', 'EELIHW 1203 x', 7, ''),
(56, 'EELIHW 2107', 'EELIHW 2107 x', 8, ''),
(57, 'EELIHW 2108', 'EELIHW 2108 x', 5, ''),
(58, 'EELIHW 2209', 'EELIHW 2209 x', 12, ''),
(59, 'EELIHW 2210', 'EELIHW 2210 x', 9, '');

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
(1, 1, 3, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(2, 1, 5, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(3, 1, 46, 4, 47, 25, 1, NULL, NULL, 1, 7, 2),
(4, 1, 53, 4, 5, 22, 11, NULL, 1, 1, 7, 2),
(5, 1, 42, 4, 39, 25, 1, NULL, NULL, 1, 7, 2),
(6, 1, 1, 4, 1, 26, 14, NULL, 1, 3, 4, 5),
(7, 1, 6, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(8, 1, 7, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(9, 1, 8, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(10, 1, 1, 7, 1, 26, 14, NULL, 1, 3, 4, 5),
(11, 2, 3, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(12, 2, 5, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(13, 2, 46, 4, 47, 25, 1, NULL, NULL, 1, 7, 2),
(14, 2, 53, 4, 5, 22, 11, NULL, 1, 1, 7, 2),
(15, 2, 42, 4, 39, 25, 1, NULL, NULL, 1, 7, 2),
(16, 2, 1, 4, 1, 26, 14, NULL, 1, 3, 4, 5),
(17, 2, 6, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(18, 2, 7, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(19, 2, 8, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(20, 2, 1, 7, 1, 26, 14, NULL, 1, 3, 4, 5),
(21, 2, 19, 55, 21, 25, 6, NULL, NULL, 1, 5, 3),
(22, 2, 20, 55, 62, 25, 6, NULL, NULL, 1, 5, 3),
(23, 2, 47, 55, 28, 25, 1, NULL, NULL, 1, 7, 3),
(24, 2, 54, 55, 37, 22, 11, NULL, 1, 1, 7, 2),
(25, 2, 45, 55, 19, 23, 2, NULL, 1, 1, 7, 2),
(26, 3, 3, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(27, 3, 5, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(28, 3, 46, 4, 47, 25, 1, NULL, NULL, 1, 7, 2),
(29, 3, 53, 4, 5, 22, 11, NULL, 1, 1, 7, 2),
(30, 3, 42, 4, 39, 25, 1, NULL, NULL, 1, 7, 2),
(31, 3, 1, 4, 1, 26, 14, NULL, 1, 3, 4, 5),
(32, 3, 6, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(33, 3, 7, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(34, 3, 8, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(35, 3, 1, 7, 1, 26, 14, NULL, 1, 3, 4, 5),
(36, 3, 19, 55, 21, 25, 6, NULL, NULL, 1, 5, 3),
(37, 3, 20, 55, 62, 25, 6, NULL, NULL, 1, 5, 3),
(38, 3, 47, 55, 28, 25, 1, NULL, NULL, 1, 7, 3),
(39, 3, 54, 55, 37, 22, 11, NULL, 1, 1, 7, 2),
(40, 3, 45, 55, 19, 23, 2, NULL, 1, 1, 7, 2),
(41, 3, 1, 55, 1, 26, 14, NULL, 1, 3, 4, 5),
(42, 4, 3, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(43, 4, 5, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(44, 4, 46, 4, 47, 25, 1, NULL, NULL, 1, 7, 2),
(45, 4, 53, 4, 5, 22, 11, NULL, 1, 1, 7, 2),
(46, 4, 42, 4, 39, 25, 1, NULL, NULL, 1, 7, 2),
(47, 4, 1, 4, 1, 26, 14, NULL, 1, 3, 4, 5),
(48, 4, 6, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(49, 4, 7, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(50, 4, 8, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(51, 4, 1, 7, 1, 26, 14, NULL, 1, 3, 4, 5),
(52, 4, 19, 55, 21, 25, 6, NULL, NULL, 1, 5, 3),
(53, 4, 20, 55, 62, 25, 6, NULL, NULL, 1, 5, 3),
(54, 4, 47, 55, 28, 25, 1, NULL, NULL, 1, 7, 3),
(55, 4, 54, 55, 37, 22, 11, NULL, 1, 1, 7, 2),
(56, 4, 45, 55, 19, 23, 2, NULL, 1, 1, 7, 2),
(57, 4, 1, 55, 1, 26, 14, NULL, 1, 3, 4, 5),
(58, 5, 3, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(59, 5, 5, 4, 39, 25, 1, NULL, NULL, 1, 7, 3),
(60, 5, 46, 4, 47, 25, 1, NULL, NULL, 1, 7, 2),
(61, 5, 53, 4, 5, 22, 11, NULL, 1, 1, 7, 2),
(62, 5, 42, 4, 39, 25, 1, NULL, NULL, 1, 7, 2),
(63, 5, 1, 4, 1, 26, 14, NULL, 1, 3, 4, 5),
(64, 5, 6, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(65, 5, 7, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(66, 5, 8, 7, 51, 25, 1, NULL, NULL, 1, 7, 3),
(67, 5, 1, 7, 1, 26, 14, NULL, 1, 3, 4, 5),
(68, 5, 19, 55, 21, 25, 6, NULL, NULL, 1, 5, 3),
(69, 5, 20, 55, 62, 25, 6, NULL, NULL, 1, 5, 3),
(70, 5, 47, 55, 28, 25, 1, NULL, NULL, 1, 7, 3),
(71, 5, 54, 55, 37, 22, 11, NULL, 1, 1, 7, 2),
(72, 5, 45, 55, 19, 23, 2, NULL, 1, 1, 7, 2),
(73, 5, 1, 55, 1, 26, 14, NULL, 1, 3, 4, 5);

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
(1, 2017, 2018, '3', '(0)Conflict/s []', '2017-04-26 12:38:52', 0),
(2, 2017, 2018, '3', '(0)Conflict/s []', '2017-04-26 13:28:32', 0),
(3, 2017, 2018, '3', '(0)Conflict/s []', '2017-04-26 14:21:10', 0),
(4, 2017, 2018, '3', '(1)Conflict/s [2.]', '2017-04-26 14:24:13', 0),
(5, 2017, 2018, '3', '(0)Conflict/s []', '2017-04-26 14:35:55', 1);

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
  `password` varchar(255) NOT NULL DEFAULT '',
  `rights` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `password`, `rights`) VALUES
(1, 'admin@admin.com', 'Johnny', 'Doe', '$2y$10$SBk70HrdjF0H0npd2Qskjebdp82QLUePCZ5RiTll7Vjs9f70yMs3i', 1),
(4, 'user@user.com', 'Janey', 'Doe', '$2y$10$K3UE/LwXA2eo0/i9laVkSuNhUWcgVkAjp0LBtudZUzAwyRqZ2Czhi', 0);

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `trainee_group`
--
ALTER TABLE `trainee_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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