-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 10:31 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techspecs`
--

-- --------------------------------------------------------

--
-- Table structure for table `ts_adminuser`
--

CREATE TABLE `ts_adminuser` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_adminuser`
--

INSERT INTO `ts_adminuser` (`id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '123456', 'Active', '2017-09-17 00:00:00', '2017-09-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ts_attribute`
--

CREATE TABLE `ts_attribute` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` varchar(255) NOT NULL,
  `attribute_details` varchar(255) DEFAULT NULL,
  `view_type` enum('Normal','Color','Box Type','Double Column') NOT NULL DEFAULT 'Normal',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_attribute`
--

INSERT INTO `ts_attribute` (`id`, `category_id`, `parent_id`, `attribute_name`, `attribute_value`, `attribute_details`, `view_type`, `created_at`) VALUES
(2, 1, 0, 'Design', '', NULL, 'Normal', '2017-09-29 07:34:18'),
(3, 1, 2, 'Width', '65.44 mm', NULL, 'Normal', '2017-09-29 07:35:30'),
(4, 1, 2, 'Height', '75 mm', NULL, 'Normal', '2017-09-29 07:36:06'),
(5, 1, 0, 'Network', '', NULL, 'Normal', '2017-09-29 07:39:42'),
(6, 1, 5, 'GSM', '850 Mz', 'LTE band 1(2100), 2(1900), 3(1800), 4(1700/2100), 5(850), 7(2600), 8(900), 12(700), ', 'Normal', '2017-09-29 07:40:08'),
(7, 3, 0, 'Type', '', NULL, 'Normal', '2017-09-29 15:39:04'),
(8, 3, 7, 'Screen', 'LCD', NULL, 'Normal', '2017-09-29 15:39:59'),
(9, 1, 0, 'Camera', '', '', 'Double Column', '2017-10-10 20:18:42'),
(10, 1, 9, 'Primary', '12 MP', NULL, 'Normal', '2017-10-10 20:19:14'),
(11, 1, 9, 'Secondary', '8 MP', NULL, 'Normal', '2017-10-10 20:19:53'),
(12, 1, 9, 'Video', '1080px', NULL, 'Normal', '2017-10-10 20:20:24'),
(13, 3, 0, 'Display', '', NULL, 'Normal', '2017-10-12 22:10:04'),
(15, 3, 13, 'LED', 'LED', NULL, 'Normal', '2017-10-12 22:11:55'),
(16, 1, 9, 'Camera', '5 MP', NULL, 'Normal', '2017-10-13 20:27:04'),
(17, 6, 7, 'Cable', 'Wired', NULL, 'Normal', '2017-10-15 19:34:06'),
(18, 6, 0, 'Wired Headphone', '', NULL, 'Normal', '2017-10-15 19:36:28'),
(19, 6, 18, 'Cable', '10 F', NULL, 'Normal', '2017-10-16 17:59:29'),
(20, 6, 18, 'Bass', 'Yes', NULL, 'Normal', '2017-10-16 18:19:30'),
(21, 1, 0, 'Device color', '', '', 'Color', '2017-10-17 19:06:24'),
(22, 1, 21, '', 'Red', NULL, 'Normal', '2017-10-17 19:06:44'),
(23, 1, 21, '', 'Gray', NULL, 'Normal', '2017-10-17 19:07:35'),
(24, 1, 21, '', 'Silver', NULL, 'Normal', '2017-10-17 19:08:43'),
(25, 1, 21, '', 'Black', NULL, 'Normal', '2017-10-17 19:09:07'),
(27, 7, 0, 'Power', '', '', 'Normal', '2017-10-17 21:20:35'),
(28, 7, 27, '', '100KW', '', 'Normal', '2017-10-17 22:39:23'),
(29, 0, 0, 'Storage', '', '', 'Box Type', '2017-10-20 20:16:03'),
(30, 0, 29, '', '512 GB', '', 'Normal', '2017-10-20 20:16:31'),
(31, 0, 29, '', '1 TB', '', 'Normal', '2017-10-20 20:16:58'),
(32, 0, 29, '', '2 TB', '1 TB', 'Normal', '2017-10-20 20:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `ts_category`
--

CREATE TABLE `ts_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `category_name` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_category`
--

INSERT INTO `ts_category` (`id`, `parent_id`, `category_name`, `slug`, `image_name`, `status`, `added_date`) VALUES
(1, 0, 'Smart Phones', 'smart-phones', '', 'Active', '2017-09-19 19:20:18'),
(2, 1, 'Samsung', 'samsung', NULL, 'Active', '2017-09-19 19:20:45'),
(4, 1, 'Smart Phone', 'smart-phone', '925460785399c118d75c1831a46a4492.jpg', 'Active', '2017-09-30 20:40:26'),
(6, 0, 'Headphone', 'headphone', '02d3a99ddf5a0e4427440955a1bbd0a4.png', 'Active', '2017-09-30 20:48:40'),
(8, 6, 'Samsung', 'samsung-1', '', 'Active', '2017-10-05 20:37:15'),
(9, 1, 'Sony', 'sony', 'e00a0c8e7ec162f880bcbc86adb88171.jpg', 'Active', '2017-10-15 19:38:49'),
(12, 6, 'Sony', 'sony-2', '669bca8530c779a0afffe17d032aa1f3.jpg', 'Active', '2017-10-15 21:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `ts_cms`
--

CREATE TABLE `ts_cms` (
  `id` int(11) NOT NULL,
  `cms_title` varchar(50) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `cms_content` longtext NOT NULL,
  `cms_image` varchar(255) NOT NULL,
  `cms_meta_title` varchar(255) NOT NULL,
  `cms_meta_key` text NOT NULL,
  `cms_meta_desc` text NOT NULL,
  `cms_status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ts_cms`
--

INSERT INTO `ts_cms` (`id`, `cms_title`, `slug`, `cms_content`, `cms_image`, `cms_meta_title`, `cms_meta_key`, `cms_meta_desc`, `cms_status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', 'about us', 'about us', 'about us', '1', '2017-02-04 00:00:00', '2017-10-15 21:15:04'),
(2, 'Terms and conditions', 'terms-and-conditions', '<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '', 'terms and conditions', 'terms and conditions', 'terms and conditions', '1', '2017-02-04 00:00:00', '2017-10-15 21:09:10'),
(3, 'Privacy Policy', 'privacy-policy', '<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '1', '2017-02-04 00:00:00', '2017-10-15 21:09:27'),
(4, 'Contact Us', 'contact-us', '', '', '', '', '', '1', '0000-00-00 00:00:00', '2017-10-15 18:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `ts_product`
--

CREATE TABLE `ts_product` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `product_code` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_product`
--

INSERT INTO `ts_product` (`id`, `parent_id`, `category_id`, `product_name`, `slug`, `product_code`, `description`, `is_featured`, `status`, `created_at`) VALUES
(1, 1, 2, 'nmnm', 'nmnm', 'vjhghg', '', 'No', 'Active', '2017-09-19 20:26:36'),
(2, 6, 8, 'Samsung Super Sound', 'samsung-super-sound', 'sds', 'hgfhjm', 'Yes', 'Active', '2017-10-01 07:12:22'),
(3, 1, 2, 'Samsung On nxt', 'samsung-on-nxt', 'NXT234', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Yes', 'Active', '2017-10-04 22:58:53'),
(4, 6, 8, 'Samsung ', 'samsung', 'SMG', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'No', 'Active', '2017-10-04 23:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `ts_product_attribute`
--

CREATE TABLE `ts_product_attribute` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_product_attribute`
--

INSERT INTO `ts_product_attribute` (`id`, `product_id`, `attribute_id`) VALUES
(5, 1, 3),
(6, 1, 6),
(7, 1, 10),
(8, 1, 11),
(17, 2, 19),
(18, 2, 20),
(19, 4, 19),
(69, 3, 3),
(70, 3, 4),
(71, 3, 6),
(72, 3, 10),
(73, 3, 11),
(74, 3, 12),
(75, 3, 16),
(76, 3, 22),
(77, 3, 23),
(78, 3, 24),
(79, 3, 25),
(80, 3, 30),
(81, 3, 31);

-- --------------------------------------------------------

--
-- Table structure for table `ts_product_image`
--

CREATE TABLE `ts_product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `is_featured` enum('Yes','No') NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_product_image`
--

INSERT INTO `ts_product_image` (`id`, `product_id`, `image_name`, `is_featured`, `created_at`) VALUES
(2, 1, '4c749e3e1b3bfbd0018df1776754a6cb.jpg', 'Yes', '2017-09-28 21:26:53'),
(3, 1, 'f6d58d204057511e806ec5a4056980f2.jpg', 'No', '2017-10-10 21:38:20'),
(5, 1, '0ec61474b84aa5c8fe7f6ba93d3600ea.jpg', 'No', '2017-10-10 21:38:20'),
(6, 1, 'd34d9e4071e8457117e0bc26aec90875.jpg', 'No', '2017-10-10 21:38:20'),
(7, 3, '7ae7424d1f59c2d3dad8286cb1340e83.jpg', 'Yes', '2017-10-15 19:27:44'),
(8, 3, 'b92e8703175c6b930753aac61620ff10.jpg', 'No', '2017-10-15 19:27:44'),
(9, 3, 'b1bbfc57f65c3077fac9272a36407cbf.jpg', 'No', '2017-10-15 19:27:44'),
(10, 3, 'a96604fda8e3749f905020a07a280b53.jpg', 'No', '2017-10-15 19:27:44'),
(11, 4, '4322413eb04c2854ddc447b73202c4be.jpg', 'Yes', '2017-10-15 19:28:20'),
(12, 4, '18699ef88f89badf38051376a0afe5fd.jpg', 'No', '2017-10-15 19:28:20'),
(13, 2, 'ce4b32314e4574c83e670fe3a80377a2.png', 'Yes', '2017-10-15 21:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `ts_search_key`
--

CREATE TABLE `ts_search_key` (
  `id` int(11) NOT NULL,
  `search_key` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_search_key`
--

INSERT INTO `ts_search_key` (`id`, `search_key`, `created_at`) VALUES
(1, 'Samsung On nxt', '2017-10-15 19:21:14'),
(2, 'aaa', '2017-10-15 21:59:48'),
(3, 'aaa', '2017-10-15 22:05:05'),
(4, 'aaa', '2017-10-15 22:06:14'),
(5, 'aaa', '2017-10-15 22:39:32'),
(6, 'aaa', '2017-10-15 22:40:50'),
(7, 'aaa', '2017-10-15 23:32:25'),
(8, 'aaa', '2017-10-15 23:33:52'),
(9, 'aaa', '2017-10-15 23:34:07'),
(10, 'aaa', '2017-10-15 23:34:14'),
(11, 'aaa', '2017-10-15 23:34:32'),
(12, 'aaa', '2017-10-15 23:34:53'),
(13, 'Samsung On nxt', '2017-10-15 19:21:15'),
(14, 'Samsung ', '2017-10-15 19:32:20'),
(15, 'Samsung ', '2017-10-15 19:37:25'),
(16, 'Samsung On nxt', '2017-10-15 19:38:04'),
(17, 'aaa', '2017-10-15 19:43:45'),
(18, 'Samsung ', '2017-10-15 19:44:06'),
(19, 'Samsung ', '2017-10-15 19:46:23'),
(20, 'Samsung ', '2017-10-15 19:47:36'),
(21, 'Samsung ', '2017-10-15 20:09:43'),
(22, 'Samsung ', '2017-10-15 20:37:47'),
(23, 'Samsung ', '2017-10-15 21:04:42'),
(24, 'Samsung Super Sound', '2017-10-16 18:59:08'),
(25, 'Samsung Super Sound', '2017-10-16 18:59:36'),
(26, 'Samsung Super Sound', '2017-10-16 19:45:50'),
(27, 'Samsung Super Sound', '2017-10-16 20:23:47'),
(28, 'Samsung Super Sound', '2017-10-16 20:26:54'),
(29, 'Samsung Super Sound', '2017-10-16 20:27:53'),
(30, 'Samsung Super Sound', '2017-10-16 20:27:53'),
(31, 'Samsung Super Sound', '2017-10-16 20:27:53'),
(32, 'Samsung Super Sound', '2017-10-16 20:27:53'),
(33, 'Samsung Super Sound', '2017-10-16 20:27:53'),
(34, 'Samsung Super Sound', '2017-10-16 20:27:54'),
(35, 'Samsung Super Sound', '2017-10-16 20:27:54'),
(36, 'Samsung Super Sound', '2017-10-16 20:27:54'),
(37, 'Samsung Super Sound', '2017-10-16 20:27:54'),
(38, 'Samsung Super Sound', '2017-10-16 20:27:54'),
(39, 'Samsung Super Sound', '2017-10-16 20:27:54'),
(40, 'Samsung Super Sound', '2017-10-16 20:28:12'),
(41, 'Samsung Super Sound', '2017-10-16 20:30:24'),
(42, 'Samsung Super Sound', '2017-10-16 20:31:04'),
(43, 'Samsung On nxt', '2017-10-23 17:06:32'),
(44, 'samss', '2017-11-19 21:34:36'),
(45, 'dffs', '2017-11-21 00:42:51'),
(46, 'fdf', '2017-11-21 00:43:00'),
(47, 'fdf', '2017-11-21 00:56:10'),
(48, 'dffs', '2017-11-21 00:58:13'),
(49, 'dffs', '2017-11-21 00:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `ts_sitesettings`
--

CREATE TABLE `ts_sitesettings` (
  `id` int(5) NOT NULL,
  `sitesettings_name` varchar(255) NOT NULL,
  `sitesettings_type` enum('TEXT','COMBO','CHECKBOX','TEXTAREA','SELECT','IMG') NOT NULL DEFAULT 'TEXT',
  `sitesettings_data_type` enum('TEXT','NUMERIC') NOT NULL DEFAULT 'TEXT',
  `sitesettings_lebel` varchar(255) NOT NULL,
  `sitesettings_value` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ts_sitesettings`
--

INSERT INTO `ts_sitesettings` (`id`, `sitesettings_name`, `sitesettings_type`, `sitesettings_data_type`, `sitesettings_lebel`, `sitesettings_value`, `status`, `last_updated_on`) VALUES
(1, 'webmaster_email', 'TEXT', 'TEXT', 'Webmaster Email', 'buieee2010@gmail.com', 'active', '2016-12-30 01:58:41'),
(2, 'home_page_content', 'TEXT', 'TEXT', 'Home Page Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'active', '2017-10-20 14:25:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_adminuser`
--
ALTER TABLE `ts_adminuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_attribute`
--
ALTER TABLE `ts_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_category`
--
ALTER TABLE `ts_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_cms`
--
ALTER TABLE `ts_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_product`
--
ALTER TABLE `ts_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_product_attribute`
--
ALTER TABLE `ts_product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_product_image`
--
ALTER TABLE `ts_product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_search_key`
--
ALTER TABLE `ts_search_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_sitesettings`
--
ALTER TABLE `ts_sitesettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_adminuser`
--
ALTER TABLE `ts_adminuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ts_attribute`
--
ALTER TABLE `ts_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `ts_category`
--
ALTER TABLE `ts_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ts_cms`
--
ALTER TABLE `ts_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_product`
--
ALTER TABLE `ts_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_product_attribute`
--
ALTER TABLE `ts_product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `ts_product_image`
--
ALTER TABLE `ts_product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ts_search_key`
--
ALTER TABLE `ts_search_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `ts_sitesettings`
--
ALTER TABLE `ts_sitesettings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
