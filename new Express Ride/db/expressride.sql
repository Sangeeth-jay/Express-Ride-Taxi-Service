-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 06:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expressride`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `pickup_point` varchar(45) DEFAULT NULL,
  `destination` varchar(45) DEFAULT NULL,
  `km` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `acceptation` varchar(45) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `pickup_point`, `destination`, `km`, `amount`, `date`, `time`, `acceptation`, `customer_id`, `vehicle_id`, `user_id`) VALUES
(4, 'Colombo', 'Galle', 125.5, 12550, '2023-09-23', '09:15:00', 'accepted', 1, 1, 3),
(5, 'Colombo', 'Matara', 153, 22950, '2023-09-26', '12:30:00', 'accepted', 2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `idbooking_status` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `booking_booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`idbooking_status`, `date`, `status`, `time`, `booking_booking_id`) VALUES
(3, '2023-09-23', 'waiting', '09:15:00', 4),
(4, '2023-09-26', 'waiting', '12:30:00', 5),
(11, '2023-09-26', 'accepted', '19:04:19', 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `nic` varchar(45) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `nic`, `email`, `telephone`, `password`) VALUES
(1, 'Avindu', 'Dilshan', '992456127v', 'avindu456@gmail.com', 779291667, '123'),
(2, 'Nipun', 'Maduranga', '2000214123', 'nipun@gmail.com', 885522, '456'),
(12, 'pawan', 'ravindra', '992255544v', 'pawan@gmail.com', 773254867, '123');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(11) NOT NULL,
  `town_name` varchar(100) DEFAULT NULL,
  `km_from_colombo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `town_name`, `km_from_colombo`) VALUES
(1, 'Galle', 125.5),
(2, 'Matara', 153),
(3, 'Colombo', 0),
(4, 'Negambo', 37),
(5, 'Gampaha', 34.6),
(6, 'Avissawela', 48.5),
(7, 'Kurunagala', 100.2),
(8, 'Kandy', 120.8),
(9, 'Nuwara Eliya', 156.8);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `description`) VALUES
(1, 'new news'),
(2, 'Getting 10% off for to the DFCC Credit Cards. Collect your rewards today!'),
(3, 'news 2'),
(4, 'today');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `nic` varchar(45) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `user_name`, `password`, `designation`, `nic`, `telephone`) VALUES
(1, 'Avindu Dilshan', 'avindu', '123', '1', '9922', 7788),
(2, 'Dilshan Chathuranga', 'dilshan', '456', '2', '9944', 75),
(3, 'Kaluwa', 'kalu', '789', '3', '25', 74),
(6, 'Pawan Ravindra', 'pawan', '123', '3', '9935', 2147483647),
(7, '', '', '9936', '', '9936', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `cost_per_km` float DEFAULT NULL,
  `availability` varchar(45) DEFAULT NULL,
  `driver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `type`, `cost_per_km`, `availability`, `driver_id`) VALUES
(1, 'van', 100, 'Not-available', 3),
(2, 'car', 150, 'available', 3),
(3, 'Bus', 50, 'Avilable', 3),
(5, 'car', 150, 'Avilable', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`,`customer_id`,`vehicle_id`,`user_id`),
  ADD KEY `fk_booking_customer_idx` (`customer_id`),
  ADD KEY `fk_booking_vehicle1_idx` (`vehicle_id`,`user_id`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`idbooking_status`,`booking_booking_id`),
  ADD KEY `fk_booking_status_booking1_idx` (`booking_booking_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`,`nic`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`,`booking_id`,`customer_id`),
  ADD KEY `fk_feedback_booking1_idx` (`booking_id`,`customer_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`,`booking_id`,`customer_id`),
  ADD KEY `fk_payment_booking1_idx` (`booking_id`,`customer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`,`driver_id`),
  ADD KEY `fk_vehicle_user1_idx` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `idbooking_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_vehicle1` FOREIGN KEY (`vehicle_id`,`user_id`) REFERENCES `vehicle` (`vehicle_id`, `driver_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD CONSTRAINT `fk_booking_status_booking1` FOREIGN KEY (`booking_booking_id`) REFERENCES `booking` (`booking_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_booking1` FOREIGN KEY (`booking_id`,`customer_id`) REFERENCES `booking` (`booking_id`, `customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_booking1` FOREIGN KEY (`booking_id`,`customer_id`) REFERENCES `booking` (`booking_id`, `customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk_vehicle_user1` FOREIGN KEY (`driver_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
