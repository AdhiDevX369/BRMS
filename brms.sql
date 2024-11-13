-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 07:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nic`, `password`, `role`) VALUES
(1, '725411219v', '123456', 'admin'),
(3, '897894564v', '$2y$10$uejf5NdCHiOU0F3S/9L0Du3IXzX9mDrywbHTI0/WnnQocx8VkntGK', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_request`
--

CREATE TABLE `admin_request` (
  `id` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `designation` enum('Divisional Secretariat','Additional Divisional Secretariat','Accountant','Administration Officer','IT Staff','Subject Officer') NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('pending','approved','rejected','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_request`
--

INSERT INTO `admin_request` (`id`, `nic`, `full_name`, `dob`, `designation`, `password`, `status`) VALUES
(1, '199305801372', 'udesh kumara', '0000-00-00', 'Subject Officer', '786642436', ''),
(6, '897894564v', 'madawa viduranga', '1989-10-02', '', '789456', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `business_name` varchar(200) NOT NULL,
  `stutus` enum('review your documents','coming soon visit the business','send to approved','approved and come to payement','rejected','document are not completed, call us') NOT NULL,
  `update_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `application_id` int(11) NOT NULL,
  `GN_div` varchar(255) NOT NULL,
  `Business_Name` varchar(255) NOT NULL,
  `Nature_Of_Business` varchar(255) NOT NULL,
  `Address_of_business` varchar(255) NOT NULL,
  `Start_date` date NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `NIC` varchar(12) NOT NULL,
  `Any_Other_Business` varchar(255) DEFAULT NULL,
  `If_Owner_Had_Names` varchar(255) DEFAULT NULL,
  `Nationality` varchar(100) NOT NULL,
  `Address_of_Owner` varchar(255) NOT NULL,
  `Business_type` enum('individual','partnership') NOT NULL,
  `Others` varchar(255) DEFAULT NULL,
  `BR_Number` varchar(30) NOT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `update_time` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`application_id`, `GN_div`, `Business_Name`, `Nature_Of_Business`, `Address_of_business`, `Start_date`, `owner_name`, `NIC`, `Any_Other_Business`, `If_Owner_Had_Names`, `Nationality`, `Address_of_Owner`, `Business_type`, `Others`, `BR_Number`, `document_path`, `status`, `update_time`) VALUES
(0, 'amuhena', 'randika', 'spice', '3 amuhena gampola', '2024-10-01', 'shAKIRA', '147852369V', 'no', 'no', 'Sri lankan', '3 amuhena gampola', 'individual', 'no', '', 'uploads/SinhalaTamilKit_IME_Win10_20H2_October_2020.zip', '', '2024-11-10 10:29:52'),
(0, 'athgala north', 'gihan stores', 'shop', '64 athgala gampola', '2024-11-04', 'gihan sanjeewa', '933403645v', 'no', 'no', 'Sri lankan', '64 athgala gampola', 'individual', 'no', '', 'uploads/SinhalaTamilKit_IME_Win10_20H2_October_2020.zip', 'pending', '2024-11-10 19:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` varchar(12) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `submitted_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `full_name`, `phone_number`, `email`, `message`, `submitted_at`) VALUES
('67317a1e83fa', 'sakura rajapakshe', '0114758693', 'sakuraja@gmail.com', 'abc pvt', '2024-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_businesses`
--

CREATE TABLE `deleted_businesses` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `deleted_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edited businesses`
--

CREATE TABLE `edited businesses` (
  `id` int(12) NOT NULL,
  `business_id` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `edited_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `business_id` varchar(12) NOT NULL,
  `BR_Number` varchar(50) NOT NULL,
  `registration_fee` decimal(10,0) NOT NULL DEFAULT 250,
  `late_fee` decimal(10,0) NOT NULL,
  `total_amount` int(10) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`business_id`, `BR_Number`, `registration_fee`, `late_fee`, `total_amount`, `payment_date`) VALUES
('0', '', 250, 160, 410, '2024-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `tms_feedback`
--

CREATE TABLE `tms_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comments` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tms_feedback`
--

INSERT INTO `tms_feedback` (`id`, `name`, `email`, `rating`, `comments`, `submitted_at`) VALUES
(1, 'rasindu', 'rvidu@gmail.com', 5, 'good work!', '2024-11-09 09:59:00'),
(2, 'sakura rajapakshe', 'sakuraja@gmail.com', NULL, 'wow', '2024-11-11 04:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `role` enum('admin','user','','') NOT NULL,
  `id` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`role`, `id`, `nic`, `name`, `address`, `email`, `password`) VALUES
('admin', 3, '199305801372', 'udesh', '89 amuhena gampola', 'udeshdilud@gmail.com', 'Ud93@227v'),
('admin', 4, '123456789v', 'ghj', 'gampola', 'hy@gmail.com', '258963'),
('admin', 5, '147852963v', 'nuwan\'  ', 'kurunegala', 'abc@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `admin_request`
--
ALTER TABLE `admin_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_businesses`
--
ALTER TABLE `deleted_businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edited businesses`
--
ALTER TABLE `edited businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `tms_feedback`
--
ALTER TABLE `tms_feedback`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_request`
--
ALTER TABLE `admin_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deleted_businesses`
--
ALTER TABLE `deleted_businesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edited businesses`
--
ALTER TABLE `edited businesses`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tms_feedback`
--
ALTER TABLE `tms_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
