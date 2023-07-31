-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 10:42 PM
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
-- Database: `health_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `title`, `category`, `content`, `doctor_id`) VALUES
(3, 'Technology', 'lskdlksjd', 'I am a DOctor and completing my journey', 1),
(4, 'Important Particle', 'Prostate', 'Take care of it', 1),
(5, 'Pagol', 'Mental Health', ' I am not well', 1),
(6, 'Health Drinks', 'Nutrition', 'Too much costly', 1),
(7, 'WEAK', 'Nutrition', ' Dont be weak and hazy as well ', 1),
(8, 'Sleep', 'Mental Health', ' SOund sleep is very necessary thing.', 2),
(9, 'Movie ', 'Mental Health', ' A good Movie like BAHUBALI is worthy to watch \r\n', 1),
(10, 'Mental Health', 'Mental Health', ' Mental health is often avoided', 3),
(11, 'Hair Growth', 'Nutrition', ' Onion juice is good for hair growth . Giving coconut milk or oil can also be beneficial. ', 3),
(12, 'Hair growth', 'Nutrition', ' Dont use too much of shampoo and conditionar', 2),
(13, 'Dark circle', 'Dermatology', ' Less sleeping and tension causes Dark circle ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `buying_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `sent_by` varchar(10) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `message_text`, `consumer_id`, `doctor_id`, `sent_by`, `timestamp`) VALUES
(1, 'hello', 1, 1, '', '2023-04-17 00:37:16'),
(2, 'i am toky', 1, 1, '', '2023-04-17 00:48:37'),
(3, 'What is your name ', 1, 1, '', '2023-04-17 00:52:43'),
(4, '', 1, 1, '', '2023-04-17 01:05:25'),
(5, '', 1, 1, '', '2023-04-17 01:06:16'),
(6, '', 1, 1, '', '2023-04-17 01:06:20'),
(7, 'hello\r\n', 1, 1, '', '2023-04-17 01:07:11'),
(8, 'I am scik', 1, 1, '', '2023-04-17 01:07:20'),
(9, 'I am Farida\r\n', 3, 1, '', '2023-04-17 01:35:07'),
(10, 'Yes Farida please say', 3, 1, '', '2023-04-17 01:50:37'),
(11, 'yes', 1, 1, '', '2023-04-17 01:51:10'),
(12, '.m,m', 1, 1, '', '2023-04-17 01:57:13'),
(13, 'Hello Kabir sir ', 1, 2, 'consumer', '2023-04-17 02:08:18'),
(14, 'Hello GOlam', 1, 2, 'doctor', '2023-04-17 02:08:31'),
(15, 'What do you want to know ?', 1, 2, 'doctor', '2023-04-17 02:12:16'),
(16, 'Sir I  am having a headache ', 1, 2, 'consumer', '2023-04-17 02:12:47'),
(17, 'Waht else do you want to know \r\n', 1, 2, 'doctor', '2023-04-17 02:24:30'),
(18, 'sir I am Farida ', 3, 2, 'consumer', '2023-04-17 02:46:22'),
(19, 'yes Farida ', 3, 2, 'doctor', '2023-04-17 02:47:46'),
(20, 'Please say something', 3, 2, 'doctor', '2023-04-17 03:07:45'),
(21, 'hello ', 1, 1, 'consumer', '2023-04-17 03:08:36'),
(22, 'Please say what happened ', 1, 1, 'doctor', '2023-04-17 23:20:50'),
(23, 'Please say what happened ', 1, 1, 'doctor', '2023-04-17 23:21:16'),
(24, 'Please say what happened ', 1, 1, 'doctor', '2023-04-17 23:22:08'),
(25, 'Please say what happened ', 1, 1, 'doctor', '2023-04-17 23:22:14'),
(26, 'Please say what happened ', 1, 1, 'doctor', '2023-04-17 23:23:08'),
(27, 'Please say what happened ', 1, 1, 'doctor', '2023-04-17 23:23:41'),
(28, 'Please say what happened ', 1, 1, 'doctor', '2023-04-17 23:24:42'),
(29, 'what happened to you toky', 1, 1, 'doctor', '2023-04-17 23:29:58'),
(30, 'Nothing I am just mentally disturbed. ', 1, 1, 'consumer', '2023-04-17 23:53:51'),
(31, 'Hello DR , My hair is falling very fast ', 4, 3, 'consumer', '2023-04-26 16:58:39'),
(32, 'From when It is happening ?', 4, 3, 'doctor', '2023-04-26 17:00:54'),
(33, 'Hello Kabir singh', 5, 2, 'consumer', '2023-05-01 12:06:45'),
(34, 'hello farah', 5, 2, 'doctor', '2023-05-01 12:08:06'),
(35, 'hello Khaleda aapa', 6, 3, 'consumer', '2023-05-01 23:59:38'),
(36, 'Hello Alia', 6, 3, 'doctor', '2023-05-02 00:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `id` int(11) NOT NULL,
  `against` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`id`, `against`, `description`, `image`) VALUES
