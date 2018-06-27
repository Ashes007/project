-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 10:28 PM
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
-- Database: `website`
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
(2, 'Terms and Conditions', 'terms-and-conditions', '<p>Why do we use it?</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Why do we use it?</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Why do we use it?</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '', 'terms and conditions', 'terms and conditions', 'terms and conditions', '1', '2017-02-04 00:00:00', '2018-06-27 17:46:10'),
(3, 'Privacy Policy', 'privacy-policy', '<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<h4>Why do we use it?</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '1', '2017-02-04 00:00:00', '2017-10-15 21:09:27'),
(4, 'Contact Us', 'contact-us', '', '', '', '', '', '1', '0000-00-00 00:00:00', '2017-10-15 18:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `ts_post`
--

CREATE TABLE `ts_post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float(12,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ts_post`
--

INSERT INTO `ts_post` (`id`, `title`, `description`, `price`, `location`, `email`, `image_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'aa', 'dfdf', 23.00, 'rtwtr', 'wrt', NULL, 'Inactive', '2018-06-27 16:57:07', NULL),
(2, 'aa', 'fadsf', 23.00, 'rtwtr', 'wrt', '8addb1c963db748c465a8ffb6fab9291.jpg', 'Inactive', '2018-06-27 16:57:28', NULL);

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
-- Indexes for table `ts_cms`
--
ALTER TABLE `ts_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_post`
--
ALTER TABLE `ts_post`
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
-- AUTO_INCREMENT for table `ts_cms`
--
ALTER TABLE `ts_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_post`
--
ALTER TABLE `ts_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ts_sitesettings`
--
ALTER TABLE `ts_sitesettings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
