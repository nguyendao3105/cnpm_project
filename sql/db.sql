-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 08, 2020 lúc 07:10 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food`
--

CREATE TABLE `food` (
  `available` bit(1) NOT NULL,
  `foodname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `id_food` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `descriptions_food` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `source_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `food`
--

INSERT INTO `food` (`available`, `foodname`, `price`, `id_food`, `id_vendor`, `descriptions_food`, `source_image`) VALUES
(b'0', 'Mì tôm cay hải sản', 29000.00, 1, 1, 'Mì cay hải sản với cùng tôm mực khổng lồ ăn mê mệt!', '../images/Menu/Court1/Food01.png'),
(b'1', 'Noodle', 10.20, 1, 1, 'Bo em hut rat nhieu thuoc', 'food.png'),
(b'1', 'VL', 10.23, 0, 1, 'adfa', 'adsf.png'),
(b'1', 'Mon 1', 1000.00, 2, 1, 'AAAAAAAAAA', 'inmage.png'),
(b'1', 'Mon 2', 1001.00, 3, 1, 'BBBBBBB', 'inmage.png'),
(b'1', 'Mon 3', 1002.00, 4, 1, 'CCCCCCC', 'inmage.png'),
(b'1', 'Mon 4', 1003.00, 5, 1, 'DDDDDD', 'inmage.png'),
(b'1', 'Mon 5', 1004.00, 6, 2, 'EEEE', 'inmage.png'),
(b'1', 'Mon 6', 1005.00, 7, 2, 'DMDMDMDM', 'inmage.png'),
(b'1', 'Mon 7', 1006.00, 8, 3, 'DIZZZZ', 'inmage.png'),
(b'0', 'Trà sữa matcha', 14000.00, 0, 0, '', 'Images/Menu/Court2/Food04.png '),
(b'1', 'Bánh bao', 10000.00, 0, 5, '120', '0120');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `time` date NOT NULL,
  `total_order` double(10,2) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `order_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id_order`, `cus_name`, `time`, `total_order`, `id_vendor`, `order_state`) VALUES
(2, 'Dao1', '2020-08-05', 15000.00, 2, 2),
(1, 'Dao', '2020-04-03', 10000.00, 1, 1),
(4, 'Dao', '2020-08-01', 150000.00, 2, 0),
(3, 'abc', '2020-05-31', 20000.00, 1, 0),
(5, 'daopro', '2020-08-06', 10.00, 0, 0),
(6, 'daopro', '2020-08-06', 34.00, 0, 0),
(7, 'daopro', '2020-08-06', 163.00, 0, 0),
(8, 'daopro', '2020-08-06', 58.00, 0, 0),
(9, 'daopro', '2020-08-06', 10.00, 1, 0),
(10, 'daopro', '2020-08-06', 10.00, 1, 0),
(11, 'daopro', '2020-08-06', 10.00, 1, 0),
(12, 'daopro', '2020-08-06', 174.00, 1, 0),
(13, 'daopro', '2020-08-06', 203.00, 1, 0),
(14, 'daopro', '2020-08-06', 29010.00, 1, 0),
(15, 'daopro', '2020-08-06', 2900.00, 1, 0),
(16, 'daopro', '2020-08-06', 1000.00, 1, 0),
(17, 'daopro', '2020-08-06', 1000.00, 1, 0),
(18, 'daopro', '2020-08-06', 1000.00, 1, 0),
(19, 'daopro', '2020-08-06', 1000.00, 1, 0),
(20, 'daopro', '2020-08-06', 1000.00, 1, 0),
(21, 'daopro', '2020-08-06', 1006000.00, 3, 0),
(22, 'daopro', '2020-08-06', 1006.00, 3, 0),
(23, 'daopro', '2020-08-06', 10.00, 1, 0),
(24, 'daopro', '2020-08-06', 10.00, 1, 0),
(25, 'daopro', '2020-08-06', 10.00, 1, 0),
(26, 'daopro', '2020-08-06', 10.00, 1, 0),
(27, 'daopro', '2020-08-06', 10.00, 1, 0),
(28, 'daopro', '2020-08-06', 10.00, 1, 0),
(29, 'daopro', '2020-08-06', 10.00, 1, 0),
(30, 'daopro', '2020-08-06', 10.00, 1, 0),
(31, 'daopro', '2020-08-06', 59066.00, 3, 0),
(32, 'daopro', '2020-08-06', 10.00, 1, 0),
(33, 'daopro', '2020-08-07', 29000.00, 1, 0),
(34, 'daopro', '2020-08-07', 10.00, 1, 0),
(35, 'daopro', '2020-08-07', 10000010.00, 1, 0),
(36, 'daopro', '2020-08-07', 10.00, 1, 0),
(37, 'customer', '2020-08-08', 10.00, 1, 1),
(38, 'customer', '2020-08-08', 3212110.00, 1, 0),
(39, 'customer', '2020-08-08', 2900000.00, 1, 2),
(40, 'customer', '2020-08-08', 2900000.00, 1, 1),
(41, 'customer', '2020-08-08', 30000.00, 1, 2),
(42, 'customer', '2020-08-08', 10.00, 1, 1),
(43, '', '2020-08-08', 2024.00, 1, 0),
(44, '', '2020-08-08', 60.00, 1, 1),
(45, '', '2020-08-08', 30.00, 1, 0),
(46, '', '2020-08-08', 10.00, 1, 0),
(47, '', '2020-08-08', 10.00, 1, 0),
(48, 'daopro', '2020-08-08', 40.00, 1, 2),
(49, '', '2020-08-08', 10.00, 1, 0),
(50, 'customer', '2020-08-08', 10.00, 1, 1),
(51, 'customer', '2020-08-08', 20.00, 1, 2),
(52, 'customer', '2020-08-08', 10000.00, 5, 2),
(53, 'customer', '2020-08-08', 60000.00, 5, 2),
(54, 'customer', '2020-08-08', 10.00, 1, 2),
(55, 'customer', '2020-08-08', 10.00, 1, 2),
(56, 'customer', '2020-08-08', 1990.00, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_order` int(11) NOT NULL,
  `food_name` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_food` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id_order`, `food_name`, `quantity`, `total_food`) VALUES
