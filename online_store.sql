-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2017 at 10:00 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `ip_add` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `pro_id`, `qty`, `ip_add`) VALUES
(14, 19, 4, '::1'),
(15, 20, 4, '::1'),
(16, 36, 1, '::1'),
(17, 17, 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `main_cat`
--

CREATE TABLE `main_cat` (
  `cat_id` int(10) NOT NULL,
  `cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_cat`
--

INSERT INTO `main_cat` (`cat_id`, `cat_name`) VALUES
(1, 'Electronics'),
(9, 'Utensils'),
(11, 'Vehicles'),
(15, 'Furniture'),
(16, 'Showpiece'),
(17, 'Fragrance'),
(18, 'Beauty'),
(19, 'Footwear'),
(20, 'Toys'),
(22, 'Babies');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(10) NOT NULL,
  `pro_name` text NOT NULL,
  `cat_id` int(10) NOT NULL,
  `sub_cat_id` int(10) NOT NULL,
  `pro_img1` text NOT NULL,
  `pro_img2` text NOT NULL,
  `pro_img3` text NOT NULL,
  `pro_img4` text NOT NULL,
  `pro_feature1` text NOT NULL,
  `pro_feature2` text NOT NULL,
  `pro_feature3` text NOT NULL,
  `pro_feature4` text NOT NULL,
  `pro_feature5` text NOT NULL,
  `pro_price` text NOT NULL,
  `pro_model` text NOT NULL,
  `pro_warranty` text NOT NULL,
  `pro_keyword` text NOT NULL,
  `pro_added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `for_whom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `cat_id`, `sub_cat_id`, `pro_img1`, `pro_img2`, `pro_img3`, `pro_img4`, `pro_feature1`, `pro_feature2`, `pro_feature3`, `pro_feature4`, `pro_feature5`, `pro_price`, `pro_model`, `pro_warranty`, `pro_keyword`, `pro_added_date`, `for_whom`) VALUES
(17, 'Suzuki Mehran ', 11, 11, 'Suzuki_Mehran_2012.jpg', 'mehran.jpg', 'MehranColorWhiteb.jpg', 'MehranDesignConcept3.jpg', 'Air Conditioner', 'CD Player', 'Defogger (Rear)', 'Remote Boot/Fuel-Lid', 'Tachometer', '732000', '2017', '1 year', 'Suzuki,Mehran', '2017-05-08 06:22:25', ''),
(19, 'HP Laptops', 1, 1, 'hp.jpg', 'laptop_PNG5912.png', 'hp1.jpg', 'laptop_PNG5924.png', 'Processor: Intel Core i5-7200U', 'RAM: 8GB', 'Inbuilt HDD: 1TB', 'OS: Windows 10 Home', '3.0 usb support', '70000', 'HP 15-AU620TX (Z4Q39PA)', '3 Years', 'Hp,laptops', '2017-05-08 06:22:34', ''),
(20, 'Dell inspiron', 1, 1, 'Dell 1.png', 'Dell 2.png', 'Dell 3.png', 'Dell.jpg', 'Processors: Intel Core i5-4210U', 'Memory: 8 GB ', 'Graphics Processor: Intel HD Graphics 4400.', 'LCD Display: 15.6-inch LED Backlit Display, 1366*768 pixels.', 'Hard Drive: SATA 1000 GB (5400 RPM), SATA 1 TB (5400 RPM)', '27000', 'Inspiron 15 (5547)', '3 Years', 'Dell,Inspiron,Laptops', '2017-05-08 06:23:04', ''),
(21, 'Suzuki Cultus 2017', 11, 11, 'cultus 2.png', 'cultus 3.jpg', 'cultus 5.jpeg', 'cultus.png', 'Air Conditioner', 'Power Windows', 'Power Steering', 'Cup Holders', 'Folding Rear Seats', '1034000', '2017', '--', 'Suzuki Cultus,Suzuki', '2017-05-08 06:23:17', ''),
(23, 'Toyota Corolla ', 11, 11, 'Corolla1.jpg', 'corolla 4.jpg', 'corolla 1.jpg', 'corolla 3.jpg', 'Pre-collision system with pedestrian detection function', 'Dynamic radar cruise control', 'Lane Departure Alerts ', 'Automatic High Beams', 'Steering assist function', '16.6 lacs', '2017', '--', 'Toyota,corolla', '2017-04-30 09:46:06', ''),
(24, 'Lumina Plates', 14, 14, 'Lumina 1.jpg', 'Lumina 2.jpg', 'Lumina 3.jpg', 'Lumina 4.jpg', 'Dimensions 305(Ã˜)mm/ 12"', 'Material Fine China', 'Colour: White', 'Oven, microwave and freezer safe', 'Superior strength and durability of vitrified tableware with the elegance of fine bone china', '3000', '--', '--', 'Lumina,Glass', '2017-05-04 07:34:10', ''),
(25, 'Byzantine Necklace', 7, 7, 'necklace 1.jpg', 'necklace 2.jpg', 'necklace 3.jpg', 'necklace 4.jpg', 'Metal	18k Yellow Gold', 'Clasp	Lobster claw clasp', 'Chain lengthïš	18.0 inches', 'Width	         5/16 inch', 'Approximate weight	21.0 - 24.5 grams', '200000', '--', '--', 'Jewellery,necklace', '2017-05-04 12:58:06', 'women'),
(26, 'ADVIVUM BERKELEY DRESSING TABLE', 15, 10, 'dressing table.jpg', 'dressing table 1.jpg', 'dressing table 2.jpg', 'dressing table 3.jpg', 'MATERIAL :Solid wood and sycamore veneer. High gloss ', 'Width :138cm x depth 76cm x height 78cm', 'Height of top left & right & middle drawers', '9 cm Height of Bottom right and left drawers ', '13.3 cm Height of table without legs 24.9 cm', '50000', '--', '--', 'Furniture,dressing table', '2017-05-08 06:23:33', ''),
(27, 'Leather Multi-Pocket Bifold Wallet', 16, 16, 'leather-hybrid-bifold-wallet-241.jpg', 'multi-pocket-bi-fold-wallet-202.jpg', 'multi-pocket-bi-fold-wallet-122.jpg', 'multi-pocket-bi-fold-wallet-122.jpg', 'full-size billfold area', '4 extra-wide credit card pockets', '1 extra-wide clear ID/credit card pocket', '2 oversized hidden storage pocket', '4 1/2" wide x 3 3/8" tall (11.4 cm x 8.5 cm)', '2700', '--', '--', 'wallet,men', '2017-05-08 06:23:40', 'men'),
(30, 'Dial colour-Black ,Case shape-Round,watch', 16, 16, 'matrix1.jpg', 'matrix2.jpg', 'matrix3.jpg', 'matrix 4.jpg', 'Dial colour-Black ,Case shape-Round', 'Band colour-Brown,Band Material-leather', 'Watch movement-Quartz, watch display type-Analog', 'Product might slightly vary from the image', 'all images are taken under standard lighting', '1550', '--', '--', 'Watch,matrix', '2017-05-08 06:23:45', 'men'),
(31, 'Paco Rabanne Lady Million,perfume for Shamsa', 17, 17, 'perfume1.png', 'perfume 2.png', 'perfume 3.jpg', 'perfume 4.jpg', 'Bitter orange, Fleshy raspberry', 'Neroli, Orange flower, Arabian Jasmine', 'Honey, Vibrant patchouli', '--', '--', '1500', '--', '--', 'Perfumes,women', '2017-05-05 10:41:51', 'women'),
(32, 'Revlon Super Lipstick For Shamsa', 18, 18, 'lipstick1.jpg', 'lipstick 2.jpg', 'lipstick 3.jpg', 'lipstick 4.jpeg', 'A seductive fragrance blend of ripe fruit and roses', 'Inspired by ancient love potions of  Egyptian Queen Cleopatra', 'Exclusive package', 'Luxurious color ', 'moisturizing feel', '2000', '--', '--', 'Lipstick,revlon', '2017-05-08 06:23:52', 'women'),
(33, 'Womens Joizi Peep Toe Pump Shoes For Shamsa', 19, 19, 'shoes1.jpg', 'shoes2.jpg', 'shoes3.jpg', 'shoes4.jpg', 'Pump style with a peep toe', 'Cutout detail', 'Lace tie at ankle', 'Smooth lining, cushioning insole', 'Synthetic outsole, 3 inch heel', '1700', '--', '--', 'Shoes,women', '2017-05-08 06:24:00', 'women'),
(34, 'Premsons Battery Operated Train toys Set', 20, 20, 'train1.jpg', 'train2.jpg', 'train3.jpg', 'train4.jpg', '13 Piece Train set with Engine', 'Engine has a Head light which gives kids a real engine appeal', 'Perimeter of track is around 210 cm ', 'Requires 2 AA batteries (not included)', ' Diameter is 67.5 cm', '2000', '--', '--', 'Train,Toys', '2017-05-08 06:24:07', 'kids'),
(35, 'Mothercare Darlington Cot - Antique,baby cott', 22, 22, 'cott1.jpg', 'cott2.jpg', 'cott3.jpg', 'cott4.jpg', 'Fixed Sides', 'Three mattress base heights', 'Suitable from birth to 2 years', 'Requires a 120x60cm cot mattress (sold separately)', 'Cot Dimensions: D66.2xW124xH97cm', '8000', '--', 'Free 6 months guarantee', 'Cott,Babies', '2017-05-08 06:24:11', 'kids'),
(36, 'Acer TravelMate P449', 1, 9, 'acer.jpg', 'acer2.jpg', 'acer3.jpg', 'acer4.jpg', 'Processor: Intel Core i5-6200U', 'RAM: 8GB', 'Inbuilt HDD: 500GB', 'OS: Windows 10 Pro', 'Built in CD Rom', '88000', '--', '--', 'Acer laptops,laptops', '2017-05-09 05:51:06', 'men');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_cat_id` int(10) NOT NULL,
  `sub_cat_name` varchar(100) NOT NULL,
  `cat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_cat_id`, `sub_cat_name`, `cat_id`) VALUES
(3, 'Dish Washer', 9),
(6, 'Dressing Table', 10),
(11, 'Car', 1),
(12, 'Honda Civic', 11),
(13, 'Plates', 14),
(14, 'Wallet', 16),
(15, 'Watches', 16),
(16, 'Perfumes', 17),
(17, 'Lipsticks', 18),
(18, 'Shoes', 19),
(19, 'Toy Train', 20),
(20, 'Baby Cott', 22);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_name` text NOT NULL,
  `u_email` text NOT NULL,
  `u_pass` text NOT NULL,
  `u_add` text NOT NULL,
  `u_pin` text NOT NULL,
  `u_dob` text NOT NULL,
  `u_phone` text NOT NULL,
  `u_img` text NOT NULL,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `u_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `main_cat`
--
ALTER TABLE `main_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `main_cat`
--
ALTER TABLE `main_cat`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
