-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2019 at 02:44 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `website_ban_hang_quan_ao_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `roles` int(5) DEFAULT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `roles`, `username`, `password`, `email`, `name`, `status`, `created_at`) VALUES
(1, 1, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin@gmail.com', 'SupperAdmin', 0, '2017-06-12 16:30:04'),
(9, 2, 'Nguyễn Hưng', '25d55ad283aa400af464c76d713c07ad', 'nguyenhung@gmail.com', 'Nguyễn Hưng', 0, '2018-10-26 07:15:19'),
(7, 1, 'Nguyễn Hoàng Hưng', '25f9e794323b453885f5181f1b624d0b', 'hoanghungnguyen03@gmail.com', 'Nguyễn Hoàng Hưng', 0, '2018-10-26 06:12:02'),
(10, 0, 'Khang Hưng 1', '25f9e794323b453885f5181f1b624d0b', 'hung@gmail.com', 'Khang Hưng 1', 0, '2018-10-26 07:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
`id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `parent_id` int(5) DEFAULT '0',
  `sort_order` tinyint(4) DEFAULT '0',
  `status` tinyint(2) DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `icon`, `parent_id`, `sort_order`, `status`, `created`) VALUES
(108, 'Thời trang nữ', '', 0, 1, 0, '2018-10-13 04:05:57'),
(109, 'Áo', '', 108, 1, 0, '2018-10-13 04:08:10'),
(110, 'Chân Váy', '', 108, 2, 0, '2018-10-13 04:08:25'),
(111, 'Thời Trang Nam', '', 0, 2, 0, '2018-10-13 04:16:09'),
(112, ' Áo sơ mi', '', 111, 1, 0, '2018-10-13 04:16:48'),
(113, ' Áo thun nam', '', 111, 2, 0, '2018-10-13 04:17:25'),
(114, 'Quần jean', '', 111, 3, 0, '2018-10-13 04:17:51'),
(115, 'Đồ Thể Thao', '', 0, 3, 0, '2018-10-13 04:18:53'),
(116, 'Đồ Thể Thao Nữ', '', 115, 1, 0, '2018-10-13 04:19:25'),
(117, 'Đồ Thể Thao Nam', '', 115, 2, 0, '2018-10-13 04:19:39'),
(121, 'Áo khoác', '', 0, 4, 0, '2018-10-26 06:35:28'),
(122, 'Áo khoác nam ', '', 121, 1, 0, '2018-10-26 06:36:58'),
(123, 'Áo khoác nữ', '', 121, 1, 0, '2018-10-26 06:37:48'),
(124, 'ĐẦM LIỀN / VÁY LIỀN', '', 108, 3, 0, '2018-10-26 09:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id` int(128) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `activel` tinyint(3) DEFAULT '0',
  `created` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `address`, `title`, `content`, `phone`, `activel`, `created`) VALUES
