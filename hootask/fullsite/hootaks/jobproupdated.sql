-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2015 at 05:29 PM
-- Server version: 5.5.43
-- PHP Version: 5.3.10-1ubuntu3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE IF NOT EXISTS `certification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cert_name` varchar(255) NOT NULL,
  `cert_authority` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `cert_url` varchar(555) NOT NULL,
  `from_month` varchar(20) DEFAULT NULL,
  `s_date` varchar(255) DEFAULT NULL,
  `to_month` varchar(20) DEFAULT NULL,
  `e_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certification_ibfk_1` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`id`, `uid`, `cert_name`, `cert_authority`, `license_number`, `cert_url`, `from_month`, `s_date`, `to_month`, `e_date`) VALUES
(1, 11, '', '', '', '', NULL, NULL, NULL, NULL),
(2, 12, '', '', '', '', NULL, NULL, NULL, NULL),
(3, 13, '', '', '', '', NULL, NULL, NULL, NULL),
(4, 14, '', '', '', '', NULL, NULL, NULL, NULL),
(5, 15, '', '', '', '', NULL, NULL, NULL, NULL),
(6, 16, '', '', '', '', NULL, NULL, NULL, NULL),
(7, 17, '', '', '', '', NULL, NULL, NULL, NULL),
(8, 18, '', '', '', '', NULL, NULL, NULL, NULL),
(10, 20, '', '', '', '', NULL, NULL, NULL, NULL),
(11, 21, '', '', '', '', NULL, NULL, NULL, NULL),
(12, 22, '', '', '', '', NULL, NULL, NULL, NULL),
(13, 23, '', '', '', '', NULL, NULL, NULL, NULL),
(15, 25, '', '', '', '', NULL, NULL, NULL, NULL),
(16, 26, '', '', '', '', NULL, NULL, NULL, NULL),
(17, 27, '', '', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `from_month` varchar(20) DEFAULT NULL,
  `s_date` varchar(20) DEFAULT NULL,
  `to_month` varchar(20) DEFAULT NULL,
  `e_date` varchar(11) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `uid`, `school`, `from_month`, `s_date`, `to_month`, `e_date`, `degree`, `field_of_study`, `grade`, `description`) VALUES
