-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2015 at 08:10 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseId` int(11) NOT NULL AUTO_INCREMENT,
  `courseCode` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `programLead` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`courseId`),
  UNIQUE KEY `courseCode` (`courseCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='University Course Record' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `moduleId` int(11) NOT NULL AUTO_INCREMENT,
  `moduleCode` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `moduleLeader` varchar(100) NOT NULL,
  `courseCode` varchar(100) NOT NULL,
  PRIMARY KEY (`moduleId`),
  UNIQUE KEY `moduleCode` (`moduleCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='University Modules Records' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:Inactive, 1:Active',
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Roles for different access right privileges to users' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`, `status`) VALUES
(1, 'Admin', 1),
(2, 'Staff', 1),
(3, 'Student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `roomId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` varchar(500) NOT NULL,
  `building` varchar(10) NOT NULL,
  `level` int(11) NOT NULL COMMENT '1: uni room, 2: dept. room, 3: faculty room, 4: direc. room',
  `type` int(11) NOT NULL COMMENT '1: Lecture, 2: Lab, 3: Meeting Room, 4: Computer Room',
  `capacity` int(11) NOT NULL,
  `incharge` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '-1: Deleted, 0: inactive, 1: Active',
  `permission` int(11) NOT NULL COMMENT '0: No Permission Required, 1: Contact Incharge',
  `note` text NOT NULL,
  PRIMARY KEY (`roomId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='University Room Record' AUTO_INCREMENT=21 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomId`, `name`, `location`, `building`, `level`, `type`, `capacity`, `incharge`, `status`, `permission`, `note`) VALUES
(1, 'RoomA1', 'Wheatley', 'C', 1, 1, 50, 'Mitchell', 1, 1, ''),
(2, 'RoomA2', 'Wheatley', 'C', 2, 1, 50, 'Null', 1, 0, ''),
(3, 'RoomA3', 'Wheatley', 'D', 3, 1, 50, 'f1', 1, 1, ''),
(4, 'RoomA4', 'Wheatley', 'D', 4, 1, 50, 'Mitchell', 1, 0, ''),
(5, 'RoomA5', 'Wheatley', 'D', 1, 1, 50, 'Null', 1, 0, ''),
(6, 'RoomA6', 'Wheatley', 'E', 2, 1, 50, 'Mitchell', 1, 0, ''),
(7, 'RoomA7', 'Wheatley', 'E', 3, 1, 50, 'Cox', 1, 0, ''),
(8, 'RoomA8', 'Wheatley', 'E', 4, 1, 50, 'Mitchell', 1, 0, ''),
(9, 'RoomA9', 'Wheatley', 'E', 1, 1, 10, 'Duce', 1, 0, ''),
(10, 'RoomA10', 'Wheatley', 'F', 2, 3, 10, 'Cox', 1, 0, ''),
(11, 'RoomA11', 'Wheatley', 'F', 3, 2, 10, 'Mitchell', 1, 0, ''),
(12, 'RoomA12', 'Wheatley', 'F', 4, 2, 10, 'Mitchell', 1, 0, ''),
(13, 'RoomA13', 'Wheatley', 'F', 1, 2, 50, 'Mitchell', 1, 0, ''),
(14, 'RoomB1', 'Wheatley', 'F', 2, 2, 25, 'Mitchell', 1, 0, ''),
(15, 'RoomB2', 'Headington', 'G', 3, 2, 25, 'Null', 1, 0, ''),
(16, 'RoomB3', 'Headington', 'G', 4, 2, 25, 'Duce', 1, 0, ''),
(17, 'RoomB4', 'Headington', 'G', 1, 2, 25, 'Null', 1, 0, ''),
(18, 'RoomB5', 'Wheatley', 'G', 2, 2, 25, 'Mitchell', 1, 0, ''),
(19, 'RoomB6', 'Wheatley', 'G', 3, 2, 25, 'Cox', 1, 0, ''),
(20, 'RoomB7', 'Wheatley', 'G', 4, 2, 25, 'Mitchell', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

CREATE TABLE IF NOT EXISTS `room_booking` (
  `bookingId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(100) NOT NULL,
  `roomId` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `status` int(11) NOT NULL COMMENT '-2: Deleted, -1: Cancelled, 0: Approval Pending, 1: Booked/Approved',
  `purpose` text NOT NULL,
  `approvedBy` varchar(100) NOT NULL,
  `initiatedOn` datetime NOT NULL,
  `bookedOn` datetime NOT NULL,
  PRIMARY KEY (`bookingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Room Booking & Request Table' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `room_booking`
--

INSERT INTO `room_booking` (`bookingId`, `userId`, `roomId`, `bookingDate`, `startTime`, `endTime`, `status`, `purpose`, `approvedBy`, `initiatedOn`, `bookedOn`) VALUES
(1, 's1', 1, '2015-04-09', '23:00:00', '23:59:00', 1, 'Lecture', 'admin', '2015-04-07 00:00:00', '2015-04-07 00:00:00'),
(2, 's1', 2, '2015-04-08', '15:00:00', '17:00:00', -1, 'Meeting', 'admin', '2015-04-07 00:00:00', '2015-04-07 00:00:00'),
(3, 's1', 3, '2015-04-09', '23:00:00', '23:59:00', 0, 'Test', '', '2015-04-09 00:00:00', '0000-00-00 00:00:00'),
(4, 's1', 12, '2015-04-12', '10:00:00', '13:00:00', 1, 'Test', 'admin', '2015-04-09 00:00:00', '2015-04-09 00:00:00'),
(6, 's1', 4, '2015-04-14', '03:40:00', '04:40:00', 1, 'test2', 'admin', '2015-04-13 03:44:20', '2015-04-13 03:44:20'),
(7, 'f1', 3, '2015-04-21', '04:10:00', '05:10:00', 0, '', '', '2015-04-19 04:13:32', '0000-00-00 00:00:00'),
(8, 'f1', 2, '2015-04-22', '04:20:00', '05:20:00', -1, '', 'admin', '2015-04-19 04:21:58', '2015-04-19 04:21:58'),
(9, 'f1', 2, '2015-04-22', '04:20:00', '05:20:00', 1, '', 'admin', '2015-04-19 04:24:36', '2015-04-19 04:24:36'),
(10, 's1', 1, '2015-04-29', '07:40:00', '08:40:00', 0, '', '', '2015-04-19 07:43:37', '0000-00-00 00:00:00'),
(11, 's1', 3, '2015-04-23', '07:45:00', '08:45:00', 0, '', '', '2015-04-19 07:46:29', '0000-00-00 00:00:00'),
(12, 'f1', 2, '2015-04-22', '07:55:00', '08:55:00', 1, '', 'admin', '2015-04-19 07:55:19', '2015-04-19 07:55:19'),
(13, 's1', 7, '2015-04-29', '08:00:00', '09:00:00', 1, '', 'admin', '2015-04-19 08:03:32', '2015-04-19 08:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `room_level`
--

CREATE TABLE IF NOT EXISTS `room_level` (
  `levelId` int(11) NOT NULL AUTO_INCREMENT,
  `levelName` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: Inactive, 1: Active',
  PRIMARY KEY (`levelId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `room_level`
--

INSERT INTO `room_level` (`levelId`, `levelName`, `status`) VALUES
(1, 'University Room', 1),
(2, 'Dept. Room', 1),
(3, 'Faculty Room', 1),
(4, 'Direc. Room', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
  `typeId` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: Inactive, 1: Active',
  PRIMARY KEY (`typeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`typeId`, `type`, `status`) VALUES
(1, 'Lecture Room', 1),
(2, 'Practical Room', 1),
(3, 'Meeting Room', 1),
(4, 'Computer Lab', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moduleCode` varchar(100) NOT NULL,
  `roomId` int(11) NOT NULL,
  `weekDay` varchar(200) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `type` int(11) NOT NULL COMMENT '1: Lecture, 2: Lab, 3: Meeting',
  `status` int(11) NOT NULL COMMENT '0: Inactive, 1: Active',
  `incharge` varchar(100) NOT NULL,
  `exception` varchar(500) NOT NULL,
  `repeatOn` int(11) NOT NULL COMMENT '0: No Repeat, 1: Every Week',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='University''s Timetable' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `userName` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `contact` bigint(11) NOT NULL,
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User''s Basic Deatils';

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userName`, `name`, `emailId`, `contact`) VALUES
('admin', 'OBU BBS Admin', 'bbs@brookes.ac.uk', 900990),
('f1', 'Dummy Faculty', 'f1@brookes.ac.uk', 898999),
('s1', 'Abc Student', 'abc.st@brookes.ac,uk', 787888988);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `roleId` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: Inactive, 1:Active',
  `lastLoginAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `studentNo` (`userName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='User''s Login Details' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `userName`, `password`, `roleId`, `status`, `lastLoginAt`) VALUES
(1, 'admin', '9b430c0031f645b56dcb6214df5e34f4', 1, 1, '0000-00-00 00:00:00'),
(2, 'f1', '202cb962ac59075b964b07152d234b70', 2, 1, '0000-00-00 00:00:00'),
(3, 's1', '202cb962ac59075b964b07152d234b70', 3, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_staff_info`
--

CREATE TABLE IF NOT EXISTS `user_staff_info` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `staffNumber` varchar(200) NOT NULL,
  `office` varchar(500) NOT NULL,
  `department` varchar(900) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_staff_info`
--

INSERT INTO `user_staff_info` (`sno`, `staffNumber`, `office`, `department`) VALUES
(1, 'f1', 'T1.27', 'Computing');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
