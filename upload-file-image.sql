-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 13, 2024 at 03:38 AM
-- Server version: 8.4.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upload-file-image`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_news`
--

CREATE TABLE `a_news` (
  `news_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `news_category_id` int NOT NULL,
  `thumbnail_image` varchar(255) DEFAULT 'No_Image_Available.jpg',
  `status_id` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `a_news`
--

INSERT INTO `a_news` (`news_id`, `title`, `description`, `news_category_id`, `thumbnail_image`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'นี่คือสิ่งสำคัญที่ทำให้ Apple Intelligence แตกต่างจาก AI ของบริษัทอื่น', 'งาน WWDC 2024 ที่ผ่านมาเป็นอีกงานที่หลายฝ่ายต่างจับตามองเนื่องจาก Apple เป็นบริษัทยักษ์ใหญ่เพียงรายเดียวที่ล้าหลังเรื่อง AI แต่หลังจากการเปิดตัว Apple Intelligence กลายเป็นบริษัทอื่น ๆ อาจต้องพิจารณา AI ของตัวเองใหม่อีกครั้ง โดยเฉพาะ Google และ Microsoft\r\n\r\nสำหรับ Microsoft นั้นมีหุ้นส่วนกับทาง OpenAI กว่า 10,000 ล้านเหรียญ บริษัทพัฒนา Copilot ที่นำ ChatGPT เข้ามาร่วมประมวลผลในผลิตภัณฑ์ของบริษัท เช่น ตัว Windows รวมถึงแอปพลิเคชันอย่าง Office ส่วน Google ก็เปิดตัว Gemini ที่ผสานเข้ากับผลิตภัณฑ์ของตัวเองรวมถึงเปิดให้ผู้ผลิตสมาร์ตโฟน Android สามารถเข้าถึงบริการนี้ได้ด้วยรูปแบบคลาวด์ และสุดท้ายคือ AI ของ Apple ที่ใช้ชื่อว่า Apple Intelligenc', 2, '20240613_103521_IMG_02.png', 1, '2024-06-13 03:35:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `a_news_category`
--

CREATE TABLE `a_news_category` (
  `news_category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `a_news_category`
--

INSERT INTO `a_news_category` (`news_category_id`, `category_name`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'ทั่วไป', 1, '2024-03-17 08:38:54', NULL),
(2, 'ข่าว', 1, '2024-03-17 08:38:54', NULL),
(3, 'อื่นๆ', 1, '2024-04-10 17:46:55', '2024-06-13 03:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `a_news_filename`
--

CREATE TABLE `a_news_filename` (
  `news_filename_id` int NOT NULL,
  `news_id` int NOT NULL,
  `news_filename` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `a_news_filename`
--

INSERT INTO `a_news_filename` (`news_filename_id`, `news_id`, `news_filename`, `created_at`, `updated_at`) VALUES
(13, 1, '20240613_103522_ทดสอบ_upload_ไฟล์_pdf.pdf', '2024-06-13 03:35:22', NULL),
(14, 1, '20240613_103522_ทดสอบ_upload_ไฟล์_powerpoint.pptx', '2024-06-13 03:35:22', NULL),
(15, 1, '20240613_103522_ทดสอบ_upload_ไฟล์_word.docx', '2024-06-13 03:35:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_status`
--

CREATE TABLE `m_status` (
  `status_id` int NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `m_status`
--

INSERT INTO `m_status` (`status_id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'ใช้งาน', '2023-09-28 16:45:52', '2023-09-28 09:45:52'),
(2, 'ยกเลิก', '2023-09-28 16:45:52', '2024-04-11 09:38:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_news`
--
ALTER TABLE `a_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `a_news_category`
--
ALTER TABLE `a_news_category`
  ADD PRIMARY KEY (`news_category_id`);

--
-- Indexes for table `a_news_filename`
--
ALTER TABLE `a_news_filename`
  ADD PRIMARY KEY (`news_filename_id`);

--
-- Indexes for table `m_status`
--
ALTER TABLE `m_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_news`
--
ALTER TABLE `a_news`
  MODIFY `news_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `a_news_category`
--
ALTER TABLE `a_news_category`
  MODIFY `news_category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `a_news_filename`
--
ALTER TABLE `a_news_filename`
  MODIFY `news_filename_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_status`
--
ALTER TABLE `m_status`
  MODIFY `status_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
