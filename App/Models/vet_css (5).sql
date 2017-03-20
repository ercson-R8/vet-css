-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 10:52 AM
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
(110, 2017011, 'Asma', 'AL', 'ENG - Instructor'),
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
(121, 2017022, 'Fatma', 'Al-Balushi', 'IT - Instructor'),
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
(145, 2017046, 'Nags', 'PAVAN', 'MATH - Instructor'),
(146, 2017047, 'Nasir', 'Al Hinai', 'MECH - Instructor'),
(147, 2017048, 'Norman', 'De Ocampo', 'RAC - Instructor'),
(148, 2017049, 'Osamah', 'Mohammad Ahmmad Al-Shobaki', 'RAC - Instructor'),
(149, 2017050, 'Rajesh', 'Chaladath', 'BUS - Instructor'),
(150, 2017051, 'Regina', 'Formaran', 'PE - Instructor'),
(151, 2017052, 'Rojesb', 'Chaladatb', 'DRW - Instructor'),
(152, 2017053, 'Rommel', 'Rosales', 'WEL - Instructor'),
(153, 2017054, 'Sajith', 'Bandara', 'IT - Instructor'),
(154, 2017055, 'Sheikha', 'Ali Said Al-Badi', 'IT - Instructor'),
(155, 2017056, 'Silpa', 'Sarah Abraham', 'ENG - Instructor'),
(156, 2017057, 'Taoufik', 'Ouelhazi', 'WEL - Instructor'),
(157, 2017058, 'Vara', 'Prasad Reddy Subbi Reddy', 'IT - Instructor'),
(158, 2017059, 'Vijaya', 'kumar', 'IT - Instructor'),
(159, 2017060, 'vinay', 'kumar', 'ENG - Instructor'),
(160, 2017061, 'William', 'Caniedo', 'ELX - Instructor'),
(161, 2017062, 'Fatma', 'Mosa', 'BUS-Instructor'),
(162, 2017063, 'Shaik', 'Shaik', 'MATH - Instructor');

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
(6, 'insert', 'this is insertinsertinsert', '2017-03-17 04:59:41');

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
(16, 'ELC Classroom 1', 12, 'Main Building', '	Dedicated room for ELC lecture classes'),
(17, 'CRVN 1', 10, 'Caravan', 'Rooms for English Foundation Program'),
(18, 'CRVN 2', 10, 'Caravan', 'Rooms for English Foundation Program'),
(19, 'CRVN 3', 10, 'Caravan', 'Rooms for English Foundation Program'),
(20, 'CRVN 4', 10, 'Caravan', 'Rooms for English Foundation Program'),
(21, 'CRVN 5', 10, 'Caravan', 'Rooms for English Foundation Program'),
(22, 'CRVN 11', 11, 'Caravan', 'Rooms for non-English Foundation Program'),
(23, 'Computer LAB 1', 2, 'Main Building', 'Maintained by Mr. Eric'),
(24, 'Computer LAB 2', 2, 'Main Building', 'Maintained by Mr. Vijay'),
(25, 'Any', 14, 'The as the room type specified', 'The as the room type specified');

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
(13, 'ELX-Converted room', 'Dedicated room for ELX lecture classes'),
(14, 'Any', 'Any room of the specified type');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `subject_class`
--

INSERT INTO `subject_class` (`id`, `timetable_id`, `subject_id`, `trainee_group_id`, `instructor_id`, `room_id`, `room_type_id`, `meeting_time_id_TBDropped`, `preferred_start_period`, `preferred_end_period`, `preferred_number_days`) VALUES
(1, 1, 18, 28, 118, NULL, 1, NULL, 1, 2, 1),
(2, 1, 46, 28, 102, 1, 1, NULL, 1, 2, 1),
(3, 1, 47, 136, 157, NULL, 2, NULL, 3, 4, 2),
(4, 1, 46, 1, 100, NULL, 9, NULL, 2, 1, 1),
(5, 1, 46, 29, 100, 10, 7, NULL, 1, 3, 1),
(6, 1, 46, 28, 102, 14, 1, NULL, 1, 3, 1),
(7, 1, 27, 136, 124, 14, 1, NULL, 1, 3, 1),
(8, 2, 23, 136, 111, 14, 1, NULL, 1, 3, 2),
(9, 2, 6, 86, 132, 14, 1, NULL, 1, 2, 2),
(11, 3, 27, 136, 124, 14, 2, NULL, 1, 2, 2),
(12, 3, 27, 137, 108, 25, 1, NULL, 1, 2, 1),
(13, 3, 46, 82, 100, 25, 2, NULL, 1, 4, 2),
(14, 3, 18, 1, 113, 25, 1, NULL, 3, 2, 4),
(15, 3, 5, 30, 104, 25, 11, NULL, 3, 7, 2);

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
  `current` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `year_start`, `year_end`, `term`, `remarks`, `current`) VALUES
