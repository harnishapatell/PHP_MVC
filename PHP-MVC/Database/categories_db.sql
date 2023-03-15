-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 11:42 AM
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
-- Database: `categories_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL,
  `datetime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `category_name`, `description`, `image`, `datetime`, `status`) VALUES
(408, NULL, '--', 'Dummy Record', '', '2023-03-15 10:39:52.053569', 'Active'),
(409, 408, 'App Development', 'App Development', 'upload/app devp.jpg', '2023-03-15 10:39:52.074439', 'Active'),
(410, 409, 'Android Development', 'Android Development', 'upload/android devp.jpg', '2023-03-15 10:40:14.493993', 'Active'),
(411, NULL, '--', 'Dummy Record', '', '2023-03-15 10:40:31.543337', 'Active'),
(412, 411, 'Web Designing', 'Web Designing', 'upload/web design.jpg', '2023-03-15 10:40:31.548918', 'Active'),
(413, 412, 'HTML', 'HTML', 'upload/html.png', '2023-03-15 10:40:56.744680', 'Active'),
(414, 412, 'CSS', 'CSS', 'upload/css.png', '2023-03-15 10:41:12.973146', 'Active'),
(415, NULL, '--', 'Dummy Record', '', '2023-03-15 10:41:31.707764', 'Active'),
(416, 415, 'Web Development', 'Web Development', 'upload/web devp.jpg', '2023-03-15 10:41:31.710115', 'Active'),
(417, 416, 'PHP', 'PHP', 'upload/php.png', '2023-03-15 10:41:50.863667', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phoneno` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `phoneno`) VALUES
(1, 'Harnisha', 'Patel', 'harnishapatel12@gmail.com', 'Harnisha@1210', '8320545329'),
(2, 'Krusha', 'Shah', 'krushashah4@gmail.com', 'Krusha@1810', '6354514454'),
(3, 'Prince', 'Patel', 'princepatel0025@gmail.com', '6b4d3a1ce033d417fc8abdc3c9bde9b2', '7862004709'),
(4, 'abcd', 'abcd', 'abcd@gmail.com', 'f0cbceecf140dbb7be600791511533ee', '7548962345'),
(5, 'Manoj', 'Patel', 'manoj51@gmail.com', '620c5da8be688c32d6be386910c041eb', '8690101404'),
(6, 'Khushboo', 'Rana', 'khushboo78@gmail.com', '817b3d2f28f33a4a861414a21c111df9', '7458612545'),
(7, 'Kriva', 'Patel', 'kriva08@gmail.com', '15cd7a933afacffd85e92583bfaeee69', '4567892153'),
(8, 'abc', 'abc', 'abc@gmail.com', 'Abc12345', '7894561236'),
(9, 'hello', 'hello', 'hello@gmail.com', 'd0aabe9a362cb2712ee90e04810902f3', '7418529635'),
(10, 'Vidhi', 'Rana', 'vidhi45@gmail.com', '7839b6c947c98fb420b334ceef9cd6c8', '7458965412'),
(11, 'Raman', 'Patel', 'raman78@gmail.com', '56e301312c76890180eaeaac2339efbc', '7412589635'),
(12, 'pqr', 'pqr', 'pqr@gmail.com', '5684b052fb837dd0cdb756713a607a42', '7894561235'),
(13, 'xyz', 'xyz', 'xyz@gmail.com', 'dc02c947d1b6c77047f17e5f01ea39ed', '7531598524'),
(14, 'jkl', 'jkl', 'jkl@gmail.com', '49a0ce0f6a8b48736d7a4ff035bba262', '4578954238');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
