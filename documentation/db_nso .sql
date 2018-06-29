-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2018 at 11:15 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nso`
--

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `claim_id` int(1) NOT NULL,
  `claim_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claim`
--

INSERT INTO `claim` (`claim_id`, `claim_name`) VALUES
(1, 'แอดมิน'),
(2, 'หัวหน้า'),
(3, 'ผู้ใช้ทั่วไป');

-- --------------------------------------------------------

--
-- Table structure for table `emp_req_form`
--

CREATE TABLE `emp_req_form` (
  `erf_id` int(4) NOT NULL,
  `erf_write_place` varchar(50) NOT NULL COMMENT 'เขียนที่',
  `erf_dateFU` date NOT NULL COMMENT 'วันเดือนปี',
  `erf_toppic` varchar(50) NOT NULL COMMENT 'เรื่อง',
  `erf_requst` varchar(50) NOT NULL COMMENT 'เรียน',
  `erf_name` varchar(50) NOT NULL COMMENT 'ข้าพเจ้า',
  `erf_Codid` varchar(20) NOT NULL COMMENT 'บัตรเลขที่',
  `erf_office` varchar(20) NOT NULL COMMENT ' สำนัก/กอง',
  `erf_income` date NOT NULL COMMENT 'ได้รับการบรรจุเมื่อวันที่',
  `erf_BdateStart_f` date NOT NULL COMMENT 'ขอลาพักผ่อนตั้งแต่วันที่',
  `erf_AdateStart_f` date NOT NULL COMMENT 'ถึงวันที่',
  `erf_num_f` int(2) NOT NULL COMMENT 'มีกำหนด',
  `erf_contact` text NOT NULL COMMENT 'ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่',
  `erf_fhone` varchar(10) NOT NULL COMMENT 'หมายเลขโทรศัพท์',
  `erf_status` int(1) NOT NULL COMMENT 'สถานะ',
  `member_id` int(4) NOT NULL,
  `erf_note` text NOT NULL COMMENT 'หมายเหตุ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ลาพักผ่อนข้าราชการ';

--
-- Dumping data for table `emp_req_form`
--

INSERT INTO `emp_req_form` (`erf_id`, `erf_write_place`, `erf_dateFU`, `erf_toppic`, `erf_requst`, `erf_name`, `erf_Codid`, `erf_office`, `erf_income`, `erf_BdateStart_f`, `erf_AdateStart_f`, `erf_num_f`, `erf_contact`, `erf_fhone`, `erf_status`, `member_id`, `erf_note`) VALUES
(12, '', '2018-05-12', 'ขอลาพักผ่อน', '', 'ณัฐพล พรมเจียม', '', '', '0000-00-00', '2018-05-01', '2018-05-05', 0, '', '', 1, 1, ''),
(13, 'fghdghdghdgh', '2018-05-17', 'ขอลาพักผ่อน', '4565', 'ณัฐพล พรมเจียม45645645', '56546', '', '2018-05-15', '0000-00-00', '0000-00-00', 0, '', '', 1, 1, 'dddddddddddddddd'),
(14, '8678678678', '2018-05-17', 'ขอลาพักผ่อน', '6786786786', 'ณัฐพล พรมเจียม', '786786', '786786', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', '', 2, 1, 'jjjjjjjjjjjjjjjjjjjjj'),
(15, 'asdasdasdasd', '2018-05-17', 'ขอลาพักผ่อน', '78678asad', 'ณัฐพล พรมเจียม', '786786', '', '0000-00-00', '2018-05-21', '0000-00-00', 0, '', '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(4) NOT NULL,
  `fname` varchar(50) NOT NULL COMMENT 'ชื่อ',
  `lname` varchar(50) NOT NULL COMMENT 'นามสกุล',
  `username` varchar(20) NOT NULL COMMENT 'รหัสผู้ใช้',
  `password` varchar(50) NOT NULL COMMENT 'รหัสผ่าน',
  `position` varchar(30) NOT NULL COMMENT 'ตำแหน่ง',
  `department` varchar(30) NOT NULL COMMENT 'สังกัด',
  `level` varchar(50) NOT NULL COMMENT 'ระดับ',
  `claim_id` int(11) NOT NULL COMMENT 'สิทธิเข้าใช้',
  `status` int(1) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `fname`, `lname`, `username`, `password`, `position`, `department`, `level`, `claim_id`, `status`) VALUES
(1, 'ณัฐพล', 'พรมเจียม', 'dodo', '1234', 'ผู้ช่วยงานสถิติ', 'กลุ่มงานสถิติ', 'พนักงานทั่วไป', 3, 1),
(2, 'สุริยะ', 'เต่าทองคำ', 'dindin', '1122', 'นักวิเคราะห์ข้อมูลส่วนกลาง', 'กลุ่มจัดการข้อมูลการศึกษา', 'หัวหน้า', 2, 1),
(3, 'พัชรี', 'วันมงคล', 'patcharee', '147852', 'พนักงานกรมสถิติ', 'กลุ่มงานสถิติ', 'พนักงานทั่วไป', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quit_req_form`
--

