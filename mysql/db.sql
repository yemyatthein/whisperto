-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 27, 2011 at 02:08 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `whisperdb`
-- 
CREATE DATABASE `whisperdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `whisperdb`;

-- --------------------------------------------------------

-- 
-- Table structure for table `comments`
-- 

CREATE TABLE `comments` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `content` varchar(255) NOT NULL,
  `time_created` datetime NOT NULL,
  `whisper_id` int(5) unsigned NOT NULL,
  `user_id` int(5) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- 
-- Dumping data for table `comments`
-- 

INSERT INTO `comments` VALUES (1, 'Are you, George??', '2011-02-14 03:07:49', 1, 1);
INSERT INTO `comments` VALUES (2, 'Another comment from me', '2011-02-14 04:06:54', 1, 1);
INSERT INTO `comments` VALUES (4, 'Please send me mail here. Thanks', '2011-05-16 17:53:25', 3, 2);
INSERT INTO `comments` VALUES (5, 'Hello I meant...haha', '2011-05-16 18:40:33', 2, 1);
INSERT INTO `comments` VALUES (6, 'Hello Haha', '2011-05-16 19:03:16', 1, 1);
INSERT INTO `comments` VALUES (7, 'I am not sure', '2011-05-16 19:06:16', 2, 1);
INSERT INTO `comments` VALUES (8, 'Hi. Thanks for the message. It is very intriguing indeed.', '2011-05-16 20:14:12', 3, 1);
INSERT INTO `comments` VALUES (9, 'Let me know the mobile number', '2011-05-16 20:14:48', 3, 1);
INSERT INTO `comments` VALUES (10, 'Mine is  66 80003553', '2011-05-16 20:15:34', 3, 1);
INSERT INTO `comments` VALUES (11, 'Thanks for the number', '2011-05-16 20:18:56', 3, 2);
INSERT INTO `comments` VALUES (12, 'My number : 66 80233452', '2011-05-17 11:12:11', 3, 2);
INSERT INTO `comments` VALUES (13, 'yeah..LOL', '2011-05-17 19:19:54', 2, 2);
INSERT INTO `comments` VALUES (14, 'Nice one sir', '2011-05-18 08:55:46', 1, 2);
INSERT INTO `comments` VALUES (15, 'LOP', '2011-05-22 14:54:39', 2, 1);
INSERT INTO `comments` VALUES (16, 'dsa\n', '2011-05-22 15:01:28', 2, 1);
INSERT INTO `comments` VALUES (17, 'ALLOWED \n', '2011-05-22 15:01:53', 2, 1);
INSERT INTO `comments` VALUES (18, 'Dd', '2011-05-22 15:02:39', 2, 1);
INSERT INTO `comments` VALUES (19, 'fas\nDSD\ndsa', '2011-05-22 15:04:33', 1, 1);
INSERT INTO `comments` VALUES (20, 'Hello James..Im Ye', '2011-05-22 15:08:00', 4, 1);
INSERT INTO `comments` VALUES (21, 'Arnold Schwarzenegger is known for extraordinary accomplishments: bodybuilder; actor; politician. Yet the revelation of a love child by his housekeeper has set back his latest ambitions, analysts say.', '2011-05-22 15:18:30', 4, 3);
INSERT INTO `comments` VALUES (22, 'Blasdf kdks ksmai sa', '2011-05-22 16:25:41', 1, 2);
INSERT INTO `comments` VALUES (23, 'Great to see it back because I used that algorithm for many many years and it works perfectly. You may try to test on load balancing technique as well.', '2011-05-23 06:43:09', 6, 1);
INSERT INTO `comments` VALUES (24, 'I think you are right. I want to see the result next week if you can manage to show it. Thanks a lot.', '2011-05-23 07:52:52', 6, 3);
INSERT INTO `comments` VALUES (25, 'By the way I am not sure nl2br is used or not. So I tested it here\nOK..right,..approach is good', '2011-05-23 07:53:31', 6, 3);
INSERT INTO `comments` VALUES (26, 'No..me neither..quite boring there', '2011-05-23 12:47:30', 8, 2);
INSERT INTO `comments` VALUES (27, 'But Im going..i got appointment with Brendy, my team member..', '2011-05-23 12:48:22', 8, 3);
INSERT INTO `comments` VALUES (28, 'yea', '2011-05-23 16:18:14', 13, 2);
INSERT INTO `comments` VALUES (29, 'That is affirmative sir..hehe', '2011-05-24 04:24:30', 14, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `invitations`
-- 

CREATE TABLE `invitations` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `user_id` int(5) unsigned NOT NULL,
  `email` varchar(200) NOT NULL,
  `md5` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `invitations`
-- 

INSERT INTO `invitations` VALUES (8, 1, 'ymt23@gmail.com', 'b06971f88f5b4b5742be39c52ea87667');

-- --------------------------------------------------------

-- 
-- Table structure for table `notifications`
-- 

CREATE TABLE `notifications` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `type` int(1) unsigned NOT NULL COMMENT '0-new request, 1-accept request, 2-join and accept',
  `user_to` int(4) unsigned NOT NULL,
  `user_from` int(4) unsigned NOT NULL,
  `time_created` datetime NOT NULL,
  `seen` int(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `notifications`
-- 

INSERT INTO `notifications` VALUES (6, 1, 3, 2, '2011-05-23 11:04:51', 1);
INSERT INTO `notifications` VALUES (5, 0, 2, 3, '2011-05-23 10:04:51', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `responses`
-- 

CREATE TABLE `responses` (
  `user_id` int(5) unsigned NOT NULL,
  `comment_id` int(5) unsigned NOT NULL,
  `for_cake` varchar(10) NOT NULL,
  PRIMARY KEY  (`for_cake`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `responses`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `secondname` varchar(20) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `about` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'yemyatthein@gmail.com', '84740c46faa9fbde7d41b39d128b97ad042106b7', 'Ye', 'Myat', 'default.png', '1989-03-15', 'I am interested to communicate and discuss over online securely. Add me as friend if you want.', 'Male');
INSERT INTO `users` VALUES (2, 'blazing_throne@hotmail.com', '84740c46faa9fbde7d41b39d128b97ad042106b7', 'Curious', 'George', 'default.png', '1992-06-08', 'I am interested to communicate and discuss over online securely. Add me as friend if you wish.', 'Male');
INSERT INTO `users` VALUES (3, 'blazing_throne@yahoo.com', '84740c46faa9fbde7d41b39d128b97ad042106b7', 'James', 'Bond', 'default.png', '1988-03-11', 'I am interested to communicate and discuss over online securely. Add me as friend if you want.', 'Male');

-- --------------------------------------------------------

-- 
-- Table structure for table `users_users`
-- 

CREATE TABLE `users_users` (
  `user_id_1` int(5) unsigned NOT NULL,
  `user_id_2` int(5) unsigned NOT NULL,
  `status` int(1) NOT NULL default '0' COMMENT '0-Inviter 1-friend 2-invitee ',
  PRIMARY KEY  (`user_id_1`,`user_id_2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `users_users`
