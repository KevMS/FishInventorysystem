-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 06:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fish_inventory`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `autoInc` () RETURNS INT(10)  BEGIN
        DECLARE getCount INT(10);

        SET getCount = (
            SELECT COUNT(item_number)
            FROM fish_items) + 1;

        RETURN getCount;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accesslog`
--

CREATE TABLE `accesslog` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `timeLogin` datetime DEFAULT NULL,
  `timeLogout` datetime DEFAULT NULL,
  `IPaddress` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accesslog`
--

INSERT INTO `accesslog` (`ID`, `userID`, `timeLogin`, `timeLogout`, `IPaddress`) VALUES
(1, 3, '2022-12-17 06:07:17', NULL, '::1'),
(2, 3, '2022-12-17 06:07:48', '2022-12-17 06:08:03', '::1'),
(3, 1, '2022-12-17 06:08:08', '2022-12-17 13:10:53', '::1'),
(4, 1, '2022-12-17 13:10:59', '2022-12-17 13:11:35', '::1'),
(5, 1, '2022-12-17 13:11:40', '2022-12-17 13:11:52', '::1'),
(6, 1, '2022-12-17 13:14:27', NULL, '::1'),
(7, 1, '2022-12-17 13:16:49', NULL, '::1'),
(8, 1, '2022-12-17 13:17:32', NULL, '::1'),
(9, 1, '2022-12-17 13:17:45', NULL, '::1'),
(10, 1, '2022-12-17 13:35:44', NULL, '::1'),
(11, 1, '2022-12-17 13:36:05', NULL, '::1'),
(12, 1, '2022-12-17 13:37:27', NULL, '::1'),
(13, 1, '2022-12-17 13:37:31', NULL, '::1'),
(14, 1, '2022-12-17 13:38:25', NULL, '::1'),
(15, 1, '2022-12-17 13:38:54', NULL, '::1'),
(16, 1, '2022-12-17 13:39:26', NULL, '::1'),
(17, 1, '2022-12-17 13:39:38', NULL, '::1'),
(18, 1, '2022-12-17 13:40:07', NULL, '::1'),
(19, 1, '2022-12-17 13:41:32', '2022-12-17 13:42:07', '::1'),
(20, 1, '2022-12-17 13:42:12', '2022-12-17 13:42:43', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin2', 'admin'),
(3, 'kevzkie213', 'kevzkie213', 'user'),
(4, 'admin2', 'admin3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catID`, `categoryName`, `description`, `photo`) VALUES
(1, 'Whole Fish', '', 'fresh-whole-fish.jpg'),
(2, 'Dried Fish', 'Dried Fish is a type of fish that has been preserved by removing the moisture content through drying process.', 'depositphotos_156000438-stock-photo-dried-fish-market-on-the.jpg'),
(3, 'Sliced Fish', 'The fish can be sliced in various ways, such as lengthwise or crosswise,  and the thickness of the slices can vary.', 'sliced fish.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `fullname`, `email`, `phone`, `address`, `date`) VALUES
(2, 'John Doe', 'john@gmail.com', '09278428144', 'Linao Ormoc City', '2022-12-01 00:55:33'),
(6, 'James Reid', 'james@gmail.com', '09676548263', 'Punta Ormoc City', '2022-12-01 01:06:14'),
(9, 'Kevin Saludaga', 'kevinsaludaga.5@gmail.com', '09126374885', 'Ormoc City Leyte', '2022-12-01 03:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `fish_items`
--

CREATE TABLE `fish_items` (
  `fish_id` int(11) NOT NULL,
  `item_number` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `discount` double NOT NULL,
  `stock` double NOT NULL,
  `unit_price` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_Added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fish_items`
--

INSERT INTO `fish_items` (`fish_id`, `item_number`, `item_name`, `category_name`, `discount`, `stock`, `unit_price`, `status`, `image`, `date_Added`) VALUES
(1, 1, 'Yellow Fin Tuna (Sliced)', 'Sliced Fish', 0, 30, 350, 'active', 'sliced tuna.jpg', '2022-12-17 05:37:13'),
(2, 2, 'Yellow Fin Tuna (Small)', 'Whole Fish', 0, 0, 350, 'active', 'whole yellow fin.jpg', '2022-12-16 21:05:33'),
(3, 3, 'Tuna-Bulis (Small)', 'Whole Fish', 0, 50, 350, 'active', 'IMG_20220820_171353.jpg', '2022-12-17 05:17:27'),
(4, 4, 'Barracoda (Sliced)', 'Sliced Fish', 0.1, 0, 380, 'active', 'baracodasliced.jpg', '2022-12-17 05:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `filename`, `name`) VALUES
(1, 'IMG_20211119_161307.jpg', 'fish'),
(2, 'IMG_20220111_180341.jpg', 'fish'),
(3, 'IMG20221025070246.jpg', 'fish'),
(4, 'IMG20221025083000.jpg', 'fish'),
(5, 'IMG20221110083008.jpg', 'fish man'),
(6, 'IMG20221211152421.jpg', 'tuna bucket');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` float NOT NULL,
  `unit_price` float NOT NULL,
  `total_cost` float NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `item_number`, `item_name`, `quantity`, `unit_price`, `total_cost`, `customer_name`, `order_date`, `status`) VALUES
(1, '1', 'Yellow Fin Tuna (Sliced)', 11, 350, 3850, 'John Doe', '2022-12-17 00:22:31', 'delivered'),
(2, '1', 'Yellow Fin Tuna (Sliced)', 10, 350, 3500, 'John Doe', '2022-12-17 01:10:46', 'pending'),
(3, '2', 'Yellow Fin Tuna (Small)', 11, 350, 3850, 'John Doe', '2022-12-17 05:39:50', 'pending'),
(4, '3', 'Tuna-Bulis (Small)', 25, 350, 8750, 'John Doe', '2022-12-17 05:39:53', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `item_number` int(250) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `total_cost` float NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `puchase_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `item_number`, `item_name`, `quantity`, `unit_price`, `total_cost`, `supplier_name`, `puchase_date`) VALUES
(1, 1, 'Yellow Fin Tuna (Sliced)', 50, 200, 10000, 'Rodsan Fishing Vessel', '2022-12-16 21:21:37'),
(2, 3, 'Tuna-Bulis (Small)', 50, 200, 10000, 'Rodsan Fishing Vessel', '2022-12-17 05:17:27'),
(3, 1, 'Yellow Fin Tuna (Sliced)', 30, 200, 6000, 'Rodsan Fishing Vessel', '2022-12-17 05:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_number` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` float NOT NULL,
  `unit_cost` float NOT NULL,
  `discount` float NOT NULL,
  `total_cost` float NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `order_id`, `item_number`, `item_name`, `quantity`, `unit_cost`, `discount`, `total_cost`, `customer_name`, `sale_date`) VALUES
(1, 1, 1, 'Yellow Fin Tuna (Sliced)', 11, 350, 0.1, 3465, 'John Doe', '2022-12-17 00:22:31'),
(2, 0, 1, 'Yellow Fin Tuna (Sliced)', 39, 350, 0.1, 12285, 'Walk-in Customer', '2022-12-17 00:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `email`, `phone`, `address`, `date`) VALUES
(1, 'Rodsan Fishing Vessel', 'rodsan@gmail.com', '09676548263', 'Ormoc City Leyte', '2022-11-29 02:34:32'),
(2, 'Milag&#039;s Dried Fish', 'milagsdriedfish@gmail.com', '09563524776', 'Punta, Ormoc City Leyte', '2022-11-29 02:36:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslog`
--
ALTER TABLE `accesslog`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catID`),
  ADD KEY `catID` (`catID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `fish_items`
--
ALTER TABLE `fish_items`
  ADD PRIMARY KEY (`fish_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslog`
--
ALTER TABLE `accesslog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fish_items`
--
ALTER TABLE `fish_items`
  MODIFY `fish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