CREATE TABLE `quit_req_form` (
  `qrf_id` int(4) NOT NULL,
  `qrf_write_place` varchar(50) NOT NULL COMMENT 'เขียนที่',
  `qrf_dateFU` date NOT NULL COMMENT 'วันเดือนปี',
  `qrf_toppic` varchar(50) NOT NULL COMMENT 'เรื่อง',
  `qrf_requst` varchar(50) NOT NULL COMMENT 'เรียน',
  `qrf_name` varchar(50) NOT NULL COMMENT 'ข้าพเจ้า',
  `qrf_Codid` int(20) NOT NULL COMMENT 'บัตรเลขที่',
  `qrf_office` varchar(50) NOT NULL COMMENT 'สำนัก/กอง',
  `qrf_income` date NOT NULL COMMENT 'ได้รับการบรรจุเมื่อวันที่',
  `qrf_BdateStart_f` date NOT NULL COMMENT 'ขอลาพักผ่อนตั้งแต่วันที่',
  `qrf_AdateStart_f` date NOT NULL COMMENT 'ถึงวันที่',
  `qrf_num_f` int(2) NOT NULL COMMENT 'มีกำหนด',
  `qrf_contact` text NOT NULL COMMENT 'ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่',
  `qrf_fhone` varchar(10) NOT NULL COMMENT 'หมายเลขโทรศัพท์',
  `qrf_status` int(1) NOT NULL COMMENT 'สถานะ',
  `member_id` int(4) NOT NULL,
  `qrf_note` text NOT NULL COMMENT 'หมายเหตุ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quit_req_form`
--

INSERT INTO `quit_req_form` (`qrf_id`, `qrf_write_place`, `qrf_dateFU`, `qrf_toppic`, `qrf_requst`, `qrf_name`, `qrf_Codid`, `qrf_office`, `qrf_income`, `qrf_BdateStart_f`, `qrf_AdateStart_f`, `qrf_num_f`, `qrf_contact`, `qrf_fhone`, `qrf_status`, `member_id`, `qrf_note`) VALUES
(10, '', '2018-05-12', 'ขอลาพักผ่อน', '', 'ณัฐพล พรมเจียม', 0, '', '0000-00-00', '2018-05-01', '2018-05-06', 0, '', '', 1, 1, ''),
(11, 'asdasdas', '2018-05-17', 'ขอลาพักผ่อน', 'asdasdasd', 'ณัฐพล พรมเจียม', 0, 'dasdasda', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', '', 1, 1, 'ddddddddddddddddddddddddddddd'),
(12, '', '2018-05-17', 'ขอลาพักผ่อน', 'gfdgfdg', 'ณัฐพล พรมเจียม', 0, '', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', '', 2, 1, 'ffffffffffffffffffff'),
(13, 'iopiop', '2018-05-17', 'ขอลาพักผ่อน', 'uiouoipiopp', 'ณัฐพล พรมเจียม', 0, '', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(14, 'asdasd', '2018-05-18', 'ขอลาพักผ่อน', 'asdasdasd', 'ณัฐพล พรมเจียม', 0, '', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(15, '', '2018-05-18', 'ขอลาพักผ่อน', 'sdsad', 'ณัฐพล พรมเจียม', 0, 'asdasdasd', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(16, '', '2018-05-18', 'ขอลาพักผ่อน', 'หกดหดหก', 'ณัฐพล พรมเจียม', 0, 'ดกหดหกดหกด', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(17, 'dfsdfdf', '2018-05-18', 'ขอลาพักผ่อน', 'dfdsfsdf', 'ณัฐพล พรมเจียม', 0, 'fsdfsdfsdf', '0000-00-00', '2018-05-22', '0000-00-00', 0, '', '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `request_form`
--

CREATE TABLE `request_form` (
  `rf_id` int(4) NOT NULL,
  `rf_write_place` varchar(50) NOT NULL COMMENT 'เขียนที่',
  `rf_dateFU` date NOT NULL COMMENT 'วันเดือนปี',
  `rf_toppic` varchar(50) NOT NULL COMMENT 'เรื่อง',
  `rf_requst` varchar(50) NOT NULL COMMENT 'เรียน',
  `rf_name` varchar(50) NOT NULL COMMENT 'ข้าพเจ้า',
  `rf_position` varchar(50) NOT NULL COMMENT 'ตำแหน่ง',
  `rf_level` varchar(50) NOT NULL COMMENT 'ระดับ',
  `rf_Codid` varchar(20) NOT NULL COMMENT 'บัตรเลขที่',
  `rf_department` varchar(50) NOT NULL COMMENT 'สังกัด',
  `rf_r2` text NOT NULL COMMENT 'ประเภทที่จะลา',
  `rf_detail` text NOT NULL COMMENT 'รายละเอียดที่ลา',
  `rf_BdateStart_f` date NOT NULL COMMENT 'วันที่ลา',
  `rf_AdateStart_f` date NOT NULL COMMENT 'ลาถึงวันที่',
  `rf_num_f` int(2) NOT NULL COMMENT 'จำนวนวันที่ลา',
  `rf_r3` text NOT NULL COMMENT 'ประเภทที่เคยลา',
  `rf_BdateStart_p` date NOT NULL COMMENT 'วันที่ลาเคยลา',
  `rf_AdateStart_p` date NOT NULL COMMENT 'เคยลาถึงวันที่',
  `rf_num_p` int(2) NOT NULL COMMENT 'จำนวนวันที่เคยลา',
  `rf_contact` text NOT NULL COMMENT 'ติดต่อได้ที่',
  `rf_fhone` text NOT NULL COMMENT 'เบอร์โทร',
  `rf_status` int(1) NOT NULL COMMENT 'สถานะ',
  `member_id` int(4) NOT NULL,
  `rf_note` text NOT NULL COMMENT 'หมายเหตุ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ลาหยุดงาน';

--
-- Dumping data for table `request_form`
--

INSERT INTO `request_form` (`rf_id`, `rf_write_place`, `rf_dateFU`, `rf_toppic`, `rf_requst`, `rf_name`, `rf_position`, `rf_level`, `rf_Codid`, `rf_department`, `rf_r2`, `rf_detail`, `rf_BdateStart_f`, `rf_AdateStart_f`, `rf_num_f`, `rf_r3`, `rf_BdateStart_p`, `rf_AdateStart_p`, `rf_num_p`, `rf_contact`, `rf_fhone`, `rf_status`, `member_id`, `rf_note`) VALUES
(50, '', '2018-05-12', 'ป่วยหนัก', 'fdgdfg', 'ณัฐพล พรมเจียม', 'dfgfdg', '', '', '', '', '', '2018-05-15', '2018-05-17', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 1, 1, ''),
(51, '', '2018-05-12', 'คลื่นไส้อาเจียน', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '2018-05-07', '2018-05-10', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 1, 1, ''),
(52, 'ตึกคอม', '2018-05-12', 'รถคว่ำ เจ็บหนัก ทำงานไม่ไหว', 'รองกมล รุ่งเรืิิอง', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '2018-05-28', '2018-05-31', 4, '', '0000-00-00', '0000-00-00', 0, '', '', 1, 1, ''),
(67, '', '2018-05-16', 'หฟกฟกหเฟกดเหดเหฟดเดเ', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(68, '', '2018-05-16', 'หฟกฟกหเฟกดเหดเหฟดเดเ', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(69, '', '2018-05-16', 'หกดหกดดดดดดดดดดดดดดดดดดดด', 'ดหกดดดดดดดดดดดดดดดดดดดดดดดดดดดด', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 1, 1, 'dsfsdfdsfd'),
(70, '', '2018-05-16', 'หกดหกดดดดดดดดดดดดดดดดดดดด', 'ดหกดดดดดดดดดดดดดดดดดดดดดดดดดดดด', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(72, 'โรงพยาบาลมอบูรพา กรุงเทพ', '2018-05-16', '', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(73, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 2, 0, ''),
(78, '', '2018-05-17', '', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 2, 1, ''),
(79, '', '2018-05-17', 'sdadasdsa', '', 'สุริยะ เต่าทองคำ', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 2, ''),
(80, '', '2018-05-17', '', '', 'สุริยะ เต่าทองคำ', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 2, ''),
(81, '', '2018-05-17', '', '', 'สุริยะ เต่าทองคำ', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 2, ''),
(82, '', '2018-05-18', '', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(83, 'มหาวิทยาลัยบูรพา', '2018-05-18', 'ขออนุญาติลา', '', 'ณัฐพล พรมเจียม', 'พนักงานราชการ', 'ระดับสูง', '', '', 'กิจส่วนตัว', 'กลับบ้านต่างจังหวัด', '2018-05-28', '2018-05-30', 2, 'กิจส่วนตัว', '0000-00-00', '0000-00-00', 2, '85 หมู่ 9 ตำบลทุ่งควายกิน อำเภอแกลง จังหวัดระยอง', '0970740553', 0, 1, ''),
(84, '', '2018-05-18', '', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(85, '', '2018-05-18', '', '', 'สุริยะ เต่าทองคำ', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 2, ''),
(86, 'werwerwer', '2018-05-18', 'srewr', '', 'ณัฐพล พรมเจียม', 'werwer', 'werwerwer', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(87, 'กดหกดหกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกหดหกด', '2018-05-18', '', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(88, 'กดหกดหกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกหดหกด', '2018-05-18', '', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(89, 'sdsdasds', '2018-05-18', 'adsadsad', '', 'ณัฐพล พรมเจียม', 'sdasdasdsad', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(90, 'vdfvdfv', '2018-05-18', 'dfvfdvfdvfdvf', '', 'สุริยะ เต่าทองคำ', 'vdfvfdv', 'dfvdfvdf', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 2, ''),
(91, 'swxwsxwsx', '2018-05-18', 'wsxwsxwsxws', '', 'สุริยะ เต่าทองคำ', 'xwsxwws', 'xwsxwsxw', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 2, ''),
(92, 'sdfsdfsd', '2018-05-18', 'fsdfsdf', '', 'ณัฐพล พรมเจียม', 'sdfsd', 'fsdfsdfsd', '', '', '', 'fsdfsdf', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(93, 'fsdfsdf', '2018-05-18', 'sdfsdf', '', 'สุริยะ เต่าทองคำ', 'fsdfsdfsdsd', 'dfsdfsd', '', '', '', 'fsdfsdfsdfsdf', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 2, ''),
(94, 'sdfsdf', '2018-05-18', 'dsfdsf', '', 'ณัฐพล พรมเจียม', 'sdfsdf', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(95, 'sdfdsfsd', '2018-05-18', 'dfsdf', '', 'ณัฐพล พรมเจียม', 'sdf', 'fsdfsdf', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(96, 'asdads', '2018-05-18', 'sadad', '', 'ณัฐพล พรมเจียม', 'dasdsa', 'dasdasdasdsd', '', '', 'กิจส่วนตัว', 'sdasdas', '2018-05-30', '2018-05-13', 0, 'กิจส่วนตัว', '0000-00-00', '0000-00-00', 0, 'adadw', 'dadwadawd', 0, 1, ''),
(97, 'ssssssssssss', '2018-05-18', 'ssssaaaaaaaaaaa', '', 'ณัฐพล พรมเจียม', 'aaaaaaaa', 'aaaaaaaaaaaaaaaaaaa', '', '', '', 'aaaaaa', '2018-05-23', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(98, 'ssssssssssssssssssssssssss', '2018-05-18', 'ffffffffffffffffffffff', '', 'ณัฐพล พรมเจียม', 'aaaaaaaaaaaaaaaaaaaaaaa', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(99, 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', '2018-05-18', 'gfgggggg', '', 'ณัฐพล พรมเจียม', 'ffffffffffffffff', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(100, 'โดโด หฟกหฟกฟหก', '2018-05-18', 'ไม่โหด แต่่เรียนมา', '', 'ณัฐพล พรมเจียม', 'หฟกหฟกกดดเ้กั้กเ้ดก', 'เ้กเ้กดเ้', '', '', 'กิจส่วนตัว', 'กดเ้กดเ้กด้เ', '2018-05-30', '2018-05-29', 5, 'กิจส่วนตัว', '0000-00-00', '0000-00-00', 9, 'หฟกฟหกฟหก', '0695+95464654', 0, 1, ''),
(101, 'asdasdsdasdsssadasdas', '2018-05-18', 'assada', '', 'ณัฐพล พรมเจียม', 'sdasd', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(102, '', '2018-05-18', '', '', 'ณัฐพล พรมเจียม', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', 0, '', '', 0, 1, ''),
(103, 'sdasdasd', '2018-05-18', 'asdasd', '', 'ณัฐพล พรมเจียม', 'asdasdas', 'dasdasdas', '', '', '', 'dasdasdasdasd', '2018-05-30', '2018-05-21', 5, 'คลอดบุตร', '0000-00-00', '0000-00-00', 0, 'sdasd', '560465498', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `table_work_boss`
--

CREATE TABLE `table_work_boss` (
  `twb_id` int(5) NOT NULL,
  `twb_title` varchar(200) NOT NULL COMMENT 'เรื่องหรือรายละเอียด',
  `twb_start` datetime NOT NULL COMMENT 'วันเวลาเริ่ม',
  `twb_end` datetime NOT NULL COMMENT 'วันเวลาสิ้นสุด',
  `member_id` int(4) NOT NULL COMMENT 'คนสร้างข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_work_boss`
--

INSERT INTO `table_work_boss` (`twb_id`, `twb_title`, `twb_start`, `twb_end`, `member_id`) VALUES
(1, 'dfdfsdfsf', '2018-05-17 16:00:00', '2018-05-17 16:30:00', 0),
(3, 'ฃานหัวหน้า', '2018-05-20 07:00:00', '2018-05-24 07:00:00', 0),
(6, 'dfgfdgdfgfdgfdgfdg', '2018-06-04 07:00:00', '2018-06-05 07:00:00', 0),
(7, 'dgdfgdfg', '2018-05-18 07:00:00', '2018-05-19 07:00:00', 0),
(8, 'dasd', '2018-04-30 07:00:00', '2018-05-01 07:00:00', 0),
(9, 'กินข้าว', '2018-05-01 07:00:00', '2018-05-02 07:00:00', 0),
(10, 'w22s2s', '2018-05-24 07:00:00', '2018-05-25 07:00:00', 0),
(11, '2wsw2s2ws', '2018-05-29 07:00:00', '2018-06-03 07:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `training_form`
--

CREATE TABLE `training_form` (
  `tf_id` int(5) NOT NULL,
  `tf_toppic` varchar(100) NOT NULL COMMENT 'เรื่อง',
  `tf_name` varchar(50) NOT NULL COMMENT 'ชื่อ',
  `tf_position` varchar(50) NOT NULL COMMENT 'ตำแหน่ง',
  `tf_level` varchar(50) NOT NULL COMMENT 'ระดีับ',
  `tf_date_start` date NOT NULL COMMENT 'วันออกปฏิบัติหน้าที่',
  `tf_date_end` date NOT NULL COMMENT 'ถึงวันที่',
  `tf_file` text NOT NULL COMMENT 'path file',
  `tf_num` int(2) NOT NULL COMMENT 'จำนวนวันลา',
  `member_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training_form`
--

INSERT INTO `training_form` (`tf_id`, `tf_toppic`, `tf_name`, `tf_position`, `tf_level`, `tf_date_start`, `tf_date_end`, `tf_file`, `tf_num`, `member_id`) VALUES
(3, '', 'สุริยะ เต่าทองคำ', '', '', '0000-00-00', '0000-00-00', '', 0, 2),
(4, '', 'สุริยะ เต่าทองคำ', '', '', '0000-00-00', '0000-00-00', '', 0, 2),
(5, '', 'สุริยะ เต่าทองคำ', '', '', '0000-00-00', '0000-00-00', '', 0, 2),
(6, '', 'สุริยะ เต่าทองคำ', '', '', '0000-00-00', '0000-00-00', '', 50, 2),
(7, 'dsfsdf', 'ณัฐพล พรมเจียม', 'sdfsdfsdf', 'sdfsdfsdf', '2018-05-25', '2018-05-28', '', 511, 1),
(8, 'ขอไปดูงานนอกสถานที่', 'ณัฐพล พรมเจียม', 'ข้าราชการ', 'พื้นฐาน', '2018-05-27', '2018-05-29', '../filework/sample-file (4).pdf', 30, 1),
(9, '', 'สุริยะ เต่าทองคำ', '', '', '0000-00-00', '0000-00-00', '', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`claim_id`);

--
-- Indexes for table `emp_req_form`
--
ALTER TABLE `emp_req_form`
  ADD PRIMARY KEY (`erf_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `quit_req_form`
--
ALTER TABLE `quit_req_form`
  ADD PRIMARY KEY (`qrf_id`);

--
-- Indexes for table `request_form`
--
ALTER TABLE `request_form`
  ADD PRIMARY KEY (`rf_id`);

--
-- Indexes for table `table_work_boss`
--
ALTER TABLE `table_work_boss`
  ADD PRIMARY KEY (`twb_id`);

--
-- Indexes for table `training_form`
--
ALTER TABLE `training_form`
  ADD PRIMARY KEY (`tf_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `claim_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_req_form`
--
ALTER TABLE `emp_req_form`
  MODIFY `erf_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quit_req_form`
--
ALTER TABLE `quit_req_form`
  MODIFY `qrf_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `request_form`
--
ALTER TABLE `request_form`
  MODIFY `rf_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `table_work_boss`
--
ALTER TABLE `table_work_boss`
  MODIFY `twb_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `training_form`
--
ALTER TABLE `training_form`
  MODIFY `tf_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
