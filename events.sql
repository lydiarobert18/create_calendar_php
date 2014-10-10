-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 27, 2014 at 11:30 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_descr` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_descr`, `event_date`, `time`) VALUES
(1, 'html5', '2014-07-08', 9),
(2, 'html10', '2014-07-02', 11),
(3, 'html19', '2014-08-07', 10),
(4, 'htmk2', '2014-09-03', 14),
(5, 'javascript', '2014-07-02', 12);
