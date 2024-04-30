-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 11:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowers_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `fname` varchar(437) DEFAULT NULL,
  `lname` varchar(439) DEFAULT NULL,
  `idnumber` varchar(273) DEFAULT NULL,
  `phone` varchar(186) DEFAULT NULL,
  `gender` varchar(365) DEFAULT NULL,
  `martialstatus` varchar(623) DEFAULT NULL,
  `DoB` varchar(312) DEFAULT NULL,
  `email` varchar(111) DEFAULT NULL,
  `password` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fname`, `lname`, `idnumber`, `phone`, `gender`, `martialstatus`, `DoB`, `email`, `password`) VALUES
(1, 'keza', 'Bibi', '199079876566', '07862426', 'Male', 'single', '20/12/2000', 'keza@gmail.com', 'kezaQgmail.com'),
(2, 'nini', 'nini', '199067878', '0786272', 'Female', 'maried', '20/02/2000', 'nini@gmail.com', 'nini'),
(3, 'keza', 'kiki', '1956566778', '0784354565', 'Female', 'married', '20/12/2000', 'keza@gmail.com', '222013825');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_id` int(10) NOT NULL,
  `Customername` varchar(75) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_id`, `Customername`, `Email`, `Address`, `Gender`) VALUES
(1, 'eliane ', 's@gmail.com', 'muhanga', 'male'),
(3, 'Mutoni', 'mutoini@gmail.com', 'Kigali', 'Female'),
(4, 'Vianney', 'vianney@gmail.com', 'Nyagatare', 'Male'),
(5, 'John', 'john@gmail.com', 'Kigali', 'Female'),
(6, 'keti', 'kiki@gmail.com', 'kayonza', 'male'),
(13, 'sahar', 'sahar@gmail.co', 'Kigali', 'Female'),
(14, 'John', 'john@gmail.com', 'Kigali', 'Male'),
(23, 'didi', 'ss@gmail.com', 'ngoma', 'male'),
(24, 'veri', 'juno@gmail.com', 'gasabo', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `flower`
--

CREATE TABLE `flower` (
  `Flower_id` int(10) NOT NULL,
  `Flower_type` varchar(20) DEFAULT NULL,
  `Unit_price` int(10) DEFAULT NULL,
  `Quantity` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flower`
--

INSERT INTO `flower` (`Flower_id`, `Flower_type`, `Unit_price`, `Quantity`) VALUES
(1, 'Rose', 10, '11'),
(2, 'Granium', 11, '30'),
(4, 'granium', 34, '55555'),
(6, 'sunflower', 6565, '456'),
(12, 'rose', 6778, '67768'),
(16, 'Lily', 333333, '1'),
(17, 'rose', 33, '1'),
(20, 'lily', 345678, '456');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `Manager_id` int(10) NOT NULL,
  `Manager_name` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Email` varchar(20) DEFAULT NULL,
  `Customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`Manager_id`, `Manager_name`, `username`, `Telephone`, `Email`, `Customer_id`) VALUES
(1, 'Toni', 'nina', '0780495290', 'Tomas@gmail.com', 1),
(2, 'cyucyu', 'hirwa', '0780495290', 'irwa@gmail.com', 3),
(3, 'Erineste Muhire', 'neste', '078049456', 'erineste@gmail.com', 5),
(4, 'Yvonne', 'vonne', '078675298', 'yvonne@gmail.com', 4),
(8, 'kiza', 'fggh', '5456', 'kiza@gmail.com', 3),
(12, 'titi', 'tini', '073857676', 'titi@gmail.com', NULL),
(13, 'keza', 'jiji', '078565676', 'keza@gmail.com', NULL),
(14, 'justin', 'ghg', '0786456', 'yf@gmail.com', 1),
(16, 'monike', 'moni', '07834567', 'eme@gmail.com', 3),
(17, 'lilo', 'yyy', '07823456789', 'lilof@gmail.com', 3),
(20, 'Bayizere', 'com', '078345678', 'hhh@gmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(11) NOT NULL,
  `Amaunt` float DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `PaymentMethod` varchar(77) DEFAULT NULL,
  `Customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_id`, `Amaunt`, `PaymentDate`, `PaymentMethod`, `Customer_id`) VALUES
