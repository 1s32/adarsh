-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 07:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cars`
--

CREATE TABLE `tbl_cars` (
  `carid` int(11) NOT NULL,
  `carname` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `model_year` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `km` varchar(30) NOT NULL,
  `milege` int(11) NOT NULL,
  `status` enum('1','0') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cars`
--

INSERT INTO `tbl_cars` (`carid`, `carname`, `model`, `model_year`, `price`, `image`, `km`, `milege`, `status`) VALUES
(1240, 'kia ', 'seltos', '2011', 222222, 'up/65eca71ccc033_65d0ba8e5066f_Kia Seltos 2023 Facelift 1677504205338 (3).jpg', '2', 1, '1'),
(1241, 'MaruthiSuzuki', 'Swift', '2023', 400000, 'up/65e843330e5d8_6531f2795fac2_swift1.jpeg', '33', 55, '1'),
(1242, 'Toyota', 'Innova', '2023', 200000, 'up/65ec9f4857720_65125f1c9e58d_innovahome.jpg', '800', 556654, '1'),
(1243, 'MaruthiSuzuki', 'Alto', '2022', 600000, 'up/65eca013dec9f_65d0ca0aa3f48_65116a2410678_alto.jpg', '2022', 17, '1'),
(1247, 'MaruthiSuzuki', 'Alto', '2022', 600000, 'up/65eca181720ce_65d0ca0aa3f48_65116a2410678_alto.jpg', '2022', 17, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `lid` int(11) NOT NULL,
  `role` varchar(30) DEFAULT 'user',
  `status` enum('blocked','unblocked') DEFAULT 'unblocked',
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `Gcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`lid`, `role`, `status`, `email`, `password`, `Gcode`) VALUES
(2, 'admin', 'unblocked', 'admin@gmail.com', 'Admin.@123', 699039),
(13, 'user', 'unblocked', 'adarsh918g@gmail.com', 'Adarsh.@123', 684520);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oilchange`
--

CREATE TABLE `tbl_oilchange` (
  `oilid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_register`
--

CREATE TABLE `tbl_register` (
  `rid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_register`
--

INSERT INTO `tbl_register` (`rid`, `lid`, `phone`, `name`) VALUES
(3, 6, '7878665654', 'aby'),
(4, 8, '7878665654', 'aby'),
(5, 9, '8590771875', 'adarsh'),
(6, 10, '8982323387', 'bins'),
(7, 11, '8590887123', 'jhjk'),
(8, 12, '8590887123', 'jhjk'),
(9, 13, '8787878787', 'adarsh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_repairservice.php`
--

CREATE TABLE `tbl_repairservice.php` (
  `repid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `bdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tierservice`
--

CREATE TABLE `tbl_tierservice` (
  `tierid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `bdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tierservice`
--

INSERT INTO `tbl_tierservice` (`tierid`, `lid`, `bdate`) VALUES
(1, 0, '2024-03-06'),
(2, 0, '2024-03-05'),
(3, 0, '2024-03-05'),
(4, 0, '2024-03-05'),
(5, 6, '2024-03-05'),
(6, 0, '2024-03-05'),
(7, 0, '2024-03-06'),
(8, 6, '2024-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userfeedbacks`
--

CREATE TABLE `tbl_userfeedbacks` (
  `fid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `feedback` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userfeedbacks`
--

INSERT INTO `tbl_userfeedbacks` (`fid`, `lid`, `feedback`) VALUES
(1, 6, 'great\r\n'),
(2, 6, 'GOOD'),
(3, 6, 'great\r\n'),
(4, 6, 'great\r\n'),
(5, 6, 'great');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_washservice`
--

CREATE TABLE `tbl_washservice` (
  `washid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`cid`, `lid`) VALUES
(1240, 8),
(1240, 13),
(1241, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cars`
--
ALTER TABLE `tbl_cars`
  ADD PRIMARY KEY (`carid`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `tbl_oilchange`
--
ALTER TABLE `tbl_oilchange`
  ADD PRIMARY KEY (`oilid`);

--
-- Indexes for table `tbl_register`
--
ALTER TABLE `tbl_register`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tbl_repairservice.php`
--
ALTER TABLE `tbl_repairservice.php`
  ADD PRIMARY KEY (`repid`);

--
-- Indexes for table `tbl_tierservice`
--
ALTER TABLE `tbl_tierservice`
  ADD PRIMARY KEY (`tierid`);

--
-- Indexes for table `tbl_userfeedbacks`
--
ALTER TABLE `tbl_userfeedbacks`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `tbl_washservice`
--
ALTER TABLE `tbl_washservice`
  ADD PRIMARY KEY (`washid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cars`
--
ALTER TABLE `tbl_cars`
  MODIFY `carid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1248;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_oilchange`
--
ALTER TABLE `tbl_oilchange`
  MODIFY `oilid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_register`
--
ALTER TABLE `tbl_register`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_repairservice.php`
--
ALTER TABLE `tbl_repairservice.php`
  MODIFY `repid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tierservice`
--
ALTER TABLE `tbl_tierservice`
  MODIFY `tierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_userfeedbacks`
--
ALTER TABLE `tbl_userfeedbacks`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_washservice`
--
ALTER TABLE `tbl_washservice`
  MODIFY `washid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
