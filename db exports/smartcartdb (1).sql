-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2021 at 06:04 PM
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
-- Database: `smartcartdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Tapal'),
(2, 'Dollar'),
(3, 'Thomas');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `battery_percentage` float DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL,
  `weight` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `battery_percentage`, `status`, `weight`) VALUES
(1, 100, 'Active', 0.7),
(2, 100, 'Idle', 0),
(3, 100, 'Idle', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`id`, `cart_id`, `product_id`) VALUES
(78, 1, 7),
(82, 1, 4),
(85, 1, 1);

--
-- Triggers `cart_product`
--
DELIMITER $$
CREATE TRIGGER `tr_cart_product_afterDelete` AFTER DELETE ON `cart_product` FOR EACH ROW BEGIN
declare product_weight float;
declare old_cart_weight float;
declare new_cart_weight float;
set old_cart_weight = (SELECT `weight` from cart where id = OLD.cart_id);
set product_weight = (SELECT `weight` from product where id = OLD.product_id);
set new_cart_weight = old_cart_weight - product_weight;
update cart set `weight` = new_cart_weight where id = OLD.cart_id;
if ((select count(cart_id) as items_in_cart
from cart_product
where cart_id = OLD.`cart_id` ) = 0)
then
update cart set `status` = 'Idle' where id = OLD.cart_id;
end if;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_cart_product_afterInsert` AFTER INSERT ON `cart_product` FOR EACH ROW BEGIN

declare product_weight float;
declare old_cart_weight float;
declare new_cart_weight float;

set old_cart_weight = (SELECT `weight` from cart where id = NEW.`cart_id`);
set product_weight = (SELECT `weight` from product where id = NEW.`product_id`);
set new_cart_weight = old_cart_weight + product_weight;

update cart set `weight` = new_cart_weight where id = NEW.`cart_id`;

if (select `status` from cart where id = NEW.`cart_id`) = 'Idle'
then
update cart set `status` = 'Active' where id = NEW.`cart_id`;
end if;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Groceries'),
(2, 'Stationery'),
(3, 'Pet');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `discount_percentage` float DEFAULT NULL,
  `from` varchar(32) DEFAULT NULL,
  `to` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `product_id`, `discount_percentage`, `from`, `to`) VALUES
(1, 7, 0.35, NULL, NULL),
(2, 4, 0.2, NULL, NULL),
(3, 1, 0.2, '29-07-2021', '30-07-2021');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `barcode` varchar(12) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `times_sold` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `barcode`, `price`, `weight`, `brand_id`, `category_id`, `times_sold`) VALUES
(1, 'Family Mixture', '121212121212', 10.99, 0.5, 1, 1, NULL),
(3, 'Danedar', '121212121213', 10.99, 0.5, 1, 1, NULL),
(4, 'Black Pointer', '102030405060', 15, 0.1, 2, 2, NULL),
(6, 'Blue Pointer', '102030405061', 15, 0.1, 2, 2, NULL),
(7, 'Danedar 100g', '102030405062', 105, 0.1, 1, 1, NULL),
(9, 'Cat Litter', '102030405065', 1200, 8, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `payment_methood` varchar(32) DEFAULT NULL,
  `money` float DEFAULT NULL,
  `bill_datetime` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`product_id`, `quantity`) VALUES
(6, 22),
(7, 2),
(9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `role` varchar(16) DEFAULT NULL,
  `salary` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `salary`) VALUES
(1, 'Mahad', 'mahad@gmail.com', '123123', 'cashier', NULL),
(2, 'Muhammad Ali Khan', 'admin@scs.com', 'zroorihai?', 'superadmin', NULL),
(3, 'amaaz', 'amaaz@gmail.com', '123', NULL, NULL),
(4, 'amaaz', 'amaaz@gmail.com', '123', NULL, NULL),
(5, 'Amaaz', 'amaz@gmail.com', '1111', 'cashier', NULL);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `tr_user_beforeInsert` BEFORE INSERT ON `user` FOR EACH ROW BEGIN

if 
NEW.role = 'superadmin' then set NEW.role = NULL;
end if;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_user_beforeUpdate` BEFORE UPDATE ON `user` FOR EACH ROW BEGIN

if 
NEW.role = 'superadmin' then set NEW.role = OLD.role;
end if;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_product_details`
-- (See below for the actual view)
--
CREATE TABLE `vw_product_details` (
`id` int(11)
,`product_name` varchar(256)
,`brand_name` varchar(64)
,`category_name` varchar(64)
,`quantity` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_product_details`
--
DROP TABLE IF EXISTS `vw_product_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_product_details`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `product_name`, `b`.`name` AS `brand_name`, `c`.`name` AS `category_name`, `s`.`quantity` AS `quantity` FROM (((`product` `p` join `brand` `b` on(`p`.`brand_id` = `b`.`id`)) join `category` `c` on(`c`.`id` = `p`.`category_id`)) left join `stock` `s` on(`p`.`id` = `s`.`product_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD UNIQUE KEY `barcode_2` (`barcode`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
