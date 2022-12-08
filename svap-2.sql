-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-12-08 19:09:57
-- 服务器版本： 10.4.21-MariaDB
-- PHP 版本： 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `svap`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `collection`
--

CREATE TABLE `collection` (
  `collector_email` varchar(50) NOT NULL,
  `post_id` int(20) NOT NULL,
  `collection_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `question` varchar(100) NOT NULL,
  `member_id` int(20) NOT NULL,
  `post_id` int(20) NOT NULL,
  `question_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment_id` int(11) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `answer_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `image_path`
--

CREATE TABLE `image_path` (
  `email` varchar(50) NOT NULL,
  `post_id` int(20) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `image_path`
--

INSERT INTO `image_path` (`email`, `post_id`, `image_path`) VALUES
('1762649548@qq.com', 1, 'imgStorage/1762649548@qq.com/1/0.png'),
('1762649548@qq.com', 1, 'imgStorage/1762649548@qq.com/1/1.png'),
('1762649548@qq.com', 2, 'imgStorage/1762649548@qq.com/2/0.png'),
('1762649548@qq.com', 3, 'imgStorage/1762649548@qq.com/3/0.png'),
('1762649548@qq.com', 4, 'imgStorage/1762649548@qq.com/4/0.png');

-- --------------------------------------------------------

--
-- 表的结构 `member`
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
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`email`, `name`, `password`, `phone`, `city`, `isBanned`) VALUES
('1762649548@qq.com', 'bcy', '$2y$10$d4wtWMD031P2iFkZN6p8meFGpAuzZtNz6aLY0ijFxg2kr7dRHnA5u', '6045628672', 'New Westminster', 0);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` varchar(50) NOT NULL,
  `sender_email` varchar(50) NOT NULL,
  `message_id` int(20) NOT NULL,
  `receiver_email` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE `post` (
  `post_id` int(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `isReported` tinyint(1) NOT NULL DEFAULT 0,
  `isTraded` tinyint(1) NOT NULL DEFAULT 0,
  `value` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `date`, `email`, `category`, `isReported`, `isTraded`, `value`) VALUES
(1, 'Phone', 'isdbabccyigefeong', '2022-12-08 14:22:23', '1762649548@qq.com', 'tv', 0, 0, '100.00'),
(2, 'sajdbkaa', 'sdcxkn', '2022-12-08 14:23:58', '1762649548@qq.com', 'tv', 0, 0, '100.00'),
(3, 'asvc', 'asc8xztgivba', '2022-12-08 14:25:38', '1762649548@qq.com', 'tv', 0, 0, '100.00'),
(4, '123', 'xsxa', '2022-12-08 14:28:36', '1762649548@qq.com', 'figure', 0, 0, '100.00');

-- --------------------------------------------------------

--
-- 表的结构 `want_to_trade`
--

CREATE TABLE `want_to_trade` (
  `email` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `want_to_trade`
--

INSERT INTO `want_to_trade` (`email`, `post_id`, `category`) VALUES
('1762649548@qq.com', 1, 'tv'),
('1762649548@qq.com', 2, 'tv'),
('1762649548@qq.com', 2, 'funko-pop'),
('1762649548@qq.com', 3, 'tv'),
('1762649548@qq.com', 4, 'casset');

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- 表的索引 `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`collection_id`);

--
-- 表的索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- 表的索引 `image_path`
--
ALTER TABLE `image_path`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `email` (`email`);

--
-- 表的索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`email`);

--
-- 表的索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- 表的索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 限制导出的表
--

--
-- 限制表 `image_path`
--
ALTER TABLE `image_path`
  ADD CONSTRAINT `image_path_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `image_path_ibfk_2` FOREIGN KEY (`email`) REFERENCES `member` (`email`);

--
-- 限制表 `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`email`) REFERENCES `member` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
