SET NAMES utf8;

SET time_zone = '+00:00';

SET foreign_key_checks = 0;

SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `appsetting`;

CREATE TABLE `appsetting` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`setting_id` int(10) unsigned NOT NULL,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`value` text COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),KEY `appsetting_setting_id_foreign` (`setting_id`),CONSTRAINT `appsetting_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settinglist` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `appsetting` (`id`, `setting_id`, `name`, `value`, `created_at`, `updated_at`) VALUES(1,1,'name','Simply',NULL,NULL),(2,	1,'user.register','true',NULL,NULL);

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`icon` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `categories_name_unique` (`name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `title`, `icon`, `created_at`, `updated_at`) VALUES(1,'Undefined','Doesn\'t hold any category','fi-wrench',NULL,NULL);

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`content` longtext COLLATE utf8_unicode_ci NOT NULL,`author` int(10) unsigned NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,`deleted_at` timestamp NULL DEFAULT NULL,`is_a_menu` tinyint(1) NOT NULL DEFAULT '0',PRIMARY KEY (`id`),KEY `pages_author_foreign` (`author`),CONSTRAINT `pages_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pages` (`id`, `title`, `description`, `content`, `author`, `created_at`, `updated_at`, `deleted_at`, `is_a_menu`) VALUES(1,'About Us','','',1,NULL,NULL,NULL,0),(2,'Contact Us','','',1,NULL,NULL,NULL,0);

DROP TABLE IF EXISTS `pagessetting`;

CREATE TABLE `pagessetting` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`page_id` int(10) unsigned NOT NULL,`search` tinyint(1) NOT NULL,`share` tinyint(1) NOT NULL,`fullpage` tinyint(1) NOT NULL,`leftnav` tinyint(1) NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),KEY `pagessetting_page_id_foreign` (`page_id`),CONSTRAINT `pagessetting_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (`email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,KEY `password_resets_email_index` (`email`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`content` longtext COLLATE utf8_unicode_ci NOT NULL,`user_id` int(10) unsigned NOT NULL,`category_id` int(10) unsigned NOT NULL,`views` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',`tags` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`type` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Draft, 1 - Scheduled, 2 - Published, 3 - Deleted',`schedule` datetime DEFAULT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,`deleted_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `post_url_unique` (`url`),UNIQUE KEY `post_title_unique` (`title`),KEY `post_user_id_foreign` (`user_id`),KEY `post_category_id_foreign` (`category_id`),CONSTRAINT `post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,CONSTRAINT `post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `role` (`id`, `name`, `description`) VALUES(1,'author','Someone who\'s access is to create content.'),(2,'administrator','Have all the access to every function on this app.');

DROP TABLE IF EXISTS `settinglist`;

CREATE TABLE `settinglist` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`value` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `settinglist` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES(1,'app','Application',NULL,NULL);

DROP TABLE IF EXISTS `userrole`;

CREATE TABLE `userrole` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`role_id` int(10) unsigned NOT NULL,`user_id` int(10) unsigned NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `userrole_user_id_unique`(`user_id`),KEY `userrole_role_id_foreign` (`role_id`),CONSTRAINT `userrole_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,CONSTRAINT `userrole_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `userrole` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES(1,2,1,'2018-02-08 16:38:34','2018-02-08 16:38:34');