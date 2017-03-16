-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2017 at 02:41 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `id_number`, `first_name`, `last_name`, `note`) VALUES
(1, 0, 'Paul', 'George', 'PolSci instructor'),
(2, 1, 'Peter', 'Parker', 'Bio instructor'),
(3, 2, 'James', 'LeBron', 'English instructo'),
(4, 3, 'John', 'Wall', 'Math instructor'),
(5, 4, 'Canteen', 'Canteen', 'Canteen'),
(6, 2016001, 'Xander', 'Cage', 'Stunt instructor'),
(7, 2016002, 'Bruce', 'Banner', 'Genetics instructors'),
(8, 2016003, 'Tony', 'Starks', 'Robotics instructor'),
(100, 2017001, 'Abdulaziz', 'Abid Galm Al Hinai', 'ELC - Instructor'),
(101, 2017002, 'Abdulaziz', 'Jumah Al Shamaki', 'RAC - Instructor'),
(102, 2017003, 'Abdullah', 'Maher.Abdullah', 'ELC - Instructor'),
(103, 2017004, 'Abdurahiman', 'Puthan', 'ENG - Instructor'),
(104, 2017005, 'Ahmed', 'Mahsob', 'BUS - Instructor'),
(105, 2017006, 'Ahmed', 'AL-Maqbali', 'ENG - Instructor'),
(106, 2017007, 'Ali', 'Mohammed Ali Salih', 'ENG - Instructor'),
(107, 2017008, 'Ammar', 'Bin Mosbah', 'MECH - Instructor'),
(108, 2017009, 'antonio', 'Buca', 'PHY - Instructor'),
(109, 2017010, 'Aref', 'Al ajmi', 'ENG - Instructor'),
(110, 2017011, 'Asma', 'AL-', 'ENG - Instructor'),
(111, 2017012, 'Asma', 'Al Farsi', 'PHY - Instructor'),
(112, 2017013, 'Ayeesha', 'Yasmin', 'PHY - Instructor'),
(113, 2017014, 'Ayoub', 'Al Oufi', 'MATH - Instructor'),
(114, 2017015, 'Bilal', 'Al Arqenah', 'PHY - Instructor'),
(115, 2017016, 'Carlo', 'Romion', 'PE - Instructor'),
(116, 2017017, 'Conrado', 'Torres', 'ELX - Instructor'),
(117, 2017018, 'Ericson', 'Billedo', 'IT - Instructor'),
(118, 2017019, 'Euclid', 'Santiago', 'ELC - Instructor'),
(119, 2017020, 'Eulogio', 'Oderon', 'ELX - Instructor'),
(120, 2017021, 'Fatma', 'AL-Blushi', 'ENG - Instructor'),
(121, 2017022, 'Fatma', 'Al Balushi', 'IT - Instructor'),
(122, 2017023, 'Ghalib', 'Al Amri', 'MECH - Instructor'),
(123, 2017024, 'Hermogenes', 'Baculo', 'ELC - Instructor'),
(124, 2017025, 'Ibrahim', 'Saif Said Al Mawaali', 'ELC - Instructor'),
(125, 2017026, 'Ignatius', 'Rodrigues', 'ELC - Instructor'),
(126, 2017027, 'Jaffar', 'Al. Bahrani', 'MATH - Instructor'),
(127, 2017028, 'Jenier', 'Galarpe', 'WEL - Instructor'),
(128, 2017029, 'Julie', 'Mathew Senil', 'ENG - Instructor'),
(129, 2017030, 'Juluis', 'Dabon', 'RAC - Instructor'),
(130, 2017031, 'Kannan', 'subash chandra bose', 'DRW - Instructor'),
(131, 2017032, 'Karunadas', 'Parakunnath', 'ELC - Instructor'),
(132, 2017033, 'Macario', 'Barredo', 'MECH - Instructor'),
(133, 2017034, 'Mansoor', 'Al Balushi', 'ENG - Instructor'),
(134, 2017035, 'Marwan', 'ahmed. Almamari', 'ENG - Instructor'),
(135, 2017036, 'Maryam', 'AL-Mamary', 'ENG - Instructor'),
(136, 2017037, 'Mohammed', 'Mahmoud Saliem', 'BUS - Instructor'),
(137, 2017038, 'Mohammed', 'Nasser Abdullah Al Balushi', 'BUS - Instructor'),
(138, 2017039, 'Mohammed', 'Al-BAlushi', 'ENG - Instructor'),
(139, 2017040, 'Mohammed', 'Nabbhan Al Nabbhani', 'ENG - Instructor'),
(140, 2017041, 'Mohammed', 'ALNabhani', 'ENG - Instructor'),
(141, 2017042, 'Mohammed', 'Vaziruddin', 'MATH - Instructor'),
(142, 2017043, 'mohammed', 'al-basyuni al-said al qal youbi', 'RAC - Instructor'),
(143, 2017044, 'Mohammed', 'Ramdan Salim', 'WEL - Instructor'),
(144, 2017045, 'Mustafa', 'Metwally', 'DRW - Instructor'),
(145, 2017046, 'NAGAPAVAN', '.N', 'MATH - Instructor'),
(146, 2017047, 'Nasir', 'Al Hinai', 'MECH - Instructor'),
(147, 2017048, 'Norman', 'De Ocampo', 'RAC - Instructor'),
(148, 2017049, 'Osamah', 'Mohammad Ahmmad Al-Shobaki', 'RAC - Instructor'),
(149, 2017050, 'Rajesh', 'Chaladath', 'BUS - Instructor'),
(150, 2017051, 'Regina', 'Formaran', 'PE - Instructor'),
(151, 2017052, 'Rojesb', 'Chaladatb', 'DRW - Instructor'),
(152, 2017053, 'Rommel', 'A. Rosales', 'WEL - Instructor'),
(153, 2017054, 'Sajith', 'Bandara', 'IT - Instructor'),
(154, 2017055, 'Sheikha', 'Ali Said Al-Badi', 'IT - Instructor'),
(155, 2017056, 'Silpa', 'Sarah Abraham', 'ENG - Instructor'),
(156, 2017057, 'Taoufik', 'Ouelhazi', 'WEL - Instructor'),
(157, 2017058, 'Vara', 'Prasad Reddy Subbi Reddy', 'IT - Instructor'),
(158, 2017059, 'Vijaya', 'kumar', 'IT - Instructor'),
(159, 2017060, 'vinay', 'kumar', 'ENG - Instructor'),
(160, 2017061, 'William', 'Caniedo', 'ELX - Instructor'),
(161, 2017062, 'Fatma', 'Mosa', 'BUS-Instructor'),
(162, 2017063, 'Shaik', 'X', 'MATH - Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(4) NOT NULL,
  `subject_id` int(4) NOT NULL,
  `time_slot` int(4) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `others` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(64, 'update', 'updateupdate 646464 ', '2017-02-11 11:43:48'),
(65, 'update', 'updateupdate 63 63 63 ', '2017-02-11 12:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(4) NOT NULL,
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
(18, 'ELC Classroom 1', 12, 'Main Building', '	Dedicated room for ELC lecture classes'),
(19, 'CRVN 1', 10, 'Caravan', 'Rooms for English Foundation Program'),
(20, 'CRVN 2', 10, 'Caravan', 'Rooms for English Foundation Program'),
(21, 'CRVN 3', 10, 'Caravan', 'Rooms for English Foundation Program'),
(22, 'CRVN 4', 10, 'Caravan', 'Rooms for English Foundation Program'),
(23, 'CRVN 5', 10, 'Caravan', 'Rooms for English Foundation Program'),
(24, 'CRVN 11', 11, 'Caravan', 'Rooms for non-English Foundation Program');

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
(9, 'Canteen', 'Mess hall, lounges, '),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(13, 'BBSSM 2201x', 'MANAGEMENT AND ORGANIZATION ', 0, ''),
(14, 'BBSSM 2204', 'MARKETING COMMUINCATION', 0, ''),
(15, 'BBSSM 2204x', 'GRADUATION PROJECT ', 0, ''),
(16, 'CHEM 1101', 'Chemistry 1', 4, ''),
(17, 'CHEM 1202', 'Chemistry 2', 4, ''),
(18, 'EECIM 1101', 'Basic Electricity and System', 7, ''),
(19, 'EECIM 1102', 'Basic Electronics and Circuits', 7, ''),
(20, 'EECIM 1103', 'Fundamental Digital Electronics Circuits', 0, ''),
(21, 'EECIM 1203', 'ELX-?', 7, ''),
(22, 'EECIM 1204', 'Installation, Servicing Audio-Video Systems', 5, ''),
(23, 'EECIM 1205', 'Switched-Mode Power Supplies & Autovolt Power', 0, ''),
(24, 'EECIM 1206', 'Electronics Devices Servicing 1', 0, ''),
(25, 'EECIM 1305', 'ELX-?', 5, ''),
(26, 'EECIM 2107', 'Personal Computers and Multimedia Devices', 0, ''),
(27, 'EECIM 2108', 'Computer System Data Comm. & Internetworking', 0, ''),
(28, 'EECIM 2109', 'Graduation Project 1', 0, ''),
(29, 'EECIM 2210', 'Security Alarm systems', 0, ''),
(30, 'EECIM 2211', 'Electronics Devices Servicing 2', 0, ''),
(31, 'EECIM 2212', 'Graduation Project 2', 0, ''),
(32, 'EELIHW 1101', 'Health and Safety Precautions', 1, ''),
(33, 'EELIHW 1102', 'Basic Electricity(AC/DC) &Electrical Code', 5, ''),
(34, 'EELIHW 1103', 'Tools, Instruments, Electric wires and cable works', 5, ''),
(35, 'EELIHW 1204', 'Basic Electronics', 4, ''),
(36, 'EELIHW 1205', 'Electrical-Circuits and Protection Devices', 0, ''),
(37, 'EELIHW 1206', 'Three Phase Principles', 0, ''),
(38, 'EENDR 1101', 'Engineering Drawing 1', 0, ''),
(39, 'EENDR 1202', 'Engineering Drawing 2', 0, ''),
(42, 'ENTRP 1202', 'ENTREPRENEURSHIP', 0, ''),
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
(54, 'PRMG 1101', 'ENTREPRENEURSHIP', 0, ''),
(55, 'PUENG 2101', 'Public Speaking', 3, ''),
(56, 'TCENG 1202', 'Technical Communication', 3, ''),
(57, 'TWENG 1101', 'TECHNICAL WRINTING ', 3, ''),
(58, 'EELIHW 1203', 'EELIHW 1203', 7, ''),
(59, 'EELIHW 2107', 'EELIHW 2107', 8, ''),
(60, 'EELIHW 2108', 'EELIHW 2108', 5, ''),
(61, 'EELIHW 2209', 'EELIHW 2209', 12, ''),
(62, 'EELIHW 2210', 'EELIHW 2210', 9, '');

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
  `meeting_time_id_TBDropped` int(4) DEFAULT NULL,
  `preferred_start_period` int(4) DEFAULT NULL,
  `preferred_end_period` int(4) DEFAULT NULL,
  `preferred_number_days` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(4) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  `term` varchar(100) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `year_start`, `year_end`, `term`, `remarks`) VALUES
(1, 2016, 2017, '1', 'testing 101');

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
(1, 'MECHA', 'A', 1, 'Term 1 Mechatronics Trainees'),
(2, 'MECHA', 'B', 1, 'Term 1 Mechatronics Trainees'),
(3, 'MECHA', 'C', 1, 'Term 1 Mechatronics Trainees'),
(4, 'MECHA', 'A', 2, 'Term 2 Mechatronics Trainees'),
(5, 'MECHA', 'B', 2, 'Term 2 Mechatronics Trainees'),
(6, 'MECHA', 'C', 2, 'Term 2 Mechatronics Trainees'),
(7, 'MECHA', 'A', 3, 'Term 3 Mechatronics Trainees'),
(8, 'MECHA', 'B', 3, 'Term 3 Mechatronics Trainees'),
(9, 'MECHA', 'C', 3, 'Term 3 Mechatronics Trainees'),
(10, 'MECHA', 'A', 4, 'Term 4 Mechatronics Trainees'),
(11, 'MECHA', 'A', 4, 'Term 4 Mechatronics Trainees'),
(12, 'MECHA', 'B', 4, 'Term 4 Mechatronics Trainees'),
(13, 'MECHA', 'C', 5, 'Term 5 Mechatronics Trainees'),
(14, 'MECHA', 'A', 5, 'Term 5 Mechatronics Trainees'),
(15, 'MECHA', 'B', 5, 'Term 5 Mechatronics Trainees'),
(16, 'MECHA', 'C', 6, 'Term 6 Mechatronics Trainees'),
(17, 'MECHA', 'A', 6, 'Term 6 Mechatronics Trainees'),
(18, 'MECHA', 'A', 6, 'Term 6 Mechatronics Trainees'),
(19, 'MECHA', 'B', 7, 'Term 7 Mechatronics Trainees'),
(20, 'MECHA', 'C', 7, 'Term 7 Mechatronics Trainees'),
(21, 'MECHA', 'A', 7, 'Term 7 Mechatronics Trainees'),
(22, 'MECHA', 'B', 8, 'Term 8 Mechatronics Trainees'),
(23, 'MECHA', 'C', 8, 'Term 8 Mechatronics Trainees'),
(24, 'MECHA', 'A', 8, 'Term 8 Mechatronics Trainees'),
(25, 'MECHA', 'A', 9, 'Term 9 Mechatronics Trainees'),
(26, 'MECHA', 'B', 9, 'Term 9 Mechatronics Trainees'),
(27, 'MECHA', 'C', 9, 'Term 9 Mechatronics Trainees'),
(28, 'ELX', 'A', 1, 'Term 1 Mechatronics Trainees'),
(29, 'ELX', 'B', 1, 'Term 1 Mechatronics Trainees'),
(30, 'ELX', 'C', 1, 'Term 1 Mechatronics Trainees'),
(31, 'ELX', 'A', 2, 'Term 2 Mechatronics Trainees'),
(32, 'ELX', 'B', 2, 'Term 2 Mechatronics Trainees'),
(33, 'ELX', 'C', 2, 'Term 2 Mechatronics Trainees'),
(34, 'ELX', 'A', 3, 'Term 3 Mechatronics Trainees'),
(35, 'ELX', 'B', 3, 'Term 3 Mechatronics Trainees'),
(36, 'ELX', 'C', 3, 'Term 3 Mechatronics Trainees'),
(37, 'ELX', 'A', 4, 'Term 4 Mechatronics Trainees'),
(38, 'ELX', 'A', 4, 'Term 4 Mechatronics Trainees'),
(39, 'ELX', 'B', 4, 'Term 4 Mechatronics Trainees'),
(40, 'ELX', 'C', 5, 'Term 5 Mechatronics Trainees'),
(41, 'ELX', 'A', 5, 'Term 5 Mechatronics Trainees'),
(42, 'ELX', 'B', 5, 'Term 5 Mechatronics Trainees'),
(43, 'ELX', 'C', 6, 'Term 6 Mechatronics Trainees'),
(44, 'ELX', 'A', 6, 'Term 6 Mechatronics Trainees'),
(45, 'ELX', 'A', 6, 'Term 6 Mechatronics Trainees'),
(46, 'ELX', 'B', 7, 'Term 7 Mechatronics Trainees'),
(47, 'ELX', 'C', 7, 'Term 7 Mechatronics Trainees'),
(48, 'ELX', 'A', 7, 'Term 7 Mechatronics Trainees'),
(49, 'ELX', 'B', 8, 'Term 8 Mechatronics Trainees'),
(50, 'ELX', 'C', 8, 'Term 8 Mechatronics Trainees'),
(51, 'ELX', 'A', 8, 'Term 8 Mechatronics Trainees'),
(52, 'ELX', 'A', 9, 'Term 9 Mechatronics Trainees'),
(53, 'ELX', 'B', 9, 'Term 9 Mechatronics Trainees'),
(54, 'ELX', 'C', 9, 'Term 9 Mechatronics Trainees'),
(55, 'ELC', 'A', 1, 'Term 1 Mechatronics Trainees'),
(56, 'ELC', 'B', 1, 'Term 1 Mechatronics Trainees'),
(57, 'ELC', 'C', 1, 'Term 1 Mechatronics Trainees'),
(58, 'ELC', 'A', 2, 'Term 2 Mechatronics Trainees'),
(59, 'ELC', 'B', 2, 'Term 2 Mechatronics Trainees'),
(60, 'ELC', 'C', 2, 'Term 2 Mechatronics Trainees'),
(61, 'ELC', 'A', 3, 'Term 3 Mechatronics Trainees'),
(62, 'ELC', 'B', 3, 'Term 3 Mechatronics Trainees'),
(63, 'ELC', 'C', 3, 'Term 3 Mechatronics Trainees'),
(64, 'ELC', 'A', 4, 'Term 4 Mechatronics Trainees'),
(65, 'ELC', 'A', 4, 'Term 4 Mechatronics Trainees'),
(66, 'ELC', 'B', 4, 'Term 4 Mechatronics Trainees'),
(67, 'ELC', 'C', 5, 'Term 5 Mechatronics Trainees'),
(68, 'ELC', 'A', 5, 'Term 5 Mechatronics Trainees'),
(69, 'ELC', 'B', 5, 'Term 5 Mechatronics Trainees'),
(70, 'ELC', 'C', 6, 'Term 6 Mechatronics Trainees'),
(71, 'ELC', 'A', 6, 'Term 6 Mechatronics Trainees'),
(72, 'ELC', 'A', 6, 'Term 6 Mechatronics Trainees'),
(73, 'ELC', 'B', 7, 'Term 7 Mechatronics Trainees'),
(74, 'ELC', 'C', 7, 'Term 7 Mechatronics Trainees'),
(75, 'ELC', 'A', 7, 'Term 7 Mechatronics Trainees'),
(76, 'ELC', 'B', 8, 'Term 8 Mechatronics Trainees'),
(77, 'ELC', 'C', 8, 'Term 8 Mechatronics Trainees'),
(78, 'ELC', 'A', 8, 'Term 8 Mechatronics Trainees'),
(79, 'ELC', 'A', 9, 'Term 9 Mechatronics Trainees'),
(80, 'ELC', 'B', 9, 'Term 9 Mechatronics Trainees'),
(81, 'ELC', 'C', 9, 'Term 9 Mechatronics Trainees'),
(82, 'WLD', 'A', 1, 'Term 1 Mechatronics Trainees'),
(83, 'WLD', 'B', 1, 'Term 1 Mechatronics Trainees'),
(84, 'WLD', 'C', 1, 'Term 1 Mechatronics Trainees'),
(85, 'WLD', 'A', 2, 'Term 2 Mechatronics Trainees'),
(86, 'WLD', 'B', 2, 'Term 2 Mechatronics Trainees'),
(87, 'WLD', 'C', 2, 'Term 2 Mechatronics Trainees'),
(88, 'WLD', 'A', 3, 'Term 3 Mechatronics Trainees'),
(89, 'WLD', 'B', 3, 'Term 3 Mechatronics Trainees'),
(90, 'WLD', 'C', 3, 'Term 3 Mechatronics Trainees'),
(91, 'WLD', 'A', 4, 'Term 4 Mechatronics Trainees'),
(92, 'WLD', 'A', 4, 'Term 4 Mechatronics Trainees'),
(93, 'WLD', 'B', 4, 'Term 4 Mechatronics Trainees'),
(94, 'WLD', 'C', 5, 'Term 5 Mechatronics Trainees'),
(95, 'WLD', 'A', 5, 'Term 5 Mechatronics Trainees'),
(96, 'WLD', 'B', 5, 'Term 5 Mechatronics Trainees'),
(97, 'WLD', 'C', 6, 'Term 6 Mechatronics Trainees'),
(98, 'WLD', 'A', 6, 'Term 6 Mechatronics Trainees'),
(99, 'WLD', 'A', 6, 'Term 6 Mechatronics Trainees'),
(100, 'WLD', 'B', 7, 'Term 7 Mechatronics Trainees'),
(101, 'WLD', 'C', 7, 'Term 7 Mechatronics Trainees'),
(102, 'WLD', 'A', 7, 'Term 7 Mechatronics Trainees'),
(103, 'WLD', 'B', 8, 'Term 8 Mechatronics Trainees'),
(104, 'WLD', 'C', 8, 'Term 8 Mechatronics Trainees'),
(105, 'WLD', 'A', 8, 'Term 8 Mechatronics Trainees'),
(106, 'WLD', 'A', 9, 'Term 9 Mechatronics Trainees'),
(107, 'WLD', 'B', 9, 'Term 9 Mechatronics Trainees'),
(108, 'WLD', 'C', 9, 'Term 9 Mechatronics Trainees'),
(109, 'RAC', 'A', 1, 'Term 1 Mechatronics Trainees'),
(110, 'RAC', 'B', 1, 'Term 1 Mechatronics Trainees'),
(111, 'RAC', 'C', 1, 'Term 1 Mechatronics Trainees'),
(112, 'RAC', 'A', 2, 'Term 2 Mechatronics Trainees'),
(113, 'RAC', 'B', 2, 'Term 2 Mechatronics Trainees'),
(114, 'RAC', 'C', 2, 'Term 2 Mechatronics Trainees'),
(115, 'RAC', 'A', 3, 'Term 3 Mechatronics Trainees'),
(116, 'RAC', 'B', 3, 'Term 3 Mechatronics Trainees'),
(117, 'RAC', 'C', 3, 'Term 3 Mechatronics Trainees'),
(118, 'RAC', 'A', 4, 'Term 4 Mechatronics Trainees'),
(119, 'RAC', 'A', 4, 'Term 4 Mechatronics Trainees'),
(120, 'RAC', 'B', 4, 'Term 4 Mechatronics Trainees'),
(121, 'RAC', 'C', 5, 'Term 5 Mechatronics Trainees'),
(122, 'RAC', 'A', 5, 'Term 5 Mechatronics Trainees'),
(123, 'RAC', 'B', 5, 'Term 5 Mechatronics Trainees'),
(124, 'RAC', 'C', 6, 'Term 6 Mechatronics Trainees'),
(125, 'RAC', 'A', 6, 'Term 6 Mechatronics Trainees'),
(126, 'RAC', 'A', 6, 'Term 6 Mechatronics Trainees'),
(127, 'RAC', 'B', 7, 'Term 7 Mechatronics Trainees'),
(128, 'RAC', 'C', 7, 'Term 7 Mechatronics Trainees'),
(129, 'RAC', 'A', 7, 'Term 7 Mechatronics Trainees'),
(130, 'RAC', 'B', 8, 'Term 8 Mechatronics Trainees'),
(131, 'RAC', 'C', 8, 'Term 8 Mechatronics Trainees'),
(132, 'RAC', 'A', 8, 'Term 8 Mechatronics Trainees'),
(133, 'RAC', 'A', 9, 'Term 9 Mechatronics Trainees'),
(134, 'RAC', 'B', 9, 'Term 9 Mechatronics Trainees'),
(135, 'RAC', 'C', 9, 'Term 9 Mechatronics Trainees'),
(136, 'BUS', 'A', 1, 'Term 1 Mechatronics Trainees'),
(137, 'BUS', 'B', 1, 'Term 1 Mechatronics Trainees'),
(138, 'BUS', 'C', 1, 'Term 1 Mechatronics Trainees'),
(139, 'BUS', 'A', 2, 'Term 2 Mechatronics Trainees'),
(140, 'BUS', 'B', 2, 'Term 2 Mechatronics Trainees'),
(141, 'BUS', 'C', 2, 'Term 2 Mechatronics Trainees'),
(142, 'BUS', 'A', 3, 'Term 3 Mechatronics Trainees'),
(143, 'BUS', 'B', 3, 'Term 3 Mechatronics Trainees'),
(144, 'BUS', 'C', 3, 'Term 3 Mechatronics Trainees'),
(145, 'BUS', 'A', 4, 'Term 4 Mechatronics Trainees'),
(146, 'BUS', 'A', 4, 'Term 4 Mechatronics Trainees'),
(147, 'BUS', 'B', 4, 'Term 4 Mechatronics Trainees'),
(148, 'BUS', 'C', 5, 'Term 5 Mechatronics Trainees'),
(149, 'BUS', 'A', 5, 'Term 5 Mechatronics Trainees'),
(150, 'BUS', 'B', 5, 'Term 5 Mechatronics Trainees'),
(151, 'BUS', 'C', 6, 'Term 6 Mechatronics Trainees'),
(152, 'BUS', 'A', 6, 'Term 6 Mechatronics Trainees'),
(153, 'BUS', 'A', 6, 'Term 6 Mechatronics Trainees'),
(154, 'BUS', 'B', 7, 'Term 7 Mechatronics Trainees'),
(155, 'BUS', 'C', 7, 'Term 7 Mechatronics Trainees'),
(156, 'BUS', 'A', 7, 'Term 7 Mechatronics Trainees'),
(157, 'BUS', 'B', 8, 'Term 8 Mechatronics Trainees'),
(158, 'BUS', 'C', 8, 'Term 8 Mechatronics Trainees'),
(159, 'BUS', 'A', 8, 'Term 8 Mechatronics Trainees'),
(160, 'BUS', 'A', 9, 'Term 9 Mechatronics Trainees'),
(161, 'BUS', 'B', 9, 'Term 9 Mechatronics Trainees'),
(162, 'BUS', 'C', 9, 'Term 9 Mechatronics Trainees'),
(200, 'Dummy Group 1', 'A', 1, NULL),
(500, 'Dummy Group 2', 'A', 1, NULL);

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
  ADD KEY `subject_id` (`subject_id`);

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trainee_group`
--
ALTER TABLE `trainee_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

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