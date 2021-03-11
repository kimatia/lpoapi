-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2020 at 08:44 PM
-- Server version: 10.3.22-MariaDB-1
-- PHP Version: 7.3.15-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drozoneApi`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(50) NOT NULL,
  `bank_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `account_name` varchar(155) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `file` varchar(50) DEFAULT NULL,
  `minimum_signatories` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `bank_id`, `branch_id`, `account_name`, `account_number`, `file`, `minimum_signatories`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(10, 'I&M', 'Nairobi', 'Drozones', '8887776565643', '1333434344.png', '2', '0', '1600889098', '1600889098', 'admin'),
(11, 'Credit', 'Liwatonii', 'Medfast', '8887976565444', NULL, '2', '10', '1600889098', '1603096450', 'admin'),
(12, 'KCB', 'Kengeleni', 'Health', '3656783947346', NULL, '2', '0', '1601728632', '1601728632', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `head_office_number` varchar(50) NOT NULL,
  `head_office_address` varchar(50) NOT NULL,
  `head_office_email` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `head_office_number`, `head_office_address`, `head_office_email`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(6, 'Credit', '254795511728', 'Kengeleni nyali', 'kimatia@gmail.com', 'complete', '1600813094', '1600813273', 'kimatia'),
(8, 'I&M', '0710805424', 'kima@gmail.com', 'kima@gmail.com', 'complete', '1600898453', '1600898453', 'kimatia'),
(10, 'KCB', '0795511728', 'Kongowea Stage', 'kimatia@gmail.com', 'complete', '1601728495', '1601728495', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bank_branch`
--

CREATE TABLE `bank_branch` (
  `branch_id` int(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `bank_id` varchar(50) NOT NULL,
  `branch_manager` varchar(50) NOT NULL,
  `branch_manager_telephone` varchar(50) NOT NULL,
  `branch_manager_email` varchar(50) NOT NULL,
  `operations_manager` varchar(50) NOT NULL,
  `operations_manager_telephone` varchar(50) NOT NULL,
  `operations_manager_email` varchar(50) NOT NULL,
  `relations_manager` varchar(50) NOT NULL,
  `relations_manager_telephone` varchar(50) NOT NULL,
  `relations_manager_email` varchar(50) NOT NULL,
  `physical_address` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '10',
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_branch`
--

INSERT INTO `bank_branch` (`branch_id`, `branch_name`, `bank_id`, `branch_manager`, `branch_manager_telephone`, `branch_manager_email`, `operations_manager`, `operations_manager_telephone`, `operations_manager_email`, `relations_manager`, `relations_manager_telephone`, `relations_manager_email`, `physical_address`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(6, 'Nairobi', 'I&M', 'Kimatia Daniel', '254795511728', 'kkkk@gmail.com', 'Daniel joshua', '254710805424', 'kkk@gmail.com', 'Namanda Joshua', '254772773272', 'kk@gmail.com', 'Nairobi', '10', '1584544905', '1584544905', '999999999'),
(7, 'Liwatonii', 'Credit', 'Kimatia Daniel', '0795511728', 'kkkk@gmail.com', 'Daniel joshua', '0795511728', 'kkk@gmail.com', 'Namanda Joshua', '0795511728', 'kk@gmail.com', 'Mlolongo road', '10', '1584391868', '1600896968', 'admin'),
(12, 'Kengeleni', 'KCB', 'kimatia', '0710805424', 'kimatia@gmail.com', 'kimatia', '0710805424', 'kimatia@gmail.com', 'kimatia', '0710805424', 'kimatia@gmail.com', 'Kengeleni road', 'complete', '1601728563', '1601728563', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `batch_ref` varchar(50) NOT NULL,
  `cheques` varchar(50) NOT NULL,
  `amount` varchar(50) DEFAULT '0',
  `bank_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `account_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `month_year` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cheques`
--

CREATE TABLE `cheques` (
  `id` int(11) NOT NULL,
  `batch_id` varchar(50) DEFAULT NULL,
  `payee` varchar(150) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `pay_date` varchar(50) NOT NULL,
  `cheque_no` varchar(50) DEFAULT NULL,
  `bank_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `account_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `events_id` int(11) NOT NULL,
  `details` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`events_id`, `details`, `name`, `start`, `end`, `color`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(63, 'Weekend blocked', 'Weekend', '2020-10-17', '2020-10-17', '#da2f24', 'complete', '1602860604', '1602860604', 'admin'),
(64, 'Weekend blocked', 'Weekend', '2020-10-18', '2020-10-18', '#da2f24', 'complete', '1602860604', '1602860604', 'admin'),
(65, 'Weekend blocked', 'Weekend', '2020-10-24', '2020-10-24', '#da2f24', 'complete', '1602860604', '1602860604', 'admin'),
(66, 'Weekend blocked', 'Weekend', '2020-10-25', '2020-10-25', '#da2f24', 'complete', '1602860604', '1602860604', 'admin'),
(67, 'Weekend blocked', 'Weekend', '2020-10-31', '2020-10-31', '#da2f24', 'complete', '1602860604', '1602860604', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1596034696),
('m170823_080921_users', 1596034700),
('m170921_160116_news', 1596034700);

-- --------------------------------------------------------

--
-- Table structure for table `rejected`
--

CREATE TABLE `rejected` (
  `id` int(11) NOT NULL,
  `batch_id` varchar(50) DEFAULT NULL,
  `payee` varchar(150) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `pay_date` varchar(50) NOT NULL,
  `cheque_no` varchar(50) DEFAULT NULL,
  `bank_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `account_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rejected`
--

INSERT INTO `rejected` (`id`, `batch_id`, `payee`, `amount`, `pay_date`, `cheque_no`, `bank_id`, `branch_id`, `account_id`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(269, '3385', 'mmmmm', '222', '2020-10-18', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602368061', '1602368061', 'admin'),
(270, '18262', 'sssss', '34000', '2020-10-25', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602406333', '1602406333', 'admin'),
(271, '9161', 'sesee', '13000', '2020-10-17', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602407379', '1602407379', 'admin'),
(272, '3850', 'ewwer', '34000', '2020-10-24', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602409361', '1602409361', 'admin'),
(273, '13347', 'vvcvcv', '345', '2020-10-18', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602493057', '1602493057', 'admin'),
(274, '18218', 'vvcvcv', '345', '2020-10-18', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602493073', '1602493073', 'admin'),
(275, '26997', 'vvcvcv', '345', '2020-10-18', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602493087', '1602493087', 'admin'),
(276, '27015', 'vvcvcv', '345', '2020-10-18', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602493152', '1602493152', 'admin'),
(277, '3380', 'vvcvcv', '345', '2020-10-18', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602493159', '1602493159', 'admin'),
(278, '11258', 'ddddd', '456', '2020-10-10', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602494511', '1602494511', 'admin'),
(279, '7795', 'ddddd', '456', '2020-10-10', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602494527', '1602494527', 'admin'),
(280, '17397', 'ddddd', '456', '2020-10-10', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602494536', '1602494536', 'admin'),
(281, '15349', 'ddddd', '456', '2020-10-10', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602494560', '1602494560', 'admin'),
(282, '18997', 'ddddd', '456', '2020-10-10', NULL, 'I&M', 'Nairobi', '8887776565643', 'rejected', '1602494562', '1602494562', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `signatories`
--

CREATE TABLE `signatories` (
  `signatory_id` int(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `account_id` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signatories`
--

INSERT INTO `signatories` (`signatory_id`, `user_id`, `account_id`, `type`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'kims', '8887776565643', 'must', 'complete', '1600889098', '1600889098', 'admin'),
(2, 'Joy', '8887976565444', 'must', 'complete', '1600889098', '1600890512', 'admin'),
(3, 'kimatia', '3656783947346', 'Must', 'complete', '1601728632', '1601728632', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kimatia', 'admin', '8qEBHZtWU2lBI_JZM_uh3Lyr2WWhRdch', '$2y$13$mfRZU89BJ2l6ATDc.dH9DewYJ3ydoYkSMg9MGZvxtZPcw5ZVYNU2m', NULL, 'admin@gmail.com', 10, 1596034789, 1596034789),
(3, 'daggy', 'user', 'ksWrHZy91dckl82OhY4Q_rchTO8Ujjct', '$2y$13$mfRZU89BJ2l6ATDc.dH9DewYJ3ydoYkSMg9MGZvxtZPcw5ZVYNU2m', NULL, 'daggy@gmail.com', 10, 1596603665, 1596603665);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `account_number` (`account_number`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`),
  ADD UNIQUE KEY `bank_name` (`bank_name`);

--
-- Indexes for table `bank_branch`
--
ALTER TABLE `bank_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheques`
--
ALTER TABLE `cheques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `rejected`
--
ALTER TABLE `rejected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatories`
--
ALTER TABLE `signatories`
  ADD PRIMARY KEY (`signatory_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bank_branch`
--
ALTER TABLE `bank_branch`
  MODIFY `branch_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `cheques`
--
ALTER TABLE `cheques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `events_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `rejected`
--
ALTER TABLE `rejected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `signatories`
--
ALTER TABLE `signatories`
  MODIFY `signatory_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