(1, 'Noodle', 3, 6000.00),
(1, 'Ice', 2, 4000.00),
(2, 'Water', 4, 12000.00),
(2, 'Apple', 1, 3000.00),
(3, 'ABC', 2, 20000.00),
(4, 'aaa', 1, 150000.00),
(5, 'VL', 1, 10.00),
(6, 'Mì tôm cay hải sản', 1, 34.00),
(6, 'VL', 3, 34.00),
(6, 'Noodle', 2, 34.00),
(6, 'Mon 1', 2, 34.00),
(6, 'Mon 2', 1, 34.00),
(6, 'Mon 3', 1, 34.00),
(6, 'Mon 4', 1, 34.00),
(7, 'Mon 1', 9, 163.00),
(7, 'VL', 4, 163.00),
(7, 'Mì tôm cay hải sản', 4, 163.00),
(7, 'Noodle', 10, 163.00),
(7, 'Mon 2', 11, 163.00),
(7, 'Mon 3', 10, 163.00),
(7, 'Mon 4', 3, 163.00),
(7, 'Mon 5', 3, 163.00),
(7, 'Mon 6', 8, 163.00),
(7, 'Mon 7', 3, 163.00),
(8, 'Mì tôm cay hải sản', 2, 58.00),
(9, 'VL', 1, 10.00),
(10, 'VL', 1, 10.00),
(11, 'VL', 1, 10.00),
(12, 'Mì tôm cay hải sản', 6, 174.00),
(13, 'VL', 1, 203.00),
(13, 'Mì tôm cay hải sản', 7, 203.00),
(14, 'VL', 1, 29010.00),
(14, 'Mì tôm cay hải sản', 1, 29010.00),
(15, 'Mì tôm cay hải sản', 100000, 2900.00),
(16, 'VL', 100000000, 1000.00),
(17, 'VL', 100000000, 1000.00),
(18, 'VL', 100000000, 1000.00),
(19, 'VL', 100000000, 1000.00),
(20, 'VL', 100000, 1000.00),
(21, 'Mon 7', 1000, 1006000.00),
(22, 'Mon 7', 1, 1006.00),
(23, 'VL', 1, 10.00),
(24, 'VL', 1, 10.00),
(25, 'VL', 1, 10.00),
(26, 'VL', 1, 10.00),
(27, 'VL', 1, 10.00),
(28, 'VL', 1, 10.00),
(29, 'Noodle', 1, 10.00),
(30, 'VL', 1, 10.00),
(31, 'Mon 7', 1, 59066.00),
(31, 'VL', 6, 59066.00),
(31, 'Mì tôm cay hải sản', 2, 59066.00),
(32, 'VL', 1, 10.00),
(33, 'Mì tôm cay hải sản', 1, 29000.00),
(34, 'VL', 1, 10.00),
(35, 'Noodle', 1, 10000010.00),
(35, 'Mon 1', 10000, 10000010.00),
(36, 'VL', 1, 10.00),
(37, 'VL', 1, 10.00),
(38, 'VL', 210, 3212110.00),
(38, 'Mì tôm cay hải sản', 3, 3212110.00),
(38, 'Noodle', 1, 3212110.00),
(38, 'Mon 1', 3123, 3212110.00),
(39, 'Mì tôm cay hải sản', 100, 2900000.00),
(40, 'Mì tôm cay hải sản', 100, 2900000.00),
(41, 'VL', 100, 30000.00),
(41, 'Mì tôm cay hải sản', 1, 30000.00),
(42, 'VL', 1, 10.00),
(43, 'VL', 2, 2024.00),
(43, 'Mon 3', 2, 2024.00),
(44, 'VL', 6, 60.00),
(45, 'VL', 3, 30.00),
(46, 'VL', 1, 10.00),
(47, 'VL', 1, 10.00),
(48, 'VL', 4, 40.00),
(49, 'VL', 1, 10.00),
(50, 'VL', 1, 10.00),
(51, 'VL', 2, 20.00),
(52, 'Bánh bao', 1, 10000.00),
(53, 'Bánh bao', 6, 60000.00),
(54, 'VL', 1, 10.00),
(55, 'VL', 1, 10.00),
(56, 'VL', 199, 1990.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `state_sys`
--

CREATE TABLE `state_sys` (
  `state` varchar(50) NOT NULL,
  `value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `state_sys`
--

INSERT INTO `state_sys` (`state`, `value`) VALUES
('maintaining', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` varchar(3) DEFAULT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `permission`, `balance`) VALUES
(18, 'dasfs', 'a@fsdgdf', 'c20ad4d76fe97759aa27a0c99bff6710', '', 0),
(19, 'aaasa', 'afsdl@dasf', '1d0f0d132d010dfd2f13cbe79ef5e0eb', '', 0),
(20, '121212', 'aaaa@qwqw', 'c20ad4d76fe97759aa27a0c99bff6710', '', 0),
(21, 'dsafa', 'adfasd@dfgdsf', 'c20ad4d76fe97759aa27a0c99bff6710', '', 0),
(22, 'daf', 'adsfa@dsa', 'c20ad4d76fe97759aa27a0c99bff6710', '', 0),
(23, 'aa', 'afsd@fff', 'c20ad4d76fe97759aa27a0c99bff6710', '', 0),
(24, 'asdfa', 'aa@gfgs', 'c20ad4d76fe97759aa27a0c99bff6710', '', 0),
(25, 'abcxyz', 'aaa', 'c20ad4d76fe97759aa27a0c99bff6710', '9', 0),
(26, 'daopro', 'sf', 'c20ad4d76fe97759aa27a0c99bff6710', '9', 41),
(28, 'ちん', 'ccc', 'c4ca4238a0b923820dcc509a6f75849b', '1', 0),
(29, 'customer', 'c', 'c4ca4238a0b923820dcc509a6f75849b', '9', 950000),
(30, 'manager', '1', 'c4ca4238a0b923820dcc509a6f75849b', '4', 0),
(31, 'owner', '1234', 'c4ca4238a0b923820dcc509a6f75849b', '3', 0),
(32, 'it', 'aksjsjd', 'c4ca4238a0b923820dcc509a6f75849b', '2', 0),
(33, 'cook', 'kjasdjb', 'c4ca4238a0b923820dcc509a6f75849b', '1', 0),
(34, 'mothai', 'asdfj', 'c4ca4238a0b923820dcc509a6f75849b', '1', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(11) NOT NULL,
  `vendor_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `vendor_name`, `owner_name`) VALUES
(1, 'NOODLE_SHOP', 'DAO'),
(2, 'NOODLE_SHOP_2', 'DAO_2'),
(3, 'NOODLE_SHOP_3', 'DAO_3'),
(4, 'NOODLE_SHOP_4', 'DAO_4'),
(5, 'Bánh bao', 'owner');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
