-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 03:49 PM
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
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `externalbooking`
--

CREATE TABLE `externalbooking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_status` varchar(50) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `famousspot`
--

CREATE TABLE `famousspot` (
  `sid` int(11) NOT NULL,
  `Fspot_name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `contactInfo` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `notif_message` text DEFAULT NULL,
  `notif_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `tid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `rid` int(11) NOT NULL,
  `budget` decimal(10,2) NOT NULL,
  `noOfDays` int(11) NOT NULL,
  `price_rate` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `tid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `contactInfo` varchar(255) DEFAULT NULL,
  `R_price` decimal(10,2) NOT NULL,
  `p_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourist`
--

CREATE TABLE `tourist` (
  `tid` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourist_phoneno`
--

CREATE TABLE `tourist_phoneno` (
  `tid` int(11) NOT NULL,
  `phoneNo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourplan`
--

CREATE TABLE `tourplan` (
  `p_id` int(11) NOT NULL,
  `s_date` date DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `plan_status` varchar(255) NOT NULL,
  `tour_cost` decimal(10,2) NOT NULL,
  `noOfDays` int(11) DEFAULT NULL,
  `rid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `transport_id` int(11) NOT NULL,
  `transport_type` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitspot`
--

CREATE TABLE `visitspot` (
  `vid` int(11) NOT NULL,
  `vname` varchar(255) NOT NULL,
  `v_description` text DEFAULT NULL,
  `v_location` varchar(250) NOT NULL,
  `p_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `externalbooking`
--
ALTER TABLE `externalbooking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `transport_id` (`transport_id`);

--
-- Indexes for table `famousspot`
--
ALTER TABLE `famousspot`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `tid` (`tid`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `tourist`
--
ALTER TABLE `tourist`
  ADD PRIMARY KEY (`tid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tourist_phoneno`
--
ALTER TABLE `tourist_phoneno`
  ADD PRIMARY KEY (`tid`,`phoneNo`);

--
-- Indexes for table `tourplan`
--
ALTER TABLE `tourplan`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `rid` (`rid`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transport_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `visitspot`
--
ALTER TABLE `visitspot`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `p_id` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `externalbooking`
--
ALTER TABLE `externalbooking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `famousspot`
--
ALTER TABLE `famousspot`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourist`
--
ALTER TABLE `tourist`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourplan`
--
ALTER TABLE `tourplan`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `externalbooking`
--
ALTER TABLE `externalbooking`
  ADD CONSTRAINT `externalbooking_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `externalbooking_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `externalbooking_ibfk_3` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`) ON DELETE CASCADE;

--
-- Constraints for table `famousspot`
--
ALTER TABLE `famousspot`
  ADD CONSTRAINT `famousspot_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tourplan` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tourplan` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tourist` (`tid`) ON DELETE CASCADE;

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tourist` (`tid`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tourplan` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `tourist_phoneno`
--
ALTER TABLE `tourist_phoneno`
  ADD CONSTRAINT `tourist_phoneno_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tourist` (`tid`) ON DELETE CASCADE;

--
-- Constraints for table `tourplan`
--
ALTER TABLE `tourplan`
  ADD CONSTRAINT `tourplan_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `requirements` (`rid`) ON DELETE CASCADE;

--
-- Constraints for table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tourplan` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `visitspot`
--
ALTER TABLE `visitspot`
  ADD CONSTRAINT `visitspot_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tourplan` (`p_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
