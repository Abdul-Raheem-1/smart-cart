-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 05:56 AM
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
-- Database: `ebookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `image` varchar(512) NOT NULL,
  `creditcard` varchar(16) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `contactnumber` varchar(50) NOT NULL,
  `isadmin` int(11) NOT NULL,
  `isseller` int(11) NOT NULL,
  `createdon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `dob`, `image`, `creditcard`, `gender`, `address`, `contactnumber`, `isadmin`, `isseller`, `createdon`) VALUES
(10, 'Muhammad Ali Khan', 'admin1018', 'admin@iqra.com', '2000-03-22', 'default.png', '1111111111111111', 'Male', 'Gulshan-e-Iqbal', '03302399258', 1, 0, ''),
(14, 'Amaaz', '123', 'amaz@gmail.com', '', '', '1111111111111111', 'Male', 'Gulshan-e-Iqbal', '0330000000', 0, 0, '2021-03-21'),
(15, 'faizan khan', '123', 'f@gmail.com', '2021-03-16', '161713066_883878445522848_1490982166969035585_n.jpg', '1111111111111111', 'Male', 'Gulshan-e-Iqbal 13', '0330000000', 0, 0, '2021-03-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