(1, 2017, 2018, '2', 'test test test ', 0),
(2, 2018, 2019, '2', 'The changes have been applied successfully.', 0),
(3, 2020, 2021, '2', '// type 14 is any room of the same type ', 1);

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
(1, 'BUS-1A', 'A', 1, 'Term 1 Business Trainees'),
(2, 'BUS-1B', 'B', 1, 'Term 1 Business Trainees'),
(3, 'BUS-1C', 'C', 1, 'Term 1 Business Trainees'),
(4, 'BUS-2A', 'A', 2, 'Term 2 Business Trainees'),
(5, 'BUS-2B', 'B', 2, 'Term 2 Business Trainees'),
(6, 'BUS-2C', 'C', 2, 'Term 2 Business Trainees'),
(7, 'BUS-3A', 'A', 3, 'Term 3 Business Trainees'),
(8, 'BUS-3B', 'B', 3, 'Term 3 Business Trainees'),
(9, 'BUS-3C', 'C', 3, 'Term 3 Business Trainees'),
(10, 'BUS-4A', 'A', 4, 'Term 4 Business Trainees'),
(11, 'BUS-4A', 'A', 4, 'Term 4 Business Trainees'),
(12, 'BUS-4B', 'B', 4, 'Term 4 Business Trainees'),
(13, 'BUS-5C', 'C', 5, 'Term 5 Business Trainees'),
(14, 'BUS-5A', 'A', 5, 'Term 5 Business Trainees'),
(15, 'BUS-5B', 'B', 5, 'Term 5 Business Trainees'),
(16, 'BUS-6C', 'C', 6, 'Term 6 Business Trainees'),
(17, 'BUS-6A', 'A', 6, 'Term 6 Business Trainees'),
(18, 'BUS-6A', 'A', 6, 'Term 6 Business Trainees'),
(19, 'BUS-7B', 'B', 7, 'Term 7 Business Trainees'),
(20, 'BUS-7C', 'C', 7, 'Term 7 Business Trainees'),
(21, 'BUS-7A', 'A', 7, 'Term 7 Business Trainees'),
(22, 'BUS-8B', 'B', 8, 'Term 8 Business Trainees'),
(23, 'BUS-8C', 'C', 8, 'Term 8 Business Trainees'),
(24, 'BUS-8A', 'A', 8, 'Term 8 Business Trainees'),
(25, 'BUS-9A', 'A', 9, 'Term 9 Business Trainees'),
(26, 'BUS-9B', 'B', 9, 'Term 9 Business Trainees'),
(27, 'BUS-9C', 'C', 9, 'Term 9 Business Trainees'),
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
(38, 'ELC-4A', 'A', 4, 'Term 4 Electrical Trainees'),
(39, 'ELC-4B', 'B', 4, 'Term 4 Electrical Trainees'),
(40, 'ELC-5C', 'C', 5, 'Term 5 Electrical Trainees'),
(41, 'ELC-5A', 'A', 5, 'Term 5 Electrical Trainees'),
(42, 'ELC-5B', 'B', 5, 'Term 5 Electrical Trainees'),
(43, 'ELC-6C', 'C', 6, 'Term 6 Electrical Trainees'),
(44, 'ELC-6A', 'A', 6, 'Term 6 Electrical Trainees'),
(45, 'ELC-6A', 'A', 6, 'Term 6 Electrical Trainees'),
(46, 'ELC-7B', 'B', 7, 'Term 7 Electrical Trainees'),
(47, 'ELC-7C', 'C', 7, 'Term 7 Electrical Trainees'),
(48, 'ELC-7A', 'A', 7, 'Term 7 Electrical Trainees'),
(49, 'ELC-8B', 'B', 8, 'Term 8 Electrical Trainees'),
(50, 'ELC-8C', 'C', 8, 'Term 8 Electrical Trainees'),
(51, 'ELC-8A', 'A', 8, 'Term 8 Electrical Trainees'),
(52, 'ELC-9A', 'A', 9, 'Term 9 Electrical Trainees'),
(53, 'ELC-9B', 'B', 9, 'Term 9 Electrical Trainees'),
(54, 'ELC-9C', 'C', 9, 'Term 9 Electrical Trainees'),
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
(65, 'ELX-4A', 'A', 4, 'Term 4 Electronics Trainees'),
(66, 'ELX-4B', 'B', 4, 'Term 4 Electronics Trainees'),
(67, 'ELX-5C', 'C', 5, 'Term 5 Electronics Trainees'),
(68, 'ELX-5A', 'A', 5, 'Term 5 Electronics Trainees'),
(69, 'ELX-5B', 'B', 5, 'Term 5 Electronics Trainees'),
(70, 'ELX-6C', 'C', 6, 'Term 6 Electronics Trainees'),
(71, 'ELX-6A', 'A', 6, 'Term 6 Electronics Trainees'),
(72, 'ELX-6A', 'A', 6, 'Term 6 Electronics Trainees'),
(73, 'ELX-7B', 'B', 7, 'Term 7 Electronics Trainees'),
(74, 'ELX-7C', 'C', 7, 'Term 7 Electronics Trainees'),
(75, 'ELX-7A', 'A', 7, 'Term 7 Electronics Trainees'),
(76, 'ELX-8B', 'B', 8, 'Term 8 Electronics Trainees'),
(77, 'ELX-8C', 'C', 8, 'Term 8 Electronics Trainees'),
(78, 'ELX-8A', 'A', 8, 'Term 8 Electronics Trainees'),
(79, 'ELX-9A', 'A', 9, 'Term 9 Electronics Trainees'),
(80, 'ELX-9B', 'B', 9, 'Term 9 Electronics Trainees'),
(81, 'ELX-9C', 'C', 9, 'Term 9 Electronics Trainees'),
(82, 'Mecha-1A', 'A', 1, 'Term 1 Mechatronics Trainees'),
(83, 'Mecha-1B', 'B', 1, 'Term 1 Mechatronics Trainees'),
(84, 'Mecha-1C', 'C', 1, 'Term 1 Mechatronics Trainees'),
(85, 'Mecha-2A', 'A', 2, 'Term 2 Mechatronics Trainees'),
(86, 'Mecha-2B', 'B', 2, 'Term 2 Mechatronics Trainees'),
(87, 'Mecha-2C', 'C', 2, 'Term 2 Mechatronics Trainees'),
(88, 'Mecha-3A', 'A', 3, 'Term 3 Mechatronics Trainees'),
(89, 'Mecha-3B', 'B', 3, 'Term 3 Mechatronics Trainees'),
(90, 'Mecha-3C', 'C', 3, 'Term 3 Mechatronics Trainees'),
(91, 'Mecha-4A', 'A', 4, 'Term 4 Mechatronics Trainees'),
(92, 'Mecha-4A', 'A', 4, 'Term 4 Mechatronics Trainees'),
(93, 'Mecha-4B', 'B', 4, 'Term 4 Mechatronics Trainees'),
(94, 'Mecha-5C', 'C', 5, 'Term 5 Mechatronics Trainees'),
(95, 'Mecha-5A', 'A', 5, 'Term 5 Mechatronics Trainees'),
(96, 'Mecha-5B', 'B', 5, 'Term 5 Mechatronics Trainees'),
(97, 'Mecha-6C', 'C', 6, 'Term 6 Mechatronics Trainees'),
(98, 'Mecha-6A', 'A', 6, 'Term 6 Mechatronics Trainees'),
(99, 'Mecha-6A', 'A', 6, 'Term 6 Mechatronics Trainees'),
(100, 'Mecha-7B', 'B', 7, 'Term 7 Mechatronics Trainees'),
(101, 'Mecha-7C', 'C', 7, 'Term 7 Mechatronics Trainees'),
(102, 'Mecha-7A', 'A', 7, 'Term 7 Mechatronics Trainees'),
(103, 'Mecha-8B', 'B', 8, 'Term 8 Mechatronics Trainees'),
(104, 'Mecha-8C', 'C', 8, 'Term 8 Mechatronics Trainees'),
(105, 'Mecha-8A', 'A', 8, 'Term 8 Mechatronics Trainees'),
(106, 'Mecha-9A', 'A', 9, 'Term 9 Mechatronics Trainees'),
(107, 'Mecha-9B', 'B', 9, 'Term 9 Mechatronics Trainees'),
(108, 'Mecha-9C', 'C', 9, 'Term 9 Mechatronics Trainees'),
(109, 'RAC-1A', 'A', 1, 'Term 1 Ref & AirCon Trainees'),
(110, 'RAC-1B', 'B', 1, 'Term 1 Ref & AirCon Trainees'),
(111, 'RAC-1C', 'C', 1, 'Term 1 Ref & AirCon Trainees'),
(112, 'RAC-2A', 'A', 2, 'Term 2 Ref & AirCon Trainees'),
(113, 'RAC-2B', 'B', 2, 'Term 2 Ref & AirCon Trainees'),
(114, 'RAC-2C', 'C', 2, 'Term 2 Ref & AirCon Trainees'),
(115, 'RAC-3A', 'A', 3, 'Term 3 Ref & AirCon Trainees'),
(116, 'RAC-3B', 'B', 3, 'Term 3 Ref & AirCon Trainees'),
(117, 'RAC-3C', 'C', 3, 'Term 3 Ref & AirCon Trainees'),
(118, 'RAC-4A', 'A', 4, 'Term 4 Ref & AirCon Trainees'),
(119, 'RAC-4A', 'A', 4, 'Term 4 Ref & AirCon Trainees'),
(120, 'RAC-4B', 'B', 4, 'Term 4 Ref & AirCon Trainees'),
(121, 'RAC-5C', 'C', 5, 'Term 5 Ref & AirCon Trainees'),
(122, 'RAC-5A', 'A', 5, 'Term 5 Ref & AirCon Trainees'),
(123, 'RAC-5B', 'B', 5, 'Term 5 Ref & AirCon Trainees'),
(124, 'RAC-6C', 'C', 6, 'Term 6 Ref & AirCon Trainees'),
(125, 'RAC-6A', 'A', 6, 'Term 6 Ref & AirCon Trainees'),
(126, 'RAC-6A', 'A', 6, 'Term 6 Ref & AirCon Trainees'),
(127, 'RAC-7B', 'B', 7, 'Term 7 Ref & AirCon Trainees'),
(128, 'RAC-7C', 'C', 7, 'Term 7 Ref & AirCon Trainees'),
(129, 'RAC-7A', 'A', 7, 'Term 7 Ref & AirCon Trainees'),
(130, 'RAC-8B', 'B', 8, 'Term 8 Ref & AirCon Trainees'),
(131, 'RAC-8C', 'C', 8, 'Term 8 Ref & AirCon Trainees'),
(132, 'RAC-8A', 'A', 8, 'Term 8 Ref & AirCon Trainees'),
(133, 'RAC-9A', 'A', 9, 'Term 9 Ref & AirCon Trainees'),
(134, 'RAC-9B', 'B', 9, 'Term 9 Ref & AirCon Trainees'),
(135, 'RAC-9C', 'C', 9, 'Term 9 Ref & AirCon Trainees'),
(136, 'WELD-1A', 'A', 1, 'Term 1 Welding & Fabrication Trainees'),
(137, 'WELD-1B', 'B', 1, 'Term 1 Welding & Fabrication Trainees'),
(138, 'WELD-1C', 'C', 1, 'Term 1 Welding & Fabrication Trainees'),
(139, 'WELD-2A', 'A', 2, 'Term 2 Welding & Fabrication Trainees'),
(140, 'WELD-2B', 'B', 2, 'Term 2 Welding & Fabrication Trainees'),
(141, 'WELD-2C', 'C', 2, 'Term 2 Welding & Fabrication Trainees'),
(142, 'WELD-3A', 'A', 3, 'Term 3 Welding & Fabrication Trainees'),
(143, 'WELD-3B', 'B', 3, 'Term 3 Welding & Fabrication Trainees'),
(144, 'WELD-3C', 'C', 3, 'Term 3 Welding & Fabrication Trainees'),
(145, 'WELD-4A', 'A', 4, 'Term 4 Welding & Fabrication Trainees'),
(146, 'WELD-4A', 'A', 4, 'Term 4 Welding & Fabrication Trainees'),
(147, 'WELD-4B', 'B', 4, 'Term 4 Welding & Fabrication Trainees'),
(148, 'WELD-5C', 'C', 5, 'Term 5 Welding & Fabrication Trainees'),
(149, 'WELD-5A', 'A', 5, 'Term 5 Welding & Fabrication Trainees'),
(150, 'WELD-5B', 'B', 5, 'Term 5 Welding & Fabrication Trainees'),
(151, 'WELD-6C', 'C', 6, 'Term 6 Welding & Fabrication Trainees'),
(152, 'WELD-6A', 'A', 6, 'Term 6 Welding & Fabrication Trainees'),
(153, 'WELD-6A', 'A', 6, 'Term 6 Welding & Fabrication Trainees'),
(154, 'WELD-7B', 'B', 7, 'Term 7 Welding & Fabrication Trainees'),
(155, 'WELD-7C', 'C', 7, 'Term 7 Welding & Fabrication Trainees'),
(156, 'WELD-7A', 'A', 7, 'Term 7 Welding & Fabrication Trainees'),
(157, 'WELD-8B', 'B', 8, 'Term 8 Welding & Fabrication Trainees'),
(158, 'WELD-8C', 'C', 8, 'Term 8 Welding & Fabrication Trainees'),
(159, 'WELD-8A', 'A', 8, 'Term 8 Welding & Fabrication Trainees'),
(160, 'WELD-9A', 'A', 9, 'Term 9 Welding & Fabrication Trainees'),
(161, 'WELD-9B', 'B', 9, 'Term 9 Welding & Fabrication Trainees'),
(162, 'WELD-9C', 'C', 9, 'Term 9 Welding & Fabrication Trainees'),
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `trainee_group`
--
ALTER TABLE `trainee_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;
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
