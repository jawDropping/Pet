-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 02:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petsociety`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`id`, `admin_name`, `admin_password`, `admin_email`) VALUES
(1, 'admin', 'admin', 'anonymous430@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `comment_tbl`
--

CREATE TABLE `comment_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_tbl`
--

INSERT INTO `comment_tbl` (`id`, `user_id`, `pet_id`, `likes`, `comment`) VALUES
(1, 1, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 2, 1, 2, 'Kabati anang iro-a oy');

-- --------------------------------------------------------

--
-- Table structure for table `daysweek`
--

CREATE TABLE `daysweek` (
  `id` int(11) NOT NULL,
  `days` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daysweek`
--

INSERT INTO `daysweek` (`id`, `days`) VALUES
(1, 'monday'),
(2, 'tuesday'),
(3, 'wednesday'),
(4, 'thursday'),
(5, 'friday'),
(6, 'satuday'),
(7, 'sunday');

-- --------------------------------------------------------

--
-- Table structure for table `delivered_items`
--

CREATE TABLE `delivered_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `items` varchar(100) NOT NULL,
  `user_username` varchar(70) NOT NULL,
  `date_delivered` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivered_items`
--

INSERT INTO `delivered_items` (`id`, `order_id`, `items`, `user_username`, `date_delivered`) VALUES
(8, 2, 'Special Dog Execellence(x1), Pedigree(x4)', 'Ian John Ticod', '2022-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_tbl`
--

CREATE TABLE `delivery_tbl` (
  `delivery_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `items` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `delivery_date` date NOT NULL,
  `date_delivered` date NOT NULL DEFAULT current_timestamp(),
  `delivery_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_tbl`
--

INSERT INTO `delivery_tbl` (`delivery_id`, `order_id`, `items`, `total_amount`, `user_username`, `delivery_date`, `date_delivered`, `delivery_status`) VALUES
(35, 1, 'Pro Plan Adult 7+ Sport Performance 30/17 Chicken & Rice Senior Dog Food(x1), Pedigree(x1)', '300', 'Ian John Ticod', '2022-04-19', '2022-04-22', 'FOR DELIVERY!');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `transaction_number` varchar(50) NOT NULL,
  `org_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `suffix` varchar(50) NOT NULL,
  `proof_photo` varchar(500) NOT NULL,
  `donation_status` varchar(50) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `transaction_number`, `org_id`, `first_name`, `last_name`, `contact_number`, `suffix`, `proof_photo`, `donation_status`, `email_address`, `coupon_code`, `amount`) VALUES
(2, '12312312', 1, 'Ian John', 'Ticod', '12312312', 'N/A', '2Z.png', 'CONFIRMED', 'ianjohn0505@gmail.com', 'gqDjVPRl', '500'),
(3, '188009923', 1, 'Ian John', 'Ticod', '099926956792', 'N/A', '2A.png', 'FOR CONFIRMATION', 'ianjohn0505@gmail.com', 'N/A', '100');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

CREATE TABLE `feedback_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_tbl`
--

INSERT INTO `feedback_tbl` (`id`, `user_id`, `service_id`, `comment`) VALUES
(1, 1, 1, 'WAY AYO NGA SERVICE!');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_tbl`
--

CREATE TABLE `ledger_tbl` (
  `id` int(11) NOT NULL,
  `transaction_number` varchar(50) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `date_confirmed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_tbl`
--

INSERT INTO `ledger_tbl` (`id`, `transaction_number`, `org_name`, `first_name`, `last_name`, `contact_number`, `date_confirmed`) VALUES
(3, '12312312', 'judame', 'Ian', 'Ticod', '12312312', '2022-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `orders_tbl`
--

CREATE TABLE `orders_tbl` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `delivery_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `org_location` varchar(50) NOT NULL,
  `org_contact_number` varchar(50) NOT NULL,
  `org_email_address` varchar(50) NOT NULL,
  `org_photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `org_name`, `org_location`, `org_contact_number`, `org_email_address`, `org_photo`) VALUES
(1, 'judame', 'looc', '123123123', 'judame@gmail.com', '1.7.png'),
(6, 'Ivy Joe Org', 'Lapu-lapu City', '09225672509', 'ivyjoe@gmail.com', '870.jpg'),
(7, 'wildrift org', 'opao mandaue city', '09876782312', 'mobilelegends@gmail.com', 'FB_IMG_1610796764162.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_age` varchar(50) NOT NULL,
  `pet_breed` varchar(50) NOT NULL,
  `pet_gender` varchar(50) NOT NULL,
  `pet_details` varchar(500) NOT NULL,
  `pet_photo` varchar(500) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `user_id`, `pet_name`, `pet_age`, `pet_breed`, `pet_gender`, `pet_details`, `pet_photo`, `likes`) VALUES
