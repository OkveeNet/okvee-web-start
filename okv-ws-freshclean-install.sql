-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2012 at 12:52 AM
-- Server version: 5.5.15
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `v_web_start`
--

-- --------------------------------------------------------

--
-- Table structure for table `ws_accounts`
--

CREATE TABLE IF NOT EXISTS `ws_accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_username` varchar(255) DEFAULT NULL,
  `account_email` varchar(255) DEFAULT NULL,
  `account_password` varchar(255) DEFAULT NULL,
  `account_fullname` varchar(255) DEFAULT NULL,
  `account_birthdate` date DEFAULT NULL,
  `account_avatar` varchar(255) DEFAULT NULL,
  `account_signature` text,
  `account_create` datetime DEFAULT NULL,
  `account_last_login` datetime DEFAULT NULL,
  `account_online_code` varchar(255) DEFAULT NULL COMMENT 'store session code for check dubplicate log in if enabled.',
  `account_status` int(1) NOT NULL DEFAULT '0' COMMENT '0=disable, 1=enable',
  `account_status_text` varchar(255) DEFAULT NULL,
  `account_new_email` varchar(255) DEFAULT NULL,
  `account_new_password` varchar(255) DEFAULT NULL,
  `account_confirm_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ws_accounts`
--

INSERT INTO `ws_accounts` (`account_id`, `account_username`, `account_email`, `account_password`, `account_fullname`, `account_birthdate`, `account_avatar`, `account_signature`, `account_create`, `account_last_login`, `account_online_code`, `account_status`, `account_status_text`, `account_new_email`, `account_new_password`, `account_confirm_code`) VALUES
(1, 'admin', 'admin@domain.tld', '5ab0383413f56451cb0fdeaa6b0b224f334f71d3', '', NULL, NULL, '', '2011-04-20 19:20:04', '2012-02-27 23:11:53', '20928f4873f864d04428510df6c9d0d7', 1, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ws_account_level`
--

CREATE TABLE IF NOT EXISTS `ws_account_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_group_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`level_id`),
  KEY `level_group_id` (`level_group_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ws_account_level`
--

INSERT INTO `ws_account_level` (`level_id`, `level_group_id`, `account_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_account_level_group`
--

CREATE TABLE IF NOT EXISTS `ws_account_level_group` (
  `level_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(255) DEFAULT NULL,
  `level_description` text,
  `level_priority` int(5) NOT NULL DEFAULT '1' COMMENT 'lower is more higher priority',
  PRIMARY KEY (`level_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ws_account_level_group`
--

INSERT INTO `ws_account_level_group` (`level_group_id`, `level_name`, `level_description`, `level_priority`) VALUES
(1, 'Super administrator', 'best for site owner.', 1),
(2, 'Administrator', NULL, 2),
(3, 'Member', 'Just member.', 999);

-- --------------------------------------------------------

--
-- Table structure for table `ws_account_level_permission`
--

CREATE TABLE IF NOT EXISTS `ws_account_level_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_page` varchar(255) NOT NULL,
  `params` text,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `permission_page` (`permission_page`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ws_account_level_permission`
--

INSERT INTO `ws_account_level_permission` (`permission_id`, `permission_page`, `params`) VALUES
(1, 'account_account', 'a:3:{i:1;a:5:{s:14:"account_manage";s:1:"1";s:11:"account_add";s:1:"1";s:12:"account_edit";s:1:"1";s:14:"account_delete";s:1:"1";s:19:"account_view_logins";s:1:"1";}i:2;a:5:{s:14:"account_manage";s:1:"1";s:11:"account_add";s:1:"0";s:12:"account_edit";s:1:"1";s:14:"account_delete";s:1:"0";s:19:"account_view_logins";s:1:"1";}i:3;a:5:{s:14:"account_manage";s:1:"0";s:11:"account_add";s:1:"0";s:12:"account_edit";s:1:"0";s:14:"account_delete";s:1:"0";s:19:"account_view_logins";s:1:"0";}}'),
(2, 'account_level', 'a:3:{i:1;a:4:{s:20:"account_manage_level";s:1:"1";s:17:"account_add_level";s:1:"1";s:18:"account_edit_level";s:1:"1";s:20:"account_delete_level";s:1:"1";}i:2;a:4:{s:20:"account_manage_level";s:1:"1";s:17:"account_add_level";s:1:"0";s:18:"account_edit_level";s:1:"1";s:20:"account_delete_level";s:1:"0";}i:3;a:4:{s:20:"account_manage_level";s:1:"0";s:17:"account_add_level";s:1:"0";s:18:"account_edit_level";s:1:"0";s:20:"account_delete_level";s:1:"0";}}'),
(3, 'account_permissions', 'a:3:{i:1;a:1:{s:25:"account_manage_permission";s:1:"1";}i:2;a:1:{s:25:"account_manage_permission";s:1:"0";}i:3;a:1:{s:25:"account_manage_permission";s:1:"0";}}'),
(4, 'admin_global_config', 'a:3:{i:1;a:1:{s:20:"admin_website_config";s:1:"1";}i:2;a:1:{s:20:"admin_website_config";s:1:"0";}i:3;a:1:{s:20:"admin_website_config";s:1:"0";}}'),
(5, 'account_admin_login', 'a:3:{i:1;a:1:{s:19:"account_admin_login";s:1:"1";}i:2;a:1:{s:19:"account_admin_login";s:1:"1";}i:3;a:1:{s:19:"account_admin_login";s:1:"0";}}');

-- --------------------------------------------------------

--
-- Table structure for table `ws_account_logins`
--

CREATE TABLE IF NOT EXISTS `ws_account_logins` (
  `account_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `login_ua` varchar(255) DEFAULT NULL,
  `login_os` varchar(255) DEFAULT NULL,
  `login_browser` varchar(255) DEFAULT NULL,
  `login_ip` varchar(255) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_attempt` int(1) NOT NULL DEFAULT '0' COMMENT '0=fail, 1=success',
  `login_attempt_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_login_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ws_account_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `ws_config`
--

CREATE TABLE IF NOT EXISTS `ws_config` (
  `config_name` varchar(255) DEFAULT NULL,
  `config_value` varchar(255) DEFAULT NULL,
  `config_core` int(1) DEFAULT '0' COMMENT '0=no, 1=yes. if config core then please do not delete from db.',
  `config_description` text,
  KEY `config_name` (`config_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ws_config`
--

INSERT INTO `ws_config` (`config_name`, `config_value`, `config_core`, `config_description`) VALUES
('site_name', 'okvee Web start', 1, 'website name'),
('page_title_separator', ' &rsaquo; ', 1, 'page title separator. eg. site name | page'),
('duplicate_login', 'off', 1, 'allow log in more than 1 place, session? set to on/off to allow/disallow.'),
('allow_avatar', '1', 1, 'set to 1 if use avatar or set to 0 if not use it.'),
('avatar_size', '200', 1, 'set file size in Kilobyte.'),
('avatar_allowed_types', 'gif|jpg|png', 1, 'avatar allowe file types (see reference from codeigniter)\r\neg. gif|jpg|png'),
('avatar_path', 'client/avatar/', 1, 'path to directory for upload avatar'),
('member_allow_register', '1', 1, 'allow users to register'),
('member_verification', '1', 1, 'member verification method.\r\n1 = verify by email\r\n2 = wait for admin verify');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ws_account_level`
--
ALTER TABLE `ws_account_level`
  ADD CONSTRAINT `ws_account_level_ibfk_1` FOREIGN KEY (`level_group_id`) REFERENCES `ws_account_level_group` (`level_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ws_account_level_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `ws_accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ws_account_logins`
--
ALTER TABLE `ws_account_logins`
  ADD CONSTRAINT `ws_account_logins_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `ws_accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;
