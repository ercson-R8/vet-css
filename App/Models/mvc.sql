-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 02:50 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

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
(4, 'New Test Post', '2016-17 NBA season Full Game Highlights Regular January Jan 29th 29 2016 2017 Cavs Cavaliers Warriors OKC Thunder Trail Blazers Sixers Bulls Knicks Hawks Rockets Pacers Mavericks Spurs Magic Raptors Wiards Pelicans Ximo Pierto NBATV HD Live Stream Streaming 720p Youtube Official Channel Top 10 Plays Dunks Inside the NBA Shaq Episode Shaqtin'' A Fool', '2017-01-30 12:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