(19, 'doctor', 'SSAFLKJASLKFJLKASD', '643ab01f76cc8'),
(20, 'doctor', 'dsfg', ''),
(21, '', '', ''),
(22, '', '', ''),
(23, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `consumer_user`
--

CREATE TABLE `consumer_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `picture` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumer_user`
--

INSERT INTO `consumer_user` (`id`, `username`, `email`, `password`, `contact`, `picture`) VALUES
(1, 'Golam', 'golam@123gmail.com', 'Qwerty123!', '+8801234567890', '1681627826'),
(2, 'Shahriar Toky', 'shahriar123@gmail.com', 'Qwerty123!', '+8801755813147', '1681384457'),
(3, 'Farida', 'farida1234@gmail.com', 'farida123!', '+8801234567890', '1681632470'),
(4, 'Jonogon', 'jonogon123@gmail.com', 'Jonogon123!', '+8801774090079', '1682506254'),
(5, 'Sufana Farah', 'farah123@gmail.com', 'Farah123!', '+8801774030079', '1682921115'),
(6, 'Alia', 'alia123@gmail.com', 'Alia123!', '+8801774030079', '1682963719');

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `deal_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `buying_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `shipping_address` text NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `shipping_status` varchar(30) NOT NULL,
  `received_status` varchar(5) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deal`
--

INSERT INTO `deal` (`deal_id`, `cart_id`, `product_id`, `product_name`, `buying_quantity`, `product_price`, `cost`, `consumer_id`, `seller_id`, `shipping_address`, `transaction_id`, `shipping_status`, `received_status`, `rating`) VALUES
(117, 82, 14, 'Television ', 1, 50000, 50000, 1, 5, 'sea', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 0),
(118, 83, 14, 'Television ', 2, 50000, 100000, 1, 5, 'sea', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 0),
(120, 84, 14, 'Television ', 1, 50000, 50000, 1, 5, 'skjbsansabas', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 0),
(121, 84, 14, 'Television ', 1, 50000, 50000, 1, 5, 'maaf', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 0),
(122, 85, 16, 'CRATCHER', 1, 500, 500, 1, 5, 'maaf', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 5),
(124, 84, 14, 'Television ', 1, 50000, 50000, 1, 5, 'maaf', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 0),
(125, 85, 16, 'CRATCHER', 1, 500, 500, 1, 5, 'maaf', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 5),
(126, 86, 17, 'Table ', 1, 1000, 1000, 1, 5, 'mirpur', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 0),
(127, 87, 15, 'Basin ', 1, 50000, 50000, 1, 5, 'kalasjh', 'CASH ON DELIVERY', 'SHIPPED', 'NO', 0),
(128, 88, 18, 'Phone case ', 2, 700, 1400, 4, 7, 'Merul Badda, Dhaka ', 'toookyy1', 'Unshipped', 'YES', 4),
(129, 90, 16, 'CRATCHER', 2, 500, 1000, 4, 5, 'Merul Badda, Dhaka ', 'toookyy2', 'Unshipped', 'NO', 0),
(130, 91, 17, 'Table ', 1, 1000, 1000, 2, 5, 'Tejgoan', 'CASH ON DELIVERY', 'Unshipped', 'NO', 0),
(131, 92, 19, 'Saline', 1, 200, 200, 1, 5, 'Uttara Dhaka', 'CASH ON DELIVERY', 'Unshipped', 'NO', 0),
(132, 94, 19, 'Saline', 2, 200, 400, 5, 5, 'Uttara Dhaka', 'CASH ON DELIVERY', 'Unshipped', 'NO', 5),
(134, 95, 16, 'CRATCHER', 1, 500, 500, 5, 5, 'mymensingh', 'abcdefghi', 'Unshipped', 'NO', 0),
(135, 96, 17, 'Table ', 2, 1000, 2000, 6, 5, 'AIUB , DHaka', 'demo1', 'Unshipped', 'NO', 3),
(136, 97, 20, 'Injection', 1, 100, 100, 6, 5, 'gulshan', 'CASH ON DELIVERY', 'Unshipped', 'NO', 0),
(137, 99, 14, 'Television ', 1, 50000, 50000, 6, 5, 'Jharkhondo', 'Hello1234', 'Unshipped', 'NO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_user`
--

CREATE TABLE `doctor_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `education` text NOT NULL,
  `expertise` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `picture` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_user`
--

INSERT INTO `doctor_user` (`id`, `username`, `email`, `password`, `education`, `expertise`, `contact`, `picture`) VALUES
(1, 'Sufana', 'alamgir@123gmail.com', 'Qwerty123!', 'BPHARM', 'Cardiologist', '+8801774030079', '1681628038'),
(2, 'Kabir', 'rahim123@gmail.com', 'Qwerty123!', 'BSC, MBBMS', 'Oncologist', '2147483647', '1681330431'),
(3, 'Begum Khaleda', 'khaleda1234@gmail.com', 'Khaleda123!', 'HSC ', 'Cardiologist', '+8801234567890', '1682504534');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notice` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user`, `user_id`, `notice`, `read_status`, `timestamp`) VALUES
(1, 'consumer', 1, '0', 1, '2023-04-17 23:24:42'),
(2, 'consumer', 1, 'Sufana has sent you a message .', 1, '2023-04-17 23:29:58'),
(3, 'doctor', 1, 'A patient has sent you a message .', 1, '2023-04-17 23:53:51'),
(4, 'provider', 5, 'Television  has been bought 1 pcs.', 1, '2023-04-18 00:57:49'),
(5, 'provider', 5, 'CRATCHER has been bought 1 pcs.', 1, '2023-04-18 00:57:49'),
(6, 'consumer', 1, 'Your Product CRATCHER has sent to maaf .', 1, '2023-04-18 01:09:51'),
(7, 'provider', 5, 'Table  has been bought 1 pcs.', 1, '2023-04-18 20:52:44'),
(8, 'provider', 5, 'Basin  has been bought 1 pcs.', 1, '2023-04-18 21:37:21'),
(9, 'provider', 7, 'Phone case  has been bought 2 pcs.', 1, '2023-04-26 16:57:10'),
(10, 'provider', 5, 'CRATCHER has been bought 2 pcs.', 1, '2023-04-26 16:57:10'),
(11, 'doctor', 3, 'A patient has sent you a message .', 1, '2023-04-26 16:58:39'),
(12, 'consumer', 4, 'Begum Khaleda has sent you a message .', 1, '2023-04-26 17:00:54'),
(13, 'provider', 5, 'Table  has been bought 1 pcs.', 1, '2023-04-26 23:27:31'),
(14, 'consumer', 1, 'Your Product Television has sent to maaf .', 1, '2023-04-27 02:25:05'),
(15, 'provider', 5, 'Saline has been bought 1 pcs.', 1, '2023-05-01 12:05:58'),
(16, 'provider', 5, 'Saline has been bought 2 pcs.', 1, '2023-05-01 12:05:58'),
(17, 'doctor', 2, 'A patient has sent you a message .', 1, '2023-05-01 12:06:45'),
(18, 'consumer', 5, 'Kabir has sent you a message .', 1, '2023-05-01 12:08:06'),
(19, 'consumer', 1, 'Your Product Table has sent to mirpur .', 1, '2023-05-01 12:25:25'),
(20, 'consumer', 1, 'Your Product Basin has sent to kalasjh .', 1, '2023-05-01 12:25:34'),
(21, 'provider', 5, 'CRATCHER has been bought 1 pcs.', 1, '2023-05-01 12:27:36'),
(22, 'provider', 5, 'Table  has been bought 2 pcs.', 1, '2023-05-01 23:57:25'),
(23, 'doctor', 3, 'A patient has sent you a message .', 1, '2023-05-01 23:59:38'),
(24, 'consumer', 6, 'Begum Khaleda has sent you a message .', 1, '2023-05-02 00:04:14'),
(25, 'provider', 5, 'Injection has been bought 1 pcs.', 1, '2023-05-02 00:14:58'),
(26, 'provider', 5, 'Television  has been bought 1 pcs.', 0, '2023-05-02 02:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `quantity`, `picture`, `seller_id`) VALUES
(14, 'Television ', 'A XIAOMI LED tv is 43 screen', 50000, 29, '1681626670', 5),
(15, 'Basin ', 'A squared Basin ', 50000, 0, '1681626703', 5),
(16, 'CRATCHER', 'Meri ek tang nakli hei ', 500, 7, '1681633471', 5),
(17, 'Table ', 'A wooden Table ', 1000, 45, '1681633515', 5),
(18, 'Phone case ', 'Silicon WHite color good quality phone case ', 700, 8, '1682506068', 7),
(19, 'Saline', '200 ml authentic saline ', 200, 7, '1682628624', 5),
(20, 'Injection', 'its  a 10 inch injection', 100, 49, '1682964793', 5);

-- --------------------------------------------------------

--
-- Table structure for table `provider_user`
--

CREATE TABLE `provider_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `picture` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provider_user`
--

INSERT INTO `provider_user` (`id`, `username`, `email`, `password`, `contact`, `picture`) VALUES
(5, 'Alauddin', 'hasina123@gmail.com', 'Qwerty123!', '+8801774030079', '1681552678'),
(6, 'kader', 'kader123@gmail.com', 'Qwerty123!', '+8801775550079', ''),
(7, 'Kader', 'obaidul123@gmail.com', 'Kader123!', '+8801774030079', '1682505918'),
(10, 'daliya', 'daliya123@gmail.com', 'Polkadot', '+8801774090079', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `foreign_key1` (`doctor_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `test5` (`seller_id`),
  ADD KEY `test10` (`consumer_id`),
  ADD KEY `test4` (`product_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `foreign2` (`doctor_id`),
  ADD KEY `foreign` (`consumer_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumer_user`
--
ALTER TABLE `consumer_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`deal_id`),
  ADD KEY `test` (`seller_id`),
  ADD KEY `test1` (`product_id`),
  ADD KEY `test3` (`consumer_id`);

--
-- Indexes for table `doctor_user`
--
ALTER TABLE `doctor_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key` (`seller_id`);

--
-- Indexes for table `provider_user`
--
ALTER TABLE `provider_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `consumer_user`
--
ALTER TABLE `consumer_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deal`
--
ALTER TABLE `deal`
  MODIFY `deal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `doctor_user`
--
ALTER TABLE `doctor_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `provider_user`
--
ALTER TABLE `provider_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `foreign_key1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_user` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `test10` FOREIGN KEY (`consumer_id`) REFERENCES `consumer_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test4` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test5` FOREIGN KEY (`seller_id`) REFERENCES `provider_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`consumer_id`) REFERENCES `consumer_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deal`
--
ALTER TABLE `deal`
  ADD CONSTRAINT `test3` FOREIGN KEY (`consumer_id`) REFERENCES `consumer_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`seller_id`) REFERENCES `provider_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
