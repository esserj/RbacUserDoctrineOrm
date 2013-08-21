-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2013 at 08:16 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fly_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `rbac_permission`
--

CREATE TABLE IF NOT EXISTS `rbac_permission` (
  `perm_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `perm_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_role`
--

CREATE TABLE IF NOT EXISTS `rbac_role` (
  `role_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `parent_role_id` int(1) unsigned DEFAULT NULL,
  `role_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `parent_role_id` (`parent_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_role_permission`
--

CREATE TABLE IF NOT EXISTS `rbac_role_permission` (
  `role_id` int(11) unsigned NOT NULL,
  `perm_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`perm_id`),
  KEY `perm_id` (`perm_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_rbac_role`
--

CREATE TABLE IF NOT EXISTS `user_rbac_role` (
  `user_id` int(1) unsigned NOT NULL,
  `role_id` int(1) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='rbac roles for each user';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rbac_role`
--
ALTER TABLE `rbac_role`
  ADD CONSTRAINT `rbac_role_ibfk_1` FOREIGN KEY (`parent_role_id`) REFERENCES `rbac_role` (`role_id`);

--
-- Constraints for table `rbac_role_permission`
--
ALTER TABLE `rbac_role_permission`
  ADD CONSTRAINT `rbac_role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `rbac_role` (`role_id`),
  ADD CONSTRAINT `rbac_role_permission_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `rbac_permission` (`perm_id`);

--
-- Constraints for table `user_rbac_role`
--
ALTER TABLE `user_rbac_role`
  ADD CONSTRAINT `user_rbac_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rbac_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `rbac_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