(39, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', 'where the dream begins', 'where the dream begins', '0928817228', 0, '2019-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
`id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `title`, `name`, `phone`, `email`, `address`, `content`, `created`) VALUES
(7, 'Giới thiệu   ', 'Xưởng Gia Công Hàng Thời Trang - Công Ty TNHH May Mặc Dony', '0286267581', 'donysty@gmail.com', '355/23 Kênh Tân Hóa, Q. Tân Phú, Tp. HCM', '<p><strong>Dony l&agrave; c&ocirc;ng ty sản xuất may mặc theo đơn đặt h&agrave;ng</strong><span style="color:rgb(17, 17, 17); font-family:arial">. Sản xuất trọn g&oacute;i từ nguy&ecirc;n liệu đến may in th&ecirc;u ho&agrave;n thiện sản phẩm may mặc.&nbsp;</span><br />\r\n<em>Xưởng thời trang Dony chuy&ecirc;n nhận gia c&ocirc;ng h&agrave;ng thời trang với ti&ecirc;u chuẩn cao cấp, số lượng đơn h&agrave;ng nhận tối thiểu từ 30 c&aacute;i</em><span style="color:rgb(17, 17, 17); font-family:arial">&nbsp;</span><br />\r\n<strong>C&aacute;c sản phẩm ch&iacute;nh</strong><span style="color:rgb(17, 17, 17); font-family:arial">:</span><br />\r\n<span style="color:rgb(17, 17, 17); font-family:arial">-</span><strong>&nbsp;&Aacute;o thun</strong><span style="color:rgb(17, 17, 17); font-family:arial">: Cổ tr&ograve;n, cổ trụ, cổ điển, thời trang vải c&aacute; sấu, c&aacute; m&acirc;p, cotton, polyester, lụa m&egrave;, c&aacute; sấu m&egrave;,..&nbsp;</span><br />\r\n<span style="color:rgb(17, 17, 17); font-family:arial">-</span><strong>&nbsp;&Aacute;o kho&aacute;c</strong><span style="color:rgb(17, 17, 17); font-family:arial">: 1 lớp, 2 lớp, chằn g&ograve;n vải d&ugrave;, switt, Micro, c&aacute;n m&agrave;ng chống nước, kh&ocirc;ng c&aacute;n m&agrave;ng,..&nbsp;</span><br />\r\n<span style="color:rgb(17, 17, 17); font-family:arial">-&nbsp;</span><strong>Sơ mi</strong><span style="color:rgb(17, 17, 17); font-family:arial">: Cổ điển, sơ mi kiểu vải Silk, Kate Việt Thắng, Kate Mỹ, &yacute;, Kate thun,..&nbsp;</span><br />\r\n<span style="color:rgb(17, 17, 17); font-family:arial">-&nbsp;</span><strong>Quần t&acirc;y, quần kaki, quần short</strong><span style="color:rgb(17, 17, 17); font-family:arial">: Cashmere, Kaki, Len ngựa, Terin,..&nbsp;</span><br />\r\n<span style="color:rgb(17, 17, 17); font-family:arial">-&nbsp;</span><strong>Đầm v&aacute;y</strong><span style="color:rgb(17, 17, 17); font-family:arial">: Ch&acirc;n v&aacute;y, đầm Tuy&ecirc;t mưa, cotton lạnh, kaki thun, c&aacute;t nhật, c&aacute;t h&agrave;n, c&aacute;t giấy, vải thun,..&nbsp;</span><br />\r\n<span style="color:rgb(17, 17, 17); font-family:arial">-&nbsp;</span><strong>N&oacute;n mũ</strong><span style="color:rgb(17, 17, 17); font-family:arial">: N&oacute;n lưỡi trai ( n&oacute;n kết), n&oacute;n tai b&egrave;o, n&oacute;n nửa đầu, Kaki cotton, Samsung, Kaki 65/35, D&ugrave;, Thun,..&nbsp;</span><br />\r\n<span style="color:rgb(17, 17, 17); font-family:arial">-&nbsp;</span><strong>Bảo hộ lao động</strong><span style="color:rgb(17, 17, 17); font-family:arial">: Quần t&uacute;i hộp, quần bảo hộ, &aacute;o bảo hộ, bộ &aacute;o liền quần với c&aacute;c chất liệu: Kaki thường, vải chống ch&aacute;y, vảy Denin,..</span></p>\r\n', '2018-10-13 04:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `newcategory`
--

CREATE TABLE IF NOT EXISTS `newcategory` (
`id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` tinyint(3) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `newcategory`
--

INSERT INTO `newcategory` (`id`, `name`, `sort_order`, `status`, `created_at`) VALUES
(5, 'Tin mới', 1, 0, '2018-10-13 11:56:03'),
(6, 'Tin nóng', 2, 0, '2018-10-13 11:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `newcatalog_id` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(50) COLLATE utf8_bin NOT NULL,
  `created` int(11) NOT NULL DEFAULT '0',
  `count_view` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `newcatalog_id`, `title`, `intro`, `content`, `image_link`, `created`, `count_view`) VALUES
(23, 5, ' ÁO KHOÁC NAM KAKI PHỐI KHÓA KÉO ROCKY', 'Áo sắp ra mắt', '<div style="box-sizing: border-box; font-family: Verdana; font-size: 12px;">Th&ocirc;ng tin chi tiết</div>\r\n\r\n<div style="box-sizing: border-box; font-family: Verdana; font-size: 12px;">Nếu như thời trang cho bạn g&aacute;i cần lắm sự tỉ mỉ, kh&eacute;o l&eacute;o v&agrave; tinh tế từ kiểu d&aacute;ng đến m&agrave;u sắc th&igrave; thời trang cho nam lại đơn giản hơn nhưng tinh tế v&agrave; kh&ocirc;ng cầu kỳ, người ta vẫn sẽ thấy một anh ch&agrave;ng thanh lịch nhưng vẫn manly v&agrave; nam t&iacute;nh, đặc biệt, những trang phục như &aacute;o kho&aacute;c chỉ cần một chiếc &aacute;o m&agrave;u trơn c&ugrave;ng một số điểm nhấn nhỏ như logo hay sọc ngang &aacute;o..cũng đủ l&agrave;m ch&agrave;ng nổi bật v&agrave; thật ấn tượng trước c&aacute;c bạn g&aacute;i.</div>\r\n\r\n<div style="box-sizing: border-box; font-family: Verdana; font-size: 12px;">&nbsp;</div>\r\n\r\n<div style="box-sizing: border-box; font-family: Verdana; font-size: 12px;"><span style="font-family:verdana; font-size:12px">Chất liệu kaki chắc chắn, đẹp, co gi&atilde;n nhẹ. Thiết kế cổ trụ phối đai nam t&iacute;nh, tay d&agrave;i lịch l&atilde;m, lưng &aacute;o được phối n&uacute;t c&aacute; t&iacute;nh, mang lại vẻ đẹp s&agrave;nh điệu cho c&aacute;c bạn nam.</span></div>\r\n', 'tinmoi1.jpg', 1540552634, 2),
(24, 5, ' ÁO THUN NAM CỔ TRỤ GREY', ' Sản phẩm sắp ra', '<p><a href="http://www.mydeal.vn/danh-muc/19/ao-thun-nam.html" style="box-sizing: border-box; color: rgb(85, 85, 85); text-decoration-line: none; outline: none; transition: all 0.3s ease-in-out 0s; font-family: Arial, Tahoma, Verdana; border: 0px; margin: 0px; padding: 0px;" target="_blank">&Aacute;o thun nam</a><span style="font-family:arial,tahoma,verdana">&nbsp;cổ trụ Grey mang lại n&eacute;t trẻ trung, năng động cho ph&aacute;i mạnh. &Aacute;o c&oacute; kiểu d&aacute;ng cổ bẻ xẻ trụ c&agrave;i n&uacute;t, tay ngắn, phối m&agrave;u đa dạng, ph&ugrave; hợp cho bạn mặc khi đi học, đi chơi hay đi l&agrave;m. Điểm nổi bật l&agrave; t&uacute;i &aacute;o, cổ tay, lưng &aacute;o phối m&agrave;u kh&aacute;c nhau, đem lại n&eacute;t hiện đại, c&aacute; t&iacute;nh cho người mặc. Kết hợp c&ugrave;ng quần jeans v&agrave; gi&agrave;y thể thao, bạn đ&atilde; c&oacute; vẻ ngo&agrave;i ấn tượng hơn bao giờ hết.</span></p>\r\n', 'tinmoi2.jpg', 1540553058, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `transaction_id` int(255) NOT NULL,
`id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `delivered` tinyint(3) DEFAULT '2',
  `qty` int(11) NOT NULL DEFAULT '0',
  `name_pr` varchar(200) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`transaction_id`, `id`, `product_id`, `delivered`, `qty`, `name_pr`, `price`, `amount`, `created`) VALUES
