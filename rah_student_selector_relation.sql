-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2023 at 01:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rahbar`
--

-- --------------------------------------------------------

--
-- Table structure for table `rah_student_selector_relation`
--

CREATE TABLE `rah_student_selector_relation` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `selector_id` int(11) NOT NULL,
  `addition_text` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rah_student_selector_relation`
--

INSERT INTO `rah_student_selector_relation` (`id`, `student_id`, `selector_id`, `addition_text`, `created_at`, `updated_at`) VALUES
(1, 45, 16, 'testing going on', '2023-02-21 06:12:39', '0000-00-00 00:00:00'),
(2, 46, 16, 'testing going on', '2023-02-21 06:14:34', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rah_student_selector_relation`
--
ALTER TABLE `rah_student_selector_relation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rah_student_selector_relation`
--
ALTER TABLE `rah_student_selector_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
