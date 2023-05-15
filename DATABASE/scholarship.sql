-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 12:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `address`, `image`) VALUES
(1, 'System Administrator', 'archive_scholarship@gmail.com', '$2y$10$8L1WyWfXAW9E0sZnnatvW.VF8OlMABHOMTmeYUBErZBWFFDaGtriK', '4W2Q+GCX, Kaybagal South, Tagaytay, 4120 Cavite', 'uploads/logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `archived_tdp`
--

CREATE TABLE `archived_tdp` (
  `id` int(11) NOT NULL,
  `date_upload` varchar(255) NOT NULL,
  `file` text NOT NULL,
  `semester` varchar(255) NOT NULL,
  `academic_yr` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `archived_tes`
--

CREATE TABLE `archived_tes` (
  `id` int(11) NOT NULL,
  `date_upload` varchar(255) NOT NULL,
  `file` text NOT NULL,
  `semester` varchar(255) NOT NULL,
  `academic_yr` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `archived_unifast`
--

CREATE TABLE `archived_unifast` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `file` text NOT NULL,
  `date_upload` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `archived_users`
--

CREATE TABLE `archived_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `account_stat` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tdp_grantees`
--

CREATE TABLE `tdp_grantees` (
  `id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `file` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `academic_yr` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tes_grantees`
--

CREATE TABLE `tes_grantees` (
  `id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `file` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `academic_yr` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unifast_files`
--

CREATE TABLE `unifast_files` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_upload` date NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `account_stat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_tdp`
--
ALTER TABLE `archived_tdp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_tes`
--
ALTER TABLE `archived_tes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_unifast`
--
ALTER TABLE `archived_unifast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_users`
--
ALTER TABLE `archived_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tdp_grantees`
--
ALTER TABLE `tdp_grantees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tes_grantees`
--
ALTER TABLE `tes_grantees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unifast_files`
--
ALTER TABLE `unifast_files`
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
-- AUTO_INCREMENT for table `archived_tdp`
--
ALTER TABLE `archived_tdp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archived_tes`
--
ALTER TABLE `archived_tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archived_unifast`
--
ALTER TABLE `archived_unifast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archived_users`
--
ALTER TABLE `archived_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tdp_grantees`
--
ALTER TABLE `tdp_grantees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tes_grantees`
--
ALTER TABLE `tes_grantees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unifast_files`
--
ALTER TABLE `unifast_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
