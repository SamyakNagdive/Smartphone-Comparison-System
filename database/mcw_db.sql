-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2022 at 09:10 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcw_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `order_by` int(30) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `order_by`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Basic Specs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet iaculis justo, vitae suscipit velit. Vestibulum sed euismod purus. Curabitur ac lacus congue, ultrices est quis, dapibus lacus. Nullam ut arcu vitae ligula semper tristique vitae nec risus. Morbi non vulputate leo, eget sollicitudin leo. Donec bibendum dolor at ullamcorper aliquam. Aliquam mollis iaculis varius. In nunc massa, accumsan in nisl ac, molestie auctor nisl. Praesent felis lacus, dapibus vel rutrum vitae, aliquet eu ligula.', 1, 1, 0, '2022-02-21 10:18:23', '2022-02-21 14:01:37'),
(2, 'Pricing', 'Praesent neque justo, mattis in venenatis dapibus, ornare ac leo. Ut ut posuere sem, ac hendrerit felis. Quisque non volutpat lorem, nec rhoncus tortor. Proin et libero varius, accumsan mi et, tristique massa. Phasellus dapibus volutpat velit finibus accumsan. Suspendisse accumsan arcu sit amet sapien ultrices vehicula. Nunc lacus metus, laoreet ut leo eu, euismod porttitor odio. Ut sit amet tempus ipsum.', 6, 1, 0, '2022-02-21 10:21:13', '2022-02-21 11:00:16'),
(3, 'Type', 'Donec maximus feugiat tortor, non semper lacus dignissim non. Integer vitae posuere massa. Nullam vel erat ornare, sagittis ex eu, blandit sem. Nulla ac nunc non nisi vehicula luctus. Nulla malesuada sollicitudin est, et mollis mi luctus at. Vivamus euismod metus mauris, vitae finibus sem vulputate sed.', 0, 1, 0, '2022-02-21 10:21:39', '2022-02-21 14:01:37'),
(4, 'Screen', 'Quisque erat justo, semper sed neque quis, dictum tempor magna. Aliquam erat volutpat. Sed pharetra vitae tellus quis pretium. Praesent venenatis ligula vitae risus scelerisque porttitor.', 4, 1, 0, '2022-02-21 10:22:29', '2022-02-21 11:00:16'),
(5, 'Network', 'Nam commodo dignissim nulla, eget elementum odio porttitor ac. Phasellus interdum, nulla in commodo pharetra, lorem lacus tristique quam, eget luctus urna orci viverra dui. Etiam congue ullamcorper erat, eu elementum risus aliquam posuere. Sed posuere ante ac elit dapibus sollicitudin. Quisque dui nunc, scelerisque non ipsum ac, tempus malesuada leo.', 2, 1, 0, '2022-02-21 10:22:52', '2022-02-21 14:01:37'),
(6, 'Camera', 'Duis quis urna ut eros imperdiet auctor sit amet sed velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris quis velit lorem. Donec vitae erat ante. Quisque ornare sed nisi id sodales. Donec condimentum condimentum turpis ac suscipit. Maecenas ut eleifend ex.', 5, 1, 0, '2022-02-21 10:23:03', '2022-02-21 11:00:16'),
(7, 'Size', 'Duis quis urna ut eros imperdiet auctor sit amet sed velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris quis velit lorem. Donec vitae erat ante. Quisque ornare sed nisi id sodales. Donec condimentum condimentum turpis ac suscipit. Maecenas ut eleifend ex.', 3, 1, 0, '2022-02-21 10:23:20', '2022-02-21 11:00:16'),
(9, 'test', '123', 1, 1, 1, '2022-02-21 10:29:52', '2022-02-21 10:30:04'),
(10, 'OTHERS', 'Otheri Information', 7, 1, 0, '2022-02-21 11:45:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `field_list`
--

CREATE TABLE `field_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `order_by` int(30) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `field_list`
--

INSERT INTO `field_list` (`id`, `category_id`, `name`, `description`, `order_by`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 3, 'TYPE', 'Type of device', 0, 1, 0, '2022-02-21 11:19:41', NULL),
(2, 3, 'Shape', 'The shape of the device.', 1, 1, 0, '2022-02-21 11:20:01', '2022-02-21 12:04:38'),
(3, 1, 'OS', 'Mobile Operating System', 0, 1, 0, '2022-02-21 11:20:19', NULL),
(4, 1, 'OS VERSION', 'Device\'s Operating System Version', 1, 1, 0, '2022-02-21 11:21:37', '2022-02-21 12:03:38'),
(5, 1, 'SIM', 'Sim Slot', 2, 1, 0, '2022-02-21 11:22:28', '2022-02-21 12:03:38'),
(6, 1, 'CPU', 'Device\'s Central Processing Unit', 3, 1, 0, '2022-02-21 11:23:29', '2022-02-21 12:03:38'),
(7, 1, 'CPU SPEED', 'Central Processing Unit Speed', 4, 1, 0, '2022-02-21 11:23:54', '2022-02-21 12:03:38'),
(8, 1, 'STORAGE', 'Device\'s Storage', 5, 1, 0, '2022-02-21 11:24:08', '2022-02-21 12:03:38'),
(9, 1, 'CHIPSET', 'Device\'s Chipset', 6, 1, 0, '2022-02-21 11:24:48', '2022-02-21 12:03:38'),
(10, 1, 'RAM', 'Device\'s Random-Access Memory', 7, 1, 0, '2022-02-21 11:25:08', '2022-02-21 12:03:38'),
(11, 1, 'EXTERNAL STORAGE', 'Device\'s External Storage', 8, 1, 0, '2022-02-21 11:35:57', '2022-02-21 12:03:38'),
(12, 1, 'BATTERY', 'Device\'s Baterry Information', 9, 1, 0, '2022-02-21 11:36:18', '2022-02-21 12:03:38'),
(13, 4, 'DISPLAY SIZE', 'Device\'s Display Size', 0, 1, 0, '2022-02-21 11:36:55', NULL),
(14, 4, 'RESOLUTION', 'Device\'s Resolution', 1, 1, 0, '2022-02-21 11:37:24', '2022-02-21 12:04:51'),
(15, 5, 'TYPE', 'Device\'s network types', 0, 1, 0, '2022-02-21 11:38:32', NULL),
(16, 5, '2G', 'Device\'s 2G info.', 1, 1, 0, '2022-02-21 11:38:53', '2022-02-21 12:04:32'),
(17, 5, '3G', 'Device\'s 3G info.', 2, 1, 0, '2022-02-21 11:38:59', '2022-02-21 12:04:32'),
(18, 5, '4G', 'Device\'s 4G info.', 3, 1, 0, '2022-02-21 11:39:07', '2022-02-21 12:04:32'),
(19, 5, '5G', 'Device\'s 5G info.', 4, 1, 0, '2022-02-21 11:40:35', '2022-02-21 12:04:32'),
(20, 5, 'SPEED', 'Device\'s network speed.', 5, 1, 0, '2022-02-21 11:40:59', '2022-02-21 12:04:32'),
(21, 6, 'MAIN CAMERA', 'Device\'s main camera information', 0, 1, 0, '2022-02-21 11:41:38', NULL),
(22, 6, 'FEATURES', 'Device\'s camera features', 1, 1, 0, '2022-02-21 11:41:54', '2022-02-21 12:05:02'),
(23, 6, 'VIDEO', 'Device\'s  video Info', 2, 1, 0, '2022-02-21 11:42:13', '2022-02-21 12:05:02'),
(24, 6, 'FRONT CAMERA', 'Device\'s  Front Cam Info', 3, 1, 0, '2022-02-21 11:42:32', '2022-02-21 12:05:02'),
(25, 6, 'FRONT CAM FEATURE', 'Device\'s  Front Cam Information.', 4, 1, 0, '2022-02-21 11:43:38', '2022-02-21 12:05:02'),
(26, 6, 'FRONT CAM VIDEO', 'Device\'s  Front Cam Video info.', 5, 1, 0, '2022-02-21 11:43:57', '2022-02-21 12:05:02'),
(27, 7, 'DIMENSIONS', 'Device\'s  Dimension', 0, 1, 0, '2022-02-21 11:44:33', NULL),
(28, 7, 'WEIGHT', 'Device\'s weight.', 1, 1, 0, '2022-02-21 11:44:56', '2022-02-21 12:04:43'),
(29, 10, 'More Feature', 'Other Information', 0, 1, 0, '2022-02-21 11:46:17', NULL),
(30, 10, 'test', 'test', 1, 1, 1, '2022-02-21 11:50:55', '2022-02-21 13:26:45'),
(32, 2, 'PRICE', 'Device Suggester Selling Price', 1, 1, 0, '2022-02-21 12:07:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_list`
--

CREATE TABLE `mobile_list` (
  `id` int(30) NOT NULL,
  `model` text NOT NULL,
  `brand` text NOT NULL,
  `display_content` text NOT NULL,
  `thumbnail_path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobile_list`
--

INSERT INTO `mobile_list` (`id`, `model`, `brand`, `display_content`, `thumbnail_path`, `status`, `date_created`, `date_updated`) VALUES
(2, 'Redmi Note 11 Pro 5G', ' Xiaomi', '&lt;h2 class=&quot;has-text-align-center&quot; id=&quot;here-s-the-complete-list-of-specifications-features-price-of-the-xiaomi-redmi-note-11-pro-5g&quot; style=&quot;margin: 47px 0px 18px; padding: 0px; overflow-wrap: break-word; text-align: center; color: rgb(17, 17, 17); font-size: 29px; line-height: 44px; font-family: Candara, Verdana, sans-serif;&quot;&gt;Here&rsquo;s The Complete List of Specifications, Features, &amp;amp; Price of the Xiaomi Redmi Note 11 Pro 5G&lt;/h2&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The Xiaomi Redmi Note 11 Pro 5G was officially announced on January 26, 2022, and released on February 18, 2022. The smartphone is fueled with a non-removable Li-Po 5000 mAh battery + Fast charging 67W + Power Delivery 3.0 + Quick Charge 3+. It is available in three colors: Graphite Gray, Polar White, and Atlantic Blue.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;Body &amp;amp; Display:&lt;/strong&gt;&lt;/p&gt;&lt;div class=&quot;code-block code-block-3&quot; style=&quot;margin: 8px auto; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px; text-align: center; clear: both;&quot;&gt;&lt;ins class=&quot;adPushupAds&quot; data-adpcontrol=&quot;1v4kp&quot; data-ver=&quot;2&quot; data-siteid=&quot;38386&quot; data-ac=&quot;PHNjcmlwdCBhc3luYyBzcmM9Ii8vcGFnZWFkMi5nb29nbGVzeW5kaWNhdGlvbi5jb20vcGFnZWFkL2pzL2Fkc2J5Z29vZ2xlLmpzIj48L3NjcmlwdD4KPCEtLSBQTjJuZFBhcmFncmFwaCAtLT4KPGlucyBjbGFzcz0iYWRzYnlnb29nbGUgbWlkYm90YWRzIgogICAgIHN0eWxlPSJkaXNwbGF5OmlubGluZS1ibG9jayIKICAgICBkYXRhLWFkLWNsaWVudD0iY2EtcHViLTAzMzU2MzUyOTc3ODk0NTEiCiAgICAgZGF0YS1hZC1zbG90PSI2NTQ5Mzk5MzE3IgogICAgIGRhdGEtZnVsbC13aWR0aC1yZXNwb25zaXZlPSJ0cnVlIj48L2lucz4KPHNjcmlwdD4KKGFkc2J5Z29vZ2xlID0gd2luZG93LmFkc2J5Z29vZ2xlIHx8IFtdKS5wdXNoKHt9KTsKPC9zY3JpcHQ+&quot; data-push=&quot;1&quot; style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;&lt;/ins&gt;&lt;/div&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The dimension of the 5G-ready smartphone is 164.2 x 76.1 x 8.1 mm and weighs 202 grams. It is built with a glass front (Gorilla Glass 5) and a glass back. It features a 6.67 inches screen size and the display is Super AMOLED capacitive touchscreen that provides 1080 x 2400 pixels resolution.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;Platform:&lt;/strong&gt;&lt;/p&gt;&lt;div class=&quot;code-block code-block-4&quot; style=&quot;margin: 8px auto; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px; text-align: center; clear: both;&quot;&gt;&lt;ins class=&quot;adPushupAds&quot; data-adpcontrol=&quot;en6ne&quot; data-ver=&quot;2&quot; data-siteid=&quot;38386&quot; data-ac=&quot;PHNjcmlwdCBhc3luYyBzcmM9Ii8vcGFnZWFkMi5nb29nbGVzeW5kaWNhdGlvbi5jb20vcGFnZWFkL2pzL2Fkc2J5Z29vZ2xlLmpzIj48L3NjcmlwdD4KPCEtLSBQTjNyZFBhcmFncmFwaCAtLT4KPGlucyBjbGFzcz0iYWRzYnlnb29nbGUgbWlkYm90YWRzIgogICAgIHN0eWxlPSJkaXNwbGF5OmlubGluZS1ibG9jayIKICAgICBkYXRhLWFkLWNsaWVudD0iY2EtcHViLTAzMzU2MzUyOTc3ODk0NTEiCiAgICAgZGF0YS1hZC1zbG90PSI5OTg1NjU2NDEwIgogICAgIGRhdGEtZnVsbC13aWR0aC1yZXNwb25zaXZlPSJ0cnVlIj48L2lucz4KPHNjcmlwdD4KKGFkc2J5Z29vZ2xlID0gd2luZG93LmFkc2J5Z29vZ2xlIHx8IFtdKS5wdXNoKHt9KTsKPC9zY3JpcHQ+&quot; data-push=&quot;1&quot; style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;&lt;/ins&gt;&lt;/div&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;Redmi Note 11 Pro 5G runs on the Android 11 + MIUI 13 operating system. It is powered by the Qualcomm SM6375 Snapdragon 695 5G (6 nm) Octa-core processor while the graphics processing unit (GPU) is Adreno 619.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The smartphone comes in variants such as 64GB + 6GB RAM, 128GB + 6GB RAM, and 128GB + 8GB RAM. It also supports expandable microSD storage up to 1TB.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;a href=&quot;https://philnews.ph/2022/02/20/xiaomi-redmi-note-11-pro-5g-specs-features-price-philippines/&quot; target=&quot;_blank&quot;&gt;Data Source: Philnews&lt;/a&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/thumbnails/2.png?v=1645423990', 1, '2022-02-21 14:13:10', '2022-02-21 14:13:10'),
(3, 'Redmi K50 Gaming', 'Xiaomi', '&lt;h2 class=&quot;has-text-align-center&quot; id=&quot;here-s-the-complete-list-of-specifications-features-price-of-the-xiaomi-redmi-k50-gaming&quot; style=&quot;margin: 47px 0px 18px; padding: 0px; overflow-wrap: break-word; text-align: center; color: rgb(17, 17, 17); font-size: 29px; line-height: 44px; font-family: Candara, Verdana, sans-serif;&quot;&gt;Here&rsquo;s The Complete List of Specifications, Features, &amp;amp; Price of the Xiaomi Redmi K50 Gaming&lt;/h2&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The Xiaomi Redmi K50 Gaming was officially announced on February 16, 2022. The 5G-ready device is fueled with a non-removable Li-Po 4700 mAh battery + Fast charging 120W + Power Delivery 3.0 + Quick Charge 3+. It is offered in four colors: Black, Gray, Blue, and AMG.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;Body &amp;amp; Display:&lt;/strong&gt;&lt;/p&gt;&lt;div class=&quot;code-block code-block-3&quot; style=&quot;margin: 8px auto; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px; text-align: center; clear: both;&quot;&gt;&lt;ins class=&quot;adPushupAds&quot; data-adpcontrol=&quot;1v4kp&quot; data-ver=&quot;2&quot; data-siteid=&quot;38386&quot; data-ac=&quot;PHNjcmlwdCBhc3luYyBzcmM9Ii8vcGFnZWFkMi5nb29nbGVzeW5kaWNhdGlvbi5jb20vcGFnZWFkL2pzL2Fkc2J5Z29vZ2xlLmpzIj48L3NjcmlwdD4KPCEtLSBQTjJuZFBhcmFncmFwaCAtLT4KPGlucyBjbGFzcz0iYWRzYnlnb29nbGUgbWlkYm90YWRzIgogICAgIHN0eWxlPSJkaXNwbGF5OmlubGluZS1ibG9jayIKICAgICBkYXRhLWFkLWNsaWVudD0iY2EtcHViLTAzMzU2MzUyOTc3ODk0NTEiCiAgICAgZGF0YS1hZC1zbG90PSI2NTQ5Mzk5MzE3IgogICAgIGRhdGEtZnVsbC13aWR0aC1yZXNwb25zaXZlPSJ0cnVlIj48L2lucz4KPHNjcmlwdD4KKGFkc2J5Z29vZ2xlID0gd2luZG93LmFkc2J5Z29vZ2xlIHx8IFtdKS5wdXNoKHt9KTsKPC9zY3JpcHQ+&quot; data-push=&quot;1&quot; style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;&lt;/ins&gt;&lt;/div&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The Redmi K50 Gaming has the Corning Gorilla Glass Victus protection. It is built with a glass front (Gorilla Glass Victus), a glass back, and an aluminum frame. The phone measures 162.5 x 76.7 x 8.5 mm and weighs 210 grams. It features a 6.67 inches screen size and the display is OLED capacitive touchscreen that provides 1080 x 2400 pixels resolution.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;Platform:&lt;/strong&gt;&lt;/p&gt;&lt;div class=&quot;code-block code-block-4&quot; style=&quot;margin: 8px auto; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px; text-align: center; clear: both;&quot;&gt;&lt;ins class=&quot;adPushupAds&quot; data-adpcontrol=&quot;en6ne&quot; data-ver=&quot;2&quot; data-siteid=&quot;38386&quot; data-ac=&quot;PHNjcmlwdCBhc3luYyBzcmM9Ii8vcGFnZWFkMi5nb29nbGVzeW5kaWNhdGlvbi5jb20vcGFnZWFkL2pzL2Fkc2J5Z29vZ2xlLmpzIj48L3NjcmlwdD4KPCEtLSBQTjNyZFBhcmFncmFwaCAtLT4KPGlucyBjbGFzcz0iYWRzYnlnb29nbGUgbWlkYm90YWRzIgogICAgIHN0eWxlPSJkaXNwbGF5OmlubGluZS1ibG9jayIKICAgICBkYXRhLWFkLWNsaWVudD0iY2EtcHViLTAzMzU2MzUyOTc3ODk0NTEiCiAgICAgZGF0YS1hZC1zbG90PSI5OTg1NjU2NDEwIgogICAgIGRhdGEtZnVsbC13aWR0aC1yZXNwb25zaXZlPSJ0cnVlIj48L2lucz4KPHNjcmlwdD4KKGFkc2J5Z29vZ2xlID0gd2luZG93LmFkc2J5Z29vZ2xlIHx8IFtdKS5wdXNoKHt9KTsKPC9zY3JpcHQ+&quot; data-push=&quot;1&quot; style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;&lt;/ins&gt;&lt;/div&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The smartphone is powered by the Qualcomm SM8450 Snapdragon 8 Gen 1 (4 nm) Octa-core processor while the graphics processing unit (GPU) is Adreno 730. It runs on the Android 12 + MIUI 13 operating system. It comes in variants such as 128GB + 8GB RAM, 128GB + 12GB RAM, and 256GB + 12GB RAM.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;Main Camera:&lt;/strong&gt;&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The rear side of the Xiaomi Redmi K50 Gaming sports a triple-camera that consists of 64-megapixel (wide) + 8-megapixel (ultrawide) + 2-megapixel (macro). It features dual-LED flash, HDR, and panorama.&lt;/p&gt;&lt;div class=&quot;code-block code-block-6&quot; style=&quot;margin: 8px auto; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px; text-align: center; clear: both;&quot;&gt;&lt;ins class=&quot;adPushupAds&quot; data-adpcontrol=&quot;3s6f1&quot; data-ver=&quot;2&quot; data-siteid=&quot;38386&quot; data-ac=&quot;PHNjcmlwdCBhc3luYyBzcmM9Ii8vcGFnZWFkMi5nb29nbGVzeW5kaWNhdGlvbi5jb20vcGFnZWFkL2pzL2Fkc2J5Z29vZ2xlLmpzIj48L3NjcmlwdD4KPCEtLSBQTjh0aFBhcmFncmFwaCAtLT4KPGlucyBjbGFzcz0iYWRzYnlnb29nbGUgbWlkYm90YWRzIgogICAgIHN0eWxlPSJkaXNwbGF5OmlubGluZS1ibG9jayIKICAgICBkYXRhLWFkLWNsaWVudD0iY2EtcHViLTAzMzU2MzUyOTc3ODk0NTEiCiAgICAgZGF0YS1hZC1zbG90PSI5Nzc0MzI4NDU0IgogICAgIGRhdGEtZnVsbC13aWR0aC1yZXNwb25zaXZlPSJ0cnVlIj48L2lucz4KPHNjcmlwdD4KKGFkc2J5Z29vZ2xlID0gd2luZG93LmFkc2J5Z29vZ2xlIHx8IFtdKS5wdXNoKHt9KTsKPC9zY3JpcHQ+&quot; data-push=&quot;1&quot; style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;&lt;/ins&gt;&lt;/div&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px; overflow-wrap: break-word;&quot;&gt;Selfie Camera:&lt;/strong&gt;&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;The smartphone has a tiny punch-hole screen that houses a 20-megapixel camera. It also features HDR.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;Connectivity options on the gaming smartphone include USB Type-C 2.0, USB OTG, Infrared port, NFC, WiFi 802.11 a/b/g/n/ac/6e, hotspot, Bluetooth 5.2, GPS with A-GPS, GLONASS, GALILEO, QZSS, and NavIC. Sensors on the phone include fingerprint (side-mounted), accelerometer, gyro, compass, and color spectrum.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 29px; margin-left: 0px; padding: 0px; overflow-wrap: break-word; color: rgb(17, 17, 17); font-family: Candara, Verdana, sans-serif; font-size: 18px;&quot;&gt;&lt;a href=&quot;https://philnews.ph/2022/02/18/xiaomi-redmi-k50-gaming-specs-features-price-philippines/&quot; target=&quot;_blank&quot;&gt;Data Source: PhilNews.PH&lt;/a&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/thumbnails/3.jpg?v=1645424949', 1, '2022-02-21 14:29:08', '2022-02-21 14:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_meta`
--

CREATE TABLE `mobile_meta` (
  `mobile_id` int(30) NOT NULL,
  `field_id` int(30) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobile_meta`
--

INSERT INTO `mobile_meta` (`mobile_id`, `field_id`, `meta_value`) VALUES
(2, 1, 'Smartphone , Phablet , Camera Phone , Bezel-less Phone'),
(2, 2, '	Bar'),
(2, 3, 'Android'),
(2, 4, 'Android 11, MIUI 13'),
(2, 5, 'Hybrid Dual SIM (Nano-SIM, dual stand-by)'),
(2, 6, 'Qualcomm SM6375 Snapdragon 695 5G (6 nm) Octa-core Kryo 660'),
(2, 7, '2x2.2 GHz Kryo 660 Gold & 6x1.7 GHz Kryo 660 Silver'),
(2, 8, '	64GB, 128GB'),
(2, 9, 'Qualcomm SM6375 Snapdragon 695 5G (6 nm)'),
(2, 10, '6GB, 8GB'),
(2, 11, 'MicroSD for up to 1TB'),
(2, 12, 'Non-removable Li-Po 5000 mAh + Fast charging 67W + Power Delivery 3.0 + Quick Charge 3+'),
(2, 15, '2G, 3G , 4G (LTE), 5G'),
(2, 16, 'GSM 850 / 900 / 1800 / 1900 - SIM 1 & SIM 2'),
(2, 17, 'HSDPA 800 / 850 / 900 / 1900 / 2100'),
(2, 18, '1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 18, 19, 20, 26, 28, 32, 38, 40, 41, 66'),
(2, 19, '1, 3, 5, 7, 8, 20, 28, 38, 40, 41, 66, 77, 78 SA/NSA'),
(2, 20, 'HSPA 42.2/5.76 Mbps, LTE-A (CA), 5G'),
(2, 27, '164.2 x 76.1 x 8.1 mm (6.46 x 3.00 x 0.32 in)'),
(2, 28, '164.2 x 76.1 x 8.1 mm (6.46 x 3.00 x 0.32 in)'),
(2, 13, '6.67 inches'),
(2, 14, '1080 x 2400 pixels'),
(2, 21, '108MP + 8MP + 2MP'),
(2, 22, 'LED flash, HDR, panorama'),
(2, 23, '1080p@30fps'),
(2, 24, '16MP'),
(2, 25, 'N/A'),
(2, 26, '1080p@30fps'),
(2, 32, '16,916.46'),
(2, 29, 'Wi-Fi , Hotspot/Tethering , GPS , Bluetooth , Infrared , Flash , Face Unlock , Fingerprint Scanner , NFC , Triple Cameras , 3.5mm Headphone Jack , Water-Resistant'),
(3, 1, 'Smartphone, Phablet, Camera Phone, Selfie Phone, Bezel-less Phone, Gaming Phone'),
(3, 2, 'Bar'),
(3, 3, 'Android'),
(3, 4, 'Android 12, MIUI 13'),
(3, 5, 'Dual SIM (Nano-SIM, dual stand-by)'),
(3, 6, 'Qualcomm SM8450 Snapdragon 8 Gen 1 (4 nm) Octa-core Cortex-X2 & Cortex-A710 &Cortex-A510'),
(3, 7, '1x3.00 GHz Cortex-X2 & 3x2.50 GHz Cortex-A710 & 4x1.80 GHz Cortex-A510'),
(3, 8, '128GB, 256GB'),
(3, 9, '128GB, 256GB'),
(3, 10, '8GB, 12GB'),
(3, 11, 'No'),
(3, 12, 'No'),
(3, 15, '2G , 3G , 4G (LTE), 5G'),
(3, 16, 'GSM 850 / 900 / 1800 / 1900 - SIM 1 & SIM 2 CDMA 800'),
(3, 17, 'HSDPA 850 / 900 / 1700(AWS) / 1900 / 2100 CDMA2000 1x'),
(3, 18, '1, 2, 3, 4, 5, 7, 8, 18, 19, 26, 34, 38, 39, 40, 41, 42'),
(3, 19, '1, 3, 5, 8, 28, 38, 40, 41, 77, 78 SA/NSA/Sub6'),
(3, 20, 'HSPA 42.2/5.76 Mbps, LTE-A, 5G'),
(3, 27, '162.5 x 76.7 x 8.5 mm (6.40 x 3.02 x 0.33 in)'),
(3, 28, '210 g (7.41 oz)'),
(3, 13, '6.67 inches'),
(3, 14, '1080 x 2400 pixels'),
(3, 21, '64MP + 8MP + 2MP'),
(3, 22, 'Dual-LED flash, HDR, panorama'),
(3, 23, '4K@30/60fps, 1080p@30/60/120fps, 720p@960fps, HDR'),
(3, 24, '20MP'),
(3, 25, 'HDR'),
(3, 26, '1080p@30/60fps, 720p@120fps, HDR'),
(3, 32, '31,590'),
(3, 29, 'Wi-Fi , Hotspot/Tethering , GPS , Bluetooth , Infrared , Flash , Face Unlock , Fingerprint Scanner , NFC , 3.5mm Headphone Jack , Triple Cameras');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Mobile Comparison Website'),
(6, 'short_name', 'MCW - PHP'),
(11, 'logo', 'uploads/logo-1645409251.jpg?v=1645409251'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1645430976.jpg?v=1645430976');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1645064505', NULL, 1, '2021-01-20 14:02:37', '2022-02-17 10:21:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_list`
--
ALTER TABLE `field_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `mobile_list`
--
ALTER TABLE `mobile_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_meta`
--
ALTER TABLE `mobile_meta`
  ADD KEY `mobile_id` (`mobile_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `field_list`
--
ALTER TABLE `field_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `mobile_list`
--
ALTER TABLE `mobile_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `field_list`
--
ALTER TABLE `field_list`
  ADD CONSTRAINT `field_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mobile_meta`
--
ALTER TABLE `mobile_meta`
  ADD CONSTRAINT `mobile_meta_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `field_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mobile_meta_ibfk_2` FOREIGN KEY (`mobile_id`) REFERENCES `mobile_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
