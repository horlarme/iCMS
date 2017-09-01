<?php

/**
 * This script will be in charge of updating the whole site, when there's an update
 *
 */

//error_reporting(0);
//Composer Autoloader
require './vendor/autoload.php';
//Configuration Files
require 'class/config.php';
$dataBase = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);
$postC = new \ITBLOG\Post($dataBase);
$blog = new ITBLOG\Blogging($dataBase);

//Dropping the table that will be updated with new values
echo "Dropping the table that will be updated with new values" . "<br />";
$dataBase->query("ALTER TABLE `postlist` DROP `URL`");
//Adding the new Table into postist
echo "Adding the new Table into postist" . "<br />";
$dataBase->query("ALTER TABLE `postlist` ADD `URL` VARCHAR(50) NOT NULL AFTER `content`");


//Creating new URL for existing pages
$fetch = $dataBase->query("SELECT `title`,`id` FROM `postlist`");

//looping through each of them and creating for them a new URL
//foreach ($fetch as $post){
while ($post = $fetch->fetch()) {
    $newURL = $postC->createURL($post['title']);
    echo "Changing row " . $post['id'] . "<br />";
    $dataBase->query("UPDATE `postlist` SET `URL` = '" . $newURL . "' WHERE `postlist`.`id` = " . $post['id']);
}


echo "Droping the table" ."<br />";
$dataBase->query("DROP TABLE IF EXISTS `categories`");
echo "Create the table again" ."<br />";
$dataBase->query("CREATE TABLE `categories` ( `category_id` int(11) NOT NULL AUTO_INCREMENT,`category_name` text,`category_title` text,`category_icon` text,PRIMARY KEY (`category_id`))");
echo "Adding values back into the table" ."<br />";
$dataBase->query("INSERT INTO `categories` (`category_id`,`category_name`, `category_title`, `category_icon`) VALUES
  (1, 'Security',	'Protect your device and self with security tips and helps.',	'fi-wrench'),
  (2, 'Apps',	'Software and Application related stuffs.',	'fi-social-apple'),
  (3, 'Mobile',	'Your phone Information and latest tricks',	'fi-tablet-portrait'),
  (4, 'Experiences', 'Read about other developers&apos;programmers&apos stories and experiences in the industry.', 'fi-shuffle'),
  (5, 'Others', 'I can&apos;t find a place for these!!!', 'fi-database'),
  (6, 'News', 'The happenings around our ears now seen by our eyes.', 'fi-social-designer-news'),
  (7, 'Internet', 'Internet and its NEWS...', 'fi-web')");

echo "The Update is complete" . "<br />";
echo "<a href=" . APP_ADD . ">Click here to go to home page</a>";