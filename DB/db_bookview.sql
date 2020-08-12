-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2020 at 01:29 PM
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
(10, NULL, NULL, 'supakit.iot@gmail.com', 'boatSupakit', 'Posai', NULL, 'https://lh3.googleusercontent.com/-i2kOZHe4i08/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucmGQQq3wAS9h4vw4cnrOhuCPqir9Q/s96-c/photo.jpg', '107641026113720422895', 'user');

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
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