(1, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`) VALUES
(4, 'Telugu'),
(5, 'Kannada');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(555) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(700) NOT NULL,
  `country` varchar(20) NOT NULL,
  `Maritial_status` varchar(20) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `language` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `profile_complete` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL,
  `active_state` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `image`, `firstname`, `lastname`, `gender`, `email`, `password`, `address`, `country`, `Maritial_status`, `dob`, `language`, `contact`, `user_type`, `profile_complete`, `reg_date`, `active_state`) VALUES
(11, 'user_unknown.jpg', 'Ajay', 'Payal', 'Male', 'ajaypayal@gmail.com', '123456', '', '', '', '', '', '', 'Mentor', '', '2014-12-31 11:46:14', '1'),
(12, '2014-12-3111-52-17.png', 'Arpita', 'Singh', 'Female', 'ArpitaSingh@gmail.com', '123456', '', '0', '', '0', 'Hindi', '1234567890', 'Mentor', '86', '2014-12-31 11:46:43', '1'),
(13, '2014-12-3111-52-42.png', 'Arpan', 'Patidar', 'Male', 'ArpanPatidar@gmail.com', '123456', '', '0', '', '0', 'English', '9876543210', 'Mentor', '80', '2014-12-31 11:47:14', '1'),
(14, '2014-12-3111-53-06.png', 'Ankit', 'Trivedi', 'Male', 'AnkitTrivedi@gmail.com', '123456', '', '0', '', '0', 'English', '9876543210', 'Mentor', '100', '2014-12-31 11:47:35', '1'),
(15, '2014-12-3111-53-25.png', 'Ankur', 'Gupta', 'Male', 'AnkurGupta@gmail.com', '123456', '', '0', '', '0', 'Malyalam', '1234567890', 'Mentor', '100', '2014-12-31 11:47:58', '1'),
(16, '2014-12-3111-53-51.png', 'Atul', 'Bharat', 'Male', 'AtulBharat@gmail.com', '123456', '', '0', '', '0', 'Malyalam', '9876543210', 'Mentor', '100', '2014-12-31 11:48:19', '1'),
(17, '2014-12-3111-54-09.png', 'Arvind', 'Jain', 'Male', 'ArvindJain@gmail.com', '123456', '', '0', '', '0', 'Telugu', '', 'Mentor', '90', '2014-12-31 11:48:40', '1'),
(18, '2014-12-3111-54-36.png', 'Ankita', 'Gangaramani', 'Male', 'AnkitaGangaramani@gmail.com', '123456', '', '', '', '', '', '', 'Mentor', '100', '2014-12-31 11:49:02', '1'),
(19, '2014-12-3111-55-09.png', 'Arpita', 'Dholi', 'Female', 'ArpitaDholi@gmail.com', '123456', '', '0', '', '0', 'hindi', '1234567890', 'Jobseeker', '100', '2014-12-31 11:49:27', '1'),
(20, '14200325642067346180.jpg', 'Anna', 'Hajare', 'Male', 'AnnaHajare@gmail.com', '123456', '', '0', '', '0', '', '', 'Jobseeker', '100', '2014-12-31 11:49:57', '1'),
(21, '2014-12-3111-55-59.png', 'Anil', 'Kumble', 'Male', 'AnilKumble@gmail.com', '123456', '', '', '', '', '', '', 'Mentor', '99', '2014-12-31 11:50:15', '0'),
(22, '2014-12-3111-56-34.png', 'Anarkali', 'Jubeda', 'Female', 'AnarkaliJubeda@gmail.com', '123456', '', '', '', '', '', '', 'Mentor', '100', '2014-12-31 11:50:53', '0'),
(23, '2014-12-3114-12-08.png', 'Admin', 'Admin', 'Male', 'admin@gmail.com', '123456', '', '', '', '', '', '', 'Admin', '', '2014-12-31 12:15:28', '1'),
(25, 'user_unknown.jpg', 'mentor', 'mentor', 'Female', 'mentor@gmail.com', '123456', '', '', '', '', '', '', 'Mentor', '', '2014-12-31 14:31:41', '1'),
(26, '14200327511456207471.jpg', 'varsh', 'verma', 'Male', 'varsh@gmail.com', '123456', '', '0', '', '0', '', '', 'Jobseeker', '', '2014-12-31 14:32:19', '1'),
(27, 'user_unknown.jpg', 'jobseeker', 'jobseeker', '0', 'jobseeker@gmail.com', '123456', '', '0', '', '0', '', '', 'Jobseeker', '', '2014-12-31 19:20:07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `skill` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `skills_ibfk_1` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `uid`, `skill`) VALUES
(9, 11, 'MCSE, OCTE'),
(10, 12, 'Php, .Net, Java'),
(11, 13, 'Oracal, SCJP'),
(12, 14, 'Thermodynamics'),
(13, 15, 'CCNA, CCNP, CCIE'),
(14, 16, 'CCNA, CCNP, .Net, Java, C++'),
(15, 17, '.net, MBA(Marketing)'),
(16, 18, 'Drupal, Php'),
(17, 19, 'Marketing'),
(18, 20, 'Magento, Joomla'),
(19, 21, 'CakePhp, Codeigniter'),
(20, 22, 'SCJP,Drupal'),
(21, 23, 'ODesk'),
(23, 25, ''),
(24, 26, ''),
(25, 27, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_summary`
--

CREATE TABLE IF NOT EXISTS `user_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `summary` varchar(2000) DEFAULT NULL,
  `link` varchar(555) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_summary_ibfk_1` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_summary`
--

INSERT INTO `user_summary` (`id`, `uid`, `summary`, `link`, `title`, `description`) VALUES
(10, 11, NULL, NULL, NULL, NULL),
(11, 12, '  Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge\n\n \n\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem. Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge ', '0', '0', '0'),
(12, 13, 'Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge\n\n \n\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem. Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge', NULL, NULL, NULL),
(13, 14, NULL, NULL, NULL, NULL),
(14, 15, NULL, NULL, NULL, NULL),
(15, 16, NULL, NULL, NULL, NULL),
(16, 17, NULL, NULL, NULL, NULL),
(17, 18, 'Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge\n\n \n\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem. Dean is CEO and founder of Yamato LTD Europe. With 15 years of experience he brings his expertise and knowledge', NULL, NULL, NULL),
(18, 19, '  fgsgfdgdfgsf', NULL, NULL, NULL),
(19, 20, NULL, NULL, NULL, NULL),
(20, 21, NULL, NULL, NULL, NULL),
(21, 22, NULL, NULL, NULL, NULL),
(22, 23, NULL, NULL, NULL, NULL),
(24, 25, NULL, NULL, NULL, NULL),
(25, 26, NULL, NULL, NULL, NULL),
(26, 27, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workexperience`
--

CREATE TABLE IF NOT EXISTS `workexperience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `jobtitle` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `from_month` varchar(20) DEFAULT NULL,
  `s_year` varchar(50) DEFAULT NULL,
  `to_month` varchar(20) DEFAULT NULL,
  `e_year` varchar(50) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `workexperience`
--

INSERT INTO `workexperience` (`id`, `uid`, `company_name`, `jobtitle`, `location`, `from_month`, `s_year`, `to_month`, `e_year`, `description`) VALUES
(10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 14, 'Batch Masters', 'Quality Testing', 'Indore', 'January', '2014', 'January', '2014', 'Working here from 1 year'),
(14, 15, 'Wipro India pvt Ltd', 'Senior Technical Consultant', 'Mumbai', 'January', '2009', 'April', '2012', '2 Year Completed With Company'),
(15, 16, 'TCS', 'Network Engineer', 'Gurgaon', 'February', '2013', 'March', '2014', '3 Year With Company'),
(16, 17, 'New Tech Fusion', 'Network Engineer', 'Gurgaon', 'November', '1998', 'November', '2007', ''),
(17, 18, 'Batch Masters', 'Quality Testing', 'Mumbai', 'February', '2013', 'March', '2014', ''),
(18, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 12, 'New Tech Fusion', 'Php Developer', 'Indore', 'January', '2002', 'May', '2012', 'I am woking from last 10 Years'),
(24, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 13, 'Infosys', 'Managing Director', 'Gurgaon', 'January', '2014', 'January', '2014', 'From Last 3 Year  i am working Here'),
(27, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certification`
--
ALTER TABLE `certification`
  ADD CONSTRAINT `certification_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

--
-- Constraints for table `user_summary`
--
ALTER TABLE `user_summary`
  ADD CONSTRAINT `user_summary_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

--
-- Constraints for table `workexperience`
--
ALTER TABLE `workexperience`
  ADD CONSTRAINT `workexperience_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