(122, 147, 116, 2, 1, 'ÁO-KHOÁC-NAM-AK78', 135000, '135000.0000', 1540553602),
(123, 148, 76, 1, 1, 'Sơ-Mi-Nam-No-Style-TD-Q01', 225000, '225000.0000', 1540553809),
(124, 149, 88, 2, 1, 'ÁO-LEN-KẺ-ĐỎ', 891000, '891000.0000', 1542903047),
(124, 150, 87, 2, 1, 'ÁO-ĐỎ-BO-VIỀN', 700000, '700000.0000', 1542903052),
(125, 151, 87, 2, 1, 'ÁO-ĐỎ-BO-VIỀN', 700000, '700000.0000', 2019),
(126, 152, 114, 2, 1, 'ÁO-KHOÁC-NAM-AK53', 165000, '165000.0000', 2019),
(126, 153, 103, 2, 6, 'ĐỒ-THỂ-THAO-LIVERPOOL', 325000, '1950000.0000', 2019),
(127, 154, 87, 2, 1, 'ÁO-ĐỎ-BO-VIỀN', 700000, '700000.0000', 2019),
(130, 157, 88, 2, 1, 'ÁO-LEN-KẺ-ĐỎ', 891000, '891000.0000', 2019),
(131, 158, 89, 2, 1, 'JUPE-ĐỎ-ĐAI-CẠP', 900600, '900600.0000', 2019),
(132, 159, 114, 2, 1, 'ÁO-KHOÁC-NAM-AK53', 165000, '165000.0000', 2019),
(133, 160, 113, 2, 1, 'ÁO-KHOÁC-NAM-AK49', 111000, '111000.0000', 2019),
(133, 161, 71, 2, 1, 'Áo-Thun-Nam-No-Style-Cổ-Trụ-ST04', 165000, '165000.0000', 2019),
(134, 162, 87, 2, 1, 'ÁO-ĐỎ-BO-VIỀN', 700000, '700000.0000', 2019),
(135, 163, 89, 1, 1, 'JUPE-ĐỎ-ĐAI-CẠP', 900600, '900600.0000', 2019),
(136, 164, 89, 1, 1, 'JUPE-ĐỎ-ĐAI-CẠP', 900600, '900600.0000', 2019),
(137, 165, 88, 1, 3, 'ÁO-LEN-KẺ-ĐỎ', 891000, '2673000.0000', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `image_link` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image_list` text COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `warranty` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(255) NOT NULL,
  `buyed` int(255) NOT NULL,
  `gifts` text COLLATE utf8_unicode_ci NOT NULL,
  `specifications` text COLLATE utf8_unicode_ci NOT NULL,
  `created` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `catalog_id`, `supplier_id`, `name`, `price`, `content`, `discount`, `image_link`, `image_list`, `view`, `warranty`, `total`, `buyed`, `gifts`, `specifications`, `created`) VALUES
(87, 109, 11, ' ÁO ĐỎ BO VIỀN', '700000.0000', '', 0, 'aonu4.jpg', '[]', 13, '', 30, 0, '', '', '2019-11-09'),
(88, 109, 11, ' ÁO LEN KẺ ĐỎ', '900000.0000', '', 1, 'aonu3.jpg', '[]', 2, '', 32, 3, '', '', '2019-11-09'),
(89, 110, 11, '  JUPE ĐỎ ĐAI CẠP', '948000.0000', '', 5, 'chanvay1.jpg', '[]', 3, '', 32, 3, '', '', '2019-11-09'),
(90, 110, 11, '  JUPE TRẮNG DIỄU CHỈ', '998000.0000', '', 0, 'chanvay2.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09'),
(91, 110, 11, ' JUPE ĐEN GẤU REN', '1000000.0000', '', 0, 'chanvay3.jpg', '[]', 0, '', 20, 0, '', '', '2019-11-09'),
(92, 124, 11, 'BỘ LEN TÍM TAY LOE  ', '2500000.0000', '', 0, 'damnu1.jpg', '[]', 0, '', 20, 0, '', '', '2019-11-09'),
(93, 124, 11, ' ĐẦM LEN KẺ ĐEN', '2000000.0000', '', 3, 'damnu2.jpg', '[]', 0, '', 60, 0, '', '', '2019-11-09'),
(94, 124, 11, 'BỘ LEN TRẮNG HỌA TIẾT', '1500000.0000', '', 2, 'damnu4.jpg', '[]', 1, '', 50, 0, '', '', '2019-11-09'),
(95, 124, 11, ' BỘ LEN HT NƠ', '2500000.0000', '', 0, 'damnu3.jpg', '[]', 0, '', 35, 0, '', '', '2019-11-09'),
(96, 116, 11, ' Sport TT33', '600000.0000', '', 0, 'thethaonu1.jpg', '[]', 0, '', 35, 0, '', '', '2019-11-09'),
(97, 116, 11, ' Sport TT34', '550000.0000', '', 0, 'thethaonu2.jpg', '[]', 0, '', 35, 0, '', '', '2019-11-09'),
(98, 116, 11, ' Sport TT35', '400000.0000', '', 0, 'thethaonu3.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09'),
(99, 116, 11, ' Sport TT36', '450000.0000', '', 0, 'thethaonu4.jpg', '[]', 2, '', 35, 0, '', '', '2019-11-09'),
(101, 117, 11, ' Đồ Thể Thao Đồ Thể Thao Real Madrid Legend Tay Dài', '200000.0000', '', 0, 'thethaonam4.jpg', '[]', 0, '', 40, 0, '', '', '2019-11-09'),
(102, 117, 11, ' ĐỒ THỂ THAO EROS - BARCE LEGEND', '250000.0000', '', 2, 'thethaonam3.jpg', '[]', 0, '', 60, 0, '', '', '2019-11-09'),
(103, 117, 11, ' ĐỒ THỂ THAO LIVERPOOL', '325000.0000', '', 0, 'thethaonam2.jpg', '[]', 13, '', 35, 0, '', '', '2019-11-09'),
(109, 123, 11, '  Áo Khoác Da Cổ Cài Nút MS-1974', '3500000.0000', '', 0, 'aokhoacnu2.jpg', '[]', 0, '', 50, 0, '', '', '2019-11-09'),
(110, 123, 11, '  Áo Khoác Kaki Nữ Dáng Dài Cao Cấp Thu Đông AK5896VN', '2000000.0000', '', 0, 'aokhoacnu3.jpg', '[]', 0, '', 40, 0, '', '', '2019-11-09'),
(111, 123, 11, ' Áo Khoác Nữ Kaki Nhúng Eo Cao Cấp Thu Đông AK30067VN-M2 ', '4000000.0000', '', 0, 'aokhoacnu4.jpg', '[]', 0, '', 25, 0, '', '', '2019-11-09'),
(115, 122, 11, '  ÁO KHOÁC NAM AK27', '150000.0000', '', 0, 'aokhoacnam3jpg.jpg', '[]', 2, '', 25, 0, '', '', '2019-11-09'),
(116, 122, 11, '  ÁO KHOÁC NAM AK78  ', '135000.0000', '', 0, 'aokhoacnam4.jpg', '[]', 7, '', 50, 0, '', '', '2019-11-10'),
(108, 123, 11, 'Áo Khoác Nữ Dạ Cao Cấp Thu Đông AK516VN', '2300000.0000', '', 3, 'aokhoacnu12.jpg', '[]', 0, '', 36, 0, '', '', '2019-11-09'),
(85, 109, 11, ' ÁO LEN BE BO GẤU', '800000.0000', '', 0, 'aonu1.jpg', '[]', 1, '', 30, 0, '', '', '2019-11-09'),
(86, 109, 11, '  ÁO LEN HỒNG KT', '798000.0000', '', 0, 'aonu2.jpg', '[]', 1, '', 30, 0, '', '', '2019-11-09'),
(113, 122, 11, ' ÁO KHOÁC NAM AK49', '111000.0000', '', 0, 'aokhoacnam1.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09'),
(114, 122, 11, ' ÁO KHOÁC NAM AK53', '165000.0000', '', 0, 'aokhoacnam2.jpg', '[]', 2, '', 1, 0, '', '', '2019-11-09'),
(112, 123, 11, ' Áo Khoác Nữ Dạ Dáng Dài Phối Lông Cổ Cao Cấp Thu Đông AK5097VN-M2', '2500000.0000', '', 0, 'aokhoacnu5.jpg', '[]', 0, '', 25, 0, '', '', '2019-11-09'),
(73, 112, 11, ' Sơ Mi Nam No Style TD Q03 ', '225000.0000', '', 2, 'aosominam11.jpg', '["bb569191-a3c9-3200-ae03-0013eccb8bc5.jpg"]', 7, '', 25, 0, '', '', '2019-11-09'),
(71, 113, 11, 'Áo Thun Nam No Style Cổ Trụ ST04', '165000.0000', '', 0, 'aothunnam11.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09'),
(72, 112, 13, ' Sơ Mi Nam No Style TD V02', '285000.0000', '', 0, 'aosominam2.jpg', '[]', 0, '', 25, 0, '', '', '2019-11-09'),
(74, 112, 11, ' Sơ Mi Nam No Style TD C35', '225000.0000', '', 0, 'aosominam3.jpg', '[]', 0, '', 25, 0, '', '', '2019-11-09'),
(75, 112, 11, '  Sơ Mi Nam No Style TN Q01 ', '185000.0000', '', 2, 'aosominam4.jpg', '[]', 0, '', 25, 0, '', '', '2019-11-09'),
(76, 112, 11, ' Sơ Mi Nam No Style TD Q01', '225000.0000', '', 0, 'aosominam5.jpg', '[]', 10, '', 23, 2, '', '', '2019-11-09'),
(77, 113, 11, ' Áo Thun Nam No Style Cổ Trụ J01', '165000.0000', '', 1, 'aothunnam2.jpg', '["410043fe-dca7-1f00-12ac-00147194c682.jpg"]', 0, '', 30, 0, '', '', '2019-11-09'),
(78, 113, 11, ' Áo Thun Nam No Style Cổ Trụ O02 ', '165000.0000', '', 1, 'aothunnam3.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09'),
(79, 113, 12, ' Áo Thun Nam No Style Cổ Trụ M01', '165000.0000', '', 1, 'aothunnam4.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09'),
(80, 113, 11, ' Áo Thun Nam No Style Basic TD B01', '185000.0000', '', 2, 'aothunnam5.jpg', '[]', 2, '', 30, 0, '', '', '2019-11-09'),
(81, 114, 11, '  Quần Jean Nam No Style Dài A30', '325000.0000', '', 2, 'quanjeannam1.jpg', '[]', 1, '', 30, 0, '', '', '2019-11-09'),
(82, 114, 11, ' Quần Jean Nam No Style Dài A14', '325000.0000', '', 0, 'quanjeannam2.jpg', '[]', 1, '', 30, 0, '', '', '2019-11-09'),
(83, 114, 11, ' Quần Jean Nam No Style Dài A37', '325000.0000', '', 3, 'quanjeannam3.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09'),
(84, 114, 11, ' Quần Jean Nam No Style Dài A31', '350000.0000', '', 0, 'quanjeannam4.jpg', '[]', 0, '', 30, 0, '', '', '2019-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `roles`, `created_at`) VALUES
(1, 'Subper admin', 'Subper admin', 0, '2018-10-14 06:43:56'),
(2, 'Admin', 'Admin', 0, '2018-10-14 06:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
`id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `name`, `image_link`, `link`, `sort_order`) VALUES
(11, ' slide 2', 'banner_silder_3.jpg', ' ', 2),
(12, ' slide 3', 'banner_silder_4.jpg', ' ', 3),
(13, ' slide5', 'slider5.jpg', ' ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
`id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `phone`, `email`, `fax`, `status`, `created_at`) VALUES
(11, 'Công Ty TNHH May Mặc Dony', 'Xưởng May: 355/23 Kênh Tân Hóa, Q. Tân Phú, Tp. HCM', '02862675818', 'dony@gmail.com', '', 0, '2018-10-13 04:12:28'),
(12, 'Donysty', '37 Chu Văn An q Bình Thạnh ', '016895021564', 'dony21@gmail.com', '', 0, '2018-10-13 12:06:04'),
(13, 'Elisa', '24 Lê văn Quyết', '01247845687', 'elisa@gmail.com', '42424', 1, '2018-10-26 07:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
`id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `payment` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_bin NOT NULL,
  `Transport` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `security` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `status`, `user_id`, `user_name`, `user_email`, `user_phone`, `address`, `amount`, `payment`, `message`, `Transport`, `security`, `created`) VALUES
