-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2017 at 11:56 AM
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
(1, 1, 1, 4, 3, 63, 34, 5, '2017-04-05 09:17:32'),
(2, 1, 1, 4, 3, 63, 35, 5, '2017-04-05 09:17:32'),
(3, 1, 1, 4, 3, 63, 25, 5, '2017-04-05 09:17:32'),
(4, 1, 1, 4, 3, 63, 26, 5, '2017-04-05 09:17:32'),
(5, 1, 1, 4, 3, 63, 16, 5, '2017-04-05 09:17:32'),
(6, 1, 1, 4, 3, 63, 17, 5, '2017-04-05 09:17:32'),
(7, 1, 2, 4, 5, 51, 37, 2, '2017-04-05 09:17:32'),
(8, 1, 2, 4, 5, 51, 38, 2, '2017-04-05 09:17:32'),
(9, 1, 2, 4, 5, 51, 9, 2, '2017-04-05 09:17:32'),
(10, 1, 2, 4, 5, 51, 10, 2, '2017-04-05 09:17:32'),
(11, 1, 2, 4, 5, 51, 24, 2, '2017-04-05 09:17:32'),
(12, 1, 2, 4, 5, 51, 25, 2, '2017-04-05 09:17:32'),
(13, 1, 3, 4, 46, 47, 2, 5, '2017-04-05 09:17:32'),
(14, 1, 3, 4, 46, 47, 3, 5, '2017-04-05 09:17:33'),
(15, 1, 3, 4, 46, 47, 12, 5, '2017-04-05 09:17:33'),
(16, 1, 3, 4, 46, 47, 13, 5, '2017-04-05 09:17:33'),
(17, 1, 4, 4, 53, 5, 0, 22, '2017-04-05 09:17:33'),
(18, 1, 4, 4, 53, 5, 1, 22, '2017-04-05 09:17:33'),
(19, 1, 4, 4, 53, 5, 22, 22, '2017-04-05 09:17:33'),
(20, 1, 5, 4, 42, 51, 18, 1, '2017-04-05 09:17:33'),
(21, 1, 5, 4, 42, 51, 19, 1, '2017-04-05 09:17:33'),
(22, 1, 5, 4, 42, 51, 20, 1, '2017-04-05 09:17:33'),
(23, 2, 6, 4, 3, 63, 25, 2, '2017-04-05 09:18:23'),
(24, 2, 6, 4, 3, 63, 26, 2, '2017-04-05 09:18:23'),
(25, 2, 6, 4, 3, 63, 3, 2, '2017-04-05 09:18:23'),
(26, 2, 6, 4, 3, 63, 4, 2, '2017-04-05 09:18:23'),
(27, 2, 6, 4, 3, 63, 20, 2, '2017-04-05 09:18:23'),
(28, 2, 6, 4, 3, 63, 21, 2, '2017-04-05 09:18:23'),
(29, 2, 7, 4, 5, 51, 28, 3, '2017-04-05 09:18:23'),
(30, 2, 7, 4, 5, 51, 29, 3, '2017-04-05 09:18:23'),
(31, 2, 7, 4, 5, 51, 0, 3, '2017-04-05 09:18:23'),
(32, 2, 7, 4, 5, 51, 1, 3, '2017-04-05 09:18:23'),
(33, 2, 7, 4, 5, 51, 16, 3, '2017-04-05 09:18:23'),
(34, 2, 7, 4, 5, 51, 17, 3, '2017-04-05 09:18:23'),
(35, 2, 8, 4, 46, 47, 38, 1, '2017-04-05 09:18:23'),
(36, 2, 8, 4, 46, 47, 39, 1, '2017-04-05 09:18:23'),
(37, 2, 8, 4, 46, 47, 13, 1, '2017-04-05 09:18:23'),
(38, 2, 8, 4, 46, 47, 14, 1, '2017-04-05 09:18:23'),
(39, 2, 9, 4, 53, 5, 22, 22, '2017-04-05 09:18:23'),
(40, 2, 9, 4, 53, 5, 34, 22, '2017-04-05 09:18:23'),
(41, 2, 9, 4, 53, 5, 35, 22, '2017-04-05 09:18:23'),
(42, 2, 10, 4, 42, 51, 9, 2, '2017-04-05 09:18:23'),
(43, 2, 10, 4, 42, 51, 10, 2, '2017-04-05 09:18:23'),
(44, 2, 10, 4, 42, 51, 11, 2, '2017-04-05 09:18:23'),
(45, 3, 12, 4, 3, 63, 18, 3, '2017-04-05 09:21:20'),
(46, 3, 12, 4, 3, 63, 19, 3, '2017-04-05 09:21:20'),
(47, 3, 12, 4, 3, 63, 13, 3, '2017-04-05 09:21:20'),
(48, 3, 12, 4, 3, 63, 14, 3, '2017-04-05 09:21:20'),
(49, 3, 12, 4, 3, 63, 27, 3, '2017-04-05 09:21:20'),
(50, 3, 12, 4, 3, 63, 28, 3, '2017-04-05 09:21:20'),
(51, 3, 13, 4, 5, 51, 35, 5, '2017-04-05 09:21:20'),
(52, 3, 13, 4, 5, 51, 36, 5, '2017-04-05 09:21:20'),
(53, 3, 13, 4, 5, 51, 29, 5, '2017-04-05 09:21:20'),
(54, 3, 13, 4, 5, 51, 30, 5, '2017-04-05 09:21:20'),
(55, 3, 13, 4, 5, 51, 2, 5, '2017-04-05 09:21:20'),
(56, 3, 13, 4, 5, 51, 3, 5, '2017-04-05 09:21:20'),
(57, 3, 14, 4, 46, 47, 5, 3, '2017-04-05 09:21:20'),
(58, 3, 14, 4, 46, 47, 6, 3, '2017-04-05 09:21:20'),
(59, 3, 14, 4, 46, 47, 21, 3, '2017-04-05 09:21:21'),
(60, 3, 14, 4, 46, 47, 22, 3, '2017-04-05 09:21:21'),
(61, 3, 15, 4, 53, 5, 26, 22, '2017-04-05 09:21:21'),
(62, 3, 15, 4, 53, 5, 32, 22, '2017-04-05 09:21:21'),
(63, 3, 15, 4, 53, 5, 33, 22, '2017-04-05 09:21:21'),
(64, 3, 16, 4, 42, 51, 37, 5, '2017-04-05 09:21:21'),
(65, 3, 16, 4, 42, 51, 38, 5, '2017-04-05 09:21:21'),
(66, 3, 16, 4, 42, 51, 39, 5, '2017-04-05 09:21:21'),
(67, 3, 17, 4, 1, 1, 17, 26, '2017-04-05 09:21:21'),
(68, 3, 17, 4, 1, 1, 10, 26, '2017-04-05 09:21:21'),
(69, 3, 17, 4, 1, 1, 1, 26, '2017-04-05 09:21:21'),
(70, 3, 17, 4, 1, 1, 25, 26, '2017-04-05 09:21:21'),
(71, 3, 17, 4, 1, 1, 34, 26, '2017-04-05 09:21:21'),
(72, 4, 24, 4, 3, 63, 33, 1, '2017-04-05 09:33:21'),
(73, 4, 24, 4, 3, 63, 34, 1, '2017-04-05 09:33:22'),
(74, 4, 24, 4, 3, 63, 20, 1, '2017-04-05 09:33:22'),
(75, 4, 24, 4, 3, 63, 21, 1, '2017-04-05 09:33:22'),
(76, 4, 24, 4, 3, 63, 8, 1, '2017-04-05 09:33:22'),
(77, 4, 24, 4, 3, 63, 9, 1, '2017-04-05 09:33:22'),
(78, 4, 25, 4, 5, 51, 28, 2, '2017-04-05 09:33:22'),
(79, 4, 25, 4, 5, 51, 29, 2, '2017-04-05 09:33:22'),
(80, 4, 25, 4, 5, 51, 0, 2, '2017-04-05 09:33:22'),
(81, 4, 25, 4, 5, 51, 1, 2, '2017-04-05 09:33:22'),
(82, 4, 25, 4, 5, 51, 22, 2, '2017-04-05 09:33:22'),
(83, 4, 25, 4, 5, 51, 23, 2, '2017-04-05 09:33:22'),
(84, 4, 26, 4, 46, 47, 11, 5, '2017-04-05 09:33:22'),
(85, 4, 26, 4, 46, 47, 12, 5, '2017-04-05 09:33:22'),
(86, 4, 26, 4, 46, 47, 38, 5, '2017-04-05 09:33:22'),
(87, 4, 26, 4, 46, 47, 39, 5, '2017-04-05 09:33:22'),
(88, 4, 27, 4, 53, 5, 24, 22, '2017-04-05 09:33:22'),
(89, 4, 27, 4, 53, 5, 25, 22, '2017-04-05 09:33:22'),
(90, 4, 27, 4, 53, 5, 7, 22, '2017-04-05 09:33:22'),
(91, 4, 28, 4, 42, 51, 13, 3, '2017-04-05 09:33:22'),
(92, 4, 28, 4, 42, 51, 14, 3, '2017-04-05 09:33:22'),
(93, 4, 28, 4, 42, 51, 15, 3, '2017-04-05 09:33:22'),
(94, 4, 29, 4, 1, 1, 17, 26, '2017-04-05 09:33:22'),
(95, 4, 29, 4, 1, 1, 26, 26, '2017-04-05 09:33:22'),
(96, 4, 29, 4, 1, 1, 3, 26, '2017-04-05 09:33:22'),
(97, 4, 29, 4, 1, 1, 35, 26, '2017-04-05 09:33:22'),
(98, 4, 29, 4, 1, 1, 10, 26, '2017-04-05 09:33:22'),
(99, 4, 30, 31, 55, 26, 8, 10, '2017-04-05 09:33:22'),
(100, 4, 30, 31, 55, 26, 9, 10, '2017-04-05 09:33:22'),
(101, 4, 30, 31, 55, 26, 10, 10, '2017-04-05 09:33:22'),
(102, 4, 30, 31, 55, 26, 24, 10, '2017-04-05 09:33:22'),
(103, 4, 30, 31, 55, 26, 25, 10, '2017-04-05 09:33:22'),
(104, 4, 30, 31, 55, 26, 32, 10, '2017-04-05 09:33:22'),
(105, 4, 30, 31, 55, 26, 33, 10, '2017-04-05 09:33:22'),
(106, 4, 31, 31, 36, 25, 16, 11, '2017-04-05 09:33:23'),
(107, 4, 31, 31, 36, 25, 17, 11, '2017-04-05 09:33:23'),
(108, 4, 31, 31, 36, 25, 0, 11, '2017-04-05 09:33:23'),
(109, 4, 31, 31, 36, 25, 1, 11, '2017-04-05 09:33:23'),
(110, 4, 32, 31, 51, 16, 6, 1, '2017-04-05 09:33:23'),
(111, 4, 32, 31, 51, 16, 7, 1, '2017-04-05 09:33:23'),
(112, 4, 32, 31, 51, 16, 37, 1, '2017-04-05 09:33:23'),
(113, 4, 32, 31, 51, 16, 38, 1, '2017-04-05 09:33:23'),
(114, 4, 33, 31, 48, 15, 30, 3, '2017-04-05 09:33:23'),
(115, 4, 33, 31, 48, 15, 31, 3, '2017-04-05 09:33:23'),
(116, 4, 33, 31, 48, 15, 4, 3, '2017-04-05 09:33:23'),
(117, 4, 33, 31, 48, 15, 5, 3, '2017-04-05 09:33:23'),
(118, 4, 34, 31, 53, 5, 20, 22, '2017-04-05 09:33:23'),
(119, 4, 34, 31, 53, 5, 21, 22, '2017-04-05 09:33:23'),
(120, 4, 34, 31, 53, 5, 12, 22, '2017-04-05 09:33:23'),
(121, 4, 35, 31, 1, 1, 11, 26, '2017-04-05 09:33:23'),
(122, 4, 35, 31, 1, 1, 27, 26, '2017-04-05 09:33:23'),
(123, 4, 35, 31, 1, 1, 34, 26, '2017-04-05 09:33:23'),
(124, 4, 35, 31, 1, 1, 2, 26, '2017-04-05 09:33:23'),
(125, 4, 35, 31, 1, 1, 18, 26, '2017-04-05 09:33:23'),
(126, 5, 41, 4, 3, 63, 18, 3, '2017-04-05 09:42:44'),
(127, 5, 41, 4, 3, 63, 19, 3, '2017-04-05 09:42:44'),
(128, 5, 41, 4, 3, 63, 2, 3, '2017-04-05 09:42:44'),
(129, 5, 41, 4, 3, 63, 3, 3, '2017-04-05 09:42:44'),
(130, 5, 41, 4, 3, 63, 37, 3, '2017-04-05 09:42:44'),
(131, 5, 41, 4, 3, 63, 38, 3, '2017-04-05 09:42:44'),
(132, 5, 42, 4, 5, 51, 32, 5, '2017-04-05 09:42:44'),
(133, 5, 42, 4, 5, 51, 33, 5, '2017-04-05 09:42:45'),
(134, 5, 42, 4, 5, 51, 5, 5, '2017-04-05 09:42:45'),
(135, 5, 42, 4, 5, 51, 6, 5, '2017-04-05 09:42:45'),
(136, 5, 42, 4, 5, 51, 29, 5, '2017-04-05 09:42:45'),
(137, 5, 42, 4, 5, 51, 30, 5, '2017-04-05 09:42:45'),
(138, 5, 43, 4, 46, 47, 35, 5, '2017-04-05 09:42:45'),
(139, 5, 43, 4, 46, 47, 36, 5, '2017-04-05 09:42:45'),
(140, 5, 43, 4, 46, 47, 22, 5, '2017-04-05 09:42:45'),
(141, 5, 43, 4, 46, 47, 23, 5, '2017-04-05 09:42:45'),
(142, 5, 44, 4, 53, 5, 0, 22, '2017-04-05 09:42:45'),
(143, 5, 44, 4, 53, 5, 20, 22, '2017-04-05 09:42:45'),
(144, 5, 44, 4, 53, 5, 21, 22, '2017-04-05 09:42:45'),
(145, 5, 45, 4, 42, 51, 12, 2, '2017-04-05 09:42:45'),
(146, 5, 45, 4, 42, 51, 13, 2, '2017-04-05 09:42:45'),
(147, 5, 45, 4, 42, 51, 14, 2, '2017-04-05 09:42:45'),
(148, 5, 46, 4, 1, 1, 17, 26, '2017-04-05 09:42:45'),
(149, 5, 46, 4, 1, 1, 34, 26, '2017-04-05 09:42:45'),
(150, 5, 46, 4, 1, 1, 25, 26, '2017-04-05 09:42:45'),
(151, 5, 46, 4, 1, 1, 10, 26, '2017-04-05 09:42:45'),
(152, 5, 46, 4, 1, 1, 1, 26, '2017-04-05 09:42:45'),
(153, 5, 47, 31, 55, 26, 32, 11, '2017-04-05 09:42:45'),
(154, 5, 47, 31, 55, 26, 33, 11, '2017-04-05 09:42:45'),
(155, 5, 47, 31, 55, 26, 8, 11, '2017-04-05 09:42:45'),
(156, 5, 47, 31, 55, 26, 9, 11, '2017-04-05 09:42:45'),
(157, 5, 47, 31, 55, 26, 16, 11, '2017-04-05 09:42:45'),
(158, 5, 47, 31, 55, 26, 17, 11, '2017-04-05 09:42:45'),
(159, 5, 47, 31, 55, 26, 18, 11, '2017-04-05 09:42:45'),
(160, 5, 48, 31, 36, 25, 0, 10, '2017-04-05 09:42:45'),
(161, 5, 48, 31, 36, 25, 1, 10, '2017-04-05 09:42:45'),
(162, 5, 48, 31, 36, 25, 25, 10, '2017-04-05 09:42:45'),
(163, 5, 48, 31, 36, 25, 26, 10, '2017-04-05 09:42:45'),
(164, 5, 49, 31, 51, 16, 22, 1, '2017-04-05 09:42:45'),
(165, 5, 49, 31, 51, 16, 23, 1, '2017-04-05 09:42:45'),
(166, 5, 49, 31, 51, 16, 6, 1, '2017-04-05 09:42:45'),
(167, 5, 49, 31, 51, 16, 7, 1, '2017-04-05 09:42:45'),
(168, 5, 50, 31, 48, 15, 13, 3, '2017-04-05 09:42:45'),
(169, 5, 50, 31, 48, 15, 14, 3, '2017-04-05 09:42:45'),
(170, 5, 50, 31, 48, 15, 29, 3, '2017-04-05 09:42:46'),
(171, 5, 50, 31, 48, 15, 30, 3, '2017-04-05 09:42:46'),
(172, 5, 51, 31, 53, 5, 12, 22, '2017-04-05 09:42:46'),
(173, 5, 51, 31, 53, 5, 4, 22, '2017-04-05 09:42:46'),
(174, 5, 51, 31, 53, 5, 5, 22, '2017-04-05 09:42:46'),
(175, 5, 52, 31, 1, 1, 11, 26, '2017-04-05 09:42:46'),
(176, 5, 52, 31, 1, 1, 2, 26, '2017-04-05 09:42:46'),
(177, 5, 52, 31, 1, 1, 19, 26, '2017-04-05 09:42:46'),
(178, 5, 52, 31, 1, 1, 35, 26, '2017-04-05 09:42:46'),
(179, 5, 52, 31, 1, 1, 27, 26, '2017-04-05 09:42:46'),
(180, 5, 53, 58, 22, 18, 1, 4, '2017-04-05 09:42:46'),
(181, 5, 53, 58, 22, 18, 2, 4, '2017-04-05 09:42:46'),
(182, 5, 53, 58, 22, 18, 3, 4, '2017-04-05 09:42:46'),
(183, 5, 53, 58, 22, 18, 8, 4, '2017-04-05 09:42:46'),
(184, 5, 53, 58, 22, 18, 9, 4, '2017-04-05 09:42:46'),
(185, 5, 53, 58, 22, 18, 16, 4, '2017-04-05 09:42:46'),
(186, 5, 53, 58, 22, 18, 17, 4, '2017-04-05 09:42:46'),
(187, 5, 54, 58, 23, 62, 34, 9, '2017-04-05 09:42:46'),
(188, 5, 54, 58, 23, 62, 35, 9, '2017-04-05 09:42:46'),
(189, 5, 54, 58, 23, 62, 25, 9, '2017-04-05 09:42:46'),
(190, 5, 54, 58, 23, 62, 26, 9, '2017-04-05 09:42:46'),
(191, 5, 54, 58, 23, 62, 27, 9, '2017-04-05 09:42:46'),
(192, 5, 55, 58, 26, 21, 9, 9, '2017-04-05 09:42:46'),
(193, 5, 55, 58, 26, 21, 10, 9, '2017-04-05 09:42:46'),
(194, 5, 55, 58, 26, 21, 11, 9, '2017-04-05 09:42:46'),
(195, 5, 55, 58, 26, 21, 32, 9, '2017-04-05 09:42:46'),
(196, 5, 55, 58, 26, 21, 33, 9, '2017-04-05 09:42:46'),
(197, 5, 56, 58, 53, 5, 7, 22, '2017-04-05 09:42:46'),
(198, 5, 56, 58, 53, 5, 30, 22, '2017-04-05 09:42:46'),
(199, 5, 56, 58, 53, 5, 31, 22, '2017-04-05 09:42:46'),
(200, 5, 57, 58, 48, 43, 36, 1, '2017-04-05 09:42:46'),
(201, 5, 57, 58, 48, 43, 37, 1, '2017-04-05 09:42:46'),
(202, 5, 57, 58, 48, 43, 18, 1, '2017-04-05 09:42:46'),
(203, 5, 57, 58, 48, 43, 19, 1, '2017-04-05 09:42:46');

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
(25, 'Any Room ', 9, 'Campus', 'Free room'),
(26, 'Free Room', 14, 'Free Room', 'Free Room');

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
(19, 'EECIM 1101', 'Basic Electricity and System', 10, ''),
(20, 'EECIM 1102', 'Basic Electronics and Circuits', 10, ''),
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
(46, 'MTBS 1202', 'BUSINESS MATHIMATICS', 4, ''),
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
(1, 1, 3, 4, 63, 25, 1, NULL, NULL, 1, 7, 3),
(2, 1, 5, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(3, 1, 46, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(4, 1, 53, 4, 5, 22, 11, NULL, 1, 1, 8, 2),
(5, 1, 42, 4, 51, 25, 1, NULL, NULL, 1, 8, 1),
(6, 2, 3, 4, 63, 25, 1, NULL, NULL, 1, 7, 3),
(7, 2, 5, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(8, 2, 46, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(9, 2, 53, 4, 5, 22, 11, NULL, 1, 1, 8, 2),
(10, 2, 42, 4, 51, 25, 1, NULL, NULL, 1, 8, 1),
(11, 2, 1, 4, 1, 26, 14, NULL, 1, 2, 4, 5),
(12, 3, 3, 4, 63, 25, 1, NULL, NULL, 1, 7, 3),
(13, 3, 5, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(14, 3, 46, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(15, 3, 53, 4, 5, 22, 11, NULL, 1, 1, 8, 2),
(16, 3, 42, 4, 51, 25, 1, NULL, NULL, 1, 8, 1),
(17, 3, 1, 4, 1, 26, 14, NULL, 1, 2, 4, 5),
(18, 3, 55, 31, 26, 25, 7, NULL, NULL, 1, 4, 3),
(19, 3, 36, 31, 25, 25, 7, NULL, NULL, 1, 4, 2),
(20, 3, 51, 31, 16, 25, 1, NULL, NULL, 1, 8, 2),
(21, 3, 48, 31, 15, 25, 1, NULL, NULL, 1, 8, 2),
(22, 3, 53, 31, 5, 22, 11, NULL, 1, 1, 8, 2),
(23, 3, 1, 31, 1, 26, 14, NULL, 1, 2, 4, 5),
(24, 4, 3, 4, 63, 25, 1, NULL, NULL, 1, 7, 3),
(25, 4, 5, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(26, 4, 46, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(27, 4, 53, 4, 5, 22, 11, NULL, 1, 1, 8, 2),
(28, 4, 42, 4, 51, 25, 1, NULL, NULL, 1, 8, 1),
(29, 4, 1, 4, 1, 26, 14, NULL, 1, 2, 4, 5),
(30, 4, 55, 31, 26, 25, 7, NULL, NULL, 1, 4, 3),
(31, 4, 36, 31, 25, 25, 7, NULL, NULL, 1, 4, 2),
(32, 4, 51, 31, 16, 25, 1, NULL, NULL, 1, 8, 2),
(33, 4, 48, 31, 15, 25, 1, NULL, NULL, 1, 8, 2),
(34, 4, 53, 31, 5, 22, 11, NULL, 1, 1, 8, 2),
(35, 4, 1, 31, 1, 26, 14, NULL, 1, 2, 4, 5),
(36, 4, 22, 58, 18, 4, 13, NULL, 1, 1, 4, 3),
(37, 4, 23, 58, 62, 25, 6, NULL, NULL, 1, 4, 2),
(38, 4, 26, 58, 21, 25, 6, NULL, NULL, 1, 4, 2),
(39, 4, 53, 58, 5, 22, 11, NULL, 1, 1, 8, 2),
(40, 4, 48, 58, 43, 25, 1, NULL, NULL, 1, 8, 2),
(41, 5, 3, 4, 63, 25, 1, NULL, NULL, 1, 7, 3),
(42, 5, 5, 4, 51, 25, 1, NULL, NULL, 1, 8, 3),
(43, 5, 46, 4, 47, 25, 1, NULL, NULL, 1, 8, 2),
(44, 5, 53, 4, 5, 22, 11, NULL, 1, 1, 8, 2),
(45, 5, 42, 4, 51, 25, 1, NULL, NULL, 1, 8, 1),
(46, 5, 1, 4, 1, 26, 14, NULL, 1, 2, 4, 5),
(47, 5, 55, 31, 26, 25, 7, NULL, NULL, 1, 4, 3),
(48, 5, 36, 31, 25, 25, 7, NULL, NULL, 1, 4, 2),
(49, 5, 51, 31, 16, 25, 1, NULL, NULL, 1, 8, 2),
(50, 5, 48, 31, 15, 25, 1, NULL, NULL, 1, 8, 2),
(51, 5, 53, 31, 5, 22, 11, NULL, 1, 1, 8, 2),
(52, 5, 1, 31, 1, 26, 14, NULL, 1, 2, 4, 5),
(53, 5, 22, 58, 18, 4, 13, NULL, 1, 1, 4, 3),
(54, 5, 23, 58, 62, 25, 6, NULL, NULL, 1, 4, 2),
(55, 5, 26, 58, 21, 25, 6, NULL, NULL, 1, 4, 2),
(56, 5, 53, 58, 5, 22, 11, NULL, 1, 1, 8, 2),
(57, 5, 48, 58, 43, 25, 1, NULL, NULL, 1, 8, 2);

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
(1, 2017, 2018, '1', 'Test This table has 1 CONFLICT(S).', '2017-04-05 09:10:53', 0),
(2, 2017, 2018, '1', '(0) CONFLICT/S @ ', '2017-04-05 09:18:22', 0),
(3, 2017, 2018, '1', '(0) CONFLICT/S @ ', '2017-04-05 09:21:19', 0),
(4, 2017, 2018, '1', '(0) CONFLICT/S @ ', '2017-04-05 09:33:16', 0),
(5, 2017, 2018, '1', '(1) CONFLICT/S @ ', '2017-04-05 09:40:09', 1);

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
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