(1, 56700000, '2023-10-02', 'bank', 1),
(2, 4567, '2024-04-24', 'bank', 3),
(4, 6497, '2023-11-12', 'bank', 4),
(5, 2000, '2023-06-02', 'cash', 5),
(6, 6565560, '2021-12-12', 'bank', 1),
(9, 3456, '2024-05-03', 'cash', 3);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `Stock_id` int(10) NOT NULL,
  `ProductName` varchar(20) DEFAULT NULL,
  `UnitPrice` int(222) DEFAULT NULL,
  `DateReceived` date DEFAULT NULL,
  `QuantityAvailable` varchar(20) DEFAULT NULL,
  `Flower_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`Stock_id`, `ProductName`, `UnitPrice`, `DateReceived`, `QuantityAvailable`, `Flower_id`) VALUES
(1, 'iris', 1, '2024-04-22', '1', 1),
(2, 'rose', 43567, '2024-05-03', '456', 4),
(5, 'Lavender', 9736, '2023-08-11', '62333', 2),
(6, 'granium', 546777, '2020-12-05', '565', 4),
(9, 'rose', 5665, '2024-04-06', '5456', 2),
(10, 'Lily', 7845, '2024-05-09', '1190', NULL),
(11, 'rose', 65657, '2024-04-10', '4556', 4),
(12, 'sunflower', 7656, '2024-04-04', '45675', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Supplier_id` int(10) NOT NULL,
  `SupplierName` varchar(40) DEFAULT NULL,
  `Telephone` varchar(31) DEFAULT NULL,
  `Email` varchar(456) DEFAULT NULL,
  `Address` varchar(250) NOT NULL,
  `Gender` varchar(25) NOT NULL,
  `Manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Supplier_id`, `SupplierName`, `Telephone`, `Email`, `Address`, `Gender`, `Manager_id`) VALUES
(1, 'kabera didas', '0734567890', 'yf@gmail.com', 'nyagatare', 'male', 1),
(3, 'Mimi', '0788880995', 'mimi@gmail.com', '', '', 3),
(4, 'Mource', '0727568903', 'ourice@gmail.com', 'nyanza', 'male', NULL),
(6, 'Julie', '0783564782', 'julie@gmail.com', '', '', NULL),
(7, 'mimi', '073667798', 'mimi@gmail.com', 'ngoma', 'male', 1),
(10, 'nepo', '07354667', 'nepo@gmail.com', '', '', NULL),
(11, 'Divine', '078665436', 'didi@gmail.com', 'huye', 'female', 1),
(13, 'mizero', '078345678', 'kiki@gmail.com', 'kicukiro', 'female', 1),
(14, 'tesi', '0784567', 'tesi@gamail.com', 'Kigali', 'female', 3),
(15, 'kikiyo', '078345678', 'kiyp@gamil.com', 'Kamonyi', 'male', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(4, 'Ingabire', 'Julliette', 'julliette', 'jullietteingabirei@gmail.com', '0780495290', '$2y$10$M7XgpZZvSmuBD3C1tmIqPO.HXRjnXM8jtf96hBU2gtq.unSiUofGa', '2024-04-25 12:29:56', '123', 0),
(19, 'titi', 'hhh', 'jullietteingabire@gamil.com', 'titi@gmail.com', '0784567', '$2y$10$jo5V/jpLrv3WEtiC4lEPte8Rjc081fpX1uEnYeqIEX.Cv.8Aci6JW', '2024-04-29 16:08:21', '123', 0),
(20, 'Julie', 'ingabire', 'com', 'jullietteingabire@gamil.com', '07823456', '$2y$10$udC2O3xBaQnHFcyd7t5mcepRwQw6mpnpvab6RQ.R7jUBJej8yHSOe', '2024-04-29 16:30:50', '45', 0),
(23, 'MIMI', 'MIMI', '@gamil.com', '222013825@gamil.com', '0780495290', '$2y$10$QgGzT8LegyV0iA511eqr7eUSxOANHaYCqd9v2CdBt9MWqC5sCNE8S', '2024-04-30 06:42:58', '45', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `flower`
--
ALTER TABLE `flower`
  ADD PRIMARY KEY (`Flower_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`Manager_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Stock_id`),
  ADD KEY `Flower_id` (`Flower_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Supplier_id`),
  ADD KEY `Manager_id` (`Manager_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `flower`
--
ALTER TABLE `flower`
  MODIFY `Flower_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `Manager_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `Stock_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Supplier_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`Customer_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`Customer_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`Flower_id`) REFERENCES `flower` (`Flower_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`Manager_id`) REFERENCES `manager` (`Manager_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
