-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2026 at 03:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rules_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `created_at`) VALUES
(1, 'Loan Approval Flow', '2026-05-28 10:05:46'),
(2, 'Loan Review Flow', '2026-05-28 12:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `group_rules`
--

CREATE TABLE `group_rules` (
  `group_rule_id` int(11) NOT NULL,
  `fk_group_id` int(11) NOT NULL,
  `fk_rule_id` int(11) NOT NULL,
  `parent_rule_id` int(11) DEFAULT NULL,
  `tier` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_rules`
--

INSERT INTO `group_rules` (`group_rule_id`, `fk_group_id`, `fk_rule_id`, `parent_rule_id`, `tier`, `sort_order`, `created_at`) VALUES
(1, 1, 1, NULL, 1, 1, '2026-05-28 10:05:46'),
(2, 1, 2, 1, 2, 2, '2026-05-28 10:05:46'),
(3, 1, 4, 2, 3, 3, '2026-05-28 10:05:46'),
(4, 2, 3, NULL, 1, 1, '2026-05-28 12:47:30'),
(5, 2, 2, 3, 2, 2, '2026-05-28 12:47:30'),
(6, 2, 6, 2, 3, 3, '2026-05-28 12:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `rule_id` int(11) NOT NULL,
  `rule_name` varchar(255) NOT NULL,
  `rule_type` enum('condition','decision') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`rule_id`, `rule_name`, `rule_type`, `created_at`) VALUES
(1, 'Salary Verified', 'condition', '2026-05-27 16:45:22'),
(2, 'Credit Score Checked', 'condition', '2026-05-27 16:47:11'),
(3, 'Documents Submitted', 'condition', '2026-05-27 16:48:44'),
(4, 'Approve Loan', 'decision', '2026-05-27 16:52:18'),
(5, 'Reject Loan', 'decision', '2026-05-27 16:55:31'),
(6, 'Manual Review Required', 'decision', '2026-05-27 16:58:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_rules`
--
ALTER TABLE `group_rules`
  ADD PRIMARY KEY (`group_rule_id`),
  ADD KEY `fk_group_id` (`fk_group_id`),
  ADD KEY `fk_rule_id` (`fk_rule_id`),
  ADD KEY `parent_rule_id` (`parent_rule_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`rule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_rules`
--
ALTER TABLE `group_rules`
  MODIFY `group_rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_rules`
--
ALTER TABLE `group_rules`
  ADD CONSTRAINT `group_rules_ibfk_1` FOREIGN KEY (`fk_group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `group_rules_ibfk_2` FOREIGN KEY (`fk_rule_id`) REFERENCES `rules` (`rule_id`),
  ADD CONSTRAINT `group_rules_ibfk_3` FOREIGN KEY (`parent_rule_id`) REFERENCES `rules` (`rule_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
