-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2016 at 07:58 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musafir`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `country_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `country_name`) VALUES
(1, 'Dhaka', 'Bangladesh'),
(2, 'Mumbai', 'India'),
(3, 'New York', 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `passport_no` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `contact_no` int(11) NOT NULL,
  `contact_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`passport_no`, `name`, `gender`, `birth_date`, `contact_no`, `contact_address`) VALUES
('f12s34', 'Fahim Mohiuddin', 'Male', '1994-01-24', 1673200901, 'Gopibag, Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
  `flight_id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `vacant_seats` int(11) NOT NULL,
  `ticket_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `plane_id`, `route_id`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `vacant_seats`, `ticket_price`) VALUES
(2, 1, 1, '2016-02-05', '2016-02-05', '07:00:00', '08:00:00', 100, 3000),
(3, 3, 1, '2016-02-05', '2016-02-05', '10:00:00', '11:00:00', 180, 4500),
(4, 2, 2, '2016-02-06', '2016-02-06', '10:00:00', '11:00:00', 100, 3000),
(5, 3, 3, '2016-02-17', '2016-02-17', '10:00:00', '22:00:00', 180, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE IF NOT EXISTS `planes` (
  `plane_id` int(11) NOT NULL,
  `plane_type_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`plane_id`, `plane_type_id`) VALUES
(1, 1),
(2, 1),
(4, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `plane_types`
--

CREATE TABLE IF NOT EXISTS `plane_types` (
  `plane_type_id` int(11) NOT NULL,
  `plane_type_name` varchar(50) NOT NULL,
  `plane_type_capacity` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plane_types`
--

INSERT INTO `plane_types` (`plane_type_id`, `plane_type_name`, `plane_type_capacity`) VALUES
(1, 'Jet', 100),
(2, 'Jumbo Jet', 180);

-- --------------------------------------------------------

--
-- Table structure for table `route_list`
--

CREATE TABLE IF NOT EXISTS `route_list` (
  `route_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_list`
--

INSERT INTO `route_list` (`route_id`, `source_id`, `destination_id`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 3),
(4, 2, 3),
(5, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket_id` int(11) NOT NULL,
  `passport_no` varchar(50) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `seat_count` int(11) NOT NULL,
  `fare_amount` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `passport_no`, `flight_id`, `seat_count`, `fare_amount`, `booking_date`, `purchase_date`, `status`) VALUES
(1, 'f12s34', 3, 6, 27000, '2016-02-16', NULL, 'Booked');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`passport_no`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`),
  ADD KEY `plane_id` (`plane_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`plane_id`),
  ADD KEY `plane_type_id` (`plane_type_id`);

--
-- Indexes for table `plane_types`
--
ALTER TABLE `plane_types`
  ADD PRIMARY KEY (`plane_type_id`);

--
-- Indexes for table `route_list`
--
ALTER TABLE `route_list`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `passport_no` (`passport_no`),
  ADD KEY `flight_id` (`flight_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `plane_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `plane_types`
--
ALTER TABLE `plane_types`
  MODIFY `plane_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `route_list`
--
ALTER TABLE `route_list`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `planes` (`plane_id`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `route_list` (`route_id`);

--
-- Constraints for table `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_ibfk_1` FOREIGN KEY (`plane_type_id`) REFERENCES `plane_types` (`plane_type_id`);

--
-- Constraints for table `route_list`
--
ALTER TABLE `route_list`
  ADD CONSTRAINT `route_list_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `route_list_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `cities` (`city_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`passport_no`) REFERENCES `customers` (`passport_no`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
