-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 03:23 AM
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
-- Database: `svap`
--

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `collector_email` varchar(50) NOT NULL,
  `post_id` int(20) NOT NULL,
  `collection_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`collector_email`, `post_id`, `collection_id`) VALUES
('1762649548@qq.com', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_path`
--

CREATE TABLE `image_path` (
  `email` varchar(50) NOT NULL,
  `post_id` int(20) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_path`
--

INSERT INTO `image_path` (`email`, `post_id`, `image_path`) VALUES
('1762649548@qq.com', 1, 'imgStorage/1762649548@qq.com/1/0.jpg'),
('1762649548@qq.com', 1, 'imgStorage/1762649548@qq.com/1/1.jpg'),
('1762649548@qq.com', 1, 'imgStorage/1762649548@qq.com/1/2.jpg'),
('1762649548@qq.com', 2, 'imgStorage/1762649548@qq.com/2/0.jpg'),
('1762649548@qq.com', 2, 'imgStorage/1762649548@qq.com/2/1.jpg'),
('1762649548@qq.com', 2, 'imgStorage/1762649548@qq.com/2/2.jpg'),
('1762649548@qq.com', 3, 'imgStorage/1762649548@qq.com/3/0.jpg'),
('1762649548@qq.com', 4, 'imgStorage/1762649548@qq.com/4/0.jpg'),
('1762649548@qq.com', 4, 'imgStorage/1762649548@qq.com/4/1.jpg'),
('1762649548@qq.com', 4, 'imgStorage/1762649548@qq.com/4/2.jpg'),
('1762649548@qq.com', 5, 'imgStorage/1762649548@qq.com/5/0.jpg'),
('1762649548@qq.com', 5, 'imgStorage/1762649548@qq.com/5/1.jpg'),
('jason@qq.com', 6, 'imgStorage/jason@qq.com/6/0.jpg'),
('jason@qq.com', 6, 'imgStorage/jason@qq.com/6/1.jpg'),
('jason@qq.com', 7, 'imgStorage/jason@qq.com/7/0.jpg'),
('jason@qq.com', 7, 'imgStorage/jason@qq.com/7/1.jpg'),
('jason@qq.com', 8, 'imgStorage/jason@qq.com/8/0.jpg'),
('jason@qq.com', 8, 'imgStorage/jason@qq.com/8/1.jpg'),
('yanhan@qq.com', 9, 'imgStorage/yanhan@qq.com/9/0.jpg'),
('yanhan@qq.com', 9, 'imgStorage/yanhan@qq.com/9/1.jpg'),
('yanhan@qq.com', 10, 'imgStorage/yanhan@qq.com/10/0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `email` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `isBanned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`email`, `name`, `password`, `phone`, `city`, `isBanned`) VALUES
('1762649548@qq.com', 'Chongyuan Bian', '$2y$10$q8tFOq8Mw.4gSgJO5HNqSO0uv9BzWow5XjGLIZAwG6jTaOSsg6J5C', '6045628672', 'Surrey', 0),
('bian@qq.com', 'Bian', '$2y$10$CJMMncsVk/b6t3qsGLcrp.NTXrqcWTamxZ9bpkBtx.cHvKmaDk11q', '2368180233', 'Maple Ridge', 0),
('jason@qq.com', 'Jason Liu', '$2y$10$bb4JEI0HaW.ZpAINtt1u2O7m/MEU9s1jkt4DVkryztlZqtLLicEJq', '6047802688', 'Richmond', 0),
('yanhan@qq.com', 'Yan Han', '$2y$10$EykDg3MPw/tOSYWVgGYLvOdSC83TzBrsXBlgMtkJMaiT9ESc9KU/G', '6047802333', 'Port Moody', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` varchar(50) NOT NULL,
  `sender_email` varchar(50) NOT NULL,
  `message_id` int(20) NOT NULL,
  `receiver_email` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`time_stamp`, `content`, `sender_email`, `message_id`, `receiver_email`, `status`) VALUES
('2022-12-10 13:47:51', 'Hi, I want it', '1762649548@qq.com', 1, 'yanhan@qq.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `value` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `date`, `email`, `category`, `value`) VALUES
(1, ' Lots of Lego - New and Used', 'I have a fair variety of items for trade/barter or sale, Items available are shown in the pictures and/or are listed in other ads', '2022-12-10 13:13:53', '1762649548@qq.com', 'lego', '100.00'),
(2, 'Toshiba 15.6\" laptop 6th gen', 'Toshiba Tecra A50-C laptop\r\n6th generation i5-6200 CPU\r\n8GB memory, 250GB SSD\r\n15.6-inch, 1366x768 HD Screen\r\nOffice 2016 installed\r\nGreat condition, everything works and battery is very good', '2022-12-10 13:14:56', '1762649548@qq.com', 'laptop', '220.00'),
(3, 'phone for sale/trade', 'Samsung ace II.', '2022-12-10 13:17:18', '1762649548@qq.com', 'phone', '90.00'),
(4, 'Two tone Men\'s Rolex Submariner', 'Selling a Y series serial# Two tone Rolex Submariner.\r\nExcellent condition, full links, no sag\r\nBox\'s, marketing papers, etc.', '2022-12-10 13:20:30', '1762649548@qq.com', 'collectible', '14000.00'),
(5, 'Black Speakers', 'ADAM Audio F5 Active Nearfield Monitors (Pair) Black Speakers\r\nWork good.', '2022-12-10 13:26:18', '1762649548@qq.com', 'speaker', '350.00'),
(6, 'Blaster Radio', 'JVC Model PC- 110 portable stereo system with CD and dual cassette players. Excellent condition and perfect working order. Comes with remote, price is firm.', '2022-12-10 13:28:56', 'jason@qq.com', 'speaker', '100.00'),
(7, 'Vintage Wrong Way wooden road sign', 'Vintage Wrong Way wooden road sign 40 x 36 inches.\r\n\r\nGreat collectible, movie prop, Man Cave\r\n\r\nAsking $40.00 obo\r\n\r\nThank you for looking and please contact me with any questions :^)', '2022-12-10 13:30:41', 'jason@qq.com', 'collectible', '40.00'),
(8, 'Brass Letter Opener', 'Brass letter opener, excellent condition, looks great, 6\" long, great gift idea or add to your collection, $10', '2022-12-10 13:31:54', 'jason@qq.com', 'collectible', '10.00'),
(9, 'The Compleat Beatles', 'The Compleat Beatles VHS+The Beatles 40th Anniversary Collectors Edition Magazine\r\n$17 for all OR $9 each', '2022-12-10 13:40:02', 'yanhan@qq.com', 'collectible', '17.00'),
(10, 'Sega Genesis Arcade Power Stick', 'Sega Genesis Arcade Power Stick in excellent condition and perfect working order. Price is firm.', '2022-12-10 13:41:29', 'yanhan@qq.com', 'game-console', '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `want_to_trade`
--

CREATE TABLE `want_to_trade` (
  `email` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `want_to_trade`
--

INSERT INTO `want_to_trade` (`email`, `post_id`, `category`) VALUES
('1762649548@qq.com', 1, 'cd'),
('1762649548@qq.com', 1, 'dvd'),
('1762649548@qq.com', 1, 'funko-pop'),
('1762649548@qq.com', 1, 'lego'),
('1762649548@qq.com', 2, 'tv'),
('1762649548@qq.com', 2, 'funko-pop'),
('1762649548@qq.com', 2, 'desktop'),
('1762649548@qq.com', 2, 'laptop'),
('1762649548@qq.com', 3, 'tv'),
('1762649548@qq.com', 3, 'lego'),
('1762649548@qq.com', 3, 'desktop'),
('1762649548@qq.com', 3, 'laptop'),
('1762649548@qq.com', 3, 'phone'),
('1762649548@qq.com', 4, 'collectible'),
('1762649548@qq.com', 5, 'collectible'),
('1762649548@qq.com', 5, 'cd'),
('1762649548@qq.com', 5, 'dvd'),
('jason@qq.com', 6, 'blu-ray'),
('jason@qq.com', 7, 'tv'),
('jason@qq.com', 7, 'lego'),
('jason@qq.com', 7, 'desktop'),
('jason@qq.com', 8, 'phone'),
('yanhan@qq.com', 9, 'desktop'),
('yanhan@qq.com', 9, 'laptop'),
('yanhan@qq.com', 10, 'phone');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `image_path`
--
ALTER TABLE `image_path`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_path`
--
ALTER TABLE `image_path`
  ADD CONSTRAINT `image_path_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `image_path_ibfk_2` FOREIGN KEY (`email`) REFERENCES `member` (`email`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`email`) REFERENCES `member` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