(1, 1, 'chuchu', '5 yrs old', 'sad', 'M', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'dogo.jpg', 19),
(2, 2, 'iringski', '4 months', 'ambot', 'F', 'Iring ni galagar', 'petnigalagar.jpg', 2),
(4, 1, 'Roger', '12', 'Aswang', 'Bayot', 'fjhdkjsfha', 'gabriel-gurrola-u6BPMXgURuI-unsplash.jpg', 0),
(5, 1, 'Roger', '12', 'Aswang', 'Bayot', 'fjhdkjsfha', 'gabriel-gurrola-u6BPMXgURuI-unsplash.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pet_center_tbl`
--

CREATE TABLE `pet_center_tbl` (
  `pet_center_id` int(11) NOT NULL,
  `pet_center_name` varchar(50) NOT NULL,
  `pet_center_password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `pet_center_photo` varchar(500) NOT NULL,
  `active_coupon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_center_tbl`
--

INSERT INTO `pet_center_tbl` (`pet_center_id`, `pet_center_name`, `pet_center_password`, `email`, `contact_number`, `location`, `pet_center_photo`, `active_coupon`) VALUES
(4, 'judame', '123123', 'judame@gmail.com', '123123', 'Pusok Cemento Chapel, 2674 Pusok Rd, Lapu-Lapu City, Cebu', 'userIcon.svg', 'yes'),
(5, 'Carlos Joshua Igpit', 'SADAS', 'carlosjoshua.official@gmail.com', '21321', '', 'userIcon.svg', 'yes'),
(6, 'Carlos Joshua Igpit', 'SADAS', 'carlosjoshua.official@gmail.com', '21321', '', 'userIcon.svg', 'yes'),
(7, 'Carlos Joshua Igpit', 'SADAS', 'carlosjoshua.official@gmail.com', '21321', '', 'userIcon.svg', 'yes'),
(10, 'Pet Association', 'asd', 'carlosjoshua.official@gmail.com', '21321', '', 'userIcon.svg', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `pet_prod`
--

CREATE TABLE `pet_prod` (
  `prod_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_prod`
--

INSERT INTO `pet_prod` (`prod_id`, `cat_name`) VALUES
(1, 'Dog Food'),
(2, 'Cat Food'),
(3, 'Bird Food'),
(4, 'Fish Food'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `posts_like`
--

CREATE TABLE `posts_like` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts_like`
--

INSERT INTO `posts_like` (`id`, `pet_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 1),
(4, 1, 2),
(5, 2, 2),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 1, 1),
(15, 1, 1),
(16, 1, 1),
(17, 1, 1),
(18, 1, 1),
(19, 1, 1),
(20, 1, 1),
(21, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pro_brand` int(50) NOT NULL,
  `pro_img` varchar(500) NOT NULL,
  `pro_img2` varchar(500) NOT NULL,
  `pro_img3` varchar(500) NOT NULL,
  `pro_img4` varchar(500) NOT NULL,
  `pro_price` varchar(500) NOT NULL,
  `pro_quantity` int(11) NOT NULL,
  `pro_keyword` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`pro_id`, `pro_name`, `cat_id`, `pro_brand`, `pro_img`, `pro_img2`, `pro_img3`, `pro_img4`, `pro_price`, `pro_quantity`, `pro_keyword`) VALUES
(1, 'Special Dog Execellence', 1, 0, 'special dog excellence.jpg', 'special dog excellence.jpg', 'special dog excellence.jpg', 'special dog excellence.jpg', '50', 100, 'asdsadsadasd'),
(2, 'Pedigree', 1, 0, 'dog_dry_food_3.jpg', 'dog_dry_food_3.jpg', 'dog_dry_food_3.jpg', 'dog_dry_food_3.jpg', '230', 134, 'peds'),
(3, 'Pro Plan Adult 7+ Sport Performance 30/17 Chicken & Rice Senior Dog Food', 1, 0, 'pro-plan-dog-sport-chicken-rice.png', 'pro-plan-dog-sport-chicken-rice.png', 'pro-plan-dog-sport-chicken-rice.png', 'pro-plan-dog-sport-chicken-rice.png', '70', 50, 'Adult '),
(4, 'Meow Mix Dry Cat Food, 55.5 fl oz, 3.47 lb', 2, 0, 'spin_prod_1194881812.jpg', 'spin_prod_1194881812.jpg', 'spin_prod_1194881812.jpg', 'spin_prod_1194881812.jpg', '75', 200, 'Dry Food'),
(5, 'Friskies 7 Dry Cat Food, 16 lb. Bag', 2, 0, 'dc838b69-aecd-4460-997d-de56c4f3d9e6_1.a7861a702c320b77335127eafe00f5f3.jpeg', 'dc838b69-aecd-4460-997d-de56c4f3d9e6_1.a7861a702c320b77335127eafe00f5f3.jpeg', 'dc838b69-aecd-4460-997d-de56c4f3d9e6_1.a7861a702c320b77335127eafe00f5f3.jpeg', 'dc838b69-aecd-4460-997d-de56c4f3d9e6_1.a7861a702c320b77335127eafe00f5f3.jpeg', '35', 50, 'Dry Cat Food'),
(6, 'Purina Kit and Caboodle Cat Food (13 lbs)', 2, 0, 'spin_prod_1195964912 (1).jpg', 'spin_prod_1195964912 (1).jpg', 'spin_prod_1195964912 (1).jpg', 'spin_prod_1195964912 (1).jpg', '80', 200, 'Cat Food ');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_services`
--

CREATE TABLE `reserve_services` (
  `reserve_id` int(11) NOT NULL,
  `pet_center_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_cost` int(11) NOT NULL,
  `reserve_date` date NOT NULL,
  `reserve_time` time NOT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `transaction_code` varchar(50) NOT NULL,
  `service_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserve_services`
--

INSERT INTO `reserve_services` (`reserve_id`, `pet_center_id`, `service_id`, `user_id`, `service_cost`, `reserve_date`, `reserve_time`, `coupon_code`, `transaction_code`, `service_status`) VALUES
(5, 4, 1, 1, 35, '2022-04-15', '20:21:00', '', 'rqzHnNk9', 'For Confirmation'),
(6, 4, 1, 1, 35, '2022-04-13', '08:50:51', 'Ets6124', 'adadasdsad', 'CONFIRMED'),
(7, 4, 1, 1, 35, '2022-04-13', '08:45:00', '', '4mshLToO', 'CONFIRMED'),
(8, 4, 1, 1, 35, '2022-04-05', '20:47:00', '', '0ND2TiCm', 'CONFIRMED'),
(9, 4, 1, 1, 35, '2022-04-12', '08:49:00', 'asdsadasdas', 'YeUytyrZ', 'For Confirmation'),
(10, 4, 1, 1, 35, '2022-04-20', '08:02:00', 'DSADsds', '1oaflHCe', 'CONFIRMED'),
(11, 4, 1, 1, 35, '2022-04-13', '12:07:00', '', 'gee8KMcZ', 'For Confirmation'),
(12, 4, 1, 1, 35, '2022-04-13', '12:07:00', '', '7utj2N1W', 'For Confirmation'),
(13, 4, 1, 1, 0, '2022-04-12', '21:27:00', '', 'fPt2kUmX', 'For Confirmation'),
(14, 4, 1, 1, 35, '2022-04-19', '12:27:00', '', 'RsmJ2MNt', 'For Confirmation'),
(15, 4, 1, 1, 35, '2022-04-05', '00:56:00', '', 'QobvTvoR', 'For Confirmation'),
(16, 4, 1, 1, 35, '2022-04-15', '11:01:00', '', 'hz5fQK1C', 'CONFIRMED'),
(17, 4, 1, 1, 35, '2022-05-03', '00:57:00', '', 'bUHZ8Ll8', 'For Confirmation');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `pet_center_id` int(11) NOT NULL,
  `services_name` varchar(255) NOT NULL,
  `services_loc` varchar(255) NOT NULL,
  `services_email` varchar(255) NOT NULL,
  `services_contact_number` varchar(50) NOT NULL,
  `day_open` varchar(50) NOT NULL,
  `day_close` varchar(50) NOT NULL,
  `time_open` time NOT NULL,
  `time_close` time NOT NULL,
  `service_cost` varchar(50) NOT NULL,
  `service_photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_id`, `pet_center_id`, `services_name`, `services_loc`, `services_email`, `services_contact_number`, `day_open`, `day_close`, `time_open`, `time_close`, `service_cost`, `service_photo`) VALUES
(1, 1, 4, 'Prettier Pet', 'looc', 'judame@gmail.com', '123123', '1', '5', '08:00:00', '16:00:00', '35', '2U.png'),
(2, 3, 4, 'Amazing Pets', '63 Zone Ube Pakna-an Mandaue City', 'ianjohn0101@gmail.com', '092266662123', '1', '5', '08:00:00', '16:00:00', '75', 'JINKY C. BORRICANO.jpg'),
(3, 2, 4, 'Born to be wild', 'Mandaue City', 'btbw@gmail.com', '09926056792', '1', '5', '08:00:00', '16:00:00', '80', '1.png');

-- --------------------------------------------------------

--
-- Table structure for table `service_cat`
--

CREATE TABLE `service_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_cat`
--

INSERT INTO `service_cat` (`cat_id`, `cat_name`) VALUES
(1, 'Pet Grooming'),
(2, 'Pet Hotel'),
(3, 'Pet Training');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contactnumber` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_profilephoto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `user_username`, `user_email`, `user_contactnumber`, `user_password`, `municipality`, `barangay`, `user_address`, `user_profilephoto`) VALUES
(1, 'Ian John Ticod', 'ianjohn0505@gmail.com', '09995967301', '123', 'mandaue', 'pakna-an', 'zone ube pakna-an mandaue city', '2Y.png'),
(2, 'meme', 'mememe@gmail.com', '123123123', '123', 'mandaue', 'pakna-an', 'zone ube pakna-an mandaue city', '852.jpg'),
(3, 'eyen', 'ianjohn0606@gmail.com', '123123', '123123', 'mandaue', 'pakna-an', 'jaime st', 'userIcon.svg'),
(4, 'Bongbong Marcos', 'carlosjoshua.official@gmail.com', '09087156583', 'asd', 'mandaue', 'Mango', 'Maxilom Ave.', 'LOGO.png'),
(5, 'carlosjoshua.official@gmail.com', 'Carlos Joshua Igpit', 'carlosjoshua.official@gmail.com', '123', 'Consolacion', 'Pitogo', 'Cebu North road', 'userIcon.svg'),
(6, 'Syra Mae Arroyo Dumaguing', 'chiara_sy@gmail.com', '09455062225', '1H@ppiness,..', 'Cebu City', 'Mango', 'Gen Maxilon Ave.', 'userIcon.svg'),
(7, 'ianjohn', 'carlosjoshua.official@gmail.com', '08098098', 'asd', 'asdsad', 'asdasd', 'asdasd', 'userIcon.svg'),
(8, 'ianjohn', 'carlosjoshua.official@gmail.com', '08098098', 'asd', 'asdsad', 'asdasd', 'asdasd', 'userIcon.svg'),
(9, 'ianjohn', 'carlosjoshua.official@gmail.com', '08098098', 'asd', 'asdsad', 'asdasd', 'asdasd', 'userIcon.svg'),
(10, 'ianjohn', 'carlosjoshua.official@gmail.com', 'carlosjoshua.official@gmail.com', 'asdsa', 'asdsa', 'asdas', 'asdas', 'userIcon.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_tbl`
--
ALTER TABLE `comment_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daysweek`
--
ALTER TABLE `daysweek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivered_items`
--
ALTER TABLE `delivered_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_tbl`
--
ALTER TABLE `delivery_tbl`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_tbl`
--
ALTER TABLE `ledger_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_center_tbl`
--
ALTER TABLE `pet_center_tbl`
  ADD PRIMARY KEY (`pet_center_id`);

--
-- Indexes for table `pet_prod`
--
ALTER TABLE `pet_prod`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `posts_like`
--
ALTER TABLE `posts_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `reserve_services`
--
ALTER TABLE `reserve_services`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_cat`
--
ALTER TABLE `service_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintbl`
--
ALTER TABLE `admintbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment_tbl`
--
ALTER TABLE `comment_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `daysweek`
--
ALTER TABLE `daysweek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivered_items`
--
ALTER TABLE `delivered_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `delivery_tbl`
--
ALTER TABLE `delivery_tbl`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ledger_tbl`
--
ALTER TABLE `ledger_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pet_center_tbl`
--
ALTER TABLE `pet_center_tbl`
  MODIFY `pet_center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pet_prod`
--
ALTER TABLE `pet_prod`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts_like`
--
ALTER TABLE `posts_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reserve_services`
--
ALTER TABLE `reserve_services`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_cat`
--
ALTER TABLE `service_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
