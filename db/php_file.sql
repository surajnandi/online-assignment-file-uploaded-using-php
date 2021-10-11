-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2021 at 07:41 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_file`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('A','D') NOT NULL DEFAULT 'A' COMMENT 'A-Active, D-Deactivate',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'master@gmail.com', 'master@12345', 'A', '2021-07-26 19:42:46', '2021-07-28 11:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('A','D') NOT NULL DEFAULT 'A' COMMENT 'A-Active, D-Deactivate',
  `submitted_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `subject`, `document`, `message`, `status`, `submitted_date`) VALUES
(6, 'suraj', 'suraj@gmail.com', '8116879007', 'computer', 'Asus Laptop - Invoice.pdf', 'ok', 'A', '2021-07-26 09:00:41'),
(8, 'Sekhar Nandi', 'sekhar@gmail.com', '9988774455', 'Life Cycle', 'Acknowledgement-Reprint-Reciept-2021-07-24__193620.pdf', '', 'A', '2021-07-26 22:15:35'),
(13, 'suraj', 'suraj@gmail.com', '8116879007', 'computer', 'Asus Laptop - Invoice.pdf', 'ok', 'D', '2021-07-26 09:00:41'),
(14, 'suraj', 'suraj@gmail.com', '8116879007', 'computer', 'Asus Laptop - Invoice.pdf', 'ok', 'D', '2021-07-26 09:00:41'),
(15, 'suraj', 'suraj@gmail.com', '8116879007', 'computer', 'Asus Laptop - Invoice.pdf', 'ok', 'D', '2021-07-26 09:00:41'),
(17, 'aaa', 'aa@gmail.com', '1111111111', 'computer - 1', 'Railwire Billing.pdf', '', 'D', '2021-07-27 19:22:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
