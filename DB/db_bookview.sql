-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 12:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bookview`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `id_cate` int(11) NOT NULL,
  `name_book` text COLLATE utf8_unicode_ci NOT NULL,
  `name_author` text COLLATE utf8_unicode_ci NOT NULL,
  `image_book` text COLLATE utf8_unicode_ci NOT NULL,
  `resume` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `id_cate`, `name_book`, `name_author`, `image_book`, `resume`, `amount`, `status`) VALUES
(1, 16, 'อ่านคิดน่ารู้ ลองดูแล้วจะรู้กัน', 'สุภกิจ โพธิ์ไทรย์', '1596962026-นิยาย-m.jpg', 'แปอแปอแปอแปอปแอปแ แปอ ปแ อ ปแอ ปอหดฟหกหก หฟ ก ห', 40, 1),
(2, 16, 'test test', 'สุภกิจ โพธิ์ไทรย์', '1597227376-ปกหนังสือ.jpg', 'ssafdfd ff df dfa', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catergory`
--

CREATE TABLE `catergory` (
  `id_cate` int(11) NOT NULL,
  `name_cate` text COLLATE utf8_unicode_ci NOT NULL,
  `date_borrow` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catergory`
--

INSERT INTO `catergory` (`id_cate`, `name_cate`, `date_borrow`, `image`) VALUES
(16, 'ทั่วไป1', 5, '1596958268-BoldialFlatCreativeWordPressThemeBestWordPressThemes2014.jpg'),
(17, 'วิทยาศาตร์', 5, '1596910430-5c7ea3ecHUa1JbW3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `chat_bot`
--

CREATE TABLE `chat_bot` (
  `id_chat_bot` int(11) NOT NULL,
  `key` text COLLATE utf8_unicode_ci NOT NULL,
  `message_auto` text COLLATE utf8_unicode_ci NOT NULL,
  `create_chat_bot` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chat_bot`
--

INSERT INTO `chat_bot` (`id_chat_bot`, `key`, `message_auto`, `create_chat_bot`) VALUES
(1, 'default', 'กรุณรอแอดมินตอบกลับค่ะ', '2020-09-12 14:49:37'),
(2, 'หนังสือ', 'สามารถค้นหาได้เลยค่ะ', '2020-09-12 21:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

CREATE TABLE `chat_room` (
  `id_chat_room` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `update_at` datetime NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chat_room`
--

INSERT INTO `chat_room` (`id_chat_room`, `id_user`, `update_at`, `create_at`) VALUES
(2, 11, '2020-09-13 05:50:31', '2020-09-13 01:13:06'),
(3, 7, '2020-09-13 02:09:16', '2020-09-13 02:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_chat` int(11) NOT NULL,
  `id_chat_room` int(11) NOT NULL,
  `send_to` text COLLATE utf8_unicode_ci NOT NULL,
  `send_by` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `chat_create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_chat`, `id_chat_room`, `send_to`, `send_by`, `message`, `chat_create_at`) VALUES
(1, 2, 'admin', '11', 'fffdsad', '2020-09-13 01:13:06'),
(2, 2, '11', 'Bot', 'กรุณรอแอดมินตอบกลับค่ะ', '2020-09-13 01:13:06'),
(3, 2, 'admin', '11', 'sadsa', '2020-09-13 01:20:00'),
(4, 2, '11', 'Bot', 'กรุณรอแอดมินตอบกลับค่ะ', '2020-09-13 01:20:00'),
(5, 3, 'admin', '7', 'testttt', '2020-09-13 02:09:16'),
(6, 3, '7', 'Bot', 'กรุณรอแอดมินตอบกลับค่ะ', '2020-09-13 02:09:16'),
(7, 2, 'user', 'admin', 'กหดกหด', '2020-09-13 02:37:46'),
(8, 2, 'user', 'admin', 'sdsd', '2020-09-13 02:39:46'),
(9, 2, 'admin', '11', 'xzcxvc', '2020-09-13 02:42:05'),
(10, 2, 'user', 'admin', 'cvcxv', '2020-09-13 02:42:12'),
(11, 2, 'admin', '11', 'dsfdsf', '2020-09-13 02:42:23'),
(12, 2, 'user', 'admin', 'dfdsfd', '2020-09-13 02:42:28'),
(13, 2, 'user', 'admin', 'ffff', '2020-09-13 05:28:10'),
(14, 2, 'user', 'admin', 'vvvv', '2020-09-13 05:30:35'),
(15, 2, 'admin', '11', 'gkkkk', '2020-09-13 05:31:52'),
(16, 2, 'user', 'admin', 'mnvmvn', '2020-09-13 05:34:17'),
(17, 2, 'admin', '11', 'gdsgsf', '2020-09-13 05:35:52'),
(18, 2, 'user', 'admin', 'ccvxc', '2020-09-13 05:36:12'),
(19, 2, 'admin', '11', '       nbbvnbv', '2020-09-13 05:36:51'),
(20, 2, 'user', 'admin', 'sadsad', '2020-09-13 05:43:07'),
(21, 2, 'admin', '11', 'vcvcxv', '2020-09-13 05:46:27'),
(22, 2, 'user', 'admin', 'xcxzcx', '2020-09-13 05:46:34'),
(23, 2, 'admin', '11', 'xcxzczxc', '2020-09-13 05:46:39'),
(24, 2, 'user', 'admin', 'cvvvvvvvvvvvvv', '2020-09-13 05:48:11'),
(25, 2, 'admin', '11', 'vzczvcv', '2020-09-13 05:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `no_order` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `fines_order` int(11) DEFAULT NULL,
  `status_order` text COLLATE utf8_unicode_ci NOT NULL,
  `create_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `no_order`, `id_user`, `total_amount`, `fines_order`, `status_order`, `create_order`) VALUES
(18, '0000000001', 7, 9, NULL, '11', '2020-09-07 00:00:00'),
(19, '0000000002', 11, 4, 10, '11', '2020-09-07 02:12:00'),
(20, '0000000003', 11, 2, NULL, '11', '2020-09-09 06:40:39'),
(21, '0000000004', 11, 3, NULL, '01', '2020-09-10 05:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `date_borrow` date NOT NULL,
  `fines` decimal(8,2) DEFAULT NULL,
  `amount_order` int(11) NOT NULL,
  `status_order_detail` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_detail`, `id_order`, `id_book`, `date_borrow`, `fines`, `amount_order`, `status_order_detail`) VALUES
(1, 18, 1, '2020-09-12', NULL, 2, '11'),
(2, 18, 2, '2020-09-12', NULL, 7, '11'),
(3, 19, 1, '2020-09-12', NULL, 1, '11'),
(4, 19, 2, '2020-09-12', NULL, 3, '11'),
(5, 20, 1, '2020-09-14', NULL, 2, '11'),
(6, 21, 2, '2020-09-15', NULL, 1, '01'),
(7, 21, 1, '2020-09-15', NULL, 2, '01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `review` text COLLATE utf8_unicode_ci NOT NULL,
  `date_review` datetime NOT NULL,
  `status_review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id_review`, `id_book`, `id_user`, `review`, `date_review`, `status_review`) VALUES
(1, 1, 1, 'dsfdsf', '2020-08-11 14:55:15', 1),
(2, 1, 1, 'sdffd', '2020-08-11 15:12:07', 1),
(3, 1, 1, 'asad', '2020-08-11 15:15:09', 1),
(4, 1, 1, 'sadsad', '2020-08-11 15:33:45', 1),
(5, 2, 10, 'cfdfdsfsd', '2020-08-12 13:04:21', 1),
(6, 2, 10, 'เล่มนี้ดีมากๆเลยครับ', '2020-08-12 13:04:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` text COLLATE utf8_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_google` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `first_name`, `last_name`, `phone`, `profile`, `id_google`, `type`) VALUES
(1, 'admin', '12345', 'admin@admin.com', 'super', 'admin', NULL, NULL, NULL, 'admin'),
(6, 'boatsupakit', '5940505432', '5940505432@nrru.ac.th', 'สุภกิจ', 'โพธิ์ไทรย์', '0644547445', NULL, NULL, 'user'),
(7, NULL, NULL, 'boatbububa@gmail.com', 'supakit', 'posai', NULL, 'https://lh3.googleusercontent.com/-aJBfseVhJnI/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucnAVnIo3NoxvH2DasUc2JZLGtwksA/s96-c/photo.jpg', '108458014591147147813', 'user'),
(10, NULL, NULL, 'supakit.iot@gmail.com', 'boatSupakit', 'Posai', NULL, 'https://lh3.googleusercontent.com/-i2kOZHe4i08/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucmGQQq3wAS9h4vw4cnrOhuCPqir9Q/s96-c/photo.jpg', '107641026113720422895', 'user'),
(11, NULL, NULL, 'boat@degitobangkok.com', 'Boat', 'Supakit', '0644547445', 'http://localhost/bookview/upload/1599831501-9008503529293936704501006572931732624900096o.jpg', '115441813355937508288', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `catergory`
--
ALTER TABLE `catergory`
  ADD PRIMARY KEY (`id_cate`);

--
-- Indexes for table `chat_bot`
--
ALTER TABLE `chat_bot`
  ADD PRIMARY KEY (`id_chat_bot`);

--
-- Indexes for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD PRIMARY KEY (`id_chat_room`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catergory`
--
ALTER TABLE `catergory`
  MODIFY `id_cate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `chat_bot`
--
ALTER TABLE `chat_bot`
  MODIFY `id_chat_bot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `id_chat_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
