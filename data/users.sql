-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2021 at 01:48 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction3_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(15) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `address` varchar(60) NOT NULL,
  `country` varchar(15) NOT NULL,
  `image` longblob NOT NULL,
  `branch` int(100) NOT NULL,
  `balance` int(100) NOT NULL,
  PRIMARY KEY(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--
--for blob data )please choose a random file as your avatar
INSERT INTO `users` (`firstname`, `lastname`, `username`, `phonenumber`, `email`, `password`, `ID`, `address`, `address`, `country`, `branch`, `balance`) VALUES
('Dang Huy', 'Nguyen', 'darkdraken', '0903210302', 'anhmeochidang@gmail.com', 'b11d834ec73ef531b33cf30103232e9e8e7e3398', 12341245, '702 Nguyen Van Linh, Tan Hung, Quan 7', 'Ho chi minh ', 'vietnam', 2, 350000000),
('Sang', 'Nguyen', 'darkdraken123', '0903210303', 'darkdraken47@gmail.com', 'danghuy0505', 2147483647, 'Handi Resco Building, 521 Kim Ma, Ngoc Khanh, Ba Đinh', 'Ha Noi', 'Vietnam', 1, 400000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`firstname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
