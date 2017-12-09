-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2015 at 06:29 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `851906`
--

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `partner` varchar(255) NOT NULL,
  `email_ids` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `country`, `partner`, `email_ids`) VALUES
(1, 'United States (HQ)', 'CDC', 'bharat.prajapat@newtechfusion.com'),
(2, 'Angola', 'Census', 'rohit.malviya@newtechfusion.com'),
(3, 'India', 'Implementing Partner', 'rohit.malviya@newtechfusion.com,bharat.prajapat@newtechfusion.com,prajapat21bharat@gmail.com'),
(4, 'Botswana', 'DoD', 'prajapat21bharat@gmail.com'),
(5, 'Asia Regional Program', 'HRSA', 'prajapat21bharat@gmail.com,bharat.prajapat@newtechfusion.com'),
(6, 'Burundi', 'NIH', 'sumit@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(7, 'Cambodia', 'OGHA/OGA', 'sumit@newtechfusion.com,nilesh@newtechfusion.com'),
(8, 'Ghana', 'Peace Corps', 'bharat.prajapat@newtechfusion.com'),
(9, 'CÃ´te d''Ivoire', 'State/AF', 'rohit.malviya@newtechfusion.com'),
(10, 'India', 'USAID', 'ritesh.bisht@newtechfusion.com,bharat@newtechfusion.com,rohit.malviya@newtechfusion.com'),
(11, 'United States (HQ)', 'Implementing Partner', 'rahul.mishra@newtechfusion.com,bharat.prajapat@newtechfusion.com');

-- --------------------------------------------------------

--
-- Table structure for table `email_country`
--

CREATE TABLE IF NOT EXISTS `email_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `countryname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `email_country`
--

INSERT INTO `email_country` (`id`, `pid`, `countryname`, `email`) VALUES
(1, 11, 'United States (HQ)', 'bharat.prajapat@newtechfusion.com'),
(2, 11, 'Angola', 'bharat.prajapat@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(3, 11, 'Asia Regional Program', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com'),
(4, 11, 'Botswana', 'deepankar.dey@newtechfusion.com'),
(5, 11, 'Burundi', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(6, 11, 'Cambodia', 'ritesh.bisht@newtechfusion.com'),
(7, 11, 'Cameroon', 'rohit.malviya@newtechfusion.com'),
(8, 11, 'Caribbean Regional', 'ritesh.bisht@newtechfusion.com,bharat.prajapat@newtechfusion.com'),
(9, 11, 'Central America Regional', 'deepankar.dey@newtechfusion.com'),
(10, 11, 'Central Asia Region', 'rohit.malviya@newtechfusion.com'),
(11, 11, 'CÃ´te d''Ivoire', 'deepankar.dey@newtechfusion.com'),
(12, 11, 'Dem. Rep. of Congo', 'rohit.malviya@newtechfusion.com'),
(13, 11, 'Dominican Republic', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com'),
(14, 11, 'Ethiopia', 'rohit.malviya@newtechfusion.com'),
(15, 11, 'Ghana', 'bharat.prajapat@newtechfusion.com'),
(16, 11, 'Guyana', 'bharat.prajapat@newtechfusion.com'),
(17, 11, 'Haiti', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com'),
(18, 11, 'India', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(19, 11, 'Indonesia', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com'),
(20, 11, 'Kenya', 'rohit.malviya@newtechfusion.com'),
(21, 11, 'Lesotho', 'deepankar.dey@newtechfusion.com'),
(22, 11, 'Malawi', 'bharat.prajapat@newtechfusion.com'),
(23, 11, 'Mozambique', 'bharat.prajapat@newtechfusion.com'),
(24, 11, 'Namibia', 'rohit.malviya@newtechfusion.com'),
(25, 11, 'Nigeria', 'ritesh.bisht@newtechfusion.com'),
(26, 11, 'Papua New Guinea', 'deepankar.dey@newtechfusion.com'),
(27, 11, 'Rwanda', 'deepankar.dey@newtechfusion.com'),
(28, 11, 'South Africa', 'rohit.malviya@newtechfusion.com'),
(29, 11, 'South Sudan', 'bharat.prajapat@newtechfusion.com'),
(30, 11, 'Swaziland', 'bharat.prajapat@newtechfusion.com'),
(31, 11, 'Tanzania', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com'),
(32, 11, 'Uganda', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(33, 11, 'Ukraine', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(34, 11, 'Vietnam', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(35, 11, 'Zambia', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(36, 11, 'Zimbabwe', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(37, 11, 'Other', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com');

-- --------------------------------------------------------

--
-- Table structure for table `email_partner`
--

CREATE TABLE IF NOT EXISTS `email_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnername` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `email_partner`
--

INSERT INTO `email_partner` (`id`, `partnername`, `email`) VALUES
(1, 'PEPFAR Coordinators Office', 'bharat.prajapat@newtechfusion.com'),
(2, 'CDC', 'rohit.malviya@newtechfusion.com'),
(3, 'Census', 'ritesh.bisht@newtechfusion.com'),
(4, 'DoD', 'bharat.prajapat@newtechfusion.com,rahul.mishra@newtechfusion.com'),
(5, 'HRSA', 'rahul.mishra@newtechfusion.com,rohit.malviya@gmail.com'),
(6, 'NIH', 'deepankar.dey@newtechfusion.com'),
(7, 'OGHA/OGA', 'bharat.prajapat@newtechfusion.com'),
(8, 'Peace Corps', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com'),
(9, 'State/AF', 'ritesh.bisht@newtechfusion.com,bharat.prajapat@newtechfusion.com'),
(10, 'USAID', 'rahul.mishra@newtechfusion.com,rohit.malviya@gmail.com,bharat.prajapat@newtechfusion.com'),
(11, 'Implementing Partner', 'bharat.prajapat@newtechfusion.com,rohit.malviya@newtechfusion.com,riteshbisht@newtechfusion.com,rahul.mishra@newtechfusion.com');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `participating_org` varchar(255) NOT NULL,
  `implementing_partner` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `data_stream` varchar(255) NOT NULL,
  `access_type` varchar(255) NOT NULL,
  `acc_full_name` varchar(255) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_org` varchar(255) NOT NULL,
  `justification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `firstname`, `lastname`, `email`, `country`, `participating_org`, `implementing_partner`, `language`, `data_stream`, `access_type`, `acc_full_name`, `acc_email`, `acc_org`, `justification`) VALUES
(9, 'Bharat', 'Prajapat', 'admin@gmail.com', 'United States (HQ)', 'PEPFAR Coordinators Office', '', 'Arabic', 'MER,SIMS', 'Data Entry SIMS,Data Entry MER,Accept Data,Submit Data,Read Data', '', '', '', 'test'),
(10, 'Bharat', 'bisht', 'admin1@gmail.com', 'United States (HQ)', 'PEPFAR Coordinators Office', '', 'Arabic', 'MER,SIMS', 'Data Entry SIMS,Accept Data', '', '', '', 'bharat'),
(11, 'Bharat', 'bisht', 'a@g.com', 'United States (HQ)', 'PEPFAR Coordinators Office', '', 'Arabic', 'MER,SIMS', 'Data Entry SIMS,Accept Data', '', '', '', 'bharat'),
(12, 'Rahul', 'Mishra', 'rahul.mishra@newtechfusion.com', 'United States (HQ)', 'PEPFAR Coordinators Office', '', 'Vietnamese', 'MER', 'Data Entry SIMS', '', '', '', 'scsaca'),
(13, 'test account', '123', 'test@gmail.com', 'United States (HQ)', 'PEPFAR Coordinators Office', '', 'Arabic', 'MER,SIMS', 'Data Entry SIMS,Data Entry MER,Accept Data,Submit Data,Read Data', '', '', '', 'bharat'),
(14, '34534', '435345', '', '', '', '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
