-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 09:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pblvoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `email` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`email`, `pass`) VALUES
('anuragspatil88@gmail.com', '$2y$10$uXrGZDKEZwfE0d.4fE7QZey4i17R1YEhwKHuMuk39c7SyI4J./R1G');

-- --------------------------------------------------------

--
-- Table structure for table `cand`
--

CREATE TABLE `cand` (
  `id` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `PartyName` varchar(15) NOT NULL,
  `DPimage` varchar(255) NOT NULL,
  `Post` varchar(15) NOT NULL,
  `votes` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cand`
--

INSERT INTO `cand` (`id`, `Name`, `PartyName`, `DPimage`, `Post`, `votes`) VALUES
(16, 'Narendra Modi', 'BJP ', 'PMmodi.jpg', 'Prime Minister', 3),
(17, 'Donald Trump', 'USA', 'donaldtrump.jpg', 'Prime Minister', 1),
(18, 'Xi Jinping', 'China', 'Xi_Jinping.jpg', 'Prime Minister', 1),
(19, 'Vladimir Putin', 'Russia', 'vladimirPutin.jpg', 'Prime Minister', 1);

-- --------------------------------------------------------

--
-- Table structure for table `regdetails`
--

CREATE TABLE `regdetails` (
  `sr` int(11) NOT NULL,
  `firstname` varchar(11) NOT NULL,
  `lastname` varchar(11) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regdetails`
--

INSERT INTO `regdetails` (`sr`, `firstname`, `lastname`, `gender`, `age`, `email`, `password`, `status`) VALUES
(19, 'Anurag', 'Patil', 'Male', 19, 'patilanurag405@gmail.com', '$2y$10$E6FxeKVUXGbA80YFsLkAxeKCidG5Sv/AtS5Vywt6IQeEqxd4Cwe4G', 1),
(21, 'Elon', 'Musk', 'Male', 55, 'elonmusk@gmail.com', '$2y$10$4F44c3JcKqn0MIVfzPQuwOYXp4zkbr3EA35OMhietcb1QvMVTL9vK', 1),
(26, 'Mohan', 'Sharma', 'Male', 55, 'mohansharma44@gmail.com', '$2y$10$X5MNpBD5bx6O5oosyIz51.mS3hSYJ2Rfy3XghdVbNbLd3LWSVpoEK', 1),
(27, 'Samruddhi', 'Patil', 'Female', 21, 'samruddhipatil159@gmail.com', '$2y$10$sSaTM0V0v9jMr8E8miX8gOMTi4I.oBZ/w4raoFOABhU5cvMko8HBi', 1),
(28, 'Logan', 'Paul', 'Male', 32, 'loganpaul@gmail.com', '$2y$10$8FiS/spPTPnxzKm80SyXXe73Ec37CJkIFAKIb0ZpQn7VK3dG.geI2', 1),
(29, 'Rohan', 'Patel', 'Male', 45, 'rohanpatel@gmail.com', '$2y$10$0WWIgakvkyvtERIDYqS4uORit/6yJSI.2ox9BUKPhAKc9SnIf/9m.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cand`
--
ALTER TABLE `cand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regdetails`
--
ALTER TABLE `regdetails`
  ADD PRIMARY KEY (`sr`),
  ADD UNIQUE KEY `uq_regdetails_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cand`
--
ALTER TABLE `cand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `regdetails`
--
ALTER TABLE `regdetails`
  MODIFY `sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
