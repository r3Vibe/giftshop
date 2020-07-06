-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2020 at 09:17 PM
-- Server version: 10.3.20-MariaDB-1
-- PHP Version: 7.3.15-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giftshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `variations` varchar(255) NOT NULL,
  `prange` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `number`, `variations`, `prange`, `image`, `link`) VALUES
(1, 'sanitizer', '2', 'type,size', '30-50', '../images/category/sanitizer.jpg', '../shop/sanitizer.php'),
(2, 'mask', '2', 'type,size', '30-50', '../images/category/mask.jpg', '../shop/mask.php');

-- --------------------------------------------------------

--
-- Table structure for table `orderlistt`
--

CREATE TABLE `orderlistt` (
  `order_id` varchar(255) NOT NULL,
  `id` int(100) NOT NULL,
  `product` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlistt`
--

INSERT INTO `orderlistt` (`order_id`, `id`, `product`, `product_id`, `price`, `quantity`, `subtotal`, `customer`, `contact`, `email`, `address`, `status`, `date`) VALUES
('rd-01', 1, 'vivid one', 'rd-vivid-mask-01', '150', '2', '300', 'arnab gupta', '555', 'test2@mail.com', 'barasat', 'delivered', '04-Jul-2020'),
('rd-01', 2, 'vivid one', 'rd-vivid-mask-01', '150', '2', '300', 'arnab gupta', '555', 'test2@mail.com', 'barasat', 'processing', '04-Jul-2020'),
('rd-03', 3, 'vivid one', 'rd-vivid-mask-01', '150', '2', '300', 'arnab gupta', '555', 'test2@mail.com', 'barasat', 'delivered', '04-Jul-2020');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `productid` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `productid`, `status`, `price`, `quantity`, `image`) VALUES
(1, 'vivid one', 'mask', 'rd-vivid-mask-01', 'active', 150, 10, '../images/products/iron.jpg'),
(2, 'vivid two', 'sanitizer', 'rd-vivid-sanitizer-01', 'active', 150, 10, '../images/products/iron.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `password`, `fname`, `contact`, `email`, `address`, `role`, `image`) VALUES
(5, 'dovahkiin', '$2y$10$flsSok2I1CxHgNYmn3gQ/.lCajxzpkBMr6dmQchaTNrHA4GGL5BRS', 'arnab gupta', '555', 'test@mail.com', 'barasat', 'admin', ''),
(6, 'dovahkiin2', '$2y$10$flsSok2I1CxHgNYmn3gQ/.lCajxzpkBMr6dmQchaTNrHA4GGL5BRS', 'arnab gupta', '555', 'test2@mail.com', 'barasat', 'customer', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlistt`
--
ALTER TABLE `orderlistt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderlistt`
--
ALTER TABLE `orderlistt`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
