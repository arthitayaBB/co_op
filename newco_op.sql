-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2025 at 06:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminn`
--

CREATE TABLE `adminn` (
  `Admin_id` int(11) NOT NULL,
  `Ad_name` varchar(100) DEFAULT NULL,
  `Ad_surname` varchar(100) DEFAULT NULL,
  `Ad_phone` varchar(10) DEFAULT NULL,
  `Ad_email` varchar(100) DEFAULT NULL,
  `Ad_pwd` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminn`
--

INSERT INTO `adminn` (`Admin_id`, `Ad_name`, `Ad_surname`, `Ad_phone`, `Ad_email`, `Ad_pwd`) VALUES
(1, 'นายปวริศ ', 'มหาชัยโย', '0873698542', 'Pawarit@gmail.com', '$2y$10$fI5GD/YUfx6pPz1yhjelgOA48Z5mMXrm/w2bgkbs20WK5ekdZ5YtK'),
(2, 'นางสาวภิญญดา ', 'สุวรรณกิตติ ', '0651236845', 'Phinyada@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `advice`
--

CREATE TABLE `advice` (
  `advice_id` int(11) NOT NULL,
  `Workbenefit` text DEFAULT NULL,
  `Std_id` bigint(20) DEFAULT NULL,
  `Company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advice`
--

INSERT INTO `advice` (`advice_id`, `Workbenefit`, `Std_id`, `Company_id`, `created_at`) VALUES
(2, 'เบี้ยเลี้ยง500', 65010912516, 10403, '2025-04-27 16:02:35'),
(3, 'เบี้ยเลี้ยง500', 65010912516, 10403, '2025-04-27 16:02:35'),
(4, 'เบี้ยเลี้ยงรายวัน200', 65010912516, 10403, '2025-04-27 16:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `advisor_id` int(11) NOT NULL,
  `Tec_id1` int(11) DEFAULT NULL,
  `Tec_id2` int(11) DEFAULT NULL,
  `Std_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advisor_id`, `Tec_id1`, `Tec_id2`, `Std_id`) VALUES
(256, 1101, 1102, 65010912501),
(257, 1101, 1102, 65010912502),
(258, 1101, 1102, 65010912503),
(259, 1101, 1102, 65010912504),
(260, 1101, 1102, 65010912505),
(261, 1103, 1104, 65010912506),
(262, 1103, 1104, 65010912507),
(263, 1103, 1104, 65010912508),
(264, 1103, 1104, 65010912510),
(265, 1105, 1106, 65010912509),
(266, 1105, 1106, 65010912511),
(267, 1105, 1106, 65010912512),
(268, 1105, 1106, 65010912513),
(269, 1105, 1106, 65010912514),
(270, 1105, 1106, 65010912515),
(272, 1107, 1108, 65010912516),
(273, 1107, 1108, 65010912517),
(274, 1107, 1108, 65010912518),
(275, 1107, 1108, 65010912519),
(276, 1107, 1108, 65010912520),
(278, 1109, 1110, 65010912521),
(279, 1109, 1110, 65010912522),
(280, 1109, 1110, 65010912523),
(281, 1109, 1110, 65010912524),
(282, 1109, 1110, 65010912525),
(283, 1111, 1112, 65010912526),
(284, 1111, 1112, 65010912527),
(285, 1111, 1112, 65010912528),
(286, 1111, 1112, 65010912529),
(287, 1111, 1112, 65010912530),
(288, 1113, 1114, 65010912531),
(289, 1113, 1114, 65010912532),
(290, 1113, 1114, 65010912533),
(291, 1113, 1114, 65010912534),
(292, 1113, 1114, 65010912535),
(294, 1115, 1116, 65010912536),
(295, 1115, 1116, 65010912537),
(296, 1115, 1116, 65010912538),
(297, 1115, 1116, 65010912539),
(298, 1115, 1116, 65010912540),
(321, 1105, 1106, 65109125788);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `Bn_id` int(11) NOT NULL,
  `Bn_explain` varchar(200) NOT NULL,
  `Bn_image` varchar(200) NOT NULL,
  `Bn_status` varchar(200) NOT NULL COMMENT '	1=แสดง 0=ไม่แสดง	',
  `Admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`Bn_id`, `Bn_explain`, `Bn_image`, `Bn_status`, `Admin_id`) VALUES
(111101, 'เปิดรับนิสิตฝึกงานสหกิจ ตั้งเเต่วันที่ 20 พฤษภาคม-20มีนาคม 2569', 'Bn1.png', '1', 1),
(111102, 'ข้อเเตกต่างฝึกงานเเละฝึกงานสหกิจ', 'Bn2.png', '1', 1),
(111103, 'ข้อดีของการฝึกงานสหกิจ', 'Bn3.png', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Company_id` int(11) NOT NULL,
  `NamecomTH` varchar(255) DEFAULT NULL,
  `NamecomEng` varchar(255) DEFAULT NULL,
  `Company_add` varchar(255) DEFAULT NULL,
  `Province` varchar(100) DEFAULT NULL,
  `Com_phone` varchar(10) DEFAULT NULL,
  `Zip_id` varchar(10) DEFAULT NULL,
  `Com_email` varchar(100) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `Contact_com` varchar(100) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `Duration` varchar(50) DEFAULT NULL,
  `Job_description` text DEFAULT NULL,
  `Fax_number` varchar(20) DEFAULT NULL,
  `Map` text DEFAULT NULL,
  `Academic_year` int(11) DEFAULT NULL,
  `Major_id` int(11) NOT NULL,
  `welfare` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_id`, `NamecomTH`, `NamecomEng`, `Company_add`, `Province`, `Com_phone`, `Zip_id`, `Com_email`, `Website`, `Contact_com`, `Position`, `Duration`, `Job_description`, `Fax_number`, `Map`, `Academic_year`, `Major_id`, `welfare`) VALUES
(10101, 'บริษัท เอเอ็นเอส ออดิท จำกัด', 'ANS Audit Co., Ltd', 'เลขที่ 100/72,100/2 ชั้นที่ 22 อาคารว่องวานิชคอมเพล็กซ์ บี ถนนพระราม 9 แขวงห้วยขวาง เขตห้วยขวาง  ', 'กรุงเทพมหานคร', '026450109', '10310', 'atipong@crowe-ans.co.th', 'www.ans.co.th', 'คุณนพกร เทียนทอง', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'ให้บริการตรวจสอบบัญชีแก่บริษัทจดทะเบียนในตลาดหลักทรัพย์ บริษัทข้ามชาติ และบริษัทท้องถิ่น', '026450110', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15501.597151575894!2d100.55518223955082!3d13.75477810000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f78f8ae4919%3A0xb8f3df9e42b94b84!2sANS%20Audit%20Co.%2C%20Ltd.!5e0!3m2!1sth!2sth!4v1739778704271!5m2!1sth!2sth\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade', 2567, 101, '-'),
(10102, 'บริษัท รุ่งนภาการบัญชี จำกัด', 'Rungnapa Accounting Co., Ltd', 'เลขที่ 14 ซอยจรัญสนิทวงศ์ 61 แขวงบางบำหรุ เขตบางพลัด ', 'กรุงเทพมหานคร ', '024335013', '10700', 'rungnapa_account@hotmail.com', 'https://data.creden.co/company/general/0105556008743', 'คุณณรงค์พันธ์ รัตนปนัดดา', 'ผู้จัดการ', '4 เดือน', 'ให้บริการด้านการทำบัญชี การตรวจสอบบัญชี และการให้คำปรึกษาด้านภาษี ', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3831.596579665183!2d103.28425007513842!3d16.18974138450734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122a6be7ce7f04f%3A0x27c2a1a8556c00b8!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4o-C4uOC5iOC4h-C4meC4oOC4suC4geC4o-C4uOC5iuC4myDguIjguLPguIHguLHguJQg4Liq4Liy4LiC4LiyIOC4oeC4q-C4suC4quC4suC4o-C4hOC4suC4oQ!5e0!3m2!1sth!2sth!4v1739185386154!5m2!1sth!2sth', 2567, 101, 'เบี้ยเลี้ยงรายวัน'),
(10103, 'บริษัท สำนักงานอีวาย จำกัด', 'EY Company Limited', 'เลขที่ 193/136-137 อาคารเลคยรัชดา ออฟฟิศคอมเพล็กซ์ ชั้น 33 ถนนรัชดาภิเษก แขวงคลองเตย เขตคลองเตย ', 'กรุงเทพมหานคร', '0226409090', '10110', 'jarinya.fueangnoi@th.ey.com', 'https://www.ey.com/en_th', 'คุณกนกณัฐ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'ให้คำปรึกษาทางการเงิน การตรวจสอบบัญชี และบริการด้านภาษี', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.7846021529976!2d100.5578488750899!3d13.731486786658223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f1b877bf439%3A0x408a73eb767df3f2!2zRVkgQ29tcGFueSBMaW1pdGVkIHwg4Lia4LiI4LiBLiDguKrguLPguJnguLHguIHguIfguLLguJkg4Lit4Li14Lin4Liy4Lii!5e0!3m2!1sth!2sth!4v1739779500607!5m2!1sth!2sth\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade', 2567, 101, '-'),
(10104, 'บริษัท ธนเสฏฐ์ คอนซัลติ้งค์ จำกัด', 'Tanasate Consulting Co., Ltd', 'เลขที่ 98 หมู่ที่ 2 ซอยงามวงศ์วาน23 ถนนงามวงศ์วาน ตำบลบางเขน อำเภอเมือง ', 'นนทบุรี', '0816559307', '11000', '-', 'www.tanasate.com', 'คุณจีระนันท์', 'กรรมการผู้จัดการ', '4 เดือน', 'ให้บริการด้านบัญชีและภาษีอากร รวมถึงการจัดทำรายงานเงินเดือน การยื่นแบบแสดงรายการภาษีอากร และการจดทะเบียนจัดตั้งบริษัท', '025802098', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.637448790964!2d100.53212747506352!3d13.860787994760992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ca8af024475%3A0x96242acf0abd2af8!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4mOC4meC5gOC4quC4j-C4kOC5jCDguK3guK3guJTguLTguJcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739182982184!5m2!1sth!2sth', 2567, 101, '-'),
(10105, 'บริษัท มิเนอร์วา ออดิทติ้ง จำกัด', 'MINERVA AUDITING SERVICE COMPANY LIMITED', 'เลขที่ 58/54 ซอยกำนันแม้น 3 แขวงคลองบางพราน เขตบางบอน ', 'กรุงเทพมหานคร ', '0867898263', '10150', 'porntip@mservice.co.th', 'https://www.matchlink.asia/th/business/page/Thailand/BANGKOK/51686-minerva-auditing-service-co-ltd.html', 'คุณพรทิพย์ วิญญปกรณ์', 'ผู้จัดการ', '4 เดือน', 'การทำบัญชีและตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.9932909489635!2d102.834862975104!3d16.42516712981098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228a2674b34095%3A0x3b31b36e89e61070!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4muC4tS7guKfguLUuIOC4geC4suC4o-C4muC4seC4jeC4iuC4teC5geC4peC4sOC4oOC4suC4qeC4teC4reC4suC4geC4oyAo4LiC4Lit4LiZ4LmB4LiB4LmI4LiZKSDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739187178121!5m2!1sth!2sth', 2567, 101, '-'),
(10106, 'บริษัท โปรแอค แอนด์ ออดิท จำกัด', 'PRO ACC & AUDIT COMPANY LIMITED', 'เลขที่ 31 หมู่ที่ 2 ถนนหนามแดง-บางพลี ตำบลบางแก้ว อำเภอบางพลี ', 'สมุทรปราการ ', '027102454', '10540', 'proaccandaudit@hotmail.com', 'https://proaccandaudit.com', 'คุณนววิทย์', 'ผู้จัดการ', '4 เดือน', 'การให้บริการด้านบัญชีและภาษีอากร จดทะเบียนบริษัท BOI ', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9460422487705!2d100.4969711750615!3d13.721716597989406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2bb51e79a2811%3A0x5a4d84c96b6ff9e6!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4ruC4suC5guC4pSDguYHguK3guITguYDguITguLLguJfguYwg4LiI4Liz4LiB4Lix4LiUIEhhbG8gQWNjb3VudCBjby4sTHRkLg!5e0!3m2!1sth!2sth!4v1739187243524!5m2!1sth!2sth', 2567, 101, '-'),
(10107, 'บริษัท โรเดิ้ล แอนด์ พาร์ทเนอร์ ออดิท เซอร์วิสเซส จำกัด', 'Rödl & Partner Audit Services Company Limited', 'อาคารเอ็มไพร์ทาวเวอร์ ถนนสาทรใต้ แขวงยานาวา เขตสาทร ', 'กรุงเทพมหานคร ', '026700472', '10120', 'suporn.visitvoranat@roedl.com', 'https://www.roedl.com/about-us/locations/thailand/', 'คุณสุพร', '', '4 เดือน', 'กิจกรรมเกี่ยวกับบัญชี การทำบัญชีและะตรวจสอบบัษชี ให้คำปรึกษาด้านภาษี ', '026700673', '', 2567, 101, '-'),
(10108, 'บริษัท สำนักงานดร.วิรัช แอนด์ แอสโซซิเอทส์ จำกัด', 'DR.VIRACH & ASSCOCIATES OFFICE COMPANY LIMITED', 'เลขที่ 518/3 อาคารมณียาเซ็นเตอร์ นอธ ชั้น7 ถนนเพลินจิต แขวงลุมพินี เขตปทุมวัน', 'กรุงเทพมหานคร', '022500634', '10330', 'virach5183@yahoo.com', 'https://www.vaaudit.com/', 'คุณจิตต์อารีย์ หัตถโชติ', 'หัวหน้าฝ่ายทรัพยากรบุคคล', '4 เดือน', 'บริการด้านการตรวจสอบบัญชี วางเเผนรูปเเบบบัญชี ให้คำเเนะนำทางด้านบัญชี', '0-21250029', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.677040944416!2d100.55597637506172!3d13.737992497613108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f5007db047d%3A0xa63641bf8d3433eb!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4quC4s-C4meC4seC4geC4h-C4suC4mSDguYDguK0g4LmB4Lit4LiZ4LiU4LmMIOC5gOC4rSDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739187365217!5m2!1sth!2sth', 2567, 101, '-'),
(10109, 'บริษัท พีเคเอฟ ออดิท (ประเทศไทย) จำกัด', ' PKF AUDIT (THAILAND) COMPANY LIMITED', 'เลขที่ 98 อาคารสาทรสแควร์ ออฟฟิศทาวเวอร์ ชั้นที่ 28 ยูนิต 2808และ2812 ถนนสาทรเหนือ แขวงสีลม เขตบางรัก ', ' กรุงเทพมหานคร', '0639873999', '10500', 'lalita.u@pkf.com', 'https://www.pkfthailand.asia', 'คุณลลิตา															', '-', '4 เดือน', 'เกี่ยวกับบัญชีการทำบัญชีและการตรวจสอบบัญชี', '021081591', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62009.213521077865!2d100.50083396990122!3d13.744110451686717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29c32ab386d2f%3A0xb12a1107d9e92622!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4nuC4teC5gOC4hCDguK3guK3guJTguLTguJcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739182597364!5m2!1sth!2sth\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade', 2567, 101, '-'),
(10110, 'บริษัท ธนไชยกุล สอบบัญชี จำกัด', 'THANACHAIKUL AUDIT COMPANY LIMITED', 'เลขที่ 17/6 หมู่ที่ 12 ตำบลคลองข่อย อำเภอปากเกร็ด ', 'นนทบุรี', '021944136', '11120', 'taaudit2009@gmail.com', '-', 'คุณกุหลาบ วิลุนนะหุย', 'ผู้ช่วยตรวจสอบบัญชี', '4 เดือน', 'งานตรวจสอบบัญชี งานบัญชีวางแผนภาษี วางระบบบัญชี และอื่น ๆ ตามที่ได้รับมอบหมาย', '021944136', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.863945620876!2d100.43115627506496!3d13.96670289228184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e28fe15d03056f%3A0xa371845585cff380!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4mOC4meC5hOC4iuC4ouC4geC4uOC4pSDguKrguK3guJrguJrguLHguI3guIrguLUg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739183809309!5m2!1sth!2sth', 2567, 101, '-'),
(10111, 'บริษัท สอบบัญชี วาย.เค จำกัด', 'Y.K. AUDITING COMPANY LIITED', 'เลขที่ 9/10 ถนนโชคชัย4 แขวงลาดพร้าว เขตลาดพร้าว', 'กรุงเทพมหานคร ', '0816207983', '10230', 'ykaudit2011@gmail.com', 'https://ykta.co.th', 'คุณคนึงวิภา อาจิตรนุภาพ', 'ผู้จัดการ', '4 เดือน', 'ตรวจสอบบัญชี ทำบัญชี', '029314635', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.3992464949597!2d100.59512057506284!3d13.815048495826064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29d9885ea0d89%3A0xbc4c3681bb9f505b!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4quC4reC4muC4muC4seC4jeC4iuC4tSDguKfguLLguKIu4LmA4LiELiDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739183854968!5m2!1sth!2sth', 2567, 101, 'เบี้ยเลี้ยงวันละ 250-300 บาท/วัน และสวัสดิการอื่น มีโบนัสหลังปิดงบ'),
(10112, 'บริษัท เคเอ็นบี ออดิท จำกัด', 'KNB AUDIT COMPANY LIMITED', 'เลขที่ 231 ถนนเทอดไท แขวงปากคลองภาษีเจริญ เขตภาษีเจริญ ', 'กรุงเทพมหานคร ', '0853502422', '10160', '-', '-', 'คุณกิตติ ', 'กรรมการผู้จัดการ', '4 เดือน', 'ให้บริการจัดทำบัญชี ตรวจสอบบัญชี', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.099108202916!2d100.43653247506137!3d13.712446898203472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e297a726cce619%3A0x5b0eb97e2ddb2c16!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4hOC5gOC4reC5h-C4meC4muC4tSDguK3guK3guJTguLTguJcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739183923448!5m2!1sth!2sth', 2567, 101, '-'),
(10113, 'บริษัท เค.แอคเคาน์ติ้งเซอร์วิช จำกัด', 'K.ACCOUNTING SERVICES COMPANY LIMITED', 'เลขที่ 47/1 ถนนเทศบาลรังสฤษดิ์เหนือ แขวงลาดยาว เขตจตุจักร ', 'กรุงเทพมหานคร', '02-9538250', '10900', 'kgroup2537@hotmail.com', 'https://www.k-accountingservices.co.th/', 'คุณแพรวดาว ห่อเพชร', 'เจ้าหน้าที่ธุรการ', '4 เดือน', 'ให้บริการทางด้าน บัญชี ภาษีอากร ตรวจสอบบัญชี การจัดการทั่วไป เช่น วางระบบบัญชี และการควบคุมภายใน ฯลฯ จดทะเบียนธุรกิจฯ', '029538252', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.9599237299253!2d100.54187887506322!3d13.841444195211828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29dc02719569d%3A0x906e01737cb3878e!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4hC7guYHguK3guITguYDguITguLLguJnguYzguJXguLTguYnguIcg4LmA4LiL4Lit4Lij4LmM4Lin4Li04LiqIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739184323036!5m2!1sth!2sth', 2567, 101, '-'),
(10114, 'บริษัท ภูมิไทย สอบบัญชี จำกัด', 'PHOOMTHAI AUDIT COMPANY LIMITED', 'เลขที่ 141/25 อาคารสกุลไทยสุรวงศ์ทาวเวอร์ชั้น20 ยูนิค 20A ถนนสุรวงศ์ แขวงสุริยวงศ์ เขตบางรัก ', 'กรุงเทพมหานคร', '021265416', '10500', 'wpiangpornpen@gmail.com', '-', 'คุณวิรัญญา เพียพรเพ็ญ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'บริษัทให้บริการด้าน งานตรวจสอบบัญชี ครอบคลุมทั้ง External Audit, Internal Audit, IT Audit, วางระบบบัญชี รวมถึงให้คำปรึกษาทางด้านบัญชี และภาษีอากร', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.827222694385!2d100.52670407506159!3d13.728908097823169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2992291be6f37%3A0xdc7eddef6c6206cd!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4oOC4ueC4oeC4tOC5hOC4l-C4oiDguKrguK3guJrguJrguLHguI3guIrguLUg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739184603304!5m2!1sth!2sth', 2567, 101, '-'),
(10115, 'บริษัท เรืองหิรัญการบัญชีและกฎหมาย จำกัด', 'RUEANGHIRUN ACCOUNT AND LAW COMPANY LIMITED', 'เลขที่ 9/9 หมู่ที่ 5 ถนนเลียบคลองสาม อำเภอคลองหลวง ', 'ปทุมธานี', '0982498699', '12120', '-', 'http://www.banbunchee.com/', 'คุณจุฑามาศ เจ็ดประโคน', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'รับจัดทำบัญชี วางระบบบัญชี รับเป็นที่ปรึกษาทางบัญชีและภาษีอากร', '020902284', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3870.380339947691!2d100.66129877506626!3d14.054703890208643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d804d6073330d%3A0x126aa698567e2a91!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4o-C4t-C4reC4h-C4q-C4tOC4o-C4seC4jeC4geC4suC4o-C4muC4seC4jeC4iuC4teC5geC4peC4sOC4geC4juC4q-C4oeC4suC4oiDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739184842917!5m2!1sth!2sth\" width=\"600\" height=\"450\" style=\"border:0; ', 2567, 101, 'วันละ 100 บาท(ช่วยนอกเหนือเวลาฝึกงาน ตอบแทน 2 เท่า)'),
(10116, 'บริษัท เอ็กซ์เซลเลนท์ ออดิติ้ง จำกัด', 'EXCELLENT AUDITING COMPANY LIMITED', 'เลขที่ 176/1 อาคารเรืองน้ำมนต์ ซอยอินทามระ 22 ถนนสุทธิสาร แขวงดินแดง เขตดินแดง ', 'กรุงเทพมหานคร', '022777613', '10400', 'excellent.audit@gmail.com', '-', 'คุณสุนิสา ใจไธสง', 'ฝ่ายทรัพยากรบุคคล', '4เดือน', 'ให้บริการด้าน กิจกรรมเกี่ยวกับบัญชีการทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี', '022777614', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.9750020696165!2d100.56070877509077!3d13.78038048661443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29c27dfe862e3%3A0x8e5b26adebd80960!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4reC5h-C4geC4i-C5jOC5gOC4i-C4peC5gOC4peC4meC4l-C5jCDguK3guK3guJTguLTguJXguLTguYnguIcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739185034903!5m2!1sth!2sth', 2567, 101, '-'),
(10117, 'บริษัท ที่ปรึกษาตรวจสอบบัญชีและภาษีอาการ จำกัด', 'AUDITING AND TAX CONSULTANT COMPANY LIMITED', 'เลขที่ 45/673-675 ซอยรามคำแหง 58/3 ถนนรามคำแหง แขวงหัวหมาก เขตบางกะปิ ', 'กรุงเทพมหานคร', '0864451665', '10240', 'aandt2544@yahoo.com', '-', 'คุณพรชาตรี', 'กรรมการผู้จัดการ', '4 เดือน', 'บริการงานด้านบัญชี ภาษีอากร การสอบบัญชีและบริการอื่นที่เกี่ยวข้องกับวิชาชีพบัญชี', '024809988', '', 2567, 101, '-'),
(10118, 'บริษัท ยูนีค แอดไวเซอร์ จำกัด', 'UNIQUE ADVISOR COMPANY LIMITED', 'เลขที่ 253 ซอย 21 ถนนสุขุมวิท (อโศก) แขวงคลองเตยเหนือ เขตวัฒนา  ', 'กรุงเทพมหานคร', '022619699', '10110', '-', 'http://www.u-advisor.com/', 'คุณโกศล', 'กรรมการผู้จัดการ', '4 เดือน', 'ธุรกิจ ที่ปรึกษาการเงิน การบัญชี บริการวางระบบบัญชี', '022619697', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.5838136174675!2d100.55148447506181!3d13.7436287974827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ee7b862d815%3A0xc8ad8abf30cb87a3!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4ouC4ueC4meC4teC4hCDguYHguK3guJTguYTguKfguYDguIvguK3guKPguYwg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739185679224!5m2!1sth!2sth', 2567, 101, '-'),
(10119, 'บริษัท บูรพา บีเอ็น ออดิท จำกัด', 'East BN Audit Co., Ltd', 'เลขที่ 119 อาคารบี ไอ เอส ห้อง 2D46 ชั้น 2 ถนนมเหสักข์ แขวงสุริยวงศ์ เขตบางรัก', ' กรุงเทพมหานคร', '0868059568', '10150', 'east.audut@gmail.com', 'http://www.ebnaudit.com/?lang=th', 'คุณวชิรา', 'ผู้ช่วยตรวจสอบบัญชี', '4 เดือน', 'ตรวจสอบบัญชีภายในให้กับบริษัทจดทะเบียนในตลาดหลักทรัพย์และบริษัทIPO  ให้คำปรึกษาด้านการบัญชี การสอบบัญชี และภาษีอากร ', '026356600', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.745277410815!2d100.6472936750634!3d13.854322794911688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d6304bb5a5a4d%3A0x8e86cc5b31ccb15e!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4hCDguYDguK3guKog4Lie4Li1IOC5gOC4n-C4reC4o-C5jOC4meC4tOC5gOC4iOC4reC4o-C5jCDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739186260073!5m2!1sth!2sth', 2567, 101, 'ทำงานสัปดาห์ละ 5 วัน ค่าฝึกงาน ขนมน้ำดื่มกาแฟและน้ำอัดลม'),
(10120, 'บริษัท ยูนีค ออดิท จำกัด', 'UNIQUE AUDIT COMPANY LIMITED', 'เลขที่ 678/306 หมู่บ้านดิเอ็กซ์คลูซีฟ ซอยพัฒนาการ 44 ถนนพัฒนาการ แขวงพัฒนาการ เขตสวนหลวง ', 'กรุงเทพมหานคร', '0944876767', '10310', 'info@uniqueaudit.com', 'http://www.uniqueaudit.com/', 'คุณจิตติณัฏฐ์', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'ตรวจสอบบัญชี,ทำบัญชีและที่ปรึกษา', '027166100', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.582324666546!2d100.58415477506188!3d13.74371879748066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29eee1d5b01c9%3A0x2193c4e4d0a00572!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4ouC4ueC4meC4teC4hCDguK3guK3guJTguLTguJcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739186020727!5m2!1sth!2sth', 2567, 101, 'หยุดวันเสาร์ – อาทิตย์ และวันหยุดตามประเพณีของบริษัท เบี้ยเลี้ยง วันละ 350 บาท'),
(10121, 'บริษัท ซัคเซส แอคเค้าน์ โซลูชั่น จำกัด', 'SUCCESS ACCOUNT SOLUTION CO., LTD.', 'เลขที่ 6 ซอยบางแวก 30 แขวงบางแวก เขตภาษีเจริญ ', 'กรุงเทพมหานคร', '0944174992', '10160', 'successa765@gmail.com', 'https://www.successaccsolution.com/%E0%B8%9F%E0%B8%9F', 'คุณณัฐนันท์ ', 'กรรมการผู้จัดการ', '4 เดือน', 'การทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.6685787087736!2d100.44604447506175!3d13.738504197601259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29933715e686b%3A0x5c397aaa869fdaf!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4i-C4seC4hOC5gOC4i-C4qiDguYHguK3guITguYDguITguYnguLLguJnguYwg4LmC4LiL4Lil4Li54LiK4Lix4LmI4LiZIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739186188105!5m2!1sth!2sth', 2567, 101, '-'),
(10122, 'บริษัท ซีพีเอเอ็ม จำกัด', 'CPAM COMPANY LIMITED', 'เลขที่ 1/161-1/162 ซอยวัชรพล 2/7 ถนนวัชรพล แขวงท่าแร้ง เขตบางเขน', 'กรุงเทพมหานคร', '0202414703', '10220', 'finance@brainworks.co.th', '-', 'คุณจรัญญา', 'ผู้ช่วยตรวจสอบบัญชี', '4 เดือน', 'การทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี ให้บริการตรวจสอบบัญชี และจัดทำบัญชี', '025105798', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.745277410815!2d100.6472936750634!3d13.854322794911688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d6304bb5a5a4d%3A0x8e86cc5b31ccb15e!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4hCDguYDguK3guKog4Lie4Li1IOC5gOC4n-C4reC4o-C5jOC4meC4tOC5gOC4iOC4reC4o-C5jCDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739186260073!5m2!1sth!2sth', 2567, 101, 'เบี้ยเลี้ยงและเงินค่าเดินทางกรณีออกปฏิบัติงานนอกสถานที่'),
(10123, 'บริษัท ทีเอซี บิซิเนส จำกัด', ' TAC BUSINESS COMPANY LIMITED', 'เลขที่ 118/127-129 หมู่ที่14 ถนนมิตรภาพ 25 ตำบลในเมือง อำเภอเมือง ', 'ขอนแก่น', '0432396289', '40000', 'tac.business_a@hotmail.com', '-', 'คุณวราภรณ์ ', 'ผู้จัดการ', '4 เดือน', 'สำนักงานบัญชี รับจัดทำบัญชีและให้คำปรึกษาด้านภาษีอากร ตรวจสอบบัญชี จดทะเบียน', '043243691', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.1814552148944!2d102.83094447510464!3d16.466347128684472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228b1334ecec69%3A0x19e8d8b919bbed!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4l-C4tSDguYDguK0g4LiL4Li1IOC4muC4tOC4i-C4tOC5gOC4meC4qiDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739186335361!5m2!1sth!2sth', 2567, 101, '-'),
(10124, 'บริษัท ฟิเดส ออดิท จำกัด', 'FIDES AUDIT COMPANY LIMITED', 'เลขที่ 92/18-19 อาคารสาธรธานี 2 ชั้นที่ 9 ถนนสาทรเหนือ แขวงสีลม เขตบางรัก ', 'กรุงเทพมหานคร', '0878060305', '10500', 'benjaporn.mahh@gmail.com', 'http://fidesaccounting.com/index.php?sw=th&mode=contact', 'คุณเบญจพร', 'ผู้จัดการทั่วไป', '4 เดือน', 'กิจกรรมเกี่ยวกับบัญชีการทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี', '024416058', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.929629405111!2d100.52825767506161!3d13.722710197966428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29fb98a0916cf%3A0x86fc250c7d3c22b8!2zRmlkZXMgQXVkaXQgQ28uLCBMdGQuICjguJrguKPguLTguKnguLHguJcg4Lif4Li04LmA4LiU4LiqIOC4reC4reC4lOC4tOC4lyDguIjguLPguIHguLHguJQp!5e0!3m2!1sth!2sth!4v1739186419632!5m2!1sth!2sth', 2567, 101, 'ค่าเบี้ยเลี้ยง'),
(10125, 'บริษัท ตรวจสอบภายในธรรมนิติ จำกัด', 'DHARMNITI INTERNAL AUDIT COMPANY LIMITED', 'เลขที่ 178 อาคารธรรมนิติ ชั้น 5 ซอยเพิ่มทรัพย์ (ประชาชื่น20) ถนนประชาชื่น แขวงบางซื่อ เขตบางซื่อ ', 'กรุงเทพมหานคร', '025690500 ', '10800', 'thunyaluk@dharmniti.co.th', 'https://www.dir.co.th/th/', 'คุณธัญลักษณ์ ', 'หัวหน้างานบุคคล', '4 เดือน', 'ให้บริการด้าน ตรวจสอบภายใน (Internal Audit) ประเมินระบบควบคุมภายใน บริหารความเสี่ยงองค์กร ตรวจสอบระบบ IT และ ให้คำปรึกษาด้าน PDPA', '025960500 ', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124029.66445434549!2d100.44843072862116!3d13.722868510719415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f055796a2c3%3A0xd94cbb26409223e0!2sDIA%20International%20Audit%20Co.%2C%20Ltd.%20(Head%20Office)!5e0!3m2!1sth!2sth!4v1739186587857!5m2!1sth!2sth', 2567, 101, '-'),
(10126, 'บริษัท สอบบัญชี ดี ไอ เอ อินเตอร์เนชั่นแนล จำกัด', 'D I A INTERNATIONAL AUDIT COMPANY LIMITED', 'เลขที่ 954 ถนนอ่อนนุช แขวงสวนหลวง เขตสวนหลวง ', 'กรุงเทพมหานคร ', '023325126', '10250', 'rattha@diaaudit.com,dia@diaaudit.com', 'https://www.diaaudit.com/careers', 'คุณรัฐฐาน์', 'ฝ่ายประสานงาน', '4 เดือน', 'ทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี', '024809988', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.316960956153!2d100.5333542750629!3d13.819996195710981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29b8d1febcc21%3A0x31d3c41c7ee3a583!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4leC4o-C4p-C4iOC4quC4reC4muC4oOC4suC4ouC5g-C4meC4mOC4o-C4o-C4oeC4meC4tOC4leC4tCDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739186683165!5m2!1sth!2sth', 2567, 101, 'เบี้ยเลี้ยงต่อวัน 250/วัน ที่พัก'),
(10127, 'สำนักงานบ้านบัญชีและภาษีอากร', 'HOUSE ACCOUNT AND TAX OFFICE COMPANY LIMITED', 'ตำบลหัวขวาง อำเภอโกสุมพิสัย', ' มหาสารคาม', '043761210', '44140', 'homeaccounting@hotmail.com', 'http://www.baanbunchee.com', 'คุณจุฑารัตน์', '-', '4 เดือน', 'ให้คำปรึกษาและวางแผนภาษีอากรทุกประเภท จัดวางแผนภาษีที่ต้องยื่นนำส่งกรมสรรพากรรายปีพร้อมบริการยื่นชำระภาษี สอบทานการคำนวณภาษีครึ่งปี และจัดเตรียมแบบนำส่งภาษีเงินได้ฯครึ่งปี รับรองงบการเงินโดยผู้ตรวจสอบมาตรฐาน', '027260236', '', 2567, 101, '-'),
(10128, 'บริษัท สำนักงานเอ็ม เอ็ม เอ็น ซินดิเคท จำกัด', 'MMN Syndicate Office Co., Ltd.', 'เลขที่ 3312/19 ซอยลาดพร้าว 101 ถนนลาดพร้าว แขวงคลองจั่น เขตบางกะปิ ', 'กรุงเทพมหานคร', '027369593', '10240', 'mmm@mmnsyn.com,info@mmnsyn.com', 'https://www.mmnsyn.com', '-', '-', '4 เดือน', 'เป็นธุรกิจกิจกรรมเกี่ยวกับบัญชีการทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี', '027369593', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.7595636912124!2d100.62548967506255!3d13.793362696329988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d620c14382c8d%3A0x451c3fdff32296d1!2sMMN%20Syndicate%20Office%20Company%20Limited!5e0!3m2!1sth!2sth!4v1739187005689!5m2!1sth!2sth', 2567, 101, 'อัตราค่าจ้าง 200 บาทต่อวัน'),
(10129, 'บริษัท บี.วี การบัญชีและภาษีอากร (ขอนแก่น) จำกัด', 'B.V.ACCOUNTING & TAX (KHONKAEN) CO., LTD', 'เลขที่ 20,13-15 ซอยชวนชื่น1 ตำบลในเมือง อำเภอเมืองขอนแก่น', 'ขอนแก่น', '043320635', '40000', 'icfo@brteam.com', '-', 'คุณรัญชิดา', 'ผู้จัดการ', '4 เดือน', 'กิจกรรมเกี่ยวกับบัญชีการทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านบัญชี ภาษี ธุรกิจ', '04320153', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.9932909489635!2d102.834862975104!3d16.42516712981098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228a2674b34095%3A0x3b31b36e89e61070!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4muC4tS7guKfguLUuIOC4geC4suC4o-C4muC4seC4jeC4iuC4teC5geC4peC4sOC4oOC4suC4qeC4teC4reC4suC4geC4oyAo4LiC4Lit4LiZ4LmB4LiB4LmI4LiZKSDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739187178121!5m2!1sth!2sth', 2567, 101, '-'),
(10130, 'บริษัท ฮาโล แอคเคาท์ จำกัด', 'HALO ACCOUNT CO., LTD.', 'เลขที่ 77/28 อาคารสินสาธรทาวเวอร์ ชั้น 11 ห้อง 4 และ 5 ถ. กรุงธนบุรี แขวง คลองต้นไทร เขตคลองสาน ', 'กรุงเทพมหานคร', '0800648879', '10600', 'info@haloaccount.com,baanromyen.acc@hotmail.com', 'http://www.haloaccount.com/th/', 'คุณพุทธินันท์', '-', '4 เดือน', 'ประกอบธุรกิจทำบัญชี การทำบัญชี และตรวจสอบบัญชี ', '034406281', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9460422487705!2d100.4969711750615!3d13.721716597989406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2bb51e79a2811%3A0x5a4d84c96b6ff9e6!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4ruC4suC5guC4pSDguYHguK3guITguYDguITguLLguJfguYwg4LiI4Liz4LiB4Lix4LiUIEhhbG8gQWNjb3VudCBjby4sTHRkLg!5e0!3m2!1sth!2sth!4v1739187243524!5m2!1sth!2sth', 2567, 101, '-'),
(10131, 'บริษัท พีเอสเค แอคเคาน์ติ้ง คอนซัลแตนท์ จำกัด', 'PSK ACCOUNTING CONSULTANT CO., LTD. ', 'เลขที่ 22,24 ซอยรามคำแหง 2 แขวงดอกไม้ เขตประเวศ ', 'กรุงเทพมหานคร ', '0902995614', '10250', 'buncneeaudit@windowslive.com', '-', 'คุณพิมณฑ์พัฒน์', 'ผู้จัดการ', '4 เดือน', 'บริการจดทะเบียนธุรกิจ จดตั้งบริษัท หจก. ทะเบียนภาษีมูลค่าเพิ่ม ประกันสังคม รับทำบัญชี และตรวจสอบบัญชี', '023977203', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.809884143206!2d100.68097807506075!3d13.669321399197804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d5e3c95fa3e73%3A0xf9522375aa824bc!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4nuC4teC5gOC4reC4quC5gOC4hCDguYHguK3guITguYDguITguLLguJnguYzguJXguLTguYnguIcg4LiE4Lit4LiZ4LiL4Lix4Lil4LmB4LiV4LiZ4LiX4LmMIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739187297913!5m2!1sth!2sth', 2567, 101, '-'),
(10132, 'บริษัท สำนักงาน เอ แอนด์ เอ จำกัด', 'A&A OFFICE CO., LTD.', 'เลขที่ 246 อาคารไทมส์ สแควร์ ชั้น 21 ห้องเลขที่ 21-01 ถนนสุขุมวิท 12-14 แขวงคลองเตย เขตคลองเตย ', 'กรุงเทพมหานคร ', '022549272 ', '10110 ', 'chumjai.plaa@gmail.com', 'https://www.aandaoffice.com/17962345/%E0%B9%80%E0%B8%81%E0%B8%B5%E0%B9%88%E0%B8%A2%E0%B8%A7%E0%B8%81%E0%B8%B1%E0%B8%9A%E0%B9%80%E0%B8%A3%E0%B8%B2', 'คุณอิฎฐพล ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'การทำบัญชีและการตรวจสอบบัญชี การให้คำปรึกษาด้านภาษี', '022549272', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.809884143206!2d100.68097807506075!3d13.669321399197804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d5e3c95fa3e73%3A0xf9522375aa824bc!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4nuC4teC5gOC4reC4quC5gOC4hCDguYHguK3guITguYDguITguLLguJnguYzguJXguLTguYnguIcg4LiE4Lit4LiZ4LiL4Lix4Lil4LmB4LiV4LiZ4LiX4LmMIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739187297913!5m2!1sth!2sth', 2567, 101, '-'),
(10133, 'บริษัท สำนักงาน เอ เอ็ม ซี จำกัด', 'SAM NAK-NGAN A.M.C. Co., Ltd.', 'ชั้น 19 ยูนิต 4 อาคารสีลมคอมเพล็กซ์ 191 ถนนสีลม แขวงสีลม เขตบางรัก ', 'กรุงเทพมหานคร ', '022313980', '10500 ', 'sirada@amc-mri.com', 'https://www.smcthai.co.th/policy.php', 'คุณศิรดา บวรกุล', '-', '4 เดือน', 'บริการสอบบัญชี การบริการเกี่ยวกับด้านการบัญชีอื่นๆ กิจกรรมเกี่ยวกับบัญชีการทำบัญชี', '022313988', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967865.4229621547!2d96.09606662499995!3d13.786795100000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29dd3b36031f5%3A0xc84d00a507dd4ddc!2zQU0gQVVESVQgR1JPVVAg4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4reC5gOC4reC5h-C4oSDguK3guK3guJTguLTguJcg4LmB4Lit4LiZ4LiU4LmMIOC5geC4reC4quC5guC4i-C4i-C4tOC5gOC4reC4lyDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739187498004!5m2!1sth!2sth', 2567, 101, '-'),
(10134, 'บริษัท อินเทลลิเจนท์ ดี.ซี จำกัด', 'INTELLIGENT D.C COMPANY LIMITED', '222 หมู่ที่ 4 ตำบลสันผีเสื้อ อำเภอเมืองเชียงใหม่', 'เชียงใหม่ ', '0894317166', '50180 ', 'IntelligentDC@outlook.com', '-', '-', '-', '4 เดือน', 'กิจกรรมให้คำปรึกษาด้านการบริหารจัดการอื่นๆซึ่งมิได้จัด ประเภทไว้ในที่อื่น', '-', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15102.727360730554!2d98.988509!3d18.8568093!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3b9a649fce53%3A0x506a147504e296b2!2z4Lit4Li04LiZ4LmA4LiX4Lil4Lil4Li04LmA4LiI4LiZ4LiX4LmMIOC4lOC4tS7guIvguLU!5e0!3m2!1sth!2sth!4v1739187715667!5m2!1sth!2sth', 2567, 101, '-'),
(10135, 'บริษัท บีพลัส การบัญชี จำกัด', 'BPLUS ACCOUNTING CO., LTD. ', 'สำนักงานใหญ่ เลขที่ 8/4 อาคารรัชดาโฮม ซอยอินทามระ 49 ถนนประชาสุข แขวงดินแดง เขตดินแดง ', 'กรุงเทพมหานคร ', '0876362734', '10400 ', 'bplusacc@outlook.co.th', 'https://www.bplusaccounting.com', 'คุณนฤมล', '-', '4 เดือน', 'สำนักงานบัญชีครบวงจร รับจดทะเบียนธุรกิจ ทำบัญชี ยื่นภาษี ปิดงบการเงิน วางระบบบัญชี ตรวจสอบบัญชี รับปรึกษาบัญชีและภาษี', '020018800', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.906528054733!2d100.56554807506241!3d13.78450799653547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f82671bf751%3A0xd3234d0823b9ec98!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4muC4teC4nuC4peC4seC4qiDguIHguLLguKPguJrguLHguI3guIrguLUg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739187867378!5m2!1sth!2sth', 2567, 101, 'ประกันสังคม พักร้อนประจำปี ค่าที่พักกรณีปฏิบัติงานต่างจังหวัดค่าโทรศัพท์ (บางตำแหน่ง) '),
(10136, 'บริษัท เอ็มพาตี้ คอนซัลติ้ง (ไทยแลนด์) จำกัด', 'Empathy Consulting (Thailand) Co., Ltd.', 'เลขที่ 240/5, 240/7 อาคารอโยธยาทาวเวอร์ ชั้น11 ถนนรัชดาภิเษก แขวงห้วยขวาง เขตห้วยขวาง ', 'กรุงเทพมหานคร ', '022768606 ', '10310', 'empathy_31@trustmail.jobthai.com', '-', 'คุณมรุลี กรประดับ', '-', '4 เดือน', 'กิจกรรมการบัญชี การทำบัญชี การสอบบัญชี', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.9085705336133!2d100.57394367506244!3d13.784384896538343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29d761529c911%3A0x2b4c463d7c3767e!2z4LiX4Li14LmI4Lib4Lij4Li24LiB4Lip4Liy4LiU4LmJ4Liy4LiZ4Lia4Lix4LiN4LiK4Li14oCLIOC4muC4o-C4tOC4qeC4seC4l-KAi-C5gOC4reC5h-C4oeC4nuC4suC4leC4teC5ieKAiyDguITguK3guJnguIvguLHguKXguJXguLTguYnguIfigIsgKOC5hOC4l-C4ouC5geC4peC4meC4lOC5jCkg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739188180903!5m2!1sth!2sth\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"', 2567, 101, '-'),
(10137, 'บริษัท แอคเคาท์เวิร์ค จำกัด (สำนักงานบัญชีคุณภาพ)', '(AccountWorks Co., Ltd.)', 'เลขที่ 1-2 ซอยสุภาพงษ์ 3 แยก8 แขวงหนองบอน เขตประเวช ', 'กรุงเทพมหานคร', '0924782917', '10250 ', 'info@accountworks.co.th', 'https://www.accountworks.co.th', 'คุณอรนภา ', '-', '4 เดือน', 'รับทำบัญชี รับตรวจสอบบัญชี รับจดทะเบียนบริษัท โดยสำนักงานบัญชีคุณภาพเน้น', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.5560210754325!2d98.9922196751495!3d18.817929360023573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3add4a37a213%3A0x58641f99e76aff46!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4l-C4tSDguYHguK3guITguYDguITguLLguJnguJfguYwg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739188354177!5m2!1sth!2sth', 2567, 101, 'ประกันสังคม OT (ตามที่ได้รับอนุมัติ) Bonus ตรวจสุขภาพประจำปี เลี้ยงฉลอง ตามProjectงานที่สำเร็จ อบรมพัฒนาความรู้ระหว่างปี วันลาพักร้อน (เพิ่มตามอายุงาน) วันลาป่วย 30 วัน วันลาคลอด 90 วัน วันลากิจ 5 วัน เงินช่วยเหลือคนในครอบครัว กรณีเสียชีวิต เงินช่วยเหลืองานแต่ง ของขวัญรับปริญญา ประกันอุบัติเหตุ ประกันชีวิต'),
(10138, 'บริษัท เดอะเบสท์ ออดิท ทีม จำกัด', 'The Best Audit Team Company Limited', 'เลขที่ 373/70 ถนนนาวงประชาพัฒนา แขวงสีกัน เขตดอนเมือง  ', 'กรุงเทพมหานคร ', '0983656554', '10210', 'Chatchawan@thebestacc.com', 'http://www.thebestacc.com/about.html', '-', '-', '4 เดือน', 'ให้บริการด้านบัญชี ตรวจสอบบัญชี และอื่นๆที่เกี่ยวข้อง', '029291841', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.2187133744287!2d100.42989507506381!3d13.885866594175525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e291cc0229c32d%3A0x95703a63fc17b284!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4lOC4reC4sOC5gOC4muC4quC4l-C5jOC4iuC5iuC4reC4ouC4quC5jCDguYHguK3guITguYDguITguLLguJnguYzguJXguLTguYnguIcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739189049755!5m2!1sth!2sth', 2567, 101, '-'),
(10139, 'บริษัท ดีลอยท์ ทู้ช โธมัทสุ ไชยยศ ที่ปรึกษา สอบบัญชี จำกัด', 'Deloitte Touche Tohmatsu Jaiyos Advisory Co., Ltd.', 'เลขที่ 11/1 อาคารเอไอเอ สาทร ทาวเวอร์ ชั้นที่ 23-27 ถนน สาทรใต้ แขวงยานนาวา เขตสาทร ', 'กรุงเทพมหานคร', '026765700', '10120 ', 'avoranithipak@deloitte.com', 'https://www.yellowpages.co.th/profile/%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%A9%E0%B8%B1%E0%B8%97-%E0%B8%94%E0%B8%B5%E0%B8%A5%E0%B8%AD%E0%B8%A2%E0%B8%97%E0%B9%8C-%E0%B8%97%E0%B8%B9%E0%B9%89%E0%B8%8A-%E0%B9%82%E0%B8%98%E0%B8%A1%E0%B8%B1%E0%B8%97%E0%B8%AA%E0%B8%', 'คุณอธิพัฒน์ วรนิธิภาคย์ ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'ให้บริการด้านการตรวจสอบบัญชี การให้คำปรึกษาทางธุรกิจ การบริหารจัดการ และภาษีอากร', '026765757', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9710970080437!2d100.52421907506147!3d13.720199698024388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f5a57f3bf0b%3A0x25bc780eae2cb554!2sDeloitte%20Touche%20Tohmatsu%20Jaiyos%20Co.%2C%20Ltd.!5e0!3m2!1sth!2sth!4v1739189093178!5m2!1sth!2sth', 2567, 101, '-'),
(10140, 'บริษัท สำนักงานสอบบัญชี ซี แอนด์ เอ จำกัด', 'C&A Audit Office Co., Ltd.', 'เลขที่ 53 ถนนนราธิวาสราชนครินทร์ แขวง ช่องนนทรี เขต ยานนาวา ', ' กรุงเทพมหานคร', '026780750', '10120', 'cna@cnaaudit.com', 'https://www.cnaaudit.com/', 'คุณอารยา มหาวนิช', '-', '4 เดือน', 'บริษัทให้บริการด้านการตรวจสอบบัญชี การทำบัญชี และการให้คำปรึกษาด้านภาษี', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.2598108843013!2d100.53771637506131!3d13.702708098428355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f45ec6290eb%3A0x85f4d7c60d2b6626!2z4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4Liq4Lit4Lia4Lia4Lix4LiN4LiK4Li1IOC4i-C4tSDguYHguK3guJnguJTguYwg4LmA4Lit!5e0!3m2!1sth!2sth!4v1739189131263!5m2!1sth!2sth', 2567, 101, '-'),
(10141, 'บริษัท ยูไนเต็ด ชาร์เตอร์ แอคเคาท์แท้นท์ จำกัด', 'United Chartered Accountant Co., Ltd.', 'เลขที่ 269/141 ซอยจรัญสนิทวงศ์ 35 ถนนจรัญสนิทวงศ์ แขวงบางขุนศรี เขตบางกอกน้อย ', 'กรุงเทพมหานคร ', '026553322', '10700', '-', '-', '-', '-', '4 เดือน', 'สำนักงานตรวจสอบบัญชีที่ให้บริการด้านการตรวจสอบบัญชี การวางระบบบัญชี และการตรวจสอบภายใน', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62007.508247648766!2d100.39531845820315!3d13.750551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2998ed78a4375%3A0x4b876f175642b8ea!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4ouC4ueC5hOC4meC5gOC4leC5h-C4lCDguIrguLLguKPguYzguYDguJXguK3guKPguYwg4LmB4Lit4LiE4LmA4LiE4LmJ4Liy4LiX4LmM4LmB4LiX4LmJ4LiZ4LiX4LmMIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739189192913!5m2!1sth!2sth', 2567, 101, '-'),
(10142, 'สำนักงานบัญชีทนายความมิตรประชา ยงยุทธการบัญชีและกฏหมาย', 'Yongyout Accounting and Law Office)', 'เลขที่ 589 อาคารถุงเงิน ถนนลาดหญ้า แขวงคลองสาน เขตคลองสาน ', 'กรุงเทพมหานคร ', '028614611', '10600', 'mpc-audit@hotmail.com', 'www.yongyout.com', 'คุณรัชดาวัลย์', '-', '4 เดือน', 'บริการด้านบัญชี กฎหมาย ภาษีอากร และเทคโนโลยีสารสนเทศครบวงจร', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.8827829248003!2d100.48982613488766!3d13.725545799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e298fa9768352f%3A0x734cbe7e573c6b4d!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4quC4s-C4meC4seC4geC4h-C4suC4meC4geC4juC4q-C4oeC4suC4ouC5geC4peC4sOC4muC4seC4jeC4iuC4teC4mOC4suC4lOC4suC4l-C4meC4suC4ouC4hOC4p-C4suC4oSDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739189319042!5m2!1sth!2sth', 2567, 101, 'ค่าตอบแทน: วันละ 300 - 350 บาท'),
(10143, 'บริษัท มอร์ จีเซีย (ประเทศไทย) จำกัด', 'MOORE GSIA (THAILAND) Limited', 'เลขที่ 2/89 อาคาร ออฟฟิตทาวเวอร์ ชั้นที่ 17 ซอย บางนาคอมเพล็กซ์ บางนาเหนือ เขตบางนา ', 'กรุงเทพมหานคร', '021365600', '10260 ', '-', 'https://www.moore-global.com/locations/moore-gsia-thailand-limited-bangkok', 'คุณกวินภพ ปรีดี', '-', '4 เดือน', 'บริการด้านการตรวจสอบบัญชี การทำบัญชี และการให้คำปรึกษาด้านภาษี', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.8188393817663!2d100.6342834750608!3d13.668777199210357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d5f1d04b41c33%3A0x519335df3face5bf!2sMOORE%20GSiA%20(Thailand)%20Limited!5e0!3m2!1sth!2sth!4v1739189356321!5m2!1sth!2sth', 2567, 101, '-'),
(10201, 'บริษัท เลิศ โกลบอล กรุ๊ป จำกัด', ' Lert Global Group ', 'เลขที่ 200 อาคารทศพล ชั้น 5 ห้อง 5ซี ถนนรัชดาภิเษก เขตห้วยขวาง กรุงเทพมหานคร 10310', 'กรุงเทพมหานคร ', '065 251 99', '10310', 'info@lernc.com', 'https://www.lertglobalgroup.com/th/   https://www.facebook.com/LertGlobalGroup/', 'คุณพัทธนันท์ เนียมสุทธิ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'เป็นผู้ให้บริการด้านการวางแผนและจัดทำการตลาด สื่อโฆษณา และประชาสัมพันธ์ โดยมุ่งเน้นการเปิดตลาดให้กับแบรนด์ไทยสู่ประเทศจีน และนำเข้าสินค้าจากจีนสู่ตลาดในประเทศไทยและภูมิภาคเอเชียตะวันออกเฉียงใต้', '065 251 9922', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.7329399782557!2d100.57416667506253!3d13.794966196292716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29d5bafc569df%3A0x5982c33757539d25!2sLERT%20GLOBAL%20GROUP%20COMPANY%20LIMITED!5e0!3m2!1sth!2sth!4v1739189492600!5m2!1sth!2sth', 2567, 102, '-'),
(10202, 'บริษัท ลอรีอัลประเทศไทย จำกัด', 'L\'Oréal Thailand', 'เลขที่ 179 บางกอกซิตี้ทาวเวอร์ ถนนสาทรใต้ แขวงทุ่งมหาเมฆ เขตสาทร กรุงเทพมหานคร 10120', 'กรุงเทพมหานคร', '02-6843033', '10120', '-', 'https://careers.loreal.com/en_US/content/Students', 'คุณอนุรักษ์  ชัชวาลพงศ์พันธ์  ', '-', '4 เดือน', 'ดำเนินธุรกิจเกี่ยวกับ ความงามและเครื่องสำอาง ครอบคลุมผลิตภัณฑ์หลากหลายประเภท ตั้งแต่ สกินแคร์ เมคอัพ ผลิตภัณฑ์ดูแลเส้นผม และผลิตภัณฑ์เวชสำอาง', '02-684-3000', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1937.9353209187332!2d100.53180883860193!3d13.726280602274057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f3cd4b103e5%3A0x5f4fe1f86e6877d!2sL&#39;Or%C3%A9al%20Thailand!5e0!3m2!1sth!2sth!4v1739189601869!5m2!1sth!2sth', 2567, 102, '-'),
(10203, 'บริษัท ตลาดเซฟวัน จำกัด', 'SAVEONE FLEA MARKET COMPANY LIMITED ', 'เลขที่ 1485/1 ถนนมิตรภาพ ตำบลในเมือง อำเภอเมือง จังหวัดนครราชสีมา 30000', 'นครราชสีมา', '0-4422-258', '30000', '-', 'https://www.saveonekorat.com', '-', '-', '4 เดือน', 'ดำเนินธุรกิจเกี่ยวกับ ตลาดกลางคืน (Night Market) และศูนย์การค้าแบบเปิด', '044-371-111', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.6340806425137!2d102.04147627507979!3d14.957466268240067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31194cb6aaaaaaab%3A0xec5f662e93e55bff!2z4LiV4Lil4Liy4LiU4LmA4LiL4Lif4Lin4Lix4LiZ!5e0!3m2!1sth!2sth!4v1739189646366!5m2!1sth!2sth', 2567, 102, '-'),
(10204, 'บริษัท วัชร มารีน จำกัด', 'WATCHARA MARINE CO., LTD', 'เลขที่ 140/94 หมู่ 11 ถนนสุขุมวิท ตำบลหนองปรือ อำเภอบางละมุง จังหวัดชลบุรี 20150 ', 'ชลบุรี ', '038-418500', '20150', 'info@watcharamarine.co.th', 'https://watcharamarine.com/', 'คุณนิภารัตน์  กุลอุปฮาด ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'ตัวแทนจำหน่ายผลิตภัณฑ์ทางน้ำของยามาฮ่า (Yamaha)', '038 418 500', 'https://maps.app.goo.gl/LUiEmoCtoUggGc6w5', 2567, 102, '-'),
(10205, 'โรงแรมกมลา 555', 'Kamala 555', 'เลขที่ 74/39 หมู่ 3 ถนนริมหาด ตำบลกมลา อำเภอกระทู้ จังหวัดภูเก็ต 83150', 'ภูเก็ต', '086-489404', '83150', 'kenedy_dodo@yahoo.com', '-', '-', '-', '4 เดือน', 'ให้บริการที่พักสำหรับนักท่องเที่ยวที่มาเยือนหาดกมลา', '-', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31612.13006827276!2d98.2544153!3d7.945481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30503a3a65719edb%3A0xc498674ea1ed732!2sAt%20Kamala%20Hotel!5e0!3m2!1sth!2sth!4v1739189818396!5m2!1sth!2sth', 2567, 102, '-'),
(10206, 'บริษัท โอโซน ปาร์ค จำกัด', 'Ozone Park Co., Ltd', 'หลังตลาดเซฟวัน ตำบลในเมือง อำเภอเมือง จังหวัดนครราชสีมา 30000', 'นครราชสีมา', '0819395051', '30000', 'naeti@ozonepark.co.th', 'www.ozonepark.co.th', 'คุณเนติ', 'ผู้จัดการฝ่ายการตลาด', '4 เดือน', 'ดำเนินธุรกิจในด้านการศึกษา การตลาด และบริการพาณิชย์อิเล็กทรอนิกส์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.0243064403826!2d100.4951034750631!3d13.83757899530179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29b0fc7b895bd%3A0x3824ba05d0c84a5b!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5guC4reC5guC4i-C4mSDguJvguLLguKPguYzguIQg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739189890010!5m2!1sth!2sth', 2567, 102, 'เบี้ยเลี้ยง , เครื่องดื่มร้อน: กาแฟ/ไมโล , เครื่องดื่มเย็น: Pepsi'),
(10207, 'บริษัท เบทาโกรเกษตรอุสาหกรรม จำกัด', 'Betagro Agro Industry Company Limited', 'สำนักงานอุบลราชธานี เลขที่ 62/2-4 หมู่ที่ 10 ถนนเลี่ยงเมือง ตำบลแจระแม อำเภอเมือง จังหวัดอุบลราชธานี 30400', 'อุบลราชธานี ', '045283814', '30400', '-', 'www.betagro.com', '-', '-', '4 เดือน', 'บริการด้านการผลิตและแปรรูปอาหารสัตว์, เลี้ยงปศุสัตว์, และจำหน่ายผลิตภัณฑ์เนื้อสัตว์และอาหารสัตว์เลี้ยง.', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966480.289925803!2d96.07787092499996!3d13.868071799999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29d8db8b09c91%3A0x6903d2f941f59b5c!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4muC4l-C4suC5guC4geC4oyDguIjguLPguIHguLHguJQgKOC4oeC4q-C4suC4iuC4mSkgSGVhZCBPZmZpY2U!5e0!3m2!1sth!2sth!4v1739189942899!5m2!1sth!2sth', 2567, 102, 'เบี้ยเลี้ยง: มีการจ่ายเบี้ยเลี้ยงระหว่างการฝึกงาน , เครื่องดื่ม: มีบริการเครื่องดื่มร้อน เช่น กาแฟ และไมโล , เครื่องดื่มเย็น: มีบริการเครื่องดื่มเย็น เช่น เป๊ปซี่'),
(10208, 'บริษัท ลายไทย เรคคอร์ด จำกัด', 'Laithai Record Company Limited', 'เลขที่ 2/55 ถนนราชดำเนิน ตำบลในเมือง อำเภอเมืองร้อยเอ็ด จังหวัดร้อยเอ็ด 45000', 'ร้อยเอ็ด', '0952879316', '45000', 'nuylinethaimedia@gmail.com', 'Laithai Record', 'คุณบัญชา', 'ผู้จัดการ', '4 เดือน', 'ดำเนินธุรกิจด้านความบันเทิงหลากหลายประเภท เช่น การรับจ้างทำดนตรี แต่งเพลง ผลิตภาพยนตร์ผ่านสื่อต่าง ๆ รวมถึงการจัดงานอีเวนต์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.0993584307466!2d103.62654207509769!3d16.060333039676085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3117fdea7bd78793%3A0x49ccf4ad552866b0!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4peC4suC4ouC5hOC4l-C4oiDguYDguKPguITguITguK3guKPguYzguJQg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739189980354!5m2!1sth!2sth', 2567, 102, '-'),
(10209, 'บริษัท ไอ.วี.จี จำกัด', 'I.V.G. Company Limited', 'เลขที่ 102 หมู่ที่ 5 ตำบลพญาเย็น อำเภอปากช่อง จังหวัดนครราชสีมา 30230', 'นครราชสีมา', '0923205799', '30230', 'hr@pbvalley.com', 'www.pbvalleykhaoyai.com', 'คุณหนูดี', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'ธุรกิจเกี่ยวกับการปลูกและจำหน่ายองุ่น', '044-300-915', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.4704300338326!2d101.2353753750738!3d14.572249377770214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311dd11cae81c475%3A0xa39c7c7e9f387e55!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5hOC4rS7guKfguLUu4LiI4Li1IOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739190019554!5m2!1sth!2sth', 2567, 102, 'ที่พัก ,อาหาร , ประการสังคม ,กองทุนสำรองเลี้ยงชีพ,ประกันสุขภาพ,กิจกรรมสันทนาการ'),
(10210, 'บริษัท แจ่มใส พับลิชชิ่ง จำกัด', 'Jamsai Publishing Co., Ltd', 'เลขที่ 285/33 ซอย 31 ถนนจรัญสนิทวงศ์ แขวงบางขุนศรี เขตบางกอกน้อย กรุงเทพมหานคร 10700', 'กรุงเทพมหานคร', '028404800', '10700', 'patsamol.re@jamsai.com,hr@jamsai.com', 'www.jamsai.com', 'คุณพรรษมล', 'หัวหน้าฝ่ายบุคคล', '4 เดือน', 'ธุรกิจเกี่ยวกับการพิมพ์และจัดจำหน่ายหนังสือ, นิยาย, และพ็อกเก็ตบุ๊ค', '02-840-4801', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.438057904774!2d100.46331457506194!3d13.752436297278836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e299b9103573e7%3A0x57dc8425cb49d995!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5geC4iOC5iOC4oeC5g-C4qiDguJ7guLHguJrguKXguLTguIrguIrguLTguYjguIcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739190089434!5m2!1sth!2sth', 2567, 102, 'อาหารกลางวัน,เกียรติบัตร,หนังสือรับรองการฝึกงาน'),
(10211, 'บริษัท มาร์เก็ตเมทริกซ์ เอเชีย จำกัด', 'Market Metrics Asia Co., Ltd', 'เลขที่ 45/6 ซอยกรุงเทพนนท์ 3 แยก 2 ตำบลบางเขน อำเภอเมืองนนทบุรี จังหวัดนนทบุรี 11000', 'นนทบุรี', '021161337', '11000', 'mma.thailand2004@gmail.com', 'marketmetrics.asia', 'คุณมัลลิกา', '-', '4 เดือน', 'ปรึกษาทางด้านเศรษฐกิจ', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61985.13751774112!2d100.48024557910155!3d13.834769399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29b71036eaaab%3A0x4aebe23dd31af467!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4oeC4suC4o-C5jOC5gOC4geC5h-C4leC5gOC4oeC4l-C4o-C4tOC4geC4i-C5jOC5gOC4reC5gOC4iuC4teC4oiDguIjguLPguIHguLHguJQg4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4LmD4Lir4LiN4LmI!5e0!3m2!1sth!2sth!4v1739198749600!5m2!1sth!2sth', 2567, 102, '-'),
(10212, 'บริษัท ที โอ เอช มอเตอร์ จำกัด', 'TOH Motor Co., Ltd.', 'เลขที่ 1226/27-32 ถนนสมถวิลราษฎร์ ตำบลตลาด อำเภอเมือง จังหวัดมหาสารคาม 44000', 'มหาสารคาม', '043722209', '44000', 'tatar_ran@hotmail.com', 'https://www.tohothai.co.th/companyprofile.php?lang=thai', 'คุณตุ้ม', '-', '4 เดือน', 'จำหน่ายและบริการรถจักรยานยนต์ฮอนด้า รวมถึงอะไหล่และอุปกรณ์เสริมต่าง ๆ สำหรับรถจักรยานยนต์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7663.582372830441!2d103.28998837770999!3d16.1797152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122a6ec3e21f779%3A0xd9b0d8ed3ac49079!2z4LiX4Li1IOC5guC4rSDguYDguK3guIog4Lih4Lit4LmA4LiV4Lit4Lij4LmMIOC4qOC4ueC4meC4ouC5jOC4ruC4reC4meC4lOC5ieC4siDguKrguLLguILguLLguJzguJTguLjguIfguKfguLTguJbguLUg4LitIOC5gOC4oeC4t-C4reC4hyDguKHguKvguLLguKrguLLguKPguITguLLguKE!5e0!3m2!1sth!2sth!4v1739199318766!5m2!1sth!2sth', 2567, 102, '-'),
(10213, 'บริษัท บางกอก ครีเอชั่นส์ แอนด์ เอเจนซี่ เซอร์วิสเซส จำกัด', 'Bangkok Creations and Agency Services Co., Ltd', 'เลขที่ 64 ซอยรามคำแหง12 (อุดมยศ) แขวงหัวหมาก เขตบางกะปิ กรุงเทพมหานคร 10240', ' กรุงเทพมหานคร ', '0615626364', '10240', 'bkkcreations@gmail.com', '-', '-', '-', '4 เดือน', 'ให้บริการด้านการจัดงานประชาสัมพันธ์และส่งเสริมการขายสินค้าอุปโภคบริโภค', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.241975418267!2d100.29965397508943!3d13.703789286683149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29590781e6b07%3A0x5f76c2a1cecc843!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4muC4suC4h-C4geC4reC4geC4hOC4o-C4tOC4quC4oeC4seC4qiDguYDguJTguYfguITguYLguITguYDguKPguIrguLHguYjguJkg4LmA4Lit4LmH4LiB4LiL4Lib4Lit4Lij4LmM4LiVIOC4iOC4s-C4geC4seC4lCjguYLguKPguIfguIfguLLguJkp!5e0!3m2!1sth!2sth!4v1739199426431!5m2!1sth!2sth', 2567, 102, '-'),
(10214, 'บริษัท บางกอก เฮลท์กรุ๊ป จำกัด', 'Bangkok Health Group Co., Ltd', 'เลขที่ 160/15-17 ถนนจอมสุรางค์ยาตร์ ตำบลในเมือง อำเภอเมือง จังหวัดนครราชสีมา 30000', 'นครราชสีมา', '044254127', '30000', 'hrbangkokhealthgoup@gmail.com,fongnamnoiiz@gmail.com', 'https://bkacne.com', 'คุณเอื้อม', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'ทำธุรกิจผลิตและจำหน่ายผลิตภัณฑ์ดูแลผิวสำหรับผู้ที่มีปัญหาสิวและผิวแพ้ง่าย', '044-254-127', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1979424.7676832157!2d99.93389057681297!3d14.307714202469374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31194df8fb433a81%3A0xfaf2791f1b199d62!2sBangkok%20Health%20Group%20Co.%2CLtd.!5e0!3m2!1sth!2sth!4v1739199566430!5m2!1sth!2sth', 2567, 102, '-'),
(10215, 'บริษัท โตโยต้า ลีสซิ่ง (ประเทศไทย) จำกัด', 'Toyota Leasing (Thailand) Co.,Ltd', 'เลขที่ 990 อาคารอับดุลราฮิม ชั้น 18-19 ถนนพระราม 4 แขวงสีลม เขตบางรัก กรุงเทพมหานคร 10500 ', 'กรุงเทพมหานคร ', '0-2660-555', '10500 ', 'Montre_A@tlt.co.th, human_resources@ tlt.co.th', 'https://www.tlt.co.th/index.php', 'คุณวรรณวนัช ', 'หัวหน้างานฝ่ายบุคคล', '4 เดือน', 'ให้บริการสินเชื่อรถยนต์ บริษัทมุ่งที่จะขยายตลาดการให้สินเชื่อ', '02-6361381', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7935009.840461136!2d91.330317275!3d13.807993800000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29dcd617a8c69%3A0x8b5b6f03b0d73b7b!2z4LmC4LiV4LmC4Lii4LiV4LmJ4LiyIOC4peC4teC4quC4i-C4tOC5iOC4hw!5e0!3m2!1sth!2sth!4v1739199642895!5m2!1sth!2sth', 2567, 102, 'เบี้ยงเลี้ยงฝึกงาน'),
(10216, 'บริษัท บีเอ็นเอฟ โฮลดิ้ง จำกัด', 'BNF HOLDING COMPANY LIMITED', 'เลขที่ 222 อาคารโรงแรมใบหยกสกาย ชั้นที่ 21 ซอยราชปรารภ 3 ถนนราชปรารภ แขวงถนนพญาไท เขตราชเทวี กรุงเทพมหานคร 10400 ', 'กรุงเทพมหานคร', '02-6563487', '10400 ', 'recruitment@bnfholeing.co.th', '-', 'คุณสุชาติ ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'บริการด้านอาหารในภัตตาคาร/ร้านอาหาร', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.3958009617822!2d100.5403466!3d13.754988700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ec5f6171345%3A0x50bca1fc9df55d3e!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4muC4teC5gOC4reC5h-C4meC5gOC4reC4nyDguYLguK7guKXguJTguLTguYnguIcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739199693596!5m2!1sth!2sth', 2567, 102, 'เบี้ยเลี้ยงฝึกงาน'),
(10217, 'โรงแรม ฌาน วิลล่า สุขุมวิท', 'SHAN Villas Sukhumvit', 'เลขที่ 16 ซอย อ่อนนุช 18 แขวงสวนหลวง กรุงเทพมหานคร 10250 ', 'กรุงเทพมหานคร ', '061-978264', '10250 ', 'marketing@shanvillasbangkok.com', 'https://shanvillasbangkok.com', '-', '-', '4 เดือน', 'บริการด้านที่พัก คิดและวางแผนกลยุทธ์การตลาด คิด content ในการโปรโมท Mekha ผ่านสื่อออนไลน์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.16714015435!2d100.60965687464311!3d13.708324898299468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f461edff803%3A0xac62c9b53821510e!2sSHAN%20Sukhumvit!5e0!3m2!1sth!2sth!4v1739199887852!5m2!1sth!2sth', 2567, 102, '-'),
(10218, 'อสิตา อีโค รีสอร์ท', 'Asita Eco Resort', 'เลขที่ 33/3 หมู่4 ตำบลท้ายหาด อำเภอเมือง จังหวัดสมุทรสงคราม 75000', 'สมุทรสงคราม', '0842896264', '75000', 'sales1@asitaresort.com', 'https://www.asitaresort.com', 'คุณทศพล  ', '-', '4 เดือน', 'บริการห้องพัก ร้านอาหาร ร้านกาแฟ สปา อสิตา อีโค รีสอร์ท', '0-3476-7333', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3881.337841692944!2d99.97350487508375!3d13.391395086963875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2d489bfbd74bf%3A0xaca144b5320ffc4!2z4Lit4Liq4Li04LiV4LiyIOC4reC4tOC5guC4hCDguKPguLXguKrguK3guKPguYzguJcg4Lit4Lix4Lih4Lie4Lin4Liy!5e0!3m2!1sth!2sth!4v1739200069032!5m2!1sth!2sth', 2567, 102, 'อาหาร 3 มื้อ และเบี้ยเลี้ยงวันละ 150 บาท โบนัสเดือนละ 1,000 บาท ที่พัก ชุดพนักงานพร้อมซักรีดให้'),
(10219, 'บริษัท บัตรกรุงไทย จำกัด (มหาชน)', 'KRUNGTHAI CARD PUBLIC COMPANY LIMITED', 'เลขที่ 591 อาคารสมัชชาวาณิช 2 ชั้น 14 ถนนสุขุมวิท แขวงคลองตันเหนือ เขตวัฒนา กรุงเทพมหานคร 10110', 'กรุงเทพมหานคร', '02-828-509', '10110', 'charinee.y@ktc.co.th', 'https://krungthai.com/th/about-ktb/getdetailktbgroup?id=305', 'คุณชาริณี ยะสารวรรณ ', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'จัดทำแผนและดำเนินงานด้านการตลาดในหมวด Family, Education, Book, Pet เพื่อกระตุ้นการใช้จ่ายผ่านบัตรเครดิตเคทีซีและสร้างสัมพันธ์ที่ดีกับพันธมิตรร้านค้าตามแนวทางและเป้าหมายของบริษัท', '02 123 5190', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.7693661801986!2d100.5673265!3d13.7324085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f027218b7eb%3A0x6d0a136581659999!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4muC4seC4leC4o-C4geC4o-C4uOC4h-C5hOC4l-C4oiDguIjguLPguIHguLHguJQg4Lih4Lir4Liy4LiK4LiZ!5e0!3m2!1sth!2sth!4v1739247030283!5m2!1sth!2sth', 2567, 102, 'ตามข้อตกลงของบริษัท'),
(10220, 'บริษัท ไอเดียล แอพโพรช จำกัด (อควาพลัส ซีรี่ส์)', 'IDEAL APPROACH CO., LTD', 'เลขที่ 2 ซอยกรุงเทพกรีฑา 19 แขวงทับช้าง เขตสะพานสูง กรุงเทพมหานคร 10250 ', 'กรุงเทพมหานคร', '084-439343', '10250 ', 'pptoptimoglobal@gmail.com', 'https://aquaplus.co.th/', 'คุณวิกาญดา', 'ฝ่ายทรัพยากรบุคคล', '4 เดือน', 'การขายส่งเครื่องสำอาง แบรนด์สกินแคร์ระดับโลก มุ่งเน้นไปที่ตลาดเอเชียโดยเฉพาะ', '0-2368-2566', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3877.0002844598803!2d100.505353!3d13.657746399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a247bb62915b%3A0xbfc24ece5ce883a4!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5hOC4reC5gOC4lOC4teC4ouC4pSDguYHguK3guITguYDguIvguYfguKrguYLguIvguKPguLXguKrguYwg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739247090972!5m2!1sth!2sth', 2567, 102, '-'),
(10221, 'โรงแรม พูลแมน เขาหลัก รีสอร์ท พังงา', 'IDEAL APPROACH CO., LTD', 'เลขที่ 46/109 หมู่ 2 ซอย 46 แหลมสน ตําบลบางม่วง อําเภอตะกั่วป่า จังหวัดพังงา 82190', 'พังงา', '-', '82190', '-', 'https://www.pullmankhaolakresort.com/th/', '-', '-', '4 เดือน', 'บริการที่พัก ห้องอาหาร สปา และสิ่งอำนวยความสะดวก', '076-59-2233', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.2803735944176!2d98.26729069999999!3d8.853468300000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3050c5f32e651581%3A0xfd3cee722912bb07!2z4Lie4Li54Lil4LmB4Lih4LiZIOC5gOC4guC4suC4q-C4peC4seC4gSDguKPguLXguKrguK3guKPguYzguJc!5e0!3m2!1sth!2sth!4v1739247218997!5m2!1sth', 2567, 102, '-');
INSERT INTO `company` (`Company_id`, `NamecomTH`, `NamecomEng`, `Company_add`, `Province`, `Com_phone`, `Zip_id`, `Com_email`, `Website`, `Contact_com`, `Position`, `Duration`, `Job_description`, `Fax_number`, `Map`, `Academic_year`, `Major_id`, `welfare`) VALUES
(10222, 'บริษัท ออร่า ริช (ประเทศไทย) จํากัด', 'AURA RICH (THAILAND) COMPANY LIMITED', 'เลขที่ 456/8 หมู่ 2 ถ.เลี่ยงเมือง ตําบลบ้านเป็ด อําเภอเมือง จังหวัดขอนแก่น 40000', 'ขอนแก่น ', '0804426692', '40000', '-', 'https://aurarichthailand.com/', '-', '-', '4 เดือน', 'แบรนด์ผลิตภัณฑ์ ดูแลความสวยงามของผู้หญิงในทุกด้าน ทั้งด้านความงาม และด้านสุขภาพ', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.8841459412665!2d102.7660246!3d16.430709300000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x312289a282a054bb%3A0xa9b2389547adba69!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4reC4reC4o-C5iOC4siDguKPguLTguIogKOC4m-C4o-C4sOC5gOC4l-C4qOC5hOC4l-C4oikg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739247355536!5m2!1sth!2sth', 2567, 102, 'เบี้ยเลี้ยง  สินค้าราคาพนักงาน  อาหารพนักงาน'),
(10223, 'ดี วารี จอมเทียนบีช พัทยา พัทยา', 'D Varee Jomtien Beach Pattaya Hotel', 'เลขที่ 457 หมู่ 12 ถนนหาดจอมเทียน ซอย 13 - 14 หนองปรือ บางละมุง พัทยา ชลบุรี 20150 ', 'ชลบุรี', '063 841 89', '20150 ', '-', 'https://th.djbpattaya.com/', '-', '-', '4 เดือน', 'บริการห้องพักพร้อมระเบียงวิวทะเล มีสิ่งอำนวยความสะดวก', '(66) 38 418 989', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3889.426107095755!2d100.8842011!3d12.8802995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3102bdfe5d7390d1%3A0xfd76ffc9e24be376!2z4LmC4Lij4LiH4LmB4Lij4Lih4LiU4Li1IOC4p-C4suC4o-C4tSDguIjguK3guKHguYDguJfguLXguKLguJkg4Lia4Li14LiK!5e0!3m2!1sth!2sth!4v1739247459704!5m2!1sth!2sth', 2567, 102, 'อาหารฟรี 3 มื้อ  ชุดยูนิฟอร์มพร้อมซักรีดฟรี เบี้ยเลี้ยงรายเดือน สวัสดิการด้านการรักษาพยาบาล'),
(10224, 'บริษัท เจ้าพระยา ดีเวล๊อปเมนต์ คอร์ปอเรชั่น จํากัด', 'CHAOPHAYA DEVELOPMENT CORPORATION LTD', 'เลขที่  23 ถ.เจริญกรุง 24 แขวงตลาดน้อย เขตสัมพันธวงศ์ กรุงเทพมหานคร 10100', 'กรุงเทพมหานคร', '095 890 17', '10100', '-', 'https://rivercitybangkok.com/', '-', '-', '4 เดือน', 'เป็นธุรกิจให้เช่าพื้นที่ให้บริการอื่นๆ การเช่าและการดำเนินการเกี่ยวกับอสังหาริมทรัพย์', '0-2237-7600', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.7808083784766!2d100.5144847!3d13.7317163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e298d91889289f%3A0x64692ec89ad6fc8d!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4iOC4seC4geC4o-C4p-C4suC4peC5gOC4l-C4o-C5gOC4p-C4peC5gOC4i-C4reC4o-C5jOC4p-C4tOC4qiDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739247653279!5m2!1sth!2sth', 2567, 102, 'ทำงาน 5วัน วันหยุด 2วัน เงินเดือน 4,000 บาทต่อเดือน'),
(10225, 'บริษัท ไทม์ บรอดคาสท์ จํากัด', 'TIME BROADCAST COMPANY LIMITED', 'เลขที่ 19/19 ชั้นที่ 4 ซอยโชคชัยร่วมมิตร ถนนวิภาวดี รังสิต แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900 ', 'กรุงเทพมหานคร', '02-661-737', '10900', '-', '-', '-', '-', '4 เดือน', 'ข้อมูลข่าวสารและการสื่อสาร โดยให้บริการด้าน กิจกรรมการผลิตรายการโทรทัศน์', '0-2661-7188', '-', 2567, 102, '-'),
(10226, 'บริษัท โตโยต้าแก่นนคร จํากัด', 'TOYOTA KAENNAKORN COMPANY LIMITED', 'เลขที่ 359/888 หมู่ 17 ถนนมิตรภาพ ตําบลในเมือง อําเภอเมือง จังหวัดขอนแก่น 40000', 'ขอนแก่น ', '043-333444', '40000', '-', 'https://www.tkn.co.th/', '-', '-', '4 เดือน', 'การขายยานยนต์ใหม่ชนิดรถยนต์นั่งส่วนบุคคล รถกระบะ รถตู้ และรถขนาดเล็กที่คล้ายกันการบำรุงรักษาและการซ่อมระบบเครื่องยนต์และชิ้นส่วนยานยนต์', '043-365-400', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61232.5645503807!2d102.78562067910156!3d16.423034300000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228b7f81a98a73%3A0xd260871137aa08e0!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5guC4leC5guC4ouC4leC5ieC4suC5geC4geC5iOC4meC4meC4hOC4oyDguIjguLPguIHguLHguJQg4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4LmD4Lir4LiN4LmI!5e0!3m2!1sth!2sth!4v1739248665826!5m2!1sth!2sth', 2567, 102, 'ตามข้อตกลงของบริษัท'),
(10227, 'บริษัท มาย เซฟ เซอร์วิส จํากัด', 'MY SAVE SERVICES CO., LTD', 'เลขที่ 100/1 อาคารวรสมบัติ ห้องเลขที่ 20 แอล ชั้นที่ 20 ถนนพระราม 9 แขวงห้วยขวาง เขตห้วยขวาง กรุงเทพมหานคร 10310 ', 'กรุงเทพมหานคร', '0632737225', '10310', '-', 'https://www.mysave.co/en', '-', '-', '4 เดือน', 'การขนส่งและขนถ่ายสินค้า รวมถึงคนโดยสาร วัตถุประสงค์ ประกอบกิจการให้บริการขนส่งสินค้าอุปโภคบริโภค พัสดุต่างๆ ทั้งภายในและภายนอกประเทศ', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.9261713330425!2d100.4563008!3d13.662253100000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a2c8bee2423f%3A0xddde6b4d2e5a2a3a!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4oeC4suC4oiDguKHguLLguKIg4LmA4LiL4Lit4Lij4LmM4Lin4Li04LiqIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739248740356!5m2!1sth!2sth', 2567, 102, '-'),
(10228, 'บริษัท ฌาน โฮลิสติก จํากัด', 'CHARN HOLISTIC CO., LTD', 'เลขที่ 589/26 อาคารเซ็นทรัล ซิตี้ ทาวเวอร์ ชั้นที่ 7 ถนนเทพรัตน แขวงบางนาเหนือ เขตบางนา กรุงเทพฯ 10260', 'กรุงเทพฯ', '0889170081', '10260', '-', '-', '-', '-', '4 เดือน', 'กิจการขายปลีกเครื่องสำอาง', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3872.385473058358!2d100.6961694!3d13.935638799999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d7c12fb09c9df%3A0xa579963d073f5dba!2z4LmC4Liu4Lil4Li04Liq4LiV4Li04LiBIOC4quC4m-C4siDguYHguK3guJnguJTguYwg4Lia4Li04Lin4LiV4Li14LmJ!5e0!3m2!1sth!2sth!4v1739249307715!5m2!1sth!2sth', 2567, 102, '-'),
(10229, 'บริษัท ฟอร์ทูเดย์ จํากัด', 'FORETODAY CO., LTD', 'เลขที่ 140 ชั้น 24 ยูนิต 140/57 ถนนสีลม แขวงสุริยวงศ์ เขตบางรัก กรุงเทพมหานคร 10500 ', 'กรุงเทพมหานคร', '0985818312', '10500', '-', 'https://foretoday.asia/?utm_source=chatgpt.com', '-', '-', '4 เดือน', 'ให้บริการด้าน กิจกรรมให้คำปรึกษาด้านการบริหารจัดการอื่นๆซึ่งมิได้จัด ประเภทไว้ในที่อื่น', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.8660053723825!2d100.5282436!3d13.726561199999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e299e336c3afab%3A0x303ead763850cdf4!2sForeToday%20Thailand!5e0!3m2!1sth!2sth!4v1739249558232!5m2!1sth!2sth', 2567, 102, '-'),
(10230, 'ธนาคารกรุงเทพ จํากัด (มหาชน) สาขา มหาสารคาม', 'Bangkok Bank Maha Sarakham', 'เลขที่ 472 ถนนนครสวรรค์ ตําบลตลาด อําเภอเมือง จังหวัดมหาสารคาม 440000', 'มหาสารคาม', '-', '440000', '-', 'https://www.bangkokbank.com/th-th/locate-us', '-', '-', '4 เดือน', 'ดำเนินงานในหลากหลายด้านของธุรกิจการเงิน', '0-4372-2555', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122581.788945513!2d103.19067305820317!3d16.23683630000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122a38bf4a57a27%3A0xc1df3c299b2e92d!2z4LiY4LiZ4Liy4LiE4Liy4Lij4LiB4Lij4Li44LiH4LmA4LiX4LieIOC4iOC4s-C4geC4seC4lCjguKHguKvguLLguIrguJkp4Liq4Liy4LiC4Liy4Lir4LiZ4LmJ4LiyIOC4oS7guKHguKvguLLguKrguLLguKPguITguLLguKE!5e0!3m2!1sth!2sth!4v1739249481817!5m2!1sth!2sth', 2567, 102, 'ค่าตอบแทน  มีประกันอุบัติเหตุสำหรับนักศึกษาฝึกงาน'),
(10231, 'ธนาคารออมสิน จํากัด สาขาโกสุมพิสัย', 'Government Savings Bank, Kosum Phisai Branch', 'เลขที่ 136 ถนนผดุงประชากร ตําบลหัวขวาง อําเภอโกสุมพิสัย จังหวัดมหาสารคาม 44140', 'มหาสารคาม', '0-4376-145', '44140', '-', 'https://www.gsb.or.th/contact_gsb/%E0%B8%AA%E0%B8%B2%E0%B8%82%E0%B8%B2%E0%B9%82%E0%B8%81%E0%B8%AA%E0%B8%B8%E0%B8%A1%E0%B8%9E%E0%B8%B4%E0%B8%AA%E0%B8%B1%E0%B8%A2/', '-', '-', '4 เดือน', 'บริการทางการเงินแก่ลูกค้าในพื้นที่ เช่น การรับฝากเงิน การให้สินเชื่อ และการให้คำปรึกษาด้านการเงิน', '0-4376-1830', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3830.438507621308!2d103.0672429!3d16.249281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122999d665cdee9%3A0xb0b9cf9c07496cc7!2z4LiY4LiZ4Liy4LiE4Liy4Lij4Lit4Lit4Lih4Liq4Li04LiZIOC4quC4suC4guC4suC5guC4geC4quC4uOC4oeC4nuC4tOC4quC4seC4og!5e0!3m2!1sth!2sth!4v1739249601406!5m2!1sth!2sth', 2567, 102, '-'),
(10232, 'บริษัท ขอนแก่นแหอวน จำกัด', 'KHON KAEN FISHING NET CO.,LTD', 'เลขที่ 115 หมู่ที่ 17 ถนนมิตรภาพ ตำบลในเมือง อำเภอเมืองขอนแก่น จ.ขอนแก่น 40000 ', 'ขอนแก่น', '0808435564', '40000 ', '-', 'https://www.kkfnets.com/career.php', '-', '-', '4 เดือน', 'ผู้นำในการส่งผลิต และส่งออกสินค้า ประเภทสิ่งทอ แห อวน ตาข่าย ภายใต้เครื่องหมายการค้าตราเรือใบ', '043-270972', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d489877.58525999374!2d102.5412649328125!3d16.416259699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x312289c6540fd92f%3A0xacbe609b96927cb0!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4guC4reC4meC5geC4geC5iOC4meC5geC4q-C4reC4p-C4mSDguIjguLPguIHguLHguJQgKOC4quC4s-C4meC4seC4geC4h-C4suC4meC5g-C4q-C4jeC5iCk!5e0!3m2!1sth!2sth!4v1739251033589!5m2!1sth!2sth', 2567, 102, '-'),
(10233, 'บริษัท อีริดู จำกัด', 'ERIDU COMPANY LIMITED', 'เลขที่ 1 ซอยสุขุมวิท 73 แขวงพระโขนงเหนือ เขตวัฒนา กรุงเทพมหานคร 10110 ', 'กรุงเทพมหานคร', '0875930612', '10110 ', '-', 'https://www.eridu.co.th/', '-', '-', '4 เดือน', 'ธุรกิจบริการ, การตลาด, ค้าปลีก / ค้าส่ง, โฆษณา / ประชาสัมพันธ์, บริการพาณิชย์อิเล็กทรอนิกส์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.9265726580347!2d100.5992326!3d13.662228700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a1bca1de8a3d%3A0x67a3731306fa9962!2sEridu%20Co.%2C%20Ltd.!5e0!3m2!1sth!2sth!4v1739251148287!5m2!1sth!2sth', 2567, 102, 'ทำงานจันทร์-ศุกร์ 9.00 - 18.00 น. หยุดเสาร์-อาทิตย์ และวันหยุดนักขัตฤกษ์เบี้ยเลี้ยงนักศึกษาฝึกงาน 3,000 บาท/เดือน (จ่ายทุกวันที่ 10 ของเดือน) มีแมวให้เล่น 1 ตัว'),
(10234, 'บริษัท มัด แอนด์ ฮาวด์ จํากัด (มหาชน)', 'MUDANDHOUND', 'เลขที่ 206 ซอยพัฒนาการ 20 แขวงสวนหลวง เขตสวนหลวง กรุงเทพมหานคร 10250', 'กรุงเทพมหานคร ', '02-0799765', '10250', '-', 'https://www.mudandhound.co.th/th/', '-', '-', '4 เดือน', 'เป็นบริษัทโฮลดิ้งที่ดำเนินธุรกิจในด้านการลงทุนและการจัดการ โดยมุ่งเน้นในสองกลุ่มธุรกิจหลัก ได้แก่ ธุรกิจร้านอาหารและเครื่องดื่ม', '02-079-9765', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31007.408139450225!2d100.58921240000004!3d13.722928850000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29fd471548bc1%3A0x9b91910fced19a38!2sMud%20%26%20Hound%20Public%20Company%20Limited!5e0!3m2!1sth!2sth!4v1739251235745!5m2!1sth!2sth', 2567, 102, '-'),
(10235, 'บริษัท เอชพีเอ็น กรุ๊ป โฮลดิ้งส์ จํากัด', 'HPN Group Holdings', 'เลขที่ 47/2 ตำบลคูขวาง อำเภอลาดหลุมแก้ว จังหวัดปทุมธานี 12140', 'ปทุมธานี ', '082-929-58', '12140', '-', 'https://www.hpngroupholdings.com/', '-', '-', '4 เดือน', 'บริษัทดำเนินธุรกิจการขายส่งสินค้าในครัวเรือนอื่น ๆ ซึ่งมิได้จัดประเภทไว้ในที่อื่น โดยมุ่งเน้นการผลิตและจำหน่ายเฟอร์นิเจอร์ เครื่องนอน และที่นอนแบบครบวงจร', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d496118.5302312036!2d100.58921240000004!3d13.722928850000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e283e42a2a8085%3A0x3ac461e2601b51b7!2z4Lia4LiI4LiBLiDguYDguK3guYfguJnguYDguK3guIrguJ7guLUg4Lit4Li04LiZ4LmA4LiV4Lit4Lij4LmMIOC4geC4o-C4uOC5iuC4myAo4Lib4Lij4Liw4LmA4LiX4Lio4LmE4LiX4LiiKQ!5e0!3m2!1sth!2sth!4v1739251296730!5m2!1sth!2sth', 2567, 102, 'บริษัทมีการเสนอโบนัสพิเศษสำหรับพนักงานใหม่'),
(10236, 'บริษัท โตโยต้า แมททีเรียล แฮสด์ลิ่ง แวร์เฮ้าส์ โซลูชั่น (ประเทศไทย) จํากัด', 'TOYOTA MATERIAL HANDLING WAREHOUSE SOLUTIONS THAILAND', 'เลขที่ 57 หมู่ 6 ถนนกิ่งแก้ว ตําบลราชาเทวะ อําเภอบางพลี จังหวัดสมุทรปราการ 10540 ', 'สมุทรปราการ', '088-002841', '10540', '-', 'https://www.toyotawarehousesolutions.co.th/th/', '-', '-', '4 เดือน', 'บริษัทจำหน่ายและให้บริการรถยกไฟฟ้า รวมถึงประตูโรงงานและพื้นปรับระดับ ยังมีบริการหลังการขาย บริการอะไหล่ และศูนย์ฝึกอบรม เพื่อสนับสนุนการดำเนินงานของลูกค้าอย่างครบวงจร', '02-721-6480', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.499165262082!2d100.728404!3d13.6881903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d60e75d5a8233%3A0xd5db94087d0d8fc9!2z4Lia4LiI4LiBLiDguYLguJXguYLguKLguJXguYnguLIg4LmB4Lih4LiX4LiX4Li14LmA4Lij4Li14Lii4LilIOC5geC4ruC4meC4lOC5jOC4peC4tOC5iOC4hyDguYHguKfguKPguYzguYDguK7guYnguLLguKrguYwg4LmC4LiL4Lil4Li54LiK4Lix4LmI4LiZ4Liq4LmMICjguJvguKPguLDguYDguJfguKjguYTguJfguKIp!5e0!3m2!1sth!2sth!4v1739251334363!5m2!1sth!2sth  ', 2567, 102, '-'),
(10237, 'บริษัท เจ้านาง (ไทยแลนด์) จํากัด', 'CHAONANG', 'เลขที่ 456/14 หมู่ที่1 ตําบลบ้านทุ่ม อําเภอเมืองขอนแก่น จังหวัดขอนแก่น 40000', 'ขอนแก่น', '080-840-82', '40000', '-', 'https://chaonangthailand.com/whats-new/', '-', '-', '4 เดือน', 'เป็นผู้ผลิตและจำหน่ายเครื่องสำอางภายใต้แบรนด์ \"เจ้านาง\"', '099-289-6963', '', 2567, 102, '-'),
(10238, 'โรงแรมฟาวน์เท่น ทรี รีสอร์ท', 'Fountain Tree Resort', 'เลขที่ 16 หมู่ 7 ถนนนิคมลําตะคอง ตําบลขนงพระ อําเภอปากช่อง นครราชสีมา 30130', 'นครราชสีมา', '0827477261', '30130', '-', 'https://www.fountaintreeresort.com/', '-', '-', '4 เดือน', 'เป็นรีสอร์ทท่ามกลางธรรมชาติ  รีสอร์ทเหมาะสำหรับการพักผ่อนแบบครอบครัว กลุ่มเพื่อน และหมู่คณะ', '087-800-8158', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.952324078161!2d101.4548537!3d14.6586471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311c2bf9ffbcd22f%3A0xeaf69299e29eb6ff!2z4Lif4Liy4Lin4LiZ4LmM4LmA4LiX4LmI4LiZ4LiX4Lij4Li1IEZvdW50YWluIFRyZWUgUmVzb3J0!5e0!3m2!1sth!2sth!4v1739251670151!5m2!1sth!2sth', 2567, 102, '-'),
(10239, 'บริษัท ปริญนรา แอสเสท จำกัด', 'PRINNARA ASSET COMPANY LIMITED', 'เลขที่ 1 อาคารเอ็มไพร์ ทาวเวอร์ ชั้นที่ 47 ยูนิต 4703 ถนนสาธรใต้ แขวงยานนาวา เขตสาธร กรุงเทพมหานคร 10210', 'กรุงเทพมหานคร', '-', '10210', '-', 'https://www.santihouse.com/', '-', '-', '4 เดือน', 'เป็นบริษัทพัฒนาอสังหาริมทรัพย์ที่มุ่งเน้นการพัฒนาที่อยู่อาศัยสำหรับคนรุ่นใหม่ โดยใช้แนวคิดคุณภาพและดีไซน์ล้ำสมัย ', '-', '-', 2567, 102, 'วันหยุดประจำปี,ลากิจหรือพักร้อน,ประกันอุบัติเหตุ,ชุดยูนิฟอร์มและอุปกรณ์เพื่อความปลอดภัย'),
(10240, 'บริษัท สัมปันนี ครีเอชั่น จํากัด', 'SUMPANNEE CREATION COMPANY LIMITED', 'เลขที่ 72 ซอยรามคําแหง 4 (สมานมิตร) แขวงสวนหลวง เขตสวนหลวง กรุงเทพฯ 10250', 'กรุงเทพฯ', '02-1270337', '10250', '-', '-', '-', '-', '4 เดือน', 'ธุรกิจเกี่ยวกับการขายส่งเสื้อผ้าและการขายสินค้าออนไลน์ภายใต้แบรนด์ CHEWA', '095-287-4547', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123919.73161537132!2d100.49182945820311!3d13.929308400000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2837aff7b7023%3A0xc6695e27e47e4525!2z4Liq4Lix4Lih4Lib4Lix4LiZ4LiZ4Li1LVNhbXBhbm5lZQ!5e0!3m2!1sth!2sth!4v1739251789963!5m2!1sth!2sth', 2567, 102, '-'),
(10241, 'บริษัท แบรนด์นิสต้า จํากัด (สํานักงานใหญ่)', 'BRANDNISTA CO., LTD', 'เลขที่ 225/15 ถนนประชาราษฎร์สาย 1 แขวงบางซื่อ เขตบางซื่อ กรุงเทพมหานคร 10800', 'กรุงเทพมหานคร', '-', '10800', '-', '-', '-', '-', '4 เดือน', 'ธุรกิจออกแบบและพัฒนาเว็บไซต์ทุกประเภท', '02-912-5588', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247826.44360594542!2d100.55131461640622!3d13.941439000000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d7dfe3d4b10eb%3A0x49b78fac50f42a1a!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5geC4muC4o-C4meC4lOC5jCDguYDguJrguYDguJnguJ_guLTguJUgKOC4m-C4o-C4sOC5gOC4l-C4qOC5hOC4l-C4oikg4LiI4Liz4LiB4Lix4LiUIHwgQnJhbmRiZW5lZml0IENvLixMdGQu!5e0!3m2!1sth!2sth!4v1739251904745!5m2!1sth!2sth', 2567, 102, '-'),
(10242, 'ห้างหุ้นส่วนจํากัด ทองทวี (ขอนแก่น) เจริญยนต์', 'TONGTAWEE (KHONKAEN) JARERNYON LIMITED PARTNERSHIP', 'เลขที่ 334 ม.15 ตำบลศิลา อำเภอเมือง จังหวัดขอนแก่น 40000', 'ขอนแก่น', '043225197', '40000', '-', '-', '-', '-', '4 เดือน', 'ธุรกิจเกี่ยวกับการบำรุงรักษาและซ่อมระบบเครื่องยนต์และชิ้นส่วนยานยนต์ ', '092-838-2417', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.944288809989!2d102.8566486!3d16.4783584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x312261985a000a7b%3A0x66970f87689cd85d!2z4Lit4Li54LmI4LiX4Lit4LiH4LiX4Lin4Li14LiC4Lit4LiZ4LmB4LiB4LmI4LiZ!5e0!3m2!1sth!2sth!4v1739251964916!5m2!1sth!2sth', 2567, 102, 'วันลาป่วย สามารถใช้สิทธิ์ลาป่วยได้ โดยไม่ต้องยื่นใบรับรองแพทย์ หากไม่เกิน 3 วัน'),
(10243, 'บริษัท พลาสติค และหีบห่อไทย จํากัด (มหาชน)', 'THAI PLASPAC PUBLIC COMPANY LIMITED', 'เลขที่ 77 ซอยเทียนทะเล 30 แขวงท่าข้าม เขตบางขุนเทียน กรุงเทพมหานคร 10150', 'กรุงเทพมหานคร', '-', '10150', '-', 'https://tpacpackaging.com/th/contact/', '-', '-', '-', 'ธุรกิจผลิตบรรจุภัณฑ์พลาสติกประเภทขวดและฝาบรรจุอาหาร น้ำยาทำความสะอาด ตลอดจนเครื่องใช้และอุปกรณ์ต่าง ๆ', '02-897-2250', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3878.132776514219!2d100.422356!3d13.588699000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2bcd132d524b3%3A0x11a7cbef75f65b60!2z4Lia4Lih4LiILiDguJ7guKXguLLguKrguJXguLTguITguYHguKXguLDguKvguLXguJrguKvguYjguK3guYTguJfguKIgfCBUaGFpIFBsYXNwYWPigIsgUHVibGljIENvbXBhbnkgTGltaXRlZCAoVFBBQyk!5e0!3m2!1sth!2sth!4v1739252038681!5m2!1sth!2sth', 2567, 102, '-'),
(10244, 'โรงแรมเจริญธานี ขอนแก่น', 'Charoenthanihotel', 'เลขที่ 260 ถนนศรีจันทร์ ตำบลในเมือง อำเภอเมือง จังหวัดขอนแก่น 40000', 'ขอนแก่น', '-', '40000', '-', '-', '-', '-', '4 เดือน', 'ให้บริการห้องพักที่สะดวกสบายและสิ่งอำนวยความสะดวกครบครัน', '04-322-0400', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.9102923905325!2d102.8329164!3d16.429381799999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228a23750d5347%3A0x664a57ee26a7b7e8!2z4LmC4Lij4LiH4LmB4Lij4Lih4LmA4LiI4Lij4Li04LiN4LiY4Liy4LiZ4Li1IOC4guC4reC4meC5geC4geC5iOC4mQ!5e0!3m2!1sth!2sth!4v1739252088720!5m2!1sth!2sth', 2567, 102, 'เวลาทำงานไม่เกินวันละ 6 ชั่วโมง และไม่เกิน 30 ชั่วโมงต่อสัปดาห์ เวลาพักไม่น้อยกว่า 1 ชั่วโมงต่อวัน หลังจากทำงานมาแล้วไม่เกิน 4 ชั่วโมง วันหยุดประจำสัปดาห์ไม่น้อยกว่า 2 วันต่อสัปดาห์ โดยให้มีระยะห่างกันไม่เกิน 5 วัน \r\n'),
(10301, 'บริษัท คิวบ์ อนาไลติกส์ คอนซัลติ้ง จำกัด', 'CUBE ANALYTICS CONSULTING CO., LTD', 'เลขที่ 7 ซอยลาดพร้าว 23 แขวงจันทรเกษม เขตจตุจักร กรุงเทพมหานคร 10900', 'กรุงเทพมหานคร', '0619426953', '10900', 'chutimon@datacubeth.ai', 'https://data.creden.co/company/general/0105563162485', 'คุณชุติมณฑน์', 'นักวิเคราะห์ข้อมูล', '4 เดือน', 'ให้บริการด้านการจัดการและสนับสนุนกิจกรรมทางธุรกิจ เช่น การจัดงานแสดงสินค้า การประชุม และกิจกรรมส่งเสริมการขาย', '-', '-', 2567, 103, '-'),
(10302, 'ห้างหุ้นส่วนจำกัด ไอที เทคโนคอม', 'IT TECHNOCOM LIMITED PARTNERSHIP', 'เลขที่ 641/14 ซอยเสรีไทย 11 ถนนเสรีไทย แขวงคลองกุ่ม เขตบึงกุ่ม กรุงเทพมหานคร 10240', 'กรุงเทพมหานคร', '0625059561', '10240', 'chalamla@gmail.com', 'www.it-technocom.com', '-', '-', '4 เดือน', 'ให้คำปรึกษาและบริการด้านเทคโนโลยีสารสนเทศ เช่น การฝึกอบรม IT การพัฒนาเว็บไซต์ และการจดทะเบียนโดเมนเนม', '02-001-8804', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3872.8323379751123!2d100.5030321750931!3d13.908967786499499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e285001d3f690d%3A0xc1ab2345ae8adeb5!2z4Lir4LiI4LiBLuC5hOC4reC4l-C4teC5gOC4l-C4hOC5guC4meC4hOC4reC4oQ!5e0!3m2!1sth!2sth!4v1739252396679!5m2!1sth!2sth', 2567, 103, '-'),
(10303, 'บริษัท เอ็นเอ็มบี-มินีแบไทย จำกัด (โรงงานบางปะอิน)', 'NMB-Minebea Thai Ltd', 'เลขที่ 1 หมู่ 7 ถ.พหลโยธิน ก.ม. 51 ต.เชียงรากน้อย อ.บางปะอิน จ.พระนครศรีอยุธยา 13180 ', 'พระนครศรีอยุธยา', '080-059025', '13180', '-', 'https://minebea.co.th/th/', '-\r\n', '-', '4 เดือน', 'ผู้ผลิตและจำหน่ายตลับลูกปืนและชิ้นส่วนอิเล็กทรอนิกส์', '(035) 361177', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3867.1934149162903!2d100.6052017!3d14.241936699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e278a873b3b99f%3A0x8e4319aa390c8f1d!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4reC5h-C4meC5gOC4reC5h-C4oeC4muC4tS3guKHguLTguJnguLXguYHguJog4LmE4LiX4LiiIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739252490916!5m2!1sth!2sth', 2567, 103, '-'),
(10304, 'บริษัท เอฟซีซี เซอร์วิสเซส จำกัด', 'FCC Services Co., Ltd', 'เลขที่ 323/1 ซอยภาวนา (ลาดพร้าว41) ถนนลาดพร้าว แขวงสามเสนนอก เขตห้วยขวาง กรุงเทพมหานคร 10310 \r\n', 'กรุงเทพมหานคร', '0921205188', '10310 ', '-', ' www.fcc.co.th', '-', '-', '4 เดือน', 'ให้บริการ ศูนย์บริการลูกค้าภายนอก (Outsourcing Contact Center) เช่น บริการรับสายและโทรออก, ช่วยเหลือฉุกเฉินบนท้องถนน, และระบบบริหารจัดการลูกค้าสัมพันธ์ (CRM)', '02-793-9365', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.6158160068567!2d100.5865164!3d13.8020182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29db7f637f349%3A0x83e92e3814e02a63!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4reC4n-C4i-C4teC4i-C4tSDguYDguIvguK3guKPguYzguKfguLTguKrguYDguIvguKog4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739252568088!5m2!1sth!2sth', 2567, 103, '-'),
(10305, 'บริษัท น้ำตาลครบุรี จำกัด (มหาชน) (โรงงานน้ำตาลครบุรี สีคิ้ว)', 'Khonburi Sugar Public Company Limited', 'เลขที่ 289 หมู่ 13 ตำบลจระเข้หิน อำเภอครบุรี จังหวัดนครราชสีมา 30250  \r\n', 'นครราชสีมา', '044 448 33', '30250', '-', 'www.kbs.co.th', '-', '-', '4 เดือน', 'ผู้ผลิตและจำหน่ายน้ำตาลทรายครบวงจร', '044-448-500', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9101177806388!2d100.5801321!3d13.723891300000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29fa9349a61e1%3A0x12668b4fe5722848!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4meC5ieC4s-C4leC4suC4peC4hOC4o-C4muC4uOC4o-C4tSDguIjguLPguIHguLHguJQgKOC4oeC4q-C4suC4iuC4mSk!5e0!3m2!1sth!2sth!4v1739252620833!5m2!1sth!2sth', 2567, 103, 'เบี้ยเลี้ยงวันฝึกงาน'),
(10306, 'บริษัท สเตป โซลูชั่นส์ จำกัด', 'Step Solutions Co., Ltd', 'เลขที่ 75 ถนนนิมิตใหม่ แขวงสามวาตะวันออก เขตคลองสามวา กรุงเทพมหานคร 10510\r\n', 'กรุงเทพมหานคร ', '02 106 275', '10510', '-', 'www.step-solutions.com', '-', '-', '4 เดือน', 'ให้บริการโซลูชันดิจิทัลและระบบบริการตนเอง โดยมุ่งเน้นการนำเสนอเทคโนโลยีที่ทันสมัยเพื่อยกระดับการนำเสนอสินค้าและบริการของลูกค้า', '0-2976-9105', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.543032332102!2d100.7302916!3d13.866446600000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d7bb4900d6803%3A0xb790fef4e08b6bfb!2sStep%20Solutions%20Co.%2C%20Ltd!5e0!3m2!1sth!2sth!4v1739252683387!5m2!1sth!2sth', 2567, 103, '-'),
(10307, 'บริษัท ดีทรัซ จำกัด (สำนักงานใหญ่)', 'Ditruz Co., Ltd', 'เลขที่ 91/909 หมู่ 3 สินทรัพย์ 1 ถนนรังสิต – นครนายก ตำบลบึงยี่โถ อำเภอธัญบุรี จังหวัดปทุมธานี 12130 \r\n', 'ปทุมธานี', '02-102-474', '12130', '-', 'www.ditruz.com', '-', '-', '4 เดือน', 'ธุรกิจด้าน การพัฒนาระบบและบริการด้านเทคโนโลยีสารสนเทศ (IT Solutions)', '02-102-4747', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.3331727781424!2d100.69294579999999!3d13.9982483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d7ed933591297%3A0x4cd6545a05330169!2sDitruz%20Co.%2CLtd.!5e0!3m2!1sth!2sth!4v1739252736256!5m2!1sth!2sth', 2567, 103, '-'),
(10308, 'บริษัท เอ็นเอ็มบี-มินีแบไทย จำกัด (โรงงานนวนคร)', 'NMB-Minebea Thai Co., Ltd', 'เลขที่ 60/118 นิคมอุตสาหกรรมนวนคร หมู่ 19 ถ.พหลโยธิน ต.คลองหนึ่ง อ.คลองหลวง ปทุมธานี 12120 \r\n', 'ปทุมธานี', '0800590252', '12120 ', '-', 'www.minebea.co.th', '-', '-', '4 เดือน', 'ผลิตตลับลูกปืนขนาดเล็ก มอเตอร์ขนาดเล็ก ชิ้นส่วนเชิงกล และอุปกรณ์/ชิ้นส่วนอิเล็กทรอนิกส์ที่มีความเที่ยงตรงสูง', '0-2529-3790', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123750.18927732129!2d100.53516385820309!3d14.241936699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e278a873b3b99f%3A0x8e4319aa390c8f1d!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4reC5h-C4meC5gOC4reC5h-C4oeC4muC4tS3guKHguLTguJnguLXguYHguJog4LmE4LiX4LiiIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739252788740!5m2!1sth!2sth', 2567, 103, ' เบี้ยเลี้ยง , อาหาร , การฝึกอบรม'),
(10309, 'บริษัท ดิจิทัล แวลู จำกัด', 'Digital Value Company Limited', 'เลขที่ 9/12 ซอยกรุงเทพกรีฑา7 แยก 4 (บ้านสวนราชา) แขวงหัวหมาก เขตบางกะปิ กรุงเทพมหานคร 10240 \r\n', 'กรุงเทพมหานคร', '0851881090', '10240 ', '-', 'www.digitalvalue.co.th', '-', '-', '4 เดือน', 'ทำธุรกิจด้านการขาย, ให้เช่า และให้บริการรับวางระบบคอมพิวเตอร์ รวมถึงการจัดการสิ่งอำนวยความสะดวกด้านคอมพิวเตอร์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.2977579999947!2d100.62843099999999!3d13.760908899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d618b650500f7%3A0x149195fab3f3b468!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4lOC4tOC4iOC4tOC4l-C4seC4pSDguYHguKfguKXguLkg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1739252835481!5m2!1sth!2sth', 2567, 103, '-'),
(10310, 'บริษัท ซีพี แอ็กตร้า จำกัด (มหาชน) สาขามหาสารคาม', 'CP Axtra Public Company Limited', 'เลขที่ 253 หมู่ที่ 8 ตำบลเกิ้ง อำเภอเมืองมหาสารคาม จังหวัดมหาสารคาม 44000\r\n', 'มหาสารคาม', '-', '44000', '-', 'https://www.cpaxtra.com/en/home', '-', '-', '4 เดือน', 'ทำธุรกิจ ค้าปลีก และ ค้าส่ง จำหน่ายสินค้าอุปโภคบริโภคและบริการแฟรนไชส์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d496089.9926181844!2d100.34706503281252!3d13.736418599999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d61d16119f48b%3A0xafa9687eb8f7bc52!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4i-C4teC4nuC4tSDguYHguK3guYfguIHguIvguYzguJXguKPguYnguLIg4LiI4Liz4LiB4Lix4LiUICjguKHguKvguLLguIrguJkpIOC4quC4s-C4meC4seC4geC4h-C4suC4meC5g-C4q-C4jeC5iA!5e0!3m2!1sth!2sth!4v1739252902183!5m2!1sth!2sth', 2567, 103, '-'),
(10311, 'บริษัท ขอนแก่นแหอวน จำกัด', 'Khon Kaen Fishing Net Factory Co., Ltd', 'เลขที่ 115 หมู่ที่ 17 ถนนมิตรภาพ ตำบลในเมือง อำเภอเมืองขอนแก่น จ.ขอนแก่น 40000 \r\n', 'ขอนแก่น', '0808435564', '40000', '-', 'www.kkfnets.com', '-', '-', '4 เดือน', 'ธุรกิจเกี่ยวกับการผลิตและจำหน่าย ตาข่าย แห อวน และ อุปกรณ์การประมง รวมถึงสินค้าสำหรับ การเกษตร ภายใต้แบรนด์ \"เรือใบ\" (SHIP)', '0-4322-1879', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1972188.5251666969!2d101.69370705000001!3d15.107146900000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x312289c6540fd92f%3A0xacbe609b96927cb0!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4guC4reC4meC5geC4geC5iOC4meC5geC4q-C4reC4p-C4mSDguIjguLPguIHguLHguJQgKOC4quC4s-C4meC4seC4geC4h-C4suC4meC5g-C4q-C4jeC5iCk!5e0!3m2!1sth!2sth!4v1739252957437!5m2!1sth!2sth', 2567, 103, '-'),
(10312, 'บริษัท ดับบลิวทีซี คอมพิวเตอร์ จำกัด', 'WTC Computer Co., Ltd', 'เลขที่ 128/343-344 อาคารพญาไทพลาซ่า ชั้น 13 ถนนพญาไท แขวงทุ่งพญาไท เขตราชเทวี กรุงเทพมหานคร 10400\r\n', 'กรุงเทพมหานคร', '0 2612 118', '10400', '-', 'www.wtc.co.th', '-', '-', '4 เดือน', 'ทำธุรกิจจำหน่ายคอมพิวเตอร์, อุปกรณ์ IT และให้บริการออกแบบและวางระบบคอมพิวเตอร์ (Systems Integration)', '0-2216-5185', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.371111344476!2d100.52923387509033!3d13.75647978663585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29eca656a1347%3A0x35f9a4141ab476d1!2sWTC%20Computer%20Co.%2CLTD!5e0!3m2!1sth!2sth!4v1739253152879!5m2!1sth!2sth', 2567, 103, '-'),
(10313, 'ศูนย์สร้างสรรค์งานออกแบบ', 'Thailand Creative & Design Center (TCDC)', 'เลขที่ 123 หมู่ 6 ถนนมิตรภาพ ตำบลในเมือง อำเภอเมืองขอนแก่น จังหวัดขอนแก่น 40002\r\n', 'ขอนแก่น', '0 4300 938', '40002', '-', 'https://www.tcdc.or.th/th/about-main', '-', '-', '4 เดือน', 'TCDC ส่งเสริมและพัฒนาศักยภาพด้านการออกแบบ ผ่านกิจกรรมต่างๆ เช่น เวิร์กชอปและนิทรรศการ', '0-2105-7450', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.8637366577723!2d100.51562349999999!3d13.726698500000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f022db566ff%3A0x287c0f1b5fbe26f3!2z4Lio4Li54LiZ4Lii4LmM4Liq4Lij4LmJ4Liy4LiH4Liq4Lij4Lij4LiE4LmM4LiH4Liy4LiZ4Lit4Lit4LiB4LmB4Lia4Lia!5e0!3m2!1sth!2sth!4v1739253190555!5m2!1sth!2sth', 2567, 103, '-'),
(10314, 'บริษัท เทเลอินโฟ มีเดีย จำกัด (มหาชน)', 'Teleinfo Media Public Company Limited', 'เลขที่ 1126/2 อาคารวานิช 2 ชั้น 28 ห้องเลขที่ 2803, 2804 ถนนเพชรบุรีตัดใหม่ แขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400\r\n', 'กรุงเทพมหานคร', '061569 299', '10400', '-', 'https://www.teleinfomedia.co.th/', '-', '-', '4 เดือน', 'บริการโฆษณาออนไลน์ผ่านแพลตฟอร์ม Thailand YellowPagesTM ซึ่งเป็นสื่อโฆษณาดิจิทัลของคนไทย ที่รวมข้อมูลการติดต่อธุรกิจทั่วไทยไว้ในเว็บเดียว', '0-2262-8811', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.4975594285193!2d100.54801859999999!3d13.7488415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29c1d94a40bd5%3A0xa39f162fe68dbc3e!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4l-C5gOC4peC4reC4tOC4meC5guC4nyDguKHguLXguYDguJTguLXguKIg4LiI4Liz4LiB4Lix4LiUICjguKHguKvguLLguIrguJkpIOC4quC4s-C4meC4seC4geC4h-C4suC4meC5g-C4q-C4jeC5iA!5e0!3m2!1sth!2sth!4v1739253238830!5m2!1sth!2sth', 2567, 103, 'ห้องพยาบาล พร้อมแพทย์ (รักษาฟรี) เบี้ยเลี้ยง 200 บาทต่อวัน'),
(10315, 'อุทยานประวัติศาสตร์พนมรุ้ง', 'Phanom Rung Historical Park', 'เลขที่ 114 หมู่ที่ 8 ตำบลตาเป๊ก อำเภอเฉลิมพระเกียรติ จังหวัดบุรีรัมย์ 31110\r\n', 'บุรีรัมย์ ', '0 4466 625', '31110', '-', 'https://www.finearts.go.th/phanomrunghistoricalpark/contact', '-', '-', '4 เดือน', 'ฝึกปฏิบัติงานห้องสมุด ที่ห้องวารสารและหนังสือพิมพ์', '044 666 251', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7724.331614981224!2d102.94261624999999!3d14.532506599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311bd4d819ab46c1%3A0x9dfb475988ec4e0d!2z4Lit4Li44LiX4Lii4Liy4LiZ4Lib4Lij4Liw4Lin4Lix4LiV4Li04Lio4Liy4Liq4LiV4Lij4LmM4Lie4LiZ4Lih4Lij4Li44LmJ4LiH!5e0!3m2!1sth!2sth!4v1739253280485!5m2!1sth!2sth', 2567, 103, '-'),
(10316, 'บริษัท อนันดา ดีเวลลอปเม้นท์ จำกัด (มหาชน)', 'ANANDA DEVELOPMENT PUBLIC ', 'สำนักงาน FYI 2525 อาคารเอฟวายไอ เซ็นเตอร์ ชั้น 11 ถนนพระราม4 แขวงคลองเตย เขตคลองเตย กรุงเทพมหานคร 10110\r\n', 'กรุงเทพมหานคร ', '0 4424 555', '10110', '-', 'http://www.ananda.co.th', '-', '-', '4 เดือน', 'จัดทำประกาศรับสมัครงานลงในเว็บไซต์ และ สื่อออนไลน์ต่างๆ นัดสัมภาษณ์ผู้สมัครงาน จัดการงานด้านเอกสารของงานฝ่ายบุคคล บันทึกข้อมูลพนักงานลงในระบบ งานอื่นๆที่ได้รับมอบหมาย', '02-0562222', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9703108036565!2d100.5599977!3d13.720247299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d5ea12f71553f%3A0xd5f0d96c9d24a623!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4reC4meC4seC4meC4lOC4siDguJTguLXguYDguKfguKXguKXguK3guJvguYDguKHguYnguJnguJfguYwg4LiI4Liz4LiB4Lix4LiUICjguKHguKvguLLguIrguJkp!5e0!3m2!1sth!2sth!4v1739253329210!5m2!1sth!2sth', 2567, 103, 'ประกันสุขภาพ ประกันชีวิต ค่าใช้จ่ายในการเดินทาง สิธิการเบิกค่าทันตกรรม ประกันสังคม ตามข้อตกลงของบริษัท'),
(10401, 'โรงพยาบาลมหาวิทยาลัยเทคโนโลยีสุรนารี', 'Suranaree University of Technology Hospital', 'เลขที่ 111 ถนนมหาวิทยาลัย ตำบลสุรนารี อำเภอเมือง จังหวัดนครราชสีมา 30000\r\n', 'นครราชสีมา', '044376555', '30000', '-', 'https://www.suth.go.th', '-', '-', '4 เดือน', 'การเรียนการสอนทางการแพทย์', '0 4437 6999', 'https://www.google.com/maps/place/%E0%B8%A8%E0%B8%B9%E0%B8%99%E0%B8%A2%E0%B9%8C%E0%B8%AA%E0%B8%AB%E0%B8%81%E0%B8%B4%E0%B8%88%E0%B8%A8%E0%B8%B6%E0%B8%81%E0%B8%A9%E0%B8%B2%E0%B9%81%E0%B8%A5%E0%B8%B0%E0%B8%9E%E0%B8%B1%E0%B8%92%E0%B8%99%E0%B8%B2%E0%B8%AD%E0%B8%B2%E0%B8%8A%E0%B8%B5%E0%B8%9E+%E0%B8%A1%E0%B8%AB%E0%B8%B2%E0%B8%A7%E0%B8%B4%E0%B8%97%E0%B8%A2%E0%B8%B2%E0%B8%A5%E0%B8%B1%E0%B8%A2%E0%B9%80%E0%B8%97%E0%B8%84%E0%B9%82%E0%B8%99%E0%B9%82%E0%B8%A5%E0%B8%A2%E0%B8%B5%E0%B8%AA%E0%B8%B8%E0%B8%A3%E0%B8%99%E0%B8%B2%E0%B8%A3%E0%B8%B5/@14.8814744,102.0129798,17z/data=!3m1!4b1!4m6!3m5!1s0x311ead99ce4d3089:0x7546ed1e26c55ab7!8m2!3d14.8814744!4d102.0155547!16s%2Fg%2F11b6q1cysd?entry=ttu&g_ep=EgoyMDI1MDIwOS4wIKXMDSoASAFQAw%3D%3D', 2567, 104, '-'),
(10402, 'บริษัท เอ็ม เอฟ อี ซี จำกัด (มหาชน)', 'M F E C PUBLIC COMPANY LIMITED', 'เลขที่ 349 อาคาร เอสเจอินฟินิทวัน บิสซิเนส คอมเพล็กซ์ ถนนวิภาวดีรังสิต แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900 \r\n', 'กรุงเทพมหานคร', '0-2821-799', '10900', ' info@sec.or.th', ' www.mfec.co.th', 'น.ส.อรวรรณ  หนุนตะคุ', 'เลขานุการบริษัท', '4 เดือน', 'ทำงานเกี่ยวกับ Digital', '0-2618-8188', 'https://www.google.co.th/maps/place/MFEC+Public+Company+Limited+(Headquarter)/@13.8096364,100.5557356,17z/data=!4m14!1m7!3m6!1s0x30e29d82c3bdbadd:0x77a12003cc7a66d2!2sMFEC+Public+Company+Limited+(Headquarter)!8m2!3d13.8096364!4d100.5583105!16s%2Fg%2F11fd6bc_dh!3m5!1s0x30e29d82c3bdbadd:0x77a12003cc7a66d2!8m2!3d13.8096364!4d100.5583105!16s%2Fg%2F11fd6bc_dh?entry=ttu&g_ep=EgoyMDI1MDIwOS4wIKXMDSoASAFQAw%3D%3D', 2567, 104, 'มีเงินช่วยเหลือค่าเดินทาง วันไหนที่ Work from Home  ก็จะยังได้รับในส่วนนี้เช่นเดียวกัน และทาง MFEC มี Certificate ให้หลังฝึกจบ'),
(10403, 'บริษัท อินเทลลิเจนท์ ดี.ซี จำกัด', 'INTELLIGENT D.C COMPANY LIMITED', 'เลขที่ 190 หมู่ 3 ต.สันผีเสื้อ อ.เมือง จ.เชียงใหม่ 50300 \r\n\r\n\r\n', 'เชียงใหม่', '062-753846', ' 50300 ', 'sirinya.t@i-dc.co.th', 'https://web.facebook.com/AccRmutlCM/photos/%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%81%E0%B8%B2%E0%B8%A8%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%A9%E0%B8%B1%E0%B8%97%E0%B', 'คุณสิริญญา', '-', '4 เดือน', 'สำนักงานบัญชีคุณภาพและสำนักงานบัญชีดิดิจิทัล\r\nโดยกรมพัฒนาธุรกิจการค้า กระทรวงพาณิชย์', '-', 'https://maps.app.goo.gl/Xct7Tggg4AFcrAZL8', 2567, 104, '-'),
(10404, 'บริษัท บีเอสเอส โฮลดิงส์ จำกัด', 'BSS HOLDINGS COMPANY LIMITED', 'เลขที่ 21 อาคารทีเอสที ทาวเวอร์ ชั้น 19 ซอยเฉยพ่วง ถนนวิภาวดี-รังสิต แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900 \r\n', 'กรุงเทพมหานคร', ' +662 273 ', '10900 ', 'TSDCallCenter@set.or.th', 'www.set.or.th/th/tsd/overview', '-', '-', '4 เดือน', 'บริการ IT และการให้คำปรึกษาด้าน IT', ' +662 273 8858', 'https://maps.app.goo.gl/pXvo9BYq63vUwjp99', 2567, 104, '-'),
(10405, 'บริษัท ซันฟู้ด อินเตอร์ เนชั่นแนล จำกัด', '-', 'เลขที่ 69 หมู่ 6 ตำบลคำพราน อำเภอวังม่วง จังหวัดสระบุรี 18220 \r\n', 'สระบุรี ', '(66) 2561-', '18220 ', 'sungroup@sungroup.co.th', 'https://www.sungroup.co.th/recruitment3/', '-', '-', '4 เดือน', 'โรงงานผลิตอาหารไก่ ฟาร์มพ่อแม่พันธุ์ โรงฟักไข่ ฟาร์มไก่เนื้อ ธุรกิจไก่ประกัน และไก่จ้างเลี้ยง โรงงานผลิต และแปรรูปเนื้อไก่สดเนื้อไก่แช่แข็ง เพื่อการส่งออก โรงงานผลิตอาหารปรุงสุกแช่แข็งจากเนื้อไก่', '(00) 3673-0245,(00) ', 'https://maps.app.goo.gl/dMR5sPhiN6L9kZtT9', 2567, 104, '-'),
(10501, 'บริษัท เบโค ไทย จำกัด', 'Beko Thai', 'เลขที่ 360 หมู่ 3 ตำบลหนองละลอก อำเภอบ้านค่าย จังหวัดระยอง 21120 \r\n', 'ระยอง', '038-997200', '21120 ', 'piriya.sornwong@beko.com\r\n', 'www.beko.com', 'คุณบุ๋ม \r\n', 'ฝ่ายทรัพยากรบุคคล\r\n', '4 เดือน', 'ผลิตและจำหน่ายเครื่องใช้ไฟฟ้า รวมทั้งให้บริการหลังการขาย รวมถึงการติดตั้ง ซ่อมแซม และบำรุงรักษา', '0-3899-7200', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d995939.8502100611!2d100.69827826562502!3d12.818053700000013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3102e3f3eefcc5ad%3A0xf8ecff939611f4!2sBeko%20Thai!5e0!3m2!1sth!2sth!4v1739253515575!5m2!1sth!2sth', 2567, 105, 'ค่าเบี้ยเลี้ยงวันละ 300 บาท อาหารกลางวันฟรี รถรับ-ส่งฟรี'),
(10502, 'บริษัท สยามโกลบอลเฮ้าส์ จำกัด (มหาชน)', 'SIAM GLOBAL HOUSE PUBLIC COMPANY LIMITED', 'เลขที่ 232 หมู่ 19 ตำบลรอบเมือง อำเภอเมืองร้อยเอ็ด ร้อยเอ็ด 45000 \r\n', ' ร้อยเอ็ด ', '081-872511', '45000 ', 'chutipa@globalhouse.co.th\r\n', 'www.globalhouse.co.th', 'คุณชุติภา \r\n', 'ฝ่ายทรัพยากรบุคคล\r\n', '4 เดือน', 'จำหน่ายวัสดุก่อสร้างและอุปกรณ์ตกแต่งบ้าน', '0-4361-9886-7', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.578205049679!2d103.651128!3d16.035458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3117fc30840dac6b%3A0xa742d70c96acaabe!2z4LmC4LiB4Lil4Lia4Lit4Lil4LmA4Liu4LmJ4Liy4Liq4LmMIOC4o-C5ieC4reC4ouC5gOC4reC5h-C4lA!5e0!3m2!1sth!2sth!4v1739253635401!5m2!1sth!2sth', 2567, 105, '-'),
(10503, 'บริษัท เอส ซี อาร์ทิสทรี จำกัด', 'S.C.Artistry Co.,Ltd', 'เลขที่ 128/939 หมู่ 1 ถนนเทพารักษ์ ตำบลบางเสาธง อำเภอบางเสาธง จังหวัดสมุทรปราการ 10570 \r\n', 'สมุทรปราการ', '0270639798', '10570 ', 'Hattachai_k@lolane.com\r\n', 'www.lolane.com', 'คุณหัธชัย \r\n', 'ผู้จัดการฝ่ายทรัพยากรบุคคล\r\n', '4 เดือน', 'ผลิตเครื่องหอม เครื่องสำอาง และผลิตภัณฑ์ในห้องน้ำ', '02 706 3979', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248075.74274135116!2d100.5030617048022!3d13.707334679220182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d5b5e1de17a6f%3A0xe3413c8205054761!2z4Lia4LiI4LiBLiDguYDguK3guKou4LiL4Li1LuC4reC4suC4o-C5jOC4l-C4tOC4quC4l-C4o-C4tSAo4LmC4Lij4LiH4LiH4Liy4LiZKQ!5e0!3m2!1sth!2sth!4v1739253709883!5m2!1sth!2sth', 2567, 105, '-'),
(10504, 'โครงการ CP ALL Internship Program บริษัท ซีพีออลล์ จำกัด (มหาชน)', 'CP ALL PUBLIC COMPANY LIMITED', 'เลขที่ 58/28 อาคาร The tara แจ้งวัฒนะ ชั้น 11 (HR Operations) ถนนแจ้งวัฒนะ บางตลาด อำเภอปากเกร็ด จังหวัดนนทบุรี 11120\r\n', 'นนทบุรี', '0845091181', '11120', 'Emkritlao@cpall.co.th\r\n', 'http://www.cpall.co.th', 'คุณเอมกฤษฎ์\r\n', 'ฝ่ายทรัพยากรบุคคล\r\n', '4 เดือน', 'Merchandising / Marketing / Purchasing / Human Resources และอื่นๆ ', '0-2071-1870', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3827.8676909906762!2d102.8139454751425!3d16.380700984344827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x312289818c00de7b%3A0x6f570ac12097bb28!2z4Lia4Lij4Li04Lip4Lix4LiXIENQQUxMIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1739253772039!5m2!1sth!2sth', 2567, 105, 'เบี้ยเลี้ยงวันละ 500 บาท (สำหรับการฝึกงานที่สำนักงานใหญ่) หรือ 300 บาท (สำหรับการฝึกงานออนไลน์) ประกันชีวิตและประกันอุบัติเหตุระหว่างฝึกงาน  สิทธิในการใช้บริการที่ Health Center และเข้าร่วม Development Program ต่าง ๆ ที่ทางโครงการจัดขึ้น เช่น Plant Tour และ CSR'),
(10505, 'บริษัท โอเวอร์โฟล ดีไซน์ แอนด์ บิลด์ จำกัด', 'OVERFLOW DESIGN AND BUILD COMPANY LIMITED', 'เลขที่ 555/7 หมู่บ้านเนอวานา สุวรรณภูมิ ถนนอ่อนนุช แขวงประเวศ เขตประเวศ กรุงเทพมหานคร 10250 \r\n', 'กรุงเทพมหานคร', '02-0820855', '10250 ', '-', 'http://www.overflowservice.com/', '-', 'ฝ่ายทรัพยากรบุคคล\r\n', '4 เดือน', 'งานสถาปัตยกรรมและการให้คำปรึกษาที่เกี่ยวข้อง', '0-20820855', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9565738372435!2d100.6850865!3d13.721079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d60e7233f6d61%3A0xf2f4baab2ba8c768!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5guC4reC5gOC4p-C4reC4o-C5jOC5guC4n-C4pSDguJTguLXguYTguIvguJnguYwg4LmB4Lit4LiZ4LiU4LmMIOC4muC4tOC4peC4lOC5jCDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739253813333!5m2!1sth!2sth', 2567, 105, '-'),
(10506, 'บริษัท เบทาโกร จำกัด (มหาชน)', 'BETAGRO', 'เบทาโกร ทาวเวอร์ (นอร์ทปาร์ค) เลขที่ 323 ถนนวิภาวดีรังสิต แขวงทุ่งสองห้อง เขตหลักสี่ กรุงเทพมหานคร 10210\r\n', 'กรุงเทพมหานคร', '080-045-54', '10210', 'kanyaratkh@betagro.com\r\n', 'https://www.betagro-food.com/contact', 'คุณกันยรัตน์ ขันตี  \r\n', 'เจ้าหน้าที่ทรัพยากรมนุษย์\r\n', '4 เดือน', 'ผลิตอาหารสัตว์ เวชภัณฑ์และสารเสริมสำหรับสัตว์ ฟาร์มปศุสัตว์ รวมทั้งผลิตภัณฑ์สำหรับสัตว์เลี้ยงและจัดจำหน่าย', '02-0002984', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991620.0724814517!2d99.99999006562501!3d13.868071799999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29d8db8b09c91%3A0x6903d2f941f59b5c!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4muC4l-C4suC5guC4geC4oyDguIjguLPguIHguLHguJQgKOC4oeC4q-C4suC4iuC4mSkgSGVhZCBPZmZpY2U!5e0!3m2!1sth!2sth!4v1739253865857!5m2!1sth!2sth', 2567, 105, '-'),
(10507, 'บริษัท สหเรือง จำกัด', 'THE SAHARUANG CO.,Ltd', 'เลขที่ 76 หมู่ 8 บ้านป่าหวาย ตำบลบางทรายใหญ่ อำเภอเมือง จังหวัดมุกดาหาร 49000\r\n', 'มุกดาหาร', '042-660401', '49000', '-', 'www.teleinfomedia.co.th', '-', '-', '4 เดือน', 'ผลิตและจำหน่ายน้ำตาล', '0-4261-1703', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3824.448127782578!2d104.6121475!3d16.553936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313db9b5332ad2cd%3A0xb067ce0cafec3301!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4quC4q-C5gOC4o-C4t-C4reC4hyDguIjguLPguIHguLHguJQ!5e0!3m2!1sth!2sth!4v1739253909590!5m2!1sth!2sth', 2567, 105, '-'),
(10508, 'บริษัท น้ำตาลมิตรผล จำกัด (เกษตรสมบูรณ์)', 'MITR PHOL SUGAR CORP., LTD', 'เลขที่ 99 หมู่ 8 ตำบลบ้านเดื่อ อำเภอเกษตรสมบูรณ์ จังหวัดชัยภูมิ 36120\r\n', 'ชัยภูมิ ', '044056417', '36120', '-', 'www.mitrphol.com/career.php', '-', '-', '4 เดือน', 'เขียนContent ,Online Learning', '02 794-1000', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.484436193779!2d101.87122169999999!3d16.092221999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311f5bfb492be527%3A0x652154b469fbc6a6!2z4LmC4Lij4LiH4LiH4Liy4LiZIOC4meC5ieC4s-C4leC4suC4peC4oeC4tOC4leC4o-C4nOC4pSDguIjguLPguIHguLHguJQgKOC5gOC4geC4qeC4leC4o-C4quC4oeC4muC4ueC4o-C4k-C5jCk!5e0!3m2!1sth!2sth!4v1739253944934!5m2!1sth!2sth', 2567, 105, '-'),
(10509, 'โรงเเรมรามาดา รีสอร์ท บาย วินด์เเฮมเขาหลัก', 'RAMADA RESORT BY WYNDHAM KHAO LAK', 'เลขที่ 59 หมู่ 5 ตำบลคึกคัก อำเภอตะกั่วป่า จังหวัดพังงา 82190 \r\n', 'พังงา', '076-427-77', '82190 ', '-', 'http://www.popjobphuket.com', '-', '-', '4 เดือน', 'บริการลูกค้าการจัดการห้องพัก อาหารและเครื่องดื่ม', '076-427-777', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.2996787812313!2d98.2465696!3d8.6630232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3050eecf2cae4049%3A0x1948829260baf943!2z4LmC4Lij4LiH4LmB4Lij4Lih4Lij4Liy4Lih4Liy4LiU4Liy4Lij4Li14Liq4Lit4Lij4LmM4LiXIOC4muC4suC4oiDguKfguLTguJnguJTguYzguYHguK7guKEg4LmA4LiC4Liy4Lir4Lil4Lix4LiB!5e0!3m2!1sth!2sth!4v1739253982428!5m2!1sth!2sth', 2567, 105, '-'),
(10510, 'โรงแรมเขาหลัก แมริออท บีช รีสอร์ท แอนด์ สปา', 'Khao Lak Marriott Beach Resort & Spa ', 'เลขที่ 1/111 หมู่ 2 อำเภอตะกั่วป่า จังหวัดพังงา 82190\r\n', 'พังงา', '076428077', '82190', '-', 'mhrs.hktmk.recruit@marriott.com', '-', '-', '4 เดือน', 'เป็นรีสอร์ทให้บริการที่พัก ยังมีกิจกรรมต่างๆ เช่น การดำน้ำ การท่องเที่ยวชมธรรมชาติ และการพักผ่อนริมทะเลที่เป็นเอกลักษณ์', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63078.53457054977!2d98.23164287910151!3d8.841513699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3050c56d1f02aa2f%3A0x9ee00e771c837adb!2sKhao%20Lak%20Marriott%20Beach%20Resort%20%26%20Spa!5e0!3m2!1sth!2sth!4v1739254029746!5m2!1sth!2sth', 2567, 105, '-'),
(10511, 'โมเวนพิค รีสอร์ท เขาใหญ่', 'Movenpick Resort Khao Yai', 'เลขที่ 334 หมู่ 6 ต.วังไทร อ.ปากช่อง จ.นครราชสีมา 30130\r\n', 'นครราชสีมา', '0988268177', '30130', '-', 'jakkrapong.wongbeiasat@movenpick.com', '-', '-', '4 เดือน', 'บริการด้านที่พักในส่วนบ้านและโรงแรม จัดกิจกรรมสำหรับแขกและดูแลความบันเทิง', '044 009 100 ', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.709087632884!2d101.57648540000001!3d14.6724438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311c268dec99c935%3A0x697b0be6024eb77!2z4LmA4Lih4Lit4LmA4Lin4LiZ4Lie4Li04LiEIOC4o-C4teC4quC4reC4o-C5jOC4lyDguYDguILguLLguYPguKvguI3guYg!5e0!3m2!1sth!2sth!4v1739254068631!5m2!1sth!2sth', 2567, 105, 'ค่าเบี้ยเลี้ยง 3,000 บาท/เดือน  หอพักใกล้ที่ทำงาน ชุดทำงานบริการซักฟรี วันหยุด 6 วัน/เดือน  อาหารฟรี 3 มื้อ/วัน '),
(10512, 'บริษัท เบทาโกร ช็อป สาขาสุรินทร์', 'BETAGRO SHOP Surin', 'เลขที่ 280/27-30 ถนนเทศบาล3 ตำบลในเมือง อำเภอเมือง สุรินทร์ 32000 \r\n', 'สุรินทร์', '0800455491', '32000 ', '-', 'https://www.betagro.com/en/career', '-', '-', '4 เดือน', 'ดำเนินธุรกิจอุตสาหกรรมการเกษตร และอาหารครบวงจร ครอบคลุมตั้งแต่อาหารสัตว์ ปศุสัตว์', '0-4453-9261-3', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d246765.73446406543!2d103.35130251640625!3d14.897228800000017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3119e3cdf9804c5d%3A0xec6b5b4160e8e7af!2z4LmA4Lia4LiX4Liy4LmC4LiB4LijIOC4iuC5h-C4reC4myDguKrguLLguILguLLguKrguLjguKPguLTguJnguJfguKPguYw!5e0!3m2!1sth!2sth!4v1739254124529!5m2!1sth!2sth', 2567, 105, 'เบี้ยเลี้ยง ตลอดระยะเวลาการฝึกงานกับบริษัท เงินช่วยเหลือค่าที่พัก ค่าอาหาร ตามระเบียบที่บริษัทกำหนด 3เงินช่วยเหลือกรณีตำแหน่งที่ต้องปฎิบัติงานนอกสถานที่ ประกันชีวิตและประกันอุบัติเหตุแบบกลุ่ม (24 ชม.)'),
(10513, 'บริษัท เบทาโกร อโกรกรุ๊ป จำกัด (มหาชน)', 'BETAGRO FEED MILL CO.,LTD', 'เลขที่ 196 หมู่ 11 ถนนธนะรัชต์ ตำบลหนองน้ำแดง อำเภอปากช่อง นครราชสีมา 30130 \r\n', 'นครราชสีมา', '0800455491', '30130', '-', 'https://www.betagro.com/th/home', '-', '-', '4 เดือน', 'ผลิตอาหารสัตว์ เวชภัณฑ์และสารเสริมสำหรับสัตว์ ฟาร์มปศุสัตว์ รวมทั้งผลิตภัณฑ์สำหรับสัตว์เลี้ยงและจัดจำหน่าย', '0-3663-8246', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3857.2346296072024!2d100.90991969999999!3d14.812084100000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311e0a35c4e61adf%3A0xb9d754cc36bbb64c!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4muC4l-C4suC5guC4geC4oyDguK3guYLguIHguKPguIHguKPguLjguYrguJsg4LiI4Liz4LiB4Lix4LiUICjguKHguKvguLLguIrguJkpIExSMg!5e0!3m2!1sth!2sth!4v1739254158799!5m2!1sth!2sth', 2567, 105, 'เบี้ยเลี้ยง ตลอดระยะเวลาการฝึกงานกับบริษัท เงินช่วยเหลือค่าที่พัก ค่าอาหาร ตามระเบียบที่บริษัทกำหนด เงินช่วยเหลือกรณีตำแหน่งที่ต้องปฎิบัติงานนอกสถานที่ ประกันชีวิตและประกันอุบัติเหตุแบบกลุ่ม (24 ชม.)'),
(10514, 'อนันตรา เกาะยาวใหญ่ รีสอร์ท แอนด์ วิลล่าส์', 'Anantara Koh Yao Yai Resort and Villas', 'เลขที่ 88/8 หมู่ 4 ตำบลเกาะยาวใหญ่ อำเภอเกาะยาว จังหวัดพังงา 82160 \r\n', 'พังงา', '076 675 88', '82160 ', '-', 'https://www.anantara.com/th/koh-yao-yai-phuket', '-', '-', '4 เดือน', 'ให้บริการเกี่ยวกับที่พัก รีสอร์ทหรูระดับ 5 ดาวที่มีบรรยากาศเงียบสงบและเป็นส่วนตัว เหมาะสำหรับการพักผ่อนริมทะเล', '-', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.586076935598!2d98.60747789999999!3d8.041538699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3051c96617e8e61b%3A0xacf584bec5722371!2z4Lit4LiZ4Lix4LiZ4LiV4Lij4LiyIOC5gOC4geC4suC4sOC4ouC4suC4p-C5g-C4q-C4jeC5iCDguKPguLXguKrguK3guKPguYzguJcg4LmB4Lit4LiZ4LiU4LmMIOC4p-C4tOC4peC4peC5iOC4sg!5e0!3m2!1sth!2sth!4v1739254190046!5m2!1sth!2sth', 2567, 105, 'ค่าเบี้ยเลี้ยง 4000 บาท ต่อเดือน ที่พัก อาหาร เครื่องเเบบการทำงาน การฝึกอบรม On-The-Job/กิจกรรม CSR'),
(10515, 'โรงแรมเมอร์เคียว เชียงใหม่', 'Mercure Chiang Mai', 'เลขที่ 183 ถนน ช้างเผือก ตำบลช้างเผือก อำเภอเมืองเชียงใหม่ เชียงใหม่ 50200 \r\n', 'เชียงใหม่', '053 225 50', '50200 ', '-', 'https://mercure.com-chiangmai.com/th/', '-', '-', '4 เดือน', 'ให้บริการที่พักที่มีคุณภาพสูงสำหรับนักท่องเที่ยว ยังมีห้องอาหารและบาร์ที่บริการอาหารหลากหลายเมนู', '053 225500 ext 8201', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.9079959367537!2d98.985129!3d18.8022531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3aaf04fcdb6b%3A0x7c79fc5038bf852c!2z4LmC4Lij4LiH4LmB4Lij4Lih4LmA4Lih4Lit4Lij4LmM4LmA4LiE4Li14Lii4LinIOC5gOC4iuC4teC4ouC4h-C5g-C4q-C4oeC5iA!5e0!3m2!1sth!2sth!4v1739254224541!5m2!1sth!2sth', 2567, 105, 'ค่าอาหาร ชุดพนักงาน ค่าเบี้ยเลี้ยง100บาทต่อวัน'),
(10516, 'เซ็นทรัลขอนแก่น', 'CentralKhonKaen', 'เลขที่ 99/1 ถ. มิตรภาพ ตำบลในเมือง อำเภอเมือง จังหวัดขอนแก่น 40000 \r\n', 'ขอนแก่น', '043 288 28', '40000 ', '-', 'https://centralretailcareers.com', '-', '-', '4 เดือน', 'People Business Partner', '02-101-8028-29', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.8400301075817!2d102.8257675!3d16.432948900000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228a177f96cb25%3A0x89a8966e698a4760!2z4LmA4LiL4LmH4LiZ4LiX4Lij4Lix4LilIOC4guC4reC4meC5geC4geC5iOC4mQ!5e0!3m2!1sth!2sth!4v1739254258701!5m2!1sth!2sth', 2567, 105, '-'),
(10517, 'บริษัท อินฟรา คอร์เปเรชั่น จำกัด', 'Infra Corporation', 'เลขที่ 188/70 อาคารชัยวอล์ค ห้องเลขที่ ดี 16 (ชั้นที่ 3-4) ดี 17 ถนนจรัสเมือง แขวงวังใหม่ เขตปทุมวัน กรุงเทพมหานคร 10330\r\n', 'กรุงเทพมหานคร', '0620360055', '10330', '-', 'https://www.infra-corp.co/join-us/', '-', '-', '4 เดือน', 'เรียนรู้การจัดทำข้อมูลเอกสาร เรียนรู้เกี่ยวกับการจัดเตรียมการประชุม', '02-1811768', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15502.535069200752!2d100.52445!3d13.740609!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2992e0c9810ff%3A0x6c96eff94cbf0814!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4reC4tOC4meC4n-C4o-C4siDguJ7guKXguLHguKog4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sus!4v1739254459340!5m2!1sth!2sus', 2567, 105, '-'),
(10601, 'สำนักงานบริหารหนี้สาธารณะ', 'The Public Debt Management Office', 'กระทรวงการคลัง ถ. พระรามที่ 6 แขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400\r\n', 'กรุงเทพมหานคร', '-', '10400', '-', 'https://www.pdmo.go.th', '-', '-', '4 เดือน', 'มีหน้าที่ในการบริหารหนี้สาธารณะ ตามกฎหมายว่าด้วยการบริหารหนี้สาธารณะโดยการวางแผน กำกับ และดำเนินการก่อหนี้ค้ำประกัน และปรับโครงสร้างหนี้ของรัฐบาล', '02-278-7878', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.951070221088!2d100.53518489999999!3d13.781823200000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29c042f84dd6f%3A0xe24051c04724bdd5!2z4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4Lia4Lij4Li04Lir4Liy4Lij4Lir4LiZ4Li14LmJ4Liq4Liy4LiY4Liy4Lij4LiT4LiwIOC4geC4o-C4sOC4l-C4o-C4p-C4h-C4geC4suC4o-C4hOC4peC4seC4hw!5e0!3m2!1sth!2sus!4v1739254541041!5m2!1sth!2sus', 2567, 106, '-'),
(10602, 'ธนาคารออมสิน สำนักงานใหญ่', 'Government Savings Bank', 'เลขที่ 470 ถนนพหลโยธิน แขวงสามเสนใน เขตพญาไท  กรุงเทพมหานคร 10400\r\n', 'กรุงเทพมหานคร', '022998000', '10400', 'recruitment@mfec.co.th\r\n', 'https://www.gsb.or.th', '-', '-', '4 เดือน', '1.รับฝากเงิน 2.ออกพันธบัตรออมสินและสลากออมสิน 3.รับฝากเงินออมสินเพื่อสงเคราะห์ชีวิตและครอบครัว 4.ทำการรับจ่ายและโอนเงิน 5ซื้อหรือขายพันธบัตรรัฐบาลไทย', '0-2299-8000', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.8515701380306!2d100.54886959999999!3d13.787819899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29c1d94a40bd5%3A0x6d39fb079a2efb88!2z4LiY4LiZ4Liy4LiE4Liy4Lij4Lit4Lit4Lih4Liq4Li04LiZIOC4quC4s-C4meC4seC4geC4h-C4suC4meC5g-C4q-C4jeC5iA!5e0!3m2!1sth!2sus!4v1739254629919!5m2!1sth!2sus', 2567, 106, '-'),
(10603, 'กระทรวงแรงงาน สำนักงานปลัดกระทรวงแรงงาน', 'Ministry of Labour', 'ถนนมิตรไมตรี แขวงดินแดง เขตดินแดง กรุงเทพมหานคร 10400 \r\n', 'กรุงเทพมหานคร ', '022321471', '10400 ', '-', 'http://welfare.labour.go.th/', '-', '-', '4 เดือน', 'ศึกษา วิเคราะห์ จัดทำ ข้อมูล เพื่อใช้ในการกำหนดนโยบาย เป้าหมายและผลสัมฤทธิ์ของกระทรวง', '0 2232 1227', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.2428893074098!2d100.54950217509042!3d13.764220986628931!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f298ee0540d%3A0xa2965b9de67fe10d!2z4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4Lib4Lil4Lix4LiU4LiB4Lij4Liw4LiX4Lij4Lin4LiH4LmB4Lij4LiH4LiH4Liy4LiZ!5e0!3m2!1sth!2sth!4v1739254667957!5m2!1sth!2sth', 2567, 106, '-'),
(10604, 'สำนักงานสภาพัฒนาการเศรษฐกิจและสังคมแห่งชาติ', 'Office of the National Economic and Social Development Council', 'เลขที่ 962 ถนนกรุงเกษม แขวงวัดโสมนัส เขตป้อมปราบศัตรูพ่าย กรุงเทพมหานคร 10100 \r\n', 'กรุงเทพมหานคร', '022804085', '10100 ', '-', 'webmaster@nesdc.go.th', '-', '-', '4 เดือน', 'มีหน้าที่จัดทำแผนพัฒนาเศรษฐกิจและสังคมแห่งชาติ เพื่อใช้เป็นกรอบและแนวทางในการพัฒนาประเทศในแต่ละช่วงระยะเวลา 5 ปี', '043-711-073', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.357058715894!2d100.5146601!3d13.757328399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2993884e343ef%3A0xfa5b7c0ee73e0f38!2z4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4Liq4Lig4Liy4Lie4Lix4LiS4LiZ4Liy4LiB4Liy4Lij4LmA4Lio4Lij4Lip4LiQ4LiB4Li04LiI4LmB4Lil4Liw4Liq4Lix4LiH4LiE4Lih4LmB4Lir4LmI4LiH4LiK4Liy4LiV4Li0ICjguKrguKDguLLguJ7guLHguJLguJnguYwp!5e0!3m2!1sth!2sth!4v1739254710513!5m2!1sth!2sth', 2567, 106, '-');
INSERT INTO `company` (`Company_id`, `NamecomTH`, `NamecomEng`, `Company_add`, `Province`, `Com_phone`, `Zip_id`, `Com_email`, `Website`, `Contact_com`, `Position`, `Duration`, `Job_description`, `Fax_number`, `Map`, `Academic_year`, `Major_id`, `welfare`) VALUES
(10605, 'สำนักงานพาณิชย์จังหวัดมหาสารคาม', 'Office of Provincial Commercial Affairs Mahasarakham', 'เลขที่ 19 ซอย 21 ถนนมหาชัยดำริห์ ตำบลตลาด อำเภอเมืองมหาสารคาม มหาสารคาม 44000 \r\n', 'มหาสารคาม', '043-711-07', '44000 ', '-', 'mh ops@moc.go.th', '-', '-', '4 เดือน', 'ดูแลหลักในการโฆษณากิจการองค์กรขององค์กรข้อมูลมหาสารคามการควบคุมและการดำเนินการต่างๆ เกี่ยวกับพื้นที่', '0043-711-009', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3831.6602080604703!2d103.310763!3d16.1864639!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122a68a344ff7ad%3A0xd4d9b1b934fcca4c!2z4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4Lie4Liy4LiT4Li04LiK4Lii4LmM4LiI4Lix4LiH4Lir4Lin4Lix4LiU4Lih4Lir4Liy4Liq4Liy4Lij4LiE4Liy4Lih!5e0!3m2!1sth!2sth!4v1739254744452!5m2!1sth!2sth', 2567, 106, 'จ่ายเงินเดือนที่เหมาะสมตามตำแหน่งและระดับการทำงานและเริ่มทำงานเงินเดือนตามระยะเวลาและผลการดำเนินงาน');

-- --------------------------------------------------------

--
-- Table structure for table `intro`
--

CREATE TABLE `intro` (
  `Intro_id` int(10) NOT NULL,
  `I_picture` text DEFAULT NULL,
  `I_detail` text DEFAULT NULL,
  `I_status` int(2) DEFAULT NULL COMMENT '1=แสดง 0=ไม่',
  `Admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intro`
--

INSERT INTO `intro` (`Intro_id`, `I_picture`, `I_detail`, `I_status`, `Admin_id`) VALUES
(2, 'intro2_20250804181311.jpg', '9 ขั้นตอนสหกิจ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_offer`
--

CREATE TABLE `job_offer` (
  `Offer_id` int(5) NOT NULL,
  `Offer_status` int(5) DEFAULT NULL COMMENT '1=ได้งาน\r\n2=ไม่ได้งาน\r\n3=เสนอแต่ไม่ได้รับ',
  `Std_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_offer`
--

INSERT INTO `job_offer` (`Offer_id`, `Offer_status`, `Std_id`) VALUES
(1, 1, 65010912501),
(2, 1, 65010912514),
(3, 2, 65010912513),
(4, 2, 65010912537),
(5, 2, 65010912512),
(6, 2, 65010912525),
(7, 3, 65010912522),
(8, 3, 65010912527),
(9, 1, 65010912516),
(10, 1, 65010912516),
(11, 3, 65010912516);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `Major_id` int(11) NOT NULL,
  `Major_name` varchar(100) DEFAULT NULL,
  `M_sub` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`Major_id`, `Major_name`, `M_sub`) VALUES
(101, 'สาขาวิชาการบัญชี', 'AC'),
(102, 'สาขาวิชาการตลาด', 'MK '),
(103, 'สาขาวิชาคอมพิวเตอร์ธุรกิจ', 'BC'),
(104, 'สาขาวิชาเทคโนโลยีสารสนเทศธุรกิจ', 'BIT'),
(105, 'สาขาวิชาการจัดการ', ' MG '),
(106, 'สาขาวิชาเศรษฐศาสตร์ธุรกิจ', 'BE '),
(107, 'สาขาวิชาบริหารการเงิน', ' FI '),
(108, 'สาขาวิชาธุรกิจระหว่างประเทศ (หลักสูตรนานาชาติ)', ' IB ');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `N_id` int(11) NOT NULL,
  `N_picture` varchar(255) NOT NULL,
  `N_heading` text NOT NULL,
  `N_detail` text NOT NULL,
  `N_date` date NOT NULL,
  `N_year` year(4) NOT NULL,
  `N_status` varchar(10) NOT NULL COMMENT '	1=แสดง 0=ไม่แสดง	',
  `Admin_id` int(11) DEFAULT NULL,
  `N_refer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`N_id`, `N_picture`, `N_heading`, `N_detail`, `N_date`, `N_year`, `N_status`, `Admin_id`, `N_refer`) VALUES
(11102, 'news2.png', 'เอกสาร', 'ส่งเอกสารผิดฉบับ กรุณามารับคืนและนำเอกสารมาส่งใหม่', '2025-02-20', '2025', '1', 1, 'กองกิจการนิสิต'),
(11103, 'news3.png', 'เปิดรับสมัครนิสิตฝึกงาน', 'สามารถดูรายละเอียดได้ที่หน้าเว็บเพจของกองกิจการนิสิต', '2025-03-10', '2025', '1', 2, 'กองกิจการนิสิต'),
(11104, 'news4.png', 'การกรอกเอกสารมีข้อผิดพลาด', 'กรุณามารับเอกสารคืนเพื่อทำการกรอกข้อมูลให้ถูกต้อง', '2025-03-12', '2025', '1', 2, 'กองกิจการนิสิต'),
(11105, 'news5.png', 'งานเอกสาร', 'นิสิตส่งเอกสารไม่ครบ กรุณาติดต่อกับเจ้าหน้าที่กองกิจการนิสิตด่วนค่ะ', '2025-03-15', '2025', '1', 1, 'กองกิจการนิสิต'),
(11106, 'news6.png', 'เปิดรับสมัครนิสิตฝึกงาน', 'สามารถดูรายละเอียดที่หน้าเว็บเพจและหากมีความสนใจสามารถสอบถามรายละเอียดได้ที่เว็บเพจของกองกิจการนิสิต', '2025-03-16', '2025', '1', 2, 'กองกิจการนิสิต'),
(11107, 'news7.png', 'ประกาศการรับสมัครนิสิตฝึกงาน', 'สามารถดูรายละเอียดได้ที่หน้าเว็บเพจของกองกิจการนิสิต', '2025-03-17', '2025', '1', 2, 'กองกิจการ'),
(11109, 'news9.png', 'ประกาศสถานประกอบการที่รับนิสิตฝึกงาน', 'สามารติดต่อได้ที่กองกิจการนิสิต', '2025-03-20', '2025', '1', 2, 'กองกิจการนิสิต'),
(11110, 'news2.png', 'อบรมเตรียมความพร้อม', 'อบรมทักษะการทำงาน มารยาทในองค์กร และการปรับตัวในที่ทำงานให้กับนิสิต ณ อาคารบริหารธุรกิจสิรินธร คณะการบัญชีและการจัดการ ห้อง SBB-1001', '2025-03-20', '2025', '0', 2, 'กองกิจการนิสิต1');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `Proposal_id` int(11) NOT NULL,
  `Proposal_name` varchar(255) DEFAULT NULL,
  `File_name` varchar(255) DEFAULT NULL,
  `Sug_year` int(11) DEFAULT NULL,
  `Std_id` bigint(20) DEFAULT NULL,
  `Company_id` int(11) DEFAULT NULL,
  `Pro_status` varchar(50) DEFAULT NULL COMMENT '0= ไม่อนุมัติ\r\n1= อนุมัติ\r\n2= แก้ไข\r\n3=รอตรวจสอบ\r\n4=ยังไม่เพิ่มโปรเจค',
  `Note` text DEFAULT NULL,
  `Com_status` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`Proposal_id`, `Proposal_name`, `File_name`, `Sug_year`, `Std_id`, `Company_id`, `Pro_status`, `Note`, `Com_status`) VALUES
(11110101, 'ระบบ', 'project_65010912501_1754324231.pdf', 2567, 65010912501, 10135, '0', 'แก้ไข', 3),
(11110102, 'Cost & Profit Insight for Business Growth – การวิเคราะห์ต้นทุนและกำไรเพื่อการเติบโตขององค์กร', 'Cost_Profit_Analysis.pdf', 2567, 65010912502, 10102, '1', 'การวิเคราะห์ชัดเจน แต่ควรมีกรณีศึกษาหรือข้อมูลเปรียบเทียบเพิ่มเติม', 0),
(11110103, 'Internal Audit & Control Excellence – ความเป็นเลิศด้านการตรวจสอบและควบคุมภายในองค์กร', 'Internal_Audit_Control.pdf', 2567, 65010912503, 10103, '2', 'เนื้อหาครบถ้วน แต่ควรเสริมมาตรฐานการตรวจสอบที่เกี่ยวข้อง', 1),
(11110104, 'Cash Flow & Budget Mastery – กลยุทธ์บริหารกระแสเงินสดและงบประมาณองค์กร', 'Cash_Flow_Budgeting.pdf', 2567, 65010912504, 10104, '0', 'มีแนวทางที่ดี แต่ควรแสดงตัวอย่างหรือโมเดลที่ใช้จริง', 0),
(11110105, 'ระบบขนส่ง', 'project_65010912505_1743258415.pdf', 2565, 65010912505, 10138, '1', 'การวิเคราะห์ละเอียดดี ควรเพิ่มตัวอย่างการนำไปใช้จริง', 3),
(11110106, 'ระบบจัดการสหกิจศึกษา', 'project_65010912506_1743603835.pdf', 2567, 65010912506, 10240, '3', '-', 3),
(11110107, 'SME Digital Marketing Plan – พัฒนาแผนการตลาดออนไลน์สำหรับธุรกิจ SME', 'SME_Digital_Marketing_Plan.pdf', 2567, 65010912507, 10202, '1', '-', 0),
(11110108, 'Sales Promotion & Brand Building Strategy – กลยุทธ์ส่งเสริมการขายและสร้างแบรนด์สินค้า', 'Sales_Promotion_Branding.pdf', 2567, 65010912508, 10203, '1', '-', 0),
(11110109, 'Marketing Strategy for New Products – วางแผนกลยุทธ์การตลาดสำหรับสินค้าใหม่', 'New_Product_Marketing_Strategy.pdf', 2567, 65010912509, 10204, '1', '-', 0),
(11110110, 'Content & Social Media Marketing Strategy – การสร้างคอนเทนต์และกลยุทธ์โซเชียลมีเดียมาร์เก็ตติ้ง', 'Content_Social_Media_Strategy.pdf\r\n', 2567, 65010912510, 10205, '1', 'ควรมีการวางแผนที่ชัดเจนในแต่ละขั้นตอนการดำเนินการ', 0),
(11110111, 'Customer Data Management with CRM System – พัฒนาระบบจัดการข้อมูลลูกค้าด้วยฐานข้อมูล (CRM System)', 'CRM_System_Customer_Data.pdf', 2567, 65010912511, 10301, '1', 'โครงงานมีความชัดเจน แต่ควรเพิ่มรายละเอียดเกี่ยวกับเทคโนโลยีที่ใช้ในแต่ละระบบ', 0),
(11110112, 'Business Data Analysis with Power BI – วิเคราะห์ข้อมูลธุรกิจด้วย Power BI', 'Power_BI_Business_Analysis.pdf', 2567, 65010912512, 10302, '1', '-', 0),
(11110113, 'E-Commerce Website Development – พัฒนาเว็บไซต์สำหรับธุรกิจอีคอมเมิร์ซ\r\n', 'E_Commerce_Website_Development.pdf', 2567, 65010912513, 10303, '1', 'การพัฒนาเว็บไซต์ควรอธิบายแนวทางในการปรับแต่งให้เหมาะสมกับลูกค้าเป้าหมาย', 0),
(11110114, 'AI-Powered Chatbot Development for Business – พัฒนา Chatbot สำหรับธุรกิจด้วย AI', 'AI_Chatbot_Development.pdf', 2567, 65010912514, 10304, '1', '-', 0),
(11110115, 'Inventory Management System Development – พัฒนาระบบจัดการคลังสินค้า (Inventory Management System)\r\n', 'Inventory_Management_System.pdf', 2567, 65010912515, 10305, '1', ' ระบบจัดการคลังสินค้าควรเน้นการออกแบบที่ใช้งานง่ายและสามารถเพิ่มประสิทธิภาพในการบริหารจัดการ', 0),
(11110116, 'CRM System for Customer Data Management – พัฒนาระบบบริหารจัดการข้อมูลลูกค้า (CRM System)', 'CRM_System_Development.pdf', 2567, 65010912516, 10403, '1', 'ระบบ CRM ควรอธิบายการจัดเก็บและการรักษาความปลอดภัยของข้อมูลลูกค้า', 3),
(11110117, 'Business Data Analytics for Insights – วิเคราะห์ข้อมูลธุรกิจด้วย Data Analytics', 'Business_Data_Analytics.pdf', 2567, 65010912517, 10402, '1', '-', 0),
(11110118, 'Web Application Development for Business – พัฒนาเว็บไซต์ธุรกิจด้วยเทคโนโลยี Web Application', 'Web_Application_Business.pdf', 2567, 65010912518, 10403, '1', 'การพัฒนา Web Application ควรอธิบายเทคโนโลยีที่ใช้และความสามารถของระบบ', 0),
(11110119, 'e-Document System for Organizational Document Management – พัฒนาระบบ e-Document เพื่อการจัดการเอกสารในองค์กร', 'e_Document_Management.pdf', 2567, 65010912519, 10404, '1', '-', 0),
(11110120, 'AI Chatbot for Automated Customer Support – พัฒนา Chatbot เพื่อตอบคำถามลูกค้าอัตโนมัติ', 'AI_Chatbot_Customer_Support.pdf', 2567, 65010912520, 10405, '1', '-', 0),
(11110121, 'HR Management System Development – พัฒนาระบบบริหารงานบุคคล (HR Management System)', 'HR_Management_System.pdf', 2567, 65010912521, 10501, '1', 'ระบบ HR ควรเสนอโซลูชันที่สามารถปรับเปลี่ยนตามความต้องการขององค์กร', 0),
(11110122, 'Strategic Plan for Organizational Efficiency – วางแผนกลยุทธ์เพิ่มประสิทธิภาพการทำงานในองค์กร', 'Organizational_Efficiency_Plan.pdf', 2567, 65010912522, 10502, '1', '-', 0),
(11110123, 'Supply Chain Management System Development – พัฒนาระบบบริหารจัดการซัพพลายเชน (Supply Chain Management)', 'Supply_Chain_Management_System.pdf', 2567, 65010912523, 10503, '1', 'ระบบซัพพลายเชนควรมีการอธิบายถึงการเชื่อมโยงข้อมูลและการจัดการสินค้าคงคลัง', 0),
(11110124, 'Employee Development Plan Design – ออกแบบแผนพัฒนาศักยภาพพนักงานในองค์กร', 'Employee_Development_Plan.pdf', 2567, 65010912524, 10504, '1', '-', 0),
(11110125, 'Risk Management & Strategic Planning for Organization – บริหารความเสี่ยงและการวางแผนเชิงกลยุทธ์องค์กร', 'Risk_Management_Strategic_Planning.pdf', 2567, 65010912525, 10505, '1', 'การบริหารความเสี่ยงควรมีการระบุปัจจัยเสี่ยงที่สำคัญและแผนการรับมือที่ชัดเจน', 0),
(11110126, 'Economic Trend Analysis and Business Impact – วิเคราะห์แนวโน้มเศรษฐกิจและผลกระทบต่อธุรกิจ', 'Economic_Trend_Analysis.pdf', 2567, 65010912526, 10601, '1', 'การวิเคราะห์แนวโน้มเศรษฐกิจควรมีข้อมูลจากแหล่งที่เชื่อถือได้และการพยากรณ์ระยะยาว', 0),
(11110127, 'Cost-Benefit Analysis for Business Decision-Making – วิเคราะห์ต้นทุนและผลตอบแทนของธุรกิจ (Cost-Benefit Analysis)', 'Cost_Benefit_Analysis_Business.pdf', 2567, 65010912527, 10602, '1', '-', 0),
(11110128, 'Impact of Government Policies on Business Sector – ศึกษาผลกระทบของนโยบายภาครัฐต่อภาคธุรกิจ', 'Government_Policy_Impact.pdf', 2567, 65010912528, 10603, '1', 'การศึกษาผลกระทบจากนโยบายภาครัฐควรมีการนำเสนอแนวทางแก้ไขหรือปรับตัวที่เป็นไปได้', 0),
(11110129, 'Market and Consumer Behavior Analysis for Business Expansion – วิเคราะห์ตลาดและพฤติกรรมผู้บริโภคเพื่อการขยายธุรกิจ', 'Market_Consumer_Behavior_Analysis.pdf', 2567, 65010912529, 10604, '1', '-', 0),
(11110130, 'Economic and Financial Forecasting System for Organizations – พัฒนาระบบพยากรณ์เศรษฐกิจและการเงินขององค์กร', 'Economic_Financial_Forecasting.pdf', 2567, 65010912530, 10605, '1', 'ระบบพยากรณ์เศรษฐกิจควรมีตัวอย่างการประยุกต์ใช้ในภาคธุรกิจจริงเพื่อแสดงถึงความเป็นไปได้', 0),
(11110131, 'Financial Statement Analysis for Decision-Making – วิเคราะห์งบการเงินเพื่อการตัดสินใจทางการเงิน', 'Financial_Statement_Analysis.pdf', 2567, 65010912531, 10101, '1', '-', 0),
(11110132, 'Cash Flow Management System Development – พัฒนาระบบบริหารจัดการกระแสเงินสด', 'Cash_Flow_Management_System.pdf', 2567, 65010912532, 10101, '1', 'ระบบบริหารจัดการกระแสเงินสดควรมีการแสดงตัวอย่างการทำงานจริงและการบันทึกข้อมูลอัตโนมัติ', 0),
(11110133, 'Investment Risk Analysis & Portfolio Management – วิเคราะห์ความเสี่ยงในการลงทุนและการบริหารพอร์ตการลงทุน', 'Investment_Risk_Analysis_Portfolio.pdf', 2567, 65010912533, 10101, '1', '-', 0),
(11110134, 'Budget and Financial Planning for Medium-Sized Businesses – วางแผนงบประมาณและการเงินสำหรับธุรกิจขนาดกลาง', 'Budget_Financial_Planning_Medium_Business.pdf', 2567, 65010912534, 10101, '1', 'การวางแผนงบประมาณควรมีการเชื่อมโยงกับเป้าหมายระยะยาวของธุรกิจ', 0),
(11110135, 'Valuation System Development for Business Valuation – พัฒนาระบบการประเมินมูลค่าองค์กร (Valuation System)', 'Business_Valuation_System.pdf', 2567, 65010912535, 10101, '1', 'ระบบการประเมินมูลค่าองค์กรควรมีมาตรฐานที่ใช้ในการประเมินที่ชัดเจนและอ้างอิงได้', 0),
(11110136, 'International Marketing Strategy in E-Commerce – ศึกษากลยุทธ์การตลาดระหว่างประเทศในธุรกิจอีคอมเมิร์ซ', 'International_Marketing_Strategy_E_Commerce.pdf', 2567, 65010912536, 10101, '1', 'กลยุทธ์การตลาดระหว่างประเทศควรมีตัวอย่างกรณีศึกษาจากธุรกิจที่ประสบความสำเร็จ', 0),
(11110137, 'Trade Risk and Negotiation Strategy – ศึกษาความเสี่ยงทางการค้าและการเจรจาข้อตกลงทางการค้า', 'Trade_Risk_Negotiation_Strategy.pdf', 2567, 65010912537, 10101, '1', '-', 0),
(11110138, 'Market Expansion Plan for International Business – วิเคราะห์และจัดทำแผนการขยายตลาดในต่างประเทศ', 'Market_Expansion_International_Business.pdf', 2567, 65010912538, 10101, '1', 'แผนการขยายตลาดควรคำนึงถึงการวิจัยตลาดและพฤติกรรมผู้บริโภคในต่างประเทศ', 0),
(11110139, 'International Trade: Import and Export Strategies – ศึกษาการนำเข้าและส่งออกในธุรกิจระหว่างประเทศ', 'International_Trade_Import_Export.pdf', 2567, 65010912539, 10101, '1', '-', 0),
(11110140, 'Enhancing International Business Management with Technology Tools – พัฒนาความสามารถในการจัดการธุรกิจระหว่างประเทศด้วยเครื่องมือทางเทคโนโลยี', 'International_Business_Management_Technology.pdf', 2567, 65010912540, 10101, '1', 'การพัฒนาความสามารถในการจัดการธุรกิจควรมีตัวอย่างการใช้เทคโนโลยีในการเพิ่มประสิทธิภาพการดำเนินงาน', 0);

-- --------------------------------------------------------

--
-- Table structure for table `public_relations`
--

CREATE TABLE `public_relations` (
  `Pr_id` int(11) NOT NULL,
  `Pr_picture1` varchar(255) DEFAULT NULL,
  `Pr_picture2` varchar(255) DEFAULT NULL,
  `Pr_picture3` varchar(255) DEFAULT NULL,
  `Pr_picture4` varchar(255) DEFAULT NULL,
  `Pr_title` text DEFAULT NULL,
  `Pr_detail` text DEFAULT NULL,
  `Company_id` int(11) DEFAULT NULL,
  `Pr_date` date DEFAULT NULL,
  `Pr_year` int(11) DEFAULT NULL,
  `Pr_status` varchar(50) DEFAULT NULL,
  `Admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_relations`
--

INSERT INTO `public_relations` (`Pr_id`, `Pr_picture1`, `Pr_picture2`, `Pr_picture3`, `Pr_picture4`, `Pr_title`, `Pr_detail`, `Company_id`, `Pr_date`, `Pr_year`, `Pr_status`, `Admin_id`) VALUES
(1111101, 'Pr1.1.png', 'Pr2.1.png', 'Pr3.1.png', 'Pr4.1.png', 'ประชาสัมพันธ์สหกิจ1001', 'คณะบัญชี มหาวิทยาลัยมหาสารคามเปิดรับสมัครนักศึกษาฝึกงานสหกิจในสาขาบัญชี การเงิน และภาษีอากร โดยร่วมมือกับบริษัทชั้นนำกว่า 30 แห่งทั่วประเทศ นักศึกษาที่เข้าร่วมโครงการจะได้รับประสบการณ์การทำงานจริงในบริษัทตรวจสอบบัญชีและสถาบันการเงินชั้นนำ เปิดรับสมัครตั้งแต่วันนี้ถึง 1 มีนาคม 2567', 10101, '2025-02-19', 2567, '1', 1),
(1111102, 'Pr2.1.png', 'Pr2.2png', 'Pr3.2png', 'Pr4.2png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาสาขาบัญชีฝึกงานสหกิจเพื่อเรียนรู้การจัดทำงบการเงินและการตรวจสอบภายใน\r\nสมัครได้ตั้งแต่วันที่ 1 ถึง 28 กุมภาพันธ์ 2567\r\n', 10102, '2025-02-01', 2567, '1', 1),
(1111103, 'Pr1.1.png', 'Pr2.3.png', 'Pr3.3.png', 'Pr4.3.png', 'ประชาสัมพันธ์สหกิจ1001', 'ธนาคาร B รับสมัครนักศึกษาฝึกงานสหกิจในแผนกบัญชีเพื่อเรียนรู้การวิเคราะห์งบการเงินและการบริหารภาษี  \r\nสมัครได้ตั้งแต่วันที่ 1 กุมภาพันธ์ ถึง 10 มีนาคม 2567', 10103, '2025-01-22', 2567, '1', 2),
(1111104, 'Pr2.1.png', 'Pr3.4.png', 'Pr3.4.png', 'Pr4.4.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท C เปิดรับนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การจัดการภาษีและการวางแผนภาษี\r\nสมัครได้วันที่ 1 กุมภาพันธ์ ถึง 5 มีนาคม 2567', 10104, '2025-02-17', 2567, '1', 1),
(1111105, 'Pr1.1.png', 'Pr2.5.png', 'Pr3.5.png', 'Pr4.5.png', 'ประชาสัมพันธ์สหกิจ1001', 'สำนักงาน D รับสมัครนักศึกษาสาขาบัญชีเข้าฝึกงานสหกิจในแผนกบัญชีทั่วไปและการตรวจสอบภายในสมัครได้ตั้งแต่วันที่ 25 กุมภาพันธ์ ถึง 1 มีนาคม 2567', 10105, '2025-01-14', 2567, '1', 1),
(1111106, 'Pr2.1.png', 'Pr2.6.png', 'Pr3.6.png', 'Pr4.6.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาสาขาการตลาดเข้าร่วมฝึกงานสหกิจเพื่อเรียนรู้การวิเคราะห์ตลาดและวางแผนกลยุทธ์การตลาดดิจิทัล\r\nสมัครได้ตั้งแต่วันที่ 5 กุมภาพันธ์  ถึง 28 กุมภาพันธ์ 2567', 10201, '2025-02-05', 2567, '1', 2),
(1111107, 'Pr1.1.png', 'Pr2.7.png', 'Pr3.7.png', 'Pr4.7.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท B รับสมัครนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การวางแผนกลยุทธ์การขาย การทำการตลาดออนไลน์ และการบริหารจัดการลูกค้าสัมพันธ์\r\nสมัครได้ตั้งแต่วันที่ 10 กุมภาพันธ์ ถึง 15 มีนาคม 2567', 10202, '2025-02-01', 2567, '1', 1),
(1111108, 'Pr2.1.png', 'Pr2.8.png', 'Pr3.8.png', 'Pr4.8.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท C เปิดรับนักศึกษาฝึกงานสหกิจในด้านการตลาดดิจิทัล การวิเคราะห์ข้อมูลการตลาดออนไลน์ และการบริหารสื่อโซเชียลมีเดีย\r\nสมัครได้ตั้งแต่วันที่ 12 กุมภาพันธ์ ถึง 10 มีนาคม 2567', 10203, '2025-02-04', 2567, '1', 1),
(1111109, 'Pr1.1.png', 'Pr2.9.png', 'Pr3.9.png', 'Pr4.9.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท D เปิดรับนักศึกษาฝึกงานสหกิจเพื่อพัฒนาแบรนด์ การตลาดเชิงกลยุทธ์ และการวิจัยตลาด\r\nสมัครได้ตั้งแต่วันที่ 15 กุมภาพันธ์  ถึง 28 กุมภาพันธ์ 2567', 10204, '2025-01-29', 2567, '1', 1),
(1111110, 'Pr2.1.png', 'Pr2.10.png', 'Pr3.10.png', 'Pr4.10.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท E รับสมัครนักศึกษาฝึกงานสหกิจในแผนกการตลาดและโฆษณา เพื่อเรียนรู้การสร้างแคมเปญโฆษณาและการใช้เครื่องมือการตลาดออนไลน์\r\nสมัครได้ตั้งแต่ 20 กุมภาพันธ์ 2567 ถึง 5 มีนาคม 2567', 10205, '2025-01-21', 2567, '1', 2),
(1111111, 'Pr1.1.png', 'Pr2.11.png', 'Pr3.11.png', 'Pr4.11.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาสาขาคอมพิวเตอร์ธุรกิจเข้าฝึกงานสหกิจในด้านการพัฒนาระบบ ERP และการวิเคราะห์ข้อมูลธุรกิจ\r\nสมัครได้9ตั้งแต่วันที่ 10 กุมภาพันธ์ ถึง 28 กุมภาพันธ์ 2567', 10301, '2025-02-01', 2567, '1', 2),
(1111112, 'Pr2.1.png', 'Pr2.12.png', 'Pr3.12.png', 'Pr4.12.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท B รับสมัครนักศึกษาฝึกงานสหกิจในด้านการพัฒนาระบบซอฟต์แวร์และการตลาดออนไลน์สำหรับธุรกิจ\r\nสมัครได้ตั้งแต่วันที่ 15 กุมภาพันธ์  ถึง 10 มีนาคม 2567', 10302, '2025-02-01', 2567, '1', 2),
(1111113, 'Pr1.1.png', 'Pr2.13.png', 'Pr3.13.png', 'Pr4.13.png', 'ประชาสัมพันธ์สหกิจ1001', 'ธนาคาร C เปิดรับนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การใช้เทคโนโลยีสารสนเทศในธุรกิจการเงินและการพัฒนาระบบออนไลน์\r\nสมัครได้ตั้งแต่วันที่ 20 กุมภาพันธ์ ถึง 5 มีนาคม 2567', 10303, '2025-01-31', 2567, '1', 1),
(1111114, 'Pr2.1.png', 'Pr2.14.png', 'Pr3.14.png', 'Pr4.14.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท D เปิดรับนักศึกษาสาขาคอมพิวเตอร์ธุรกิจฝึกงานสหกิจในแผนกพัฒนาระบบข้อมูลและการจัดการฐานข้อมูลธุรกิจ\r\nสมัครได้ตั้งแต่วันที่ 25 กุมภาพันธ์ ถึง 15 มีนาคม 2567', 10304, '2025-02-01', 2567, '1', 2),
(1111115, 'Pr1.1.png', 'Pr2.15.png', 'Pr3.15.png', 'Pr4.15.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท E รับนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การบริหารจัดการข้อมูลธุรกิจและการใช้เครื่องมือ Business Intelligence ในการตัดสินใจ\r\nสมัครได้ตั้งแต่วันที่ 1 มีนาคม ถึง 10 มีนาคม 2567', 10305, '2025-02-28', 2567, '1', 2),
(1111116, 'Pr2.1.png', 'Pr2.16.png', 'Pr3.16.png', 'Pr4.16.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การพัฒนาระบบสารสนเทศและการจัดการฐานข้อมูลธุรกิจ\r\nสมัครได้ตั้งแต่วันที่ 10 กุมภาพันธ์  ถึง 28 กุมภาพันธ์ 2567', 10401, '2025-02-10', 2567, '1', 1),
(1111117, 'Pr1.1.png', 'Pr2.17.png', 'Pr3.17.png', 'Pr4.17.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท B เปิดรับนักศึกษาสาขาเทคโนโลยีสารสนเทศธุรกิจเข้าฝึกงานในด้านการวิเคราะห์ระบบและการพัฒนาแอปพลิเคชันสำหรับองค์กร\r\nสมัครได้ตั้งแต่วันที่  15 กุมภาพันธ์ ถึง 10 มีนาคม 2567', 10402, '2025-02-15', 2567, '1', 2),
(1111118, 'Pr2.1.png', 'Pr2.18.png', 'Pr3.18.png', 'Pr4.18.png', 'ประชาสัมพันธ์สหกิจ1001', 'ธนาคาร C รับสมัครนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การใช้เทคโนโลยีในการบริหารจัดการข้อมูลทางการเงิน\r\nสมัครได้ตั้งแต่ 20 กุมภาพันธ์ ถึง 5 มีนาคม 2567', 10403, '2025-02-19', 2567, '1', 2),
(1111119, 'Pr1.1.png', 'Pr2.19.png', 'Pr3.19.png', 'Pr4.19.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท D เปิดรับนักศึกษาฝึกงานเพื่อพัฒนาและปรับปรุงระบบสารสนเทศสำหรับการบริหารองค์กร\r\nสมัครได้ตั้งแต่วันที่ 25 กุมภาพันธ์ ถึง 15 มีนาคม 2567', 10404, '2025-02-21', 2567, '1', 2),
(1111120, 'Pr2.1.png', 'Pr2.20.png', 'Pr3.20.png', 'Pr4.20.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท E รับสมัครนักศึกษาฝึกงานในด้านการจัดการระบบเครือข่ายและความปลอดภัยของข้อมูลธุรกิจสมัครได้ตั้งแต่วันที่ 1 มีนาคม ถึง 10 มีนาคม 2567', 10405, '2025-03-01', 2567, '1', 1),
(1111121, 'Pr1.1.png', 'Pr2.21.png', 'Pr3.21.png', 'Pr4.21.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การบริหารโครงการและการจัดการองค์กร\r\nสมัครได้ตั้งแต่วันที่ 10 กุมภาพันธ์ ถึง 28 กุมภาพันธ์ 2567', 10501, '2025-02-09', 2567, '1', 1),
(1111122, 'Pr2.1.png', 'Pr2.22.png', 'Pr3.22.png', 'Pr4.22.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท B เปิดรับนักศึกษาสาขาการจัดการเข้าฝึกงานเพื่อพัฒนาทักษะด้านการวางแผนกลยุทธ์และการบริหารทรัพยากรองค์กร\r\nสมัครได้ตั้งแต่วันที่ 15 กุมภาพันธ์ ถึง 10 มีนาคม 2567', 10502, '2025-02-14', 2567, '1', 2),
(1111123, 'Pr1.1.png', 'Pr2.23.png', 'Pr3.23.png', 'Pr4.23.png', 'ประชาสัมพันธ์สหกิจ1001', 'ธนาคาร C รับสมัครนักศึกษาฝึกงานเพื่อเรียนรู้การจัดการระบบงานและกระบวนการบริหารองค์กร\r\nสมัครได้ตั้งแต่วันที่ 20 กุมภาพันธ์ ถึง 5 มีนาคม 2567', 10503, '2025-02-20', 2567, '1', 2),
(1111124, 'Pr2.1.png', 'Pr2.24.png', 'Pr3.24.png', 'Pr4.24.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท D เปิดรับนักศึกษาฝึกงานเพื่อเรียนรู้การบริหารโครงการและการควบคุมงานให้เป็นไปตามแผน\r\nสมัครได้ตั้งแต่วันที่ 25 กุมภาพันธ์ ถึง 15 มีนาคม 2567', 10504, '2025-02-25', 2567, '1', 2),
(1111125, 'Pr1.1.png', 'Pr2.25.png', 'Pr3.25.png', 'Pr4.25.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท E รับสมัครนักศึกษาฝึกงานเพื่อเรียนรู้การบริหารทรัพยากรมนุษย์และการพัฒนาบุคลากรในองค์กร\r\nสมัครได้ตั้งแต่วันที่ 1 มีนาคม ถึง 10 มีนาคม 2567', 10505, '2025-03-01', 2567, '1', 2),
(1111126, 'Pr2.1.png', 'Pr2.26.png', 'Pr3.26.png', 'Pr4.26.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การวิเคราะห์เศรษฐกิจและแนวโน้มตลาดธุรกิจ\r\nสมัครได้ตั้งแต่วันที่ 10 กุมภาพันธ์ ถึง 28 กุมภาพันธ์ 2567', 10601, '2025-02-10', 2567, '1', 1),
(1111127, 'Pr1.1.png', 'Pr2.27.png', 'Pr3.27.png', 'Pr4.27.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท B เปิดรับนักศึกษาสาขาเศรษฐศาสตร์ธุรกิจเข้าฝึกงานเพื่อพัฒนาทักษะด้านการวิเคราะห์ข้อมูลเศรษฐกิจและการเงิน\r\nสมัครได้ตั้งแต่วันที่ 15 กุมภาพันธ์  ถึง 10 มีนาคม 2567', 10602, '2025-02-15', 2567, '1', 2),
(1111128, 'Pr2.1.png', 'Pr2.28.png', 'Pr3.28.png', 'Pr4.28.png', 'ประชาสัมพันธ์สหกิจ1001', 'ธนาคาร C รับสมัครนักศึกษาฝึกงานเพื่อเรียนรู้การประเมินความเสี่ยงทางเศรษฐกิจและการวางแผนการเงิน\r\nสมัครได้ตั้งแต่วันที่ 20 กุมภาพันธ์ ถึง 5 มีนาคม 2567', 10603, '2025-02-20', 2567, '1', 2),
(1111129, 'Pr1.1.png', 'Pr2.29.png', 'Pr3.29.png', 'Pr3.29.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท D เปิดรับนักศึกษาฝึกงานเพื่อศึกษาแนวโน้มเศรษฐกิจและผลกระทบต่อภาคธุรกิจ\r\nสมัครได้ตั้งแต่วันที่  25 กุมภาพันธ์ ถึง 15 มีนาคม 2567', 10604, '2025-02-25', 2567, '1', 1),
(1111130, 'Pr2.1.png', 'Pr2.30.png', 'Pr3.30.png', 'Pr4.30.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท E รับสมัครนักศึกษาฝึกงานเพื่อเรียนรู้การกำหนดนโยบายเศรษฐกิจและการพัฒนาแผนธุรกิจ\r\nสมัครได้ตั้งแต่วันที่ 1 มีนาคม ถึง 10 มีนาคม 2567', 10605, '2025-03-01', 2567, '1', 2),
(1111131, 'Pr1.1.png', 'Pr2.31.png', 'Pr3.31.png', 'Pr4.31.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาฝึกงานสหกิจเพื่อเรียนรู้การวิเคราะห์งบการเงินและการบริหารกระแสเงินสด\r\nสมัครได้ตั้งแต่วันที่ 10 กุมภาพันธ์ ถึง 28 กุมภาพันธ์ 2567', 10101, '2025-02-10', 2567, '1', 1),
(1111132, 'Pr2.1.png', 'Pr2.32.png', 'Pr3.32.png', 'Pr4.32.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท B เปิดรับนักศึกษาสาขาบริหารการเงินเข้าฝึกงานเพื่อเรียนรู้การวิเคราะห์การลงทุนและการจัดการพอร์ตการลงทุน\r\nสมัครได้ตั้งแต่วันที่  15 กุมภาพันธ์ ถึง 10 มีนาคม 2567', 10101, '2025-02-15', 2567, '1', 2),
(1111133, 'Pr1.1.png', 'Pr2.33.png', 'Pr3.33.png', 'Pr4.33.png', 'ประชาสัมพันธ์สหกิจ1001', 'ธนาคาร C รับสมัครนักศึกษาฝึกงานเพื่อศึกษาแนวทางการบริหารสินเชื่อและการประเมินความเสี่ยงทางการเงิน\r\nสมัครได้ตั้งแต่ 20 กุมภาพันธ์ ถึง 5 มีนาคม 2567', 10101, '2025-02-20', 2567, '1', 2),
(1111134, 'Pr2.1.png', 'Pr2.34.png', 'Pr3.34.png', 'Pr4.34.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท D เปิดรับนักศึกษาฝึกงานเพื่อเรียนรู้การวางแผนงบประมาณและการบริหารต้นทุนธุรกิจ\r\nสมัครได้ตั้งแต่วันที่ 25 กุมภาพันธ์ ถึง 15 มีนาคม 2567', 10101, '2025-02-25', 2567, '1', 2),
(1111135, 'Pr1.1.png', 'Pr2.35.png', 'Pr3.35.png', 'Pr4.35.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท E รับสมัครนักศึกษาฝึกงานเพื่อเรียนรู้การวิเคราะห์และบริหารความเสี่ยงทางการเงินในองค์กร\r\nสมัครได้ตั้งแต่วันที่  1 มีนาคม ถึง 10 มีนาคม 2567', 10101, '2025-03-01', 2567, '1', 1),
(1111136, 'Pr2.1.png', 'Pr2.36.png', 'Pr3.36.png', 'Pr4.36.png', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท A เปิดรับนักศึกษาฝึกงานสหกิจหลักสูตรนานาชาติ เพื่อเรียนรู้การดำเนินธุรกิจและการค้าระหว่างประเทศ\r\nสมัครได้ตั้งแต่วันที่  10 กุมภาพันธ์ ถึง 28 กุมภาพันธ์ 2567', 10101, '2025-02-10', 2567, '1', 1),
(1111137, 'Pr1.1.png', '', '', '', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท B เปิดรับนักศึกษาฝึกงานเพื่อเรียนรู้กระบวนการนำเข้า-ส่งออก และการบริหารซัพพลายเชนระดับสากล\\r\\nสมัครได้ตั้งแต่วันที่ 15 กุมภาพันธ์ ถึง 10 มีนาคม 2567', 10101, '2025-02-15', 2567, '1', 1),
(1111138, 'Pr2.1.png', '', '', '', 'ประชาสัมพันธ์สหกิจ1001', 'ธนาคาร C รับสมัครนักศึกษาฝึกงานเพื่อศึกษาแนวทางการลงทุนและการบริหารความเสี่ยงทางการเงินระดับโลก\\\\r\\\\nสมัครได้ตั้งแต่วันที่ 20 กุมภาพันธ์ ถึง 5 มีนาคม 2567', 10101, '2025-02-20', 2567, '1', 1),
(1111139, 'Pr1.1.png', '', '', '', 'ประชาสัมพันธ์สหกิจ1001', 'บริษัท D เปิดรับนักศึกษาฝึกงานเพื่อเรียนรู้กลยุทธ์ทางการตลาดสำหรับธุรกิจที่ต้องการขยายไปยังตลาดต่างประเทศ\\\\r\\\\nสมัครได้ตั้งแต่วันที่ 25 กุมภาพันธ์ ถึง 15 มีนาคม 2567', 10101, '2025-02-25', 2567, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Std_id` bigint(20) NOT NULL,
  `Id_number` varchar(13) DEFAULT NULL,
  `Std_prefix` varchar(10) DEFAULT NULL,
  `Std_name` varchar(100) DEFAULT NULL,
  `Std_surname` varchar(100) DEFAULT NULL,
  `Major_id` int(11) DEFAULT NULL,
  `Grade_level` int(11) DEFAULT NULL,
  `GPA` float DEFAULT NULL,
  `GPAX` float DEFAULT NULL,
  `CGX` int(11) DEFAULT NULL,
  `Std_phone` varchar(10) DEFAULT NULL,
  `Std_email` varchar(100) DEFAULT NULL,
  `Std_add` varchar(255) DEFAULT NULL,
  `Province` varchar(50) DEFAULT NULL,
  `Zip_id` int(6) DEFAULT NULL,
  `Std_picture` varchar(255) DEFAULT NULL,
  `Std_pwd` text DEFAULT NULL,
  `Academic_year` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Std_id`, `Id_number`, `Std_prefix`, `Std_name`, `Std_surname`, `Major_id`, `Grade_level`, `GPA`, `GPAX`, `CGX`, `Std_phone`, `Std_email`, `Std_add`, `Province`, `Zip_id`, `Std_picture`, `Std_pwd`, `Academic_year`) VALUES
(65010912501, '1500000000001', 'นาย', 'ปวินท์ ', 'จันทร์เพ็ญ', 101, 4, 3.5, 3.2, 100, '0623125694', 'Pawin@gmail.com', '123/45 หมู่ 5 ถ.สุขุมวิท ต.บางจาก อ.พระโขนง', 'กรุงเทพมหานคร', 10110, 'profile_65010912501.jpg', '$2y$10$/2vqkQ6LRULzl2WrVIpi6O1rI7yCEm1pYeVHZAOdGq4SueuiNble2', 2565),
(65010912502, '1500000000002', 'นางสาว', 'ปิยธิมา', 'ทวีสุข', 101, 4, 2.8, 2.6, 100, '0641238746', 'Piyathida@gmail.com', '234/56 หมู่ 2 ถ.รัชดาภิเษก ต.ห้วยขวาง อ.ห้วยขวา', 'กรุงเทพมหานคร ', 10310, 'profile_65010912502.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912503, '1500000000003', 'นางสาว', 'มณีรัตน์ ', 'ศุภวัฒน์', 101, 4, 3.54, 3.3, 100, '0957841236', 'Maneerat@gmail.com', '12/34 หมู่ 8 ถ.เพชรเกษม ต.บางแค อ.บางแค ', 'กรุงเทพมหานคร ', 10160, 'profile_65010912503.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912504, '1500000000004', 'นาย', 'ณัฐกุล ', 'ธนะภูมิ', 101, 4, 2.6, 2.2, 100, '0842321456', 'Natakun@gmail.com', '789/12 ถนนเทพกระษัตรี ตำบลรัษฎา อำเภอเมือง', 'ภูเก็ต', 83000, 'profile_65010912504.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912505, '1500000000005', 'นาย', 'วีรยุทธ', ' ยิ่งยง', 101, 4, 3.99, 3.88, 100, '0874523614', 'Veerayuth@gmail.com', '67 หมู่ 3 ซอยมิตรภาพ 10 ถนนมิตรภาพ ตำบลในเมือง อำเภอเมือง', 'ขอนแก่น', 40000, 'std5.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912506, '1500000000006', 'นางสาว', 'ณัฐธยาน์ ', 'ประมูล', 102, 4, 3.66, 3.45, 100, '0846329456', 'Nattayan@gmail.com', '255/7 หมู่ 8 ถนนมิตรภาพ ตำบลหัวทะเล อำเภอเมือง', 'นครราชสีมา', 30000, 'std6.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912507, '1500000000007', 'นางสาว', 'ภัทรสุดา ', 'พรประทาน', 102, 4, 2.78, 2.36, 100, '0653246972', 'Phatsuda@gmail.com', '99/12 หมู่ 10 ซอยนาเกลือ 14 ถนนเลียบชายหาด ตำบลหนองปรือ อำเภอ', 'ชลบุรี', 20150, 'std7.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912508, '1500000000008', 'นาย', 'กวินทร์ ', 'วิจิตร์ศรี', 102, 4, 2.58, 2.35, 100, '0874236524', 'Kawin@gmail.com', '88/9 หมู่ 2 ถนนตลาดใหม่ ตำบลตลาด อำเภอเมือง', 'สุราษฎร์ธานี', 84000, 'std8.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912509, '1500000000009', 'นาย', 'อัครเดช', 'คงนิช', 103, 4, 3.33, 3.1, 104, '0941300584', 'Ac@gmail.com', 'บ้าน', 'นครปฐม', 41160, 'profile_65010912509.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912510, '1500000000010', 'นางสาว', 'อภิญญา ', 'ชินธนชัย', 102, 4, 3.45, 3.05, 100, '0634567451', 'Apinya@gmail.com', '234 หมู่ 7 ถนนโพศรี ตำบลหมากแข้ง อำเภอเมือง', 'อุดรธานี', 41000, 'std10.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912511, '1500000000011', 'นางสาว', 'นิชาภา ', 'เพ็ชรสุวรรณ ', 103, 4, 2.77, 2.56, 100, '0641256325', 'Nichapa@gmail.com', '56 หมู่ 4 ถนนสวรรค์วิถี ตำบลนครสวรรค์ตก อำเภอเมือง', 'นครสวรรค์', 60000, 'std11.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912512, '1500000000012', 'นาย', 'ชนินทร์ ', 'ศรีอัครานนท์', 103, 4, 3.9, 3.7, 100, '0674236587', 'Chanin@gmail.com', '12 ถนนเพชรเกษม ตำบลหน้าเมือง อำเภอเมือง', 'ราชบุรี', 70000, 'std12.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912513, '1500000000013', 'นางสาว', 'ธนิดา ', 'ดาราภิรมย์ ', 103, 4, 3.42, 3.1, 100, '0853624156', 'Thanida@gmail.com', '77 หมู่ 9 ถนนจิระ ตำบลในเมือง อำเภอเมือง', 'บุรีรัมย์', 31000, 'std13.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912514, '1500000000014', 'นาย', 'อิทธิพล ', 'พันธ์สุวรรณ', 103, 4, 3.64, 3.55, 100, '0627456874', 'Itthipon@gmail.com', '100 ถนนเทศา ตำบลพระปฐมเจดีย์ อำเภอเมือง', 'นครปฐม', 73000, 'std14.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912515, '1500000000015', 'นาย', 'ธนพล ', 'ชัยภูมิ', 103, 4, 3.61, 3.42, 100, '0873564256', 'Thanapol@gmail.com', '21/4 ถนนบุญวาทย์ ตำบลสวนดอก อำเภอเมือง', 'ลำปาง', 52000, 'std15.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912516, '1500000000016', 'นางสาว', 'ศิริวรรณ', 'สุวรรณมาศ ', 104, 4, 3.86, 3.68, 100, '0874563547', 'Siriwan@gmail.com', '48/7 หมู่ 3 ถนนสุขุมวิท ตำบลเนินพระ อำเภอเมือง', 'ระยอง', 21000, 'std16.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912517, '1500000000017', 'นาย', 'ภาคิน ', 'วรากุล', 104, 4, 3.33, 3.2, 100, '0846523756', 'Phakin@gmail.com', '55 ถนนเขื่อนธานี ตำบลในเมือง อำเภอเมือง', 'อุบลราชธานี', 34000, 'std17.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912518, '1500000000018', 'นางสาว', 'กานต์ธิดา ', 'วงศ์สวัสดิ์ ', 104, 4, 2.66, 2.5, 100, '0634568715', 'Kanthida@gmail.com', '35 ถนนบรมไตรโลกนารถ ตำบลในเมือง อำเภอเมือง', 'พิษณุโลก', 65000, 'std18.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912519, '1500000000019', 'นางสาว', 'ณิชานันท์ ', 'พิพัฒน์พงษ์', 104, 4, 3.45, 3.32, 100, '0854126748', 'Nichanan@gmail.com', '78 หมู่ 6 ถนนสุขเกษม ตำบลธาตุเชิงชุม อำเภอเมือง', 'สกลนคร', 47000, 'std19.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912520, '1500000000020', 'นางสาว', 'ชญานิศ ', 'รัตนมาศ', 104, 4, 3.42, 3.21, 100, '0614563275', 'Chayanis@gmail.com', '19/5 ถนนติวานนท์ ตำบลตลาดขวัญ อำเภอเมือง', 'นนทบุรี', 11000, 'std20.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912521, '1500000000021', 'นาย', 'ณัฐนนท์', 'วิชญานนท์', 105, 4, 3.81, 3.72, 100, '0831236542', 'Nattanon@gmail.com', '22/3 หมู่ 4 ถนนศรีจันทร์ ตำบลบ้านเป็ด อำเภอเมือง', 'มหาสารคาม', 44000, 'std21.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912522, '1500000000022', 'นาย', 'ปรัชญา ', 'ธรรมโชติ', 105, 4, 3.66, 3.45, 100, '0625874623', 'Prachaya@gmail.com', '11/9 ถนนศรีภูเวียง ตำบลในเมือง อำเภอเมือง', 'เลย', 42000, 'std22.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912523, '1500000000023', 'นางสาว', 'พิมพ์วรีย์ ', 'ธาราทิพย์', 105, 4, 2.78, 2.61, 100, '0674563256', 'Pimwaree@gmail.com', '66 หมู่ 1 ถนนพิชัยสงคราม ตำบลท่าพี่เลี้ยง อำเภอเมือง', 'สุพรรณบุรี', 72000, 'std23.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912524, '1500000000024', 'นาย', 'อชิรวัตน์ ', 'รุจิภาส', 105, 4, 3.66, 3.55, 100, '0864597624', 'Achirawat@gmail.com', '40/6 หมู่ 5 ถนนราษฎร์บำรุง ตำบลนาจอมเทียน อำเภอสัตหีบ', 'ชลบุรี', 20250, 'std24.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912525, '1500000000025', 'นางสาว', 'ศิริขวัญ ', 'วนารัตน์ ', 105, 4, 3.86, 3.71, 100, '0953647562', 'Sirikhwan@gmail.com', '88/1 ถนนเยาวราช ตำบลตลาด อำเภอเมือง', 'ตรัง', 92000, 'std25.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912526, '1500000000026', 'นาย', 'กิตติภพ ', 'วงศ์ศรีไพร', 106, 4, 3.76, 3.61, 100, '0863456274', 'Kittiphop@gmail.com', '75 หมู่ 8 ถนนอินทวโรรส ตำบลศรีภูมิ อำเภอเมือง', 'ลำพูน', 51000, 'std26.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912527, '1500000000027', 'นางสาว', 'อารดา ', 'เพชรรุ่งโรจน์', 106, 4, 3.44, 3.26, 100, '0654265784', 'Arada@gmail.com', '30/2 ถนนราชดำเนิน ตำบลหัวหิน อำเภอหัวหิน', 'ประจวบคีรีขันธ์', 77110, 'std27.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912528, '1500000000028', 'นางสาว', 'ภิรมย์ลดา  ', 'กาญจนกุล', 106, 4, 3.65, 3.51, 100, '0934521456', 'Piromlada@gmail.com', '90 หมู่ 9 ถนนพหลโยธิน ตำบลเวียง อำเภอเมือง', 'เชียงราย', 57000, 'std28.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912529, '1500000000029', 'นาย', 'วรัญญู ', 'ศักดากร', 106, 4, 3.74, 3.65, 100, '0874563256', 'Waranyu@gmail.com', '55/7 ถนนสุนทรภู่ ตำบลบ้านเพ อำเภอเมือง', 'ระยอง', 21160, 'std29.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912530, '1500000000030', 'นาย', 'ศุภณัฐ ', 'สุขเกษม', 106, 4, 3.65, 3.52, 100, '0863245675', 'Supanat@gmail.com', '100/3 ถนนพญาไท ตำบลตลาด อำเภอเมือง', 'เพชรบุรี', 76000, 'std30.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912531, '1500000000031', 'นางสาว', 'ธัญวรัตน์ ', 'รุ่งเรืองชัย', 107, 4, 3.54, 3.41, 100, '0642567452', 'Thanyawarat@gmail.com', '123 หมู่ 7 ถนนมิตรภาพ ตำบลท่าช้าง อำเภอเมือง', 'สระบุรี', 18000, 'std31.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912532, '1500000000032', 'นาย', 'ธนกฤต ', 'อมรศักดิ์', 107, 4, 3.56, 3.41, 100, '0624567563', 'Thanakrit@gmail.com', '88/9 ถนนสุริยวงศ์ ตำบลมหาชัย อำเภอเมือง', 'สมุทรสาคร', 74000, 'std32.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912533, '1500000000033', 'นางสาว', 'ธัญวรัตน์ ', 'รุ่งเรืองชัย', 107, 4, 3.23, 2.96, 100, '0645326574', 'Thanyawarat@gmail.com', '55/4 ถนนเจริญนคร ตำบลสำเหร่ อำเภอเมือง', 'สมุทรปราการ', 10270, 'std32.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912534, '1500000000034', 'นางสาว', 'อภิญญา ', 'วรากร', 107, 4, 3.62, 3.52, 100, '0674536245', 'Apinya@gmail.com', '99 หมู่ 6 ถนนศรีนครินทร์ ตำบลเทพารักษ์ อำเภอเมือง', 'สมุทรปราการ', 10280, 'std34.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912535, '1500000000035', 'นางสาว', 'ปัทมวรรณ  ', 'จิรโชติ', 107, 4, 2.61, 2.41, 100, '0864532654', 'Patamawan@gmail.com', '45/8 ถนนกาญจนาภิเษก ตำบลบางม่วง อำเภอบางใหญ่', 'นนทบุรี', 11140, 'std35.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912536, '1500000000036', 'นาย', 'จักรภพ ', 'วัฒนกิจ', 108, 4, 3.54, 3.41, 100, '0856345627', 'Jakraphop@gmail.com', '30/5 ถนนเลียบคลอง ตำบลท่าตูม อำเภอเมือง', 'สุรินทร์', 32000, 'std36.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912537, '1500000000037', 'นางสาว', 'สุพิชชา ', 'นิลรัตน์ ', 108, 4, 3.88, 3.72, 100, '0863541265', 'Supitcha@gmail.com', '11/2 ถนนจอมพล ตำบลในเมือง อำเภอเมือง', 'นครพนม', 48000, 'std37.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912538, '1500000000038', 'นาย', 'ภาณุวิชญ์ ', 'ศรีวัฒน์', 108, 4, 3.64, 3.52, 100, '0863546247', 'Jakraphop@gmail.com', '67/5 ถนนพญาไท ตำบลปากเพรียว อำเภอเมือง', 'สระบุรี', 18000, 'std38.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65010912539, '1500000000039', 'นางสาว', 'ณัฏฐิยา ', 'วัฒนานนท์', 108, 4, 3.63, 3.54, 100, '0863256472', 'Natthiya@gmail.com', '99/10 ถนนเทศบาล ตำบลในเมือง อำเภอเมือง', 'อำนาจเจริญ', 37000, 'std39.png', '827ccb0eea8a706c4c34a16891f84e7b', 2566),
(65010912540, '1500000000040', 'นางสาว', 'วริศรา ', 'สุขสวัสดิ์ ', 108, 4, 3.64, 3.51, 100, '0654236587', 'Warissara@gmail.com', '188/8 ซ.บ้านช้าง ตำบลหมากแข้ง อำเภอเมือง', 'อุดรธานี', 41000, 'std40.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567),
(65109125788, '1474166466666', 'นางสาว', 'อัครเดช', 'คงนิช', 103, 4, 2.5, 2.1, 100, '0941300584', 'test@gmail.com', 'บ้าน', 'นครนายก', 46620, 'profile_65109125788.png', '827ccb0eea8a706c4c34a16891f84e7b', 2567);

-- --------------------------------------------------------

--
-- Table structure for table `student_work`
--

CREATE TABLE `student_work` (
  `Work_id` int(11) NOT NULL,
  `Work_name` varchar(255) DEFAULT NULL,
  `Std_id` bigint(20) DEFAULT NULL,
  `Work_detail` text DEFAULT NULL,
  `Work_picture` varchar(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Work_year` int(11) DEFAULT NULL,
  `Company_id` int(11) DEFAULT NULL,
  `Work_File` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_work`
--

INSERT INTO `student_work` (`Work_id`, `Work_name`, `Std_id`, `Work_detail`, `Work_picture`, `Date`, `Work_year`, `Company_id`, `Work_File`) VALUES
(1002, 'โครงการวิเคราะห์ต้นทุนและกำไรขององค์กร', 65010912502, 'วิเคราะห์โครงสร้างต้นทุนและกำไรของบริษัท เพื่อนำเสนอแนวทางการลดต้นทุนและเพิ่มประสิทธิภาพทางการเงิน\r\n', 'w2.png', '2025-04-02', 2567, 10102, 'Wf2.pdf'),
(1003, 'โครงการวิเคราะห์งบการเงินเพื่อการตัดสินใจทางธุรกิจ', 65010912503, 'ศึกษาและวิเคราะห์งบการเงินขององค์กร เพื่อนำเสนอข้อมูลเชิงลึกสำหรับการวางแผนและตัดสินใจทางธุรกิจ', 'w3.png', '2025-04-03', 2567, 10103, 'Wf3.pdf'),
(1004, 'โครงการตรวจสอบภายในและการควบคุมภายในองค์กร', 65010912504, 'ศึกษากระบวนการตรวจสอบบัญชีภายใน ค้นหาความผิดพลาด และปรับปรุงระบบควบคุมภายใน', 'w4.png', '2025-04-04', 2567, 10104, 'Wf4.pdf'),
(1005, 'โครงการบริหารกระแสเงินสดและงบประมาณองค์กร', 65010912505, 'ศึกษาวิธีบริหารจัดการกระแสเงินสดและจัดทำงบประมาณ เพื่อให้บริษัทสามารถวางแผนการเงินได้อย่างมีประสิทธิภาพ\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'w5.png', '2025-04-05', 2567, 10105, 'Wf5.pdf'),
(1006, 'โครงการวิเคราะห์พฤติกรรมผู้บริโภคและแนวโน้มตลาด', 65010912506, '-ศึกษาพฤติกรรมผู้บริโภคและปัจจัยที่มีผลต่อการตัดสินใจซื้อสินค้า\r\n-วิเคราะห์ข้อมูลแนวโน้มตลาดและพฤติกรรมลูกค้าผ่านแบบสอบถามและการวิจัยตลาด\r\n-นำเสนอแนวทางปรับกลยุทธ์การตลาดให้สอดคล้องกับพฤติกรรมผู้บริโภค\r\n', 'w6.png', '2025-04-07', 2567, 10201, 'Wf6.pdf'),
(1007, 'โครงการพัฒนาแผนการตลาดออนไลน์สำหรับธุรกิจ SME', 65010912507, '-ศึกษาแนวทางการตลาดออนไลน์ เช่น การใช้โซเชียลมีเดียและโฆษณาออนไลน์\r\n-วางแผนและออกแบบกลยุทธ์ Digital Marketing ให้เหมาะสมกับกลุ่มเป้าหมาย\r\n-ทดลองใช้เครื่องมือทางการตลาด เช่น Facebook Ads, Google Ads, SEO', 'w7.png', '2025-04-08', 2567, 10202, 'Wf7.pdf'),
(1008, 'โครงการส่งเสริมการขายและสร้างแบรนด์สินค้า', 65010912508, '-ศึกษากลยุทธ์การสร้างแบรนด์และการสื่อสารทางการตลาด\r\n-ออกแบบกิจกรรมส่งเสริมการขาย เช่น โปรโมชั่น ลดราคา หรือแคมเปญแจกของรางวัล\r\n-วัดผลและวิเคราะห์ประสิทธิภาพของกิจกรรมที่จัดขึ้น', 'w8.png', '2025-04-09', 2567, 10203, 'Wf8.pdf'),
(1009, 'โครงการวางแผนกลยุทธ์การตลาดสำหรับสินค้าใหม่', 65010912509, '-วิเคราะห์ตลาดและคู่แข่งเพื่อพัฒนาแนวทางเปิดตัวสินค้าใหม่\r\n-วางแผนกลยุทธ์การกำหนดราคา ช่องทางจัดจำหน่าย และการสื่อสารทางการตลาด\r\n-ทดสอบแผนการตลาดและปรับปรุงตามผลตอบรับของกลุ่มเป้าหมาย', 'w9.png', '2025-04-10', 2567, 10204, 'Wf9.pdf'),
(1010, 'โครงการสร้างคอนเทนต์และกลยุทธ์ Social Media Marketing', 65010912510, '-ศึกษาพฤติกรรมของผู้ใช้โซเชียลมีเดียแต่ละแพลตฟอร์ม\r\n-วางแผนและออกแบบเนื้อหาสำหรับ Facebook, Instagram, TikTok ฯลฯ\r\n-วัดผลการเข้าถึงและการมีส่วนร่วมของผู้บริโภค พร้อมนำเสนอแนวทางปรับปรุง', 'w10.png', '2025-04-11', 2567, 10205, 'Wf10.pdf'),
(1011, 'โครงการพัฒนาระบบจัดการข้อมูลลูกค้าด้วยฐานข้อมูล (CRM System)', 65010912511, '-ศึกษาและออกแบบฐานข้อมูลเพื่อจัดเก็บข้อมูลลูกค้า\r\n-พัฒนาและปรับปรุงระบบ CRM (Customer Relationship Management) ให้มีประสิทธิภาพ\r\n-นำระบบไปทดสอบและวิเคราะห์ผลตอบรับจากผู้ใช้งาน', 'w11.png', '2025-04-15', 2567, 10301, 'Wf11.pdf'),
(1012, 'โครงการวิเคราะห์ข้อมูลธุรกิจด้วย Power BI', 65010912512, '-ศึกษาและรวบรวมข้อมูลทางธุรกิจจากแหล่งต่าง ๆ\r\n-ใช้เครื่องมือ Power BI หรือ Google Data Studio ในการวิเคราะห์และสร้าง Dashboard\r\n-นำเสนอข้อมูลเชิงลึกที่ช่วยให้ผู้บริหารสามารถตัดสินใจได้อย่างมีประสิทธิภาพ', 'w12.png', '2025-04-16', 2567, 10302, 'Wf12.pdf'),
(1013, 'โครงการพัฒนาเว็บไซต์สำหรับธุรกิจอีคอมเมิร์ซ', 65010912513, '-ออกแบบและพัฒนาเว็บไซต์อีคอมเมิร์ซด้วย WordPress หรือ Laravel\r\n-เชื่อมต่อระบบชำระเงินออนไลน์ เช่น PayPal, QR Code Payment\r\n-ทดสอบและปรับปรุง UX/UI เพื่อให้ใช้งานได้ง่ายและมีประสิทธิภาพสูงสุด\r\n', 'w13.png', '2025-04-16', 2567, 10303, 'Wf13.pdf'),
(1014, 'โครงการพัฒนา Chatbot สำหรับธุรกิจด้วย AI', 65010912514, '-ศึกษาเทคโนโลยี AI และการพัฒนา Chatbot ด้วยแพลตฟอร์ม เช่น Dialogflow หรือ LINE Bot\r\n-พัฒนา Chatbot เพื่อตอบคำถามและช่วยเหลือลูกค้าอัตโนมัติ\r\n-ทดสอบและปรับปรุงให้ Chatbot สามารถโต้ตอบได้อย่างแม่นยำ\r\n', 'w14.png', '2025-04-17', 2567, 10304, 'Wf14.pdf'),
(1015, 'โครงการพัฒนาระบบจัดการคลังสินค้า (Inventory Management System)', 65010912515, '-ศึกษากระบวนการจัดการสินค้าคงคลังของธุรกิจ\r\n-ออกแบบและพัฒนาโปรแกรมสำหรับติดตามสินค้า และแจ้งเตือนเมื่อต้องเติมสต็อก\r\n-ทดสอบระบบและนำเสนอแนวทางปรับปรุงให้ใช้งานได้จริงในองค์กร', 'w15.png', '2025-08-04', 2567, 10305, 'Workfile_65010912515_1754324565.pdf'),
(1016, ' โครงการพัฒนาระบบบริหารจัดการข้อมูลลูกค้า (CRM System)', 65010912516, '-ออกแบบและพัฒนาระบบจัดเก็บข้อมูลลูกค้าเพื่อช่วยให้ธุรกิจสามารถบริหารความสัมพันธ์กับลูกค้าได้ดีขึ้น\r\n-ใช้เทคโนโลยีฐานข้อมูล เช่น MySQL หรือ MongoDB และพัฒนา UI ให้ใช้งานง่าย\r\n-ทดสอบและปรับปรุงระบบตามข้อเสนอแนะของผู้ใช้งาน\r\n', 'w16.png', '2025-04-17', 2567, 10401, 'Wf16.pdf'),
(1017, 'โครงการวิเคราะห์ข้อมูลธุรกิจด้วย Data Analytics', 65010912517, '-ศึกษาและรวบรวมข้อมูลการขาย การตลาด และพฤติกรรมลูกค้า\r\n-ใช้เครื่องมือวิเคราะห์ข้อมูล เช่น Power BI, Tableau หรือ Python เพื่อหาข้อมูลเชิงลึก\r\n-นำเสนอรายงาน Dashboard เพื่อช่วยในการตัดสินใจทางธุรกิจ\r\n', 'w17.png', '2025-04-18', 2567, 10402, 'Wf17.pdf'),
(1018, 'โครงการพัฒนาเว็บไซต์ธุรกิจด้วยเทคโนโลยี Web Application', 65010912518, '-ออกแบบและพัฒนาเว็บไซต์สำหรับธุรกิจ เช่น เว็บไซต์ขายของออนไลน์ หรือระบบจองบริการ\r\n-ใช้เทคโนโลยี HTML, CSS, JavaScript, PHP หรือ React ในการพัฒนา\r\n-ปรับปรุง UX/UI และเพิ่มฟีเจอร์ เช่น ระบบสมาชิก และการชำระเงินออนไลน์\r\n', 'w18.png', '2025-03-20', 2567, 10403, 'Wf18.pdf'),
(1019, 'โครงการพัฒนาระบบ e-Document เพื่อการจัดการเอกสารในองค์กร', 65010912519, '-ศึกษาการบริหารเอกสารในองค์กรและปัญหาที่พบ\r\n-พัฒนาระบบ e-Document ช่วยให้สามารถจัดเก็บและค้นหาเอกสารได้ง่ายขึ้น\r\n-ใช้เทคโนโลยี Cloud Storage เช่น Google Drive API หรือ AWS S3\r\n', 'w19.png', '2025-03-21', 2567, 10404, 'Wf19.pdf'),
(1020, 'โครงการพัฒนา Chatbot เพื่อตอบคำถามลูกค้าอัตโนมัติ', 65010912520, '-ศึกษาเทคโนโลยี AI Chatbot และการพัฒนา Chatbot ผ่านแพลตฟอร์มเช่น Dialogflow หรือ LINE Bot\r\n-พัฒนา Chatbot ให้สามารถตอบคำถามพื้นฐานเกี่ยวกับสินค้าและบริการ\r\n-ทดสอบและปรับปรุงระบบให้สามารถตอบคำถามได้แม่นยำมากขึ้น\r\n', 'w20.png', '2025-03-22', 2567, 10405, 'Wf20.pdf'),
(1021, 'โครงการพัฒนาระบบบริหารงานบุคคล (HR Management System)', 65010912521, '-ศึกษาแนวทางการบริหารทรัพยากรบุคคลในองค์กร\r\n-ออกแบบและพัฒนาระบบจัดเก็บข้อมูลพนักงาน เช่น การลงเวลาทำงาน สวัสดิการ และการประเมินผล\r\n-ทดสอบและปรับปรุงระบบให้สามารถใช้งานได้จริง\r\n', 'w21.png', '2025-03-22', 2567, 10501, 'W21.pdf'),
(1022, 'โครงการวางแผนกลยุทธ์เพิ่มประสิทธิภาพการทำงานในองค์กร', 65010912522, '-ศึกษาปัญหาในการบริหารงานและกระบวนการทำงานขององค์กร\r\n-นำเสนอแนวทางการปรับปรุงเพื่อเพิ่มประสิทธิภาพ เช่น Lean Management, Agile Workflow\r\n-วัดผลและประเมินความสำเร็จของแนวทางที่นำเสนอ\r\n', 'w22.png', '2025-03-23', 2567, 10502, 'Wf22.pdf'),
(1023, 'โครงการพัฒนาระบบบริหารจัดการซัพพลายเชน (Supply Chain Management)', 65010912523, '-วิเคราะห์และศึกษากระบวนการบริหารซัพพลายเชนขององค์กร\r\n-พัฒนาระบบเพื่อลดต้นทุนและเพิ่มความรวดเร็วในการจัดส่งสินค้า\r\n-ทดสอบระบบและนำเสนอแนวทางปรับปรุงให้มีประสิทธิภาพสูงสุด', 'w23.png', '2025-03-23', 2567, 10503, 'Wf23.pdf'),
(1024, 'โครงการออกแบบแผนพัฒนาศักยภาพพนักงานในองค์กร', 65010912524, '-ศึกษาความต้องการพัฒนาทักษะของพนักงานในแต่ละแผนก\r\n-วางแผนและออกแบบหลักสูตรอบรม เช่น ทักษะการบริหาร การสื่อสาร หรือการใช้เทคโนโลยีใหม่ๆ\r\n-ประเมินผลลัพธ์และเสนอแนวทางพัฒนาต่อไป', 'w24.png', '2025-03-25', 2567, 10504, 'Wf24.pdf'),
(1025, 'โครงการบริหารความเสี่ยงและการวางแผนเชิงกลยุทธ์องค์กร', 65010912525, '-ศึกษาปัจจัยเสี่ยงที่มีผลต่อการดำเนินธุรกิจ เช่น ความเสี่ยงด้านการเงิน การดำเนินงาน หรือกฎหมาย\r\n-วิเคราะห์และออกแบบแผนบริหารความเสี่ยงให้เหมาะสม\r\n-นำเสนอแนวทางลดความเสี่ยงและวางแผนรับมือกับสถานการณ์ที่อาจเกิดขึ้น', 'w25.png', '2025-03-26', 2567, 10505, 'Wf25.pdf'),
(1026, 'โครงการวิเคราะห์แนวโน้มเศรษฐกิจและผลกระทบต่อธุรกิจ', 65010912526, '-ศึกษาปัจจัยทางเศรษฐกิจที่มีผลต่อธุรกิจ เช่น อัตราดอกเบี้ย เงินเฟ้อ ค่าเงิน และนโยบายการคลัง\r\n-วิเคราะห์แนวโน้มทางเศรษฐกิจและคาดการณ์ผลกระทบต่อธุรกิจ\r\n-นำเสนอแนวทางปรับกลยุทธ์ทางธุรกิจให้สอดคล้องกับสถานการณ์เศรษฐกิจ\r\n', 'w26.png', '2025-03-26', 2567, 10601, 'Wf26.pdf'),
(1027, 'โครงการวิเคราะห์ต้นทุนและผลตอบแทนของธุรกิจ (Cost-Benefit Analysis)', 65010912527, '-ศึกษาโครงสร้างต้นทุนของธุรกิจและวิเคราะห์ผลตอบแทนจากการลงทุน\r\n-ใช้หลักการเศรษฐศาสตร์ธุรกิจเพื่อหาวิธีลดต้นทุนและเพิ่มประสิทธิภาพการดำเนินงาน\r\n-นำเสนอแนวทางปรับปรุงการบริหารต้นทุนและเพิ่มกำไรให้กับธุรกิจ\r\n', 'w27.png', '2025-03-26', 2567, 10602, 'Wf27.pdf'),
(1028, 'โครงการศึกษาผลกระทบของนโยบายภาครัฐต่อภาคธุรกิจ', 65010912528, '-ศึกษานโยบายเศรษฐกิจของภาครัฐ เช่น ภาษี มาตรการกระตุ้นเศรษฐกิจ และกฎหมายแรงงาน\r\n-วิเคราะห์ผลกระทบของนโยบายที่มีต่อภาคธุรกิจและการจ้างงาน\r\n-นำเสนอแนวทางปรับกลยุทธ์ทางธุรกิจให้สอดคล้องกับนโยบายของภาครัฐ\r\n', 'w28.png', '2025-03-27', 2567, 10603, 'Wf28.pdf'),
(1029, 'โครงการวิเคราะห์ตลาดและพฤติกรรมผู้บริโภคเพื่อการขยายธุรกิจ', 65010912529, '-ศึกษาแนวโน้มตลาดและพฤติกรรมการบริโภคสินค้าและบริการ\r\n-วิเคราะห์อุปสงค์และอุปทานของตลาดเพื่อหาโอกาสทางธุรกิจ\r\n-เสนอแผนกลยุทธ์เพื่อขยายตลาดและเพิ่มยอดขายให้กับองค์กร', 'w29.png', '2025-03-29', 2567, 10604, 'Wf29.pdf'),
(1030, 'โครงการพัฒนาระบบพยากรณ์เศรษฐกิจและการเงินขององค์กร', 65010912530, '-ศึกษาเครื่องมือและแบบจำลองทางเศรษฐศาสตร์ที่ใช้ในการพยากรณ์เศรษฐกิจ\r\n-พัฒนาระบบวิเคราะห์ข้อมูลเพื่อคาดการณ์แนวโน้มเศรษฐกิจและกระแสเงินสดขององค์กร\r\n-ทดสอบระบบและนำเสนอแนวทางใช้ข้อมูลพยากรณ์เพื่อการตัดสินใจทางธุรกิจ\r\n', 'w30.png', '2025-03-30', 2567, 10605, 'Wf30.pdf'),
(1031, 'โครงการวิเคราะห์งบการเงินเพื่อการตัดสินใจทางการเงิน', 65010912531, '-ศึกษาและวิเคราะห์งบการเงิน เช่น งบดุล งบกำไรขาดทุน และงบกระแสเงินสด\r\n-วิเคราะห์ข้อมูลทางการเงินเพื่อช่วยในการตัดสินใจเกี่ยวกับการลงทุนและการจัดการทางการเงิน\r\n-นำเสนอข้อเสนอแนะเพื่อปรับปรุงความสามารถในการทำกำไรและการควบคุมต้นทุน', 'w31.png', '2025-03-17', 2567, 10101, 'Wf31.pdf'),
(1032, 'โครงการพัฒนาระบบบริหารจัดการกระแสเงินสด', 65010912532, '-ศึกษาการบริหารจัดการกระแสเงินสดในองค์กร\r\n-พัฒนาระบบการติดตามและวิเคราะห์กระแสเงินสดเพื่อป้องกันปัญหาการขาดสภาพคล่อง\r\n-แนะนำวิธีการเพิ่มประสิทธิภาพในการบริหารกระแสเงินสดและวางแผนทางการเงินระยะยาว\r\n', 'w32.png', '2025-03-20', 2567, 10101, 'Wf32.pdf'),
(1033, 'โครงการวิเคราะห์ความเสี่ยงในการลงทุนและการบริหารพอร์ตการลงทุน', 65010912533, '-ศึกษาความเสี่ยงที่เกี่ยวข้องกับการลงทุนในหุ้น พันธบัตร หรือสินทรัพย์อื่น ๆ\r\n-วิเคราะห์ข้อมูลทางการเงินและตลาดเพื่อประเมินความเสี่ยงและผลตอบแทนจากการลงทุน\r\n-วางแผนกลยุทธ์ในการจัดการพอร์ตการลงทุนเพื่อให้เกิดผลตอบแทนสูงสุดในขณะที่ควบคุมความเสี่ยง\r\n', 'w33.png', '2025-03-21', 2567, 10101, 'Wf33.pdf'),
(1034, 'โครงการวางแผนงบประมาณและการเงินสำหรับธุรกิจขนาดกลาง', 65010912534, '-ศึกษาการวางแผนงบประมาณและการจัดสรรทรัพยากรทางการเงินในธุรกิจขนาดกลาง\r\n-ออกแบบแผนงบประมาณเพื่อจัดการค่าใช้จ่ายและเพิ่มผลกำไรขององค์กร\r\n-ประเมินและปรับแผนการเงินตามผลการดำเนินงานและการเปลี่ยนแปลงในตลาด', 'w34.png', '2025-03-21', 2567, 10101, 'Wf34.pdf'),
(1035, 'โครงการพัฒนาระบบการประเมินมูลค่าองค์กร (Valuation System)', 65010912535, '-ศึกษาวิธีการประเมินมูลค่าองค์กร โดยใช้เทคนิคต่าง ๆ เช่น การประเมินตามกระแสเงินสดที่คาดว่าจะได้รับ (DCF)\r\n-พัฒนาระบบเพื่อช่วยในการประเมินมูลค่าองค์กรและการตัดสินใจซื้อ-ขายธุรกิจ\r\n-ทดสอบและปรับปรุงการใช้เครื่องมือการประเมินให้เหมาะสมกับความต้องการขององค์กร\r\n', 'w35.png', '2025-03-24', 2567, 10101, 'Wf34.pdf'),
(1036, 'โครงการศึกษากลยุทธ์การตลาดระหว่างประเทศในธุรกิจอีคอมเมิร์ซ', 65010912536, '-ศึกษาการตลาดข้ามประเทศและความแตกต่างของพฤติกรรมผู้บริโภคในแต่ละประเทศ\r\n-พัฒนาแผนการตลาดออนไลน์เพื่อรองรับการขยายธุรกิจไปยังตลาดต่างประเทศ\r\n-วิเคราะห์ความท้าทายในการปรับกลยุทธ์การตลาดให้เข้ากับแต่ละตลาด\r\n', 'w36.png', '2025-03-26', 2567, 10101, 'Wf36.pdf'),
(1037, 'โครงการศึกษาความเสี่ยงทางการค้าและการเจรจาข้อตกลงทางการค้า', 65010912537, '-ศึกษาความเสี่ยงที่เกี่ยวข้องกับการทำธุรกิจระหว่างประเทศ เช่น ความเสี่ยงทางการเงิน การเมือง และการเปลี่ยนแปลงของกฎหมาย\r\n-ศึกษาการเจรจาข้อตกลงทางการค้า และวิธีการเจรจาในสภาวะเศรษฐกิจโลกที่เปลี่ยนแปลง\r\n-วิเคราะห์กรณีศึกษาของข้อตกลงการค้าในต่างประเทศและนำเสนอแนวทางจัดการความเสี่ยง', 'w37.png', '2025-03-27', 2567, 10101, 'Wf37.pdf'),
(1038, 'โครงการวิเคราะห์และจัดทำแผนการขยายตลาดในต่างประเทศ', 65010912538, '-ศึกษาและวิเคราะห์ตลาดต่างประเทศเพื่อหาช่องทางการขยายธุรกิจ\r\n-พัฒนากลยุทธ์การขยายตลาด เช่น การเข้าสู่ตลาดใหม่ การปรับผลิตภัณฑ์ให้เหมาะสม หรือการร่วมทุน\r\n-นำเสนอแผนการขยายตลาดและวิธีการเข้าไปเจาะตลาดในประเทศที่มีศักยภาพ\r\n', 'w38.png', '2025-03-28', 2567, 10101, 'Wf38.pdf'),
(1039, 'โครงการศึกษาการนำเข้าและส่งออกในธุรกิจระหว่างประเทศ', 65010912539, '-ศึกษากระบวนการนำเข้าและส่งออกสินค้าและบริการระหว่างประเทศ\r\n-ศึกษากฎหมายและข้อบังคับที่เกี่ยวข้องกับการค้าระหว่างประเทศ รวมถึงภาษีและการควบคุมการนำเข้า\r\n-นำเสนอวิธีการในการเพิ่มประสิทธิภาพและลดต้นทุนในกระบวนการส่งออกและนำเข้าสินค้า\r\n', 'w39.png', '2025-03-29', 2567, 10101, 'Wf39.pdf'),
(1040, 'โครงการพัฒนาความสามารถในการจัดการธุรกิจระหว่างประเทศด้วยเครื่องมือทางเทคโนโลยี', 65010912540, '-ศึกษาการใช้เครื่องมือดิจิทัลและเทคโนโลยีในการบริหารธุรกิจระหว่างประเทศ เช่น การใช้ ERP หรือ CRM ในการบริหารจัดการ\r\n-พัฒนาระบบเพื่อเพิ่มประสิทธิภาพการทำงานและลดความซับซ้อนในการทำธุรกิจระหว่างประเทศ\r\n-นำเสนอแผนการใช้เทคโนโลยีเพื่อขยายฐานลูกค้าและเพิ่มความสามารถในการแข่งขันในตลาดโลก\r\n', 'w40.png', '2025-03-31', 2567, 10101, 'Wf40.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Tec_id` int(11) NOT NULL,
  `Tec_name` varchar(100) DEFAULT NULL,
  `Tec_surname` varchar(100) DEFAULT NULL,
  `Tec_picture` varchar(255) DEFAULT NULL,
  `Major_id` int(11) DEFAULT NULL,
  `Tec_phone` varchar(10) DEFAULT NULL,
  `Tec_email` varchar(100) DEFAULT NULL,
  `Tec_pwd` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`Tec_id`, `Tec_name`, `Tec_surname`, `Tec_picture`, `Major_id`, `Tec_phone`, `Tec_email`, `Tec_pwd`) VALUES
(1101, 'ผู้ช่วยศาสตราจารย์ ดร.อัครวิชช์ ', ' รอบคอบ', 'ผู้ช่วยศาสตราจารย์_ดร_อัครวิชช์__1101.jpg', 101, '084612008', 'phaiboon.r@acc.msu.ac.th', '$2y$10$XJHGH/j5zwGs0EPDuvprzemDzF3iVk1rY9nMBYFX0fBobbtdwroWi'),
(1102, 'อาจารย์ ดร.ศรีรุ่งรัตน์ ', 'สุดสมบูรณ์', 'อาจารย์_ดร_ศรีรุ่งรัตน์__1102.jpg', 101, '043754333', 'sudsomboon@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(1103, 'ผู้ช่วยศาสตราจารย์ ดร.จุฬารัตน์ \r\n', 'ขันแก้ว', 'ผู้ช่วยศาสตราจารย์_ดร_จุฬารัตน์__1103.jpg', 102, '043754333', 'chularat.k@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1104, 'อาจารย์ ดร.ยุทธชัย', 'เกราะแก้ว', 'อาจารย์_ดร_ยุทธชัย_1104.jpg', 102, '0896511884', 'yuthachai.k@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1105, 'อาจารย์ ดร.ณัฐอาภา \r\n', 'สัจจวาที', 'อาจารย์_ดร_ณัฐอาภา__1105.jpg', 103, '0810581116', 'natarpha.s@mbs.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1106, 'อาจารย์ ดร.อนุพงศ์', 'สุขประเสริฐ', 'อาจารย์_ดร_อนุพงศ์_1106.jpg', 103, '0809659451', 'anupong.s@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1107, 'อาจารย์ ดร.ยงยุทธ \r\n', 'รัชตเวชกุล', 'อาจารย์_ดร_ยงยุทธ__1107.jpg', 104, '043754333', 'yongyut.r@msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1108, 'อาจารย์ ดร.อิทธิพล', 'เอี่ยมภูงา', 'อาจารย์_ดร_อิทธิพล_1108.jpg', 104, '0816686404', 'itthiphol.e@mbs.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1109, 'อาจารย์ ดร.วราวรรณ ', 'ชูวิรัช', 'อาจารย์_ดร_วราวรรณ__1109.jpg', 105, '0815594151', 'warawan.c@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1110, 'อาจารย์ ดร.จิรายุ \r\n', 'รัตนบวร', 'อาจารย์_ดร_จิรายุ__1110.jpg', 105, '-', ' jirayu.r@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1111, 'อาจารย์ ดร.สุพัฒตรา \r\n', 'นัดธีร์', 'อาจารย์_ดร_สุพัฒตรา__1111.jpg', 106, '-', 'supattra.n@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1112, 'ผู้ช่วยศาสตราจารย์ ดร.วีระศักดิ์ ', 'สว่างโลก', 'อาจารย์_ดร_วีระศักดิ์__1112.jpg', 106, '0809596582', 'weerasak.sa@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1113, 'ผู้ช่วยศาสตราจารย์ ดร.องอาจ \r\n', 'ชาญประสิทธิ์ชัย \r\n', 'ผู้ช่วยศาสตราจารย์_ดร_องอาจ__1113.jpg', 107, '0819973636', 'ongart.c@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1114, 'อาจารย์ ดร.ชินภัทร ', 'คันธพนิต \r\n', 'อาจารย์_ดร_ชินภัทร__1114.jpg', 107, '0852261833', 'chinapat.k@acc.msu.ac.th', '827ccb0eea8a706c4c34a16891f84e7b'),
(1115, 'อาจารย์ ดร.พงศธร', 'ตันตระบัณฑิตย์ \r\n', 'Tec15.png', 108, '-', '-', '827ccb0eea8a706c4c34a16891f84e7b'),
(1116, 'อาจารย์เบญจมาภรณ์ \r\n', 'สมบัติธีระ \r\n', 'Tec16.png', 108, '-', '-', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminn`
--
ALTER TABLE `adminn`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `advice`
--
ALTER TABLE `advice`
  ADD PRIMARY KEY (`advice_id`),
  ADD KEY `Std_id` (`Std_id`),
  ADD KEY `Company_id` (`Company_id`);

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`advisor_id`),
  ADD KEY `fk_teacher_major` (`Tec_id1`),
  ADD KEY `fk_student_major` (`Std_id`),
  ADD KEY `Tec_id2` (`Tec_id2`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`Bn_id`),
  ADD KEY `Admin_id` (`Admin_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Company_id`),
  ADD KEY `Major_id` (`Major_id`);

--
-- Indexes for table `intro`
--
ALTER TABLE `intro`
  ADD PRIMARY KEY (`Intro_id`);

--
-- Indexes for table `job_offer`
--
ALTER TABLE `job_offer`
  ADD PRIMARY KEY (`Offer_id`),
  ADD KEY `std_id` (`Std_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`Major_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`N_id`),
  ADD KEY `Amin_id` (`Admin_id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`Proposal_id`),
  ADD KEY `Std_id` (`Std_id`),
  ADD KEY `Company_id` (`Company_id`);

--
-- Indexes for table `public_relations`
--
ALTER TABLE `public_relations`
  ADD PRIMARY KEY (`Pr_id`),
  ADD KEY `Company_id` (`Company_id`),
  ADD KEY `Admin_id` (`Admin_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Std_id`),
  ADD KEY `Major_id` (`Major_id`);

--
-- Indexes for table `student_work`
--
ALTER TABLE `student_work`
  ADD PRIMARY KEY (`Work_id`),
  ADD KEY `Std_id` (`Std_id`),
  ADD KEY `Company_id` (`Company_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Tec_id`),
  ADD KEY `Major_id` (`Major_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminn`
--
ALTER TABLE `adminn`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `advice`
--
ALTER TABLE `advice`
  MODIFY `advice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `advisor`
--
ALTER TABLE `advisor`
  MODIFY `advisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `Bn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111107;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `Company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10612;

--
-- AUTO_INCREMENT for table `intro`
--
ALTER TABLE `intro`
  MODIFY `Intro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_offer`
--
ALTER TABLE `job_offer`
  MODIFY `Offer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `Major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `N_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11115;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `Proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11110157;

--
-- AUTO_INCREMENT for table `public_relations`
--
ALTER TABLE `public_relations`
  MODIFY `Pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111148;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Std_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68123444445;

--
-- AUTO_INCREMENT for table `student_work`
--
ALTER TABLE `student_work`
  MODIFY `Work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1055;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Tec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advice`
--
ALTER TABLE `advice`
  ADD CONSTRAINT `advice_ibfk_1` FOREIGN KEY (`Std_id`) REFERENCES `student` (`Std_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advice_ibfk_2` FOREIGN KEY (`Company_id`) REFERENCES `company` (`Company_id`) ON DELETE CASCADE;

--
-- Constraints for table `advisor`
--
ALTER TABLE `advisor`
  ADD CONSTRAINT `advisor_ibfk_1` FOREIGN KEY (`Std_id`) REFERENCES `student` (`Std_id`),
  ADD CONSTRAINT `advisor_ibfk_2` FOREIGN KEY (`Tec_id1`) REFERENCES `teacher` (`Tec_id`),
  ADD CONSTRAINT `fk_student_major` FOREIGN KEY (`Std_id`) REFERENCES `student` (`Std_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_teacher_major` FOREIGN KEY (`Tec_id2`) REFERENCES `teacher` (`Tec_id`) ON DELETE CASCADE;

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `adminn` (`Admin_id`);

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`Major_id`) REFERENCES `major` (`Major_id`);

--
-- Constraints for table `job_offer`
--
ALTER TABLE `job_offer`
  ADD CONSTRAINT `job_offer_ibfk_1` FOREIGN KEY (`Std_id`) REFERENCES `student` (`Std_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `adminn` (`Admin_id`);

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `proposal_ibfk_5` FOREIGN KEY (`Company_id`) REFERENCES `company` (`Company_id`),
  ADD CONSTRAINT `proposal_ibfk_6` FOREIGN KEY (`Std_id`) REFERENCES `student` (`Std_id`);

--
-- Constraints for table `public_relations`
--
ALTER TABLE `public_relations`
  ADD CONSTRAINT `public_relations_ibfk_2` FOREIGN KEY (`Admin_id`) REFERENCES `adminn` (`Admin_id`),
  ADD CONSTRAINT `public_relations_ibfk_3` FOREIGN KEY (`Company_id`) REFERENCES `company` (`Company_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`Major_id`) REFERENCES `major` (`Major_id`);

--
-- Constraints for table `student_work`
--
ALTER TABLE `student_work`
  ADD CONSTRAINT `student_work_ibfk_5` FOREIGN KEY (`Company_id`) REFERENCES `company` (`Company_id`),
  ADD CONSTRAINT `student_work_ibfk_6` FOREIGN KEY (`Std_id`) REFERENCES `student` (`Std_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`Major_id`) REFERENCES `major` (`Major_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
