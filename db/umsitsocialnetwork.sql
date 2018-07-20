-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2017 at 04:54 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umsitsocialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `firstPersonId` int(30) NOT NULL,
  `secondPersonId` int(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `del1` int(30) NOT NULL,
  `del2` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `firstPersonId` (`firstPersonId`),
  KEY `secondPersonId` (`secondPersonId`)
) ENGINE=InnoDB AUTO_INCREMENT=1140 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `firstPersonId`, `secondPersonId`, `date`, `del1`, `del2`) VALUES
(1120, 3, 4, '03:53 AM 20-07-16', 0, 0),
(1125, 11, 1, '02:47 AM 14-08-16', 0, 0),
(1126, 11, 12, '02:59 AM 14-08-16', 0, 0),
(1130, 1, 4, '11:03 PM 16-08-16', 1, 0),
(1131, 1, 22, '06:00 PM 20-08-16', 1, 0),
(1132, 3, 1, '04:07 AM 22-08-16', 0, 1),
(1133, 1, 31, '04:08 AM 27-08-16', 1, 0),
(1136, 1, 12, '12:41 AM 5-09-16', 1, 0),
(1137, 1, 29, '03:19 AM 5-11-16', 1, 0),
(1138, 1, 43, '10:51 PM 16-11-16', 0, 0),
(1139, 1, 44, '02:04 AM 17-11-16', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eventalert`
--

DROP TABLE IF EXISTS `eventalert`;
CREATE TABLE IF NOT EXISTS `eventalert` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) NOT NULL,
  `alertReciever` varchar(30) NOT NULL,
  `alertGeneratorId` int(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `int` (`id`),
  KEY `alertGeneratorId` (`alertGeneratorId`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventalert`
--

INSERT INTO `eventalert` (`id`, `event`, `alertReciever`, `alertGeneratorId`, `date`) VALUES
(60, 'Sports week on 1st December', '*', 1, '07:35 PM 21-10-16'),
(61, 'Gala on 1st January.....', 'Business', 1, '07:35 PM 21-10-16'),
(62, 'External will be on 17 nov', 'CS & IT', 11, '09:03 AM 15-11-16'),
(63, 'gala', 'Banking', 1, '06:24 AM 14-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `eventgallery`
--

DROP TABLE IF EXISTS `eventgallery`;
CREATE TABLE IF NOT EXISTS `eventgallery` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(255) NOT NULL,
  `photoName` varchar(200) NOT NULL,
  `photoUploaderId` int(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `photoUploaderId` (`photoUploaderId`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventgallery`
--

INSERT INTO `eventgallery` (`id`, `eventName`, `photoName`, `photoUploaderId`, `date`) VALUES
(37, 'friends', '1233393_514578848619907_465014334_n.jpg', 1, '10:31 AM 16-08-16'),
(38, 'friends', 'IMG_20131102_153338.jpg', 1, '10:31 AM 16-08-16'),
(41, 'friends', 'IMG_20140111_105907.jpg', 1, '10:31 AM 16-08-16'),
(42, 'friends', 'IMG_20140115_144552.jpg', 1, '10:31 AM 16-08-16'),
(45, 'friends', 'IMG_20131219_152900.jpg', 1, '06:38 AM 18-08-16'),
(46, 'gulpur trip', 'IMG_20140106_124817.jpg', 1, '06:51 AM 18-08-16'),
(47, 'gulpur trip', 'IMG_20140106_124945.jpg', 1, '06:51 AM 18-08-16'),
(51, 'Friends', '339388_382868741801081_1731599821_o.jpg', 11, '09:02 AM 15-11-16'),
(52, 'Friends', '381804_111978638920256_880038962_n.jpg', 11, '09:02 AM 15-11-16'),
(53, 'Friends', '391932_138549532921440_1165731599_n.jpg', 11, '09:02 AM 15-11-16'),
(54, 'Friends', '417699_351323994985718_127002812_n.jpg', 11, '09:02 AM 15-11-16'),
(55, 'Friends', '893983_165960463561120_780882843_o.jpg', 11, '09:02 AM 15-11-16'),
(56, 'Friends', '1090937_1385338048390574_2116677491_o.jpg', 11, '09:02 AM 15-11-16'),
(57, 'Friends', '1400534_626489800726108_36905096_o.jpg', 11, '09:02 AM 15-11-16'),
(58, 'Friends', '1501341_1450933178452760_1637239717_o.jpg', 11, '09:02 AM 15-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `password` varchar(30) NOT NULL,
  `lastseen` varchar(30) NOT NULL,
  `cnic` varchar(13) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position` varchar(30) NOT NULL,
  `ban` varchar(2) NOT NULL,
  `department` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `securityQuestion` varchar(255) NOT NULL,
  `answer` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `cnic` (`cnic`),
  UNIQUE KEY `email` (`email`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `firstName`, `lastName`, `email`, `phone`, `password`, `lastseen`, `cnic`, `dob`, `gender`, `position`, `ban`, `department`, `city`, `securityQuestion`, `answer`) VALUES
(1, 'Muhammad', 'Yasir', 'ymalik689@gmail.com', '923415032045', 'admin', '03:15 AM 4-02-17', '81202', '23-03-1993', 'Male', 'Admin', '0', 'CS & IT', 'Mirpur', '0', '0'),
(3, 'Muhammad Rizwan', 'Aslam', 'rizwan1@hotmail.com', '0', 'admin', '09:14 AM 26-08-16', '81205', '21-12-1992', 'male', 'Student', '0', 'Business', '', '0', '0'),
(4, 'Umair', 'Abrar', 'umalik', '0', 'admin', '0', '83023', '21/03/1994', 'male', 'Teacher', '0', 'Business', '', '0', '0'),
(11, 'Ehsan', 'Ali', 'ehsan1@gmail.com', '0', 'admin', '06:23 AM 14-12-16', '213213', '21/03/1995', 'Male', 'Staff', '0', 'Banking', 'Mirpur', '0', '0'),
(12, 'Usman', 'faryad', 'usman1@gmail.com', '0', 'admin', '04:11 AM 4-09-16', '81209', '23/3/1993', 'male', 'Staff', '0', 'Banking', '', '0', '0'),
(22, 'javaid', 'malik', 'ymalik83@gmail.com', '314', 'admin', '0', '81204', '2016-08-25', 'male', 'Teacher', '0', 'Math', 'kotli', 'Place of Birth?', 'kotli'),
(29, 'amjad', 'khan', 'unknown@hotmail.com', '0341510', 'admin', '0', '23324', '2012-11-30', 'male', 'Student', '0', 'Math', 'mirpur', 'Favourite Place?', 'naran'),
(31, 'faizan', 'malik', 'muhammad@hotmail.com', '03415335353', 'admin', '0', '82322', '2012-11-01', 'male', 'Teacher', '0', 'Banking', 'kotli', 'Favourite Movie', 'veer'),
(43, 'owais', 'khan', 'abc@yahoo.com', '923411111112', 'admina', '02:08 AM 17-11-16', '8120250508090', '1996-12-28', 'male', 'Staff', '0', 'Banking', 'kotli', 'Place of Birth?', 'mirpur'),
(44, 'sajid', 'malik', 'ymalik101@hotmail.com', '923415023232', 'admin1', '0', '8120250408989', '1995-11-30', 'male', 'Teacher', '0', 'Banking', 'Mirpur', 'Place of Birth?', 'mipur'),
(45, 'Owais', 'Khan', 'abc@gmail.com', '923415032045', 'admin1', '0', '8120250408987', '2014-12-31', 'male', 'Student', '0', 'Math', 'kotli', 'Place of Birth?', 'mirpur');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `conversationId` int(30) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `senderId` int(30) NOT NULL,
  `senderName` varchar(30) NOT NULL,
  `recieverId` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `date` varchar(30) NOT NULL,
  `del1` int(1) NOT NULL,
  `del2` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `senderId` (`senderId`),
  KEY `conversationId` (`conversationId`),
  KEY `recieverId` (`recieverId`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `conversationId`, `message`, `senderId`, `senderName`, `recieverId`, `status`, `date`, `del1`, `del2`) VALUES
(135, 1125, '?\n', 11, 'Ehsan Ali', 1, 0, '12:06 AM 16-08-16', 0, 1),
(136, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '02:55 AM 16-08-16', 0, 1),
(137, 1125, '?\n', 11, 'Ehsan Ali', 1, 0, '02:55 AM 16-08-16', 0, 1),
(138, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '10:54 PM 16-08-16', 0, 1),
(139, 1130, 'hi\n', 1, 'Muhammad Yasir', 4, 1, '11:03 PM 16-08-16', 1, 0),
(142, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '03:55 AM 20-08-16', 0, 1),
(143, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '03:55 AM 20-08-16', 0, 1),
(145, 1125, 'ghg\n', 1, 'Muhammad Yasir', 11, 0, '02:56 AM 22-08-16', 0, 1),
(146, 1132, 'hi\n', 3, 'Muhammad Rizwan Aslam', 1, 0, '04:34 AM 22-08-16', 0, 0),
(150, 1133, 'hi\n', 1, 'Muhammad Yasir', 31, 1, '05:45 PM 28-08-16', 1, 0),
(151, 1133, '?\n', 1, 'Muhammad Yasir', 31, 1, '05:45 PM 28-08-16', 1, 0),
(152, 1133, 'where r u?\n', 1, 'Muhammad Yasir', 31, 1, '05:45 PM 28-08-16', 1, 0),
(157, 1133, 'hi', 1, 'Muhammad Yasir', 31, 1, '10:25 AM 31-08-16', 1, 0),
(158, 1133, '?', 1, 'Muhammad Yasir', 31, 1, '10:25 AM 31-08-16', 1, 0),
(160, 1133, 'hi', 1, 'Muhammad Yasir', 31, 1, '10:36 AM 31-08-16', 1, 0),
(162, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '12:35 AM 4-09-16', 0, 1),
(169, 1136, 'hi\n', 1, 'Muhammad Yasir', 12, 1, '12:41 AM 5-09-16', 1, 0),
(170, 1136, '?\n', 1, 'Muhammad Yasir', 12, 1, '05:22 AM 7-09-16', 1, 0),
(171, 1133, 'hjh\n', 1, 'Muhammad Yasir', 31, 1, '11:34 PM 3-04-16', 1, 0),
(172, 1133, '\n', 1, 'Muhammad Yasir', 31, 1, '11:34 PM 3-04-16', 1, 0),
(173, 1125, 'g\n', 11, 'Ehsan Ali', 1, 0, '06:42 PM 13-10-16', 0, 1),
(174, 1125, 'ok\n', 11, 'Ehsan Ali', 1, 0, '06:42 PM 13-10-16', 0, 1),
(175, 1136, 'hu', 1, 'Muhammad Yasir', 12, 1, '11:39 PM 14-10-16', 1, 0),
(176, 1125, 'HI\n', 1, 'Muhammad Yasir', 11, 0, '12:03 AM 17-10-16', 0, 0),
(177, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '12:03 AM 17-10-16', 0, 0),
(178, 1125, 'DF\n', 1, 'Muhammad Yasir', 11, 0, '12:03 AM 17-10-16', 0, 0),
(179, 1125, 'WHERE \n', 1, 'Muhammad Yasir', 11, 0, '12:03 AM 17-10-16', 0, 11),
(180, 1125, 'HELLO\n', 1, 'Muhammad Yasir', 11, 0, '12:03 AM 17-10-16', 0, 11),
(181, 1125, 'HIE\n', 1, 'Muhammad Yasir', 11, 0, '12:03 AM 17-10-16', 0, 11),
(182, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '12:03 AM 17-10-16', 0, 11),
(183, 1125, '?', 1, 'Muhammad Yasir', 11, 0, '07:41 PM 21-10-16', 0, 11),
(185, 1137, 'hi\n', 1, 'Muhammad Yasir', 29, 1, '03:19 AM 5-11-16', 1, 0),
(186, 1125, '?\n', 1, 'Muhammad Yasir', 11, 0, '08:58 AM 15-11-16', 0, 11),
(187, 1125, 'kkk', 1, 'Muhammad Yasir', 11, 0, '10:45 PM 16-11-16', 0, 0),
(188, 1125, 'jhjh', 1, 'Muhammad Yasir', 11, 0, '10:45 PM 16-11-16', 0, 0),
(189, 1138, 'hi\n', 1, 'Muhammad Yasir', 43, 0, '10:51 PM 16-11-16', 0, 0),
(190, 1138, 'hi\n', 1, 'Muhammad Yasir', 43, 0, '10:52 PM 16-11-16', 0, 0),
(191, 1138, 'hi\n', 43, 'owais khan', 1, 0, '10:53 PM 16-11-16', 0, 0),
(192, 1138, 'hi\n', 1, 'Muhammad Yasir', 43, 0, '02:06 AM 17-11-16', 0, 0),
(193, 1138, 'hi\n', 43, 'owais khan', 1, 0, '02:07 AM 17-11-16', 0, 0),
(194, 1125, 'hjgjg\n', 1, 'Muhammad Yasir', 11, 0, '06:21 AM 14-12-16', 0, 0),
(195, 1125, 'hjsfl\n', 1, 'Muhammad Yasir', 11, 0, '06:23 AM 14-12-16', 0, 0),
(196, 1125, 'iui\n', 1, 'Muhammad Yasir', 11, 1, '03:04 AM 4-02-17', 0, 0),
(197, 1125, '\n', 1, 'Muhammad Yasir', 11, 1, '03:04 AM 4-02-17', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profilepic`
--

DROP TABLE IF EXISTS `profilepic`;
CREATE TABLE IF NOT EXISTS `profilepic` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picHolderId` int(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `currentStatus` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `picHolderId` (`picHolderId`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilepic`
--

INSERT INTO `profilepic` (`id`, `name`, `picHolderId`, `date`, `currentStatus`) VALUES
(32, 'IMG_20140106_110812.jpg', 11, '21', 'active'),
(33, 'IMG_20131219_153432.jpg', 11, '21', 'inactive'),
(34, 'IMG_20140101_101900.jpg', 11, '21', 'inactive'),
(36, 'IMG_20140106_110556.jpg', 11, '21', 'inactive'),
(38, '6851997-danbo-wallpaper.jpg', 1, '06:32 PM 21-10-16', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `statusPosterId` int(30) NOT NULL,
  `posterName` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statusPosterId` (`statusPosterId`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `statusPosterId`, `posterName`, `date`) VALUES
(23, 'hi', 11, 'Ehsa Al', '09:05 PM 8-08-16'),
(47, '?', 3, 'Muhammad Rizwan Aslam', '09:24 PM 18-08-16'),
(53, 'hi', 3, 'Muhammad Rizwan Aslam', '01:40 AM 22-08-16'),
(55, 'hello', 1, 'Muhammad Yasir', '10:44 PM 16-11-16'),
(57, 'hello', 1, 'Muhammad Yasir', '02:03 AM 17-11-16'),
(58, 'hghjg', 1, 'Muhammad Yasir', '06:21 AM 14-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `statuscomment`
--

DROP TABLE IF EXISTS `statuscomment`;
CREATE TABLE IF NOT EXISTS `statuscomment` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `commenterId` int(30) NOT NULL,
  `commenterName` varchar(30) NOT NULL,
  `statusId` int(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statusId` (`statusId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuscomment`
--

INSERT INTO `statuscomment` (`id`, `commenterId`, `commenterName`, `statusId`, `date`, `comment`) VALUES
(5, 1, 'Muhammad Yasir', 53, '03:18 AM 5-11-16', 'hi?');

-- --------------------------------------------------------

--
-- Table structure for table `statuslike`
--

DROP TABLE IF EXISTS `statuslike`;
CREATE TABLE IF NOT EXISTS `statuslike` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `likerId` int(30) NOT NULL,
  `likerName` varchar(30) NOT NULL,
  `statusId` int(30) NOT NULL,
  `likes` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statusId` (`statusId`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuslike`
--

INSERT INTO `statuslike` (`id`, `likerId`, `likerName`, `statusId`, `likes`) VALUES
(45, 3, 'Muhammad Rizwan Aslam', 53, 1),
(101, 1, 'Muhammad Yasir', 47, 1),
(107, 1, 'Muhammad Yasir', 53, 1),
(109, 11, 'Ehsan Ali', 53, 1),
(110, 1, 'Muhammad Yasir', 58, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`firstPersonId`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`secondPersonId`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventalert`
--
ALTER TABLE `eventalert`
  ADD CONSTRAINT `eventalert_ibfk_1` FOREIGN KEY (`alertGeneratorId`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventgallery`
--
ALTER TABLE `eventgallery`
  ADD CONSTRAINT `eventgallery_ibfk_1` FOREIGN KEY (`photoUploaderId`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`conversationId`) REFERENCES `conversation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profilepic`
--
ALTER TABLE `profilepic`
  ADD CONSTRAINT `profilepic_ibfk_1` FOREIGN KEY (`picHolderId`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`statusPosterId`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `statuscomment`
--
ALTER TABLE `statuscomment`
  ADD CONSTRAINT `statuscomment_ibfk_1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `statuslike`
--
ALTER TABLE `statuslike`
  ADD CONSTRAINT `statuslike_ibfk_1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
