-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2014 at 02:44 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jobpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoinment`
--

CREATE TABLE IF NOT EXISTS `appoinment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_uid` int(11) DEFAULT NULL,
  `for_uid` int(11) DEFAULT NULL,
  `app_date_time` datetime DEFAULT NULL,
  `app_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `from_uid` (`from_uid`),
  KEY `for_uid` (`for_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryname`) VALUES
(62, 'Accounting'),
(63, 'Chemical'),
(64, 'Software Development'),
(65, 'Software Testing'),
(66, 'It Support'),
(67, 'Hardware & Networking');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `category`, `image`) VALUES
(9, 'Tcs', 'Software Testing', '2014-12-20-14-43-48.jpg'),
(10, 'Yash Technology', 'Software Testing', '2014-12-20-14-43-58.jpeg'),
(11, 'Accenture', 'Accounting', '2014-12-20-14-43-40.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `graduation` varchar(255) DEFAULT NULL,
  `gra_year` int(11) DEFAULT NULL,
  `post_graduation` varchar(255) DEFAULT NULL,
  `pg_year` int(11) DEFAULT NULL,
  `doctorate_phd` varchar(255) DEFAULT NULL,
  `dr_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `uid`, `graduation`, `gra_year`, `post_graduation`, `pg_year`, `doctorate_phd`, `dr_year`) VALUES
(1, 13, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 14, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`) VALUES
(1, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `personaldetails`
--

CREATE TABLE IF NOT EXISTS `personaldetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `profilepic` varchar(255) DEFAULT NULL,
  `about_me` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `fb_id` varchar(255) DEFAULT NULL,
  `tw_id` varchar(255) DEFAULT NULL,
  `gplus_id` varchar(255) DEFAULT NULL,
  `linkd_id` varchar(255) DEFAULT NULL,
  `u_tube_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL,
  `active_state` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `firstname`, `lastname`, `gender`, `email`, `password`, `image`, `user_type`, `reg_date`, `active_state`) VALUES
(7, 'rohit', 'malviya', 'Male', 'rohit@gmail.com', '123456', '', 'Jobseeker', '2014-12-13 10:50:08', '0'),
(8, 'bharat', 'Prajapat', 'Male', 'bharat@gmail.com', '123456', '', 'Mentor', '2014-12-13 10:50:52', '0'),
(9, 'ritesh', 'singhh', 'Male', 'ritesh@gmail.com', '123456', '', 'Mentor', '2014-12-13 10:51:56', '0'),
(12, 'Admin', '', '', 'admin@gmail.com', '123456', '2014-12-19-15-28-03.jpg', 'Admin', '0000-00-00 00:00:00', '1'),
(13, 'Mentor', 'Demo', 'Male', 'mentor@gmail.com', '123456', '2014-12-18-13-27-48.jpg', 'Mentor', '2014-12-18 13:20:57', '1'),
(14, 'Jobseeker', 'Demo', 'Female', 'jobseeker@gmail.com', '123456', '2014-12-18-13-28-26.jpg', 'Jobseeker', '2014-12-18 13:21:21', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `workexperience`
--

CREATE TABLE IF NOT EXISTS `workexperience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `functional_area` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `datefrom` datetime DEFAULT NULL,
  `dateto` datetime DEFAULT NULL,
  `current_sal` varchar(255) DEFAULT NULL,
  `expected_sal` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `resume_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `workexperience`
--

INSERT INTO `workexperience` (`id`, `uid`, `experience`, `year`, `month`, `skills`, `functional_area`, `company_name`, `position`, `datefrom`, `dateto`, `current_sal`, `expected_sal`, `resume`, `resume_title`) VALUES
(1, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appoinment`
--
ALTER TABLE `appoinment`
  ADD CONSTRAINT `appoinment_ibfk_1` FOREIGN KEY (`from_uid`) REFERENCES `registration` (`id`),
  ADD CONSTRAINT `appoinment_ibfk_2` FOREIGN KEY (`for_uid`) REFERENCES `registration` (`id`);

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

--
-- Constraints for table `personaldetails`
--
ALTER TABLE `personaldetails`
  ADD CONSTRAINT `personaldetails_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`);

--
-- Constraints for table `workexperience`
--
ALTER TABLE `workexperience`
  ADD CONSTRAINT `workexperience_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
