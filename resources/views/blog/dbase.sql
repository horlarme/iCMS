# Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+01:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

# Not using this databade name
# DROP DATABASE IF EXISTS `itblog`;

# CREATE DATABASE `itblog` /*!40100 DEFAULT CHARACTER SET latin1 */;
# USE `itblog`;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text,
  `category_title` text,
  `category_icon` text,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`category_id`,`category_name`, `category_title`, `category_icon`) VALUES
  (1, 'Security',	'Protect your device and self with security tips and helps.',	'fi-wrench'),
  (2, 'Apps',	'Software and Application related stuffs.',	'fi-social-apple'),
  (3, 'Mobile',	'Your phone Information and latest tricks',	'fi-tablet-portrait'),
  (4, 'Experiences', 'Read about other developers\'/programmers\' stories and experiences in the industry.', 'fi-shuffle'),
  (5, 'Others', 'I can\'t find a place for these!!!', 'fi-database'),
  (6, 'News', 'The happenings around our ears now seen by our eyes.', 'fi-social-designer-news'),
  (7, 'Internet', 'Internet and its NEWS...', 'fi-web');


# Table =  Taglist (TAG LIST)
CREATE TABLE `taglist` (`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, `tag` text);

# Table = postlist (POST LIST)
# DROP TABLE IF EXISTS `postlists`;
CREATE TABLE `postlist` (`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text,
  `description` text,
  `image` text,
  `content` longtext,
  `author` text,
  `day` INTEGER,
  `month` INTEGER,
  `year` INTEGER,
  `category_id` INTEGER,
  `views` INT(11) NOT NULL DEFAULT '0',
  `tags` text,
  `scheduleday` INTEGER,
  `schedulemonth` INTEGER,
  `scheduleyear` INTEGER,
  `URL` VARCHAR(50),
  `type` text);

# Table = comment (Comment List)
CREATE TABLE `comment` (`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, `postid` INTEGER, `name` text, `email` text, `comment` longtext, `day` INTEGER, `month` INTEGER, `year` INTEGER,`replyto` text);

# Table = newsletter (Newsletter)
CREATE TABLE `newsletter` (`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, `email` text, `active` INT NOT NULL DEFAULT "0" COMMENT '0 - Not Verified, 1 - Verified, 2 - Deleted', `activation_key` text);


# Advertisement Contacts
DROP TABLE IF EXISTS `advertContacts`;

CREATE TABLE `advertContacts`(
  `advert_id` int NOT NULL AUTO_INCREMENT,
  `advert_name` text,
  `advert_mobile` text,
  `advert_website` text,
  `advert_email` text,
  PRIMARY KEY (`advert_id`)
)