-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 203.158.3.36:3306
-- Generation Time: Mar 01, 2023 at 03:20 PM
-- Server version: 10.10.2-MariaDB-1:10.10.2+maria~ubu2204
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prj65_02`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'admin',
  `create_by` varchar(50) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `role`, `create_by`, `created_time`) VALUES
(9, 'ADMIN', 'e366d50563abb1c8988d8a08ea24a1ad', 'tiwderrmail@gmail.com', 'admin', NULL, NULL),
(10, 'Chanannichaar', '79d66dfca6e19f8b4b2ebd48d88e200c', 'chanannichaar@gmail.com', 'admin', 'ADMIN', '2023-02-01 23:35:26'),
(13, 'B6200176Wanlop', '0e177a49b2a42f6b30f74bba8023a8cd', 'b6200176@gmail.com', 'admin', 'ADMIN', '2023-02-09 10:16:49'),
(14, 'surakiart678', 'f9a910bd0d8cb7cd46a5c9c152c7ab83', 'surakiart595@gmail.com', 'admin', 'ADMIN', '2023-02-09 10:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_log`
--

CREATE TABLE `tbl_admin_log` (
  `id` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `action_by` varchar(50) DEFAULT NULL,
  `action_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_admin_log`
--

INSERT INTO `tbl_admin_log` (`id`, `action`, `username`, `remark`, `action_by`, `action_time`) VALUES
(8, 'approve', 'kradum', 'P', 'ADMIN', '2023-02-09 10:19:35'),
(9, 'approve', 'pumkie', 'P', 'surakiart678', '2023-02-09 13:42:15'),
(10, 'approve', 'SasithonS', 'P', 'Chanannichaar', '2023-02-09 14:28:34'),
(11, 'approve', 'tutorwanlop', 'P', 'B6200176Wanlop', '2023-02-09 20:48:22'),
(12, 'approve', 'tutorwanlop', 'P', 'B6200176Wanlop', '2023-02-09 22:22:11'),
(13, 'approve', 'GameMopore', 'P', 'surakiart678', '2023-02-12 11:43:00'),
(14, 'approve', 'Marcellus', 'P', 'surakiart678', '2023-02-14 03:27:33'),
(15, 'approve', 'Marcellus', 'P', 'surakiart678', '2023-02-14 03:27:37'),
(16, 'approve', 'testtutor2', 'P', 'B6200176Wanlop', '2023-02-15 08:40:17'),
(17, 'approve', 'surasak', 'F-เอกสารไม่ตรงกับข้อมูลลงทะเบียน', 'ADMIN', '2023-02-15 09:32:53'),
(18, 'approve', 'tutorwanlop', 'P', 'B6200176Wanlop', '2023-02-19 16:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attention`
--

CREATE TABLE `tbl_attention` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `channel` varchar(100) DEFAULT NULL,
  `group_type` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_attention`
--

INSERT INTO `tbl_attention` (`id`, `username`, `subject`, `level`, `purpose`, `channel`, `group_type`, `gender`) VALUES
(17, 'kradum', 'การเขียนโปรแกรม,สถิติ,เทคโนโลยีสารสนเทศ', '4,5', '5', 'ออนไลน์,ตัวต่อตัว', '', ''),
(19, 'surakiart595', 'การเขียนโปรแกรม,ภาษาอังกฤษ,เทคโนโลยีสารสนเทศ', '', '', 'ออนไลน์,ตัวต่อตัว', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `intro` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `level` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `purpose` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `channel` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `group_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `day` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `course_descrip` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `course_status` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `title`, `intro`, `subject`, `level`, `purpose`, `price`, `channel`, `group_type`, `day`, `time`, `course_descrip`, `cover`, `create_by`, `created_time`, `last_update`, `course_status`) VALUES
(8, 'รับสอน PHP พื้นฐาน สร้างเว็บง่าย ๆ', 'สอน PHP ตั้งแต่พื้นฐาน จนสามารถสร้างเว็บแบบง่าย ๆ และประยุกต์ต่อยอดได้', 'การเขียนโปรแกรม', '5', '5', 200, 'ออนไลน์,ตัวต่อตัว', 'ไม่จำกัด', 'mon,tue,wed,thu,fri,sat,sun', 'เช้า-เที่ยง,บ่าย-เย็น', '<p></p><p></p><p></p><p></p><h5><span style=\"margin: 0px; border: 0px; outline: 0px; vertical-align: baseline; font-family: arial, sans, sans-serif; white-space: pre-wrap; font-size: 18px; background-color: rgb(75, 163, 185);\"><b style=\"\"><font color=\"#ffffff\">เนื้อหาการเรียนการสอน</font></b></span></h5><span style=\"margin: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(85, 85, 85); font-family: arial, sans, sans-serif; white-space: pre-wrap; font-size: 14px;\">- การเขียนโปรแกรมเพื่อพัฒนา web application ด้วยภาษา PHP</span><br style=\"color: rgb(85, 85, 85); font-family: arial, sans, sans-serif; white-space: pre-wrap;\"><span style=\"margin: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(85, 85, 85); font-family: arial, sans, sans-serif; white-space: pre-wrap; font-size: 14px;\">- Basic syntax</span><br style=\"color: rgb(85, 85, 85); font-family: arial, sans, sans-serif; white-space: pre-wrap;\"><span style=\"margin: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(85, 85, 85); font-family: arial, sans, sans-serif; white-space: pre-wrap; font-size: 14px;\">- Variable</span><br style=\"color: rgb(85, 85, 85); font-family: arial, sans, sans-serif; white-space: pre-wrap;\"><span style=\"margin: 0px; border: 0px; outline: 0px; vertical-align: baseline;\"><span style=\"color: rgb(85, 85, 85); font-family: arial, sans, sans-serif; white-space: pre-wrap; font-size: 14px;\">- Control Stat</span><font color=\"#555555\" face=\"arial, sans, sans-serif\"><span style=\"font-size: 14px; white-space: pre-wrap;\">emen\n\n</span></font><span style=\"font-family: arial, sans, sans-serif; font-size: 18px; white-space: pre-wrap;\"><b style=\"\"><span style=\"background-color: rgb(75, 163, 185);\"><font color=\"#ffffff\">เหมาะสำหรับ</font></span><font color=\"#555555\">\n</font></b></span><font color=\"#555555\" face=\"arial, sans, sans-serif\"><span style=\"font-size: 14px; white-space: pre-wrap;\">- ผู้สนใจทั่วไปที่ต้องการเรียนรู้การออกแบบเว็บเพจและการเขียนเว็บโปรแกรมมิ่งเริ่มต้น\n- นักเรียน นักศึกษาที่ต้องการพัฒนาโครงงานคอมพิวเตอร์ด้วยภาษา PHP และฐานข้อมูล MySQL</span></font></span><p></p><p><span style=\"margin: 0px; border: 0px; outline: 0px; vertical-align: baseline;\"><font face=\"arial, sans, sans-serif\"><span style=\"font-size: 14px; white-space: pre-wrap;\"><span style=\"font-size: 18px; background-color: rgb(75, 163, 185);\"><b style=\"\"><font color=\"#ffffff\">สิ่งที่จะได้การเรียน</font></b></span><font color=\"#555555\">\n</font></span><span style=\"color: rgb(85, 85, 85); font-size: 14px; white-space: pre-wrap;\">- สามารรู้หลักการออกแบบเว็บเพจบนเว็บไซต์ได้\n- สามารถเรียนรู้หลักการเขียนภาษา HTML and CSS\n- เรียนรู้พื้นฐานฐานข้อมูล SQL เบื้องต้น</span>\n</font></span></p><p></p><p><span style=\"margin: 0px; border: 0px; outline: 0px; vertical-align: baseline; font-family: arial, sans, sans-serif; white-space: pre-wrap;\"><span style=\"font-size: 14px;\"><b style=\"\"><span style=\"font-size: 18px; background-color: rgb(75, 163, 185);\"><font color=\"#ffffff\">ระยะเวลา</font></span></b><font color=\"#555555\">\n- 20 ชั่วโมง\n</font></span><font color=\"#555555\"><br></font></span></p><div style=\"text-align: center;\"><font color=\"#555555\"></font></div><p></p><p></p><p></p><p></p><p></p>', 'a8baa56554f96369ab93e4f3bb068c22.jpg', 'kradum', '2023-02-08 23:59:40', '2023-02-24 03:20:40', b'1'),
(9, 'รับสอน Data Visualization แปลงข้อมูลธุรกิจให้เป็นภาพสุดปัง', 'เรียนง่ายเป็นเร็ว', 'เทคโนโลยีสารสนเทศ', '4', '5', 100, 'ออนไลน์,ตัวต่อตัว', 'ไม่จำกัด', 'tue,wed', 'บ่าย-เย็น', 'รับสอน Data Visualization แปลงข้อมูลธุรกิจให้เป็นภาพสุดปัง', '42a0e188f5033bc65bf8d78622277c4e.jpg', 'pumkie', '2023-02-09 13:46:46', '2023-02-09 13:49:16', b'1'),
(10, 'รับสอนเล่นกีตาร์', 'สอนเล่นกีตาร์', 'ดนตรี', '5', '1', 500, 'ตัวต่อตัว', 'ไม่จำกัด', 'thu,sat', 'เช้า-เที่ยง,บ่าย-เย็น,ค่ำ', 'เดือนเดียวเล่นคล่องแน่นอน', 'tiwderr1.jpg', 'SasithonS', '2023-02-09 14:54:42', NULL, b'1'),
(11, 'สอนวาดรูปเบื้องต้น', 'วาดรูปตั้งแต่พื้นฐาน โดยโปรแกรม Procreate', 'ศิลปะ', '5', '1', 100, 'ตัวต่อตัว', 'ไม่จำกัด', 'thu', 'บ่าย-เย็น', 'วาดรูปตั้งแต่พื้นฐาน โดยโปรแกรม Procreate', 'tiwderr1.jpg', 'SasithonS', '2023-02-09 14:57:58', '2023-02-09 14:58:40', b'0'),
(13, 'ภาษาเยอรมันระดับ B1 , B2', 'คอร์สวิชาภาษาเยอรมันระดับ B1 , B2 หลักสูตรเร่งรัดพิเศษ สามารถเข้าใจพื้นฐาน ทั้งการพูด การเขียน ภาษาเยอรมันได้รวดเร็ว', 'ภาษาเยอรมัน', '4', '5', 100, 'ตัวต่อตัว', 'ไม่จำกัด', 'sat,sun', 'บ่าย-เย็น', '<p>ติดต่อได้ที่<br>Facebook: tutorwanlop<br>Line : tutorwanlop</p>', 'ec8956637a99787bd197eacd77acce5e.jpg', 'tutorwanlop', '2023-02-09 22:41:11', '2023-02-19 17:07:51', b'1'),
(14, 'Electric Circuit', 'สอนพื้นฐานเกี่ยวกับวิชา Electric Circuit Part Midterm', 'วิชาเฉพาะทาง', '4', '4', 50, 'ตัวต่อตัว', 'ติวเดี่ยว', 'sat,sun', 'บ่าย-เย็น', '', 'tiwderr1.jpg', 'GameMopore', '2023-02-12 11:54:16', '2023-02-12 12:16:26', b'1'),
(15, 'English 1-5', 'สอนปรับพื้นฐานตั้งแต่แกรมม่า คำศัพท์ต่างๆ พร้อมติวให้ก่อนสอบ', 'ภาษาอังกฤษ', '4', '4', 70, 'ตัวต่อตัว', 'กลุ่ม 2-5 คน', 'sat,sun', 'บ่าย-เย็น', '', 'tiwderr1.jpg', 'Marcellus', '2023-02-14 04:08:10', NULL, b'1'),
(16, 'Chemistry I (SUT)', 'รับสอนและติวเคมี', 'เคมี', '4', '4', 50, 'ออนไลน์,ตัวต่อตัว', 'ไม่จำกัด', 'thu,fri', 'บ่าย-เย็น,ค่ำ', '', 'tiwderr1.jpg', 'Marcellus', '2023-02-14 04:10:06', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_like_course`
--

CREATE TABLE `tbl_like_course` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_like_course`
--

INSERT INTO `tbl_like_course` (`id`, `username`, `course_id`, `created_time`) VALUES
(7, 'surakiart595', 8, '2023-02-09 00:00:29'),
(8, 'mimigumo', 8, '2023-02-09 00:16:38'),
(11, 'surakiart595', 9, '2023-02-09 13:50:01'),
(14, 'fisho', 9, '2023-02-09 17:36:12'),
(17, 'B6205027', 11, '2023-02-09 20:36:10'),
(18, 'fisho', 10, '2023-02-09 21:22:54'),
(19, 'fisho', 13, '2023-02-10 06:51:31'),
(22, 'surakiart595', 14, '2023-02-12 12:04:10'),
(23, 'surakiart595', 15, '2023-02-14 04:15:03'),
(24, 'Kewalin', 13, '2023-02-15 08:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `t_lattitude` decimal(11,7) DEFAULT NULL,
  `t_longitude` decimal(11,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `username`, `location`, `t_lattitude`, `t_longitude`) VALUES
(4, 'kradum', 'นครราชสีมา, เมืองนครราชสีมา, สุรนารี', '14.8828476', '102.0223167'),
(6, 'mimigumo', 'นครราชสีมา, เมืองนครราชสีมา, หนองจะบก', '14.8973696', '102.0358433'),
(7, 'SasithonS', '', '0.0000000', '0.0000000'),
(8, 'surakiart595', 'นครราชสีมา, เมืองนครราชสีมา, สุรนารี', '14.8871072', '102.0157922'),
(9, 'B6205027', 'นครราชสีมา, เมืองนครราชสีมา, สุรนารี', '14.8813570', '102.0145386'),
(10, 'fisho', 'นครราชสีมา, เมืองนครราชสีมา, สุรนารี', '14.8804775', '102.0148656'),
(11, 'tutorwanlop', 'นครราชสีมา, เมืองนครราชสีมา, สุรนารี', '14.8813995', '102.0191524'),
(12, 'CHACHI', 'ปทุมธานี, ลำลูกกา, คูคต', '13.9511878', '100.6484353'),
(13, 'Marcellus', 'นครราชสีมา, เมืองนครราชสีมา, หนองไผ่ล้อม', '14.9664765', '102.0864908'),
(14, 'Kewalin', 'นครราชสีมา, เมืองนครราชสีมา, สุรนารี', '14.8811362', '102.0202847');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer`
--

CREATE TABLE `tbl_offer` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `cf_subject` varchar(10) DEFAULT NULL,
  `rm_subject` varchar(500) DEFAULT NULL,
  `cf_level` varchar(10) DEFAULT NULL,
  `rm_level` varchar(500) DEFAULT NULL,
  `cf_purpose` varchar(10) DEFAULT NULL,
  `rm_purpose` varchar(500) DEFAULT NULL,
  `cf_price` varchar(10) DEFAULT NULL,
  `rm_price` varchar(500) DEFAULT NULL,
  `cf_channel` varchar(10) DEFAULT NULL,
  `rm_channel` varchar(500) DEFAULT NULL,
  `cf_group_type` varchar(10) DEFAULT NULL,
  `rm_group_type` varchar(500) DEFAULT NULL,
  `cf_day` varchar(10) DEFAULT NULL,
  `rm_day` varchar(500) DEFAULT NULL,
  `cf_time` varchar(10) DEFAULT NULL,
  `rm_time` varchar(500) DEFAULT NULL,
  `offer_descrip` longtext DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `is_read` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_offer`
--

INSERT INTO `tbl_offer` (`id`, `post_id`, `cf_subject`, `rm_subject`, `cf_level`, `rm_level`, `cf_purpose`, `rm_purpose`, `cf_price`, `rm_price`, `cf_channel`, `rm_channel`, `cf_group_type`, `rm_group_type`, `cf_day`, `rm_day`, `cf_time`, `rm_time`, `offer_descrip`, `create_by`, `created_time`, `is_read`) VALUES
(9, 8, 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'yes', 'สะดวกติวตามร้านกาแฟนะคะ', 'yes', '', 'yes', '', 'yes', 'จะเป็นบ่าย 2 ถึง 6 โมงนะคะ', '<p>สวัสดีค่ะน้อง พี่ตกลงเงื่อนไขของน้องนะคะ มีคอร์สเรียนอยู่ประมาณ 10 ชั่วโมง ถ้าเรียนเสาร์อาทิตย์ ช่วงบ่ายเลือกได้เลยนะคะว่าจะเรียนรอบละกี่ชั่วโมง</p><p>สนใจสอบถามได้น้า ^^</p>', 'kradum', '2023-02-09 00:37:05', 2),
(10, 8, 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'no', '', 'yes', '', '', 'pumkie', '2023-02-09 13:51:49', 1),
(11, 8, 'yes', '', 'yes', '', 'yes', '', 'no', '', 'yes', '', 'yes', '', 'yes', '', 'yes', '', '<p>Good Website :)</p>', 'SasithonS', '2023-02-09 14:32:09', 1),
(12, 12, 'yes', '', 'yes', '', 'yes', '', 'yes', 'ขอ 500 ต่อ ชม.', 'yes', '', 'yes', '', 'yes', '', 'yes', '', '', 'tutorwanlop', '2023-02-09 20:50:07', 2),
(13, 11, 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'yes', '', 'สนใจอยากสอนการเขียนโปรแกรม<br>ติดต่อกลับที่<br>Facebook : tutorfisho', 'tutorwanlop', '2023-02-10 02:02:21', 1),
(14, 8, 'yes', '', 'yes', '', 'yes', '', 'no', '500 ได้ไหมครับ', 'yes', '', 'yes', '', 'yes', '', 'yes', '', '', 'GameMopore', '2023-02-12 12:18:38', 1),
(15, 8, 'yes', '', 'yes', '', 'yes', '', 'no', '500 วิชานี้ค่อนข้างยาก ปกติ เขาสอนกันเป็น 1000 เลย', 'yes', '', 'yes', '', 'yes', '', 'yes', '', '', 'Marcellus', '2023-02-14 04:12:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_reply`
--

CREATE TABLE `tbl_offer_reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `is_read` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_offer_reply`
--

INSERT INTO `tbl_offer_reply` (`id`, `post_id`, `offer_id`, `message`, `create_by`, `created_time`, `is_read`) VALUES
(43, 8, 9, 'สวัสดีครับ', 'surakiart595', '2023-02-09 00:42:06', 1),
(44, 8, 9, 'สวัสดีค่า ^^', 'kradum', '2023-02-09 00:44:04', 2),
(45, 8, 9, 'สามารถเริ่มเรียน เสาร์-อาทิตย์ที่จะถึงได้เลยไหมครับ', 'surakiart595', '2023-02-09 00:46:59', 1),
(46, 8, 10, 'สวัสดีครับ พี่สะดวกเป็นวันไหนครับ', 'surakiart595', '2023-02-09 13:52:21', 1),
(47, 8, 10, ':D', 'surakiart595', '2023-02-09 13:52:35', 1),
(48, 8, 10, 'วันจัทนทร์ค่ะ', 'pumkie', '2023-02-09 13:53:24', 1),
(49, 8, 10, 'ผมมีเรียนครับวันจันทร์ เป็นวันศุกร์ได้ไหมครับ', 'surakiart595', '2023-02-09 14:07:22', 1),
(50, 12, 12, '500 แรงเกินไปคร่าาาาา', 'B6205027', '2023-02-09 20:50:48', 1),
(51, 12, 12, 'เร็ว<br />', 'B6205027', '2023-02-09 20:51:14', 1),
(52, 12, 12, 'โอเคครับ', 'tutorwanlop', '2023-02-09 20:51:19', 2),
(53, 12, 12, 'แก๋วววว', 'B6205027', '2023-02-09 20:51:37', 1),
(54, 12, 12, 'โย่ววว', 'B6205027', '2023-02-09 20:52:18', 1),
(55, 12, 12, 'ขอ 450 ได้ไหม', 'tutorwanlop', '2023-02-09 20:52:29', 1),
(56, 8, 11, 'สวัสดีครับ พี่สะดวก ในช่วงราคาไหนครับพี่', 'surakiart595', '2023-02-09 20:57:36', 0),
(57, 11, 13, 'สอนใจสอนเขียนโค้ดภาษา Python', 'tutorwanlop', '2023-02-10 02:14:24', 1),
(58, 11, 13, 'ขอข้อมูลการติดต่อ และรายละเอียดค่างสอนหน่อยครับ', 'fisho', '2023-02-10 02:46:03', 1),
(59, 8, 14, 'สวัสดีครับ อยากสอบถามรายละเอียดการสอนเพิ่มเติมครับ', 'surakiart595', '2023-02-14 03:30:33', 0),
(60, 8, 15, 'สวัสดีครับ', 'surakiart595', '2023-02-14 04:13:22', 1),
(61, 8, 15, 'ครับ<br />', 'Marcellus', '2023-02-14 04:13:53', 1),
(62, 8, 15, 'เห็นสนใจอยากเรียนภาษาไพธอน<br />', 'Marcellus', '2023-02-14 04:14:04', 1),
(63, 8, 15, 'สนใจรับข้อเสนอไหมครับ', 'Marcellus', '2023-02-14 04:14:28', 1),
(64, 8, 15, 'ถ้าผมจ่าย 500 ผมได้อะไรบ้างครับพี่', 'surakiart595', '2023-02-14 04:14:36', 1),
(65, 8, 15, 'ได้ทุกอย่างที่ต้องการครับ สอนตั้งแต่เริ่มต้น จนเชี่ยวชาญ', 'Marcellus', '2023-02-14 04:15:25', 1),
(66, 8, 15, 'พอดีพี่จบ Computer Science ที่ Chula มาเกียตินิยม แต่มาทำงานที่ โคราช แต่ ส อา พี่ว่างครับ', 'Marcellus', '2023-02-14 04:16:17', 1),
(67, 8, 9, 'ok', 'kradum', '2023-02-16 07:00:53', 1),
(68, 8, 9, 'เอาเป็นเสาร์-อาทิตย์นี้นะคะ ?', 'kradum', '2023-02-16 14:25:47', 1),
(69, 8, 9, 'ครับ ให้ติดต่อคุณครูยังไงดีครับ', 'surakiart595', '2023-02-17 13:36:41', 0),
(70, 8, 9, 'อีเมลหรอครับ', 'surakiart595', '2023-02-17 13:46:31', 0),
(71, 8, 10, 'สะดวกไหมครับคุณครู', 'surakiart595', '2023-02-17 13:47:34', 0),
(72, 8, 9, 'อ่อ แล้วจะนัดติวที่ไหนดีครับ', 'surakiart595', '2023-02-17 13:49:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `level` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `purpose` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `channel` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `group_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `day` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `post_descrip` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `post_status` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `title`, `subject`, `level`, `purpose`, `price`, `channel`, `group_type`, `day`, `time`, `post_descrip`, `create_by`, `created_time`, `last_update`, `post_status`) VALUES
(8, 'หาคนสอน Python ในตัวจังหวัด นครราชสีมาและอำเภอใกล้เคียง', 'การเขียนโปรแกรม', '4', '0', 300, 'ตัวต่อตัว', 'ติวเดี่ยว', 'sat,sun', 'บ่าย-เย็น', '<h5><b style=\"\"><u style=\"background-color: rgb(255, 255, 255);\"><font color=\"#634aa5\">เรียนรู้ภาษา Python เกี่ยวกับ Computer Vision</font></u></b></h5><p><font style=\"background-color: rgb(255, 214, 99);\">ความต้องการ</font><br><span style=\"background-color: rgb(255, 255, 255);\">เข้าใจวิธีการใช้ Library ต่างๆ<br></span><span style=\"background-color: rgb(255, 255, 255);\">เข้าใจหลักการทำงาน Computer Vision<br></span><span style=\"background-color: rgb(255, 255, 255);\">สามารถนำไปประยุกต์ใช้กับ Hardware ได้<br></span><span style=\"background-color: rgb(255, 255, 255);\">---------------------------------------------------------------------------------------------------------<br></span><span style=\"background-color: rgb(255, 255, 255);\">ขอคนที่ใจเย็นและรับกับการเรียนรู้ที่ช้าของผู้เรียนได้ครับ<br></span><span style=\"background-color: rgb(255, 255, 255);\">ขอบคุณครับ</span></p>', 'surakiart595', '2023-02-09 00:18:17', '2023-02-19 15:52:11', b'1'),
(9, 'ตามหาคนสอนภาษาเกาหลี （*´▽｀*）', 'ภาษาเกาหลี', '2', '6', 150, 'ตัวต่อตัว,ออนไลน์', 'ติวเดี่ยว', 'sat,sun', 'บ่าย-เย็น', '', 'mimigumo', '2023-02-09 00:22:59', NULL, b'1'),
(11, 'หา developer สอนเขียนโค้ดภาษา Python', 'การเขียนโปรแกรม', '4', '5', 1000, 'ตัวต่อตัว,ออนไลน์', 'ติวเดี่ยว', 'sat,sun', 'เช้า-เที่ยง', NULL, 'fisho', '2023-02-09 19:23:07', NULL, b'1'),
(12, 'หาติวเตอร์แถวหนองน้่ำจิน 1 ท่าน วิชาคณิตศาสตร์', '9 วิชาสามัญ', '3', '1', 150, 'ออนไลน์', 'ติวกลุ่ม (10 คน)', 'mon,tue,wed,thu,fri', 'บ่าย-เย็น', '<p><b>สวีสดีครับ</b></p>', 'B6205027', '2023-02-09 20:41:28', NULL, b'1'),
(13, 'หาคนสอนSPSS ด่วนที่สุด', 'สถิติ', '4', '5', 2000, 'ตัวต่อตัว', 'ติวเดี่ยว', 'fri', 'ค่ำ', '<p>c</p>', 'CHACHI', '2023-02-10 13:40:00', '2023-02-19 17:48:02', b'0'),
(14, 'หาคนสอนภาษาอังกฤษสำหรับใช้ทำงานค่ะ', 'IELTS', '4', '0', 150, 'ตัวต่อตัว,ออนไลน์', 'ติวเดี่ยว', 'fri,sat,sun', 'ค่ำ', '<p>ก่อนจบมหาวิทยาลัยต้องสอบภาษาอังกฤษเพื่อจบก่อน อยากหาคนช่วยสอนหน่อยค่ะ&nbsp;</p>', 'Kewalin', '2023-02-15 08:56:38', NULL, b'1'),
(19, 'หาคนสอน SQL และภาษา R', 'เทคโนโลยีสารสนเทศ', '4', '5', 300, 'ตัวต่อตัว,ออนไลน์', 'ติวเดี่ยว', 'sat,sun', 'บ่าย-เย็น', '', 'CHACHI', '2023-02-19 17:55:02', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reset_code` varchar(255) DEFAULT NULL,
  `exp_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_reset_password`
--

INSERT INTO `tbl_reset_password` (`id`, `email`, `reset_code`, `exp_date`) VALUES
(8, 'natsa48@gmail.com', '094192b0e0e97a12356c7845fd349f14e38de05ea0', '2023-02-15 01:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review_course`
--

CREATE TABLE `tbl_review_course` (
  `id` int(11) NOT NULL,
  `course` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `show_user` bit(1) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `is_read` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_review_course`
--

INSERT INTO `tbl_review_course` (`id`, `course`, `score`, `message`, `show_user`, `create_by`, `created_time`, `is_read`) VALUES
(10, 8, 5, 'ชอบมาก ๆ สอนดีมาก ๆ เลย แนะนำต่อเพื่อน ๆ ด้วย พี่ติวเตอร์ใจดีมาก ๆ ค่ะ', b'1', 'mimigumo', '2023-02-09 00:18:08', 1),
(11, 8, 5, 'very good ', b'0', 'surakiart595', '2023-02-09 01:34:05', 1),
(12, 9, 5, 'สอนดีและเข้าใจได้ง่ายมากๆเลยครับ', b'1', 'surakiart595', '2023-02-09 13:50:33', 1),
(15, 9, 5, 'เนื้อหาเยอะแต่สอนได้เข้าใจง่าย ไม่น่าเบื่อ', b'1', 'fisho', '2023-02-09 17:49:18', 0),
(16, 10, 3, 'สอนเข้าใจง่าย แต่ราคาแพงเกินไป', b'1', 'fisho', '2023-02-09 21:23:48', 0),
(17, 13, 5, 'สอนไว เข้าใจง่าย ใช้ได้จริง', b'1', 'fisho', '2023-02-10 06:52:10', 1),
(18, 13, 5, 'gooddddddddddddddddd', b'0', 'CHACHI', '2023-02-10 13:45:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review_student`
--

CREATE TABLE `tbl_review_student` (
  `id` int(11) NOT NULL,
  `student` varchar(50) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `show_user` bit(1) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `is_read` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_review_student`
--

INSERT INTO `tbl_review_student` (`id`, `student`, `score`, `message`, `show_user`, `create_by`, `created_time`, `is_read`) VALUES
(6, 'surakiart595', 5, 'เด็กคนนี้พยายามเรียนมากค่ะ แต่ติดขี้เกียจไปนิด โดยรวมตั้งใจสุดๆ', b'1', 'pumkie', '2023-02-09 14:02:15', 1),
(7, 'fisho', 5, 'ตั้งใจเรียนดีมาก', b'1', 'tutorwanlop', '2023-02-10 03:37:47', 1),
(8, 'surakiart595', 5, 'ค่อนข้างเป็นเด็กที่ขยันค่ะ ตั้งใจเรียนดี มาตรงเวลาตลอด', b'0', 'kradum', '2023-02-16 14:27:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`id`, `subject`) VALUES
(1, '9 วิชาสามัญ'),
(2, 'CU-AAT'),
(3, 'CU-BEST'),
(4, 'CU-TEP'),
(5, 'GAT PAT'),
(6, 'IELTS'),
(7, 'IGCSE'),
(8, 'OET'),
(9, 'O-NET'),
(10, 'SAT'),
(11, 'TCAS'),
(12, 'TOEFL'),
(13, 'TOEIC'),
(14, 'TU-GET'),
(15, 'กฎหมาย'),
(16, 'การเขียนโปรแกรม'),
(17, 'การตลาด'),
(18, 'การบ้านทั่วไป'),
(19, 'การออกแบบ'),
(20, 'กีฬา'),
(21, 'ความถนัดแพทย์'),
(22, 'คอมพิวเตอร์'),
(23, 'เคมี'),
(24, 'แคลคูลัส'),
(25, 'ชีววิทยา'),
(26, 'ดนตรี'),
(27, 'ดาราศาสตร์'),
(28, 'ทักษะอาชีพ'),
(29, 'เทคโนโลยีสารสนเทศ'),
(30, 'นาฏศิลป์'),
(31, 'บัญชีและการเงิน'),
(32, 'ประวัติศาสตร์'),
(33, 'ภาษาเกาหลี'),
(34, 'ภาษาจีน'),
(35, 'ภาษาญี่ปุ่น'),
(36, 'ภาษาไทย'),
(37, 'ภาษาบาลี'),
(38, 'ภาษาฝรั่งเศส'),
(39, 'ภาษาเยอรมัน'),
(40, 'ภาษาอังกฤษ'),
(41, 'ภูมิศาสตร์'),
(42, 'วิชาเฉพาะทาง'),
(43, 'ศิลปะ'),
(44, 'เศรษฐศาสตร์'),
(45, 'สถิติ'),
(46, 'สังคมศึกษา ศาสนา และวัฒนธรรม'),
(47, 'สุขศึกษา');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_award`
--

CREATE TABLE `tbl_tutor_award` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `org` varchar(500) DEFAULT NULL,
  `detail` varchar(300) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_tutor_award`
--

INSERT INTO `tbl_tutor_award` (`id`, `username`, `title`, `org`, `detail`, `created_time`) VALUES
(11, 'kradum', 'ชนะเลิศ การพัฒนาเว็บไซต์ด้วยภาษา HTML/PHP', 'บริษัท ดิจิทัล จำกัด', '', '2023-02-09 00:11:05'),
(12, 'SasithonS', 'ทุน 85', 'มทส', 'สอบชิงทุน', '2023-02-09 14:45:01'),
(13, 'tutorwanlop', 'Deutsch A1', 'Gurthe', 'Deutsch A1 Certificate', '2023-02-10 08:24:53'),
(15, 'GameMopore', 'รางวัลนักศึกษากินเก่ง', 'หอ 7 ห้อง 7235', 'เนื่องจากกินเก่งมาก ทางเพื่อนร่วมห้องหรือเมทจึงมอบให้', '2023-02-12 11:50:31'),
(16, 'Marcellus', 'ผลการเรียนอันดับหนึ่งของหลักสูตรปี 2564', 'มทส.', '', '2023-02-14 03:48:49'),
(18, 'Marcellus', 'TOEIC', 'CPA', '785', '2023-02-14 04:02:15'),
(20, 'kradum', 'ทุนการศึกษา มทส. ศักยบัณฑิต', 'มหาวิทยาลัยเทคโนโลยีสุรนารี', '', '2023-02-24 00:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_contact`
--

CREATE TABLE `tbl_tutor_contact` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_tutor_contact`
--

INSERT INTO `tbl_tutor_contact` (`id`, `username`, `type`, `contact`) VALUES
(12, 'kradum', '2-Email', 'B6210960@g.sut.ac.th'),
(13, 'SasithonS', '5-Line', 'sasithon'),
(15, 'SasithonS', '6-Twitter', 'sasithon'),
(17, 'tutorwanlop', '3-Facebook', 'tutor_wanlop'),
(20, 'GameMopore', '3-Facebook', 'Thanarat Phimtakhob'),
(21, 'GameMopore', '1-Phone', '0000000000'),
(22, 'GameMopore', '4-Instagram', 'Mmmao'),
(23, 'Marcellus', '1-Phone', '099-999-9999'),
(24, 'Marcellus', '2-Email', 'natsa48@gmail.com'),
(28, 'kradum', '5-Line', 'B6210960jaa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_edu`
--

CREATE TABLE `tbl_tutor_edu` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `edu_stat` varchar(100) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `fac_maj` varchar(255) DEFAULT NULL,
  `diploma` varchar(255) DEFAULT NULL,
  `period_year` varchar(255) DEFAULT NULL,
  `gpax` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_tutor_edu`
--

INSERT INTO `tbl_tutor_edu` (`id`, `username`, `level`, `edu_stat`, `institute`, `fac_maj`, `diploma`, `period_year`, `gpax`) VALUES
(15, 'pumkie', 'ปริญญาตรี', 'จบการศึกษา', 'มหาวิทยาลัยเทคโนโลยีสุรนารี', 'ธุรกิจอัจฉริยะและการวิเคราะห์ข้อมูล', NULL, NULL, NULL),
(16, 'SasithonS', 'ปริญญาตรี', 'กำลังศึกษา', 'มทส', 'ไอที', NULL, NULL, NULL),
(17, 'SasithonS', 'มัธยมศึกษาตอนปลาย', 'จบการศึกษา', 'ตอนนม', '-', 'ม.ปลาย', '3', '4.00'),
(18, 'tutorwanlop', 'ปริญญาตรี', 'จบการศึกษา', 'Suranaree University of Technology', 'Enterprise Software', NULL, NULL, NULL),
(19, 'GameMopore', 'ปริญญาตรี', 'กำลังศึกษา', 'มหาวิทยาลัยเทคโนโลยีสุรนารี', 'วิศวกรรมไฟฟ้า', NULL, NULL, NULL),
(22, 'surasak', 'ปริญญาตรี', 'กำลังศึกษา', 'มทส.', 'ซอฟต์แวร์วิสาหกิจ', NULL, NULL, NULL),
(24, 'Marcellus', 'ปริญญาตรี', 'กำลังศึกษา', 'Suranaree University of Technology', 'Geological Engineering', 'Bachelor\'s degree in Engineering', '2019-Present', '3.78'),
(25, 'testtutor2', 'ปริญญาตรี', 'จบการศึกษา', 'SUT', 'ES', NULL, NULL, NULL),
(26, 'Test1', 'ปริญญาเอก', 'กำลังศึกษา', 'test', 'test', NULL, NULL, NULL),
(27, 'kradum', 'ปริญญาตรี', 'กำลังศึกษา', 'มหาวิทยาลัยเทคโนโลยีสุรนารี', 'เทคโนโลยีสารสนเทศ', '', '2563 - ปัจจุบัน', '3.97');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_experience`
--

CREATE TABLE `tbl_tutor_experience` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `experience` longtext DEFAULT NULL,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_tutor_experience`
--

INSERT INTO `tbl_tutor_experience` (`id`, `username`, `experience`, `last_update`) VALUES
(11, 'kradum', '<p><div style=\"text-align: left;\"><span style=\"-webkit-text-size-adjust: 100%; color: rgb(66, 66, 66); font-family: prompt;\"><span style=\"font-size: 14px;\">** </span><b><span style=\"font-size: 14px;\">รับสอนการเขียนโปรแกรมด้วย</span></b></span><b style=\"-webkit-text-size-adjust: 100%;\"><span style=\"font-family: prompt;\"><font color=\"#731842\"><span style=\"font-size: 14px;\"> HTML,</span></font><font color=\"#085294\"><span style=\"font-size: 14px;\"> </span></font></span><span style=\"font-family: prompt; font-size: 14px;\"><font color=\"#085294\">CSS,</font></span><span style=\"color: rgb(66, 66, 66); font-family: prompt; font-size: 14px;\"> </span><span style=\"font-family: prompt; font-size: 14px;\"><font color=\"#397b21\">JS, </font></span><span style=\"font-family: prompt; font-size: 14px;\"><font color=\"#b56308\">PHP</font></span></b><span style=\"-webkit-text-size-adjust: 100%; color: rgb(66, 66, 66); font-family: prompt; font-size: 14px;\"> ไม่มีพื้นฐานก็เรียนได้น้า ^^</span></div><span style=\"color: rgb(66, 66, 66); font-family: prompt;\">มีประสบการณ์สอนมากกว่า 3 ปี ทั้งในหลักสูตรไทยและอินเตอร์<br></span><span style=\"color: rgb(66, 66, 66); font-family: prompt;\">สอนนักเรียนจากโรงเรียนดังมาหลายที่เลยค่ะ สำหรับคนที่อยากเรียนพื้นฐานการเขียนโปรแกรม <br>การันตีว่าจะสามารถเข้าใจได้อย่างถ่องแท้แน่นอน</span></p><p style=\"text-align: center;\"><img src=\"data:image/webp;base64,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\" data-filename=\"2B5D47F4-2412-443E-895C-C0C8BD65D8E4.webp\" style=\"width: 50%;\"><span style=\"font-family: prompt;\"><font color=\"#ffff00\"><br></font></span></p>', '2023-02-24 03:12:17');
INSERT INTO `tbl_tutor_experience` (`id`, `username`, `experience`, `last_update`) VALUES
(12, 'SasithonS', '<p>สอนคณิตศาสตร์ม.ต้น - ปลาย</p>', '2023-02-09 14:45:43'),
(14, 'GameMopore', 'เคยสอนวิชา Electrical Circuit&nbsp;', '2023-02-12 11:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_schedule`
--

CREATE TABLE `tbl_tutor_schedule` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `day` varchar(50) DEFAULT NULL,
  `detail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_tutor_schedule`
--

INSERT INTO `tbl_tutor_schedule` (`id`, `username`, `day`, `detail`) VALUES
(21, 'kradum', '4-thu', '13:00 - 20:00 น.'),
(22, 'kradum', '5-fri', '13:00 - 20:00 น.'),
(24, 'kradum', '6-sat', '09:00 - 18:00 น.'),
(25, 'kradum', '7-sun', '09:00 - 18:00 น.'),
(26, 'SasithonS', '1-mon', '15.00-18.00น.'),
(27, 'SasithonS', '4-thu', '09.00-12.00น.'),
(29, 'tutorwanlop', '7-sun', '13:00 - 17:00'),
(30, 'tutorwanlop', '3-wed', 'สอน German C1\n13:00 - 17:00'),
(31, 'GameMopore', '2-tue', '20.00-22.00'),
(32, 'Marcellus', '6-sat', '13:00-21:00'),
(33, 'Marcellus', '7-sun', '13:00-21:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created_time` datetime DEFAULT current_timestamp(),
  `verification_code` varchar(255) DEFAULT NULL,
  `is_verified` bit(1) DEFAULT b'0',
  `verified_time` datetime DEFAULT NULL,
  `is_approved` bit(1) DEFAULT b'0',
  `approved_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `phone`, `user_password`, `role`, `created_time`, `verification_code`, `is_verified`, `verified_time`, `is_approved`, `approved_time`) VALUES
(3, 'kradum', 'kdchnnch@gmail.com', '0000000000', '79d66dfca6e19f8b4b2ebd48d88e200c', 'tutor', '2023-02-08 23:32:28', '7b5bf4a8718bc098dbfbc25a5160878c', b'1', '2023-02-08 23:33:23', b'1', '2023-02-09 10:19:35'),
(4, 'surakiart595', 'surakiart595@gmail.com', '0843924822', 'f9a910bd0d8cb7cd46a5c9c152c7ab83', 'student', '2023-02-08 23:39:36', 'a390316885b1296d595a31253492d96c', b'1', '2023-02-08 23:40:37', b'0', NULL),
(5, 'mimigumo', 'chanannichaar@gmail.com', '0939521931', '79d66dfca6e19f8b4b2ebd48d88e200c', 'student', '2023-02-09 00:15:08', '8e2dc0a4ef2d5a10445317618309a059', b'1', '2023-02-09 00:15:35', b'0', NULL),
(6, 'Godon', 'godon896@gmail.com', '0958304352', 'dbb71a226bf2a8c3e018365d58cebfa4', 'student', '2023-02-09 13:09:14', '0a8159c2b4a0783c4b8a67bfede9b6a7', b'1', '2023-02-09 13:10:58', b'0', NULL),
(7, 'pumkie', 'sukemon8700@gmail.com', '0643575429', '23898ab119c934bbcd9c3e276aff37e1', 'tutor', '2023-02-09 13:35:02', '443cfce029f529795abe12d7d1fdb73f', b'1', '2023-02-09 13:37:24', b'1', '2023-02-09 13:42:15'),
(8, 'SasithonS', 'Sasithon190319@gmail.com', '0985482352', 'baf0f0afd319bf489c5fe7d5a44b7a52', 'tutor', '2023-02-09 14:23:21', 'acd31d44b12d0a5b40b370ba472646f2', b'1', '2023-02-09 14:24:08', b'1', '2023-02-09 14:28:34'),
(10, 'Nitiphum khanjanthue', 'gusnitiphum890@gmail.com', '0_________', 'b677c7d0bf324384b9ce6f0de671c7e1', 'student', '2023-02-09 15:27:56', '3ae932f06b75f54906f223c590b8f620', b'1', '2023-02-09 15:28:17', b'0', NULL),
(11, 'fisho', 'test1@gmail.com', '0645954309', '5c83cb20be2911b9d907e4d6d866175d', 'student', '2023-02-09 16:51:28', '0105a8e9be4b3c890fd9b4ca9676d107', b'1', '2023-02-09 16:51:45', b'0', NULL),
(12, 'B6205027', 'galaxy143725869@gmail.com', '0918300140', '25f9e794323b453885f5181f1b624d0b', 'student', '2023-02-09 20:28:14', 'a9ed2022dbdecf27f2773c77664a1f28', b'1', '2023-02-09 20:28:57', b'0', NULL),
(13, 'tutorwanlop', 'wanlopfisho@gmail.com', '0645954309', '5c83cb20be2911b9d907e4d6d866175d', 'tutor', '2023-02-11 23:51:00', NULL, b'1', '2023-02-11 23:57:25', b'0', NULL),
(14, 'GameMopore', 'gamethanarat555@gmail.com', '0820312176', '28312d81e728a01b8450dcae2bacebad', 'tutor', '2023-02-10 06:32:47', 'a65849ac5bf4a71a4052c66d168d3089', b'1', '2023-02-10 06:33:23', b'1', '2023-02-12 11:43:00'),
(15, 'CHACHI', 'chichananchida@gmail.com', '0957767713', 'ed0b065946509aec596c439f93258cf3', 'student', '2023-02-10 13:32:53', '823c8502248950163ca948f71d53b7dc', b'1', '2023-02-10 13:33:43', b'0', NULL),
(16, 'Marcellus', 'natsa48@gmail.com', '0933901063', '77e6b8b36cb3c3fe2bf304dd668be6b9', 'tutor', '2023-02-14 01:11:25', 'f8ede1fa59835689d677f36f0454675c', b'1', '2023-02-14 01:13:28', b'1', '2023-02-14 03:27:37'),
(17, 'surasak', 'surakiart789@gmail.com', '0986782178', 'f9a910bd0d8cb7cd46a5c9c152c7ab83', 'tutor', '2023-02-14 03:17:42', '98f38aa0aae99d5065152a7bee029d9d', b'1', '2023-02-14 03:18:08', b'0', NULL),
(20, 'Kewalin', 'ploy8112543@gmail.com', '0918286392', '57590a1e2313534b5db2278d71666e9c', 'student', '2023-02-15 08:39:39', '116b3e33ae618eef754b2c93183fb392', b'1', '2023-02-15 08:40:03', b'0', NULL),
(22, 'Test1', 'test@gmail.com', '1111111111', '1bbd886460827015e5d605ed44252251', 'tutor', '2023-02-23 19:08:23', '544c754ed9f522cfbd255a23ecd50250', b'0', NULL, b'0', NULL),
(23, 'Siraphat', 'em25122456@gmail.com', '0801653354', 'f6a8b53f32ddf671d09086c71919f494', 'student', '2023-02-25 18:01:00', '8d459a9906039ced5d38c83a660d2eda', b'1', '2023-02-25 18:01:21', b'0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `profile_name` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'default_pic.jpg',
  `profile_cover` varchar(255) DEFAULT 'default_cover.jpg',
  `bio` varchar(200) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT 'ไม่ระบุ',
  `id_card` varchar(13) DEFAULT NULL,
  `coppied_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`id`, `username`, `profile_name`, `profile_pic`, `profile_cover`, `bio`, `first_name`, `last_name`, `dob`, `gender`, `id_card`, `coppied_id`) VALUES
(3, 'kradum', 'ติวเตอร์พี่ไข่มุก', 'a8f15eda80c50adb0e71943adc8015cf.jpg', '006f52e9102a8d3be2fe5614f42ba989.jpg', 'สวัสดีค่ะน้อง ๆ ใครชอบเรียนแบบสบาย ๆ เน้นเข้าใจ เรียนสนุก ต้องพี่เลย ประสบการณ์สอนมากกว่า 3 ปี ^^', 'Chanannicha', 'Arunrueang', '2001-02-14', 'หญิง', NULL, 'user1testfile.pdf'),
(4, 'surakiart595', 'Big_Y4i', 'bf8229696f7a3bb4700cfddef19fa23f.jpg', 'f7e6c85504ce6e82442c770f7c8606f0.jpg', 'เด็กชายผู้พยายามมาตลอด แต่ก็ไม่ได้อะไรเลย', NULL, NULL, NULL, 'ชาย', NULL, NULL),
(5, 'mimigumo', 'mimigumo', 'default_pic.jpg', 'default_cover.jpg', '내가 힘들 때, 울 것 같을 때\n기운도 이젠 나지 않을 때', NULL, NULL, NULL, 'ไม่ระบุ', NULL, NULL),
(6, 'Godon', 'Godon', 'default_pic.jpg', 'default_cover.jpg', NULL, NULL, NULL, NULL, 'ไม่ระบุ', NULL, NULL),
(7, 'pumkie', 'pumkie', 'default_pic.jpg', 'default_cover.jpg', NULL, 'Pum', 'suteemon', '2001-07-27', 'หญิง', '1239948239494', '65b9eea6e1cc6bb9f0cd2a47751a186f.png'),
(8, 'SasithonS', 'SasithonS', '1ff8a7b5dc7a7d1f0ed65aaa29c04b1e.jpg', 'default_cover.jpg', 'Hello', 'ศศิธร', 'แสงนารายณ์', '2001-01-27', 'หญิง', '1105535528654', '1afa34a7f984eeabdbb0a7d494132ee5.pdf'),
(10, 'Nitiphum khanjanthue', 'Nitiphum khanjanthue', 'default_pic.jpg', 'default_cover.jpg', NULL, NULL, NULL, NULL, 'ไม่ระบุ', NULL, NULL),
(11, 'fisho', 'fisho_student', '3def184ad8f4755ff269862ea77393dd.jpg', '0e65972dce68dad4d52d063967f0a705.jpg', 'ฟิชโช่ นักเรียน ชั้น 6/5', NULL, NULL, NULL, 'lgbtq+', NULL, NULL),
(12, 'B6205027', 'B6205027', '8f85517967795eeef66c225f7883bdcb.jpg', 'a8f15eda80c50adb0e71943adc8015cf.jpg', '', NULL, NULL, NULL, 'ชาย', NULL, NULL),
(13, 'tutorwanlop', 'wanlop_tutor', 'bd686fd640be98efaae0091fa301e613.jpg', '82aa4b0af34c2313a562076992e50aa3.jpg', 'ติวเตอร์สอนภาษาเยอรมัน มีประสบการ์สอน 5 ปี ราคาคอร์สเรียนคุ้มค่า', 'วันลบ', 'คิดดิ้ง', '2023-02-21', 'lgbtq+', '1409901824421', 'e00da03b685a0dd18fb6a08af0923de0.pdf'),
(14, 'GameMopore', 'GameMopore', 'default_pic.jpg', 'default_cover.jpg', NULL, 'ธนรัตน์ ', 'พิมตะขบ', '2000-08-28', 'ชาย', '1309902798166', '0336dcbab05b9d5ad24f4333c7658a0e.pdf'),
(15, 'CHACHI', 'chichalovepimma', '07e1cd7dca89a1678042477183b7ac3f.jpg', '82aa4b0af34c2313a562076992e50aa3.jpg', '-alone-', NULL, NULL, NULL, 'lgbtq+', NULL, NULL),
(16, 'Marcellus', 'Marcellus', '2b24d495052a8ce66358eb576b8912c8.jpg', 'default_cover.jpg', 'Hello!!! I am a Geological student who attends and loves English.\nI got 785 scores in TOEIC and can teach English 1-5 of SUT English compulsory subjects.', 'Mangkorn', 'Songsoem', '2000-10-03', 'ไม่ระบุ', '1111111111111', 'fc221309746013ac554571fbd180e1c8.pdf'),
(17, 'surasak', 'surasak', 'default_pic.jpg', 'default_cover.jpg', NULL, 'สุรเกียรติ', 'เนตรวงษ์', '2000-09-24', 'ชาย', '7654321231133', 'eb160de1de89d9058fcb0b968dbbbd68.pdf'),
(20, 'Kewalin', 'Kewalin', 'b73ce398c39f506af761d2277d853a92.jpg', 'default_cover.jpg', 'สวัสดีค่าาา เราเป็นเด็กที่ตั้งใจ และขยันมากๆเลย อยากจะมีความรู้เยอะๆ เอาไว้ไปใช้ในอนาคตค่าาา', NULL, NULL, NULL, 'หญิง', NULL, NULL),
(32, 'Test1', 'Test1', 'default_pic.jpg', 'default_cover.jpg', NULL, 'Test', 'test', '2023-06-22', 'ไม่ระบุ', '', NULL),
(33, 'Siraphat', 'Siraphat', 'default_pic.jpg', 'default_cover.jpg', NULL, NULL, NULL, NULL, 'ไม่ระบุ', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_log`
--
ALTER TABLE `tbl_admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attention`
--
ALTER TABLE `tbl_attention`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_like_course`
--
ALTER TABLE `tbl_like_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offer_reply`
--
ALTER TABLE `tbl_offer_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review_course`
--
ALTER TABLE `tbl_review_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review_student`
--
ALTER TABLE `tbl_review_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tutor_award`
--
ALTER TABLE `tbl_tutor_award`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tutor_contact`
--
ALTER TABLE `tbl_tutor_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tutor_edu`
--
ALTER TABLE `tbl_tutor_edu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tutor_experience`
--
ALTER TABLE `tbl_tutor_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tutor_schedule`
--
ALTER TABLE `tbl_tutor_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_admin_log`
--
ALTER TABLE `tbl_admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_attention`
--
ALTER TABLE `tbl_attention`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_like_course`
--
ALTER TABLE `tbl_like_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_offer_reply`
--
ALTER TABLE `tbl_offer_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_review_course`
--
ALTER TABLE `tbl_review_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_review_student`
--
ALTER TABLE `tbl_review_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_tutor_award`
--
ALTER TABLE `tbl_tutor_award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_tutor_contact`
--
ALTER TABLE `tbl_tutor_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_tutor_edu`
--
ALTER TABLE `tbl_tutor_edu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_tutor_experience`
--
ALTER TABLE `tbl_tutor_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_tutor_schedule`
--
ALTER TABLE `tbl_tutor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
