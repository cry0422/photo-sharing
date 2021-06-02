-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-05-28 13:34:44
-- 服务器版本： 10.4.19-MariaDB
-- PHP 版本： 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `ruiyang.chen20`
--

-- --------------------------------------------------------

--
-- 表的结构 `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `password` varchar(6) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `account`
--

INSERT INTO `account` (`account_id`, `username`, `password`, `email`) VALUES
(1, 'crayon', '123456', 'Ruiyang.Chen@student.xjtlu.edu.cn'),
(2, 'laoyu', '123456', 'Jie.Yu20@student.xjtlu.edu.cn'),
(3, 'harry', '123456', 'Yunzhe.Song20@student.xjtlu.edu.cn'),
(4, 'eelin', '123456', '578760766@qq.com'),
(5, 'yyy', '123456', '123456789@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `photo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `comment` varchar(50) CHARACTER SET utf8 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`cid`, `username`, `photo`, `comment`, `time`) VALUES
(1, 'crayon', 'car.jpg', 'I think this photo is a cute one!!!', '2021-05-28 10:58:07'),
(2, 'laoyu', 'car.jpg', 'Not good.', '2021-05-28 11:11:08'),
(3, 'laoyu', 'art.jpg', 'Come to see my picture!!!', '2021-05-28 11:15:33'),
(4, 'laoyu', 'audiR8.jpeg', 'It is my car.', '2021-05-28 11:19:52'),
(5, 'crayon', 'audiR8.jpeg', 'I like your car. Can you drive me? bro', '2021-05-28 11:20:25'),
(6, 'harry', 'audiR8.jpeg', 'Hi!!!', '2021-05-28 11:24:40'),
(7, 'eelin', 'flower_girl.jpeg', 'So nice!', '2021-05-28 11:26:38'),
(8, 'eelin', 'flower.jpeg', 'Cartoon flowers.', '2021-05-28 11:29:59'),
(9, 'yyy', 'jordan.jpeg', 'The king of basketball: Jordan ', '2021-05-28 11:34:02'),
(10, 'crayon', 'jordan.jpeg', 'I am his fan.', '2021-05-28 11:35:41'),
(11, 'crayon', 'like.png', 'love!!!', '2021-05-28 11:36:20');

-- --------------------------------------------------------

--
-- 表的结构 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `pid` varchar(200) CHARACTER SET utf8 NOT NULL,
  `likeORdislike` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `likes`
--

INSERT INTO `likes` (`id`, `username`, `pid`, `likeORdislike`) VALUES
(1, 'crayon', '1', 'like'),
(2, 'laoyu', '1', 'dislike'),
(3, 'laoyu', '2', 'like'),
(4, 'crayon', '3', 'like'),
(5, 'harry', '1', 'like'),
(6, 'harry', '2', 'dislike'),
(7, 'harry', '3', 'like'),
(10, 'harry', '4', 'dislike'),
(11, 'eelin', '4', 'like'),
(12, 'eelin', '1', 'like'),
(13, 'eelin', '2', 'dislike'),
(14, 'eelin', '3', 'like'),
(15, 'eelin', '5', 'like'),
(16, 'eelin', '6', 'like'),
(17, 'yyy', '1', 'like'),
(18, 'yyy', '2', 'dislike'),
(19, 'yyy', '3', 'dislike'),
(20, 'yyy', '4', 'like'),
(21, 'yyy', '5', 'like'),
(22, 'yyy', '6', 'dislike'),
(23, 'yyy', '7', 'like'),
(24, 'crayon', '7', 'like'),
(25, 'crayon', '5', 'like'),
(26, 'crayon', '9', 'like');

-- --------------------------------------------------------

--
-- 表的结构 `photo`
--

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL,
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `photo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `time` datetime NOT NULL,
  `tags` varchar(200) CHARACTER SET utf8 NOT NULL,
  `type` varchar(10) CHARACTER SET utf8 NOT NULL,
  `likes` int(10) NOT NULL,
  `dislikes` int(10) NOT NULL,
  `description` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `photo`
--

INSERT INTO `photo` (`photo_id`, `username`, `photo`, `time`, `tags`, `type`, `likes`, `dislikes`, `description`) VALUES
(1, 'crayon', 'car.jpg', '2021-05-28 10:57:20', '#car#sky#cute', 'landscape', 4, 1, 'Cartoon car'),
(2, 'laoyu', 'art.jpg', '2021-05-28 11:12:12', '#art#abstract #popular#people', 'landscape', 1, 3, 'It is my first time to see so beautiful picture'),
(3, 'laoyu', 'audiR8.jpeg', '2021-05-28 11:18:48', '#car#audi#r8', 'landscape', 3, 1, 'Audi R8'),
(4, 'harry', 'flower_girl.jpeg', '2021-05-28 11:23:33', '#flower#girl', 'portrait', 2, 1, 'Do you like it?'),
(5, 'eelin', 'like.png', '2021-05-28 11:27:45', '#like#heart', 'landscape', 3, 0, 'Give you my heart'),
(6, 'eelin', 'flower.jpeg', '2021-05-28 11:29:40', '#flower#cartoon', 'portrait', 1, 1, 'Smell good!'),
(7, 'yyy', 'jordan.jpeg', '2021-05-28 11:32:36', '#jordan#basketball#cartoon', 'landscape', 2, 0, 'The king of nba.'),
(8, 'crayon', 'lakers.jpeg', '2021-05-28 11:35:29', '#lakers#basketball#nba', 'landscape', 0, 0, 'Lakers, champion '),
(9, 'crayon', 'laoyu_header.jpeg', '2021-05-28 11:58:35', '#tom#cat', 'landscape', 1, 0, 'It is Tom');

-- --------------------------------------------------------

--
-- 表的结构 `profile`
--

CREATE TABLE `profile` (
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(6) CHARACTER SET utf8 NOT NULL,
  `header` varchar(100) CHARACTER SET utf8 NOT NULL,
  `signature` varchar(200) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `profile`
--

INSERT INTO `profile` (`username`, `name`, `gender`, `header`, `signature`) VALUES
('crayon', 'Ruiyang Chen', 'male', 'crayon_header.jpeg', 'Welcome to my photo share! guys!'),
('eelin', 'Yilin', 'female', 'header.png', 'Hi, everybody.'),
('harry', 'Xiaohua Song', 'female', 'flower_girl.jpeg', 'I wanna a boyfriend.'),
('laoyu', 'Jie Yu', 'male', 'laoyu_header.jpeg', 'I like making friends.'),
('yyy', 'yyy', 'female', 'header.png', 'Hello, my name is yyy. I like cars, basketball and music.');

--
-- 转储表的索引
--

--
-- 表的索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- 表的索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- 表的索引 `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- 表的索引 `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
