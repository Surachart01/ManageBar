-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2024 at 09:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manage_table`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tableId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detailProduct`
--

CREATE TABLE `detailProduct` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(1) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT './image/profile/defaultUser.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `userName`, `email`, `phone`, `password`, `role`, `image`) VALUES
(19, 'Admin', 'admin@admin', '0000000000', 'b59c67bf196a4758191e42f76670ceba', '2', './image/profile/defaultUser.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `News`
--

CREATE TABLE `News` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `memberId` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `state` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `optionName` varchar(100) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `state` varchar(1) DEFAULT NULL,
  `QRCODE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderProduct`
--

CREATE TABLE `orderProduct` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `tableId` int(11) NOT NULL,
  `state` varchar(1) NOT NULL,
  `SLIP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `SLIP` varchar(100) NOT NULL,
  `UID` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `tableId` int(10) NOT NULL,
  `date` varchar(100) NOT NULL,
  `log` varchar(100) NOT NULL,
  `state` varchar(1) NOT NULL,
  `type` varchar(50) NOT NULL,
  `orderId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `tableNum` varchar(10) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `tableNum`, `price`) VALUES
(1, 'A001', 0),
(2, 'A002', 0),
(3, 'A003', 0),
(4, 'A004', 0),
(5, 'A005', 0),
(6, 'A006', 0),
(7, 'A007', 0),
(8, 'A008', 0),
(9, 'A009', 0),
(10, 'A010', 0),
(11, 'A011', 0),
(12, 'A012', 0),
(13, 'A013', 0),
(14, 'A014', 0),
(15, 'A015', 0),
(16, 'A016', 0),
(17, 'A017', 0),
(18, 'A018', 0),
(19, 'A019', 0),
(20, 'A020', 0),
(21, 'A021', 0),
(22, 'A022', 0),
(23, 'A023', 0),
(24, 'A024', 0),
(25, 'A025', 0),
(26, 'A026', 0),
(27, 'A027', 0),
(28, 'A028', 0),
(29, 'A029', 0),
(30, 'A030', 0),
(31, 'A031', 0),
(32, 'A032', 0),
(33, 'A033', 0),
(34, 'A034', 0),
(35, 'A035', 0),
(36, 'A036', 0),
(37, 'A037', 0),
(38, 'A038', 0),
(39, 'A039', 0),
(40, 'A040', 0),
(41, 'A041', 0),
(42, 'A042', 0),
(43, 'A043', 0),
(44, 'A044', 0),
(45, 'A045', 0),
(46, 'A046', 0),
(47, 'A047', 0),
(48, 'A048', 0),
(49, 'A049', 0),
(50, 'A050', 0),
(51, 'A051', 0),
(52, 'A052', 0),
(53, 'A053', 0),
(54, 'A054', 0),
(55, 'A055', 0),
(56, 'A056', 0),
(57, 'A057', 0),
(58, 'A058', 0),
(59, 'A059', 0),
(60, 'A060', 0),
(61, 'A061', 0),
(62, 'A062', 0),
(63, 'A063', 0),
(64, 'A064', 0),
(65, 'A065', 0),
(66, 'A066', 0),
(67, 'A067', 0),
(68, 'A068', 0),
(69, 'A069', 0),
(70, 'A070', 0),
(71, 'A071', 0),
(72, 'A072', 0),
(73, 'A073', 0),
(74, 'A074', 0),
(75, 'A075', 0),
(76, 'A076', 0),
(77, 'A077', 0),
(78, 'A078', 0),
(79, 'A079', 0),
(80, 'A080', 0),
(81, 'A081', 0),
(82, 'A082', 0),
(83, 'A083', 0),
(84, 'A084', 0),
(85, 'A085', 0),
(86, 'A086', 0),
(87, 'A087', 0),
(88, 'A088', 0),
(89, 'A089', 0),
(90, 'A090', 0),
(91, 'A091', 0),
(92, 'A092', 0),
(93, 'A093', 0),
(94, 'A094', 0),
(95, 'A095', 0),
(96, 'A096', 0),
(97, 'A097', 0),
(98, 'A098', 0),
(99, 'A099', 0),
(100, 'A100', 0),
(101, 'A101', 0),
(102, 'A102', 0),
(103, 'A103', 0),
(104, 'A104', 0),
(105, 'A105', 0),
(106, 'A106', 0),
(107, 'A107', 0),
(108, 'A108', 0),
(109, 'A109', 0),
(110, 'A110', 0),
(111, 'A111', 0),
(112, 'A112', 0),
(113, 'A113', 0),
(114, 'A114', 0),
(115, 'A115', 0),
(116, 'A116', 0),
(117, 'A117', 0),
(118, 'A118', 0),
(119, 'A119', 0),
(120, 'A120', 0),
(121, 'A121', 0),
(122, 'A122', 0),
(123, 'A123', 0),
(124, 'A124', 0),
(125, 'A125', 0),
(126, 'A126', 0),
(127, 'A127', 0),
(128, 'A128', 0),
(129, 'A129', 0),
(130, 'A130', 0),
(131, 'A131', 0),
(132, 'A132', 0),
(133, 'A133', 0),
(134, 'A134', 0),
(135, 'A135', 0),
(136, 'A136', 0),
(137, 'A137', 0),
(138, 'A138', 0),
(139, 'A139', 0),
(140, 'A140', 0),
(141, 'A141', 0),
(142, 'A142', 0),
(143, 'A143', 0),
(144, 'A144', 0),
(145, 'A145', 0),
(146, 'A146', 0),
(147, 'A147', 0),
(148, 'A148', 0),
(149, 'A149', 0),
(150, 'A150', 0),
(151, 'A151', 0),
(152, 'A152', 0),
(153, 'A153', 0),
(154, 'A154', 0),
(155, 'A155', 0),
(156, 'A156', 0),
(157, 'A157', 0),
(158, 'A158', 0),
(159, 'A159', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailProduct`
--
ALTER TABLE `detailProduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderProduct`
--
ALTER TABLE `orderProduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Member` (`memberId`),
  ADD KEY `FK_Table` (`tableId`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detailProduct`
--
ALTER TABLE `detailProduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `News`
--
ALTER TABLE `News`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderProduct`
--
ALTER TABLE `orderProduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `FK_Member` FOREIGN KEY (`memberId`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Table` FOREIGN KEY (`tableId`) REFERENCES `tables` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