(122, 1, 31, 'Nguyễn Thành Nhân', 'nguyenthanhnhan@gmail.com', '01245789635', '84 Tôn Thất Huyết', '135000.0000', 'Sau khi nhận được hàng', '', 'Chuyển phát nhanh', '', '2018-10-26'),
(123, 1, 31, 'Nguyễn Thành Nhân', 'nguyenthanhnhan@gmail.com', '01245789635', '84 Tôn Thất Huyết', '225000.0000', 'Sau khi nhận được hàng', '', 'Chuyển phát nhanh', '', '2018-10-26'),
(124, 2, 30, 'nguyễn hoàng  hưng', 'hoanghungnguyen03@gmail.com', '01678346386', '355 Chu Văn An p12 q Bình Thạnh ', '1591000.0000', 'Sau khi nhận được hàng', '', 'Chuyển phát nhanh', '', '2018-11-22'),
(125, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '700000.0000', 'Sau khi nhận được hàng', ' ', 'Chuyển phát nhanh', '', '2019-11-08'),
(126, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '2115000.0000', 'Sau khi nhận được hàng', ' ', 'Giao hàng tiêu chuẩn', '', '2019-11-09'),
(127, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '700000.0000', 'Sau khi nhận được hàng', ' ', 'Giao hàng tiêu chuẩn', '', '2019-11-09'),
(128, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '730000.0000', 'Sau khi nhận được hàng', ' ', 'Chuyển phát nhanh', '', '2019-11-09'),
(129, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '730000.0000', 'Sau khi nhận được hàng', ' ', 'Chuyển phát nhanh', '', '2019-11-09'),
(130, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '921000.0000', 'Sau khi nhận được hàng', ' ', 'Chuyển phát nhanh', '', '2019-11-09'),
(131, 2, 0, 'Test', 'duocnvoit@gmail.com', '1659020898', 'thái bình', '900600.0000', 'Sau khi nhận được hàng', '  ', 'Giao hàng tiêu chuẩn', '', '2019-11-09'),
(132, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '195000.0000', 'ngan_luong', '  ', 'Chuyển phát nhanh', '', '2019-11-09'),
(133, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '306000.0000', 'ngan_luong', ' ', 'Chuyển phát nhanh', '', '2019-11-09'),
(134, 2, 0, 'NGuyễn Văn Dược', 'test@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '730000.0000', 'Sau khi nhận được hàng', ' ', 'Chuyển phát nhanh', '', '2019-11-09'),
(135, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '930600.0000', 'ngan_luong', ' ', 'Chuyển phát nhanh', '', '2019-11-09'),
(136, 2, 0, 'NGuyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình, Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '930600.0000', 'Sau khi nhận được hàng', ' ', 'Chuyển phát nhanh', '', '2019-11-09'),
(137, 1, 34, 'Nguyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', '2703000.0000', 'Sau khi nhận được hàng', 'giao hàng', 'Chuyển phát nhanh', '', '2019-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(255) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(5) NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `user_name`, `email`, `phone`, `address`, `sex`, `password`, `status`, `created`) VALUES
(33, 'nguyễn khang hưng', 'Khang Hưng', 'nguyenkhanghung@gmail.com', '016895021564', '25abc', 1, '25f9e794323b453885f5181f1b624d0b', NULL, 1540554591),
(31, 'Nguyễn Thành Nhân', 'Nguyễn Thành Nhân', 'nguyenthanhnhan@gmail.com', '01245789635', '84 Tôn Thất Huyết', 1, '25f9e794323b453885f5181f1b624d0b', NULL, 1540537984),
(30, 'nguyễn hưng', 'nguyễn hoàng  hưng', 'hoanghungnguyen03@gmail.com', '01678346386', '355 Chu Văn An p12 q Bình Thạnh ', 1, '25d55ad283aa400af464c76d713c07ad', NULL, 1540535405),
(34, 'duocnv', 'Nguyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', 'Thôn Nội Thôn Xã Tây Đô Huyện Hưng Hà Tỉnh Thái Bình', 0, '25d55ad283aa400af464c76d713c07ad', NULL, 1573354573);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
 ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `newcategory`
--
ALTER TABLE `newcategory`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`), ADD KEY `index` (`newcatalog_id`), ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_2` (`id`), ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `id` int(128) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `newcategory`
--
ALTER TABLE `newcategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