-- 

INSERT INTO `users_users` VALUES (1, 2, 1);
INSERT INTO `users_users` VALUES (2, 1, 1);
INSERT INTO `users_users` VALUES (1, 3, 1);
INSERT INTO `users_users` VALUES (3, 1, 1);
INSERT INTO `users_users` VALUES (3, 2, 1);
INSERT INTO `users_users` VALUES (2, 3, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `users_whispers`
-- 

CREATE TABLE `users_whispers` (
  `whisper_id` int(5) unsigned NOT NULL,
  `user_id` int(5) unsigned NOT NULL,
  `seen` int(1) NOT NULL default '0',
  `interested` int(1) NOT NULL default '1',
  `for_cake` varchar(10) NOT NULL,
  PRIMARY KEY  (`whisper_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Visible to';

-- 
-- Dumping data for table `users_whispers`
-- 

INSERT INTO `users_whispers` VALUES (1, 2, 1, 1, '1-2');
INSERT INTO `users_whispers` VALUES (1, 1, 1, 1, '1-1');
INSERT INTO `users_whispers` VALUES (2, 2, 1, 1, '2-2');
INSERT INTO `users_whispers` VALUES (2, 1, 1, 1, '2-1');
INSERT INTO `users_whispers` VALUES (3, 1, 1, 1, '3-1');
INSERT INTO `users_whispers` VALUES (3, 2, 1, 1, '3-2');
INSERT INTO `users_whispers` VALUES (4, 1, 1, 1, '4-1');
INSERT INTO `users_whispers` VALUES (4, 3, 1, 1, '4-3');
INSERT INTO `users_whispers` VALUES (6, 1, 1, 1, '6-1');
INSERT INTO `users_whispers` VALUES (6, 3, 1, 1, '6-3');
INSERT INTO `users_whispers` VALUES (8, 2, 1, 1, '8-2');
INSERT INTO `users_whispers` VALUES (8, 3, 1, 1, '8-3');
INSERT INTO `users_whispers` VALUES (8, 1, 1, 1, '8-1');
INSERT INTO `users_whispers` VALUES (9, 1, 1, 1, '9-1');
INSERT INTO `users_whispers` VALUES (10, 1, 1, 1, '10-1');
INSERT INTO `users_whispers` VALUES (11, 1, 1, 1, '11-1');
INSERT INTO `users_whispers` VALUES (12, 1, 1, 1, '12-1');
INSERT INTO `users_whispers` VALUES (13, 3, 1, 1, '13-3');
INSERT INTO `users_whispers` VALUES (13, 2, 1, 1, '13-2');
INSERT INTO `users_whispers` VALUES (13, 1, 1, 1, '13-1');
INSERT INTO `users_whispers` VALUES (14, 3, 1, 1, '14-3');
INSERT INTO `users_whispers` VALUES (14, 1, 1, 1, '14-1');

-- --------------------------------------------------------

-- 
-- Table structure for table `whispers`
-- 

CREATE TABLE `whispers` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `content` text NOT NULL,
  `time_created` datetime NOT NULL,
  `user_id` int(5) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `whispers`
-- 

INSERT INTO `whispers` VALUES (1, 'hay how do you think this job? I am interested in it. ^_^', '2011-02-14 03:04:06', 1);
INSERT INTO `whispers` VALUES (2, 'Heklo', '2011-05-16 15:37:56', 1);
INSERT INTO `whispers` VALUES (3, 'This is right Ye. We can discuss about that issue in more detail if we can meet next week. I appreciate your suggestion to add that feature in our service.', '2011-05-16 17:52:46', 2);
INSERT INTO `whispers` VALUES (4, 'Hi How are you?\r\n~James', '2011-05-22 15:07:28', 3);
INSERT INTO `whispers` VALUES (6, 'Another one with your text loop', '2011-05-22 16:08:22', 3);
INSERT INTO `whispers` VALUES (8, 'Are you guys going to the party tonight? I think I will skip hehehe...Sooooo lazzzyyy ', '2011-05-23 12:46:53', 1);
INSERT INTO `whispers` VALUES (13, 'Another message to test the value of it...hahaha', '2011-05-23 16:14:30', 1);
INSERT INTO `whispers` VALUES (14, 'My name is Gkf . I watch that match..haha', '2011-05-23 16:18:00', 1);
